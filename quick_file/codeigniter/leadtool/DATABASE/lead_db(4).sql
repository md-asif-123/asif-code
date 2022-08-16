-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 03, 2016 at 11:21 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


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
(57, '', 'asif@gmail.com', 'asif', '2016-04-27 00:00:00', '0000-00-00 00:00:00', ''),
(58, '', 'tousif@gmail.com', 'tousif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(61, 'admindd', 'admin@gmail.com', 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 's');

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
-- Table structure for table `core_config_data`
--

CREATE TABLE IF NOT EXISTS `core_config_data` (
  `config_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Config Id',
  `scope` varchar(8) NOT NULL DEFAULT 'default' COMMENT 'Config Scope',
  `scope_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Config Scope Id',
  `path` varchar(255) NOT NULL DEFAULT 'general' COMMENT 'Config Path',
  `value` text COMMENT 'Config Value',
  PRIMARY KEY (`config_id`),
  UNIQUE KEY `UNQ_CORE_CONFIG_DATA_SCOPE_SCOPE_ID_PATH` (`scope`,`scope_id`,`path`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Config Data' AUTO_INCREMENT=12 ;

--
-- Dumping data for table `core_config_data`
--

INSERT INTO `core_config_data` (`config_id`, `scope`, `scope_id`, `path`, `value`) VALUES
(1, 'default', 0, 'general/region/display_all', '1'),
(2, 'default', 0, 'general/region/state_required', 'AT,CA,CH,DE,EE,ES,FI,FR,LT,LV,RO,US'),
(3, 'default', 0, 'web/seo/use_rewrites', '1'),
(4, 'default', 0, 'admin/dashboard/enable_charts', '1'),
(5, 'default', 0, 'web/unsecure/base_url', 'http://192.168.0.3/magento1800/'),
(6, 'default', 0, 'web/secure/base_url', 'http://192.168.0.3/magento1800/'),
(7, 'default', 0, 'general/locale/code', 'en_US'),
(8, 'default', 0, 'general/locale/timezone', 'America/Los_Angeles'),
(9, 'default', 0, 'currency/options/base', 'USD'),
(10, 'default', 0, 'currency/options/default', 'USD'),
(11, 'default', 0, 'currency/options/allow', 'USD');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `name` varchar(30) NOT NULL,
  `val` decimal(10,2) NOT NULL,
  `gdp` varchar(5) NOT NULL,
  `score` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`name`, `val`, `gdp`, `score`) VALUES
('India', 20.00, '', 5),
('Pakistan', 40.00, '', 10),
('America', 20.00, '', 15),
('Canada', 10.00, '', 20),
('United Kingdom', 10.00, '', 25);

-- --------------------------------------------------------

--
-- Table structure for table `email_account`
--

CREATE TABLE IF NOT EXISTS `email_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `email_password` varchar(100) NOT NULL,
  `smtp` varchar(100) NOT NULL,
  `smtp_port` int(50) NOT NULL,
  `pop` varchar(100) NOT NULL,
  `pop_port` int(50) NOT NULL,
  `imap` varchar(100) NOT NULL,
  `imap_port` int(50) NOT NULL,
  `value` int(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `email_account`
--

INSERT INTO `email_account` (`id`, `email`, `email_password`, `smtp`, `smtp_port`, `pop`, `pop_port`, `imap`, `imap_port`, `value`, `status`, `added_on`) VALUES
(2, 'tousif@gmail.com', 't', 'sad', 45, '22', 0, '45', 0, 34, 0, '2016-05-30 13:00:13'),
(3, 'asif@gmail.com', 'dsa', '', 3, '3', 0, '3', 0, 0, 1, '2016-05-30 11:59:18'),
(4, 'hussain@gmail.com', '4', '', 4, '5', 0, '5', 0, 0, 0, '2016-05-31 10:35:58'),
(5, 'asif@gmail.com', 'asif', 'sad', 434, 'sd', 443, 'fds', 3434, 0, 0, '2016-05-31 10:44:34'),
(6, 's@gmail.com', 'sdf', 'fg', 455, 'gfds', 345, 'egf', 454, 0, 1, '2016-05-30 12:22:42'),
(7, 'nazir@gmail.com', 'n', 'df', 34, 'df', 34, 'def', 344, 3, 1, '2016-06-03 05:50:39'),
(8, 'nazir@gmail.com', 'n', 'fd', 232, 'fd', 32, 'fd', 54, 3, 1, '2016-06-03 06:16:57');

-- --------------------------------------------------------

--
-- Table structure for table `email_check`
--

CREATE TABLE IF NOT EXISTS `email_check` (
  `id` int(11) NOT NULL,
  `email_id` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `email_type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_check`
--

INSERT INTO `email_check` (`id`, `email_id`, `email_type`) VALUES
(0, 'gmail.com', 0),
(0, 'rediffmail.com', 0);

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
  `business_type` varchar(18) NOT NULL,
  `unit_price` int(10) NOT NULL,
  `need_sample` varchar(2) NOT NULL,
  `attached` varchar(18) DEFAULT NULL,
  `user_history` varchar(10) NOT NULL,
  `data_source` varchar(40) NOT NULL,
  `detected_languagecode` varchar(30) NOT NULL,
  `manual_languagecode` varchar(3) NOT NULL,
  `comments` text CHARACTER SET utf8 NOT NULL,
  `score_country` int(4) NOT NULL,
  `score_industry` int(4) NOT NULL,
  `score_companyname` int(4) NOT NULL,
  `score_businesstype` int(4) NOT NULL,
  `score_contactinformation` int(4) NOT NULL,
  `score_enquiredescription` int(4) NOT NULL,
  `score_unitprice` int(4) NOT NULL,
  `score_sample` int(4) NOT NULL,
  `score_attachedment` int(4) NOT NULL,
  `score_userhistory` int(4) NOT NULL,
  `score_datasource` int(4) NOT NULL,
  `ipaddress` varchar(100) NOT NULL,
  `dat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `enquires`
--

INSERT INTO `enquires` (`id`, `name`, `email`, `website`, `tele_phone`, `fax`, `mobile`, `country`, `company_name`, `industry`, `business_type`, `unit_price`, `need_sample`, `attached`, `user_history`, `data_source`, `detected_languagecode`, `manual_languagecode`, `comments`, `score_country`, `score_industry`, `score_companyname`, `score_businesstype`, `score_contactinformation`, `score_enquiredescription`, `score_unitprice`, `score_sample`, `score_attachedment`, `score_userhistory`, `score_datasource`, `ipaddress`, `dat`) VALUES
(17, 'Nazir mallick', 'nazir@gmail.com', 'web', '1245687', 144557, 895568985, 'Afghanistan', 'hayat', '1', 'manufacture', 500, 'Y', NULL, 'nothing', 'sss', 'en', '', 'dsfs', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '127.0.0.1', '2016-05-10 11:07:51'),
(18, 'Nazir', 'nazir@gmail.com', 'web', '1245687', 144557, 895568985, 'Bahamas The', 'hayat', '1', 'manufacture', 500, 'Y', 'test27.txt', 'nothing', 'sss', 'en', '', 'i玩透透喔碟', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '127.0.0.1', '2016-05-11 21:32:06'),
(23, 'Nazir mallick', 'nazir@gmail.com', 'ww.hayat.in', '1245687', 144557, 895568985, '10', 'Hayat info', '5', '10', 500, '10', 'value31.txt', '1', '', 'en', '', 'hi', 10, 5, 10, 10, 20, 1, 10, 10, 10, 0, 0, '127.0.0.1', '2016-05-11 23:10:15'),
(24, 'Nazir mallick', 'nazir@gmail.com', 'ww.hayat.in', '1245687', 144557, 895568985, '10', 'Hayat info', '5', '10', 500, '10', 'value32.txt', '1', '', 'en', '', 'hi', 10, 5, 10, 10, 20, 1, 10, 10, 10, 0, 0, '127.0.0.1', '2016-05-11 23:10:41'),
(39, 'Nazir', 'nazir@gmail.com', 'web', '1245687', 144557, 895568985, 'India', 'hayat', '1', '10', 500, '10', 'value34.txt', '1', '', 'en', 'af', 'hi', 5, 10, 10, 10, 20, 1, 10, 10, 10, 0, 0, '127.0.0.1', '2016-05-23 12:25:18'),
(59, 'TC001', 'bulbul@gmail.comlio', 'web', '1245687', 144557, 895568985, 'Pakistan', 'Hayat info', '1', '10', 500, '0', 'N', '1', '', 'en', '', 'hi', 10, 5, 10, 10, 15, 1, 10, 0, 0, 0, 0, '127.0.0.1', '2016-05-31 05:56:35');

-- --------------------------------------------------------

--
-- Table structure for table `enquires_backup`
--

CREATE TABLE IF NOT EXISTS `enquires_backup` (
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
  `business_type` varchar(18) NOT NULL,
  `unit_price` int(10) NOT NULL,
  `need_sample` varchar(2) NOT NULL,
  `attached` varchar(18) DEFAULT NULL,
  `user_history` varchar(10) NOT NULL,
  `data_source` varchar(40) NOT NULL,
  `detected_languagecode` varchar(30) NOT NULL,
  `manual_languagecode` varchar(3) NOT NULL,
  `comments` text CHARACTER SET utf8 NOT NULL,
  `score_country` int(4) NOT NULL,
  `score_industry` int(4) NOT NULL,
  `score_companyname` int(4) NOT NULL,
  `score_businesstype` int(4) NOT NULL,
  `score_contactinformation` int(4) NOT NULL,
  `score_enquiredescription` int(4) NOT NULL,
  `score_unitprice` int(4) NOT NULL,
  `score_sample` int(4) NOT NULL,
  `score_attachedment` int(4) NOT NULL,
  `score_userhistory` int(4) NOT NULL,
  `score_datasource` int(4) NOT NULL,
  `ipaddress` varchar(100) NOT NULL,
  `dat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `enquires_backup`
--

INSERT INTO `enquires_backup` (`id`, `name`, `email`, `website`, `tele_phone`, `fax`, `mobile`, `country`, `company_name`, `industry`, `business_type`, `unit_price`, `need_sample`, `attached`, `user_history`, `data_source`, `detected_languagecode`, `manual_languagecode`, `comments`, `score_country`, `score_industry`, `score_companyname`, `score_businesstype`, `score_contactinformation`, `score_enquiredescription`, `score_unitprice`, `score_sample`, `score_attachedment`, `score_userhistory`, `score_datasource`, `ipaddress`, `dat`) VALUES
(17, 'Nazir mallick', 'nazir@gmail.com', 'web', '1245687', 144557, 895568985, 'Afghanistan', 'hayat', '1', 'manufacture', 500, 'Y', NULL, 'nothing', 'sss', 'en', '', 'dsfs', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '127.0.0.1', '2016-05-10 11:07:51'),
(18, 'Nazir', 'nazir@gmail.com', 'web', '1245687', 144557, 895568985, 'Bahamas The', 'hayat', '1', 'manufacture', 500, 'Y', 'test27.txt', 'nothing', 'sss', 'en', '', 'i玩透透喔碟', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '127.0.0.1', '2016-05-11 21:32:06'),
(19, 'Nazir', 'nazir@gmail.com', 'web', '1245687', 144557, 895568985, '15', 'Hayat info', '5', '10', 500, '10', 'value27.txt', '1', '', 'en', '', 'dff', 15, 5, 10, 10, 20, 1, 10, 10, 10, 0, 0, '127.0.0.1', '2016-05-11 21:26:34'),
(20, 'Nazir', 'nazir@gmail.com', '', '65', 0, 5765, '5', 'Hayat info', '10', '10', 500, '10', 'value28.txt', '1', '', 'vi', '', 'vvv', 5, 10, 10, 10, 15, 1, 10, 10, 10, 0, 0, '127.0.0.1', '2016-05-11 21:30:49'),
(21, 'Nazir mallick', 'nazir@gmail.com', 'ww.hayat.in', '1245687', 144557, 895568985, '5', 'hayat', '10', '10', 500, '10', 'N', '1', '', 'zh-CN', '', 'i玩透透喔碟', 5, 10, 10, 10, 20, 1, 10, 10, 0, 0, 0, '127.0.0.1', '2016-05-11 21:33:06'),
(22, 'Nazir mallick', 'nazir@gmail.com', 'ww.hayat.in', '1245687', 144557, 895568985, '15', 'hayat', '10', '10', 500, '0', 'test95.txt', '1', '', 'en', '', 'Hi', 15, 10, 10, 10, 20, 1, 10, 0, 10, 0, 0, '127.0.0.1', '2016-05-11 21:47:09'),
(23, 'Nazir mallick', 'nazir@gmail.com', 'ww.hayat.in', '1245687', 144557, 895568985, '10', 'Hayat info', '5', '10', 500, '10', 'value31.txt', '1', '', 'en', '', 'hi', 10, 5, 10, 10, 20, 1, 10, 10, 10, 0, 0, '127.0.0.1', '2016-05-11 23:10:15'),
(24, 'Nazir mallick', 'nazir@gmail.com', 'ww.hayat.in', '1245687', 144557, 895568985, '10', 'Hayat info', '5', '10', 500, '10', 'value32.txt', '1', '', 'en', '', 'hi', 10, 5, 10, 10, 20, 1, 10, 10, 10, 0, 0, '127.0.0.1', '2016-05-11 23:10:41'),
(25, 'Nazir mallick', 'nazir@gmail.com', 'ww.hayat.in', '63568954', 144557, 895568985, 'America', 'Hayat info', '10', '10', 500, '10', 'N', '1', '', 'en', '', 'hi', 15, 10, 10, 10, 20, 1, 10, 10, 0, 0, 0, '127.0.0.1', '2016-05-11 23:12:23'),
(26, 'Nazir', 'nazir@gmail.com', 'ww.hayat.in', '63568954', 144557, 895568985, 'Pakistan', 'Hayat info', '10', '10', 500, '10', 'N', '1', '', 'en', '', 'sss', 10, 10, 10, 10, 20, 1, 10, 10, 0, 0, 0, '127.0.0.1', '2016-05-12 00:57:44'),
(27, 'Nazir', 'nazir@gmail.com', 'ww.hayat.in', '63568954', 144557, 895568985, 'Pakistan', 'Hayat info', '10', '10', 500, '10', 'N', '1', '', 'en', '', 'sss', 10, 10, 10, 10, 20, 1, 10, 10, 0, 0, 0, '127.0.0.1', '2016-05-12 00:58:28'),
(28, 'Nazir', 'nazir@gmail.com', 'ww.hayat.in', '63568954', 144557, 895568985, 'Pakistan', 'Hayat info', '10', '10', 500, '10', 'N', '1', '', 'en', '', 'sss', 10, 10, 10, 10, 20, 1, 10, 10, 0, 0, 0, '127.0.0.1', '2016-05-12 00:59:05'),
(29, 'Nazir', 'nazir@gmail.com', 'ww.hayat.in', '63568954', 144557, 895568985, 'Pakistan', 'Hayat info', '10', '10', 500, '10', 'N', '1', '', 'en', '', 'sss', 10, 10, 10, 10, 20, 1, 10, 10, 0, 0, 0, '127.0.0.1', '2016-05-12 00:59:24'),
(30, 'Nazir', 'nazir@gmail.com', 'ww.hayat.in', '63568954', 144557, 895568985, 'Pakistan', 'Hayat info', '10', '10', 500, '10', 'N', '1', '', 'en', '', 'sss', 10, 10, 10, 10, 20, 1, 10, 10, 0, 0, 0, '127.0.0.1', '2016-05-12 01:01:09'),
(31, 'Nazir', 'nazir@gmail.com', 'ww.hayat.in', '63568954', 144557, 895568985, 'Pakistan', 'Hayat info', '10', '10', 500, '10', 'N', '1', '', 'en', '', 'sss', 10, 10, 10, 10, 20, 1, 10, 10, 0, 0, 0, '127.0.0.1', '2016-05-12 01:01:41'),
(32, 'Nazir', 'nazir@gmail.com', 'ww.hayat.in', '63568954', 144557, 895568985, 'Pakistan', 'Hayat info', '10', '10', 500, '10', 'N', '1', '', 'en', '', 'sss', 10, 10, 10, 10, 20, 1, 10, 10, 0, 0, 0, '127.0.0.1', '2016-05-12 01:01:47'),
(33, 'Nazir', 'nazir@gmail.com', 'ww.hayat.in', '63568954', 144557, 895568985, 'Pakistan', 'Hayat info', '10', '10', 500, '10', 'N', '1', '', 'en', '', 'sss', 10, 10, 10, 10, 20, 1, 10, 10, 0, 0, 0, '127.0.0.1', '2016-05-12 01:02:42'),
(34, 'Nazir', 'nazir@gmail.com', 'ww.hayat.in', '63568954', 144557, 895568985, 'Pakistan', 'Hayat info', '10', '10', 500, '10', 'N', '1', '', 'en', '', 'sss', 10, 10, 10, 10, 20, 1, 10, 10, 0, 0, 0, '127.0.0.1', '2016-05-12 01:03:49'),
(35, 'Nazir', 'nazir@gmail.com', 'ww.hayat.in', '63568954', 144557, 895568985, 'Pakistan', 'Hayat info', '10', '10', 500, '10', 'N', '1', '', 'en', '', 'sss', 10, 10, 10, 10, 20, 1, 10, 10, 0, 0, 0, '127.0.0.1', '2016-05-12 01:04:40'),
(36, 'Nazir', 'nazir@gmail.com', 'ww.hayat.in', '63568954', 144557, 895568985, 'Pakistan', 'Hayat info', '10', '10', 500, '10', 'N', '1', '', 'en', '', 'sss', 10, 10, 10, 10, 20, 1, 10, 10, 0, 0, 0, '127.0.0.1', '2016-05-12 01:05:42'),
(37, 'Nazir', 'nazir@gmail.com', 'ww.hayat.in', '63568954', 144557, 895568985, 'Pakistan', 'Hayat info', '10', '10', 500, '10', 'N', '1', '', 'en', '', 'sss', 10, 10, 10, 10, 20, 1, 10, 10, 0, 0, 0, '127.0.0.1', '2016-05-12 01:06:54'),
(38, 'Nazir', 'nazir@gmail.com', 'ww.hayat.in', '1245687', 144557, 895568985, 'America', 'Hayat info', '10', '10', 500, '10', 'value33.txt', '1', '', 'zh-TW', '', '來自幾個國家的球隊之間的體育競爭，尤其是國際足球錦標賽每四年舉行一次', 15, 10, 10, 10, 20, 4, 10, 10, 10, 0, 0, '127.0.0.1', '2016-05-12 01:14:23'),
(39, 'Nazir', 'nazir@gmail.com', 'web', '1245687', 144557, 895568985, 'India', 'hayat', '1', '10', 500, '10', 'value34.txt', '1', '', 'en', 'af', 'hi', 5, 10, 10, 10, 20, 1, 10, 10, 10, 0, 0, '127.0.0.1', '2016-05-23 12:25:18'),
(40, 'Nazir mallick', 'nazir@gmail.com', 'web', '1245687', 144557, 895568985, 'Pakistan', 'Hayat info', '15', '10', 4565, '10', 'N', '1', '', 'NC', '', 'Hello world', 10, 15, 10, 10, 20, 1, 10, 10, 0, 0, 0, '127.0.0.1', '2016-05-23 12:43:08'),
(41, 'Nazir mallick', 'nazir@gmail.com', 'web', '1245687', 144557, 895568985, 'Pakistan', 'Hayat info', '15', '10', 4565, '10', 'N', '1', '', 'NC', '', 'Hello world', 10, 15, 10, 10, 20, 1, 10, 10, 0, 0, 0, '127.0.0.1', '2016-05-23 12:46:02'),
(42, 'Nazir mallick', 'nazir@gmail.com', 'web', '1245687', 144557, 895568985, 'Pakistan', 'Hayat info', '15', '10', 4565, '10', 'N', '1', '', 'NC', '', 'Hello world', 10, 15, 10, 10, 20, 1, 10, 10, 0, 0, 0, '127.0.0.1', '2016-05-23 12:46:36'),
(43, 'Nazir mallick', 'nazir@gmail.com', 'web', '1245687', 144557, 895568985, 'Pakistan', 'Hayat info', '15', '10', 4565, '10', 'N', '1', '', 'NC', '', 'Hello world', 10, 15, 10, 10, 20, 1, 10, 10, 0, 0, 0, '127.0.0.1', '2016-05-23 12:46:58'),
(44, 'Nazir mallick', 'nazir@gmail.com', 'ww.hayat.in', '1245687', 144557, 5765, 'Pakistan', 'Hayat info', '20', '10', 500, '0', 'N', '1', '', 'NC', '', 'hello world', 10, 20, 10, 10, 20, 1, 10, 0, 0, 0, 0, '127.0.0.1', '2016-05-23 13:01:12'),
(45, 'Nazir mallick', 'www.hayat.in', 'ww.hayat.in', '1245687', 144557, 895568985, 'America', 'Hayat info', '15', '10', 500, '10', 'N', '1', '', 'en', '', 'hi', 15, 15, 10, 10, 15, 1, 10, 10, 0, 0, 0, '127.0.0.1', '2016-05-30 09:26:19'),
(46, 'Nazir mallick', 'nazir@gmail.com', 'ww.hayat.in', '63568954', 144557, 895568985, 'Canada', 'Hayat info', '10', '10', 500, '10', 'N', '1', '', 'NC', '', 'Ship all around the world with low-cost domestic and international small parcel shipping solutions', 20, 10, 10, 10, 20, 2, 10, 10, 0, 0, 0, '127.0.0.1', '2016-05-30 09:27:47'),
(47, 'Nazir mallick', 'nazir@gmail.com', 'ww.hayat.in', '63568954', 144557, 895568985, 'Canada', 'Hayat info', '10', '10', 500, '10', 'N', '1', '', 'NC', '', 'Ship all around the world', 20, 10, 10, 10, 20, 1, 10, 10, 0, 0, 0, '127.0.0.1', '2016-05-30 09:29:34'),
(48, 'Nazir mallick', 'nazir@gmail.com', 'ww.hayat.in', '63568954', 144557, 895568985, 'Canada', 'Hayat info', '10', '10', 500, '10', 'N', '1', '', 'NC', '', 'Ship all', 20, 10, 10, 10, 20, 1, 10, 10, 0, 0, 0, '127.0.0.1', '2016-05-30 09:29:57'),
(49, 'Nazir mallick', 'nazir@gmail.com', 'ww.hayat.in', '63568954', 144557, 895568985, 'Canada', 'Hayat info', '10', '10', 500, '10', 'N', '1', '', 'en', '', 'hello', 20, 10, 10, 10, 20, 1, 10, 10, 0, 0, 0, '127.0.0.1', '2016-05-30 09:30:46'),
(50, 'Nazir mallick', 'nazir@gmail.com', 'ww.hayat.in', '63568954', 144557, 895568985, 'Canada', 'Hayat info', '10', '10', 500, '10', 'N', '1', '', 'NC', '', 'hello world', 20, 10, 10, 10, 20, 1, 10, 10, 0, 0, 0, '127.0.0.1', '2016-05-30 09:31:04'),
(51, 'Nazir mallick', 'nazir@gmail.com', 'ww.hayat.in', '63568954', 144557, 895568985, 'Canada', 'Hayat info', '10', '10', 500, '10', 'N', '1', '', 'en', '', 'world', 20, 10, 10, 10, 20, 1, 10, 10, 0, 0, 0, '127.0.0.1', '2016-05-30 09:31:26'),
(52, 'Nazir mallick', 'nazir@gmail.com', 'ww.hayat.in', '63568954', 144557, 895568985, 'Canada', 'Hayat info', '10', '10', 500, '10', 'N', '1', '', 'en', '', 'what', 20, 10, 10, 10, 20, 1, 10, 10, 0, 0, 0, '127.0.0.1', '2016-05-30 09:31:50'),
(53, 'Nazir mallick', 'nazir@gmail.com', 'ww.hayat.in', '63568954', 144557, 895568985, 'Canada', 'Hayat info', '10', '10', 500, '10', 'N', '1', '', 'NC', '', 'what is this', 20, 10, 10, 10, 20, 1, 10, 10, 0, 0, 0, '127.0.0.1', '2016-05-30 09:32:16'),
(54, 'Nazir mallick', 'nazir@gmail.com', 'ww.hayat.in', '63568954', 144557, 895568985, 'Canada', 'Hayat info', '10', '10', 500, '10', 'N', '1', '', 'en', '', 'whatisyourname', 20, 10, 10, 10, 20, 1, 10, 10, 0, 0, 0, '127.0.0.1', '2016-05-30 09:41:20'),
(55, 'Nazir mallick', 'nazir@gmail.com', 'ww.hayat.in', '63568954', 144557, 895568985, 'Canada', 'Hayat info', '10', '10', 500, '10', 'N', '1', '', 'en', '', 'what is your name', 20, 10, 10, 10, 20, 1, 10, 10, 0, 0, 0, '127.0.0.1', '2016-05-30 09:54:43'),
(56, 'Nazir mallick', 'nazir@gmail.com', 'ww.hayat.in', '63568954', 144557, 895568985, 'Canada', 'Hayat info', '10', '10', 500, '10', 'N', '1', '', 'fy', '', 'SHIP DOMESTIC AND\r\nINTERNATIONAL AT\r\nLOW COST', 20, 10, 10, 10, 20, 1, 10, 10, 0, 0, 0, '127.0.0.1', '2016-05-30 09:55:23'),
(57, 'Nazir mallick', 'nazir@gmail.com', 'ww.hayat.in', '63568954', 144557, 895568985, 'Canada', 'Hayat info', '10', '10', 500, '10', 'N', '1', '', 'en', '', 'Ship all around the world with low-cost domestic and international small parcel shipping solutions', 20, 10, 10, 10, 20, 2, 10, 10, 0, 0, 0, '127.0.0.1', '2016-05-30 09:56:05'),
(58, 'Nazir mallick', 'nazir@gmail.com', 'ww.hayat.in', '63568954', 144557, 895568985, 'Canada', 'Hayat info', '10', '10', 500, '10', 'N', '1', '', 'en', '', 'Ship all around the world with low-cost domestic\r\n and international small parcel shipping solutions', 20, 10, 10, 10, 20, 2, 10, 10, 0, 0, 0, '127.0.0.1', '2016-05-30 09:56:22'),
(59, 'asif', 'asif@gmail.com', 'ww.hayat.in', '63568954', 144557, 895568985, 'India', 'hayat', '10', '10', 500, '10', 'N', '1', '', 'en', '', 'how are you', 5, 10, 10, 10, 20, 1, 10, 10, 0, 0, 0, '192.168.0.76', '2016-05-31 10:50:46');

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
(1, 39, '2016-05-21 07:39:41');

-- --------------------------------------------------------

--
-- Table structure for table `industry`
--

CREATE TABLE IF NOT EXISTS `industry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `industry`
--

INSERT INTO `industry` (`id`, `name`, `score`) VALUES
(1, 'accounting', 5),
(2, 'advertising', 10),
(3, 'cosmetics', 15),
(4, 'chemical', 20),
(5, 'information', 25);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(20) NOT NULL,
  `language_code` varchar(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=87 ;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `language`, `language_code`) VALUES
(1, 'Afrikaans', 'af'),
(2, 'Albanian', 'sq'),
(3, 'Arabic', 'ar'),
(4, 'Armenian', 'hy'),
(5, 'Azerbaijani', 'az'),
(6, 'Basque', 'eu'),
(7, 'Belarusian', 'be'),
(8, 'Bengali', 'bn'),
(9, 'Bosnian', 'bs'),
(10, 'Bulgarian', 'bg'),
(11, 'Catalan', 'ca'),
(12, 'Cebuano', 'ceb'),
(13, 'Chichewa', 'ny'),
(14, 'Chinese Simplified', 'zh-CN'),
(15, 'Chinese Traditional', 'zh-TW'),
(16, 'Croatian', 'hr'),
(17, 'Czech', 'cs'),
(18, 'Danish', 'da'),
(19, 'Dutch', 'nl'),
(20, 'English', 'en'),
(21, 'Esperanto', 'eo'),
(22, 'Georgian', 'ka'),
(23, 'German', 'de'),
(24, 'Greek', 'el'),
(25, 'Gujarati', 'gu'),
(26, 'Haitian Creole', 'ht'),
(27, 'Hausa', 'ha'),
(28, 'Hebrew', 'iw'),
(29, 'Hindi', 'hi'),
(30, 'Hmong', 'hmn'),
(31, 'Hungarian', 'hu'),
(32, 'Icelandic', 'is'),
(33, 'Igbo', 'ig'),
(34, 'Indonesian', 'id'),
(35, 'Irish', 'ga'),
(36, 'Italian', 'it'),
(37, 'Japanese', 'ja'),
(38, 'Javanese', 'jw'),
(39, 'Kannada', 'kn'),
(40, 'Kazakh', 'kk'),
(41, 'Khmer', 'km'),
(42, 'Korean', 'ko'),
(43, 'Lao', 'lo'),
(44, 'Latin', 'la'),
(45, 'Latvian', 'lv'),
(46, 'Lithuanian', 'lt'),
(47, 'Macedonian', 'mk'),
(48, 'Malagasy', 'mg'),
(49, 'Malay', 'ms'),
(50, 'Malayalam', 'ml'),
(51, 'Maltese', 'mt'),
(52, 'Maori', 'mi'),
(53, 'Marathi', 'mr'),
(54, 'Mongolian', 'mn'),
(55, 'Myanmar (Burmese)', 'my'),
(56, 'Nepali', 'ne'),
(57, 'Norwegian', 'no'),
(58, 'Persian', 'fa'),
(59, 'Polish', 'pl'),
(60, 'Portuguese', 'pt'),
(61, 'Punjabi', 'ma'),
(62, 'Romanian', 'ro'),
(63, 'Russian', 'ru'),
(64, 'Serbian', 'sr'),
(65, 'Sesotho', 'st'),
(66, 'Sinhala', 'si'),
(67, 'Slovak', 'sk'),
(68, 'Slovenian', 'sl'),
(69, 'Somali', 'so'),
(70, 'Spanish', 'es'),
(71, 'Sudanese', 'su'),
(72, 'Swahili', 'sw'),
(73, 'Swedish', 'sv'),
(74, 'Tajik', 'tg'),
(75, 'Tamil', 'ta'),
(76, 'Telugu', 'te'),
(77, 'Thai', 'th'),
(78, 'Turkish', 'tr'),
(79, 'Ukrainian', 'uk'),
(80, 'Urdu', 'ur'),
(81, 'Uzbek', 'uz'),
(82, 'Vietnamese', 'vi'),
(83, 'Welsh', 'cy'),
(84, 'Yiddish', 'yi'),
(85, 'Yoruba', 'yo'),
(86, 'Zulu', 'zu');

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE IF NOT EXISTS `score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(3) NOT NULL,
  `child_id` int(3) NOT NULL COMMENT 'Ignore this field',
  `name` varchar(20) NOT NULL,
  `score` varchar(5) NOT NULL,
  `value` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `score`
--

INSERT INTO `score` (`id`, `parent_id`, `child_id`, `name`, `score`, `value`) VALUES
(1, 0, 0, 'country', '0', 0),
(2, 1, 0, 'group A', '10', 0),
(3, 1, 0, 'group B', '9.2', 0),
(4, 1, 0, 'group C', '8.4', 0),
(5, 1, 0, 'group D', '7.5', 0),
(6, 1, 0, 'group E', '6.7', 0),
(7, 1, 0, 'group F', '5.9', 0),
(8, 1, 0, 'group G', '5', 0),
(9, 1, 0, 'group H', '4.2', 0),
(10, 1, 0, 'group I', '3.5', 0),
(11, 1, 0, 'group J', '2.7', 0),
(12, 0, 0, 'user_company', '0', 0),
(13, 12, 0, 'yes', '10', 0),
(14, 12, 0, 'no', '5', 0),
(15, 0, 0, 'user_business_type', '0', 0),
(16, 15, 0, 'wholesaler', '10', 0),
(17, 15, 0, 'manufacture', '10', 0),
(18, 15, 0, 'merchant', '10', 0),
(19, 15, 0, 'agent', '10', 0),
(20, 15, 0, 'procumbent_officer', '10', 0),
(21, 15, 0, 'distributer', '10', 0),
(22, 15, 0, 'goverment', '10', 0),
(23, 15, 0, 'assiciations', '10', 0),
(24, 15, 0, 'service_provider', '10', 0),
(25, 15, 0, 'other', '10', 0),
(26, 0, 0, 'user_contact_info', '0', 0),
(27, 26, 0, 'custom_domain_email', '10', 0),
(28, 26, 0, 'web_mail', '5', 0),
(29, 26, 0, 'telephone', '5', 0),
(30, 26, 0, 'fax', '5', 0),
(31, 26, 0, 'mobile', '5', 0),
(32, 26, 0, 'website', '10', 0),
(33, 26, 0, 'no_website', '0', 0),
(34, 0, 0, 'enquire_description', '0', 0),
(35, 34, 0, '1-10 words', '1', 10),
(36, 34, 0, '10-20 words', '2', 20),
(37, 34, 0, '20-30 words', '3', 30),
(38, 34, 0, '30-40 words', '4', 40),
(39, 34, 0, '40-50 words', '5', 50),
(40, 34, 0, '50-60 words', '6', 60),
(41, 34, 0, '60-70 words', '7', 70),
(42, 34, 0, '70-80 words', '8', 80),
(43, 34, 0, '80-90 words', '9', 90),
(44, 34, 0, '90+words', '10', 0),
(45, 0, 0, 'enquire_unit_price', '0', 0),
(46, 45, 0, '1-50USD', '1', 50),
(47, 45, 0, '50-100USD', '5', 100),
(48, 45, 0, '100-500USD', '10', 500),
(49, 0, 0, 'enquire_other', '0', 0),
(50, 49, 0, 'sample', '10', 0),
(51, 49, 0, 'no_sample', '0', 0),
(52, 0, 0, 'enquire_attached', '0', 0),
(53, 52, 0, 'with', '10', 0),
(54, 52, 0, 'no', '0', 0),
(55, 0, 0, 'user_history', '0', 0),
(56, 55, 0, '1 year', '1', 0),
(57, 55, 0, '2 year', '5', 0),
(58, 55, 0, '3 year', '10', 0),
(59, 0, 0, 'data_source', '0', 0),
(60, 59, 0, 'trade_china', '5', 1),
(61, 59, 0, 'email_campaign', '5', 2),
(62, 59, 0, 'chl_registered_buyer', '10', 3),
(63, 59, 0, 'chl_vip_buyer', '10', 4);

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
(1, 14552, 'axzaa', 'sxsax', '2016-04-14 09:16:01', 44, 777),
(2, 14552, 'axzaa', 'sxsax', '2016-04-14 09:16:40', 44, 777),
(3, 4545, 'axzaa', 'sxsax', '2016-04-14 09:26:25', 44, 777),
(4, 444, 'sa', 'sss', '2016-04-15 05:55:38', 77, 888),
(5, 444, 'sa', 'sss', '2016-04-15 05:59:04', 77, 888);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
