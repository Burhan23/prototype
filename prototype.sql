-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2023 at 08:11 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prototype`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_mrkayu`
--

CREATE TABLE `admin_mrkayu` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'Full Access',
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_mrkayu`
--

INSERT INTO `admin_mrkayu` (`id`, `fname`, `email`, `username`, `role`, `password`) VALUES
(1, 'FARHAN BURHANUDIN SAIFULLAH', 'admin@gmail.com', 'admin', 'Full Akses', 'kelompok3');

-- --------------------------------------------------------

--
-- Table structure for table `bayar`
--

CREATE TABLE `bayar` (
  `id` int(11) NOT NULL,
  `id_investor` varchar(255) NOT NULL,
  `id_pengrajin` varchar(255) NOT NULL,
  `jumlah` int(255) NOT NULL,
  `metode` varchar(255) NOT NULL,
  `nomer` varchar(255) NOT NULL,
  `bukti` varchar(100) NOT NULL DEFAULT 'SCAM',
  `status` varchar(100) NOT NULL DEFAULT '1',
  `id_invest` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bayar`
--

INSERT INTO `bayar` (`id`, `id_investor`, `id_pengrajin`, `jumlah`, `metode`, `nomer`, `bukti`, `status`, `id_invest`) VALUES
(4, '1', '1', 30010000, 'dana', '41142241', 'Bayar_Pemberian_dana1.png', '2', '1');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembayaran`
--

CREATE TABLE `detail_pembayaran` (
  `id_invest` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `admin_username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_pembayaran`
--

INSERT INTO `detail_pembayaran` (`id_invest`, `nama`, `admin_username`) VALUES
('1', 'ID_Bayar14', '');

-- --------------------------------------------------------

--
-- Table structure for table `invest`
--

CREATE TABLE `invest` (
  `id` int(11) NOT NULL,
  `id_investor` varchar(100) NOT NULL,
  `id_pengrajin` varchar(100) NOT NULL,
  `jumlah_dana` int(100) NOT NULL,
  `status_investor` varchar(100) NOT NULL DEFAULT 'Permintaan sudah dikirim, Menunggu respon',
  `status_pengrajin` varchar(100) NOT NULL DEFAULT 'Menunggu respon',
  `status` varchar(100) NOT NULL DEFAULT '1',
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `mou` varchar(100) NOT NULL DEFAULT 'none'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invest`
--

INSERT INTO `invest` (`id`, `id_investor`, `id_pengrajin`, `jumlah_dana`, `status_investor`, `status_pengrajin`, `status`, `tanggal`, `mou`) VALUES
(1, '2', '1', 30000000, 'Menunggu proses pengembalian dari Pengrajin', 'Harap segera melakukan pengembalian', '8', '2023-06-01', 'SURAT_PERJANJIAN_INVESTASI_1_vestor-john.docx'),
(2, '2', '1', 20000000, 'Memproses MOU ke admin', 'Memproses MOU ke admin', '4', '2023-05-22', 'SURAT_PERJANJIAN_INVESTASI_2_vestor-john.docx');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama_product` varchar(50) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `id_users` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama_product`, `gambar`, `deskripsi`, `id_users`) VALUES
(17, 'wrqrwqrw', 't31684393704.jpg', 'ewtwetwe', ''),
(18, 'ereeer', 'm31684394082.png', 'terete', '$1'),
(19, 'erere', 'm11684394131.jpg', 'treer', '1'),
(20, 'ghnggf', 'm11684394146.jpg', 'dfhdfdh', '1'),
(21, 'rrert', 'm41684394157.jpg', 'trereter', '1'),
(22, 'figure kayu 1 karakter', 'tau11684761703.jpg', 'figure pasukan masa depan dari kayu', '1'),
(23, 'figure kayu 1 set', 'tau21684761731.jpg', 'figure pasukan masa depan 1 set dari kayu', '1');

-- --------------------------------------------------------

--
-- Table structure for table `progres_pengrajin`
--

CREATE TABLE `progres_pengrajin` (
  `id` int(11) NOT NULL,
  `id_produk` varchar(50) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `tanggal_mulai` date NOT NULL DEFAULT current_timestamp(),
  `tanggal_selesai` date NOT NULL DEFAULT (current_timestamp() + interval 7 day),
  `status` varchar(50) NOT NULL DEFAULT '0',
  `id_users` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `progres_pengrajin`
--

INSERT INTO `progres_pengrajin` (`id`, `id_produk`, `foto`, `tanggal_mulai`, `tanggal_selesai`, `status`, `id_users`) VALUES
(3, '23', 'none.png', '2023-05-29', '2023-06-05', '0', '1'),
(2, '23', 'none.png', '2023-05-29', '2023-06-05', '0', '1'),
(5, '23', 'Progres_23_1_29 Mei 2023.jpg', '2023-05-29', '2023-06-05', '50', '1');

-- --------------------------------------------------------

--
-- Table structure for table `upgrade`
--

CREATE TABLE `upgrade` (
  `id` int(11) NOT NULL,
  `npwp` varchar(20) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `no_rekening` varchar(20) NOT NULL,
  `deskripsi` text NOT NULL,
  `bukti_ktp` varchar(100) NOT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `upgrade`
--

INSERT INTO `upgrade` (`id`, `npwp`, `nik`, `no_rekening`, `deskripsi`, `bukti_ktp`, `id_users`) VALUES
(3, '21222122221', '212112121212', '121212121222', '', 'bmc.png', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_telepon` varchar(255) NOT NULL,
  `pp` varchar(255) NOT NULL DEFAULT 'default-pp.png',
  `role` varchar(100) NOT NULL,
  `npwp` varchar(100) NOT NULL DEFAULT 'false',
  `nik` varchar(100) NOT NULL DEFAULT 'false',
  `no_rekening` varchar(100) NOT NULL DEFAULT 'false',
  `deskripsi` text NOT NULL DEFAULT 'Ini merupakan desktipsi pengrajin mengenai kerajinan',
  `last_login` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `email`, `username`, `password`, `no_telepon`, `pp`, `role`, `npwp`, `nik`, `no_rekening`, `deskripsi`, `last_login`) VALUES
(1, 'john cena', 'john@gmail.com', 'john', '123', '082331334', 'm3.png', '1', '23132132', '214421124', '421421124', '', '2023-05-29'),
(2, 'Kawal Investor', 'vestor@gmail.com', 'vestor', '123', '0823443465', 'm3.png', '2', '23124124', '142214124', '1421241421', '', '2023-05-22'),
(3, 'Farhan tester', 'farhan@gmail.com', 'farhan', '123', '0835565664', 'Akun Netacad.png', '1', 'false', 'false', 'false', 'Ini merupakan desktipsi pengrajin mengenai kerajinan', '2023-05-22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_mrkayu`
--
ALTER TABLE `admin_mrkayu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `bayar`
--
ALTER TABLE `bayar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invest`
--
ALTER TABLE `invest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `progres_pengrajin`
--
ALTER TABLE `progres_pengrajin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upgrade`
--
ALTER TABLE `upgrade`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `npwp` (`npwp`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD UNIQUE KEY `no_rekening` (`no_rekening`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `no_telepon` (`no_telepon`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bayar`
--
ALTER TABLE `bayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `invest`
--
ALTER TABLE `invest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `progres_pengrajin`
--
ALTER TABLE `progres_pengrajin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `upgrade`
--
ALTER TABLE `upgrade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
