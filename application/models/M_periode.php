<?php 
defined ('BASEPATH') or exit('No Direct Script Access Allowed');

class M_periode extends CI_Model{
    public function getPeriode(){
        return $this->db->get('tb_periode');
    }

    public function addPeriode($data,$table){
        return $this->db->insert($table,$data);
    }

    public function editPeriode($where){
        $this->db->from('tb_periode');
        $this->db->where($where);
        return $this->db->get();
    }

    public function updatePeriode($where,$table,$data){
        $this->db->where($where);
        $this->db->update($data,$table);
    }

    public function deletePeriode($where,$table){
        $this->db->where($where);
        $this->db->delete($table);
    }
}
?>