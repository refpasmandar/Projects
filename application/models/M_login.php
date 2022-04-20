<?php 
defined ('BASEPATH') or exit ('No Direct Script Access Allowed');

class M_login extends CI_Model{


    public function login($post){
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where('username', $post['username']);
        $this->db->where('password', sha1($post['password']));
        $query = $this->db->get();
        return $query;
    }

    public function tampilData($id = null){
        $this->db->select('*');
        $this->db->from('tb_user');
        if($id != null){
            $this->db->where('id_user', $id);
        }
        $query = $this->db->get();
        return $query;
    }

}

?>