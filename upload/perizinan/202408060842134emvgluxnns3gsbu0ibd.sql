-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2024 at 02:43 AM
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
(1, 34, 39, 'assalamualaikum pak', NULL, 1, 1722307280, '2024-07-30 09:41:20', '2024-07-30 11:34:38'),
(2, 39, 34, 'iya waalaikumsalam ada apa?', NULL, 1, 1722314086, '2024-07-30 11:34:46', '2024-07-31 08:02:27'),
(3, 38, 37, 'belajar yang rajin ya', NULL, 1, 1722324580, '2024-07-30 14:29:40', '2024-08-02 03:21:00'),
(4, 34, 39, 'nanti kamu ngajar kelas 3SI1 ya', NULL, 0, 1722387760, '2024-07-31 08:02:40', '2024-07-31 08:02:40'),
(5, 34, 39, 'bisa dicek dulu', '20240731080255hgpy2dhvrpd10ma8jo9c.pdf', 0, 1722387775, '2024-07-31 08:02:55', '2024-07-31 08:02:55');

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
(1, '3SI3', 0, 34, 0, '2024-07-30 09:18:45', '2024-07-30 09:18:45'),
(2, '3SI1', 0, 34, 0, '2024-07-30 09:20:27', '2024-07-30 09:20:27'),
(3, '3SI2', 0, 34, 0, '2024-07-30 09:20:37', '2024-07-30 09:20:37');

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
(2, 1, 1, 3, '12:30', '14:30', '321', '2024-08-20', 12, 30, 14, 30, '2024-07-30 11:38:05', '2024-07-30 11:38:05'),
(14, 2, 6, 5, '08:40', '09:15', '321', '2024-08-01', 8, 40, 9, 15, '2024-08-01 08:56:30', '2024-08-01 08:56:30'),
(16, 2, 4, 5, '08:55', '10:05', '321', '2024-08-01', 8, 55, 10, 5, '2024-08-01 09:08:27', '2024-08-01 09:08:27'),
(18, 2, 1, 5, '09:45', '10:45', '321', '2024-08-01', 9, 45, 10, 45, '2024-08-01 09:50:11', '2024-08-01 09:50:11'),
(20, 2, 5, 5, '19:20', '20:30', '321', '2024-08-01', 19, 20, 20, 50, '2024-08-01 10:57:51', '2024-08-01 10:57:51'),
(21, 1, 2, 6, '07:25', '08:20', '257', '2024-08-04', 7, 25, 8, 20, '2024-08-02 03:20:10', '2024-08-02 03:20:10'),
(24, 2, 3, 2, '07:15', '09:00', '331', '2024-08-06', 7, 15, 9, 0, '2024-08-03 07:39:10', '2024-08-03 07:39:10');

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
(2, 'A', 85, 100, 34, '2024-01-08 09:08:15', '2024-01-16 20:15:22'),
(4, 'C-', 50, 55, 34, '2024-01-08 09:08:38', '2024-01-16 20:13:44'),
(5, 'D', 0, 50, 34, '2024-01-12 11:38:28', '2024-01-16 20:12:58'),
(6, 'C', 55, 60, 34, '2024-01-16 20:13:58', '2024-01-16 20:13:58'),
(7, 'C+', 60, 65, 34, '2024-01-16 20:14:15', '2024-01-16 20:14:15'),
(8, 'B-', 65, 70, 34, '2024-01-16 20:14:28', '2024-01-16 20:14:28'),
(9, 'B', 70, 75, 34, '2024-01-16 20:14:42', '2024-01-16 20:14:42'),
(10, 'B+', 75, 80, 34, '2024-01-16 20:14:56', '2024-01-16 20:14:56'),
(11, 'A-', 80, 85, 34, '2024-01-16 20:15:10', '2024-01-16 20:15:10');

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
(1, 10, 1, 2, '2024-08-01', '12:13', '13:13', '256', '2024-07-30 11:13:41', '2024-07-30 11:13:41', 34),
(2, 10, 1, 1, '2024-07-24', '13:13', '15:13', '266', '2024-07-30 11:13:41', '2024-07-30 11:13:41', 34),
(4, 10, 2, 6, '2024-08-01', '10:30', '12:30', '332', '2024-07-31 09:57:56', '2024-07-31 09:57:56', 34),
(5, 10, 2, 5, '2024-08-02', '10:30', '12:30', '321', '2024-07-31 09:57:56', '2024-07-31 09:57:56', 34),
(6, 10, 2, 4, '2024-08-05', '14:30', '16:30', '264', '2024-07-31 09:57:56', '2024-07-31 09:57:56', 34),
(7, 10, 2, 3, '2024-08-06', '08:00', '10:00', '251', '2024-07-31 09:57:56', '2024-07-31 09:57:56', 34),
(8, 10, 2, 2, '2024-08-07', '08:00', '10:00', '261', '2024-07-31 09:57:56', '2024-07-31 09:57:56', 34),
(9, 10, 2, 1, '2024-08-01', '15:16', '17:16', '321', '2024-07-31 09:57:56', '2024-07-31 09:57:56', 34);

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
(1, 'UTS 2024 Semester Ganjil', '', 1, '2024-01-16 21:53:56', '2024-01-16 21:53:56', 0, 1),
(2, 'Semester 1', '', 34, '2024-01-17 20:37:31', '2024-01-17 20:37:31', 0, 0),
(3, 'Semester 2', '', 34, '2024-01-17 20:37:38', '2024-01-17 20:37:38', 0, 0),
(4, 'Semester 3', '', 34, '2024-01-17 20:37:51', '2024-01-17 20:37:51', 0, 0),
(5, 'Semester 4', '', 34, '2024-01-17 20:37:59', '2024-01-17 20:37:59', 0, 0),
(6, 'Semester 5', '', 34, '2024-01-17 20:38:57', '2024-01-17 20:38:57', 0, 0),
(7, 'Semester 6', '', 34, '2024-01-17 20:39:04', '2024-01-17 20:39:04', 0, 0),
(8, 'Semester 7', '', 34, '2024-01-17 20:39:13', '2024-01-17 20:39:13', 0, 0),
(9, 'Semester 8', '', 34, '2024-01-17 20:39:25', '2024-01-17 20:39:25', 0, 0),
(10, 'Ujian Tengah Semester Ganjil', '', 34, '2024-07-30 11:10:06', '2024-07-30 11:10:06', 0, 1);

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
(1, 'Pemrograman Web', 'Teori & Praktikum', 0, 34, 0, '2024-07-30 09:44:32', '2024-07-30 09:44:32'),
(2, 'Official Statistik Lanjutan', 'Teori', 0, 34, 0, '2024-07-30 09:44:49', '2024-07-30 09:44:49'),
(3, 'Analisis Peubah Ganda', 'Teori & Praktikum', 0, 34, 0, '2024-07-31 09:17:30', '2024-07-31 09:17:30'),
(4, 'Data Mining', 'Teori', 0, 34, 0, '2024-07-31 09:17:42', '2024-07-31 09:17:42'),
(5, 'Teknologi Perekayasaan Data', 'Teori & Praktikum', 0, 34, 0, '2024-07-31 09:18:01', '2024-07-31 09:18:01'),
(6, 'Metode Penelitian', 'Teori', 0, 34, 0, '2024-07-31 09:18:33', '2024-07-31 09:18:33');

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
(2, 1, 2, 34, 0, 0, NULL, NULL),
(3, 3, 1, 34, 0, 0, NULL, NULL),
(4, 3, 2, 34, 0, 0, NULL, NULL),
(8, 2, 1, 34, 0, 0, NULL, '2024-07-30 09:52:03'),
(9, 2, 2, 34, 0, 0, NULL, NULL),
(10, 2, 3, 34, 0, 0, NULL, NULL),
(11, 2, 4, 34, 0, 0, NULL, NULL),
(12, 2, 5, 34, 0, 0, NULL, NULL),
(13, 2, 6, 34, 0, 0, NULL, NULL);

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
(1, 1, 1, 35, 0, 34, '2024-07-30 10:06:10', '2024-07-30 10:07:18', 0),
(2, 2, 2, 39, 0, 34, '2024-07-30 10:07:47', '2024-07-30 10:07:47', 0),
(3, 2, 2, 35, 0, 34, '2024-07-30 10:07:47', '2024-08-01 09:47:05', 1),
(4, 3, 2, 41, 0, 34, '2024-07-31 09:46:43', '2024-07-31 09:46:43', 0),
(5, 5, 2, 39, 0, 34, '2024-07-31 09:46:58', '2024-07-31 09:46:58', 0);

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
(1, 37, 8, 1, 1, 85, 75, 50, 87, 34, '2024-07-30 15:04:58', '2024-07-30 15:04:58', 400, 275),
(2, 37, 8, 1, 2, 75, 0, 80, 80, 34, '2024-07-30 15:05:08', '2024-07-30 15:05:08', 300, 225),
(3, 40, 9, 2, 6, 80, 0, 70, 90, 34, '2024-07-31 10:14:38', '2024-07-31 10:14:38', 300, 225),
(4, 40, 9, 2, 5, 87, 100, 80, 80, 34, '2024-07-31 10:15:22', '2024-07-31 10:15:22', 400, 275),
(5, 40, 9, 2, 4, 75, 0, 80, 80, 34, '2024-07-31 10:15:33', '2024-07-31 10:15:33', 300, 225),
(6, 40, 9, 2, 3, 80, 80, 75, 78, 34, '2024-07-31 10:15:45', '2024-07-31 10:16:18', 400, 275),
(7, 40, 9, 2, 2, 60, 0, 90, 80, 34, '2024-07-31 10:15:54', '2024-07-31 10:17:01', 300, 225),
(8, 40, 9, 2, 1, 90, 80, 76, 68, 34, '2024-07-31 10:16:41', '2024-07-31 10:16:41', 400, 275);

