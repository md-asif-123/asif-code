-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 18, 2016 at 03:37 PM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `chl_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `user_id` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `registered_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_activity` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_type` varchar(5) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `user_id`, `password`, `registered_on`, `last_activity`, `user_type`) VALUES
(57, '', 'md.asif.558@gmail.co', 'mynameisasif', '2016-04-27 00:00:00', '0000-00-00 00:00:00', ''),
(58, '', 'tousif@gmail.com', 'mynameistousif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(61, 'admin', 'admin@gmail.com', 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 's');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(4) NOT NULL,
  `category_name` varchar(28) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `parent_id`, `category_name`) VALUES
(1, 0, 'Textile & garments'),
(2, 0, 'Furniturte'),
(3, 0, 'Building materials'),
(4, 0, 'Electronic'),
(5, 0, 'Lighting'),
(6, 0, 'Household & lifts'),
(7, 0, 'Automobiles & motorcycle'),
(8, 0, 'Electricity & new energy'),
(9, 0, 'Machinery'),
(10, 0, 'Food');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` smallint(10) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(50) NOT NULL,
  `pid` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `company_name`, `pid`) VALUES
(1, 'ALBA GARDEN FURNITURE CO.LTD', 0),
(2, 'HANGING GARDEN FURNITURE CO.LTD', 0);

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

CREATE TABLE IF NOT EXISTS `enquiry` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile_no` varchar(20) NOT NULL,
  `product1` varchar(20) NOT NULL,
  `product2` varchar(20) NOT NULL,
  `product3` varchar(20) NOT NULL,
  `product4` varchar(20) NOT NULL,
  `quantity1` varchar(20) NOT NULL,
  `quantity2` varchar(20) NOT NULL,
  `quantity3` varchar(20) NOT NULL,
  `quantity4` varchar(20) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `time` time NOT NULL,
  `product_id` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=72 ;

--
-- Dumping data for table `enquiry`
--

INSERT INTO `enquiry` (`id`, `title`, `firstname`, `surname`, `email`, `mobile_no`, `product1`, `product2`, `product3`, `product4`, `quantity1`, `quantity2`, `quantity3`, `quantity4`, `quantity`, `date`, `time`, `product_id`) VALUES
(1, 'Mr', 'asif', 'iqbal', 'asif@gmail.com', '123456', 'v1', 'b2', 'c3', 'd4', 'q1', 'q2', 'q3', 'q4', '', '', '00:00:00', ''),
(62, '', 'ooo', '', 'ooo', 'oo', 'ooo', 'oo', '', '', '', '', '', '', 'o', '05/18/2016', '00:00:00', ''),
(63, '', 'asif', '', 'asif@gmail.com', '123456', 'oo', 'oo', '', '', '', '', '', '', 'o', '05/18/2016', '00:00:00', ''),
(64, '', 'f', '', 'v', 'sdf', 'dfsd', 'sdf', '', '', 'sd', 'sd', 'sd', 'sd', 'sd', '05/18/2016', '00:00:00', ''),
(65, '', 'f', '', 'v', 'sdf', 'dfsd', 'sdf', 'ss', 'ss', 'sd', 'sd', 'sd', 'sd', 'sd', '05/18/2016', '00:00:00', ''),
(66, '', 'asif', '', 'asif@gmail.com', '123456', 'aa', 'aa', '', '', 'aa', 'aa', '', '', 'aa', '05/19/2016', '00:00:00', ''),
(67, '', 'asif', '', 'asif@gmail.com', '123456', 'aa', 'aa', 'aa', 'aa', 'aa', 'aa', 'dd', 'dd', 'aa', '05/19/2016', '00:00:00', ''),
(68, '', 'QQ', '', 'QQ', 'QQ', 'QQ', 'QQ', '', '', '', '', '', 'QQ', 'QQ', '05/18/2016', '00:00:00', ''),
(69, '', 'asif', '', 'asif@gmail.com', '123456', 'QQ', 'QQ', '', '', '', '45', '', 'QQ', 'QQ', '05/18/2016', '00:00:00', ''),
(70, '', 'WEW', '', 'W', 'W', 'W', 'WE', '', '', '', '', '', '', 'WE', '', '00:00:00', ''),
(71, '', 'asif', '', 'asif@gmail.com', '123456', 'W', 'WE', '', '', '', '', '', '', 'WE', '', '00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `image` varchar(30) NOT NULL,
  `category` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `ipaddress` varchar(30) NOT NULL,
  `dat` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `company_id`, `title`, `image`, `category`, `description`, `ipaddress`, `dat`) VALUES
(3, '1', 'Pra Wiszacy Marina', '11.jpg', 'Household & lifts', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '192.168.0.77', '0000-00-00 00:00:00'),
(4, '2', 'you are welcome', 'logo.png', 'Furniturte', 'industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '192.168.0.77', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
