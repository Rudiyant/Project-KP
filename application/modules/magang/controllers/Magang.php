<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Magang extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('MagangModel');
	}

	public function index()
	{
		$data['title'] = "Selamat Datang ";
		$data['welcome'] = "1";
		$data['type'] = 'magang';
		$this->blade->render('magang', $data);
    }
    
    public function izin()
	{
		$data['title'] = "Formulir Permohonan Izin";
		$data['type'] = 'magang';
		$data['welcome'] = "0";

		$id = $this->session->userdata('id');
		$data['karyawan'] = $this->MagangModel->dataKaryawan($id);

		$this->blade->render('izin', $data);
	}
	
	public function buatSuratIzin()
	{
		$data['title'] = "Cetak Surat Izin";
		$data['type'] = 'karyawan';
		$data['welcome'] = "0";
		$id_izin = random_string('alnum', 5);

		$keterangan = $this->input->post('keterangan');
		if ($keterangan == "Ada Keperluan") {
			$keterangan = $this->input->post('perlu');
		}
		if ($keterangan == "Lain-lain") {
			$keterangan = $this->input->post('lain');
		}

		$izin = array(
			'id_izin'	  		=> $id_izin,
			'keterangan_izin'   => $keterangan,
			'alasan_izin'       => $this->input->post('alasan'),
			'hari_tanggal'      => $this->input->post('tanggal'),
			'lama_waktu_izin'   => $this->input->post('lama'),
			'status_izin'		=> "OK",
			'id_karyawan'		=> $this->session->userdata('id'),
		);

		$this->MagangModel->buatSuratIzin($izin);
		redirect('magang/cetakIzin/' . $id_izin);
	}

    public function cetakIzin($id_izin)
	{
		$data['title'] = "Cetak Surat Izin";
		$data['type'] = 'magang';
		$data['welcome'] = "0";

		$data['izin'] = $this->MagangModel->cetakIzin($id_izin);

		$this->blade->render('cetakIzin', $data);
    }
    
    public function editIzin($id_izin)
	{
		$data['title'] = "Edit Data Izin";
		$data['type'] = 'magang';
		$data['welcome'] = "0";

		$id = $this->session->userdata('id');
		$data['karyawan'] = $this->MagangModel->dataKaryawan($id);

		$data['izin'] = $this->MagangModel->cetakIzin($id_izin);

		$this->blade->render('editIzin', $data);
	}

	public function update($id_izin)
	{
		$data['title'] = "Cetak Surat Izin";
		$data['type'] = 'magang';
		$data['welcome'] = "0";

		$keterangan = $this->input->post('keterangan');
		if ($keterangan == "Ada Keperluan") {
			$keterangan = $this->input->post('perlu');
		}
		if ($keterangan == "Lain-lain") {
			$keterangan = $this->input->post('lain');
		}

		$izin = array(
			'id_izin'			=> $id_izin,
			'keterangan_izin'   => $keterangan,
			'alasan_izin'       => $this->input->post('alasan'),
			'hari_tanggal'      => $this->input->post('tanggal'),
			'lama_waktu_izin'   => $this->input->post('lama'),
			'status_izin'		=> "OK",
			'id_karyawan'		=> $this->session->userdata('id'),
		);

		$this->MagangModel->update($izin);
		redirect('magang/cetakIzin/' . $id_izin);
	}
}