-- --------------------------------------------------------

--
-- Table structure for table `olah_nilai`
--

CREATE TABLE `olah_nilai` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `kurikulum_id` int(11) DEFAULT NULL,
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

INSERT INTO `olah_nilai` (`id`, `exam_id`, `kurikulum_id`, `class_id`, `matkul_id`, `passing_mark`, `full_mark`, `created_by`, `created_at`, `updated_at`) VALUES
(3, 8, NULL, 1, 2, 225, 300, 34, '2024-07-30 15:04:15', '2024-07-30 15:04:15'),
(4, 8, NULL, 1, 1, 275, 400, 34, '2024-07-30 15:04:15', '2024-07-30 15:04:15'),
(5, 3, NULL, 1, 2, 225, 300, 34, '2024-07-30 15:05:43', '2024-07-30 15:05:43'),
(6, 3, NULL, 1, 1, 275, 400, 34, '2024-07-30 15:05:43', '2024-07-30 15:05:43'),
(7, 9, NULL, 2, 6, 225, 300, 34, '2024-07-31 09:58:37', '2024-07-31 09:58:37'),
(8, 9, NULL, 2, 5, 275, 400, 34, '2024-07-31 09:58:37', '2024-07-31 09:58:37'),
(9, 9, NULL, 2, 4, 225, 300, 34, '2024-07-31 09:58:37', '2024-07-31 09:58:37'),
(10, 9, NULL, 2, 3, 275, 400, 34, '2024-07-31 09:58:37', '2024-07-31 09:58:37'),
(11, 9, NULL, 2, 2, 225, 300, 34, '2024-07-31 09:58:37', '2024-07-31 09:58:37'),
(12, 9, NULL, 2, 1, 275, 400, 34, '2024-07-31 09:58:37', '2024-07-31 09:58:37');

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
(1, 'penemuan duit', '2024-07-31', '2024-07-16', NULL, 34, '2024-07-30 11:28:45', '2024-07-30 11:28:45'),
(2, 'penemuan Mobil BMW', '2023-09-09', '2024-08-08', 'bmw warna merah', 34, '2024-07-30 14:04:17', '2024-07-30 14:04:17');

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
  `presensi_id` int(11) DEFAULT NULL,
  `dosen_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perizinan`
