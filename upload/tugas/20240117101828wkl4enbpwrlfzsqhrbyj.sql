-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2024 at 02:07 PM
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
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0:not read, 1:read, ',
  `created_date` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `sender_id`, `receiver_id`, `message`, `file`, `status`, `created_date`, `created_at`, `updated_at`) VALUES
(1, 1, 17, 'apaan sih', NULL, 1, 1704896172, '2024-01-10 21:16:12', '2024-01-11 08:30:19'),
(2, 1, 17, 'apaan sih', NULL, 1, 1704896173, '2024-01-10 21:16:13', '2024-01-11 08:30:19'),
(3, 1, 17, 'apaan sih', NULL, 1, 1704896173, '2024-01-10 21:16:13', '2024-01-11 08:30:19'),
(4, 1, 17, 'apaan sih', NULL, 1, 1704896174, '2024-01-10 21:16:14', '2024-01-11 08:30:19'),
(5, 1, 17, 'apaan lu', NULL, 1, 1704896188, '2024-01-10 21:16:28', '2024-01-11 08:30:19'),
(6, 1, 17, 'apaan lu', NULL, 1, 1704896190, '2024-01-10 21:16:30', '2024-01-11 08:30:19'),
(7, 1, 17, 'apaan lu', NULL, 1, 1704896190, '2024-01-10 21:16:30', '2024-01-11 08:30:19'),
(8, 1, 17, 'apaan lu', NULL, 1, 1704896191, '2024-01-10 21:16:31', '2024-01-11 08:30:19'),
(9, 1, 17, 'apaan lu', NULL, 1, 1704896191, '2024-01-10 21:16:31', '2024-01-11 08:30:19'),
(10, 1, 17, 'apaan lu', NULL, 1, 1704896192, '2024-01-10 21:16:32', '2024-01-11 08:30:19'),
(11, 1, 17, 'apaan lu', NULL, 1, 1704896192, '2024-01-10 21:16:32', '2024-01-11 08:30:19'),
(12, 1, 17, 'apaan lu', NULL, 1, 1704896192, '2024-01-10 21:16:32', '2024-01-11 08:30:19'),
(13, 1, 17, 'hey\r\nsasa', NULL, 1, 1704896383, '2024-01-10 21:19:43', '2024-01-11 08:30:19'),
(14, 1, 17, 'maafin aku ya', NULL, 1, 1704896416, '2024-01-10 21:20:16', '2024-01-11 08:30:19'),
(15, 1, 17, 'halo', NULL, 1, 1704925012, '2024-01-11 05:16:52', '2024-01-11 08:30:19'),
(16, 1, 17, 'halo bang', NULL, 1, 1704925074, '2024-01-11 05:17:54', '2024-01-11 08:30:19'),
(17, 1, 17, 'heloo cuy', NULL, 1, 1704925266, '2024-01-11 05:21:06', '2024-01-11 08:30:19'),
(18, 1, 17, 'kenapa', NULL, 1, 1704925275, '2024-01-11 05:21:15', '2024-01-11 08:30:19'),
(19, 1, 17, 'apa eh', NULL, 1, 1704925391, '2024-01-11 05:23:11', '2024-01-11 08:30:19'),
(20, 1, 17, 'gpp', NULL, 1, 1704925398, '2024-01-11 05:23:18', '2024-01-11 08:30:19'),
(21, 1, 17, 'kamu kenaapa', NULL, 1, 1704925417, '2024-01-11 05:23:37', '2024-01-11 08:30:19'),
(22, 1, 17, 'kok diem aja', NULL, 1, 1704925429, '2024-01-11 05:23:49', '2024-01-11 08:30:19'),
(23, 1, 17, 'apa', NULL, 1, 1704925502, '2024-01-11 05:25:02', '2024-01-11 08:30:19'),
(24, 1, 17, 'gpp kok', NULL, 1, 1704925507, '2024-01-11 05:25:07', '2024-01-11 08:30:19'),
(25, 1, 5, 'selamat siang', NULL, 0, 1704925553, '2024-01-11 05:25:53', '2024-01-11 05:25:53'),
(26, 1, 5, '😅', NULL, 0, 1704925597, '2024-01-11 05:26:37', '2024-01-11 05:26:37'),
(27, 1, 5, 'pa', NULL, 0, 1704925743, '2024-01-11 05:29:03', '2024-01-11 05:29:03'),
(28, 1, 14, 'pak gimana kabarnya', NULL, 1, 1704927602, '2024-01-11 06:00:02', '2024-01-11 06:07:59'),
(29, 14, 1, 'iya gimana ada apa', NULL, 1, 1704927752, '2024-01-11 06:02:32', '2024-01-11 06:07:29'),
(30, 14, 1, 'saya sehat sehat aja kok', NULL, 1, 1704927758, '2024-01-11 06:02:38', '2024-01-11 06:07:29'),
(31, 14, 1, 'alhamdulilah', NULL, 1, 1704928115, '2024-01-11 06:08:35', '2024-01-11 06:09:13'),
(32, 14, 1, NULL, NULL, 1, 1704928116, '2024-01-11 06:08:36', '2024-01-11 06:09:13'),
(33, 14, 1, 'kalo bapak gimana', NULL, 1, 1704928121, '2024-01-11 06:08:41', '2024-01-11 06:09:13'),
(34, 1, 14, 'pak gimana', NULL, 1, 1704932332, '2024-01-11 07:18:52', '2024-01-11 07:22:11'),
(35, 1, 14, 'halo pak', NULL, 1, 1704932346, '2024-01-11 07:19:06', '2024-01-11 07:22:11'),
(36, 1, 17, 'halo', NULL, 1, 1704932424, '2024-01-11 07:20:24', '2024-01-11 08:30:19'),
(37, 1, 2, 'pagi pak', NULL, 1, 1704932445, '2024-01-11 07:20:45', '2024-01-11 07:23:02'),
(38, 14, 1, 'iya gak ada apa apa kok', NULL, 1, 1704932549, '2024-01-11 07:22:29', '2024-01-11 07:24:54'),
(39, 2, 1, 'ya pagi ada ap aya', NULL, 1, 1704932590, '2024-01-11 07:23:10', '2024-01-11 07:24:38'),
(40, 1, 2, 'gak ada pak', NULL, 0, 1704932692, '2024-01-11 07:24:52', '2024-01-11 07:24:52'),
(41, 14, 1, 'bang', NULL, 1, 1704935892, '2024-01-11 08:18:12', '2024-01-11 08:18:36'),
(42, 1, 4, 'selamat anak bapak menjadi juara', NULL, 1, 1704936426, '2024-01-11 08:27:06', '2024-01-11 08:27:30'),
(43, 1, 4, 'bangun pak', NULL, 1, 1704936430, '2024-01-11 08:27:10', '2024-01-11 08:27:30'),
(44, 4, 1, 'beneran nih?', NULL, 1, 1704936460, '2024-01-11 08:27:40', '2024-01-11 09:01:05'),
(45, 4, 1, 'iya lho pak', NULL, 1, 1704936538, '2024-01-11 08:28:58', '2024-01-11 09:01:05'),
(46, 17, 1, 'maaf', NULL, 1, 1704936624, '2024-01-11 08:30:24', '2024-01-11 08:35:13'),
(47, 4, 11, 'pie le kabare', NULL, 1, 1704936743, '2024-01-11 08:32:23', '2024-01-11 08:33:14'),
(48, 4, 11, 'kok ra tau ngabari', NULL, 1, 1704936774, '2024-01-11 08:32:54', '2024-01-11 08:33:14'),
(49, 11, 4, 'iyo yah maaf lagi sibuk', NULL, 0, 1704936804, '2024-01-11 08:33:24', '2024-01-11 08:33:24'),
(50, 11, 4, 'ayah pie kabare', NULL, 0, 1704936826, '2024-01-11 08:33:46', '2024-01-11 08:33:46'),
(51, 11, 4, 'ayah sehat kan?', NULL, 0, 1704936884, '2024-01-11 08:34:44', '2024-01-11 08:34:44'),
(52, 1, 17, 'eh kamu kemana aja', NULL, 1, 1704936923, '2024-01-11 08:35:23', '2024-01-11 08:36:04'),
(53, 1, 17, 'gak kemana mana sih', NULL, 1, 1704936930, '2024-01-11 08:35:30', '2024-01-11 08:36:04'),
(54, 17, 1, 'iya maaf bang', NULL, 1, 1704936973, '2024-01-11 08:36:13', '2024-01-11 09:01:06'),
(55, 17, 1, NULL, '202401110900230hfalfnlwxr23xydz9dj.docx', 1, 1704938423, '2024-01-11 09:00:23', '2024-01-11 09:01:06'),
(56, 17, 1, 'aku kirim gambar', '20240111090040rpld4lenw6j38an96fzn.jpg', 1, 1704938440, '2024-01-11 09:00:40', '2024-01-11 09:01:06'),
(57, 1, 17, 'ini bang', '20240111090247lh4koebiqgufvj9taosl.docx', 0, 1704938567, '2024-01-11 09:02:47', '2024-01-11 09:02:47'),
(58, 1, 14, 'pak ada apa', NULL, 1, 1704939445, '2024-01-11 09:17:25', '2024-01-11 09:17:56'),
(59, 1, 14, 'saya gak tau', NULL, 1, 1704939451, '2024-01-11 09:17:31', '2024-01-11 09:17:56'),
(60, 14, 1, 'kok gak tau', NULL, 1, 1704939854, '2024-01-11 09:24:14', '2024-01-11 09:25:11'),
(61, 14, 1, 'harus tau kamu itu', NULL, 1, 1704939860, '2024-01-11 09:24:20', '2024-01-11 09:25:11'),
(62, 14, 1, 'pokoknya tanggung jawab', NULL, 1, 1704939866, '2024-01-11 09:24:26', '2024-01-11 09:25:11'),
(63, 1, 14, 'oke bang', NULL, 1, 1704939915, '2024-01-11 09:25:15', '2024-01-11 09:32:30'),
(64, 1, 14, 'yaudah tungguin ya', NULL, 1, 1704939919, '2024-01-11 09:25:19', '2024-01-11 09:32:30'),
(65, 1, 5, 'pie pak ana apa', NULL, 0, 1704940321, '2024-01-11 09:32:01', '2024-01-11 09:32:01'),
(66, 1, 4, 'yaudha gapapa', NULL, 0, 1704940335, '2024-01-11 09:32:15', '2024-01-11 09:32:15'),
(67, 14, 1, 'hah maksudnya apa ini', NULL, 1, 1704940373, '2024-01-11 09:32:53', '2024-01-11 09:33:52'),
(68, 14, 1, 'saya gak minta apa apa', NULL, 1, 1704940378, '2024-01-11 09:32:58', '2024-01-11 09:33:52'),
(69, 14, 1, 'kamu maunya apa', NULL, 1, 1704940384, '2024-01-11 09:33:04', '2024-01-11 09:33:52');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:active, 1:inactive',
  `created_by` int(11) DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:not, 1:yes',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `name`, `status`, `created_by`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, '2KS1', 0, 1, 0, '2024-01-03 23:42:06', '2024-01-03 23:42:06'),
