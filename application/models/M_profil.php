<?php 
defined ('BASEPATH') or exit ('No direct script access allowed');

class M_profil extends CI_Model{
    
    public function getProfil(){
        return $this->db->get('tb_perusahaan');
    }

    public function getSetting(){
        return $this->db->get('tb_setting');
    }

    public function cekTable(){
        $this->db->select('*');
        $this->db->from('tb_perusahaan');
        $query = $this->db->get();
        return $query;
    }

    //Tabel Perusahaan
    public function setProfil($data,$table){
        $this->db->insert($table,$data);
    }

    // Tabel Setting
    public function setSetting($data,$table){
        $this->db->insert($table,$data);
    }

    public function updateProfil($where,$table,$data){
        $this->db->where($where);
        $this->db->update($data,$table);
    }

    public function updateSetting($where,$table,$data){
        $this->db->where($where);
        $this->db->update($data,$table);
    }
}
?>