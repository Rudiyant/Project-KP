<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends MY_Controller
{

	public function index()
	{
		$data['title'] = "Selamat Datang User";
		$data['type'] = 'karyawan';
		$this->blade->render('karyawan', $data);
    }
    
    public function izin()
	{
		$data['title'] = "Formulir Permohonan Izin";
		$data['type'] = 'karyawan';
		$this->blade->render('izin', $data);
    }
    
    public function cuti()
	{
		$data['title'] = "Formulir Permohonan Cuti";
		$data['type'] = 'karyawan';
		$this->blade->render('cuti', $data);
    }

    public function cetakIzin()
	{
		$data['title'] = "Cetak Surat Izin";
		$data['type'] = 'karyawan';
		$this->blade->render('cetakIzin', $data);
    }
    
    public function editIzin()
	{
		$data['title'] = "Edit Data Izin";
		$data['type'] = 'karyawan';
		$this->blade->render('editIzin', $data);
    }
    
    public function statusCuti()
	{
		$data['title'] = "Status Permohonan Cuti";
		$data['type'] = 'karyawan';
		$this->blade->render('statusCuti', $data);
    }
    
    public function editCuti()
	{
		$data['title'] = "Edit Data Cuti";
		$data['type'] = 'karyawan';
		$this->blade->render('editCuti', $data);
	}
}