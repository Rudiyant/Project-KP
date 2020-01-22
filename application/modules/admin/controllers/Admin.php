<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MY_Controller
{
	public function index()
	{
		$data['title'] = "Dasboard Admin";
		$this->blade->render('admin', $data);
	}

	public function izin()
	{
		$data['title'] = "Daftar Permohonan Izin";
		$this->blade->render('admin/izin', $data);
	}

	public function cuti()
	{
		$data['title'] = "Daftar Permohonan Cuti";
		$this->blade->render('admin/cuti', $data);
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