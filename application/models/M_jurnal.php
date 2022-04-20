<?php
defined('BASEPATH') or exit('No Direct Script Access Allowed');

class M_jurnal extends CI_Model
{
    public function addJurnal($data, $table)
    {
        return $this->db->insert_batch($table, $data);
    }

    public function getJurnalFilter($tgl1, $tgl2)
    {
        $this->db->from('tb_jurnal');
        $this->db->join('tb_akun', 'tb_akun.id_akun = tb_jurnal.id_akun', 'left');
        $this->db->where('tanggal_transaksi >=', $tgl1);
        $this->db->where('tanggal_transaksi <=', $tgl2);
        $this->db->order_by('tanggal_transaksi', 'asc');
        $this->db->order_by('id_jurnal', 'asc');
        return $this->db->get();
    }

    public function getData($where, $where2)
    {
        $this->db->distinct();
        $this->db->select('kode_jurnal,tanggal_transaksi,memo,jenis_transaksi');
        $this->db->from('tb_jurnal');
        $this->db->where($where);
        $this->db->where($where2);
        return $this->db->get();
    }

    public function getJurnalHeader($tgl1, $tgl2)
    {
        $this->db->distinct();
        $this->db->select('kode_jurnal,tanggal_transaksi,jenis_transaksi,status');
        $this->db->from('tb_jurnal');
        $this->db->where('tanggal_transaksi >=', $tgl1);
        $this->db->where('tanggal_transaksi <=', $tgl2);
        $this->db->order_by('tanggal_transaksi', 'asc');
        $this->db->order_by('id_jurnal', 'asc');
        return $this->db->get();
    }

    public function getEditJurnal($where, $where2)
    {
        $this->db->select('tb_jurnal.id_akun,tb_akun.kode_akun,tb_akun.no_akun,saldo_jurnal,posisi,id_jurnal');
        $this->db->from('tb_jurnal');
        $this->db->where($where);
        $this->db->where('tb_jurnal.jenis_transaksi', 'Jurnal');
        $this->db->where($where2);
        $this->db->join('tb_akun', 'tb_akun.id_akun = tb_jurnal.id_akun', 'left');
        return $this->db->get();
    }

    public function deleteJurnal($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function getIDJurnal($where, $where2)
    {
        $this->db->from('tb_jurnal');
        $this->db->where($where);
        $this->db->where($where2);
        return $this->db->get();
    }
}
