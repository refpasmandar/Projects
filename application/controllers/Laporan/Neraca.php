<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Neraca extends CI_Controller
{
    public function filterNeraca()
    {
        $data['profil']     = $this->M_profil->getProfil()->result();
        $data['setting'] = $this->M_profil->getSetting()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data,);
        $this->load->view('v_admin/Laporan/Neraca/filter_neraca', $data);
        $this->load->view('template/footer');
    }

    function prosesFilterNeraca()
    {
        $this->form_validation->set_rules('tanggal1neraca', 'Awal Periode', 'required');
        $this->form_validation->set_rules('tanggal2neraca', 'Akhir Periode', 'required');
        $this->form_validation->set_message('required', '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $data['profil']     = $this->M_profil->getProfil()->result();
            $data['setting']    = $this->M_profil->getSetting()->result();

            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data,);
            $this->load->view('v_admin/Laporan/Neraca/filter_neraca', $data);
            $this->load->view('template/footer');
        } else {
            $tanggal1neraca = $this->input->post('tanggal1neraca');
            $tanggal2neraca = $this->input->post('tanggal2neraca');
            $tanggalAwal = date('Y-m-01', strtotime($tanggal2neraca));
            $id_akun = $this->input->post('id_akun');

            $data['profil']     = $this->M_profil->getProfil()->result();
            $data['neraca_aktiva'] = $this->M_laporan->getAkunNeracaAktiva($tanggal1neraca, $tanggal2neraca, $tanggalAwal)->result();
            $data['neraca_pasiva'] = $this->M_laporan->getAkunNeracaPasiva($tanggal1neraca, $tanggal2neraca, $tanggalAwal)->result();
            $data['tanggal1neraca'] = $tanggal1neraca;
            $data['tanggal2neraca'] = $tanggal2neraca;
            $data['pendapatan'] = $this->db->query("SELECT sum(saldo_jurnal) as pendapatan from tb_jurnal a
                                        join tb_akun b on a.id_akun = b.id_akun
                                        where (a.tanggal_transaksi >= '$tanggalAwal' and b.kode_akun = '4') and (a.tanggal_transaksi <= '$tanggal2neraca' and b.kode_akun = '4')")->row_array();
            $data['pengeluaran'] = $this->db->query("SELECT sum(saldo_jurnal) as pengeluaran from tb_jurnal a
                                        join tb_akun b on a.id_akun = b.id_akun
                                        where (a.tanggal_transaksi >= '$tanggalAwal' and (b.kode_akun = '5' or b.kode_akun ='6')) and (a.tanggal_transaksi <= '$tanggal2neraca' and (b.kode_akun = '5' or b.kode_akun ='6'))")->row_array();
            $data['setting'] = $this->M_profil->getSetting()->result();
            $data['id_akun'] = $id_akun;

            // var_dump($tanggalAwal);

            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Laporan/Neraca/Neraca_2', $data);
            $this->load->view('template/footer');
        }
    }
    public function cetakNeraca()
    {
        $tanggal1neraca  = $this->input->get('tanggal1neraca');
        $tanggal2neraca  = $this->input->get('tanggal2neraca');
        $tanggalAwal = date('Y-m-01', strtotime($tanggal2neraca));

        $data['profil']     = $this->M_profil->getProfil()->result();
        $data['neraca_aktiva'] = $this->M_laporan->getAkunNeracaAktiva($tanggal1neraca, $tanggal2neraca, $tanggalAwal)->result();
        $data['neraca_pasiva'] = $this->M_laporan->getAkunNeracaPasiva($tanggal1neraca, $tanggal2neraca, $tanggalAwal)->result();
        $data['pendapatan'] = $this->db->query("SELECT sum(saldo_jurnal) as pendapatan from tb_jurnal a
                                        join tb_akun b on a.id_akun = b.id_akun
                                        where (a.tanggal_transaksi >= '$tanggalAwal' and b.kode_akun = '4') and (a.tanggal_transaksi <= '$tanggal2neraca' and b.kode_akun = '4')")->row_array();
        $data['pengeluaran'] = $this->db->query("SELECT sum(saldo_jurnal) as pengeluaran from tb_jurnal a
                                        join tb_akun b on a.id_akun = b.id_akun
                                        where (a.tanggal_transaksi >= '$tanggalAwal' and (b.kode_akun = '5' or b.kode_akun ='6')) and (a.tanggal_transaksi <= '$tanggal2neraca' and (b.kode_akun = '5' or b.kode_akun ='6'))")->row_array();
        $data['tanggal1neraca'] = $tanggal1neraca;
        $data['tanggal2neraca'] = $tanggal2neraca;
        $data['judul'] = "Neraca";
        $this->pdf->generate('v_admin/Laporan/Neraca/cetakNeraca', $data);
    }
}
