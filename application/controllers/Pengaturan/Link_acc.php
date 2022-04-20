<?php
defined('BASEPATH') or exit('no direct script access allowed');

class Link_acc extends CI_Controller
{


    function kondisiLink()
    {
        $query = $this->db->get('tb_linkacc');
        if ($query->num_rows() > 0) {
            redirect('Pengaturan/Link_acc/updateLink');
        } else {
            redirect('Pengaturan/Link_acc/formLink');
        }
    }

    public function formLink()
    {
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['coa'] = $this->M_coa->getCoaTrans()->result();
        $data['jual'] = $this->M_coa->getLinkJual()->result_array();
        $data['beli'] = $this->M_coa->getLinkBeli()->result_array();
        $data['modal'] = $this->M_coa->getLinkModal()->result_array();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Link_Account/formLinkAccount', $data);
        $this->load->view('template/footer');
    }

    public function addLinkAcc()
    {
        $id_akun    = $this->input->post('id_akun');
        $link       = $this->input->post('link');
        $jenis      = $this->input->post('jenis');

        $data = array();

        foreach ($id_akun as $akun => $id) {
            array_push($data, array(
                'id_akun' => $id,
                'keterangan_link' => $link[$akun],
                'jenis_link' => $jenis[$akun]
            ));
        }

        $this->db->insert_batch('tb_linkacc', $data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('Success', 'Link Account berhasil ditambahkan');
            redirect('Pengaturan/Link_acc/updateLink');
        } else {
            redirect('Pengaturan/Link_acc/updateLink');
        }
    }

    public function updateLink()
    {
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['coa'] = $this->M_coa->getCoaTrans()->result();
        $data['jual'] = $this->M_coa->getLinkJual()->result();
        $data['beli'] = $this->M_coa->getLinkBeli()->result();
        $data['modal'] = $this->M_coa->getLinkModal()->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Link_Account/listLink', $data);
        $this->load->view('template/footer');
    }

    public function formEditLink($id_link)
    {
        $data['profil'] = $this->M_profil->getProfil()->result();
        $data['coa'] = $this->M_coa->getCoaTrans()->result();

        // $data['jual'] = $this->M_coa->getLinkJual()->result();
        // $data['beli'] = $this->M_coa->getLinkBeli()->result();
        $where = $id_link;
        $data['link'] = $this->M_coa->getLink($where)->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Link_Account/formEditLink', $data);
        $this->load->view('template/footer');
    }

    public function prosesEditLink()
    {
        $id_link = $this->input->post('id_link');
        $id_akun = $this->input->post('id_akun');
        $keterangan = $this->input->post('keterangan');
        $jenis = $this->input->post('jenis');

        $data = array(
            'id_akun'            => $id_akun,
            'keterangan_link'    => $keterangan,
            'jenis_link'         => $jenis
        );

        $where = array('id_link' => $id_link);

        $this->M_coa->updateLink($where, $data, 'tb_linkacc');
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('Success', 'Link Account Berhasil Diubah');
            redirect('Pengaturan/Link_acc/updateLink');
        } else {
            redirect('Pengaturan/Link_acc/updateLink');
        }
    }

    public function tambahLinkAcc()
    {
        $data['coa'] = $this->M_coa->getCoaTrans()->result();
        $data['profil'] = $this->M_profil->getProfil()->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_admin/Link_Account/tambah_linkAcc', $data);
        $this->load->view('template/footer');
    }

    public function prosesTambahLinkAcc()
    {
        $this->form_validation->set_rules('id_akun', 'Akun', 'required|is_unique[tb_linkacc.id_akun]');
        $this->form_validation->set_rules('keterangan', 'Keterangan Link Account', 'required');
        $this->form_validation->set_rules('jenis', 'Jenis Link Account', 'required');

        $this->form_validation->set_message('required', '%s Tidak Boleh Dikosongkan, Harus Diisi!');
        $this->form_validation->set_message('is_unique', '%s Sudah Ada');
        $this->form_validation->set_error_delimiters('<span class="text-danger text-xs font-weight-bold">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $data['coa'] = $this->M_coa->getCoaTrans()->result();
            $data['profil'] = $this->M_profil->getProfil()->result();
            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('v_admin/Link_Account/tambah_linkAcc', $data);
            $this->load->view('template/footer');
        } else {
            $id_akun = $this->input->post('id_akun');
            $keterangan = $this->input->post('keterangan');
            $jenis = $this->input->post('jenis');

            $data = array(
                'id_akun' => $id_akun,
                'keterangan_link' => $keterangan,
                'jenis_link' => $jenis
            );

            $this->db->insert('tb_linkacc', $data);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('Success', 'Link Account berhasil ditambahkan');
                redirect('Pengaturan/Link_acc/updateLink');
            } else {
                redirect('Pengaturan/Link_acc/updateLink');
            }
        }
    }
}
