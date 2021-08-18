-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2021 at 12:58 AM
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
-- Database: `reservasi_gedung`
--

-- --------------------------------------------------------

--
-- Table structure for table `diskon`
--

CREATE TABLE `diskon` (
  `id_diskon` int(11) NOT NULL,
  `nama_diskon` varchar(30) NOT NULL,
  `hari` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diskon`
--

INSERT INTO `diskon` (`id_diskon`, `nama_diskon`, `hari`, `diskon`, `keterangan`) VALUES
(2, 'min 10 hari sewa', 10, 40, 'jika menyewa lebih dari 10 hari diskon 40%'),
(3, 'min 2 hari sewa', 2, 10, 'minimal penyewaan 2 hari untuk mendapatkan diskon 10%'),
(4, 'min 5 hari sewa', 5, 30, 'jika menyewa lebih dari 5 hari maka dapat diskon 30%');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id_fasilitas` int(11) NOT NULL,
  `nama_fasilitas` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`id_fasilitas`, `nama_fasilitas`, `deskripsi`, `gambar`) VALUES
(3, 'wewr', 'wer', 'covid.png');

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id_layanan` int(11) NOT NULL,
  `nama_layanan` varchar(50) NOT NULL,
  `harga_reservasi` int(11) NOT NULL,
  `fasilitas` text NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id_layanan`, `nama_layanan`, `harga_reservasi`, `fasilitas`, `gambar`, `deskripsi`) VALUES
(1, 'Acara Malam ini', 7000000, 'air conditioner, sound sistem, kursi futura 260 seat\r\n', 'burger-1.jpg', 'FASILITAS YANG SANGAT BAGUS'),
(4, 'Pemakaian Out Door', 20000000, 'SDA, outdoor / sebelah timur gedung, area parkir untuk acara katering', 'burger-2.jpg', 'germo asu dan lain-lain'),
(5, 'gedung haji', 2000000, 'lama tak jumpa', 'dessert-2.jpg', 'LONTE YANG SANGAT NGEFUCK ANJING BANGSAT'),
(6, 'LONTE ANJING', 90000, 'lonte sehat, lonte sakit, hiv aids, gigolo, ', 'dish-1.jpg', 'ini adalah layanan untuk melayani om om kesepian dan juga buaya darat dan laki-laki hidung belang');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nomor_reservasi` varchar(12) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_layanan` int(11) NOT NULL,
  `nik` int(11) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `lama_reservasi` int(11) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `keterangan` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nomor_reservasi`, `id_user`, `id_layanan`, `nik`, `nama_pelanggan`, `tgl_mulai`, `tgl_akhir`, `total_bayar`, `lama_reservasi`, `no_hp`, `keterangan`, `status`) VALUES
(32, 'PW000001', 1, 3, 1234, 'andri', '2021-03-15', '2021-03-17', 37800000, 3, '098765787', 'pernikahan anak saya', 2),
(33, 'PW000033', 1, 4, 1234, 'rohman', '2021-03-23', '2021-03-24', 36000000, 2, '98997979', 'anak saya sunatan pak', 3),
(34, 'pw000002', 2, 4, 1234, 'sewon', '2021-02-10', '2021-03-15', 50000000, 5, '098777', 'sunatan', 4),
(35, 'PW000035', 1, 3, 1234, 'reza', '2021-04-07', '2021-04-10', 50400000, 4, '092398', '12345678', 3),
(36, 'PW000036', 1, 4, 1234, 'mega', '2021-03-30', '2021-03-31', 36000000, 2, '9898898958', 'pernikahan', 3),
(37, 'PW000037', 1, 3, 23423, 'kksdsdkkf', '2021-03-28', '2021-03-29', 25200000, 2, '98998798', 'khkjhjh', 2),
(39, 'PW000039', 1, 4, 3423423, 'andra', '2021-06-15', '2021-06-17', 54000000, 3, '009897878', 'werwer', 3);

-- --------------------------------------------------------

--
-- Table structure for table `reservasi`
--

CREATE TABLE `reservasi` (
  `id_reservasi` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tgl_reservasi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservasi`
--

INSERT INTO `reservasi` (`id_reservasi`, `id_pelanggan`, `tgl_reservasi`) VALUES
(64, 33, '2021-03-23'),
(65, 33, '2021-03-24'),
(66, 35, '2021-04-07'),
(67, 35, '2021-04-08'),
(68, 35, '2021-04-09'),
(69, 35, '2021-04-10'),
(70, 36, '2021-03-30'),
(71, 36, '2021-03-31'),
(72, 39, '2021-06-15'),
(73, 39, '2021-06-16'),
(74, 39, '2021-06-17');

-- --------------------------------------------------------

--
-- Table structure for table `testimoni`
--

CREATE TABLE `testimoni` (
  `id_testimoni` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `testi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimoni`
--

INSERT INTO `testimoni` (`id_testimoni`, `id_pelanggan`, `testi`) VALUES
(2, 29, 'menurut saya pengelola sangat ramah dan membantu sekali dalam menangani masalah-masalah yang ada pada saat acara'),
(3, 36, 'sangat menyentuh hati');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `name`, `image`, `password`, `role_id`) VALUES
(34, 'Aji Prasetiyo', 'default.jpg', '$2y$10$dCESS3a88IDBBZ5.hdffluotlb1Pa7.f5glq0N45jZonUVW0kVclq', 1),
(39, 'Novianti', 'default.jpg', '$2y$10$gIeIf6iBnW6m7zAFT6Pm6e.Eypquyoz/CfEAf.eVWyuOzzdyA3H6a', 2),
(44, 'andri', 'default.jpg', '$2y$10$hdxW4fDVQn.Ckz009u/D0eMxNoz50sPwAAUn1e/8J3xVELb77CEYe', 1),
(45, 'rahmat', 'default.jpg', '$2y$10$IuaXi7DJNmuepOyTu4Y4eOpKmyR7ST3wSM1BWaMAMLSp4cwcW39Qi', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diskon`
--
ALTER TABLE `diskon`
  ADD PRIMARY KEY (`id_diskon`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id_fasilitas`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id_layanan`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `reservasi`
--
ALTER TABLE `reservasi`
  ADD PRIMARY KEY (`id_reservasi`);

--
-- Indexes for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`id_testimoni`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diskon`
--
ALTER TABLE `diskon`
  MODIFY `id_diskon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id_fasilitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id_layanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `reservasi`
--
ALTER TABLE `reservasi`
  MODIFY `id_reservasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `id_testimoni` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
