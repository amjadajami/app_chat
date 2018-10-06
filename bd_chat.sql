-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 06, 2018 at 06:31 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `t_chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

DROP TABLE IF EXISTS `conversation`;
CREATE TABLE IF NOT EXISTS `conversation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `emetteur_id` int(11) NOT NULL,
  `recepteur_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `emetteur_id` (`emetteur_id`),
  KEY `recepteur_id` (`recepteur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `conversation`
--

INSERT INTO `conversation` (`id`, `message`, `emetteur_id`, `recepteur_id`, `date`) VALUES
(1, 'message', 29, 11, '2018-10-05 01:00:42'),
(2, 'message', 29, 13, '2018-10-05 01:03:42'),
(3, 'message', 29, 11, '2018-10-05 01:09:42'),
(4, 'message', 29, 13, '2018-10-05 01:03:42'),
(5, 'message', 11, 29, '2018-10-05 01:03:42'),
(6, 'message', 29, 11, '2018-10-05 11:39:21'),
(16, 'message', 29, 11, '2018-10-05 12:20:36'),
(17, 'message', 29, 11, '2018-10-05 12:24:37'),
(18, 'message', 29, 11, '2018-10-05 12:24:46'),
(19, 'message', 29, 11, '2018-10-05 12:26:20'),
(20, 'message', 11, 29, '2018-10-05 12:54:08'),
(21, 'message', 29, 11, '2018-10-05 12:54:50'),
(22, 'message', 29, 11, '2018-10-05 12:55:28'),
(23, 'message', 29, 11, '2018-10-05 13:12:27'),
(24, 'message', 29, 16, '2018-10-05 23:16:49'),
(25, 'message', 29, 11, '2018-10-05 23:31:00'),
(26, 'message', 29, 11, '2018-10-05 23:32:02'),
(27, 'message', 29, 11, '2018-10-05 23:32:43'),
(28, 'message', 29, 11, '2018-10-05 23:34:00'),
(29, 'message', 29, 16, '2018-10-05 23:34:19'),
(30, 'message', 29, 16, '2018-10-05 23:34:26'),
(33, 'message', 29, 16, '2018-10-05 23:48:35'),
(43, 'hanya', 29, 11, '2018-10-06 18:28:43');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `isConnect` int(11) NOT NULL DEFAULT '0',
  `pass` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `isConnect`, `pass`) VALUES
(11, 'test', 0, '2736fab291f04e69b62d490c3c09361f5b82461a'),
(13, 'test2', 0, '2736fab291f04e69b62d490c3c09361f5b82461a'),
(16, 'test3', 0, '2736fab291f04e69b62d490c3c09361f5b82461a'),
(28, 'login', 0, '2736fab291f04e69b62d490c3c09361f5b82461a'),
(29, 'amjad', 0, 'da82c16684a5885d761b082d6f140d4bb869ef6f');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `conversation`
--
ALTER TABLE `conversation`
  ADD CONSTRAINT `conversation_ibfk_1` FOREIGN KEY (`emetteur_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `conversation_ibfk_2` FOREIGN KEY (`recepteur_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
