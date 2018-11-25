-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 10, 2014 at 04:36 PM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sunzan-design.com`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_comp_branch`
--

CREATE TABLE IF NOT EXISTS `tb_comp_branch` (
  `cbr_id` int(4) NOT NULL AUTO_INCREMENT,
  `cbr_name` varchar(30) NOT NULL,
  `cbr_status` int(1) NOT NULL,
  PRIMARY KEY (`cbr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='สาขา' AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tb_comp_branch`
--

INSERT INTO `tb_comp_branch` (`cbr_id`, `cbr_name`, `cbr_status`) VALUES
(1, 'สี่แยกแม่กรณ์', 1),
(2, 'ตลาดบ้านดู่', 1),
(3, 'เชียงราย', 1),
(4, 'นางแล', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_member`
--

CREATE TABLE IF NOT EXISTS `tb_member` (
  `mbr_id` int(11) NOT NULL AUTO_INCREMENT,
  `mbr_code` varchar(20) NOT NULL,
  `mbr_name` varchar(50) NOT NULL,
  `mbr_branch` int(4) NOT NULL,
  `mbr_expire_date` date NOT NULL,
  PRIMARY KEY (`mbr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='ตารางสมาชิก' AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tb_member`
--

INSERT INTO `tb_member` (`mbr_id`, `mbr_code`, `mbr_name`, `mbr_branch`, `mbr_expire_date`) VALUES
(1, '2-57-0001', 'นางสาวสกาวใจ อำไพพรศรี', 2, '2014-03-31'),
(2, '1-57-0002', 'นายพุทธรักษา  ปัญญาเลิศวิไล', 1, '2014-03-28'),
(3, '1-57-0001', 'นายแสนดี ศรีสุขสมหวัง', 1, '2014-03-03'),
(4, '3-57-0003', 'นางรุ่งอรุณ แสงทองเจิดจรัส', 3, '2014-03-05'),
(5, '4-57-0004', 'นายแสนดี ศรีสุขสมหวัง', 4, '2014-03-31'),
(6, '2-57-0006', 'นางสาวนกยูง ผดุงยุติธรรม', 2, '2014-03-06'),
(7, '3-57-0008', 'นายดำรง  รักษ์ธรรมชาติ', 3, '2014-03-02'),
(8, '1-57-0009', 'นางสาวจริงใจ  รักจริงจัง', 1, '2014-03-01'),
(9, '4-57-0019', 'นายสมหวัง  หวังสดใส', 4, '2014-03-31'),
(10, '2-57-0010', 'นางรุ่งจรัส  พิพัสดำรงทอง', 2, '2014-03-28'),
(11, '3-57-0011', 'นายแสนสุข  พัฒนารุ่งเรือง', 3, '2014-03-31'),
(12, '1-57-0012', 'นางอรุณแสง  ดำเนินรุ่ง', 1, '2014-03-28');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
