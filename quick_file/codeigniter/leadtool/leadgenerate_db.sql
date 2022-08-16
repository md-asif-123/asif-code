-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 05, 2016 at 03:03 PM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `leadgenerate_db`
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
  `status` varchar(4) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `user_id`, `password`, `registered_on`, `last_activity`, `user_type`, `status`) VALUES
(65, 'md asif', 'asif@gmail.com', 'asif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'A', 'N'),
(64, 'md tousif', 'tousif@gmail.com', 'tousif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'A', 'Y'),
(61, 'admin', 'admin@gmail.com', 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 's', '');

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
  `status` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=234 ;

--
-- Dumping data for table `company_details`
--

INSERT INTO `company_details` (`id`, `company_name`, `industry`, `language_code`, `email`, `contact_person`, `status`) VALUES
(134, 'klmnopqrst', '64', 'gh', 'abc@gmail.com', '214', '0'),
(135, 'pqrstuvwxy', '15', 'lm', 'abc@gmail.com', '850', '0'),
(136, 'stuvwxyz', '70', 'op', 'abc@gmail.com', '676', '0'),
(137, 'vwxyz', '50', 'rs', 'abc@gmail.com', '781', '0'),
(138, 'yz', '17', '', 'abc@gmail.com', '477', '0'),
(139, 'efghijklmn', '43', 'ab', 'abc@gmail.com', '252', '0'),
(140, 'uvwxyz', '80', 'qr', 'abc@gmail.com', '408', '0'),
(141, 'nopqrstuvw', '25', 'jk', 'abc@gmail.com', '239', '0'),
(142, 'fghijklmno', '23', 'bc', 'abc@gmail.com', '331', '0'),
(143, 'efghijklmn', '93', 'ab', 'abc@gmail.com', '223', '0'),
(144, 'pqrstuvwxy', '15', 'lm', 'abc@gmail.com', '306', '0'),
(145, 'klmnopqrst', '48', 'gh', 'abc@gmail.com', '222', '0'),
(146, '', '60', '', 'abc@gmail.com', '816', '0'),
(147, 'opqrstuvwx', '7', 'kl', 'abc@gmail.com', '114', '0'),
(148, 'wxyz', '26', 's', 'abc@gmail.com', '288', '0'),
(149, 'ijklmnopqr', '35', 'ef', 'abc@gmail.com', '759', '0'),
(150, '', '58', '', 'abc@gmail.com', '722', '0'),
(151, 'yz', '72', '', 'abc@gmail.com', '629', '0'),
(152, 'rstuvwxyz', '17', 'no', 'abc@gmail.com', '717', '0'),
(153, 'nopqrstuvw', '51', 'jk', 'abc@gmail.com', '528', '0'),
(154, '', '93', '', 'abc@gmail.com', '191', '0'),
(155, 'hijklmnopq', '31', 'de', 'abc@gmail.com', '221', '0'),
(156, 'tuvwxyz', '41', 'pq', 'abc@gmail.com', '610', '0'),
(157, 'uvwxyz', '14', 'qr', 'abc@gmail.com', '457', '0'),
(158, 'klmnopqrst', '95', 'gh', 'abc@gmail.com', '713', '0'),
(159, 'efghijklmn', '74', 'ab', 'abc@gmail.com', '494', '0'),
(160, 'fghijklmno', '3', 'bc', 'abc@gmail.com', '333', '0'),
(161, 'klmnopqrst', '85', 'gh', 'abc@gmail.com', '124', '0'),
(162, '', '42', '', 'abc@gmail.com', '628', '0'),
(163, 'pqrstuvwxy', '42', 'lm', 'abc@gmail.com', '800', '0'),
(164, 'rstuvwxyz', '53', 'no', 'abc@gmail.com', '701', '0'),
(165, 'efghijklmn', '84', 'ab', 'abc@gmail.com', '457', '0'),
(166, 'hijklmnopq', '61', 'de', 'abc@gmail.com', '528', '0'),
(167, '', '26', '', 'abc@gmail.com', '42', '0'),
(168, 'klmnopqrst', '97', 'gh', 'abc@gmail.com', '280', '0'),
(169, 'ijklmnopqr', '75', 'ef', 'abc@gmail.com', '135', '0'),
(170, 'efghijklmn', '30', 'ab', 'abc@gmail.com', '552', '0'),
(171, 'tuvwxyz', '65', 'pq', 'abc@gmail.com', '274', '0'),
(172, 'yz', '86', '', 'abc@gmail.com', '785', '0'),
(173, 'rstuvwxyz', '73', 'no', 'abc@gmail.com', '85', '0'),
(174, '', '78', '', 'abc@gmail.com', '392', '0'),
(175, '', '51', '', 'abc@gmail.com', '399', '0'),
(176, 'nopqrstuvw', '25', 'jk', 'abc@gmail.com', '782', '0'),
(177, 'mnopqrstuv', '45', 'ij', 'abc@gmail.com', '785', '0'),
(178, 'wxyz', '83', 's', 'abc@gmail.com', '187', '0'),
(179, 'z', '25', '', 'abc@gmail.com', '670', '0'),
(180, 'tuvwxyz', '66', 'pq', 'abc@gmail.com', '187', '0'),
(181, 'pqrstuvwxy', '6', 'lm', 'abc@gmail.com', '465', '0'),
(182, 'yz', '73', '', 'abc@gmail.com', '530', '0'),
(183, '', '76', '', 'abc@gmail.com', '890', '0'),
(184, 'uvwxyz', '12', 'qr', 'abc@gmail.com', '264', '0'),
(185, 'fghijklmno', '21', 'bc', 'abc@gmail.com', '501', '0'),
(186, 'hijklmnopq', '26', 'de', 'abc@gmail.com', '660', '0'),
(187, 'nopqrstuvw', '46', 'jk', 'abc@gmail.com', '412', '0'),
(188, 'jklmnopqrs', '17', 'fg', 'abc@gmail.com', '31', '0'),
(189, '', '6', '', 'abc@gmail.com', '22', '0'),
(190, 'fghijklmno', '70', 'bc', 'abc@gmail.com', '267', '0'),
(191, 'stuvwxyz', '26', 'op', 'abc@gmail.com', '839', '0'),
(192, 'nopqrstuvw', '82', 'jk', 'abc@gmail.com', '752', '0'),
(193, 'rstuvwxyz', '27', 'no', 'abc@gmail.com', '406', '0'),
(194, 'rstuvwxyz', '83', 'no', 'abc@gmail.com', '394', '0'),
(195, 'rstuvwxyz', '54', 'no', 'abc@gmail.com', '625', '0'),
(196, '', '63', '', 'abc@gmail.com', '544', '0'),
(197, 'pqrstuvwxy', '98', 'lm', 'abc@gmail.com', '781', '0'),
(198, '', '94', '', 'abc@gmail.com', '729', '0'),
(199, 'z', '24', '', 'abc@gmail.com', '472', '0'),
(200, 'yz', '61', '', 'abc@gmail.com', '671', '0'),
(201, 'efghijklmn', '88', 'ab', 'abc@gmail.com', '726', '0'),
(202, 'ijklmnopqr', '81', 'ef', 'abc@gmail.com', '514', '0'),
(203, 'rstuvwxyz', '74', 'no', 'abc@gmail.com', '634', '0'),
(204, 'z', '31', '', 'abc@gmail.com', '149', '0'),
(205, 'fghijklmno', '10', 'bc', 'abc@gmail.com', '268', '0'),
(206, 'vwxyz', '71', 'rs', 'abc@gmail.com', '340', '0'),
(207, 'ghijklmnop', '96', 'cd', 'abc@gmail.com', '13', '0'),
(208, 'hijklmnopq', '74', 'de', 'abc@gmail.com', '245', '0'),
(209, 'yz', '30', '', 'abc@gmail.com', '786', '0'),
(210, 'mnopqrstuv', '43', 'ij', 'abc@gmail.com', '346', '0'),
(211, 'stuvwxyz', '31', 'op', 'abc@gmail.com', '664', '0'),
(212, 'mnopqrstuv', '44', 'ij', 'abc@gmail.com', '873', '0'),
(213, 'fghijklmno', '64', 'bc', 'abc@gmail.com', '508', '0'),
(214, 'rstuvwxyz', '26', 'no', 'abc@gmail.com', '225', '0'),
(215, 'rstuvwxyz', '68', 'no', 'abc@gmail.com', '588', '0'),
(216, 'uvwxyz', '45', 'qr', 'abc@gmail.com', '599', '0'),
(217, 'ghijklmnop', '77', 'cd', 'abc@gmail.com', '811', '0'),
(218, 'jklmnopqrs', '95', 'fg', 'abc@gmail.com', '116', '0'),
(219, '', '49', '', 'abc@gmail.com', '40', '0'),
(220, 'vwxyz', '29', 'rs', 'abc@gmail.com', '240', '0'),
(221, 'wxyz', '86', 's', 'abc@gmail.com', '824', '0'),
(222, 'xyz', '81', '', 'abc@gmail.com', '609', '0'),
(223, 'pqrstuvwxy', '64', 'lm', 'abc@gmail.com', '622', '0'),
(224, 'tuvwxyz', '99', 'pq', 'abc@gmail.com', '159', '0'),
(225, 'ijklmnopqr', '55', 'ef', 'abc@gmail.com', '126', '0'),
(226, 'fghijklmno', '62', 'bc', 'abc@gmail.com', '46', '0'),
(227, '', '54', '', 'abc@gmail.com', '787', '0'),
(228, 'fghijklmno', '10', 'bc', 'abc@gmail.com', '274', '0'),
(229, 'lmnopqrstu', '1', 'hi', 'abc@gmail.com', '543', '0'),
(230, 'tuvwxyz', '65', 'pq', 'abc@gmail.com', '818', '0'),
(231, 'ghijklmnop', '10', 'cd', 'abc@gmail.com', '339', '0'),
(232, 'jklmnopqrs', '63', 'fg', 'abc@gmail.com', '50', '0'),
(233, 'lmnopqrstu', '88', 'hi', 'abc@gmail.com', '755', '0');

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=112 ;

--
-- Dumping data for table `enquires`
--

INSERT INTO `enquires` (`id`, `name`, `phone`, `email`, `company_name`, `industry`, `detected_languagecode`, `manual_languagecode`, `comments`, `ipaddress`, `dat`) VALUES
(1, 'sdfrssdgds', '540', 'abc@gmail.com', 'ffghijklmn', '4', 'lm', 'ar', 'ffghijklmn', '650', '2016-05-05 09:14:13'),
(2, 'dgdsgtuvwx', '836', 'abc@gmail.com', 'klmnopqrst', '1', 'df', 'eng', 'klmnopqrst', '587', '2016-05-04 12:25:30'),
(3, 'dsgtuvwxyz', '377', 'abc@gmail.com', 'mnopqrstuv', '42', 'no', 'mn', 'mnopqrstuv', '542', '2016-05-04 07:08:23'),
(4, 'opqsdfgsdf', '149', 'abc@gmail.com', 'gkefsdaffg', '10', 'ef', 'ep', 'gkefsdaffg', '376', '2016-05-04 07:08:23'),
(5, 'hijklmnopq', '686', 'abc@gmail.com', 'dkfgkdlgke', '38', 'de', 'de', 'dkfgkdlgke', '399', '2016-05-04 07:08:23'),
(6, 'dgdsgtuvwx', '759', 'abc@gmail.com', 'klmnopqrst', '48', 'df', 'kl', 'klmnopqrst', '393', '2016-05-04 07:08:38'),
(7, 'fghijklmno', '646', 'abc@gmail.com', 'bcdkfgkdlg', '79', 'bc', 'bc', 'bcdkfgkdlg', '796', '2016-05-04 07:08:38'),
(8, 'nopqsdfgsd', '770', 'abc@gmail.com', 'lgkefsdaff', '85', 'ye', 'ye', 'lgkefsdaff', '15', '2016-05-04 07:08:39'),
(9, 'opqsdfgsdf', '878', 'abc@gmail.com', 'gkefsdaffg', '99', 'ef', 'ep', 'gkefsdaffg', '274', '2016-05-04 07:08:39'),
(10, 'klmnopqsdf', '267', 'abc@gmail.com', 'gkdlgkefsd', '7', 'wy', 'ye', 'gkdlgkefsd', '643', '2016-05-04 07:08:39'),
(11, 'frssdgdsgt', '816', 'abc@gmail.com', 'ghijklmnop', '80', 'ds', 'gh', 'ghijklmnop', '771', '2016-05-04 07:09:40'),
(12, 'gsdfrssdgd', '643', 'abc@gmail.com', 'affghijklm', '69', 'kl', 'le', 'affghijklm', '569', '2016-05-04 07:09:40'),
(13, 'sdfgsdfrss', '546', 'abc@gmail.com', 'fsdaffghij', '72', 'hi', 'ec', 'fsdaffghij', '204', '2016-05-04 07:09:40'),
(14, 'fgsdfrssdg', '383', 'abc@gmail.com', 'daffghijkl', '88', 'jk', 'xl', 'daffghijkl', '209', '2016-05-04 07:09:40'),
(15, 'fgsdfrssdg', '466', 'abc@gmail.com', 'daffghijkl', '64', 'jk', 'xl', 'daffghijkl', '670', '2016-05-04 07:09:40'),
(16, 'lmnopqsdfg', '530', 'abc@gmail.com', 'kdlgkefsda', '49', 'yt', 'er', 'kdlgkefsda', '557', '2016-05-04 07:12:06'),
(17, 'klmnopqsdf', '525', 'abc@gmail.com', 'gkdlgkefsd', '20', 'wy', 'ye', 'gkdlgkefsd', '431', '2016-05-04 07:12:07'),
(18, 'dgdsgtuvwx', '807', 'abc@gmail.com', 'klmnopqrst', '61', 'df', 'kl', 'klmnopqrst', '691', '2016-05-04 07:12:07'),
(19, 'hijklmnopq', '109', 'abc@gmail.com', 'dkfgkdlgke', '45', 'de', 'de', 'dkfgkdlgke', '745', '2016-05-04 07:12:07'),
(20, 'qsdfgsdfrs', '317', 'abc@gmail.com', 'efsdaffghi', '92', 'gh', 'ie', 'efsdaffghi', '453', '2016-05-04 07:12:07'),
(21, 'dgdsgtuvwx', '164', 'abc@gmail.com', 'klmnopqrst', '75', 'df', 'kl', 'klmnopqrst', '123', '2016-05-04 07:13:11'),
(22, 'ssdgdsgtuv', '636', 'abc@gmail.com', 'ijklmnopqr', '16', 'fs', 'ij', 'ijklmnopqr', '517', '2016-05-04 07:13:11'),
(23, 'klmnopqsdf', '466', 'abc@gmail.com', 'gkdlgkefsd', '86', 'wy', 'ye', 'gkdlgkefsd', '142', '2016-05-04 07:13:11'),
(24, 'sdfrssdgds', '638', 'abc@gmail.com', 'ffghijklmn', '8', 'lm', 'ef', 'ffghijklmn', '658', '2016-05-04 07:13:11'),
(25, 'dsgtuvwxyz', '788', 'abc@gmail.com', 'mnopqrstuv', '53', 'no', 'mn', 'mnopqrstuv', '575', '2016-05-04 07:13:11'),
(26, 'frssdgdsgt', '99', 'abc@gmail.com', 'ghijklmnop', '43', 'ds', 'gh', 'ghijklmnop', '652', '2016-05-04 07:13:13'),
(27, 'sdgdsgtuvw', '6', 'abc@gmail.com', 'jklmnopqrs', '49', 'sd', 'jk', 'jklmnopqrs', '298', '2016-05-04 07:13:13'),
(28, 'rssdgdsgtu', '594', 'abc@gmail.com', 'hijklmnopq', '95', 'sf', 'hi', 'hijklmnopq', '273', '2016-05-04 07:13:13'),
(29, 'dfgsdfrssd', '596', 'abc@gmail.com', 'sdaffghijk', '52', 'ij', 'cx', 'sdaffghijk', '885', '2016-05-04 07:13:13'),
(30, 'gsdfrssdgd', '97', 'abc@gmail.com', 'affghijklm', '41', 'kl', 'le', 'affghijklm', '196', '2016-05-04 07:13:13'),
(31, 'dgdsgtuvwx', '532', 'abc@gmail.com', 'klmnopqrst', '35', 'df', 'kl', 'klmnopqrst', '313', '2016-05-04 07:13:14'),
(32, 'dgdsgtuvwx', '184', 'abc@gmail.com', 'klmnopqrst', '55', 'df', 'kl', 'klmnopqrst', '196', '2016-05-04 07:13:14'),
(33, 'fgsdfrssdg', '488', 'abc@gmail.com', 'daffghijkl', '73', 'jk', 'xl', 'daffghijkl', '156', '2016-05-04 07:13:14'),
(34, 'qsdfgsdfrs', '629', 'abc@gmail.com', 'efsdaffghi', '12', 'gh', 'ie', 'efsdaffghi', '49', '2016-05-04 07:13:14'),
(35, 'pqsdfgsdfr', '241', 'abc@gmail.com', 'kefsdaffgh', '42', 'fg', 'pi', 'kefsdaffgh', '188', '2016-05-04 07:13:14'),
(36, 'efghijklmn', '308', 'abc@gmail.com', 'abcdkfgkdl', '85', 'ab', 'ab', 'abcdkfgkdl', '430', '2016-05-04 07:14:32'),
(37, 'hijklmnopq', '465', 'abc@gmail.com', 'dkfgkdlgke', '16', 'de', 'de', 'dkfgkdlgke', '185', '2016-05-04 07:14:32'),
(38, 'lmnopqsdfg', '796', 'abc@gmail.com', 'kdlgkefsda', '53', 'yt', 'er', 'kdlgkefsda', '213', '2016-05-04 07:14:32'),
(39, 'pqsdfgsdfr', '35', 'abc@gmail.com', 'kefsdaffgh', '70', 'fg', 'pi', 'kefsdaffgh', '822', '2016-05-04 07:14:32'),
(40, 'fghijklmno', '67', 'abc@gmail.com', 'bcdkfgkdlg', '88', 'bc', 'bc', 'bcdkfgkdlg', '73', '2016-05-04 07:14:32'),
(41, 'ghijklmnop', '526', 'abc@gmail.com', 'cdkfgkdlgk', '80', 'cd', 'cd', 'cdkfgkdlgk', '74', '2016-05-04 07:14:32'),
(42, 'fghijklmno', '597', 'abc@gmail.com', 'bcdkfgkdlg', '67', 'bc', 'bc', 'bcdkfgkdlg', '685', '2016-05-04 07:14:32'),
(43, 'dgdsgtuvwx', '813', 'abc@gmail.com', 'klmnopqrst', '21', 'df', 'kl', 'klmnopqrst', '415', '2016-05-04 07:14:32'),
(44, 'fghijklmno', '360', 'abc@gmail.com', 'bcdkfgkdlg', '64', 'bc', 'bc', 'bcdkfgkdlg', '25', '2016-05-04 07:14:32'),
(45, 'dfgsdfrssd', '671', 'abc@gmail.com', 'sdaffghijk', '67', 'ij', 'cx', 'sdaffghijk', '722', '2016-05-04 07:14:32'),
(46, 'ssdgdsgtuv', '32', 'abc@gmail.com', 'ijklmnopqr', '53', 'fs', 'ij', 'ijklmnopqr', '567', '2016-05-04 07:14:32'),
(47, 'ssdgdsgtuv', '776', 'abc@gmail.com', 'ijklmnopqr', '93', 'fs', 'ij', 'ijklmnopqr', '768', '2016-05-04 07:14:32'),
(48, 'fghijklmno', '288', 'abc@gmail.com', 'bcdkfgkdlg', '11', 'bc', 'bc', 'bcdkfgkdlg', '286', '2016-05-04 07:14:32'),
(49, 'qsdfgsdfrs', '1', 'abc@gmail.com', 'efsdaffghi', '76', 'gh', 'ie', 'efsdaffghi', '330', '2016-05-04 07:14:32'),
(50, 'dfgsdfrssd', '2', 'abc@gmail.com', 'sdaffghijk', '11', 'ij', 'cx', 'sdaffghijk', '758', '2016-05-04 07:14:32'),
(51, 'klmnopqsdf', '823', 'abc@gmail.com', 'gkdlgkefsd', '88', 'wy', 'ye', 'gkdlgkefsd', '81', '2016-05-04 07:14:32'),
(52, 'efghijklmn', '749', 'abc@gmail.com', 'abcdkfgkdl', '30', 'ab', 'ab', 'abcdkfgkdl', '857', '2016-05-04 07:14:32'),
(53, 'sdgdsgtuvw', '316', 'abc@gmail.com', 'jklmnopqrs', '7', 'sd', 'jk', 'jklmnopqrs', '696', '2016-05-04 07:14:32'),
(54, 'jklmnopqsd', '506', 'abc@gmail.com', 'fgkdlgkefs', '41', 'rw', 'ry', 'fgkdlgkefs', '358', '2016-05-04 07:14:32'),
(55, 'ghijklmnop', '54', 'abc@gmail.com', 'cdkfgkdlgk', '5', 'cd', 'cd', 'cdkfgkdlgk', '152', '2016-05-04 07:14:32'),
(56, 'gdsgtuvwxy', '846', 'abc@gmail.com', 'lmnopqrstu', '20', 'fn', 'lm', 'lmnopqrstu', '837', '2016-05-04 07:14:32'),
(57, 'dfrssdgdsg', '714', 'abc@gmail.com', 'fghijklmno', '58', 'md', 'fg', 'fghijklmno', '23', '2016-05-04 07:14:32'),
(58, 'dgdsgtuvwx', '644', 'abc@gmail.com', 'klmnopqrst', '42', 'df', 'kl', 'klmnopqrst', '268', '2016-05-04 07:14:32'),
(59, 'pqsdfgsdfr', '270', 'abc@gmail.com', 'kefsdaffgh', '43', 'fg', 'pi', 'kefsdaffgh', '83', '2016-05-04 07:14:32'),
(60, 'ssdgdsgtuv', '576', 'abc@gmail.com', 'ijklmnopqr', '82', 'fs', 'ij', 'ijklmnopqr', '227', '2016-05-04 07:14:32'),
(61, 'efghijklmn', '297', 'abc@gmail.com', 'abcdkfgkdl', '33', 'ab', 'ab', 'abcdkfgkdl', '108', '2016-05-04 07:14:32'),
(62, 'sdfgsdfrss', '417', 'abc@gmail.com', 'fsdaffghij', '16', 'hi', 'ec', 'fsdaffghij', '488', '2016-05-04 07:14:32'),
(63, 'klmnopqsdf', '570', 'abc@gmail.com', 'gkdlgkefsd', '3', 'wy', 'ye', 'gkdlgkefsd', '774', '2016-05-04 07:14:32'),
(64, 'dfrssdgdsg', '841', 'abc@gmail.com', 'fghijklmno', '17', 'md', 'fg', 'fghijklmno', '826', '2016-05-04 07:14:32'),
(65, 'ssdgdsgtuv', '864', 'abc@gmail.com', 'ijklmnopqr', '29', 'fs', 'ij', 'ijklmnopqr', '54', '2016-05-04 07:14:32'),
(66, 'hijklmnopq', '724', 'abc@gmail.com', 'dkfgkdlgke', '61', 'de', 'de', 'dkfgkdlgke', '116', '2016-05-04 07:14:32'),
(67, 'sdfgsdfrss', '55', 'abc@gmail.com', 'fsdaffghij', '85', 'hi', 'ec', 'fsdaffghij', '423', '2016-05-04 07:14:32'),
(68, 'sdfgsdfrss', '741', 'abc@gmail.com', 'fsdaffghij', '23', 'hi', 'ec', 'fsdaffghij', '834', '2016-05-04 07:14:32'),
(69, 'ghijklmnop', '616', 'abc@gmail.com', 'cdkfgkdlgk', '47', 'cd', 'cd', 'cdkfgkdlgk', '758', '2016-05-04 07:14:32'),
(70, 'sdfrssdgds', '666', 'abc@gmail.com', 'ffghijklmn', '78', 'lm', 'ef', 'ffghijklmn', '54', '2016-05-04 07:14:32'),
(71, 'lmnopqsdfg', '524', 'abc@gmail.com', 'kdlgkefsda', '88', 'yt', 'er', 'kdlgkefsda', '832', '2016-05-04 07:14:32'),
(72, 'mnopqsdfgs', '274', 'abc@gmail.com', 'dlgkefsdaf', '1', 'ty', 'ry', 'dlgkefsdaf', '252', '2016-05-04 07:14:32'),
(73, 'ssdgdsgtuv', '452', 'abc@gmail.com', 'ijklmnopqr', '86', 'fs', 'ij', 'ijklmnopqr', '422', '2016-05-04 07:14:33'),
(74, 'jklmnopqsd', '242', 'abc@gmail.com', 'fgkdlgkefs', '67', 'rw', 'ry', 'fgkdlgkefs', '302', '2016-05-04 07:14:33'),
(75, 'qsdfgsdfrs', '177', 'abc@gmail.com', 'efsdaffghi', '15', 'gh', 'ie', 'efsdaffghi', '201', '2016-05-04 07:14:33'),
(76, 'ghijklmnop', '342', 'abc@gmail.com', 'cdkfgkdlgk', '51', 'cd', 'cd', 'cdkfgkdlgk', '879', '2016-05-04 07:14:33'),
(77, 'efghijklmn', '373', 'abc@gmail.com', 'abcdkfgkdl', '48', 'ab', 'ab', 'abcdkfgkdl', '845', '2016-05-04 07:14:33'),
(78, 'dfrssdgdsg', '352', 'abc@gmail.com', 'fghijklmno', '28', 'md', 'fg', 'fghijklmno', '859', '2016-05-04 07:14:33'),
(79, 'ijklmnopqs', '815', 'abc@gmail.com', 'kfgkdlgkef', '62', 'er', 'er', 'kfgkdlgkef', '329', '2016-05-04 07:14:33'),
(80, 'ssdgdsgtuv', '45', 'abc@gmail.com', 'ijklmnopqr', '73', 'fs', 'ij', 'ijklmnopqr', '15', '2016-05-04 07:14:33'),
(81, 'sdfrssdgds', '377', 'abc@gmail.com', 'ffghijklmn', '32', 'lm', 'ef', 'ffghijklmn', '228', '2016-05-04 07:14:33'),
(82, 'ijklmnopqs', '97', 'abc@gmail.com', 'kfgkdlgkef', '61', 'er', 'er', 'kfgkdlgkef', '825', '2016-05-04 07:14:33'),
(83, 'mnopqsdfgs', '637', 'abc@gmail.com', 'dlgkefsdaf', '32', 'ty', 'ry', 'dlgkefsdaf', '316', '2016-05-04 07:14:33'),
(84, 'dfgsdfrssd', '282', 'abc@gmail.com', 'sdaffghijk', '66', 'ij', 'cx', 'sdaffghijk', '361', '2016-05-04 07:14:33'),
(85, 'ssdgdsgtuv', '467', 'abc@gmail.com', 'ijklmnopqr', '37', 'fs', 'ij', 'ijklmnopqr', '370', '2016-05-04 07:14:33'),
(86, 'gsdfrssdgd', '376', 'abc@gmail.com', 'affghijklm', '65', 'kl', 'le', 'affghijklm', '200', '2016-05-04 07:14:33'),
(87, 'gdsgtuvwxy', '543', 'abc@gmail.com', 'lmnopqrstu', '23', 'fn', 'lm', 'lmnopqrstu', '163', '2016-05-04 07:14:33'),
(88, 'jklmnopqsd', '153', 'abc@gmail.com', 'fgkdlgkefs', '32', 'rw', 'ry', 'fgkdlgkefs', '117', '2016-05-04 07:14:33'),
(89, 'pqsdfgsdfr', '640', 'abc@gmail.com', 'kefsdaffgh', '64', 'fg', 'pi', 'kefsdaffgh', '371', '2016-05-04 07:14:33'),
(90, 'fghijklmno', '289', 'abc@gmail.com', 'bcdkfgkdlg', '42', 'bc', 'bc', 'bcdkfgkdlg', '785', '2016-05-04 07:14:33'),
(91, 'efghijklmn', '534', 'abc@gmail.com', 'abcdkfgkdl', '36', 'ab', 'ab', 'abcdkfgkdl', '769', '2016-05-04 07:14:33'),
(92, 'sdgdsgtuvw', '559', 'abc@gmail.com', 'jklmnopqrs', '69', 'sd', 'jk', 'jklmnopqrs', '181', '2016-05-04 07:14:33'),
(93, 'sdfgsdfrss', '898', 'abc@gmail.com', 'fsdaffghij', '14', 'hi', 'ec', 'fsdaffghij', '232', '2016-05-04 07:14:33'),
(94, 'opqsdfgsdf', '737', 'abc@gmail.com', 'gkefsdaffg', '90', 'ef', 'ep', 'gkefsdaffg', '779', '2016-05-04 07:14:33'),
(95, 'fgsdfrssdg', '609', 'abc@gmail.com', 'daffghijkl', '71', 'jk', 'xl', 'daffghijkl', '334', '2016-05-04 07:14:33'),
(96, 'qsdfgsdfrs', '599', 'abc@gmail.com', 'efsdaffghi', '79', 'gh', 'ie', 'efsdaffghi', '555', '2016-05-04 07:14:33'),
(97, 'fghijklmno', '341', 'abc@gmail.com', 'bcdkfgkdlg', '84', 'bc', 'bc', 'bcdkfgkdlg', '852', '2016-05-04 07:14:33'),
(98, 'frssdgdsgt', '819', 'abc@gmail.com', 'ghijklmnop', '11', 'ds', 'gh', 'ghijklmnop', '183', '2016-05-04 07:14:33'),
(99, 'gsdfrssdgd', '768', 'abc@gmail.com', 'affghijklm', '29', 'kl', 'le', 'affghijklm', '659', '2016-05-04 07:14:33'),
(100, 'fghijklmno', '273', 'abc@gmail.com', 'bcdkfgkdlg', '60', 'bc', 'bc', 'bcdkfgkdlg', '338', '2016-05-04 07:14:33'),
(101, 'fghijklmno', '767', 'abc@gmail.com', 'bcdkfgkdlg', '77', 'bc', 'bc', 'bcdkfgkdlg', '431', '2016-05-04 07:14:33'),
(102, 'ghijklmnop', '536', 'abc@gmail.com', 'cdkfgkdlgk', '3', 'cd', 'cd', 'cdkfgkdlgk', '796', '2016-05-04 07:14:33'),
(103, 'ghijklmnop', '112', 'abc@gmail.com', 'cdkfgkdlgk', '8', 'cd', 'cd', 'cdkfgkdlgk', '843', '2016-05-04 07:14:33'),
(104, 'fgsdfrssdg', '482', 'abc@gmail.com', 'daffghijkl', '13', 'jk', 'xl', 'daffghijkl', '431', '2016-05-04 07:14:33'),
(105, 'sdfgsdfrss', '378', 'abc@gmail.com', 'fsdaffghij', '92', 'hi', 'ec', 'fsdaffghij', '770', '2016-05-04 07:14:33'),
(106, 'nopqsdfgsd', '787', 'abc@gmail.com', 'lgkefsdaff', '66', 'ye', 'ye', 'lgkefsdaff', '819', '2016-05-04 07:14:33'),
(107, 'fghijklmno', '441', 'abc@gmail.com', 'bcdkfgkdlg', '8', 'bc', 'bc', 'bcdkfgkdlg', '887', '2016-05-04 07:14:33'),
(108, 'hijklmnopq', '325', 'abc@gmail.com', 'dkfgkdlgke', '38', 'de', 'de', 'dkfgkdlgke', '833', '2016-05-04 07:14:34'),
(109, 'qsdfgsdfrs', '74', 'abc@gmail.com', 'efsdaffghi', '29', 'gh', 'ie', 'efsdaffghi', '68', '2016-05-04 07:14:34'),
(110, 'gsdfrssdgd', '672', 'abc@gmail.com', 'affghijklm', '3', 'kl', 'le', 'affghijklm', '250', '2016-05-04 07:14:34'),
(111, 'Saddam', '52136445', 's@gmail.com', 'hayat', '1', '', '', 'uytu', '192.168.0.76', '2016-05-05 09:43:05');

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
-- Table structure for table `translated_message`
--

CREATE TABLE IF NOT EXISTS `translated_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enquery_id` int(10) NOT NULL,
  `message` tinytext NOT NULL,
  `language_code` varchar(3) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
