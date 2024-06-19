-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2024 at 02:14 AM
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
  `sub_total` decimal(17,2) DEFAULT NULL,
  `persen_ppn` int DEFAULT NULL,
  `total` decimal(17,2) DEFAULT NULL,
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
('BL24-00001', '13-06-2024', '13-07-2024', 'ANEKA', '36161460.00', 10, '39777606.00', 'Lunas', '13-06-2024', 'Sudah Terkirim', '14-06-2024', '13-06-2024', 'Admin'),
('BL24-00002', '14-06-2024', '14-07-2024', 'ANEKA', '7446175.00', 10, '8190792.50', 'Lunas', '14-06-2024', 'Sudah Terkirim', '15-06-2024', '14-06-2024', 'Admin'),
('BL24-00003', '14-06-2024', '14-07-2024', 'AMBICO', '1060809.60', 10, '1166890.56', 'Lunas', '15-06-2024', 'Sudah Terkirim', '16-06-2024', '14-06-2024', 'Admin'),
('BL24-00004', '14-06-2024', '14-07-2024', 'AMBICO', '3304049.80', 10, '3634454.78', 'Lunas', '14-06-2024', 'Sudah Terkirim', '14-06-2024', '14-06-2024', 'Admin'),
('BL24-00005', '14-06-2024', '14-07-2024', 'AMBICO', '864860.00', 10, '951346.00', 'Lunas', '15-06-2024', 'Sudah Terkirim', '16-06-2024', '14-06-2024', 'Admin'),
('BL24-00006', '14-06-2024', '14-07-2024', 'AMBICO', '2048922.00', 10, '2253814.20', 'Lunas', '16-06-2024', 'Belum Terkirim', '-', '14-06-2024', 'Admin'),
('BL24-00007', '14-06-2024', '14-07-2024', 'AMBICO', '345000.00', 10, '379500.00', 'Lunas', '14-06-2024', 'Sudah Terkirim', '14-06-2024', '14-06-2024', 'Admin'),
('BL24-00008', '15-06-2024', '15-07-2024', 'ANEKA', '7848700.00', 10, '8633570.00', 'Lunas', '15-06-2024', 'Sudah Terkirim', '15-06-2024', '15-06-2024', 'Admin'),
('BL24-00009', '19-06-2024', '19-07-2024', 'AMBICO', '850000.00', 10, '935000.00', 'Lunas', '19-06-2024', 'Sudah Terkirim', '19-06-2024', '19-06-2024', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `beli_dtl`
--

CREATE TABLE `beli_dtl` (
  `no_bukti` varchar(45) NOT NULL,
  `kode_brg` varchar(45) DEFAULT NULL,
  `nama_brg` varchar(255) DEFAULT NULL,
  `qty_order` int DEFAULT NULL,
  `id_satuan` int NOT NULL,
  `hrg_per_unit` float DEFAULT NULL,
  `hrg_total` float DEFAULT NULL,
  `kirim_gudang` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `beli_dtl`
--

INSERT INTO `beli_dtl` (`no_bukti`, `kode_brg`, `nama_brg`, `qty_order`, `id_satuan`, `hrg_per_unit`, `hrg_total`, `kirim_gudang`) VALUES
('BL24-00001', 'A0012M', 'Sanma L', 18, 1, 28990, 521820, 'M'),
('BL24-00001', 'A001M', 'KIKKOMAN Shoyu 1,6LTR', 40, 1, 99099, 3963960, 'M'),
('BL24-00001', 'A0023', 'Chirimen Jako 1KG', 120, 2, 263964, 31675700, 'K'),
('BL24-00002', 'A0096F', 'FILLET Salmon Tasman Headless', 30, 3, 155000, 4650000, 'K'),
('BL24-00002', 'A004R', 'BULLDOG Tonkatsu Sauce 1.5LTR (R)', 40, 1, 45495, 1819800, 'M'),
('BL24-00002', 'A0087R', 'Dorry Fillet Frozen (+/-200-250GR)', 125, 1, 7811, 976375, 'K'),
('BL24-00003', 'A015M', 'HIGASHIMARU Usukuchi Shoyu Bottle 1LTR', 15, 1, 35585.5, 533782, 'M'),
('BL24-00003', 'A028M', 'BULLDOG Worchestershire Sauce 300ML', 30, 1, 17567.6, 527027, 'M'),
('BL24-00004', 'A102M', 'EBARA Yakiniku No Tare Mild 300ML', 25, 1, 21171, 529275, 'K'),
('BL24-00004', 'A133', 'OTAFUKU Yakisoba Sauce Kokusai 2.15KG', 35, 1, 79279.3, 2774770, 'K'),
('BL24-00005', 'A123M', 'KIKKOMAN Teriyaki Grill Sauce 250ML', 40, 1, 21621.5, 864860, 'M'),
('BL24-00006', 'A156M', 'TIGER Oyster Sauce 280GR', 36, 1, 14414.5, 518922, 'M'),
('BL24-00006', 'A17F', 'Salmon Norway Fillet Import', 12, 3, 127500, 1530000, 'K'),
('BL24-00007', 'A0042', 'Fresh Salmon IMPORT - N', 15, 3, 23000, 345000, 'K'),
('BL24-00008', 'A181M', 'KIKKOMAN Shoyu (Mild Aroma) 18LTR', 10, 4, 285135, 2851350, 'M'),
('BL24-00008', 'A18A', 'Fresh Salmon TASMANIA', 5, 3, 119600, 598000, 'K'),
('BL24-00008', 'A0012M', 'Sanma L', 19, 1, 25000, 475000, 'M'),
('BL24-00001', 'A0012M', 'Sanma L', 18, 1, 28990, 521820, 'M'),
('BL24-00001', 'A001M', 'KIKKOMAN Shoyu 1,6LTR', 40, 1, 99099, 3963960, 'M'),
('BL24-00001', 'A0023', 'Chirimen Jako 1KG', 120, 2, 263964, 31675700, 'K'),
('BL24-00002', 'A0096F', 'FILLET Salmon Tasman Headless', 30, 3, 155000, 4650000, 'K'),
('BL24-00002', 'A004R', 'BULLDOG Tonkatsu Sauce 1.5LTR (R)', 40, 1, 45495, 1819800, 'M'),
('BL24-00002', 'A0087R', 'Dorry Fillet Frozen (+/-200-250GR)', 125, 1, 7811, 976375, 'K'),
('BL24-00003', 'A015M', 'HIGASHIMARU Usukuchi Shoyu Bottle 1LTR', 15, 1, 35585.5, 533782, 'M'),
('BL24-00003', 'A028M', 'BULLDOG Worchestershire Sauce 300ML', 30, 1, 17567.6, 527027, 'M'),
('BL24-00004', 'A102M', 'EBARA Yakiniku No Tare Mild 300ML', 25, 1, 21171, 529275, 'K'),
('BL24-00004', 'A133', 'OTAFUKU Yakisoba Sauce Kokusai 2.15KG', 35, 1, 79279.3, 2774770, 'K'),
('BL24-00005', 'A123M', 'KIKKOMAN Teriyaki Grill Sauce 250ML', 40, 1, 21621.5, 864860, 'M'),
('BL24-00006', 'A156M', 'TIGER Oyster Sauce 280GR', 36, 1, 14414.5, 518922, 'M'),
('BL24-00006', 'A17F', 'Salmon Norway Fillet Import', 12, 3, 127500, 1530000, 'K'),
('BL24-00007', 'A0042', 'Fresh Salmon IMPORT - N', 15, 3, 23000, 345000, 'K'),
('BL24-00008', 'A181M', 'KIKKOMAN Shoyu (Mild Aroma) 18LTR', 10, 4, 285135, 2851350, 'M'),
('BL24-00008', 'A18A', 'Fresh Salmon TASMANIA', 5, 3, 119600, 598000, 'K'),
('BL24-00008', 'A0012M', 'Sanma L', 19, 1, 25000, 475000, 'M'),
('BL24-00009', 'A0012M', 'Sanma L', 10, 1, 34000, 340000, 'K'),
('BL24-00009', 'A0035M', 'EBARA Sukiyaki 1.5LTR (R)', 30, 1, 17000, 510000, 'M');

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
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `quantity` int NOT NULL,
  `id_satuan` int NOT NULL,
  `hrg_jual` float DEFAULT NULL,
  `kode_gudang` varchar(45) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `invmaster`
--

INSERT INTO `invmaster` (`id`, `kode_brg`, `nama_brg`, `kode_divisi`, `kode_jenis`, `kode_type`, `quantity`, `id_satuan`, `hrg_jual`, `kode_gudang`, `keterangan`) VALUES
(53, 'A0012M', 'Sanma L', 'J', 'F', 'JSFN', 14, 1, 41672.1, 'M', '-'),
(54, 'A001M', 'KIKKOMAN Shoyu 1,6LTR', 'J', 'D', 'K18L', 36, 1, 148648, 'M', '-'),
(55, 'A0023', 'Chirimen Jako 1KG', 'L', 'F', 'LCSF', 118, 2, 395946, 'K', '-'),
(57, 'A0096F', 'FILLET Salmon Tasman Headless', 'W', 'C', 'SLMN', 25, 3, 232500, 'K', '-'),
(58, 'A004R', 'BULLDOG Tonkatsu Sauce 1.5LTR (R)', 'J', 'D', 'PTDR', 30, 1, 68242.5, 'M', '-'),
(59, 'A0087R', 'Dorry Fillet Frozen (+/-200-250GR)', 'J', 'F', 'JSFN', 105, 1, 11716.5, 'K', '-'),
(60, 'A102M', 'EBARA Yakiniku No Tare Mild 300ML', 'J', 'D', 'PTDR', 15, 1, 31756.5, 'K', '-'),
(61, 'A133', 'OTAFUKU Yakisoba Sauce Kokusai 2.15KG', 'J', 'D', 'PTDR', 25, 1, 118919, 'K', '-'),
(62, 'A0023', 'Chirimen Jako 1KG', 'L', 'F', 'LCSF', 2, 2, 0, 'K', 'BARANG RUSAK'),
(63, 'A015M', 'HIGASHIMARU Usukuchi Shoyu Bottle 1LTR', 'J', 'D', 'PTDR', 15, 1, 53378.2, 'M', '-'),
(64, 'A028M', 'BULLDOG Worchestershire Sauce 300ML', 'W', 'D', 'PTDR', 25, 1, 26351.3, 'M', '-'),
(65, 'A123M', 'KIKKOMAN Teriyaki Grill Sauce 250ML', 'J', 'D', 'K18L', 28, 1, 32432.2, 'M', '-'),
(66, 'A0042', 'Fresh Salmon IMPORT - N', 'W', 'C', 'SLMN', 10, 3, 34500, 'K', '-'),
(67, 'A181M', 'KIKKOMAN Shoyu (Mild Aroma) 18LTR', 'J', 'D', 'K18L', 4, 4, 427702, 'M', '-'),
(68, 'A18A', 'Fresh Salmon TASMANIA', 'W', 'C', 'SLMN', 5, 3, 179400, 'K', '-'),
(69, 'A001M', 'KIKKOMAN Shoyu 1,6LTR', 'J', 'D', 'K18L', 2, 1, 0, 'M', 'BARANG EXPIRED'),
(70, 'A0012M', 'Sanma L', 'J', 'F', 'JSFN', 10, 1, 41672.1, 'K', '-'),
(71, 'A0035M', 'EBARA Sukiyaki 1.5LTR (R)', 'J', 'D', 'PTDR', 30, 1, 25500, 'M', '-');

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
  `sub_total` decimal(17,2) DEFAULT NULL,
  `persen_ppn` int DEFAULT NULL,
  `total` decimal(17,2) DEFAULT NULL,
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
('JL24-00001', '13-06-2024', '13-07-2024', '104 BAR', '434850.00', 10, '478335.00', 'Lunas', '15-06-2024', 'Sudah Terkirim', '15-06-2024', '13-06-2024', 'Admin'),
('JL24-00002', '13-06-2024', '13-07-2024', '88SUNARI', '217425.00', 10, '239167.50', 'Lunas', '14-06-2024', 'Sudah Terkirim', '15-06-2024', '13-06-2024', 'Admin'),
('JL24-00003', '14-06-2024', '14-07-2024', '104 BAR', '1844925.00', 10, '2029417.50', 'Lunas', '15-06-2024', 'Sudah Terkirim', '15-06-2024', '14-06-2024', 'Admin'),
('JL24-00004', '14-06-2024', '14-07-2024', '88SUNARI', '1506755.00', 10, '1657430.50', 'Lunas', '16-06-2024', 'Sudah Terkirim', '16-06-2024', '14-06-2024', 'Admin'),
('JL24-00005', '15-06-2024', '15-07-2024', '104 BAR', '755272.90', 10, '830800.19', 'Lunas', '15-06-2024', 'Sudah Terkirim', '15-06-2024', '15-06-2024', 'Admin'),
('JL24-00006', '19-06-2024', '19-07-2024', '104 BAR', '3071312.80', 10, '3378444.08', 'Lunas', '19-06-2024', 'Sudah Terkirim', '19-06-2024', '19-06-2024', 'Admin');

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
('JL24-00001', 53, 'A0012M', 'Sanma L', 10, 1, 43485, 434850, 'M'),
('JL24-00002', 53, 'A0012M', 'Sanma L', 5, 1, 43485, 217425, 'M'),
('JL24-00003', 57, 'A0096F', 'FILLET Salmon Tasman Headless', 5, 3, 232500, 1162500, 'K'),
('JL24-00003', 58, 'A004R', 'BULLDOG Tonkatsu Sauce 1.5LTR (R)', 10, 1, 68242.5, 682425, 'M'),
('JL24-00004', 60, 'A102M', 'EBARA Yakiniku No Tare Mild 300ML', 10, 1, 31756.5, 317565, 'K'),
('JL24-00004', 61, 'A133', 'OTAFUKU Yakisoba Sauce Kokusai 2.15KG', 10, 1, 118919, 1189190, 'K'),
('JL24-00005', 59, 'A0087R', 'Dorry Fillet Frozen (+/-200-250GR)', 20, 1, 11716.5, 234330, 'K'),
('JL24-00005', 64, 'A028M', 'BULLDOG Worchestershire Sauce 300ML', 5, 1, 26351.3, 131756, 'M'),
('JL24-00005', 65, 'A123M', 'KIKKOMAN Teriyaki Grill Sauce 250ML', 12, 1, 32432.2, 389186, 'M'),
('JL24-00001', 53, 'A0012M', 'Sanma L', 10, 1, 43485, 434850, 'M'),
('JL24-00002', 53, 'A0012M', 'Sanma L', 5, 1, 43485, 217425, 'M'),
('JL24-00003', 57, 'A0096F', 'FILLET Salmon Tasman Headless', 5, 3, 232500, 1162500, 'K'),
('JL24-00003', 58, 'A004R', 'BULLDOG Tonkatsu Sauce 1.5LTR (R)', 10, 1, 68242.5, 682425, 'M'),
('JL24-00004', 60, 'A102M', 'EBARA Yakiniku No Tare Mild 300ML', 10, 1, 31756.5, 317565, 'K'),
('JL24-00004', 61, 'A133', 'OTAFUKU Yakisoba Sauce Kokusai 2.15KG', 10, 1, 118919, 1189190, 'K'),
('JL24-00005', 59, 'A0087R', 'Dorry Fillet Frozen (+/-200-250GR)', 20, 1, 11716.5, 234330, 'K'),
('JL24-00005', 64, 'A028M', 'BULLDOG Worchestershire Sauce 300ML', 5, 1, 26351.3, 131756, 'M'),
('JL24-00005', 65, 'A123M', 'KIKKOMAN Teriyaki Grill Sauce 250ML', 12, 1, 32432.2, 389186, 'M'),
('JL24-00006', 53, 'A0012M', 'Sanma L', 8, 1, 41575.1, 332601, 'M'),
('JL24-00006', 66, 'A0042', 'Fresh Salmon IMPORT - N', 5, 3, 34500, 172500, 'K'),
('JL24-00006', 67, 'A181M', 'KIKKOMAN Shoyu (Mild Aroma) 18LTR', 6, 4, 427702, 2566210, 'M');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `tanggal` date NOT NULL,
  `kode_brg` varchar(255) NOT NULL,
  `nama_brg` varchar(255) NOT NULL,
  `id_satuan` int DEFAULT NULL,
  `kode_gudang` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `stok_awal` int NOT NULL,
  `qty_masuk` int NOT NULL,
  `qty_keluar` int NOT NULL,
  `qty_rusak_exp` int NOT NULL,
  `stok_akhir` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mutasi_stok`
--

INSERT INTO `mutasi_stok` (`id`, `no_bukti`, `tanggal`, `kode_brg`, `nama_brg`, `id_satuan`, `kode_gudang`, `stok_awal`, `qty_masuk`, `qty_keluar`, `qty_rusak_exp`, `stok_akhir`) VALUES
(40, 'BL24-00001', '2024-06-14', 'A0012M', 'Sanma L', 1, 'M', 0, 18, 0, 0, 18),
(41, 'BL24-00001', '2024-06-14', 'A001M', 'KIKKOMAN Shoyu 1,6LTR', 1, 'M', 0, 40, 0, 0, 40),
(42, 'BL24-00001', '2024-06-14', 'A0023', 'Chirimen Jako 1KG', 2, 'K', 0, 120, 0, 0, 120),
(43, 'JL24-00001', '2024-06-15', 'A0012M', 'Sanma L', 1, 'M', 18, 0, 10, 0, 8),
(44, 'JL24-00002', '2024-06-15', 'A0012M', 'Sanma L', 1, 'M', 8, 0, 5, 0, 3),
(45, '-', '2024-06-14', 'A001M', 'KIKKOMAN Shoyu 1,6LTR', 1, 'M', 40, 0, 0, 2, 38),
(46, 'BL24-00002', '2024-06-15', 'A0096F', 'FILLET Salmon Tasman Headless', 3, 'K', 0, 30, 0, 0, 30),
(47, 'BL24-00002', '2024-06-15', 'A004R', 'BULLDOG Tonkatsu Sauce 1.5LTR (R)', 1, 'M', 0, 40, 0, 0, 40),
(48, 'BL24-00002', '2024-06-15', 'A0087R', 'Dorry Fillet Frozen (+/-200-250GR)', 1, 'K', 0, 125, 0, 0, 125),
(49, 'JL24-00003', '2024-06-15', 'A0096F', 'FILLET Salmon Tasman Headless', 3, 'K', 30, 0, 5, 0, 25),
(50, 'JL24-00003', '2024-06-15', 'A004R', 'BULLDOG Tonkatsu Sauce 1.5LTR (R)', 1, 'M', 40, 0, 10, 0, 30),
(51, 'BL24-00004', '2024-06-14', 'A102M', 'EBARA Yakiniku No Tare Mild 300ML', 1, 'K', 0, 25, 0, 0, 25),
(52, 'BL24-00004', '2024-06-14', 'A133', 'OTAFUKU Yakisoba Sauce Kokusai 2.15KG', 1, 'K', 0, 35, 0, 0, 35),
(53, 'JL24-00004', '2024-06-16', 'A102M', 'EBARA Yakiniku No Tare Mild 300ML', 1, 'K', 25, 0, 10, 0, 15),
(54, 'JL24-00004', '2024-06-16', 'A133', 'OTAFUKU Yakisoba Sauce Kokusai 2.15KG', 1, 'K', 35, 0, 10, 0, 25),
(55, '-', '2024-06-14', 'A0023', 'Chirimen Jako 1KG', 2, 'K', 120, 0, 0, 2, 118),
(56, 'BL24-00003', '2024-06-16', 'A015M', 'HIGASHIMARU Usukuchi Shoyu Bottle 1LTR', 1, 'M', 0, 15, 0, 0, 15),
(57, 'BL24-00003', '2024-06-15', 'A028M', 'BULLDOG Worchestershire Sauce 300ML', 1, 'M', 0, 30, 0, 0, 30),
(58, 'BL24-00005', '2024-06-16', 'A123M', 'KIKKOMAN Teriyaki Grill Sauce 250ML', 1, 'M', 0, 40, 0, 0, 40),
(61, 'BL24-00007', '2024-06-14', 'A0042', 'Fresh Salmon IMPORT - N', 3, 'K', 0, 15, 0, 0, 15),
(62, 'BL24-00008', '2024-06-15', 'A181M', 'KIKKOMAN Shoyu (Mild Aroma) 18LTR', 4, 'M', 0, 10, 0, 0, 10),
(63, 'BL24-00008', '2024-06-15', 'A18A', 'Fresh Salmon TASMANIA', 3, 'K', 0, 5, 0, 0, 5),
(64, 'BL24-00008', '2024-06-15', 'A0012M', 'Sanma L', 1, 'M', 3, 19, 0, 0, 22),
(65, 'JL24-00005', '2024-06-15', 'A0087R', 'Dorry Fillet Frozen (+/-200-250GR)', 1, 'K', 125, 0, 20, 0, 105),
(66, 'JL24-00005', '2024-06-15', 'A028M', 'BULLDOG Worchestershire Sauce 300ML', 1, 'M', 30, 0, 5, 0, 25),
(67, 'JL24-00005', '2024-06-15', 'A123M', 'KIKKOMAN Teriyaki Grill Sauce 250ML', 1, 'M', 40, 0, 12, 0, 28),
(68, '-', '2024-06-16', 'A001M', 'KIKKOMAN Shoyu 1,6LTR', 1, 'M', 38, 0, 0, 2, 36),
(69, 'BL24-00009', '2024-06-19', 'A0012M', 'Sanma L', 1, 'K', 0, 10, 0, 0, 10),
(70, 'BL24-00009', '2024-06-19', 'A0035M', 'EBARA Sukiyaki 1.5LTR (R)', 1, 'M', 0, 30, 0, 0, 30),
(71, 'JL24-00006', '2024-06-19', 'A0012M', 'Sanma L', 1, 'M', 22, 0, 8, 0, 14),
(72, 'JL24-00006', '2024-06-19', 'A0042', 'Fresh Salmon IMPORT - N', 3, 'K', 15, 0, 5, 0, 10),
(73, 'JL24-00006', '2024-06-19', 'A181M', 'KIKKOMAN Shoyu (Mild Aroma) 18LTR', 4, 'M', 10, 0, 6, 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `opname_stok`
--

CREATE TABLE `opname_stok` (
  `id` int NOT NULL,
  `tanggal` varchar(45) DEFAULT NULL,
  `kode_brg` varchar(45) DEFAULT NULL,
  `nama_brg` varchar(255) DEFAULT NULL,
  `id_satuan` int NOT NULL,
  `kode_gudang` varchar(45) NOT NULL,
  `qty_sistem` int DEFAULT NULL,
  `qty_fisik` int DEFAULT NULL,
  `selisih` int DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `opname_stok`
--

INSERT INTO `opname_stok` (`id`, `tanggal`, `kode_brg`, `nama_brg`, `id_satuan`, `kode_gudang`, `qty_sistem`, `qty_fisik`, `selisih`, `keterangan`) VALUES
(1, '14-06-2024', 'A001M', 'KIKKOMAN Shoyu 1,6LTR', 1, 'M', 40, 38, -2, 'BARANG RUSAK'),
(2, '14-06-2024', 'A0023', 'Chirimen Jako 1KG', 2, 'K', 120, 118, -2, 'BARANG RUSAK'),
(3, '16-06-2024', 'A001M', 'KIKKOMAN Shoyu 1,6LTR', 1, 'M', 38, 36, -2, 'BARANG EXPIRED'),
(9, '17-06-2024', 'A0012M', 'Sanma L', 1, 'M', 25, 23, -2, 'SALAH PENCATATAN'),
(10, '19-06-2024', 'A0012M', 'Sanma L', 1, 'M', 15, 14, -1, 'SALAH PENCATATAN');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mutasi_stok_satuan1_idx` (`id_satuan`),
  ADD KEY `fk_mutasi_stok_invgudang1_idx` (`kode_gudang`);

--
-- Indexes for table `opname_stok`
--
ALTER TABLE `opname_stok`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_opname_stok_invgudang1_idx` (`kode_gudang`),
  ADD KEY `fk_opname_stok_satuan1_idx` (`id_satuan`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mutasi_stok`
--
ALTER TABLE `mutasi_stok`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `opname_stok`
--
ALTER TABLE `opname_stok`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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

--
-- Constraints for table `mutasi_stok`
--
ALTER TABLE `mutasi_stok`
  ADD CONSTRAINT `fk_mutasi_stok_invgudang1` FOREIGN KEY (`kode_gudang`) REFERENCES `invgudang` (`kode`),
  ADD CONSTRAINT `fk_mutasi_stok_satuan1` FOREIGN KEY (`id_satuan`) REFERENCES `satuan` (`id`);

--
-- Constraints for table `opname_stok`
--
ALTER TABLE `opname_stok`
  ADD CONSTRAINT `fk_opname_stok_invgudang1` FOREIGN KEY (`kode_gudang`) REFERENCES `invgudang` (`kode`),
  ADD CONSTRAINT `fk_opname_stok_satuan1` FOREIGN KEY (`id_satuan`) REFERENCES `satuan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
