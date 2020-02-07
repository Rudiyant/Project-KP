<?php
class StartModel extends CI_Model
{
    function auth_admin($username, $password){
        $query = $this->db->query("SELECT * FROM admin WHERE username='$username' AND password='$password'");
        return $query;
    }
 
    function auth_karyawan($username, $password){
        $query=$this->db->query("SELECT * FROM karyawan_akun WHERE akun_username='$username' AND akun_password='$password' AND is_active='1'");
        return $query;
    }

    public function findAdmin($username) {
        return $this->db->where('username', $username)->get('admin')->row_array();
    }

    public function findKaryawan($username) {
        return $this->db->where('akun_username', $username)->get('karyawan_akun')->row_array();
    }

    public function getKaryawan($akun_id) {
        return $this->db->where('akun_id', $akun_id)->get('karyawan')->row_array();
    }
}
?>