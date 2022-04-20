<?php
defined('BASEPATH') or exit('no direct script access allowed');

class Saldo_awal extends CI_Controller
{
    function kondisiSaldo()
    {
        $query = $this->db->get('tb_saldo');
        if ($query->num_rows() > 0) {
            redirect('Pengaturan/Saldo_awal/kondisiMax');
        } else {
            redirect('Pengaturan/Saldo_awal/inputSaldoAwal');
        }
    }

    function kondisimax()
    {
        $query = $this->db->get('tb_jurnal');
        if ($query->num_rows() > 0) {
            redirect('Pengaturan/Saldo_awal/saldoLatest');
        } else {
            redirect('Pengaturan/Saldo_awal/updateSaldoAwal');
        }
    }

    function inputSaldoAwal()
    {
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['saldo']  = $this->M_coa->getSaldo()->result();
        $data['periode'] = $this->M_coa->getPeriodeSaldo()->result();
        $data['setting'] = $this->M_profil->getSetting()->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Coa/input_saldoawal', $data);
        $this->load->view('template/footer');
    }

    function prosesInputSaldoAwal()
    {
        $this->form_validation->set_rules('periode', 'Periode Saldo Awal', 'required');
        $this->form_validation->set_message('required', '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $data['profil'] = $this->M_profil->getProfil()->result();
            $data['saldo']  = $this->M_coa->getSaldo()->result();
            $data['periode'] = $this->M_coa->getPeriodeSaldo()->result();
            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Coa/input_saldoawal', $data);
            $this->load->view('template/footer');
        } else {
            $saldo = $this->input->post('saldo');
            $id_akun = $this->input->post('id_akun');
            $periode = $this->input->post('periode');

            $data = array();

            foreach ($id_akun as $id => $akun) {
                array_push($data, array(
                    'id_akun' => $akun,
                    'saldo' => $saldo[$id],
                    'periode' => $periode,
                ));
            }
            $this->db->update_batch('tb_akun', $data, 'id_akun');
            // $this->M_coa->inputSaldoAwal();
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('Success', 'Saldo Awal berhasil di Update');
                $this->M_coa->sumLevel3();
                $this->M_coa->salinSaldoAwal();
                redirect('Pengaturan/Saldo_awal/updateSaldoAwal');
            } else {
                $this->session->set_flashdata('Success', 'Saldo Awal gagal di Update');
                redirect('Pengaturan/Saldo_awal/inputSaldoAwal');
            }
        }
    }

    function updateSaldoAWal()
    {
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['saldo']  = $this->M_coa->getSaldoAwal()->result();
        $data['periode'] = $this->M_coa->getPeriodeSaldo()->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Coa/update_saldoawal', $data);
        $this->load->view('template/footer');
    }

    function prosesUpdateSaldoAwal()
    {
        $saldo = $this->input->post('saldo');
        $id_akun = $this->input->post('id_akun');

        $data          = array();

        foreach ($id_akun as $id => $akun) {
            array_push($data, array(
                'id_akun' => $akun,
                'saldo' => $saldo[$id],
            ));
        }

        // var_dump($data);

        // echo $data;

        // $where = array('id_akun' => $id_akun);

        $this->db->update_batch('tb_akun', $data, 'id_akun');
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('Success', 'Saldo Awal berhasil di Update');
            $this->M_coa->sumLevel3();
            $this->M_coa->matchingSaldo();
            redirect('Pengaturan/Saldo_awal/updateSaldoAwal');
        } else {
            $this->session->set_flashdata('Success', 'Saldo Awal gagal di Update');
            redirect('Pengaturan/Saldo_awal/updateSaldoAwal');
        }
    }

    public function saldoLatest()
    {
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['saldo']  = $this->M_coa->getSaldoAwalLatest()->result();
        $data['periode'] = $this->M_coa->getPeriodeSaldo()->result();

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Coa/saldoLatest', $data);
        $this->load->view('template/footer');
    }
}
