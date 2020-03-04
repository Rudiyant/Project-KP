-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Mar 2020 pada 20.14
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sinai`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `username`, `password`) VALUES
('891c0775-3b48-11ea-b233-b42e9929de51', 'Admin', '0100501', '11111');

-- --------------------------------------------------------

--
-- Struktur dari tabel `direktur`
--

CREATE TABLE `direktur` (
  `niy` char(17) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `divisi` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `id_karyawan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` varchar(50) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `niy` varchar(50) NOT NULL,
  `nama_divisi` varchar(50) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `akun_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama`, `nik`, `niy`, `nama_divisi`, `nama_jabatan`, `is_active`, `created_at`, `updated_at`, `akun_id`) VALUES
('265c0775-3b48-11ea-b233-b42e9929de55', 'M. Saepullah', '333016600002', '', 'Divisi IT', 'Magang IT', 1, '2020-03-05 00:00:00', '2020-03-05 00:00:00', '265c0775-3b48-11ea-b233-b42e9929de55'),
('484c0775-3b48-11ea-b233-b42e9929de53', 'Johan Saifudin', '', '02 01 1019 090752', 'SD Teladan', 'Guru Kelas', 1, '2020-03-05 00:00:00', '2020-03-05 00:00:00', '484b59f1-3b48-11ea-b233-b42e9929de53'),
('52f4f0c6-3b48-11ea-b233-b42e9929de53', 'Imam Prasetyo, S.Kom.', '', '02 01 1019 210989', 'Divisi IT', 'Staff IT', 1, '2020-03-05 00:00:00', '2020-03-05 00:00:00', '52f49ae0-3b48-11ea-b233-b42e9929de53'),
('d8e7a282-3b47-11ea-b233-b42e9929de53', 'Muhammad Prasetyo', '', '02 01 1016 210989', 'Operasional', 'Direktur', 1, '2020-03-05 00:00:00', '2020-03-05 00:00:00', 'd8e75512-3b47-11ea-b233-b42e9929de53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan_akun`
--

CREATE TABLE `karyawan_akun` (
  `akun_id` varchar(50) NOT NULL,
  `akun_username` varchar(50) NOT NULL,
  `akun_password` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_active` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `karyawan_akun`
--

INSERT INTO `karyawan_akun` (`akun_id`, `akun_username`, `akun_password`, `created_at`, `updated_at`, `is_active`) VALUES
('265c0775-3b48-11ea-b233-b42e9929de55', '0100401', '11111', '2020-03-05 00:00:00', '2020-03-05 00:00:00', '1'),
('484b59f1-3b48-11ea-b233-b42e9929de53', '0100201', '11111', '2020-03-05 00:00:00', '2020-03-05 00:00:00', '1'),
('52f49ae0-3b48-11ea-b233-b42e9929de53', '0100301', '11111', '2020-03-05 00:00:00', '2020-03-05 00:00:00', '1'),
('d8e75512-3b47-11ea-b233-b42e9929de53', '0100101', '11111', '2020-03-05 00:00:00', '2020-03-05 00:00:00', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_cuti`
--

CREATE TABLE `surat_cuti` (
  `alasan_cuti` varchar(60) NOT NULL,
  `hari_tgl_mulai` varchar(50) NOT NULL,
  `hari_tgl_selesai` varchar(50) NOT NULL,
  `hari_tgl_masuk` varchar(50) NOT NULL,
  `tujuan_cuti` varchar(50) NOT NULL,
  `status_cuti` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `id_karyawan` varchar(50) NOT NULL,
  `alamat_karyawan` varchar(50) NOT NULL,
  `nomor_surat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `surat_cuti`
--

INSERT INTO `surat_cuti` (`alasan_cuti`, `hari_tgl_mulai`, `hari_tgl_selesai`, `hari_tgl_masuk`, `tujuan_cuti`, `status_cuti`, `keterangan`, `tanggal`, `id_karyawan`, `alamat_karyawan`, `nomor_surat`) VALUES
('Liburan keluarga ke luar negeri', 'Kamis, 05 Maret 2020', 'Minggu, 08 Maret 2020', 'Senin, 09 Maret 2020', 'Direktur Sekolah Teladan', 1, '', '04 Maret 2020', '484c0775-3b48-11ea-b233-b42e9929de53', 'Condongcatur, Depok Sleman, Yogyakarta', '01/SIC/III/2020'),
('Liburan ke China', 'Kamis, 05 Maret 2020', 'Sabtu, 14 Maret 2020', 'Senin, 16 Maret 2020', 'Direktur Sekolah Teladan', 2, 'Permohnan cuti terlalu lama', '04 Maret 2020', '52f4f0c6-3b48-11ea-b233-b42e9929de53', 'Bantul, Yogyakarta', '02/SIC/III/2020');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_izin`
--

CREATE TABLE `surat_izin` (
  `id_izin` varchar(50) NOT NULL,
  `keterangan_izin` varchar(60) NOT NULL,
  `alasan_izin` varchar(60) NOT NULL,
  `hari_tanggal` varchar(50) NOT NULL,
  `lama_waktu_izin` varchar(20) NOT NULL,
  `status_izin` int(11) NOT NULL,
  `id_karyawan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `surat_izin`
--

INSERT INTO `surat_izin` (`id_izin`, `keterangan_izin`, `alasan_izin`, `hari_tanggal`, `lama_waktu_izin`, `status_izin`, `id_karyawan`) VALUES
('cNL9B', 'Izin Tidak Masuk', 'Sakit Maag', 'Kamis, 05 Maret 2020', '1 Hari', 0, '52f4f0c6-3b48-11ea-b233-b42e9929de53'),
('cptjJ', 'Meninggalkan Sekolah saat Jam Kerja', 'Ada rapat di luar sekolah', 'Kamis, 01 Januari 1970', '3 Jam', 0, '484c0775-3b48-11ea-b233-b42e9929de53'),
('V0PvX', 'Pulang Lebih Awal', 'Kondangan', 'Jumat, 06 Maret 2020', '2 Jam', 0, '265c0775-3b48-11ea-b233-b42e9929de55');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `direktur`
--
ALTER TABLE `direktur`
  ADD UNIQUE KEY `niy` (`niy`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD KEY `akun_id` (`akun_id`) USING BTREE;

--
-- Indeks untuk tabel `karyawan_akun`
--
ALTER TABLE `karyawan_akun`
  ADD PRIMARY KEY (`akun_id`);

--
-- Indeks untuk tabel `surat_cuti`
--
ALTER TABLE `surat_cuti`
  ADD PRIMARY KEY (`nomor_surat`),
  ADD KEY `id_karyawan` (`id_karyawan`) USING BTREE;

--
-- Indeks untuk tabel `surat_izin`
--
ALTER TABLE `surat_izin`
  ADD PRIMARY KEY (`id_izin`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `direktur`
--
ALTER TABLE `direktur`
  ADD CONSTRAINT `id_karyawan` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`);

--
-- Ketidakleluasaan untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `fkakun_id` FOREIGN KEY (`akun_id`) REFERENCES `karyawan_akun` (`akun_id`);

--
-- Ketidakleluasaan untuk tabel `surat_cuti`
--
ALTER TABLE `surat_cuti`
  ADD CONSTRAINT `fkid_karyawan` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`);

--
-- Ketidakleluasaan untuk tabel `surat_izin`
--
ALTER TABLE `surat_izin`
  ADD CONSTRAINT `surat_izin_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
