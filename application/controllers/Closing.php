<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Closing extends CI_Controller
{
    public function filterClosing()
    {
        $data['profil']     = $this->M_profil->getProfil()->result();
        $data['setting']    = $this->M_profil->getSetting()->result();


        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data,);
        $this->load->view('v_admin/Laporan/Closing/filter_closing', $data);
        $this->load->view('template/footer');
    }

    public function closingJurnal()
    {
        $tanggal1 = $this->input->post('tanggal1closing');
        $tanggal2 = $this->input->post('tanggal2closing');
        $tanggalAwal = $this->db->query("SELECT tanggal_pembukuan from tb_setting")->row_array();
        $data['profil'] = $this->M_profil->getProfil()->result();
        // $data['jurnal'] = $this->M_jurnal->getJurnalFilter($tanggal1, $tanggal2)->result();
        $data['header'] = $this->M_jurnal->getJurnalHeader($tanggal1, $tanggal2)->result();
        $data['tanggal1'] = $tanggal1;
        $data['tanggal2'] = $tanggal2;
        $data['tanggalAwal'] = $tanggalAwal;
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Laporan/Closing/closing_jurnal', $data);
        $this->load->view('template/footer');
        $this->session->set_userdata('referred_from', current_url());
    }

    function closingTabBukuBesar($tanggal1, $tanggal2)
    {
        $tanggal1 = $tanggal1;
        $tanggal2 = $tanggal2;
        $tanggalAwal = $this->db->query("SELECT tanggal_pembukuan from tb_setting")->row_array();
        $data['profil']     = $this->M_profil->getProfil()->result();
        $data['coa']        = $this->M_coa->getCoaTrans()->result();
        // $data['buku_besar'] = $this->M_laporan->closingBukuBesar($tanggal1, $tanggal2)->result();
        // $data['saldoawal'] = $this->M_laporan->SaldoAwalBukuBesar($id_akun)->result();
        // $data['testing'] = $this->M_laporan->AwalBukuBesar($id_akun);
        $data['tanggal1'] = $tanggal1;
        $data['tanggal2'] = $tanggal2;
        $data['tanggalAwal'] = $tanggalAwal;
        // $data['id_akun'] = $id_akun;

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Laporan/Closing/closing_bukuBesar', $data);
        $this->load->view('template/footer');
    }

    public function closingTabJurnal($tanggal1, $tanggal2)
    {
        $tanggal1 = $tanggal1;
        $tanggal2 = $tanggal2;
        $tanggalAwal = $this->db->query("SELECT tanggal_pembukuan from tb_setting")->row_array();
        $data['profil'] = $this->M_profil->getProfil()->result();
        // $data['jurnal'] = $this->M_jurnal->getJurnalFilter($tanggal1, $tanggal2)->result();
        $data['header'] = $this->M_jurnal->getJurnalHeader($tanggal1, $tanggal2)->result();
        $data['tanggal1'] = $tanggal1;
        $data['tanggal2'] = $tanggal2;
        $data['tanggalAwal'] = $tanggalAwal;
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Laporan/Closing/closing_jurnal', $data);
        $this->load->view('template/footer');
        $this->session->set_userdata('referred_from', current_url());
    }


    function closingTabNeraca($tanggal1, $tanggal2)
    {
        $tanggal1 = $tanggal1;
        $tanggal2 = $tanggal2;
        $tanggalAwal = $this->db->query("SELECT tanggal_pembukuan from tb_setting")->row_array();
        $tanggalAwalPembukuan = $this->db->query("SELECT tanggal_pembukuan from tb_setting")->row()->tanggal_pembukuan;
        $data['profil'] = $this->M_profil->getProfil()->result();
        $id_akun = $this->input->post('id_akun');

        $data['profil']     = $this->M_profil->getProfil()->result();
        $data['neraca_aktiva'] = $this->M_laporan->getAkunNeracaAktiva($tanggalAwalPembukuan, $tanggal2, $tanggal1)->result();
        $data['neraca_pasiva'] = $this->M_laporan->getAkunNeracaPasiva($tanggalAwalPembukuan, $tanggal2, $tanggal1)->result();
        $data['tanggal1'] = $tanggal1;
        $data['tanggal2'] = $tanggal2;
        $data['tanggalAwal'] = $tanggalAwal;
        $data['pendapatan'] = $this->db->query("SELECT sum(saldo_jurnal) as pendapatan from tb_jurnal a
                                        join tb_akun b on a.id_akun = b.id_akun
                                        where (a.tanggal_transaksi >= '$tanggal1' and b.kode_akun = '4') and (a.tanggal_transaksi <= '$tanggal2' and b.kode_akun = '4')")->row_array();
        $data['pengeluaran'] = $this->db->query("SELECT sum(saldo_jurnal) as pengeluaran from tb_jurnal a
                                        join tb_akun b on a.id_akun = b.id_akun
                                        where (a.tanggal_transaksi >= '$tanggal1' and (b.kode_akun = '5' or b.kode_akun ='6')) and (a.tanggal_transaksi <= '$tanggal2' and (b.kode_akun = '5' or b.kode_akun ='6'))")->row_array();
        $data['setting'] = $this->M_profil->getSetting()->result();
        $data['id_akun'] = $id_akun;

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Laporan/Closing/closing_neraca', $data);
        $this->load->view('template/footer');
    }

    public function closingTabLabaRugi($tanggal1, $tanggal2)
    {

        $tanggal1 = $tanggal1;
        $tanggal2 = $tanggal2;
        $tanggalAwal = $this->db->query("SELECT tanggal_pembukuan from tb_setting")->row_array();
        $data['tanggalAwal'] = $tanggalAwal;

        $data['profil']     = $this->M_profil->getProfil()->result();
        $data['pendapatan'] = $this->M_laporan->getAkunPendapatan($tanggal1, $tanggal2)->result();
        $data['pengeluaran'] = $this->M_laporan->getAkunpengeluaran($tanggal1, $tanggal2)->result();
        $data['setting']    = $this->M_profil->getSetting()->result();
        $data['tanggal1'] = $tanggal1;
        $data['tanggal2'] = $tanggal2;

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Laporan/Closing/closing_labaRugi', $data);
        $this->load->view('template/footer');
    }

    public function closingPeriode($tanggal1, $tanggal2)
    {

        $tanggal1 = $tanggal1;
        $tanggal2 = $tanggal2;
        // Tanggal Awal Pembukuan
        $tanggalAwal = $this->db->query("SELECT tanggal_pembukuan from tb_setting")->row_array();
        $data['tanggalAwal'] = $tanggalAwal;

        // Membuat Periode baru
        $periode_baru = strtotime($tanggal1);
        $periode_awal = date("Y-m-d", strtotime("+1 month", $periode_baru)) . "\n";

        // Update Jurnal
        $this->db->query("UPDATE tb_jurnal set status ='Close' where tanggal_transaksi >= '$tanggal1' and tanggal_transaksi <='$tanggal2'");

        // Input Saldo Awal
        $this->db->query("INSERT into tb_saldo (id_akun, parent_saldo, saldo_awal, periode_saldo) 
        select a.id_akun,a.parent_id, COALESCE(c.saldoAwal + b.totalTransaksi,c.saldoAwal,0) as saldo_akhir, COALESCE(date_add(c.periode_saldo, interval 1 month),'$periode_awal') from tb_akun a 
        left join (select id_akun,sum(saldo_jurnal) as totalTransaksi from tb_jurnal where tanggal_transaksi >= '$tanggal1' and tanggal_transaksi <= '$tanggal2' group by id_akun) b on a.id_akun = b.id_akun 
        left join (select id_akun,saldo_awal as saldoAwal,periode_saldo from tb_saldo where periode_saldo = '$tanggal1') c on a.id_akun =  c.id_akun");

        // Menghitung Laba Rugi
        $pendapatan = $this->db->query("SELECT sum(saldo_jurnal) as pendapatan from tb_jurnal a
                                        join tb_akun b on a.id_akun = b.id_akun
                                        where (a.tanggal_transaksi >= '$tanggal1' and b.kode_akun = '4') and (a.tanggal_transaksi <= '$tanggal2' and b.kode_akun = '4')")->row()->pendapatan;
        $pengeluaran = $this->db->query("SELECT sum(saldo_jurnal) as pengeluaran from tb_jurnal a
                                        join tb_akun b on a.id_akun = b.id_akun
                                        where (a.tanggal_transaksi >= '$tanggal1' and (b.kode_akun = '5' or b.kode_akun ='6')) and (a.tanggal_transaksi <= '$tanggal2' and (b.kode_akun = '5' or b.kode_akun ='6'))")->row()->pengeluaran;
        $labaRugi = substr($pendapatan, 1) - $pengeluaran;
        // 

        // Ambil Laba Ditahan
        $labaDitahan = $this->db->query("SELECT saldo_awal from tb_saldo where id_akun = (select id_akun from tb_linkacc where keterangan_link = 'Akun Laba Ditahan') and periode_saldo = '$tanggal1'")->row_array();

        // Hitung Laba Ditahan
        $newLabaDitahan = $labaDitahan['saldo_awal'] - $labaRugi;
        print_r($labaDitahan);
        print_r($newLabaDitahan);

        // Update Laba Ditahan
        $this->db->query("UPDATE tb_saldo set saldo_awal = '$newLabaDitahan' where periode_saldo = '$periode_awal' and id_akun = (select id_akun from tb_linkacc where keterangan_link = 'Akun Laba Ditahan')");

        $this->db->query("UPDATE tb_akun set saldo = '$newLabaDitahan' where id_akun = (select id_akun from tb_linkacc where keterangan_link = 'Akun Laba Ditahan')");
        // 

        // Update Header Saldo Awal
        for ($i = 1; $i <= 3; $i++) {
            $this->db->query("UPDATE tb_saldo t1 inner join (select parent_saldo,sum(saldo_awal) as saldo, periode_saldo from tb_saldo where periode_saldo = '$periode_awal' group by parent_saldo) b on b.parent_saldo = t1.id_akun set t1.saldo_awal = b.saldo where t1.periode_saldo = b.periode_saldo");
        }

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('Success', 'Periode Berhasil Ditutup');
            $this->M_coa->sumLevel3();
            redirect('Closing/filterClosing');
        } else {
            redirect('Closing/closingTabNeraca/' . $tanggalAwal['tanggal_pembukuan'] . '/' . $tanggal2);
        }
    }
}