(2, '2KS2', 1, 1, 1, '2024-01-03 23:56:22', '2024-01-04 00:16:11'),
(3, '2KS4', 0, 1, 0, '2024-01-04 00:00:45', '2024-01-04 00:13:33'),
(4, '2KS5', 0, 1, 0, '2024-01-04 01:15:22', '2024-01-04 01:15:22');

-- --------------------------------------------------------

--
-- Table structure for table `class_timetable`
--

CREATE TABLE `class_timetable` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `matkul_id` int(11) DEFAULT NULL,
  `week_id` int(11) DEFAULT NULL,
  `start_time` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `room_number` varchar(10) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam_mulai` int(11) DEFAULT NULL,
  `menit_mulai` int(11) DEFAULT NULL,
  `jam_akhir` int(11) DEFAULT NULL,
  `menit_akhir` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_timetable`
--

INSERT INTO `class_timetable` (`id`, `class_id`, `matkul_id`, `week_id`, `start_time`, `end_time`, `room_number`, `tanggal`, `jam_mulai`, `menit_mulai`, `jam_akhir`, `menit_akhir`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 2, '08:03', '10:01', '123', '2024-01-08', 8, 3, 10, 1, '2024-01-06 01:01:38', NULL),
(2, 1, 6, 3, '10:01', '12:01', '321', '2024-01-02', 10, 1, 12, 1, '2024-01-06 01:01:38', NULL),
(3, 3, 8, 2, '08:33', '10:33', '321', '2024-01-10', 8, 33, 10, 33, '2024-01-06 01:33:29', '2024-01-06 01:33:29'),
(4, 3, 8, 3, '07:34', '12:33', '271', '2024-01-01', 7, 34, 12, 33, '2024-01-06 01:33:29', '2024-01-06 01:33:29'),
(5, 3, 8, 5, '09:33', '10:33', '331', '2024-01-03', 9, 33, 10, 33, '2024-01-06 01:33:29', '2024-01-06 01:33:29'),
(6, 4, 6, 6, '10:33', '12:33', '257', '2024-01-01', 10, 33, 12, 33, '2024-01-06 01:33:50', '2024-01-06 01:33:50'),
(7, 4, 5, 2, '10:25', '12:25', '341', '2024-01-02', 10, 25, 12, 25, '2024-01-07 03:25:25', '2024-01-07 03:25:25'),
(11, 3, 5, 2, '15:52', '17:53', '321', '2024-01-16', 15, 52, 17, 53, '2024-01-12 15:47:51', '2024-01-12 15:47:51'),
(12, 3, 5, 3, '15:54', '16:53', '333', '2024-01-09', 15, 54, 16, 53, '2024-01-12 15:47:51', '2024-01-12 15:47:51'),
(13, 3, 7, 2, '07:50', '09:50', '276', '2024-01-18', 7, 50, 9, 50, '2024-01-12 15:48:46', '2024-01-12 15:48:46'),
(14, 3, 7, 6, '15:48', '16:48', '257', '2024-01-12', 17, 48, 18, 48, '2024-01-12 15:48:46', '2024-01-12 15:48:46');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grade_nilai`
--

CREATE TABLE `grade_nilai` (
  `id` int(11) NOT NULL,
  `name` varchar(25) DEFAULT NULL,
  `percent_from` int(11) DEFAULT 0,
  `percent_to` int(11) DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grade_nilai`
