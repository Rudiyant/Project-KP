<?php
class AdminModel extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function cariNiy()
    {
        $cari = $this->input->post('cari', TRUE);
        $data = $this->db->query("SELECT * from karyawan where niy like '%$cari%' ");
        return $data->result();
    }

    function getData($select, $table, $where = false)
    {
        if ($where) {
            return $this->db
                ->select($select)
                ->from($table)
                ->where($where)
                ->get()
                ->row();
        } else {
            return $this->db
                ->select($select)
                ->get($table)
                ->result();
        }
    }

    function postData($insert, $tabel3, $tabel4)
    {
        return $this->db
            ->insert($insert)
            ->select($tabel3)
            ->from($tabel4)
            ->set($insert);
    }

    function getJoin($kolom, $table1, $table2, $syarat)
    {
        $this->db->select($kolom);
        $this->db->from($table1);
        $this->db->join($table2, $syarat);

        $query = $this->db->get()->result();

        return $query;
    }

    function insert($insert, $value)
    {
        $this->db->insert($insert, $value);
    }

    // function add()
    // {
    //     $params = [
    //         'niy' => $post['niy'],
    //         'nama'=> $post['nama'],
    //         'nama_jabatan' => $post['nama_jabatan']
    //     ];
    //     $this->db->insert('direktur',$params);
    // }

    public function dataIzin()
    {
        $query = $this->db->query('SELECT * FROM surat_izin s INNER JOIN karyawan k ON s.id_karyawan=k.id_karyawan')->result_array();
        return $query;
    }

    public function dataCuti()
    {
        $query = $this->db->query('SELECT * FROM surat_cuti s INNER JOIN karyawan k ON s.id_karyawan=k.id_karyawan')->result_array();
        return $query;
    }

    public function setuju($updateData)
    {
        // $this->db->query("UPDATE surat_cuti SET status_cuti = '1' WHERE nomor_surat ='$nomorSurat'");
        $this->db->set($updateData)->where('nomor_surat', $updateData['nomor_surat'])->update('surat_cuti', $updateData);
        $query = $this->db->query('SELECT * FROM surat_cuti s INNER JOIN karyawan k ON s.id_karyawan=k.id_karyawan')->result_array();
        return $query;
    }
}
