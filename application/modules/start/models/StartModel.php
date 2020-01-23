<?php
class StartModel extends CI_Model
{
    function auth_admin($username, $password){
        $query = $this->db->query("SELECT * FROM admin WHERE username='$username' AND password='$password'");
        return $query;
    }
 
    function auth_karyawan($username, $password){
        $query=$this->db->query("SELECT * FROM karyawan WHERE niy='$username' AND password='$password'");
        return $query;
    }

    function auth_magang($username, $password){
        $query=$this->db->query("SELECT * FROM karyawan WHERE nik='$username' AND password='$password'");
        return $query;
    }

    public function findByUsername($username) {
        return $this->db->where('username', $username)->get('admin')->row_array();
    }

    public function findByNIY($username) {
        return $this->db->where('niy', $username)->get('karyawan')->row_array();
    }

    public function findByNIK($username) {
        return $this->db->where('nik', $username)->get('karyawan')->row_array();
    }
}
?>