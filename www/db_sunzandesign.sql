-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 10, 2014 at 04:43 PM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sunzandesign`
--

-- --------------------------------------------------------

--
-- Table structure for table `even`
--

CREATE TABLE IF NOT EXISTS `even` (
  `id_even` int(11) NOT NULL AUTO_INCREMENT,
  `id_area` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `survival` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_even`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `even`
--

INSERT INTO `even` (`id_even`, `id_area`, `date`, `survival`) VALUES
(1, 1, '2013-07-09', 98),
(2, 1, '2013-07-11', 96),
(3, 7, '2013-07-11', 98),
(4, 1, '2013-07-10', 97),
(5, 6, '2013-07-10', 99),
(6, 3, '2013-07-23', 95);

-- --------------------------------------------------------

--
-- Table structure for table `tb_area`
--

CREATE TABLE IF NOT EXISTS `tb_area` (
  `id_area` int(11) NOT NULL AUTO_INCREMENT,
  `name_pond` varchar(3) NOT NULL,
  PRIMARY KEY (`id_area`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tb_area`
--

INSERT INTO `tb_area` (`id_area`, `name_pond`) VALUES
(1, 'A1'),
(2, 'A2'),
(3, 'A3'),
(4, 'A4'),
(5, 'A5'),
(6, 'A6'),
(7, 'A7'),
(8, 'A8'),
(9, 'A9'),
(10, 'A10');

-- --------------------------------------------------------

--
-- Table structure for table `tb_questionnaire`
--

CREATE TABLE IF NOT EXISTS `tb_questionnaire` (
  `te` int(11) NOT NULL,
  `qtn_active` int(1) NOT NULL,
  `qtn_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_report_booking`
--

CREATE TABLE IF NOT EXISTS `tb_report_booking` (
  `bk_id` int(13) NOT NULL AUTO_INCREMENT,
  `bk_user_code` bigint(10) NOT NULL,
  `bk_date` date NOT NULL,
  `bk_customer_code` bigint(10) NOT NULL,
  `bk_customer_name` varchar(40) NOT NULL,
  `bk_remark` varchar(225) NOT NULL,
  PRIMARY KEY (`bk_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tb_report_booking`
--

INSERT INTO `tb_report_booking` (`bk_id`, `bk_user_code`, `bk_date`, `bk_customer_code`, `bk_customer_name`, `bk_remark`) VALUES
(1, 2556020001, '2013-07-01', 2147483647, 'Mr.Brain', ''),
(2, 2556020001, '2013-07-04', 32123, 'Mr.BomBae', ''),
(3, 2556020001, '2013-07-05', 2147483647, 'Mr.Brain', ''),
(4, 2556020001, '2013-07-17', 32123, 'Mr.BomBae', ''),
(5, 2556020001, '2013-07-04', 25560, 'Mr.Brain', ''),
(6, 2556020001, '2013-07-05', 121212, 'Mr.Brain333', ''),
(7, 2556020002, '2013-07-05', 32123, 'asdfasdf', ''),
(8, 2556020003, '2013-07-02', 20002, 'Mr.Brain44', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'อัตโนมัติ',
  `user_code` varchar(20) NOT NULL COMMENT 'รหัสสมาชิก',
  `user_name` varchar(30) NOT NULL COMMENT 'ชื่อล็อกอิน',
  `user_password` varchar(60) NOT NULL COMMENT 'รหัสผ่าน',
  `user_fullname` varchar(100) NOT NULL COMMENT 'ชื่อนามสกุล',
  `user_nickname` varchar(30) NOT NULL COMMENT 'ชื่อเล่น',
  `user_school` varchar(50) NOT NULL COMMENT 'โรงเรียน',
  `user_level` int(1) NOT NULL COMMENT 'ระดับ',
  `user_active_status` int(1) NOT NULL COMMENT 'สถานะ',
  `user_regis_date` date NOT NULL,
  `user_expire_date` date NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='ข้อมูลสมาชิก' AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `user_code`, `user_name`, `user_password`, `user_fullname`, `user_nickname`, `user_school`, `user_level`, `user_active_status`, `user_regis_date`, `user_expire_date`) VALUES
(1, '2556020001', 'sunzandesign', 'abc123', 'ซันซาน ดีไซน์', '', '', 1, 1, '0000-00-00', '2014-03-12'),
(2, '2556020002', 'sunzandesign2', 'abc1234', 'นายรณพีร์ พณรี', '', '', 2, 1, '0000-00-00', '2014-03-09'),
(3, '2556020003', 'sunzandesign3', 'abc12345', 'นางสาวรุ่งนภา เผ่าพงษ์พันธ์', '', '', 2, 1, '0000-00-00', '2014-03-08'),
(4, '2556020004', 'sunzandesign4', 'abc123', 'นางสาวสุวิมล สุดใจ', '', '', 2, 1, '0000-00-00', '2014-03-25'),
(5, '2556020005', 'sunzandesign5', 'abc1234', 'นางสาวอรทัย ใจเย็น', '', '', 2, 1, '0000-00-00', '2014-03-03'),
(6, '2556020006', 'sunzandesign6', 'abc12345', 'นายณัฐพงษ์ คงรี', '', '', 2, 1, '0000-00-00', '2014-03-09'),
(7, '2556020007', 'sunzandesign7', 'abc12345', 'นายนิคม  บุญส่ง', '', '', 2, 1, '0000-00-00', '2014-03-05');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
