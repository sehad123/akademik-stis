-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2024 at 10:31 AM
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
-- Database: `stis.com`
--

-- --------------------------------------------------------

--
-- Table structure for table `matkul_class`
--

CREATE TABLE `matkul_class` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `matkul_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matkul_class`
--

INSERT INTO `matkul_class` (`id`, `class_id`, `matkul_id`, `created_by`, `is_delete`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 34, 0, 0, NULL, NULL),
(2, 1, 6, 34, 0, 0, NULL, '2024-08-05 19:44:09'),
(8, 2, 1, 34, 0, 0, NULL, '2024-07-30 09:52:03'),
(9, 2, 2, 34, 0, 0, NULL, NULL),
(10, 2, 3, 34, 0, 0, NULL, NULL),
(11, 2, 4, 34, 0, 0, NULL, NULL),
(12, 2, 5, 34, 0, 0, NULL, NULL),
(13, 2, 6, 34, 0, 0, NULL, NULL),
(21, 3, 1, 5, 0, 0, NULL, NULL),
(22, 3, 2, 5, 0, 0, NULL, NULL),
(23, 3, 3, 5, 0, 0, NULL, NULL),
(24, 3, 4, 5, 0, 0, NULL, NULL),
(25, 3, 6, 5, 0, 0, NULL, NULL),
(31, 4, 2, 5, 0, 0, NULL, NULL),
(32, 4, 3, 5, 0, 0, NULL, NULL),
(33, 4, 5, 5, 0, 0, NULL, NULL),
(34, 4, 7, 5, 0, 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `matkul_class`
--
ALTER TABLE `matkul_class`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `matkul_class`
--
ALTER TABLE `matkul_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
