-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2016 at 02:12 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `b1ver1`
--

-- --------------------------------------------------------

--
-- Table structure for table `URAIAN_APBD`
--

create table URAIAN_APBD 
(
   `ID_URAIAN`            int(11)                        not null,
   `URAIAN`               varchar(60)                    not null,
   constraint PK_URAIAN_APBD primary key (ID_URAIAN)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `URAIAN_APBD`
--

INSERT INTO `URAIAN_APBD` (`ID_URAIAN`, `URAIAN`) VALUES
(1, 'Pendapatan'),
(2, 'PAD'),
(3, 'Pajak daerah'),
(4, 'Retribusi daerah'),
(5, 'Hasil pengelolaan kekayaan daerah yang dipisahkan'),
(6, 'Lain-lain PAD yang sah'),
(7, 'Pendapatan Transfer'),
(8, 'Transfer Pemerintah Pusat - Dana Perimbangan'),
(9, 'Dana Bagi Hasil Pajak'),
(10, 'Dana Bagi Hasil Bukan Pajak (SDA)'),
(11, 'Dana alokasi umum'),
(12, 'Dana alokasi khusus'),
(13, 'Transfer Pemerintah Pusat - Lainnya'),
(14, 'Dana Otonomi Khusus'),
(15, 'Dana Penyesuaian'),
(16, 'Transfer Pemerintah Provinsi'),
(17, 'Pendapatan Bagi Hasil Pajak'),
(18, 'Pendapatan Bagi Hasil Lainnya'),
(19, 'Lain-lain Pendapatan yang sah'),
(20, 'Pendapatan Hibah'),
(21, 'Pendapatan Dana Darurat'),
(22, 'Pendapatan Lainnya'),
(23, 'Belanja'),
(24, 'Belanja Operasi'),
(25, 'Belanja Pegawai'),
(26, 'Belanja Barang'),
(27, 'Belanja Bunga'),
(28, 'Belanja Subsidi'),
(29, 'Belanja Hibah'),
(30, 'Belanja Bantuan sosial'),
(31, 'Belanja Bantuan Keuangan'),
(32, 'Belanja Modal'),
(33, 'Tanah'),
(34, 'Peralatan dan Mesin'),
(35, 'Gedung dan Bangunan'),
(36, 'Jalan, irigasi dan jaringan'),
(37, 'Aset tetap lainnya'),
(38, 'Konstruksi Dalam Pengerjaan'),
(39, 'Aset lainnya'),
(40, 'Belanja tidak terduga'),
(41, 'Belanja tidak terduga'),
(42, 'Transfer'),
(43, 'Bagi Hasil Pajak ke Kab/Kota/Desa'),
(44, 'Bagi Hasil Retribusi ke Kab/Kota/Desa'),
(45, 'Bagi Hasil Lainnya ke Kab/Kota/Desa'),
(46, 'Transfer Lainnya ke Kab/Kota/Desa'),
(47, 'Belanja dan Transfer'),
(48, 'Pembiayaan'),
(49, 'Penerimaan Pembiayaan'),
(50, 'SiLPA TA sebelumnya'),
(51, 'Pencairan dana cadangan'),
(52, 'Hasil Penjualan Kekayaan Daerah yang Dipisahkan '),
(53, 'Penerimaan Pinjaman Daerah dan Obligasi Daerah'),
(54, 'Penerimaan Kembali Pemberian Pinjaman'),
(55, 'Pengeluaran Pembiayaan'),
(56, 'Pembentukan Dana Cadangan'),
(57, 'Penyertaan Modal (Investasi) Daerah'),
(58, 'Pembayaran Pokok Utang '),
(59, 'Pembayaran Kegiatan Lanjutan'),
(60, 'Pembayaran Kegiatan Lanjutan'),
(61, 'Pengeluaran Perhitungan Pihak Ketiga');

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
/*==============================================================*/
/* Table: APBD                                                  */
/*==============================================================*/

create table APBD 
(
   `ID_DAERAH`            int(11)                        not null,
   `ID_URAIAN`            int(11)                        not null,
   `APBD`                 decimal                        null,
   `APBD_P`               decimal                        null,
   `TAHUN`                char(4)                        not null,
   constraint PK_APBD primary key (ID_DAERAH, ID_URAIAN, TAHUN)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


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
  `PERIODE` varchar(20) DEFAULT NULL
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
-- Indexes for table `URAIAN_APBD`
--
-- ALTER TABLE `URAIAN_APBD`
--   ADD PRIMARY KEY (`ID_URAIAN`);

--
-- Indexes for table `daerah`
--
ALTER TABLE `daerah`
  ADD PRIMARY KEY (`ID_DAERAH`);

--
-- Indexes for table `data_apbd`
--
ALTER TABLE `data_apbd`
  ADD PRIMARY KEY (`ID_URAIAN`,`ID_DAERAH`,`ID_KONTAK`,`TAHUN`),
  ADD KEY `FK_DAERAH_APBD2` (`ID_DAERAH`),
  ADD KEY `FK_PEMILIK_DATA` (`ID_KONTAK`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`ID_KONTAK`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_USER`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `URAIAN_APBD`
--
ALTER TABLE `URAIAN_APBD`
  MODIFY `ID_URAIAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
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
  ADD CONSTRAINT `FK_DAERAH_APBD` FOREIGN KEY (`ID_URAIAN`) REFERENCES `URAIAN_APBD` (`ID_URAIAN`),
  ADD CONSTRAINT `FK_DAERAH_APBD2` FOREIGN KEY (`ID_DAERAH`) REFERENCES `daerah` (`ID_DAERAH`),
  ADD CONSTRAINT `FK_PEMILIK_DATA` FOREIGN KEY (`ID_KONTAK`) REFERENCES `kontak` (`ID_KONTAK`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
