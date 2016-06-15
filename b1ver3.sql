-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2016 at 05:35 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `b1ver2`
--

-- --------------------------------------------------------

--
-- Table structure for table `apbd`
--

CREATE TABLE `apbd` (
  `ID_DAERAH` int(11) NOT NULL,
  `ID_URAIAN` int(11) NOT NULL,
  `APBD` decimal(10,0) DEFAULT NULL,
  `APBD_P` decimal(10,0) DEFAULT NULL,
  `TAHUN` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `daerah`
--

CREATE TABLE `daerah` (
  `ID_DAERAH` int(11) NOT NULL,
  `NAMA_DAERAH` varchar(25) NOT NULL,
  `KATEGORI` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daerah`
--

INSERT INTO `daerah` (`ID_DAERAH`, `NAMA_DAERAH`, `KATEGORI`) VALUES
(1, 'Prov. Bali', 'Provinsi'),
(2, 'Kab. Badung', 'Kabupaten/Kota'),
(3, 'Kab. Bangli', 'Kabupaten/Kota'),
(4, 'Kab. Buleleng', 'Kabupaten/Kota'),
(5, 'Kab. Gianyar', 'Kabupaten/Kota'),
(6, 'Kab. Jembrana', 'Kabupaten/Kota'),
(7, 'Kab. Karangasem', 'Kabupaten/Kota'),
(8, 'Kab. Klungkung', 'Kabupaten/Kota'),
(9, 'Kab. Tabanan', 'Kabupaten/Kota'),
(10, 'Kota Denpasar', 'Kabupaten/Kota');

-- --------------------------------------------------------

--
-- Table structure for table `data_apbd`
--

CREATE TABLE `data_apbd` (
  `ID_URAIAN` int(11) NOT NULL,
  `ID_DAERAH` int(11) NOT NULL,
  `ID_KONTAK` int(11) NOT NULL,
  `NILAI_REALISASI` double(30,8) DEFAULT NULL,
  `PERSEN_REALISASI` double(30,8) DEFAULT NULL,
  `TAHUN` char(4) NOT NULL,
  `PERIODE` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `ID_KONTAK` int(11) NOT NULL,
  `NAMA_INSTANSI` varchar(50) NOT NULL,
  `NO_TELEPON` varchar(15) DEFAULT NULL,
  `EMAIL` varchar(30) DEFAULT NULL,
  `ALAMAT` varchar(50) DEFAULT NULL,
  `PIC` varchar(50) DEFAULT NULL,
  `PREFERRED_CONTACT` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kontak`
--

INSERT INTO `kontak` (`ID_KONTAK`, `NAMA_INSTANSI`, `NO_TELEPON`, `EMAIL`, `ALAMAT`, `PIC`, `PREFERRED_CONTACT`) VALUES
(1, 'wew', '085792305910', 'aa@gmail.com', 'asasasa', 'sasasasa', '085792305910');

-- --------------------------------------------------------

--
-- Table structure for table `uraian_apbd`
--

CREATE TABLE `uraian_apbd` (
  `ID_URAIAN` int(11) NOT NULL,
  `URAIAN` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uraian_apbd`
--

INSERT INTO `uraian_apbd` (`ID_URAIAN`, `URAIAN`) VALUES
(1, 'PENDAPATAN DAERAH'),
(2, 'PEND. ASLI DAERAH (PAD)'),
(3, ' Pendapatan Pajak Daerah'),
(4, 'Retribusi Daerah'),
(5, 'Hsl PMD & Hsl Pengel. Kek. Daerah yg dipisahkan'),
(6, 'Lain-Lain PAD yg Sah'),
(7, 'DANA PERIMBANGAN'),
(8, 'Bagi hasil pajak dan bukan pajak'),
(9, 'Dana Alokasi Umum (DAU)'),
(10, 'Dana Alokasi Khusus (DAK)'),
(11, 'Dana Penguatan Infrastruktur Daerah'),
(12, 'LAIN-LAIN PENDAPATAN YG SAH'),
(13, 'Pendapatan Hibah'),
(14, 'Dana bagi hsl pajak dr Prov & pemda lainnya'),
(15, 'Dana Penyesuaian & otonomi khusus'),
(16, 'Bantuan Keuangan dr Prov atau Pemda lain'),
(17, 'Sumbangan Pihak Ketiga'),
(18, 'Alokasi Kurang Bayar DAK'),
(19, 'BELANJA DAERAH'),
(20, 'BELANJA TIDAK LANGSUNG'),
(21, 'Belanja Pegawai'),
(22, 'Belanja Barang '),
(23, 'Belanja Subsidi'),
(24, 'Belanja Hibah'),
(25, 'Belanja Bantuan Sosial'),
(26, 'Belanja Bagi Hsl kpd Prov/Kab/Kota & Pemda'),
(27, 'Belanja Bantuan Keuangan kpd Prov/Kab/Kota/Desa'),
(28, 'Belanja Tidak Terduga'),
(29, 'BELANJA LANGSUNG'),
(30, 'Belanja Pegawai'),
(31, 'Belanja Barang dan Jasa'),
(32, 'Belanja Modal'),
(33, 'SURPLUS/(DEFISIT)'),
(34, 'PEMBIAYAAN'),
(35, 'PENERIMAAN DAERAH'),
(36, 'Penggunaan Sisa Lebih Perhitungan Anggaran (SILPA)'),
(37, 'PENGELUARAN DAEARAH'),
(38, 'Penyertaan Modal (Investasi) Pemerintah Daerah'),
(39, 'Penguatan Modal Pemerintah Daerah'),
(40, 'PEMBIAYAAN NETTO'),
(41, 'SISA LEBIH PEMBIAYAAN ANGGARAN (SILPA)'),
(42, NULL),
(43, NULL),
(44, NULL),
(45, NULL),
(46, NULL),
(47, NULL),
(48, NULL),
(49, NULL),
(50, NULL),
(51, NULL),
(52, NULL),
(53, NULL),
(54, NULL),
(55, NULL),
(56, NULL),
(57, NULL),
(58, NULL),
(59, NULL),
(60, NULL),
(61, NULL),
(62, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID_USER` int(11) NOT NULL,
  `USERNAME` varchar(20) NOT NULL,
  `PASSWORD` varchar(40) NOT NULL,
  `LEVEL` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apbd`
--
ALTER TABLE `apbd`
  ADD PRIMARY KEY (`ID_DAERAH`,`ID_URAIAN`,`TAHUN`);

--
-- Indexes for table `daerah`
--
ALTER TABLE `daerah`
  ADD PRIMARY KEY (`ID_DAERAH`);

--
-- Indexes for table `data_apbd`
--
ALTER TABLE `data_apbd`
  ADD PRIMARY KEY (`ID_URAIAN`,`ID_DAERAH`,`ID_KONTAK`,`TAHUN`,`PERIODE`),
  ADD KEY `FK_DAERAH_APBD2` (`ID_DAERAH`),
  ADD KEY `FK_PEMILIK_DATA` (`ID_KONTAK`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`ID_KONTAK`);

--
-- Indexes for table `uraian_apbd`
--
ALTER TABLE `uraian_apbd`
  ADD PRIMARY KEY (`ID_URAIAN`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_USER`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daerah`
--
ALTER TABLE `daerah`
  MODIFY `ID_DAERAH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `kontak`
--
ALTER TABLE `kontak`
  MODIFY `ID_KONTAK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `uraian_apbd`
--
ALTER TABLE `uraian_apbd`
  MODIFY `ID_URAIAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_apbd`
--
ALTER TABLE `data_apbd`
  ADD CONSTRAINT `FK_DAERAH_APBD` FOREIGN KEY (`ID_URAIAN`) REFERENCES `uraian_apbd` (`ID_URAIAN`),
  ADD CONSTRAINT `FK_DAERAH_APBD2` FOREIGN KEY (`ID_DAERAH`) REFERENCES `daerah` (`ID_DAERAH`),
  ADD CONSTRAINT `FK_PEMILIK_DATA` FOREIGN KEY (`ID_KONTAK`) REFERENCES `kontak` (`ID_KONTAK`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
