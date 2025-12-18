-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16 Des 2025 pada 19.28
-- Versi Server: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jasarenovasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(10) unsigned NOT NULL,
  `id` int(11) NOT NULL,
  `namaadmin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `id`, `namaadmin`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', '2018-07-19 02:45:04', '2018-07-19 02:45:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `alamatpelanggan`
--

CREATE TABLE IF NOT EXISTS `alamatpelanggan` (
  `id_alamatpelanggan` int(10) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `alamatpelanggan` text NOT NULL,
  `latitudealamat` varchar(30) NOT NULL,
  `longtitudealamat` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `alamatpelanggan`
--

INSERT INTO `alamatpelanggan` (`id_alamatpelanggan`, `id_pelanggan`, `alamatpelanggan`, `latitudealamat`, `longtitudealamat`, `created_at`, `updated_at`) VALUES
(8, 8, 'Jln. Palang Karaya (Restoran Ria)', '3.5855397996432137', '98.68257343769073', '2018-08-09 08:50:50', '2018-08-09 08:50:50'),
(9, 13, 'Jl. Pelita I No. 65', '3.604339232390904', '98.68642113463306', '2018-08-12 16:55:29', '2018-08-12 16:55:29'),
(10, 14, 'Jl, Karya No. 125', '3.609596521899874', '98.66548667887946', '2018-08-12 16:58:44', '2018-08-12 16:58:44'),
(11, 15, 'Jl. Bambu V No. 25', '3.608906959937716', '98.67847865859005', '2018-08-12 17:01:46', '2018-08-12 17:01:46'),
(12, 16, 'Jl. Umar No. 23', '3.619799684133099', '98.67497951204768', '2018-08-12 21:24:29', '2018-08-12 21:24:29'),
(13, 17, 'Jl. Pendidikan No 78', '3.619449490924735', '98.70261581725686', '2018-08-12 21:27:23', '2018-08-12 21:27:23'),
(14, 18, 'Jl. Permai No.32', '3.607307987291772', '98.69330327993987', '2018-08-12 21:30:27', '2018-08-12 21:30:27'),
(16, 19, 'Jl. Karantina No. 56', '3.609904674119131', '98.68176536826263', '2018-08-12 21:37:06', '2018-08-12 21:37:06'),
(17, 20, 'Jl. Batu Bara No. 214', '3.5897757599156876', '98.6854510906445', '2018-08-12 21:39:48', '2018-08-12 21:39:48'),
(18, 21, 'Jl. Sei kera No. 23', '3.5938258246704287', '98.68474160861774', '2018-08-12 21:42:47', '2018-08-12 21:42:47'),
(19, 22, 'Jl. Tuasan No 291', '3.616069038906791', '98.69704543081912', '2018-08-12 21:44:45', '2018-08-12 21:44:45'),
(20, 25, 'Jln. Krakatau No. 73', '3.6266857333701097', '98.68082027882338', '2022-11-03 06:43:03', '2022-11-03 06:43:03'),
(21, 29, 'Test', '3.6184241', '98.680938', '2025-12-15 16:41:33', '2025-12-15 16:41:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahanmaterial`
--

