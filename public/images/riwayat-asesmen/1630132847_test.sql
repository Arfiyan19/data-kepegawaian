-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2021 at 04:56 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_aster_pangkat`
--

CREATE TABLE `t_aster_pangkat` (
  `id` int(11) NOT NULL,
  `nama_pangkat` varchar(255) NOT NULL,
  `created_at` datetime(3) NOT NULL,
  `created_by` char(32) NOT NULL,
  `updated_at` datetime(3) NOT NULL,
  `updated_by` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_master_eselon`
--

CREATE TABLE `t_master_eselon` (
  `id` int(11) NOT NULL,
  `nama_eselon` varchar(255) NOT NULL,
  `created_at` datetime(3) NOT NULL,
  `created_by` char(32) NOT NULL,
  `updated_at` datetime(3) NOT NULL,
  `updated_by` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_master_keududukan_organisasi`
--

CREATE TABLE `t_master_keududukan_organisasi` (
  `id` int(11) NOT NULL,
  `nama_kedudukan_organisasi` varchar(255) NOT NULL,
  `created_at` datetime(3) NOT NULL,
  `created_by` char(32) NOT NULL,
  `updated_at` datetime(3) NOT NULL,
  `updated_by` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_master_pangakat_golongan`
--

CREATE TABLE `t_master_pangakat_golongan` (
  `id` int(11) NOT NULL,
  `nama_panggkat` varchar(255) NOT NULL,
  `created_at` datetime(3) NOT NULL,
  `created_by` char(32) NOT NULL,
  `updated_at` datetime(3) NOT NULL,
  `updated_by` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_master_pangakat_unit_organisasi`
--

CREATE TABLE `t_master_pangakat_unit_organisasi` (
  `id` int(11) NOT NULL,
  `nama_pangakat_unit_organisasi` varchar(255) NOT NULL,
  `created_at` datetime(3) NOT NULL,
  `created_by` char(32) NOT NULL,
  `updated_at` datetime(3) NOT NULL,
  `updated_by` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_master_posisi`
--

CREATE TABLE `t_master_posisi` (
  `id` int(11) NOT NULL,
  `nama_posisi` varchar(255) NOT NULL,
  `created_at` datetime(3) NOT NULL,
  `created_by` char(32) NOT NULL,
  `updated_at` datetime(3) NOT NULL,
  `updated_by` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_master_posisi`
--

INSERT INTO `t_master_posisi` (`id`, `nama_posisi`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(0, 'Direktur ', '2021-08-12 20:59:21.000', 'afadsfadsfa', '2021-08-11 00:00:00.000', '3234232');

-- --------------------------------------------------------

--
-- Table structure for table `t_mastesr_unit_kerja`
--

CREATE TABLE `t_mastesr_unit_kerja` (
  `id` int(11) NOT NULL,
  `nama_unit_kerja` varchar(255) NOT NULL,
  `created_at` datetime(3) NOT NULL,
  `created_by` char(32) NOT NULL,
  `updated_at` datetime(3) NOT NULL,
  `updated_by` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
