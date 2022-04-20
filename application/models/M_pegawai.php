<?php 
defined ('BASEPATH') or exit ('No direct script access allowed');

Class M_pegawai extends CI_Model{
    public function getPegawai(){
        return $this->db->get('tb_pegawai');
    }

    public function addPegawai($data,$table){
        return $this->db->insert($table,$data);
    }

    public function editPegawai($where){
        $this->db->from('tb_pegawai');
        $this->db->where($where);
        return $this->db->get();
    }

    public function updatePegawai($where,$table,$data){
        $this->db->where($where);
        $this->db->update($data,$table);
    }

    public function deletePegawai($where,$table){
        $this->db->where($where);
        $this->db->delete($table);
    }
}
?>