<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('KaryawanModel');
		$this->load->library('pdf');
	}

	public function index()
	{
		$data['title'] = "Selamat Datang ";
		$data['type'] = 'karyawan';
		$data['welcome'] = "1";
		$this->blade->render('karyawan', $data);
	}

	public function izin()
	{
		$data['title'] = "Formulir Permohonan Izin";
		$data['type'] = 'karyawan';
		$data['welcome'] = "0";

		$id = $this->session->userdata('id');
		$data['karyawan'] = $this->KaryawanModel->dataKaryawan($id);

		$this->blade->render('izin', $data);
	}

	public function buatSuratIzin()
	{
		$data['title'] = "Cetak Surat Izin";
		$data['type'] = 'karyawan';
		$data['welcome'] = "0";
		$id_izin = random_string('alnum', 5);

		include "tgl_indo.php";

		$keterangan = $this->input->post('keterangan');
		if ($keterangan == "Ada Keperluan") {
			$keterangan = $this->input->post('perlu');
		}
		if ($keterangan == "Lain-lain") {
			$keterangan = $this->input->post('lain');
		}

		$tgl = date('Y-m-d', strtotime($this->input->post('tanggal')));
		$tglSurat = tgl_indo($tgl, true);

		$izin = array(
			'id_izin'	  		=> $id_izin,
			'keterangan_izin'   => $keterangan,
			'alasan_izin'       => $this->input->post('alasan'),
			'hari_tanggal'      => $tglSurat,
			'lama_waktu_izin'   => $this->input->post('lama'),
			'status_izin'		=> "OK",
			'id_karyawan'		=> $this->session->userdata('id'),
		);

		$this->KaryawanModel->buatSuratIzin($izin);
		redirect('karyawan/cetakIzin/' . $id_izin);
	}

	public function cetakIzin($id_izin)
	{
		$data['title'] = "Cetak Surat Izin";
		$data['type'] = 'karyawan';
		$data['welcome'] = "0";

		$data['izin'] = $this->KaryawanModel->cetakIzin($id_izin);

		$this->blade->render('cetakIzin', $data);
	}

	public function editIzin($id_izin)
	{
		$data['title'] = "Edit Data Izin";
		$data['type'] = 'karyawan';
		$data['welcome'] = "0";

		$id = $this->session->userdata('id');
		$data['karyawan'] = $this->KaryawanModel->dataKaryawan($id);

		$data['izin'] = $this->KaryawanModel->cetakIzin($id_izin);

		$this->blade->render('editIzin', $data);
	}

	public function update($id_izin)
	{
		$data['title'] = "Cetak Surat Izin";
		$data['type'] = 'karyawan';
		$data['welcome'] = "0";

		include "tgl_indo.php";

		$keterangan = $this->input->post('keterangan');
		if ($keterangan == "Ada Keperluan") {
			$keterangan = $this->input->post('perlu');
		}
		if ($keterangan == "Lain-lain") {
			$keterangan = $this->input->post('lain');
		}

		$tgl = date('Y-m-d', strtotime($this->input->post('tanggal')));
		$tglSurat = tgl_indo($tgl, true);

		$izin = array(
			'id_izin'	  		=> $id_izin,
			'keterangan_izin'   => $keterangan,
			'alasan_izin'       => $this->input->post('alasan'),
			'hari_tanggal'      => $tglSurat,
			'lama_waktu_izin'   => $this->input->post('lama'),
			'status_izin'		=> "OK",
			'id_karyawan'		=> $this->session->userdata('id'),
		);

		$this->KaryawanModel->update($izin);
		$this->session->set_flashdata('update', '<div style="color: green">Data berhasil diupdate.</div>');
		redirect('karyawan/cetakIzin/' . $id_izin);
	}

	public function suratIzin($id_izin, $index)
	{
		$id = $this->session->userdata('id');
		$karyawan = $this->KaryawanModel->dataKaryawan($id);
		$izin = $this->KaryawanModel->cetakIzin($id_izin);

		$pdf = new FPDF('P', 'mm', 'A4');
		// membuat halaman baru
		$pdf->AddPage();
		$pdf->SetMargins(25, 5);
		$pdf->SetAutoPageBreak('off', 2);

		$image1 = base_url('assets/dist/img/Teladan.png');
		$image2 = base_url('assets/dist/img/sinai.png');
		$ctg = base_url('assets/dist/img/ctg.png');
		$nctg = base_url('assets/dist/img/nctg.png');

		//Header
		$pdf->Image($image2, 25, 4, 27);
		$pdf->Image($image1, 165, 4, 20);
		$pdf->Cell(0, 8, '', 0, 1);
		$pdf->SetFont('Times', 'B', 14);
		$pdf->Cell(0, 7, 'SURAT IZIN', 0, 1, 'C');
		$pdf->SetFont('Times', '', 12);
		$pdf->Ln(3);


		$pdf->Cell(20, 6, 'Saya yang bertandatangan di bawah ini,', 0, 1);
		$pdf->SetFont('Times', '', 12);
		//Nama
		$pdf->cell(20, 6, 'Nama', 1, 0);
		$pdf->cell(5, 6, ' :', 1, 0);
		$pdf->cell(0, 6, $karyawan['nama'], 1, 1);
		//Jabatan
		$pdf->cell(20, 6, 'Jabatan', 1, 0);
		$pdf->cell(5, 6, ' :', 1, 0);
		$pdf->cell(0, 6, $karyawan['nama_jabatan'], 1, 1);
		//Divisi
		$pdf->cell(20, 6, 'Divisi', 1, 0);
		$pdf->cell(5, 6, ' :', 1, 0);
		$pdf->cell(0, 6, $karyawan['nama_divisi'], 1, 1);

		$pdf->cell(0, 6, 'Dengan ini mengajukan izin untuk:', 1, 1);

		//Keterangan
		$pdf->SetFillColor(153, 255, 153);
		$pdf->cell(120, 6, 'Keterangan', 1, 0, 'C', true);
		$pdf->cell(0, 6, 'Lama Waktu Izin', 1, 1, 'C', true);
		//Isi Keterangan
		$keterangan = substr($izin['keterangan_izin'], 0, 7);
		switch ($keterangan) {
			case "Izin Ti":
				$pdf->cell(30, 6, $pdf->Image($ctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Izin tidak masuk', 1, 0);
				$pdf->cell(0, 6, $izin['lama_waktu_izin'], 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Izin terlambat masuk kerja', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Pulang Lebih Awal', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Meninggalkan sekolah saat jam kerja', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Ada keperluan', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Lain-lain', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				break;
			case "Izin Te":
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Izin tidak masuk', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($ctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Izin terlambat masuk kerja', 1, 0);
				$pdf->cell(0, 6, $izin['lama_waktu_izin'], 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Pulang Lebih Awal', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Meninggalkan sekolah saat jam kerja', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Ada keperluan', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Lain-lain', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				break;
			case "Pulang ":
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Izin tidak masuk', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Izin terlambat masuk kerja', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($ctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Pulang Lebih Awal', 1, 0);
				$pdf->cell(0, 6, $izin['lama_waktu_izin'], 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Meninggalkan sekolah saat jam kerja', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Ada keperluan', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Lain-lain', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				break;
			case "Meningg":
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Izin tidak masuk', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Izin terlambat masuk kerja', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Pulang Lebih Awal', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($ctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Meninggalkan sekolah saat jam kerja', 1, 0);
				$pdf->cell(0, 6, $izin['lama_waktu_izin'], 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Ada keperluan', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Lain-lain', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				break;
			case "Ada Kep":
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Izin tidak masuk', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Izin terlambat masuk kerja', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Pulang Lebih Awal', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Meninggalkan sekolah saat jam kerja', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($ctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, $izin['keterangan_izin'], 1, 0);
				$pdf->cell(0, 6, $izin['lama_waktu_izin'], 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Lain-lain', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				break;
			case "Lain-la":
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Izin tidak masuk', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Izin terlambat masuk kerja', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Pulang Lebih Awal', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Meninggalkan sekolah saat jam kerja', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Ada Keperluan', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($ctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, $izin['keterangan_izin'], 1, 0);
				$pdf->cell(0, 6, $izin['lama_waktu_izin'], 1, 1, 'C');
				break;
		}



		//Alasan
		$pdf->cell(30, 6, 'Alasan', 1, 0);
		$pdf->cell(0, 6, $izin['alasan_izin'], 1, 1);

		//Hari Tanggal
		$pdf->cell(30, 6, 'Hari Tanggal', 1, 0);
		$pdf->cell(0, 6, $izin['hari_tanggal'], 1, 1);

		//TTD
		$get_xxx = $pdf->GetX();
		$get_yyy = $pdf->GetY();
		$width_cell = 40;

		$pdf->multicell(40, 6, 'Mengetahui,
		Security
		

		(............................)', 1, 'C');
		$get_xxx += $width_cell;
		$pdf->SetXY($get_xxx, $get_yyy);

		$pdf->multicell(40, 6, 'Mengetahui,
		Direktur
		

		(............................)', 1, 'C');
		$get_xxx += $width_cell;
		$pdf->SetXY($get_xxx, $get_yyy);

		$pdf->multicell(40, 6, 'Mengetahui,
		Atasan Langsung

		
		(............................)', 1, 'C');
		$get_xxx += $width_cell;
		$pdf->SetXY($get_xxx, $get_yyy);

		$pdf->multicell(40, 6, 'Karyawan, ybs



		' . $karyawan['nama'], 1, 'C');
		$get_xxx += $width_cell;
		$pdf->SetXY($get_xxx, $get_yyy);

		$pdf->Cell(0, 31, '', 0, 1);
		$pdf->Cell(0, 5, '___________________________________________________________________________', 0, 1);
		$pdf->Cell(0, 5, '', 0, 1);

		//Header
		$pdf->Image($image2, 25, 152, 27);
		$pdf->Image($image1, 165, 152, 20);
		$pdf->Cell(0, 12, '', 0, 1);
		$pdf->SetFont('Times', 'B', 14);
		$pdf->Cell(0, 7, 'SURAT IZIN', 0, 1, 'C');
		$pdf->SetFont('Times', '', 12);
		$pdf->Ln(3);

		$pdf->Cell(20, 6, 'Saya yang bertandatangan di bawah ini,', 0, 1);
		$pdf->SetFont('Times', '', 12);
		//Nama
		$pdf->cell(20, 6, 'Nama', 1, 0);
		$pdf->cell(5, 6, ' :', 1, 0);
		$pdf->cell(0, 6, $karyawan['nama'], 1, 1);
		//Jabatan
		$pdf->cell(20, 6, 'Jabatan', 1, 0);
		$pdf->cell(5, 6, ' :', 1, 0);
		$pdf->cell(0, 6, $karyawan['nama_jabatan'], 1, 1);
		//Divisi
		$pdf->cell(20, 6, 'Divisi', 1, 0);
		$pdf->cell(5, 6, ' :', 1, 0);
		$pdf->cell(0, 6, $karyawan['nama_divisi'], 1, 1);

		$pdf->cell(0, 6, 'Dengan ini mengajukan izin untuk:', 1, 1);

		//Keterangan
		$pdf->SetFillColor(153, 255, 153);
		$pdf->cell(120, 6, 'Keterangan', 1, 0, 'C', true);
		$pdf->cell(0, 6, 'Lama Waktu Izin', 1, 1, 'C', true);
		//Isi Keterangan
		$keterangan = substr($izin['keterangan_izin'], 0, 7);
		switch ($keterangan) {
			case "Izin Ti":
				$pdf->cell(30, 6, $pdf->Image($ctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Izin tidak masuk', 1, 0);
				$pdf->cell(0, 6, $izin['lama_waktu_izin'], 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Izin terlambat masuk kerja', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Pulang Lebih Awal', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Meninggalkan sekolah saat jam kerja', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Ada keperluan', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Lain-lain', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				break;
			case "Izin Te":
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Izin tidak masuk', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($ctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Izin terlambat masuk kerja', 1, 0);
				$pdf->cell(0, 6, $izin['lama_waktu_izin'], 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Pulang Lebih Awal', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Meninggalkan sekolah saat jam kerja', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Ada keperluan', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Lain-lain', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				break;
			case "Pulang ":
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Izin tidak masuk', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Izin terlambat masuk kerja', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($ctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Pulang Lebih Awal', 1, 0);
				$pdf->cell(0, 6, $izin['lama_waktu_izin'], 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Meninggalkan sekolah saat jam kerja', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Ada keperluan', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Lain-lain', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				break;
			case "Meningg":
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Izin tidak masuk', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Izin terlambat masuk kerja', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Pulang Lebih Awal', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($ctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Meninggalkan sekolah saat jam kerja', 1, 0);
				$pdf->cell(0, 6, $izin['lama_waktu_izin'], 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Ada keperluan', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Lain-lain', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				break;
			case "Ada Kep":
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Izin tidak masuk', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Izin terlambat masuk kerja', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Pulang Lebih Awal', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Meninggalkan sekolah saat jam kerja', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($ctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, $izin['keterangan_izin'], 1, 0);
				$pdf->cell(0, 6, $izin['lama_waktu_izin'], 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Lain-lain', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				break;
			case "Lain-la":
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Izin tidak masuk', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Izin terlambat masuk kerja', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Pulang Lebih Awal', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Meninggalkan sekolah saat jam kerja', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($nctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, 'Ada Keperluan', 1, 0);
				$pdf->cell(0, 6, '', 1, 1, 'C');
				$pdf->cell(30, 6, $pdf->Image($ctg, 38, $pdf->GetY()), 1, 0, 'C');
				$pdf->cell(90, 6, $izin['keterangan_izin'], 1, 0);
				$pdf->cell(0, 6, $izin['lama_waktu_izin'], 1, 1, 'C');
				break;
		}



		//Alasan
		$pdf->cell(30, 6, 'Alasan', 1, 0);
		$pdf->cell(0, 6, $izin['alasan_izin'], 1, 1);

		//Hari Tanggal
		$pdf->cell(30, 6, 'Hari Tanggal', 1, 0);
		$pdf->cell(0, 6, $izin['hari_tanggal'], 1, 1);

		//TTD
		$get_xxx = $pdf->GetX();
		$get_yyy = $pdf->GetY();
		$width_cell = 40;

		$pdf->multicell(40, 6, 'Mengetahui,
		Security
		

		(............................)', 1, 'C');
		$get_xxx += $width_cell;
		$pdf->SetXY($get_xxx, $get_yyy);

		$pdf->multicell(40, 6, 'Mengetahui,
		Direktur
		

		(............................)', 1, 'C');
		$get_xxx += $width_cell;
		$pdf->SetXY($get_xxx, $get_yyy);

		$pdf->multicell(40, 6, 'Mengetahui,
		Atasan Langsung

		
		(............................)', 1, 'C');
		$get_xxx += $width_cell;
		$pdf->SetXY($get_xxx, $get_yyy);
		
		$pdf->multicell(40, 6, 'Karyawan, ybs


		
		' . $karyawan['nama'], 1, 'C');
		$get_xxx += $width_cell;
		$pdf->SetXY($get_xxx, $get_yyy);

		$kode = $index;
		if ($kode == '1')
			$pdf->Output('D', 'suratIzin.pdf');
		else if ($kode == '0')
			$pdf->Output('I', 'suratIzin.pdf');
	}

	public function cuti()
	{
		$data['title'] = "Formulir Permohonan Cuti";
		$data['type'] = 'karyawan';
		$data['welcome'] = "0";

		$id = $this->session->userdata('id');
		$data['karyawan'] = $this->KaryawanModel->dataKaryawan($id);

		$this->blade->render('cuti', $data);
	}

	public function buatSuratCuti()
	{
		$data['title'] = "Buat Surat Cuti";
		$data['type'] = 'karyawan';
		$data['welcome'] = "0";

		include "tgl_indo.php";
		include "getRomawi.php";

		$bulan = date('n');
		$romawi = getRomawi($bulan);
		$tahun = date('Y');
		$nomor = "/SIC/" . $romawi . "/" . $tahun;
		$noUrut = $this->KaryawanModel->cekNoSurat();
		$kode = sprintf("%02s", $noUrut);
		$nomorSurat = $kode . $nomor;

		$tglMulai = date('Y-m-d', strtotime($this->input->post('mulai')));
		$mulai = tgl_indo($tglMulai, true);
		$tglSelesai = date('Y-m-d', strtotime($this->input->post('selesai')));
		$selesai = tgl_indo($tglSelesai, true);
		$tglMasuk = date('Y-m-d', strtotime($this->input->post('masuk')));
		$masuk = tgl_indo($tglMasuk, true);
		$tgl = date('Y-m-d');
		$tglSurat = tgl_indo($tgl, false);

		$cuti = array(
			'nomor_surat'		=> $nomorSurat,
			'alasan_cuti'       => $this->input->post('alasan'),
			'hari_tgl_mulai'    => $mulai,
			'hari_tgl_selesai'  => $selesai,
			'hari_tgl_masuk'    => $masuk,
			'tujuan_cuti'	    => $this->input->post('tujuan'),
			'status_cuti'		=> "0",
			'tanggal'			=> $tglSurat,
			'id_karyawan'		=> $this->session->userdata('id'),
			'alamat_karyawan'	=> $this->input->post('alamat'),
		);

		$this->KaryawanModel->buatSuratCuti($cuti);
		$this->session->set_userdata($cuti);
		redirect('karyawan');
	}

	public function statusCuti()
	{
		$data['title'] = "Status Permohonan Cuti";
		$data['type'] = 'karyawan';
		$data['welcome'] = "0";

		$nomorSurat = $this->session->userdata('nomor_surat');
		$data['cuti'] = $this->KaryawanModel->statusCuti($nomorSurat);

		$this->blade->render('statusCuti', $data);
	}

	public function editCuti()
	{
		$data['title'] = "Edit Data Cuti";
		$data['type'] = 'karyawan';
		$data['welcome'] = "0";

		
		$id = $this->session->userdata('id');
		$data['karyawan'] = $this->KaryawanModel->dataKaryawan($id);

		$nomorSurat = $this->session->userdata('nomor_surat');
		$data['cuti'] = $this->KaryawanModel->statusCuti($nomorSurat);

		$this->blade->render('editCuti', $data);
	}

	public function updateCuti()
	{
		$data['title'] = "Edit Data Cuti";
		$data['type'] = 'karyawan';
		$data['welcome'] = "0";

		include "tgl_indo.php";
		$nomorSurat = $this->session->userdata('nomor_surat');

		$tglMulai = date('Y-m-d', strtotime($this->input->post('mulai')));
		$mulai = tgl_indo($tglMulai, true);
		$tglSelesai = date('Y-m-d', strtotime($this->input->post('selesai')));
		$selesai = tgl_indo($tglSelesai, true);
		$tglMasuk = date('Y-m-d', strtotime($this->input->post('masuk')));
		$masuk = tgl_indo($tglMasuk, true);
		$tgl = date('Y-m-d');
		$tglSurat = tgl_indo($tgl, false);

		$cuti = array(
			'nomor_surat'		=> $nomorSurat,
			'alasan_cuti'       => $this->input->post('alasan'),
			'hari_tgl_mulai'    => $mulai,
			'hari_tgl_selesai'  => $selesai,
			'hari_tgl_masuk'    => $masuk,
			'tujuan_cuti'	    => $this->input->post('tujuan'),
			'status_cuti'		=> "0",
			'tanggal'			=> $tglSurat,
			'id_karyawan'		=> $this->session->userdata('id'),
			'alamat_karyawan'	=> $this->input->post('alamat'),
		);

		$this->KaryawanModel->updateCuti($cuti);
		$this->session->set_flashdata('update', '<div style="color: green">Data berhasil diupdate.</div>');
		redirect('karyawan/statusCuti/' . $nomorSurat);
	}

	public function suratCuti($index)
	{
		$id = $this->session->userdata('id');
		$nomorSurat = $this->session->userdata('nomor_surat');
		$karyawan = $this->KaryawanModel->dataKaryawan($id);
		$cuti = $this->KaryawanModel->statusCuti($nomorSurat);

		$pdf = new FPDF('P', 'mm', 'A4');
		// membuat halaman baru
		$pdf->AddPage();
		$pdf->SetMargins(15, 8, 15);
		$pdf->SetAutoPageBreak('off', 2);

		$imgKaryawan = base_url('assets/dist/img/karyawan.png');

		//Header
		$pdf->SetFont('Times', 'B', 14);
		$pdf->Cell(0, 7, 'SEKOLAH TELADAN YOGYAKARTA', 0, 1, 'C');
		$pdf->SetFont('Times', '', 10);
		$pdf->Cell(0,4,'Alamat: Jln. Kanupaten Km 0,5 No. 99, Nogotirto, Gamping, Sleman',0,1,'C');
		$pdf->Cell(0,4,'Telp. (0274) 2923001, 2923002',0,1,'C');
		$pdf->Cell(0,4,'Website: www.sekolahteladan.sch.id, Email: sdteladan.yogyakarta@gmail.com',0,1,'C');
		$pdf->SetFont('Times', 'B', 12);
		$pdf->Cell(0,0,'_______________________________________________________________________________________',0,1,'C');
		$pdf->Ln(5);

		$pdf->Image($imgKaryawan, 140, 18, 70);
		$pdf->Ln(15);

		$pdf->SetFont('Times', 'BU', 12);
		$pdf->Cell(0, 6, 'SURAT IZIN CUTI', 0, 1, 'C');
		$pdf->SetFont('Times', '', 12);
		$pdf->Cell(0, 6, 'Nomor: '.$nomorSurat, 0, 1, 'C');
		$pdf->Ln(5);

		$pdf->Cell(0, 6, 'Kepada Yth.', 0, 1);
		$pdf->Cell(0, 6, $cuti['tujuan_cuti'], 0, 1);
		$pdf->Cell(0, 6, 'di Yogyakarta', 0, 1);
		$pdf->Ln(5);

		$pdf->Cell(0, 6, 'Dengan hormat,', 0, 1);
		$pdf->Cell(0, 6, 'Saya yang bertandatangan di bawah ini:', 0, 1);
		$pdf->Ln(3);
		$pdf->Cell(0, 6, 'Nama				: '.$karyawan['nama'], 0, 1);
		$pdf->Cell(0, 6, 'Alamat		: '.$cuti['alamat_karyawan'], 0, 1);
		$pdf->Cell(0, 6, 'Jabatan		: '.$karyawan['nama_jabatan'], 0, 1);
		$pdf->Ln(3);

		$pdf->Cell(0, 6, 'Bermaksud mengajukan ijin cuti '.$cuti['alasan_cuti'].'.', 0, 1);
		$pdf->Cell(75, 6, 'Dimulai sejak hari '.$cuti['hari_tgl_mulai'], 0, 0);
		$pdf->Cell(79, 6, 'dan selesai pada hari '.$cuti['hari_tgl_selesai'], 0, 0);
		$pdf->Cell(0,6, 'sehingga akan', 0,1);
		$pdf->Cell(79, 6, 'mulai aktif kembali pada hari '.$cuti['hari_tgl_masuk'].'.', 0, 0);
		$pdf->Ln(10);

		$pdf->MultiCell(0, 6, 'Demikian surat izin cuti ini saya ajukan. Atas perhatian dan dikabulkannya, saya ucapkan banyak terima
kasih.', 0);

		$pdf->Ln(20);
		$pdf->Cell(0,6, 'Sleman, '.$cuti['tanggal'], 0,1);
		$pdf->Cell(140,6, 'Pemohon,', 0,0);
		$pdf->Cell(0,6, 'Direktur,', 0,0);
		$pdf->Ln(20);
		$pdf->Cell(130,6, $karyawan['nama'], 0,0);
		$pdf->Cell(0,6, 'Eko Yudi Prasetyo, S.E.', 0,0);
		$pdf->Ln(40);

		$pdf->SetFont('Times', 'I', 12);
		$pdf->MultiCell(0, 6, 'Tembusan:
		1. Direktur Sekolah Teladan
		2. Direktur Operasional
		3. Divisi PSDM Sekolah Telan
		4. Administrasi Sekolah Teladan');

		$kode = $index;
		if ($kode == '1')
			$pdf->Output('D', 'suratCuti.pdf');
		else if ($kode == '0')
			$pdf->Output('I', 'suratCuti.pdf');
	}
}
