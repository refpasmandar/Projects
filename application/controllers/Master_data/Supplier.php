<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // check_admin();
        check_not_login();
    }

    public function daftarSupplier()
    {
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['supp'] = $this->M_supplier->getSupplier()->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Supplier/v_supplier', $data);
        $this->load->view('template/footer');
    }

    public function tambahSupplier()
    {
        $data['profil'] = $this->M_profil->getProfil()->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Supplier/tambah_supplier');
        $this->load->view('template/footer');
    }

    public function prosesTambah()
    {
        $this->form_validation->set_rules('nama_supplier', 'Nama Supplier', 'required|is_unique[tb_supplier.nama_supplier]|max_length[25]');
        $this->form_validation->set_rules('kode_supp', 'Kode Supplier', 'required|is_unique[tb_supplier.kode_supplier]|min_length[2]|max_length[10]');
        $this->form_validation->set_rules('no_telp', 'Nomor Telepon Supplier', 'required|max_length[13]');
        $this->form_validation->set_rules('alamat', 'Alamat Supplier', 'required|max_length[50]');
        $this->form_validation->set_rules('email', 'Email Supplier', 'required|max_length[30]');

        $this->form_validation->set_message('required', '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_message('is_unique', '%s Sudah Ada');
        $this->form_validation->set_message('min_length', '%s Minimal %d Karakter');
        $this->form_validation->set_message('max_length', '%s Maksimal %d Karakter');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $data['profil'] = $this->M_profil->getProfil()->result();
            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Supplier/tambah_supplier');
            $this->load->view('template/footer');
        } else {
            $nama_supplier = $this->input->post('nama_supplier');
            $no_telp = $this->input->post('no_telp');
            $alamat = $this->input->post('alamat');
            $email = $this->input->post('email');
            $kode_supp = $this->input->post('kode_supp');

            $data = array(
                'nama_supplier'     => $nama_supplier,
                'kode_supplier'     => $kode_supp,
                'telp_supplier'     => $no_telp,
                'alamat_supplier'   => $alamat,
                'email_supplier'    => $email
            );

            $this->M_supplier->addSupplier($data, 'tb_supplier');
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('Success', 'Supplier berhasil ditambahkan');
                redirect('Master_data/Supplier/daftarSupplier');
            } else {
                redirect('Master_data/Supplier/daftarSupplier');
            }
        }
    }

    public function editSupplier($id)
    {
        $where = array('id_supplier' => $id);
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['supp'] = $this->M_supplier->editSupplier($where, 'tb_supplier')->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Supplier/edit_supplier', $data);
        $this->load->view('template/footer');
    }

    public function prosesEdit()
    {
        $this->form_validation->set_rules('kode_supp', 'Kode Supplier', 'required|min_length[2]|max_length[10]|callback_KodeCheck');
        $this->form_validation->set_rules('nama_supplier', 'Nama Supplier', 'required|max_length[25]|callback_NamaCheck');
        $this->form_validation->set_rules('no_telp', 'Nomor Telepon Supplier', 'required|max_length[13]');
        $this->form_validation->set_rules('alamat', 'Alamat Supplier', 'required|max_length[50]');
        $this->form_validation->set_rules('email', 'Email Supplier', 'required|max_length[25]');

        $this->form_validation->set_message('min_length', '%s Minimal %d Karakter');
        $this->form_validation->set_message('max_length', '%s Maksimal %d Karakter');
        $this->form_validation->set_message('required', '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $id = $this->input->post('id_supplier');
            $where = array('id_supplier' => $id);
            $data['profil'] = $this->M_profil->getProfil()->result();
            $data['supp'] = $this->M_supplier->editSupplier($where, 'tb_supplier')->result();
            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Supplier/edit_supplier', $data);
            $this->load->view('template/footer');
        } else {
            $id_supplier   = $this->input->post('id_supplier');
            $kode_supp = $this->input->post('kode_supp');
            $nama_supplier = $this->input->post('nama_supplier');
            $no_telp = $this->input->post('no_telp');
            $alamat = $this->input->post('alamat');
            $email = $this->input->post('email');

            $data = array(
                'nama_supplier'     => $nama_supplier,
                'kode_supplier'     => $kode_supp,
                'telp_supplier'     => $no_telp,
                'alamat_supplier'   => $alamat,
                'email_supplier'    => $email
            );

            $where = array('id_supplier' => $id_supplier);

            $this->M_supplier->updateSupplier($where, $data, 'tb_supplier');
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('Success', 'Supplier berhasil diubah');
                redirect('Master_data/Supplier/daftarSupplier');
            } else {
                redirect('Master_data/Supplier/daftarSupplier');
            }
        }
    }

    public function deleteSupplier($id)
    {
        $where = array('id_supplier' => $id);
        $this->M_supplier->deleteSupplier($where, 'tb_supplier');
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('Success', 'Supplier Berhasil Dihapus');
            redirect('Master_data/Supplier/daftarSupplier');
        } else {
            redirect('Master_data/Supplier/daftarSupplier');
        }
    }

    function KodeCheck()
    {
        $post = $this->input->post(null, true);
        $query = $this->db->query("select * from tb_supplier where kode_supplier = '$post[kode_supp]' AND id_supplier != '$post[id_supplier]'");
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
        $query = $this->db->query("select * from tb_supplier where nama_supplier = '$post[nama_supplier]' AND id_supplier != '$post[id_supplier]'");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('NamaCheck', '%s ini sudah dipakai');
            return false;
        } else {
            return true;
        }
    }

    public function tambahUtangAwal()
    {
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['barang'] = $this->M_barang->getData()->result();
        $data['supp'] = $this->M_supplier->getSupplier()->result();
        $data['coa'] = $this->M_coa->getCoa()->result();
        $data['setting'] = $this->M_profil->getSetting()->result();
        // $data['bayar'] = $this->db->query('select id_akun from tb_linkacc where keterangan="Akun Pembayaran"')->result();
        $data['akunBayar'] = $this->M_transaksi->getAkunPembayaran()->result();
        $data['utang'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Utang"')->result();
        $data['persediaan'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Persediaan (Beli)"')->result();
        $data['batasUtang'] = $this->db->query("SELECT nama_akun, COALESCE(b.saldo_awal - c.totalUtang,0) as batasUtang,COALESCE(c.totalUtang,0) as totalUtang,b.saldo_awal from tb_akun a 
        join (select id_akun,saldo_awal from tb_saldo where id_akun = (select id_akun from tb_linkacc where keterangan_link = 'Akun Utang')) b on b.id_akun = a.id_akun 
        left join (select id_akun,sum(saldo_jurnal) AS totalUtang from tb_jurnal where id_akun = (select id_akun from tb_linkacc where keterangan_link = 'Akun Utang') and jenis_transaksi = 'Utang Awal') c on c.id_akun = a.id_akun")->row_array();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Supplier/formUtangAwal', $data);
        $this->load->view('template/footer');
    }

    public function prosesTambahUtangAwal()
    {
        $setting = $this->input->post('kode_transaksi');
        $this->form_validation->set_rules('nomor_invoice', $setting, 'required|is_unique[tb_jurnal.kode_jurnal]');
        $this->form_validation->set_rules('tanggal_transaksi', 'Tanggal Transaksi', 'required');
        $this->form_validation->set_rules('akun_pembayaran', 'Akun Pembayaran', 'required');
        $this->form_validation->set_rules('id_supplier', 'Supplier', 'required');
        $this->form_validation->set_rules('memo', 'Memo', 'required');
        $this->form_validation->set_rules('id_barang[]', 'Barang', 'required');
        $this->form_validation->set_rules('qty[]', 'Quantity', 'required');
        $this->form_validation->set_message('required', '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $data['profil'] = $this->M_profil->getProfil()->result();
            $data['barang'] = $this->M_barang->getData()->result();
            $data['supp'] = $this->M_supplier->getSupplier()->result();
            $data['coa'] = $this->M_coa->getCoa()->result();
            $data['setting'] = $this->M_profil->getSetting()->result();
            // $data['bayar'] = $this->db->query('select id_akun from tb_linkacc where keterangan="Akun Pembayaran"')->result();
            $data['akunBayar'] = $this->M_transaksi->getAkunPembayaran()->result();
            $data['utang'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Utang"')->result();
            $data['persediaan'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Persediaan (Beli)"')->result();
            $data['batasUtang'] = $this->db->query("SELECT nama_akun, COALESCE(b.saldo_awal - c.totalUtang,0) as batasUtang,COALESCE(c.totalUtang,0),b.saldo_awal from tb_akun a 
            join (select id_akun,saldo_awal from tb_saldo where id_akun = (select id_akun from tb_linkacc where keterangan_link = 'Akun Utang')) b on b.id_akun = a.id_akun 
            left join (select id_akun,sum(saldo_jurnal) AS totalUtang from tb_jurnal where id_akun = (select id_akun from tb_linkacc where keterangan_link = 'Akun Utang') and jenis_transaksi = 'Utang Awal') c on c.id_akun = a.id_akun")->row_array();
            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Supplier/formUtangAwal', $data);
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
            $id_supplier = $this->input->post('id_supplier');
            $id_barang = $this->input->post('id_barang');
            $qty = $this->input->post('qty');
            $diskon = $this->input->post('diskon');
            $total = $this->input->post('total');

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

            var_dump($data);

            $trans = array();

            foreach ($id_barang as $bar => $barang) {
                array_push($trans, array(
                    'kode_jurnal' => $kode_jurnal,
                    'id_barang' => $barang,
                    'qty_beli' => $qty[$bar],
                    'diskon_beli' => $diskon[$bar],
                    'total_beli' => $total[$bar],
                    'id_user' => $id_pegawai,
                    'id_supplier' => $id_supplier
                ));
            }

            $this->db->insert_batch('tb_jurnal', $data);
            $this->db->insert_batch('tb_transaksibeli', $trans);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('Success', 'Utang Awal Ditambahkan');
                $this->M_coa->sumLevel3();
                redirect('Master_data/Supplier/daftarSupplier');
            } else {
                redirect('Master_data/Supplier/daftarSupplier');
            }
        }
    }

    public function editUtangAwal($invoice, $tgl)
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
        //Data supplier
        $data['supplier'] = $this->M_transaksi->getDataSupplier($where)->result();
        //data barang sesuai supplier
        $data['barang'] = $this->M_barang->getDataBySupplier($kondisi)->result();
        //List supplier
        $data['supp'] = $this->M_supplier->getSupplier()->result();
        // List barang yang dibeli
        $data['listBarang'] = $this->M_transaksi->getListBarangBeli($where)->result();
        // jumlah bayar
        $data['jumlahBayar'] = $this->M_transaksi->getJumlahBayar($kondisi, $tanggal)->result();
        // Get akun bayar
        $data['getAkunBayar'] = $this->M_transaksi->getAkunPembayaranSelected($where)->result();
        // Link account pembayaran
        // $data['bayar'] = $this->db->query('select id_akun from tb_linkacc where keterangan="Akun Pembayaran"')->result();
        $data['akunBayar'] = $this->M_transaksi->getAkunPembayaran()->result();
        // Link Account utang
        $data['utang'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Utang"')->result();
        // Link account persediaan barang
        $data['persediaan'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Persediaan (Beli)"')->result();
        $data['batasUtang'] = $this->db->query("SELECT nama_akun, COALESCE(b.saldo_awal - c.totalUtang,0) as batasUtang,COALESCE(c.totalUtang,0),b.saldo_awal from tb_akun a 
        join (select id_akun,saldo_awal from tb_saldo where id_akun = (select id_akun from tb_linkacc where keterangan_link = 'Akun Utang')) b on b.id_akun = a.id_akun 
        left join (select id_akun,sum(saldo_jurnal) AS totalUtang from tb_jurnal where id_akun = (select id_akun from tb_linkacc where keterangan_link = 'Akun Utang') and jenis_transaksi = 'Utang Awal') c on c.id_akun = a.id_akun")->row_array();
        // Load view
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Supplier/formEditUtangAwal', $data);
        $this->load->view('template/footer');
        // var_dump($where);
    }

    public function prosesEditUtangAwal()
    {
        $setting = $this->input->post('kode_transaksi');
        $this->form_validation->set_rules('nomor_invoice', $setting, 'required');
        $this->form_validation->set_rules('tanggal_transaksi', 'Tanggal Transaksi', 'required');
        $this->form_validation->set_rules('akun_pembayaran', 'Akun Pembayaran', 'required');
        $this->form_validation->set_rules('id_supplier', 'Supplier', 'required');
        $this->form_validation->set_rules('memo', 'Memo', 'required');
        $this->form_validation->set_rules('id_barang[]', 'Barang', 'required');
        $this->form_validation->set_rules('qty[]', 'Quantity', 'required');
        $this->form_validation->set_message('required', '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $kode_jurnal = $this->input->post('nomor_invoice');
            $tanggal = $this->input->post('tanggal_transaksi');
            $where = array('kode_jurnal' => $kode_jurnal);
            $where2 = array('tanggal_transaksi' => $kode_jurnal);
            $kondisi = $kode_jurnal;
            // Settingan
            $data['setting'] = $this->M_profil->getSetting()->result();
            // profil perusahaan
            $data['profil'] = $this->M_profil->getProfil()->result();
            // Data Invoice,tanggal,memo
            $data['single'] = $this->M_jurnal->getData($where)->result();
            // Data ID Jurnal
            $data['jurnal'] = $this->AM_jurnal->getIDjurnal($where, $where2)->result();
            //Data supplier
            $data['supplier'] = $this->M_transaksi->getDataSupplier($where)->result();
            //data barang
            $data['barang'] = $this->M_barang->getData()->result();
            //List supplier
            $data['supp'] = $this->M_supplier->getSupplier()->result();
            // List barang yang dibeli
            $data['listBarang'] = $this->M_transaksi->getListBarangBeli($where)->result();
            // jumlah bayar
            $data['jumlahBayar'] = $this->M_transaksi->getJumlahBayar($kondisi)->result();
            // // Link account pembayaran
            // $data['bayar'] = $this->db->query('select id_akun from tb_linkacc where keterangan="Akun Pembayaran"')->result();
            // List Akun Pembayaran
            $data['akunBayar'] = $this->M_transaksi->getAkunPembayaran()->result();
            // Link Account utang
            $data['utang'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Utang"')->result();
            // Link account persediaan barang
            $data['persediaan'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Persediaan (Beli)"')->result();
            $data['batasUtang'] = $this->db->query("SELECT nama_akun, COALESCE(b.saldo_awal - c.totalUtang,0) as batasUtang,COALESCE(c.totalUtang,0),b.saldo_awal from tb_akun a 
            join (select id_akun,saldo_awal from tb_saldo where id_akun = (select id_akun from tb_linkacc where keterangan_link = 'Akun Utang')) b on b.id_akun = a.id_akun 
            left join (select id_akun,sum(saldo_jurnal) AS totalUtang from tb_jurnal where id_akun = (select id_akun from tb_linkacc where keterangan_link = 'Akun Utang') and jenis_transaksi = 'Utang Awal') c on c.id_akun = a.id_akun")->row_array();
            // Load view
            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Pembelian/formEditPembelian', $data);
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
            $id_supplier = $this->input->post('id_supplier');
            $id_barang = $this->input->post('id_barang');
            $qty = $this->input->post('qty');
            $diskon = $this->input->post('diskon');
            $total = $this->input->post('total');

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
                    'id_transaksibeli' => $transaksi,
                    'kode_jurnal' => $kode_jurnal,
                    'id_barang' => $id_barang[$tr],
                    'id_user' => $id_pegawai,
                    'id_supplier' => $id_supplier,
                    'qty_beli' => $qty[$tr],
                    'diskon_beli' => $diskon[$tr],
                    'total_beli' => $total[$tr]
                ));
            }

            // var_dump($trans);
            $this->db->update_batch('tb_jurnal', $data, 'id_jurnal');
            $this->db->update_batch('tb_transaksibeli', $trans, 'id_transaksibeli');
            $this->session->set_flashdata('Success', 'Data Berhasil Disimpan');
            $this->M_coa->sumLevel3();
            $referred_from = $this->session->userdata('referred_from');
            redirect($referred_from, 'refresh');
        }
    }

    public function deleteUtangAwal($kode_jurnal, $tanggal)
    {
        $this->db->query("DELETE a.*,b.*,c.* from tb_transaksibeli a
        join tb_jurnal b on b.kode_jurnal = a.kode_jurnal
        left join tb_returbeli c on c.kode_jurnal = a.kode_jurnal
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
