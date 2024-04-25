-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 22, 2024 at 09:27 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `UserName` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Email` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Phone` varchar(12) NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `adminid` (`admin_id`),
  KEY `UserName` (`UserName`,`Email`),
  KEY `Email` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `UserName`, `Email`, `Password`, `FirstName`, `LastName`, `Phone`) VALUES
(3, 'Geesara Gawesh', 'sdasd@gmail.com', '$2y$10$VCuBlOn5XHAkIcE8svL7Muv0ktjCguenLl6.kXhw5yHBcXlY2PWW.', 'Geesara', 'Gawesh', '77542854'),
(74, 'Hamsayini', 'Hamsayini', '$2y$10$bJcANGZqU/5TYvaqAlmsaejHuJDyYL4vl25tC2ylLjDOs2LZ.r4ou', 'Hamsa', 'Hamsa', '977213132');

-- --------------------------------------------------------

--
-- Table structure for table `applyadvertisement`
--

DROP TABLE IF EXISTS `applyadvertisement`;
CREATE TABLE IF NOT EXISTS `applyadvertisement` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `round_id` int UNSIGNED NOT NULL,
  `applied_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `applied_by` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `round_id` (`round_id`),
  KEY `applied_by` (`applied_by`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `applyadvertisement`
--

INSERT INTO `applyadvertisement` (`id`, `round_id`, `applied_date`, `applied_by`) VALUES
(4, 1, '2024-03-10 12:48:26', 1),
(5, 1, '2024-03-10 12:51:10', 3),
(6, 1, '2024-03-13 13:53:33', 11);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `user_id` int NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `contact_person` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `company_site` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `contact_no` varchar(255) NOT NULL,
  `address` text,
  `description` text,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`user_id`, `company_name`, `contact_person`, `email`, `company_site`, `contact_no`, `address`, `description`) VALUES
(1, 'WSO2', 'Nufdha', 'wso2@gmail.com', NULL, '0123456789', NULL, NULL),
(4, 'CodeGen', 'Hamsayini', 'codegen@gmail.com', NULL, '0123456710', NULL, NULL),
(11, '99X', 'Sharmi', '99x@gmail.com', NULL, '0123456789', NULL, NULL),
(17, 'CodeBeta', 'sayini', 'codebeta@gmail.com', NULL, '01111111111', NULL, NULL),
(20, 'Alterium', 'mike', 'mike@gmail.com', 'https://www.mike.com', '0123456789', NULL, NULL),
(34, 'Virtusa', 'Sharmi', 'virtusa@gmail.com', 'www.virtusa.com', '0772123432', NULL, NULL);

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
  `status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`ad_id`),
  KEY `company_foreign` (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `company_ad`
--

INSERT INTO `company_ad` (`ad_id`, `position`, `requirements`, `no_of_intern`, `working_mode`, `from_date`, `to_date`, `company_id`, `qualification`, `status`) VALUES
(15, 'SE', 'test1', 10, 'Online', '2024-03', '2024-09', 1, 'test1', 2),
(16, 'Data Analyst', 'test2', 5, 'Online', '2024-04', '2024-10', 4, 'test2', 1),
(17, 'QA', 'test3', 4, 'Hybrid', '2024-04', '2024-10', 4, 'test3', 1),
(18, 'Data Scientist', 'test4', 10, 'Hybrid', '2024-04', '2024-10', 11, 'test4', 2),
(19, 'BA', 'test5', 10, 'Hybrid', '2024-04', '2024-10', 11, 'test5', 1),
(20, 'BA', 'test6', 10, 'Hybrid', '2024-04', '2024-10', 4, 'test6', 1),
(21, 'UI/UX Designer', 'test7', 10, 'Online', '2024-04', '2024-10', 1, 'test7', 1),
(22, 'Data Analyst', 'test8', 5, 'Online', '2024-04', '2024-10', 1, 'test8', 1),
(23, 'SE', 'test9', 15, 'Hybrid', '2024-04', '2024-10', 4, 'test9', 2),
(24, 'Backend Engineer', 'test10', 15, 'Online', '2024-04', '2024-10', 11, 'test10', 2),
(25, 'QA', 'test11', 10, 'Online', '2024-05', '2024-11', 20, 'test11', 1),
(26, 'Data Scientist', 'test12', 5, 'Hybrid', '2024-03', '2024-09', 11, 'test12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `company_report`
--

DROP TABLE IF EXISTS `company_report`;
CREATE TABLE IF NOT EXISTS `company_report` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` int NOT NULL,
  `reported_by` int NOT NULL,
  `reason` text NOT NULL,
  `date` date DEFAULT NULL,
  `status` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`),
  KEY `reported_by` (`reported_by`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_visit`
--

DROP TABLE IF EXISTS `company_visit`;
CREATE TABLE IF NOT EXISTS `company_visit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `company_id` int NOT NULL,
  `request_date` datetime NOT NULL,
  `visit_date` datetime DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `reason` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `company_visit`
--

INSERT INTO `company_visit` (`id`, `company_id`, `request_date`, `visit_date`, `status`, `reason`) VALUES
(1, 4, '2024-03-23 06:17:00', '2024-03-20 09:00:00', 1, 'Testing the function'),
(2, 11, '2024-03-23 06:17:00', '2024-03-23 06:17:00', 1, 'Testing the function'),
(10, 20, '2024-03-28 11:00:00', '2024-03-28 11:00:00', 2, ''),
(11, 1, '2024-03-28 09:00:00', '2024-03-29 18:53:28', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

DROP TABLE IF EXISTS `complaint`;
CREATE TABLE IF NOT EXISTS `complaint` (
  `complaint_id` int NOT NULL AUTO_INCREMENT,
  `company_id` int DEFAULT NULL,
  `student_id` int DEFAULT NULL,
  `user_type` enum('company','student') DEFAULT NULL,
  `type` varchar(100) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `reply` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`complaint_id`),
  KEY `student_id` (`student_id`),
  KEY `complaint_ibfk_2` (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`complaint_id`, `company_id`, `student_id`, `user_type`, `type`, `title`, `description`, `reply`, `status`, `created_at`) VALUES
(43, 20, NULL, 'company', 'system_complaint', 'TEST 1', 'TEST', NULL, 0, '2024-04-22 08:36:40'),
(44, NULL, 11, 'student', 'user_complaint', 'TEST 2', 'TEST', NULL, 0, '2024-04-22 08:36:40');

-- --------------------------------------------------------

--
-- Table structure for table `first_round_data`
--

DROP TABLE IF EXISTS `first_round_data`;
CREATE TABLE IF NOT EXISTS `first_round_data` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `ad_id` int NOT NULL,
  `applied_id` int UNSIGNED NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ad_id` (`ad_id`,`applied_id`),
  KEY `applied_id` (`applied_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `first_round_data`
--

INSERT INTO `first_round_data` (`id`, `ad_id`, `applied_id`, `status`) VALUES
(5, 15, 4, 1),
(7, 15, 5, 1),
(8, 21, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pdc_user`
--

DROP TABLE IF EXISTS `pdc_user`;
CREATE TABLE IF NOT EXISTS `pdc_user` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pdc_user`
--

INSERT INTO `pdc_user` (`id`, `email`, `first_name`, `last_name`, `password`) VALUES
(2, 'sayisenthil@gmail.com', 'hamsa', 'senthil', 'hamsa');

-- --------------------------------------------------------

--
-- Table structure for table `round`
--

DROP TABLE IF EXISTS `round`;
CREATE TABLE IF NOT EXISTS `round` (
  `id` int UNSIGNED NOT NULL,
  `count` int UNSIGNED DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `round`
--

INSERT INTO `round` (`id`, `count`, `start_date`, `end_date`) VALUES
(1, 4, '2024-02-06', '2024-02-22');

-- --------------------------------------------------------

--
-- Table structure for table `second_round_data`
--

DROP TABLE IF EXISTS `second_round_data`;
CREATE TABLE IF NOT EXISTS `second_round_data` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `applied_id` int UNSIGNED NOT NULL,
  `job_role` varchar(255) NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `applied_id` (`applied_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `second_round_data`
--

INSERT INTO `second_round_data` (`id`, `applied_id`, `job_role`, `status`) VALUES
(3, 6, 'BA\r\nQA\r\nSE', 0),
(4, 6, 'BA\r\nQA\r\nSE', 0);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `email` varchar(50) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `index_no` int NOT NULL,
  `reg_no` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `index_no` (`index_no`),
  UNIQUE KEY `reg_no` (`reg_no`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `user_id`, `email`, `first_name`, `last_name`, `index_no`, `reg_no`) VALUES
(1, 12, '2021is033stu@ucsc.cmb.ac.lk', 'Hamsayini', 'Senthilrasa', 21020337, '2021/IS/033'),
(3, 14, '2021is069@stu.ucsc.cmb.ac.lk', 'Nufdha', 'Macky', 21020697, '2021/CS/069'),
(11, 23, '2021is001@stu.ucsc.cmb.ac.lk', 'Mike', 'John', 21020015, '2021/IS/001');

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
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_role`, `user_profile`, `user_status`, `password`) VALUES
(1, 'wso2@gmail.com', 'company', 'profilepic.jpg', 1, '$2y$10$pw9lMpqmhOJBerffYavMDOGZNlf6IoZe4cutYXkUORpEMSkbqBt9m'),
(2, 'sayisenthil@gmail.com', 'pdc', 'profilepic.jpg', 1, '$2y$10$bJcANGZqU/5TYvaqAlmsaejHuJDyYL4vl25tC2ylLjDOs2LZ.r4ou'),
(3, 'applexus@gmail.com', 'company', 'profilepic.jpg', 1, '$2y$10$bJcANGZqU/5TYvaqAlmsaejHuJDyYL4vl25tC2ylLjDOs2LZ.r4ou'),
(4, 'codegen@gmail.com', 'company', 'profilepic.jpg', 1, '$2y$10$nGI6g2.V4IPWWVcAredhTezd4IBuNxNBM2LF6X09l/Q9TM/svET3W'),
(11, '99x@gmail.com', 'company', 'profilepic.jpg', 0, '$2y$10$7Ur1W1I/bO77uahSsK7mJOc1wn3L8y8E5eMJQMwc5JmrLllJ4SdcS'),
(12, 'sarmisenthil@gmail.com', 'student', 'profilepic.jpg', 1, '$2y$10$i/nCb9lHqrJXNhUvaKP0b.nls8AtpOk.vHiuE/B3qg/AisMENtaTy'),
(14, 'nufdha@gmail.com', 'student', 'profilepic.jpg', 1, '$2y$10$k5WzBlaOVbwu8LWTwFOwVeSUO78b4.NGdyX4ZAO7CXMpBIvA/LYgu'),
(17, 'h2o@gmail.com', 'company', 'profilepic.jpg', 1, '$2y$10$hNcHFrKrRioYU.1Vl4Ie9.OcY5cL258E41XeR1j1YDnYCyn0oXtHq'),
(20, 'nike@gmail.com', 'company', 'profilepic.jpg', 1, '$2y$10$WLpamsSOPnkEZO4EnaX0neD7MyS7yLv1.xKtg5pQfbAsfvEwaCXd2'),
(23, 'fila@gmail.com', 'student', 'profilepic.jpg', 1, '$2y$10$.QdMPej2fatlYzQhquzi2eYUFHi1dAaIvpWqHwMJlO.FqquHLSPmi'),
(30, 'zone24*7@gmail.com', 'company', 'profilepic.jpg', 1, 'zone24*7@123'),
(34, 'mike@gmail.com', 'company', 'profilepic.jpg', 1, '$2y$10$JfauzBJOeX3TEckR3jEXtOgeBm52QyGqGQEscoolBsuRJDjyNHzqy'),
(43, 'ifs@gmail.com', 'company', 'profilepic.jpg', 0, 'IFs@123'),
(71, 'Hamsayini', 'admin', 'profilepic.jpg', 1, '$2y$10$bJcANGZqU/5TYvaqAlmsaejHuJDyYL4vl25tC2ylLjDOs2LZ.r4ou');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applyadvertisement`
--
ALTER TABLE `applyadvertisement`
  ADD CONSTRAINT `applyadvertisement_ibfk_1` FOREIGN KEY (`round_id`) REFERENCES `round` (`id`),
  ADD CONSTRAINT `applyadvertisement_ibfk_2` FOREIGN KEY (`applied_by`) REFERENCES `student` (`id`);

--
-- Constraints for table `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `company_ad`
--
ALTER TABLE `company_ad`
  ADD CONSTRAINT `company_foreign` FOREIGN KEY (`company_id`) REFERENCES `company` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `company_report`
--
ALTER TABLE `company_report`
  ADD CONSTRAINT `company_report_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`user_id`),
  ADD CONSTRAINT `company_report_ibfk_2` FOREIGN KEY (`reported_by`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `complaint`
--
ALTER TABLE `complaint`
  ADD CONSTRAINT `fk_company` FOREIGN KEY (`company_id`) REFERENCES `company` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_std` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `first_round_data`
--
ALTER TABLE `first_round_data`
  ADD CONSTRAINT `first_round_data_ibfk_1` FOREIGN KEY (`ad_id`) REFERENCES `company_ad` (`ad_id`),
  ADD CONSTRAINT `first_round_data_ibfk_2` FOREIGN KEY (`applied_id`) REFERENCES `applyadvertisement` (`id`);

--
-- Constraints for table `pdc_user`
--
ALTER TABLE `pdc_user`
  ADD CONSTRAINT `fk_pdc_id` FOREIGN KEY (`id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `second_round_data`
--
ALTER TABLE `second_round_data`
  ADD CONSTRAINT `second_round_data_ibfk_1` FOREIGN KEY (`applied_id`) REFERENCES `applyadvertisement` (`id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
