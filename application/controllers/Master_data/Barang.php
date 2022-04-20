<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // check_admin();
        check_not_login();
    }

    public function Persediaan()
    {
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['barang'] = $this->M_barang->getData()->result_array();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Barang/v_barang.php', $data);
        $this->load->view('template/footer');
    }

    public function tambahBarang()
    {
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['satuanbeli'] = $this->M_barang->getSatuanBeli()->result();
        $data['satuanjual'] = $this->M_barang->getSatuanJual()->result();
        $data['kategori'] = $this->M_barang->getKategori()->result();
        $data['supp'] = $this->M_supplier->getSupplier()->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Barang/tambah_barang.php', $data);
        $this->load->view('template/footer');
    }

    public function prosesTambah()
    {
        $this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required|is_unique[tb_barang.kode_barang]|max_length[25]');
        $this->form_validation->set_rules('kode_pabrik', 'Kode Pabrik', 'required|is_unique[tb_barang.kode_pabrik]|max_length[25]');
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required|is_unique[tb_barang.nama_barang]|max_length[40]');
        $this->form_validation->set_rules('harga_beli', 'Harga Beli Barang', 'required');
        $this->form_validation->set_rules('id_supplier', 'Supplier Barang', 'required');
        $this->form_validation->set_rules('harga_jual', 'Harga Jual Barang', 'required');
        $this->form_validation->set_rules('satuan_beli', 'Satuan Beli Barang', 'required');
        $this->form_validation->set_rules('satuan_jual', 'Satuan Jual Barang', 'required');
        $this->form_validation->set_rules('kategori_barang', 'Kategori Barang', 'required');
        $this->form_validation->set_rules('stok_beli', 'Jumlah Beli', 'required');
        $this->form_validation->set_rules('nilai_konversi', 'Nilai Konversi', 'required');
        $this->form_validation->set_rules('hpp', 'Harga Pokok Penjualan', 'required');

        $this->form_validation->set_message('is_unique', '%s Sudah Ada');
        $this->form_validation->set_message('max_length', '%s Maksimal %d Karakter');
        $this->form_validation->set_message('required', '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $data['profil'] = $this->M_profil->getProfil()->result();
            $data['satuanbeli'] = $this->M_barang->getSatuanBeli()->result();
            $data['satuanjual'] = $this->M_barang->getSatuanJual()->result();
            $data['kategori'] = $this->M_barang->getKategori()->result();
            $data['supp'] = $this->M_supplier->getSupplier()->result();
            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Barang/tambah_barang.php', $data);
            $this->load->view('template/footer');
        } else {
            $kode_barang    = $this->input->post('kode_barang');
            $kode_pabrik    = $this->input->post('kode_pabrik');
            $id_supplier    = $this->input->post('id_supplier');
            $nama_barang    = $this->input->post('nama_barang');
            $harga_beli     = $this->input->post('harga_beli');
            $harga_jual     = $this->input->post('harga_jual');
            $satuan_beli    = $this->input->post('satuan_beli');
            $satuan_jual    = $this->input->post('satuan_jual');
            $nilai_konversi = $this->input->post('nilai_konversi');
            $id_kategori    = $this->input->post('kategori_barang');
            $stok_beli      = $this->input->post('stok_beli');
            $stok_jual      = $this->input->post('stok_jual');
            $hpp            = $this->input->post('hpp');

            $data = array(
                'kode_barang'       => $kode_barang,
                'kode_pabrik'       => $kode_pabrik,
                'id_supplier'       => $id_supplier,
                'nama_barang'       => $nama_barang,
                'harga_beli'        => $harga_beli,
                'harga_jual'        => $harga_jual,
                'id_satuanbeli'     => $satuan_beli,
                'id_satuanjual'     => $satuan_jual,
                'id_kategori'       => $id_kategori,
                'stok_beli'         => $stok_beli,
                'nilai_konversi'    => $nilai_konversi,
                'stok_jual'         => $stok_jual,
                'hpp'               => $hpp
            );

            $this->M_barang->addBarang($data, 'tb_barang');
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('Success', 'Barang berhasil ditambahkan');
                redirect('Master_data/Barang/Persediaan');
            } else {
                redirect('Master_data/Barang/Persediaan');
            }
        }
    }

    public function editBarang($id)
    {
        $where = array('id_barang' => $id);
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['barang'] = $this->M_barang->editBarang($where)->result();
        $data['satuanbeli'] = $this->M_barang->getSatuanBeli()->result();
        $data['satuanjual'] = $this->M_barang->getSatuanJual()->result();
        $data['kategori'] = $this->M_barang->getKategori()->result();
        $data['supp'] = $this->M_supplier->getSupplier()->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Barang/edit_barang.php', $data);
        $this->load->view('template/footer');
    }

    public function prosesEdit()
    {
        $this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required|max_length[25]|callback_checkKodBar');
        $this->form_validation->set_rules('kode_pabrik', 'Kode Pabrik', 'required|max_length[25]|callback_checkKodPab');
        $this->form_validation->set_rules('id_supplier', 'Supplier Barang', 'required');
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required|max_length[40]|callback_checkNaBar');
        $this->form_validation->set_rules('harga_beli', 'Harga Beli Barang', 'required');
        $this->form_validation->set_rules('harga_jual', 'Harga Jual Barang', 'required');
        $this->form_validation->set_rules('satuan_beli', 'Satuan Beli Barang', 'required');
        $this->form_validation->set_rules('satuan_jual', 'Satuan Jual Barang', 'required');
        $this->form_validation->set_rules('kategori_barang', 'Kategori Barang', 'required');
        $this->form_validation->set_rules('stok_beli', 'Jumlah Beli', 'required');
        $this->form_validation->set_rules('nilai_konversi', 'Nilai Konversi', 'required');
        $this->form_validation->set_rules('hpp', 'Harga Pokok Penjualan', 'required');

        $this->form_validation->set_message('max_length', '%s Maksimal %d Karakter');
        $this->form_validation->set_message('required', '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $id = $this->input->post('id_barang');
            $where = array('id_barang' => $id);
            $data['profil'] = $this->M_profil->getProfil()->result();
            $data['barang'] = $this->M_barang->editBarang($where)->result();
            $data['satuanbeli'] = $this->M_barang->getSatuanBeli()->result();
            $data['satuanjual'] = $this->M_barang->getSatuanJual()->result();
            $data['kategori'] = $this->M_barang->getKategori()->result();
            $data['supp'] = $this->M_supplier->getSupplier()->result();
            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Barang/edit_barang', $data);
            $this->load->view('template/footer');
        } else {
            $id_barang      = $this->input->post('id_barang');
            $kode_barang    = $this->input->post('kode_barang');
            $id_supplier    = $this->input->post('id_supplier');
            $kode_pabrik    = $this->input->post('kode_pabrik');
            $nama_barang    = $this->input->post('nama_barang');
            $harga_beli     = $this->input->post('harga_beli');
            $harga_jual     = $this->input->post('harga_jual');
            $satuan_beli    = $this->input->post('satuan_beli');
            $satuan_jual    = $this->input->post('satuan_jual');
            $nilai_konversi = $this->input->post('nilai_konversi');
            $id_kategori    = $this->input->post('kategori_barang');
            $stok_beli      = $this->input->post('stok_beli');
            $stok_jual      = $this->input->post('stok_jual');
            $hpp            = $this->input->post('hpp');

            $data = array(
                'kode_barang'       => $kode_barang,
                'kode_pabrik'       => $kode_pabrik,
                'id_supplier'       => $id_supplier,
                'nama_barang'       => $nama_barang,
                'harga_beli'        => $harga_beli,
                'harga_jual'        => $harga_jual,
                'id_satuanbeli'     => $satuan_beli,
                'id_satuanjual'     => $satuan_jual,
                'id_kategori'       => $id_kategori,
                'stok_beli'         => $stok_beli,
                'nilai_konversi'    => $nilai_konversi,
                'stok_jual'         => $stok_jual,
                'hpp'               => $hpp
            );

            $where = array('id_barang' => $id_barang);

            $this->M_barang->updateBarang($where, $data, 'tb_barang');
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('Success', 'Data Barang Berhasil Diubah');
                redirect('Master_data/Barang/Persediaan');
            } else {
                redirect('Master_data/Barang/Persediaan');
            }
        }
    }

    function checkKodBar()
    {
        $post = $this->input->post(null, true);
        $query = $this->db->query("select * from tb_barang where kode_barang = '$post[kode_barang]' AND id_barang != '$post[id_barang]'");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('checkKodBar', '%s yang diinputkan sudah terpakai');
            return false;
        } else {
            return true;
        }
    }

    function checkKodPab()
    {
        $post = $this->input->post(null, true);
        $query = $this->db->query("select * from tb_barang where kode_pabrik = '$post[kode_pabrik]' AND id_barang != '$post[id_barang]'");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('checkKodPab', '%s yang diinputkan sudah terpakai');
            return false;
        } else {
            return true;
        }
    }

    function checkNaBar()
    {
        $post = $this->input->post(null, true);
        $query = $this->db->query("select * from tb_barang where nama_barang = '$post[kode_pabrik]' AND id_barang != '$post[id_barang]'");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('checkNaBar', '%s yang diinputkan sudah terpakai');
            return false;
        } else {
            return true;
        }
    }

    public function deleteBarang($id)
    {
        $where = array('id_barang' => $id);
        $this->M_barang->deleteBarang($where, 'tb_barang');
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('Success', 'Data Barang Berhasil Dihapus');
            redirect('Master_data/Barang/Persediaan');
        } else {
            redirect('Master_data/Barang/Persediaan');
        }
    }

    public function satuanBeli()
    {
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['satuan'] = $this->M_barang->getSatuanBeli()->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Barang/satuanBeli', $data);
        $this->load->view('template/footer');
    }

    public function tambahSatuanBeli()
    {
        $this->form_validation->set_rules('satuan_beli', 'Satuan', 'required|is_unique[tb_satuanbeli.satuan_beli]');
        $this->form_validation->set_rules('simbol_satuan', 'Simbol Satuan', 'required');
        $this->form_validation->set_message('required', '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_message('is_unique', '%s Sudah Ada!');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $data['profil'] = $this->M_profil->getProfil()->result();
            $data['satuan'] = $this->M_barang->getSatuanBeli()->result();
            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Barang/satuanBeli', $data);
            $this->load->view('template/footer');
        } else {
            $satuan_beli  = $this->input->post('satuan_beli');
            $simbol_satuan = $this->input->post('simbol_satuan');

            $data = array(
                'satuan_beli'       => $satuan_beli,
                'simbol_satuanbeli'     => $simbol_satuan
            );

            $this->M_barang->addSatuanBeli($data, 'tb_satuanbeli');
            if ($this->db->affected_rows() > 0) {
                $this->M_barang->addSatuanJual();
                $this->session->set_flashdata('Success', 'Satuan Beli berhasil ditambahkan');
                redirect('Master_data/Barang/satuanBeli');
            } else {
                redirect('Master_data/Barang/satuanBeli');
            }
        }
    }

    public function editSatuanBeli($id_satuan)
    {
        $where = array('id_satuanbeli' => $id_satuan);
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['satuan'] = $this->M_barang->editSatuanBeli($where)->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Barang/edit_satuanbeli', $data);
        $this->load->view('template/footer');
    }

    public function prosesEditSatuanBeli()
    {
        $this->form_validation->set_rules('satuan_beli', 'Satuan', 'required|max_length[15]|callback_SatuanBeliCheck');
        $this->form_validation->set_message('required', '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $id_satuan = $this->input->post('id_satuan');
            $where = array('id_satuanbeli' => $id_satuan);
            $data['profil'] = $this->M_profil->getProfil()->result();
            $data['satuan'] = $this->M_barang->editSatuanBeli($where)->result();
            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Barang/edit_satuanbeli', $data);
            $this->load->view('template/footer');
        } else {
            $id_satuan      = $this->input->post('id_satuan');
            $satuan_beli  = $this->input->post('satuan_beli');
            $simbol_satuan = $this->input->post('simbol_satuan');

            $data = array(
                'id_satuanbeli'     => $id_satuan,
                'satuan_beli'   => $satuan_beli,
                'simbol_satuanbeli' => $simbol_satuan
            );

            $where  = array('id_satuanbeli' => $id_satuan);

            $this->M_barang->updateSatuanBeli($where, $data, 'tb_satuanbeli');
            if ($this->db->affected_rows() > 0) {
                $this->M_barang->updateSatuanJual();
                $this->session->set_flashdata('Success', 'Satuan Beli berhasil diubah');
                redirect('Master_data/Barang/satuanBeli');
            } else {
                redirect('Master_data/Barang/satuanBeli');
            }
        }
    }

    public function deleteSatuanBeli($id_satuan)
    {
        $where = array('id_satuanbeli' => $id_satuan);
        $where2 = $id_satuan;
        $this->M_barang->deleteSatuanBeli($where2, 'tb_satuanbeli');
        if ($this->db->affected_rows() > 0) {
            // $this->M_barang->deleteSatuanJual($where2);
            $this->session->set_flashdata('Success', 'Satuan Beli berhasil dihapus');
            redirect('Master_data/Barang/satuanBeli');
        } else {
            redirect('Master_data/Barang/satuanBeli');
        }
    }

    function SatuanBeliCheck()
    {
        $post = $this->input->post(null, true);
        $query = $this->db->query("select * from tb_satuanbeli where satuan_beli = '$post[satuan_beli]' AND id_satuanbeli != '$post[id_satuan]'");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('SatuanBeliCheck', '%s ini sudah dipakai');
            return false;
        } else {
            return true;
        }
    }

    //Satuan Jual Barang
    public function satuanJual()
    {
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['satuan'] = $this->M_barang->getSatuanJual()->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Barang/satuanJual', $data);
        $this->load->view('template/footer');
    }

    // public function tambahSatuanJual(){
    //     $this->form_validation->set_rules('satuan_jual','Satuan','required|is_unique[tb_satuanjual.satuan_jual]');
    //     $this->form_validation->set_message('required' , '%s Tidak Boleh Dikosongkan, Harus Diisi!');
    //     $this->form_validation->set_message('is_unique','%s Sudah Ada!');
    //     $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

    //     if($this->form_validation->run() == FALSE){
    //         $data['profil'] = $this->M_profil->getProfil()->result();
    //         $data['satuan'] = $this->M_barang->getSatuanJual()->result();
    //         $this->load->view('template/header');
    //         $this->load->view('template/sidebar',$data);
    //         $this->load->view('v_admin/Barang/satuanJual',$data);
    //         $this->load->view('template/footer');
    //     }else{
    //         $satuan_jual  = $this->input->post('satuan_jual');

    //         $data = array(
    //             'satuan_jual'     => $satuan_jual,
    //         );

    //         $this->M_barang->addSatuanJual($data,'tb_satuanjual');
    //         if($this->db->affected_rows() > 0){
    //             $this->session->set_flashdata('Success', 'Satuan Jual berhasil ditambahkan');
    //             redirect('Master_data/Barang/satuanJual');
    //         }else{
    //             redirect('Master_data/Barang/satuanJual');
    //         }
    //     }
    // }

    // public function editSatuanJual($id_satuan){
    // $where = array('id_satuan' => $id_satuan);
    // $data['profil'] = $this->M_profil->getProfil()->result();
    // $data['satuan'] = $this->M_barang->editSatuanJual($where)->result();
    //     $this->load->view('template/header');
    //     $this->load->view('template/sidebar',$data);
    //     $this->load->view('v_admin/Barang/edit_satuanjual',$data);
    //     $this->load->view('template/footer');
    // }

    // public function prosesEditSatuanJual(){
    //     $this->form_validation->set_rules('satuan_jual','Satuan','required|max_length[15]|callback_SatuanJualCheck');
    //     $this->form_validation->set_message('required' , '%s Tidak Boleh Dikosongkan, Harus Diisi!');
    //     $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

    //     if($this->form_validation->run() == FALSE){
    //     $id_satuan = $this->input->post('id_satuan');
    //     $where = array('id_satuan' => $id_satuan);
    //     $data['profil'] = $this->M_profil->getProfil()->result();
    //     $data['satuan'] = $this->M_barang->editSatuanJual($where)->result();
    //     $this->load->view('template/header');
    //     $this->load->view('template/sidebar',$data);
    //     $this->load->view('v_admin/Barang/edit_satuanjual',$data);
    //     $this->load->view('template/footer');
    //     }else{
    //         $id_satuan      = $this->input->post('id_satuan');
    //         $satuan_jual  = $this->input->post('satuan_jual');

    //         $data = array(
    //             'id_satuan'     => $id_satuan,
    //             'satuan_jual' => $satuan_jual
    //         );

    //         $where  = array('id_satuan' => $id_satuan);

    //         $this->M_barang->updateSatuanJual($where,$data,'tb_satuanjual');
    //         if($this->db->affected_rows() > 0 ){
    //             $this->session->set_flashdata('Success', 'Satuan Jual berhasil diubah');
    //             redirect('Master_data/Barang/satuanJual');
    //         }else{
    //             redirect('Master_data/Barang/satuanJual');
    //         }
    //     }
    // }

    // public function deleteSatuanJual($id_satuan){
    //     $where = array('id_satuan' => $id_satuan);
    //     $this->M_barang->deleteSatuanJual($where,'tb_satuanjual');
    //     if($this->db->affected_rows() > 0){
    //         $this->session->set_flashdata('Success', 'Satuan Jual berhasil dihapus');
    //         redirect('Master_data/Barang/satuanJual');
    //     }else{
    //         redirect('Master_data/Barang/satuanJual');
    //     }
    // }

    // function SatuanJualCheck(){
    //     $post = $this->input->post(null,true);
    //     $query = $this->db->query("select * from tb_satuanjual where satuan_jual = '$post[satuan_jual]' AND id_satuan != '$post[id_satuan]'");
    //     if($query->num_rows() > 0 ){
    //         $this->form_validation->set_message('SatuanJualCheck' , '%s ini sudah dipakai');
    //         return false;
    //     }else{
    //         return true;
    //     }
    // }

    //Kategori Barang
    //List Kategori Barang
    public function kategoriBarang()
    {
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['kategori'] = $this->M_barang->getKategori()->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Barang/kategori', $data);
        $this->load->view('template/footer');
    }

    public function tambahKategori()
    {
        $this->form_validation->set_rules('kategori_barang', 'Kategori Barang', 'required|is_unique[tb_kategori.kategori_barang]');
        $this->form_validation->set_message('required', '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_message('is_unique', '%s Sudah Ada!');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $data['profil'] = $this->M_profil->getProfil()->result();
            $data['kategori'] = $this->M_barang->getKategori()->result();
            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Barang/kategori', $data);
            $this->load->view('template/footer');
        } else {
            $kategori_barang  = $this->input->post('kategori_barang');

            $data = array(
                'kategori_barang'     => $kategori_barang,
            );

            $this->M_barang->addKategori($data, 'tb_kategori');
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('Success', 'Kategori berhasil ditambahkan');
                redirect('Master_data/Barang/kategoriBarang');
            } else {
                redirect('Master_data/Barang/kategoriBarang');
            }
        }
    }

    public function editKategori($id_kategori)
    {
        $where = array('id_kategori' => $id_kategori);
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['kategori'] = $this->M_barang->editKategori($where)->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Barang/edit_kategori', $data);
        $this->load->view('template/footer');
    }

    public function prosesEditKategori()
    {
        $this->form_validation->set_rules('kategori_barang', 'Kategori Barang', 'required');
        $this->form_validation->set_message('required', '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $id_kategori = $this->input->post('id_kategori');
            $where = array('id_kategori' => $id_kategori);
            $data['profil'] = $this->M_profil->getProfil()->result();
            $data['kategori'] = $this->M_barang->editKategori($where)->result();
            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Barang/edit_kategori', $data);
            $this->load->view('template/footer');
        } else {
            $id_kategori      = $this->input->post('id_kategori');
            $kategori_barang  = $this->input->post('kategori_barang');

            $data = array(
                'id_kategori'     => $id_kategori,
                'kategori_barang' => $kategori_barang
            );

            $where  = array('id_kategori' => $id_kategori);

            $this->M_barang->updateKategori($where, $data, 'tb_kategori');
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('Success', 'kategori berhasil diubah');
                redirect('Master_data/Barang/kategoriBarang');
            } else {
                redirect('Master_data/Barang/kategoriBarang');
            }
        }
    }

    public function deleteKategori($id_kategori)
    {
        $where = array('id_kategori' => $id_kategori);
        $this->M_barang->deleteKategori($where, 'tb_kategori');
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('Success', 'Kategori berhasil dihapus');
            redirect('Master_data/Barang/kategoriBarang');
        } else {
            redirect('Master_data/Barang/kategoriBarang');
        }
    }
}
