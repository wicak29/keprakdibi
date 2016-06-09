-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2016 at 04:29 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bi`
--

-- --------------------------------------------------------

--
-- Table structure for table `jangcuk`
--

CREATE TABLE `melody` (
  `uraian` varchar(100) NOT NULL,
  `bali` double(30,8) NOT NULL,
  `badung` double(30,8) NOT NULL,
  `bangli` double(30,8) NOT NULL,
  `buleleng` double(30,8) NOT NULL,
  `jembrana` double(30,8) NOT NULL,
  `karangasem` double(30,8) NOT NULL,
  `klungkung` double(30,8) NOT NULL,
  `tabanan` double(30,8) NOT NULL,
  `denpasar` double(30,8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
