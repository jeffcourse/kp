-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2024 at 06:57 PM
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
  `kirim_gudang` varchar(45) NOT NULL,
  `sub_total` float DEFAULT NULL,
  `persen_ppn` int DEFAULT NULL,
  `total` float DEFAULT NULL,
  `lunas` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `create_time` varchar(45) DEFAULT NULL,
  `author` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `beli`
--

INSERT INTO `beli` (`no_bukti`, `tanggal`, `jatuh_tempo`, `kode_supp`, `kirim_gudang`, `sub_total`, `persen_ppn`, `total`, `lunas`, `status`, `create_time`, `author`) VALUES
('BL24-00001', '22-05-2024', '22-06-2024', 'ANEKA', 'M', 1212000, 10, 1333200, 'Lunas', 'Belum Terkirim', '28-05-2024', 'Daniel'),
('BL24-00002', '28-05-2024', '28-06-2024', 'CLEANBEE', 'M', 728000, 10, 800800, 'Belum Lunas', 'Belum Terkirim', '28-05-2024', 'Daniel'),
('BL24-00003', '28-05-2024', '28-06-2024', 'ANEKA', 'M', 1080000, 10, 1188000, 'Belum Lunas', 'Belum Terkirim', '28-05-2024', 'Daniel');

-- --------------------------------------------------------

--
-- Table structure for table `beli_dtl`
--

