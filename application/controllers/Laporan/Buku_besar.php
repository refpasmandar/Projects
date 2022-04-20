<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku_besar extends CI_Controller
{
    public function bukuBesar()
    {
        $data['profil']     = $this->M_profil->getProfil()->result();
        $data['coa']        = $this->M_coa->getCoaTrans()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data,);
        $this->load->view('v_admin/Laporan/Buku_besar/filter_bukubesar', $data);
        $this->load->view('template/footer');
    }

    function prosesfilterBukuBesar()
    {
        // $this->form_validation->set_rules('id_akun', 'Akun', 'required');
        $this->form_validation->set_rules('tanggal1jurnal', 'Awal Periode', 'required');
        $this->form_validation->set_rules('filterBukuBesar', 'Model Tampilan', 'required');
        $this->form_validation->set_rules('tanggal2jurnal', 'Akhir Periode', 'required');
        $this->form_validation->set_message('required', '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $data['profil']     = $this->M_profil->getProfil()->result();
            $data['coa']        = $this->M_coa->getCoaTrans()->result();

            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data,);
            $this->load->view('v_admin/Laporan/Buku_besar/filter_bukubesar', $data);
            $this->load->view('template/footer');
        } else {
            $radio = $this->input->post('filterBukuBesar');
            $tanggal1jurnal = $this->input->post('tanggal1jurnal');
            $tanggal2jurnal = $this->input->post('tanggal2jurnal');

            if ($radio == 2) {
                $id_akun = $this->input->post('id_akun');
                $data['profil']     = $this->M_profil->getProfil()->result();
                $data['coa']        = $this->M_coa->getCoaTrans()->result();
                $data['buku_besar'] = $this->M_laporan->filterBukuBesar($tanggal1jurnal, $tanggal2jurnal, $id_akun)->result();
                $data['saldoawal'] = $this->M_laporan->SaldoAwalBukuBesar($id_akun, $tanggal1jurnal)->result();
                $data['testing'] = $this->M_laporan->AwalBukuBesar($id_akun, $tanggal1jurnal);
                $data['tanggal1jurnal'] = $tanggal1jurnal;
                $data['tanggal2jurnal'] = $tanggal2jurnal;
                $data['id_akun'] = $id_akun;
                $data['radioChecked'] = $radio;
                $this->load->view('template/header');
                $this->load->view('template/sidebar', $data);
                $this->load->view('v_admin/Laporan/Buku_besar/buku_besar', $data);
                $this->load->view('template/footer');
            } else {
                $id_akun = $this->input->post('id_akun');
                $data['profil']     = $this->M_profil->getProfil()->result();
                $data['coa']        = $this->M_coa->getCoaTrans()->result();
                // $data['buku_besar'] = $this->M_laporan->closingBukuBesar($tanggal1, $tanggal2)->result();
                // $data['saldoawal'] = $this->M_laporan->SaldoAwalBukuBesar($id_akun)->result();
                // $data['testing'] = $this->M_laporan->AwalBukuBesar($id_akun);
                $data['tanggal1'] = $tanggal1jurnal;
                $data['tanggal2'] = $tanggal2jurnal;
                $data['radioChecked'] = $radio;
                $this->load->view('template/header');
                $this->load->view('template/sidebar', $data);
                $this->load->view('v_admin/Laporan/Buku_besar/buku_besarSemua', $data);
                $this->load->view('template/footer');
            }
        }
    }
}