--

INSERT INTO `grade_nilai` (`id`, `name`, `percent_from`, `percent_to`, `created_by`, `created_at`, `updated_at`) VALUES
(2, 'A', 80, 100, 1, '2024-01-08 09:08:15', '2024-01-08 09:08:15'),
(3, 'B', 70, 80, 1, '2024-01-08 09:08:28', '2024-01-08 09:08:28'),
(4, 'C', 60, 70, 1, '2024-01-08 09:08:38', '2024-01-08 09:08:38'),
(5, 'D', 0, 60, 1, '2024-01-12 11:38:28', '2024-01-12 11:38:37');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_ujian`
--

CREATE TABLE `jadwal_ujian` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `matkul_id` int(11) DEFAULT NULL,
  `exam_date` date DEFAULT NULL,
  `start_time` varchar(25) DEFAULT NULL,
  `end_time` varchar(25) DEFAULT NULL,
  `room_number` varchar(25) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_ujian`
--

INSERT INTO `jadwal_ujian` (`id`, `exam_id`, `class_id`, `matkul_id`, `exam_date`, `start_time`, `end_time`, `room_number`, `created_at`, `updated_at`, `created_by`) VALUES
(7, 11, 3, 8, '2024-01-06', '10:42', '12:43', '265', '2024-01-12 10:43:38', '2024-01-12 10:43:38', 1),
(8, 11, 3, 7, '2024-01-05', '11:43', '12:43', '254', '2024-01-12 10:43:38', '2024-01-12 10:43:38', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kurikulum`
--

CREATE TABLE `kurikulum` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `note` varchar(2000) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) DEFAULT 0 COMMENT '0:non ujian,1:ujian'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kurikulum`
--

INSERT INTO `kurikulum` (`id`, `name`, `note`, `created_by`, `created_at`, `updated_at`, `is_delete`, `status`) VALUES
(1, 'UTS 2023', '', 1, '2024-01-06 07:44:21', '2024-01-12 09:04:08', 0, 1),
(2, 'Semester 1', '', 1, '2024-01-06 07:44:33', '2024-01-09 07:33:32', 0, 0),
(3, 'Semester 2', '', 1, '2024-01-06 07:45:25', '2024-01-09 07:33:23', 0, 0),
(4, 'UAS 2023', '', 1, '2024-01-06 07:51:33', '2024-01-12 09:04:01', 0, 1),
(5, 'Semester 3', '', 1, '2024-01-06 07:52:28', '2024-01-09 07:33:14', 0, 0),
(6, 'Semester 4', '', 1, '2024-01-08 02:02:20', '2024-01-09 07:33:05', 0, 0),
(7, 'Semester 5', '', 1, '2024-01-12 09:03:52', '2024-01-12 09:03:52', 0, 0),
(8, 'Semester 6', '', 1, '2024-01-12 09:04:22', '2024-01-12 09:04:22', 0, 0),
(9, 'Semester 7', '', 1, '2024-01-12 09:04:37', '2024-01-12 09:04:37', 0, 0),
(10, 'Semester 8', '', 1, '2024-01-12 09:04:48', '2024-01-12 09:04:48', 0, 0),
(11, 'UTS 2024 Semester Ganjil', '', 1, '2024-01-12 10:40:25', '2024-01-12 10:40:25', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `matkul`
--

CREATE TABLE `matkul` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:active,1:inactive',
  `created_by` int(11) DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:not, 1:yes',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matkul`
--

INSERT INTO `matkul` (`id`, `name`, `type`, `status`, `created_by`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Analisis Peubah Ganda', '1', 0, 1, 1, '2024-01-04 01:16:26', '2024-01-04 01:22:24'),
(2, 'Pemrograman Web', NULL, 0, 1, 1, '2024-01-04 01:16:40', '2024-01-04 01:22:22'),
(3, 'Metode Statistika', NULL, 0, 1, 1, '2024-01-04 01:19:11', '2024-01-04 01:22:20'),
(4, 'Alin', NULL, 0, 1, 1, '2024-01-04 01:19:54', '2024-01-04 01:22:18'),
(5, 'Analisis Peubah Ganda', 'Teori', 0, 1, 0, '2024-01-04 01:22:30', '2024-01-04 01:27:22'),
(6, 'Pemrograman Web', 'Teori & Praktikum', 0, 1, 0, '2024-01-04 01:25:28', '2024-01-07 03:17:15'),
(7, 'Official Statistik', 'Teori', 0, 1, 0, '2024-01-04 02:28:30', '2024-01-04 02:28:30'),
(8, 'Data Mining', 'Teori', 0, 1, 0, '2024-01-04 02:28:39', '2024-01-04 02:28:39'),
(9, 'Interaksi Manusia Komputer', 'Teori & Praktikum', 0, 1, 0, '2024-01-04 02:28:50', '2024-01-07 03:17:08'),
(10, 'Teknologi Big Data', 'Teori', 0, 1, 0, '2024-01-04 02:29:02', '2024-01-04 02:29:02');

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
(19, 1, 6, 1, 0, 0, '2024-01-05 10:14:08', '2024-01-05 10:14:08'),
(21, 3, 5, 1, 0, 0, '2024-01-05 10:15:04', '2024-01-05 10:15:04'),
(22, 3, 7, 1, 0, 0, '2024-01-05 10:16:47', '2024-01-05 10:16:47'),
(23, 3, 8, 1, 0, 0, '2024-01-05 10:17:04', '2024-01-05 10:17:04'),
(26, 4, 5, 1, 0, 0, '2024-01-05 11:46:27', '2024-01-07 03:18:56');

-- --------------------------------------------------------

--
-- Table structure for table `matkul_dosen`
--

CREATE TABLE `matkul_dosen` (
  `id` int(11) NOT NULL,
  `matkul_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `dosen_id` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_delete` tinyint(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matkul_dosen`
--

INSERT INTO `matkul_dosen` (`id`, `matkul_id`, `class_id`, `dosen_id`, `status`, `created_by`, `created_at`, `updated_at`, `is_delete`) VALUES
(3, 8, 3, 14, 0, 1, '2024-01-05 11:14:23', '2024-01-07 03:03:03', 0),
(5, 7, 1, 14, 0, 1, '2024-01-05 11:44:12', '2024-01-05 11:46:57', 1),
(8, 5, 2, 2, 0, 1, '2024-01-05 11:53:35', '2024-01-12 11:40:37', 1),
(9, 7, 2, 2, 0, 1, '2024-01-05 11:53:57', '2024-01-12 11:40:34', 1),
(10, 14, 3, 2, 0, 1, '2024-01-05 11:54:17', '2024-01-05 12:10:30', 0),
(11, 10, 2, 2, 0, 1, '2024-01-05 11:54:29', '2024-01-05 11:54:55', 1),
(12, 2, 3, 2, 0, 1, '2024-01-05 11:54:36', '2024-01-07 03:01:59', 1),
(13, 6, 3, 16, 0, 1, '2024-01-07 02:50:59', '2024-01-07 03:01:56', 1),
(15, 5, 4, 16, 0, 1, '2024-01-07 02:58:11', '2024-01-07 03:25:01', 0),
(16, 9, 3, 16, 0, 1, '2024-01-12 11:41:41', '2024-01-12 11:41:41', 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `matkul_id` int(11) DEFAULT NULL,
  `tugas` int(11) NOT NULL DEFAULT 0,
  `praktikum` int(11) NOT NULL DEFAULT 0,
  `uts` int(11) NOT NULL DEFAULT 0,
  `uas` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `full_mark` int(11) DEFAULT 0,
  `passing_mark` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `student_id`, `exam_id`, `class_id`, `matkul_id`, `tugas`, `praktikum`, `uts`, `uas`, `created_by`, `created_at`, `updated_at`, `full_mark`, `passing_mark`) VALUES
(1, 9, 5, 4, NULL, 0, 0, 0, 0, 1, '2024-01-07 08:10:31', '2024-01-07 08:10:31', 100, 0),
(2, 11, 5, 3, NULL, 0, 0, 0, 0, 1, '2024-01-07 08:11:19', '2024-01-07 08:11:19', 100, 0),
(3, 11, 5, 3, 7, 40, 0, 30, 10, 1, '2024-01-07 08:18:03', '2024-01-08 03:29:00', 100, 65),
(4, 11, 5, 3, 8, 30, 0, 30, 20, 1, '2024-01-07 08:18:14', '2024-01-08 01:15:30', 100, 0),
(5, 8, 5, 3, 7, 10, 0, 30, 20, 1, '2024-01-07 08:18:48', '2024-01-08 09:14:35', 100, 65),
(6, 8, 5, 3, 8, 10, 0, 60, 10, 1, '2024-01-07 08:19:03', '2024-01-08 09:14:19', 100, 70),
(7, 8, 5, 3, 6, 0, 0, 0, 0, 1, '2024-01-07 08:19:40', '2024-01-07 08:19:40', 100, 0),
(8, 11, 5, 8, 8, 0, 0, 0, 0, 1, '2024-01-08 00:11:24', '2024-01-08 00:11:24', 100, 0),
(9, 11, 5, 7, 7, 89, 0, 77, 77, 1, '2024-01-08 00:11:34', '2024-01-08 00:11:34', 100, 0),
(10, 8, 5, 7, 7, 87, 0, 88, 90, 1, '2024-01-08 00:11:45', '2024-01-08 00:11:45', 100, 0),
(11, 11, 5, 6, 6, 0, 0, 0, 0, 1, '2024-01-08 00:19:02', '2024-01-08 00:19:02', 100, 0),
(12, 11, 5, 3, 6, 0, 0, 0, 0, 1, '2024-01-08 00:24:43', '2024-01-08 00:24:43', 100, 0),
(13, 11, 5, 3, 5, 20, 0, 20, 50, 1, '2024-01-08 01:14:34', '2024-01-08 09:18:16', 100, 80),
(14, 8, 5, 3, 5, 10, 0, 20, 40, 1, '2024-01-08 01:15:06', '2024-01-08 09:18:00', 100, 80),
(15, 9, 5, 4, 6, 10, 30, 30, 20, 1, '2024-01-08 01:19:37', '2024-01-08 01:19:55', 100, 0),
(16, 11, 3, 3, 7, 25, 0, 25, 20, 14, '2024-01-08 03:21:32', '2024-01-08 03:22:21', 100, 0),
(17, 8, 3, 3, 7, 10, 0, 50, 20, 2, '2024-01-09 10:40:09', '2024-01-09 10:40:09', 100, 60),
(20, 11, 10, 3, 8, 80, 0, 76, 72, 1, '2024-01-12 11:17:17', '2024-01-12 15:27:35', 300, 225),
(21, 11, 10, 3, 7, 78, 0, 76, 89, 1, '2024-01-12 11:17:30', '2024-01-12 11:17:30', 300, 225),
(22, 11, 10, 3, 5, 56, 0, 98, 80, 1, '2024-01-12 11:17:39', '2024-01-12 11:17:39', 300, 225);

-- --------------------------------------------------------

--
-- Table structure for table `olah_nilai`
--

CREATE TABLE `olah_nilai` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `matkul_id` int(11) DEFAULT NULL,
  `passing_mark` int(25) DEFAULT NULL,
  `full_mark` int(25) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `olah_nilai`
--

INSERT INTO `olah_nilai` (`id`, `exam_id`, `class_id`, `matkul_id`, `passing_mark`, `full_mark`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 10, 3, 8, 225, 300, 1, '2024-01-12 10:57:19', '2024-01-12 10:57:19'),
(2, 10, 3, 7, 225, 300, 1, '2024-01-12 10:57:19', '2024-01-12 10:57:19'),
(3, 10, 3, 5, 225, 300, 1, '2024-01-12 10:57:19', '2024-01-12 10:57:19'),
(4, 10, 1, 6, 275, 400, 1, '2024-01-12 11:12:04', '2024-01-12 11:12:04');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `tgl_pengumuman` date DEFAULT NULL,
  `tgl_publish` date DEFAULT NULL,
  `pesan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `judul`, `tgl_pengumuman`, `tgl_publish`, `pesan`, `created_by`, `created_at`, `updated_at`) VALUES
(4, 'penemuan Mobil BMW', '2024-01-02', '2024-01-04', '<p>ditemukan uang sebesar 50 juta</p>', 1, '2024-01-09 16:59:02', '2024-01-09 17:26:28'),
(5, 'penemuan duit', '2024-01-02', '2024-01-18', '<p>ditemukan duit 50 juta</p>', 1, '2024-01-09 17:48:31', '2024-01-09 17:48:31'),
(6, 'penemuan buku', '2024-01-05', '2024-01-11', '<p>ditemukan buku bahasa jepang</p>', 1, '2024-01-09 18:05:48', '2024-01-09 18:05:48');

-- --------------------------------------------------------

--
-- Table structure for table `perizinan`
--

CREATE TABLE `perizinan` (
  `student_id` int(11) DEFAULT NULL,
  `alasan` text DEFAULT NULL,
  `bukti` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `matkul_id` int(11) DEFAULT NULL,
  `presensi_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perizinan`
--

INSERT INTO `perizinan` (`student_id`, `alasan`, `bukti`, `updated_at`, `created_at`, `status`, `id`, `class_id`, `matkul_id`, `presensi_id`) VALUES
(11, '<p>males</p>', '20240112050930ptpgf6appvpddwz4swek.pdf', '2024-01-12 17:09:30', '2024-01-12 17:09:30', 'belum diterima', 4, 11, 3, NULL),
(11, '<p>males pak saya gak tau kenapa</p>', '20240112051134tuy0obqhwa53bha3s1ag.pdf', '2024-01-16 07:23:17', '2024-01-12 17:11:34', 'diterima', 5, 3, 7, 15),
(11, NULL, '20240116081654ivh1r7uyemneftmzpbjk.pdf', '2024-01-16 08:24:29', '2024-01-16 08:16:54', 'diterima', 6, 3, 8, 22),
(11, '<p>sakit batuk bu</p>', '20240116082140ffbv6btusamletegrsh1.pdf', '2024-01-16 08:21:40', '2024-01-16 08:21:40', 'belum diterima', 7, 3, 8, 22),
(11, '<p>ini pak maaf ya sebelumnya</p>', '20240116082807boh9jiyf3fkc5jmmc1bs.jpeg', '2024-01-16 08:28:46', '2024-01-16 08:28:07', 'ditolak', 8, 3, 8, 25);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesan_pengumuman`
--

CREATE TABLE `pesan_pengumuman` (
  `id` int(11) NOT NULL,
  `pengumuman_id` int(11) DEFAULT NULL,
  `pesan_to` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesan_pengumuman`
--

INSERT INTO `pesan_pengumuman` (`id`, `pengumuman_id`, `pesan_to`, `created_at`, `updated_at`) VALUES
(1, 3, 3, '2024-01-09 16:55:22', '2024-01-09 16:55:22'),
(2, 3, 2, '2024-01-09 16:55:22', '2024-01-09 16:55:22'),
(6, 4, 4, '2024-01-09 17:26:28', '2024-01-09 17:26:28'),
(7, 4, 2, '2024-01-09 17:26:28', '2024-01-09 17:26:28'),
(8, 5, 3, '2024-01-09 17:48:31', '2024-01-09 17:48:31'),
(9, 6, 3, '2024-01-09 18:05:48', '2024-01-09 18:05:48'),
(10, 6, 2, '2024-01-09 18:05:48', '2024-01-09 18:05:48'),
(11, 6, 2, '2024-01-09 18:05:48', '2024-01-09 18:05:48');

-- --------------------------------------------------------

--
-- Table structure for table `presensi_mahasiswa`
--

CREATE TABLE `presensi_mahasiswa` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `tgl_presensi` date DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `presensi_type` int(11) DEFAULT NULL COMMENT '1=hadir, 3=izin, 4=sakit, 5=tidak_hadir, 2=terlambat',
  `created_by` int(11) DEFAULT NULL,
  `created_at` varchar(30) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `matkul_id` int(11) DEFAULT NULL,
  `week_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `presensi_mahasiswa`
--

INSERT INTO `presensi_mahasiswa` (`id`, `class_id`, `tgl_presensi`, `student_id`, `presensi_type`, `created_by`, `created_at`, `updated_at`, `matkul_id`, `week_id`) VALUES
(2, 3, '2024-01-09', 11, 5, 0, '2024-01-09 10:52:00', '2024-01-09 10:53:48', 8, NULL),
(3, 1, '2024-01-06', 7, 1, 1, '2024-01-09 11:09:42', '2024-01-09 11:09:42', 6, NULL),
(4, 3, '2024-01-09', 11, 1, 0, '2024-01-09 15:55:00', '2024-01-09 15:55:18', 5, NULL),
(5, 3, '2024-01-11', 14, 2, 0, '2024-01-11 09:45:00', '2024-01-11 09:45:09', 8, NULL),
(15, 3, '2024-01-12', 11, 4, 0, '2024-01-12 17:11:00', '2024-01-12 17:11:22', 7, NULL),
(25, 3, '2024-01-16', 11, 4, 0, '2024-01-16 08:27:00', '2024-01-16 08:27:24', 8, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `submit_tugas`
--

CREATE TABLE `submit_tugas` (
  `id` int(11) NOT NULL,
  `tugas_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submit_tugas`
--

INSERT INTO `submit_tugas` (`id`, `tugas_id`, `student_id`, `description`, `document`, `created_at`, `updated_at`) VALUES
(1, 2, 11, '<p>selesai</p>', '20240110083306odgqj1jbw5rqvs7jvsxv.drawio', '2024-01-10 08:33:06', '2024-01-10 08:33:06'),
(2, 4, 9, NULL, '20240110083825oseladxosmqun2bgifs5.pdf', '2024-01-10 08:38:25', '2024-01-10 08:38:25'),
(3, 5, 11, '<p>maaf pak saya terlambat mengumpulkan</p>', '20240111100059kw4uxnnp8l3hijbix9at.docx', '2024-01-11 10:00:59', '2024-01-11 10:00:59'),
(4, 10, 11, '<p>maaf ada yang ketipek banyak</p>', '20240112033751iyll4nmeqwlhjeemdfkg.pdf', '2024-01-12 15:37:51', '2024-01-12 15:37:51');

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `matkul_id` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `document` varchar(255) CHARACTER SET ucs2 COLLATE ucs2_bin DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0 : tugas, 1:materi',
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id`, `class_id`, `matkul_id`, `tanggal`, `deadline`, `document`, `status`, `description`, `created_at`, `updated_at`, `is_delete`, `created_by`) VALUES
(2, 3, 8, '2024-01-10', '2024-01-12', '20240110063740ugqrjkvxfgsckc5khrpv.docx', 0, '<p>kerjakan dengn benar</p>', '2024-01-10 06:37:40', '2024-01-10 06:37:40', 0, 1),
(4, 4, 5, '2024-01-12', '2024-01-19', '20240110072459pnztlxbswiknihmamw3i.drawio', 0, '<p>mantap hayo</p>', '2024-01-10 07:24:59', '2024-01-10 07:24:59', 0, 1),
(5, 3, 8, '2024-01-10', '2024-01-13', '2024011010354819d88elz05fgzbwqn4r7.docx', 0, '<p>kerjakan dengan benar</p>', '2024-01-10 10:35:08', '2024-01-10 10:35:48', 0, 14),
(6, 3, 7, '2024-01-18', '2024-01-13', '20240112082037plb0s8w7qhuopsnokxm4.pdf', 1, '<p>pertemuan 1</p>', '2024-01-12 08:20:37', '2024-01-12 08:20:37', 0, 2),
(7, 3, 7, '2024-01-13', '2024-01-19', '20240112083024pjdgzx65sftroajuice1.pdf', 0, '<p>kerjakan sebelum jam 12</p>', '2024-01-12 08:30:24', '2024-01-12 08:30:24', 0, 2),
(8, 3, 8, '2024-01-05', '2024-01-04', '2024011208365033c9lxo5zxxsz9tdgb13.pdf', 0, '<p>tugas pertemuan 2</p>', '2024-01-12 08:36:50', '2024-01-12 08:36:50', 0, 14),
(9, 3, 8, '2024-01-17', NULL, '20240112083909z16k0u6w1eqlkl5yfswo.pdf', 1, '<p>materi pertemuan 9</p>', '2024-01-12 08:37:20', '2024-01-12 08:39:09', 0, 14),
(10, 3, 8, '2024-01-19', '2024-01-10', '20240112115023sgqkekpujeknqcdagqqa.pdf', 0, '<p>kerjakan sekarang juga</p>', '2024-01-12 11:50:23', '2024-01-12 11:50:23', 0, 16);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `user_type` tinyint(4) NOT NULL DEFAULT 3 COMMENT '1:admin, 2:dosen, 3:student, 4:parent',
  `is_delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:not deleted, 1:deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admission_number` varchar(255) DEFAULT NULL,
  `roll_number` varchar(50) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `caste` varchar(50) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `mobile_number` varchar(20) DEFAULT NULL,
  `admission_date` date DEFAULT NULL,
  `profile_pic` varchar(100) DEFAULT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `height` varchar(10) DEFAULT NULL,
  `weight` varchar(10) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0:active, 1:inactive',
  `occupation` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `work_experience` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `permanent_address` varchar(255) DEFAULT NULL,
  `material_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `user_type`, `is_delete`, `created_at`, `updated_at`, `admission_number`, `roll_number`, `class_id`, `gender`, `date_of_birth`, `caste`, `religion`, `mobile_number`, `admission_date`, `profile_pic`, `blood_group`, `height`, `weight`, `last_name`, `status`, `occupation`, `address`, `parent_id`, `work_experience`, `note`, `qualification`, `permanent_address`, `material_status`) VALUES
(1, 'BAAK', 'admin@gmail.com', NULL, '$2y$12$UseyEqWfPSVy3vTuyEh/3.x4QQCh/RsQHIugxVKlpTzwvHWygaeBe', 'SIjgZ8kMfnJRt0iD9ugf5Dp6AhSvfQ5owceAchqLmvv3rHONviih8ie7pFHq', 1, 0, '2024-01-03 09:22:14', '2024-01-16 13:06:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(2, 'dosen', 'dosen@gmail.com', NULL, '$2y$12$5JLEyZ9PwRGm0eQOpRzLJ.7ysZo0p4rQBH1BtREa1SfDe13lyH6VS', 'LCY4gjyZhIgA1Uf0c5PcXKe7TTWe3Q8MCoSHWYrvtx5GSRE73BozYaD99M70', 2, 0, '2024-01-03 09:22:14', '2024-01-12 04:39:51', NULL, NULL, NULL, 'Perempuan', '2024-01-01', NULL, NULL, '082871278172', '2024-01-04', '20240105025529genbf5jebcdfdhvjsbvz.jpeg', NULL, '', NULL, 'muda', 0, NULL, 'Jakbar', 0, 'lolso', 'lolos', 'lolos', 'Jatim', 'PBW'),
(3, 'student', 'student@gmail.com', NULL, '$2y$12$5JLEyZ9PwRGm0eQOpRzLJ.7ysZo0p4rQBH1BtREa1SfDe13lyH6VS', 'nwaBx1V3yh8PtD2rj6WTdBHKeJhyz5SNLUfK5D4BqXHnFYJWEkiKIOUopjAb', 3, 0, '2024-01-03 09:22:14', '2024-01-04 20:39:15', NULL, NULL, NULL, 'Laki-Laki', '2024-01-01', 'Jakarta Pusat', 'Islam', '088218718732', NULL, NULL, NULL, '180', '80', 'S2', 0, NULL, '', 0, NULL, NULL, NULL, NULL, NULL),
(4, 'ortu', 'ortu@gmail.com', NULL, '$2y$12$5JLEyZ9PwRGm0eQOpRzLJ.7ysZo0p4rQBH1BtREa1SfDe13lyH6VS', '8kstNlfLigEDl5EPhVwrYvDgxJXGMNN2MtqIRRO4IipXUDwJcT8fdy0vKv58', 4, 0, '2024-01-03 09:22:14', '2024-01-11 01:33:01', NULL, NULL, NULL, 'Perempuan', NULL, NULL, NULL, '08782182781', NULL, '20240104112317gy43syjkqq6hqu5xa3ne.jpg', NULL, NULL, NULL, 'sapa', 0, 'Guru', 'Kudus Jawa Tengah', 0, NULL, NULL, NULL, NULL, NULL),
(5, 'sehad official', 'setyahadinugroho3@gmail.com', NULL, '$2y$12$5JLEyZ9PwRGm0eQOpRzLJ.7ysZo0p4rQBH1BtREa1SfDe13lyH6VS', 'aUhs4UEbynK1ZFlRjmfd0qVBxaevtF', 1, 0, '2024-01-03 09:22:14', '2024-01-03 07:23:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(6, 'setya', 'setya@gmail.com', NULL, '$2y$12$zg9BP/a0YDe/B7H39v2ktOUOUiMUu0T.BMoYcW9k4D7nn0q9seOIK', NULL, 1, 1, '2024-01-03 06:42:59', '2024-01-03 07:05:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(7, 'setya', 'setyahadinugroho@gmail.com', NULL, '$2y$12$2VV5pjghH4IpS/oRwfXtPepvhNFvfDit1HWDwzFsUV2mf4aw3yF8G', NULL, 3, 0, '2024-01-04 03:15:31', '2024-01-06 20:07:04', '2221123', '121', 1, 'Laki-Laki', '2024-01-03', 'jawa', 'islam', '08129189218', '2024-01-18', NULL, 'O', '160', '80', 'hadi', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(8, 'Nugroho', 'setyahadinugroho11@gmail.com', NULL, '$2y$12$alQjr8TJlG3uWNfh.wmR2eMWPKsCcDbs01QjmSrABBXKTdtz1pKlC', NULL, 3, 0, '2024-01-04 03:16:50', '2024-01-04 03:16:50', '8392938', '32', 3, 'Laki-Laki', '2024-01-03', 'sunda', 'islam', '08398298329', '2024-01-01', NULL, 'A', '170', '', 'sehad', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(9, 'sindu', 'sindu@gmail.com', NULL, '$2y$12$EreUGoKhRZvDPG9hyxkTDul27sdxBzzA4nt0/rR.1DMix2d0WTlwu', NULL, 3, 0, '2024-01-04 03:24:28', '2024-01-05 03:19:25', '2192', '21', 4, 'Laki-Laki', '2024-01-01', 'Jawa', 'Islam', '08281817283', '2024-01-03', NULL, 'AB', '180', '55', 'dinar', 0, NULL, NULL, 15, NULL, NULL, NULL, NULL, NULL),
(10, 'yuda', 'yuda@gmail.com', NULL, '$2y$12$feEKZ9SiGWI.1mzDRuHlce7phgsg6gCE8v1XPWWAqmfOkb1Z618uS', NULL, 3, 1, '2024-01-04 03:27:47', '2024-01-04 05:11:49', '12871', '12', 3, 'Laki-Laki', '2024-01-01', 'Batak', 'Islam', '08281812817', '2024-01-02', NULL, 'O', '178', '', 'pangestu', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(11, 'bagas', 'bagas@gmail.com', NULL, '$2y$12$B7DfddxaxIfExLbRm4MrIuXE3UhmYDniTrNJHBv1GSlr3sfAGoZfe', NULL, 3, 0, '2024-01-04 03:31:07', '2024-01-16 01:30:00', '121872718', '1', 3, 'Perempuan', '2024-01-03', 'Betawi', 'Krsiten', '02718271827', '2024-01-01', '202401041149581srmy4nziszsgu8luu0o.jpg', 'O', '190', '80', 'koro', 0, NULL, NULL, 4, NULL, NULL, NULL, NULL, NULL),
(12, 'Bambang', 'bambang@gmail.com', NULL, '$2y$12$7m5oTDnFUVwR/la4wldrre5nqOuCPmm9Wmgba5KpqqySebDQwab8u', NULL, 4, 1, '2024-01-04 16:18:50', '2024-01-04 16:25:13', NULL, NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '082817218', NULL, '20240104111849uliyv4exviitat9wg9p3.jpeg', NULL, NULL, NULL, 'Sudiyono', 0, 'PNS', 'Jakarta', 0, NULL, NULL, NULL, NULL, NULL),
(13, 'Bagus', 'bagus@gmail.com', NULL, '$2y$12$1rRR29uxHgEMoWSQT9H3AuGSz4../Z0ySSjoQikCTf0v5i1Q3XDQ2', NULL, 2, 1, '2024-01-04 19:38:14', '2024-01-04 19:40:55', NULL, NULL, NULL, 'Laki-Laki', '2023-12-31', NULL, NULL, '08211872818', '2024-01-02', '202401050238147ddrj1sy2fyc9owi2jfa.jpg', NULL, '', NULL, 'Dwy', 0, NULL, 'Jaktim', NULL, 'mantap', 'mantap', 'test', 'Jember', 'Progrman Desktop'),
(14, 'Bagus Dwy', 'baguss@gmail.com', NULL, '$2y$12$ezhzWCeNkdphtaFZrQRum.gDvxEKj2l.aOFSfbi2zyUJA/pC9cZT2', NULL, 2, 0, '2024-01-04 19:54:39', '2024-01-12 08:28:16', NULL, NULL, NULL, 'Laki-Laki', '2024-01-01', NULL, NULL, '082121888', '2024-01-05', '20240105032642yxwjgngadjtqdmkzadu3.jpg', NULL, '', NULL, 'Cahyono', 0, NULL, 'Bekasi', NULL, 'wqwq', 'wqwq', 'test', 'Jaktim', 'PBO'),
(15, 'Fahrur', 'parent@gmail.com', NULL, '$2y$12$iQ.WcW2SX6khGdBkkT632.2dXPLo03WtLSFwesWAR.yEqOu6gKlXi', NULL, 4, 0, '2024-01-04 20:55:03', '2024-01-04 20:57:18', NULL, NULL, NULL, 'Other', NULL, NULL, NULL, '08873827328', NULL, '20240105035517yhmyj8ttzbyxzlr1yzzn.png', NULL, NULL, NULL, 'Zidan', 0, 'Pensiunan', 'Jakarta', NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Nori', 'nori@gmail.com', NULL, '$2y$12$U0ZgHdkDXQ/sOJi16cBFTeOUdQfNBb/YiStmAMh7rpmOlBdksdKb6', NULL, 2, 0, '2024-01-06 19:42:00', '2024-01-12 04:53:01', NULL, NULL, NULL, 'Perempuan', '2024-01-03', NULL, NULL, '0887382782', '2024-01-09', NULL, NULL, '', NULL, 'Wilantika', 0, NULL, 'Jakarta', NULL, '-', '-', '-', 'Medan', 'Rekayasa Perangkat Lunak'),
(17, 'Sehad', 'setyahadi@gmail.com', NULL, '$2y$12$fL0izRwIQhTLbfRx/BpOS.QwTwvktRsxx7oQ4OqwOX4CZsuENi6Q2', NULL, 1, 0, '2024-01-10 11:02:44', '2024-01-11 02:00:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20240110060244yckbv0kxfarphtkds0yg.jpeg', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `week`
--

CREATE TABLE `week` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `fullcalendar_day` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `week`
--

INSERT INTO `week` (`id`, `name`, `created_at`, `updated_at`, `fullcalendar_day`) VALUES
(2, 'Monday', '2024-01-06 06:20:58', '2024-01-06 06:20:58', 1),
(3, 'Tuesday', '2024-01-06 06:20:58', '2024-01-06 06:20:58', 2),
(4, 'Wednesday', '2024-01-06 06:20:58', '2024-01-06 06:20:58', 3),
(5, 'Thursday', '2024-01-06 06:20:58', '2024-01-06 06:20:58', 4),
(6, 'Friday', '2024-01-06 06:20:58', '2024-01-06 06:20:58', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_timetable`
--
ALTER TABLE `class_timetable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `grade_nilai`
--
ALTER TABLE `grade_nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal_ujian`
--
ALTER TABLE `jadwal_ujian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kurikulum`
--
ALTER TABLE `kurikulum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matkul`
--
ALTER TABLE `matkul`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matkul_class`
--
ALTER TABLE `matkul_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matkul_dosen`
--
ALTER TABLE `matkul_dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `olah_nilai`
--
ALTER TABLE `olah_nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perizinan`
--
ALTER TABLE `perizinan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pesan_pengumuman`
--
ALTER TABLE `pesan_pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `presensi_mahasiswa`
--
ALTER TABLE `presensi_mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submit_tugas`
--
ALTER TABLE `submit_tugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `week`
--
ALTER TABLE `week`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `class_timetable`
--
ALTER TABLE `class_timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grade_nilai`
--
ALTER TABLE `grade_nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jadwal_ujian`
--
ALTER TABLE `jadwal_ujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kurikulum`
--
ALTER TABLE `kurikulum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `matkul`
--
ALTER TABLE `matkul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `matkul_class`
--
ALTER TABLE `matkul_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `matkul_dosen`
--
ALTER TABLE `matkul_dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `olah_nilai`
--
ALTER TABLE `olah_nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `perizinan`
--
ALTER TABLE `perizinan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesan_pengumuman`
--
ALTER TABLE `pesan_pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `presensi_mahasiswa`
--
ALTER TABLE `presensi_mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `submit_tugas`
--
ALTER TABLE `submit_tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `week`
--
ALTER TABLE `week`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
