<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Riwayat_saldo extends CI_Controller
{
    function filterSaldo()
    {
        $data['profil'] = $this->M_profil->getProfil()->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Coa/saldo_awal_filter');
        $this->load->view('template/footer');
    }

    function prosesFilter()
    {
        $this->form_validation->set_rules('tanggal1', 'Tanggal Awal', 'required');
        $this->form_validation->set_rules('tanggal2', 'Tanggal Akhir', 'required');
        $this->form_validation->set_message('required', '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $data['profil'] = $this->M_profil->getProfil()->result();
            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Coa/saldo_awal_filter');
            $this->load->view('template/footer');
        } else {
            $tanggal1 = $this->input->post('tanggal1');
            $tanggal2 = $this->input->post('tanggal2');
            $data['saldo'] = $this->M_coa->filterSaldo($tanggal1, $tanggal2)->result();
            $data['periode'] = $this->M_coa->filterPeriode($tanggal1, $tanggal2)->result();
            $data['profil'] = $this->M_profil->getProfil()->result();
            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Coa/riwayat_saldo', $data);
            $this->load->view('template/footer');
        }
    }
}
