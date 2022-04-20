<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_laporan extends CI_Model
{
    public function getJurnalByPeriode($where)
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where($where);
        $this->db->join('tb_akun', 'tb_akun.id_akun = tb_transaksi.id_akun');
        return $this->db->get();
    }

    public function getJurnalJoin()
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->join('tb_barang', 'tb_barang.id_barang = tb_transaksi.id_barang');
        $this->db->join('tb_periode', 'tb_periode.id_periode = tb_transaksi.id_periode');
        $this->db->join('tb_akun', 'tb_akun.id_akun = tb_transaksi.id_akun');
        $this->db->join('tb_pegawai', 'tb_pegawai.id_pegawai = tb_transaksi.id_pegawai');
        return $this->db->get();
    }

    public function getJurnalPeriodeTitle($where)
    {
        $this->db->select('*');
        $this->db->where($where);
        $this->db->from('tb_periode');
        return $this->db->get()->row();
    }

    public function getEditTransaksi($where)
    {
        $this->db->from('tb_transaksi');
        $this->db->where($where);
        $this->db->join('tb_periode', 'tb_periode.id_periode = tb_transaksi.id_periode');
        $this->db->join('tb_akun', 'tb_akun.id_akun = tb_transaksi.id_akun');
        $this->db->join('tb_barang', 'tb_barang.id_barang = tb_transaksi.id_barang', 'left');
        $this->db->join('tb_pegawai', 'tb_pegawai.id_pegawai = tb_transaksi.id_pegawai', 'left');
        return $this->db->get();
    }

    public function getJurnalPeriode()
    {
        $this->db->select('*');
        $this->db->from('tb_periode');
        return $this->db->get()->row();
    }

    public function filterBukuBesar($tanggal1jurnal, $tanggal2jurnal, $id_akun)
    {
        $this->db->select("*");
        $this->db->distinct();
        $this->db->from('tb_jurnal');
        $this->db->join('tb_akun', 'tb_akun.id_akun = tb_jurnal.id_akun', 'left');
        $this->db->join('tb_saldo', 'tb_saldo.id_akun = tb_jurnal.id_akun', 'left');
        $this->db->where('tb_jurnal.tanggal_transaksi >=', $tanggal1jurnal);
        $this->db->where('tb_jurnal.tanggal_transaksi <=', $tanggal2jurnal);
        $this->db->where('tb_saldo.periode_saldo =', $tanggal1jurnal);
        $this->db->where('tb_jurnal.id_akun', $id_akun);
        $this->db->where('tb_jurnal.saldo_jurnal <> 0');
        $this->db->order_by('tanggal_transaksi', 'asc');
        return $this->db->get();
    }

    public function closingBukuBesar($tanggal1jurnal, $tanggal2jurnal, $id_akun)
    {
        $this->db->select("*");
        $this->db->from('tb_jurnal');
        $this->db->join('tb_akun', 'tb_akun.id_akun = tb_jurnal.id_akun', 'left');
        $this->db->join('tb_saldo', 'tb_saldo.id_akun = tb_jurnal.id_akun', 'left');
        $this->db->where('tb_jurnal.tanggal_transaksi >=', $tanggal1jurnal);
        $this->db->where('tb_jurnal.tanggal_transaksi <=', $tanggal2jurnal);
        $this->db->where('tb_saldo.periode_saldo =', $tanggal1jurnal);
        $this->db->where('tb_jurnal.id_akun', $id_akun);
        $this->db->where('tb_jurnal.saldo_jurnal <> 0');
        $this->db->order_by('tanggal_transaksi', 'asc');
        return $this->db->get();
    }

    public function SaldoAwalBukuBesar($id_akun, $tanggal1)
    {
        $this->db->select("*");
        $this->db->from('tb_saldo');
        $this->db->join('tb_akun', 'tb_saldo.id_akun = tb_akun.id_akun', 'right');
        $this->db->where('tb_saldo.id_akun', $id_akun);
        $this->db->where('tb_saldo.periode_saldo = ', $tanggal1);
        return $this->db->get();
    }

    public function AwalBukuBesar($id_akun, $tanggal1)
    {
        $this->db->select("*");
        $this->db->from('tb_saldo');
        $this->db->where('tb_saldo.id_akun', $id_akun);
        $this->db->where('tb_saldo.periode_saldo = ', $tanggal1);
        $query = $this->db->get();
        return $query->row_array();
    }

    // Neraca
    public function getAkunNeracaAktiva($tanggal1neraca, $tanggal2neraca, $tanggalAwal)
    {

        $query = $this->db->query("SELECT a.nama_akun,a.id_akun,a.kode_akun,a.no_akun,b.saldo_awal,d.totaljurnal,b.saldo_awal + d.totaljurnal as total,a.level,x.saldo from tb_akun a 
        left join (select id_akun,saldo_awal,periode_saldo from tb_saldo where periode_saldo = '$tanggalAwal' group by id_akun) b on a.id_akun = b.id_akun 
        left join (select id_akun,sum(saldo_jurnal) as totaljurnal,tanggal_transaksi from tb_jurnal where tanggal_transaksi >= '$tanggalAwal' and tanggal_transaksi <= '$tanggal2neraca' group by id_akun) d on a.id_akun = d.id_akun 
        left join (select saldo_awal as saldo,t1.id_akun from tb_saldo t1 join(select level,id_akun from tb_akun) t2 on t2.id_akun = t1.id_akun where periode_saldo = '$tanggal1neraca') x on x.id_akun = a.id_akun 
        where a.jenis_akun = 'Aktiva' order by a.kode_akun,a.no_akun asc");

        return ($query);
    }

    public function getAkunNeracaPasiva($tanggal1neraca, $tanggal2neraca, $tanggalAwal)
    {

        $query = $this->db->query("SELECT a.nama_akun,a.id_akun,a.kode_akun,a.no_akun,a.level,b.saldo_awal,d.totaljurnal,b.saldo_awal + d.totaljurnal as total,a.level,x.saldo from tb_akun a 
        left join (select id_akun,saldo_awal,periode_saldo from tb_saldo where periode_saldo = '$tanggalAwal' group by id_akun) b on a.id_akun = b.id_akun 
        left join (select id_akun,sum(saldo_jurnal) as totaljurnal,tanggal_transaksi from tb_jurnal where tanggal_transaksi >= '$tanggalAwal' and tanggal_transaksi <= '$tanggal2neraca' group by id_akun) d on a.id_akun = d.id_akun 
        left join (select saldo_awal as saldo,t1.id_akun from tb_saldo t1 join(select level,id_akun from tb_akun ) t2 on t2.id_akun = t1.id_akun where periode_saldo = '$tanggal1neraca') x on x.id_akun = a.id_akun 
        where a.jenis_akun = 'Pasiva' order by a.kode_akun,a.no_akun asc");

        return ($query);
    }

    // Laba Rugi
    public function getAkunPendapatan($tanggal1labarugi, $tanggal2labarugi)
    {

        $query = $this->db->query("SELECT a.kode_akun, a.no_akun, a.nama_akun, d.saldo_jurnal, a.jenis_akun, a.kategori_akun, d.tanggal_transaksi, a.level from tb_akun a 
        left join (select id_akun, sum(saldo_jurnal) as saldo_jurnal, tanggal_transaksi from tb_jurnal  where tanggal_transaksi >= '$tanggal1labarugi' and tanggal_transaksi <= '$tanggal2labarugi' group by id_akun) d on a.id_akun = d.id_akun
        where a.jenis_akun = 'L/R' AND a.kategori_akun = 4
        order by a.no_akun, a.kode_akun ASC");

        return ($query);
    }

    public function getAkunpengeluaran($tanggal1labarugi, $tanggal2labarugi)
    {

        $query = $this->db->query("SELECT a.kode_akun, a.no_akun, a.nama_akun, d.saldo_jurnal, a.jenis_akun, a.kategori_akun, d.tanggal_transaksi, a.level from tb_akun a 
        left join (select id_akun,sum(saldo_jurnal) as saldo_jurnal, tanggal_transaksi from tb_jurnal  where tanggal_transaksi >= '$tanggal1labarugi' and tanggal_transaksi <= '$tanggal2labarugi' group by id_akun) d on a.id_akun = d.id_akun
        where a.jenis_akun = 'L/R' AND a.kategori_akun = 5 or a.kategori_akun = 6
        order by a.kode_akun, a.no_akun ASC");

        return ($query);
    }
}