CREATE TABLE IF NOT EXISTS `bahanmaterial` (
  `id_bahanmaterial` int(10) unsigned NOT NULL,
  `id_kategoritukang` int(11) NOT NULL,
  `kodebahanmaterial` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `bahanmaterial` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `informasibahanmaterial` text COLLATE utf8_unicode_ci NOT NULL,
  `hargabahanmaterial` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fotobahanmaterial` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `statusbahanmaterial` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `bahanmaterial`
--

INSERT INTO `bahanmaterial` (`id_bahanmaterial`, `id_kategoritukang`, `kodebahanmaterial`, `bahanmaterial`, `informasibahanmaterial`, `hargabahanmaterial`, `fotobahanmaterial`, `statusbahanmaterial`, `created_at`, `updated_at`) VALUES
(1, 1, 'KBa321saAs', 'AC Baru', 'Plastik', '1500000', 'fotobahanmaterial20180705095447.jpg', '1', '2018-07-05 16:32:14', '2018-07-23 07:42:11'),
(5, 2, 'KBY82LhHsQ', 'CCTV HD', 'Mesin', '500000', 'fotobahanmaterial1A08UtYRB.jpg', '1', '2018-07-23 07:56:22', '2018-07-23 07:56:22'),
(6, 1, 'KBhFxkVcfS', 'AC LG', 'Baru', '1500000', 'fotobahanmaterial1wJdHPBUm.jpg', '1', '2018-08-12 18:31:05', '2018-08-12 18:31:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hargajarak`
--

CREATE TABLE IF NOT EXISTS `hargajarak` (
  `id_hargajarak` int(10) unsigned NOT NULL,
  `hargajarak` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `hargajarak`
--

INSERT INTO `hargajarak` (`id_hargajarak`, `hargajarak`, `created_at`, `updated_at`) VALUES
(1, 15000, '2018-08-05 16:58:44', '2018-08-12 17:41:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jasatersedia`
--

CREATE TABLE IF NOT EXISTS `jasatersedia` (
  `id_jasatersedia` int(10) unsigned NOT NULL,
  `id_tukang` int(11) NOT NULL,
  `id_jenispemesanan` int(11) NOT NULL,
  `biayajasatersedia` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `jenisjasatersedia` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `jasatersedia`
--

INSERT INTO `jasatersedia` (`id_jasatersedia`, `id_tukang`, `id_jenispemesanan`, `biayajasatersedia`, `jenisjasatersedia`, `created_at`, `updated_at`) VALUES
(56, 2, 3, '500000', '0', '2018-07-23 09:36:19', '2018-07-23 09:36:19'),
(57, 2, 3, '200000', '1', '2018-07-23 09:36:19', '2018-07-23 09:36:19'),
(61, 5, 1, '100000', '0', '2018-08-12 18:11:22', '2018-08-12 18:11:22'),
(62, 5, 2, '120000', '1', '2018-08-12 18:11:22', '2018-08-12 18:11:22'),
(63, 6, 1, '75000', '0', '2018-08-12 18:20:59', '2018-08-12 18:20:59'),
(64, 6, 1, '120000', '1', '2018-08-12 18:20:59', '2018-08-12 18:20:59'),
(65, 7, 1, '120000', '0', '2018-08-12 18:23:40', '2018-08-12 18:23:40'),
(66, 7, 2, '140000', '1', '2018-08-12 18:23:40', '2018-08-12 18:23:40'),
(67, 1, 1, '55000', '0', '2018-08-12 20:35:25', '2018-08-12 20:35:25'),
(68, 1, 2, '35600', '0', '2018-08-12 20:35:25', '2018-08-12 20:35:25'),
(69, 1, 1, '35000', '1', '2018-08-12 20:35:25', '2018-08-12 20:35:25'),
(70, 10, 1, '100000', '0', '2018-08-12 22:30:36', '2018-08-12 22:30:36'),
(71, 10, 2, '120000', '1', '2018-08-12 22:30:36', '2018-08-12 22:30:36'),
(72, 11, 1, '120000', '0', '2018-08-12 22:34:19', '2018-08-12 22:34:19'),
(73, 11, 2, '150000', '1', '2018-08-12 22:34:19', '2018-08-12 22:34:19'),
(74, 12, 1, '120000', '0', '2018-08-12 22:36:59', '2018-08-12 22:36:59'),
(75, 12, 2, '140000', '1', '2018-08-12 22:36:59', '2018-08-12 22:36:59'),
(76, 13, 3, '200000', '0', '2018-08-12 22:46:01', '2018-08-12 22:46:01'),
(77, 13, 5, '300000', '1', '2018-08-12 22:46:01', '2018-08-12 22:46:01'),
(78, 14, 3, '150000', '0', '2018-08-12 22:50:10', '2018-08-12 22:50:10'),
(79, 14, 5, '250000', '1', '2018-08-12 22:50:10', '2018-08-12 22:50:10'),
(80, 15, 3, '200000', '0', '2018-08-12 22:53:29', '2018-08-12 22:53:29'),
(81, 15, 5, '230000', '1', '2018-08-12 22:53:30', '2018-08-12 22:53:30'),
(82, 16, 7, '100000', '0', '2018-08-12 23:03:24', '2018-08-12 23:03:24'),
(83, 16, 8, '200000', '1', '2018-08-12 23:03:24', '2018-08-12 23:03:24'),
(84, 17, 7, '120000', '0', '2018-08-12 23:06:01', '2018-08-12 23:06:01'),
(85, 17, 7, '180000', '1', '2018-08-12 23:06:01', '2018-08-12 23:06:01'),
(86, 20, 1, '100000', '0', '2025-12-15 16:27:57', '2025-12-15 16:27:57'),
(87, 20, 1, '100000', '1', '2025-12-15 16:27:57', '2025-12-15 16:27:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenispemesanan`
--

CREATE TABLE IF NOT EXISTS `jenispemesanan` (
  `id_jenispemesanan` int(10) unsigned NOT NULL,
  `id_kategoritukang` int(11) NOT NULL,
  `jenispemesanan` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `jenispemesanan`
--

INSERT INTO `jenispemesanan` (`id_jenispemesanan`, `id_kategoritukang`, `jenispemesanan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pasang AC Baru', '2018-07-04 14:17:22', '2018-07-04 14:17:22'),
(2, 1, 'Service AC', '2018-07-04 15:37:36', '2018-07-04 15:37:36'),
(3, 2, 'Pasang CCTV Baru', '2018-07-23 08:06:14', '2018-07-23 08:11:02'),
(5, 2, 'Perbaiki CCTV', '2018-08-12 18:12:47', '2018-08-12 18:12:47'),
(7, 3, 'Pasang Barang Elektronik', '2018-08-12 18:32:05', '2018-08-12 18:32:05'),
(8, 3, 'Perbaiki Barang Elektronik', '2018-08-12 18:32:22', '2018-08-12 18:32:22'),
(9, 4, 'Pemasangan Instalasi Listrik', '2018-08-12 18:32:41', '2018-08-12 18:32:41'),
(10, 4, 'Perbaikan Instalasi Listrik', '2018-08-12 18:33:02', '2018-08-12 18:33:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategoritukang`
--

CREATE TABLE IF NOT EXISTS `kategoritukang` (
  `id_kategoritukang` int(10) unsigned NOT NULL,
  `kategoritukang` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `kategoritukang`
--

INSERT INTO `kategoritukang` (`id_kategoritukang`, `kategoritukang`, `created_at`, `updated_at`) VALUES
(1, 'Renovasi Indoor', '2018-07-04 13:30:33', '2018-07-04 13:30:33'),
(2, 'Renovasi Outdoor', '2018-07-04 13:30:33', '2018-07-04 13:30:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporanprogress`
--

CREATE TABLE IF NOT EXISTS `laporanprogress` (
  `id_progress` int(10) unsigned NOT NULL,
  `id_tukang` int(11) NOT NULL,
  `id_pemesanan` int(11) NOT NULL,
  `tanggal_progress` datetime NOT NULL,
  `informasi_pekerjaan` text COLLATE utf8_unicode_ci NOT NULL,
  `fotoprogress1` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fotoprogress2` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fotoprogress3` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fotoprogress4` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fotoprogress5` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `laporanprogress`
--

INSERT INTO `laporanprogress` (`id_progress`, `id_tukang`, `id_pemesanan`, `tanggal_progress`, `informasi_pekerjaan`, `fotoprogress1`, `fotoprogress2`, `fotoprogress3`, `fotoprogress4`, `fotoprogress5`, `created_at`, `updated_at`) VALUES
(1, 20, 15, '2025-12-16 13:10:00', 'Test', 'progress_pekerjaan/progress_15_1_1765865453.jpg', NULL, NULL, NULL, NULL, '2025-12-16 06:10:53', '2025-12-16 06:10:53'),
(2, 20, 15, '2025-12-15 13:54:00', 'Test', 'progress_pekerjaan/progress_15_1_1765868063.jpg', NULL, NULL, NULL, NULL, '2025-12-16 06:54:23', '2025-12-16 06:54:23'),
(3, 20, 15, '2025-12-17 13:56:00', '1', 'progress_pekerjaan/progress_15_1_1765868187.jpg', NULL, NULL, NULL, NULL, '2025-12-16 06:56:27', '2025-12-16 06:56:27'),
(4, 20, 15, '2025-12-18 13:57:00', '2', 'progress_pekerjaan/progress_15_1_1765868272.jpg', NULL, NULL, NULL, NULL, '2025-12-16 06:57:52', '2025-12-16 06:57:52'),
(6, 20, 15, '2025-12-16 14:11:00', '1', 'progress_pekerjaan/progress_15_1_1765869119.jpg', NULL, NULL, NULL, NULL, '2025-12-16 07:11:59', '2025-12-16 17:16:16'),
(8, 20, 15, '2025-12-16 16:27:00', '1', 'progress_pekerjaan/progress_15_1_1765877266.jpg', NULL, NULL, NULL, NULL, '2025-12-16 09:27:46', '2025-12-16 09:27:46'),
(9, 20, 15, '2025-12-27 01:08:00', 'Test', 'progress_pekerjaan/progress_15_1_1765909361.jpg', 'progress_pekerjaan/progress_15_2_1765909361.jpg', NULL, NULL, NULL, '2025-12-16 18:08:27', '2025-12-16 18:22:51'),
(10, 20, 15, '2025-12-20 01:23:00', 'Test', 'progress_pekerjaan/progress_15_1_1765909399.jpg', NULL, NULL, NULL, NULL, '2025-12-16 18:23:19', '2025-12-16 18:23:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2018_07_04_040428_create_pelanggan_table', 1),
('2018_07_04_040630_create_tukang_table', 1),
('2018_07_04_040858_create_admin_table', 1),
('2018_07_04_040951_create_alamatpengantaran_table', 1),
('2018_07_04_041119_create_pemesanan_table', 1),
('2018_07_04_041503_create_riwayattransaksi_table', 1),
('2018_07_04_041718_create_notifikasi_table', 1),
('2018_07_04_041901_create_kategoritukang_table', 1),
('2018_07_04_041912_create_bahanmaterial_table', 1),
('2018_07_04_041924_create_jenispemesanan_table', 1),
('2018_07_04_161301_create_jasatersedia_table', 2),
('2018_07_05_160853_create_pemesananbahanmaterial_table', 3),
('2018_07_22_125312_create_ulasantukang_table', 4),
('2018_08_05_235736_create_hargajarak_table', 5),
('2025_12_16_085648_create_laporanprogress_table', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi`
--

CREATE TABLE IF NOT EXISTS `notifikasi` (
  `id_notifikasi` int(10) unsigned NOT NULL,
  `dari` int(11) NOT NULL,
  `kepada` int(11) NOT NULL,
  `isinotifikasi` text COLLATE utf8_unicode_ci NOT NULL,
  `jenisnotifikasi` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `statusnotifikasi` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `notifikasi`
--

INSERT INTO `notifikasi` (`id_notifikasi`, `dari`, `kepada`, `isinotifikasi`, `jenisnotifikasi`, `statusnotifikasi`, `created_at`, `updated_at`) VALUES
(12, 1, 11, 'berhasil melakukan pengupdatean saldo dengan nominal Rp. 10,000,000.00 pada tanggal 2018-08-09 15:54:28', 'riwayattransaksi', '0', '2018-08-09 08:54:28', '2018-08-09 08:54:28'),
(13, 11, 1, 'telah melakukan pemesanan terhadap jasa anda', 'permintaanpesanan', '0', '2018-08-09 08:55:01', '2018-08-09 08:55:01'),
(14, 5, 11, 'telah menerima permintaan pesanan anda dengan nomor pemesanan NPz1goNg86', 'riwayatpemesanan/3?kategori=1&katakunci=', '0', '2018-08-09 08:55:40', '2018-08-09 08:55:40'),
(15, 5, 11, 'telah menerima permintaan pesanan anda dengan nomor pemesanan NPz1goNg86', 'riwayatpemesanan/3?kategori=1&katakunci=', '0', '2018-08-09 08:55:41', '2018-08-09 08:55:41'),
(16, 11, 5, 'telah mengkonfirmasi bahwa pekerjaan anda dengan nomor pemesananNPz1goNg86 telah selesai, silahkan cek saldo anda akan secara otomatis bertambah', 'riwayatpemesanan/3', '1', '2018-08-09 09:07:31', '2018-08-12 17:04:31'),
(17, 11, 5, 'telah memberikan ulasan terhadap jasa anda dengan nilai rating 5', 'caritukang/1/komentarpelanggan', '1', '2018-08-09 09:12:02', '2018-08-12 17:04:26'),
(18, 1, 13, 'berhasil melakukan pengupdatean saldo dengan nominal Rp. 10,000,000.00 pada tanggal 2018-08-12 17:08:44', 'riwayattransaksi', '1', '2018-08-12 17:08:44', '2018-08-12 17:10:18'),
(19, 13, 1, 'telah melakukan pemesanan terhadap jasa anda', 'permintaanpesanan', '0', '2018-08-12 17:24:08', '2018-08-12 17:24:08'),
(20, 5, 13, 'telah menerima permintaan pesanan anda dengan nomor pemesanan NP4Sbaw7pu', 'riwayatpemesanan/4?kategori=1&katakunci=', '1', '2018-08-12 17:24:54', '2018-08-12 17:37:49'),
(21, 13, 5, 'telah mengkonfirmasi bahwa pekerjaan anda dengan nomor pemesananNP4Sbaw7pu telah selesai, silahkan cek saldo anda akan secara otomatis bertambah', 'riwayatpemesanan/4', '1', '2018-08-12 17:29:32', '2018-08-12 17:37:06'),
(22, 13, 1, 'telah melakukan pemesanan terhadap jasa anda', 'permintaanpesanan', '0', '2018-08-12 17:36:29', '2018-08-12 17:36:29'),
(23, 13, 5, 'telah memberikan ulasan terhadap jasa anda dengan nilai rating 4', 'caritukang/1/komentarpelanggan', '1', '2018-08-12 17:37:32', '2018-08-12 17:38:12'),
(24, 5, 13, 'telah menolak permintaan pesanan anda', 'riwayatpemesanan/5?kategori='' . 1 . ''&katakunci=', '1', '2018-08-12 17:38:49', '2018-08-12 18:40:34'),
(25, 13, 1, 'telah melakukan pemesanan terhadap jasa anda', 'permintaanpesanan', '0', '2018-08-12 18:38:33', '2018-08-12 18:38:33'),
(26, 13, 1, 'telah melakukan pemesanan terhadap jasa anda', 'permintaanpesanan', '0', '2018-08-12 18:39:30', '2018-08-12 18:39:30'),
(27, 13, 1, 'telah melakukan pemesanan terhadap jasa anda', 'permintaanpesanan', '0', '2018-08-12 18:39:47', '2018-08-12 18:39:47'),
(28, 5, 13, 'telah menolak permintaan pesanan anda', 'riwayatpemesanan/6?kategori='' . 1 . ''&katakunci=', '1', '2018-08-12 18:40:04', '2018-08-12 18:40:37'),
(29, 5, 13, 'telah menolak permintaan pesanan anda', 'riwayatpemesanan/7?kategori='' . 1 . ''&katakunci=', '0', '2018-08-12 18:40:15', '2018-08-12 18:40:15'),
(30, 5, 13, 'telah menerima permintaan pesanan anda dengan nomor pemesanan NP2SLPXpQu', 'riwayatpemesanan/8?kategori=1&katakunci=', '1', '2018-08-12 18:40:21', '2018-08-12 20:23:58'),
(31, 13, 5, 'telah mengkonfirmasi bahwa pekerjaan anda dengan nomor pemesananNP2SLPXpQu telah selesai, silahkan cek saldo anda akan secara otomatis bertambah', 'riwayatpemesanan/8', '0', '2018-08-12 18:42:00', '2018-08-12 18:42:00'),
(32, 13, 5, 'telah memberikan ulasan terhadap jasa anda dengan nilai rating 5', 'caritukang/1/komentarpelanggan', '1', '2018-08-12 18:42:18', '2018-08-12 18:43:15'),
(33, 1, 5, 'telah mengkonfirmasi penarikan saldo dengan nominal Rp. 50,000.00 pada tanggal 2018-08-12 18:44:42', 'riwayattransaksi', '0', '2018-08-12 18:44:42', '2018-08-12 18:44:42'),
(34, 1, 5, 'telah melakukan penolakan penarikan saldo dengan nominal Rp. 0.00 pada tanggal 2018-08-12 18:45:28', 'riwayattransaksi', '0', '2018-08-12 18:45:28', '2018-08-12 18:45:28'),
(35, 1, 5, 'telah melakukan penolakan penarikan saldo dengan nominal Rp. 50,000.00 pada tanggal 2018-08-12 18:46:13', 'riwayattransaksi', '0', '2018-08-12 18:46:13', '2018-08-12 18:46:13'),
(36, 1, 13, 'telah melakukan penolakan pengisian saldo dengan nominal Rp. 10,000,000.00 pada tanggal 2018-08-12 20:22:39', 'riwayattransaksi', '1', '2018-08-12 20:22:39', '2018-08-12 20:23:56'),
(37, 1, 13, 'berhasil melakukan pengupdatean saldo dengan nominal Rp. 10,000,000.00 pada tanggal 2018-08-12 20:25:54', 'riwayattransaksi', '0', '2018-08-12 20:25:54', '2018-08-12 20:25:54'),
(38, 13, 1, 'telah melakukan pemesanan terhadap jasa anda', 'permintaanpesanan', '0', '2018-08-12 20:38:33', '2018-08-12 20:38:33'),
(39, 5, 13, 'telah menerima permintaan pesanan anda dengan nomor pemesanan NPp8WMAQxy', 'riwayatpemesanan/9?kategori=1&katakunci=', '0', '2018-08-12 20:44:27', '2018-08-12 20:44:27'),
(40, 13, 5, 'telah mengkonfirmasi bahwa pekerjaan anda dengan nomor pemesananNPp8WMAQxy telah selesai, silahkan cek saldo anda akan secara otomatis bertambah', 'riwayatpemesanan/9', '0', '2018-08-12 20:46:54', '2018-08-12 20:46:54'),
(41, 1, 2, 'berhasil melakukan pengupdatean saldo dengan nominal Rp. 10,000,000.00 pada tanggal 2018-08-13 11:43:09', 'riwayattransaksi', '1', '2018-08-13 11:43:09', '2018-08-19 12:35:20'),
(42, 1, 5, 'telah melakukan penolakan penarikan saldo dengan nominal Rp. 50,000.00 pada tanggal 2018-08-19 12:38:39', 'riwayattransaksi', '0', '2018-08-19 12:38:39', '2018-08-19 12:38:39'),
(43, 13, 1, 'telah melakukan pemesanan terhadap jasa anda', 'permintaanpesanan', '0', '2018-08-24 15:02:53', '2018-08-24 15:02:53'),
(44, 5, 13, 'telah menerima permintaan pesanan anda dengan nomor pemesanan NPJN5WObyk', 'riwayatpemesanan/10?kategori=1&katakunci=', '0', '2018-08-24 15:17:38', '2018-08-24 15:17:38'),
(45, 13, 1, 'telah melakukan pemesanan terhadap jasa anda', 'permintaanpesanan', '0', '2018-08-24 15:24:18', '2018-08-24 15:24:18'),
(46, 1, 42, 'berhasil melakukan pengupdatean saldo dengan nominal Rp. 1,000,000.00 pada tanggal 2022-11-03 13:57:45', 'riwayattransaksi', '0', '2022-11-03 06:57:45', '2022-11-03 06:57:45'),
(47, 42, 1, 'telah melakukan pemesanan terhadap jasa anda', 'permintaanpesanan', '0', '2022-11-03 06:58:45', '2022-11-03 06:58:45'),
(48, 5, 13, 'telah menolak permintaan pesanan anda', 'riwayatpemesanan/11?kategori='' . 1 . ''&katakunci=', '0', '2022-11-03 07:03:24', '2022-11-03 07:03:24'),
(49, 5, 42, 'telah menerima permintaan pesanan anda dengan nomor pemesanan NParq2fYEx', 'riwayatpemesanan/12?kategori=1&katakunci=', '0', '2022-11-03 07:04:13', '2022-11-03 07:04:13'),
(50, 42, 7, 'telah melakukan pemesanan terhadap jasa anda', 'permintaanpesanan', '0', '2022-11-03 07:06:52', '2022-11-03 07:06:52'),
(51, 42, 6, 'telah melakukan pemesanan terhadap jasa anda', 'permintaanpesanan', '0', '2022-11-03 07:07:38', '2022-11-03 07:07:38'),
(52, 1, 42, 'berhasil melakukan pengupdatean saldo dengan nominal Rp. 10,000,000.00 pada tanggal 2022-11-03 14:41:30', 'riwayattransaksi', '0', '2022-11-03 07:41:30', '2022-11-03 07:41:30'),
(53, 1, 47, 'berhasil melakukan pengupdatean saldo dengan nominal Rp. 1,000,000.00 pada tanggal 2025-12-15 23:44:06', 'riwayattransaksi', '0', '2025-12-15 16:44:06', '2025-12-15 16:44:06'),
(54, 47, 20, 'telah melakukan pemesanan terhadap jasa anda', 'permintaanpesanan', '0', '2025-12-15 16:47:19', '2025-12-15 16:47:19'),
(55, 43, 47, 'telah menerima permintaan pesanan anda dengan nomor pemesanan NPCcDDT9pB', 'riwayatpemesanan/15?kategori=1&katakunci=', '0', '2025-12-15 16:58:32', '2025-12-15 16:58:32'),
(56, 1, 47, 'berhasil melakukan pengupdatean saldo dengan nominal Rp. 100,000,000.00 pada tanggal 2025-12-16 09:29:29', 'riwayattransaksi', '0', '2025-12-16 02:29:29', '2025-12-16 02:29:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE IF NOT EXISTS `pelanggan` (
  `id_pelanggan` int(10) unsigned NOT NULL,
  `id` int(11) NOT NULL,
  `namapelanggan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `id`, `namapelanggan`, `created_at`, `updated_at`) VALUES
(1, 2, 'Edy Salim', '2018-07-03 22:25:38', '2018-07-05 01:10:55'),
(2, 3, 'Lionardi', '2018-07-03 22:29:32', '2018-07-03 22:29:32'),
(3, 4, 'Andri', '2018-07-03 22:31:38', '2018-07-03 22:31:38'),
(4, 6, 'Suwandi', '2018-07-16 17:39:33', '2018-07-16 17:39:33'),
(5, 7, 'Andi', '2018-07-19 02:22:11', '2018-07-19 02:22:11'),
(6, 9, 'Sumandi', '2018-07-23 07:08:03', '2018-07-23 07:08:03'),
(7, 10, 'Kevin', '2018-07-23 09:31:26', '2018-07-23 09:31:26'),
(8, 11, 'Kenju', '2018-08-09 08:00:13', '2018-08-09 08:00:13'),
(9, 12, 'Michael', '2018-08-12 16:25:47', '2018-08-12 16:25:47'),
(10, 12, 'Michael', '2018-08-12 16:26:06', '2018-08-12 16:26:06'),
(11, 12, 'Michael', '2018-08-12 16:29:00', '2018-08-12 16:29:00'),
(12, 12, 'Andi', '2018-08-12 16:34:00', '2018-08-12 16:34:00'),
(13, 13, 'Michael', '2018-08-12 16:34:31', '2018-08-12 16:34:31'),
(14, 16, 'Bruce Wayne', '2018-08-12 16:56:23', '2018-08-12 16:56:23'),
(15, 17, 'Krendy', '2018-08-12 16:59:35', '2018-08-12 16:59:35'),
(16, 23, 'Elfine Owen', '2018-08-12 21:21:54', '2018-08-12 21:21:54'),
(17, 24, 'Gilbert', '2018-08-12 21:25:41', '2018-08-12 21:25:41'),
(18, 25, 'Kevin', '2018-08-12 21:28:50', '2018-08-12 21:28:50'),
(19, 26, 'Affandy Diharjo Angkasa', '2018-08-12 21:34:48', '2018-08-12 21:34:48'),
(20, 27, 'Juliani Kosasih', '2018-08-12 21:38:15', '2018-08-12 21:38:15'),
(21, 28, 'Giovanni Artedjo', '2018-08-12 21:40:38', '2018-08-12 21:40:38'),
(22, 29, 'Charles', '2018-08-12 21:43:31', '2018-08-12 21:43:31'),
(23, 40, 'Dicky', '2018-08-13 13:38:36', '2018-08-13 13:38:36'),
(24, 41, 'Suwandi', '2022-11-02 12:18:45', '2022-11-02 12:18:45'),
(25, 42, 'Marco', '2022-11-03 05:21:38', '2022-11-03 05:21:38'),
(26, 44, 'Test', '2025-12-15 05:46:05', '2025-12-15 05:46:05'),
(27, 45, 'Kennedi Anjing', '2025-12-15 05:49:39', '2025-12-15 05:49:39'),
(28, 46, 'Manda', '2025-12-15 11:47:10', '2025-12-15 11:47:10'),
(29, 47, 'Sinta', '2025-12-15 11:47:52', '2025-12-15 11:47:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE IF NOT EXISTS `pemesanan` (
  `id_pemesanan` int(10) unsigned NOT NULL,
  `id_tukang` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_jenispemesanan` int(11) NOT NULL,
  `id_kategoritukang` int(11) NOT NULL,
  `nomorpemesanan` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `biayajasa` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `tanggalbekerja` date NOT NULL,
  `tanggalselesai` date NOT NULL,
  `catatan` text COLLATE utf8_unicode_ci,
  `kategoripemesanan` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `fotopemesanan1` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fotopemesanan2` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alamatpemesanan` text COLLATE utf8_unicode_ci,
  `latitudepemesanan` text COLLATE utf8_unicode_ci,
  `longtitudepemesanan` text COLLATE utf8_unicode_ci,
  `alasanpenolakanpemesanan` text COLLATE utf8_unicode_ci,
  `statuspemesanan` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `statusubahharga` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `id_tukang`, `id_pelanggan`, `id_jenispemesanan`, `id_kategoritukang`, `nomorpemesanan`, `biayajasa`, `tanggalbekerja`, `tanggalselesai`, `catatan`, `kategoripemesanan`, `fotopemesanan1`, `fotopemesanan2`, `alamatpemesanan`, `latitudepemesanan`, `longtitudepemesanan`, `alasanpenolakanpemesanan`, `statuspemesanan`, `statusubahharga`, `created_at`, `updated_at`) VALUES
(3, 1, 8, 1, 1, 'NPz1goNg86', '140000', '2018-08-11', '2018-08-17', 'Mantap', '1', 'fotopesan120180809155501.jpg', '', 'Jln. Palang Karaya (Restoran Ria)', '3.5855397996432137', '98.68257343769073', '', '5', '0', '2018-08-09 08:55:01', '2018-08-09 09:12:02'),
(4, 1, 13, 1, 1, 'NP4Sbaw7pu', '55000', '2018-08-15', '0000-00-00', 'cepat', '0', 'fotopesan120180812172408.jpg', 'fotopesan220180812172408.jpg', 'Jl. Pelita I No. 65', '3.604339232390904', '98.68642113463306', NULL, '5', '0', '2018-08-12 17:24:08', '2018-08-12 17:37:31'),
(5, 1, 13, 2, 1, 'NPr8n7m3Qd', '35600', '2018-08-15', '0000-00-00', 'cepat', '0', NULL, NULL, 'Jl. Pelita I No. 65', '3.604339232390904', '98.68642113463306', 'tidak bisa', '2', '0', '2018-08-12 17:36:29', '2018-08-12 17:38:48'),
(6, 1, 13, 1, 1, 'NP0U4cvc0B', '55000', '2018-08-24', '0000-00-00', 'asdasd', '0', NULL, NULL, 'Jl. Pelita I No. 65', '3.604339232390904', '98.68642113463306', 'tidak', '2', '0', '2018-08-12 18:38:33', '2018-08-12 18:40:03'),
(7, 1, 13, 2, 1, 'NPPvkvcNAT', '35600', '2018-08-17', '0000-00-00', 'adsasdasdas', '0', 'fotopesan120180812183929.jpg', NULL, 'Jl. Pelita I No. 65', '3.604339232390904', '98.68642113463306', 'tidak', '2', '0', '2018-08-12 18:39:29', '2018-08-12 18:40:14'),
(8, 1, 13, 1, 1, 'NP2SLPXpQu', '35000', '2018-08-16', '2018-08-22', 'asdasdsad', '1', NULL, NULL, 'Jl. Pelita I No. 65', '3.604339232390904', '98.68642113463306', NULL, '5', '0', '2018-08-12 18:39:47', '2018-08-12 18:42:18'),
(9, 1, 13, 1, 1, 'NPp8WMAQxy', '55000', '2018-08-24', '0000-00-00', 'cepat', '0', 'fotopesan120180812203832.jpg', NULL, 'Jl. Pelita I No. 65', '3.604339232390904', '98.68642113463306', NULL, '4', '0', '2018-08-12 20:38:32', '2018-08-12 20:46:54'),
(10, 1, 13, 1, 1, 'NPJN5WObyk', '35000', '2018-08-25', '2018-08-31', 'Tolong Ya', '1', 'fotopesan120180824220253.jpg', NULL, 'Jl. Pelita I No. 65', '3.604339232390904', '98.68642113463306', NULL, '1', '0', '2018-08-24 15:02:53', '2018-08-24 15:17:38'),
(11, 1, 13, 1, 1, 'NP8hYVCxg3', '55000', '2018-08-27', '0000-00-00', 'Mantap', '0', NULL, NULL, 'Jl. Pelita I No. 65', '3.604339232390904', '98.68642113463306', 'Maaf lupa dikonfirmasi', '2', '0', '2018-08-24 15:24:18', '2022-11-03 07:03:24'),
(12, 1, 25, 1, 1, 'NParq2fYEx', '55000', '2022-11-04', '0000-00-00', 'Bawa tangga ya', '0', NULL, NULL, 'Jln. Krakatau No. 73', '3.6266857333701097', '98.68082027882338', NULL, '3', '0', '2022-11-03 06:58:45', '2022-11-03 07:42:45'),
(13, 7, 25, 1, 1, 'NP4L2q2P2w', '120000', '2022-11-18', '0000-00-00', 'Bawa tangga ya!', '0', NULL, NULL, 'Jln. Krakatau No. 73', '3.6266857333701097', '98.68082027882338', NULL, '0', '0', '2022-11-03 07:06:52', '2022-11-03 07:06:52'),
(14, 6, 25, 1, 1, 'NPD4lisZiW', '120000', '2022-11-24', '2022-11-30', 'Bawa tangga', '1', NULL, NULL, 'Jln. Krakatau No. 73', '3.6266857333701097', '98.68082027882338', NULL, '0', '0', '2022-11-03 07:07:37', '2022-11-03 07:07:37'),
(15, 20, 29, 1, 1, 'NPCcDDT9pB', '100000', '2025-12-16', '0000-00-00', 'Test', '0', NULL, NULL, 'Test', '3.6184241', '98.680938', NULL, '3', '0', '2025-12-15 16:47:19', '2025-12-16 02:37:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesananbahanmaterial`
--

CREATE TABLE IF NOT EXISTS `pemesananbahanmaterial` (
  `id_pemesananbahanmaterial` int(10) unsigned NOT NULL,
  `id_bahanmaterial` int(11) NOT NULL,
  `id_pemesanan` int(11) NOT NULL,
  `hargapemesananbahanmaterial` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `qtypembelian` int(11) NOT NULL,
  `statuspembelian` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `pemesananbahanmaterial`
--

INSERT INTO `pemesananbahanmaterial` (`id_pemesananbahanmaterial`, `id_bahanmaterial`, `id_pemesanan`, `hargapemesananbahanmaterial`, `qtypembelian`, `statuspembelian`, `created_at`, `updated_at`) VALUES
(8, 1, 3, '1500000', 1, '1', '2018-08-09 08:55:54', '2018-08-09 08:55:57'),
(9, 1, 4, '1500000', 1, '1', '2018-08-12 17:27:38', '2018-08-12 17:28:07'),
(10, 1, 4, '1500000', 1, '1', '2018-08-12 17:27:43', '2018-08-12 17:28:07'),
(11, 1, 4, '1500000', 1, '1', '2018-08-12 17:28:14', '2018-08-12 17:28:21'),
(12, 6, 8, '1500000', 1, '1', '2018-08-12 18:41:16', '2018-08-12 18:41:25'),
(13, 1, 8, '1500000', 1, '1', '2018-08-12 18:41:21', '2018-08-12 18:41:25'),
(14, 6, 8, '1500000', 1, '1', '2018-08-12 18:41:29', '2018-08-12 18:41:50'),
(16, 6, 9, '1500000', 1, '1', '2018-08-12 20:46:06', '2018-08-12 20:46:20'),
(17, 1, 12, '1500000', 1, '1', '2022-11-03 07:42:30', '2022-11-03 07:42:45'),
(18, 1, 15, '1500000', 1, '1', '2025-12-16 02:37:46', '2025-12-16 02:37:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayattransaksi`
--

CREATE TABLE IF NOT EXISTS `riwayattransaksi` (
  `id_riwayattransaksi` int(10) unsigned NOT NULL,
  `id` int(11) NOT NULL,
  `kode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `jumlahsaldo` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `rekening` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `namarekening` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rekeningtujuan` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jenistransaksi` text COLLATE utf8_unicode_ci NOT NULL,
  `buktitransaksi` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `statustransaksi` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `riwayattransaksi`
--

INSERT INTO `riwayattransaksi` (`id_riwayattransaksi`, `id`, `kode`, `jumlahsaldo`, `rekening`, `namarekening`, `rekeningtujuan`, `jenistransaksi`, `buktitransaksi`, `statustransaksi`, `created_at`, `updated_at`) VALUES
(5, 1, 'KT5TP', '100000000', '8305106255', 'Kenju', 'BCA - 8305123456', 'Pengisian Saldo', 'buktitransferKT5TP.jpg', '0', '2018-08-09 08:53:08', '2018-08-09 08:53:08'),
(6, 11, 'KTbNn', '10000000', '8305106255', 'Kenju', 'BCA - 8305123456', 'Pengisian Saldo', 'buktitransferKTbNn.jpg', '1', '2018-08-09 08:54:01', '2018-08-09 08:54:28'),
(7, 5, 'KTABCKC5xk', '140000', '', '', '', 'Pembayaran Biaya Jasa', '', '1', '2018-08-09 09:07:31', '2018-08-09 09:07:31'),
(8, 13, 'KTqnG', '10000000', '8123123124124', 'Michael', 'BCA - 8305123456', 'Pengisian Saldo', 'buktitransferKTqnG.jpg', '1', '2018-08-12 17:06:38', '2018-08-12 17:08:44'),
(9, 5, 'KTABCH0nwL', '35000', NULL, NULL, NULL, 'Pembayaran Biaya Jasa', NULL, '1', '2018-08-12 18:42:00', '2018-08-12 18:42:00'),
(10, 5, 'KTLkuYjR1Z', '50000', '8305106255', 'Kennedi', NULL, 'Penarikan Saldo', NULL, '1', '2018-08-12 18:43:56', '2018-08-12 18:44:42'),
(11, 5, 'KTPefiSrR1', '0', '8305106255', 'Kennedi', NULL, 'Penarikan Saldo', NULL, '2', '2018-08-12 18:44:59', '2018-08-12 18:45:28'),
(12, 5, 'KTANPAu47l', '50000', '8305106255', 'Kennedi', NULL, 'Penarikan Saldo', NULL, '2', '2018-08-12 18:45:47', '2018-08-12 18:46:13'),
(13, 13, 'KTvu9', '10000000', '8123123124124', 'Michael', 'BCA - 8305123456', 'Pengisian Saldo', 'buktitransferKTvu9.jpg', '2', '2018-08-12 20:22:13', '2018-08-12 20:22:39'),
(14, 13, 'KTD7a', '10000000', '8123123124124', 'Michael', 'BCA - 8305123456', 'Pengisian Saldo', 'buktitransferKTD7a.jpg', '1', '2018-08-12 20:24:31', '2018-08-12 20:25:54'),
(15, 5, 'KTABCqPcwq', '55000', NULL, NULL, NULL, 'Pembayaran Biaya Jasa', NULL, '1', '2018-08-12 20:46:54', '2018-08-12 20:46:54'),
(16, 5, 'KTaGH39feN', '50000', '8305106255', 'Kennedi', NULL, 'Penarikan Saldo', NULL, '2', '2018-08-12 20:53:44', '2018-08-19 12:38:39'),
(17, 2, 'KTmhO', '10000000', '8306106244', 'Edy Salim', 'BCA - 8305123456', 'Pengisian Saldo', 'buktitransferKTmhO.jpg', '1', '2018-08-13 11:41:52', '2018-08-13 11:43:09'),
(18, 5, 'KTtx1cecjE', '23750', '8305106255', 'Kennedi', NULL, 'Penarikan Saldo', NULL, '0', '2018-08-24 15:21:51', '2018-08-24 15:21:51'),
(19, 42, 'KTVXf', '1000000', '830400311', 'Marco', 'BCA - 8305123456', 'Pengisian Saldo', 'buktitransferKTVXf.jpg', '1', '2022-11-03 06:56:49', '2022-11-03 06:57:44'),
(20, 42, 'KTsod', '10000000', '830400311', 'Marco', 'BCA - 8305123456', 'Pengisian Saldo', 'buktitransferKTsod.jpg', '1', '2022-11-03 07:40:32', '2022-11-03 07:41:29'),
(21, 47, 'KTUc8', '1000000', '1', 'Sinta', 'BCA - 8305123456', 'Pengisian Saldo', 'buktitransferKTUc8.jpg', '1', '2025-12-15 16:43:40', '2025-12-15 16:44:06'),
(22, 47, 'KTrFc', '100000000', '1', 'Sinta', 'BCA - 8305123456', 'Pengisian Saldo', 'buktitransferKTrFc.jpg', '1', '2025-12-16 02:02:18', '2025-12-16 02:29:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tukang`
--

CREATE TABLE IF NOT EXISTS `tukang` (
  `id_tukang` int(10) unsigned NOT NULL,
  `id` int(11) NOT NULL,
  `id_kategoritukang` int(11) NOT NULL,
  `namatukang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pengalamanbekerja` text COLLATE utf8_unicode_ci,
  `lamapengalamanbekerja` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `deskripsikeahlian` text COLLATE utf8_unicode_ci,
  `rating` double DEFAULT '0',
  `totalvote` int(11) DEFAULT '0',
  `jumlahvote` int(11) DEFAULT '0',
  `fotoktp` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fotosim` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fotohasilkerja` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `statusjasakeahlian` varchar(1) COLLATE utf8_unicode_ci DEFAULT '0',
  `statuseditprofil` varchar(1) COLLATE utf8_unicode_ci DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `tukang`
--

INSERT INTO `tukang` (`id_tukang`, `id`, `id_kategoritukang`, `namatukang`, `pengalamanbekerja`, `lamapengalamanbekerja`, `deskripsikeahlian`, `rating`, `totalvote`, `jumlahvote`, `fotoktp`, `fotosim`, `fotohasilkerja`, `statusjasakeahlian`, `statuseditprofil`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 'Kennedi', 'Saya Pernah Menservice Banyak AC', '1', 'Pasang, perbaiki dan service AC', 4.6666666666667, 14, 3, 'fotoktp5.jpg', 'fotosim5.jpg', '', '1', '1', '2018-07-04 06:46:53', '2018-08-12 20:35:25'),
(2, 8, 2, 'Robin', 'PT. Niaga Raya Teknisi CCTV', '1', 'Ahli CCTV Internasional', 0, 0, 0, 'fotoktp8.jpg', 'fotosim8.jpg', '', '1', '1', '2018-07-23 07:04:10', '2018-08-06 03:09:53'),
(3, 14, 1, 'Test', NULL, '1', '12321312312', 0, 0, 0, 'fotoktp14.jpg', 'fotosim14.jpg', '', '0', '0', '2018-08-12 16:41:03', '2018-08-12 16:41:03'),
(4, 15, 1, 'Coba', NULL, '1', 'Test', 0, 0, 0, 'fotoktp15.jpg', 'fotosim15.jpg', '', '0', '0', '2018-08-12 16:45:20', '2018-08-12 16:45:20'),
(5, 18, 1, 'Adi', 'Toko Indah Jaya', '4', 'Perbaiki dan Service AC', 0, 0, 0, 'fotoktp18.jpg', 'fotosim18.jpg', '', '1', '1', '2018-08-12 17:14:22', '2018-08-12 18:11:22'),
(6, 19, 1, 'Budi', 'PT. Makmur Jaya', '6', 'Service AC', 0, 0, 0, 'fotoktp19.jpg', 'fotosim19.jpg', '', '1', '1', '2018-08-12 17:46:30', '2018-08-12 18:21:00'),
(7, 20, 1, 'Cody', '', '8', 'Perbaiki dan Service AC', 0, 0, 0, 'fotoktp20.jpg', 'fotosim20.jpg', '', '1', '1', '2018-08-12 18:08:44', '2018-08-12 18:23:40'),
(8, 21, 2, 'Edo', NULL, '6', 'Pasang CCTV', 0, 0, 0, 'fotoktp21.jpg', 'fotosim21.jpg', '', '0', '1', '2018-08-12 18:26:56', '2018-08-12 22:22:16'),
(9, 22, 2, 'Fajar', NULL, '4', 'Perbaiki dan pasang CCTV', 0, 0, 0, 'fotoktp22.jpg', 'fotosim22.jpg', '', '0', '0', '2018-08-12 18:27:43', '2018-08-12 18:27:43'),
(10, 30, 1, 'Chandra ', 'Toko Jaya Elektronik', '4', 'Pasang dan Perbaiki AC', 0, 0, 0, 'fotoktp30.jpg', 'fotosim30.jpg', '', '1', '1', '2018-08-12 21:58:52', '2018-08-12 22:30:36'),
(11, 31, 1, 'Muhammad Azwir', 'Toko Marelan Elektronik', '6', 'Pasang dan Service AC', 0, 0, 0, 'fotoktp31.jpg', 'fotosim31.jpg', '', '1', '1', '2018-08-12 22:03:59', '2018-08-12 22:34:19'),
(12, 32, 1, 'Zico', '', '3', 'Pasang dan Service AC', 0, 0, 0, 'fotoktp32.jpg', 'fotosim32.jpg', '', '1', '1', '2018-08-12 22:08:27', '2018-08-12 22:36:59'),
(13, 33, 2, 'Heri Suyono', 'Toko CCTV Jaya', '5', 'Pasang CCTV', 0, 0, 0, 'fotoktp33.jpg', 'fotosim33.jpg', '', '1', '1', '2018-08-12 22:18:33', '2018-08-12 22:46:01'),
(14, 34, 2, 'Jackyson', 'Toko Bilal Elektronik', '3', 'Pasang dan Perbaiki CCTV', 0, 0, 0, 'fotoktp34.jpg', 'fotosim34.jpg', '', '1', '1', '2018-08-12 22:19:38', '2018-08-12 22:50:10'),
(15, 35, 2, 'Vina Loren', '', '5', 'Pasang dan Perbaiki CCTV', 0, 0, 0, 'fotoktp35.jpg', 'fotosim35.jpg', '', '1', '1', '2018-08-12 22:20:38', '2018-08-12 22:53:30'),
(16, 36, 3, 'Muhammad Bachtiar', 'Toko Sukses Mandiri', '4', 'Pasang dan Perbaiki TV, Radio', 0, 0, 0, 'fotoktp36.jpg', 'fotosim36.jpg', '', '1', '1', '2018-08-12 22:58:48', '2018-08-12 23:03:24'),
(17, 37, 3, 'Riduan Salim', '', '5', 'Pasang dan Perbaiki Kulkas, Tv', 0, 0, 0, 'fotoktp37.jpg', 'fotosim37.jpg', '', '1', '1', '2018-08-12 23:00:27', '2018-08-12 23:06:01'),
(18, 38, 4, 'Hermanto', NULL, '5', 'Pasang Instalasi Listrik', 0, 0, 0, 'fotoktp38.jpg', 'fotosim38.jpg', '', '0', '0', '2018-08-12 23:08:41', '2018-08-12 23:08:41'),
(19, 39, 4, 'Hong Koh Tian', NULL, '8', 'Pasang dan Perbaiki Instalasi Listrik', 0, 0, 0, 'fotoktp39.jpg', 'fotosim39.jpg', '', '0', '0', '2018-08-12 23:10:09', '2018-08-12 23:10:09'),
(20, 43, 1, 'Kevin', 'Tukang AC di Sun Plaza~Tukang AC di Medan Fair', '15', 'Test', 0, 0, 0, 'fotoktp_1765773406.jpg', 'fotosim_1765773406.jpg', 'hasil_pekerjaan_1765773406.zip', '1', '1', '2025-12-15 04:36:46', '2025-12-15 16:27:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ulasan`
--

CREATE TABLE IF NOT EXISTS `ulasan` (
  `id_ulasan` int(10) unsigned NOT NULL,
  `id_tukang` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `isiulasan` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `ulasan`
--

INSERT INTO `ulasan` (`id_ulasan`, `id_tukang`, `id_pelanggan`, `rating`, `isiulasan`, `created_at`, `updated_at`) VALUES
(3, 1, 8, 5, 'Nice x', '2018-08-09 09:12:02', '2018-08-09 09:12:02'),
(4, 1, 13, 4, 'good', '2018-08-12 17:37:32', '2018-08-12 17:37:32'),
(5, 1, 13, 5, 'Luar biasa', '2018-08-12 18:42:18', '2018-08-12 18:42:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `kodeuser` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8_unicode_ci,
  `nomorhandphone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `saldo` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nomorrekening` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `namarekening` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fotoprofil` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longtitude` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `statuspengguna` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `statusverifikasi` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `kodeuser`, `alamat`, `nomorhandphone`, `saldo`, `nomorrekening`, `namarekening`, `fotoprofil`, `latitude`, `longtitude`, `statuspengguna`, `statusverifikasi`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', '$2y$10$nKMSx2Tg4YEGDANZcY1DD.c.P9teuHv9bdyIpHjsIOxZewhrQuMQK', 'ADM1', '', '', '', '', '', 'nopicture.jpg', '', '', '0', '1', 'rXOnxoPkzfBDwUKbPtN1Zu58VUB7FIblF1FKtv7VzvD5TaFYcG4rkzxtmJ6A', '2018-07-03 22:05:16', '2025-12-16 02:29:31'),
(2, 'edy@gmail.com', '$2y$10$sUsOzeYmxuL1ObsvA61UM.feT.YIHIWMXC3vGn33yxfVHZGlHwenO', 'NIP1', 'Jln. Krakatau No 53', '0821932132131', '10000000', '8306106244', 'Bank Central Asia', 'fotoprofil2.jpg', '3.61644241551856', '98.67959334337775', '1', '1', 'T8rK2pqSVQki3ft0uSmokDfWe1iFcpAAwSzg9MctrK440eiLa450ctRfo6ZO', '2018-07-03 22:25:38', '2022-05-06 19:23:30'),
(3, 'lionardi@gmail.com', '$2y$10$dB2uGZixTlGQEdEexGAU3emQAIYOnn6puu220B09j5B8mpt.8B.li', 'NIP2', '', '', '0', '', '', 'nopicture.jpg', '', '', '1', '1', 'UzJNHrcqtdrlMQrgTPYzRbvFkaSSuQOnkHK3KAX2jHecD7ANPSAwj9mWR9dk', '2018-07-03 22:29:32', '2018-08-06 02:46:47'),
(4, 'andri@gmail.com', '$2y$10$SUJW3eZtpCopPkDGK9FH9uG3ExhXjQrl7HFFbpypcDOcx7aANqf.e', 'NIP3', '', '', '0', '', '', 'nopicture.jpg', '', '', '1', '1', 'i9BlXsAOY8twTJhqYSiLgSZOpEfK62aZJ6SXaFH5g8WIQkbNWCjoj06lwqNA', '2018-07-03 22:31:38', '2018-08-06 02:46:54'),
(5, 'kennedi@gmail.com', '$2y$10$z0JsXQrzKuhNEB1b3pf.oeszGztLyrhuKl6ZtdnswKwZG781cLgWC', 'TAC1', 'Jln. Karya Wisata No. 53', '082161621035', '10000', '8305106255', '', 'fotoprofil5.jpg', '3.557957340653788', '98.70297431945801', '2', '1', 'enHYxTpvJkX0IUXDHqKIp7FMxKG2QMZ4D0mZ1o9ocFdHzQCbH5oqQWrKDjF6', '2018-07-04 06:46:53', '2022-11-18 05:46:39'),
(6, 'sutod@gmail.com', '$2y$10$Rsvbnb7rm.tPmohoSa8I.emKiwUqtGuJpXjB7xeGnM3C4vbxLtTg6', 'NIP4', 'Jln, Madong Lubis No. 53', '089832141241', '0', '123456789', '', 'nopicture.jpg', '3.590418368644319', '98.69488199577029', '1', '1', 'rnYgJXeSZI35XRkzmRMey5xbB6ARV2rik3krYeRn9oFla2Ce1zYEoDqBg3xJ', '2018-07-16 17:39:33', '2018-07-16 17:50:22'),
(7, 'andi@gmail.com', '$2y$10$aHTmFTAjlxMxhHwfDufl5evaP3Rl/QPvRL8ahGXi94O4iBZTZfHYK', 'NIP5', 'Jl. Prof. HM. Yamin Sh No.47', '081361382054', '0', '909321411', '', 'nopicture.jpg', '3.5980585112422174', '98.68838310241699', '1', '1', '4e5A9LXfvqzpn3RICGLc7QoFZXfvCSBxsYlkBoZNDm3PAWeAaentcOsFaiTG', '2018-07-19 02:22:12', '2018-07-19 02:44:03'),
(8, 'robintukang@gmail.com', '$2y$10$rquO0oWJDCn5H6A1SLARuuJ6vaYuVnozfmmqnGVok.QQ5hedynJSq', 'TAC2', 'Jl. Prof. HM. Yamin Sh No.47', '0893421411', '0', '309421411', 'Bank Central Asia', 'fotoprofil8.jpg', '3.5980585112422174', '98.68838310241699', '2', '1', 'Gq1j0KlvocQvdkVf9pRws5nLunG8BVu3xp0BBXIpbxiKHwngPmpzuyvGbPE7', '2018-07-23 07:04:10', '2018-08-06 03:07:51'),
(9, 'sumandi@gmail.com', '$2y$10$sqHidG5hIOCorpqRdOVf3.WsI0w6C47yACK3PCXOorWOC10/J6nSC', 'NIP6', '', '', '0', '', '', 'nopicture.jpg', '', '', '1', '1', NULL, '2018-07-23 07:08:03', '2018-07-23 07:08:03'),
(10, 'kevin@gmail.com', '$2y$10$5gO6Z2SS9QH0BceUZUbJ5ugyVAL.oevVDfOgfHyHoT0u90oENDOeu', 'NIP7', 'Jalan Putri Hijau No.17', '08197321411', '0', '1234567890', '', 'fotoprofil10.jpg', '3.5997289090347766', '98.6726975440979', '1', '1', 'KtF1ZgJu9Yjfb3zTzmaqX0l3aibK6jnYaMKd4KulyKGrovNezPhpvcePCuKI', '2018-07-23 09:31:27', '2018-07-23 09:48:10'),
(11, 'kenju@gmail.com', '$2y$10$pcDQQ68mxr9yzWAErQfkGedpqfqK1sQhUQB22mWx3ppylw9h7vykG', 'NIP8', 'Jln. Majapahit No. 53', '0812345678901', '8355331.9477059', '8305106255', 'Kenju', 'fotoprofil11.jpg', '3.6054809572669693', '98.63065057023778', '1', '1', 'wmzFlg4xHFmtdKfqeKyQZ59U9VhDnVWQ0miZgrTcoDYJXjxffKUTJjN05DEl', '2018-08-09 08:00:13', '2018-08-09 09:07:14'),
(12, 'andilovedesign123@gmail.com', '$2y$10$5l86satF8ofhGunkd6cOiO0qOeBuPEyGZiXcB5aGYXhvlsJMRNNf2', 'NIP9', '1', '1', '0', '1', '1', 'nopicture.jpg', '3.5955573515899077', '98.67926401852418', '1', '1', 'rTJigpG5fqk3dPHuFWRZCuWJPjDAnQkI6eQEMl1KrVsoWQBqi4bw5ZuCoj2t', '2018-08-12 16:34:01', '2024-02-09 05:53:32'),
(13, 'michaelsalim39@gmail.com', '$2y$10$ZDOjL2f8vWfpf7JkTvAcQO1eSlo5pAWrNES9Wx4UJa0e8dQZsAYke', 'NIP10', 'Jl. Pelita I No. 65', '08123123123', '9169693.6872431', '8123123124124', 'Bank Central Asia', 'fotoprofil13.jpg', '3.604125080083662', '98.68714856462475', '1', '1', 'Mut9LyjofeYYU7lJE1kqlC7GgrvaKzIq5tBHeGnRuaL4ImrgxtkYnKyMe1jK', '2018-08-12 16:34:31', '2022-11-03 07:03:24'),
(14, 'test@gmail.com', '$2y$10$ghFqO/7C2Q4iU0MQd5x37ueHrKPQq/2VrusRlcY3DT3l0.LZZhIn2', 'TAC3', NULL, NULL, '0', NULL, NULL, 'fotoprofil14.jpg', NULL, NULL, '2', '1', NULL, '2018-08-12 16:41:03', '2018-08-12 17:07:25'),
(15, 'coba@gmail.com', '$2y$10$J7E6Nb7/UJd/1KDJZ4.vbOeRU6D35Lem8J.c3.Zz8NnhPhjYIind2', 'TAC4', NULL, NULL, '0', NULL, NULL, 'fotoprofil15.jpg', NULL, NULL, '2', '1', NULL, '2018-08-12 16:45:20', '2018-08-12 17:07:29'),
(16, 'frentzenlouei@yahoo.com', '$2y$10$r8PJ2XpKFeoug1ybFiBuT.8rAeU2QmtRjumHdZM/EJjLroszq3Waa', 'NIP11', 'Jl, Karya No. 125', '0812312441231', '0', '8123123124', 'Bank Central Asia', 'fotoprofil16.jpg', '3.6110213558728828', '98.66560052287241', '1', '1', 'abE1fH5jLF4mJyrBdeH65UkNr6yT2x4ktmi4LTjq2lCbY3rcTxsHMOoUhf71', '2018-08-12 16:56:23', '2018-08-12 16:58:56'),
(17, 'krendyw4@gmail.com', '$2y$10$bOadfQO.lr4kacrx4ojXAu4HULCEvxvw9VcjHAnwCMWyO9.Wtc2.y', 'NIP12', 'Jl. Bambu V No. 25', '0811111111111', '0', '84123417234581', 'Bank Mandiri', 'fotoprofil17.jpg', '3.6087784692050517', '98.67819870302412', '1', '1', 'pLbqjjqZiCNRwYrBrcaR1rregfy3846oWJ9x2Qc7EKOVPzJ1mLqfmtatx4ye', '2018-08-12 16:59:35', '2018-08-12 17:42:42'),
(18, 'adi@gmail.com', '$2y$10$z0JsXQrzKuhNEB1b3pf.oeszGztLyrhuKl6ZtdnswKwZG781cLgWC', 'TAC5', 'Jl. Bambu II No.56', '0814324234244', '0', '812312424124', 'Bank Mandiri', 'fotoprofil18.jpg', '3.6068554762307232', '98.67617411373908', '2', '1', 'NwFwJXe8lmX9bBQgBA9Ij1j8p90yUcB8FWzmOtVL4CbMB1mbzhM1epfEpH1l', '2018-08-12 17:14:22', '2022-11-03 04:48:41'),
(19, 'budi@gmail.com', '$2y$10$y/T75W8ZcY7s19EFAhIynOt3toA5l.dEfNw6vebPZKAlAR1fZbc8S', 'TAC6', 'Jl. Bambu No. 23', '081231241241', '0', '81231231244', 'Bank Mandiri', 'fotoprofil19.jpg', '3.6043978678398654', '98.68093771694953', '2', '1', 'V8OLmXTCSnxNylklLj1tjVaDKNFzrGDZ5aL2x5foh7phuFxxx2covjiJtkK4', '2018-08-12 17:46:30', '2018-08-12 18:21:06'),
(20, 'cody@gmail.com', '$2y$10$uKEoi3oDy32Rh6kw/UwWyeDc92U64bIz3axDR0wJd0LVW5MCg1FDy', 'TAC7', 'Jl. Bilal Ujung No. 6', '8123124133', '0', '8123124124', 'Bank Central Asia', 'fotoprofil20.jpg', '3.623164490982744', '98.68163459707728', '2', '1', 'xRjLVfh1p39CnF9CHShAR3YFtKPPnhvTZ3gL19PI9RAtFzmGNvP6ZvIKbXJ9', '2018-08-12 18:08:44', '2018-08-12 18:25:48'),
(21, 'edo@gmail.com', '$2y$10$vu1FdpunWjVnN6POTD9lGuitS8TQWNNTBXz/FFo3/IGtkfUdykbv2', 'TAC8', 'Jl. Pelita IV No. 123', '0812312312412', '0', '91231231231', 'Bank Mandiri', 'fotoprofil21.jpg', '3.6077468726803237', '98.68692528296015', '2', '1', 'tiGsxVRgOe7u5mcQEp2AAyRTG7mwZCkRti9qFioevfpGdHrWlr2N6qnBTuVo', '2018-08-12 18:26:56', '2018-08-12 22:22:45'),
(22, 'fajar@gmail.com', '$2y$10$dB0AZhbFvkk5EL524JnrfOfHFOhDTh59XNUNjpgxUu4AW8d9R4g7i', 'TAC9', NULL, NULL, '0', NULL, NULL, 'fotoprofil22.jpg', NULL, NULL, '2', '0', NULL, '2018-08-12 18:27:44', '2018-08-12 18:27:44'),
(23, 'elfine-owen@hotmail.com', '$2y$10$6GY7YAOnrvrg03hZCl.ZFegCp5aAA2ZrYVbg9bE2hp.Y5zmUsTktS', 'NIP13', 'Jl. Umar No. 23', '081231231414', '0', '8131232131', 'Bank Nasional Indonesia', 'fotoprofil23.jpg', '3.6199210334928154', '98.67461123086741', '1', '1', 'L3nDkDfu2eFZAVRreD8WioKz0Ma3hoarymSeMdBPYXWAFnTKNbyohnFtFx53', '2018-08-12 21:21:54', '2018-08-12 21:24:48'),
(24, 'yukijaden5@gmail.com', '$2y$10$dYuQ/sMudsfWVEzSKl9V3OKhQYVwq5xDwF4wlc1RyPG8DDYfzKj0i', 'NIP14', 'Jl. Pendidikan No 78', '08412341233', '0', '79412345889', 'Bank Central Asia', 'fotoprofil24.jpg', '3.6192662731114718', '98.70216170538811', '1', '1', '89Bu3Rv4qfMSIhpYzz576YogoMLuluIbyYJk3Jp6IzAoMm1WPDXzLUD0wk8L', '2018-08-12 21:25:42', '2018-08-12 21:27:42'),
(25, 'badkids28@gmail.com', '$2y$10$.N1yIXAl8C5VrNO.FXJplu/OT6CFMbnqwU.rV.A7oHjCZC2eVW3/u', 'NIP15', 'Jl. Permai No.32', '084324241213', '0', '8112347821', 'Bank Nasional Indonesia', 'fotoprofil25.jpg', '3.6072199458126524', '98.69370747495589', '1', '1', 'UmEgYiPxij3R4QUaYJJvdrnSxXKgB8ezlsCEe1qY4sI2t1cy6M8d4KRy5kX4', '2018-08-12 21:28:51', '2018-08-12 21:30:54'),
(26, 'affandidiharjo@gmail.com', '$2y$10$NZcSaj1lT68668kPnuJcDOafIOtWl2XmrVFdw3tesUIg80dCrC8mi', 'NIP16', 'Jl. Karantina No.56', '0814251232', '0', '81234141234', 'Bank Central Asia', 'fotoprofil26.jpg', '3.6100056909559113', '98.68220942620542', '1', '1', 'R5dnbnXa01EAHzHlRaEtVF7KgPr70T1C3MpxaZFzR93qPy5w8HVTweLWvmIS', '2018-08-12 21:34:48', '2018-08-12 21:37:39'),
(27, 'juliani.kosasi04@gmail.com', '$2y$10$K1gmrTjSPGU4vmJV0F.gl.DCI6O.Che4KlIyEIsDi0M3sGRnBFKC6', 'NIP17', 'Jl. Batu Bara No. 214', '081452432511', '0', '8414123462123', 'Bank Mandiri', 'fotoprofil27.jpg', '3.5900636786465046', '98.68534030152966', '1', '1', 'gKEGQ9yRtLjJpiHsEaJddMC68GdOy1daEJAZUPsSfwbqcWUdf249Yq3hQ08e', '2018-08-12 21:38:16', '2018-08-12 21:39:56'),
(28, 'giovanni_artedjo@yahoo.com', '$2y$10$kv1YwbbXoLXSkSJfWh2Nb./iztw2aoYXrhqQ3/BcmTfCjONAl4jDq', 'NIP18', 'Jl. Sei kera No. 23', '083314123123', '0', '81231214214', 'Bank Nasional Indonesia', 'fotoprofil28.jpg', '3.5941422969527648', '98.68510288828952', '1', '1', 'NwWgJC9o1rYBZfXCo0vO9XNgxy6pe54LkGJA6kYRhsFHZR66cOI784ejMwId', '2018-08-12 21:40:38', '2018-08-12 21:43:01'),
(29, '141111758@students.mikroskil.ac.id', '$2y$10$YxU1oZ2iDJQ/FTYvPCiw8OS1Q8kWLYIJ48lSfijfeHwbNWqGlgyE6', 'NIP19', 'Jl. Tuasan No 291', '08142414123', '0', '81231231345', 'Bank Central Asia', 'fotoprofil29.jpg', '3.615957204465033', '98.6974067104909', '1', '1', 'xDhVyKZ8YoAb3Z6H122H8vJ1s7EtSrSOtWZbF410wWoUb6Yc6yycmISGT3F5', '2018-08-12 21:43:31', '2018-08-12 21:51:19'),
(30, 'chanciasui@gmail.com', '$2y$10$6omD9XIiC6gmsirLJ4gPLOpkcTkzbRNnHKx7XEhMNE3ecSecIHit2', 'TAC10', 'Jl. Pukat II No.25', '08141231233', '0', '8123142341', 'Bank Central Asia', 'fotoprofil30.jpg', '3.5946625334908915', '98.70780471172907', '2', '1', 'X9mjTrviZJkluIkleofJarEc22DHMvU4xixqJ5KW73ddHdCkcEwVlt5jAwvR', '2018-08-12 21:58:52', '2018-08-12 22:31:35'),
(31, 'mazwir@gmail.com', '$2y$10$lJdSfxaKIjg7FKOQ.vK.Le9EMD7RcDMe/.JX51aCWuLeyez4f8Hfq', 'TAC11', 'Jl. Marelan V No. 98', '08312312321', '0', '7123123123412', 'Bank Mandiri', 'fotoprofil31.jpg', '3.697049630227276', '98.65579431482365', '2', '1', '4GWfl3xqgOwvIiIMEDfg8d1eiYUIVpcWQZ4myEDxG7JzmPSYfJRsdLWK2TGB', '2018-08-12 22:03:59', '2018-08-12 22:34:55'),
(32, 'sanazukiv@gmail.com', '$2y$10$aFlaPalGIY3W57fyiERKYe.20HylFBjEqiMLicpihp.m4U017czWa', 'TAC12', 'Jl. Perwira V No. 50', '08425123415', '0', '8467512842', 'Bank Central Asia', 'fotoprofil32.jpg', '3.6385662673174854', '98.6886083411955', '2', '1', 'ZOKGvpyqOcodcmS8FiaiLrF77NsRjJ32u3Y7uIs3htf25wczwTINnoZk1MPe', '2018-08-12 22:08:27', '2018-08-12 22:37:05'),
(33, 'herifi88@gmail.com', '$2y$10$avQMec2ad7hOuuXMq.GuseXlaziKxEOPpxjSmrWE9wZ85vWbCzqJm', 'TAC13', 'Jl. Denai No.278', '0824123213123', '0', '8412316782', 'Bank Central Asia', 'fotoprofil33.jpg', '3.5816030185662933', '98.71653263378698', '2', '1', 'Oktl3ZyDuC49wR9ycJOGh4PQcr7uYff5wxJg2VnLEijPuDdyLh5RfsXU9Irn', '2018-08-12 22:18:33', '2018-08-12 22:46:14'),
(34, 'wianjacky@gmail.com', '$2y$10$oZeDCGYekFbvNiBaMeBjxu0yeRllI/Mp8hB/utt1f4d/zsDvQSUl6', 'TAC14', 'Jl. Bhayangkara No. 121', '081156732134', '0', '8431451234', 'Bank Nasional Indonesia', 'fotoprofil34.jpg', '3.622242341475166', '98.6997534617235', '2', '1', 'iMKcfmNfn96kj5LlDOFB4UNSqOjQliAI0xkFQy55Ed4YyfMIBpAC8LoY5ojO', '2018-08-12 22:19:39', '2018-08-12 22:50:58'),
(35, 'vinaloren88@gmail.com', '$2y$10$Hcm13ZNOU9qSk0eftx5.YeJ5SrQ7uPf6rZDbIqTzLOZCi/B5q.NWq', 'TAC15', 'Jl. Letda Sujono No. 256', '083123123213', '0', '8941231231231', 'Bank Mandiri', 'fotoprofil35.jpg', '3.5968308883973705', '98.74165081970762', '2', '1', 'rocn5JIYsAYH7XvJ2QC3fkJwk1Yvtn5WhMSpX3H7ENmFsDrCgSvpid6yUVUW', '2018-08-12 22:20:38', '2018-08-12 22:53:49'),
(36, 'tiarjs223@gmail.com', '$2y$10$ay6bxuuMz79hKW1Q4E1/H.3YlrZR7wZh8aKez7JEu5YTi4Skxoehq', 'TAC16', 'Jl. Palapa No. 67', '08123123144', '0', '8122466723', 'Bank Central Asia', 'fotoprofil36.jpg', '3.630278088997335', '98.66866791984467', '2', '1', 'UyXBuzshBr57Ns3ceqhPgeKzn9UDuqbsZgAoJ8KCOkJvZiCFQju2668O3Qbu', '2018-08-12 22:58:48', '2018-08-12 23:03:47'),
(37, 'riduansalim88@gmail.com', '$2y$10$67VzwN977pHkAaeK36Mt1uoVrn6p2kEogzd00W.rfj5Xeb32WP4Uq', 'TAC17', 'Jl. Gaperta No. 231', '081412312444', '0', '814123141245', 'Bank Mandiri', 'fotoprofil37.jpg', '3.604604115399853', '98.63873148297955', '2', '1', '3kMGJpREDQGnGZ1YmQavbAMMjmXe1SWihrTfi765GPSiClBXNS1NTKcjEdEn', '2018-08-12 23:00:27', '2018-08-12 23:06:09'),
(38, 'xieciachai@gmail.com', '$2y$10$zFdH26Cta7eH0q4BLlNSw.mBpk2WTl/nXH.17kBBkAO2j0rEqlc4W', 'TAC18', NULL, NULL, '0', NULL, NULL, 'fotoprofil38.jpg', NULL, NULL, '2', '0', NULL, '2018-08-12 23:08:41', '2018-08-12 23:08:41'),
(39, 'hongkohtian@gmail.com', '$2y$10$M7wJZ7Xyx9./gsCkv65TOulirGg5WDaICS8mXo/uyUHahnpT39jMG', 'TAC19', NULL, NULL, '0', NULL, NULL, 'fotoprofil39.jpg', NULL, NULL, '2', '0', NULL, '2018-08-12 23:10:10', '2018-08-12 23:10:10'),
(40, 'saputralin.dicky@gmail.com', '$2y$10$/8k.Q1aaoomI57qNvikkI.bdubXSt5N6OpwtNk/7NyLD7nSuW1HMi', 'NIP20', NULL, NULL, '0', NULL, NULL, 'nopicture.jpg', NULL, NULL, '1', '1', NULL, '2018-08-13 13:38:38', '2018-08-13 13:38:38'),
(41, 'suwandi@gmail.com', '$2y$10$Z7plNtGECYQ01nxX3C2ECOph7mBCPb0ERb3isUAEEtOfYxrmO4aje', 'NIP21', '', '081234567890', '0', '830519944', 'Suwandi', 'nopicture.jpg', '3.587968808626384', '98.7077049509262', '1', '1', 'lDBIgDPwxtuPteL5wG6bUr85Bi5JOFtBHxECRcbZAMX0FWtAJXe2RTYodhRb', '2022-11-02 12:18:45', '2022-11-02 12:26:27'),
(42, 'marco@gmail.com', '$2y$10$w1CJDIwnjJiy2DJkgqgFhevcQMO8qf.jXxwa4fI7jxJ.zoE.2pTOq', 'NIP22', 'Jln. Krakatau No. 73', '081345567781', '9138397.2282153', '830400311', 'Marco', 'fotoprofil42.jpg', '3.625812414695396', '98.68011116981506', '1', '1', '3IRV34nVDNCYJx7inM9HWKvveVIZEJ6hvF52l8mTv8g0rsuMXKTK0sM4UaGz', '2022-11-03 05:21:39', '2022-11-18 05:38:03'),
(43, 'kevinsuw@gmail.com', '$2y$10$cOVo4wEpIq.3zDRyQqCoJeNO9GDUF4N4AJFbXOs2baGgcMHhsw//.', 'TAC20', '1', '1', '0', '1', '1', 'fotoprofil_1765773406.jpg', '3.587262922014247', '98.70708966208085', '2', '1', 'h1Mh0L2BorptZMFddS0n4Ce781vLz5dOjiKugz3cf7a4q7YxUaFuQkLvnsqO', '2025-12-15 04:36:47', '2025-12-16 18:23:45'),
(44, 'testsaja@gmail.com', '$2y$10$Ebe12MY34zhx9nKrUO77RORD0ogMjog/TdSHhpKvN5RYHJ1izI5Ya', 'NIP23', NULL, NULL, '0', NULL, NULL, 'nopicture.jpg', NULL, NULL, '1', '1', NULL, '2025-12-15 05:46:05', '2025-12-15 05:46:05'),
(45, 'kennedianjing@gmail.com', '$2y$10$8wv0v1EmVOyPMH8ujgRtxeSMwVRyCJrn0C5iu56dn3x.8s1UrDZl2', 'NIP24', NULL, NULL, '0', NULL, NULL, 'nopicture.jpg', NULL, NULL, '1', '1', NULL, '2025-12-15 05:49:39', '2025-12-15 05:49:39'),
(46, 'manda@gmail.com', '$2y$10$MqteZ.H/hDX6As/HDYJBAOfG5PDdGBZBakSUdc/vIWkIB/7Nq767y', 'NIP25', NULL, NULL, '0', NULL, NULL, 'nopicture.jpg', NULL, NULL, '1', '1', NULL, '2025-12-15 11:47:10', '2025-12-15 11:47:10'),
(47, 'sinta@gmail.com', '$2y$10$Vv0ZSzarcBCqkacUva6QaOFKbbKojbA7GaDMvxaJTp1aZVN39JS2e', 'NIP26', 'Test', '1', '99346709.442978', '1', '1', 'nopicture.jpg', '3.5889171429439597', '98.70831494939162', '1', '1', 'X3JxwQLZ8TWGKhxovfLuGrh73DRT2Fm5RR4N8LZTownNG0hrD4gB8kvrpgab', '2025-12-15 11:47:52', '2025-12-16 02:39:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `alamatpelanggan`
--
ALTER TABLE `alamatpelanggan`
  ADD PRIMARY KEY (`id_alamatpelanggan`);

--
-- Indexes for table `bahanmaterial`
--
ALTER TABLE `bahanmaterial`
  ADD PRIMARY KEY (`id_bahanmaterial`);

--
-- Indexes for table `hargajarak`
--
ALTER TABLE `hargajarak`
  ADD PRIMARY KEY (`id_hargajarak`);

--
-- Indexes for table `jasatersedia`
--
ALTER TABLE `jasatersedia`
  ADD PRIMARY KEY (`id_jasatersedia`);

--
-- Indexes for table `jenispemesanan`
--
ALTER TABLE `jenispemesanan`
  ADD PRIMARY KEY (`id_jenispemesanan`);

--
-- Indexes for table `kategoritukang`
--
ALTER TABLE `kategoritukang`
  ADD PRIMARY KEY (`id_kategoritukang`);

--
-- Indexes for table `laporanprogress`
--
ALTER TABLE `laporanprogress`
  ADD PRIMARY KEY (`id_progress`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`), ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indexes for table `pemesananbahanmaterial`
--
ALTER TABLE `pemesananbahanmaterial`
  ADD PRIMARY KEY (`id_pemesananbahanmaterial`);

--
-- Indexes for table `riwayattransaksi`
--
ALTER TABLE `riwayattransaksi`
  ADD PRIMARY KEY (`id_riwayattransaksi`);

--
-- Indexes for table `tukang`
--
ALTER TABLE `tukang`
  ADD PRIMARY KEY (`id_tukang`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id_ulasan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `alamatpelanggan`
--
ALTER TABLE `alamatpelanggan`
  MODIFY `id_alamatpelanggan` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `bahanmaterial`
--
ALTER TABLE `bahanmaterial`
  MODIFY `id_bahanmaterial` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `hargajarak`
--
ALTER TABLE `hargajarak`
  MODIFY `id_hargajarak` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `jasatersedia`
--
ALTER TABLE `jasatersedia`
  MODIFY `id_jasatersedia` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT for table `jenispemesanan`
--
ALTER TABLE `jenispemesanan`
  MODIFY `id_jenispemesanan` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `kategoritukang`
--
ALTER TABLE `kategoritukang`
  MODIFY `id_kategoritukang` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `laporanprogress`
--
ALTER TABLE `laporanprogress`
  MODIFY `id_progress` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `pemesananbahanmaterial`
--
ALTER TABLE `pemesananbahanmaterial`
  MODIFY `id_pemesananbahanmaterial` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `riwayattransaksi`
--
ALTER TABLE `riwayattransaksi`
  MODIFY `id_riwayattransaksi` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `tukang`
--
ALTER TABLE `tukang`
  MODIFY `id_tukang` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id_ulasan` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
