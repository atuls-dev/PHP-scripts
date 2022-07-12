-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 26, 2019 at 05:02 PM
-- Server version: 10.3.13-MariaDB-log
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `threshol_its`
--

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `coupon_id` int(11) NOT NULL,
  `tour_id` int(10) NOT NULL,
  `coupon_code` varchar(20) NOT NULL,
  `discount` int(10) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`coupon_id`, `tour_id`, `coupon_code`, `discount`, `start_date`, `end_date`, `created`) VALUES
(6, 229, 'PRDGPU0DFF', 500, '2019-06-21', '2019-06-23', '2019-06-21 20:37:57'),
(8, 229, 'PR98GTPANS', 600, '2019-06-24', '2019-06-30', '2019-06-24 16:13:12'),
(9, 229, 'PR9Q3EFUDN', 400, '2019-06-24', '2019-06-30', '2019-06-24 20:11:14'),
(10, 223, 'PRW4MHIYE4', 500, '2019-06-24', '2019-06-30', '2019-06-24 22:07:11'),
(11, 223, 'PR06IDOLHJ', 300, '2019-06-22', '2019-06-23', '2019-06-24 22:08:39'),
(12, 223, 'PRP2OY78BF', 400, '2019-06-24', '2019-06-30', '2019-06-24 22:09:03'),
(16, 215, 'PRZ8DNROGK', 4545, '2019-06-27', '2019-06-29', '2019-06-26 19:42:56'),
(17, 224, 'PRGLN55JSV', 7000, '2019-06-22', '2019-06-28', '2019-06-26 19:43:06'),
(19, 221, 'PR4VOQTV0H', 5000, '2019-06-27', '2019-06-30', '2019-06-26 19:52:23'),
(20, 215, 'PRWOWCLXXL', 600, '2019-06-27', '2019-06-30', '2019-06-26 19:53:47'),
(22, 215, 'PRTABNF6SP', 600, '2019-06-27', '2019-06-30', '2019-06-26 20:37:32'),
(24, 220, 'PRBEP8L13L', 600, '2019-06-27', '2019-06-30', '2019-06-26 20:41:31'),
(25, 215, 'PR3C59G3Z0', 4564, '2019-06-27', '2019-06-29', '2019-06-26 20:51:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`coupon_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
