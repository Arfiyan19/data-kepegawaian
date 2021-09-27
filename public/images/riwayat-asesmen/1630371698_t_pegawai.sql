-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2021 at 10:53 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `t_pegawai`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_kedudukan_organisasi`
--

CREATE TABLE `t_kedudukan_organisasi` (
  `id_kedudukan_organiasi` bigint(20) UNSIGNED NOT NULL,
  `kedudukan_organiasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_kedudukan_organisasi`
--

INSERT INTO `t_kedudukan_organisasi` (`id_kedudukan_organiasi`, `kedudukan_organiasi`, `created_at`, `updated_at`) VALUES
(1, 'Milik Pemerintahan Indonesia\r\n', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_master_jenis_organisasi`
--

CREATE TABLE `t_master_jenis_organisasi` (
  `id_jenis_organisasi` bigint(20) UNSIGNED NOT NULL,
  `jenis_organiasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_master_jenis_organisasi`
--

INSERT INTO `t_master_jenis_organisasi` (`id_jenis_organisasi`, `jenis_organiasi`, `created_at`, `updated_at`) VALUES
(1, 'ORGANISASI MITTRA PRESIDEN\r\n', NULL, NULL),
(2, 'Organisasi Desa\r\n', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_riwayat_organisasi`
--

CREATE TABLE `t_riwayat_organisasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_organisasi_lembaga` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_jenis_organisasi` int(11) NOT NULL,
  `id_kedudukan_organiasi` int(11) NOT NULL,
  `tempat_kedudukan_organisasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  `surat_keputusan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_surat_keputusan` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `validated_at` int(11) DEFAULT NULL,
  `read_at` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_riwayat_organisasi`
--

INSERT INTO `t_riwayat_organisasi` (`id`, `nama_organisasi_lembaga`, `id_jenis_organisasi`, `id_kedudukan_organiasi`, `tempat_kedudukan_organisasi`, `tanggal_mulai`, `tanggal_berakhir`, `surat_keputusan`, `tanggal_surat_keputusan`, `status`, `user_id`, `validated_at`, `read_at`, `created_at`, `updated_at`) VALUES
(3, 'Kepala Desa', 1, 1, 'POnorogo', '2021-08-26', '2021-08-29', 'PGW/ALL', '2021-08-29', 0, 1, NULL, 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_kedudukan_organisasi`
--
ALTER TABLE `t_kedudukan_organisasi`
  ADD PRIMARY KEY (`id_kedudukan_organiasi`);

--
-- Indexes for table `t_master_jenis_organisasi`
--
ALTER TABLE `t_master_jenis_organisasi`
  ADD PRIMARY KEY (`id_jenis_organisasi`);

--
-- Indexes for table `t_riwayat_organisasi`
--
ALTER TABLE `t_riwayat_organisasi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_kedudukan_organisasi`
--
ALTER TABLE `t_kedudukan_organisasi`
  MODIFY `id_kedudukan_organiasi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_master_jenis_organisasi`
--
ALTER TABLE `t_master_jenis_organisasi`
  MODIFY `id_jenis_organisasi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_riwayat_organisasi`
--
ALTER TABLE `t_riwayat_organisasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
