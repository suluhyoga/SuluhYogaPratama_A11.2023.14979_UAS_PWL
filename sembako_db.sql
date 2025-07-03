-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2025 at 02:33 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sembako_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) UNSIGNED NOT NULL,
  `kategori` varchar(200) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `kategori`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'BERAS', 'beras.jpg', '2025-06-09 02:04:16', NULL),
(2, 'MINYAK GORENG', 'minyakgoreng.jpg', '2025-06-09 02:04:16', NULL),
(3, 'GULA PASIR', 'gulapasir.jpg', '2025-06-09 02:04:16', NULL),
(4, 'MIE INSTAN', 'mieinstan.jpg', '2025-06-09 02:04:16', NULL),
(5, 'KECAP', 'kecap.jpg', '2025-06-09 02:04:16', NULL),
(6, 'SARDEN', 'sarden.jpg', '2025-06-09 02:04:16', NULL),
(7, 'TEH', 'teh.jpg', '2025-06-09 02:04:16', NULL),
(8, 'SIRUP', '1749561195_89605742d3217d8f71ef.jpg', '2025-06-09 02:04:16', '2025-06-10 13:13:15');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `nama`, `alamat`, `email`, `pesan`, `created_at`) VALUES
(1, 'Suluh Yoga Pratama', 'Ngampin Garung RT 03 RW 06', '1112314979@gmail.com', 'Uji Coba Mantap Bossku', '2025-06-08 13:22:49'),
(4, 'Rizal', 'JL Bayu Prasetya', 'rizal@gmail.com', 'Sembakoku merupakan web yang sangat berguna', '2025-06-10 05:14:00'),
(5, 'KAIII', 'ambarawa', 'kai@gmail.com', 'lopyu yogaaa', '2025-06-10 05:40:30'),
(6, 'Waull', 'Genuk', 'waul@gmail.com', 'beliin kerang 5 meterr', '2025-06-10 05:41:13'),
(7, 'Apip', 'Demak', 'ipeh@gmail.com', 'APIP DAN IPEH POREPERR', '2025-06-10 05:41:42'),
(8, 'IGDO', 'kariadi', 'igdo@gmail.com', 'joss gandoss', '2025-06-10 12:27:37'),
(9, 'AJAM IJUDIN', 'Pemalang ngalor', 'ijudin@gmail.com', 'inyong kecot', '2025-06-10 12:28:14'),
(10, 'azzam', 'pemalang', 'azzam@gmail.com', 'wokeee', '2025-06-10 12:57:06');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_produk` int(11) UNSIGNED NOT NULL,
  `qty` int(5) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2025-06-08-132729', 'App\\Database\\Migrations\\User', 'default', 'App', 1749389302, 1),
(2, '2025-06-09-015554', 'App\\Database\\Migrations\\Category', 'default', 'App', 1749434528, 2),
(3, '2025-06-09-015605', 'App\\Database\\Migrations\\Product', 'default', 'App', 1749434528, 2),
(4, '2025-06-12-173433', 'App\\Database\\Migrations\\Keranjang', 'default', 'App', 1751262618, 3),
(5, '2025-06-30-054918', 'App\\Database\\Migrations\\Transaction', 'default', 'App', 1751262618, 3),
(6, '2025-06-30-054930', 'App\\Database\\Migrations\\TransactionDetail', 'default', 'App', 1751262618, 3);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` double NOT NULL,
  `satuan` varchar(100) NOT NULL,
  `kategori_id` int(11) UNSIGNED NOT NULL,
  `jumlah` int(5) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `nama`, `harga`, `satuan`, `kategori_id`, `jumlah`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'BERAS PANDAN WANGI', 19000, 'kg', 1, 18, 'beras_pandanwangi.jpg', '2025-06-09 03:57:17', '2025-06-10 13:03:12'),
