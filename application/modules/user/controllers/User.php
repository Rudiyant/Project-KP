<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends MY_Controller
{

	public function index()
	{
		$data['title'] = "Selamat Datang User";
		$this->blade->render('user', $data);
    }
    
    public function izin()
	{
		$data['title'] = "Formulir Permohonan Izin";
		$this->blade->render('izin', $data);
    }
    
    public function cuti()
	{
		$data['title'] = "Formulir Permohonan Cuti";
		$this->blade->render('cuti', $data);
    }

    public function cetakIzin()
	{
		$data['title'] = "Cetak Surat Izin";
		$this->blade->render('cetakIzin', $data);
    }
    
    public function editIzin()
	{
		$data['title'] = "Edit Data Izin";
		$this->blade->render('editIzin', $data);
    }
    
    public function statusCuti()
	{
		$data['title'] = "Status Permohonan Cuti";
		$this->blade->render('statusCuti', $data);
    }
    
    public function editCuti()
	{
		$data['title'] = "Edit Data Cuti";
		$this->blade->render('editCuti', $data);
	}
}