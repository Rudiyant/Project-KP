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
			$admin = $this->StartModel->findByUsername($username);
			$data = array(
				'nama'  => $admin['nama_admin'],
				'logged_in' => TRUE
			);
			$this->session->set_userdata($data);
			redirect('admin');
		} else {
			$cek_karyawan = $this->StartModel->auth_karyawan($username, $password);
			if ($cek_karyawan->num_rows() > 0) //jika login sebagai karyawan
			{
				$karyawan = $this->StartModel->findByNIY($username);
				$data = array(
					'nama'  => $karyawan['nama'],
					'logged_in' => TRUE
				);
				$this->session->set_userdata($data);
				redirect('karyawan');
			} else {
				$cek_magang = $this->StartModel->auth_magang($username, $password);
				if ($cek_magang->num_rows() > 0) //jika login sebagai karyawan magang
				{
					$karyawan = $this->StartModel->findByNIK($username);
					$data = array(
						'nama'  => $karyawan['nama'],
						'logged_in' => TRUE
					);
					$this->session->set_userdata($data);
					redirect('magang');
				}
				else //jika username atau password tidak ada
				{
					$this->session->set_flashdata('failed', '<div style="color: red">Username atau password salah!</div>');
					redirect('start');
				}
			}
		}
	}

	public function logout()
	{
		$this->session->set_userdata('logged_in', 0);
		$this->session->unset_userdata('nama');
		$this->session->set_flashdata('logout', '<div style="color: green">Logout Berhasil.</div>');
		redirect('start');
	}
}
