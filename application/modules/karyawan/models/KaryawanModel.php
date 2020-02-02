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

    public function cekNoSurat($bulan)
    {
        $cek = $this->db->query("SELECT max(nomor_surat) as maxKode FROM surat_cuti WHERE month(tanggal)='$bulan'");
        $ex = explode('/', $cek['nomor_surat']);

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
}
