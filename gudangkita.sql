-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2024 at 10:12 AM
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
-- Database: `gudangkita`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `KodeBarang` varchar(30) NOT NULL,
  `NamaBarang` varchar(50) NOT NULL,
  `JumlahStok` int(20) DEFAULT NULL,
  `Harga` double(15,2) DEFAULT NULL,
  `Satuan` varchar(15) NOT NULL,
  `TglAuditTerakhir` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`KodeBarang`, `NamaBarang`, `JumlahStok`, `Harga`, `Satuan`, `TglAuditTerakhir`) VALUES
('32212', 'Pena JOYKO', 101, 140000.00, 'Kotak', '2024-01-07 00:00:00'),
('4213', 'Penghapus GREEBEL', 200, 150000.00, 'Kotak', '2024-01-02 00:00:00'),
('5311', 'Pewarna FABLE CASTLE', 45, 450000.00, 'Kotak', '2023-11-15 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `barangdigudang`
--

CREATE TABLE `barangdigudang` (
  `IdTransaksi` int(11) NOT NULL,
  `WaktuTransaksi` datetime NOT NULL DEFAULT current_timestamp(),
  `StatusTransaksi` enum('Masuk','Keluar') NOT NULL,
  `Jumlah` double(15,2) DEFAULT NULL,
  `Keterangan` text DEFAULT NULL,
  `KodeGudang` int(11) NOT NULL,
  `KodeBarang` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barangdigudang`
--

INSERT INTO `barangdigudang` (`IdTransaksi`, `WaktuTransaksi`, `StatusTransaksi`, `Jumlah`, `Keterangan`, `KodeGudang`, `KodeBarang`) VALUES
(2, '2024-01-05 00:00:00', 'Keluar', 5.00, 'Fauzi membeli 5 stok barang', 2111, '5311');

-- --------------------------------------------------------

--
-- Table structure for table `gudang`
--

CREATE TABLE `gudang` (
  `KodeGudang` int(11) NOT NULL,
  `Alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gudang`
--

INSERT INTO `gudang` (`KodeGudang`, `Alamat`) VALUES
(1234, 'Kampung Bali, Kota Bengkulu'),
(2111, 'Rawa Makmur, Kota Bengkulu');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `KodeLogin` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `Level` enum('Admin','Operator','Umum') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`KodeLogin`, `Password`, `Level`) VALUES
('1234', 'abrar', 'Admin'),
('12345', 'tamara', 'Operator'),
('123456', 'abrar', 'Umum');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`KodeBarang`);

--
-- Indexes for table `barangdigudang`
--
ALTER TABLE `barangdigudang`
  ADD PRIMARY KEY (`IdTransaksi`),
  ADD KEY `KodeGudang` (`KodeGudang`),
  ADD KEY `KodeBarang` (`KodeBarang`);

--
-- Indexes for table `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`KodeGudang`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`KodeLogin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangdigudang`
--
ALTER TABLE `barangdigudang`
  MODIFY `IdTransaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gudang`
--
ALTER TABLE `gudang`
  MODIFY `KodeGudang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123457;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barangdigudang`
--
ALTER TABLE `barangdigudang`
  ADD CONSTRAINT `barangdigudang_ibfk_1` FOREIGN KEY (`KodeGudang`) REFERENCES `gudang` (`KodeGudang`),
  ADD CONSTRAINT `barangdigudang_ibfk_2` FOREIGN KEY (`KodeBarang`) REFERENCES `barang` (`KodeBarang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
