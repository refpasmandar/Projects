<?php 
defined ('BASEPATH') or exit ('No Direct Script Access Allowed');

class Pegawai extends CI_Controller{
    function __construct(){
        parent::__construct();
        // check_admin();
        check_not_login();
    }

    public function daftarPegawai(){
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['pegawai'] = $this->M_pegawai->getPegawai()->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar',$data);
        $this->load->view('v_admin/Pegawai/v_pegawai',$data);
        $this->load->view('template/footer');
    }

    public function tambahPegawai(){
        $data['profil'] = $this->M_profil->getProfil()->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar',$data);
        $this->load->view('v_admin/Pegawai/tambah_pegawai');
        $this->load->view('template/footer');
    }

    public function prosesTambah(){
        $this->form_validation->set_rules('nama_pegawai','Nama Pegawai','required|is_unique[tb_pegawai.nama_pegawai]');
        $this->form_validation->set_rules('alamat_pegawai','Alamat Pegawai','required');
        $this->form_validation->set_rules('no_telp','Nomor Telepon','required|min_length[12]');
        $this->form_validation->set_message('required' , '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_message('is_unique' , '%s Sudah Ada!');
        $this->form_validation->set_message('min_length','%s Minimal 12 Angka!');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if($this->form_validation->run() == FALSE){
            $data['profil'] = $this->M_profil->getProfil()->result();
            $this->load->view('template/header');
            $this->load->view('template/sidebar',$data);
            $this->load->view('v_admin/Pegawai/tambah_pegawai');
            $this->load->view('template/footer');
        }else{
            $nama_pegawai   = $this->input->post('nama_pegawai');
            $alamat_pegawai  = $this->input->post('alamat_pegawai');
            $no_telp        = $this->input->post('no_telp');

            $data = array(
                'nama_pegawai'      => $nama_pegawai,
                'alamat_pegawai'    => $alamat_pegawai,
                'no_telp'           => $no_telp
            );

            $this->M_pegawai->addPegawai($data,'tb_pegawai');
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('Success', ' Pegawai berhasil ditambahkan');
                redirect('Master_data/Pegawai/daftarPegawai');
            }else{
                redirect('Master_data/Pegawai/daftarPegawai');
            }
        }
    }

    public function editPegawai($id_pegawai){
        $where = array('id_pegawai' => $id_pegawai);
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['pegawai'] = $this->M_pegawai->editPegawai($where)->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar',$data);
        $this->load->view('v_admin/Pegawai/edit_pegawai',$data);
        $this->load->view('template/footer');
    }

    public function prosesEdit(){
        $this->form_validation->set_rules('nama_pegawai','Nama Pegawai','required');
        $this->form_validation->set_rules('alamat_pegawai','Alamat Pegawai','required');
        $this->form_validation->set_rules('no_telp','Nomor Telepon','required|min_length[12]');
        $this->form_validation->set_message('required' , '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_message('min_length','%s Minimal 12 Angka!');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if($this->form_validation->run() == FALSE){
            $id_pegawai = $this->input->post('id_pegawai');
            $where = array('id_pegawai' => $id_pegawai);
            $data['profil'] = $this->M_profil->getProfil()->result();
            $data['pegawai'] = $this->M_pegawai->editPegawai($where)->result();
            $this->load->view('template/header');
            $this->load->view('template/sidebar',$data);
            $this->load->view('v_admin/Pegawai/edit_pegawai',$data);
            $this->load->view('template/footer');
        }else{
            $id_pegawai     = $this->input->post('id_pegawai');
            $nama_pegawai   = $this->input->post('nama_pegawai');
            $alamat_pegawai = $this->input->post('alamat_pegawai');
            $no_telp        = $this->input->post('no_telp');

            $data = array(
                'id_pegawai'        => $id_pegawai,
                'nama_pegawai'      => $nama_pegawai,
                'alamat_pegawai'    => $alamat_pegawai,
                'no_telp'           => $no_telp
            );

            $where = array('id_pegawai' => $id_pegawai);

            $this->M_pegawai->updatePegawai($where,$data,'tb_pegawai');
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('Success', ' Pegawai berhasil Diubah');
                redirect('Master_data/Pegawai/daftarPegawai');
            }else{
                redirect('Master_data/Pegawai/daftarPegawai');
            }
        }
    }

    public function deletePegawai($id_pegawai){
        $where = array('id_pegawai' => $id_pegawai);
        $this->M_pegawai->deletePegawai($where,'tb_pegawai');
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('Success','Data Pegawai Berhasil Dihapus');
            redirect('Master_data/Pegawai/daftarPegawai');
        }else{
            redirect('Master_data/Pegawai/daftarPegawai');
        }
    }
}
