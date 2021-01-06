-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2020 at 06:05 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `ad_id` int(11) NOT NULL,
  `ad_uname` varchar(255) NOT NULL,
  `ad_password` varchar(255) NOT NULL,
  `admin_status` int(11) NOT NULL DEFAULT 1,
  `ad_email` varchar(100) NOT NULL,
  `ad_contact` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`ad_id`, `ad_uname`, `ad_password`, `admin_status`, `ad_email`, `ad_contact`) VALUES
(71, 'muhammad5659', 'ad0a8ea0fb1fcb69a573b47b5f02ba1f15d40d41', 1, 'muhammadyounas5659@gmail.com', '031512073741'),
(91, 'myounas365', '7cb1d68261bbda5a95b0957958bb3ff6e9305c6e', 1, 'satej99202@smlmail.net', '03151207272'),
(93, 'admins', '852df284c8eefc88db72f6be8184d58ec6ff571c', 1, 'admin@admin.com', '03151207374'),
(94, 'Rizwan Khan', '852df284c8eefc88db72f6be8184d58ec6ff571c', 1, 'younas@gmail.com', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`ad_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
