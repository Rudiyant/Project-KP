<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Magang extends MY_Controller
{

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
		$this->blade->render('izin', $data);
    }

    public function cetakIzin()
	{
		$data['title'] = "Cetak Surat Izin";
		$data['type'] = 'magang';
		$data['welcome'] = "0";
		$this->blade->render('cetakIzin', $data);
    }
    
    public function editIzin()
	{
		$data['title'] = "Edit Data Izin";
		$data['type'] = 'magang';
		$data['welcome'] = "0";
		$this->blade->render('editIzin', $data);
    }
}