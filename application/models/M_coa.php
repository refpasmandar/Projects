<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_coa extends CI_Model
{
    public function getCoa()
    {
        $this->db->from('tb_akun');
        $this->db->order_by('kode_akun', 'asc');
        $this->db->order_by('no_akun', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function getCoaTrans()
    {
        $this->db->from('tb_akun');
        $this->db->where('level', '4');
        $this->db->order_by('kode_akun', 'asc');
        $this->db->order_by('no_akun', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function getCoaHeader()
    {
        $this->db->from('tb_akun');
        $this->db->where('level', '1');
        $this->db->or_where('level', '2');
        $this->db->or_where('level', '3');
        $this->db->order_by('kode_akun', 'asc');
        $this->db->order_by('no_akun', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function getHeaderAkun($id)
    {
        $this->db->from('tb_akun');
        $this->db->where('kode_akun', $id);
        $this->db->where('level <>', '4');
        $this->db->order_by('kode_akun', 'asc');
        $this->db->order_by('no_akun', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function getHeaderById($kondisi)
    {
        $query = $this->db->query(
            "SELECT * from tb_akun where kode_akun = (select kode_akun from tb_akun where id_akun = '$kondisi') and level <> 4"
        );
        return $query;
    }

    public function addData($data, $table)
    {
        return $this->db->insert($table, $data);
    }

    public function editData($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function updateData($where, $table, $data)
    {
        $this->db->where($where);
        $this->db->update($data, $table);
    }

    public function updateSaldo($where, $table, $data)
    {
        $this->db->where($where);
        $this->db->update_batch($data, $table);
    }

    public function deleteData($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function sumLevel3()
    {
        for ($i = 1; $i <= 3; $i++) {
            $this->db->query('update tb_akun t1 inner join (select parent_id,sum(saldo) as saldo,periode from tb_akun group by parent_id) b on b.parent_id = t1.id_akun set t1.saldo = b.saldo, t1.periode=b.periode');
        }
    }

    //untuk input
    public function getSaldo()
    {
        $this->db->from('tb_akun');
        $this->db->where('level', '4');
        $this->db->order_by('kode_akun', 'asc');
        $this->db->order_by('no_akun', 'asc');
        return $this->db->get();
    }

    //Input saldo awal
    public function inputSaldoAwal()
    {
        $saldo = $this->input->post('saldo');
        $id_akun = $this->input->post('id_akun');
        $periode = $this->input->post('periode');

        $data = array();

        foreach ($id_akun as $id => $akun) {
            array_push($data, array(
                'id_akun' => $akun,
                'saldo' => $saldo[$id],
                'periode' => $periode,
            ));
        }
        $this->db->update_batch('tb_akun', $data, 'id_akun');

        /*$periode = $this->input->post('periode');
        $tgl = array(
            'periode'       => $periode,
        );

        $this->SaldoAwal_model->addSaldo($tgl, 'saldo_awal');*/
    }

    public function salinSaldoAwal()
    {
        $query = $this->db->query('INSERT INTO tb_saldo (id_akun, parent_saldo, saldo_awal, periode_saldo)
        SELECT id_akun,parent_id,saldo,periode FROM tb_akun');
        return $query;
    }

    //untuk update
    public function getSaldoAwal()
    {
        $query = $this->db->query("SELECT t1.*, t2.* FROM (SELECT * FROM tb_akun WHERE level='4') t1 JOIN (SELECT * FROM tb_saldo WHERE periode_saldo = (SELECT MAX(periode_saldo) as periode from tb_saldo)) t2 ON t1.id_akun = t2.id_akun order by t1.kode_akun, t1.no_akun asc");
        // $this->db->from('tb_saldo');
        // $this->db->join('tb_akun','tb_akun.id_akun = tb_saldo.id_akun');
        // $this->db->where('level','4');
        // $this->db->order_by('tb_akun.kode_akun','asc');
        // $this->db->order_by('tb_akun.no_akun','asc');
        return $query;
    }

    public function getSaldoAwalLatest()
    {
        $query = "SELECT t1.*, t2.* FROM (SELECT * FROM tb_akun) t1 JOIN (SELECT * FROM tb_saldo WHERE periode_saldo = 
        (SELECT MAX(periode_saldo) as periode from tb_saldo)) t2 ON t1.id_akun = t2.id_akun order by t1.kode_akun, t1.no_akun asc";
        return $this->db->query($query);
    }

    //Menyamakan update saldo awal
    public function matchingSaldo()
    {
        $query = $this->db->query('UPDATE tb_saldo INNER JOIN tb_akun
        ON tb_saldo.periode_saldo = tb_akun.periode AND tb_saldo.id_akun = tb_akun.id_akun 
        SET tb_saldo.saldo_awal=tb_akun.saldo');
    }

    //Judul periode
    public function getPeriodeSaldo()
    {
        $this->db->select_max('periode_saldo');
        $this->db->from('tb_saldo');
        return $this->db->get();
    }

    //Riwayat saldo
    public function filterSaldo($tgl1, $tgl2)
    {
        $this->db->from('tb_saldo');
        $this->db->join('tb_akun', 'tb_akun.id_akun = tb_saldo.id_akun');
        $this->db->where('tb_saldo.periode_saldo >= ', $tgl1);
        $this->db->where('tb_saldo.periode_saldo <= ', $tgl2);
        $this->db->order_by('tb_akun.kode_akun', 'asc');
        $this->db->order_by('tb_akun.no_akun', 'asc');
        return $this->db->get();
    }

    //Judul periode update saldo
    public function filterPeriode($tgl1, $tgl2)
    {
        $this->db->distinct();
        $this->db->select('periode_saldo');
        $this->db->from('tb_saldo');
        $this->db->where('periode_saldo >= ', $tgl1);
        $this->db->where('periode_saldo <= ', $tgl2);
        return $this->db->get();
    }

    public function getLinkJual()
    {
        $query = $this->db->query('SELECT tb_akun.*, tb_linkacc.* FROM tb_akun RIGHT JOIN 
        tb_linkacc ON tb_akun.id_akun=tb_linkacc.id_akun where tb_linkacc.jenis_link="Penjualan"');
        return ($query);
    }

    public function getLinkBeli()
    {
        $query = $this->db->query('SELECT tb_akun.*, tb_linkacc.* FROM tb_akun RIGHT JOIN 
        tb_linkacc ON tb_akun.id_akun=tb_linkacc.id_akun where tb_linkacc.jenis_link="Pembelian"');
        return ($query);
    }

    public function getLinkModal()
    {
        $query = $this->db->query('SELECT tb_akun.*, tb_linkacc.* FROM tb_akun RIGHT JOIN 
        tb_linkacc ON tb_akun.id_akun=tb_linkacc.id_akun where tb_linkacc.jenis_link="Ekuitas"');
        return ($query);
    }

    public function getLink($where)
    {
        $query = $this->db->query("SELECT tb_akun.*, tb_linkacc.* FROM tb_akun RIGHT JOIN 
        tb_linkacc ON tb_akun.id_akun=tb_linkacc.id_akun where tb_linkacc.id_link= $where");
        return ($query);
    }

    public function updateLink($where, $table, $data)
    {
        $this->db->where($where);
        $this->db->update($data, $table);
    }
}
