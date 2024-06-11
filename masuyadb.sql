-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2024 at 01:27 PM
-- Server version: 8.0.26
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `masuyadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `beli`
--

CREATE TABLE `beli` (
  `no_bukti` varchar(45) NOT NULL,
  `tanggal` varchar(45) DEFAULT NULL,
  `jatuh_tempo` varchar(45) NOT NULL,
  `kode_supp` varchar(45) NOT NULL,
  `sub_total` float DEFAULT NULL,
  `persen_ppn` int DEFAULT NULL,
  `total` float DEFAULT NULL,
  `lunas` varchar(45) DEFAULT NULL,
  `tgl_lunas` varchar(45) NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `tgl_terkirim` varchar(45) NOT NULL,
  `create_time` varchar(45) DEFAULT NULL,
  `author` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `beli`
--

INSERT INTO `beli` (`no_bukti`, `tanggal`, `jatuh_tempo`, `kode_supp`, `sub_total`, `persen_ppn`, `total`, `lunas`, `tgl_lunas`, `status`, `tgl_terkirim`, `create_time`, `author`) VALUES
('BL24-00001', '08-06-2024', '08-07-2024', 'AMBICO', 430000, 10, 473000, 'Lunas', '08-06-2024', 'Sudah Terkirim', '08-06-2024', '08-06-2024', 'Admin'),
('BL24-00002', '08-06-2024', '08-07-2024', 'ANEKA', 31889000, 10, 35077900, 'Lunas', '08-06-2024', 'Sudah Terkirim', '09-06-2024', '08-06-2024', 'Admin'),
('BL24-00003', '08-06-2024', '08-07-2024', 'AMBICO', 240000, 10, 264000, 'Lunas', '08-06-2024', 'Sudah Terkirim', '10-06-2024', '08-06-2024', 'Admin'),
('BL24-00004', '08-06-2024', '08-07-2024', 'AMBICO', 240000, 10, 264000, 'Lunas', '08-06-2024', 'Sudah Terkirim', '12-06-2024', '08-06-2024', 'Admin'),
('BL24-00005', '08-06-2024', '08-07-2024', 'ANEKA', 1195000, 11, 1326450, 'Lunas', '09-06-2024', 'Belum Terkirim', '-', '08-06-2024', 'Admin'),
('BL24-00006', '10-06-2024', '10-07-2024', 'ANEKA', 4057990000, 10, 4463790000, 'Lunas', '10-06-2024', 'Sudah Terkirim', '11-06-2024', '10-06-2024', 'Admin'),
('BL24-00007', '10-06-2024', '10-07-2024', 'CLEANBEE', 1250000, 10, 1375000, 'Lunas', '10-06-2024', 'Sudah Terkirim', '11-06-2024', '10-06-2024', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `beli_dtl`
--

CREATE TABLE `beli_dtl` (
  `no_bukti` varchar(45) NOT NULL,
  `kode_brg` varchar(45) DEFAULT NULL,
  `nama_brg` varchar(255) DEFAULT NULL,
  `qty_order` int DEFAULT NULL,
  `packing` varchar(45) DEFAULT NULL,
  `id_satuan` int NOT NULL,
  `hrg_per_unit` float DEFAULT NULL,
  `hrg_total` float DEFAULT NULL,
  `kirim_gudang` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `beli_dtl`
--

INSERT INTO `beli_dtl` (`no_bukti`, `kode_brg`, `nama_brg`, `qty_order`, `packing`, `id_satuan`, `hrg_per_unit`, `hrg_total`, `kirim_gudang`) VALUES
('BL24-00001', 'A0090', 'SRM Bread Sub Roll Wheat', 10, '10x1KG', 4, 16000, 160000, 'M'),
('BL24-00001', 'A0091', 'SRM Bread Roll Wheat', 15, '6X1KG', 4, 18000, 270000, 'K'),
('BL24-00002', 'A0012M', 'Sanma L', 20, '55x7,5KG', 1, 1594450, 31889000, 'M'),
('BL24-00003', 'A0095', 'KIKKOMAN Shoyu 2KG', 10, '15x2KG', 2, 24000, 240000, 'M'),
('BL24-00004', 'A0095', 'KIKKOMAN Shoyu 2KG', 10, '15x2KG', 2, 24000, 240000, 'M'),
('BL24-00005', 'A0096', 'KIKKOMAN Shoyu 2,5LTR', 25, '2,5LTR', 2, 32000, 800000, 'K'),
('BL24-00005', 'A0098', 'Fresh Salmon Tasmania Headless', 10, '6x1,5KG', 1, 39500, 395000, 'K'),
('BL24-00006', 'A001M', 'KIKKOMAN Shoyu 1,6LTR', 2960, '6x1,6LTR', 1, 594594, 1760000000, 'M'),
('BL24-00006', 'A0023', 'Chirimen Jako 1KG', 105, '6x1KG', 2, 1583780, 166297000, 'K'),
('BL24-00006', 'A0012M', 'Sanma L', 300, '55x7,5KG', 1, 1594450, 478335000, 'M'),
('BL24-00006', 'A004M', 'BULLDOG Tonkatsu Sauce 1,8LTR', 2186, '6x1,8LTR', 1, 751350, 1642450000, 'M'),
('BL24-00006', 'A0087', 'Dorry Fillet Frozen 1KG', 10, '10x1KG', 1, 650000, 6500000, 'M'),
('BL24-00006', 'A008M', 'KIKKOMAN Sashimi Sauce 150ML', 12, '12x150ML', 1, 367572, 4410860, 'M'),
('BL24-00007', 'A0099M', 'Komochi Shisamo 5L (8PCE)', 25, '20x105GR', 1, 50000, 1250000, 'K');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `kode_cust` varchar(45) NOT NULL,
  `nama_cust` varchar(45) DEFAULT NULL,
  `type_cust` varchar(45) DEFAULT NULL,
  `alm_1` varchar(255) DEFAULT NULL,
  `alm_2` varchar(255) DEFAULT NULL,
  `alm_3` varchar(255) DEFAULT NULL,
  `kota` varchar(45) DEFAULT NULL,
  `kontak` varchar(45) DEFAULT NULL,
  `no_telp` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `kode_sales` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`kode_cust`, `nama_cust`, `type_cust`, `alm_1`, `alm_2`, `alm_3`, `kota`, `kontak`, `no_telp`, `email`, `kode_sales`) VALUES
('07AM', '07AM BAKERS CLUB', 'BAKERY', 'JL. BUMBAK DAUH NO.88', 'KEROBOKAN, KUTA UTARA', 'BADUNG BALI', 'KEROBOKAN', 'AYU SUARTINI', '0812 37047789', '-', '16'),
('104 BAR', '104 BAR AND GRILL', 'RESTAURANT WESTERN', 'JL. DANAU POSO 104', 'SANUR', 'DENPASAR, BALI', 'DENPASAR', 'BPK.HERMAN', '0819 1644 3136', '-', '18'),
('88SUNARI', '88 SUNARI', 'MINI MARKET', 'BJ. DINAS BANYUALIT', 'KALIBUKBUK BULELENG', 'BALI', 'SINGARAJA', 'BPK. YOGA', '08193 6501871', NULL, '15');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invdivisi`
--

