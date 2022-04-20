<?php 
defined ('BASEPATH') or exit('No Direct Script Access Allowed');

class Fungsi {

    protected $ci;

    public function __construct(){
        $this->ci =& get_instance();
    }

    function user_login() {
        $user_id = $this->ci->session->userdata('user_id');
        $user_data = $this->ci->M_login->tampilData($user_id)->row();
        return $user_data;
    }
    
}
?>