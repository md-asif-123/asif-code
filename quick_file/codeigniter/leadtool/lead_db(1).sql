-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 06, 2016 at 03:04 PM
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
(1, 'nazir', '3', 'bn', 'nazirmallick39@gmail.com', 'bulbul', NULL),
(2, 'Gowebin', '3', 'bn', 'bulbul@gmail.com', 'munni', NULL),
(8, 'HAYATT', '4', 'en', 'bulbul@gmail.com', 'munni', NULL);

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
  `email` varchar(100) NOT NULL,
  `website` varchar(50) NOT NULL,
  `tele_phone` varchar(50) NOT NULL,
  `fax` int(20) NOT NULL,
  `mobile` int(50) NOT NULL,
  `country` varchar(20) NOT NULL,
  `company_name` varchar(250) NOT NULL,
  `industry` varchar(30) NOT NULL,
  `business_type` varchar(50) NOT NULL,
  `unit_price` int(10) NOT NULL,
  `need_sample` varchar(2) NOT NULL,
  `attached` varchar(40) NOT NULL,
  `user_history` varchar(10) NOT NULL,
  `data_source` varchar(40) NOT NULL,
  `detected_languagecode` varchar(30) NOT NULL,
  `manual_languagecode` varchar(3) NOT NULL,
  `comments` text NOT NULL,
  `ipaddress` varchar(100) NOT NULL,
  `dat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `enquires`
--

INSERT INTO `enquires` (`id`, `name`, `email`, `website`, `tele_phone`, `fax`, `mobile`, `country`, `company_name`, `industry`, `business_type`, `unit_price`, `need_sample`, `attached`, `user_history`, `data_source`, `detected_languagecode`, `manual_languagecode`, `comments`, `ipaddress`, `dat`) VALUES
(1, 'Nazir', 'nazir@gmail.com', '', '', 0, 0, '', 'hayat', '3', '', 0, '', '', '', '', 'en', 'cn', 'how are you', '127.0.0.1', '2016-05-05 16:33:57'),
(2, 'Bulbul', 'bulbul@gmail.com', '', '', 0, 0, '', 'HAYATT', '4', '', 0, '', '', '', '', 'en', '', 'how are you', '', '2016-05-05 13:17:59'),
(3, 'Bulbul', 'bulbul@gmail.com', '', '', 0, 0, '', 'HAYATT', '4', '', 0, '', '', '', '', 'en', 'cn', 'test', '', '2016-05-06 11:07:44'),
(4, 'Nazir', 'nothing', 'eee', '1245687', 144557, 895568985, 'Bangladesh', 'hayat', '2', '5', 500, 'Y', '', 'nothing', 'ggg', 'ggg', '', 'ee', '127.0.0.1', '2016-05-06 18:25:18'),
(5, 'Nazir', 'nazir@gmail.com', 'web', '1245687', 144557, 895568985, 'Bangladesh', 'hayat', '2', '5', 500, 'Y', '', 'nothing', 'sss', 'dddd', '', 'sds', '127.0.0.1', '2016-05-06 18:29:07'),
(6, 'Nazir', 'nazir@gmail.com', 'web', '1245687', 144557, 895568985, 'Algeria', 'hayat', '2', '2', 500, 'N', '', 'nothing', 'sss', 'en', '', 'hello', '127.0.0.1', '2016-05-06 18:32:03');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_log`
--

CREATE TABLE IF NOT EXISTS `enquiry_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `last_id` int(11) NOT NULL,
  `Completion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `enquiry_log`
--

INSERT INTO `enquiry_log` (`id`, `last_id`, `Completion`) VALUES
(1, 2, '2016-05-06 15:58:07');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(20) CHARACTER SET latin1 NOT NULL,
  `language_code` varchar(3) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `language`, `language_code`) VALUES
(1, 'English', 'en'),
(2, 'Chinese', 'cn');

-- --------------------------------------------------------

--
-- Table structure for table `translated_message`
--

CREATE TABLE IF NOT EXISTS `translated_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enquery_id` int(10) NOT NULL,
  `message` text NOT NULL,
  `language_code` varchar(3) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `translated_message`
--

INSERT INTO `translated_message` (`id`, `enquery_id`, `message`, `language_code`, `status`) VALUES
(1, 1, 'আপনি কেমন আছেন', 'bn', '0'),
(2, 2, 'how are you', 'en', '0'),
(3, 3, 'test', 'en', '0'),
(4, 1, 'আপনি কেমন আছেন', 'bn', '0'),
(5, 2, 'how are you', 'en', '0'),
(6, 3, 'test', 'en', '0'),
(7, 1, 'আপনি কেমন আছেন', 'bn', '0'),
(8, 2, 'how are you', 'en', '0'),
(9, 3, 'test', 'en', '0'),
(10, 1, 'আপনি কেমন আছেন', 'bn', '0'),
(11, 2, 'how are you', 'en', '0'),
(12, 3, 'test', 'en', '0'),
(13, 1, 'আপনি কেমন আছেন', 'bn', '0'),
(14, 2, 'how are you', 'en', '0'),
(15, 3, 'test', 'en', '0'),
(16, 1, 'আপনি কেমন আছেন', 'bn', '0'),
(17, 2, 'how are you', 'en', '0'),
(18, 3, 'test', 'en', '0'),
(19, 1, 'আপনি কেমন আছেন', 'bn', '0'),
(20, 2, 'how are you', 'en', '0'),
(21, 3, 'test', 'en', '0');

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
