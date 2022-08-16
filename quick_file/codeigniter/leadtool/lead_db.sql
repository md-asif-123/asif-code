-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 30, 2016 at 01:14 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lead_db`
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
-- Table structure for table `company_details`
--

CREATE TABLE IF NOT EXISTS `company_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(50) DEFAULT NULL,
  `industry` varchar(30) NOT NULL,
  `language_code` varchar(3) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `contact_person` varchar(50) DEFAULT NULL,
  `status` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `company_details`
--

INSERT INTO `company_details` (`id`, `company_name`, `industry`, `language_code`, `email`, `contact_person`, `status`) VALUES
(1, 'nazir', '1', 'CN', 'nazirmallick39@gmail.com', 'bulbul', NULL),
(2, 'Gowebin', '1', 'CN', 'bulbul@gmail.com', 'munni', NULL),
(3, 'Gowebin', '1', 'BN', 'bulbul@gmail.com', 'munni', NULL),
(8, 'HAYATT', '2', 'en', 'bulbul@gmail.com', 'munni', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `name` varchar(30) NOT NULL,
  `val` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`name`, `val`) VALUES
('India', 20.00),
('Pakistan', 40.00),
('America', 20.00),
('Canada', 10.00),
('United Kingdom', 10.00);

-- --------------------------------------------------------

--
-- Table structure for table `enquires`
--

CREATE TABLE IF NOT EXISTS `enquires` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `company_name` varchar(250) NOT NULL,
  `industry` varchar(30) NOT NULL,
  `detected_languagecode` varchar(30) NOT NULL,
  `manual_languagecode` varchar(3) NOT NULL,
  `comments` text NOT NULL,
  `ipaddress` varchar(100) NOT NULL,
  `dat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `enquires`
--

INSERT INTO `enquires` (`id`, `name`, `phone`, `email`, `company_name`, `industry`, `detected_languagecode`, `manual_languagecode`, `comments`, `ipaddress`, `dat`) VALUES
(45, 'Nazir', '789541774', 'nazir@gmail.com', 'hayat', '1', 'unsupported1', 'cn', 'test1', '127.0.0.1', '2016-04-30 13:56:47'),
(46, 'Nazir mallick', '789541774', 'nazir@gmail.com', 'Hayat info', '2', 'en', '', 'test2', '127.0.0.1', '2016-04-30 14:39:05'),
(47, 'Bulbul', '9230177951', 'bulbul@gmail.com', 'Gowebin', '3', '', 'hn', 'test3', '', '2016-04-30 14:39:05'),
(48, 'Bulbul', '9230177951', 'bulbul@gmail.com', 'Gowebin', '4', 'cn', 'bn', 'test4', '', '2016-04-30 14:39:05'),
(49, 'Bulbul', '9230177951', 'bulbul@gmail.com', 'Gowebin', '5', 'cn', '', 'test5', '', '2016-04-30 14:39:05'),
(50, 'Nazir', '789541774', 'nazir@gmail.com', 'hayat', '2', '', '', 'dfgf', '127.0.0.1', '2016-04-30 16:42:56');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(20) NOT NULL,
  `language_code` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `languages`
--


-- --------------------------------------------------------

--
-- Table structure for table `translated_message`
--

CREATE TABLE IF NOT EXISTS `translated_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enquery_id` int(10) NOT NULL,
  `message` tinytext NOT NULL,
  `language_code` varchar(3) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=113 ;

--
-- Dumping data for table `translated_message`
--


-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE IF NOT EXISTS `visitors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ipaddress` int(30) NOT NULL,
  `platform` varchar(20) NOT NULL,
  `browser` varchar(10) NOT NULL,
  `date&time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `agentcode` int(5) NOT NULL,
  `countrycode` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `ipaddress`, `platform`, `browser`, `date&time`, `agentcode`, `countrycode`) VALUES
(1, 14552, 'axzaa', 'sxsax', '2016-04-14 14:46:01', 44, 777),
(2, 14552, 'axzaa', 'sxsax', '2016-04-14 14:46:40', 44, 777),
(3, 4545, 'axzaa', 'sxsax', '2016-04-14 14:56:25', 44, 777),
(4, 444, 'sa', 'sss', '2016-04-15 11:25:38', 77, 888),
(5, 444, 'sa', 'sss', '2016-04-15 11:29:04', 77, 888);
