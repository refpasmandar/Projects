<?php 
defined ('BASEPATH') or exit('No Direct Script Access Allowed');

class Periode extends CI_Controller{
    function __construct(){
        parent::__construct();
        // check_admin();
        check_not_login();
    }

    public function daftarPeriode(){
        $data['periode'] = $this->M_periode->getPeriode()->result();
        $data['profil'] = $this->M_profil->getProfil()->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar',$data);
        $this->load->view('v_admin/Periode/v_periode',$data);
        $this->load->view('template/footer');
    }

    public function tambahPeriode(){
        $this->form_validation->set_rules('periode','Periode','required|is_unique[tb_periode.periode]');
        $this->form_validation->set_rules('keterangan_periode','Keterangan Periode','required');
        $this->form_validation->set_message('required' , '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_message('is_unique','%s Sudah Ada!');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if($this->form_validation->run() == FALSE){
            $data['profil'] = $this->M_profil->getProfil()->result();
            $data['periode'] = $this->M_periode->getPeriode()->result();
            $this->load->view('template/header');
            $this->load->view('template/sidebar',$data);
            $this->load->view('v_admin/Periode/v_periode',$data);
            $this->load->view('template/footer');
        }else{
            $periode            = $this->input->post('periode');
            $keterangan_periode = $this->input->post('keterangan_periode');

            $data = array(
                'periode'               => $periode,
                'keterangan_periode'    => $keterangan_periode
            );

            $this->M_periode->addPeriode($data,'tb_periode');
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('Success', 'Periode Transaksi Berhasil Ditambahkan');
                redirect('Master_data/Periode/daftarPeriode');
            }else{
                redirect('Master_data/Periode/daftarPeriode');
            }
        }
    }

    public function editPeriode($id_periode){
        $where = array('id_periode' => $id_periode);
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['periode'] = $this->M_periode->editPeriode($where)->result();
            $this->load->view('template/header');
            $this->load->view('template/sidebar',$data);
            $this->load->view('v_admin/Periode/edit_periode',$data);
            $this->load->view('template/footer');
    }

    public function prosesEdit(){
        $this->form_validation->set_rules('periode','Periode','required');
        $this->form_validation->set_rules('keterangan_periode','Keterangan Periode','required');
        $this->form_validation->set_message('required' , '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if($this->form_validation->run() == FALSE){
        $id_periode = $this->input->post('id_periode');
        $where = array('id_periode' => $id_periode);
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['periode'] = $this->M_periode->editPeriode($where)->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar',$data);
        $this->load->view('v_admin/Periode/edit_periode',$data);
        $this->load->view('template/footer');
        }else{
            $id_periode         = $this->input->post('id_periode');
            $periode            = $this->input->post('periode');
            $keterangan_periode = $this->input->post('keterangan_periode');

            $data = array(
                'periode'               => $periode,
                'keterangan_periode'    => $keterangan_periode
            );

            $where  = array('id_periode' => $id_periode);

            $this->M_periode->updatePeriode($where,$data,'tb_periode');
            if($this->db->affected_rows() > 0 ){
                $this->session->set_flashdata('Success', 'Periode Transaksi Berhasil Diubah');
                redirect('Master_data/Periode/daftarPeriode');
            }else{
                redirect('Master_data/Periode/daftarPeriode');
            }
        }
    }

    public function deletePeriode($id_periode){
        $where = array('id_periode' => $id_periode);
        $this->M_periode->deletePeriode($where,'tb_periode');
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('Success', 'Periode Transaski Berhasil Dihapus');
            redirect('Master_data/Periode/daftarPeriode');
        }else{
            redirect('Master_data/Periode/daftarPeriode');
        }
    }
}