CREATE TABLE `beli_dtl` (
  `no_bukti` varchar(45) NOT NULL,
  `kode_brg` varchar(255) DEFAULT NULL,
  `nama_brg` varchar(255) DEFAULT NULL,
  `qty_order` int DEFAULT NULL,
  `id_satuan` int NOT NULL,
  `hrg_per_unit` float DEFAULT NULL,
  `hrg_total` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `beli_dtl`
--

INSERT INTO `beli_dtl` (`no_bukti`, `kode_brg`, `nama_brg`, `qty_order`, `id_satuan`, `hrg_per_unit`, `hrg_total`) VALUES
('BL24-00003', 'WY100000002A', 'SRM Bread Sub Roll Wheat', 40, 4, 16000, 640000),
('BL24-00003', 'WY100000005', 'SRM Cookies Chocolate Chips', 11, 4, 20000, 220000),
('BL24-00003', 'WY10000000112A', 'SRM Mushroom Soup(30x350G)', 10, 4, 22000, 220000),
('BL24-00001', 'WY100000002A', 'SRM Bread Sub Roll Wheat', 40, 4, 15000, 600000),
('BL24-00001', 'WY100000005', 'SRM Cookies Chocolate Chips', 11, 4, 22000, 242000),
('BL24-00001', 'WY10000000112A', 'SRM Mushroom Soup(30x350G)', 10, 4, 22000, 220000),
('BL24-00001', 'WY1000000085', 'SRM Slice Black Olives Greci I', 5, 4, 30000, 150000),
('BL24-00002', 'WY5000000133', 'Garbage Bag Black 90cmX120', 33, 4, 14000, 462000),
('BL24-00002', 'WY5000000132', 'Garbage Bag Black 50cmX75', 2, 4, 16000, 32000),
('BL24-00002', 'WY5000000123', 'Wrapping Film 12', 13, 4, 18000, 234000);

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
  `alamat` varchar(500) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `invgudang`
--

INSERT INTO `invgudang` (`kode`, `nama`, `alamat`, `keterangan`) VALUES
('A', 'BARANG BAIK', '-', '-'),
('B', 'TITIP DI GUDANG LUAR', '-', '-'),
('E', 'BARANG EXPIRED', '-', '-'),
('F', 'BARANG FREE', '-', '-'),
('K', 'GUDANG KUTA', '-', '-'),
('M', 'GUDANG MAHE', 'Jl. Cargo Permai No. 22, Ubung, Denpasar Utara, Kota Denpasar', '-'),
('S', 'SAMPLE', '-', '-'),
('T', 'TOKO (NISSIN)', '-', '-'),
('X', 'BARANG RUSAK/EXP', '-', '-'),
('Z', 'SELISIH', '-', '-');

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
('A', 'AIRSHIP'),
('AC', 'AC'),
('C', 'CHILLED'),
('D', 'DRY'),
('F', 'FROZEN'),
('O', 'OTHER');

-- --------------------------------------------------------

--
-- Table structure for table `invmaster`
--

CREATE TABLE `invmaster` (
  `kode_brg` varchar(45) NOT NULL,
  `nama_brg` varchar(255) NOT NULL,
  `kode_divisi` varchar(45) NOT NULL,
  `kode_jenis` varchar(45) NOT NULL,
  `kode_type` varchar(45) NOT NULL,
  `packing` varchar(45) NOT NULL,
  `quantity` int NOT NULL,
  `id_satuan` int NOT NULL,
  `hrg_jual` float NOT NULL,
  `kode_gudang` varchar(45) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `invmaster`
--

INSERT INTO `invmaster` (`kode_brg`, `nama_brg`, `kode_divisi`, `kode_jenis`, `kode_type`, `packing`, `quantity`, `id_satuan`, `hrg_jual`, `kode_gudang`, `keterangan`) VALUES
('A0012M', 'Sanma L', 'J', 'F', 'JSFN', '55x7,5KG', 300, 1, 1594450, 'M', '-'),
('A001M', 'KIKKOMAN Shoyu 1,6LTR', 'J', 'D', 'K18L', '6x1,6LTR', 3038, 1, 594594, 'A', '23,6CMX33,5CMX31CM'),
('A0023', 'Chirimen Jako 1KG', 'L', 'F', 'LCSF', '6x1KG', 120, 2, 1583780, 'K', '-'),
('A004M', 'BULLDOG Tonkatsu Sauce 1,8LTR', 'J', 'D', 'PTDR', '6x1,8LTR', 2186, 1, 751350, 'M', '-'),
('A0087', 'Dorry Fillet Frozen 1KG', 'W', 'F', 'PTDR', '10x1KG', 10, 1, 650000, 'M', '-'),
('A008M', 'KIKKOMAN Sashimi Sauce 150ML', 'J', 'D', 'K18L', '12x150ML', 12, 1, 367572, 'M', '15,5CM X 20,5CM X 18CM');

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
  `status` varchar(45) NOT NULL,
  `create_time` varchar(45) DEFAULT NULL,
  `author` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jual`
--

INSERT INTO `jual` (`no_bukti`, `tanggal`, `jatuh_tempo`, `kode_cust`, `sub_total`, `persen_ppn`, `total`, `lunas`, `status`, `create_time`, `author`) VALUES
('JL24-00001', '22-05-2024', '22-06-2024', '07AM', 41000, 10, 45100, 'Lunas', 'Belum Terkirim', '22-05-2024', 'Budi'),
('JL24-00002', '05-06-2024', '05-07-2024', '07AM', 300000, 10, 330000, 'Belum Lunas', 'Belum Terkirim', '06-06-2024', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `jual_dtl`
--

CREATE TABLE `jual_dtl` (
  `no_bukti` varchar(45) NOT NULL,
  `kode_brg` varchar(255) DEFAULT NULL,
  `nama_brg` varchar(255) DEFAULT NULL,
  `qty_order` int DEFAULT NULL,
  `id_satuan` int NOT NULL,
  `hrg_per_unit` float DEFAULT NULL,
  `hrg_total` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jual_dtl`
--

INSERT INTO `jual_dtl` (`no_bukti`, `kode_brg`, `nama_brg`, `qty_order`, `id_satuan`, `hrg_per_unit`, `hrg_total`) VALUES
('JL24-00001', 'WY100000005', 'SRM Cookies Chocolate Chips', 2, 4, 18000, 36000),
('JL24-00001', 'WY100000085', 'SRM Slice Black Olives Greci I', 1, 4, 5000, 5000),
('JL24-00002', 'X005', 'XXX', 10, 1, 15000, 150000),
('JL24-00002', 'X007', 'YYY', 10, 1, 15000, 150000);

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

INSERT INTO `supplier` (`kode_supp`, `nama_supp`, `acc_bank`, `alm_1`, `alm_2`, `kota`, `negara`, `kontak`, `jabatan`, `no_telp`, `email`) VALUES
('AMBICO', 'AMBICO/PT', '4683801553', 'JL. DINOYO 35', 'SURABAYA, JAWA TIMUR 60265', 'SURABAYA', 'INDONESIA', 'IBU NATICA', '-', '0315675547', 'natica@ptambico.com'),
('ANEKA', 'PT. ANEKA KONSUMSI SELERA INTERNASIONAL (Big Farm)', '0189977788', 'KOMPLEKS PERGUDANGAN DAN INDUSTRI SAFE N LOCK G NO. 1570-1571', 'RANGKAHKIDUL, SIDOARJO - JAWA TIMUR', 'SIDOARJO', 'INDONESIA', 'BENNY', '-', '-', 'benyfirman@kansasid.com'),
('CLEANBEE', 'PT. PASTI KLIN INDONESIA', '4706558888', 'JALA KALIMAS BARAT NOMOR 57A RT.003 RW 009', 'KREMBANGAN UTARA, PABEAN CANTIAN', 'SURABAYA', 'INDONESIA', 'Pak Stanford', '-', '081999090333', 'pastiklin@gmail.com');

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
  ADD KEY `fk_beli_supplier1_idx` (`kode_supp`),
  ADD KEY `fk_beli_invgudang1_idx` (`kirim_gudang`);

--
-- Indexes for table `beli_dtl`
--
ALTER TABLE `beli_dtl`
  ADD KEY `fk_beli_dtl_beli1_idx` (`no_bukti`),
  ADD KEY `fk_beli_dtl_satuan1_idx` (`id_satuan`);

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
  ADD PRIMARY KEY (`kode_brg`),
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
  ADD KEY `fk_jual_dtl_satuan1_idx` (`id_satuan`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `fk_beli_invgudang1` FOREIGN KEY (`kirim_gudang`) REFERENCES `invgudang` (`kode`),
  ADD CONSTRAINT `fk_beli_supplier1` FOREIGN KEY (`kode_supp`) REFERENCES `supplier` (`kode_supp`);

--
-- Constraints for table `beli_dtl`
--
ALTER TABLE `beli_dtl`
  ADD CONSTRAINT `fk_beli_dtl_beli1` FOREIGN KEY (`no_bukti`) REFERENCES `beli` (`no_bukti`),
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
  ADD CONSTRAINT `fk_jual_dtl_jual1` FOREIGN KEY (`no_bukti`) REFERENCES `jual` (`no_bukti`),
  ADD CONSTRAINT `fk_jual_dtl_satuan1` FOREIGN KEY (`id_satuan`) REFERENCES `satuan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