CREATE TABLE `invdivisi` (
  `kode` varchar(45) NOT NULL,
  `divisi` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `invdivisi`
--

INSERT INTO `invdivisi` (`kode`, `divisi`) VALUES
('J', 'JAPAN'),
('L', 'LOCAL'),
('W', 'WESTERN');

-- --------------------------------------------------------

--
-- Table structure for table `invgudang`
--

CREATE TABLE `invgudang` (
  `kode` varchar(45) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `alamat` varchar(500) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `invgudang`
--

INSERT INTO `invgudang` (`kode`, `nama`, `alamat`, `keterangan`) VALUES
('K', 'GUDANG KUTA', '-', '-'),
('M', 'GUDANG MAHE', 'Jl. Cargo Permai No. 22, Ubung, Denpasar Utara, Kota Denpasar', '-');

-- --------------------------------------------------------

--
-- Table structure for table `invjenis`
--

CREATE TABLE `invjenis` (
  `kode` varchar(45) NOT NULL,
  `jenis` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `invjenis`
--

INSERT INTO `invjenis` (`kode`, `jenis`) VALUES
('C', 'CHILLED'),
('D', 'DRY'),
('F', 'FROZEN');

-- --------------------------------------------------------

--
-- Table structure for table `invmaster`
--

CREATE TABLE `invmaster` (
  `id` int NOT NULL,
  `kode_brg` varchar(45) NOT NULL,
  `nama_brg` varchar(255) NOT NULL,
  `kode_divisi` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `kode_jenis` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `kode_type` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `packing` varchar(45) NOT NULL,
  `quantity` int NOT NULL,
  `id_satuan` int NOT NULL,
  `hrg_jual` float DEFAULT NULL,
  `kode_gudang` varchar(45) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `invmaster`
--

INSERT INTO `invmaster` (`id`, `kode_brg`, `nama_brg`, `kode_divisi`, `kode_jenis`, `kode_type`, `packing`, `quantity`, `id_satuan`, `hrg_jual`, `kode_gudang`, `keterangan`) VALUES
(1, 'A0012M', 'Sanma L', 'J', 'F', 'JSFN', '55x7,5KG', 600, 1, 1275560, 'M', '-'),
(2, 'A001M', 'KIKKOMAN Shoyu 1,6LTR', 'J', 'D', 'K18L', '6x1,6LTR', 5460, 1, 483516, 'M', '23,6CMX33,5CMX31CM'),
(3, 'A0023', 'Chirimen Jako 1KG', 'L', 'F', 'LCSF', '6x1KG', 210, 2, 1187840, 'K', '-'),
(4, 'A004M', 'BULLDOG Tonkatsu Sauce 1,8LTR', 'J', 'D', 'PTDR', '6x1,8LTR', 4372, 1, 563512, 'M', '-'),
(5, 'A0087', 'Dorry Fillet Frozen 1KG', 'W', 'F', 'PTDR', '10x1KG', 20, 1, 487500, 'M', '-'),
(6, 'A008M', 'KIKKOMAN Sashimi Sauce 150ML', 'J', 'D', 'K18L', '12x150ML', 24, 1, 275679, 'M', '15,5CM X 20,5CM X 18CM'),
(17, 'A0090', 'SRM Bread Sub Roll Wheat', 'L', 'D', 'PTDR', '10x1KG', 10, 4, 24000, 'M', '-'),
(18, 'A0091', 'SRM Bread Roll Wheat', 'L', 'D', 'PTDR', '6X1KG', 15, 4, 27000, 'K', '-'),
(20, 'A0095', 'KIKKOMAN Shoyu 2KG', 'J', 'D', 'K18L', '15x2KG', 15, 2, 48000, 'M', '-'),
(34, 'A001M', 'KIKKOMAN Shoyu 1,6LTR', 'J', 'D', 'K18L', '6x1,6LTR', 50, 1, 0, 'M', 'BARANG RUSAK'),
(35, 'A001M', 'KIKKOMAN Shoyu 1,6LTR', 'J', 'D', 'K18L', '6x1,6LTR', 20, 1, 0, 'M', 'BARANG EXPIRED'),
(36, 'A0099M', 'Komochi Shisamo 5L (8PCE)', 'J', 'F', 'JSFN', '20x105GR', 8, 1, 234375, 'K', '-'),
(37, 'A0099M', 'Komochi Shisamo 5L (8PCE)', 'J', 'F', 'JSFN', '20x105GR', 2, 1, 0, 'K', 'BARANG RUSAK');

-- --------------------------------------------------------

--
-- Table structure for table `invtype`
--

CREATE TABLE `invtype` (
  `kode` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `invtype`
--

INSERT INTO `invtype` (`kode`, `type`) VALUES
('JSFN', 'SEA FOOD JAPAN - FROZEN'),
('K18L', 'KIKKOMAN - 18L & 1.6L'),
('LCSF', 'SEA FOOD JAPAN - LOCAL'),
('PTDR', 'PACIFIC TRADING - DRY'),
('SLMN', 'SALMON NRW/TROUT');

-- --------------------------------------------------------

--
-- Table structure for table `jual`
--

CREATE TABLE `jual` (
  `no_bukti` varchar(45) NOT NULL,
  `tanggal` varchar(45) DEFAULT NULL,
  `jatuh_tempo` varchar(45) NOT NULL,
  `kode_cust` varchar(45) NOT NULL,
  `sub_total` float DEFAULT NULL,
  `persen_ppn` int DEFAULT NULL,
  `total` float DEFAULT NULL,
  `lunas` varchar(45) DEFAULT NULL,
  `tgl_lunas` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `tgl_terkirim` varchar(255) NOT NULL,
  `create_time` varchar(45) DEFAULT NULL,
  `author` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jual`
--

INSERT INTO `jual` (`no_bukti`, `tanggal`, `jatuh_tempo`, `kode_cust`, `sub_total`, `persen_ppn`, `total`, `lunas`, `tgl_lunas`, `status`, `tgl_terkirim`, `create_time`, `author`) VALUES
('JL24-00001', '06-06-2024', '06-07-2024', '07AM', 39701200, 10, 43671300, 'Lunas', '07-06-2024', 'Sudah Terkirim', '08-06-2024', '06-06-2024', 'Admin'),
('JL24-00002', '08-06-2024', '08-07-2024', '88SUNARI', 15944500, 10, 17539000, 'Lunas', '08-06-2024', 'Sudah Terkirim', '09-06-2024', '08-06-2024', 'Admin'),
('JL24-00003', '08-06-2024', '08-07-2024', '104 BAR', 180000, 10, 198000, 'Lunas', '08-06-2024', 'Sudah Terkirim', '09-06-2024', '08-06-2024', 'Admin'),
('JL24-00004', '08-06-2024', '08-07-2024', '07AM', 6130800, 10, 6743880, 'Lunas', '10-06-2024', 'Belum Terkirim', '-', '08-06-2024', 'Admin'),
('JL24-00005', '10-06-2024', '10-07-2024', '07AM', 750000, 10, 825000, 'Lunas', '11-06-2024', 'Sudah Terkirim', '11-06-2024', '10-06-2024', 'Admin'),
('JL24-00006', '10-06-2024', '10-07-2024', '104 BAR', 721155, 10, 793270, 'Lunas', '12-06-2024', 'Sudah Terkirim', '12-06-2024', '10-06-2024', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `jual_dtl`
--

CREATE TABLE `jual_dtl` (
  `no_bukti` varchar(45) NOT NULL,
  `id_brg` int NOT NULL,
  `kode_brg` varchar(45) DEFAULT NULL,
  `nama_brg` varchar(255) DEFAULT NULL,
  `qty_order` int DEFAULT NULL,
  `id_satuan` int NOT NULL,
  `hrg_per_unit` float DEFAULT NULL,
  `hrg_total` float DEFAULT NULL,
  `kode_gudang` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jual_dtl`
--

INSERT INTO `jual_dtl` (`no_bukti`, `id_brg`, `kode_brg`, `nama_brg`, `qty_order`, `id_satuan`, `hrg_per_unit`, `hrg_total`, `kode_gudang`) VALUES
('JL24-00001', 1, 'A0012M', 'Sanma L', 10, 1, 1594450, 15944500, 'M'),
('JL24-00001', 3, 'A0023', 'Chirimen Jako 1KG', 15, 2, 1583780, 23756700, 'K'),
('JL24-00002', 1, 'A0012M', 'Sanma L', 10, 1, 1594450, 15944500, 'M'),
('JL24-00003', 20, 'A0095', 'KIKKOMAN Shoyu 2KG', 5, 2, 36000, 180000, 'M'),
('JL24-00004', 4, 'A004M', 'BULLDOG Tonkatsu Sauce 1,8LTR', 8, 1, 751350, 6010800, 'M'),
('JL24-00004', 17, 'A0090', 'SRM Bread Sub Roll Wheat', 5, 4, 24000, 120000, 'M'),
('JL24-00005', 36, 'A0099M', 'Komochi Shisamo 5L (8PCE)', 10, 1, 75000, 750000, 'K'),
('JL24-00006', 36, 'A0099M', 'Komochi Shisamo 5L (8PCE)', 5, 1, 144231, 721155, 'K');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mutasi_stok`
--

CREATE TABLE `mutasi_stok` (
  `id` int NOT NULL,
  `no_bukti` varchar(45) NOT NULL,
  `kode_brg` varchar(255) NOT NULL,
  `kode_gudang` varchar(255) NOT NULL,
  `qty_masuk` int NOT NULL,
  `qty_keluar` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mutasi_stok`
--

INSERT INTO `mutasi_stok` (`id`, `no_bukti`, `kode_brg`, `kode_gudang`, `qty_masuk`, `qty_keluar`) VALUES
(7, 'BL24-00001', 'A0090', 'M', 10, 0),
(8, 'BL24-00001', 'A0091', 'K', 15, 0),
(9, 'BL24-00002', 'A0012M', 'M', 20, 0),
(12, 'BL24-00003', 'A0095', 'M', 10, 0),
(13, 'JL24-00003', 'A0095', 'M', 0, 5),
(14, 'BL24-00004', 'A0095', 'M', 10, 0),
(15, 'BL24-00006', 'A001M', 'M', 2960, 0),
(16, 'BL24-00006', 'A0023', 'K', 105, 0),
(17, 'BL24-00006', 'A0012M', 'M', 300, 0),
(18, 'BL24-00006', 'A004M', 'M', 2186, 0),
(19, 'BL24-00006', 'A0087', 'M', 10, 0),
(20, 'BL24-00006', 'A008M', 'M', 12, 0),
(21, 'BL24-00007', 'A0099M', 'K', 25, 0),
(22, 'JL24-00005', 'A0099M', 'K', 0, 10),
(23, 'JL24-00006', 'A0099M', 'K', 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_person`
--

CREATE TABLE `sales_person` (
  `kode_sales` varchar(45) NOT NULL,
  `nama_sales` varchar(45) DEFAULT NULL,
  `divisi` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sales_person`
--

INSERT INTO `sales_person` (`kode_sales`, `nama_sales`, `divisi`) VALUES
('12B', 'EKA', 'RETAIL'),
('15', 'ULFA', 'RETAIL'),
('16', 'DESAK', 'FOOD'),
('17', 'ALDI', 'FOOD'),
('18', 'AGUSTA FS', 'FOOD');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id` int NOT NULL,
  `satuan` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id`, `satuan`) VALUES
(1, 'PCE'),
(2, 'PCK'),
(3, 'KG'),
(4, 'CTN');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `kode_supp` varchar(45) NOT NULL,
  `nama_supp` varchar(255) DEFAULT NULL,
  `bank` varchar(45) NOT NULL,
  `acc_bank` varchar(255) DEFAULT NULL,
  `alm_1` varchar(255) DEFAULT NULL,
  `alm_2` varchar(255) DEFAULT NULL,
  `kota` varchar(45) DEFAULT NULL,
  `negara` varchar(45) DEFAULT NULL,
  `kontak` varchar(45) DEFAULT NULL,
  `jabatan` varchar(45) DEFAULT NULL,
  `no_telp` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`kode_supp`, `nama_supp`, `bank`, `acc_bank`, `alm_1`, `alm_2`, `kota`, `negara`, `kontak`, `jabatan`, `no_telp`, `email`) VALUES
('AMBICO', 'AMBICO/PT', 'Permata', '4683801553', 'JL. DINOYO 35', 'SURABAYA, JAWA TIMUR 60265', 'SURABAYA', 'INDONESIA', 'IBU NATICA', '-', '0315675547', 'natica@ptambico.com'),
('ANEKA', 'PT. ANEKA KONSUMSI SELERA INTERNASIONAL (Big Farm)', 'Permata', '0189977788', 'KOMPLEKS PERGUDANGAN DAN INDUSTRI SAFE N LOCK G NO. 1570-1571', 'RANGKAHKIDUL, SIDOARJO - JAWA TIMUR', 'SIDOARJO', 'INDONESIA', 'BENNY', '-', '-', 'benyfirman@kansasid.com'),
('CLEANBEE', 'PT. PASTI KLIN INDONESIA', 'Permata', '4706558888', 'JALA KALIMAS BARAT NOMOR 57A RT.003 RW 009', 'KREMBANGAN UTARA, PABEAN CANTIAN', 'SURABAYA', 'INDONESIA', 'Pak Stanford', '-', '081999090333', 'pastiklin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Admin', 'admin@gmail.com', NULL, '$2y$10$USpx3P1NqC/fM3K73jgK8.lkvYTaqRe03.mXYn8.BQhBe/yLdT56G', NULL, '2024-05-04 18:49:44', '2024-05-04 18:49:44'),
(3, 'Daniel', 'daniel@gmail.com', NULL, '$2y$10$Bq3mqP6bbcp2NgpQqVzLA.kGO5QwK7FFiBBQEEPMgmD9JYHh0e1ie', NULL, '2024-05-31 04:09:29', '2024-05-31 04:09:29'),
(4, 'Budi', 'budi@gmail.com', NULL, '$2y$10$XU.XNpeG1JU3Lg0VMd0yxOc68xszgtuNlxtRy.AIhxZvJU7g573E6', NULL, '2024-06-02 09:17:44', '2024-06-02 09:17:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beli`
--
ALTER TABLE `beli`
  ADD PRIMARY KEY (`no_bukti`),
  ADD KEY `fk_beli_supplier1_idx` (`kode_supp`);

--
-- Indexes for table `beli_dtl`
--
ALTER TABLE `beli_dtl`
  ADD KEY `fk_beli_dtl_beli1_idx` (`no_bukti`),
  ADD KEY `fk_beli_dtl_satuan1_idx` (`id_satuan`),
  ADD KEY `fk_beli_dtl_invgudang1_idx` (`kirim_gudang`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`kode_cust`),
  ADD KEY `fk_customer_sales_person1_idx` (`kode_sales`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invdivisi`
--
ALTER TABLE `invdivisi`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `invgudang`
--
ALTER TABLE `invgudang`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `invjenis`
--
ALTER TABLE `invjenis`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `invmaster`
--
ALTER TABLE `invmaster`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_invmaster_invdivisi1_idx` (`kode_divisi`),
  ADD KEY `fk_invmaster_invtype1_idx` (`kode_type`),
  ADD KEY `fk_invmaster_invjenis1_idx` (`kode_jenis`),
  ADD KEY `fk_invmaster_invgudang1_idx` (`kode_gudang`),
  ADD KEY `fk_invmaster_satuan1_idx` (`id_satuan`);

--
-- Indexes for table `invtype`
--
ALTER TABLE `invtype`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `jual`
--
ALTER TABLE `jual`
  ADD PRIMARY KEY (`no_bukti`),
  ADD KEY `fk_jual_customer1_idx` (`kode_cust`);

--
-- Indexes for table `jual_dtl`
--
ALTER TABLE `jual_dtl`
  ADD KEY `fk_jual_dtl_jual1_idx` (`no_bukti`),
  ADD KEY `fk_jual_dtl_satuan1_idx` (`id_satuan`),
  ADD KEY `fk_jual_dtl_invgudang1_idx` (`kode_gudang`),
  ADD KEY `fk_jual_dtl_invmaster1_idx` (`id_brg`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mutasi_stok`
--
ALTER TABLE `mutasi_stok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `sales_person`
--
ALTER TABLE `sales_person`
  ADD PRIMARY KEY (`kode_sales`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`kode_supp`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invmaster`
--
ALTER TABLE `invmaster`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mutasi_stok`
--
ALTER TABLE `mutasi_stok`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `beli`
--
ALTER TABLE `beli`
  ADD CONSTRAINT `fk_beli_supplier1` FOREIGN KEY (`kode_supp`) REFERENCES `supplier` (`kode_supp`);

--
-- Constraints for table `beli_dtl`
--
ALTER TABLE `beli_dtl`
  ADD CONSTRAINT `fk_beli_dtl_beli1` FOREIGN KEY (`no_bukti`) REFERENCES `beli` (`no_bukti`),
  ADD CONSTRAINT `fk_beli_dtl_invgudang1` FOREIGN KEY (`kirim_gudang`) REFERENCES `invgudang` (`kode`),
  ADD CONSTRAINT `fk_beli_dtl_satuan1` FOREIGN KEY (`id_satuan`) REFERENCES `satuan` (`id`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `fk_customer_sales_person1` FOREIGN KEY (`kode_sales`) REFERENCES `sales_person` (`kode_sales`);

--
-- Constraints for table `invmaster`
--
ALTER TABLE `invmaster`
  ADD CONSTRAINT `fk_invmaster_invdivisi1` FOREIGN KEY (`kode_divisi`) REFERENCES `invdivisi` (`kode`),
  ADD CONSTRAINT `fk_invmaster_invgudang1` FOREIGN KEY (`kode_gudang`) REFERENCES `invgudang` (`kode`),
  ADD CONSTRAINT `fk_invmaster_invjenis1` FOREIGN KEY (`kode_jenis`) REFERENCES `invjenis` (`kode`),
  ADD CONSTRAINT `fk_invmaster_invtype1` FOREIGN KEY (`kode_type`) REFERENCES `invtype` (`kode`),
  ADD CONSTRAINT `fk_invmaster_satuan1` FOREIGN KEY (`id_satuan`) REFERENCES `satuan` (`id`);

--
-- Constraints for table `jual`
--
ALTER TABLE `jual`
  ADD CONSTRAINT `fk_jual_customer1` FOREIGN KEY (`kode_cust`) REFERENCES `customer` (`kode_cust`);

--
-- Constraints for table `jual_dtl`
--
ALTER TABLE `jual_dtl`
  ADD CONSTRAINT `fk_jual_dtl_invgudang1` FOREIGN KEY (`kode_gudang`) REFERENCES `invgudang` (`kode`),
  ADD CONSTRAINT `fk_jual_dtl_invmaster1` FOREIGN KEY (`id_brg`) REFERENCES `invmaster` (`id`),
  ADD CONSTRAINT `fk_jual_dtl_jual1` FOREIGN KEY (`no_bukti`) REFERENCES `jual` (`no_bukti`),
  ADD CONSTRAINT `fk_jual_dtl_satuan1` FOREIGN KEY (`id_satuan`) REFERENCES `satuan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
