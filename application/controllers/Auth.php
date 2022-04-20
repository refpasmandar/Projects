<?php
defined('BASEPATH') or exit('No Direct Script Allowed Access');

class Auth extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0', FALSE);
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    public function login()
    {
        check_already_login();
        $this->load->view('v_login');
    }

    public function processlogin()
    {

        $this->form_validation->set_rules('username', 'Nama Pengguna', 'required');
        $this->form_validation->set_rules('password', 'Kata Sandi', 'required');

        $this->form_validation->set_message('required', '%s tidak boleh kosong, mohon diisi');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('v_login');
        } else {
            $post = $this->input->post(null, true);
            if (isset($post['login'])) {
                $query = $this->M_login->login($post);
                if ($query->num_rows() > 0) {
                    $row = $query->row();
                    $params = array(
                        'user_id'   => $row->id_user,
                        // 'level'     => $row->role_id
                    );
                    $this->session->set_userdata($params);
                    redirect('Pengaturan/Perusahaan/kondisi');
                } else {
                    $this->session->set_flashdata(
                        'pesan',
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Username atau Password Anda Salah!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>'
                    );
                    redirect('auth/login');
                }
            }
        }
    }

    public function logout()
    {
        $params = array(
            'user_id', 'level'
        );
        $this->session->unset_userdata($params);
        $this->session->sess_destroy();
        redirect('auth/login', 'refresh');
    }
}
