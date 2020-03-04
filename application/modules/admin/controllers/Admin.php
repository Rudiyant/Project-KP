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
 
	// public function cariKaryawan() 
	// {
	// 	error_reporting(0);
	// 	$data['title'] = "Data Karyawan";
	// 	$this->blade->render('admin/tambahDirektur');
	// }
 
	public function dataKaryawan()
	{
		error_reporting(0);
		$data2['cari'] = $this->AdminModel->cariNiy();
		$this->blade->render('admin/dataKaryawan', $data2);
	}

	public function izin()
	{
		$data['title'] = "Daftar Permohonan Izin";
		$data['izin'] = $this->AdminModel->dataIzin();

		$this->blade->render('izin', $data);
	}

	public function cuti()
	{
		$data['title'] = "Daftar Permohonan Cuti";
		$data['cuti'] = $this->AdminModel->dataCuti();
		$this->blade->render('admin/cuti', $data);
	}

	public function tambah()
	{
		error_reporting(0);
		$data['title'] = "Tambah Data Direktur";
		if($_POST['tambah'])
		{
		$niy=$this->input->post('niy');
		$nama=$this->input->post('nama');
		$jabatan=$this->input->post('jabatan');
			$data=array
			(
				'niy' =>$niy,
				'nama'=>$nama,
				'jabatan'=>$jabatan
			);
		
		$insert=$this->AdminModel->insert('direktur', $data);
			if ($insert) 
			{
				redirect(base_url('admin/direktur'));
			}
		}
		$this->blade->render('admin/direktur');
	}

	public function setuju()
	{
		$nomorSurat = $_GET['nomor_surat'];
		$statusCuti['status_cuti'] = "1";
		$data['cuti'] = $this->AdminModel->setuju($nomorSurat, $statusCuti);
		$data['title'] = "Daftar Permohonan Cuti";
		$this->blade->render('admin/cuti', $data);
	}

	public function tolak()
	{
		$data['title'] = "Permohonan Cuti ditolak";
		$nomorSurat = $_GET['nomor_surat'];
		$data['cuti'] = $this->AdminModel->tolak($nomorSurat);

		$this->blade->render('balas', $data);
	}

	public function alasan()
	{
		$nomorSurat = $_GET['nomor_surat'];
		$statusCuti['status_cuti'] = "2";
		$statusCuti['keterangan'] = $this->input->post('alasan');
		$data['cuti'] = $this->AdminModel->setuju($nomorSurat, $statusCuti);
		$data['title'] = "Daftar Permohonan Cuti";
		$this->blade->render('admin/cuti', $data);
	}

	public function direktur(){
		$data['title'] = "Data Direktur";
		$data['direktur'] = $this->AdminModel->dataDirektur();

		$this->blade->render('direktur', $data);
	}

	public function tambahDirektur(){
		$data['title'] = "Tambah Data Direktur";
		$data['kode'] = "0";

		$this->blade->render('tambahDirektur', $data);
	}

	public function cariDirektur(){
		$data['title'] = "Tambah Data Direktur";
		$niy = $this->input->post('cari');
		$cekNiy = $this->AdminModel->cariDirektur($niy);
		
		if($cekNiy == NULL){
			$this->session->set_flashdata('niySalah', '<div style="color: red">NIY yang anda masukkan salah!</div>');
			redirect('admin/tambahDirektur');
		}

		$data['kode'] = "1";
		$data['direktur'] = $this->AdminModel->cariDirektur($niy);

		$this->blade->render('tambahDirektur', $data);
	}

	public function tambahkan($id_karyawan){
		$direktur = array(
			'id_karyawan'	  	=> $id_karyawan,
			'niy'				=> $this->input->post('niy'),
			'nama'      		=> $this->input->post('nama'),
			'jabatan'    		=> $this->input->post('jabatan'),
			'divisi'  			=> $this->input->post('divisi'),
			'status'			=> "1",
		);

		$this->AdminModel->tambahDirektur($direktur);
		$data['title'] = "Data Direktur";
		$data['direktur'] = $this->AdminModel->dataDirektur();

		$this->blade->render('direktur', $data);
	}
}