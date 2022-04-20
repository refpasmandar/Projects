<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{
    public function index(){
        check_not_login();
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['totalAkun'] = $this->M_dashboard->totalAkun();
        $data['totalBarang'] = $this->M_dashboard->totalBarang();
        $data['totalCustomer'] = $this->M_dashboard->totalCustomer();
        $data['totalSupplier'] = $this->M_dashboard->totalSupplier();
        $this->load->view('template/header.php');
        $this->load->view('template/sidebar.php',$data);
        $this->load->view('v_admin/dashboard.php');
        $this->load->view('template/footer.php');
        // $query = $this->M_profil->cekTable();
        // if($query->num_rows() == 0){
        //     $this->load->view('v_admin/Profil_Perusahaan/profil');
        // }else{
        //     $this->load->view('v_admin/dashboard.php');
        // }
        // $this->load->view('template/footer.php');
    }
}
?>