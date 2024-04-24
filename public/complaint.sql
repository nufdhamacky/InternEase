-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 19, 2024 at 04:12 AM
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
-- Table structure for table `complaint`
--

DROP TABLE IF EXISTS `complaint`;
CREATE TABLE IF NOT EXISTS `complaint` (
  `complaint_id` int NOT NULL AUTO_INCREMENT,
  `company_id` int DEFAULT NULL,
  `student_id` int DEFAULT NULL,
  `user_type` enum('company','student') DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`complaint_id`),
  KEY `complaints_ibfk_2` (`company_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`complaint_id`, `company_id`, `student_id`, `user_type`, `title`, `description`, `status`, `created_at`) VALUES
(2, 7, NULL, 'student', 'sadsdasad', 'sadasddsasad', 1, '2024-02-14 09:13:42'),
(3, NULL, 1, 'student', 'sdsaads', 'adsaasdasdas', 0, '2024-02-14 09:14:37');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaint`
--
ALTER TABLE `complaint`
  ADD CONSTRAINT `complaint_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`registration_no`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `complaint_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `company` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;