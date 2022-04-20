<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jurnal extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // check_admin();
        check_not_login();
        $this->load->library('user_agent');
    }
    public function jurnal()
    {
        $data['profil'] = $this->M_profil->getProfil()->result();
        // $data['periode'] = $this->M_periode->getPeriode()->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Laporan/filter_jurnal');
        $this->load->view('template/footer');
    }

    public function filterJurnal()
    {
        $tanggal1 = $this->input->get('tanggal1');
        $tanggal2 = $this->input->get('tanggal2');
        $data['profil'] = $this->M_profil->getProfil()->result();
        // $data['jurnal'] = $this->M_jurnal->getJurnalFilter($tanggal1, $tanggal2)->result();
        $data['header'] = $this->M_jurnal->getJurnalHeader($tanggal1, $tanggal2)->result();
        $data['tanggal1'] = $tanggal1;
        $data['tanggal2'] = $tanggal2;
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Laporan/jurnal', $data);
        $this->load->view('template/footer');
        $this->session->set_userdata('referred_from', current_url());
    }

    public function editJurnal($kode_jurnal, $tanggal)
    {
        $where = array('kode_jurnal' => $kode_jurnal);
        $where2 = array('tanggal_transaksi' => $tanggal);
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['single'] = $this->M_jurnal->getData($where, $where2)->result();
        $data['setting'] = $this->M_profil->getSetting()->result();
        $data['transaksi'] = $this->M_jurnal->getEditJurnal($where, $where2)->result();
        $data['coa'] = $this->M_coa->getCoaTrans()->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Laporan/edit_jurnalEntry', $data);
        $this->load->view('template/footer');
    }

    public function prosesEditJurnal()
    {
        $this->form_validation->set_rules('tanggal_transaksi', 'Tanggal Transaksi', 'required');
        $this->form_validation->set_rules('kode_jurnal', 'Kode Jurnal', 'required');
        $this->form_validation->set_rules('memo', 'Memo', 'required');
        $this->form_validation->set_rules('id_akun[]', 'Akun', 'required');
        $this->form_validation->set_rules('saldo[]', 'Saldo', 'required');
        $this->form_validation->set_message('required', '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $kode_jurnal = $this->input->post('kode_jurnal');
            $tanggal = $this->input->post('tanggal_transaksi');
            $where = array('kode_jurnal' => $kode_jurnal);
            $where2 = array('tanggal_transaksi' => $tanggal);
            $data['profil'] = $this->M_profil->getProfil()->result();
            $data['single'] = $this->M_jurnal->getData($where, $where2)->result();
            $data['setting'] = $this->M_profil->getSetting()->result();
            $data['transaksi'] = $this->M_jurnal->getEditJurnal($where, $where2)->result();
            $data['coa'] = $this->M_coa->getCoaTrans()->result();
            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Laporan/edit_jurnalEntry', $data);
            $this->load->view('template/footer');
        } else {
            $this->load->library('user_agent');
            $id_akun = $this->input->post('id_akun');
            $posisi = $this->input->post('posisi');
            $saldo = $this->input->post('saldo');
            $kode_jurnal = $this->input->post('kode_jurnal');
            $id_jurnal = $this->input->post('id_jurnal');
            $tanggal_transaksi = $this->input->post('tanggal_transaksi');
            $memo = $this->input->post('memo');
            $jenis_transaksi = $this->input->post('jenis_transaksi');

            $data = array();

            foreach ($id_jurnal as $id => $jurnal) {
                array_push($data, array(
                    'id_jurnal' => $jurnal,
                    'kode_jurnal' => $kode_jurnal,
                    'id_akun' => $id_akun[$id],
                    'tanggal_transaksi' => $tanggal_transaksi,
                    'memo' => $memo,
                    'posisi' => $posisi[$id],
                    'saldo_jurnal' => $saldo[$id],
                    'jenis_transaksi' => $jenis_transaksi
                ));
            }

            // var_dump($data);
            $this->db->update_batch('tb_jurnal', $data, 'id_jurnal');
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('Success', 'Data Berhasil Diubah');
                // $this->M_transaksi->sumLaba();
                $this->M_coa->sumLevel3();
                $referred_from = $this->session->userdata('referred_from');
                redirect($referred_from, 'refresh');
            } else {
                redirect($this->agent->referrer());
            }
        }
    }

    public function deleteJurnal($kode_jurnal)
    {
        $where  = array('kode_jurnal' => $kode_jurnal);
        $this->M_jurnal->deleteJurnal($where, 'tb_jurnal');
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('Success', 'Data Barang Berhasil Dihapus');
            // $this->M_transaksi->sumLaba();
            $this->M_coa->sumLevel3();
            $referred_from = $this->session->userdata('referred_from');
            redirect($referred_from, 'refresh');
        } else {
            redirect('Laporan/Jurnal/jurnal');
        }
    }
}
