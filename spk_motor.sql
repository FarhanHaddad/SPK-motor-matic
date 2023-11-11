-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2022 at 04:58 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_motor`
--

-- --------------------------------------------------------

--
-- Table structure for table `tab_alternatif`
--

CREATE TABLE `tab_alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `nama_alternatif` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tab_alternatif`
--

INSERT INTO `tab_alternatif` (`id_alternatif`, `nama_alternatif`) VALUES
(1, 'Yamaha Fino'),
(2, 'Honda Scoopy'),
(3, 'Suzuki Nex'),
(4, 'Honda Beat Street'),
(5, 'Yamaha X-Ride');

-- --------------------------------------------------------

--
-- Table structure for table `tab_kriteria`
--

CREATE TABLE `tab_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(50) NOT NULL,
  `bobot` float NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tab_kriteria`
--

INSERT INTO `tab_kriteria` (`id_kriteria`, `nama_kriteria`, `bobot`, `status`) VALUES
(1, 'Harga', 4, 'Cost'),
(2, 'Kapasitas Mesin', 2, 'Benefit'),
(3, 'Kapasitas Tengki', 2, 'Benefit'),
(4, 'Warna', 1, 'Benefit'),
(5, 'Model', 1, ' Benefit');

-- --------------------------------------------------------

--
-- Table structure for table `tab_topsis`
--

CREATE TABLE `tab_topsis` (
  `id_alternatif` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tab_topsis`
--

INSERT INTO `tab_topsis` (`id_alternatif`, `id_kriteria`, `nilai`) VALUES
(1, 1, 1),
(1, 2, 3),
(1, 3, 3),
(1, 4, 2),
(1, 5, 2),
(2, 1, 1),
(2, 2, 2),
(2, 3, 2),
(2, 4, 3),
(2, 5, 3),
(3, 1, 3),
(3, 2, 2),
(3, 3, 2),
(3, 4, 2),
(3, 5, 1),
(4, 1, 2),
(4, 2, 2),
(4, 3, 2),
(4, 4, 3),
(4, 5, 3),
(5, 1, 2),
(5, 2, 3),
(5, 3, 3),
(5, 4, 2),
(5, 5, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tab_alternatif`
--
ALTER TABLE `tab_alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `tab_kriteria`
--
ALTER TABLE `tab_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `tab_topsis`
--
ALTER TABLE `tab_topsis`
  ADD PRIMARY KEY (`id_alternatif`,`id_kriteria`) USING BTREE,
  ADD KEY `id_kriteria` (`id_kriteria`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tab_alternatif`
--
ALTER TABLE `tab_alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tab_kriteria`
--
ALTER TABLE `tab_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
