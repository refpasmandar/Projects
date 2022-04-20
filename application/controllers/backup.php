<?php 
class Backup extends CI_Controller{
    public function backup_2(){

        // Menggunakan insert batch
        public function formTransaksi(){
            $data['periode']    = $this->M_periode->getPeriode()->result();
            $data['coa']        = $this->M_coa->getCoa()->result();
            $data['barang']     = $this->M_barang->getData()->result();
            $data['satuan']     = $this->M_barang->getSatuan()->result();
            $data['kategori']   = $this->M_barang->getKategori()->result();
            $data['pegawai']    = $this->M_pegawai->getPegawai()->result();
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('v_admin/Transaksi/form_transaksi',$data);
            $this->load->view('template/footer');
        }
    
        public function tambahTransaksi(){
            $id_periode     = $this->input->post('periode');
            $id_akun        = $this->input->post('id_akun');
            $nama_akun_kre      = $this->input->post('nama_akun_kre');
            $nama_akun_deb      = $this->input->post('nama_akun_deb');
            $id_barang      = $this->input->post('id_barang');
            $nama_barang   = $this->input->post('nama_barang');
            $jumlah         = $this->input->post('jumlah');
            $arr = 
            // if($nama_akun_kre != "Pembelian" || $nama_akun != "Penjualan"){
            //     $id_barang = null;
            //     $jumlah = null;
            // }else{
            //     $id_barang      = $this->input->post('id_barang');
            //     $jumlah         = $this->input->post('jumlah');
            // }
            // if($nama_akun_deb != "Pembelian" || $nama_akun != "Penjualan"){
            //     $id_barang = null;
            //     $jumlah = null;
            // }else{
            //     $id_barang      = $this->input->post('id_barang');
            //     $jumlah         = $this->input->post('jumlah');
            // }
            $saldo          = $this->input->post('saldo');
            $posisi         = $this->input->post('posisi');
            $data           = array();
    
            $index = 0;
            foreach ($id_akun as $akun){
                array_push($data, array(
                    'id_akun' => $akun,
                    'id_periode' => $id_periode[$index],
                    'id_barang' => $id_barang[$index],
                    'jumlah' => $jumlah[$index],
                    'saldo' => $saldo[$index],
                    'posisi' => $posisi[$index]
                ));
            $index++;
            }
            
            $this->M_transaksi->addTransaksi($data,'tb_transaksi');
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('Success', 'Transaksi berhasil ditambahkan');
                redirect('Transaksi/Transaksi/formTransaksi');
            }else{
                redirect('Transaksi/Transaksi/formTransaksi');
            }
        }

        // input normal satu satu

        public function formTransaksi(){
            $data['periode']    = $this->M_periode->getPeriode()->result();
            $data['coa']        = $this->M_coa->getCoa()->result();
            $data['barang']     = $this->M_barang->getData()->result();
            $data['satuan']     = $this->M_barang->getSatuan()->result();
            $data['kategori']   = $this->M_barang->getKategori()->result();
            $data['pegawai']    = $this->M_pegawai->getPegawai()->result();
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('v_admin/Transaksi/form_transaksi_3',$data);
            $this->load->view('template/footer');
        }
    
        public function tambahTransaksi(){
            $id_periode     = $this->input->post('periode');
            $id_akun        = $this->input->post('id_akun');
            $id_barang      = $this->input->post('id_barang');
            $jumlah         = $this->input->post('jumlah');
            $posisi         = $this->input->post('posisi');
            $saldo          = $this->input->post('saldo');
            if($id_barang == null){
                $id_barang = null;
            }elseif($jumlah == null){
                $jumlah = null;
            }
    
            $data = array(
                'id_periode'    => $id_periode,
                'id_akun'       => $id_akun,
                'id_barang'     => $id_barang,
                'jumlah'        => $jumlah,
                'posisi'        => $posisi,
                'saldo'         => $saldo
                
            );
            
            $this->M_transaksi->addTransaksi($data,'tb_transaksi');
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('Success', 'Transaksi berhasil ditambahkan');
                redirect('Transaksi/Transaksi/formTransaksi');
            }else{
                redirect('Transaksi/Transaksi/formTransaksi');
            }
        }

        // insyaAllah
        <?php 
defined ('BASEPATH') or exit('No Direct Script Access Allowed');

class Transaksi extends CI_Controller{
    // Menggunakan insert batch
    public function formTransaksi(){
        $data['periode']    = $this->M_periode->getPeriode()->result();
        $data['coa']        = $this->M_coa->getCoa()->result();
        $data['barang']     = $this->M_barang->getData()->result();
        $data['satuan']     = $this->M_barang->getSatuan()->result();
        $data['kategori']   = $this->M_barang->getKategori()->result();
        $data['pegawai']    = $this->M_pegawai->getPegawai()->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('v_admin/Transaksi/form_transaksi_3',$data);
        $this->load->view('template/footer');
    }

    public function tambahTransaksi(){
        $nama_akun = $this->input->post('nama_akun');
        $this->form_validation->set_rules('periode[]','Periode','required');
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
            $data['periode']    = $this->M_periode->getPeriode()->result();
            $data['coa']        = $this->M_coa->getCoa()->result();
            $data['barang']     = $this->M_barang->getData()->result();
            $data['satuan']     = $this->M_barang->getSatuan()->result();
            $data['kategori']   = $this->M_barang->getKategori()->result();
            $data['pegawai']    = $this->M_pegawai->getPegawai()->result();
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('v_admin/Transaksi/form_transaksi_3',$data);
            $this->load->view('template/footer');
        }else{
            $id_periode     = $this->input->post('periode');
            $id_akun        = $this->input->post('id_akun');
            $id_barang      = $this->input->post('id_barang');
            $jumlah         = $this->input->post('jumlah');
            $saldo          = $this->input->post('saldo');
            $posisi         = $this->input->post('posisi');
            $data           = array();

            $index = 0;
            foreach ($id_akun as $akun){
                if($id_barang[$index] == null){
                    $id_barang[$index] = null;
                }
                array_push($data, array(
                    'id_akun' => $akun,
                    'id_periode' => $id_periode[$index],
                    'id_barang' => $id_barang[$index],
                    'jumlah' => $jumlah[$index],
                    'saldo' => $saldo[$index],
                    'posisi' => $posisi[$index]
                ));
            $index++;
            }
            
            $this->M_transaksi->addTransaksi($data,'tb_transaksi');
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
}

?>
    
?>