(2, 'BERAS ROJO LELE', 15000, 'kg', 1, 25, 'beras_rojolele.jpg', '2025-06-09 03:57:17', NULL),
(3, 'BERAS MENTIK WANGI', 14000, 'kg', 1, 20, 'beras_mentikwangi.jpg', '2025-06-09 03:57:17', NULL),
(4, 'BERAS IR64', 16000, 'kg', 1, 23, 'beras_ir64.jpg', '2025-06-09 03:57:17', NULL),
(5, 'MINYAK HEMART', 19000, 'liter', 2, 30, 'minyakgoreng_hemart.jpg', '2025-06-09 03:57:17', NULL),
(6, 'MINYAK BIMOLI', 23000, 'liter', 2, 35, 'minyakgoreng_bimoli.jpg', '2025-06-09 03:57:17', NULL),
(7, 'MINYAK RIZKI', 18000, 'liter', 2, 32, 'minyakgoreng_rizki.jpg', '2025-06-09 03:57:17', NULL),
(8, 'MINYAK FORTUNE', 21000, 'liter', 2, 28, 'minyakgoreng_fortune.jpg', '2025-06-09 03:57:17', NULL),
(9, 'GULA GULAKU', 26000, 'kg', 3, 17, 'gulapasir_gulaku.jpg', '2025-06-09 03:57:17', NULL),
(10, 'GULA ROSEBRAND', 22000, 'kg', 3, 19, 'gulapasir_rosebrand.jpg', '2025-06-09 03:57:17', NULL),
(11, 'GULA GUAVIT', 20000, 'kg', 3, 14, 'gulapasir_guavit.jpg', '2025-06-09 03:57:17', NULL),
(12, 'MIE KUAH ABC', 125000, 'kardus', 4, 10, 'mieinstan_abc.jpg', '2025-06-09 03:57:17', NULL),
(13, 'MIE KUAH SUPERMI', 120000, 'kardus', 4, 8, 'mieinstan_supermie.jpg', '2025-06-09 03:57:17', NULL),
(14, 'MIE KUAH INDOMIE', 120000, 'kardus', 4, 13, 'mieinstan_indomie.jpg', '2025-06-09 03:57:17', NULL),
(15, 'MIE KUAH SEDAAP', 123000, 'kardus', 4, 12, 'mieinstan_sedap.jpg', '2025-06-09 03:57:17', NULL),
(16, 'KECAP MANIS ABC', 12500, 'botol (275ml)', 5, 42, 'kecap_abc.jpg', '2025-06-09 12:06:17', '0000-00-00 00:00:00'),
(17, 'KECAP ASIN BANGO', 13000, 'botol (275ml)', 5, 45, 'kecap_bango.jpg', '2025-06-09 12:10:59', '0000-00-00 00:00:00'),
(18, 'KECAP MANIS INDOFOOD', 10500, 'botol (275ml)', 5, 48, 'kecap_indofood.jpg', '2025-06-09 12:12:36', '0000-00-00 00:00:00'),
(19, 'KECAP MANIS BOROBUDUR', 11000, 'botol (275ml)', 5, 40, 'kecap_borobudur.jpg', '2025-06-09 12:14:01', '0000-00-00 00:00:00'),
(20, 'ABS SAUS TOMAT', 11000, 'kaleng (155g)', 6, 30, 'sarden_abc.jpg', '2025-06-09 12:21:34', '0000-00-00 00:00:00'),
(21, 'BOTAN PEDAS GURIH', 12000, 'kaleng (155g)', 6, 37, 'sarden_botan.jpg', '2025-06-09 12:22:36', '0000-00-00 00:00:00'),
(22, 'PRONAS SAUS CABAI', 10500, 'kaleng (155g)', 6, 34, 'sarden_pronas.jpg', '2025-06-09 12:23:28', '0000-00-00 00:00:00'),
(23, 'KING\'S FISHER TOMAT', 13000, 'kaleng (155g)', 6, 36, 'sarden_kingsfisher.jpg', '2025-06-09 12:24:24', '0000-00-00 00:00:00'),
(24, 'MARJAN MELON', 26000, 'botol (460ml)', 8, 25, 'sirup_marjanmelon.jpg', '2025-06-09 12:25:34', '0000-00-00 00:00:00'),
(25, 'ABC JERUK', 17000, 'botol (460ml)', 8, 38, 'sirup_abc.jpg', '2025-06-09 12:29:45', '0000-00-00 00:00:00'),
(27, 'INDOFOOD JERUK', 20000, 'botol (460ml)', 8, 29, 'sirup_indofood.jpg', '2025-06-09 12:31:23', '0000-00-00 00:00:00'),
(28, 'MARJAN COCOPANDAN', 21000, 'botol(460ml)', 8, 29, 'sirup_marjancocopandan.jpg', '2025-06-09 12:34:35', '0000-00-00 00:00:00'),
(29, 'SARIWANGI HITAM', 8000, 'box', 7, 18, 'teh_sariwangi.jpg', '2025-06-09 12:42:13', '0000-00-00 00:00:00'),
(30, 'TONG TJI HIJAU', 25000, 'box', 7, 28, 'teh_tongtjihijau.jpg', '2025-06-09 12:42:50', '0000-00-00 00:00:00'),
(31, 'TONG TJI MELATI', 8000, 'box', 7, 17, 'teh_tongtji.jpg', '2025-06-09 12:43:34', '0000-00-00 00:00:00'),
(32, 'MUSTIKA RATU HERBAL', 30000, 'box', 7, 20, 'teh_mustikaratu.jpg', '2025-06-09 12:44:28', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `total_harga` double NOT NULL,
  `alamat` text NOT NULL,
  `ongkir` double DEFAULT NULL,
  `status` int(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `username`, `total_harga`, `alamat`, `ongkir`, `status`, `created_at`, `updated_at`) VALUES
(4, 'ahmad', 61000, 'JL Bayu Prasetya Timur Raya', 25000, 0, '2025-06-30 13:41:52', '2025-06-30 13:41:52'),
(5, 'ahmad', 423000, 'JL Bayu Prasetya Timur Raya', 400000, 0, '2025-06-30 13:48:46', '2025-06-30 13:48:46'),
(6, 'ahmad', 120000, 'JL Bayu Prasetya Timur Raya', 25000, 0, '2025-06-30 13:52:05', '2025-06-30 13:52:05'),
(7, 'ahmad', 45000, 'akdakdakd', 25000, 0, '2025-06-30 13:53:13', '2025-06-30 13:53:13'),
(8, 'ahmad', 147000, 'JL Bayu Prasetya Timur Raya', 11000, 0, '2025-06-30 13:55:21', '2025-06-30 13:55:21'),
(9, 'ahmad', 41000, 'JL Bayu Prasetya Timur Raya', 11000, 0, '2025-06-30 14:26:02', '2025-06-30 14:26:02'),
(10, 'ahmad', 34000, 'JL Bayu Prasetya Timur Raya', 11000, 0, '2025-06-30 14:28:18', '2025-06-30 14:28:18');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_detail`
--

CREATE TABLE `transaction_detail` (
  `id` int(11) UNSIGNED NOT NULL,
  `transaction_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `jumlah` int(5) NOT NULL,
  `diskon` double DEFAULT NULL,
  `subtotal_harga` double NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_detail`
--

INSERT INTO `transaction_detail` (`id`, `transaction_id`, `product_id`, `jumlah`, `diskon`, `subtotal_harga`, `created_at`, `updated_at`) VALUES
(6, 4, 20, 1, 0, 11000, '2025-06-30 13:41:52', '2025-06-30 13:41:52'),
(7, 4, 30, 1, 0, 25000, '2025-06-30 13:41:52', '2025-06-30 13:41:52'),
(8, 5, 6, 1, 0, 23000, '2025-06-30 13:48:46', '2025-06-30 13:48:46'),
(9, 6, 1, 5, 0, 95000, '2025-06-30 13:52:05', '2025-06-30 13:52:05'),
(10, 7, 11, 1, 0, 20000, '2025-06-30 13:53:13', '2025-06-30 13:53:13'),
(11, 8, 29, 2, 0, 16000, '2025-06-30 13:55:21', '2025-06-30 13:55:21'),
(12, 8, 14, 1, 0, 120000, '2025-06-30 13:55:21', '2025-06-30 13:55:21'),
(13, 9, 2, 2, 0, 30000, '2025-06-30 14:26:02', '2025-06-30 14:26:02'),
(14, 10, 6, 1, 0, 23000, '2025-06-30 14:28:18', '2025-06-30 14:28:18');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'rizal', 'rizalram100@gmail.com', '$2y$12$MYLTC166RyYKyxBALszBuOjSAxqb4df8dJgwXaTFSodeG6llfr9dy', 'admin', '2025-06-08 13:31:09', '2025-06-10 12:04:46'),
(2, 'ajimin.anggriawan', 'hasan10@yahoo.com', '$2y$12$8GavjGWo91DEJ3nNPIgm/.Z2ETVgqhFPnZQd5jcRh.xlVK3VUqwCa', 'admin', '2025-06-08 13:31:09', NULL),
(3, 'irsad75', 'diah.sitompul@gunarto.go.id', '$2y$12$a/ZKILAF3QsShsxNuPCp5evP7vH/Vmrwin7d/BKpcsuf.sd3WWHoy', 'admin', '2025-06-08 13:31:09', NULL),
(4, 'ahmad', 'ahmad@gmail.com\r\n', '$2y$12$WgpN4OtGiVtKMwGuujg8SuW7FmVZmAMYF6euSBUFqFghG9C9v0vRa', 'guest', '2025-06-08 13:31:10', NULL),
(5, 'fitriani20', 'csamosir@anggraini.co', '$2y$12$.jrFjOp59Z61Rl.KiJTYBOtRZRnrWZxddiLvV/vN3fPFNr8RzRxa6', 'guest', '2025-06-08 13:31:10', NULL),
(6, 'mulyani.ika', 'asmadi61@hassanah.co.id', '$2y$12$/F3QgkDwrqIy0xwDWcFmjemW63AY/H0ZBOs04qNLCxVnFdSYsHz7y', 'admin', '2025-06-08 13:31:10', NULL),
(7, 'titin.prasetya', 'kusumo.rachel@prasetya.ac.id', '$2y$12$pfPUwUH9.TiT6aAzQfFUHORAvEsv8Oiqlqs2ab7VJ/sTwWQxonFa6', 'guest', '2025-06-08 13:31:10', NULL),
(8, 'ismail48', 'rafi75@marpaung.biz.id', '$2y$12$Gn4Gobkjpl3s9Bxe.YmMi.K5WZMvnKv8JLYgU0Z2uGDRUsBek1O7G', 'guest', '2025-06-08 13:31:10', NULL),
(9, 'zsiregar', 'susanti.febi@natsir.biz.id', '$2y$12$G3at3kTwj05lCCd8AO/oneXv/div7syMyJ1WN.h/A2iTnaMcrwAMu', 'guest', '2025-06-08 13:31:11', NULL),
(10, 'astuti.raditya', 'purwanti.tirtayasa@yahoo.co.id', '$2y$12$Z1QDN2QmQdNOLINIfG2qH.sZBEGf/82S6gL7S40iJJ0A97Oda6JK.', 'admin', '2025-06-08 13:31:11', NULL),
(16, 'yoga', 'yoga@gmail.com', '$2y$12$17qUS.g7CFZJmxD0hm8Hde3vKcmFU5qRcWs1aTN89VcT2yZpwyKte', 'admin', '2025-06-30 10:46:18', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kategori` (`kategori`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `category` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
