-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2023 at 10:30 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `name` varchar(255) NOT NULL,
  `type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`name`, `type`) VALUES
('portfolio1', 1),
('portfolio2', 0),
('portfolio3', 1),
('portfolio4', 0),
('Software Engineer', 1),
('Software Engineer2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ao`
--

CREATE TABLE `ao` (
  `id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `point` float NOT NULL,
  `verify` int(1) NOT NULL,
  `vid` varchar(255) NOT NULL,
  `locked` int(1) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `log` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ao`
--

INSERT INTO `ao` (`id`, `title`, `point`, `verify`, `vid`, `locked`, `attachment`, `comment`, `log`) VALUES
('fac3@ex.com', 'abc-def-ghi', 3, 0, '', 1, 'abc-def-ghi-AO.pdf', '', '2023-05-02 19:56:19');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` varchar(255) NOT NULL,
  `hcomment` varchar(255) NOT NULL,
  `dcomment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `hcomment`, `dcomment`) VALUES
('fac1@ex.com', 'lorem', 'lorem'),
('fac2@ex.com', '', ''),
('fac3@ex.com', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `cts`
--

CREATE TABLE `cts` (
  `id` varchar(255) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `point` float NOT NULL,
  `vid` varchar(255) NOT NULL,
  `verify` int(1) NOT NULL,
  `locked` int(1) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `log` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cts`
--

INSERT INTO `cts` (`id`, `activity`, `date`, `point`, `vid`, `verify`, `locked`, `attachment`, `comment`, `log`) VALUES
('fac1@ex.com', 'LOL', '2022-11-28', 0, 'hod.ce@git.org.in', 1, 1, '2022-11-28-CTS.pdf', '', '2023-05-02 19:56:34'),
('fac1@ex.com', 'LOREM', '2023-05-01', 5, '', 0, 0, '2023-05-01-CTS.pdf', '', '2023-05-02 19:56:34'),
('fac1@ex.com', 'ABC', '2023-05-19', 5, '', 0, 0, '2023-05-19-CTS.pdf', '', '2023-05-02 20:16:57');

-- --------------------------------------------------------

--
-- Table structure for table `disc`
--

CREATE TABLE `disc` (
  `id` varchar(255) NOT NULL,
  `TLP` int(11) NOT NULL,
  `LWP` int(11) NOT NULL,
  `BL` int(11) NOT NULL,
  `MJC` int(11) NOT NULL,
  `F` int(11) NOT NULL,
  `point` float NOT NULL,
  `verify` int(1) NOT NULL,
  `vid` varchar(255) NOT NULL,
  `locked` int(1) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `log` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `disc`
--

INSERT INTO `disc` (`id`, `TLP`, `LWP`, `BL`, `MJC`, `F`, `point`, `verify`, `vid`, `locked`, `comment`, `log`) VALUES
('fac1@ex.com', 0, 0, 0, 0, 0, 30, 0, '', 0, 'sdsddssdsdsdadas', '2023-05-02 19:56:43'),
('fac3@ex.com', 0, 0, 2, 0, 1, 29, 1, 'admin.dept@git.org.in', 1, 'sxscsddcdcscscs', '2023-05-02 19:56:43');

-- --------------------------------------------------------

--
-- Table structure for table `dp`
--

CREATE TABLE `dp` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `point` float NOT NULL,
  `role` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `vid` varchar(255) NOT NULL,
  `verify` int(1) NOT NULL,
  `locked` int(1) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `log` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dp`
--

INSERT INTO `dp` (`id`, `name`, `point`, `role`, `duration`, `vid`, `verify`, `locked`, `attachment`, `comment`, `log`) VALUES
('fac1@ex.com', 'portfolio2', 5, 'coordinator', '1year', 'hod.ce@git.org.in', 1, 1, 'portfolio2-DP.pdf', '', '2023-05-02 19:58:28'),
('fac1@ex.com', 'portfolio4', 1, 'cocooordinator', '1year', '', 0, 0, 'portfolio4-DP.pdf', '', '2023-05-02 20:12:55');

-- --------------------------------------------------------

--
-- Table structure for table `gr`
--

CREATE TABLE `gr` (
  `id` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `subjectName` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `point` float NOT NULL,
  `resultInstitute` float NOT NULL,
  `resultGtu` float NOT NULL,
  `verify` int(1) NOT NULL,
  `sem` int(1) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `locked` int(1) NOT NULL,
  `vid` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `log` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gr`
--

INSERT INTO `gr` (`id`, `subject`, `subjectName`, `year`, `point`, `resultInstitute`, `resultGtu`, `verify`, `sem`, `attachment`, `locked`, `vid`, `comment`, `log`) VALUES
('fac1@ex.com', '3130006', 'Probability and Statistics', '2022-23', 8, 76, 74, 1, 3, '3130006-GR.pdf', 1, 'hod.ce@git.org.in', '', '2023-05-02 19:47:16'),
('fac1@ex.com', '3150710', 'Computer Networks', '21-222', 0, 80, 80, 0, 5, '3150710-GR.pdf', 0, '', '', '2023-05-02 19:55:11'),
('fac1@ex.com', '3170716', 'Artificial Intelligence', '22', -2, 89, 90, 1, 7, '3170716-GR.pdf', 1, 'hod.ce@git.org.in', '', '2023-05-02 19:47:16'),
('fac3@ex.com', '3130004', 'Effective Technical Communication', '21-22', 12, 79, 76, 1, 3, '3130004-GR.pdf', 1, 'hod.ce@git.org.in', '', '2023-05-02 19:47:16');

-- --------------------------------------------------------

--
-- Table structure for table `inv`
--

CREATE TABLE `inv` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `point` float NOT NULL,
  `vid` varchar(255) NOT NULL,
  `verify` int(1) NOT NULL,
  `locked` int(1) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `log` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inv`
--

INSERT INTO `inv` (`id`, `name`, `level`, `date`, `topic`, `point`, `vid`, `verify`, `locked`, `attachment`, `comment`, `log`) VALUES
('fac1@ex.com', 'ddcdc', 'international', '2023-03-24', 'wwsw', 5, '', 0, 0, '2023-03-24-INV.pdf', '', '2023-05-02 19:58:28');

-- --------------------------------------------------------

--
-- Table structure for table `ip`
--

CREATE TABLE `ip` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `point` float NOT NULL,
  `role` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `vid` varchar(255) NOT NULL,
  `verify` int(1) NOT NULL,
  `locked` int(1) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `log` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `dp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `password`, `name`, `dept`, `role`, `dp`) VALUES
('admin.dept@git.org.in', '$2y$10$QTWMmH972yh.TOmfyNjv3OLH.s1gEDKrFS8UbjJicaLtUIUqS4p4a', 'Admin Dept', 'Admin Dept', 'Admin Dept', 'Admin Dept-DP.jpg'),
('director@git.org.in', '$2y$10$8bu.7rQFW108nNbhoWQ1..QcAjMpUWbIh0Oxb5Pxfif2RdzPSwwoq', 'Dr Lorem H Shah', 'GIT', 'Director', 'Dr Lorem H Shah-DP.jpg'),
('fac11@ex.com', '$2y$10$cmWNsYHio9.oUhmVPsFUcuGaZulHGVsXylsKpnxmQWsrXxMZVH65e', '', 'CE', 'Faculty', ''),
('fac1@ex.com', '$2y$10$vvFB1A2w4wITaV0Y9mvCNucp4aWvM7afF4294c7t8Fc7jDUMmpxnC', 'Dr.Naman N Doshi', 'CE', 'Faculty', 'Dr.Naman N Doshi-DP.jpg'),
('fac2@ex.com', '$2y$10$z3FNQOprw7Rs.94unPUlTOOHrCMd7o/wDLo3ndlUM4OnS3nYV/QHa', 'LOREM', 'IT', 'Faculty', ''),
('fac3@ex.com', '$2y$10$9Zy3WXpJhKveqKNJpGhG9.gLmvfEN81iiJQDj4JZBhz0N1w.0CSMu', 'Vatsal', 'CE', 'Faculty', 'Vatsal-dp.jpg'),
('fac5@ex.com', '$2y$10$5hrsAEwuY7D6a7tpLpMimOAni6g1ub/rXnkltjnZVfHNVBMnVyGpu', '', 'IT', 'Faculty', ''),
('hod.ce@git.org.in', '$2y$10$FUkL6LWVIjKnkZ3fEZIIoOH2UCdSnkGhU2EXAWZ2qgjZpmDTPdMKC', 'Dr. LOREM H Shah', 'CE', 'Hod', 'Dr. N H Shah-DP.jpg'),
('hod.ec@git.org.in', '$2y$10$oAM8asY8MwuMOndZDL.Tieys8u92g6Jy1oSNZ3/WTEo9xxCgFTR5S', '', 'EC', 'Hod', ''),
('hod.it@git.org.in', '$2y$10$AV5BAbd0ovGTFrHuQyY6xun8.pgrSJxLyor3Mmi.wztedGB4SJGnu', 'Hod IT', 'IT', 'Hod', 'Hod IT-dp.jpg'),
('superuser@git.org.in', '$2y$10$dF89pSlli7Dq5xrs3Rh/FuHpkaYjjBH.clw87s58/C7dBg0rLZ6XG', 'Super User', 'Super User', 'Super User', 'Super User-DP.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `raa1`
--

CREATE TABLE `raa1` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `considering` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `participants` int(11) NOT NULL,
  `point` float NOT NULL,
  `vid` varchar(255) NOT NULL,
  `verify` int(1) NOT NULL,
  `locked` int(1) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `log` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `raa1`
--

INSERT INTO `raa1` (`id`, `name`, `considering`, `date`, `role`, `participants`, `point`, `vid`, `verify`, `locked`, `attachment`, `comment`, `log`) VALUES
('fac1@ex.com', 'LOL', 'Students', '2022-12-06', 'Coordinator', 11, 5, 'hod.ce@git.org.in', 1, 1, '2022-12-06-RAA1.pdf', '', '2023-05-02 19:59:28');

-- --------------------------------------------------------

--
-- Table structure for table `raa2`
--

CREATE TABLE `raa2` (
  `id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `place` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `sponsoring_agency` varchar(255) NOT NULL,
  `participants` int(11) NOT NULL,
  `days` int(11) NOT NULL,
  `point` float NOT NULL,
  `vid` varchar(255) NOT NULL,
  `verify` int(1) NOT NULL,
  `locked` int(1) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `log` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `raa2`
--

INSERT INTO `raa2` (`id`, `title`, `place`, `date`, `sponsoring_agency`, `participants`, `days`, `point`, `vid`, `verify`, `locked`, `attachment`, `comment`, `log`) VALUES
('fac1@ex.com', 'KKKK', 'GIT', '2022-11-28', 'LOOL', 13, 5, 5, 'hod.ce@git.org.in', 1, 1, '2022-11-28-RAA2.pdf', '', '2023-05-02 19:59:28'),
('fac1@ex.com', 'LOREM', 'Ahmedabad', '2023-05-12', 'A', 10, 20, 20, '', 0, 0, '2023-05-12-RAA2.pdf', '', '2023-05-02 19:59:28');

-- --------------------------------------------------------

--
-- Table structure for table `raa3`
--

CREATE TABLE `raa3` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `date_of_examination` varchar(255) NOT NULL,
  `duration` int(11) NOT NULL,
  `point` float NOT NULL,
  `vid` varchar(255) NOT NULL,
  `verify` int(1) NOT NULL,
  `locked` int(1) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `log` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `raa3`
--

INSERT INTO `raa3` (`id`, `name`, `date`, `date_of_examination`, `duration`, `point`, `vid`, `verify`, `locked`, `attachment`, `comment`, `log`) VALUES
('fac1@ex.com', 'C1', '2022-12-05', '2022-12-09', 8, 10, 'hod.ce@git.org.in', 1, 1, '2022-12-05-RAA3.pdf', '', '2023-05-02 19:59:28');

-- --------------------------------------------------------

--
-- Table structure for table `raa4`
--

CREATE TABLE `raa4` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `membership` int(11) NOT NULL,
  `point` float NOT NULL,
  `vid` varchar(255) NOT NULL,
  `verify` int(1) NOT NULL,
  `locked` int(1) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `log` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `raa4`
--

INSERT INTO `raa4` (`id`, `name`, `date`, `type`, `membership`, `point`, `vid`, `verify`, `locked`, `attachment`, `comment`, `log`) VALUES
('fac1@ex.com', 'KKK', '2022-11-29', 'International', 2, 10, 'hod.ce@git.org.in', 1, 1, '2022-11-29-RAA4.pdf', '', '2023-05-02 19:59:28');

-- --------------------------------------------------------

--
-- Table structure for table `raa5`
--

CREATE TABLE `raa5` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `indexing` varchar(255) NOT NULL,
  `issn` varchar(255) NOT NULL,
  `journal` varchar(255) NOT NULL,
  `vpage` varchar(255) NOT NULL,
  `point` float NOT NULL,
  `vid` varchar(255) NOT NULL,
  `verify` int(1) DEFAULT NULL,
  `locked` int(1) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `log` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `raa5`
--

INSERT INTO `raa5` (`id`, `name`, `title`, `indexing`, `issn`, `journal`, `vpage`, `point`, `vid`, `verify`, `locked`, `attachment`, `comment`, `log`) VALUES
('fac1@ex.com', 'ss', 'SS', 'UGC', 'SSSSS', 'SSSS', 'SSS', 5, 'hod.ce@git.org.in', 1, 1, 'ss-RAA5.pdf', '', '2023-05-02 19:59:28');

-- --------------------------------------------------------

--
-- Table structure for table `raa6`
--

CREATE TABLE `raa6` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pi` varchar(255) NOT NULL,
  `cvp` varchar(255) NOT NULL,
  `pp` varchar(255) NOT NULL,
  `point` float NOT NULL,
  `vid` varchar(255) NOT NULL,
  `verify` int(1) DEFAULT NULL,
  `locked` int(1) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `log` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `raa6`
--

INSERT INTO `raa6` (`id`, `name`, `pi`, `cvp`, `pp`, `point`, `vid`, `verify`, `locked`, `attachment`, `comment`, `log`) VALUES
('fac1@ex.com', 'lorem', 'AA', 'AA', 'Presented International', 3, '', 0, 0, 'lorem-RAA6.pdf', '', '2023-05-02 20:16:42'),
('fac1@ex.com', 'ss', 'SSSSS', 'SSSSsSq', 'Presented International', 3, 'hod.ce@git.org.in', 1, 1, 'ss-RAA6.pdf', '', '2023-05-02 19:59:28');

-- --------------------------------------------------------

--
-- Table structure for table `raa7`
--

CREATE TABLE `raa7` (
  `id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `authors` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `point` float NOT NULL,
  `vid` varchar(255) NOT NULL,
  `verify` int(1) DEFAULT NULL,
  `locked` int(1) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `log` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `raa8`
--

CREATE TABLE `raa8` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `sem` int(1) NOT NULL,
  `link` varchar(255) NOT NULL,
  `point` float NOT NULL,
  `vid` varchar(255) NOT NULL,
  `verify` int(1) DEFAULT NULL,
  `locked` int(1) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `log` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `raa8`
--

INSERT INTO `raa8` (`id`, `name`, `subject`, `sem`, `link`, `point`, `vid`, `verify`, `locked`, `attachment`, `comment`, `log`) VALUES
('fac1@ex.com', 'Probability and Statistics', '3130006', 3, 'acc.commmm', 5, 'hod.ce@git.org.in', 1, 1, '3130006-RAA8.pdf', '', '2023-05-02 19:59:28'),
('fac1@ex.com', 'Artificial Intelligence', '3170716', 7, 'abc.com', 5, 'hod.ce@git.org.in', 1, 1, '3170716-RAA8.pdf', '', '2023-05-02 19:59:28');

-- --------------------------------------------------------

--
-- Table structure for table `raa9`
--

CREATE TABLE `raa9` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `point` float NOT NULL,
  `vid` varchar(255) NOT NULL,
  `verify` int(1) DEFAULT NULL,
  `locked` int(1) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `log` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `raa9`
--

INSERT INTO `raa9` (`id`, `name`, `type`, `point`, `vid`, `verify`, `locked`, `attachment`, `comment`, `log`) VALUES
('fac1@ex.com', 'Naman Doshi', 'International Grant', 20, 'hod.ce@git.org.in', 1, 1, 'fac1@ex.com-RAA9.pdf', 'Helllo', '2023-05-02 19:59:28'),
('fac1@ex.com', 'Software Engineer', 'International Grant', 20, 'hod.ce@git.org.in', 1, 1, 'fac1@ex.com-RAA9.pdf', '', '2023-05-02 19:59:28');

-- --------------------------------------------------------

--
-- Table structure for table `raa10`
--

CREATE TABLE `raa10` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `candidate` varchar(255) NOT NULL,
  `university` varchar(255) NOT NULL,
  `point` float NOT NULL,
  `vid` varchar(255) NOT NULL,
  `verify` int(1) DEFAULT NULL,
  `locked` int(1) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `log` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `raa10`
--

INSERT INTO `raa10` (`id`, `name`, `candidate`, `university`, `point`, `vid`, `verify`, `locked`, `attachment`, `comment`, `log`) VALUES
('fac1@ex.com', 'pg', '11', '1', 3, 'hod.ce@git.org.in', 1, 1, 'pg-RAA10.pdf', '', '2023-05-02 19:59:28'),
('fac1@ex.com', 'phd', '5', '1', 10, 'hod.ce@git.org.in', 1, 1, 'phd-RAA10.pdf', '', '2023-05-02 19:59:28'),
('fac1@ex.com', 'phd-thesis', '10', 'GTU', 15, 'hod.ce@git.org.in', 1, 1, 'phd-RAA10.pdf', '', '2023-05-02 19:59:28');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `code` int(11) NOT NULL,
  `sem` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`code`, `sem`, `name`) VALUES
(3130004, 3, 'Effective Technical Communication'),
(3130006, 3, 'Probability and Statistics'),
(3130007, 3, 'Indian Constitution'),
(3130702, 3, 'Data Structures'),
(3130703, 3, 'Database Management Systems'),
(3130704, 3, 'Digital Fundamentals'),
(3140702, 4, 'Operating System'),
(3140705, 4, 'Object Oriented Programming - I'),
(3140707, 4, 'Computer Organization & Architecture'),
(3140708, 4, 'Discrete Mathematics'),
(3140709, 4, 'Principles Of Economics And Management'),
(3150703, 5, 'Analysis And Design Of Algorithms'),
(3150709, 5, 'Professional Ethics'),
(3150710, 5, 'Computer Networks'),
(3150711, 5, 'Software Engineering'),
(3160704, 6, 'Theory of Computation'),
(3160707, 6, 'Advance java Programming'),
(3160712, 6, 'Microprocessor and Interfacing'),
(3160713, 6, 'WEB Programming'),
(3170726, 7, 'Mobile Application Development'),
(3170722, 7, 'Big Data Analytics'),
(3170701, 7, 'Compiler Design'),
(3170716, 7, 'Artificial Intelligence');

-- --------------------------------------------------------

--
-- Table structure for table `tlp`
--

CREATE TABLE `tlp` (
  `id` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `point` float NOT NULL,
  `verify` int(1) NOT NULL,
  `vid` varchar(255) NOT NULL,
  `sem` int(1) NOT NULL,
  `scheduleClass` float NOT NULL,
  `actualClass` float NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `locked` int(1) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `log` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tlp`
--

INSERT INTO `tlp` (`id`, `subject`, `name`, `point`, `verify`, `vid`, `sem`, `scheduleClass`, `actualClass`, `attachment`, `locked`, `comment`, `log`) VALUES
('fac1@ex.com', '3130006', 'Probability and Statistics', 45.83, 1, 'hod.ce@git.org.in', 3, 12, 11, '3130006-TLP.pdf', 1, 'lol2232323', '2023-05-02 19:34:59'),
('fac1@ex.com', '3130007', 'Indian Constitution', 55, 0, '', 3, 10, 11, '3130007-TLP.pdf', 0, 'dhkjndksnkdm', '2023-05-02 19:38:13'),
('fac1@ex.com', '3160704', 'Theory of Computation', 45.83, 0, '', 6, 12, 11, '3160704-TLP.pdf', 0, '', '2023-05-02 19:34:59'),
('fac1@ex.com', '3160712', 'Microprocessor and Interfacing', 45.45, 1, 'director@git.org.in', 6, 11, 10, '3160712-TLP.pdf', 1, '', '2023-05-02 19:34:59'),
('fac1@ex.com', '3170722', 'Big Data Analytics', 45.83, 0, '', 7, 12, 11, '3170722-TLP.pdf', 0, '', '2023-05-02 19:34:59'),
('fac2@ex.com', '3140707', 'Computer Organization & Architecture', 50, 0, 'hod.ce@git.org.in', 4, 11, 11, '3140707-TLP.pdf', 1, '', '2023-05-02 19:34:59'),
('fac3@ex.com', '3130004', 'Effective Technical Communication', 50, 0, '', 3, 11, 11, '3130004-TLP.pdf', 0, 'Helllo', '2023-05-02 19:34:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ao`
--
ALTER TABLE `ao`
  ADD PRIMARY KEY (`id`,`title`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `cts`
--
ALTER TABLE `cts`
  ADD PRIMARY KEY (`id`,`date`);

--
-- Indexes for table `disc`
--
ALTER TABLE `disc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dp`
--
ALTER TABLE `dp`
  ADD PRIMARY KEY (`id`,`name`);

--
-- Indexes for table `gr`
--
ALTER TABLE `gr`
  ADD PRIMARY KEY (`id`,`subject`);

--
-- Indexes for table `inv`
--
ALTER TABLE `inv`
  ADD PRIMARY KEY (`id`,`date`);

--
-- Indexes for table `ip`
--
ALTER TABLE `ip`
  ADD PRIMARY KEY (`id`,`name`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raa1`
--
ALTER TABLE `raa1`
  ADD PRIMARY KEY (`id`,`date`);

--
-- Indexes for table `raa2`
--
ALTER TABLE `raa2`
  ADD PRIMARY KEY (`id`,`date`);

--
-- Indexes for table `raa3`
--
ALTER TABLE `raa3`
  ADD PRIMARY KEY (`id`,`date`);

--
-- Indexes for table `raa4`
--
ALTER TABLE `raa4`
  ADD PRIMARY KEY (`id`,`date`);

--
-- Indexes for table `raa5`
--
ALTER TABLE `raa5`
  ADD PRIMARY KEY (`id`,`name`);

--
-- Indexes for table `raa6`
--
ALTER TABLE `raa6`
  ADD PRIMARY KEY (`id`,`name`);

--
-- Indexes for table `raa7`
--
ALTER TABLE `raa7`
  ADD PRIMARY KEY (`id`,`title`);

--
-- Indexes for table `raa8`
--
ALTER TABLE `raa8`
  ADD PRIMARY KEY (`id`,`subject`);

--
-- Indexes for table `raa9`
--
ALTER TABLE `raa9`
  ADD PRIMARY KEY (`id`,`name`);

--
-- Indexes for table `raa10`
--
ALTER TABLE `raa10`
  ADD PRIMARY KEY (`id`,`name`) USING BTREE;

--
-- Indexes for table `tlp`
--
ALTER TABLE `tlp`
  ADD PRIMARY KEY (`id`,`subject`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ao`
--
ALTER TABLE `ao`
  ADD CONSTRAINT `c2` FOREIGN KEY (`id`) REFERENCES `profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`id`) REFERENCES `profile` (`id`);

--
-- Constraints for table `cts`
--
ALTER TABLE `cts`
  ADD CONSTRAINT `c3` FOREIGN KEY (`id`) REFERENCES `profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `disc`
--
ALTER TABLE `disc`
  ADD CONSTRAINT `c4` FOREIGN KEY (`id`) REFERENCES `profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dp`
--
ALTER TABLE `dp`
  ADD CONSTRAINT `c5` FOREIGN KEY (`id`) REFERENCES `profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gr`
--
ALTER TABLE `gr`
  ADD CONSTRAINT `c6` FOREIGN KEY (`id`) REFERENCES `profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inv`
--
ALTER TABLE `inv`
  ADD CONSTRAINT `c7` FOREIGN KEY (`id`) REFERENCES `profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ip`
--
ALTER TABLE `ip`
  ADD CONSTRAINT `c8` FOREIGN KEY (`id`) REFERENCES `profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `raa1`
--
ALTER TABLE `raa1`
  ADD CONSTRAINT `c8.1` FOREIGN KEY (`id`) REFERENCES `profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `raa2`
--
ALTER TABLE `raa2`
  ADD CONSTRAINT `c8.2` FOREIGN KEY (`id`) REFERENCES `profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `raa3`
--
ALTER TABLE `raa3`
  ADD CONSTRAINT `c8.3` FOREIGN KEY (`id`) REFERENCES `profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `raa4`
--
ALTER TABLE `raa4`
  ADD CONSTRAINT `c8.4` FOREIGN KEY (`id`) REFERENCES `profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `raa5`
--
ALTER TABLE `raa5`
  ADD CONSTRAINT `c8.5` FOREIGN KEY (`id`) REFERENCES `profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `raa6`
--
ALTER TABLE `raa6`
  ADD CONSTRAINT `c8.6` FOREIGN KEY (`id`) REFERENCES `profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `raa7`
--
ALTER TABLE `raa7`
  ADD CONSTRAINT `c8.7` FOREIGN KEY (`id`) REFERENCES `profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `raa8`
--
ALTER TABLE `raa8`
  ADD CONSTRAINT `c8.8` FOREIGN KEY (`id`) REFERENCES `profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `raa9`
--
ALTER TABLE `raa9`
  ADD CONSTRAINT `c8.9` FOREIGN KEY (`id`) REFERENCES `profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `raa10`
--
ALTER TABLE `raa10`
  ADD CONSTRAINT `c8.10` FOREIGN KEY (`id`) REFERENCES `profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tlp`
--
ALTER TABLE `tlp`
  ADD CONSTRAINT `c1` FOREIGN KEY (`id`) REFERENCES `profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
