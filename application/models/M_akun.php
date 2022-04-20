<?php
defined('BASEPATH') or exit('No Direct Script Access Allowed');

class M_akun extends CI_Model
{

    public function getProfilPengguna($id)
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where('id_user', $id);
        return $this->db->get();
    }

    public function updateProfilPengguna($post)
    {
        $params['username'] = $post['username'];
        if (!empty($post['password'])) {
            $params['password'] = sha1($post['password']);
        }
        $params['nama_user'] = $post['nama_pengguna'];
        $params['telp_user'] = $post['no_telp'];
        $params['alamat_user'] = $post['alamat'];
        $this->db->where('id_user', $post['id_user']);
        $this->db->update('tb_user', $params);
    }
}
