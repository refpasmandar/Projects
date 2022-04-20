<?php
defined('BASEPATH') or exit('No Direct Script Access Allowed');

class Penjualan extends CI_Controller
{

    public function formPenjualan()
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
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Penjualan/formPenjualan', $data);
        $this->load->view('template/footer');
    }

    public function tambahPenjualan()
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
            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Penjualan/formPenjualan', $data);
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
                    'saldo_jurnal' => $saldo[$key],
                    'status' => $status
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
                $this->session->set_flashdata('Success', 'Penjualan berhasil ditambahkan');
                //$this->M_transaksi->sumLaba();
                $this->M_coa->sumLevel3();
                // $this->db->query("UPDATE tb_barang SET stok_beli = stok_beli-NEW.qty, stok_jual = stok_jual - (nilai_konversi * NEW.qty) WHERE id_barang = NEW.id_barang;");
                redirect('Penjualan/Penjualan/formPenjualan');
            } else {
                redirect('Penjualan/Penjualan/formPenjualan');
            }
        }
    }

    public function editPenjualan($invoice, $tgl)
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
        // Load view
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Penjualan/formEditPenjualan', $data);
        $this->load->view('template/footer');
        // var_dump($where);
    }

    public function prosesEditPenjualan()
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
            //$this->M_transaksi->sumLaba();
            $this->M_coa->sumLevel3();
            $referred_from = $this->session->userdata('referred_from');
            redirect($referred_from, 'refresh');
        }
    }

    public function deletePenjualan($kode_jurnal)
    {
        $this->db->query("DELETE a.*,b.*,c.* from tb_transaksijual a
        join tb_jurnal b on b.kode_jurnal = a.kode_jurnal
        left join tb_returjual c on c.kode_jurnal = a.kode_jurnal
        where a.kode_jurnal = '$kode_jurnal'");
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('Success', 'Data Berhasil Dihapus');
            //$this->M_transaksi->sumLaba();
            $this->M_coa->sumLevel3();
            $referred_from = $this->session->userdata('referred_from');
            redirect($referred_from, 'refresh');
        } else {
            $this->session->set_flashdata('Success', 'Data Gagal Dihapus');
            $referred_from = $this->session->userdata('referred_from');
            redirect($referred_from, 'refresh');
        }
    }

    public function daftarPenjualan()
    {
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['all'] = $this->M_transaksi->getAllCustBeli()->result();

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Penjualan/daftarTransaksiCustomer', $data);
        $this->load->view('template/footer');
    }

    public function daftarCustomerPiutang()
    {
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['all'] = $this->M_transaksi->getAllCustBeli()->result();

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Penjualan/daftarCustomerPiutang', $data);
        $this->load->view('template/footer');
    }

    public function daftarCustomerLunas()
    {
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['all'] = $this->M_transaksi->getAllCustBeli()->result();

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Penjualan/daftarCustomerLunas', $data);
        $this->load->view('template/footer');
    }

    public function detailPenjualan($id_customer)
    {
        $where = $id_customer;

        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['testing'] = $this->M_transaksi->getDetailPenjualan($where)->result();
        $data['namaCust'] = $this->M_transaksi->getNamaCustomer($where)->result();
        $data['setting'] = $this->M_profil->getSetting()->result();

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Penjualan/detailPenjualan', $data);
        $this->load->view('template/footer');

        $this->session->set_userdata('detailPembelian', current_url());
    }

    public function detailTransaksiPenjualan($kode_jurnal, $tgl)
    {
        $where = array('kode_jurnal' => $kode_jurnal);
        $kondisi = $kode_jurnal;
        $where2 = array('tanggal_transaksi' => $tgl);

        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['barang'] = $this->M_barang->getData();
        $data['cust'] = $this->M_customer->getCust()->result();
        $data['setting'] = $this->M_profil->getSetting()->result();
        $data['getDataPegawai'] = $this->M_transaksi->getDataPegawaiJual($kondisi)->result();
        $data['jurnal'] = $this->M_jurnal->getData($where, $where2)->result();
        $data['listBarang'] = $this->M_transaksi->getListBarangJualDetail($kondisi)->result();
        // $data['bayar'] = $this->Admin_model->getJumlahBayar($kondisi, $where2)->result();
        $data['total'] = $this->M_transaksi->getGrandTotal($kondisi)->result();
        // $data['utang'] = $this->Admin_model->getSelisih($kondisi)->result();
        $data['detailInvoice'] = $this->M_transaksi->getDetailInvoicePenjualan($kondisi)->result();
        $this->session->set_userdata('detailInvoiceJual', current_url());

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Penjualan/detailInvoicePenjualan', $data);
        $this->load->view('template/footer');
    }

    public function terimaPiutang($kode_jurnal)
    {
        $where = array('kode_jurnal' => $kode_jurnal);
        $kondisi = $kode_jurnal;
        // $where2 = array('tgl_transaksi' => $tgl);

        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['akunPiutang'] = $this->M_transaksi->getAkunPiutang()->result();
        $data['setting'] = $this->M_profil->getSetting()->result();
        $data['akunPenerimaan'] = $this->M_transaksi->getAkunPenerimaan()->result();
        $data['total'] = $this->M_transaksi->getGrandTotal($kondisi)->result();
        $data['detailInvoice'] = $this->M_transaksi->getDetailInvoicePenjualan($kondisi)->result();

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Penjualan/terimaPiutang', $data);
        $this->load->view('template/footer');
    }

    public function prosesTerimaPiutang()
    {
        $this->form_validation->set_rules('tanggal_transaksi', 'Tanggal Transaksi', 'required');
        $this->form_validation->set_rules('memo', 'Keterangan', 'required');
        $this->form_validation->set_rules('id_akun[]', 'Akun', 'required');

        $this->form_validation->set_message('required', '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $kondisi = $this->input->post('kode_jurnal');
            $data['profil'] = $this->M_profil->getProfil()->result();
            $data['akunPiutang'] = $this->M_transaksi->getAkunPiutang()->result();
            $data['setting'] = $this->M_profil->getSetting()->result();
            $data['akunPenerimaan'] = $this->M_transaksi->getAkunPenerimaan()->result();
            $data['total'] = $this->M_transaksi->getGrandTotal($kondisi)->result();
            $data['detailInvoice'] = $this->M_transaksi->getDetailInvoicePenjualan($kondisi)->result();


            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Penjualan/terimaPiutang', $data);
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
                //$this->M_transaksi->sumLaba();
                $this->M_coa->sumLevel3();
                $this->session->set_flashdata('Success', 'Piutang Berhasil Diterima');
                $referred_from = $this->session->userdata('detailInvoiceJual');
                redirect($referred_from, 'refresh');
            } else {
                redirect('Pembelian/Pembelian/bayarUtang');
                $this->session->set_flashdata('Success', 'Utang Gagal Dibayarkan');
            }
        }
    }

    public function deleteTerimaPiutang($kode_jurnal, $tanggal)
    {
        $this->db->query("DELETE from tb_jurnal
        where kode_jurnal = '$kode_jurnal' and tanggal_transaksi = '$tanggal' and jenis_transaksi = 'Terima Piutang'");
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

    public function daftarReturJual()
    {
        $data['profil']     = $this->M_profil->getProfil()->result();
        $data['customer']   = $this->M_transaksi->getCustomerRetur()->result();
        // $data['testing'] = $this->Admin_model->testing($where)->result();

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Penjualan/daftarCustomerReturJual', $data);
        $this->load->view('template/footer');
    }

    public function invoiceReturJual($id_supplier)
    {
        $where = $id_supplier;
        $data['profil']     = $this->M_profil->getProfil()->result();
        $data['invoiceRetur'] = $this->M_transaksi->getInvoiceReturPenjualan($where)->result();
        $data['namacustomer'] = $this->M_transaksi->getCustomerRetur($where)->result();
        $data['setting'] = $this->M_profil->getSetting()->result();

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Penjualan/daftarInvoiceReturJual', $data);
        $this->load->view('template/footer');
    }

    public function detailInvoiceReturPenjualan($kode_jurnal, $tanggal_transaksi)
    {
        $where = array('kode_jurnal' => $kode_jurnal);
        $where2 = array('tanggal_transaksi' => $tanggal_transaksi);
        $kondisi = $kode_jurnal;
        $tgl = $tanggal_transaksi;
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['setting'] = $this->M_profil->getSetting()->result();
        $data['barang'] = $this->M_barang->getData();
        $data['customer'] = $this->M_customer->getCust();
        $data['jurnal'] = $this->M_jurnal->getData($where, $where2)->result();
        $data['getDataPegawai'] = $this->M_transaksi->getDataPegawaiJual($kondisi)->result();
        $data['listRetur'] = $this->M_transaksi->getListBarangReturJual($kondisi, $tgl)->result();

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Penjualan/detailInvoiceReturPenjualan', $data);
        $this->load->view('template/footer');
    }

    public function returJual($invoice, $tgl)
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
        //Data supplier
        $data['customer'] = $this->M_transaksi->getDataCustomer($where)->result();
        //data barang sesuai supplier
        $data['barang'] = $this->M_barang->getData()->result();
        //List supplier
        $data['cust'] = $this->M_customer->getCust()->result();
        // List barang yang dibeli
        $data['listBarang'] = $this->M_transaksi->getListBarangJualDetail($kondisi)->result();
        // Get akun bayar
        $data['getAkunTerima'] = $this->M_transaksi->getAkunPenerimaanRetur($where)->result();
        // Link Account utang
        $data['piutang'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Piutang"')->result();
        // Link account persediaan barang
        $data['persediaan'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Persediaan (Jual)"')->result();
        $data['hpp'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun HPP"')->result();
        $data['penjualan'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Penjualan"')->result();
        // Kondisi Akun Retur
        $data['jumlahPiutang'] = $this->M_transaksi->getDetailInvoicePenjualan($kondisi)->result();
        $data['tanggal'] = $tanggal;

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Penjualan/formReturPenjualan', $data);
        $this->load->view('template/footer');
    }

    public function prosesReturJual()
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
            $tanggal = $this->input->post('tanggal_jual');;
            $where2 = array('tanggal_transaksi' => $tanggal);

            $data['setting'] = $this->M_profil->getSetting()->result();
            // profil perusahaan
            $data['profil'] = $this->M_profil->getProfil()->result();
            // Data Invoice,tanggal,memo
            $data['single'] = $this->M_jurnal->getData($where, $where2)->result();
            //Data supplier
            $data['customer'] = $this->M_transaksi->getDataCustomer($where)->result();
            //data barang sesuai supplier
            $data['barang'] = $this->M_barang->getData()->result();
            //List supplier
            $data['cust'] = $this->M_customer->getCust()->result();
            // List barang yang dibeli
            $data['listBarang'] = $this->M_transaksi->getListBarangJualDetail($kondisi)->result();
            // Get akun bayar
            $data['getAkunTerima'] = $this->M_transaksi->getAkunPenerimaanRetur($where)->result();
            // Link Account utang
            $data['piutang'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Piutang"')->result();
            // Link account persediaan barang
            $data['persediaan'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Persediaan (Jual)"')->result();
            $data['hpp'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun HPP"')->result();
            $data['penjualan'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Penjualan"')->result();
            // Kondisi Akun Retur
            $data['jumlahPiutang'] = $this->M_transaksi->getDetailInvoicePenjualan($kondisi)->result();
            $data['tanggal'] = $tanggal;

            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Penjualan/formReturPenjualan', $data);
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
            $id_customer = $this->input->post('id_customer');
            $id_barang = $this->input->post('id_barang');
            $qty = $this->input->post('qty');
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
                    'id_akun' => $id_akun[$key],
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
                    'id_customer' => $id_customer,
                    'qty_returjual' => $qty[$brg],
                    'tanggal_returjual' => $tanggal_transaksi,
                    'total_returjual' => $total[$brg],
                    'total_returhpp' => $total_hpp[$brg]
                ));
            }

            $this->db->insert_batch('tb_jurnal', $data);
            $this->db->insert_batch('tb_returjual', $trans);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('Success', 'Retur Berhasil Ditambahkan');
                $this->M_coa->sumLevel3();
                $referred_from = $this->session->userdata('detailInvoiceJual');
                redirect($referred_from, 'refresh');
            } else {
                redirect('Penjualan/Penjualan/daftarReturJual');
            }
        }
    }

    public function editReturPenjualan($invoice, $tgl)
    {
        $where = array('kode_jurnal' => $invoice);
        $where3 = array(
            'tb_returjual.kode_jurnal' => $invoice,
            'tb_returjual.tanggal_returjual' => $tgl
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
        //Data Customer
        $data['customer'] = $this->M_transaksi->getDataCustomer($where)->result();
        //data barang sesuai supplier
        $data['barang'] = $this->M_barang->getData()->result();
        //List supplier
        $data['cust'] = $this->M_customer->getCust()->result();
        // List barang yang dibeli
        $data['listBarang'] = $this->M_transaksi->getDaftarReturJual($kondisi, $tanggal)->result();
        // Get akun bayar
        $data['getAkunTerima'] = $this->M_transaksi->getAkunPenerimaanRetur($where)->result();
        // Link Account utang
        $data['piutang'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Piutang"')->result();
        // Link account persediaan barang
        $data['persediaan'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Persediaan (Jual)"')->result();
        $data['hpp'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun HPP"')->result();
        $data['penjualan'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Penjualan"')->result();
        // Kondisi Akun Retur
        $data['jumlahPiutang'] = $this->M_transaksi->getDetailInvoicePenjualan($kondisi)->result();
        $data['tanggal'] = $tanggal;

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Penjualan/formEditReturJual', $data);
        $this->load->view('template/footer');
    }

    public function prosesEditReturJual()
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
                'tb_returjual.kode_jurnal' => $kondisi,
                'tb_returjual.tanggal_returjual' => $tanggal
            );

            $data['setting'] = $this->M_profil->getSetting()->result();
            // profil perusahaan
            $data['profil'] = $this->M_profil->getProfil()->result();
            // Data Invoice,tanggal,memo
            $data['single'] = $this->M_jurnal->getData($where, $where2)->result();
            // Data ID Jurnal
            $data['jurnal'] = $this->M_jurnal->getIDjurnal($where, $where2)->result();
            //Data Customer
            $data['customer'] = $this->M_transaksi->getDataCustomer($where)->result();
            //data barang sesuai supplier
            $data['barang'] = $this->M_barang->getData()->result();
            //List supplier
            $data['cust'] = $this->M_customer->getCust()->result();
            // List barang yang dibeli
            $data['listBarang'] = $this->M_transaksi->getDaftarReturJual($kondisi, $tanggal)->result();
            // Get akun bayar
            $data['getAkunTerima'] = $this->M_transaksi->getAkunPenerimaanRetur($where)->result();
            // Link Account utang
            $data['piutang'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Piutang"')->result();
            // Link account persediaan barang
            $data['persediaan'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Persediaan (Jual)"')->result();
            $data['hpp'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun HPP"')->result();
            $data['penjualan'] = $this->db->query('select id_akun from tb_linkacc where keterangan_link="Akun Penjualan"')->result();
            // Kondisi Akun Retur
            $data['jumlahPiutang'] = $this->M_transaksi->getDetailInvoicePenjualan($kondisi)->result();
            $data['tanggal'] = $tanggal;

            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Penjualan/formEditReturJual', $data);
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
            $id_customer = $this->input->post('id_customer');
            $id_barang = $this->input->post('id_barang');
            $qty = $this->input->post('qty');
            $total = $this->input->post('total');
            $total_hpp = $this->input->post('total_hpp');

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
                    'id_returjual' => $transaksi,
                    'kode_jurnal' => $kode_jurnal,
                    'id_barang' => $id_barang[$id],
                    'id_user' => $id_pegawai,
                    'id_customer' => $id_customer,
                    'qty_returjual' => $qty[$id],
                    'tanggal_returjual' => $tanggal_transaksi,
                    'total_returjual' => $total[$id],
                    'total_returhpp' => $total_hpp[$id]
                ));
            }

            $this->db->update_batch('tb_jurnal', $data, 'id_jurnal');
            $this->db->update_batch('tb_returjual', $trans, 'id_returjual');
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('Success', 'Retur Berhasil Ditambahkan');
                //$this->M_transaksi->sumLaba();
                $this->M_coa->sumLevel3();
                // $this->db->query('UPDATE tb_transaksibeli t1 
                // JOIN tb_barang t2 on t1.id_barang = t2.id_barang
                // JOIN tb_returbeli t3 on t1.kode_jurnal = t3.kode_jurnal
                // SET t1.qty_beli = (t1.qty_beli - t3.qty_returbeli), t1.total_beli = (t1.qty_beli - t3.qty_returbeli) * t2.harga_beli
                // WHERE t1.id_barang = t3.id_barang and t1.kode_jurnal = t3.kode_jurnal');
                $referred_from = $this->session->userdata('referred_from');
                redirect($referred_from, 'refresh');
            } else {
                redirect('Penjualan/Penjualan/daftarReturJual');
            }
        }
    }

    public function deleteReturPenjualan($kode_jurnal, $tanggal)
    {
        $this->db->query("DELETE a.*,b.* from tb_returjual a
        join tb_jurnal b on b.kode_jurnal = a.kode_jurnal
        where a.kode_jurnal = '$kode_jurnal' and b.tanggal_transaksi = '$tanggal' and b.jenis_transaksi = 'Retur Penjualan'");
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

    public function editTerimaPiutang($kode_jurnal, $tanggal)
    {
        $where = array('kode_jurnal' => $kode_jurnal);
        $kondisi = $kode_jurnal;
        $where2 = array('tanggal_transaksi' => $tanggal);

        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['detailInvoice'] = $this->M_transaksi->getDetailInvoicePenjualan($kondisi)->result();
        $data['single'] = $this->M_jurnal->getData($where, $where2)->result();
        $data['getAkunTerima'] = $this->M_transaksi->getAkunPenerimaanPiutang($where, $where2)->result();
        //$data['akunBayar'] = $this->Transaksi_model->getAkunPembayaran()->result();
        //$data['akunBayar'] = $this->Transaksi_model->getAkunPenerimaan()->result();
        $data['akunTerima'] = $this->M_transaksi->getAkunPiutangEdit($where, $where2)->result();
        $data['penerimaan'] = $this->M_transaksi->getAkunPenerimaan()->result();
        $data['total'] = $this->M_transaksi->getGrandTotal($kondisi)->result();
        $data['setting'] = $this->M_profil->getSetting()->result();

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Penjualan/formEditTerimaPiutang', $data);
        $this->load->view('template/footer');
    }

    public function prosesEditTerimaPiutang()
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
            $data['detailInvoice'] = $this->M_transaksi->getDetailInvoicePenjualan($kondisi)->result();
            $data['single'] = $this->M_jurnal->getData($where, $where2)->result();
            $data['getAkunTerima'] = $this->M_transaksi->getAkunPenerimaanPiutang($where, $where2)->result();
            //$data['akunBayar'] = $this->Transaksi_model->getAkunPembayaran()->result();
            //$data['akunBayar'] = $this->Transaksi_model->getAkunPenerimaan()->result();
            $data['akunTerima'] = $this->M_transaksi->getAkunPiutangEdit($where, $where2)->result();
            $data['penerimaan'] = $this->M_transaksi->getAkunPenerimaan()->result();
            $data['total'] = $this->M_transaksi->getGrandTotal($kondisi)->result();
            $data['setting'] = $this->M_profil->getSetting()->result();

            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Penjualan/formEditTerimaPiutang', $data);
            $this->load->view('template/footer');
        } else {
            $id_akun = $this->input->post('id_akun');
            $id_jurnal = $this->input->post('id_jurnal');
            $kode_jurnal = $this->input->post('kode_jurnal');
            $keterangan  = $this->input->post('memo');
            $tgl_transaksi = $this->input->post('tanggal_transaksi');
            $posisi = $this->input->post('posisi');
            $saldo_jurnal = $this->input->post('saldo');
            $jenis_jurnal = $this->input->post('jenis_transaksi');

            $data = array();

            foreach ($id_jurnal as $id => $jurnal) {

                array_push($data, array(
                    'id_jurnal' => $jurnal,
                    'kode_jurnal' => $kode_jurnal,
                    'id_akun' => $id_akun[$id],
                    'memo' => $keterangan,
                    'tanggal_transaksi' => $tgl_transaksi,
                    'jenis_transaksi' => $jenis_jurnal,
                    'posisi' => $posisi[$id],
                    'saldo_jurnal' => $saldo_jurnal[$id]
                ));
            }

            //var_dump($data);

            $this->db->update_batch('tb_jurnal', $data, 'id_jurnal');
            if ($this->db->affected_rows() > 0) {
                //$this->M_transaksi->sumLaba();
                $this->M_coa->sumLevel3();
                $this->session->set_flashdata('Success', 'Pembyaran Utang Berhasil Diubah');
                $referred_from = $this->session->userdata('referred_from');
                redirect($referred_from, 'refresh');
            } else {
                redirect("Laporan/Penjualan/prosesEditBayarUtang");
            }
        }
    }

    // Transaksi lama
    // Menggunakan insert batch
    public function formTransaksi()
    {
        $data['profil']     = $this->M_profil->getProfil()->result();
        $data['periode']    = $this->M_periode->getPeriode()->result();
        $data['coa']        = $this->M_coa->getCoaTrans()->result();
        $data['barang']     = $this->M_barang->getData()->result();
        $data['satuan']     = $this->M_barang->getSatuan()->result();
        $data['kategori']   = $this->M_barang->getKategori()->result();
        $data['pegawai']    = $this->M_pegawai->getPegawai()->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Transaksi/form_transaksi', $data);
        $this->load->view('template/footer');
    }

    public function tambahTransaksi()
    {
        $nama_akun = $this->input->post('nama_akun');
        $this->form_validation->set_rules('periode[]', 'Periode', 'required');
        $this->form_validation->set_rules('tanggal[]', 'Tanggal Transaksi', 'required');
        $this->form_validation->set_rules('id_akun[]', 'Nama Akun', 'required');
        if ($nama_akun == "Pembelian" || $nama_akun == "Penjualan") {
            $this->form_validation->set_rules('id_barang[]', 'Barang', 'required');
            $this->form_validation->set_rules('jumlah[]', 'Jumlah', 'required');
        }
        $this->form_validation->set_rules('saldo[]', 'Saldo', 'required');
        $this->form_validation->set_rules('posisi[]', 'Jenis Saldo', 'required');
        $this->form_validation->set_message('required', '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('Fail', 'Terdapat Form Yang Kosong, Mohon Periksa Kembali');
            $data['profil'] = $this->M_profil->getProfil()->result();
            $data['periode']    = $this->M_periode->getPeriode()->result();
            $data['coa']        = $this->M_coa->getCoa()->result();
            $data['barang']     = $this->M_barang->getData()->result();
            $data['satuan']     = $this->M_barang->getSatuan()->result();
            $data['kategori']   = $this->M_barang->getKategori()->result();
            $data['pegawai']    = $this->M_pegawai->getPegawai()->result();
            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Transaksi/form_transaksi', $data);
            $this->load->view('template/footer');
        } else {
            $id_periode     = $this->input->post('periode');
            $tanggal        = $this->input->post('tanggal');
            $id_akun        = $this->input->post('id_akun');
            $id_barang      = $this->input->post('id_barang');
            $id_pegawai     = $this->input->post('id_pegawai');
            $jumlah         = $this->input->post('jumlah');
            $saldo          = $this->input->post('saldo');
            $posisi         = $this->input->post('posisi');
            $keterangan     = $this->input->post('keterangan');
            $data           = array();

            $index = 0;
            foreach ($id_akun as $akun) {
                if ($id_barang[$index] == null) {
                    $id_barang[$index] = null;
                }
                if ($id_pegawai[$index] == null) {
                    $id_pegawai[$index] = null;
                }
                array_push($data, array(
                    'id_akun' => $akun,
                    'id_periode' => $id_periode[$index],
                    'tanggal_transaksi' => $tanggal[$index],
                    'id_barang' => $id_barang[$index],
                    'id_pegawai' => $id_pegawai[$index],
                    'jumlah' => $jumlah[$index],
                    'saldo' => $saldo[$index],
                    'posisi' => $posisi[$index],
                    'keterangan_transaksi' => $keterangan[$index]
                ));
                $index++;
            }

            $this->M_transaksi->addTransaksi($data, 'tb_transaksi');
            $this->M_coa->sumLevel3();
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('Success', 'Transaksi berhasil ditambahkan');

                redirect('Transaksi/Transaksi/formTransaksi');
            } else {
                redirect('Transaksi/Transaksi/formTransaksi');
            }
        }
    }

    //autocomplete akun
    public function get_autocomplete()
    {
        if (isset($_GET['term'])) {
            $result = $this->M_transaksi->search_akun($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'         => $row->nama_akun,
                        'no_akun'       => $row->no_akun,
                        'id_akun'       => $row->id_akun
                    );
                echo json_encode($arr_result);
            }
        }
    }

    //autocomplete barang
    public function get_barang()
    {
        if (isset($_GET['term'])) {
            $result = $this->M_transaksi->search_barang($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'         => $row->nama_barang,
                        'id_barang'     => $row->id_barang,
                        'harga_beli'    => $row->harga_beli,
                        'harga_jual'    => $row->harga_jual,
                        'id_satuan'     => $row->id_satuan,
                        'satuan_barang' => $row->satuan_barang
                    );
                echo json_encode($arr_result);
            }
        }
    }

    public function get_pegawai()
    {
        if (isset($_GET['term'])) {
            $result = $this->M_transaksi->search_pegawai($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'         => $row->nama_pegawai,
                        'id_pegawai'    => $row->id_pegawai,
                    );
                echo json_encode($arr_result);
            }
        }
    }
}
