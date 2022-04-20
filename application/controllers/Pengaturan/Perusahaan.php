<?php
defined('BASEPATH') or exit('no direct script access allowed');

class Perusahaan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        // check_admin();
        check_not_login();
    }

    function kondisi()
    {
        $query = $this->db->get('tb_perusahaan');
        if ($query->num_rows() > 0) {
            redirect('Dashboard');
        } else {
            redirect('Pengaturan/Perusahaan/formInputProfil');
        }
    }

    public function formInputProfil()
    {
        $data['profil'] = $this->M_profil->getProfil()->result();
        $this->load->view('template/header');
        // $this->load->view('template/sidebar',$data);
        $this->load->view('template/topbar', $data);
        $this->load->view('v_admin/Profil_Perusahaan/profil');
        $this->load->view('template/footer');
    }

    public function setProfil()
    {
        $this->form_validation->set_rules('tanggal_pembukuan', 'Tanggal Awal Pembukuan', 'required');
        $this->form_validation->set_rules('kode_transaksi', 'Kode Transaksi', 'required');
        $this->form_validation->set_rules('kode_entry', 'Kode Jurnal Entry', 'required');
        $this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'required|max_length[30]');
        $this->form_validation->set_rules('alamat', 'Alamat Perusahaan', 'required|max_length[60]');
        $this->form_validation->set_rules('kota', 'Kota', 'required|max_length[20]');
        $this->form_validation->set_rules('provinsi', 'Provinsi', 'required|max_length[20]');
        $this->form_validation->set_rules('kode_pos', 'Kode Pos', 'required|max_length[6]');
        $this->form_validation->set_rules('no_telp_1', 'Nomor Telepon Perusahaan', 'required|max_length[13]');
        $this->form_validation->set_rules('email', 'Email Perusahaan', 'required|max_length[30]');

        $this->form_validation->set_message('required', '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_message('max_length', '%s Maksimal %d Karakter');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $data['profil'] = $this->M_profil->getProfil()->result();
            $this->load->view('template/header');
            // $this->load->view('template/sidebar',$data);
            $this->load->view('template/topbar', $data);
            $this->load->view('v_admin/Profil_Perusahaan/profil');
            $this->load->view('template/footer');
        } else {
            // Tabel Setting
            $tanggal_pembukuan = $this->input->post('tanggal_pembukuan');
            $kode_transaksi = $this->input->post('kode_transaksi');
            $kode_entry = $this->input->post('kode_entry');

            // Tabel Perusahaan
            $nama_perusahaan = $this->input->post('nama_perusahaan');
            $alamat = $this->input->post('alamat');
            $kota = $this->input->post('kota');
            $provinsi = $this->input->post('provinsi');
            $kode_pos = $this->input->post('kode_pos');
            $no_telp_1  = $this->input->post('no_telp_1');
            $no_telp_2  = $this->input->post('no_telp_2');
            $email = $this->input->post('email');
            $logo = $_FILES['logo']['name'];
            if ($logo = '') {
            } else {
                $config['upload_path'] = './uploads';
                $config['allowed_types'] = 'jpg|jepg|png|gif';
                $config['overwrite'] = true;

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('logo')) {
                    echo "Gagal Untuk Mengupload Gambar";
                } else {
                    $logo = $this->upload->data('file_name');
                }
            }

            $data = array(
                'nama_perusahaan'   => $nama_perusahaan,
                'alamat_perusahaan' => $alamat,
                'kota'              => $kota,
                'provinsi'          => $provinsi,
                'kode_pos'          => $kode_pos,
                'telp_perusahaan1'  => $no_telp_1,
                'telp_perusahaan2'  => $no_telp_2,
                'email_perusahaan'  => $email,
                'logo'              => $logo
            );

            $data2 = array(
                'tanggal_pembukuan' => $tanggal_pembukuan,
                'kode_transaksi'    => $kode_transaksi,
                'kode_entry'        => $kode_entry
            );

            $this->M_profil->setProfil($data, 'tb_perusahaan');
            $this->M_profil->setSetting($data2, 'tb_setting');
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('Success', 'Profil Perusahaan Berhasil Di Setting');
                redirect('Dashboard');
            } else {
                redirect('Pengaturan/Perusahaan/formProfil');
            }
        }
    }

    public function formProfil()
    {
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['setting'] = $this->M_profil->getSetting()->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Profil_Perusahaan/edit_profil', $data);
        $this->load->view('template/footer');
    }

    public function updateProfil()
    {
        $this->form_validation->set_rules('tanggal_pembukuan', 'Tanggal Awal Pembukuan', 'required');
        $this->form_validation->set_rules('kode_transaksi', 'Kode Transaksi', 'required');
        $this->form_validation->set_rules('kode_entry', 'Kode Jurnal Entry', 'required');
        $this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'required|max_length[30]');
        $this->form_validation->set_rules('alamat', 'Alamat Perusahaan', 'required|max_length[60]');
        $this->form_validation->set_rules('kota', 'Kota', 'required|max_length[20]');
        $this->form_validation->set_rules('provinsi', 'Provinsi', 'required|max_length[20]');
        $this->form_validation->set_rules('kode_pos', 'Kode Pos', 'required|max_length[10]');
        $this->form_validation->set_rules('no_telp_1', 'Nomor Telepon Perusahaan', 'required|max_length[13]');
        $this->form_validation->set_rules('email', 'Email Perusahaan', 'required|max_length[25]');

        $this->form_validation->set_message('required', '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_message('max_length', '%s Maksimal %d Karakter');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $data['profil'] = $this->M_profil->getProfil()->result();
            $data['setting'] = $this->M_profil->getSetting()->result();
            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Profil_Perusahaan/edit_profil', $data);
            $this->load->view('template/footer');
        } else {
            // Tabel Setting
            $id_setting = $this->input->post('id_setting');
            $tanggal_pembukuan = $this->input->post('tanggal_pembukuan');
            $kode_transaksi = $this->input->post('kode_transaksi');
            $kode_entry = $this->input->post('kode_entry');

            // Tabel Perusahaan
            $id_perusahaan = $this->input->post('id_perusahaan');
            $nama_perusahaan = $this->input->post('nama_perusahaan');
            $alamat = $this->input->post('alamat');
            $kota = $this->input->post('kota');
            $provinsi = $this->input->post('provinsi');
            $kode_pos = $this->input->post('kode_pos');
            $no_telp_1  = $this->input->post('no_telp_1');
            $no_telp_2  = $this->input->post('no_telp_2');
            $email = $this->input->post('email');

            if ($_FILES['logo']['name'] != '') {
                $config['upload_path'] = './uploads';
                $config['allowed_types'] = 'jpg|jepg|png|gif';
                $config['overwrite'] = true;

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('logo')) {
                    echo "Gagal Untuk Mengupload Gambar";
                } else {
                    $logo = $this->upload->data('file_name');
                }
            } else {
                $logo = $this->input->post('old_image');
            }

            $data = array(
                'nama_perusahaan'   => $nama_perusahaan,
                'alamat_perusahaan' => $alamat,
                'kota'              => $kota,
                'provinsi'          => $provinsi,
                'kode_pos'          => $kode_pos,
                'telp_perusahaan1'  => $no_telp_1,
                'telp_perusahaan2'  => $no_telp_2,
                'email_perusahaan'  => $email,
                'logo'              => $logo
            );

            $data2 = array(
                'tanggal_pembukuan' => $tanggal_pembukuan,
                'kode_transaksi'    => $kode_transaksi,
                'kode_entry'        => $kode_entry
            );

            $where = array('id_perusahaan' => $id_perusahaan);
            $where2 = array('id_setting' => $id_setting);

            $this->M_profil->updateProfil($where, $data, 'tb_perusahaan');
            $this->M_profil->updateSetting($where2, $data2, 'tb_setting');
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('Success', 'Profil Perusahaan Berhasil Di Setting');
                redirect('Pengaturan/Perusahaan/formProfil');
            } else {
                redirect('Pengaturan/Perusahaan/formProfil');
            }
        }
    }
}
