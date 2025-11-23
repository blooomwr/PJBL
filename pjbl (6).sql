-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2025 at 07:08 AM
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
-- Database: `pjbl`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(10) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama_admin` varchar(50) DEFAULT NULL,
  `email_admin` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_admin`, `email_admin`) VALUES
('A01', 'syabibibrahim', '$2y$10$Z4l1/V0qRWfHpiOg6kZdtedlTP4DAWGRNNdhIuPUG.3UGrn4uPVjG', 'Syabib Ibrahim ', 'syabibibrahim@email.com');

-- --------------------------------------------------------

--
-- Table structure for table `audit_log`
--

CREATE TABLE `audit_log` (
  `id_log` int(11) NOT NULL,
  `id_admin` varchar(10) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `aksi` varchar(255) NOT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_log`
--

INSERT INTO `audit_log` (`id_log`, `id_admin`, `nama_admin`, `aksi`, `detail`, `timestamp`) VALUES
(1, 'A01', 'Syabib Ibrahim ', 'Menambah produk baru', 'Kue Api (ID: P01)', '2025-11-16 14:18:44'),
(2, 'A01', 'Syabib Ibrahim ', 'Mengubah produk', 'Kue Apii (ID: P01)', '2025-11-16 14:23:06'),
(3, 'A01', 'Syabib Ibrahim ', 'Menambah berita baru', 'erer (ID: B01)', '2025-11-16 14:27:50'),
(4, 'A01', 'Syabib Ibrahim ', 'Menambah promo baru', 'Kue Api gratis (ID: R01)', '2025-11-16 14:33:03'),
(5, 'A01', 'Syabib Ibrahim ', 'Mengubah berita', 'erer (ID: B01)', '2025-11-16 14:33:42'),
(6, 'A01', 'Syabib Ibrahim ', 'Mengubah promo', 'Kue Api gratissss (ID: R01)', '2025-11-16 14:33:52'),
(7, 'A01', 'Syabib Ibrahim ', 'Menambah berita baru', 'wwww (ID: B01)', '2025-11-16 14:36:53'),
(8, 'A01', 'Syabib Ibrahim ', 'Menghapus berita', 'Total 1 berita dihapus. (IDs: \'B01\')', '2025-11-16 14:36:56'),
(9, 'A01', 'Syabib Ibrahim ', 'Menghapus promo', 'Total 1 promo dihapus. (IDs: \'R01\')', '2025-11-16 14:37:01'),
(10, 'A01', 'Syabib Ibrahim ', 'Menghapus produk', 'Total 1 produk dihapus. (IDs: \'P01\')', '2025-11-16 14:37:13'),
(11, 'A01', 'Syabib Ibrahim ', 'Menambah produk baru', 'www (ID: P01)', '2025-11-16 14:37:26'),
(12, 'A01', 'Syabib Ibrahim ', 'Menghapus produk', 'Total 1 produk dihapus. (IDs: \'P01\')', '2025-11-16 14:37:28'),
(13, 'A01', 'Syabib Ibrahim ', 'Menambah produk baru', 'dadawdwa (ID: P01)', '2025-11-16 14:59:08'),
(14, 'A01', 'Syabib Ibrahim ', 'Menghapus 1 gambar produk', 'File: 6919844c2ebf4_hanip sus.PNG (ID Gambar: 18)', '2025-11-16 14:59:11'),
(15, 'A01', 'Syabib Ibrahim ', 'Menghapus produk', 'Total 1 produk dihapus. (IDs: \'P01\')', '2025-11-16 14:59:20'),
(16, 'A01', 'Syabib Ibrahim ', 'Menambah produk baru', 'Kue Api (ID: P01)', '2025-11-18 20:05:00'),
(17, 'A01', 'Syabib Ibrahim ', 'Menghapus produk', 'Total 1 produk dihapus. (IDs: \'P01\')', '2025-11-18 20:05:06'),
(18, 'A01', 'Syabib Ibrahim ', 'Menambah promo baru', 'B1G1 (ID: R01)', '2025-11-19 19:14:08'),
(19, 'A01', 'Syabib Ibrahim ', 'Menambah promo baru', 'Beli 1 Kaleng bonus Kaleng (ID: R02)', '2025-11-19 19:15:08'),
(20, 'A01', 'Syabib Ibrahim ', 'Menambah berita baru', 'Ulang tahun Que-Que (ID: B01)', '2025-11-19 19:17:06'),
(21, 'A01', 'Syabib Ibrahim ', 'Menambah berita baru', 'Kue all you can eat (ID: B02)', '2025-11-19 19:18:26'),
(22, 'A01', 'Syabib Ibrahim ', 'Menambah promo baru', 'Menangkan Iphone 17 PM (ID: R03)', '2025-11-19 19:20:20'),
(23, 'A01', 'Syabib Ibrahim ', 'Menambah promo baru', 'Gratis Lanyard (ID: R04)', '2025-11-19 19:22:19'),
(24, 'A01', 'Syabib Ibrahim ', 'Menambah promo baru', 'Teh Pucuk untuk setiap Pembelian (ID: R05)', '2025-11-19 19:27:41'),
(25, 'A01', 'Syabib Ibrahim ', 'Menambah produk baru', 'Kue Kaleng (ID: P01)', '2025-11-20 19:07:10'),
(26, 'A01', 'Syabib Ibrahim ', 'Menambah produk baru', 'Kue Pisang Coklat (ID: P02)', '2025-11-20 19:08:23'),
(27, 'A01', 'Syabib Ibrahim ', 'Menambah produk baru', 'Ketan Srikaya Pandan (ID: P03)', '2025-11-20 19:09:22'),
(28, 'A01', 'Syabib Ibrahim ', 'Menambah produk baru', 'Tacookies (ID: P04)', '2025-11-20 19:11:02'),
(29, 'A01', 'Syabib Ibrahim ', 'Mengubah produk', 'Tacookies (ID: P04)', '2025-11-20 19:11:31'),
(30, 'A01', 'Syabib Ibrahim ', 'Menambah produk baru', 'Wajik (ID: P05)', '2025-11-20 19:13:00'),
(31, 'A01', 'Syabib Ibrahim ', 'Menambah produk baru', 'Teh Pucuk (ID: P06)', '2025-11-20 19:13:37'),
(32, 'A01', 'Syabib Ibrahim ', 'Mengubah produk', 'Tacookies (ID: P04)', '2025-11-20 19:13:46'),
(33, 'A01', 'Syabib Ibrahim ', 'Mengubah produk', 'Kue Pisang Coklat (ID: P02)', '2025-11-20 19:13:51'),
(34, 'A01', 'Syabib Ibrahim ', 'Menambah produk baru', '1 (ID: P07)', '2025-11-20 19:14:08'),
(35, 'A01', 'Syabib Ibrahim ', 'Menambah produk baru', '2 (ID: P08)', '2025-11-20 19:14:17'),
(36, 'A01', 'Syabib Ibrahim ', 'Menambah produk baru', '3 (ID: P09)', '2025-11-20 19:14:29'),
(37, 'A01', 'Syabib Ibrahim ', 'Mengubah produk', 'Teh Pucuk (ID: P06)', '2025-11-20 19:15:53'),
(38, 'A01', 'Syabib Ibrahim ', 'Mengubah produk', 'Wajik (ID: P05)', '2025-11-20 19:16:01'),
(39, 'A01', 'Syabib Ibrahim ', 'Mengubah produk', 'Kue Kaleng (ID: P01)', '2025-11-20 19:16:07'),
(40, 'A01', 'Syabib Ibrahim ', 'Mengubah produk', 'Kue Pisang Coklat (ID: P02)', '2025-11-20 19:16:14'),
(41, 'A01', 'Syabib Ibrahim ', 'Mengubah produk', 'Ketan Srikaya Pandan (ID: P03)', '2025-11-20 19:16:31'),
(42, 'A01', 'Syabib Ibrahim ', 'Mengubah produk', 'Tacookies (ID: P04)', '2025-11-20 19:16:47'),
(43, 'A01', 'Syabib Ibrahim ', 'Menghapus produk', 'Total 1 produk dihapus. (IDs: \'P09\')', '2025-11-20 21:55:49'),
(44, 'A01', 'Syabib Ibrahim ', 'Menambah produk baru', 'www (ID: P09)', '2025-11-21 13:07:54'),
(45, 'A01', 'Syabib Ibrahim ', 'Mengubah produk', 'www (ID: P09)', '2025-11-21 13:08:06'),
(46, 'A01', 'Syabib Ibrahim ', 'Menghapus 1 gambar produk', 'File: 692001ba5c74f_Rectangle 15.png', '2025-11-21 13:08:16'),
(47, 'A01', 'Syabib Ibrahim ', 'Mengubah produk', 'www (ID: P09)', '2025-11-21 13:08:19'),
(48, 'A01', 'Syabib Ibrahim ', 'Mengubah produk', 'wwww (ID: P09)', '2025-11-21 21:27:17'),
(49, 'A01', 'Syabib Ibrahim ', 'Mengubah produk', 'wwwww (ID: P09)', '2025-11-21 21:32:24'),
(50, 'A01', 'Syabib Ibrahim ', 'Mengubah produk', 'wwwww (ID: P09)', '2025-11-21 21:32:29'),
(51, 'A01', 'Syabib Ibrahim ', 'Menambah produk baru', 'iphone (ID: P10)', '2025-11-21 21:41:00'),
(52, 'A01', 'Syabib Ibrahim ', 'Mengubah produk', 'iphone1 (ID: P10)', '2025-11-21 21:41:05'),
(53, 'A01', 'Syabib Ibrahim ', 'Menambah produk baru', 'www (ID: P11)', '2025-11-21 21:41:32'),
(54, 'A01', 'Syabib Ibrahim ', 'Menghapus produk', 'Total 3 produk dihapus. (IDs: P11,P10,P09)', '2025-11-21 21:41:42'),
(55, 'A01', 'Syabib Ibrahim ', 'Menambah produk baru', 'Kue Api (ID: P09) - Kode: BTH1ASGQ', '2025-11-21 22:04:12'),
(56, 'A01', 'Syabib Ibrahim ', 'Menambah produk baru', 'w (ID: P10) - Kode: OSMTJ9XG', '2025-11-21 22:10:58'),
(57, 'A01', 'Syabib Ibrahim ', 'Mengubah produk', 'w (ID: P10) - Kode: 11111111', '2025-11-21 22:11:08'),
(58, 'A01', 'Syabib Ibrahim ', 'Menghapus produk', 'Total 1 produk dihapus. (IDs: P10)', '2025-11-21 22:11:15'),
(59, 'A01', 'Syabib Ibrahim ', 'Menghapus produk', 'Total 1 produk dihapus. (IDs: P09)', '2025-11-21 22:11:18'),
(60, 'A01', 'Syabib Ibrahim ', 'Menambah promo baru', 'Kue Api (ID: R06)', '2025-11-21 22:23:59'),
(61, 'A01', 'Syabib Ibrahim ', 'Menghapus promo', 'Total 1 promo dihapus. (IDs: R06)', '2025-11-21 22:31:09'),
(62, 'A01', 'Syabib Ibrahim ', 'Mengubah promo', 'Teh Pucuk untuk setiap Pembelian wow (ID: R05)', '2025-11-21 22:31:19'),
(63, 'A01', 'Syabib Ibrahim ', 'Menambah promo baru', 'www (ID: R06)', '2025-11-21 22:32:25'),
(64, 'A01', 'Syabib Ibrahim ', 'Menghapus promo', 'Total 1 promo dihapus. (IDs: R06)', '2025-11-21 22:32:28'),
(65, 'A01', 'Syabib Ibrahim ', 'Menambah berita baru', 'wow (ID: B03)', '2025-11-21 22:37:34'),
(66, 'A01', 'Syabib Ibrahim ', 'Menghapus berita', 'Total 1 berita dihapus. (IDs: B03)', '2025-11-21 22:37:37'),
(67, 'A01', 'Syabib Ibrahim ', 'Mengubah berita', 'Kue all you can eatw (ID: B02)', '2025-11-21 22:37:42'),
(68, 'A01', 'Syabib Ibrahim ', 'Mengubah berita', 'Kue all you can eat (ID: B02)', '2025-11-21 22:38:00'),
(69, 'A01', 'Syabib Ibrahim ', 'Menambah produk baru', '3 (ID: P09) - Kode: XN1YJL8T', '2025-11-21 22:46:55'),
(70, 'A01', 'Syabib Ibrahim ', 'Menambah berita baru', 'Berita tes  (ID: B03)', '2025-11-21 23:22:48'),
(71, 'A01', 'Syabib Ibrahim ', 'Menambah berita baru', 'Berita tes 2 (ID: B04)', '2025-11-21 23:23:18'),
(72, 'A01', 'Syabib Ibrahim ', 'Mengubah berita', 'Berita tes 1 (ID: B03)', '2025-11-21 23:23:24'),
(73, 'A01', 'Syabib Ibrahim ', 'Menambah berita baru', 'Berita tes 3 (ID: B05)', '2025-11-21 23:23:42'),
(74, 'A01', 'Syabib Ibrahim ', 'Menambah berita baru', 'Berita tes 4 (ID: B06)', '2025-11-21 23:23:58'),
(75, 'A01', 'Syabib Ibrahim ', 'Menambah berita baru', 'Berita tes 5 (ID: B07)', '2025-11-21 23:24:08'),
(76, 'A01', 'Syabib Ibrahim ', 'Menambah berita baru', 'Berita tes 6 (ID: B08)', '2025-11-21 23:24:24'),
(77, '3', 'test123', 'Memberi Rating', 'Rating: 5 Bintang (ID: P09)', '2025-11-22 01:28:24'),
(78, 'A01', 'Syabib Ibrahim ', 'Mengubah produk', 'Teh Pucuk (ID: P06)', '2025-11-22 01:54:33'),
(79, 'A01', 'Syabib Ibrahim ', 'Mengubah produk', 'Wajik (ID: P05)', '2025-11-22 01:54:38'),
(80, 'A01', 'Syabib Ibrahim ', 'Menambah promo baru', 'ww (123)', '2025-11-23 11:35:25'),
(81, 'A01', 'Syabib Ibrahim ', 'Mengubah promo', 'ww (1234)', '2025-11-23 11:37:27'),
(82, 'A01', 'Syabib Ibrahim ', 'Menghapus promo', 'Total 1 dihapus.', '2025-11-23 11:37:47'),
(83, 'A01', 'Syabib Ibrahim ', 'Mengubah promo', 'Teh Pucuk untuk setiap Pembelian wow (TehPucuk)', '2025-11-23 11:38:05'),
(84, 'A01', 'Syabib Ibrahim ', 'Mengubah promo', 'Gratis Lanyard (Lanyard123)', '2025-11-23 11:38:35'),
(85, 'A01', 'Syabib Ibrahim ', 'Mengubah promo', 'Menangkan Iphone 17 PM (Iphone17PM)', '2025-11-23 11:38:58'),
(86, 'A01', 'Syabib Ibrahim ', 'Mengubah promo', 'Beli 1 Kaleng bonus Kaleng (KalengGery)', '2025-11-23 11:39:09'),
(87, 'A01', 'Syabib Ibrahim ', 'Mengubah promo', 'B1G1 (Buy1Get1)', '2025-11-23 11:39:19'),
(88, 'A01', 'Syabib Ibrahim ', 'Mengubah berita', 'Berita tes 6 (ID: B08)', '2025-11-23 11:51:29'),
(89, 'A01', 'Syabib Ibrahim ', 'Mengubah promo', 'B1G1 (Kode: Buy1Get1) [ID: R01]', '2025-11-23 11:53:12'),
(90, 'A01', 'Syabib Ibrahim ', 'Mengubah promo', 'B1G1 (Kode: Buy1Get1) (ID: R01)', '2025-11-23 11:54:33');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id_berita` varchar(10) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `teks_berita` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `is_berita_utama` varchar(3) DEFAULT 'No',
  `terakhir_edit` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id_berita`, `judul`, `deskripsi`, `teks_berita`, `foto`, `tanggal`, `is_berita_utama`, `terakhir_edit`) VALUES
('B01', 'Ulang tahun Que-Que', 'Ulang tahun Que-Que ke-2', 'selebrasi ulang tahun Que-Que ke-2 telah dilaksanakan kemarin tanggal 24 oktober 2026. Ulang tahun dirayakan dengan meriah dan dihadiri oleh seluruh pelanggan setia rumah que que', '691db5424d3c1_360_F_110263419_6d9oWmooHp0tLqQrG6ypqQk7KRqxIkSE.jpg', '2025-11-19 00:00:00', 'Yes', '2025-11-19 19:17:06'),
('B02', 'Kue all you can eat', 'Acara Special', 'acara makan Kue all you can eat akan dilaksanakan minggu depan di rumah que que. jangan lupa datang', '691db59249428_Jajan_Pasar_in_Jakarta.jfif', '2025-11-19 00:00:00', 'No', '2025-11-21 22:38:00'),
('B03', 'Berita tes 1', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.\"', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"\r\n\r\n\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"\r\n\r\n\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', '692091d8de695_Rectangle 11.png', '2025-11-21 00:00:00', 'No', '2025-11-21 23:23:24'),
('B04', 'Berita tes 2', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"\r\n\r\n\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"\r\n\r\n\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', '692091f6c4497_Rectangle 12.png', '2025-11-21 00:00:00', 'No', '2025-11-21 23:23:18'),
('B05', 'Berita tes 3', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', '6920920e9a4a5_Rectangle 10.png', '2025-11-21 00:00:00', 'No', '2025-11-21 23:23:42'),
('B06', 'Berita tes 4', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', '6920921e6e5ed_Rectangle 10.png', '2025-11-21 00:00:00', 'No', '2025-11-21 23:23:58'),
('B07', 'Berita tes 5', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', '69209228ba9c7_Rectangle 10.png', '2025-11-21 00:00:00', 'No', '2025-11-21 23:24:08'),
('B08', 'Berita tes 6', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', '\"Lorem ipsum dolor sit amet,u consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', '69209238c04c8_Rectangle 10.png', '2025-11-21 00:00:00', 'No', '2025-11-23 11:51:29');

-- --------------------------------------------------------

--
-- Table structure for table `detail_keranjang`
--

CREATE TABLE `detail_keranjang` (
  `id_detail` int(11) NOT NULL,
  `id_keranjang` int(11) NOT NULL,
  `id_produk` varchar(10) NOT NULL,
  `varian` varchar(50) DEFAULT NULL,
  `jumlah` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_keranjang`
--

INSERT INTO `detail_keranjang` (`id_detail`, `id_keranjang`, `id_produk`, `varian`, `jumlah`) VALUES
(1, 1, 'P04', 'Almond', 3),
(3, 1, 'P03', 'Pandan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `tanggal_update` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `id_pembeli`, `tanggal_update`) VALUES
(1, 3, '2025-11-22 02:19:58');

-- --------------------------------------------------------

--
-- Table structure for table `pembeli`
--

CREATE TABLE `pembeli` (
  `id_pembeli` int(11) NOT NULL,
  `email_pembeli` varchar(50) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama_pembeli` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembeli`
--

INSERT INTO `pembeli` (`id_pembeli`, `email_pembeli`, `username`, `password`, `nama_pembeli`) VALUES
(1, 'syackz@gmail.com', 'smurfacc', '$2y$10$75StPBblChNttTmOat3DF.BfAd/Lu86LWMnmy4qt.AW2kQyOhIkrW', 'smurfacc'),
(2, 'syabibibrahim@gmail.com', 'adminacc', '$2y$10$Z4l1/V0qRWfHpiOg6kZdtedlTP4DAWGRNNdhIuPUG.3UGrn4uPVjG', 'adminacc'),
(3, 'test@gmail.com', 'test123', '$2y$10$8YxgxYtrlAh6sAv7dyWfZu3HHC5FF8NM7B4A7o3wh7O0n8fy2VJ62', 'Test Orang'),
(4, 'test321@gmail.com', 'test321', '$2y$10$iwcvF4/.gl.AzsQ7vqwDLeXW/9Sg1l.2rUbGVs0hqL1SHgNbugr2y', 'test321');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` varchar(10) NOT NULL,
  `kode_review` varchar(8) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `varian` varchar(100) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `kategori` varchar(30) DEFAULT NULL,
  `is_bestseller` varchar(3) DEFAULT 'No',
  `terakhir_edit` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total_score` int(11) DEFAULT 0,
  `total_reviewers` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `kode_review`, `nama`, `deskripsi`, `harga`, `varian`, `stok`, `kategori`, `is_bestseller`, `terakhir_edit`, `total_score`, `total_reviewers`) VALUES
('P01', 'afa6d22a', 'Kue Kaleng', 'kue kaleng dengan isi kue yang enak', 25000, '500 gram', 21, 'makanan', 'Yes', '2025-11-21 21:49:48', 0, 0),
('P02', 'c22690c2', 'Kue Pisang Coklat', 'Kue pisang coklat dengan rasa pisang yang manis dan coklat yang meluber', 20000, 'Original', 20, 'kue', 'Yes', '2025-11-21 21:49:48', 0, 0),
('P03', '117fc72c', 'Ketan Srikaya Pandan', 'Kue ini sangat cocok untuk dimakan dengan keluarga', 20000, 'Pandan', 40, 'makanan', 'No', '2025-11-21 21:49:48', 0, 0),
('P04', '00a360a4', 'Tacookies', 'Cookies dengan tiga varian rasa yang sama enaknya', 25000, 'Original, Almond, Coklat', 10, 'kue', 'No', '2025-11-21 21:49:48', 0, 0),
('P05', '443C4075', 'Wajik', 'Kue Wajik yang lezat dan nagih', 45000, 'Original', 20, 'makanan', 'Yes', '2025-11-22 01:54:38', 0, 0),
('P06', '8CCD46C2', 'Teh Pucuk', 'hausss', 5000, 'Original', 2, 'minuman', 'Yes', '2025-11-22 17:02:35', 5, 1),
('P07', '4b127a5a', '1', '1', 12222, '1', 1, 'makanan', 'No', '2025-11-21 21:49:48', 0, 0),
('P08', 'd05e687d', '2', '2', 2, '2', 2, 'makanan', 'No', '2025-11-21 21:49:48', 0, 0),
('P09', 'XN1YJL8T', '3', '3', 3, '3', 3, 'makanan', 'No', '2025-11-22 01:36:01', 20, 4);

-- --------------------------------------------------------

--
-- Table structure for table `produk_gambar`
--

CREATE TABLE `produk_gambar` (
  `id_gambar` int(11) NOT NULL,
  `id_produk` varchar(10) DEFAULT NULL,
  `nama_file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk_gambar`
--

INSERT INTO `produk_gambar` (`id_gambar`, `id_produk`, `nama_file`) VALUES
(20, 'P01', '691f046e36074_S20490357e1024fd3bd8425a932ddd5b5s.jpg_720x720q80.jpg'),
(21, 'P02', '691f04b756465_Rectangle 1.png'),
(22, 'P03', '691f04f268889_Rectangle 16.png'),
(23, 'P04', '691f0556f1ee9_Rectangle 12.png'),
(24, 'P04', '691f0556f2307_Rectangle 10.png'),
(25, 'P04', '691f05734ac93_Rectangle 11.png'),
(26, 'P05', '691f05cc95602_Rectangle 15.png'),
(27, 'P06', '691f05f1eea2a_7cfc649c4bf56648d4efa46cd6d21480.jpg'),
(28, 'P07', '691f061048b3f_360_F_110263419_6d9oWmooHp0tLqQrG6ypqQk7KRqxIkSE.jpg'),
(29, 'P08', '691f0619a0064_360_F_110263419_6d9oWmooHp0tLqQrG6ypqQk7KRqxIkSE.jpg'),
(39, 'P09', '6920896f643db_360_F_110263419_6d9oWmooHp0tLqQrG6ypqQk7KRqxIkSE.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `produk_review`
--

CREATE TABLE `produk_review` (
  `id_review` int(11) NOT NULL,
  `id_produk` varchar(10) NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk_review`
--

INSERT INTO `produk_review` (`id_review`, `id_produk`, `id_pembeli`, `rating`, `tanggal`) VALUES
(1, 'P09', 3, 5, '2025-11-22 01:36:01'),
(2, 'P06', 3, 5, '2025-11-22 17:02:35');

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE `promo` (
  `id_promo` varchar(10) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `kode_promo` varchar(10) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `terakhir_edit` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`id_promo`, `nama`, `kode_promo`, `gambar`, `terakhir_edit`) VALUES
('R01', 'B1G1', 'Buy1Get1', '691db490e9b65_B1G1.jpg', '2025-11-23 11:39:19'),
('R02', 'Beli 1 Kaleng bonus Kaleng', 'KalengGery', '691db4cc462a5_S20490357e1024fd3bd8425a932ddd5b5s.jpg_720x720q80.jpg', '2025-11-23 11:39:09'),
('R03', 'Menangkan Iphone 17 PM', 'Iphone17PM', '691db6045a039_WEBSITE-884497797.webp', '2025-11-23 11:38:58'),
('R04', 'Gratis Lanyard', 'Lanyard123', '691db67b628b9_Lanyard.png', '2025-11-23 11:38:35'),
('R05', 'Teh Pucuk untuk setiap Pembelian wow', 'TehPucuk', '691db7bd3aeb4_7cfc649c4bf56648d4efa46cd6d21480.jpg', '2025-11-23 11:38:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `audit_log`
--
ALTER TABLE `audit_log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indexes for table `detail_keranjang`
--
ALTER TABLE `detail_keranjang`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_keranjang` (`id_keranjang`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD UNIQUE KEY `unique_user_cart` (`id_pembeli`);

--
-- Indexes for table `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`id_pembeli`),
  ADD UNIQUE KEY `email_pembeli` (`email_pembeli`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD UNIQUE KEY `kode_review` (`kode_review`);

--
-- Indexes for table `produk_gambar`
--
ALTER TABLE `produk_gambar`
  ADD PRIMARY KEY (`id_gambar`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `produk_review`
--
ALTER TABLE `produk_review`
  ADD PRIMARY KEY (`id_review`),
  ADD UNIQUE KEY `unique_review` (`id_produk`,`id_pembeli`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id_promo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_log`
--
ALTER TABLE `audit_log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `detail_keranjang`
--
ALTER TABLE `detail_keranjang`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pembeli`
--
ALTER TABLE `pembeli`
  MODIFY `id_pembeli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produk_gambar`
--
ALTER TABLE `produk_gambar`
  MODIFY `id_gambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `produk_review`
--
ALTER TABLE `produk_review`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_keranjang`
--
ALTER TABLE `detail_keranjang`
  ADD CONSTRAINT `detail_keranjang_ibfk_1` FOREIGN KEY (`id_keranjang`) REFERENCES `keranjang` (`id_keranjang`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_keranjang_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE;

--
-- Constraints for table `produk_gambar`
--
ALTER TABLE `produk_gambar`
  ADD CONSTRAINT `produk_gambar_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
