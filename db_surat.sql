-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 13, 2020 at 10:24 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_surat`
--

-- --------------------------------------------------------

--
-- Table structure for table `instansi`
--

CREATE TABLE `instansi` (
  `kd_instansi` varchar(50) NOT NULL,
  `nm_instansi` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `pic` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instansi`
--

INSERT INTO `instansi` (`kd_instansi`, `nm_instansi`, `alamat`, `pic`) VALUES
('Inst001', 'Bank Kaltim', 'Jalan Awang Long Samarinda', 'Mr. Sanjaya'),
('Inst002', 'Bank BCA', 'Jalan Awang Long Samarinda', 'Mr. Budiman'),
('Inst003', 'Bank Mandiri', 'Jalan Juanda 3', 'Mrs. Aura'),
('Inst004', 'Bank Bukopin', 'Jalan Ahmad Dahlan No 67', 'Mrs. Diana'),
('Inst005', 'Bank BRI', 'Jalan Siradj Salman No 77', 'Mr. Jony'),
('Inst006', 'Bank BNI', 'Jalan Ir Haji Juanda', 'Mr. Perdana');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `no_surat` varchar(50) NOT NULL,
  `tgl_surat` date NOT NULL,
  `perihal` varchar(50) NOT NULL,
  `sifat` varchar(50) NOT NULL,
  `kd_instansi` varchar(50) DEFAULT NULL,
  `file` varchar(50) DEFAULT NULL,
  `username` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_keluar`
--

INSERT INTO `surat_keluar` (`no_surat`, `tgl_surat`, `perihal`, `sifat`, `kd_instansi`, `file`, `username`) VALUES
('A.001/ARV/VIII/2020', '2020-08-13', 'Pengadaan Obat Covid', 'Umum', 'Inst001', 'Invoice-377034.pdf', 'root'),
('C.001/ARV/VIII/2020', '2020-08-13', 'Gadai Mobil', 'Penting', 'Inst006', 'C.001_ARV_VIII_2020.pdf', 'maudy97'),
('E.001/ARV/VIII/2020', '2020-08-13', ' Pemasangan Kanopi Garasi', 'UMUM', 'Inst002', 'D.001_ARV_VIII_2020.pdf', 'maudy97'),
('E.002/ARV/VIII/2020', '2020-08-13', 'Berita Acara Serah Terima Barang', 'UMUM', 'Inst002', 'E.002_ARV_VIII_2020.pdf', 'root');

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `no_surat` varchar(30) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_diterima` date NOT NULL,
  `perihal` varchar(50) NOT NULL,
  `sifat` varchar(50) NOT NULL,
  `kd_instansi` varchar(50) DEFAULT NULL,
  `file` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_masuk`
--

INSERT INTO `surat_masuk` (`no_surat`, `tgl_surat`, `tgl_diterima`, `perihal`, `sifat`, `kd_instansi`, `file`) VALUES
('A.001/ARV/VIII/2020', '2020-08-12', '2020-08-12', 'Gadai Mobil VW', 'Umum', 'Inst001', 'C.001_ARV_VIII_2020.pdf'),
('C.001/ARV/VIII/2020', '2020-08-10', '2020-08-10', 'Invoice Tagihan Hutang', 'Private', 'Inst002', 'C.001_ARV_VIII_2020.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(10) NOT NULL,
  `password` varchar(300) NOT NULL,
  `nama_lengkap` varchar(20) NOT NULL,
  `level` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `nama_lengkap`, `level`) VALUES
('maudy97', '$2y$10$kqmWIquz82FfgKh.XXxdke/Z0jvMF8AHNXB7SUp8cufECpDJbKcV6', 'Maudy Ayunda', 'Admin'),
('root', '$2y$10$zMv9CZAcyxtmH6AIi2PIo.0Y9bfkXTXZ8.E7g/vI669ysW9u4ntTi', 'Super User', 'Super Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `instansi`
--
ALTER TABLE `instansi`
  ADD PRIMARY KEY (`kd_instansi`);

--
-- Indexes for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`no_surat`),
  ADD KEY `for username` (`username`),
  ADD KEY `kd_instansi` (`kd_instansi`);

--
-- Indexes for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`no_surat`),
  ADD KEY `kd_instansi` (`kd_instansi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD CONSTRAINT `surat_keluar_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `surat_keluar_ibfk_2` FOREIGN KEY (`kd_instansi`) REFERENCES `instansi` (`kd_instansi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD CONSTRAINT `surat_masuk_ibfk_1` FOREIGN KEY (`kd_instansi`) REFERENCES `instansi` (`kd_instansi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
