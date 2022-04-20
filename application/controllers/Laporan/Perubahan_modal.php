<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perubahan_modal extends CI_Controller
{
    public function perubahanModal()
    {
        $data['profil']     = $this->M_profil->getProfil()->result();
        $data['coa']        = $this->M_coa->getCoaTrans()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data,);
        $this->load->view('v_admin/Laporan/Perubahan_modal/filter_perubahanModal', $data);
        $this->load->view('template/footer');
    }

    public function prosesFilterPerubahanModal()
    {

        $tanggal1modal = $this->input->post('tanggal1modal');
        $tanggal2modal = $this->input->post('tanggal2modal');

        $data['profil']     = $this->M_profil->getProfil()->result();
        $data['modalAwal'] = $this->db->query("SELECT a.*,b.* from tb_saldo a 
                                            join tb_akun b on a.id_akun = b.id_akun
                                            join tb_linkacc c on a.id_akun = c.id_akun
                                            where a.periode_saldo >= '$tanggal1modal' and a.periode_saldo <= '$tanggal2modal' and c.jenis_link = 'Ekuitas'")->result();
        $data['pendapatan'] = $this->db->query("SELECT sum(saldo_jurnal) as pendapatan from tb_jurnal a
                                        join tb_akun b on a.id_akun = b.id_akun
                                        where a.tanggal_transaksi >= '$tanggal1modal' and a.tanggal_transaksi <= '$tanggal2modal' and b.kode_akun = '4'")->row_array();
        $data['pengeluaran'] = $this->db->query("SELECT sum(saldo_jurnal) as pengeluaran from tb_jurnal a
                                        join tb_akun b on a.id_akun = b.id_akun
                                        where a.tanggal_transaksi >= '$tanggal1modal' and a.tanggal_transaksi <= '$tanggal2modal'and b.kode_akun = '5' or b.kode_akun ='6'")->row_array();

        $data['setting']    = $this->M_profil->getSetting()->result();
        $data['tanggal1modal'] = $tanggal1modal;
        $data['tanggal2modal'] = $tanggal2modal;

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Laporan/Perubahan_modal/perubahanModal', $data);
        $this->load->view('template/footer');
    }
}
