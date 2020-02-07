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

    public function cekNoSurat()
    {
        $cek = $this->db->query("SELECT max(nomor_surat) as nomor FROM surat_cuti")->row_array();
        $ex = explode('/', $cek['nomor']);

        if (date('d') == '01') {
            $nomor = '01';
        } else {
            $nomor = sprintf("%02d", $ex[0] + 1);
        }

        return $nomor;
    }

    public function buatSuratCuti($cuti)
    {
        return $this->db->insert('surat_cuti', $cuti);
    }

    public function statusCuti($nomorSurat)
    {
        $query = $this->db->from('surat_cuti')
            ->where('surat_cuti.nomor_surat', $nomorSurat)
            ->get()
            ->row_array();

        return $query;
    }

    public function updateCuti($cuti)
    {
        $query = $this->db->where('nomor_surat', $cuti['nomor_surat'])
                          ->update('surat_cuti', $cuti);
        return $query;
    }
}
