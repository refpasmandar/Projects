<?php 
defined ('BASEPATH') or exit ('No direct script access allowed');
class M_supplier extends CI_Model{
    public function getSupplier(){
        return $this->db->get('tb_supplier');
    }

    public function addSupplier($data,$table){
        return $this->db->insert($table,$data);
    }

    public function editSupplier($where,$table){
        return $this->db->get_where($table,$where);
    }

    public function updateSupplier($where,$table,$data){
        $this->db->where($where);
        $this->db->update($data,$table);
    }

    public function deleteSupplier($where,$table){
        $this->db->where($where);
        $this->db->delete($table);
    }
}
