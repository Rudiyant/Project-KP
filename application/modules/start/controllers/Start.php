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
			$admin = $this->StartModel->findAdmin($username);
			$data = array(
				'nama'  => $admin['nama'],
				'id'	=> $admin['id_admin'],
				'logged_in' => TRUE
			);
			$this->session->set_userdata($data);
			redirect('admin');
		} else {
			$cek_karyawan = $this->StartModel->auth_karyawan($username, $password);
			if ($cek_karyawan->num_rows() > 0) //jika login sebagai karyawan
			{
				$loginKaryawan = $this->StartModel->findKaryawan($username);
				$karyawan = $this->StartModel->getKaryawan($loginKaryawan['akun_id']);
				if ($karyawan['niy'] != null) {
					$data = array(
						'nama'  => $karyawan['nama'],
						'id'	=> $karyawan['id_karyawan'],
						'logged_in' => TRUE
					);
					$this->session->set_userdata($data);
					redirect('karyawan');
				} else if ($karyawan['nik'] != null) {
						$data = array(
							'nama'  => $karyawan['nama'],
							'id'	=> $karyawan['id_karyawan'],
							'logged_in' => TRUE
						);
						$this->session->set_userdata($data);
						redirect('magang');
					}
			} else {
				$this->session->set_flashdata('failed', '<div style="color: red">Username atau password salah!</div>');
				redirect('start');
			}
		}
	}

	public function logout()
	{
		$this->session->set_userdata('logged_in', 0);
		$this->session->unset_userdata('nama', 'id');
		$this->session->set_flashdata('logout', '<div style="color: green">Logout Berhasil.</div>');
		redirect('start');
	}
}
