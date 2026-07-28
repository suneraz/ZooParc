-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 27, 2024 at 05:01 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

CREATE DATABASE IF NOT EXISTS `zooparc_db`;
USE `zooparc_db`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zooparc_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(191) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(2, 'admin', '$2y$10$Hluk8dmPNhdDO42fxhmj7O3FHjKI1LJXv8l/miBLzJ/Vd3yXxEQR2');

-- --------------------------------------------------------

--
-- Table structure for table `education_uploads`
--

DROP TABLE IF EXISTS `education_uploads`;
CREATE TABLE IF NOT EXISTS `education_uploads` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `upload_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `uploaded_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `education_uploads`
--

INSERT INTO `education_uploads` (`id`, `title`, `description`, `upload_date`, `uploaded_by`) VALUES
(28, 'Feeding the Zoo', 'Explore the fascinating diets and feeding routines of our zoo animals.', '2024-10-30 18:30:00', NULL),
(33, 'Discover Animal Homes', 'Dive into the unique habitats of our zoo animals.', '2024-11-01 18:30:00', 'sunerar'),
(27, 'Guardians of the Wild', 'Uncover the stories of endangered species and their fight for survival.', '2024-09-08 18:30:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int NOT NULL AUTO_INCREMENT,
  `event_name` varchar(255) NOT NULL,
  `event_description` text NOT NULL,
  `event_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `event_description`, `event_date`) VALUES
(16, 'Zookeeper Day', 'Experience a day in the life of a zookeeper.', '2024-10-02'),
(15, 'Animal Fun Day', 'A day of fun activities for the animals', '2024-09-22'),
(17, 'Feeding Time', 'Watch as zookeepers feed the animals.', '2024-09-30');

-- --------------------------------------------------------

--
-- Table structure for table `member_event_allocation`
--

DROP TABLE IF EXISTS `member_event_allocation`;
CREATE TABLE IF NOT EXISTS `member_event_allocation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `member_id` int NOT NULL,
  `event_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`),
  KEY `event_id` (`event_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `member_event_allocation`
--

INSERT INTO `member_event_allocation` (`id`, `member_id`, `event_id`) VALUES
(5, 5, 16);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `phone`, `password`, `created_at`) VALUES
(7, 'Will', 'smith', 'smith', 'smith@gmail.com', '0123456789', '$2y$10$y9suNaKFQQrKrwXomUmshOFMpdDiDeWSm5krURMHYfgrH4vBgrgTe', '2024-08-26 16:29:08'),
(5, 'sunera', 'nawod', 'sunerar', 'sunerar.2002@gmail.com', '0717988299', '$2y$10$28joZ/7u9IUPTq2O45ZJCuFWy/oClMyFwpP.Wxu.24jHTyFSYw27.', '2024-08-17 14:51:52'),
(8, 'Ravidu', 'gune', 'ravidu', 'ravidu@gmail.com', '0712356499', '$2y$10$5E1S.BEtgCIVz41TKhrKX.JkK/Nlc2EdT7Tfipb/l3hA5vJ333wua', '2024-08-27 16:49:49'),
(9, 'Dulana', 'Malshan', 'dulana', 'dulana@gmail.com', '0756344545', '$2y$10$aTOq8vPollgZBSCsIKsJsOgizSepPkO.nfAmt5pU19tO3Qbw2wfdO', '2024-08-27 16:51:14'),
(10, 'Ashen', 'Kumara', 'ashen', 'ashen@gmail.com', '0789956345', '$2y$10$3PwRCt30gyNsXOpg6agvheBNvMZoIRcH0Vqz60gr4PxriS3KgOASW', '2024-08-27 16:51:59');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;