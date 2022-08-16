-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2017 at 07:03 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kidsworldenglish`
--

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `student_name` varchar(75) NOT NULL,
  `gurdian_name` varchar(254) NOT NULL,
  `contact_no` varchar(25) NOT NULL,
  `age` varchar(50) NOT NULL,
  `admission_on_class` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `gender` varchar(5) NOT NULL,
  `correspondance_address` text NOT NULL,
  `permanent_address` text NOT NULL,
  `comment` text NOT NULL,
  `addedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `student_name`, `gurdian_name`, `contact_no`, `age`, `admission_on_class`, `email`, `dob`, `gender`, `correspondance_address`, `permanent_address`, `comment`, `addedon`) VALUES
(1, 'md asif', 'abdul azim', '+91 758965845', '12', '5', 'md.asif.558@gmail.com', '12/02/89', 'm', 'kaikhali\r\nkolkata', 'murarai\r\nbirbhum\r\n', 'this is testing', '2017-01-06 13:18:45'),
(2, 'md asif', 'abdul azim', '+91 758965845', '8', '5', 'md.asif.558@gmail.com', '05/18/2016', 'm', 'kaikhali\r\nkolkat', 'paikar\r\nbirbhum', 'this is just testing', '2017-01-06 13:49:56'),
(3, 'imran', 'khan', '+91 758965845', '22', 'b tech', 'md.asif.558@gmail.com', '05/08/2016', 'm', 'hhj\r\nijio', 'jjkjopiji\r\nkojk', 'testing', '2017-01-11 11:29:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
