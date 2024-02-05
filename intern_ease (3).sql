-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 21, 2024 at 10:12 AM
-- Server version: 8.0.32
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `intern_ease`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`user_id`, `company_name`) VALUES
(1, 'WSO2');

-- --------------------------------------------------------

--
-- Table structure for table `company_ad`
--

DROP TABLE IF EXISTS `company_ad`;
CREATE TABLE IF NOT EXISTS `company_ad` (
  `ad_id` int NOT NULL AUTO_INCREMENT,
  `position` varchar(255) NOT NULL,
  `requirements` varchar(300) NOT NULL,
  `no_of_intern` int NOT NULL,
  `working_mode` varchar(100) NOT NULL,
  `from_date` text NOT NULL,
  `to_date` text NOT NULL,
  `company_id` int NOT NULL,
  `qualification` varchar(300) NOT NULL,
  PRIMARY KEY (`ad_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `company_ad`
--

INSERT INTO `company_ad` (`ad_id`, `position`, `requirements`, `no_of_intern`, `working_mode`, `from_date`, `to_date`, `company_id`, `qualification`) VALUES
(4, 'qa', 'hii', 10, 'Online', '2023-12', '2024-01', 7, 'hiii'),
(6, 'ba', 'test', 13, 'Online', '2023-12', '2024-04', 6, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `pdc_user`
--

DROP TABLE IF EXISTS `pdc_user`;
CREATE TABLE IF NOT EXISTS `pdc_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pdc_user`
--

INSERT INTO `pdc_user` (`id`, `email`, `first_name`, `last_name`, `password`) VALUES
(2, 'sayisenthil@gmail.com', 'hamsa', 'senthil', 'hamsa');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) NOT NULL,
  `user_role` varchar(50) NOT NULL,
  `user_profile` varchar(255) NOT NULL DEFAULT 'profilepic.jpg',
  `user_status` int NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_role`, `user_profile`, `user_status`, `password`) VALUES
(1, 'wso2@gmail.com', 'company', 'profilepic.jpg', 1, '$2y$10$pw9lMpqmhOJBerffYavMDOGZNlf6IoZe4cutYXkUORpEMSkbqBt9m'),
(2, 'sayisenthil@gmail.com', 'pdc', 'profilepic.jpg', 1, '$2y$10$bJcANGZqU/5TYvaqAlmsaejHuJDyYL4vl25tC2ylLjDOs2LZ.r4ou');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
