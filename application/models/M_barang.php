<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_barang extends CI_Model
{

    public function getData()
    {
        $this->db->from('tb_barang');
        $this->db->join('tb_satuanbeli', 'tb_satuanbeli.id_satuanbeli = tb_barang.id_satuanbeli', 'left');
        $this->db->join('tb_satuanjual', 'tb_satuanjual.id_satuanjual = tb_barang.id_satuanjual', 'left');
        $this->db->join('tb_supplier', 'tb_supplier.id_supplier = tb_barang.id_supplier', 'left');
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_barang.id_kategori');
        // $this->db->order_by('tb_barang.id_barang','asc');
        // $this->db->order_by('tb_kategori.kategori_barang','asc');
        return $this->db->get();
    }

    public function getDataBySupplier($kondisi)
    {
        $query = $this->db->query("SELECT * from tb_barang 
        join tb_satuanbeli on tb_satuanbeli.id_satuanbeli = tb_barang.id_satuanbeli
        where id_supplier= (SELECT DISTINCT id_supplier from tb_transaksibeli where kode_jurnal = '$kondisi')
        ");
        return $query;
    }

    public function getDataByCustomer($kondisi)
    {
        $query = $this->db->query("SELECT * from tb_barang 
        join tb_satuanbeli on tb_satuanbeli.id_satuanbeli = tb_barang.id_satuanbeli
        where id_supplier= (SELECT DISTINCT id_supplier from tb_transaksibeli where kode_jurnal = '$kondisi')
        ");
        return $query;
    }

    public function addBarang($data, $table)
    {
        return $this->db->insert($table, $data);
    }

    public function editBarang($where)
    {
        $this->db->from('tb_barang');
        $this->db->where($where);
        $this->db->join('tb_satuanbeli', 'tb_satuanbeli.id_satuanbeli = tb_barang.id_satuanbeli', 'left');
        $this->db->join('tb_satuanjual', 'tb_satuanjual.id_satuanjual = tb_barang.id_satuanjual', 'left');
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_barang.id_kategori');
        return $this->db->get();
    }

    public function updateBarang($where, $table, $data)
    {
        $this->db->where($where);
        $this->db->update($data, $table);
    }

    public function deleteBarang($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function getSatuanBeli()
    {
        return $this->db->get('tb_satuanbeli');
    }

    public function getSatuanJual()
    {
        $this->db->from('tb_satuanjual');
        $this->db->order_by('id_satuanjual', 'asc');
        return $this->db->get();
    }

    public function addSatuanBeli($data, $table)
    {
        return $this->db->insert($table, $data);
    }

    public function addSatuanJual()
    {
        $query = $this->db->query('INSERT IGNORE INTO tb_satuanjual (id_satuanjual,satuan_jual,simbol_satuanjual) SELECT * FROM tb_satuanbeli');
    }

    public function editSatuanBeli($where)
    {
        $this->db->from('tb_satuanbeli');
        $this->db->where($where);
        return $this->db->get();
    }

    // public function editSatuanJual($where){
    //     $this->db->from('tb_satuanjual');
    //     $this->db->where($where);
    //     return $this->db->get();
    // }

    public function updateSatuanBeli($where, $table, $data)
    {
        $this->db->where($where);
        $this->db->update($data, $table);
    }

    public function updateSatuanJual()
    {
        $query = $this->db->query('UPDATE tb_satuanjual INNER JOIN tb_satuanbeli
        ON tb_satuanjual.id_satuanjual = tb_satuanbeli.id_satuanbeli  
        SET tb_satuanjual.satuan_jual=tb_satuanbeli.satuan_beli,tb_satuanjual.simbol_satuanjual = tb_satuanbeli.simbol_satuanbeli');
        return $query;
    }

    public function deleteSatuanBeli($where2)
    {
        $query = $this->db->query("DELETE t1, t2
        FROM tb_satuanbeli t1 LEFT JOIN tb_satuanjual t2 ON t1.id_satuanbeli = t2.id_satuanjual 
        WHERE t1.id_satuanbeli = $where2");
        return $query;
    }

    // public function deleteSatuanJual($where2){

    // }

    public function getKategori()
    {
        return $this->db->get('tb_kategori');
    }

    public function addKategori($data, $table)
    {
        return $this->db->insert($table, $data);
    }

    public function editKategori($where)
    {
        $this->db->from('tb_kategori');
        $this->db->where($where);
        return $this->db->get();
    }

    public function updateKategori($where, $table, $data)
    {
        $this->db->where($where);
        $this->db->update($data, $table);
    }

    public function deleteKategori($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}
