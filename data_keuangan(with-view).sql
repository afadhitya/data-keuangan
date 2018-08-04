-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 12, 2018 at 02:55 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data_keuangan`
--

-- --------------------------------------------------------

--
-- Table structure for table `HISTORY_KEUANGAN`
--

CREATE TABLE `HISTORY_KEUANGAN` (
  `ID_HISTORY` int(11) NOT NULL,
  `ID_PENYIMPANAN` int(11) DEFAULT NULL,
  `TANGGAL` date NOT NULL,
  `HARI` varchar(10) NOT NULL,
  `KETERANGAN` text,
  `JUMLAH_HISTORY` int(11) NOT NULL,
  `PENGELUARAN_ATAU_PEMASUKAN` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `history_view`
-- (See below for the actual view)
--
CREATE TABLE `history_view` (
`ID_HISTORY` int(11)
,`ID_PENYIMPANAN` int(11)
,`SUMBER_ATAU_TUJUAN_DANA` varchar(255)
,`TANGGAL` date
,`HARI` varchar(10)
,`KETERANGAN` text
,`JUMLAH_HISTORY` int(11)
,`PENGELUARAN_ATAU_PEMASUKAN` varchar(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `HUTANG`
--

CREATE TABLE `HUTANG` (
  `ID_HUTANG` int(11) NOT NULL,
  `KETERANGAN` text NOT NULL,
  `JUMLAH_HUTANG` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `HUTANG`
--

INSERT INTO `HUTANG` (`ID_HUTANG`, `KETERANGAN`, `JUMLAH_HUTANG`) VALUES
(1, 'Pujas', 7000),
(2, 'Satia', 15000),
(3, 'Paket', 4000),
(4, 'Aksa', 5000),
(5, 'Donate', 14000);

-- --------------------------------------------------------

--
-- Table structure for table `JENIS_PENYIMPANAN`
--

CREATE TABLE `JENIS_PENYIMPANAN` (
  `ID_PENYIMPANAN` int(11) NOT NULL,
  `NAMA` varchar(255) NOT NULL,
  `JUMLAH` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `JENIS_PENYIMPANAN`
--

INSERT INTO `JENIS_PENYIMPANAN` (`ID_PENYIMPANAN`, `NAMA`, `JUMLAH`) VALUES
(1, 'Dompet', 24000),
(2, 'BCA', 361916),
(3, 'BRI', 69773),
(9, 'E-Money Mandiri', 14400),
(10, 'CGV', 67500),
(11, 'Kredit Grab', 78800),
(12, 'Reza', 1000),
(13, 'Winia', 15000);

-- --------------------------------------------------------

--
-- Structure for view `history_view`
--
DROP TABLE IF EXISTS `history_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `history_view`  AS  select `H`.`ID_HISTORY` AS `ID_HISTORY`,`H`.`ID_PENYIMPANAN` AS `ID_PENYIMPANAN`,`JP`.`NAMA` AS `SUMBER_ATAU_TUJUAN_DANA`,`H`.`TANGGAL` AS `TANGGAL`,`H`.`HARI` AS `HARI`,`H`.`KETERANGAN` AS `KETERANGAN`,`H`.`JUMLAH_HISTORY` AS `JUMLAH_HISTORY`,`H`.`PENGELUARAN_ATAU_PEMASUKAN` AS `PENGELUARAN_ATAU_PEMASUKAN` from (`jenis_penyimpanan` `JP` join `history_keuangan` `H`) where (`JP`.`ID_PENYIMPANAN` = `H`.`ID_PENYIMPANAN`) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `HISTORY_KEUANGAN`
--
ALTER TABLE `HISTORY_KEUANGAN`
  ADD PRIMARY KEY (`ID_HISTORY`),
  ADD KEY `FK_HISTORY__RELATIONS_JENIS_PE` (`ID_PENYIMPANAN`);

--
-- Indexes for table `HUTANG`
--
ALTER TABLE `HUTANG`
  ADD PRIMARY KEY (`ID_HUTANG`);

--
-- Indexes for table `JENIS_PENYIMPANAN`
--
ALTER TABLE `JENIS_PENYIMPANAN`
  ADD PRIMARY KEY (`ID_PENYIMPANAN`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `HISTORY_KEUANGAN`
--
ALTER TABLE `HISTORY_KEUANGAN`
  MODIFY `ID_HISTORY` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `HUTANG`
--
ALTER TABLE `HUTANG`
  MODIFY `ID_HUTANG` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `JENIS_PENYIMPANAN`
--
ALTER TABLE `JENIS_PENYIMPANAN`
  MODIFY `ID_PENYIMPANAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `HISTORY_KEUANGAN`
--
ALTER TABLE `HISTORY_KEUANGAN`
  ADD CONSTRAINT `FK_HISTORY__RELATIONS_JENIS_PE` FOREIGN KEY (`ID_PENYIMPANAN`) REFERENCES `JENIS_PENYIMPANAN` (`ID_PENYIMPANAN`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
