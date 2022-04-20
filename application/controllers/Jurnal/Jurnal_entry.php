<?php
defined('BASEPATH') or exit('No Direct Script Access Allowed');

class Jurnal_entry extends CI_Controller
{
    // Menggunakan insert batch
    public function formJurnal()
    {
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['coa'] = $this->M_coa->getCoaTrans()->result();
        $data['setting'] = $this->M_profil->getSetting()->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Jurnal/jurnal_entry_2', $data);
        $this->load->view('template/footer');
    }

    // Ngetest Penyusutan
    public function tambahJurnal()
    {
        $setting = $this->input->post('kode_entry');
        $this->form_validation->set_rules('tanggal_transaksi', 'Tanggal Transaksi', 'required');
        $this->form_validation->set_rules('kode_jurnal', $setting, 'required');
        $this->form_validation->set_rules('memo', 'Memo', 'required');
        $this->form_validation->set_rules('id_akun[]', 'Akun', 'required');
        $this->form_validation->set_rules('saldo[]', 'Saldo', 'required');

        $this->form_validation->set_message('required', '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_message('is_unique', '%s Sudah Ada');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');
        if ($this->form_validation->run() == FALSE) {
            $data['profil'] = $this->M_profil->getProfil()->result();
            $data['coa'] = $this->M_coa->getCoaTrans()->result();
            $data['setting'] = $this->M_profil->getSetting()->result();
            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Jurnal/jurnal_entry_2', $data);
            $this->load->view('template/footer');
        } else {
            $id_akun = $this->input->post('id_akun');
            $posisi = $this->input->post('posisi');
            $saldo = $this->input->post('saldo');
            $kode_jurnal = $this->input->post('kode_jurnal');
            $tanggal_transaksi = $this->input->post('tanggal_transaksi');
            $memo = $this->input->post('memo');
            $jenis_transaksi = $this->input->post('jenis_transaksi');
            $status = $this->input->post('status');

            $data          = array();

            foreach ($id_akun as $akun => $id_akun) {
                array_push($data, array(
                    'id_akun' => $id_akun,
                    'kode_jurnal' => $kode_jurnal,
                    'jenis_transaksi' => $jenis_transaksi,
                    'tanggal_transaksi' => $tanggal_transaksi,
                    'memo' => $memo,
                    'posisi' => $posisi[$akun],
                    'saldo_jurnal' => $saldo[$akun],
                    'status' => $status
                ));
            }
            $this->M_jurnal->addJurnal($data, 'tb_jurnal');
            if ($this->db->affected_rows() > 0) {
                // $this->M_transaksi->sumLaba();
                $this->M_coa->sumLevel3();
                $this->session->set_flashdata('Success', 'Transaksi berhasil ditambahkan');
                redirect('Jurnal/Jurnal_entry/formJurnal');
            } else {
                redirect('Jurnal/Jurnal_entry/formJurnal');
            }
        }
    }
}
