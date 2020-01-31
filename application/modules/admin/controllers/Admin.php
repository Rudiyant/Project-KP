<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->model('AdminModel');
	}

	public function index()
	{
		$data['title'] = "Dasboard Admin";
		$this->blade->render('admin', $data);
	}
 
	public function cariKaryawan() 
	{
		error_reporting(0);
		$data['title'] = "Data Karyawan";
		$this->blade->render('admin/tambahDirektur');
	}
 
	public function dataKaryawan()
	{
		error_reporting(0);

		$data2['cari'] = $this->AdminModel->cariNiy();
		$this->blade->render('admin/dataKaryawan', $data2);
	}

	// public function tambah()
	// {
	// 	$data['title'] = "Data Direktur";
	// 	$postData['direktur'] = $this->AdminModel->postData("*", "direktur");
	// 	$this->blade->render('admin/direktur', $postData);
	// }
	
	public function download()
	{
		error_reporting(0);
		$data['title'] = "Download Surat";
		$this->blade->render('admin/download');
	}

	public function izin()
	{
		$data['title'] = "Daftar Permohonan Izin";
		$this->blade->render('admin/izin', $data);
	}

	public function cuti()
	{
		error_reporting(0);
		$data['title'] = "Permohonan Cuti";
		$getData['surat_cutis'] = $this->AdminModel->getJoin("*", "surat_cuti", "karyawan", 
														  "surat_cuti.id_karyawan = karyawan.id_karyawan");
		$this->blade->render('admin/cuti', $getData);
	}

	public function cetak()
	{
		error_reporting(0);
		$id=$_GET['id_karyawan'];
		$getData['karyawans'] = $this->AdminModel->getJoin("*", "karyawan", "surat_cuti",
															"karyawan.id_karyawan = surat_cuti.id_karyawan
															and karyawan.id_karyawan = '$id'");
		$this->blade->render('admin/cetak', $getData);
	}

	public function balas()
	{
		$data['title'] = "Cetak Surat Balasan";
		$this->blade->render('admin/balas', $data);
	}

	public function direktur()
	{
		error_reporting(0);
		$data['title'] = "Daftar Direktur";
		$getData['direkturs'] = $this->AdminModel->getData("*", "direktur");
		$this->blade->render('admin/direktur', $getData);
		
	}

}