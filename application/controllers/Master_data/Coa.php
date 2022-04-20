<?php
defined('BASEPATH') or exit('No Direct Script Access Allowed');

class Coa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // check_admin();
        check_not_login();
    }

    // Menampilkan halaman COA
    public function account()
    {
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['coa'] = $this->M_coa->getCoa()->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Coa/coa', $data);
        $this->load->view('template/footer');
    }

    // Menampilkan form tambah COA
    public function tambahAkun()
    {
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['coa'] = $this->M_coa->getCoa()->result();
        $data['header'] = $this->M_coa->getCoaHeader()->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Coa/tambah_coa', $data);
        $this->load->view('template/footer');
    }

    // Proses input COA 
    public function prosesTambah()
    {
        $this->form_validation->set_rules('no_akun', 'Nomor Akun', 'required|callback_checkNoAkunAdd|max_length[6]|min_length[2]');
        $this->form_validation->set_rules('nama_akun', 'Nama Akun', 'required|is_unique[tb_akun.nama_akun]|max_length[35]');
        $this->form_validation->set_rules('keterangan', 'Keterangan Akun', 'required');
        $this->form_validation->set_rules('kategori_akun', 'Kategori Akun', 'required');
        $this->form_validation->set_rules('level', 'Level Akun', 'required');
        $this->form_validation->set_rules('parent_id', 'Parent Akun', 'required');
        $this->form_validation->set_rules('jenis_akun', 'Jenis Akun', 'required');
        $this->form_validation->set_rules('saldo_normal', 'Saldo Normal Akun', 'required');

        $this->form_validation->set_message('required', '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_message('is_unique', '%s Sudah Ada');
        $this->form_validation->set_message('max_length', '%s Maksimal %d Karakter');
        $this->form_validation->set_message('min_length', '%s Minimal %d Karakter');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $data['profil'] = $this->M_profil->getProfil()->result();
            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Coa/tambah_coa');
            $this->load->view('template/footer');
        } else {
            $no_akun = $this->input->post('no_akun');
            $kode_akun = $this->input->post('kode_akun');
            $nama_akun = $this->input->post('nama_akun');
            $keterangan = $this->input->post('keterangan');
            $kategori_akun = $this->input->post('kategori_akun');
            $level = $this->input->post('level');
            $parent_id = $this->input->post('parent_id');
            $jenis_akun = $this->input->post('jenis_akun');
            $saldo_normal = $this->input->post('saldo_normal');

            $data = array(
                'no_akun'           => $no_akun,
                'kode_akun'         => $kode_akun,
                'nama_akun'         => $nama_akun,
                'keterangan_akun'   => $keterangan,
                'kategori_akun'     => $kategori_akun,
                'level'             => $level,
                'parent_id'         => $parent_id,
                'saldo_normal'      => $saldo_normal,
                'jenis_akun'        => $jenis_akun
            );

            $this->M_coa->addData($data, 'tb_akun');
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('Success', 'Akun berhasil ditambahkan');
                redirect('Master_data/coa/account');
            } else {
                redirect('Master_data/coa/account');
            }
        }
    }

    public function getHeaderAkun()
    {
        $id = $this->input->post('id');
        $data = $this->M_coa->getHeaderAkun($id);
        echo json_encode($data);
    }

    public function editAkun($id)
    {
        $where = array('id_akun' => $id);
        $kondisi = $id;
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['coa'] = $this->M_coa->editData($where, 'tb_akun')->result();
        $data['header'] = $this->M_coa->getHeaderById($id)->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Coa/edit_coa', $data);
        $this->load->view('template/footer');
    }

    public function prosesEdit()
    {
        $this->form_validation->set_rules('no_akun', 'Nomor Akun', 'required|callback_checkNoAkun|max_length[6]|min_length[2]');
        $this->form_validation->set_rules('nama_akun', 'Nama Akun', 'required|callback_checkNamaAkun|max_length[35]');
        $this->form_validation->set_rules('keterangan', 'Keterangan Akun', 'required');
        $this->form_validation->set_rules('kategori_akun', 'Kategori Akun', 'required');
        $this->form_validation->set_rules('level', 'Level Akun', 'required');
        $this->form_validation->set_rules('parent_id', 'Parent Akun', 'required');
        $this->form_validation->set_rules('jenis_akun', 'Jenis Akun', 'required');
        $this->form_validation->set_rules('saldo_normal', 'Saldo Normal Akun', 'required');

        $this->form_validation->set_message('required', '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_message('is_unique', '%s Sudah Ada');
        $this->form_validation->set_message('max_length', '%s Maksimal %d Karakter');
        $this->form_validation->set_message('min_length', '%s Minimal %d Karakter');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $id = $this->input->post('id_akun');
            $where = array('id_akun' => $id);
            $data['profil'] = $this->M_profil->getProfil()->result();
            $data['coa'] = $this->M_coa->editData($where, 'tb_akun')->result();
            $data['header'] = $this->M_coa->getCoaHeader()->result();
            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Coa/edit_coa', $data);
            $this->load->view('template/footer');
        } else {
            $id = $this->input->post('id_akun');
            $no_akun = $this->input->post('no_akun');
            $kode_akun = $this->input->post('kode_akun');
            $nama_akun = $this->input->post('nama_akun');
            $keterangan = $this->input->post('keterangan');
            $kategori_akun = $this->input->post('kategori_akun');
            $level = $this->input->post('level');
            $parent_id = $this->input->post('parent_id');
            $jenis_akun = $this->input->post('jenis_akun');
            $saldo_normal = $this->input->post('saldo_normal');

            $data = array(
                'no_akun'           => $no_akun,
                'kode_akun'         => $kode_akun,
                'nama_akun'         => $nama_akun,
                'keterangan_akun'   => $keterangan,
                'kategori_akun'     => $kategori_akun,
                'level'             => $level,
                'parent_id'         => $parent_id,
                'saldo_normal'      => $saldo_normal,
                'jenis_akun'        => $jenis_akun
            );

            $where = array('id_akun' => $id);

            $this->M_coa->updateData($where, $data, 'tb_akun');
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('Success', 'Data Akun Berhasil Diubah');
                redirect('Master_data/Coa/account');
            } else {
                redirect('Master_data/Coa/account');
            }
        }
    }

    public function deleteAkun($id)
    {
        $where = array('id_akun' => $id);
        $this->M_coa->deleteData($where, 'tb_akun');
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('Success', 'Data Akun Berhasil Dihapus');
            redirect('Master_data/Coa/account');
        } else {
            redirect('Master_data/Coa/account');
        }
    }

    function checkNoAkun()
    {
        $post = $this->input->post(null, true);
        $query = $this->db->query("select * from tb_akun where no_akun = '$post[no_akun]' AND kode_akun = '$post[kode_akun]' AND id_akun != '$post[id_akun]'");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('checkNoAkun', '%s ini sudah dipakai');
            return false;
        } else {
            return true;
        }
    }

    function checkNoAkunAdd()
    {
        $post = $this->input->post(null, true);
        $query = $this->db->query("select * from tb_akun where no_akun = '$post[no_akun]' AND kode_akun = '$post[kode_akun]'");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('checkNoAkunAdd', '%s ini sudah dipakai');
            return false;
        } else {
            return true;
        }
    }

    function checkNamaAkun()
    {
        $post = $this->input->post(null, true);
        $query = $this->db->query("select * from tb_akun where nama_akun = '$post[nama_akun]' AND id_akun != '$post[id_akun]'");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('checkNamaAkun', '%s ini sudah dipakai');
            return false;
        } else {
            return true;
        }
    }
}
