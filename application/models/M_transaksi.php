<?php
defined('BASEPATH') or exit('No Direct Script Access Allowed');

class M_transaksi extends CI_Model
{
    // Baru
    // Pembelian
    public function getDataSupplier($where)
    {
        $this->db->distinct();
        $this->db->select('id_supplier');
        $this->db->from('tb_transaksibeli');
        $this->db->where($where);
        return $this->db->get();
    }

    public function getDataCustomer($where)
    {
        $this->db->distinct();
        $this->db->select('id_customer');
        $this->db->from('tb_transaksijual');
        $this->db->where($where);
        return $this->db->get();
    }

    public function getListBarangBeli($where)
    {
        $this->db->from('tb_transaksibeli');
        $this->db->where($where);
        $this->db->join('tb_barang', 'tb_barang.id_barang = tb_transaksibeli.id_barang');
        $this->db->join('tb_satuanbeli', 'tb_satuanbeli.id_satuanbeli = tb_barang.id_satuanbeli');
        return $this->db->get();
    }

    public function getListBarangBeliDetail($kondisi)
    {
        $query = $this->db->query("SELECT DISTINCT a.kode_jurnal,b.nama_barang, a.diskon_beli,a.total_beli, b.*,c.*,a.qty_beli,d.qtyRetur,a.qty_beli - d.qtyRetur as totalQtyBeli,(a.qty_beli - d.qtyRetur) * (b.harga_beli-a.diskon_beli) as totalTransaksi from tb_transaksibeli a
        left JOIN tb_barang b on a.id_barang = b.id_barang
        left JOIN tb_satuanbeli c on b.id_satuanbeli = c.id_satuanbeli
        left join (SELECT Distinct kode_jurnal,sum(qty_returbeli) as qtyRetur,sum(total_returbeli) as totalRetur,id_barang from tb_returbeli group by kode_jurnal,id_barang) d on d.kode_jurnal = a.kode_jurnal and d.id_barang = a.id_barang
        where a.kode_jurnal = '$kondisi'");

        return $query;
    }

    public function getJumlahBayar($kondisi, $tanggal)
    {
        $query = $this->db->query("SELECT saldo_jurnal from tb_jurnal where kode_jurnal = '$kondisi' 
        and tanggal_transaksi = '$tanggal'
        and id_akun in (select id_akun from tb_linkacc where keterangan_link = 'Akun Pembayaran')");
        return ($query);
    }

    public function get_namaproduk($id)
    {
        $this->db->from('tb_barang');
        $this->db->where('id_supplier', $id);
        $this->db->join('tb_satuanbeli', 'tb_barang.id_satuanbeli = tb_satuanbeli.id_satuanbeli');
        $this->db->order_by('nama_barang', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllSupBeli()
    {
        $query = $this->db->query("SELECT DISTINCT j.kode_jurnal,c.nama_supplier,d.id_supplier,sum(saldo_jurnal) as total_utang from tb_jurnal j
        RIGHT JOIN (SELECT distinct kode_jurnal,id_supplier FROM tb_transaksibeli) d ON d.kode_jurnal = j.kode_jurnal
        RIGHT JOIN (SELECT id_supplier,nama_supplier FROM  tb_supplier)c ON c.id_supplier = d.id_supplier
        where j.id_akun = (select id_akun from tb_linkacc where keterangan_link = 'Akun Utang')
        group by c.id_supplier");
        return ($query);
    }

    public function getSupplierUtang()
    {
        $query = $this->db->query("SELECT DISTINCT j.kode_jurnal,c.nama_supplier,d.id_supplier,sum(saldo_jurnal) as total_utang from tb_jurnal j
        RIGHT JOIN (SELECT distinct kode_jurnal,id_supplier FROM tb_transaksibeli) d ON d.kode_jurnal = j.kode_jurnal
        RIGHT JOIN (SELECT id_supplier,nama_supplier FROM  tb_supplier)c ON c.id_supplier = d.id_supplier
        where j.id_akun = (select id_akun from tb_linkacc where keterangan_link = 'Akun Utang')
        AND j.saldo_jurnal < 0
        group by c.id_supplier");
        return ($query);
    }

    public function getSupplierLunas()
    {
        $query = $this->db->query("SELECT DISTINCT j.kode_jurnal,c.nama_supplier,d.id_supplier,sum(saldo_jurnal) as total_utang from tb_jurnal j
        RIGHT JOIN (SELECT distinct kode_jurnal,id_supplier FROM tb_transaksibeli) d ON d.kode_jurnal = j.kode_jurnal
        RIGHT JOIN (SELECT id_supplier,nama_supplier FROM  tb_supplier)c ON c.id_supplier = d.id_supplier
        where j.id_akun = (select id_akun from tb_linkacc where keterangan_link = 'Akun Utang')
        AND j.saldo_jurnal = 0
        group by c.id_supplier");
        return ($query);

        return ($query);
    }

    public function getAkunPembayaran()
    {
        $this->db->from('tb_linkacc');
        $this->db->where('tb_linkacc.keterangan_link', 'Akun Pembayaran');
        $this->db->join('tb_akun', 'tb_akun.id_akun = tb_linkacc.id_akun');
        return $this->db->get();
    }

    public function getAkunUtang()
    {
        $this->db->from('tb_linkacc');
        $this->db->where('tb_linkacc.keterangan_link', 'Akun Utang');
        $this->db->join('tb_akun', 'tb_akun.id_akun = tb_linkacc.id_akun');
        return $this->db->get();
    }

    public function getAkunUtangEdit($where, $where2)
    {
        $this->db->from('tb_linkacc');
        $this->db->join('tb_akun', 'tb_akun.id_akun = tb_linkacc.id_akun');
        $this->db->join('tb_jurnal', 'tb_jurnal.id_akun = tb_linkacc.id_akun');
        $this->db->where('tb_linkacc.keterangan_link', 'Akun Utang');
        $this->db->where($where);
        $this->db->where($where2);
        return $this->db->get();
    }

    public function getAkunPembayaranSelected($where)
    {
        $this->db->distinct();
        $this->db->select('tb_jurnal.id_akun');
        $this->db->from('tb_jurnal');
        $this->db->join('tb_linkacc', 'tb_jurnal.id_akun = tb_linkacc.id_akun');
        $this->db->where($where);
        $this->db->where('tb_linkacc.keterangan_link', 'Akun Pembayaran');
        return $this->db->get();
    }

    public function getAkunPembayaranRetur($where)
    {
        $this->db->distinct();
        $this->db->select('tb_jurnal.id_akun');
        $this->db->from('tb_jurnal');
        $this->db->join('tb_linkacc', 'tb_jurnal.id_akun = tb_linkacc.id_akun');
        $this->db->where($where);
        $this->db->where('tb_jurnal.jenis_transaksi', 'Pembelian');
        $this->db->where('tb_linkacc.keterangan_link', 'Akun Pembayaran');
        return $this->db->get();
    }

    public function getGrandTotal($kondisi)
    {
        $query = $this->db->query("SELECT saldo_jurnal from tb_jurnal where kode_jurnal = '$kondisi'
        and id_akun =  (select id_akun from tb_linkacc where keterangan_link = 'Akun Persediaan (Beli)')");
        return ($query);
    }

    public function getNamaSupplier($where)
    {

        $query = $this->db->query("SELECT DISTINCT tb_supplier.nama_supplier
        from tb_supplier
        JOIN tb_transaksibeli ON tb_transaksibeli.id_supplier=tb_supplier.id_supplier
        WHERE tb_transaksibeli.id_supplier = $where");

        return $query;
    }

    public function getDetailPembelian($where)
    {
        $query = $this->db->query("SELECT distinct j.kode_jurnal,z.totalUtang,f.totalBayar,c.nama_supplier, x.tanggal_terbaru,v.totalTransaksi from tb_jurnal j
        inner join (SELECT id_akun,kode_jurnal,sum(saldo_jurnal) AS totalUtang FROM tb_jurnal where id_akun in (select id_akun from tb_linkacc where keterangan_link='Akun Utang') group by kode_jurnal) z
        inner join (SELECT id_akun,kode_jurnal,sum(saldo_jurnal) as totalBayar FROM tb_jurnal where id_akun in (select id_akun from tb_linkacc where keterangan_link='Akun Pembayaran') group by kode_jurnal) f
        inner join (SELECT id_akun,kode_jurnal,sum(saldo_jurnal) as totalTransaksi FROM tb_jurnal where id_akun in (select id_akun from tb_linkacc where keterangan_link='Akun Persediaan (Beli)') group by kode_jurnal) v
        RIGHT JOIN (SELECT distinct kode_jurnal,id_supplier FROM tb_transaksibeli) d ON d.kode_jurnal = j.kode_jurnal
        RIGHT JOIN (SELECT id_supplier,nama_supplier FROM tb_supplier)c 
        ON c.id_supplier = d.id_supplier and j.kode_jurnal = f.kode_jurnal and j.kode_jurnal = z.kode_jurnal and v.kode_jurnal = j.kode_jurnal
        inner join (select distinct kode_jurnal,min(tanggal_transaksi) as tanggal_terbaru from tb_jurnal group by kode_jurnal)x on j.kode_jurnal = x.kode_jurnal
        where c.id_supplier = $where");

        return ($query);
    }

    public function getDetailInvoicePembelian($kondisi)
    {
        $query = $this->db->query("SELECT distinct j.kode_jurnal,z.totalUtang,f.totalBayar,a.totalTransaksi,c.nama_supplier, x.tanggal_terbaru from tb_jurnal j
        inner join (SELECT id_akun,kode_jurnal,sum(saldo_jurnal) AS totalUtang FROM tb_jurnal where id_akun in (select id_akun from tb_linkacc where keterangan_link='Akun Utang') group by kode_jurnal) z
        inner join (SELECT id_akun,kode_jurnal,sum(saldo_jurnal) as totalBayar FROM tb_jurnal where id_akun in (select id_akun from tb_linkacc where keterangan_link='Akun Pembayaran')  group by kode_jurnal) f
        inner join (SELECT id_akun,kode_jurnal,sum(saldo_jurnal) as totalTransaksi FROM tb_jurnal where id_akun = (select id_akun from tb_linkacc where keterangan_link='Akun Persediaan (Beli)') group by kode_jurnal) a
        RIGHT JOIN (SELECT distinct kode_jurnal,id_supplier FROM tb_transaksibeli) d ON d.kode_jurnal = j.kode_jurnal
        RIGHT JOIN (SELECT id_supplier,nama_supplier FROM tb_supplier)c 
        ON c.id_supplier = d.id_supplier and j.kode_jurnal = f.kode_jurnal and j.kode_jurnal = z.kode_jurnal and j.kode_jurnal = a.kode_jurnal
        inner join (select distinct kode_jurnal,min(tanggal_transaksi) as tanggal_terbaru from tb_jurnal group by kode_jurnal)x on j.kode_jurnal = x.kode_jurnal
        where j.kode_jurnal = '$kondisi'");

        return ($query);
    }

    public function getAllTransaksiBeli()
    {
        $query = $this->db->query("SELECT DISTINCT kode_jurnal,tanggal_transaksi
        from tb_jurnal 
        WHERE jenis_transaksi = 'Pembelian'");

        return $query;
    }

    public function getSupplierRetur()
    {

        $query = $this->db->query("SELECT DISTINCT c.nama_supplier,d.id_supplier from tb_jurnal j
        inner JOIN (SELECT distinct kode_jurnal,id_supplier FROM tb_transaksibeli) d ON d.kode_jurnal = j.kode_jurnal
        inner join (SELECT distinct kode_jurnal from tb_returbeli) e on d.Kode_jurnal = e.kode_jurnal
        inner JOIN (SELECT id_supplier,nama_supplier FROM  tb_supplier)c ON c.id_supplier = d.id_supplier");

        return $query;
    }

    public function getInvoiceReturPembelian($kondisi)
    {
        $query = $this->db->query("SELECT DISTINCT a.kode_jurnal,d.memo,d.tanggal_transaksi from tb_returbeli a
        join (select DISTINCT kode_jurnal,id_supplier from tb_transaksibeli) b on a.kode_jurnal = b.kode_jurnal
        join (select nama_supplier,id_supplier from tb_supplier) c on b.id_supplier = c.id_supplier
        join (select kode_jurnal,memo,jenis_transaksi,tanggal_transaksi from tb_jurnal) d on a.kode_jurnal = d.kode_jurnal
        where b.id_supplier = '$kondisi' and d.jenis_transaksi = 'Retur Pembelian' order by a.kode_jurnal,d.tanggal_transaksi asc");

        return $query;
    }


    public function getListBarangReturBeli($kondisi, $tgl)
    {
        $query = $this->db->query("SELECT distinct b.kode_jurnal,a.tanggal_returbeli,a.id_returbeli,c.*,a.qty_returbeli,a.total_returbeli from tb_returbeli a 
        join (select DISTINCT kode_jurnal,tanggal_transaksi from tb_jurnal) b on a.kode_jurnal = b.kode_jurnal
        join (select * from tb_barang) c on a.id_barang = c.id_barang
        where a.tanggal_returbeli = '$tgl'");
        return ($query);
    }

    public function getDaftarReturBeli($kondisi, $tanggal)
    {
        // $this->db->from('tb_returbeli');
        // $this->db->where($where);
        // $this->db->join('tb_barang', 'tb_barang.id_barang = tb_returbeli.id_barang');

        $query = $this->db->query("SELECT a.*,b.*,c.*,d.jumlahRetur from tb_returbeli a
        join (select distinct kode_jurnal from tb_transaksibeli) b on a.kode_jurnal = b.kode_jurnal 
        join tb_barang c on a.id_barang = c.id_barang
        inner join (select kode_jurnal,id_barang,sum(qty_returbeli) as jumlahRetur from tb_returbeli group by id_barang,kode_jurnal) d on d.kode_jurnal = a.kode_jurnal and d.id_barang = a.id_barang
        where a.kode_jurnal = '$kondisi' and a.tanggal_returbeli = '$tanggal'");

        return $query;
    }

    public function getAkunPembayaranUtang($where, $where2)
    {
        $this->db->from('tb_linkacc');
        $this->db->join('tb_akun', 'tb_akun.id_akun = tb_linkacc.id_akun');
        $this->db->join('tb_jurnal', 'tb_jurnal.id_akun = tb_linkacc.id_akun');
        $this->db->where('tb_linkacc.keterangan_link', 'Akun Pembayaran');
        $this->db->where($where);
        $this->db->where($where2);
        return $this->db->get();
    }

    // Penjualan

    public function getJumlahTerima($kondisi)
    {
        $query = $this->db->query("SELECT saldo_jurnal from tb_jurnal where kode_jurnal = '$kondisi' and id_akun in (select id_akun from tb_linkacc where keterangan_link = 'Akun Penerimaan')");
        return ($query);
    }

    public function getAllCustBeli()
    {
        $query = $this->db->query("SELECT DISTINCT j.kode_jurnal,c.nama_customer,d.id_customer,sum(saldo_jurnal) as total_piutang from tb_jurnal j
        RIGHT JOIN (SELECT distinct kode_jurnal,id_customer FROM tb_transaksijual) d ON d.kode_jurnal = j.kode_jurnal
        RIGHT JOIN (SELECT id_customer,nama_customer FROM tb_customer)c ON c.id_customer = d.id_customer
        where j.id_akun = (select id_akun from tb_linkacc where keterangan_link = 'Akun Piutang')
        group by c.id_customer");
        return ($query);
    }

    public function getAkunPenerimaan()
    {
        $this->db->from('tb_linkacc');
        $this->db->where('tb_linkacc.keterangan_link', 'Akun Penerimaan');
        $this->db->join('tb_akun', 'tb_akun.id_akun = tb_linkacc.id_akun');
        return $this->db->get();
    }

    public function getAkunPenerimaanSelected($where)
    {
        $this->db->select('tb_jurnal.id_akun');
        $this->db->from('tb_jurnal');
        $this->db->join('tb_linkacc', 'tb_jurnal.id_akun = tb_linkacc.id_akun');
        $this->db->where($where);
        $this->db->where('tb_linkacc.keterangan_link', 'Akun Penerimaan');
        return $this->db->get();
    }

    public function getNamaCustomer($where)
    {

        $query = $this->db->query("SELECT DISTINCT tb_customer.nama_customer
        from tb_customer
        JOIN tb_transaksijual ON tb_transaksijual.id_customer=tb_customer.id_customer
        WHERE tb_transaksijual.id_customer = $where");

        return $query;
    }

    public function getDetailPenjualan($where)
    {
        $query = $this->db->query("SELECT distinct j.kode_jurnal,z.totalPiutang,f.totalBayar,c.nama_customer, x.tanggal_terbaru,v.totalTransaksi from tb_jurnal j
        inner join (SELECT id_akun,kode_jurnal,sum(saldo_jurnal) AS totalPiutang FROM tb_jurnal where id_akun in (select id_akun from tb_linkacc where keterangan_link='Akun Piutang') group by kode_jurnal) z
        inner join (SELECT id_akun,kode_jurnal,sum(saldo_jurnal) as totalBayar FROM tb_jurnal where id_akun in (select id_akun from tb_linkacc where keterangan_link='Akun Penerimaan') group by kode_jurnal) f
        inner join (SELECT id_akun,kode_jurnal,sum(saldo_jurnal) as totalTransaksi FROM tb_jurnal where id_akun in (select id_akun from tb_linkacc where keterangan_link='Akun Penjualan') group by kode_jurnal) v
        RIGHT JOIN (SELECT distinct kode_jurnal,id_customer FROM tb_transaksijual) d ON d.kode_jurnal = j.kode_jurnal
        RIGHT JOIN (SELECT id_customer,nama_customer FROM tb_customer) c 
        ON c.id_customer = d.id_customer and j.kode_jurnal = f.kode_jurnal and j.kode_jurnal = z.kode_jurnal and j.kode_jurnal = v.kode_jurnal
        inner join (select distinct kode_jurnal,min(tanggal_transaksi) as tanggal_terbaru from tb_jurnal group by kode_jurnal)x on j.kode_jurnal = x.kode_jurnal
        where c.id_customer = $where");

        return ($query);
    }

    public function getDetailInvoicePenjualan($kondisi)
    {
        $query = $this->db->query("SELECT distinct j.kode_jurnal,z.totalPiutang,f.totalBayar,c.nama_customer, x.tanggal_terbaru,a.totalTransaksi from tb_jurnal j
        inner join (SELECT id_akun,kode_jurnal,sum(saldo_jurnal) AS totalPiutang FROM tb_jurnal where id_akun in (select id_akun from tb_linkacc where keterangan_link='Akun Piutang') group by kode_jurnal) z
        inner join (SELECT id_akun,kode_jurnal,sum(saldo_jurnal) as totalBayar FROM tb_jurnal where id_akun in (select id_akun from tb_linkacc where keterangan_link='Akun Penerimaan') group by kode_jurnal) f
        inner join (SELECT id_akun,kode_jurnal,sum(saldo_jurnal) as totalTransaksi FROM tb_jurnal where id_akun = (select id_akun from tb_linkacc where keterangan_link='Akun Penjualan') group by kode_jurnal) a
        RIGHT JOIN (SELECT distinct kode_jurnal,id_customer FROM tb_transaksijual) d ON d.kode_jurnal = j.kode_jurnal
        RIGHT JOIN (SELECT id_customer,nama_customer FROM tb_customer) c 
        ON c.id_customer = d.id_customer and j.kode_jurnal = f.kode_jurnal and j.kode_jurnal = z.kode_jurnal and j.kode_jurnal = a.kode_jurnal
        inner join (select distinct kode_jurnal,min(tanggal_transaksi) as tanggal_terbaru from tb_jurnal group by kode_jurnal)x on j.kode_jurnal = x.kode_jurnal
        where j.kode_jurnal = '$kondisi'");

        return ($query);
    }

    public function getListBarangJual($where)
    {
        $this->db->from('tb_transaksijual');
        $this->db->where($where);
        $this->db->join('tb_barang', 'tb_barang.id_barang = tb_transaksijual.id_barang');
        $this->db->join('tb_satuanjual', 'tb_satuanjual.id_satuanjual = tb_barang.id_satuanjual');
        $this->db->order_by('id_transaksijual', 'asc');
        return $this->db->get();
    }

    public function getListBarangJualDetail($kondisi)
    {
        $query = $this->db->query("SELECT DISTINCT a.kode_jurnal,b.nama_barang, a.diskon_jual,a.total_jual, b.*,c.*,a.qty_jual,d.qtyRetur,a.qty_jual - d.qtyRetur as totalQtyJual,(a.qty_jual - d.qtyRetur) * (b.harga_jual - a.diskon_jual) as totalTransaksi from tb_transaksijual a
        left JOIN tb_barang b on a.id_barang = b.id_barang
        left JOIN tb_satuanjual c on b.id_satuanjual = c.id_satuanjual
        left join (SELECT Distinct kode_jurnal,sum(qty_returjual) as qtyRetur,sum(total_returjual) as totalRetur,id_barang from tb_returjual group by kode_jurnal,id_barang) d on d.kode_jurnal = a.kode_jurnal and d.id_barang = a.id_barang
        where a.kode_jurnal = '$kondisi'");

        return $query;
    }

    public function getAkunPiutang()
    {
        $this->db->from('tb_linkacc');
        $this->db->where('tb_linkacc.keterangan_link', 'Akun Piutang');
        $this->db->join('tb_akun', 'tb_akun.id_akun = tb_linkacc.id_akun');
        return $this->db->get();
    }

    public function getAllTransaksiJual()
    {
        $query = $this->db->query("SELECT DISTINCT kode_jurnal,tanggal_transaksi
        from tb_jurnal 
        WHERE jenis_transaksi = 'Penjualan'");

        return $query;
    }

    public function getInvoiceReturPenjualan($kondisi)
    {
        $query = $this->db->query("SELECT DISTINCT a.kode_jurnal,d.memo,d.tanggal_transaksi from tb_returjual a
        join (select DISTINCT kode_jurnal,id_customer from tb_transaksijual) b on a.kode_jurnal = b.kode_jurnal
        join (select nama_customer,id_customer from tb_customer) c on b.id_customer = c.id_customer
        join (select kode_jurnal,memo,jenis_transaksi,tanggal_transaksi from tb_jurnal) d on a.kode_jurnal = d.kode_jurnal
        where b.id_customer = '$kondisi' and d.jenis_transaksi = 'Retur Penjualan' order by a.kode_jurnal,d.tanggal_transaksi asc");

        return $query;
    }

    public function getCustomerRetur()
    {

        $query = $this->db->query("SELECT DISTINCT c.nama_customer,d.id_customer from tb_jurnal j
        inner JOIN (SELECT distinct kode_jurnal,id_customer FROM tb_transaksijual) d ON d.kode_jurnal = j.kode_jurnal
        inner join (SELECT distinct kode_jurnal from tb_returjual) e on d.Kode_jurnal = e.kode_jurnal
        inner JOIN (SELECT id_customer,nama_customer FROM tb_customer)c ON c.id_customer = d.id_customer");

        return $query;
    }

    public function getAkunPenerimaanRetur($where)
    {
        $this->db->distinct();
        $this->db->select('tb_jurnal.id_akun');
        $this->db->from('tb_jurnal');
        $this->db->join('tb_linkacc', 'tb_jurnal.id_akun = tb_linkacc.id_akun');
        $this->db->where($where);
        $this->db->where('tb_jurnal.jenis_transaksi', 'Penjualan');
        $this->db->where('tb_linkacc.keterangan_link', 'Akun Penerimaan');
        return $this->db->get();
    }

    public function getListBarangReturJual($kondisi, $tgl)
    {
        $query = $this->db->query("SELECT distinct b.kode_jurnal,a.tanggal_returjual,c.*,a.qty_returjual,a.total_returjual from tb_returjual a 
        join (select DISTINCT kode_jurnal,tanggal_transaksi from tb_jurnal) b on a.kode_jurnal = b.kode_jurnal
        join (select * from tb_barang) c on a.id_barang = c.id_barang
        where a.tanggal_returjual = '$tgl'");
        return ($query);
    }

    public function getDaftarReturJual($kondisi, $tanggal)
    {
        // $this->db->from('tb_returjual');
        // $this->db->where($where);
        // $this->db->join('tb_barang', 'tb_barang.id_barang = tb_returjual.id_barang');

        // return $this->db->get();
        $query = $this->db->query("SELECT a.*,b.*,c.*,d.jumlahRetur from tb_returjual a
        join (select distinct kode_jurnal from tb_transaksijual) b on a.kode_jurnal = b.kode_jurnal 
        join tb_barang c on a.id_barang = c.id_barang
        inner join (select kode_jurnal,id_barang,sum(qty_returjual) as jumlahRetur from tb_returjual group by id_barang,kode_jurnal) d on d.kode_jurnal = a.kode_jurnal and d.id_barang = a.id_barang
        where a.kode_jurnal = '$kondisi' and a.tanggal_returjual = '$tanggal'");

        return $query;
    }

    //EDIT PENERIMAAN PIUTANG//
    public function getAkunPiutangEdit($where, $where2)
    {
        $this->db->from('tb_linkacc');
        $this->db->join('tb_akun', 'tb_akun.id_akun = tb_linkacc.id_akun');
        $this->db->join(
            'tb_jurnal',
            'tb_jurnal.id_akun = tb_linkacc.id_akun'
        );
        $this->db->where('tb_linkacc.keterangan_link', 'Akun Piutang');
        $this->db->where($where);
        $this->db->where($where2);
        return $this->db->get();
    }

    public function getAkunPenerimaanPiutang($where, $where2)
    {
        $this->db->from('tb_linkacc');
        $this->db->join('tb_akun', 'tb_akun.id_akun = tb_linkacc.id_akun');
        $this->db->join(
            'tb_jurnal',
            'tb_jurnal.id_akun = tb_linkacc.id_akun'
        );
        $this->db->where('tb_linkacc.keterangan_link', 'Akun Penerimaan');
        $this->db->where($where);
        $this->db->where($where2);
        return $this->db->get();
    }


    // Campur
    public function getDataPegawai($kondisi)
    {
        $query = $this->db->query("SELECT distinct tb_transaksibeli.id_user,tb_user.* from tb_transaksibeli 
        join tb_user on tb_transaksibeli.id_user = tb_user.id_user
        where tb_transaksibeli.kode_jurnal = '$kondisi'");
        return $query;
    }

    public function getDataPegawaiJual($kondisi)
    {
        $query = $this->db->query("SELECT distinct tb_transaksijual.id_user,tb_user.* from tb_transaksijual
        join tb_user on tb_transaksijual.id_user = tb_user.id_user
        where tb_transaksijual.kode_jurnal = '$kondisi'");
        return $query;
    }

    // public function sumLaba()
    // {
    //     $pendapatan = $this->db->query("SELECT sum(saldo_jurnal) as pendapatan from tb_jurnal a
    //                                     join tb_akun b on a.id_akun = b.id_akun
    //                                     where a.jenis_transaksi <> 'Piutang Awal' and a.jenis_transaksi <> 'Utang Awal' and b.kode_akun = '4'")->row()->pendapatan;
    //     $pengeluaran = $this->db->query("SELECT sum(saldo_jurnal) as pengeluaran from tb_jurnal a
    //                                     join tb_akun b on a.id_akun = b.id_akun
    //                                     where a.jenis_transaksi <> 'Piutang Awal' and a.jenis_transaksi <> 'Utang Awal' and b.kode_akun = '5' or b.kode_akun ='6'")->row()->pengeluaran;

    //     $labaRugi = substr($pendapatan, 1) - $pengeluaran;

    //     $this->db->query("UPDATE tb_akun set saldo = '$labaRugi' where id_akun = (select id_akun from tb_linkacc where keterangan_link = 'Akun Laba')");
    // }

    // Lama
    public function search_akun($nama_akun)
    {
        $this->db->like('nama_akun', $nama_akun, 'both');
        $this->db->order_by('nama_akun', 'ASC');
        $this->db->limit(10);
        return $this->db->get('tb_akun')->result();
    }

    public function search_pegawai($nama_pegawai)
    {
        $this->db->like('nama_pegawai', $nama_pegawai, 'both');
        $this->db->order_by('nama_pegawai', 'ASC');
        $this->db->limit(10);
        return $this->db->get('tb_pegawai')->result();
    }

    public function search_barang($nama_barang)
    {
        $this->db->like('nama_barang', $nama_barang, 'both');
        $this->db->join('tb_satuan', 'tb_satuan.id_satuan = tb_barang.id_satuan');
        $this->db->order_by('nama_barang', 'ASC');
        $this->db->limit(10);
        return $this->db->get('tb_barang')->result();
    }

    public function addTransaksi($data, $table)
    {
        return $this->db->insert_batch($table, $data);
    }
}
