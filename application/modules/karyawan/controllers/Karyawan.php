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

	public function getRomawi($bln){
		switch ($bln){
			case 1: 
				return "I";
				break;
			case 2:
				return "II";
				break;
			case 3:
				return "III";
				break;
			case 4:
				return "IV";
				break;
			case 5:
				return "V";
				break;
			case 6:
				return "VI";
				break;
			case 7:
				return "VII";
				break;
			case 8:
				return "VIII";
				break;
			case 9:
				return "IX";
				break;
			case 10:
				return "X";
				break;
			case 11:
				return "XI";
				break;
			case 12:
				return "XII";
				break;
		}
}

	public function buatSuratCuti()
	{
		$data['title'] = "Buat Surat Cuti";
		$data['type'] = 'karyawan';
		$data['welcome'] = "0";

		$bulan = date('n');
		$romawi = redirect('karyawan/getRomawi/' . $bulan);
		$tahun = date ('Y');
		$nomor = "/SIC/".$romawi."/".$tahun;

		$izin = array(
			'alasan_izin'       => $this->input->post('alasan'),
			'hari_tanggal'      => $this->input->post('tanggal'),
			'lama_waktu_izin'   => $this->input->post('lama'),
			'status_izin'		=> "OK",
			'id_karyawan'		=> $this->session->userdata('id'),
		);

		$this->KaryawanModel->buatSuratIzin($izin);
		redirect('karyawan/cetakIzin/');
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
