<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_dashboard extends CI_Model
{
    public function totalAkun()
    {
        $this->db->from('tb_akun');
        $this->db->where('level', '4');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }
    public function totalBarang()
    {
        $query = $this->db->get('tb_barang');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }
    public function totalCustomer()
    {
        $query = $this->db->get('tb_customer');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }
    public function totalSupplier()
    {
        $query = $this->db->get('tb_supplier');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }
}
