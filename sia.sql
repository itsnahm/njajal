-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2021 at 09:03 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sia`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `IDAkun` int(11) NOT NULL,
  `nama` char(100) NOT NULL,
  `email` char(20) NOT NULL,
  `password` char(20) NOT NULL,
  `status` enum('Karyawan','Owner','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`IDAkun`, `nama`, `email`, `password`, `status`) VALUES
(1, 'Admin Percobaan', 'admin@admin.com', 'admin', 'Karyawan'),
(2, 'Lia Ardhani Rusyda', 'lia20@gmail.com', 'admin', 'Owner'),
(3, 'A', 'a@a.com', 'admin', 'Karyawan'),
(4, 'l', 'l@l.com', 'admin', 'Owner'),
(5, 'b', 'b@b.com', 'admin', 'Karyawan'),
(7, 'd', 'd@d.com', 'admin', 'Karyawan');

-- --------------------------------------------------------

--
-- Table structure for table `daftarbarang`
--

CREATE TABLE `daftarbarang` (
  `IDBarang` int(11) NOT NULL,
  `namabarang` varchar(100) NOT NULL,
  `satuan` enum('Biji','Meter','','') NOT NULL,
  `kategori` enum('Kabel','Baut','Mic','Lampu') NOT NULL,
  `jumlahbarang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daftarbarang`
--

INSERT INTO `daftarbarang` (`IDBarang`, `namabarang`, `satuan`, `kategori`, `jumlahbarang`) VALUES
(1, 'Baut Besar 10mm', 'Biji', 'Baut', 539),
(2, 'Baut Kecil 1mm', 'Biji', 'Baut', 5),
(3, 'Mic 10A', 'Biji', 'Mic', 0),
(4, 'Mic ARC', 'Biji', 'Mic', 0),
(5, 'Kabel Mic 90', 'Meter', 'Kabel', 35),
(6, 'Kabel Anten Besar BAC', 'Meter', 'Kabel', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `IDBeli` int(11) NOT NULL,
  `IDBarang` int(11) NOT NULL,
  `jumlahbeli` int(11) NOT NULL,
  `tanggalbeli` date NOT NULL,
  `hargabeli` int(11) NOT NULL,
  `totalpembelian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`IDBeli`, `IDBarang`, `jumlahbeli`, `tanggalbeli`, `hargabeli`, `totalpembelian`) VALUES
(1, 1, 100, '2021-04-26', 200, 0),
(2, 1, 500, '2021-04-26', 200, 0),
(3, 5, 50, '2021-05-02', 15000, 750000),
(4, 2, 10, '2021-05-02', 200, 2000),
(5, 1, 5, '2021-05-06', 1000, 5000),
(6, 1, 6, '2021-05-06', 1000, 6000),
(7, 1, 8, '2021-05-02', 200, 1600),
(8, 5, 5, '2021-05-06', 1000, 5000);

--
-- Triggers `pembelian`
--
DELIMITER $$
CREATE TRIGGER `baru` AFTER UPDATE ON `pembelian` FOR EACH ROW BEGIN
UPDATE daftarbarang SET jumlahbarang = jumlahbarang + new.jumlahbeli
WHERE IDBarang = new.IDBarang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `njajal` AFTER INSERT ON `pembelian` FOR EACH ROW BEGIN
UPDATE daftarbarang SET jumlahbarang = jumlahbarang + new.jumlahbeli
WHERE IDBarang = new.IDBarang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `IDJual` int(11) NOT NULL,
  `IDBarang` int(11) NOT NULL,
  `jumlahjual` int(11) NOT NULL,
  `tanggaljual` date NOT NULL,
  `hargajual` int(11) NOT NULL,
  `totalpenjualan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`IDJual`, `IDBarang`, `jumlahjual`, `tanggaljual`, `hargajual`, `totalpenjualan`) VALUES
(2, 1, 50, '2021-04-26', 500, 0),
(3, 1, 30, '2021-04-26', 500, 0),
(4, 5, 20, '2021-05-02', 25000, 500000),
(5, 2, 5, '2021-05-02', 500, 2500);

--
-- Triggers `penjualan`
--
DELIMITER $$
CREATE TRIGGER `njajal2` AFTER INSERT ON `penjualan` FOR EACH ROW BEGIN
UPDATE daftarbarang SET jumlahbarang = jumlahbarang - new.jumlahjual
WHERE IDBarang = new.IDBarang;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`IDAkun`);

--
-- Indexes for table `daftarbarang`
--
ALTER TABLE `daftarbarang`
  ADD PRIMARY KEY (`IDBarang`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`IDBeli`),
  ADD KEY `IDBarang` (`IDBarang`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`IDJual`),
  ADD KEY `IDBarang` (`IDBarang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `IDAkun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `daftarbarang`
--
ALTER TABLE `daftarbarang`
  MODIFY `IDBarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `IDBeli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `IDJual` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `fk_id_barangbeli` FOREIGN KEY (`IDBarang`) REFERENCES `daftarbarang` (`IDBarang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `fk_id_barangjual` FOREIGN KEY (`IDBarang`) REFERENCES `daftarbarang` (`IDBarang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
