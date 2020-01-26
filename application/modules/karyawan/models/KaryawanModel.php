<?php
class KaryawanModel extends CI_Model
{
    public function dataKaryawan($id)
    {
        $query = $this->db->from('karyawan')
            ->where('karyawan.id_karyawan', $id)
            ->get()
            ->row_array();

        return $query;
    }

    public function buatSuratIzin($izin)
    {
        return $this->db->insert('surat_izin', $izin);
    }

    public function cetakIzin($id_izin)
    {
        $query = $this->db->from('surat_izin')
            ->where('surat_izin.id_izin', $id_izin)
            ->get()
            ->row_array();

        return $query;
    }

    public function update($izin)
    {
        $query = $this->db->where('id_izin', $izin['id_izin'])
                          ->update('surat_izin', $izin);
        return $query;
    }
}
