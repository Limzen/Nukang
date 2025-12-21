-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2025 at 08:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jasarenovasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(10) UNSIGNED NOT NULL,
  `id` int(11) NOT NULL,
  `namaadmin` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `id`, `namaadmin`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', '2018-07-19 02:45:04', '2018-07-19 02:45:04');

-- --------------------------------------------------------

--
-- Table structure for table `alamatpelanggan`
--

CREATE TABLE `alamatpelanggan` (
  `id_alamatpelanggan` int(10) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `alamatpelanggan` text NOT NULL,
  `latitudealamat` varchar(30) NOT NULL,
  `longtitudealamat` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `alamatpelanggan`
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
(21, 29, 'Test', '3.6184241', '98.680938', '2025-12-15 16:41:33', '2025-12-15 16:41:33'),
(22, 30, 'Jalan Test No. 99', '3.5951956', '98.6722227', '2025-12-19 22:09:42', '2025-12-19 22:09:42'),
(23, 30, 'Jl. Test No. 123, Medan', '3.5941194', '98.6875767', '2025-12-19 22:15:06', '2025-12-19 22:15:06'),
(24, 30, 'Jl. Gatot Subroto No. 45, Medan', '3.5941194', '98.6875767', '2025-12-19 22:21:43', '2025-12-19 22:21:43'),
(25, 46, 'test', '3.5951956', '98.6722227', '2025-12-20 07:54:35', '2025-12-20 07:54:35');

-- --------------------------------------------------------

--
-- Table structure for table `bahanmaterial`
--

CREATE TABLE `bahanmaterial` (
  `id_bahanmaterial` int(10) UNSIGNED NOT NULL,
  `id_kategoritukang` int(11) NOT NULL,
  `kodebahanmaterial` varchar(10) NOT NULL,
  `bahanmaterial` varchar(100) NOT NULL,
  `informasibahanmaterial` text NOT NULL,
  `hargabahanmaterial` varchar(50) NOT NULL,
  `fotobahanmaterial` varchar(50) NOT NULL,
  `statusbahanmaterial` varchar(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bahanmaterial`
--

INSERT INTO `bahanmaterial` (`id_bahanmaterial`, `id_kategoritukang`, `kodebahanmaterial`, `bahanmaterial`, `informasibahanmaterial`, `hargabahanmaterial`, `fotobahanmaterial`, `statusbahanmaterial`, `created_at`, `updated_at`) VALUES
(1, 1, 'KBa321saAs', 'AC Baru', 'Plastik', '1500000', 'fotobahanmaterial20180705095447.jpg', '1', '2018-07-05 16:32:14', '2018-07-23 07:42:11'),
(5, 2, 'KBY82LhHsQ', 'CCTV HD', 'Mesin', '500000', 'fotobahanmaterial1A08UtYRB.jpg', '1', '2018-07-23 07:56:22', '2018-07-23 07:56:22'),
(6, 1, 'KBhFxkVcfS', 'AC LG', 'Baru', '1500000', 'fotobahanmaterial1wJdHPBUm.jpg', '1', '2018-08-12 18:31:05', '2018-08-12 18:31:05');

-- --------------------------------------------------------

--
-- Table structure for table `hargajarak`
--

CREATE TABLE `hargajarak` (
  `id_hargajarak` int(10) UNSIGNED NOT NULL,
  `hargajarak` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hargajarak`
--

INSERT INTO `hargajarak` (`id_hargajarak`, `hargajarak`, `created_at`, `updated_at`) VALUES
(1, 15000, '2018-08-05 16:58:44', '2018-08-12 17:41:55');

-- --------------------------------------------------------

--
-- Table structure for table `jasatersedia`
--

CREATE TABLE `jasatersedia` (
  `id_jasatersedia` int(10) UNSIGNED NOT NULL,
  `id_tukang` int(11) NOT NULL,
  `id_jenispemesanan` int(11) NOT NULL,
  `biayajasatersedia` varchar(30) NOT NULL,
  `jenisjasatersedia` varchar(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `jasatersedia`
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
(87, 20, 1, '100000', '1', '2025-12-15 16:27:57', '2025-12-15 16:27:57'),
(88, 49, 1, '200000', '0', '2025-12-20 01:34:28', '2025-12-20 01:34:28'),
(89, 49, 1, '300000', '1', '2025-12-20 01:34:28', '2025-12-20 01:34:28'),
(112, 21, 1, '200000', '0', '2025-12-20 01:59:38', '2025-12-20 01:59:38'),
(113, 21, 1, '300000', '1', '2025-12-20 01:59:38', '2025-12-20 01:59:38'),
(117, 32, 2, '200000', '0', '2025-12-20 09:17:00', '2025-12-20 09:17:00'),
(118, 32, 11, '400000', '1', '2025-12-20 09:17:00', '2025-12-20 09:17:00');

-- --------------------------------------------------------

--
-- Table structure for table `jenispemesanan`
--

CREATE TABLE `jenispemesanan` (
  `id_jenispemesanan` int(10) UNSIGNED NOT NULL,
  `id_kategoritukang` int(11) NOT NULL,
  `jenispemesanan` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `jenispemesanan`
--

INSERT INTO `jenispemesanan` (`id_jenispemesanan`, `id_kategoritukang`, `jenispemesanan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pengecatan Dinding Interior', '2018-07-04 14:17:22', '2018-07-04 14:17:22'),
(2, 1, 'Renovasi Dapur', '2018-07-04 15:37:36', '2018-07-04 15:37:36'),
(3, 2, 'Pengecatan Dinding Eksterior', '2018-07-23 08:06:14', '2018-07-23 08:11:02'),
(5, 2, 'Renovasi Pagar', '2018-08-12 18:12:47', '2018-08-12 18:12:47'),
(11, 1, 'Renovasi Kamar Mandi', '2025-12-19 20:55:12', '2025-12-19 20:55:12'),
(12, 1, 'Pemasangan Keramik/Lantai', '2025-12-19 20:55:12', '2025-12-19 20:55:12'),
(13, 1, 'Perbaikan Plafon', '2025-12-19 20:55:12', '2025-12-19 20:55:12'),
(14, 2, 'Renovasi Taman', '2025-12-19 20:55:12', '2025-12-19 20:55:12'),
(15, 2, 'Renovasi Carport/Garasi', '2025-12-19 20:55:12', '2025-12-19 20:55:12'),
(16, 2, 'Pemasangan Kanopi', '2025-12-19 20:55:12', '2025-12-19 20:55:12');

-- --------------------------------------------------------

--
-- Table structure for table `kategoritukang`
--

CREATE TABLE `kategoritukang` (
  `id_kategoritukang` int(10) UNSIGNED NOT NULL,
  `kategoritukang` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kategoritukang`
--

INSERT INTO `kategoritukang` (`id_kategoritukang`, `kategoritukang`, `created_at`, `updated_at`) VALUES
(1, 'Renovasi Indoor', '2018-07-04 13:30:33', '2018-07-04 13:30:33'),
(2, 'Renovasi Outdoor', '2018-07-04 13:30:33', '2018-07-04 13:30:33');

-- --------------------------------------------------------

--
-- Table structure for table `laporanprogress`
--

CREATE TABLE `laporanprogress` (
  `id_progress` int(10) UNSIGNED NOT NULL,
  `id_tukang` int(11) NOT NULL,
  `id_pemesanan` int(11) NOT NULL,
  `tanggal_progress` datetime NOT NULL,
  `informasi_pekerjaan` text NOT NULL,
  `fotoprogress1` varchar(50) DEFAULT NULL,
  `fotoprogress2` varchar(50) DEFAULT NULL,
  `fotoprogress3` varchar(50) DEFAULT NULL,
  `fotoprogress4` varchar(50) DEFAULT NULL,
  `fotoprogress5` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
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
('2025_12_16_085648_create_laporanprogress_table', 6),
('2025_12_19_094321_add_namalengkap_to_users_table', 7),
('2024_12_21_001700_add_missing_columns_to_tables', 8);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notifikasi` int(10) UNSIGNED NOT NULL,
  `dari` int(11) NOT NULL,
  `kepada` int(11) NOT NULL,
  `isinotifikasi` text NOT NULL,
  `jenisnotifikasi` varchar(50) NOT NULL,
  `statusnotifikasi` varchar(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notifikasi`
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
(24, 5, 13, 'telah menolak permintaan pesanan anda', 'riwayatpemesanan/5?kategori=\' . 1 . \'&katakunci=', '1', '2018-08-12 17:38:49', '2018-08-12 18:40:34'),
(25, 13, 1, 'telah melakukan pemesanan terhadap jasa anda', 'permintaanpesanan', '0', '2018-08-12 18:38:33', '2018-08-12 18:38:33'),
(26, 13, 1, 'telah melakukan pemesanan terhadap jasa anda', 'permintaanpesanan', '0', '2018-08-12 18:39:30', '2018-08-12 18:39:30'),
(27, 13, 1, 'telah melakukan pemesanan terhadap jasa anda', 'permintaanpesanan', '0', '2018-08-12 18:39:47', '2018-08-12 18:39:47'),
(28, 5, 13, 'telah menolak permintaan pesanan anda', 'riwayatpemesanan/6?kategori=\' . 1 . \'&katakunci=', '1', '2018-08-12 18:40:04', '2018-08-12 18:40:37'),
(29, 5, 13, 'telah menolak permintaan pesanan anda', 'riwayatpemesanan/7?kategori=\' . 1 . \'&katakunci=', '0', '2018-08-12 18:40:15', '2018-08-12 18:40:15'),
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
(48, 5, 13, 'telah menolak permintaan pesanan anda', 'riwayatpemesanan/11?kategori=\' . 1 . \'&katakunci=', '0', '2022-11-03 07:03:24', '2022-11-03 07:03:24'),
(49, 5, 42, 'telah menerima permintaan pesanan anda dengan nomor pemesanan NParq2fYEx', 'riwayatpemesanan/12?kategori=1&katakunci=', '0', '2022-11-03 07:04:13', '2022-11-03 07:04:13'),
(50, 42, 7, 'telah melakukan pemesanan terhadap jasa anda', 'permintaanpesanan', '0', '2022-11-03 07:06:52', '2022-11-03 07:06:52'),
(51, 42, 6, 'telah melakukan pemesanan terhadap jasa anda', 'permintaanpesanan', '0', '2022-11-03 07:07:38', '2022-11-03 07:07:38'),
(52, 1, 42, 'berhasil melakukan pengupdatean saldo dengan nominal Rp. 10,000,000.00 pada tanggal 2022-11-03 14:41:30', 'riwayattransaksi', '0', '2022-11-03 07:41:30', '2022-11-03 07:41:30'),
(53, 1, 47, 'berhasil melakukan pengupdatean saldo dengan nominal Rp. 1,000,000.00 pada tanggal 2025-12-15 23:44:06', 'riwayattransaksi', '0', '2025-12-15 16:44:06', '2025-12-15 16:44:06'),
(54, 47, 20, 'telah melakukan pemesanan terhadap jasa anda', 'permintaanpesanan', '0', '2025-12-15 16:47:19', '2025-12-15 16:47:19'),
(55, 43, 47, 'telah menerima permintaan pesanan anda dengan nomor pemesanan NPCcDDT9pB', 'riwayatpemesanan/15?kategori=1&katakunci=', '0', '2025-12-15 16:58:32', '2025-12-15 16:58:32'),
(56, 1, 47, 'berhasil melakukan pengupdatean saldo dengan nominal Rp. 100,000,000.00 pada tanggal 2025-12-16 09:29:29', 'riwayattransaksi', '0', '2025-12-16 02:29:29', '2025-12-16 02:29:29'),
(57, 48, 12, 'telah melakukan pemesanan terhadap jasa anda', 'permintaanpesanan', '0', '2025-12-19 23:08:32', '2025-12-19 23:08:32'),
(58, 48, 2, 'telah melakukan pemesanan terhadap jasa anda', 'permintaanpesanan', '0', '2025-12-19 23:10:03', '2025-12-19 23:10:03'),
(59, 48, 2, 'telah melakukan pemesanan terhadap jasa anda', 'permintaanpesanan', '0', '2025-12-20 00:42:14', '2025-12-20 00:42:14'),
(60, 1, 48, 'telah melakukan penolakan pengisian saldo dengan nominal Rp. 200,000.00 pada tanggal 2025-12-20 07:47:42', 'riwayattransaksi', '0', '2025-12-20 00:47:42', '2025-12-20 00:47:42'),
(61, 1, 48, 'berhasil melakukan pengupdatean saldo dengan nominal Rp. 50,000.00 pada tanggal 2025-12-20 07:47:48', 'riwayattransaksi', '0', '2025-12-20 00:47:48', '2025-12-20 00:47:48'),
(62, 1, 2, 'berhasil melakukan pengupdatean saldo dengan nominal Rp. 192,283.00 pada tanggal 2025-12-20 08:05:41', 'riwayattransaksi', '0', '2025-12-20 01:05:41', '2025-12-20 01:05:41'),
(63, 1, 3, 'berhasil melakukan pengupdatean saldo dengan nominal Rp. 130,393.00 pada tanggal 2025-12-20 08:07:38', 'riwayattransaksi', '0', '2025-12-20 01:07:38', '2025-12-20 01:07:38'),
(64, 1, 4, 'telah melakukan penolakan pengisian saldo dengan nominal Rp. 151,487.00 pada tanggal 2025-12-20 08:09:06', 'riwayattransaksi', '0', '2025-12-20 01:09:06', '2025-12-20 01:09:06'),
(65, 1, 5, 'telah mengkonfirmasi penarikan saldo dengan nominal Rp. 23,750.00 pada tanggal 2025-12-20 08:13:24', 'riwayattransaksi', '0', '2025-12-20 01:13:24', '2025-12-20 01:13:24'),
(66, 1, 54, 'berhasil melakukan pengupdatean saldo dengan nominal Rp. 11,000,000.00 pada tanggal 2025-12-20 16:20:40', 'riwayattransaksi', '1', '2025-12-20 09:20:40', '2025-12-20 09:23:52'),
(67, 54, 32, 'telah melakukan pemesanan terhadap jasa anda', 'permintaanpesanan', '0', '2025-12-20 09:23:35', '2025-12-20 09:23:35'),
(68, 55, 54, 'telah menerima permintaan pesanan anda dengan nomor pemesanan NPwWQIsFOa', 'riwayatpemesanan/19?kategori=1&katakunci=', '0', '2025-12-20 09:40:09', '2025-12-20 09:40:09'),
(69, 54, 55, 'telah mengkonfirmasi bahwa pekerjaan anda dengan nomor pemesananNPwWQIsFOa telah selesai, silahkan cek saldo anda akan secara otomatis bertambah', 'riwayatpemesanan/19', '0', '2025-12-20 20:00:09', '2025-12-20 20:00:09');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(10) UNSIGNED NOT NULL,
  `id` int(11) NOT NULL,
  `namapelanggan` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pelanggan`
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
(29, 47, 'Sinta', '2025-12-15 11:47:52', '2025-12-15 11:47:52'),
(30, 48, 'Test Pelanggan', '2025-12-18 07:22:27', '2025-12-18 07:22:27'),
(31, 48, 'etha', '2025-12-18 07:41:44', '2025-12-18 07:41:44'),
(32, 48, 'Pelanggan Test', '2025-12-19 01:44:30', '2025-12-19 01:44:30'),
(33, 48, 'Pelanggan Test', '2025-12-19 01:47:05', '2025-12-19 01:47:05'),
(34, 48, 'Pelanggan Test', '2025-12-19 01:53:58', '2025-12-19 01:53:58'),
(35, 48, 'John Doe Test', '2025-12-19 02:12:44', '2025-12-19 02:12:44'),
(36, 48, 'John Doe Test', '2025-12-19 02:14:53', '2025-12-19 02:14:53'),
(37, 48, 'Test User Lengkap', '2025-12-19 02:32:15', '2025-12-19 02:32:15'),
(38, 48, 'Test User Lengkap', '2025-12-19 02:35:48', '2025-12-19 02:35:48'),
(39, 48, 'Test User Lengkap', '2025-12-19 02:39:27', '2025-12-19 02:39:27'),
(40, 48, 'Test User Lengkap', '2025-12-19 02:52:49', '2025-12-19 02:52:49'),
(41, 48, 'Test User Lengkap', '2025-12-19 02:53:16', '2025-12-19 02:53:16'),
(42, 48, 'Test User Lengkap', '2025-12-19 21:42:18', '2025-12-19 21:42:18'),
(43, 51, 'Test User', '2025-12-20 07:21:08', '2025-12-20 07:21:08'),
(44, 52, 'Test Tukang', '2025-12-20 07:26:41', '2025-12-20 07:26:41'),
(45, 53, 'Jeksen', '2025-12-20 07:27:35', '2025-12-20 07:27:35'),
(46, 54, 'Jeksens', '2025-12-20 07:29:05', '2025-12-20 07:29:05'),
(47, 54, 'Jeksens', '2025-12-20 07:42:50', '2025-12-20 07:42:50'),
(48, 54, 'Jeksens', '2025-12-20 07:42:51', '2025-12-20 07:42:51'),
(49, 54, 'Jeksens', '2025-12-20 07:52:02', '2025-12-20 07:52:02'),
(50, 54, 'Jeksens', '2025-12-20 09:35:33', '2025-12-20 09:35:33');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(10) UNSIGNED NOT NULL,
  `id_tukang` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_jenispemesanan` int(11) NOT NULL,
  `id_kategoritukang` int(11) NOT NULL,
  `nomorpemesanan` varchar(10) NOT NULL,
  `biayajasa` varchar(30) NOT NULL,
  `tanggalbekerja` date NOT NULL,
  `tanggalselesai` date NOT NULL,
  `catatan` text DEFAULT NULL,
  `kategoripemesanan` varchar(1) NOT NULL,
  `fotopemesanan1` varchar(50) DEFAULT NULL,
  `fotopemesanan2` varchar(50) DEFAULT NULL,
  `alamatpemesanan` text DEFAULT NULL,
  `latitudepemesanan` text DEFAULT NULL,
  `longtitudepemesanan` text DEFAULT NULL,
  `alasanpenolakanpemesanan` text DEFAULT NULL,
  `statuspemesanan` varchar(1) NOT NULL,
  `statusubahharga` varchar(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pemesanan`
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
(15, 20, 29, 1, 1, 'NPCcDDT9pB', '100000', '2025-12-16', '0000-00-00', 'Test', '0', NULL, NULL, 'Test', '3.6184241', '98.680938', NULL, '3', '0', '2025-12-15 16:47:19', '2025-12-16 02:37:52'),
(16, 12, 30, 1, 1, 'NP0jX8SicY', '120000', '2025-12-25', '2025-12-25', 'Test order', '0', NULL, NULL, 'Test Address 123', '3.5866718', '98.69232029999999', NULL, '0', '0', '2025-12-19 23:08:32', '2025-12-19 23:08:32'),
(17, 2, 30, 3, 2, 'NPIW6T9nXU', '500000', '2025-12-26', '2025-12-26', 'f', '0', NULL, NULL, 'Test Address 123', '3.5866718', '98.69232029999999', NULL, '0', '0', '2025-12-19 23:10:03', '2025-12-19 23:10:03'),
(18, 2, 30, 3, 2, 'NP22y9S0vg', '200000', '2025-12-31', '2025-12-28', 'd', '1', NULL, NULL, 'Test Address 123', '3.5866718', '98.69232029999999', NULL, '0', '0', '2025-12-20 00:42:14', '2025-12-20 00:42:14'),
(19, 32, 46, 2, 1, 'NPwWQIsFOa', '200000', '2025-12-24', '2025-12-24', 'tes', '0', 'fotopesan120251220162335.jpg', NULL, 'Lokasi', '3.590376179283813', '98.6757132379682', NULL, '5', '0', '2025-12-20 09:23:35', '2025-12-20 20:52:47');

-- --------------------------------------------------------

--
-- Table structure for table `pemesananbahanmaterial`
--

CREATE TABLE `pemesananbahanmaterial` (
  `id_pemesananbahanmaterial` int(10) UNSIGNED NOT NULL,
  `id_bahanmaterial` int(11) NOT NULL,
  `id_pemesanan` int(11) NOT NULL,
  `hargapemesananbahanmaterial` varchar(50) NOT NULL,
  `qtypembelian` int(11) NOT NULL,
  `statuspembelian` varchar(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pemesananbahanmaterial`
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
(18, 1, 15, '1500000', 1, '1', '2025-12-16 02:37:46', '2025-12-16 02:37:52'),
(19, 1, 19, '1500000', 1, '1', '2025-12-20 10:28:15', '2025-12-20 19:58:11'),
(20, 5, 19, '500000', 1, '1', '2025-12-20 19:39:05', '2025-12-20 19:58:11');

-- --------------------------------------------------------

--
-- Table structure for table `riwayattransaksi`
--

CREATE TABLE `riwayattransaksi` (
  `id_riwayattransaksi` int(10) UNSIGNED NOT NULL,
  `id` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `jumlahsaldo` varchar(30) NOT NULL,
  `rekening` varchar(20) DEFAULT NULL,
  `namarekening` varchar(50) DEFAULT NULL,
  `rekeningtujuan` varchar(70) DEFAULT NULL,
  `jenistransaksi` text NOT NULL,
  `buktitransaksi` varchar(50) DEFAULT NULL,
  `statustransaksi` varchar(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `riwayattransaksi`
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
(18, 5, 'KTtx1cecjE', '23750', '8305106255', 'Kennedi', NULL, 'Penarikan Saldo', NULL, '1', '2018-08-24 15:21:51', '2025-12-20 01:13:24'),
(19, 42, 'KTVXf', '1000000', '830400311', 'Marco', 'BCA - 8305123456', 'Pengisian Saldo', 'buktitransferKTVXf.jpg', '1', '2022-11-03 06:56:49', '2022-11-03 06:57:44'),
(20, 42, 'KTsod', '10000000', '830400311', 'Marco', 'BCA - 8305123456', 'Pengisian Saldo', 'buktitransferKTsod.jpg', '1', '2022-11-03 07:40:32', '2022-11-03 07:41:29'),
(21, 47, 'KTUc8', '1000000', '1', 'Sinta', 'BCA - 8305123456', 'Pengisian Saldo', 'buktitransferKTUc8.jpg', '1', '2025-12-15 16:43:40', '2025-12-15 16:44:06'),
(22, 47, 'KTrFc', '100000000', '1', 'Sinta', 'BCA - 8305123456', 'Pengisian Saldo', 'buktitransferKTrFc.jpg', '1', '2025-12-16 02:02:18', '2025-12-16 02:29:29'),
(23, 48, 'KTZyh', '200000', '12345', 'etha', 'BRI - 445566778888000', 'Pengisian Saldo', 'buktitransferKTZyh.jpg', '2', '2025-12-18 07:35:13', '2025-12-20 00:47:42'),
(24, 48, 'KTFpy', '50000', '34', 'tes', 'BCA - 8305123456', 'Pengisian Saldo', 'buktitransferKTFpy.jpg', '1', '2025-12-19 21:12:22', '2025-12-20 00:47:48'),
(25, 2, 'KT467E0', '192283', '1234567890', 'Test User', 'BCA - 0987654321', 'Pengisian Saldo', 'default.jpg', '1', '2025-12-20 01:02:07', '2025-12-20 01:05:41'),
(26, 3, 'KT7C1F8', '130393', '1234567890', 'Test User', 'BCA - 0987654321', 'Pengisian Saldo', 'default.jpg', '1', '2025-12-20 01:02:07', '2025-12-20 01:07:38'),
(27, 4, 'KTAE506', '151487', '1234567890', 'Test User', 'BCA - 0987654321', 'Pengisian Saldo', 'default.jpg', '2', '2025-12-20 01:02:07', '2025-12-20 01:09:06'),
(28, 49, 'KTTPHfo1kD', '47500', NULL, NULL, NULL, 'Penarikan Saldo', NULL, '0', '2025-12-20 01:49:44', '2025-12-20 01:49:44'),
(29, 54, 'KTypB', '11000000', '34', 'jeksep', 'BCA - 8305123456', 'Pengisian Saldo', 'buktitransferKTypB.jpg', '1', '2025-12-20 09:20:08', '2025-12-20 09:20:40'),
(30, 55, 'KTABC6hmEF', '200000', NULL, NULL, NULL, 'Pembayaran Biaya Jasa', NULL, '1', '2025-12-20 20:00:09', '2025-12-20 20:00:09');

-- --------------------------------------------------------

--
-- Table structure for table `tukang`
--

CREATE TABLE `tukang` (
  `id_tukang` int(10) UNSIGNED NOT NULL,
  `id` int(11) NOT NULL,
  `id_kategoritukang` int(11) NOT NULL,
  `namatukang` varchar(255) NOT NULL,
  `pengalamanbekerja` text DEFAULT NULL,
  `lamapengalamanbekerja` varchar(2) NOT NULL,
  `deskripsikeahlian` text DEFAULT NULL,
  `rating` double DEFAULT 0,
  `totalvote` int(11) DEFAULT 0,
  `jumlahvote` int(11) DEFAULT 0,
  `fotoktp` varchar(50) NOT NULL,
  `fotosim` varchar(50) NOT NULL,
  `fotohasilkerja` varchar(50) NOT NULL,
  `statusjasakeahlian` varchar(1) DEFAULT '0',
  `statuseditprofil` varchar(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tukang`
--

INSERT INTO `tukang` (`id_tukang`, `id`, `id_kategoritukang`, `namatukang`, `pengalamanbekerja`, `lamapengalamanbekerja`, `deskripsikeahlian`, `rating`, `totalvote`, `jumlahvote`, `fotoktp`, `fotosim`, `fotohasilkerja`, `statusjasakeahlian`, `statuseditprofil`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 'Kennedi', 'Saya Pernah Menservice Banyak AC', '1', 'Ahli renovasi interior rumah', 4.6666666666667, 14, 3, 'fotoktp5.jpg', 'fotosim5.jpg', '', '1', '1', '2018-07-04 06:46:53', '2018-08-12 20:35:25'),
(2, 8, 2, 'Robin', 'PT. Niaga Raya Teknisi CCTV', '1', 'Ahli renovasi eksterior rumah', 0, 0, 0, 'fotoktp8.jpg', 'fotosim8.jpg', '', '1', '1', '2018-07-23 07:04:10', '2018-08-06 03:09:53'),
(3, 14, 1, 'Test', NULL, '1', 'Ahli renovasi interior rumah', 0, 0, 0, 'fotoktp14.jpg', 'fotosim14.jpg', '', '0', '0', '2018-08-12 16:41:03', '2018-08-12 16:41:03'),
(4, 15, 1, 'Coba', NULL, '1', 'Ahli renovasi interior rumah', 0, 0, 0, 'fotoktp15.jpg', 'fotosim15.jpg', '', '0', '0', '2018-08-12 16:45:20', '2018-08-12 16:45:20'),
(5, 18, 1, 'Adi', 'Toko Indah Jaya', '4', 'Ahli renovasi interior rumah', 0, 0, 0, 'fotoktp18.jpg', 'fotosim18.jpg', '', '1', '1', '2018-08-12 17:14:22', '2018-08-12 18:11:22'),
(6, 19, 1, 'Budi', 'PT. Makmur Jaya', '6', 'Ahli renovasi interior rumah', 0, 0, 0, 'fotoktp19.jpg', 'fotosim19.jpg', '', '1', '1', '2018-08-12 17:46:30', '2018-08-12 18:21:00'),
(7, 20, 1, 'Cody', '', '8', 'Ahli renovasi interior rumah', 0, 0, 0, 'fotoktp20.jpg', 'fotosim20.jpg', '', '1', '1', '2018-08-12 18:08:44', '2018-08-12 18:23:40'),
(8, 21, 2, 'Edo', NULL, '6', 'Ahli renovasi eksterior rumah', 0, 0, 0, 'fotoktp21.jpg', 'fotosim21.jpg', '', '0', '1', '2018-08-12 18:26:56', '2018-08-12 22:22:16'),
(9, 22, 2, 'Fajar', NULL, '4', 'Ahli renovasi eksterior rumah', 0, 0, 0, 'fotoktp22.jpg', 'fotosim22.jpg', '', '0', '0', '2018-08-12 18:27:43', '2018-08-12 18:27:43'),
(10, 30, 1, 'Chandra ', 'Toko Jaya Elektronik', '4', 'Ahli renovasi interior rumah', 0, 0, 0, 'fotoktp30.jpg', 'fotosim30.jpg', '', '1', '1', '2018-08-12 21:58:52', '2018-08-12 22:30:36'),
(11, 31, 1, 'Muhammad Azwir', 'Toko Marelan Elektronik', '6', 'Ahli renovasi interior rumah', 0, 0, 0, 'fotoktp31.jpg', 'fotosim31.jpg', '', '1', '1', '2018-08-12 22:03:59', '2018-08-12 22:34:19'),
(12, 32, 1, 'Zico', '', '3', 'Ahli renovasi interior rumah', 0, 0, 0, 'fotoktp32.jpg', 'fotosim32.jpg', '', '1', '1', '2018-08-12 22:08:27', '2018-08-12 22:36:59'),
(13, 33, 2, 'Heri Suyono', 'Toko CCTV Jaya', '5', 'Ahli renovasi eksterior rumah', 0, 0, 0, 'fotoktp33.jpg', 'fotosim33.jpg', '', '1', '1', '2018-08-12 22:18:33', '2018-08-12 22:46:01'),
(14, 34, 2, 'Jackyson', 'Toko Bilal Elektronik', '3', 'Ahli renovasi eksterior rumah', 0, 0, 0, 'fotoktp34.jpg', 'fotosim34.jpg', '', '1', '1', '2018-08-12 22:19:38', '2018-08-12 22:50:10'),
(15, 35, 2, 'Vina Loren', '', '5', 'Ahli renovasi eksterior rumah', 0, 0, 0, 'fotoktp35.jpg', 'fotosim35.jpg', '', '1', '1', '2018-08-12 22:20:38', '2018-08-12 22:53:30'),
(16, 36, 3, 'Muhammad Bachtiar', 'Toko Sukses Mandiri', '4', 'Pasang dan Perbaiki TV, Radio', 0, 0, 0, 'fotoktp36.jpg', 'fotosim36.jpg', '', '1', '1', '2018-08-12 22:58:48', '2018-08-12 23:03:24'),
(17, 37, 3, 'Riduan Salim', '', '5', 'Pasang dan Perbaiki Kulkas, Tv', 0, 0, 0, 'fotoktp37.jpg', 'fotosim37.jpg', '', '1', '1', '2018-08-12 23:00:27', '2018-08-12 23:06:01'),
(18, 38, 4, 'Hermanto', NULL, '5', 'Pasang Instalasi Listrik', 0, 0, 0, 'fotoktp38.jpg', 'fotosim38.jpg', '', '0', '0', '2018-08-12 23:08:41', '2018-08-12 23:08:41'),
(19, 39, 4, 'Hong Koh Tian', NULL, '8', 'Pasang dan Perbaiki Instalasi Listrik', 0, 0, 0, 'fotoktp39.jpg', 'fotosim39.jpg', '', '0', '0', '2018-08-12 23:10:09', '2018-08-12 23:10:09'),
(20, 43, 1, 'Kevin', 'Tukang AC di Sun Plaza~Tukang AC di Medan Fair', '15', 'Ahli renovasi interior rumah', 0, 0, 0, 'fotoktp_1765773406.jpg', 'fotosim_1765773406.jpg', 'hasil_pekerjaan_1765773406.zip', '1', '1', '2025-12-15 04:36:46', '2025-12-15 16:27:57'),
(21, 49, 1, 'Test Tukang Profesional', 'test', '1', NULL, 0, 0, 0, 'nopicture.jpg', 'nopicture.jpg', 'nopicture.jpg', '1', '0', '2025-12-18 07:22:28', '2025-12-20 01:51:54'),
(22, 49, 1, 'Test User Lengkap', '', '0', 'Ahli renovasi interior rumah', 0, 0, 0, '', '', '', '0', '1', '2025-12-19 02:55:49', '2025-12-19 02:55:49'),
(23, 49, 1, 'Test User Lengkap', '', '0', '', 0, 0, 0, '', '', '', '0', '1', '2025-12-20 01:15:15', '2025-12-20 01:15:15'),
(24, 49, 1, 'Test Tukang', '', '0', '', 0, 0, 0, '', '', '', '0', '1', '2025-12-20 01:20:53', '2025-12-20 01:20:53'),
(25, 49, 1, 'Tukang Test', '', '0', '', 0, 0, 0, '', '', '', '0', '1', '2025-12-20 01:27:23', '2025-12-20 01:27:23'),
(26, 49, 1, 'Tukang Test', '', '0', '', 0, 0, 0, '', '', '', '0', '1', '2025-12-20 01:33:21', '2025-12-20 01:33:21'),
(27, 49, 1, 'Tukang Test', '', '0', '', 0, 0, 0, '', '', '', '0', '1', '2025-12-20 01:33:34', '2025-12-20 01:33:34'),
(28, 49, 1, 'Test Tukang Profesional', '', '0', '', 0, 0, 0, '', '', '', '0', '1', '2025-12-20 02:08:42', '2025-12-20 02:08:42'),
(32, 55, 1, 'Jeksen', 'tesss', '18', 'coba coba awalanya', 4, 4, 1, '', '', '', '1', '1', '2025-12-20 07:43:28', '2025-12-20 20:52:47'),
(33, 55, 1, 'Jeksen', '', '0', '', 0, 0, 0, '', '', '', '0', '1', '2025-12-20 09:17:26', '2025-12-20 09:17:26');

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id_ulasan` int(10) UNSIGNED NOT NULL,
  `id_tukang` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `isiulasan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`id_ulasan`, `id_tukang`, `id_pelanggan`, `rating`, `isiulasan`, `created_at`, `updated_at`) VALUES
(3, 1, 8, 5, 'Nice x', '2018-08-09 09:12:02', '2018-08-09 09:12:02'),
(4, 1, 13, 4, 'good', '2018-08-12 17:37:32', '2018-08-12 17:37:32'),
(5, 1, 13, 5, 'Luar biasa', '2018-08-12 18:42:18', '2018-08-12 18:42:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(60) NOT NULL,
  `kodeuser` varchar(6) NOT NULL,
  `alamat` text DEFAULT NULL,
  `nomorhandphone` varchar(15) DEFAULT NULL,
  `saldo` varchar(30) NOT NULL,
  `nomorrekening` varchar(20) DEFAULT NULL,
  `namarekening` varchar(50) DEFAULT NULL,
  `fotoprofil` varchar(50) NOT NULL,
  `latitude` varchar(30) DEFAULT NULL,
  `longtitude` varchar(30) DEFAULT NULL,
  `statuspengguna` varchar(1) NOT NULL,
  `statusverifikasi` varchar(1) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `namaLengkap` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `kodeuser`, `alamat`, `nomorhandphone`, `saldo`, `nomorrekening`, `namarekening`, `fotoprofil`, `latitude`, `longtitude`, `statuspengguna`, `statusverifikasi`, `remember_token`, `created_at`, `updated_at`, `namaLengkap`) VALUES
(1, 'admin@gmail.com', '$2y$12$JNfIHu/CztIrhb921AxsJO/G4qyfJH5hcuL2rKNS4BxvIuo/JWgWu', 'ADM1', '', '', '', '', '', 'nopicture.jpg', '', '', '0', '1', 'vzYeNsjiwbCEk3qn9gmu66pxPlqXcJWDM94f4BfKI1fI9zI13BgvhDFZxqoU', '2018-07-03 22:05:16', '2025-12-18 06:56:32', NULL),
(2, 'edy@gmail.com', '$2y$10$sUsOzeYmxuL1ObsvA61UM.feT.YIHIWMXC3vGn33yxfVHZGlHwenO', 'NIP1', 'Jln. Krakatau No 53', '0821932132131', '10192283', '8306106244', 'Bank Central Asia', 'fotoprofil2.jpg', '3.61644241551856', '98.67959334337775', '1', '1', 'T8rK2pqSVQki3ft0uSmokDfWe1iFcpAAwSzg9MctrK440eiLa450ctRfo6ZO', '2018-07-03 22:25:38', '2025-12-20 01:05:41', NULL),
(3, 'lionardi@gmail.com', '$2y$10$dB2uGZixTlGQEdEexGAU3emQAIYOnn6puu220B09j5B8mpt.8B.li', 'NIP2', '', '', '130393', '', '', 'nopicture.jpg', '', '', '1', '1', 'UzJNHrcqtdrlMQrgTPYzRbvFkaSSuQOnkHK3KAX2jHecD7ANPSAwj9mWR9dk', '2018-07-03 22:29:32', '2025-12-20 01:07:38', NULL),
(4, 'andri@gmail.com', '$2y$10$SUJW3eZtpCopPkDGK9FH9uG3ExhXjQrl7HFFbpypcDOcx7aANqf.e', 'NIP3', '', '', '0', '', '', 'nopicture.jpg', '', '', '1', '1', 'i9BlXsAOY8twTJhqYSiLgSZOpEfK62aZJ6SXaFH5g8WIQkbNWCjoj06lwqNA', '2018-07-03 22:31:38', '2018-08-06 02:46:54', NULL),
(5, 'kennedi@gmail.com', '$2y$10$z0JsXQrzKuhNEB1b3pf.oeszGztLyrhuKl6ZtdnswKwZG781cLgWC', 'TAC1', 'Jln. Karya Wisata No. 53', '082161621035', '10000', '8305106255', '', 'fotoprofil5.jpg', '3.557957340653788', '98.70297431945801', '2', '1', 'enHYxTpvJkX0IUXDHqKIp7FMxKG2QMZ4D0mZ1o9ocFdHzQCbH5oqQWrKDjF6', '2018-07-04 06:46:53', '2025-12-18 07:03:15', NULL),
(6, 'sutod@gmail.com', '$2y$10$Rsvbnb7rm.tPmohoSa8I.emKiwUqtGuJpXjB7xeGnM3C4vbxLtTg6', 'NIP4', 'Jln, Madong Lubis No. 53', '089832141241', '0', '123456789', '', 'nopicture.jpg', '3.590418368644319', '98.69488199577029', '1', '1', 'rnYgJXeSZI35XRkzmRMey5xbB6ARV2rik3krYeRn9oFla2Ce1zYEoDqBg3xJ', '2018-07-16 17:39:33', '2018-07-16 17:50:22', NULL),
(7, 'andi@gmail.com', '$2y$10$aHTmFTAjlxMxhHwfDufl5evaP3Rl/QPvRL8ahGXi94O4iBZTZfHYK', 'NIP5', 'Jl. Prof. HM. Yamin Sh No.47', '081361382054', '0', '909321411', '', 'nopicture.jpg', '3.5980585112422174', '98.68838310241699', '1', '1', '4e5A9LXfvqzpn3RICGLc7QoFZXfvCSBxsYlkBoZNDm3PAWeAaentcOsFaiTG', '2018-07-19 02:22:12', '2018-07-19 02:44:03', NULL),
(8, 'robintukang@gmail.com', '$2y$10$rquO0oWJDCn5H6A1SLARuuJ6vaYuVnozfmmqnGVok.QQ5hedynJSq', 'TAC2', 'Jl. Prof. HM. Yamin Sh No.47', '0893421411', '0', '309421411', 'Bank Central Asia', 'fotoprofil8.jpg', '3.5980585112422174', '98.68838310241699', '2', '1', 'Gq1j0KlvocQvdkVf9pRws5nLunG8BVu3xp0BBXIpbxiKHwngPmpzuyvGbPE7', '2018-07-23 07:04:10', '2018-08-06 03:07:51', NULL),
(9, 'sumandi@gmail.com', '$2y$10$sqHidG5hIOCorpqRdOVf3.WsI0w6C47yACK3PCXOorWOC10/J6nSC', 'NIP6', '', '', '0', '', '', 'nopicture.jpg', '', '', '1', '1', NULL, '2018-07-23 07:08:03', '2018-07-23 07:08:03', NULL),
(10, 'kevin@gmail.com', '$2y$10$5gO6Z2SS9QH0BceUZUbJ5ugyVAL.oevVDfOgfHyHoT0u90oENDOeu', 'NIP7', 'Jalan Putri Hijau No.17', '08197321411', '0', '1234567890', '', 'fotoprofil10.jpg', '3.5997289090347766', '98.6726975440979', '1', '1', 'KtF1ZgJu9Yjfb3zTzmaqX0l3aibK6jnYaMKd4KulyKGrovNezPhpvcePCuKI', '2018-07-23 09:31:27', '2018-07-23 09:48:10', NULL),
(11, 'kenju@gmail.com', '$2y$10$pcDQQ68mxr9yzWAErQfkGedpqfqK1sQhUQB22mWx3ppylw9h7vykG', 'NIP8', 'Jln. Majapahit No. 53', '0812345678901', '8355331.9477059', '8305106255', 'Kenju', 'fotoprofil11.jpg', '3.6054809572669693', '98.63065057023778', '1', '1', 'wmzFlg4xHFmtdKfqeKyQZ59U9VhDnVWQ0miZgrTcoDYJXjxffKUTJjN05DEl', '2018-08-09 08:00:13', '2018-08-09 09:07:14', NULL),
(12, 'andilovedesign123@gmail.com', '$2y$10$5l86satF8ofhGunkd6cOiO0qOeBuPEyGZiXcB5aGYXhvlsJMRNNf2', 'NIP9', '1', '1', '0', '1', '1', 'nopicture.jpg', '3.5955573515899077', '98.67926401852418', '1', '1', 'rTJigpG5fqk3dPHuFWRZCuWJPjDAnQkI6eQEMl1KrVsoWQBqi4bw5ZuCoj2t', '2018-08-12 16:34:01', '2024-02-09 05:53:32', NULL),
(13, 'michaelsalim39@gmail.com', '$2y$10$ZDOjL2f8vWfpf7JkTvAcQO1eSlo5pAWrNES9Wx4UJa0e8dQZsAYke', 'NIP10', 'Jl. Pelita I No. 65', '08123123123', '9169693.6872431', '8123123124124', 'Bank Central Asia', 'fotoprofil13.jpg', '3.604125080083662', '98.68714856462475', '1', '1', 'Mut9LyjofeYYU7lJE1kqlC7GgrvaKzIq5tBHeGnRuaL4ImrgxtkYnKyMe1jK', '2018-08-12 16:34:31', '2022-11-03 07:03:24', NULL),
(14, 'test@gmail.com', '$2y$10$ghFqO/7C2Q4iU0MQd5x37ueHrKPQq/2VrusRlcY3DT3l0.LZZhIn2', 'TAC3', NULL, NULL, '0', NULL, NULL, 'fotoprofil14.jpg', NULL, NULL, '2', '1', NULL, '2018-08-12 16:41:03', '2018-08-12 17:07:25', NULL),
(15, 'coba@gmail.com', '$2y$10$J7E6Nb7/UJd/1KDJZ4.vbOeRU6D35Lem8J.c3.Zz8NnhPhjYIind2', 'TAC4', NULL, NULL, '0', NULL, NULL, 'fotoprofil15.jpg', NULL, NULL, '2', '1', NULL, '2018-08-12 16:45:20', '2018-08-12 17:07:29', NULL),
(16, 'frentzenlouei@yahoo.com', '$2y$10$r8PJ2XpKFeoug1ybFiBuT.8rAeU2QmtRjumHdZM/EJjLroszq3Waa', 'NIP11', 'Jl, Karya No. 125', '0812312441231', '0', '8123123124', 'Bank Central Asia', 'fotoprofil16.jpg', '3.6110213558728828', '98.66560052287241', '1', '1', 'abE1fH5jLF4mJyrBdeH65UkNr6yT2x4ktmi4LTjq2lCbY3rcTxsHMOoUhf71', '2018-08-12 16:56:23', '2018-08-12 16:58:56', NULL),
(17, 'krendyw4@gmail.com', '$2y$10$bOadfQO.lr4kacrx4ojXAu4HULCEvxvw9VcjHAnwCMWyO9.Wtc2.y', 'NIP12', 'Jl. Bambu V No. 25', '0811111111111', '0', '84123417234581', 'Bank Mandiri', 'fotoprofil17.jpg', '3.6087784692050517', '98.67819870302412', '1', '1', 'pLbqjjqZiCNRwYrBrcaR1rregfy3846oWJ9x2Qc7EKOVPzJ1mLqfmtatx4ye', '2018-08-12 16:59:35', '2018-08-12 17:42:42', NULL),
(18, 'adi@gmail.com', '$2y$10$z0JsXQrzKuhNEB1b3pf.oeszGztLyrhuKl6ZtdnswKwZG781cLgWC', 'TAC5', 'Jl. Bambu II No.56', '0814324234244', '0', '812312424124', 'Bank Mandiri', 'fotoprofil18.jpg', '3.6068554762307232', '98.67617411373908', '2', '1', 'NwFwJXe8lmX9bBQgBA9Ij1j8p90yUcB8FWzmOtVL4CbMB1mbzhM1epfEpH1l', '2018-08-12 17:14:22', '2022-11-03 04:48:41', NULL),
(19, 'budi@gmail.com', '$2y$10$y/T75W8ZcY7s19EFAhIynOt3toA5l.dEfNw6vebPZKAlAR1fZbc8S', 'TAC6', 'Jl. Bambu No. 23', '081231241241', '0', '81231231244', 'Bank Mandiri', 'fotoprofil19.jpg', '3.6043978678398654', '98.68093771694953', '2', '1', 'V8OLmXTCSnxNylklLj1tjVaDKNFzrGDZ5aL2x5foh7phuFxxx2covjiJtkK4', '2018-08-12 17:46:30', '2018-08-12 18:21:06', NULL),
(20, 'cody@gmail.com', '$2y$10$uKEoi3oDy32Rh6kw/UwWyeDc92U64bIz3axDR0wJd0LVW5MCg1FDy', 'TAC7', 'Jl. Bilal Ujung No. 6', '8123124133', '0', '8123124124', 'Bank Central Asia', 'fotoprofil20.jpg', '3.623164490982744', '98.68163459707728', '2', '1', 'xRjLVfh1p39CnF9CHShAR3YFtKPPnhvTZ3gL19PI9RAtFzmGNvP6ZvIKbXJ9', '2018-08-12 18:08:44', '2018-08-12 18:25:48', NULL),
(21, 'edo@gmail.com', '$2y$10$vu1FdpunWjVnN6POTD9lGuitS8TQWNNTBXz/FFo3/IGtkfUdykbv2', 'TAC8', 'Jl. Pelita IV No. 123', '0812312312412', '0', '91231231231', 'Bank Mandiri', 'fotoprofil21.jpg', '3.6077468726803237', '98.68692528296015', '2', '1', 'tiGsxVRgOe7u5mcQEp2AAyRTG7mwZCkRti9qFioevfpGdHrWlr2N6qnBTuVo', '2018-08-12 18:26:56', '2018-08-12 22:22:45', NULL),
(22, 'fajar@gmail.com', '$2y$10$dB0AZhbFvkk5EL524JnrfOfHFOhDTh59XNUNjpgxUu4AW8d9R4g7i', 'TAC9', NULL, NULL, '0', NULL, NULL, 'fotoprofil22.jpg', NULL, NULL, '2', '0', NULL, '2018-08-12 18:27:44', '2018-08-12 18:27:44', NULL),
(23, 'elfine-owen@hotmail.com', '$2y$10$6GY7YAOnrvrg03hZCl.ZFegCp5aAA2ZrYVbg9bE2hp.Y5zmUsTktS', 'NIP13', 'Jl. Umar No. 23', '081231231414', '0', '8131232131', 'Bank Nasional Indonesia', 'fotoprofil23.jpg', '3.6199210334928154', '98.67461123086741', '1', '1', 'L3nDkDfu2eFZAVRreD8WioKz0Ma3hoarymSeMdBPYXWAFnTKNbyohnFtFx53', '2018-08-12 21:21:54', '2018-08-12 21:24:48', NULL),
(24, 'yukijaden5@gmail.com', '$2y$10$dYuQ/sMudsfWVEzSKl9V3OKhQYVwq5xDwF4wlc1RyPG8DDYfzKj0i', 'NIP14', 'Jl. Pendidikan No 78', '08412341233', '0', '79412345889', 'Bank Central Asia', 'fotoprofil24.jpg', '3.6192662731114718', '98.70216170538811', '1', '1', '89Bu3Rv4qfMSIhpYzz576YogoMLuluIbyYJk3Jp6IzAoMm1WPDXzLUD0wk8L', '2018-08-12 21:25:42', '2018-08-12 21:27:42', NULL),
(25, 'badkids28@gmail.com', '$2y$10$.N1yIXAl8C5VrNO.FXJplu/OT6CFMbnqwU.rV.A7oHjCZC2eVW3/u', 'NIP15', 'Jl. Permai No.32', '084324241213', '0', '8112347821', 'Bank Nasional Indonesia', 'fotoprofil25.jpg', '3.6072199458126524', '98.69370747495589', '1', '1', 'UmEgYiPxij3R4QUaYJJvdrnSxXKgB8ezlsCEe1qY4sI2t1cy6M8d4KRy5kX4', '2018-08-12 21:28:51', '2018-08-12 21:30:54', NULL),
(26, 'affandidiharjo@gmail.com', '$2y$10$NZcSaj1lT68668kPnuJcDOafIOtWl2XmrVFdw3tesUIg80dCrC8mi', 'NIP16', 'Jl. Karantina No.56', '0814251232', '0', '81234141234', 'Bank Central Asia', 'fotoprofil26.jpg', '3.6100056909559113', '98.68220942620542', '1', '1', 'R5dnbnXa01EAHzHlRaEtVF7KgPr70T1C3MpxaZFzR93qPy5w8HVTweLWvmIS', '2018-08-12 21:34:48', '2018-08-12 21:37:39', NULL),
(27, 'juliani.kosasi04@gmail.com', '$2y$10$K1gmrTjSPGU4vmJV0F.gl.DCI6O.Che4KlIyEIsDi0M3sGRnBFKC6', 'NIP17', 'Jl. Batu Bara No. 214', '081452432511', '0', '8414123462123', 'Bank Mandiri', 'fotoprofil27.jpg', '3.5900636786465046', '98.68534030152966', '1', '1', 'gKEGQ9yRtLjJpiHsEaJddMC68GdOy1daEJAZUPsSfwbqcWUdf249Yq3hQ08e', '2018-08-12 21:38:16', '2018-08-12 21:39:56', NULL),
(28, 'giovanni_artedjo@yahoo.com', '$2y$10$kv1YwbbXoLXSkSJfWh2Nb./iztw2aoYXrhqQ3/BcmTfCjONAl4jDq', 'NIP18', 'Jl. Sei kera No. 23', '083314123123', '0', '81231214214', 'Bank Nasional Indonesia', 'fotoprofil28.jpg', '3.5941422969527648', '98.68510288828952', '1', '1', 'NwWgJC9o1rYBZfXCo0vO9XNgxy6pe54LkGJA6kYRhsFHZR66cOI784ejMwId', '2018-08-12 21:40:38', '2018-08-12 21:43:01', NULL),
(29, '141111758@students.mikroskil.ac.id', '$2y$10$YxU1oZ2iDJQ/FTYvPCiw8OS1Q8kWLYIJ48lSfijfeHwbNWqGlgyE6', 'NIP19', 'Jl. Tuasan No 291', '08142414123', '0', '81231231345', 'Bank Central Asia', 'fotoprofil29.jpg', '3.615957204465033', '98.6974067104909', '1', '1', 'xDhVyKZ8YoAb3Z6H122H8vJ1s7EtSrSOtWZbF410wWoUb6Yc6yycmISGT3F5', '2018-08-12 21:43:31', '2018-08-12 21:51:19', NULL),
(30, 'chanciasui@gmail.com', '$2y$10$6omD9XIiC6gmsirLJ4gPLOpkcTkzbRNnHKx7XEhMNE3ecSecIHit2', 'TAC10', 'Jl. Pukat II No.25', '08141231233', '0', '8123142341', 'Bank Central Asia', 'fotoprofil30.jpg', '3.5946625334908915', '98.70780471172907', '2', '1', 'X9mjTrviZJkluIkleofJarEc22DHMvU4xixqJ5KW73ddHdCkcEwVlt5jAwvR', '2018-08-12 21:58:52', '2018-08-12 22:31:35', NULL),
(31, 'mazwir@gmail.com', '$2y$10$lJdSfxaKIjg7FKOQ.vK.Le9EMD7RcDMe/.JX51aCWuLeyez4f8Hfq', 'TAC11', 'Jl. Marelan V No. 98', '08312312321', '0', '7123123123412', 'Bank Mandiri', 'fotoprofil31.jpg', '3.697049630227276', '98.65579431482365', '2', '1', '4GWfl3xqgOwvIiIMEDfg8d1eiYUIVpcWQZ4myEDxG7JzmPSYfJRsdLWK2TGB', '2018-08-12 22:03:59', '2018-08-12 22:34:55', NULL),
(32, 'sanazukiv@gmail.com', '$2y$10$aFlaPalGIY3W57fyiERKYe.20HylFBjEqiMLicpihp.m4U017czWa', 'TAC12', 'Jl. Perwira V No. 50', '08425123415', '0', '8467512842', 'Bank Central Asia', 'fotoprofil32.jpg', '3.6385662673174854', '98.6886083411955', '2', '1', 'ZOKGvpyqOcodcmS8FiaiLrF77NsRjJ32u3Y7uIs3htf25wczwTINnoZk1MPe', '2018-08-12 22:08:27', '2018-08-12 22:37:05', NULL),
(33, 'herifi88@gmail.com', '$2y$10$avQMec2ad7hOuuXMq.GuseXlaziKxEOPpxjSmrWE9wZ85vWbCzqJm', 'TAC13', 'Jl. Denai No.278', '0824123213123', '0', '8412316782', 'Bank Central Asia', 'fotoprofil33.jpg', '3.5816030185662933', '98.71653263378698', '2', '1', 'Oktl3ZyDuC49wR9ycJOGh4PQcr7uYff5wxJg2VnLEijPuDdyLh5RfsXU9Irn', '2018-08-12 22:18:33', '2018-08-12 22:46:14', NULL),
(34, 'wianjacky@gmail.com', '$2y$10$oZeDCGYekFbvNiBaMeBjxu0yeRllI/Mp8hB/utt1f4d/zsDvQSUl6', 'TAC14', 'Jl. Bhayangkara No. 121', '081156732134', '0', '8431451234', 'Bank Nasional Indonesia', 'fotoprofil34.jpg', '3.622242341475166', '98.6997534617235', '2', '1', 'iMKcfmNfn96kj5LlDOFB4UNSqOjQliAI0xkFQy55Ed4YyfMIBpAC8LoY5ojO', '2018-08-12 22:19:39', '2018-08-12 22:50:58', NULL),
(35, 'vinaloren88@gmail.com', '$2y$10$Hcm13ZNOU9qSk0eftx5.YeJ5SrQ7uPf6rZDbIqTzLOZCi/B5q.NWq', 'TAC15', 'Jl. Letda Sujono No. 256', '083123123213', '0', '8941231231231', 'Bank Mandiri', 'fotoprofil35.jpg', '3.5968308883973705', '98.74165081970762', '2', '1', 'rocn5JIYsAYH7XvJ2QC3fkJwk1Yvtn5WhMSpX3H7ENmFsDrCgSvpid6yUVUW', '2018-08-12 22:20:38', '2018-08-12 22:53:49', NULL),
(36, 'tiarjs223@gmail.com', '$2y$10$ay6bxuuMz79hKW1Q4E1/H.3YlrZR7wZh8aKez7JEu5YTi4Skxoehq', 'TAC16', 'Jl. Palapa No. 67', '08123123144', '0', '8122466723', 'Bank Central Asia', 'fotoprofil36.jpg', '3.630278088997335', '98.66866791984467', '2', '1', 'UyXBuzshBr57Ns3ceqhPgeKzn9UDuqbsZgAoJ8KCOkJvZiCFQju2668O3Qbu', '2018-08-12 22:58:48', '2018-08-12 23:03:47', NULL),
(37, 'riduansalim88@gmail.com', '$2y$10$67VzwN977pHkAaeK36Mt1uoVrn6p2kEogzd00W.rfj5Xeb32WP4Uq', 'TAC17', 'Jl. Gaperta No. 231', '081412312444', '0', '814123141245', 'Bank Mandiri', 'fotoprofil37.jpg', '3.604604115399853', '98.63873148297955', '2', '1', '3kMGJpREDQGnGZ1YmQavbAMMjmXe1SWihrTfi765GPSiClBXNS1NTKcjEdEn', '2018-08-12 23:00:27', '2018-08-12 23:06:09', NULL),
(38, 'xieciachai@gmail.com', '$2y$10$zFdH26Cta7eH0q4BLlNSw.mBpk2WTl/nXH.17kBBkAO2j0rEqlc4W', 'TAC18', NULL, NULL, '0', NULL, NULL, 'fotoprofil38.jpg', NULL, NULL, '2', '0', NULL, '2018-08-12 23:08:41', '2018-08-12 23:08:41', NULL),
(39, 'hongkohtian@gmail.com', '$2y$10$M7wJZ7Xyx9./gsCkv65TOulirGg5WDaICS8mXo/uyUHahnpT39jMG', 'TAC19', NULL, NULL, '0', NULL, NULL, 'fotoprofil39.jpg', NULL, NULL, '2', '0', NULL, '2018-08-12 23:10:10', '2018-08-12 23:10:10', NULL),
(40, 'saputralin.dicky@gmail.com', '$2y$10$/8k.Q1aaoomI57qNvikkI.bdubXSt5N6OpwtNk/7NyLD7nSuW1HMi', 'NIP20', NULL, NULL, '0', NULL, NULL, 'nopicture.jpg', NULL, NULL, '1', '1', NULL, '2018-08-13 13:38:38', '2018-08-13 13:38:38', NULL),
(41, 'suwandi@gmail.com', '$2y$10$Z7plNtGECYQ01nxX3C2ECOph7mBCPb0ERb3isUAEEtOfYxrmO4aje', 'NIP21', '', '081234567890', '0', '830519944', 'Suwandi', 'nopicture.jpg', '3.587968808626384', '98.7077049509262', '1', '1', 'lDBIgDPwxtuPteL5wG6bUr85Bi5JOFtBHxECRcbZAMX0FWtAJXe2RTYodhRb', '2022-11-02 12:18:45', '2022-11-02 12:26:27', NULL),
(42, 'marco@gmail.com', '$2y$10$w1CJDIwnjJiy2DJkgqgFhevcQMO8qf.jXxwa4fI7jxJ.zoE.2pTOq', 'NIP22', 'Jln. Krakatau No. 73', '081345567781', '9138397.2282153', '830400311', 'Marco', 'fotoprofil42.jpg', '3.625812414695396', '98.68011116981506', '1', '1', '3IRV34nVDNCYJx7inM9HWKvveVIZEJ6hvF52l8mTv8g0rsuMXKTK0sM4UaGz', '2022-11-03 05:21:39', '2022-11-18 05:38:03', NULL),
(43, 'kevinsuw@gmail.com', '$2y$10$cOVo4wEpIq.3zDRyQqCoJeNO9GDUF4N4AJFbXOs2baGgcMHhsw//.', 'TAC20', '1', '1', '0', '1', '1', 'fotoprofil_1765773406.jpg', '3.587262922014247', '98.70708966208085', '2', '1', 'h1Mh0L2BorptZMFddS0n4Ce781vLz5dOjiKugz3cf7a4q7YxUaFuQkLvnsqO', '2025-12-15 04:36:47', '2025-12-16 18:23:45', NULL),
(44, 'testsaja@gmail.com', '$2y$10$Ebe12MY34zhx9nKrUO77RORD0ogMjog/TdSHhpKvN5RYHJ1izI5Ya', 'NIP23', NULL, NULL, '0', NULL, NULL, 'nopicture.jpg', NULL, NULL, '1', '1', NULL, '2025-12-15 05:46:05', '2025-12-15 05:46:05', NULL),
(45, 'kennedianjing@gmail.com', '$2y$10$8wv0v1EmVOyPMH8ujgRtxeSMwVRyCJrn0C5iu56dn3x.8s1UrDZl2', 'NIP24', NULL, NULL, '0', NULL, NULL, 'nopicture.jpg', NULL, NULL, '1', '1', NULL, '2025-12-15 05:49:39', '2025-12-15 05:49:39', NULL),
(46, 'manda@gmail.com', '$2y$10$MqteZ.H/hDX6As/HDYJBAOfG5PDdGBZBakSUdc/vIWkIB/7Nq767y', 'NIP25', NULL, NULL, '0', NULL, NULL, 'nopicture.jpg', NULL, NULL, '1', '1', NULL, '2025-12-15 11:47:10', '2025-12-15 11:47:10', NULL),
(47, 'sinta@gmail.com', '$2y$10$Vv0ZSzarcBCqkacUva6QaOFKbbKojbA7GaDMvxaJTp1aZVN39JS2e', 'NIP26', 'Test', '1', '99346709.442978', '1', '1', 'nopicture.jpg', '3.5889171429439597', '98.70831494939162', '1', '1', 'X3JxwQLZ8TWGKhxovfLuGrh73DRT2Fm5RR4N8LZTownNG0hrD4gB8kvrpgab', '2025-12-15 11:47:52', '2025-12-16 02:39:54', NULL),
(48, 'pelanggan@nukang.com', '$2y$12$.CGwJ/ECL3LosuYHBnG2bOlIyloMVJu/s7tOot3Vm6dngdWRrmapy', 'NIP001', 'Test Address 123', '089988776655', '230000', NULL, NULL, 'fotoprofil48.jpg', '3.5866718', '98.69232029999999', '1', '1', NULL, '2025-12-18 07:22:28', '2025-12-20 00:47:48', 'Test User Lengkap'),
(49, 'tukang@nukang.com', '$2y$12$JR.kZgk1ObyQh4K7VaxBNODJzEJ940u.0KNNHewvGDp337a7y1Zhu', 'TAC001', 'Medan, Indonesia', '081234567890', '0', NULL, NULL, 'fotoprofil49.jpg', '3.5866718', '98.69232029999999', '2', '1', NULL, '2025-12-18 07:22:28', '2025-12-20 02:08:42', 'Test Tukang Profesional'),
(50, 'admin@nukang.com', '$2y$12$VlB/1.BByJUkeBpGNoz/deXaXGjj3BfoSys3QvqZwSzxc9GERv0P6', 'ADM001', 'test', '5656', '0', NULL, NULL, 'nopicture.jpg', '3.5860912', '98.6913777', '0', '1', NULL, '2025-12-18 07:26:21', '2025-12-19 05:37:31', 'Test User Lengkap'),
(51, 'testpelanggan123@test.com', '$2y$12$McsfBQK6e7WIMwM55QZgpO142.80mQCj0j9OsukEGWdSn.0u4ftQ2', 'NIP028', NULL, NULL, '0', NULL, NULL, 'nopicture.jpg', NULL, NULL, '1', '1', NULL, '2025-12-20 07:21:08', '2025-12-20 07:21:08', 'Test User'),
(52, 'testtukang456@test.com', '$2y$12$z/fbsUJbQ9WFsPdVvg6kP.nNE2pDylfBrOe3LWa8dPhqRUj7lZ222', 'NIP029', NULL, NULL, '0', NULL, NULL, 'nopicture.jpg', NULL, NULL, '1', '1', NULL, '2025-12-20 07:26:41', '2025-12-20 07:26:41', 'Test Tukang'),
(53, 'jeksen@nukang.com', '$2y$12$A7DVRnUnczdkwqYp9AbVM.BNZeIFwgzIKxd7GuZh0Zbmg6ncc1qRC', 'NIP030', NULL, NULL, '0', NULL, NULL, 'nopicture.jpg', NULL, NULL, '1', '1', NULL, '2025-12-20 07:27:35', '2025-12-20 07:27:35', 'Jeksen'),
(54, 'Jeksens@nukang.com', '$2y$12$Qm3rhOboWK61snYHTQcQ7uVM0eW6z0MFiNE.zrzDW0DB2FT18Zmse', 'NIP031', 'medannnnn njir', '081234567890', '8774854.5362234', NULL, NULL, 'fotoprofil54.jpg', '3.590376179283813', '98.6757132379682', '1', '1', 'Vl4GftlA0EZe3Omj5NIz1jVJIbRNyXb0Tqg2gUFUXa03iF3ma1i2ffoywaWh', '2025-12-20 07:29:05', '2025-12-20 19:58:11', 'Jeksens'),
(55, 'Jeksenss@nukang.com', '$2y$12$gkFZrGSV6NlvCZpntero0.JH4mS9QhxyBNJxawrNW4xphDeDAHR36', 'TAC022', 'medan woy', '081234567890', '200000', '7879879789', 'asep', 'fotoprofil55.jpg', '3.592189361359977', '98.67764442845892', '2', '1', NULL, '2025-12-20 07:40:06', '2025-12-20 20:00:09', 'Jeksen');

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
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `alamatpelanggan`
--
ALTER TABLE `alamatpelanggan`
  MODIFY `id_alamatpelanggan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `bahanmaterial`
--
ALTER TABLE `bahanmaterial`
  MODIFY `id_bahanmaterial` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hargajarak`
--
ALTER TABLE `hargajarak`
  MODIFY `id_hargajarak` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jasatersedia`
--
ALTER TABLE `jasatersedia`
  MODIFY `id_jasatersedia` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `jenispemesanan`
--
ALTER TABLE `jenispemesanan`
  MODIFY `id_jenispemesanan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kategoritukang`
--
ALTER TABLE `kategoritukang`
  MODIFY `id_kategoritukang` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `laporanprogress`
--
ALTER TABLE `laporanprogress`
  MODIFY `id_progress` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pemesananbahanmaterial`
--
ALTER TABLE `pemesananbahanmaterial`
  MODIFY `id_pemesananbahanmaterial` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `riwayattransaksi`
--
ALTER TABLE `riwayattransaksi`
  MODIFY `id_riwayattransaksi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tukang`
--
ALTER TABLE `tukang`
  MODIFY `id_tukang` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id_ulasan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