--

INSERT INTO `perizinan` (`student_id`, `alasan`, `bukti`, `updated_at`, `created_at`, `status`, `id`, `class_id`, `matkul_id`, `presensi_id`, `dosen_id`) VALUES
(40, 'sakit buu', '20240731114257a13wbepa13ersuhk6xen.xlsx', '2024-07-31 11:43:32', '2024-07-31 11:42:57', 'diterima', 2, 2, 6, 2, NULL),
(39, 'aku males ngajar', '20240801102005r4orhcyq6lzungrn7bbm.xlsx', '2024-08-01 10:23:33', '2024-08-01 10:20:05', 'tetep tidak diterima', 3, 2, 5, 21, NULL),
(NULL, 'males aku', '20240801102220wneczit2koo7ij61h4c4.xlsx', '2024-08-01 10:22:20', '2024-08-01 10:22:20', 'belum diterima', 4, 2, 5, 21, 39),
(NULL, 'males', '202408011117532d4vcr2xwdhejenlvq1c.xlsx', '2024-08-01 11:17:53', '2024-08-01 11:17:53', 'belum diterima', 5, 2, 5, 26, 39),
(40, 'takut ambulance', '20240801111825waeq6qxlzkgowcevybcw.jpeg', '2024-08-01 11:18:25', '2024-08-01 11:18:25', 'belum diterima', 6, 2, 5, 27, NULL),
(NULL, 'males', '20240801015547vqfsifxczrafa4sfynpc.htm', '2024-08-01 13:55:47', '2024-08-01 13:55:47', 'belum diterima', 7, 2, 5, 4, 39);

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
(1, 1, 3, '2024-07-30 11:28:45', '2024-07-30 11:28:45'),
(2, 1, 4, '2024-07-30 11:28:45', '2024-07-30 11:28:45'),
(3, 1, 2, '2024-07-30 11:28:45', '2024-07-30 11:28:45'),
(5, 2, 4, '2024-07-30 14:04:48', '2024-07-30 14:04:48'),
(6, 2, 2, '2024-07-30 14:04:48', '2024-07-30 14:04:48');

