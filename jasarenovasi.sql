-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jan 2026 pada 17.13
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(10) UNSIGNED NOT NULL,
  `id` int(11) NOT NULL,
  `namaadmin` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `id`, `namaadmin`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', '2025-11-16 08:04:29', '2025-11-16 08:04:29'),
(2, 50, 'ADMIN 1', '2025-11-16 08:04:29', '2025-11-16 08:04:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `alamatpelanggan`
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
-- Dumping data untuk tabel `alamatpelanggan`
--

INSERT INTO `alamatpelanggan` (`id_alamatpelanggan`, `id_pelanggan`, `alamatpelanggan`, `latitudealamat`, `longtitudealamat`, `created_at`, `updated_at`) VALUES
(30, 59, 'mikro b', '3.5875173', '98.6907458', '2026-01-02 14:30:20', '2026-01-02 14:30:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahanmaterial`
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
-- Dumping data untuk tabel `bahanmaterial`
--

INSERT INTO `bahanmaterial` (`id_bahanmaterial`, `id_kategoritukang`, `kodebahanmaterial`, `bahanmaterial`, `informasibahanmaterial`, `hargabahanmaterial`, `fotobahanmaterial`, `statusbahanmaterial`, `created_at`, `updated_at`) VALUES
(1, 1, 'KBa321saAs', 'AC Baru', 'Plastik', '1500000', 'fotobahanmaterial20180705095447.jpg', '1', '2025-11-17 18:50:46', '2025-11-17 18:50:46'),
(5, 2, 'KBY82LhHsQ', 'CCTV HD', 'Mesin', '500000', 'fotobahanmaterial1A08UtYRB.jpg', '1', '2025-11-16 22:55:38', '2025-11-16 22:55:38'),
(6, 1, 'KBhFxkVcfS', 'AC LG', 'Baru', '1500000', 'fotobahanmaterial1wJdHPBUm.jpg', '0', '2025-11-17 17:00:14', '2025-11-17 17:00:14'),
(8, 1, 'KBTnxizvjq', 'semen', 'semen', '100000', 'fotobahanmaterial50OgtqEmWN.jpg', '1', '2026-01-02 14:46:26', '2026-01-02 14:46:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hargajarak`
--

CREATE TABLE `hargajarak` (
  `id_hargajarak` int(10) UNSIGNED NOT NULL,
  `hargajarak` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `hargajarak`
--

INSERT INTO `hargajarak` (`id_hargajarak`, `hargajarak`, `created_at`, `updated_at`) VALUES
(1, 10000, '2025-11-18 03:43:28', '2025-12-24 14:42:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jasatersedia`
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
-- Dumping data untuk tabel `jasatersedia`
--

INSERT INTO `jasatersedia` (`id_jasatersedia`, `id_tukang`, `id_jenispemesanan`, `biayajasatersedia`, `jenisjasatersedia`, `created_at`, `updated_at`) VALUES
(123, 37, 5, '100000', '0', '2026-01-02 14:10:27', '2026-01-02 14:10:27'),
(124, 37, 14, '1000000', '1', '2026-01-02 14:10:27', '2026-01-02 14:10:27'),
(125, 26, 1, '10000', '0', '2026-01-02 14:45:09', '2026-01-02 14:45:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenispemesanan`
--

CREATE TABLE `jenispemesanan` (
  `id_jenispemesanan` int(10) UNSIGNED NOT NULL,
  `id_kategoritukang` int(11) NOT NULL,
  `jenispemesanan` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `jenispemesanan`
--

INSERT INTO `jenispemesanan` (`id_jenispemesanan`, `id_kategoritukang`, `jenispemesanan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pengecatan Dinding Interior', '2025-11-15 23:51:57', '2025-11-15 23:51:57'),
(2, 1, 'Renovasi Dapur', '2025-11-17 12:45:36', '2025-11-17 12:45:36'),
(3, 2, 'Pengecatan Dinding Eksterior', '2025-11-15 18:38:49', '2025-11-15 18:38:49'),
(5, 2, 'Renovasi Pagar', '2025-11-16 14:27:17', '2025-11-16 14:27:17'),
(11, 1, 'Renovasi Kamar Mandi', '2025-11-17 01:49:13', '2025-11-17 01:49:13'),
(12, 1, 'Pemasangan Keramik/Lantai', '2025-11-18 15:29:41', '2025-11-18 15:29:41'),
(13, 1, 'Perbaikan Plafon', '2025-11-19 05:01:11', '2025-11-19 05:01:11'),
(14, 2, 'Renovasi Taman', '2025-11-18 18:55:19', '2025-11-18 18:55:19'),
(15, 2, 'Renovasi Carport/Garasi', '2025-11-17 17:20:33', '2025-11-17 17:20:33'),
(16, 2, 'Pemasangan Kanopi', '2025-11-16 06:12:45', '2025-11-16 06:12:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategoritukang`
--

CREATE TABLE `kategoritukang` (
  `id_kategoritukang` int(10) UNSIGNED NOT NULL,
  `kategoritukang` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `kategoritukang`
--

INSERT INTO `kategoritukang` (`id_kategoritukang`, `kategoritukang`, `created_at`, `updated_at`) VALUES
(1, 'Renovasi Indoor', '2025-11-16 06:56:33', '2025-11-16 06:56:33'),
(2, 'Renovasi Outdoor', '2025-11-18 23:57:56', '2025-11-18 23:57:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporanprogress`
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

--
-- Dumping data untuk tabel `laporanprogress`
--

INSERT INTO `laporanprogress` (`id_progress`, `id_tukang`, `id_pemesanan`, `tanggal_progress`, `informasi_pekerjaan`, `fotoprogress1`, `fotoprogress2`, `fotoprogress3`, `fotoprogress4`, `fotoprogress5`, `created_at`, `updated_at`) VALUES
(5, 37, 32, '2026-01-03 01:01:00', 'etha tes', 'progress_pekerjaan/progress_32_1_1767364597.png', NULL, NULL, NULL, NULL, '2026-01-02 14:36:37', '2026-01-02 14:36:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2025_11_16_000001_create_users_table', 1),
('2025_11_16_000002_create_password_resets_table', 1),
('2025_11_16_000003_create_pelanggan_table', 1),
('2025_11_16_000004_create_tukang_table', 1),
('2025_11_16_000005_create_admin_table', 1),
('2025_11_16_000006_create_alamatpengantaran_table', 1),
('2025_11_17_000001_create_pemesanan_table', 1),
('2025_11_17_000002_create_riwayattransaksi_table', 1),
('2025_11_17_000003_create_notifikasi_table', 1),
('2025_11_17_000004_create_kategoritukang_table', 1),
('2025_11_17_000005_create_bahanmaterial_table', 1),
('2025_11_18_000001_create_jenispemesanan_table', 1),
('2025_11_18_000002_create_jasatersedia_table', 2),
('2025_11_18_000003_create_pemesananbahanmaterial_table', 3),
('2025_11_18_000004_create_ulasantukang_table', 4),
('2018_08_05_235736_create_hargajarak_table', 5),
('2025_11_19_000001_create_laporanprogress_table', 6),
('2025_12_19_000002_add_namalengkap_to_users_table', 7),
('2025_12_21_001700_add_missing_columns_to_tables', 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi`
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
-- Dumping data untuk tabel `notifikasi`
--

INSERT INTO `notifikasi` (`id_notifikasi`, `dari`, `kepada`, `isinotifikasi`, `jenisnotifikasi`, `statusnotifikasi`, `created_at`, `updated_at`) VALUES
(98, 1, 64, 'berhasil melakukan pengupdatean saldo dengan nominal Rp. 10,000,000,000.00 pada tanggal 2026-01-02 21:02:19', 'riwayattransaksi', '0', '2026-01-02 14:02:19', '2026-01-02 14:02:19'),
(99, 64, 65, 'telah melakukan pemesanan terhadap jasa anda', 'permintaanpesanan', '0', '2026-01-02 14:31:17', '2026-01-02 14:31:17'),
(100, 65, 64, 'telah menerima permintaan pesanan anda dengan nomor pemesanan NPxjBwptbk', 'riwayatpemesanan/32?kategori=2&katakunci=', '0', '2026-01-02 14:32:02', '2026-01-02 14:32:02'),
(101, 64, 65, 'telah mengkonfirmasi bahwa pekerjaan anda dengan nomor pemesananNPxjBwptbk telah selesai, silahkan cek saldo anda akan secara otomatis bertambah', 'riwayatpemesanan/32', '0', '2026-01-02 14:38:01', '2026-01-02 14:38:01'),
(102, 64, 65, 'telah memberikan ulasan terhadap jasa anda dengan nilai rating 3', 'riwayatpemesanan/32', '0', '2026-01-02 14:38:18', '2026-01-02 14:38:18'),
(103, 64, 65, 'telah melakukan pemesanan terhadap jasa anda', 'permintaanpesanan', '0', '2026-01-02 14:42:37', '2026-01-02 14:42:37'),
(104, 65, 64, 'telah menerima permintaan pesanan anda dengan nomor pemesanan NPZAzbuVrp', 'riwayatpemesanan/33?kategori=2&katakunci=', '0', '2026-01-02 14:42:52', '2026-01-02 14:42:52'),
(105, 64, 65, 'telah mengkonfirmasi bahwa pekerjaan anda dengan nomor pemesananNPZAzbuVrp telah selesai, silahkan cek saldo anda akan secara otomatis bertambah', 'riwayatpemesanan/33', '0', '2026-01-02 14:43:47', '2026-01-02 14:43:47'),
(106, 64, 65, 'telah memberikan ulasan terhadap jasa anda dengan nilai rating 1', 'riwayatpemesanan/33', '0', '2026-01-02 14:43:57', '2026-01-02 14:43:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(10) UNSIGNED NOT NULL,
  `id` int(11) NOT NULL,
  `namapelanggan` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `id`, `namapelanggan`, `created_at`, `updated_at`) VALUES
(30, 48, 'Jeslinn', '2025-11-16 12:32:48', '2026-01-02 13:51:40'),
(59, 64, 'ethap', '2026-01-02 13:59:09', '2026-01-02 13:59:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
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
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `id_tukang`, `id_pelanggan`, `id_jenispemesanan`, `id_kategoritukang`, `nomorpemesanan`, `biayajasa`, `tanggalbekerja`, `tanggalselesai`, `catatan`, `kategoripemesanan`, `fotopemesanan1`, `fotopemesanan2`, `alamatpemesanan`, `latitudepemesanan`, `longtitudepemesanan`, `alasanpenolakanpemesanan`, `statuspemesanan`, `statusubahharga`, `created_at`, `updated_at`) VALUES
(32, 37, 59, 5, 2, 'NPxjBwptbk', '100000', '2026-01-03', '2026-01-03', 'Pagar Rusak', '0', 'fotopesan120260102213117.jpg', NULL, 'Mikroskil A', '3.5883434', '98.69052320000002', NULL, '5', '0', '2026-01-02 14:31:17', '2026-01-02 14:38:18'),
(33, 37, 59, 14, 2, 'NPZAzbuVrp', '1000000', '2026-01-11', '2026-01-12', 'tes borongan', '1', NULL, NULL, 'mikro b', '3.5875173', '98.6907458', NULL, '5', '0', '2026-01-02 14:42:37', '2026-01-02 14:43:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesananbahanmaterial`
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
-- Dumping data untuk tabel `pemesananbahanmaterial`
--

INSERT INTO `pemesananbahanmaterial` (`id_pemesananbahanmaterial`, `id_bahanmaterial`, `id_pemesanan`, `hargapemesananbahanmaterial`, `qtypembelian`, `statuspembelian`, `created_at`, `updated_at`) VALUES
(22, 5, 32, '500000', 1, '1', '2026-01-02 14:33:32', '2026-01-02 14:33:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayattransaksi`
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
-- Dumping data untuk tabel `riwayattransaksi`
--

INSERT INTO `riwayattransaksi` (`id_riwayattransaksi`, `id`, `kode`, `jumlahsaldo`, `rekening`, `namarekening`, `rekeningtujuan`, `jenistransaksi`, `buktitransaksi`, `statustransaksi`, `created_at`, `updated_at`) VALUES
(43, 64, 'KT0cW', '10000000000', '888000888', 'ethap', 'BRI - 445566778888000', 'Pengisian Saldo', 'buktitransferKT0cW.jpg', '1', '2026-01-02 14:01:08', '2026-01-02 14:02:19'),
(44, 64, 'PJBRH98A', '100000', 'NPxjBwptbk', 'ethat', NULL, 'Pembayaran Jasa', NULL, '1', '2026-01-02 14:31:17', '2026-01-02 14:31:17'),
(45, 65, 'KTABCakMm8', '100000', NULL, NULL, NULL, 'Pembayaran Biaya Jasa', NULL, '1', '2026-01-02 14:38:01', '2026-01-02 14:38:01'),
(46, 64, 'PJHP6DUL', '1000000', 'NPZAzbuVrp', 'ethat', NULL, 'Pembayaran Jasa', NULL, '1', '2026-01-02 14:42:37', '2026-01-02 14:42:37'),
(47, 65, 'KTABCco25r', '1000000', NULL, NULL, NULL, 'Pembayaran Biaya Jasa', NULL, '1', '2026-01-02 14:43:47', '2026-01-02 14:43:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tukang`
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
  `fotoktp` varchar(255) DEFAULT NULL,
  `fotosim` varchar(255) DEFAULT NULL,
  `fotohasilkerja` varchar(255) DEFAULT NULL,
  `statusjasakeahlian` varchar(1) DEFAULT '0',
  `statuseditprofil` varchar(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `tukang`
--

INSERT INTO `tukang` (`id_tukang`, `id`, `id_kategoritukang`, `namatukang`, `pengalamanbekerja`, `lamapengalamanbekerja`, `deskripsikeahlian`, `rating`, `totalvote`, `jumlahvote`, `fotoktp`, `fotosim`, `fotohasilkerja`, `statusjasakeahlian`, `statuseditprofil`, `created_at`, `updated_at`) VALUES
(26, 49, 1, 'Tukang Test1', 'cat rumah jesslyn', '1', 'cat rumah', 0, 0, 0, '', '', '', '1', '1', '2025-11-18 03:25:09', '2026-01-02 14:45:09'),
(37, 65, 2, 'ethat', 'Taman Rumput di CV.ABC~Renov Pagar di PT.ABC', '5', 'Pasang Pagar dan Pintu Kaca', 2, 4, 2, '1767362672_ktp_Screenshot 2025-11-24 175324.png', '1767362672_sim_Screenshot 2025-11-24 175324.png', '1767362672_hasil_Screenshot 2025-11-24 175324.zip', '1', '1', '2026-01-02 14:04:32', '2026-01-02 14:43:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ulasan`
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
-- Dumping data untuk tabel `ulasan`
--

INSERT INTO `ulasan` (`id_ulasan`, `id_tukang`, `id_pelanggan`, `rating`, `isiulasan`, `created_at`, `updated_at`) VALUES
(8, 37, 59, 3, '3', '2026-01-02 14:38:18', '2026-01-02 14:38:18'),
(9, 37, 59, 1, '1', '2026-01-02 14:43:57', '2026-01-02 14:43:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
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
  `fotoprofil` varchar(255) DEFAULT NULL,
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
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `kodeuser`, `alamat`, `nomorhandphone`, `saldo`, `nomorrekening`, `namarekening`, `fotoprofil`, `latitude`, `longtitude`, `statuspengguna`, `statusverifikasi`, `remember_token`, `created_at`, `updated_at`, `namaLengkap`) VALUES
(1, 'admin@gmail.com', '$2y$12$JNfIHu/CztIrhb921AxsJO/G4qyfJH5hcuL2rKNS4BxvIuo/JWgWu', 'ADM002', '', '', '', '', '', 'nopicture.jpg', '', '', '0', '1', 'FtWKT0bIzohzSXqLQ6zqo2hS0HXulPvReuapHRaMfFOPaWuFSFNIArCnzi6L', '2025-11-16 11:20:45', '2025-11-17 18:57:25', 'ADMIN 2'),
(48, 'pelanggan@nukang.com', '$2y$12$E0BzYSFJABTWVxhPUuoddOi/G96Rr0LMQmyrimM4OtXNNQfTFnDG6', 'NIP001', 'Test Address 123', '089988776655', '3.0E+19', NULL, NULL, 'fotoprofil48.jpg', '3.5906879', '98.69558219999999', '1', '1', NULL, '2025-11-16 23:42:38', '2026-01-02 13:53:53', 'Jeslinn'),
(49, 'tukang@nukang.com', '$2y$12$Px8gr0KjNkSXeyOK6zO7OeQExX.j1ZEe1VJ3Kt5ZlJD3iZrlAfFrK', 'TAC001', 'Medan, Indonesia', '081234567890', '0', NULL, NULL, 'fotoprofil49.jpg', '3.5866718', '98.69232029999999', '2', '1', NULL, '2025-11-18 02:31:50', '2026-01-02 13:52:22', 'Tukang Test1'),
(50, 'admin@nukang.com', '$2y$12$VlB/1.BByJUkeBpGNoz/deXaXGjj3BfoSys3QvqZwSzxc9GERv0P6', 'ADM001', 'test', '5656', '0', NULL, NULL, 'nopicture.jpg', '3.5860912', '98.6913777', '0', '1', NULL, '2025-11-16 06:26:52', '2025-11-16 16:35:49', 'ADMIN 1'),
(64, 'ethap@gmail.com', '$2y$12$EZWIiypmvk90L4R3X1aebORQEr4fmRZiR43eEPIwI3t5yTfrnuRc6', 'NIP002', 'Mikroskil A', '8123123123', '9998398620.2922', '888000888', 'ethap', 'fotoprofil64.jpg', '3.5883434', '98.69052320000002', '1', '1', NULL, '2026-01-02 13:59:09', '2026-01-02 14:43:20', 'ethap'),
(65, 'ethat@gmail.com', '$2y$12$BFTB1dlZ/NnkbKzCVl4fa.mDEJh/P4F.bCv5PSSQIBcXjr65GLXQO', 'TAC002', 'Jl. Bambu No.1', '08141728393', '1100000', NULL, NULL, 'fotoprofil65.jpg', '3.6071538', '98.6794885', '2', '1', NULL, '2026-01-02 14:04:32', '2026-01-02 14:43:47', 'ethat');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `alamatpelanggan`
--
ALTER TABLE `alamatpelanggan`
  ADD PRIMARY KEY (`id_alamatpelanggan`);

--
-- Indeks untuk tabel `bahanmaterial`
--
ALTER TABLE `bahanmaterial`
  ADD PRIMARY KEY (`id_bahanmaterial`);

--
-- Indeks untuk tabel `hargajarak`
--
ALTER TABLE `hargajarak`
  ADD PRIMARY KEY (`id_hargajarak`);

--
-- Indeks untuk tabel `jasatersedia`
--
ALTER TABLE `jasatersedia`
  ADD PRIMARY KEY (`id_jasatersedia`);

--
-- Indeks untuk tabel `jenispemesanan`
--
ALTER TABLE `jenispemesanan`
  ADD PRIMARY KEY (`id_jenispemesanan`);

--
-- Indeks untuk tabel `kategoritukang`
--
ALTER TABLE `kategoritukang`
  ADD PRIMARY KEY (`id_kategoritukang`);

--
-- Indeks untuk tabel `laporanprogress`
--
ALTER TABLE `laporanprogress`
  ADD PRIMARY KEY (`id_progress`);

--
-- Indeks untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indeks untuk tabel `pemesananbahanmaterial`
--
ALTER TABLE `pemesananbahanmaterial`
  ADD PRIMARY KEY (`id_pemesananbahanmaterial`);

--
-- Indeks untuk tabel `riwayattransaksi`
--
ALTER TABLE `riwayattransaksi`
  ADD PRIMARY KEY (`id_riwayattransaksi`);

--
-- Indeks untuk tabel `tukang`
--
ALTER TABLE `tukang`
  ADD PRIMARY KEY (`id_tukang`);

--
-- Indeks untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id_ulasan`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `alamatpelanggan`
--
ALTER TABLE `alamatpelanggan`
  MODIFY `id_alamatpelanggan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `bahanmaterial`
--
ALTER TABLE `bahanmaterial`
  MODIFY `id_bahanmaterial` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `hargajarak`
--
ALTER TABLE `hargajarak`
  MODIFY `id_hargajarak` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `jasatersedia`
--
ALTER TABLE `jasatersedia`
  MODIFY `id_jasatersedia` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT untuk tabel `jenispemesanan`
--
ALTER TABLE `jenispemesanan`
  MODIFY `id_jenispemesanan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `kategoritukang`
--
ALTER TABLE `kategoritukang`
  MODIFY `id_kategoritukang` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `laporanprogress`
--
ALTER TABLE `laporanprogress`
  MODIFY `id_progress` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `pemesananbahanmaterial`
--
ALTER TABLE `pemesananbahanmaterial`
  MODIFY `id_pemesananbahanmaterial` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `riwayattransaksi`
--
ALTER TABLE `riwayattransaksi`
  MODIFY `id_riwayattransaksi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `tukang`
--
ALTER TABLE `tukang`
  MODIFY `id_tukang` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id_ulasan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
