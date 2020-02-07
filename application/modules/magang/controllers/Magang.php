<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Magang extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('MagangModel');
		$this->load->library('pdf');
	}

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

		$id = $this->session->userdata('id');
		$data['karyawan'] = $this->MagangModel->dataKaryawan($id);

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

		$this->MagangModel->buatSuratIzin($izin);
		redirect('magang/cetakIzin/' . $id_izin);
	}

	public function cetakIzin($id_izin)
	{
		$data['title'] = "Cetak Surat Izin";
		$data['type'] = 'magang';
		$data['welcome'] = "0";

		$data['izin'] = $this->MagangModel->cetakIzin($id_izin);

		$this->blade->render('cetakIzin', $data);
	}

	public function editIzin($id_izin)
	{
		$data['title'] = "Edit Data Izin";
		$data['type'] = 'magang';
		$data['welcome'] = "0";

		$id = $this->session->userdata('id');
		$data['karyawan'] = $this->MagangModel->dataKaryawan($id);

		$data['izin'] = $this->MagangModel->cetakIzin($id_izin);

		$this->blade->render('editIzin', $data);
	}

	public function update($id_izin)
	{
		$data['title'] = "Cetak Surat Izin";
		$data['type'] = 'magang';
		$data['welcome'] = "0";

		include "tgl_indo.php";

		$tgl = date('Y-m-d', strtotime($this->input->post('tanggal')));
		$tglSurat = tgl_indo($tgl, true);


		$keterangan = $this->input->post('keterangan');
		if ($keterangan == "Ada Keperluan") {
			$keterangan = $this->input->post('perlu');
		}
		if ($keterangan == "Lain-lain") {
			$keterangan = $this->input->post('lain');
		}

		$izin = array(
			'id_izin'			=> $id_izin,
			'keterangan_izin'   => $keterangan,
			'alasan_izin'       => $this->input->post('alasan'),
			'hari_tanggal'      => $tglSurat,
			'lama_waktu_izin'   => $this->input->post('lama'),
			'status_izin'		=> "OK",
			'id_karyawan'		=> $this->session->userdata('id'),
		);

		$this->MagangModel->update($izin);
		redirect('magang/cetakIzin/' . $id_izin);
	}

	public function suratIzin($id_izin, $index)
	{
		$id = $this->session->userdata('id');
		$karyawan = $this->MagangModel->dataKaryawan($id);
		$izin = $this->MagangModel->cetakIzin($id_izin);

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
		$pdf->Cell(0, 8, '', 0, 1,);
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

		$pdf->Cell(0, 31, '', 0, 1,);
		$pdf->Cell(0, 5, '___________________________________________________________________________', 0, 1,);
		$pdf->Cell(0, 5, '', 0, 1,);

		//Header
		$pdf->Image($image2, 25, 152, 27);
		$pdf->Image($image1, 165, 152, 20);
		$pdf->Cell(0, 12, '', 0, 1,);
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
}
