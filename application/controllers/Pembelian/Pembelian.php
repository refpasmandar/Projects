<?php
defined('BASEPATH') or exit('No Direct Script Access Allowed');

class Pembelian extends CI_Controller
{

    public function formPembelian()
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
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Pembelian/formPembelian', $data);
        $this->load->view('template/footer');
    }

    public function get_namaproduk()
    {
        $id = $this->input->post('id');
        $data = $this->M_transaksi->get_namaproduk($id);
        echo json_encode($data);
    }

    public function tambahPembelian()
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
            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Pembelian/formPembelian', $data);
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
            $status = $this->input->post('status');

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
                    'saldo_jurnal' => $saldo[$key],
                    'status' => $status
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
                $this->session->set_flashdata('Success', 'Pembelian berhasil ditambahkan');
                $this->M_coa->sumLevel3();
                redirect('Pembelian/Pembelian/formPembelian');
            } else {
                redirect('Pembelian/Pembelian/formPembelian');
            }
        }
    }

    public function editPembelian($invoice, $tgl)
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
        // Load view
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Pembelian/formEditPembelian', $data);
        $this->load->view('template/footer');
        // var_dump($where);
    }

    public function prosesEditPembelian()
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
            $where2 = array('tanggal_transaksi' => $tanggal);
            $kondisi = $kode_jurnal;
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
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('Success', 'Data Berhasil Disimpan');
                $this->M_coa->sumLevel3();
                $referred_from = $this->session->userdata('referred_from');
                redirect($referred_from, 'refresh');
            } else {
                $referred_from = $this->session->userdata('referred_from');
                redirect($referred_from, 'refresh');
            }
        }
    }

    public function deletePembelian($kode_jurnal)
    {
        $this->db->query("DELETE a.*,b.*,c.* from tb_transaksibeli a
        join tb_jurnal b on b.kode_jurnal = a.kode_jurnal
        left join tb_returbeli c on c.kode_jurnal = a.kode_jurnal
        where a.kode_jurnal = '$kode_jurnal'");
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

    public function daftarPembelian()
    {
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['all'] = $this->M_transaksi->getAllSupBeli()->result();

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Pembelian/daftarTransaksiSupplier', $data);
        $this->load->view('template/footer');
    }

    public function daftarSupplierUtang()
    {
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['all'] = $this->M_transaksi->getAllSupBeli()->result();

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Pembelian/daftarSupplierUtang', $data);
        $this->load->view('template/footer');
    }

    public function daftarSupplierLunas()
    {
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['all'] = $this->M_transaksi->getAllSupBeli()->result();

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Pembelian/daftarSupplierLunas', $data);
        $this->load->view('template/footer');
    }

    public function detailPembelian($id_supplier)
    {
        $where = $id_supplier;

        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['testing'] = $this->M_transaksi->getDetailPembelian($where)->result();
        $data['namasupp'] = $this->M_transaksi->getNamaSupplier($where)->result();
        $data['setting'] = $this->M_profil->getSetting()->result();

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Pembelian/detailPembelian', $data);
        $this->load->view('template/footer');

        $this->session->set_userdata('detailPembelian', current_url());
    }

    public function detailTransaksiPembelian($kode_jurnal, $tgl)
    {
        $where = array('kode_jurnal' => $kode_jurnal);
        $kondisi = $kode_jurnal;
        $where2 = array('tanggal_transaksi' => $tgl);

        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['setting'] = $this->M_profil->getSetting()->result();
        $data['barang'] = $this->M_barang->getData();
        $data['supplier'] = $this->M_supplier->getSupplier();
        $data['jurnal'] = $this->M_jurnal->getData($where, $where2)->result();
        $data['getDataPegawai'] = $this->M_transaksi->getDataPegawai($kondisi)->result();
        $data['listBarang'] = $this->M_transaksi->getListBarangBeliDetail($kondisi)->result();
        // $data['bayar'] = $this->Admin_model->getJumlahBayar($kondisi, $where2)->result();
        $data['total'] = $this->M_transaksi->getGrandTotal($kondisi)->result();
        // $data['utang'] = $this->Admin_model->getSelisih($kondisi)->result();
        $data['detailInvoice'] = $this->M_transaksi->getDetailInvoicePembelian($kondisi)->result();

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Pembelian/detailInvoicePembelian', $data);
        $this->load->view('template/footer');
        $this->session->set_userdata('detailInvoice', current_url());
    }

    public function bayarUtang($kode_jurnal)
    {
        $where = array('kode_jurnal' => $kode_jurnal);
        $kondisi = $kode_jurnal;
        // $where2 = array('tgl_transaksi' => $tgl);

        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['akunUtang'] = $this->M_transaksi->getAkunUtang()->result();
        $data['setting'] = $this->M_profil->getSetting()->result();
        $data['akunBayar'] = $this->M_transaksi->getAkunPembayaran()->result();
        $data['total'] = $this->M_transaksi->getGrandTotal($kondisi)->result();
        $data['detailInvoice'] = $this->M_transaksi->getDetailInvoicePembelian($kondisi)->result();

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Pembelian/bayarUtang', $data);
        $this->load->view('template/footer');
    }

    public function prosesBayarUtang()
    {
        $this->form_validation->set_rules('tanggal_transaksi', 'Tanggal Transaksi', 'required');
        $this->form_validation->set_rules('memo', 'Keterangan', 'required');
        $this->form_validation->set_rules('id_akun[]', 'Akun', 'required');

        $this->form_validation->set_message('required', '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $kondisi = $this->input->post('kode_jurnal');
            $data['profil'] = $this->M_profil->getProfil()->result();
            $data['akunUtang'] = $this->M_transaksi->getAkunUtang()->result();
            $data['setting'] = $this->M_profil->getSetting()->result();
            $data['akunBayar'] = $this->M_transaksi->getAkunPembayaran()->result();
            $data['total'] = $this->M_transaksi->getGrandTotal($kondisi)->result();
            $data['detailInvoice'] = $this->M_transaksi->getDetailInvoicePembelian($kondisi)->result();


            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Pembelian/bayarUtang', $data);
            $this->load->view('template/footer');
        } else {

            $id_akun            = $this->input->post('id_akun');
            $kode_jurnal        = $this->input->post('kode_jurnal');
            $keterangan         = $this->input->post('memo');
            $tgl_transaksi      = $this->input->post('tanggal_transaksi');
            $posisi             = $this->input->post('posisi');
            $saldo_jurnal       = $this->input->post('saldo');
            $jenis_transaksi    = $this->input->post('jenis_transaksi');
            $status             = $this->input->post('status');

            $data = array();

            foreach ($id_akun as $akun => $id_akun) {

                array_push($data, array(
                    'kode_jurnal' => $kode_jurnal,
                    'id_akun' => $id_akun,
                    'memo' => $keterangan,
                    'tanggal_transaksi' => $tgl_transaksi,
                    'jenis_transaksi' => $jenis_transaksi,
                    'posisi' => $posisi[$akun],
                    'saldo_jurnal' => $saldo_jurnal[$akun],
                    'status' => $status
                ));
            }

            $this->M_jurnal->addJurnal($data, 'tb_jurnal');
            if ($this->db->affected_rows() > 0) {
                $this->M_coa->sumLevel3();
                $this->session->set_flashdata('Success', 'Utang Berhasil Dibayarkan');
                $referred_from = $this->session->userdata('detailInvoice');
                redirect($referred_from, 'refresh');
            } else {
                redirect('Pembelian/Pembelian/bayarUtang');
                $this->session->set_flashdata('Success', 'Utang Gagal Dibayarkan');
            }
        }
    }

    public function deleteBayarUtang($kode_jurnal, $tanggal)
    {
        $this->db->query("DELETE from tb_jurnal
        where kode_jurnal = '$kode_jurnal' and tanggal_transaksi = '$tanggal' and jenis_transaksi = 'Bayar Utang'");
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

    public function daftarReturBeli()
    {
        $data['profil']     = $this->M_profil->getProfil()->result();
        $data['supplier']   = $this->M_transaksi->getSupplierRetur()->result();

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Pembelian/daftarSupplierReturBeli', $data);
        $this->load->view('template/footer');
    }

    public function invoiceReturBeli($id_supplier)
    {
        $where = $id_supplier;
        $data['profil']     = $this->M_profil->getProfil()->result();
        $data['invoiceRetur'] = $this->M_transaksi->getInvoiceReturPembelian($where)->result();
        $data['namasupp'] = $this->M_transaksi->getSupplierRetur($where)->result();
        $data['setting'] = $this->M_profil->getSetting()->result();

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Pembelian/daftarInvoiceReturBeli', $data);
        $this->load->view('template/footer');
    }

    public function detailInvoiceReturPembelian($kode_jurnal, $tanggal_transaksi)
    {
        $where = array('kode_jurnal' => $kode_jurnal);
        $where2 = array('tanggal_transaksi' => $tanggal_transaksi);
        $kondisi = $kode_jurnal;
        $tgl = $tanggal_transaksi;
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['setting'] = $this->M_profil->getSetting()->result();
        $data['barang'] = $this->M_barang->getData();
        $data['supplier'] = $this->M_supplier->getSupplier();
        $data['jurnal'] = $this->M_jurnal->getData($where, $where2)->result();
        $data['getDataPegawai'] = $this->M_transaksi->getDataPegawai($kondisi)->result();
        $data['listRetur'] = $this->M_transaksi->getListBarangReturBeli($kondisi, $tgl)->result();

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Pembelian/detailInvoiceReturBeli', $data);
        $this->load->view('template/footer');
    }

    public function returBeli($invoice, $tgl)
    {
        $where = array('kode_jurnal' => $invoice);
        $kondisi = $invoice;
        $tanggal = $tgl;
        $where2 = array('tanggal_transaksi' => $tgl);

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
        $data['listBarang'] = $this->M_transaksi->getListBarangBeliDetail($kondisi)->result();
        // jumlah bayar
        $data['jumlahBayar'] = $this->M_transaksi->getJumlahBayar($kondisi, $tanggal)->result();
        // Get akun bayar
        $data['getAkunBayar'] = $this->M_transaksi->getAkunPembayaranRetur($where)->result();
        // Link account pembayaran
        // $data['bayar'] = $this->db->query('select id_akun from tb_linkacc where keterangan="Akun Pembayaran"')->result();
        $data['akunBayar'] = $this->M_transaksi->getAkunPembayaran()->result();
        // Link Account utang
        $data['utang'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Utang"')->result();
        // Link account persediaan barang
        $data['persediaan'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Persediaan (Beli)"')->result();
        // Kondisi Akun Retur
        $data['jumlahUtang'] = $this->M_transaksi->getDetailInvoicePembelian($kondisi)->result();
        $data['tanggal'] = $tanggal;

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Pembelian/formReturPembelian', $data);
        $this->load->view('template/footer');
    }

    public function prosesReturBeli()
    {
        $this->form_validation->set_rules('tanggal_transaksi', 'Tanggal Transaksi', 'required');
        $this->form_validation->set_rules('memo', 'Memo', 'required');
        $this->form_validation->set_rules('qty[]', 'Quantity', 'required');
        $this->form_validation->set_rules('id_akun[]', 'Akun', 'required');

        $this->form_validation->set_message('required', '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $kondisi = $this->input->post('nomor_invoice');
            $where = array('kode_jurnal' => $kondisi);
            $tanggal = $this->input->post('tanggal_beli');;
            $where2 = array('tanggal_transaksi' => $tanggal);

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
            $data['listBarang'] = $this->M_transaksi->getListBarangBeliDetail($kondisi)->result();
            // jumlah bayar
            $data['jumlahBayar'] = $this->M_transaksi->getJumlahBayar($kondisi, $tanggal)->result();
            // Get akun bayar
            $data['getAkunBayar'] = $this->M_transaksi->getAkunPembayaranRetur($where)->result();
            // Link account pembayaran
            // $data['bayar'] = $this->db->query('select id_akun from tb_linkacc where keterangan="Akun Pembayaran"')->result();
            $data['akunBayar'] = $this->M_transaksi->getAkunPembayaran()->result();
            // Link Account utang
            $data['utang'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Utang"')->result();
            // Link account persediaan barang
            $data['persediaan'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Persediaan (Beli)"')->result();
            // Kondisi Akun Retur
            $data['jumlahUtang'] = $this->M_transaksi->getDetailInvoicePembelian($kondisi)->result();
            $data['tanggal'] = $tanggal;

            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Pembelian/formReturPembelian', $data);
            $this->load->view('template/footer');
        } else {
            $kode_jurnal = $this->input->post('nomor_invoice');
            $tanggal_transaksi = $this->input->post('tanggal_transaksi');
            $memo = $this->input->post('memo');
            $saldo = $this->input->post('saldo');
            $posisi = $this->input->post('posisi');
            $id_akun = $this->input->post('id_akun');
            $jenis_transaksi = $this->input->post('jenis_transaksi');
            $status = $this->input->post('status');


            $id_pegawai = $this->input->post('id_pegawai');
            $id_supplier = $this->input->post('id_supplier');
            $id_barang = $this->input->post('id_barang');
            $qty = $this->input->post('qty');
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
                    'saldo_jurnal' => $saldo[$key],
                    'status' => $status
                ));
            }

            $trans = array();

            foreach ($id_barang as $brg => $barang) {
                array_push($trans, array(
                    'kode_jurnal' => $kode_jurnal,
                    'id_barang' => $barang,
                    'id_user' => $id_pegawai,
                    'id_supplier' => $id_supplier,
                    'qty_returbeli' => $qty[$brg],
                    'tanggal_returbeli' => $tanggal_transaksi,
                    'total_returbeli' => $total[$brg]
                ));
            }

            $this->db->insert_batch('tb_jurnal', $data);
            $this->db->insert_batch('tb_returbeli', $trans);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('Success', 'Retur Berhasil Ditambahkan');
                $this->M_coa->sumLevel3();
                $referred_from = $this->session->userdata('detailInvoice');
                redirect($referred_from, 'refresh');
            } else {
                redirect('Pembelian/Pembelian/daftarReturBeli');
            }
        }
    }

    public function editReturPembelian($invoice, $tgl)
    {
        $where = array('kode_jurnal' => $invoice);
        $where3 = array(
            'tb_returbeli.kode_jurnal' => $invoice,
            'tb_returbeli.tanggal_returbeli' => $tgl
        );
        $kondisi = $invoice;
        $tanggal = $tgl;
        $where2 = array('tanggal_transaksi' => $tgl);

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
        $data['listBarang'] = $this->M_transaksi->getDaftarReturBeli($kondisi, $tanggal)->result();
        // jumlah bayar
        $data['jumlahBayar'] = $this->M_transaksi->getJumlahBayar($kondisi, $tanggal)->result();
        // Get akun bayar
        $data['getAkunBayar'] = $this->M_transaksi->getAkunPembayaranRetur($where)->result();
        // Link account pembayaran
        // $data['bayar'] = $this->db->query('select id_akun from tb_linkacc where keterangan="Akun Pembayaran"')->result();
        $data['akunBayar'] = $this->M_transaksi->getAkunPembayaran()->result();
        // Link Account utang
        $data['utang'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Utang"')->result();
        // Link account persediaan barang
        $data['persediaan'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Persediaan (Beli)"')->result();
        // Kondisi Akun Retur
        $data['jumlahUtang'] = $this->M_transaksi->getDetailInvoicePembelian($kondisi)->result();
        $data['tanggal'] = $tanggal;

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Pembelian/formEditReturBeli', $data);
        $this->load->view('template/footer');
    }

    public function prosesEditReturBeli()
    {
        $this->form_validation->set_rules('tanggal_transaksi', 'Tanggal Transaksi', 'required');
        $this->form_validation->set_rules('memo', 'Memo', 'required');
        $this->form_validation->set_rules('qty[]', 'Quantity', 'required');
        $this->form_validation->set_rules('id_akun[]', 'Akun', 'required');

        $this->form_validation->set_message('required', '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $kondisi = $this->input->post('nomor_invoice');
            $tanggal = $this->input->post('tanggal_transaksi');
            $where = array('kode_jurnal' => $kondisi);
            $where2 = array('tanggal_transaksi' => $tanggal);
            $where3 = array(
                'tb_returbeli.kode_jurnal' => $kondisi,
                'tb_returbeli.tanggal_returbeli' => $tanggal
            );

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
            $data['listBarang'] = $this->M_transaksi->getDaftarReturBeli($kondisi, $tanggal)->result();
            // jumlah bayar
            $data['jumlahBayar'] = $this->M_transaksi->getJumlahBayar($kondisi, $tanggal)->result();
            // Get akun bayar
            $data['getAkunBayar'] = $this->M_transaksi->getAkunPembayaranRetur($where)->result();
            // Link account pembayaran
            // $data['bayar'] = $this->db->query('select id_akun from tb_linkacc where keterangan="Akun Pembayaran"')->result();
            $data['akunBayar'] = $this->M_transaksi->getAkunPembayaran()->result();
            // Link Account utang
            $data['utang'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Utang"')->result();
            // Link account persediaan barang
            $data['persediaan'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Persediaan (Beli)"')->result();
            // Kondisi Akun Retur
            $data['jumlahUtang'] = $this->M_transaksi->getDetailInvoicePembelian($kondisi)->result();
            $data['tanggal'] = $tanggal;

            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Pembelian/formEditReturBeli', $data);
            $this->load->view('template/footer');
        } else {
            $id_jurnal = $this->input->post('id_jurnal');
            $kode_jurnal = $this->input->post('nomor_invoice');
            $tanggal_transaksi = $this->input->post('tanggal_transaksi');
            $memo = $this->input->post('memo');
            $saldo = $this->input->post('saldo');
            $posisi = $this->input->post('posisi');
            $id_akun = $this->input->post('id_akun');
            $jenis_transaksi = $this->input->post('jenis_transaksi');


            $id_transaksi = $this->input->post('id_transaksi');
            $id_pegawai = $this->input->post('id_pegawai');
            $id_supplier = $this->input->post('id_supplier');
            $id_barang = $this->input->post('id_barang');
            $qty = $this->input->post('qty');
            $total = $this->input->post('total');

            $data = array();

            foreach ($id_jurnal as $id => $jurnal) {
                array_push($data, array(
                    'id_jurnal' => $jurnal,
                    'id_akun' => $id_akun[$id],
                    'kode_jurnal' => $kode_jurnal,
                    'tanggal_transaksi' => $tanggal_transaksi,
                    'jenis_transaksi'   => $jenis_transaksi,
                    'memo' => $memo,
                    'posisi' => $posisi[$id],
                    'saldo_jurnal' => $saldo[$id]
                ));
            }

            $trans = array();

            foreach ($id_transaksi as $id => $transaksi) {
                array_push($trans, array(
                    'id_returbeli' => $transaksi,
                    'kode_jurnal' => $kode_jurnal,
                    'id_barang' => $id_barang[$id],
                    'id_user' => $id_pegawai,
                    'id_supplier' => $id_supplier,
                    'qty_returbeli' => $qty[$id],
                    'tanggal_returbeli' => $tanggal_transaksi,
                    'total_returbeli' => $total[$id]
                ));
            }

            $this->db->update_batch('tb_jurnal', $data, 'id_jurnal');
            $this->db->update_batch('tb_returbeli', $trans, 'id_returbeli');
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('Success', 'Retur Berhasil Ditambahkan');
                $this->M_coa->sumLevel3();
                $referred_from = $this->session->userdata('referred_from');
                redirect($referred_from, 'refresh');
            } else {
                redirect('Pembelian/Pembelian/daftarReturBeli');
            }
        }
    }

    public function deleteReturPembelian($kode_jurnal, $tanggal)
    {
        $this->db->query("DELETE a.*,b.* from tb_returbeli a
        join tb_jurnal b on b.kode_jurnal = a.kode_jurnal
        where a.kode_jurnal = '$kode_jurnal' and b.tanggal_transaksi = '$tanggal' and b.jenis_transaksi = 'Retur Pembelian'");
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

    public function editBayarUtang($kode_jurnal, $tanggal)
    {
        $where = array('kode_jurnal' => $kode_jurnal);
        $kondisi = $kode_jurnal;

        $where2 = array('tanggal_transaksi' => $tanggal);

        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['detailInvoice'] = $this->M_transaksi->getDetailInvoicePembelian($kondisi)->result();
        $data['single'] = $this->M_jurnal->getData($where, $where2)->result();
        // $data['jurnal'] = $this->Admin_model->getEditBayarUtang($where, $where2)->result();
        $data['getAkunBayar'] = $this->M_transaksi->getAkunPembayaranutang($where, $where2)->result();
        $data['akunBayar'] = $this->M_transaksi->getAkunPembayaran()->result();
        $data['akunUtang'] = $this->M_transaksi->getAkunUtangEdit($where, $where2)->result();
        $data['setting'] = $this->M_profil->getSetting()->result();

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Pembelian/formEditBayarUtang', $data);
        $this->load->view('template/footer');
    }

    public function prosesEditBayarUtang()
    {
        $this->form_validation->set_rules('memo', 'Memo', 'required');
        $this->form_validation->set_rules('tanggal_transaksi', 'Tanggal Transaksi', 'required');
        $this->form_validation->set_rules('id_akun[]', 'Akun', 'required');

        $this->form_validation->set_message('required', '%s Tidak Boleh Kosong');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $kode_jurnal = $this->input->post('kode_jurnal');
            $where = array('kode_jurnal' => $kode_jurnal);
            $kondisi = $kode_jurnal;
            $tanggal = $this->input->post('tanggal_transaksi');
            $where2 = array('tanggal_transaksi' => $tanggal);

            $data['profil'] = $this->M_profil->getProfil()->result();
            $data['detailInvoice'] = $this->M_transaksi->getDetailInvoicePembelian($kondisi)->result();
            $data['single'] = $this->M_jurnal->getData($where, $where2)->result();
            // $data['jurnal'] = $this->Admin_model->getEditBayarUtang($where, $where2)->result();
            $data['getAkunBayar'] = $this->M_transaksi->getAkunPembayaranutang($where, $where2)->result();
            $data['akunBayar'] = $this->M_transaksi->getAkunPembayaran()->result();
            $data['akunUtang'] = $this->M_transaksi->getAkunUtangEdit($where, $where2)->result();

            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Pembelian/formEditBayarUtang', $data);
            $this->load->view('template/footer');
        } else {
            $id_akun        = $this->input->post('id_akun');
            $id_jurnal      = $this->input->post('id_jurnal');
            $kode_jurnal        = $this->input->post('kode_jurnal');
            $memo      = $this->input->post('memo');
            $tgl_transaksi     = $this->input->post('tanggal_transaksi');
            $posisi         = $this->input->post('posisi');
            $saldo_jurnal         = $this->input->post('saldo');
            $jenis_transaksi         = $this->input->post('jenis_transaksi');

            $data           = array();

            foreach ($id_jurnal as $id => $jurnal) {

                array_push($data, array(
                    'id_jurnal' => $jurnal,
                    'kode_jurnal' => $kode_jurnal,
                    'id_akun' => $id_akun[$id],
                    'memo' => $memo,
                    'tanggal_transaksi' => $tgl_transaksi,
                    'jenis_transaksi' => $jenis_transaksi,
                    'posisi' => $posisi[$id],
                    'saldo_jurnal' => $saldo_jurnal[$id]
                ));
            }

            // var_dump($data);

            $this->db->update_batch('tb_jurnal', $data, 'id_jurnal');
            if ($this->db->affected_rows() > 0) {
                $this->M_coa->sumLevel3();
                $this->session->set_flashdata('Success', 'Pembyaran Utang Berhasil Diubah');
                $referred_from = $this->session->userdata('referred_from');
                redirect($referred_from, 'refresh');
            } else {
                redirect("Laporan/Pembelian/prosesEditBayarUtang");
            }
        }
    }
}
