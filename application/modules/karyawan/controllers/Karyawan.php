<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('KaryawanModel');
	}

	public function index()
	{
		$data['title'] = "Selamat Datang ";
		$data['type'] = 'karyawan';
		$data['welcome'] = "1";
		$this->blade->render('karyawan', $data);
	}

	public function izin()
	{
		$data['title'] = "Formulir Permohonan Izin";
		$data['type'] = 'karyawan';
		$data['welcome'] = "0";

		$id = $this->session->userdata('id');
		$data['karyawan'] = $this->KaryawanModel->dataKaryawan($id);

		$this->blade->render('izin', $data);
	}

	public function buatSuratIzin()
	{
		$data['title'] = "Cetak Surat Izin";
		$data['type'] = 'karyawan';
		$data['welcome'] = "0";
		$id_izin = random_string('alnum', 5);

		$keterangan = $this->input->post('keterangan');
		if($keterangan == null){
			$keterangan = $this->input->post('perlu');
		}
		if($keterangan == null)
		{
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

		$this->KaryawanModel->buatSuratIzin($izin);
		redirect('karyawan/cetakIzin/' . $id_izin);
	}

	public function cetakIzin($id_izin)
	{
		$data['title'] = "Cetak Surat Izin";
		$data['type'] = 'karyawan';
		$data['welcome'] = "0";

		$data['izin'] = $this->KaryawanModel->cetakIzin($id_izin);

		$this->blade->render('cetakIzin', $data);
	}

	public function editIzin($id_izin)
	{
		$data['title'] = "Edit Data Izin";
		$data['type'] = 'karyawan';
		$data['welcome'] = "0";

		$id = $this->session->userdata('id');
		$data['karyawan'] = $this->KaryawanModel->dataKaryawan($id);

		$data['izin'] = $this->KaryawanModel->cetakIzin($id_izin);

		$this->blade->render('editIzin', $data);
	}

	public function update($id_izin)
	{
		$data['title'] = "Cetak Surat Izin";
		$data['type'] = 'karyawan';
		$data['welcome'] = "0";

		$keterangan = $this->input->post('keterangan');
		if($keterangan == null){
			$keterangan = $this->input->post('perlu');
		}
		if($keterangan == null)
		{
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

		$this->KaryawanModel->update($izin);
		redirect('karyawan/cetakIzin/' . $id_izin);
	}

	public function cuti()
	{
		$data['title'] = "Formulir Permohonan Cuti";
		$data['type'] = 'karyawan';
		$data['welcome'] = "0";

		$id = $this->session->userdata('id');
		$data['karyawan'] = $this->KaryawanModel->dataKaryawan($id);

		$this->blade->render('cuti', $data);
	}

	public function statusCuti()
	{
		$data['title'] = "Status Permohonan Cuti";
		$data['type'] = 'karyawan';
		$data['welcome'] = "0";
		$this->blade->render('statusCuti', $data);
	}

	public function editCuti()
	{
		$data['title'] = "Edit Data Cuti";
		$data['type'] = 'karyawan';
		$data['welcome'] = "0";
		$this->blade->render('editCuti', $data);
	}
}
