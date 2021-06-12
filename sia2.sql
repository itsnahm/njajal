-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2021 at 01:11 PM
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
-- Database: `sia2`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `IDBarang` int(11) NOT NULL,
  `namabarang` varchar(100) NOT NULL,
  `jumlahbarang` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`IDBarang`, `namabarang`, `jumlahbarang`) VALUES
(1, 'Mic', 0),
(2, 'Baut', 25),
(3, 'Lampu', 13),
(4, 'Kabel', 0),
(5, 'Solder', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `IDTransaksi` int(11) NOT NULL,
  `jenistransaksi` enum('penjualan','pembelian','','') NOT NULL,
  `IDBarang` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`IDTransaksi`, `jenistransaksi`, `IDBarang`, `tanggal`, `jumlah`, `harga`, `total`) VALUES
(14, 'pembelian', 2, '2021-06-11', 15, 1, 15),
(21, 'pembelian', 3, '2021-06-11', 2, 1, 2),
(23, 'penjualan', 2, '2021-06-11', 10, 1, 10),
(25, 'pembelian', 5, '2021-05-01', 5, 1, 5),
(26, 'penjualan', 5, '2021-05-02', 2, 1, 2),
(27, 'penjualan', 5, '2021-05-04', 2, 1, 2),
(28, 'pembelian', 2, '2021-06-11', 8, 2, 16),
(29, 'pembelian', 2, '2021-06-11', 5, 2, 10),
(30, 'pembelian', 3, '2021-06-11', 6, 2, 12),
(31, 'pembelian', 3, '2021-05-08', 2, 1, 2),
(32, 'pembelian', 2, '2021-05-06', 7, 2, 14),
(33, 'pembelian', 3, '2021-05-12', 3, 3, 9);

--
-- Triggers `transaksi`
--
DELIMITER $$
CREATE TRIGGER `HAPUS_BELI` AFTER DELETE ON `transaksi` FOR EACH ROW UPDATE barang
SET jumlahbarang = jumlahbarang - OLD.jumlah
WHERE barang.IDBarang = OLD.IDBarang
AND OLD.jenistransaksi = "pembelian"
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `HAPUS_JUAL` AFTER DELETE ON `transaksi` FOR EACH ROW UPDATE barang 
SET jumlahbarang = jumlahbarang + OLD.jumlah
WHERE barang.IDBarang = OLD.IDBarang
AND OLD.jenistransaksi = "penjualan"
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TAMBAH_BELI` AFTER INSERT ON `transaksi` FOR EACH ROW BEGIN
UPDATE barang SET jumlahbarang = jumlahbarang + new.jumlah
WHERE barang.IDBarang = NEW.IDBarang
AND NEW.jenistransaksi = "pembelian";
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TAMBAH_JUAL` AFTER INSERT ON `transaksi` FOR EACH ROW BEGIN
UPDATE barang SET jumlahbarang = jumlahbarang - new.jumlah
WHERE IDBarang = new.IDBarang
AND NEW.jenistransaksi = "penjualan";
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UBAH_BELI1` AFTER UPDATE ON `transaksi` FOR EACH ROW UPDATE barang
SET jumlahbarang = jumlahbarang - old.jumlah
WHERE barang.IDBarang = OLD.IDBarang 
AND OLD.jenistransaksi = "pembelian"
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UBAH_BELI2` BEFORE UPDATE ON `transaksi` FOR EACH ROW UPDATE barang
SET jumlahbarang = jumlahbarang + NEW.jumlah
WHERE barang.IDBarang = new.IDBarang 
AND new.jenistransaksi = "pembelian"
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UBAH_JUAL1` AFTER UPDATE ON `transaksi` FOR EACH ROW UPDATE barang
SET jumlahbarang = jumlahbarang + old.jumlah
WHERE barang.IDBarang = OLD.IDBarang
AND OLD.jenistransaksi = "penjualan"
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UBAH_JUAL2` BEFORE UPDATE ON `transaksi` FOR EACH ROW UPDATE barang
SET jumlahbarang = jumlahbarang - NEW.jumlah
WHERE barang.IDBarang = new.IDBarang
AND NEW.jenistransaksi = "penjualan"
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`IDBarang`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`IDTransaksi`),
  ADD KEY `IDBarang` (`IDBarang`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `IDBarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `IDTransaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_id_transaksi` FOREIGN KEY (`IDBarang`) REFERENCES `barang` (`IDBarang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
