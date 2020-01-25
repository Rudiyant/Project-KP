<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('AdminModel');
	}

	public function index()
	{
		$data['title'] = "Dasboard Admin";
		$this->blade->render('admin', $data);
	}
	
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
		$id=$_GET['id_karyawan'];
		error_reporting(0);
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
		$data['title'] = "Daftar Direktur";
		$this->blade->render('admin/direktur', $data);
	}

	public function tambah()
	{
		$data['title'] = "Tambah Direktur";
		$this->blade->render('admin/tambahDirektur', $data);
	}
}