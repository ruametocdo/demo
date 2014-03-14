-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 14, 2014 at 10:05 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `content`, `created`) VALUES
(1, 23, 'Một quan chức cấp cao Mỹ cho rằng MH370 đang nằm dưới đáy Ấn Độ Dương', 1394777196),
(2, 23, 'Bắc Kinh cởi mở bất ngờ về vấn đề năng lực vệ tinh khi công bố những bức ảnh chụp vật thể trên Biển Đông,', 1394777253),
(3, 23, 'Bắc Kinh cởi mở bất ngờ về vấn đề năng lực vệ tinh khi công bố những bức ảnh chụp vật thể trên Biển Đông,', 1394777257),
(4, 24, 'Bằng Kiều có thể được trả 400 triệu đồng cho một show diễn ở Việt Nam', 1394777419),
(5, 24, 'Trận đấu giữa U19 Việt Nam với U19 Coventry City diễn ra lúc 11h30 ngày 13/3 trong sương mù dày đặc', 1394777432),
(9, 23, 'Nhiều người muốn mua bộ khung nhà nhưng anh Ngô Quý Đức từ chối bởi anh thấy ''ở nhà cổ sướng hơn ở nhà 4-5 tầng nhiều''.', 1394780508),
(10, 23, 'Nhiều người muốn mua bộ khung nhà nhưng anh Ngô Quý Đức từ chối bởi anh thấy ''ở nhà cổ sướng hơn ở nhà 4-5 tầng nhiều''.', 1394780511),
(11, 23, 'jklujliuilu', 1394788831),
(12, 23, 'jklujliuilu', 1394788835),
(13, 23, 'jklujliuilu', 1394788856);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '0',
  `image` varchar(255) DEFAULT NULL,
  `hobby` varchar(150) DEFAULT NULL,
  `cronmail` tinyint(1) DEFAULT '1',
  `notshow` tinyint(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `last_login` int(11) NOT NULL,
  `login_hash` varchar(255) NOT NULL,
  `profile_fields` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `group` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `gender`, `code`, `active`, `image`, `hobby`, `cronmail`, `notshow`, `created`, `modified`, `last_login`, `login_hash`, `profile_fields`, `group`, `created_at`, `updated_at`) VALUES
(23, 'dat huynh', 'datht83@gmail.com', 'K0a6gamZ1WRAMveKC9c3rC5CirxEKonoDQUDYWkLPbE=', 'Male', '3734cb1a7109834c923f529392f5443f', 1, NULL, NULL, 1, 0, NULL, NULL, 1394787203, '7a64de44a88c3c8a2138ca7c40b83f54c1047f11', 'a:0:{}', 1, 1394775347, 0),
(24, 'dat huynh123', 'trungdathuynh@gmail.com', 'K0a6gamZ1WRAMveKC9c3rC5CirxEKonoDQUDYWkLPbE=', 'Female', NULL, 1, NULL, NULL, 1, 0, NULL, NULL, 1394777394, 'b07a5318b3008dca7827e3a155f2f3924218e829', 'a:0:{}', 1, 1394777309, 0),
(25, 'teo', 'evolabledata@gmail.com', 'K0a6gamZ1WRAMveKC9c3rC5CirxEKonoDQUDYWkLPbE=', 'male', NULL, 1, NULL, NULL, 1, 0, NULL, NULL, 0, '', 'a:0:{}', 1, 1394781434, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
