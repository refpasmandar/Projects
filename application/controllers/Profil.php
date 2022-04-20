<?php
defined('BASEPATH') or exit('No Direct Script Access Allowed');

class Profil extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // check_admin();
        check_not_login();
    }

    public function profilPengguna()
    {
        $id = $this->session->userdata('user_id');
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['profilPengguna'] = $this->M_akun->getProfilPengguna($id)->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/profilPengguna');
        $this->load->view('template/footer');
    }

    public function prosesEditProfil()
    {
        $this->form_validation->set_rules('username', 'Nama Pengguna', 'required|min_length[8]|max_length[20]|callback_usernameCheck');
        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'Kata Sandi', 'min_length[8]|max_length[25]');
            $this->form_validation->set_rules('passconf', 'Konfirmasi Kata Sandi', 'matches[password]');
        }

        if ($this->input->post('passconf')) {
            $this->form_validation->set_rules('passconf', 'Konfirmasi Kata Sandi', 'matches[password]');
        }

        $this->form_validation->set_rules('nama_pengguna', 'Nama Lengkap Pengguna', 'required|max_length[25]');
        $this->form_validation->set_rules('no_telp', 'Nomor Telepon Pengguna', 'required|max_length[15]');
        $this->form_validation->set_rules('alamat', 'Alamat Pengguna', 'required|max_length[60]');

        $this->form_validation->set_message('required', '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_message('min_length', '%s Minimal %d Karakter');
        $this->form_validation->set_message('max_length', '%s Minimal %d Karakter');
        $this->form_validation->set_message('matches', '%s Tidak Sesuai Dengan Kata Sandi');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $id = $this->session->userdata('user_id');
            $data['profil'] = $this->M_profil->getProfil()->result();
            $data['profilPengguna'] = $this->M_akun->getProfilPengguna($id)->result();
            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/profilPengguna');
            $this->load->view('template/footer');
        } else {

            $post = $this->input->post(null, true);

            $this->M_akun->updateProfilPengguna($post);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('Success', 'Profil Pengguna Berhasil Diubah');
                redirect('Profil/profilPengguna');
            } else {
                $this->session->set_flashdata('Success', 'Profil Pengguna Gagal Diubah');
                redirect('Profil/profilPengguna');
            }
        }
    }

    function usernameCheck()
    {
        $post = $this->input->post(null, true);
        $query = $this->db->query("select * from tb_user where username = '$post[username]' AND id_user != '$post[id_user]'");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('usernameCheck', '%s ini sudah dipakai');
            return false;
        } else {
            return true;
        }
    }
}
