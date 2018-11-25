-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 12, 2014 at 01:05 AM
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
-- Table structure for table `tb_district`
--

CREATE TABLE IF NOT EXISTS `tb_district` (
  `dst_id` int(11) NOT NULL AUTO_INCREMENT,
  `dst_name` varchar(20) NOT NULL,
  PRIMARY KEY (`dst_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tb_district`
--

INSERT INTO `tb_district` (`dst_id`, `dst_name`) VALUES
(1, 'เมือง'),
(2, 'เชียงของ'),
(3, 'เชียงแสน'),
(4, 'เทิง'),
(5, 'แม่จัน'),
(6, 'แม่ฟ้าหลวง'),
(7, 'แม่ลาว'),
(8, 'แม่สาย'),
(9, 'แม่สรวย');

-- --------------------------------------------------------

--
-- Table structure for table `tb_travel_place`
--

CREATE TABLE IF NOT EXISTS `tb_travel_place` (
  `tvp_id` int(11) NOT NULL AUTO_INCREMENT,
  `tvp_name` varchar(30) NOT NULL,
  `tvp_dst_id` int(5) NOT NULL,
  PRIMARY KEY (`tvp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `tb_travel_place`
--

INSERT INTO `tb_travel_place` (`tvp_id`, `tvp_name`, `tvp_dst_id`) VALUES
(1, 'วัดพระแก้ว ', 1),
(2, 'วัดพระสิงห์ ', 1),
(3, 'วัดร่องขุ่น ', 1),
(4, 'น้ำตกขุนกรณ์ ', 1),
(5, 'น้ำตกโป่งพระบาท', 1),
(6, 'ท่าเรือบั๊ก', 2),
(7, 'วนอุทยานห้วยทรายมาน', 2),
(8, 'วัดพระธาตุจอมกิตติ ', 3),
(9, 'วัดพระธาตุผาเงา ', 3),
(10, 'หอฝิ่น อุทยานสามเหลี่ยมทองคำ ', 3),
(11, 'ภูชี้ฟ้า ', 4),
(12, 'ภูผาสวรรค์ ', 4),
(13, 'ภูชมดาว หรือ ผาหม่นน้อย ', 4),
(14, 'วัดพระธาตุจอมจันทร์ ', 5),
(15, 'ลานทองอุทยานวัฒนธรรมลุ่มแม่น้ำ', 5),
(16, 'ทุ่งดอกบัวตอง บนดอยหัวแม่คำ ', 6),
(17, 'ดอยแม่สลอง ', 6),
(18, 'พระตำหนักดอยตุง ', 6),
(19, 'ไร่ชาฉุยฟง ', 6),
(20, 'สถานีเพาะเลี้ยงสัตว์ป่าแม่ลาว ', 7),
(21, 'วัดพระธาตุดอยเวา ', 8),
(22, 'ถ้ำปุ่ม-ถ้ำปลา ', 8),
(23, 'ตลาดแม่สาย-ท่าขี้เหล็ก ', 8),
(24, 'วัดถ้ำผาจม ', 8),
(25, 'ดอยวาวี', 9),
(26, 'ดอยช้าง', 9),
(27, 'ดอยกาดผี ', 9),
(28, 'วัดแสงแก้วโพธิญาญ ', 9);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
