-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2025 at 01:55 PM
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
('A01', 'syabibibrahim', '12345', 'Syabib Ibrahim ', 'syabibibrahim@email.com');

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
(15, 'A01', 'Syabib Ibrahim ', 'Menghapus produk', 'Total 1 produk dihapus. (IDs: \'P01\')', '2025-11-16 14:59:20');

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
(2, 'syabibibrahim@gmail.com', 'adminacc', '$2y$10$Z4l1/V0qRWfHpiOg6kZdtedlTP4DAWGRNNdhIuPUG.3UGrn4uPVjG', 'adminacc');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` varchar(10) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `varian` varchar(100) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `kategori` varchar(30) DEFAULT NULL,
  `is_bestseller` varchar(3) DEFAULT 'No',
  `terakhir_edit` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produk_gambar`
--

CREATE TABLE `produk_gambar` (
  `id_gambar` int(11) NOT NULL,
  `id_produk` varchar(10) DEFAULT NULL,
  `nama_file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE `promo` (
  `id_promo` varchar(10) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `terakhir_edit` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `produk_gambar`
--
ALTER TABLE `produk_gambar`
  ADD PRIMARY KEY (`id_gambar`),
  ADD KEY `id_produk` (`id_produk`);

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
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pembeli`
--
ALTER TABLE `pembeli`
  MODIFY `id_pembeli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produk_gambar`
--
ALTER TABLE `produk_gambar`
  MODIFY `id_gambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produk_gambar`
--
ALTER TABLE `produk_gambar`
  ADD CONSTRAINT `produk_gambar_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
