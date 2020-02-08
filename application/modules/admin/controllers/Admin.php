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
	
	public function download()
	{
		error_reporting(0);
		$data['title'] = "Download Surat";
		$this->blade->render('admin/download');
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

	public function cetak()
	{
		//error_reporting(0);
		//$id=$_GET['id_karyawan'];
		$getData['karyawans'] = $this->AdminModel->getJoin("*", "karyawan", "surat_cuti",
															"karyawan.id_karyawan = surat_cuti.id_karyawan
															");
		$this->blade->render('admin/cetak', $getData);
	}

	public function balas()
	{
		error_reporting(0);
		$data['title'] = "Surat Balasan";
		$id=$_GET['id_karyawan'];
		$getData['surat_cutis'] = $this->AdminModel->getJoin("*", "surat_cuti", "karyawan", 
														  "surat_cuti.id_karyawan = karyawan.id_karyawan
														  and karyawan.id_karyawan = '$id'");
		$this->blade->render('admin/balas', $getData);
	}

	public function direktur()
	{
		error_reporting(0);
		$getData['title'] = "Daftar Direktur";
		$getData['direkturs'] = $this->AdminModel->getData("*", "direktur");
		$this->blade->render('admin/direktur', $getData);
		
	}

	public function setuju()
	{
		$nomorSurat = $_GET['nomor_surat'];
		$statusCuti['status_cuti'] = "1";
		$data['cuti'] = $this->AdminModel->setuju($nomorSurat, $statusCuti);
		$data['title'] = "Daftar Permohonan Cuti";
		$this->blade->render('admin/cuti', $data);
		
	}

}