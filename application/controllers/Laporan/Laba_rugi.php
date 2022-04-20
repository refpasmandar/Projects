<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laba_rugi extends CI_Controller
{
    public function filterLabaRugi()
    {
        $data['profil']     = $this->M_profil->getProfil()->result();
        $data['setting']    = $this->M_profil->getSetting()->result();


        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data,);
        $this->load->view('v_admin/Laporan/Laba_rugi/filter_labarugi', $data);
        $this->load->view('template/footer');
    }

    public function prosesLabaRugi()
    {

        $tanggal1labarugi = $this->input->post('tanggal1labarugi');
        $tanggal2labarugi = $this->input->post('tanggal2labarugi');

        $data['profil']     = $this->M_profil->getProfil()->result();
        $data['pendapatan'] = $this->M_laporan->getAkunPendapatan($tanggal1labarugi, $tanggal2labarugi)->result();
        $data['pengeluaran'] = $this->M_laporan->getAkunpengeluaran($tanggal1labarugi, $tanggal2labarugi)->result();
        $data['setting']    = $this->M_profil->getSetting()->result();
        $data['tanggal1labarugi'] = $tanggal1labarugi;
        $data['tanggal2labarugi'] = $tanggal2labarugi;

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Laporan/Laba_rugi/labaRugi', $data);
        $this->load->view('template/footer');
    }

    public function cetakLabaRugi()
    {
        $tanggal1labarugi = $this->input->post('tanggal1labarugi');
        $tanggal2labarugi = $this->input->post('tanggal2labarugi');

        $data['profil']     = $this->M_profil->getProfil()->result();
        $data['pendapatan'] = $this->M_laporan->getAkunPendapatan($tanggal1labarugi, $tanggal2labarugi)->result();
        $data['pengeluaran'] = $this->M_laporan->getAkunpengeluaran($tanggal1labarugi, $tanggal2labarugi)->result();
        $data['tanggal1labarugi'] = $tanggal1labarugi;
        $data['tanggal2labarugi'] = $tanggal2labarugi;
        $data['judul'] = "Laba Rugi";
        $this->pdf->generate('v_admin/Laporan/Laba_rugi/cetakLabaRugi', $data);
    }
}