-- --------------------------------------------------------

--
-- Table structure for table `presensi_mahasiswa`
--

CREATE TABLE `presensi_mahasiswa` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `tgl_presensi` date DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `dosen_id` int(11) DEFAULT NULL,
  `presensi_type` int(11) DEFAULT NULL COMMENT '1=hadir, 3=izin, 4=sakit, 5=tidak_hadir, 2=terlambat',
  `created_by` int(11) DEFAULT NULL,
  `created_at` varchar(30) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `matkul_id` int(11) DEFAULT NULL,
  `week_id` int(11) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longtitude` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 2, 37, 'maaf saya terlambat pak', '20240730022334rzpxu964mvyeoxmuk8ge.xlsx', '2024-07-30 14:23:34', '2024-07-30 14:23:34'),
(2, 4, 40, 'tolong perbaiki lagi', '20240731113700tcimdk7oihzfxpydexzu.geojson', '2024-07-31 11:37:00', '2024-07-31 11:37:00');

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
(1, 2, 1, '2024-07-25', '2024-07-23', '202407300137129ezlmikhjz1xsli6quzl.geojson', 0, 'selesaikan dengan benar', '2024-07-30 13:37:12', '2024-07-30 13:37:12', 0, 35),
(2, 1, 1, '2024-07-19', '2024-07-31', '20240730014226e4z9gk8e1sctv6w4p4b7.pdf', 0, 'kerjakan dengan benar', '2024-07-30 13:38:41', '2024-07-30 13:42:26', 0, 35),
(3, 1, 1, '2024-07-18', NULL, '20240730014909f5zchr58ior1xsvkhiap.geojson', 1, 'simak baik baik', '2024-07-30 13:48:26', '2024-07-30 13:49:09', 0, 35),
(4, 2, 3, '2024-07-24', '2024-07-19', '2024073111191874bupotuavv9z1l3vfla.xlsx', 0, 'kerjakan dengan benar ya', '2024-07-31 11:19:18', '2024-07-31 11:19:18', 0, 41),
(5, 2, 3, '2024-07-31', NULL, '20240731112408vmezqpbpycrktuitplq6.xlsx', 1, 'pelajari excelnya ya', '2024-07-31 11:24:08', '2024-07-31 11:24:08', 0, 41);

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

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `user_type`, `is_delete`, `created_at`, `updated_at`, `admission_number`, `roll_number`, `class_id`, `gender`, `date_of_birth`, `caste`, `religion`, `mobile_number`, `admission_date`, `profile_pic`, `blood_group`, `height`, `weight`, `status`, `occupation`, `address`, `parent_id`, `work_experience`, `note`, `qualification`, `permanent_address`, `material_status`) VALUES
(5, 'sehad official', 'setyahadinugroho3@gmail.com', NULL, '$2y$12$h6k.KsmGGX3fZnNmSJefxepytMh/kvbfjgjXdSzvfLd6JMx.hVkJi', 'eru5zIliVMkknS6lkrWJb2LaiQxkzgYQVpapmi1P8r83dvN1tWXIn4kr1PvC', 1, 0, '2024-01-03 09:22:14', '2024-08-03 00:39:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20240729050552ghe51mlh5bvpazvb3y6e.jpeg', NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(34, 'Admin', 'admin@gmail.com', NULL, '$2y$12$SQR9nDAYe2QmGQBGwMHreOY8DISp8lzH2ljfWDP4bcJr/aG1aa1fW', 'UptYpKwKXUqxzbHeF1BkvrhGgll8wTDptK1nHvBJzybOGEKHAy8h4mgF4PH9', 1, 0, '2024-07-29 10:04:13', '2024-08-03 00:17:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 'Farid Ridho', 'farid@gmail.com', NULL, '$2y$12$IpNhXQQD4T7JUzPij3u2ye71nKLstXeNi5/b6wg6547s3zXHDcsJq', NULL, 2, 0, '2024-07-29 10:20:28', '2024-08-01 03:57:17', NULL, NULL, NULL, 'Laki-Laki', '1998-09-01', NULL, NULL, '082918921898', '2020-04-02', NULL, NULL, '', NULL, 0, NULL, 'Jakarta', NULL, 'Pegawai BPS', '-', '-', 'Temanggung', 'Keamanan Sistem Informasi'),
(36, 'Budi', 'budi@gmail.com', NULL, '$2y$12$mq..Lho4j5yMXphrts.hH.x/00u3T2cTDQ6HeXrZHwTYeykAP4whG', NULL, 4, 0, '2024-07-29 10:27:30', '2024-07-29 10:27:30', NULL, NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '082771827812', NULL, NULL, NULL, NULL, NULL, 0, 'Guru', 'Bekasi', NULL, NULL, NULL, NULL, NULL, NULL),
(37, 'Setya Hadi Nugroho', '222112358@stis.ac.id', NULL, '$2y$12$/Wq5rmXJIuKBOVuOXBqi1OV4uwJQVdumZ5qnJA95oEf2qXUzxOIDW', 'ZQV3J5iYn9PLywvJIYuUcdCWvs5JPyy6l8i53qBmMLDc1yZCN2N0LelPr4tI', 3, 0, '2024-07-30 02:24:36', '2024-08-03 00:31:14', '222112358', NULL, 1, 'Laki-Laki', '2024-07-19', 'Boyolali', 'Islam', '087831698802', NULL, '20240803065225eqpciyqkbrd9dtz4ioe8.jfif', NULL, '', '', 0, NULL, '', 38, NULL, NULL, NULL, NULL, NULL),
(38, 'Suhendra', 'suhendra@gmail.com', NULL, '$2y$12$hNuF50YyqNu4WmnxWJiwP.yxU/kpITE10DZ/ebCeh5clbYFvm0FtG', NULL, 4, 0, '2024-07-30 02:34:10', '2024-08-02 23:43:35', NULL, NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '08787281781', NULL, '20240803064222c77dydowythwm4hcajih.jpg', NULL, NULL, NULL, 0, 'Pengacara', 'Bekasi Jawa Barat', NULL, NULL, NULL, NULL, NULL, NULL),
(39, 'Ibnu Santoso', 'ibnu@gmail.com', NULL, '$2y$12$hyrw/OuEpYA8P6nygG74IOuLYkB02ThTPTFLnx7/lwBWTG.GVbArm', NULL, 2, 0, '2024-07-30 02:39:32', '2024-08-01 22:37:09', NULL, NULL, NULL, 'Laki-Laki', '1989-06-30', NULL, NULL, '087287182718', '2024-07-09', NULL, NULL, '', NULL, 0, NULL, 'Jakarta', NULL, 'belum ada', '-', '-', 'Banyumas Jawa Tengah', 'Pemrograman Web'),
(40, 'Himawan Wahid', 'himawan@gmail.com', NULL, '$2y$12$E0KZ5nhvUFGArRsrrTHSceBwC9QrFe.GAVouF1MOcKWwn9r25puaO', NULL, 3, 0, '2024-07-31 01:01:36', '2024-08-03 00:42:25', '22213131', NULL, 2, 'Laki-Laki', '2003-01-28', 'Klaten', 'Islam', '08728178217', NULL, '20240803072826t2mwjytpigtzbnu2bcq0.jpg', NULL, '', '', 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(41, 'Lia Yuliana', 'lia@gmail.com', NULL, '$2y$12$.UKJthIA9ZBhs3P.ySh/v.tWFnSgDnn9f4C5jS0yFgoV8EAajOwAq', NULL, 2, 0, '2024-07-31 02:04:42', '2024-07-31 04:25:36', NULL, NULL, NULL, 'Perempuan', '2009-02-02', NULL, NULL, '08783187183', '2024-07-04', NULL, NULL, '', NULL, 0, NULL, 'Jakarta', NULL, '2 tahun', '-', '-', 'Kuningan', 'Analisis Peubah Ganda');

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
(2, 'Senin', '2024-01-06 06:20:58', '2024-01-06 06:20:58', 1),
(3, 'Selasa', '2024-01-06 06:20:58', '2024-01-06 06:20:58', 2),
(4, 'Rabu', '2024-01-06 06:20:58', '2024-01-06 06:20:58', 3),
(5, 'Kamis', '2024-01-06 06:20:58', '2024-01-06 06:20:58', 4),
(6, 'Jumat', '2024-01-06 06:20:58', '2024-01-06 06:20:58', 5);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `class_timetable`
--
ALTER TABLE `class_timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grade_nilai`
--
ALTER TABLE `grade_nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jadwal_ujian`
--
ALTER TABLE `jadwal_ujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kurikulum`
--
ALTER TABLE `kurikulum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `matkul`
--
ALTER TABLE `matkul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `matkul_class`
--
ALTER TABLE `matkul_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `matkul_dosen`
--
ALTER TABLE `matkul_dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `olah_nilai`
--
ALTER TABLE `olah_nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `perizinan`
--
ALTER TABLE `perizinan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesan_pengumuman`
--
ALTER TABLE `pesan_pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `presensi_mahasiswa`
--
ALTER TABLE `presensi_mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `submit_tugas`
--
ALTER TABLE `submit_tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `week`
--
ALTER TABLE `week`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
