-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 17, 2016 at 03:26 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


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
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `image` varchar(30) NOT NULL,
  `category` int(25) NOT NULL,
  `description` text NOT NULL,
  `ipaddress` varchar(30) NOT NULL,
  `dat` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `products`
--

