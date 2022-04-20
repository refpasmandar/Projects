<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // check_admin();
        check_not_login();
    }

    public function daftarCustomer()
    {
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['cust'] = $this->M_customer->getCust()->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Customer/v_customer', $data);
        $this->load->view('template/footer');
    }

    public function tambahCustomer()
    {
        $data['profil'] = $this->M_profil->getProfil()->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Customer/tambah_customer');
        $this->load->view('template/footer');
    }

    public function prosesTambah()
    {
        $this->form_validation->set_rules('nama_customer', 'Nama Customer', 'required|is_unique[tb_customer.nama_customer]|max_length[25]');
        $this->form_validation->set_rules('kode_cust', 'Kode Customer', 'required|is_unique[tb_customer.kode_customer]|min_length[2]|max_length[6]');
        $this->form_validation->set_rules('no_telp', 'Nomor Telepon Customer', 'required|max_length[13]');
        $this->form_validation->set_rules('alamat', 'Alamat Customer', 'required|max_length[50]');
        $this->form_validation->set_rules('email', 'Email Email Customer', 'required|max_length[30]');

        $this->form_validation->set_message('required', '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_message('is_unique', '%s Sudah Ada');
        $this->form_validation->set_message('min_length', '%s Minimal %d Karakter');
        $this->form_validation->set_message('max_length', '%s Maksimal %d Karakter');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $data['profil'] = $this->M_profil->getProfil()->result();
            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Customer/tambah_customer');
            $this->load->view('template/footer');
        } else {
            $nama_customer = $this->input->post('nama_customer');
            $no_telp = $this->input->post('no_telp');
            $alamat = $this->input->post('alamat');
            $email = $this->input->post('email');
            $kode_cust = $this->input->post('kode_cust');

            $data = array(
                'nama_customer'     => $nama_customer,
                'kode_customer'         => $kode_cust,
                'telp_customer'     => $no_telp,
                'alamat_customer'   => $alamat,
                'email_customer'    => $email
            );

            $this->M_customer->addCustomer($data, 'tb_customer');
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('Success', 'Customer berhasil ditambahkan');
                redirect('Master_data/Customer/daftarCustomer');
            } else {
                redirect('Master_data/Customer/daftarCustomer');
            }
        }
    }

    public function editCustomer($id)
    {
        $where = array('id_customer' => $id);
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['cust'] = $this->M_customer->editCustomer($where, 'tb_customer')->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Customer/edit_customer', $data);
        $this->load->view('template/footer');
    }

    public function prosesEdit()
    {
        $this->form_validation->set_rules('kode_cust', 'Kode Customer', 'required|min_length[2]|max_length[6]|callback_KodeCheck');
        $this->form_validation->set_rules('nama_customer', 'Nama Customer', 'required|max_length[25]|callback_NamaCheck');
        $this->form_validation->set_rules('no_telp', 'Nomor Telepon Customer', 'required|max_length[13]');
        $this->form_validation->set_rules('alamat', 'Alamat Customer', 'required|max_length[50]');
        $this->form_validation->set_rules('email', 'Email Customer', 'required|max_length[25]');

        $this->form_validation->set_message('min_length', '%s Minimal %d Karakter');
        $this->form_validation->set_message('max_length', '%s Maksimal %d Karakter');
        $this->form_validation->set_message('required', '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $id = $this->input->post('id_customer');
            $where = array('id_customer' => $id);
            $data['profil'] = $this->M_profil->getProfil()->result();
            $data['cust'] = $this->M_customer->editCustomer($where, 'tb_customer')->result();
            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Customer/edit_customer', $data);
            $this->load->view('template/footer');
        } else {
            $id_customer   = $this->input->post('id_customer');
            $kode_cust = $this->input->post('kode_cust');
            $nama_customer = $this->input->post('nama_customer');
            $no_telp = $this->input->post('no_telp');
            $alamat = $this->input->post('alamat');
            $email = $this->input->post('email');

            $data = array(
                'nama_customer'     => $nama_customer,
                'kode_customer'         => $kode_cust,
                'telp_customer'     => $no_telp,
                'alamat_customer'   => $alamat,
                'email_customer'    => $email
            );

            $where = array('id_customer' => $id_customer);

            $this->M_customer->updateCustomer($where, $data, 'tb_customer');
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('Success', 'Customer berhasil diubah');
                redirect('Master_data/Customer/daftarCustomer');
            } else {
                redirect('Master_data/Customer/daftarCustomer');
            }
        }
    }

    public function deleteCustomer($id)
    {
        $where = array('id_customer' => $id);
        $this->M_customer->deleteCustomer($where, 'tb_customer');
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('Success', 'Customer Berhasil Dihapus');
            redirect('Master_data/Customer/daftarCustomer');
        } else {
            redirect('Master_data/Customer/daftarCustomer');
        }
    }

    function KodeCheck()
    {
        $post = $this->input->post(null, true);
        $query = $this->db->query("select * from tb_customer where kode_customer = '$post[kode_cust]' AND id_customer != '$post[id_customer]'");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('KodeCheck', '%s ini sudah dipakai');
            return false;
        } else {
            return true;
        }
    }

    function NamaCheck()
    {
        $post = $this->input->post(null, true);
        $query = $this->db->query("select * from tb_customer where nama_customer = '$post[nama_customer]' AND id_customer != '$post[id_customer]'");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('NamaCheck', '%s ini sudah dipakai');
            return false;
        } else {
            return true;
        }
    }

    public function tambahPiutang()
    {
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['barang'] = $this->M_barang->getData()->result();
        $data['cust'] = $this->M_customer->getCust()->result();
        $data['coa'] = $this->M_coa->getCoa()->result();
        $data['setting'] = $this->M_profil->getSetting()->result();
        // $data['bayar'] = $this->db->query('select id_akun from tb_linkacc where keterangan="Akun Penerimaan"')->result();
        $data['akunTerima'] = $this->M_transaksi->getAkunPenerimaan()->result();
        $data['piutang'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Piutang"')->result();
        $data['persediaan'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Persediaan (Jual)"')->result();
        $data['hpp'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun HPP"')->result();
        $data['penjualan'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Penjualan"')->result();
        $data['batasPiutang'] = $this->db->query("SELECT nama_akun, COALESCE(b.saldo_awal - c.totalPiutang,0) as batasPiutang,COALESCE(b.saldo_awal,0) as saldoAwal,COALESCE(c.totalPiutang,0) as totalPiutang from tb_akun a 
        join (select id_akun,saldo_awal from tb_saldo where id_akun = (select id_akun from tb_linkacc where keterangan_link = 'Akun Piutang')) b on b.id_akun = a.id_akun 
        left join (select id_akun,sum(saldo_jurnal) AS totalPiutang from tb_jurnal where id_akun = (select id_akun from tb_linkacc where keterangan_link = 'Akun Piutang') and jenis_transaksi = 'Piutang Awal') c on c.id_akun = a.id_akun")->row_array();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Customer/formPiutangAwal', $data);
        $this->load->view('template/footer');
    }

    public function prosesTambahPiutang()
    {
        $setting = $this->input->post('kode_transaksi');
        $this->form_validation->set_rules('nomor_invoice', $setting, 'required|is_unique[tb_jurnal.kode_jurnal]');
        $this->form_validation->set_rules('tanggal_transaksi', 'Tanggal Transaksi', 'required');
        $this->form_validation->set_rules('akun_penerimaan', 'Akun Penerimaan', 'required');
        $this->form_validation->set_rules('memo', 'Memo', 'required');
        $this->form_validation->set_rules('id_barang[]', 'Barang', 'required');
        $this->form_validation->set_rules('qty[]', 'Quantity', 'required');
        $this->form_validation->set_message('required', '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $data['profil'] = $this->M_profil->getProfil()->result();
            $data['barang'] = $this->M_barang->getData()->result();
            $data['cust'] = $this->M_customer->getCust()->result();
            $data['coa'] = $this->M_coa->getCoa()->result();
            $data['setting'] = $this->M_profil->getSetting()->result();
            // $data['bayar'] = $this->db->query('select id_akun from tb_linkacc where keterangan="Akun Penerimaan"')->result();
            $data['akunTerima'] = $this->M_transaksi->getAkunPenerimaan()->result();
            $data['piutang'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Piutang"')->result();
            $data['persediaan'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Persediaan (Jual)"')->result();
            $data['hpp'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun HPP"')->result();
            $data['penjualan'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Penjualan"')->result();
            $data['batasPiutang'] = $this->db->query("SELECT nama_akun, COALESCE(b.saldo_awal - c.totalPiutang,0) as batasPiutang,COALESCE(b.saldo_awal,0) as saldoAwal,COALESCE(c.totalPiutang,0) as totalPiutang from tb_akun a 
            join (select id_akun,saldo_awal from tb_saldo where id_akun = (select id_akun from tb_linkacc where keterangan_link = 'Akun Piutang')) b on b.id_akun = a.id_akun 
            left join (select id_akun,sum(saldo_jurnal) AS totalPiutang from tb_jurnal where id_akun = (select id_akun from tb_linkacc where keterangan_link = 'Akun Piutang') and jenis_transaksi = 'Piutang Awal') c on c.id_akun = a.id_akun")->row_array();
            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Customer/formPiutangAwal', $data);
            $this->load->view('template/footer');
        } else {
            // Kedua Tabel
            $kode_jurnal = $this->input->post('nomor_invoice');

            // Tabel Jurnal
            $tanggal_transaksi = $this->input->post('tanggal_transaksi');
            $memo = $this->input->post('memo');
            $grand_total = $this->input->post('grand_total');
            $jumlah_bayar = $this->input->post('jumlah_bayar');
            $saldo = $this->input->post('saldo');
            $selisih = $this->input->post('selisih');
            $posisi = $this->input->post('posisi');
            $id_akun = $this->input->post('id_akun');
            $jenis_transaksi = $this->input->post('jenis_transaksi');

            // Tabel Transaksi
            $id_pegawai = $this->input->post('id_pegawai');
            $id_customer = $this->input->post('id_customer');
            $id_barang = $this->input->post('id_barang');
            $qty = $this->input->post('qty');
            $diskon = $this->input->post('diskon');
            $total = $this->input->post('total');
            $total_hpp = $this->input->post('total_hpp');

            $data = array();

            foreach ($id_akun as $key => $value) {
                array_push($data, array(
                    'id_akun' => $value,
                    'kode_jurnal' => $kode_jurnal,
                    'tanggal_transaksi' => $tanggal_transaksi,
                    'jenis_transaksi'   => $jenis_transaksi,
                    'memo' => $memo,
                    'posisi' => $posisi[$key],
                    'saldo_jurnal' => $saldo[$key]
                ));
            }

            $trans = array();

            foreach ($id_barang as $bar => $barang) {
                array_push($trans, array(
                    'kode_jurnal' => $kode_jurnal,
                    'id_barang' => $barang,
                    'qty_jual' => $qty[$bar],
                    'diskon_jual' => $diskon[$bar],
                    'total_jual' => $total[$bar],
                    'total_hpp' => $total_hpp[$bar],
                    'id_user' => $id_pegawai,
                    'id_customer' => $id_customer
                ));
            }

            $this->db->insert_batch('tb_jurnal', $data);
            $this->db->insert_batch('tb_transaksijual', $trans);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('Success', 'Piutang Awal Berhasil Ditambahkan');
                $this->M_coa->sumLevel3();
                // $this->db->query("UPDATE tb_barang SET stok_beli = stok_beli-NEW.qty, stok_jual = stok_jual - (nilai_konversi * NEW.qty) WHERE id_barang = NEW.id_barang;");
                redirect('Master_data/Customer/daftarCustomer');
            } else {
                redirect('Master_data/Customer/daftarCustomer');
            }
        }
    }

    public function editPiutangAwal($invoice, $tgl)
    {
        $where = array('kode_jurnal' => $invoice);
        $kondisi = $invoice;
        $tanggal = $tgl;
        $where2 = array('tanggal_transaksi' => $tgl);
        // $supp = $this->db->query("SELECT distinct id_supplier from tb_transaksibeli where kode_jurnal = '$kondisi'")->row_array();
        // $where2 = $supp;
        // Settingan
        $data['setting'] = $this->M_profil->getSetting()->result();
        // profil perusahaan
        $data['profil'] = $this->M_profil->getProfil()->result();
        // Data Invoice,tanggal,memo
        $data['single'] = $this->M_jurnal->getData($where, $where2)->result();
        // Data ID Jurnal
        $data['jurnal'] = $this->M_jurnal->getIDjurnal($where, $where2)->result();
        // Daftat Customer
        $data['cust'] = $this->M_customer->getCust()->result();
        //Data Customer di Pilih
        $data['customer'] = $this->M_transaksi->getDataCustomer($where)->result();
        //data barang
        $data['barang'] = $this->M_barang->getData()->result();
        // List barang yang dibeli
        $data['listBarang'] = $this->M_transaksi->getListBarangJual($where)->result();
        // jumlah bayar
        $data['jumlahTerima'] = $this->M_transaksi->getJumlahTerima($kondisi)->result();
        // Get akun bayar
        $data['getAkunTerima'] = $this->M_transaksi->getAkunPenerimaanSelected($where)->result();
        // // Link account pembayaran
        // $data['bayar'] = $this->db->query('select id_akun from tb_linkacc where keterangan="Akun Penerimaan"')->result();
        $data['akunTerima'] = $this->M_transaksi->getAkunPenerimaan()->result();
        // Link Account utang
        $data['piutang'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Piutang"')->result();
        // Link account persediaan barang
        $data['persediaan'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Persediaan (Jual)"')->result();
        $data['hpp'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun HPP"')->result();
        $data['penjualan'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Penjualan"')->result();
        $data['batasPiutang'] = $this->db->query("SELECT nama_akun, COALESCE(b.saldo_awal - c.totalPiutang,0) as batasPiutang,COALESCE(b.saldo_awal,0) as saldoAwal,COALESCE(c.totalPiutang,0) as totalPiutang from tb_akun a 
        join (select id_akun,saldo_awal from tb_saldo where id_akun = (select id_akun from tb_linkacc where keterangan_link = 'Akun Piutang')) b on b.id_akun = a.id_akun 
        left join (select id_akun,sum(saldo_jurnal) AS totalPiutang from tb_jurnal where id_akun = (select id_akun from tb_linkacc where keterangan_link = 'Akun Piutang') and jenis_transaksi = 'Piutang Awal') c on c.id_akun = a.id_akun")->row_array();
        // Load view
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Customer/formEditPiutangAwal', $data);
        $this->load->view('template/footer');
        // var_dump($where);
    }

    public function prosesEditPiutangAwal()
    {
        $setting = $this->input->post('kode_transaksi');
        $this->form_validation->set_rules('nomor_invoice', $setting, 'required');
        $this->form_validation->set_rules('tanggal_transaksi', 'Tanggal Transaksi', 'required');
        $this->form_validation->set_rules('akun_penerimaan', 'Akun Penerimaan', 'required');
        $this->form_validation->set_rules('id_customer', 'Customer', 'required');
        $this->form_validation->set_rules('memo', 'Memo', 'required');
        $this->form_validation->set_rules('id_barang[]', 'Barang', 'required');
        $this->form_validation->set_rules('qty[]', 'Quantity', 'required');
        $this->form_validation->set_message('required', '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $kode_jurnal = $this->input->post('nomor_invoice');
            $tanggal = $this->input->post('tanggal_transaksi');
            $where = array('kode_jurnal' => $kode_jurnal);
            $where2 = array('tanggal_transaksi' => $tanggal);
            $kondisi = $kode_jurnal;
            $data['setting'] = $this->M_profil->getSetting()->result();
            // profil perusahaan
            $data['profil'] = $this->M_profil->getProfil()->result();
            // Data Invoice,tanggal,memo
            $data['single'] = $this->M_jurnal->getData($where)->result();
            // Data ID Jurnal
            $data['jurnal'] = $this->M_jurnal->getIDjurnal($where, $where2)->result();
            // Daftat Customer
            $data['cust'] = $this->M_customer->getCust()->result();
            //Data Customer di Pilih
            $data['customer'] = $this->M_transaksi->getDataCustomer($where)->result();
            //data barang
            $data['barang'] = $this->M_barang->getData()->result();
            // List barang yang dibeli
            $data['listBarang'] = $this->M_transaksi->getListBarangJual($where)->result();
            // jumlah bayar
            $data['jumlahTerima'] = $this->M_transaksi->getJumlahTerima($kondisi)->result();
            // Get akun bayar
            $data['getAkunTerima'] = $this->M_transaksi->getAkunPenerimaanSelected($where)->result();
            // // Link account pembayaran
            // $data['bayar'] = $this->db->query('select id_akun from tb_linkacc where keterangan="Akun Penerimaan"')->result();
            $data['akunTerima'] = $this->M_transaksi->getAkunPenerimaan()->result();
            // Link Account utang
            $data['piutang'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Piutang"')->result();
            // Link account persediaan barang
            $data['persediaan'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Persediaan (Jual)"')->result();
            $data['hpp'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun HPP"')->result();
            $data['penjualan'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Penjualan"')->result();
            $data['batasPiutang'] = $this->db->query("SELECT nama_akun, COALESCE(b.saldo_awal - c.totalPiutang,0) as batasPiutang,COALESCE(b.saldo_awal,0) as saldoAwal,COALESCE(c.totalPiutang,0) as totalPiutang from tb_akun a 
            join (select id_akun,saldo_awal from tb_saldo where id_akun = (select id_akun from tb_linkacc where keterangan_link = 'Akun Piutang')) b on b.id_akun = a.id_akun 
            left join (select id_akun,sum(saldo_jurnal) AS totalPiutang from tb_jurnal where id_akun = (select id_akun from tb_linkacc where keterangan_link = 'Akun Piutang') and jenis_transaksi = 'Piutang Awal') c on c.id_akun = a.id_akun")->row_array();
            // Load view
            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Penjualan/formEditPenjualan', $data);
            $this->load->view('template/footer');
        } else {
            // Kedua Tabel
            $kode_jurnal = $this->input->post('nomor_invoice');

            // Tabel Jurnal
            $id_jurnal = $this->input->post('id_jurnal');
            $tanggal_transaksi = $this->input->post('tanggal_transaksi');
            $memo = $this->input->post('memo');
            $saldo = $this->input->post('saldo');
            $posisi = $this->input->post('posisi');
            $id_akun = $this->input->post('id_akun');
            $jenis_transaksi = $this->input->post('jenis_transaksi');

            // Tabel Transaksi
            $id_transaksi = $this->input->post('id_transaksi');
            $id_pegawai = $this->input->post('id_pegawai');
            $id_customer = $this->input->post('id_customer');
            $id_barang = $this->input->post('id_barang');
            $qty = $this->input->post('qty');
            $diskon = $this->input->post('diskon');
            $total = $this->input->post('total');
            $total_hpp = $this->input->post('total_hpp');

            $data = array();

            foreach ($id_jurnal as $jur => $jurnal) {
                array_push($data, array(
                    'id_jurnal' => $jurnal,
                    'kode_jurnal' => $kode_jurnal,
                    'tanggal_transaksi' => $tanggal_transaksi,
                    'jenis_transaksi'   => $jenis_transaksi,
                    'memo' => $memo,
                    'id_akun' => $id_akun[$jur],
                    'posisi' => $posisi[$jur],
                    'saldo_jurnal' => $saldo[$jur]
                ));
            }

            $trans = array();

            foreach ($id_transaksi as $tr => $transaksi) {
                array_push($trans, array(
                    'id_transaksijual' => $transaksi,
                    'kode_jurnal' => $kode_jurnal,
                    'id_barang' => $id_barang[$tr],
                    'id_user' => $id_pegawai,
                    'id_customer' => $id_customer,
                    'qty_jual' => $qty[$tr],
                    'diskon_jual' => $diskon[$tr],
                    'total_jual' => $total[$tr],
                    'total_hpp' => $total_hpp[$tr]
                ));
            }

            // var_dump($trans);
            $this->db->update_batch('tb_jurnal', $data, 'id_jurnal');
            $this->db->update_batch('tb_transaksijual', $trans, 'id_transaksijual');
            $this->session->set_flashdata('Success', 'Data Berhasil Disimpan');
            $this->M_coa->sumLevel3();
            $referred_from = $this->session->userdata('referred_from');
            redirect($referred_from, 'refresh');
        }
    }

    public function deletePiutangAwal($kode_jurnal, $tanggal)
    {
        $this->db->query("DELETE a.*,b.*,c.* from tb_transaksijual a
        join tb_jurnal b on b.kode_jurnal = a.kode_jurnal
        left join tb_returjual c on c.kode_jurnal = a.kode_jurnal
        where a.kode_jurnal = '$kode_jurnal' and b.tanggal_transaksi = '$tanggal'");
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('Success', 'Data Berhasil Dihapus');
            $this->M_coa->sumLevel3();
            $referred_from = $this->session->userdata('referred_from');
            redirect($referred_from, 'refresh');
        } else {
            $this->session->set_flashdata('Success', 'Data Gagal Dihapus');
            $referred_from = $this->session->userdata('referred_from');
            redirect($referred_from, 'refresh');
        }
    }
}
