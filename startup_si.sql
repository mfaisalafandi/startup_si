-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2023 at 02:59 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si_tiket`
--
CREATE DATABASE IF NOT EXISTS `si_tiket` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `si_tiket`;

-- --------------------------------------------------------

--
-- Table structure for table `tb_akun`
--

CREATE TABLE `tb_akun` (
  `id_akun` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_akun`
--

INSERT INTO `tb_akun` (`id_akun`, `username`, `password`, `level`) VALUES
(0, 'admin', '$2y$10$IitLJgCSwQaM.d9n4WoMGOg9YJtbwhw10HMEwWWSLOeochznFl6by', 2),
(2, 'faisal', '$2y$10$Semhj66a/.S0AOvDPE6tFuPtdrheRPIYvCH0zBWsQsPJNt4Y9lVi2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_paket`
--

CREATE TABLE `tb_paket` (
  `id_paket` int(11) NOT NULL,
  `nama_paket` varchar(60) NOT NULL,
  `harga` int(11) NOT NULL,
  `up_basic` int(5) NOT NULL,
  `up_gold` int(5) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_paket`
--

INSERT INTO `tb_paket` (`id_paket`, `nama_paket`, `harga`, `up_basic`, `up_gold`, `deskripsi`) VALUES
(1, 'Paket Personal', 65000, 1, 0, 'Pasang 1 Event, Slot Tiket Unlimited'),
(2, 'Paket TixA', 100000, 2, 0, 'Pasang 2 Event, Slot Tiket Unlimited'),
(3, 'Paket TixB', 250000, 7, 0, 'Pasang 7 Event, Slot Tiket Unlimited'),
(4, 'Paket TixC', 350000, 5, 1, 'Ekslusif dipromosikan di halaman depan, Pasang 3 Event, Slot Tiket Unlimited'),
(5, 'PAKET TixVIP', 750000, 0, 10, 'Ekslusif dipromosikan di halaman depan, Pasang 10 Event, Slot Tiket Unlimited');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama_pengguna` varchar(60) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `qty_basic` int(5) NOT NULL,
  `qty_gold` int(5) NOT NULL,
  `id_akun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id_pengguna`, `nama_pengguna`, `telp`, `alamat`, `qty_basic`, `qty_gold`, `id_akun`) VALUES
(0, 'admin', '0873874394834', 'Jl.D', 0, 0, 0),
(1, 'M. Faisal Afandi', '087876950031', 'Jl.Subita Gg.Tigaron No.15', 0, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_tiket`
--

CREATE TABLE `tb_tiket` (
  `id_tiket` int(11) NOT NULL,
  `judul_tiket` varchar(80) NOT NULL,
  `foto_tiket` varchar(255) NOT NULL,
  `stok` int(7) NOT NULL,
  `harga` int(9) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `tanggal_buat` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_tiket`
--

INSERT INTO `tb_tiket` (`id_tiket`, `judul_tiket`, `foto_tiket`, `stok`, `harga`, `lokasi`, `tanggal_buat`, `tanggal_akhir`, `id_pengguna`, `status`) VALUES
(2, 'SNATIA 2023', 'default.jpg', 94, 50000, 'Universitas Udayana, Bandung, Bali', '2023-06-14', '2023-09-14', 1, 1),
(3, 'UP 2023', 'default.jpg', 100, 200000, 'Universitas Udayana, Bandung, Bali', '2023-06-14', '2023-12-07', 1, 1),
(4, 'asdf', 'default.jpg', 12, 25000, 'alsdkfj', '2023-06-14', '2023-06-15', 1, 1),
(9, 'coba admin', 'default.jpg', 96, 70000, 'Jl.D', '2023-06-25', '2023-07-08', 0, 1),
(10, 'Coba Tiket 2023', '25062023191621tiket_coba.jpg', 100, 100000, 'Jl. Tiket, Bali', '2023-06-25', '2023-07-07', 1, 1),
(13, 'coba ekslusif', '25062023194127tiket_coba.jpg', 198, 250000, 'Jl.Coba Ekslusif', '2023-06-25', '2023-07-06', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_tiket_ekslusif`
--

CREATE TABLE `tb_tiket_ekslusif` (
  `id_tiket_ekslusif` int(11) NOT NULL,
  `id_tiket` int(11) NOT NULL,
  `foto_ekslusif` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_tiket_ekslusif`
--

INSERT INTO `tb_tiket_ekslusif` (`id_tiket_ekslusif`, `id_tiket`, `foto_ekslusif`) VALUES
(2, 13, '25062023194127Background (1).png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi_paket`
--

CREATE TABLE `tb_transaksi_paket` (
  `id_transaksi_paket` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `harga` int(9) NOT NULL,
  `status_bayar` tinyint(1) NOT NULL,
  `foto_bukti` varchar(255) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_transaksi_paket`
--

INSERT INTO `tb_transaksi_paket` (`id_transaksi_paket`, `id_paket`, `id_pengguna`, `harga`, `status_bayar`, `foto_bukti`, `tanggal`) VALUES
(1, 1, 1, 65000, 1, '25062023171404bayar_faisal.jpg', '2023-06-25 17:14:04');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi_tiket`
--

CREATE TABLE `tb_transaksi_tiket` (
  `id_transaksi_tiket` int(11) NOT NULL,
  `id_tiket` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `harga` int(9) NOT NULL,
  `qty` int(3) NOT NULL,
  `status_bayar` tinyint(1) NOT NULL,
  `tanggal_beli` datetime NOT NULL,
  `bukti_bayar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_transaksi_tiket`
--

INSERT INTO `tb_transaksi_tiket` (`id_transaksi_tiket`, `id_tiket`, `id_pengguna`, `harga`, `qty`, `status_bayar`, `tanggal_beli`, `bukti_bayar`) VALUES
(1, 3, 1, 200000, 5, 0, '2023-06-22 00:00:00', 'default.jpg'),
(2, 2, 1, 50000, 5, 0, '2023-06-22 00:00:00', 'default.jpg'),
(3, 2, 1, 50000, 3, 0, '2023-06-22 00:00:00', 'default.jpg'),
(4, 2, 1, 50000, 6, 0, '2023-06-22 00:00:00', 'default.jpg'),
(5, 13, 1, 250000, 2, 1, '2023-06-25 20:52:48', '25062023210735Screenshot 2023-06-25 204632.png'),
(7, 9, 1, 70000, 2, 1, '2023-06-25 21:14:10', '25062023211502Screenshot - Faisal.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_akun`
--
ALTER TABLE `tb_akun`
  ADD PRIMARY KEY (`id_akun`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tb_paket`
--
ALTER TABLE `tb_paket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD KEY `id_akun` (`id_akun`);

--
-- Indexes for table `tb_tiket`
--
ALTER TABLE `tb_tiket`
  ADD PRIMARY KEY (`id_tiket`),
  ADD KEY `id_akun` (`id_pengguna`);

--
-- Indexes for table `tb_tiket_ekslusif`
--
ALTER TABLE `tb_tiket_ekslusif`
  ADD PRIMARY KEY (`id_tiket_ekslusif`),
  ADD KEY `id_tiket` (`id_tiket`);

--
-- Indexes for table `tb_transaksi_paket`
--
ALTER TABLE `tb_transaksi_paket`
  ADD PRIMARY KEY (`id_transaksi_paket`),
  ADD KEY `id_paket` (`id_paket`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indexes for table `tb_transaksi_tiket`
--
ALTER TABLE `tb_transaksi_tiket`
  ADD PRIMARY KEY (`id_transaksi_tiket`),
  ADD KEY `id_tiket` (`id_tiket`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_akun`
--
ALTER TABLE `tb_akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_paket`
--
ALTER TABLE `tb_paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_tiket`
--
ALTER TABLE `tb_tiket`
  MODIFY `id_tiket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_tiket_ekslusif`
--
ALTER TABLE `tb_tiket_ekslusif`
  MODIFY `id_tiket_ekslusif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_transaksi_paket`
--
ALTER TABLE `tb_transaksi_paket`
  MODIFY `id_transaksi_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_transaksi_tiket`
--
ALTER TABLE `tb_transaksi_tiket`
  MODIFY `id_transaksi_tiket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD CONSTRAINT `tb_pengguna_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `tb_akun` (`id_akun`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_tiket`
--
ALTER TABLE `tb_tiket`
  ADD CONSTRAINT `tb_tiket_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `tb_pengguna` (`id_pengguna`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_transaksi_paket`
--
ALTER TABLE `tb_transaksi_paket`
  ADD CONSTRAINT `tb_transaksi_paket_ibfk_1` FOREIGN KEY (`id_paket`) REFERENCES `tb_paket` (`id_paket`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_transaksi_paket_ibfk_2` FOREIGN KEY (`id_pengguna`) REFERENCES `tb_pengguna` (`id_pengguna`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_transaksi_tiket`
--
ALTER TABLE `tb_transaksi_tiket`
  ADD CONSTRAINT `tb_transaksi_tiket_ibfk_1` FOREIGN KEY (`id_tiket`) REFERENCES `tb_tiket` (`id_tiket`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_transaksi_tiket_ibfk_2` FOREIGN KEY (`id_pengguna`) REFERENCES `tb_pengguna` (`id_pengguna`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
