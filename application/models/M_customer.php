<?php 
defined ('BASEPATH') or exit ('No direct script access allowed');
class M_customer extends CI_Model{
    public function getCust(){
        return $this->db->get('tb_customer');
    }

    public function addCustomer($data,$table){
        return $this->db->insert($table,$data);
    }

    public function editCustomer($where,$table){
        return $this->db->get_where($table,$where);
    }

    public function updateCustomer($where,$table,$data){
        $this->db->where($where);
        $this->db->update($data,$table);
    }

    public function deleteCustomer($where,$table){
        $this->db->where($where);
        $this->db->delete($table);
    }
}
