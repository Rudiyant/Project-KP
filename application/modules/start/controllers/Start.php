<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Start extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('StartModel');
	}

	public function index()
	{
		$this->blade->render('start');
	}
	
	public function authenticate()
	{
		$username   = $this->input->post('username');
		$password   = $this->input->post('password');

		$cek_admin = $this->StartModel->auth_admin($username, $password);
		if ($cek_admin->num_rows() > 0) //jika login sebagai admin
		{
			redirect('admin');
		} 
		else 
		{
			$cek_karyawan = $this->StartModel->auth_karyawan($username, $password);
			if ($cek_karyawan->num_rows() > 0) //jika login sebagai karyawan
			{
				redirect('karyawan');
			} 
			else 
			{ 
				$cek_magang = $this->StartModel->auth_magang($username, $password);
				if ($cek_magang->num_rows() > 0) //jika login sebagai karyawan magang
				{
					redirect('magang');
				}
		}
	}
}
}