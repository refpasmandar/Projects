<?php 
defined ('BASEPATH') or exit('No Direct Script Access Allowed');

class Transaksi extends CI_Controller{
    
    public function formPembelian(){
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['barang'] = $this->M_barang->getData()->result();
        $data['supp'] = $this->M_supplier->getSupplier()->result();
        $data['coa'] = $this->M_coa->getCoa()->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar',$data);
        $this->load->view('v_admin/Transaksi/formPembelian',$data);
        $this->load->view('template/footer');
    }

    public function formPenjualan(){
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['barang'] = $this->M_barang->getData()->result();
        $data['cust'] = $this->M_customer->getCust()->result();
        $data['coa'] = $this->M_coa->getCoa()->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar',$data);
        $this->load->view('v_admin/Transaksi/formPenjualan',$data);
        $this->load->view('template/footer');
    }
    
    // Transaksi lama
    // Menggunakan insert batch
    public function formTransaksi(){
        $data['profil']     = $this->M_profil->getProfil()->result();
        $data['periode']    = $this->M_periode->getPeriode()->result();
        $data['coa']        = $this->M_coa->getCoaTrans()->result();
        $data['barang']     = $this->M_barang->getData()->result();
        $data['satuan']     = $this->M_barang->getSatuan()->result();
        $data['kategori']   = $this->M_barang->getKategori()->result();
        $data['pegawai']    = $this->M_pegawai->getPegawai()->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar',$data);
        $this->load->view('v_admin/Transaksi/form_transaksi',$data);
        $this->load->view('template/footer');
    }

    public function tambahTransaksi(){
        $nama_akun = $this->input->post('nama_akun');
        $this->form_validation->set_rules('periode[]','Periode','required');
        $this->form_validation->set_rules('tanggal[]','Tanggal Transaksi','required');
        $this->form_validation->set_rules('id_akun[]','Nama Akun','required');
        if($nama_akun == "Pembelian" || $nama_akun == "Penjualan"){
            $this->form_validation->set_rules('id_barang[]','Barang','required');
            $this->form_validation->set_rules('jumlah[]','Jumlah','required');
        }
        $this->form_validation->set_rules('saldo[]','Saldo','required');
        $this->form_validation->set_rules('posisi[]','Jenis Saldo','required');
        $this->form_validation->set_message('required' , '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('Fail', 'Terdapat Form Yang Kosong, Mohon Periksa Kembali');
            $data['profil'] = $this->M_profil->getProfil()->result();
            $data['periode']    = $this->M_periode->getPeriode()->result();
            $data['coa']        = $this->M_coa->getCoa()->result();
            $data['barang']     = $this->M_barang->getData()->result();
            $data['satuan']     = $this->M_barang->getSatuan()->result();
            $data['kategori']   = $this->M_barang->getKategori()->result();
            $data['pegawai']    = $this->M_pegawai->getPegawai()->result();
            $this->load->view('template/header');
            $this->load->view('template/sidebar',$data);
            $this->load->view('v_admin/Transaksi/form_transaksi',$data);
            $this->load->view('template/footer');
        }else{
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
            foreach ($id_akun as $akun){
                if($id_barang[$index] == null){
                    $id_barang[$index] = null;
                }
                if($id_pegawai[$index] == null){
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
            
            $this->M_transaksi->addTransaksi($data,'tb_transaksi');
            $this->M_coa->sumLevel3();
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('Success', 'Transaksi berhasil ditambahkan');
                
                redirect('Transaksi/Transaksi/formTransaksi');
            }else{
                redirect('Transaksi/Transaksi/formTransaksi');
            }
        }
    }

    //autocomplete akun
    public function get_autocomplete(){
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
    public function get_barang(){
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

    public function get_pegawai(){
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

?>