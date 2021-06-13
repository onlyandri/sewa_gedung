-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2021 at 09:29 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sewa_gedung`
--

-- --------------------------------------------------------

--
-- Table structure for table `penyewa`
--

CREATE TABLE `penyewa` (
  `id_penyewa` int(11) NOT NULL,
  `nomor_sewa` varchar(12) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_gedung` int(11) NOT NULL,
  `nik` int(11) NOT NULL,
  `nama_penyewa` varchar(50) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `lama_sewa` int(11) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `keterangan` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penyewa`
--

INSERT INTO `penyewa` (`id_penyewa`, `nomor_sewa`, `id_user`, `id_gedung`, `nik`, `nama_penyewa`, `tgl_mulai`, `tgl_akhir`, `total_bayar`, `lama_sewa`, `no_hp`, `keterangan`, `status`) VALUES
(32, 'PW000001', 1, 3, 1234, 'andri', '2021-03-15', '2021-03-17', 37800000, 3, '098765787', 'pernikahan anak saya', 2),
(33, 'PW000033', 1, 4, 1234, 'rohman', '2021-03-23', '2021-03-24', 36000000, 2, '98997979', 'anak saya sunatan pak', 3),
(34, 'pw000002', 2, 4, 1234, 'sewon', '2021-02-10', '2021-03-15', 50000000, 5, '098777', 'sunatan', 3),
(35, 'PW000035', 1, 3, 1234, 'reza', '2021-04-07', '2021-04-10', 50400000, 4, '092398', '12345678', 3),
(36, 'PW000036', 1, 4, 1234, 'mega', '2021-03-30', '2021-03-31', 36000000, 2, '9898898958', 'pernikahan', 3),
(37, 'PW000037', 1, 3, 23423, 'kksdsdkkf', '2021-03-28', '2021-03-29', 25200000, 2, '98998798', 'khkjhjh', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `penyewa`
--
ALTER TABLE `penyewa`
  ADD PRIMARY KEY (`id_penyewa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `penyewa`
--
ALTER TABLE `penyewa`
  MODIFY `id_penyewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
