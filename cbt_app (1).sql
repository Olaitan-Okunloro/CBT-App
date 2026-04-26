-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2026 at 01:55 PM
-- Server version: 9.2.0
-- PHP Version: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cbt_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `activity` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_read` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `activity`, `created_at`, `updated_at`, `is_read`) VALUES
(1, 3, 'Updated school profile', '2026-04-23 23:28:14', '2026-04-23 23:28:14', 0),
(2, 3, 'Changed password', '2026-04-24 00:08:47', '2026-04-24 00:08:47', 0),
(3, 3, 'Changed password', '2026-04-24 00:09:15', '2026-04-24 00:09:15', 0),
(4, 3, 'Updated school fees', '2026-04-24 00:48:18', '2026-04-24 00:48:18', 0),
(5, 3, 'Updated school fees', '2026-04-24 00:49:37', '2026-04-24 00:49:37', 0),
(6, 3, 'Updated school books list', '2026-04-24 01:06:14', '2026-04-24 01:06:14', 0),
(7, 6, 'Changed Password', '2026-04-24 01:11:50', '2026-04-24 01:11:50', 0),
(8, 3, 'Confirmed school fee payment', '2026-04-24 01:19:03', '2026-04-24 01:19:03', 0),
(9, 6, 'Checked result online', '2026-04-24 20:32:53', '2026-04-24 20:32:53', 0),
(10, 6, 'Checked result online', '2026-04-24 20:55:49', '2026-04-24 20:55:49', 0),
(11, 6, 'Checked result online', '2026-04-24 21:05:06', '2026-04-24 21:05:06', 0),
(12, 6, 'Checked result online', '2026-04-24 21:07:08', '2026-04-24 21:07:08', 0),
(13, 6, 'Checked result online', '2026-04-24 21:31:42', '2026-04-24 21:31:42', 0),
(14, 6, 'Checked result online', '2026-04-24 21:31:56', '2026-04-24 21:31:56', 0),
(15, 6, 'Checked result online', '2026-04-24 21:32:43', '2026-04-24 21:32:43', 0),
(16, 6, 'Checked result online', '2026-04-24 21:43:46', '2026-04-24 21:43:46', 0),
(17, 6, 'Checked result online', '2026-04-24 21:43:59', '2026-04-24 21:43:59', 0),
(18, 6, 'Checked result online', '2026-04-24 21:44:56', '2026-04-24 21:44:56', 0),
(19, 6, 'Checked result online', '2026-04-24 21:51:36', '2026-04-24 21:51:36', 0),
(20, 6, 'Checked result online', '2026-04-24 21:55:21', '2026-04-24 21:55:21', 0),
(21, 6, 'Checked result online', '2026-04-24 22:26:57', '2026-04-24 22:26:57', 0),
(22, 6, 'Checked result online', '2026-04-24 22:29:05', '2026-04-24 22:29:05', 0),
(23, 6, 'Checked result online', '2026-04-24 22:41:56', '2026-04-24 22:41:56', 0),
(24, 6, 'Checked result online', '2026-04-24 22:45:29', '2026-04-24 22:45:29', 0),
(25, 6, 'Checked result online', '2026-04-24 22:47:23', '2026-04-24 22:47:23', 0),
(26, 6, 'Checked result online', '2026-04-24 22:48:09', '2026-04-24 22:48:09', 0),
(27, 6, 'Checked result online', '2026-04-24 22:49:11', '2026-04-24 22:49:11', 0),
(28, 6, 'Checked result online', '2026-04-24 22:51:44', '2026-04-24 22:51:44', 0),
(29, 6, 'Checked result online', '2026-04-24 22:52:56', '2026-04-24 22:52:56', 0),
(30, 6, 'Checked result online', '2026-04-24 23:02:27', '2026-04-24 23:02:27', 0),
(31, 6, 'Checked result online', '2026-04-24 23:05:05', '2026-04-24 23:05:05', 0),
(32, 6, 'Checked result online', '2026-04-24 23:05:40', '2026-04-24 23:05:40', 0),
(33, 6, 'Checked result online', '2026-04-24 23:06:02', '2026-04-24 23:06:02', 0),
(34, 6, 'Checked result online', '2026-04-24 23:06:45', '2026-04-24 23:06:45', 0),
(35, 6, 'Checked result online', '2026-04-24 23:08:23', '2026-04-24 23:08:23', 0),
(36, 6, 'Checked result online', '2026-04-24 23:09:38', '2026-04-24 23:09:38', 0),
(37, 6, 'Checked result online', '2026-04-24 23:10:03', '2026-04-24 23:10:03', 0),
(38, 6, 'Checked result online', '2026-04-24 23:33:44', '2026-04-24 23:33:44', 0),
(39, 6, 'Checked result online', '2026-04-24 23:35:57', '2026-04-24 23:35:57', 0),
(40, 6, 'Checked result online', '2026-04-24 23:43:30', '2026-04-24 23:43:30', 0),
(41, 6, 'Checked result online', '2026-04-24 23:46:22', '2026-04-24 23:46:22', 0),
(42, 6, 'Checked result online', '2026-04-24 23:50:01', '2026-04-24 23:50:01', 0),
(43, 6, 'Checked result online', '2026-04-24 23:50:29', '2026-04-24 23:50:29', 0),
(44, 6, 'Checked result online', '2026-04-24 23:57:57', '2026-04-24 23:57:57', 0),
(45, 6, 'Checked result online', '2026-04-24 23:59:21', '2026-04-24 23:59:21', 0),
(46, 6, 'Checked result online', '2026-04-25 00:01:29', '2026-04-25 00:01:29', 0),
(47, 6, 'Checked result online', '2026-04-25 00:02:14', '2026-04-25 00:02:14', 0),
(48, 6, 'Checked result online', '2026-04-25 00:04:16', '2026-04-25 00:04:16', 0),
(49, 6, 'Checked result online', '2026-04-25 00:14:21', '2026-04-25 00:14:21', 0),
(50, 6, 'Checked result online', '2026-04-25 00:15:15', '2026-04-25 00:15:15', 0),
(51, 6, 'Checked result online', '2026-04-25 05:28:58', '2026-04-25 05:28:58', 0),
(52, 6, 'Checked result online', '2026-04-25 05:32:29', '2026-04-25 05:32:29', 0),
(53, 6, 'Checked result online', '2026-04-25 05:33:13', '2026-04-25 05:33:13', 0),
(54, 6, 'Checked result online', '2026-04-25 05:53:28', '2026-04-25 05:53:28', 0),
(55, 5, 'Okunloro Olaitan attendance marked', '2026-04-25 07:10:54', '2026-04-25 07:10:54', 0),
(56, 5, 'Okunloro Olaitan attendance marked', '2026-04-25 08:49:47', '2026-04-25 08:49:47', 0),
(57, 6, 'Checked result online', '2026-04-25 09:51:26', '2026-04-25 09:51:26', 0),
(58, 6, 'Checked result online', '2026-04-25 09:51:52', '2026-04-25 09:51:52', 0),
(59, 6, 'Checked result online', '2026-04-25 10:27:33', '2026-04-25 10:27:33', 0),
(60, 6, 'Checked result online', '2026-04-25 10:30:14', '2026-04-25 10:30:14', 0),
(61, 6, 'Checked result online', '2026-04-25 10:40:05', '2026-04-25 10:40:05', 0),
(62, 6, 'Checked result online', '2026-04-25 10:47:32', '2026-04-25 10:47:32', 0),
(63, 6, 'Checked result online', '2026-04-25 10:54:11', '2026-04-25 10:54:11', 0),
(64, 3, 'Released 1st Term results', '2026-04-25 11:03:25', '2026-04-25 11:03:25', 0),
(65, 6, 'Checked result online', '2026-04-25 11:08:04', '2026-04-25 11:08:04', 0),
(66, 3, 'Released 2nd Term results', '2026-04-25 11:08:59', '2026-04-25 11:08:59', 0),
(67, 3, 'Released 3rd Term results', '2026-04-25 11:09:04', '2026-04-25 11:09:04', 0),
(68, 3, 'Updated school fees', '2026-04-25 11:10:44', '2026-04-25 11:10:44', 0);

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `audience` varchar(50) DEFAULT 'all',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` bigint NOT NULL,
  `attempt_id` bigint DEFAULT NULL,
  `question_id` bigint DEFAULT NULL,
  `selected_option` varchar(10) DEFAULT NULL,
  `is_correct` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint UNSIGNED NOT NULL,
  `student_details_id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `check_in_time` time DEFAULT NULL,
  `check_out_time` time DEFAULT NULL,
  `status` varchar(50) DEFAULT 'present',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `student_details_id`, `date`, `check_in_time`, `check_out_time`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, '2026-04-25', '10:44:32', NULL, 'late', 5, '2026-04-25 09:44:32', '2026-04-25 09:44:32');

-- --------------------------------------------------------

--
-- Table structure for table `bulk_payments`
--

CREATE TABLE `bulk_payments` (
  `id` bigint NOT NULL,
  `school_id` bigint NOT NULL,
  `student_count` int DEFAULT '0',
  `amount` decimal(12,2) DEFAULT '0.00',
  `reference` varchar(100) DEFAULT NULL,
  `status` varchar(30) DEFAULT 'pending',
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bulk_payments`
--

INSERT INTO `bulk_payments` (`id`, `school_id`, `student_count`, `amount`, `reference`, `status`, `paid_at`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 6000.00, 'BULK-C8NDM20T', 'success', '2026-04-23 23:18:38', '2026-04-23 23:18:18', '2026-04-23 23:18:38');

-- --------------------------------------------------------

--
-- Table structure for table `bulk_payment_students`
--

CREATE TABLE `bulk_payment_students` (
  `id` bigint NOT NULL,
  `bulk_payment_id` bigint NOT NULL,
  `student_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bulk_payment_students`
--

INSERT INTO `bulk_payment_students` (`id`, `bulk_payment_id`, `student_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2026-04-23 23:18:18', '2026-04-23 23:18:18'),
(2, 1, 2, '2026-04-23 23:18:18', '2026-04-23 23:18:18');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Primary 1', NULL, NULL),
(2, 'Primary 2', NULL, NULL),
(3, 'Primary 3', NULL, NULL),
(4, 'Primary 4', NULL, NULL),
(5, 'Primary 5', NULL, NULL),
(6, 'Primary 6', NULL, NULL),
(7, 'JSS1', NULL, NULL),
(8, 'JSS2', NULL, NULL),
(9, 'JSS3', NULL, NULL),
(10, 'SS1', NULL, NULL),
(11, 'SS2', NULL, NULL),
(13, 'WAEC', '2026-04-02 20:23:30', '2026-04-02 20:23:30'),
(14, 'NECO', '2026-04-02 20:23:30', '2026-04-02 20:23:30'),
(15, 'UTME', '2026-04-02 20:23:30', '2026-04-02 20:23:30');

-- --------------------------------------------------------

--
-- Table structure for table `class_subjects`
--

CREATE TABLE `class_subjects` (
  `id` int NOT NULL,
  `class_level_id` int NOT NULL,
  `subject_id` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `class_subjects`
--

INSERT INTO `class_subjects` (`id`, `class_level_id`, `subject_id`) VALUES
(2, 1, 1),
(3, 1, 1),
(4, 1, 1),
(5, 1, 1),
(6, 1, 1),
(7, 1, 1),
(8, 1, 1),
(9, 1, 1),
(10, 1, 1),
(11, 1, 1),
(12, 1, 3),
(13, 1, 3),
(14, 1, 3),
(15, 1, 3),
(16, 1, 3),
(17, 1, 3),
(18, 1, 3),
(19, 1, 3),
(20, 1, 3),
(21, 1, 3),
(22, 2, 1),
(23, 2, 1),
(24, 2, 1),
(25, 2, 1),
(26, 2, 1),
(27, 2, 1),
(28, 2, 1),
(29, 2, 1),
(30, 2, 1),
(31, 2, 1),
(32, 2, 3),
(33, 2, 3),
(34, 2, 3),
(35, 2, 3),
(36, 2, 3),
(37, 2, 3),
(38, 2, 3),
(39, 2, 3),
(40, 2, 3),
(41, 2, 3),
(42, 3, 1),
(43, 3, 1),
(44, 3, 1),
(45, 3, 1),
(46, 3, 1),
(47, 3, 1),
(48, 3, 1),
(49, 3, 1),
(50, 3, 1),
(51, 3, 1),
(52, 3, 3),
(53, 3, 3),
(54, 3, 3),
(55, 3, 3),
(56, 3, 3),
(57, 3, 3),
(58, 3, 3),
(59, 3, 3),
(60, 3, 3),
(61, 3, 3),
(62, 3, 4),
(63, 3, 4),
(64, 3, 4),
(65, 3, 4),
(66, 3, 4),
(67, 3, 4),
(68, 3, 4),
(69, 3, 4),
(70, 3, 4),
(71, 3, 4),
(72, 4, 1),
(73, 4, 1),
(74, 4, 1),
(75, 4, 1),
(76, 4, 1),
(77, 4, 1),
(78, 4, 1),
(79, 4, 1),
(80, 4, 1),
(81, 4, 1),
(82, 4, 3),
(83, 4, 3),
(84, 4, 3),
(85, 4, 3),
(86, 4, 3),
(87, 4, 3),
(88, 4, 3),
(89, 4, 3),
(90, 4, 3),
(91, 4, 3),
(92, 4, 4),
(93, 4, 4),
(94, 4, 4),
(95, 4, 4),
(96, 4, 4),
(97, 4, 4),
(98, 4, 4),
(99, 4, 4),
(100, 4, 4),
(101, 4, 4),
(102, 4, 5),
(103, 4, 5),
(104, 4, 5),
(105, 4, 5),
(106, 4, 5),
(107, 4, 5),
(108, 4, 5),
(109, 4, 5),
(110, 4, 5),
(111, 4, 5),
(112, 5, 1),
(113, 5, 1),
(114, 5, 1),
(115, 5, 1),
(116, 5, 1),
(117, 5, 1),
(118, 5, 1),
(119, 5, 1),
(120, 5, 1),
(121, 5, 1),
(122, 5, 3),
(123, 5, 3),
(124, 5, 3),
(125, 5, 3),
(126, 5, 3),
(127, 5, 3),
(128, 5, 3),
(129, 5, 3),
(130, 5, 3),
(131, 5, 3),
(132, 5, 4),
(133, 5, 4),
(134, 5, 4),
(135, 5, 4),
(136, 5, 4),
(137, 5, 4),
(138, 5, 4),
(139, 5, 4),
(140, 5, 4),
(141, 5, 4),
(142, 5, 5),
(143, 5, 5),
(144, 5, 5),
(145, 5, 5),
(146, 5, 5),
(147, 5, 5),
(148, 5, 5),
(149, 5, 5),
(150, 5, 5),
(151, 5, 5),
(152, 6, 1),
(153, 6, 1),
(154, 6, 1),
(155, 6, 1),
(156, 6, 1),
(157, 6, 1),
(158, 6, 1),
(159, 6, 1),
(160, 6, 1),
(161, 6, 1),
(162, 6, 3),
(163, 6, 3),
(164, 6, 3),
(165, 6, 3),
(166, 6, 3),
(167, 6, 3),
(168, 6, 3),
(169, 6, 3),
(170, 6, 3),
(171, 6, 3),
(172, 6, 4),
(173, 6, 4),
(174, 6, 4),
(175, 6, 4),
(176, 6, 4),
(177, 6, 4),
(178, 6, 4),
(179, 6, 4),
(180, 6, 4),
(181, 6, 4),
(182, 6, 5),
(183, 6, 5),
(184, 6, 5),
(185, 6, 5),
(186, 6, 5),
(187, 6, 5),
(188, 6, 5),
(189, 6, 5),
(190, 6, 5),
(191, 6, 5),
(192, 7, 1),
(193, 7, 1),
(194, 7, 1),
(195, 7, 1),
(196, 7, 1),
(197, 7, 1),
(198, 7, 1),
(199, 7, 1),
(200, 7, 1),
(201, 7, 1),
(202, 7, 1),
(203, 7, 1),
(204, 7, 1),
(205, 7, 1),
(206, 7, 1),
(207, 7, 3),
(208, 7, 3),
(209, 7, 3),
(210, 7, 3),
(211, 7, 3),
(212, 7, 3),
(213, 7, 3),
(214, 7, 3),
(215, 7, 3),
(216, 7, 3),
(217, 7, 4),
(218, 7, 4),
(219, 7, 4),
(220, 7, 4),
(221, 7, 4),
(222, 7, 4),
(223, 7, 4),
(224, 7, 4),
(225, 7, 4),
(226, 7, 4),
(227, 7, 6),
(228, 7, 6),
(229, 7, 6),
(230, 7, 6),
(231, 7, 6),
(232, 7, 6),
(233, 7, 6),
(234, 7, 6),
(235, 7, 6),
(236, 7, 6),
(237, 7, 5),
(238, 7, 5),
(239, 7, 5),
(240, 7, 5),
(241, 7, 5),
(242, 7, 5),
(243, 7, 5),
(244, 7, 5),
(245, 7, 5),
(246, 7, 5),
(247, 8, 1),
(248, 8, 1),
(249, 8, 1),
(250, 8, 1),
(251, 8, 1),
(252, 8, 1),
(253, 8, 1),
(254, 8, 1),
(255, 8, 1),
(256, 8, 1),
(257, 8, 3),
(258, 8, 3),
(259, 8, 3),
(260, 8, 3),
(261, 8, 3),
(262, 8, 3),
(263, 8, 3),
(264, 8, 3),
(265, 8, 3),
(266, 8, 3),
(267, 9, 1),
(268, 9, 1),
(269, 9, 1),
(270, 9, 1),
(271, 9, 1),
(272, 9, 3),
(273, 9, 3),
(274, 9, 3),
(275, 9, 4),
(276, 9, 6),
(277, 9, 5),
(278, 10, 1),
(279, 10, 1),
(280, 10, 1),
(281, 10, 1),
(282, 10, 1),
(283, 10, 1),
(284, 10, 1),
(285, 10, 1),
(286, 10, 1),
(287, 10, 1),
(288, 10, 1),
(289, 10, 1),
(290, 10, 1),
(291, 10, 1),
(292, 10, 1),
(293, 10, 3),
(294, 10, 3),
(295, 10, 3),
(296, 10, 3),
(297, 10, 3),
(298, 10, 3),
(299, 10, 3),
(300, 10, 3),
(301, 10, 3),
(302, 10, 3),
(303, 10, 7),
(304, 10, 7),
(305, 10, 7),
(306, 10, 7),
(307, 10, 7),
(308, 10, 7),
(309, 10, 7),
(310, 10, 7),
(311, 10, 7),
(312, 10, 7),
(313, 10, 8),
(314, 10, 8),
(315, 10, 8),
(316, 10, 8),
(317, 10, 8),
(318, 10, 8),
(319, 10, 8),
(320, 10, 8),
(321, 10, 8),
(322, 10, 8),
(323, 10, 9),
(324, 10, 9),
(325, 10, 9),
(326, 10, 9),
(327, 10, 9),
(328, 10, 9),
(329, 10, 9),
(330, 10, 9),
(331, 10, 9),
(332, 10, 9),
(333, 11, 1),
(334, 11, 1),
(335, 11, 1),
(336, 11, 1),
(337, 11, 1),
(338, 11, 1),
(339, 11, 1),
(340, 11, 1),
(341, 11, 1),
(342, 11, 1),
(343, 11, 7),
(344, 11, 7),
(345, 11, 7),
(346, 11, 7),
(347, 11, 7),
(348, 11, 8),
(349, 11, 8),
(350, 11, 8),
(351, 11, 8),
(352, 11, 8),
(353, 11, 9),
(354, 11, 9),
(355, 11, 9),
(356, 11, 9),
(357, 11, 9),
(358, 13, 1),
(359, 13, 1),
(360, 13, 1),
(361, 13, 1),
(362, 13, 1),
(363, 13, 1),
(364, 13, 3),
(365, 13, 3),
(366, 13, 3),
(367, 13, 3),
(368, 13, 3),
(369, 13, 3),
(370, 14, 1),
(371, 14, 1),
(372, 14, 1),
(373, 14, 1),
(374, 14, 1),
(375, 14, 1),
(376, 14, 3),
(377, 14, 3),
(378, 14, 3),
(379, 14, 3),
(380, 14, 3),
(381, 14, 3),
(382, 15, 1),
(383, 15, 1),
(384, 15, 1),
(385, 15, 1),
(386, 15, 1),
(387, 15, 1),
(388, 15, 3),
(389, 15, 3),
(390, 15, 3),
(391, 15, 3),
(392, 15, 3),
(393, 15, 3);

-- --------------------------------------------------------

--
-- Table structure for table `commissions`
--

CREATE TABLE `commissions` (
  `id` bigint NOT NULL,
  `referrer_id` bigint NOT NULL,
  `student_id` bigint DEFAULT NULL,
  `payment_id` bigint NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `type` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `commissions`
--

INSERT INTO `commissions` (`id`, `referrer_id`, `student_id`, `payment_id`, `amount`, `type`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 600.00, 'student', '2026-04-23 23:18:38', '2026-04-23 23:18:38'),
(2, 2, 2, 1, 600.00, 'student', '2026-04-23 23:18:38', '2026-04-23 23:18:38');

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conversation_participants`
--

CREATE TABLE `conversation_participants` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subject_id` bigint DEFAULT NULL,
  `class_id` int DEFAULT NULL,
  `school_id` int DEFAULT NULL,
  `exam_cat_id` int NOT NULL,
  `duration` int DEFAULT NULL,
  `total_questions` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_attempts`
--

CREATE TABLE `exam_attempts` (
  `id` bigint NOT NULL,
  `user_id` bigint DEFAULT NULL,
  `subject_id` bigint DEFAULT NULL,
  `exam_id` bigint DEFAULT NULL,
  `score` int DEFAULT '0',
  `total` int DEFAULT NULL,
  `started_at` timestamp NULL DEFAULT NULL,
  `submitted_at` timestamp NULL DEFAULT NULL,
  `status` varchar(50) DEFAULT 'in_progress',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_categories`
--

CREATE TABLE `exam_categories` (
  `id` int NOT NULL,
  `category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `exam_categories`
--

INSERT INTO `exam_categories` (`id`, `category`) VALUES
(1, 'mock_exam'),
(2, 'real_exam');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fill_blank_answers`
--

CREATE TABLE `fill_blank_answers` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(5, 'default', '{\"uuid\":\"26f52530-a230-48f1-8a69-4ed8bab05a7c\",\"displayName\":\"App\\\\Mail\\\\UserCreatedMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":17:{s:8:\\\"mailable\\\";O:24:\\\"App\\\\Mail\\\\UserCreatedMail\\\":23:{s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:28:\\\"olaitanabidemi2007@gmail.com\\\";}}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:7:\\\"subject\\\";N;s:8:\\\"markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:7:\\\"\\u0000*\\u0000tags\\\";a:0:{}s:11:\\\"\\u0000*\\u0000metadata\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:5:\\\"theme\\\";N;s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";s:29:\\\"\\u0000*\\u0000assertionableRenderStrings\\\";N;s:4:\\\"user\\\";O:15:\\\"App\\\\Models\\\\User\\\":36:{s:13:\\\"\\u0000*\\u0000connection\\\";s:5:\\\"mysql\\\";s:8:\\\"\\u0000*\\u0000table\\\";s:5:\\\"users\\\";s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000keyType\\\";s:3:\\\"int\\\";s:12:\\\"incrementing\\\";b:1;s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:12:\\\"\\u0000*\\u0000withCount\\\";a:0:{}s:19:\\\"preventsLazyLoading\\\";b:0;s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:6:\\\"exists\\\";b:1;s:18:\\\"wasRecentlyCreated\\\";b:1;s:28:\\\"\\u0000*\\u0000escapeWhenCastingToString\\\";b:0;s:13:\\\"\\u0000*\\u0000attributes\\\";a:10:{s:4:\\\"name\\\";s:12:\\\"Student Nine\\\";s:5:\\\"email\\\";s:28:\\\"olaitanabidemi2007@gmail.com\\\";s:8:\\\"password\\\";s:60:\\\"$2y$12$qfN5nBD.mgCi6TRpDpyjTOTw0ctjC0oahR9bKJsoNPzYF\\/dKQ31eC\\\";s:5:\\\"phone\\\";s:11:\\\"08024541403\\\";s:4:\\\"role\\\";s:7:\\\"student\\\";s:9:\\\"exam_type\\\";s:7:\\\"GENERAL\\\";s:9:\\\"is_active\\\";b:0;s:10:\\\"updated_at\\\";s:19:\\\"2026-03-21 10:01:46\\\";s:10:\\\"created_at\\\";s:19:\\\"2026-03-21 10:01:46\\\";s:2:\\\"id\\\";i:26;}s:11:\\\"\\u0000*\\u0000original\\\";a:10:{s:4:\\\"name\\\";s:12:\\\"Student Nine\\\";s:5:\\\"email\\\";s:28:\\\"olaitanabidemi2007@gmail.com\\\";s:8:\\\"password\\\";s:60:\\\"$2y$12$qfN5nBD.mgCi6TRpDpyjTOTw0ctjC0oahR9bKJsoNPzYF\\/dKQ31eC\\\";s:5:\\\"phone\\\";s:11:\\\"08024541403\\\";s:4:\\\"role\\\";s:7:\\\"student\\\";s:9:\\\"exam_type\\\";s:7:\\\"GENERAL\\\";s:9:\\\"is_active\\\";b:0;s:10:\\\"updated_at\\\";s:19:\\\"2026-03-21 10:01:46\\\";s:10:\\\"created_at\\\";s:19:\\\"2026-03-21 10:01:46\\\";s:2:\\\"id\\\";i:26;}s:10:\\\"\\u0000*\\u0000changes\\\";a:0:{}s:11:\\\"\\u0000*\\u0000previous\\\";a:0:{}s:8:\\\"\\u0000*\\u0000casts\\\";a:3:{s:17:\\\"email_verified_at\\\";s:8:\\\"datetime\\\";s:8:\\\"password\\\";s:6:\\\"hashed\\\";s:9:\\\"is_active\\\";s:7:\\\"boolean\\\";}s:17:\\\"\\u0000*\\u0000classCastCache\\\";a:0:{}s:21:\\\"\\u0000*\\u0000attributeCastCache\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:19:\\\"\\u0000*\\u0000dispatchesEvents\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:12:\\\"\\u0000*\\u0000relations\\\";a:0:{}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:27:\\\"\\u0000*\\u0000relationAutoloadCallback\\\";N;s:26:\\\"\\u0000*\\u0000relationAutoloadContext\\\";N;s:10:\\\"timestamps\\\";b:1;s:13:\\\"usesUniqueIds\\\";b:0;s:9:\\\"\\u0000*\\u0000hidden\\\";a:2:{i:0;s:8:\\\"password\\\";i:1;s:14:\\\"remember_token\\\";}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:11:\\\"\\u0000*\\u0000fillable\\\";a:9:{i:0;s:4:\\\"name\\\";i:1;s:5:\\\"email\\\";i:2;s:8:\\\"password\\\";i:3;s:5:\\\"phone\\\";i:4;s:9:\\\"exam_type\\\";i:5;s:4:\\\"role\\\";i:6;s:7:\\\"address\\\";i:7;s:13:\\\"profile_photo\\\";i:8;s:9:\\\"is_active\\\";}s:10:\\\"\\u0000*\\u0000guarded\\\";a:1:{i:0;s:1:\\\"*\\\";}s:19:\\\"\\u0000*\\u0000authPasswordName\\\";s:8:\\\"password\\\";s:20:\\\"\\u0000*\\u0000rememberTokenName\\\";s:14:\\\"remember_token\\\";s:14:\\\"\\u0000*\\u0000accessToken\\\";N;}s:8:\\\"password\\\";s:8:\\\"nNEto0g3\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\",\"batchId\":null},\"createdAt\":1774087306,\"delay\":null}', 0, NULL, 1774087306, 1774087306),
(6, 'default', '{\"uuid\":\"10943081-be1d-4a31-8ea9-f31dbcabdd76\",\"displayName\":\"App\\\\Mail\\\\UserCreatedMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":17:{s:8:\\\"mailable\\\";O:24:\\\"App\\\\Mail\\\\UserCreatedMail\\\":23:{s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:28:\\\"olaitanabidemi2007@gmail.com\\\";}}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:7:\\\"subject\\\";N;s:8:\\\"markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:7:\\\"\\u0000*\\u0000tags\\\";a:0:{}s:11:\\\"\\u0000*\\u0000metadata\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:5:\\\"theme\\\";N;s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";s:29:\\\"\\u0000*\\u0000assertionableRenderStrings\\\";N;s:4:\\\"user\\\";O:15:\\\"App\\\\Models\\\\User\\\":36:{s:13:\\\"\\u0000*\\u0000connection\\\";s:5:\\\"mysql\\\";s:8:\\\"\\u0000*\\u0000table\\\";s:5:\\\"users\\\";s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000keyType\\\";s:3:\\\"int\\\";s:12:\\\"incrementing\\\";b:1;s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:12:\\\"\\u0000*\\u0000withCount\\\";a:0:{}s:19:\\\"preventsLazyLoading\\\";b:0;s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:6:\\\"exists\\\";b:1;s:18:\\\"wasRecentlyCreated\\\";b:1;s:28:\\\"\\u0000*\\u0000escapeWhenCastingToString\\\";b:0;s:13:\\\"\\u0000*\\u0000attributes\\\";a:10:{s:4:\\\"name\\\";s:11:\\\"Student Ten\\\";s:5:\\\"email\\\";s:28:\\\"olaitanabidemi2007@gmail.com\\\";s:8:\\\"password\\\";s:60:\\\"$2y$12$OwRlidnXZRGrWOkEglm1g.Dkh3lshabSMVgsMXBRcUupWHvKECvVW\\\";s:5:\\\"phone\\\";s:12:\\\"080245414231\\\";s:4:\\\"role\\\";s:7:\\\"student\\\";s:9:\\\"exam_type\\\";s:7:\\\"GENERAL\\\";s:9:\\\"is_active\\\";b:0;s:10:\\\"updated_at\\\";s:19:\\\"2026-03-21 10:11:32\\\";s:10:\\\"created_at\\\";s:19:\\\"2026-03-21 10:11:32\\\";s:2:\\\"id\\\";i:27;}s:11:\\\"\\u0000*\\u0000original\\\";a:10:{s:4:\\\"name\\\";s:11:\\\"Student Ten\\\";s:5:\\\"email\\\";s:28:\\\"olaitanabidemi2007@gmail.com\\\";s:8:\\\"password\\\";s:60:\\\"$2y$12$OwRlidnXZRGrWOkEglm1g.Dkh3lshabSMVgsMXBRcUupWHvKECvVW\\\";s:5:\\\"phone\\\";s:12:\\\"080245414231\\\";s:4:\\\"role\\\";s:7:\\\"student\\\";s:9:\\\"exam_type\\\";s:7:\\\"GENERAL\\\";s:9:\\\"is_active\\\";b:0;s:10:\\\"updated_at\\\";s:19:\\\"2026-03-21 10:11:32\\\";s:10:\\\"created_at\\\";s:19:\\\"2026-03-21 10:11:32\\\";s:2:\\\"id\\\";i:27;}s:10:\\\"\\u0000*\\u0000changes\\\";a:0:{}s:11:\\\"\\u0000*\\u0000previous\\\";a:0:{}s:8:\\\"\\u0000*\\u0000casts\\\";a:3:{s:17:\\\"email_verified_at\\\";s:8:\\\"datetime\\\";s:8:\\\"password\\\";s:6:\\\"hashed\\\";s:9:\\\"is_active\\\";s:7:\\\"boolean\\\";}s:17:\\\"\\u0000*\\u0000classCastCache\\\";a:0:{}s:21:\\\"\\u0000*\\u0000attributeCastCache\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:19:\\\"\\u0000*\\u0000dispatchesEvents\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:12:\\\"\\u0000*\\u0000relations\\\";a:0:{}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:27:\\\"\\u0000*\\u0000relationAutoloadCallback\\\";N;s:26:\\\"\\u0000*\\u0000relationAutoloadContext\\\";N;s:10:\\\"timestamps\\\";b:1;s:13:\\\"usesUniqueIds\\\";b:0;s:9:\\\"\\u0000*\\u0000hidden\\\";a:2:{i:0;s:8:\\\"password\\\";i:1;s:14:\\\"remember_token\\\";}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:11:\\\"\\u0000*\\u0000fillable\\\";a:9:{i:0;s:4:\\\"name\\\";i:1;s:5:\\\"email\\\";i:2;s:8:\\\"password\\\";i:3;s:5:\\\"phone\\\";i:4;s:9:\\\"exam_type\\\";i:5;s:4:\\\"role\\\";i:6;s:7:\\\"address\\\";i:7;s:13:\\\"profile_photo\\\";i:8;s:9:\\\"is_active\\\";}s:10:\\\"\\u0000*\\u0000guarded\\\";a:1:{i:0;s:1:\\\"*\\\";}s:19:\\\"\\u0000*\\u0000authPasswordName\\\";s:8:\\\"password\\\";s:20:\\\"\\u0000*\\u0000rememberTokenName\\\";s:14:\\\"remember_token\\\";s:14:\\\"\\u0000*\\u0000accessToken\\\";N;}s:8:\\\"password\\\";s:8:\\\"v4lqUBev\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\",\"batchId\":null},\"createdAt\":1774087892,\"delay\":null}', 0, NULL, 1774087892, 1774087892),
(7, 'default', '{\"uuid\":\"acd5a670-29db-4d4d-a268-a3404a4a320e\",\"displayName\":\"App\\\\Mail\\\\UserCreatedMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":17:{s:8:\\\"mailable\\\";O:24:\\\"App\\\\Mail\\\\UserCreatedMail\\\":23:{s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:28:\\\"olaitanabidemi2007@gmail.com\\\";}}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:7:\\\"subject\\\";N;s:8:\\\"markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:7:\\\"\\u0000*\\u0000tags\\\";a:0:{}s:11:\\\"\\u0000*\\u0000metadata\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:5:\\\"theme\\\";N;s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";s:29:\\\"\\u0000*\\u0000assertionableRenderStrings\\\";N;s:4:\\\"user\\\";O:15:\\\"App\\\\Models\\\\User\\\":36:{s:13:\\\"\\u0000*\\u0000connection\\\";s:5:\\\"mysql\\\";s:8:\\\"\\u0000*\\u0000table\\\";s:5:\\\"users\\\";s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000keyType\\\";s:3:\\\"int\\\";s:12:\\\"incrementing\\\";b:1;s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:12:\\\"\\u0000*\\u0000withCount\\\";a:0:{}s:19:\\\"preventsLazyLoading\\\";b:0;s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:6:\\\"exists\\\";b:1;s:18:\\\"wasRecentlyCreated\\\";b:1;s:28:\\\"\\u0000*\\u0000escapeWhenCastingToString\\\";b:0;s:13:\\\"\\u0000*\\u0000attributes\\\";a:10:{s:4:\\\"name\\\";s:13:\\\"Teacher Seven\\\";s:5:\\\"email\\\";s:28:\\\"olaitanabidemi2007@gmail.com\\\";s:8:\\\"password\\\";s:60:\\\"$2y$12$escxB.wNoKPWfnF6XynS3OamhPDSwSwNpaBMg8oPY.oUhuf3zksmm\\\";s:5:\\\"phone\\\";s:12:\\\"080245414231\\\";s:4:\\\"role\\\";s:7:\\\"teacher\\\";s:9:\\\"exam_type\\\";s:7:\\\"GENERAL\\\";s:9:\\\"is_active\\\";b:1;s:10:\\\"updated_at\\\";s:19:\\\"2026-03-21 10:15:08\\\";s:10:\\\"created_at\\\";s:19:\\\"2026-03-21 10:15:08\\\";s:2:\\\"id\\\";i:28;}s:11:\\\"\\u0000*\\u0000original\\\";a:10:{s:4:\\\"name\\\";s:13:\\\"Teacher Seven\\\";s:5:\\\"email\\\";s:28:\\\"olaitanabidemi2007@gmail.com\\\";s:8:\\\"password\\\";s:60:\\\"$2y$12$escxB.wNoKPWfnF6XynS3OamhPDSwSwNpaBMg8oPY.oUhuf3zksmm\\\";s:5:\\\"phone\\\";s:12:\\\"080245414231\\\";s:4:\\\"role\\\";s:7:\\\"teacher\\\";s:9:\\\"exam_type\\\";s:7:\\\"GENERAL\\\";s:9:\\\"is_active\\\";b:1;s:10:\\\"updated_at\\\";s:19:\\\"2026-03-21 10:15:08\\\";s:10:\\\"created_at\\\";s:19:\\\"2026-03-21 10:15:08\\\";s:2:\\\"id\\\";i:28;}s:10:\\\"\\u0000*\\u0000changes\\\";a:0:{}s:11:\\\"\\u0000*\\u0000previous\\\";a:0:{}s:8:\\\"\\u0000*\\u0000casts\\\";a:3:{s:17:\\\"email_verified_at\\\";s:8:\\\"datetime\\\";s:8:\\\"password\\\";s:6:\\\"hashed\\\";s:9:\\\"is_active\\\";s:7:\\\"boolean\\\";}s:17:\\\"\\u0000*\\u0000classCastCache\\\";a:0:{}s:21:\\\"\\u0000*\\u0000attributeCastCache\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:19:\\\"\\u0000*\\u0000dispatchesEvents\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:12:\\\"\\u0000*\\u0000relations\\\";a:0:{}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:27:\\\"\\u0000*\\u0000relationAutoloadCallback\\\";N;s:26:\\\"\\u0000*\\u0000relationAutoloadContext\\\";N;s:10:\\\"timestamps\\\";b:1;s:13:\\\"usesUniqueIds\\\";b:0;s:9:\\\"\\u0000*\\u0000hidden\\\";a:2:{i:0;s:8:\\\"password\\\";i:1;s:14:\\\"remember_token\\\";}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:11:\\\"\\u0000*\\u0000fillable\\\";a:9:{i:0;s:4:\\\"name\\\";i:1;s:5:\\\"email\\\";i:2;s:8:\\\"password\\\";i:3;s:5:\\\"phone\\\";i:4;s:9:\\\"exam_type\\\";i:5;s:4:\\\"role\\\";i:6;s:7:\\\"address\\\";i:7;s:13:\\\"profile_photo\\\";i:8;s:9:\\\"is_active\\\";}s:10:\\\"\\u0000*\\u0000guarded\\\";a:1:{i:0;s:1:\\\"*\\\";}s:19:\\\"\\u0000*\\u0000authPasswordName\\\";s:8:\\\"password\\\";s:20:\\\"\\u0000*\\u0000rememberTokenName\\\";s:14:\\\"remember_token\\\";s:14:\\\"\\u0000*\\u0000accessToken\\\";N;}s:8:\\\"password\\\";s:8:\\\"aDoHK8op\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\",\"batchId\":null},\"createdAt\":1774088108,\"delay\":null}', 0, NULL, 1774088108, 1774088108),
(8, 'default', '{\"uuid\":\"0bb981ba-6411-4502-9ca3-09d228d1fe76\",\"displayName\":\"App\\\\Mail\\\\UserCreatedMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":17:{s:8:\\\"mailable\\\";O:24:\\\"App\\\\Mail\\\\UserCreatedMail\\\":23:{s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:30:\\\"olaitan.okunloro@etexgroup.com\\\";}}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:7:\\\"subject\\\";N;s:8:\\\"markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:7:\\\"\\u0000*\\u0000tags\\\";a:0:{}s:11:\\\"\\u0000*\\u0000metadata\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:5:\\\"theme\\\";N;s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";s:29:\\\"\\u0000*\\u0000assertionableRenderStrings\\\";N;s:4:\\\"user\\\";O:15:\\\"App\\\\Models\\\\User\\\":36:{s:13:\\\"\\u0000*\\u0000connection\\\";s:5:\\\"mysql\\\";s:8:\\\"\\u0000*\\u0000table\\\";s:5:\\\"users\\\";s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000keyType\\\";s:3:\\\"int\\\";s:12:\\\"incrementing\\\";b:1;s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:12:\\\"\\u0000*\\u0000withCount\\\";a:0:{}s:19:\\\"preventsLazyLoading\\\";b:0;s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:6:\\\"exists\\\";b:1;s:18:\\\"wasRecentlyCreated\\\";b:1;s:28:\\\"\\u0000*\\u0000escapeWhenCastingToString\\\";b:0;s:13:\\\"\\u0000*\\u0000attributes\\\";a:10:{s:4:\\\"name\\\";s:14:\\\"Student Eleven\\\";s:5:\\\"email\\\";s:30:\\\"olaitan.okunloro@etexgroup.com\\\";s:8:\\\"password\\\";s:60:\\\"$2y$12$hejf3TDcxlvLrYOoxfoBwOhPaux.ILDrvG3r0kPTQMqTBRbmPxiOq\\\";s:5:\\\"phone\\\";s:11:\\\"08024541933\\\";s:4:\\\"role\\\";s:7:\\\"student\\\";s:9:\\\"exam_type\\\";s:7:\\\"GENERAL\\\";s:9:\\\"is_active\\\";b:0;s:10:\\\"updated_at\\\";s:19:\\\"2026-03-21 10:23:36\\\";s:10:\\\"created_at\\\";s:19:\\\"2026-03-21 10:23:36\\\";s:2:\\\"id\\\";i:29;}s:11:\\\"\\u0000*\\u0000original\\\";a:10:{s:4:\\\"name\\\";s:14:\\\"Student Eleven\\\";s:5:\\\"email\\\";s:30:\\\"olaitan.okunloro@etexgroup.com\\\";s:8:\\\"password\\\";s:60:\\\"$2y$12$hejf3TDcxlvLrYOoxfoBwOhPaux.ILDrvG3r0kPTQMqTBRbmPxiOq\\\";s:5:\\\"phone\\\";s:11:\\\"08024541933\\\";s:4:\\\"role\\\";s:7:\\\"student\\\";s:9:\\\"exam_type\\\";s:7:\\\"GENERAL\\\";s:9:\\\"is_active\\\";b:0;s:10:\\\"updated_at\\\";s:19:\\\"2026-03-21 10:23:36\\\";s:10:\\\"created_at\\\";s:19:\\\"2026-03-21 10:23:36\\\";s:2:\\\"id\\\";i:29;}s:10:\\\"\\u0000*\\u0000changes\\\";a:0:{}s:11:\\\"\\u0000*\\u0000previous\\\";a:0:{}s:8:\\\"\\u0000*\\u0000casts\\\";a:3:{s:17:\\\"email_verified_at\\\";s:8:\\\"datetime\\\";s:8:\\\"password\\\";s:6:\\\"hashed\\\";s:9:\\\"is_active\\\";s:7:\\\"boolean\\\";}s:17:\\\"\\u0000*\\u0000classCastCache\\\";a:0:{}s:21:\\\"\\u0000*\\u0000attributeCastCache\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:19:\\\"\\u0000*\\u0000dispatchesEvents\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:12:\\\"\\u0000*\\u0000relations\\\";a:0:{}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:27:\\\"\\u0000*\\u0000relationAutoloadCallback\\\";N;s:26:\\\"\\u0000*\\u0000relationAutoloadContext\\\";N;s:10:\\\"timestamps\\\";b:1;s:13:\\\"usesUniqueIds\\\";b:0;s:9:\\\"\\u0000*\\u0000hidden\\\";a:2:{i:0;s:8:\\\"password\\\";i:1;s:14:\\\"remember_token\\\";}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:11:\\\"\\u0000*\\u0000fillable\\\";a:9:{i:0;s:4:\\\"name\\\";i:1;s:5:\\\"email\\\";i:2;s:8:\\\"password\\\";i:3;s:5:\\\"phone\\\";i:4;s:9:\\\"exam_type\\\";i:5;s:4:\\\"role\\\";i:6;s:7:\\\"address\\\";i:7;s:13:\\\"profile_photo\\\";i:8;s:9:\\\"is_active\\\";}s:10:\\\"\\u0000*\\u0000guarded\\\";a:1:{i:0;s:1:\\\"*\\\";}s:19:\\\"\\u0000*\\u0000authPasswordName\\\";s:8:\\\"password\\\";s:20:\\\"\\u0000*\\u0000rememberTokenName\\\";s:14:\\\"remember_token\\\";s:14:\\\"\\u0000*\\u0000accessToken\\\";N;}s:8:\\\"password\\\";s:8:\\\"4BWhaC35\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\",\"batchId\":null},\"createdAt\":1774088616,\"delay\":null}', 0, NULL, 1774088616, 1774088616),
(9, 'default', '{\"uuid\":\"9e6c0ff1-3d22-4cd6-8c9e-58ef4479ee91\",\"displayName\":\"App\\\\Mail\\\\UserCreatedMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":17:{s:8:\\\"mailable\\\";O:24:\\\"App\\\\Mail\\\\UserCreatedMail\\\":23:{s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:28:\\\"olaitanabidemi2007@gmail.com\\\";}}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:7:\\\"subject\\\";N;s:8:\\\"markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:7:\\\"\\u0000*\\u0000tags\\\";a:0:{}s:11:\\\"\\u0000*\\u0000metadata\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:5:\\\"theme\\\";N;s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";s:29:\\\"\\u0000*\\u0000assertionableRenderStrings\\\";N;s:4:\\\"user\\\";O:15:\\\"App\\\\Models\\\\User\\\":36:{s:13:\\\"\\u0000*\\u0000connection\\\";s:5:\\\"mysql\\\";s:8:\\\"\\u0000*\\u0000table\\\";s:5:\\\"users\\\";s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000keyType\\\";s:3:\\\"int\\\";s:12:\\\"incrementing\\\";b:1;s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:12:\\\"\\u0000*\\u0000withCount\\\";a:0:{}s:19:\\\"preventsLazyLoading\\\";b:0;s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:6:\\\"exists\\\";b:1;s:18:\\\"wasRecentlyCreated\\\";b:1;s:28:\\\"\\u0000*\\u0000escapeWhenCastingToString\\\";b:0;s:13:\\\"\\u0000*\\u0000attributes\\\";a:10:{s:4:\\\"name\\\";s:14:\\\"Student Twelve\\\";s:5:\\\"email\\\";s:28:\\\"olaitanabidemi2007@gmail.com\\\";s:8:\\\"password\\\";s:60:\\\"$2y$12$sfclLAqBYR\\/HdDGsM1ap2eziPBwt.bf0PZgai0MdOYnodQB2wMHBe\\\";s:5:\\\"phone\\\";s:11:\\\"08024541452\\\";s:4:\\\"role\\\";s:7:\\\"student\\\";s:9:\\\"exam_type\\\";s:7:\\\"GENERAL\\\";s:9:\\\"is_active\\\";b:0;s:10:\\\"updated_at\\\";s:19:\\\"2026-03-21 10:32:11\\\";s:10:\\\"created_at\\\";s:19:\\\"2026-03-21 10:32:11\\\";s:2:\\\"id\\\";i:30;}s:11:\\\"\\u0000*\\u0000original\\\";a:10:{s:4:\\\"name\\\";s:14:\\\"Student Twelve\\\";s:5:\\\"email\\\";s:28:\\\"olaitanabidemi2007@gmail.com\\\";s:8:\\\"password\\\";s:60:\\\"$2y$12$sfclLAqBYR\\/HdDGsM1ap2eziPBwt.bf0PZgai0MdOYnodQB2wMHBe\\\";s:5:\\\"phone\\\";s:11:\\\"08024541452\\\";s:4:\\\"role\\\";s:7:\\\"student\\\";s:9:\\\"exam_type\\\";s:7:\\\"GENERAL\\\";s:9:\\\"is_active\\\";b:0;s:10:\\\"updated_at\\\";s:19:\\\"2026-03-21 10:32:11\\\";s:10:\\\"created_at\\\";s:19:\\\"2026-03-21 10:32:11\\\";s:2:\\\"id\\\";i:30;}s:10:\\\"\\u0000*\\u0000changes\\\";a:0:{}s:11:\\\"\\u0000*\\u0000previous\\\";a:0:{}s:8:\\\"\\u0000*\\u0000casts\\\";a:3:{s:17:\\\"email_verified_at\\\";s:8:\\\"datetime\\\";s:8:\\\"password\\\";s:6:\\\"hashed\\\";s:9:\\\"is_active\\\";s:7:\\\"boolean\\\";}s:17:\\\"\\u0000*\\u0000classCastCache\\\";a:0:{}s:21:\\\"\\u0000*\\u0000attributeCastCache\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:19:\\\"\\u0000*\\u0000dispatchesEvents\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:12:\\\"\\u0000*\\u0000relations\\\";a:0:{}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:27:\\\"\\u0000*\\u0000relationAutoloadCallback\\\";N;s:26:\\\"\\u0000*\\u0000relationAutoloadContext\\\";N;s:10:\\\"timestamps\\\";b:1;s:13:\\\"usesUniqueIds\\\";b:0;s:9:\\\"\\u0000*\\u0000hidden\\\";a:2:{i:0;s:8:\\\"password\\\";i:1;s:14:\\\"remember_token\\\";}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:11:\\\"\\u0000*\\u0000fillable\\\";a:9:{i:0;s:4:\\\"name\\\";i:1;s:5:\\\"email\\\";i:2;s:8:\\\"password\\\";i:3;s:5:\\\"phone\\\";i:4;s:9:\\\"exam_type\\\";i:5;s:4:\\\"role\\\";i:6;s:7:\\\"address\\\";i:7;s:13:\\\"profile_photo\\\";i:8;s:9:\\\"is_active\\\";}s:10:\\\"\\u0000*\\u0000guarded\\\";a:1:{i:0;s:1:\\\"*\\\";}s:19:\\\"\\u0000*\\u0000authPasswordName\\\";s:8:\\\"password\\\";s:20:\\\"\\u0000*\\u0000rememberTokenName\\\";s:14:\\\"remember_token\\\";s:14:\\\"\\u0000*\\u0000accessToken\\\";N;}s:8:\\\"password\\\";s:11:\\\"password123\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\",\"batchId\":null},\"createdAt\":1774089131,\"delay\":null}', 0, NULL, 1774089131, 1774089131),
(10, 'default', '{\"uuid\":\"4211a093-c539-4290-90f5-6eb3e00035fd\",\"displayName\":\"App\\\\Mail\\\\UserCreatedMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":17:{s:8:\\\"mailable\\\";O:24:\\\"App\\\\Mail\\\\UserCreatedMail\\\":23:{s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:28:\\\"olaitanabidemi2007@gmail.com\\\";}}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:7:\\\"subject\\\";N;s:8:\\\"markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:7:\\\"\\u0000*\\u0000tags\\\";a:0:{}s:11:\\\"\\u0000*\\u0000metadata\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:5:\\\"theme\\\";N;s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";s:29:\\\"\\u0000*\\u0000assertionableRenderStrings\\\";N;s:4:\\\"user\\\";O:15:\\\"App\\\\Models\\\\User\\\":36:{s:13:\\\"\\u0000*\\u0000connection\\\";s:5:\\\"mysql\\\";s:8:\\\"\\u0000*\\u0000table\\\";s:5:\\\"users\\\";s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000keyType\\\";s:3:\\\"int\\\";s:12:\\\"incrementing\\\";b:1;s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:12:\\\"\\u0000*\\u0000withCount\\\";a:0:{}s:19:\\\"preventsLazyLoading\\\";b:0;s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:6:\\\"exists\\\";b:1;s:18:\\\"wasRecentlyCreated\\\";b:1;s:28:\\\"\\u0000*\\u0000escapeWhenCastingToString\\\";b:0;s:13:\\\"\\u0000*\\u0000attributes\\\";a:10:{s:4:\\\"name\\\";s:16:\\\"Student Thirteen\\\";s:5:\\\"email\\\";s:28:\\\"olaitanabidemi2007@gmail.com\\\";s:8:\\\"password\\\";s:60:\\\"$2y$12$13w4wUeti9ldq1bXnTcDgeLiWjWvAJ5TLgR8NMCv0v8xzn\\/\\/IIQWW\\\";s:5:\\\"phone\\\";s:11:\\\"08024541411\\\";s:4:\\\"role\\\";s:7:\\\"student\\\";s:9:\\\"exam_type\\\";s:7:\\\"GENERAL\\\";s:9:\\\"is_active\\\";b:0;s:10:\\\"updated_at\\\";s:19:\\\"2026-03-21 18:41:05\\\";s:10:\\\"created_at\\\";s:19:\\\"2026-03-21 18:41:05\\\";s:2:\\\"id\\\";i:33;}s:11:\\\"\\u0000*\\u0000original\\\";a:10:{s:4:\\\"name\\\";s:16:\\\"Student Thirteen\\\";s:5:\\\"email\\\";s:28:\\\"olaitanabidemi2007@gmail.com\\\";s:8:\\\"password\\\";s:60:\\\"$2y$12$13w4wUeti9ldq1bXnTcDgeLiWjWvAJ5TLgR8NMCv0v8xzn\\/\\/IIQWW\\\";s:5:\\\"phone\\\";s:11:\\\"08024541411\\\";s:4:\\\"role\\\";s:7:\\\"student\\\";s:9:\\\"exam_type\\\";s:7:\\\"GENERAL\\\";s:9:\\\"is_active\\\";b:0;s:10:\\\"updated_at\\\";s:19:\\\"2026-03-21 18:41:05\\\";s:10:\\\"created_at\\\";s:19:\\\"2026-03-21 18:41:05\\\";s:2:\\\"id\\\";i:33;}s:10:\\\"\\u0000*\\u0000changes\\\";a:0:{}s:11:\\\"\\u0000*\\u0000previous\\\";a:0:{}s:8:\\\"\\u0000*\\u0000casts\\\";a:3:{s:17:\\\"email_verified_at\\\";s:8:\\\"datetime\\\";s:8:\\\"password\\\";s:6:\\\"hashed\\\";s:9:\\\"is_active\\\";s:7:\\\"boolean\\\";}s:17:\\\"\\u0000*\\u0000classCastCache\\\";a:0:{}s:21:\\\"\\u0000*\\u0000attributeCastCache\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:19:\\\"\\u0000*\\u0000dispatchesEvents\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:12:\\\"\\u0000*\\u0000relations\\\";a:0:{}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:27:\\\"\\u0000*\\u0000relationAutoloadCallback\\\";N;s:26:\\\"\\u0000*\\u0000relationAutoloadContext\\\";N;s:10:\\\"timestamps\\\";b:1;s:13:\\\"usesUniqueIds\\\";b:0;s:9:\\\"\\u0000*\\u0000hidden\\\";a:2:{i:0;s:8:\\\"password\\\";i:1;s:14:\\\"remember_token\\\";}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:11:\\\"\\u0000*\\u0000fillable\\\";a:9:{i:0;s:4:\\\"name\\\";i:1;s:5:\\\"email\\\";i:2;s:8:\\\"password\\\";i:3;s:5:\\\"phone\\\";i:4;s:9:\\\"exam_type\\\";i:5;s:4:\\\"role\\\";i:6;s:7:\\\"address\\\";i:7;s:13:\\\"profile_photo\\\";i:8;s:9:\\\"is_active\\\";}s:10:\\\"\\u0000*\\u0000guarded\\\";a:1:{i:0;s:1:\\\"*\\\";}s:19:\\\"\\u0000*\\u0000authPasswordName\\\";s:8:\\\"password\\\";s:20:\\\"\\u0000*\\u0000rememberTokenName\\\";s:14:\\\"remember_token\\\";s:14:\\\"\\u0000*\\u0000accessToken\\\";N;}s:8:\\\"password\\\";s:11:\\\"password123\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\",\"batchId\":null},\"createdAt\":1774118468,\"delay\":null}', 0, NULL, 1774118468, 1774118468),
(11, 'default', '{\"uuid\":\"5fd5c653-9d70-438b-9cde-6f22bd83edf1\",\"displayName\":\"App\\\\Mail\\\\UserCreatedMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":17:{s:8:\\\"mailable\\\";O:24:\\\"App\\\\Mail\\\\UserCreatedMail\\\":23:{s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:30:\\\"olaitan.okunloro@etexgroup.com\\\";}}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:7:\\\"subject\\\";N;s:8:\\\"markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:7:\\\"\\u0000*\\u0000tags\\\";a:0:{}s:11:\\\"\\u0000*\\u0000metadata\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:5:\\\"theme\\\";N;s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";s:29:\\\"\\u0000*\\u0000assertionableRenderStrings\\\";N;s:4:\\\"user\\\";O:15:\\\"App\\\\Models\\\\User\\\":36:{s:13:\\\"\\u0000*\\u0000connection\\\";s:5:\\\"mysql\\\";s:8:\\\"\\u0000*\\u0000table\\\";s:5:\\\"users\\\";s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000keyType\\\";s:3:\\\"int\\\";s:12:\\\"incrementing\\\";b:1;s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:12:\\\"\\u0000*\\u0000withCount\\\";a:0:{}s:19:\\\"preventsLazyLoading\\\";b:0;s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:6:\\\"exists\\\";b:1;s:18:\\\"wasRecentlyCreated\\\";b:1;s:28:\\\"\\u0000*\\u0000escapeWhenCastingToString\\\";b:0;s:13:\\\"\\u0000*\\u0000attributes\\\";a:10:{s:4:\\\"name\\\";s:16:\\\"Ajibola Okunloro\\\";s:5:\\\"email\\\";s:30:\\\"olaitan.okunloro@etexgroup.com\\\";s:8:\\\"password\\\";s:60:\\\"$2y$12$9pHMcZzeBCwRSxPGp5xYneMPFBvppH277KPQLLwslnYeb6YVrej.m\\\";s:5:\\\"phone\\\";i:9133221567;s:4:\\\"role\\\";s:7:\\\"student\\\";s:9:\\\"exam_type\\\";s:7:\\\"GENERAL\\\";s:9:\\\"is_active\\\";b:1;s:10:\\\"updated_at\\\";s:19:\\\"2026-03-21 20:10:15\\\";s:10:\\\"created_at\\\";s:19:\\\"2026-03-21 20:10:15\\\";s:2:\\\"id\\\";i:34;}s:11:\\\"\\u0000*\\u0000original\\\";a:10:{s:4:\\\"name\\\";s:16:\\\"Ajibola Okunloro\\\";s:5:\\\"email\\\";s:30:\\\"olaitan.okunloro@etexgroup.com\\\";s:8:\\\"password\\\";s:60:\\\"$2y$12$9pHMcZzeBCwRSxPGp5xYneMPFBvppH277KPQLLwslnYeb6YVrej.m\\\";s:5:\\\"phone\\\";i:9133221567;s:4:\\\"role\\\";s:7:\\\"student\\\";s:9:\\\"exam_type\\\";s:7:\\\"GENERAL\\\";s:9:\\\"is_active\\\";b:1;s:10:\\\"updated_at\\\";s:19:\\\"2026-03-21 20:10:15\\\";s:10:\\\"created_at\\\";s:19:\\\"2026-03-21 20:10:15\\\";s:2:\\\"id\\\";i:34;}s:10:\\\"\\u0000*\\u0000changes\\\";a:0:{}s:11:\\\"\\u0000*\\u0000previous\\\";a:0:{}s:8:\\\"\\u0000*\\u0000casts\\\";a:3:{s:17:\\\"email_verified_at\\\";s:8:\\\"datetime\\\";s:8:\\\"password\\\";s:6:\\\"hashed\\\";s:9:\\\"is_active\\\";s:7:\\\"boolean\\\";}s:17:\\\"\\u0000*\\u0000classCastCache\\\";a:0:{}s:21:\\\"\\u0000*\\u0000attributeCastCache\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:19:\\\"\\u0000*\\u0000dispatchesEvents\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:12:\\\"\\u0000*\\u0000relations\\\";a:0:{}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:27:\\\"\\u0000*\\u0000relationAutoloadCallback\\\";N;s:26:\\\"\\u0000*\\u0000relationAutoloadContext\\\";N;s:10:\\\"timestamps\\\";b:1;s:13:\\\"usesUniqueIds\\\";b:0;s:9:\\\"\\u0000*\\u0000hidden\\\";a:2:{i:0;s:8:\\\"password\\\";i:1;s:14:\\\"remember_token\\\";}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:11:\\\"\\u0000*\\u0000fillable\\\";a:9:{i:0;s:4:\\\"name\\\";i:1;s:5:\\\"email\\\";i:2;s:8:\\\"password\\\";i:3;s:5:\\\"phone\\\";i:4;s:9:\\\"exam_type\\\";i:5;s:4:\\\"role\\\";i:6;s:7:\\\"address\\\";i:7;s:13:\\\"profile_photo\\\";i:8;s:9:\\\"is_active\\\";}s:10:\\\"\\u0000*\\u0000guarded\\\";a:1:{i:0;s:1:\\\"*\\\";}s:19:\\\"\\u0000*\\u0000authPasswordName\\\";s:8:\\\"password\\\";s:20:\\\"\\u0000*\\u0000rememberTokenName\\\";s:14:\\\"remember_token\\\";s:14:\\\"\\u0000*\\u0000accessToken\\\";N;}s:8:\\\"password\\\";s:8:\\\"8Nl4sUpD\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\",\"batchId\":null},\"createdAt\":1774123817,\"delay\":null}', 0, NULL, 1774123817, 1774123817),
(12, 'default', '{\"uuid\":\"4e14dd6c-94a9-4bdf-961e-cc96a32f6267\",\"displayName\":\"App\\\\Mail\\\\UserCreatedMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":17:{s:8:\\\"mailable\\\";O:24:\\\"App\\\\Mail\\\\UserCreatedMail\\\":23:{s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:28:\\\"olaitanabidemi2007@gmail.com\\\";}}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:7:\\\"subject\\\";N;s:8:\\\"markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:7:\\\"\\u0000*\\u0000tags\\\";a:0:{}s:11:\\\"\\u0000*\\u0000metadata\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:5:\\\"theme\\\";N;s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";s:29:\\\"\\u0000*\\u0000assertionableRenderStrings\\\";N;s:4:\\\"user\\\";O:15:\\\"App\\\\Models\\\\User\\\":36:{s:13:\\\"\\u0000*\\u0000connection\\\";s:5:\\\"mysql\\\";s:8:\\\"\\u0000*\\u0000table\\\";s:5:\\\"users\\\";s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000keyType\\\";s:3:\\\"int\\\";s:12:\\\"incrementing\\\";b:1;s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:12:\\\"\\u0000*\\u0000withCount\\\";a:0:{}s:19:\\\"preventsLazyLoading\\\";b:0;s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:6:\\\"exists\\\";b:1;s:18:\\\"wasRecentlyCreated\\\";b:1;s:28:\\\"\\u0000*\\u0000escapeWhenCastingToString\\\";b:0;s:13:\\\"\\u0000*\\u0000attributes\\\";a:10:{s:4:\\\"name\\\";s:13:\\\"Olusols Abefe\\\";s:5:\\\"email\\\";s:28:\\\"olaitanabidemi2007@gmail.com\\\";s:8:\\\"password\\\";s:60:\\\"$2y$12$\\/9rBRCMtWfUZSKrRxIiSUOiRwkoL9x2YEuWICDDkeTKoVTZDC0Qu6\\\";s:5:\\\"phone\\\";i:8056444321;s:4:\\\"role\\\";s:7:\\\"student\\\";s:9:\\\"exam_type\\\";s:7:\\\"GENERAL\\\";s:9:\\\"is_active\\\";b:1;s:10:\\\"updated_at\\\";s:19:\\\"2026-03-21 20:10:18\\\";s:10:\\\"created_at\\\";s:19:\\\"2026-03-21 20:10:18\\\";s:2:\\\"id\\\";i:35;}s:11:\\\"\\u0000*\\u0000original\\\";a:10:{s:4:\\\"name\\\";s:13:\\\"Olusols Abefe\\\";s:5:\\\"email\\\";s:28:\\\"olaitanabidemi2007@gmail.com\\\";s:8:\\\"password\\\";s:60:\\\"$2y$12$\\/9rBRCMtWfUZSKrRxIiSUOiRwkoL9x2YEuWICDDkeTKoVTZDC0Qu6\\\";s:5:\\\"phone\\\";i:8056444321;s:4:\\\"role\\\";s:7:\\\"student\\\";s:9:\\\"exam_type\\\";s:7:\\\"GENERAL\\\";s:9:\\\"is_active\\\";b:1;s:10:\\\"updated_at\\\";s:19:\\\"2026-03-21 20:10:18\\\";s:10:\\\"created_at\\\";s:19:\\\"2026-03-21 20:10:18\\\";s:2:\\\"id\\\";i:35;}s:10:\\\"\\u0000*\\u0000changes\\\";a:0:{}s:11:\\\"\\u0000*\\u0000previous\\\";a:0:{}s:8:\\\"\\u0000*\\u0000casts\\\";a:3:{s:17:\\\"email_verified_at\\\";s:8:\\\"datetime\\\";s:8:\\\"password\\\";s:6:\\\"hashed\\\";s:9:\\\"is_active\\\";s:7:\\\"boolean\\\";}s:17:\\\"\\u0000*\\u0000classCastCache\\\";a:0:{}s:21:\\\"\\u0000*\\u0000attributeCastCache\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:19:\\\"\\u0000*\\u0000dispatchesEvents\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:12:\\\"\\u0000*\\u0000relations\\\";a:0:{}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:27:\\\"\\u0000*\\u0000relationAutoloadCallback\\\";N;s:26:\\\"\\u0000*\\u0000relationAutoloadContext\\\";N;s:10:\\\"timestamps\\\";b:1;s:13:\\\"usesUniqueIds\\\";b:0;s:9:\\\"\\u0000*\\u0000hidden\\\";a:2:{i:0;s:8:\\\"password\\\";i:1;s:14:\\\"remember_token\\\";}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:11:\\\"\\u0000*\\u0000fillable\\\";a:9:{i:0;s:4:\\\"name\\\";i:1;s:5:\\\"email\\\";i:2;s:8:\\\"password\\\";i:3;s:5:\\\"phone\\\";i:4;s:9:\\\"exam_type\\\";i:5;s:4:\\\"role\\\";i:6;s:7:\\\"address\\\";i:7;s:13:\\\"profile_photo\\\";i:8;s:9:\\\"is_active\\\";}s:10:\\\"\\u0000*\\u0000guarded\\\";a:1:{i:0;s:1:\\\"*\\\";}s:19:\\\"\\u0000*\\u0000authPasswordName\\\";s:8:\\\"password\\\";s:20:\\\"\\u0000*\\u0000rememberTokenName\\\";s:14:\\\"remember_token\\\";s:14:\\\"\\u0000*\\u0000accessToken\\\";N;}s:8:\\\"password\\\";s:8:\\\"mmwH2Tl8\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\",\"batchId\":null},\"createdAt\":1774123818,\"delay\":null}', 0, NULL, 1774123818, 1774123818),
(13, 'default', '{\"uuid\":\"238eb1cb-441c-4625-ae99-0a74f37c851c\",\"displayName\":\"App\\\\Mail\\\\UserCreatedMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":17:{s:8:\\\"mailable\\\";O:24:\\\"App\\\\Mail\\\\UserCreatedMail\\\":23:{s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:30:\\\"olaitan.okunloro@etexgroup.com\\\";}}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:7:\\\"subject\\\";N;s:8:\\\"markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:7:\\\"\\u0000*\\u0000tags\\\";a:0:{}s:11:\\\"\\u0000*\\u0000metadata\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:5:\\\"theme\\\";N;s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";s:29:\\\"\\u0000*\\u0000assertionableRenderStrings\\\";N;s:4:\\\"user\\\";O:15:\\\"App\\\\Models\\\\User\\\":36:{s:13:\\\"\\u0000*\\u0000connection\\\";s:5:\\\"mysql\\\";s:8:\\\"\\u0000*\\u0000table\\\";s:5:\\\"users\\\";s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000keyType\\\";s:3:\\\"int\\\";s:12:\\\"incrementing\\\";b:1;s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:12:\\\"\\u0000*\\u0000withCount\\\";a:0:{}s:19:\\\"preventsLazyLoading\\\";b:0;s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:6:\\\"exists\\\";b:1;s:18:\\\"wasRecentlyCreated\\\";b:1;s:28:\\\"\\u0000*\\u0000escapeWhenCastingToString\\\";b:0;s:13:\\\"\\u0000*\\u0000attributes\\\";a:10:{s:4:\\\"name\\\";s:16:\\\"Ajibola Okunloro\\\";s:5:\\\"email\\\";s:30:\\\"olaitan.okunloro@etexgroup.com\\\";s:8:\\\"password\\\";s:60:\\\"$2y$12$Gs0i9iGKNYHlgez.6vGLZexd7eTgpSjIh1LZ\\/NBA.sL1eMlmWleky\\\";s:5:\\\"phone\\\";i:9133221567;s:4:\\\"role\\\";s:7:\\\"student\\\";s:9:\\\"exam_type\\\";s:7:\\\"GENERAL\\\";s:9:\\\"is_active\\\";b:1;s:10:\\\"updated_at\\\";s:19:\\\"2026-03-22 07:39:29\\\";s:10:\\\"created_at\\\";s:19:\\\"2026-03-22 07:39:29\\\";s:2:\\\"id\\\";i:38;}s:11:\\\"\\u0000*\\u0000original\\\";a:10:{s:4:\\\"name\\\";s:16:\\\"Ajibola Okunloro\\\";s:5:\\\"email\\\";s:30:\\\"olaitan.okunloro@etexgroup.com\\\";s:8:\\\"password\\\";s:60:\\\"$2y$12$Gs0i9iGKNYHlgez.6vGLZexd7eTgpSjIh1LZ\\/NBA.sL1eMlmWleky\\\";s:5:\\\"phone\\\";i:9133221567;s:4:\\\"role\\\";s:7:\\\"student\\\";s:9:\\\"exam_type\\\";s:7:\\\"GENERAL\\\";s:9:\\\"is_active\\\";b:1;s:10:\\\"updated_at\\\";s:19:\\\"2026-03-22 07:39:29\\\";s:10:\\\"created_at\\\";s:19:\\\"2026-03-22 07:39:29\\\";s:2:\\\"id\\\";i:38;}s:10:\\\"\\u0000*\\u0000changes\\\";a:0:{}s:11:\\\"\\u0000*\\u0000previous\\\";a:0:{}s:8:\\\"\\u0000*\\u0000casts\\\";a:3:{s:17:\\\"email_verified_at\\\";s:8:\\\"datetime\\\";s:8:\\\"password\\\";s:6:\\\"hashed\\\";s:9:\\\"is_active\\\";s:7:\\\"boolean\\\";}s:17:\\\"\\u0000*\\u0000classCastCache\\\";a:0:{}s:21:\\\"\\u0000*\\u0000attributeCastCache\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:19:\\\"\\u0000*\\u0000dispatchesEvents\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:12:\\\"\\u0000*\\u0000relations\\\";a:0:{}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:27:\\\"\\u0000*\\u0000relationAutoloadCallback\\\";N;s:26:\\\"\\u0000*\\u0000relationAutoloadContext\\\";N;s:10:\\\"timestamps\\\";b:1;s:13:\\\"usesUniqueIds\\\";b:0;s:9:\\\"\\u0000*\\u0000hidden\\\";a:2:{i:0;s:8:\\\"password\\\";i:1;s:14:\\\"remember_token\\\";}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:11:\\\"\\u0000*\\u0000fillable\\\";a:9:{i:0;s:4:\\\"name\\\";i:1;s:5:\\\"email\\\";i:2;s:8:\\\"password\\\";i:3;s:5:\\\"phone\\\";i:4;s:9:\\\"exam_type\\\";i:5;s:4:\\\"role\\\";i:6;s:7:\\\"address\\\";i:7;s:13:\\\"profile_photo\\\";i:8;s:9:\\\"is_active\\\";}s:10:\\\"\\u0000*\\u0000guarded\\\";a:1:{i:0;s:1:\\\"*\\\";}s:19:\\\"\\u0000*\\u0000authPasswordName\\\";s:8:\\\"password\\\";s:20:\\\"\\u0000*\\u0000rememberTokenName\\\";s:14:\\\"remember_token\\\";s:14:\\\"\\u0000*\\u0000accessToken\\\";N;}s:8:\\\"password\\\";s:8:\\\"0Yf5YS8y\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\",\"batchId\":null},\"createdAt\":1774165172,\"delay\":null}', 0, NULL, 1774165173, 1774165173),
(14, 'default', '{\"uuid\":\"6b98cb93-2d7b-41e0-89d1-60d8d176f9e6\",\"displayName\":\"App\\\\Mail\\\\UserCreatedMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":17:{s:8:\\\"mailable\\\";O:24:\\\"App\\\\Mail\\\\UserCreatedMail\\\":23:{s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:28:\\\"olaitanabidemi2007@gmail.com\\\";}}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:7:\\\"subject\\\";N;s:8:\\\"markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:7:\\\"\\u0000*\\u0000tags\\\";a:0:{}s:11:\\\"\\u0000*\\u0000metadata\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:5:\\\"theme\\\";N;s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";s:29:\\\"\\u0000*\\u0000assertionableRenderStrings\\\";N;s:4:\\\"user\\\";O:15:\\\"App\\\\Models\\\\User\\\":36:{s:13:\\\"\\u0000*\\u0000connection\\\";s:5:\\\"mysql\\\";s:8:\\\"\\u0000*\\u0000table\\\";s:5:\\\"users\\\";s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000keyType\\\";s:3:\\\"int\\\";s:12:\\\"incrementing\\\";b:1;s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:12:\\\"\\u0000*\\u0000withCount\\\";a:0:{}s:19:\\\"preventsLazyLoading\\\";b:0;s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:6:\\\"exists\\\";b:1;s:18:\\\"wasRecentlyCreated\\\";b:1;s:28:\\\"\\u0000*\\u0000escapeWhenCastingToString\\\";b:0;s:13:\\\"\\u0000*\\u0000attributes\\\";a:10:{s:4:\\\"name\\\";s:13:\\\"Olusols Abefe\\\";s:5:\\\"email\\\";s:28:\\\"olaitanabidemi2007@gmail.com\\\";s:8:\\\"password\\\";s:60:\\\"$2y$12$A0y0DmvCGQtnrm3euNcsbeF0D3110Pltj13w2xgz2ZI9cWDCzljS2\\\";s:5:\\\"phone\\\";i:8056444321;s:4:\\\"role\\\";s:7:\\\"student\\\";s:9:\\\"exam_type\\\";s:7:\\\"GENERAL\\\";s:9:\\\"is_active\\\";b:1;s:10:\\\"updated_at\\\";s:19:\\\"2026-03-22 07:39:33\\\";s:10:\\\"created_at\\\";s:19:\\\"2026-03-22 07:39:33\\\";s:2:\\\"id\\\";i:39;}s:11:\\\"\\u0000*\\u0000original\\\";a:10:{s:4:\\\"name\\\";s:13:\\\"Olusols Abefe\\\";s:5:\\\"email\\\";s:28:\\\"olaitanabidemi2007@gmail.com\\\";s:8:\\\"password\\\";s:60:\\\"$2y$12$A0y0DmvCGQtnrm3euNcsbeF0D3110Pltj13w2xgz2ZI9cWDCzljS2\\\";s:5:\\\"phone\\\";i:8056444321;s:4:\\\"role\\\";s:7:\\\"student\\\";s:9:\\\"exam_type\\\";s:7:\\\"GENERAL\\\";s:9:\\\"is_active\\\";b:1;s:10:\\\"updated_at\\\";s:19:\\\"2026-03-22 07:39:33\\\";s:10:\\\"created_at\\\";s:19:\\\"2026-03-22 07:39:33\\\";s:2:\\\"id\\\";i:39;}s:10:\\\"\\u0000*\\u0000changes\\\";a:0:{}s:11:\\\"\\u0000*\\u0000previous\\\";a:0:{}s:8:\\\"\\u0000*\\u0000casts\\\";a:3:{s:17:\\\"email_verified_at\\\";s:8:\\\"datetime\\\";s:8:\\\"password\\\";s:6:\\\"hashed\\\";s:9:\\\"is_active\\\";s:7:\\\"boolean\\\";}s:17:\\\"\\u0000*\\u0000classCastCache\\\";a:0:{}s:21:\\\"\\u0000*\\u0000attributeCastCache\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:19:\\\"\\u0000*\\u0000dispatchesEvents\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:12:\\\"\\u0000*\\u0000relations\\\";a:0:{}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:27:\\\"\\u0000*\\u0000relationAutoloadCallback\\\";N;s:26:\\\"\\u0000*\\u0000relationAutoloadContext\\\";N;s:10:\\\"timestamps\\\";b:1;s:13:\\\"usesUniqueIds\\\";b:0;s:9:\\\"\\u0000*\\u0000hidden\\\";a:2:{i:0;s:8:\\\"password\\\";i:1;s:14:\\\"remember_token\\\";}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:11:\\\"\\u0000*\\u0000fillable\\\";a:9:{i:0;s:4:\\\"name\\\";i:1;s:5:\\\"email\\\";i:2;s:8:\\\"password\\\";i:3;s:5:\\\"phone\\\";i:4;s:9:\\\"exam_type\\\";i:5;s:4:\\\"role\\\";i:6;s:7:\\\"address\\\";i:7;s:13:\\\"profile_photo\\\";i:8;s:9:\\\"is_active\\\";}s:10:\\\"\\u0000*\\u0000guarded\\\";a:1:{i:0;s:1:\\\"*\\\";}s:19:\\\"\\u0000*\\u0000authPasswordName\\\";s:8:\\\"password\\\";s:20:\\\"\\u0000*\\u0000rememberTokenName\\\";s:14:\\\"remember_token\\\";s:14:\\\"\\u0000*\\u0000accessToken\\\";N;}s:8:\\\"password\\\";s:8:\\\"DItKDMba\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\",\"batchId\":null},\"createdAt\":1774165173,\"delay\":null}', 0, NULL, 1774165173, 1774165173);

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_03_06_091533_create_personal_access_tokens_table', 2),
(5, '2026_03_06_092518_create_payments_table', 2),
(6, '2026_03_06_092518_create_student_details_table', 2),
(7, '2026_03_06_092519_create_subjects_table', 2),
(8, '2026_03_06_092520_create_exams_table', 2),
(9, '2026_03_06_092521_create_questions_table', 2),
(10, '2026_03_06_092522_create_fill_blank_answers_table', 2),
(11, '2026_03_06_092522_create_question_options_table', 2),
(12, '2026_03_06_092523_create_exam_attempts_table', 2),
(13, '2026_03_06_092524_create_student_answers_table', 2),
(14, '2026_03_06_092525_create_results_table', 2),
(15, '2026_03_06_092526_create_conversation_participants_table', 2),
(16, '2026_03_06_092526_create_conversations_table', 2),
(17, '2026_03_06_092527_create_messages_table', 2),
(18, '2026_03_06_092528_create_notifications_table', 2),
(19, '2026_03_06_145055_add_phone_to_users_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` bigint NOT NULL,
  `question_id` bigint DEFAULT NULL,
  `option_label` char(1) DEFAULT NULL,
  `option_text` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `question_id`, `option_label`, `option_text`, `created_at`, `updated_at`) VALUES
(21, 11, 'A', 'She don\'t like apples.', '2026-03-30 12:02:47', '2026-03-30 12:02:47'),
(22, 11, 'B', 'He doesn\'t likes apples.', '2026-03-30 12:02:47', '2026-03-30 12:02:47'),
(23, 11, 'C', 'They doesn\'t eat meat.', '2026-03-30 12:02:47', '2026-03-30 12:02:47'),
(24, 11, 'D', 'I don\'t eat meat.', '2026-03-30 12:02:47', '2026-03-30 12:02:47'),
(25, 13, 'A', 'She likes to read books, but she prefers watching movies.', '2026-03-30 12:02:47', '2026-03-30 12:02:47'),
(26, 13, 'B', 'He cooked dinner; then he cleaned the kitchen.', '2026-03-30 12:02:47', '2026-03-30 12:02:47'),
(27, 13, 'C', 'They went to the park yesterday.', '2026-03-30 12:02:47', '2026-03-30 12:02:47'),
(28, 13, 'D', 'The dog barks loudly when he sees strangers.', '2026-03-30 12:02:47', '2026-03-30 12:02:47'),
(29, 14, 'A', 'The team plays well together.', '2026-03-30 13:30:19', '2026-03-30 13:30:19'),
(30, 14, 'B', 'The team play well together.', '2026-03-30 13:30:19', '2026-03-30 13:30:19'),
(31, 14, 'C', 'The team playing well together.', '2026-03-30 13:30:19', '2026-03-30 13:30:19'),
(32, 14, 'D', 'The team is play well together.', '2026-03-30 13:30:19', '2026-03-30 13:30:19'),
(33, 15, 'A', 'She likes to hike, swimming, and to run.', '2026-03-30 13:30:19', '2026-03-30 13:30:19'),
(34, 15, 'B', 'She likes hiking, swimming, and running.', '2026-03-30 13:30:19', '2026-03-30 13:30:19'),
(35, 15, 'C', 'She likes to hike, swim, and running.', '2026-03-30 13:30:19', '2026-03-30 13:30:19'),
(36, 15, 'D', 'She likes hike, swimming, and runs.', '2026-03-30 13:30:19', '2026-03-30 13:30:19'),
(37, 16, 'A', 'win', '2026-03-30 14:46:26', '2026-03-30 14:46:26'),
(38, 16, 'B', 'wins', '2026-03-30 14:46:26', '2026-03-30 14:46:26'),
(39, 16, 'C', 'won', '2026-03-30 14:46:26', '2026-03-30 14:46:26'),
(40, 16, 'D', 'will win', '2026-03-30 14:46:26', '2026-03-30 14:46:26'),
(41, 18, 'A', 'A', '2026-03-30 14:46:26', '2026-03-30 14:46:26'),
(42, 18, 'B', 'B', '2026-03-30 14:46:26', '2026-03-30 14:46:26'),
(43, 18, 'C', 'Both A and B', '2026-03-30 14:46:26', '2026-03-30 14:46:26'),
(44, 18, 'D', 'Neither A nor B', '2026-03-30 14:46:26', '2026-03-30 14:46:26'),
(45, 19, 'A', 'is', '2026-03-30 14:55:52', '2026-03-30 14:55:52'),
(46, 19, 'B', 'are', '2026-03-30 14:55:52', '2026-03-30 14:55:52'),
(47, 19, 'C', 'am', '2026-03-30 14:55:52', '2026-03-30 14:55:52'),
(48, 19, 'D', 'be', '2026-03-30 14:55:52', '2026-03-30 14:55:52'),
(49, 21, 'A', 'have', '2026-03-30 14:55:52', '2026-03-30 14:55:52'),
(50, 21, 'B', 'has', '2026-03-30 14:55:52', '2026-03-30 14:55:52'),
(51, 21, 'C', 'having', '2026-03-30 14:55:52', '2026-03-30 14:55:52'),
(52, 21, 'D', 'has been', '2026-03-30 14:55:52', '2026-03-30 14:55:52'),
(53, 22, 'A', 'A', '2026-03-30 14:55:52', '2026-03-30 14:55:52'),
(54, 22, 'B', 'B', '2026-03-30 14:55:52', '2026-03-30 14:55:52'),
(55, 24, 'A', 'A', '2026-03-30 14:55:52', '2026-03-30 14:55:52'),
(56, 24, 'B', 'B', '2026-03-30 14:55:52', '2026-03-30 14:55:52'),
(57, 25, 'A', 'is', '2026-03-30 14:55:52', '2026-03-30 14:55:52'),
(58, 25, 'B', 'are', '2026-03-30 14:55:52', '2026-03-30 14:55:52'),
(59, 25, 'C', 'was', '2026-03-30 14:55:52', '2026-03-30 14:55:52'),
(60, 25, 'D', 'were', '2026-03-30 14:55:52', '2026-03-30 14:55:52'),
(61, 27, 'A', 'A', '2026-03-30 14:55:52', '2026-03-30 14:55:52'),
(62, 27, 'B', 'B', '2026-03-30 14:55:52', '2026-03-30 14:55:52'),
(63, 29, 'A', 'A', '2026-03-30 14:55:52', '2026-03-30 14:55:52'),
(64, 29, 'B', 'B', '2026-03-30 14:55:52', '2026-03-30 14:55:52'),
(65, 30, 'A', 'A', '2026-03-30 14:55:52', '2026-03-30 14:55:52'),
(66, 30, 'B', 'B', '2026-03-30 14:55:52', '2026-03-30 14:55:52'),
(67, 31, 'A', '-2x + 6y', '2026-03-31 03:13:31', '2026-03-31 03:13:31'),
(68, 31, 'B', '2x + 6y', '2026-03-31 03:13:31', '2026-03-31 03:13:31'),
(69, 31, 'C', '-2x - 2y', '2026-03-31 03:13:31', '2026-03-31 03:13:31'),
(70, 31, 'D', '2x - 2y', '2026-03-31 03:13:31', '2026-03-31 03:13:31'),
(71, 33, 'A', '(x + 2)(x - 2)', '2026-03-31 03:13:31', '2026-03-31 03:13:31'),
(72, 33, 'B', '(x - 2)(x - 2)', '2026-03-31 03:13:31', '2026-03-31 03:13:31'),
(73, 33, 'C', '(x + 4)(x - 1)', '2026-03-31 03:13:31', '2026-03-31 03:13:31'),
(74, 33, 'D', '(x + 1)(x - 4)', '2026-03-31 03:13:31', '2026-03-31 03:13:31'),
(75, 36, 'A', '2x^2 + 5x - 12', '2026-03-31 03:13:31', '2026-03-31 03:13:31'),
(76, 36, 'B', '2x^2 + 11x - 12', '2026-03-31 03:13:31', '2026-03-31 03:13:31'),
(77, 36, 'C', '2x^2 + 5x + 12', '2026-03-31 03:13:31', '2026-03-31 03:13:31'),
(78, 36, 'D', '2x^2 + 11x + 12', '2026-03-31 03:13:31', '2026-03-31 03:13:31'),
(79, 38, 'A', '7x - 8', '2026-03-31 03:13:31', '2026-03-31 03:13:31'),
(80, 38, 'B', '6x - 8', '2026-03-31 03:13:31', '2026-03-31 03:13:31'),
(81, 38, 'C', '8x - 8', '2026-03-31 03:13:31', '2026-03-31 03:13:31'),
(82, 38, 'D', '6x - 4', '2026-03-31 03:13:31', '2026-03-31 03:13:31'),
(83, 45, 'A', '5', '2026-04-04 09:59:20', '2026-04-04 09:59:20'),
(84, 45, 'B', '6', '2026-04-04 09:59:20', '2026-04-04 09:59:20'),
(85, 45, 'C', '7', '2026-04-04 09:59:20', '2026-04-04 09:59:20'),
(86, 45, 'D', '8', '2026-04-04 09:59:20', '2026-04-04 09:59:20'),
(87, 48, 'A', '1/6', '2026-04-04 10:10:08', '2026-04-04 10:10:08'),
(88, 48, 'B', '1/12', '2026-04-04 10:10:08', '2026-04-04 10:10:08'),
(89, 48, 'C', '1/9', '2026-04-04 10:10:08', '2026-04-04 10:10:08'),
(90, 48, 'D', '1/36', '2026-04-04 10:10:08', '2026-04-04 10:10:08'),
(91, 49, 'A', '5/20', '2026-04-04 10:10:08', '2026-04-04 10:10:08'),
(92, 49, 'B', '15/40', '2026-04-04 10:10:08', '2026-04-04 10:10:08'),
(93, 49, 'C', '15/72', '2026-04-04 10:10:08', '2026-04-04 10:10:08'),
(94, 49, 'D', '5/18', '2026-04-04 10:10:08', '2026-04-04 10:10:08'),
(95, 50, 'A', '5/18', '2026-04-04 10:16:29', '2026-04-04 10:16:29'),
(96, 50, 'B', '7/18', '2026-04-04 10:16:29', '2026-04-04 10:16:29'),
(97, 50, 'C', '5/9', '2026-04-04 10:16:29', '2026-04-04 10:16:29'),
(98, 50, 'D', '7/9', '2026-04-04 10:16:29', '2026-04-04 10:16:29'),
(99, 51, 'A', '2/9', '2026-04-04 10:16:29', '2026-04-04 10:16:29'),
(100, 51, 'B', '5/18', '2026-04-04 10:16:29', '2026-04-04 10:16:29'),
(101, 51, 'C', '7/18', '2026-04-04 10:16:29', '2026-04-04 10:16:29'),
(102, 51, 'D', '1/3', '2026-04-04 10:16:29', '2026-04-04 10:16:29'),
(103, 52, 'A', 'The data is negatively skewed', '2026-04-04 10:46:06', '2026-04-04 10:46:06'),
(104, 52, 'B', 'The data is positively skewed', '2026-04-04 10:46:06', '2026-04-04 10:46:06'),
(105, 52, 'C', 'The data is symmetric', '2026-04-04 10:46:06', '2026-04-04 10:46:06'),
(106, 52, 'D', 'The data is normally distributed', '2026-04-04 10:46:06', '2026-04-04 10:46:06'),
(107, 54, 'A', '1/6', '2026-04-04 10:57:59', '2026-04-04 10:57:59'),
(108, 54, 'B', '1/12', '2026-04-04 10:57:59', '2026-04-04 10:57:59'),
(109, 54, 'C', '1/9', '2026-04-04 10:57:59', '2026-04-04 10:57:59'),
(110, 54, 'D', '1/36', '2026-04-04 10:57:59', '2026-04-04 10:57:59'),
(111, 55, 'A', '3/20', '2026-04-04 10:57:59', '2026-04-04 10:57:59'),
(112, 55, 'B', '1/4', '2026-04-04 10:57:59', '2026-04-04 10:57:59'),
(113, 55, 'C', '5/18', '2026-04-04 10:57:59', '2026-04-04 10:57:59'),
(114, 55, 'D', '5/24', '2026-04-04 10:57:59', '2026-04-04 10:57:59'),
(115, 56, 'A', 'The sun shone brightly on the beach.', '2026-04-04 16:37:29', '2026-04-04 16:37:29'),
(116, 56, 'B', 'Peter Piper picked a peck of pickled peppers.', '2026-04-04 16:37:29', '2026-04-04 16:37:29'),
(117, 56, 'C', 'She sells seashells by the seashore.', '2026-04-04 16:37:29', '2026-04-04 16:37:29'),
(118, 56, 'D', 'The cat sat on the mat.', '2026-04-04 16:37:29', '2026-04-04 16:37:29'),
(119, 59, 'A', '1/64', '2026-04-04 17:54:51', '2026-04-04 17:54:51'),
(120, 59, 'B', '1/54', '2026-04-04 17:54:51', '2026-04-04 17:54:51'),
(121, 59, 'C', '1/27', '2026-04-04 17:54:51', '2026-04-04 17:54:51'),
(122, 59, 'D', '1/216', '2026-04-04 17:54:51', '2026-04-04 17:54:51'),
(123, 60, 'A', '3/35', '2026-04-04 17:54:51', '2026-04-04 17:54:51'),
(124, 60, 'B', '1/10', '2026-04-04 17:54:51', '2026-04-04 17:54:51'),
(125, 60, 'C', '3/28', '2026-04-04 17:54:51', '2026-04-04 17:54:51'),
(126, 60, 'D', '3/14', '2026-04-04 17:54:51', '2026-04-04 17:54:51'),
(127, 61, 'A', '23', '2026-04-05 12:16:33', '2026-04-05 12:16:33'),
(128, 61, 'B', '24', '2026-04-05 12:16:33', '2026-04-05 12:16:33'),
(129, 61, 'C', '26', '2026-04-05 12:16:33', '2026-04-05 12:16:33'),
(130, 61, 'D', '27', '2026-04-05 12:16:33', '2026-04-05 12:16:33'),
(131, 63, 'A', '23', '2026-04-05 12:22:23', '2026-04-05 12:22:23'),
(132, 63, 'B', '24', '2026-04-05 12:22:23', '2026-04-05 12:22:23'),
(133, 63, 'C', '26', '2026-04-05 12:22:23', '2026-04-05 12:22:23'),
(134, 63, 'D', '27', '2026-04-05 12:22:23', '2026-04-05 12:22:23'),
(135, 65, 'A', '67', '2026-04-05 12:25:29', '2026-04-05 12:25:29'),
(136, 65, 'B', '68', '2026-04-05 12:25:29', '2026-04-05 12:25:29'),
(137, 65, 'C', '69', '2026-04-05 12:25:29', '2026-04-05 12:25:29'),
(138, 65, 'D', '70', '2026-04-05 12:25:29', '2026-04-05 12:25:29'),
(139, 66, 'A', '48', '2026-04-05 12:25:29', '2026-04-05 12:25:29'),
(140, 66, 'B', '49', '2026-04-05 12:25:29', '2026-04-05 12:25:29'),
(141, 66, 'C', '50', '2026-04-05 12:25:29', '2026-04-05 12:25:29'),
(142, 66, 'D', '51', '2026-04-05 12:25:29', '2026-04-05 12:25:29'),
(143, 68, 'A', '31', '2026-04-05 12:25:29', '2026-04-05 12:25:29'),
(144, 68, 'B', '47', '2026-04-05 12:25:29', '2026-04-05 12:25:29'),
(145, 68, 'C', '25', '2026-04-05 12:25:29', '2026-04-05 12:25:29'),
(146, 68, 'D', '39', '2026-04-05 12:25:29', '2026-04-05 12:25:29'),
(147, 69, 'A', '70', '2026-04-05 12:25:29', '2026-04-05 12:25:29'),
(148, 69, 'B', '73', '2026-04-05 12:25:29', '2026-04-05 12:25:29'),
(149, 69, 'C', '68', '2026-04-05 12:25:29', '2026-04-05 12:25:29'),
(150, 69, 'D', '77', '2026-04-05 12:25:29', '2026-04-05 12:25:29'),
(151, 70, 'A', '56', '2026-04-05 12:25:29', '2026-04-05 12:25:29'),
(152, 70, 'B', '65', '2026-04-05 12:25:29', '2026-04-05 12:25:29'),
(153, 70, 'C', 'Both are equal', '2026-04-05 12:25:29', '2026-04-05 12:25:29'),
(154, 70, 'D', 'Cannot determine', '2026-04-05 12:25:29', '2026-04-05 12:25:29'),
(155, 71, 'A', '35', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(156, 71, 'B', '37', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(157, 71, 'C', '38', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(158, 71, 'D', '39', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(159, 72, 'A', '12', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(160, 72, 'B', '45', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(161, 72, 'C', '32', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(162, 72, 'D', '28', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(163, 74, 'A', '88', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(164, 74, 'B', '89', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(165, 74, 'C', '90', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(166, 74, 'D', '91', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(167, 75, 'A', '76', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(168, 75, 'B', '77', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(169, 75, 'C', '78', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(170, 75, 'D', '79', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(171, 77, 'A', '63', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(172, 77, 'B', '49', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(173, 77, 'C', '52', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(174, 77, 'D', '77', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(175, 78, 'A', '75', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(176, 78, 'B', '78', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(177, 78, 'C', '68', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(178, 78, 'D', '77', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(179, 79, 'A', '58', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(180, 79, 'B', '85', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(181, 79, 'C', 'Both are equal', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(182, 79, 'D', 'Cannot determine', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(183, 80, 'A', '42', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(184, 80, 'B', '44', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(185, 80, 'C', '45', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(186, 80, 'D', '46', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(187, 81, 'A', '29', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(188, 81, 'B', '56', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(189, 81, 'C', '41', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(190, 81, 'D', '68', '2026-04-05 12:25:30', '2026-04-05 12:25:30'),
(191, 84, 'A', '1', '2026-04-05 12:28:58', '2026-04-05 12:28:58'),
(192, 84, 'B', '2', '2026-04-05 12:28:58', '2026-04-05 12:28:58'),
(193, 84, 'C', '3', '2026-04-05 12:28:58', '2026-04-05 12:28:58'),
(194, 84, 'D', '5', '2026-04-05 12:28:58', '2026-04-05 12:28:58'),
(195, 86, 'A', '198', '2026-04-05 12:28:58', '2026-04-05 12:28:58'),
(196, 86, 'B', '199', '2026-04-05 12:28:58', '2026-04-05 12:28:58'),
(197, 86, 'C', '201', '2026-04-05 12:28:58', '2026-04-05 12:28:58'),
(198, 86, 'D', '202', '2026-04-05 12:28:58', '2026-04-05 12:28:58'),
(199, 88, 'A', '50', '2026-04-05 12:28:58', '2026-04-05 12:28:58'),
(200, 88, 'B', '52', '2026-04-05 12:28:58', '2026-04-05 12:28:58'),
(201, 88, 'C', '54', '2026-04-05 12:28:58', '2026-04-05 12:28:58'),
(202, 88, 'D', '56', '2026-04-05 12:28:58', '2026-04-05 12:28:58'),
(203, 90, 'A', '101', '2026-04-05 12:28:58', '2026-04-05 12:28:58'),
(204, 90, 'B', '103', '2026-04-05 12:28:58', '2026-04-05 12:28:58'),
(205, 90, 'C', '107', '2026-04-05 12:28:58', '2026-04-05 12:28:58'),
(206, 90, 'D', '109', '2026-04-05 12:28:58', '2026-04-05 12:28:58'),
(207, 92, 'A', '14', '2026-04-05 12:28:58', '2026-04-05 12:28:58'),
(208, 92, 'B', '20', '2026-04-05 12:28:58', '2026-04-05 12:28:58'),
(209, 92, 'C', '25', '2026-04-05 12:28:58', '2026-04-05 12:28:58'),
(210, 92, 'D', '30', '2026-04-05 12:28:58', '2026-04-05 12:28:58'),
(211, 93, 'A', 'Pilot', '2026-04-05 12:31:06', '2026-04-05 12:31:06'),
(212, 93, 'B', 'Chef', '2026-04-05 12:31:06', '2026-04-05 12:31:06'),
(213, 93, 'C', 'Doctor', '2026-04-05 12:31:06', '2026-04-05 12:31:06'),
(214, 93, 'D', 'Teacher', '2026-04-05 12:31:06', '2026-04-05 12:31:06'),
(215, 94, 'A', 'Car', '2026-04-05 12:31:06', '2026-04-05 12:31:06'),
(216, 94, 'B', 'Apple', '2026-04-05 12:31:06', '2026-04-05 12:31:06'),
(217, 94, 'C', 'Book', '2026-04-05 12:31:06', '2026-04-05 12:31:06'),
(218, 94, 'D', 'Sun', '2026-04-05 12:31:06', '2026-04-05 12:31:06'),
(219, 97, 'A', 'House', '2026-04-05 12:31:06', '2026-04-05 12:31:06'),
(220, 97, 'B', 'Tree', '2026-04-05 12:31:06', '2026-04-05 12:31:06'),
(221, 97, 'C', 'River', '2026-04-05 12:31:06', '2026-04-05 12:31:06'),
(222, 97, 'D', 'Mountain', '2026-04-05 12:31:06', '2026-04-05 12:31:06'),
(223, 99, 'A', 'Supermarket', '2026-04-05 12:31:06', '2026-04-05 12:31:06'),
(224, 99, 'B', 'Park', '2026-04-05 12:31:06', '2026-04-05 12:31:06'),
(225, 99, 'C', 'Beach', '2026-04-05 12:31:06', '2026-04-05 12:31:06'),
(226, 99, 'D', 'Zoo', '2026-04-05 12:31:06', '2026-04-05 12:31:06'),
(227, 102, 'A', 'Library', '2026-04-05 12:31:06', '2026-04-05 12:31:06'),
(228, 102, 'B', 'Cinema', '2026-04-05 12:31:06', '2026-04-05 12:31:06'),
(229, 102, 'C', 'Museum', '2026-04-05 12:31:06', '2026-04-05 12:31:06'),
(230, 102, 'D', 'Garden', '2026-04-05 12:31:06', '2026-04-05 12:31:06'),
(231, 103, 'A', 'She danced at the party.', '2026-04-05 12:33:40', '2026-04-05 12:33:40'),
(232, 103, 'B', 'They will swim in the pool.', '2026-04-05 12:33:40', '2026-04-05 12:33:40'),
(233, 103, 'C', 'He plays football every Saturday.', '2026-04-05 12:33:40', '2026-04-05 12:33:40'),
(234, 103, 'D', 'I ate my lunch an hour ago.', '2026-04-05 12:33:40', '2026-04-05 12:33:40'),
(235, 105, 'A', 'I am singing in the choir.', '2026-04-05 12:33:40', '2026-04-05 12:33:40'),
(236, 105, 'B', 'She will bake a cake tomorrow.', '2026-04-05 12:33:40', '2026-04-05 12:33:40'),
(237, 105, 'C', 'They are playing in the park now.', '2026-04-05 12:33:40', '2026-04-05 12:33:40'),
(238, 105, 'D', 'He danced at the concert yesterday.', '2026-04-05 12:33:40', '2026-04-05 12:33:40'),
(239, 106, 'A', 'runned', '2026-04-05 12:33:40', '2026-04-05 12:33:40'),
(240, 106, 'B', 'running', '2026-04-05 12:33:40', '2026-04-05 12:33:40'),
(241, 106, 'C', 'ran', '2026-04-05 12:33:40', '2026-04-05 12:33:40'),
(242, 106, 'D', 'runs', '2026-04-05 12:33:40', '2026-04-05 12:33:40'),
(243, 109, 'A', 'ate', '2026-04-05 12:33:40', '2026-04-05 12:33:40'),
(244, 109, 'B', 'eating', '2026-04-05 12:33:40', '2026-04-05 12:33:40'),
(245, 109, 'C', 'eats', '2026-04-05 12:33:40', '2026-04-05 12:33:40'),
(246, 109, 'D', 'will eat', '2026-04-05 12:33:40', '2026-04-05 12:33:40'),
(247, 110, 'A', 'She will sing at the concert.', '2026-04-05 12:33:40', '2026-04-05 12:33:40'),
(248, 110, 'B', 'They swim in the pool.', '2026-04-05 12:33:40', '2026-04-05 12:33:40'),
(249, 110, 'C', 'He danced at the party.', '2026-04-05 12:33:40', '2026-04-05 12:33:40'),
(250, 110, 'D', 'I have read the book.', '2026-04-05 12:33:40', '2026-04-05 12:33:40'),
(251, 115, 'A', 'Area = Length + Width', '2026-04-05 12:35:09', '2026-04-05 12:35:09'),
(252, 115, 'B', 'Area = 2 * (Length + Width)', '2026-04-05 12:35:09', '2026-04-05 12:35:09'),
(253, 115, 'C', 'Area = Length * Width', '2026-04-05 12:35:09', '2026-04-05 12:35:09'),
(254, 115, 'D', 'Area = Length / Width', '2026-04-05 12:35:09', '2026-04-05 12:35:09'),
(255, 121, 'A', 'Rectangles have equal length and width', '2026-04-05 12:35:09', '2026-04-05 12:35:09'),
(256, 121, 'B', 'Rectangles have four equal sides', '2026-04-05 12:35:09', '2026-04-05 12:35:09'),
(257, 121, 'C', 'Rectangles have opposite sides that are equal', '2026-04-05 12:35:09', '2026-04-05 12:35:09'),
(258, 121, 'D', 'Rectangles have three sides', '2026-04-05 12:35:09', '2026-04-05 12:35:09'),
(259, 122, 'A', 'Action verb', '2026-04-05 12:35:59', '2026-04-05 12:35:59'),
(260, 122, 'B', 'Linking verb', '2026-04-05 12:35:59', '2026-04-05 12:35:59'),
(261, 122, 'C', 'Helping verb', '2026-04-05 12:35:59', '2026-04-05 12:35:59'),
(262, 122, 'D', 'None of the above', '2026-04-05 12:35:59', '2026-04-05 12:35:59'),
(263, 124, 'A', 'Action verb', '2026-04-05 12:35:59', '2026-04-05 12:35:59'),
(264, 124, 'B', 'Linking verb', '2026-04-05 12:35:59', '2026-04-05 12:35:59'),
(265, 124, 'C', 'Helping verb', '2026-04-05 12:35:59', '2026-04-05 12:35:59'),
(266, 124, 'D', 'Transitive verb', '2026-04-05 12:35:59', '2026-04-05 12:35:59'),
(267, 126, 'A', 'Action verb', '2026-04-05 12:35:59', '2026-04-05 12:35:59'),
(268, 126, 'B', 'Linking verb', '2026-04-05 12:35:59', '2026-04-05 12:35:59'),
(269, 126, 'C', 'Helping verb', '2026-04-05 12:35:59', '2026-04-05 12:35:59'),
(270, 126, 'D', 'Adverb', '2026-04-05 12:35:59', '2026-04-05 12:35:59'),
(271, 128, 'A', 'Action verb', '2026-04-05 12:35:59', '2026-04-05 12:35:59'),
(272, 128, 'B', 'Linking verb', '2026-04-05 12:35:59', '2026-04-05 12:35:59'),
(273, 128, 'C', 'Helping verb', '2026-04-05 12:35:59', '2026-04-05 12:35:59'),
(274, 128, 'D', 'Adjective', '2026-04-05 12:35:59', '2026-04-05 12:35:59'),
(275, 130, 'A', 'Action verb', '2026-04-05 12:35:59', '2026-04-05 12:35:59'),
(276, 130, 'B', 'Linking verb', '2026-04-05 12:35:59', '2026-04-05 12:35:59'),
(277, 130, 'C', 'Helping verb', '2026-04-05 12:35:59', '2026-04-05 12:35:59'),
(278, 130, 'D', 'Continuous verb', '2026-04-05 12:35:59', '2026-04-05 12:35:59'),
(279, 152, 'A', 'Bronchi', '2026-04-06 09:11:11', '2026-04-06 09:11:11'),
(280, 152, 'B', 'Alveoli', '2026-04-06 09:11:11', '2026-04-06 09:11:11'),
(281, 152, 'C', 'Trachea', '2026-04-06 09:11:11', '2026-04-06 09:11:11'),
(282, 152, 'D', 'Diaphragm', '2026-04-06 09:11:11', '2026-04-06 09:11:11'),
(283, 153, 'A', 'To regulate airflow into the lungs', '2026-04-06 09:11:11', '2026-04-06 09:11:11'),
(284, 153, 'B', 'To produce mucus for lung protection', '2026-04-06 09:11:11', '2026-04-06 09:11:11'),
(285, 153, 'C', 'To protect the trachea from food entering', '2026-04-06 09:11:11', '2026-04-06 09:11:11'),
(286, 153, 'D', 'To enhance oxygen absorption in the alveoli', '2026-04-06 09:11:11', '2026-04-06 09:11:11'),
(287, 155, 'A', 'To exchange gases with the blood', '2026-04-06 09:11:11', '2026-04-06 09:11:11'),
(288, 155, 'B', 'To warm and humidify the inhaled air', '2026-04-06 09:11:11', '2026-04-06 09:11:11'),
(289, 155, 'C', 'To transport oxygen to the cells', '2026-04-06 09:11:11', '2026-04-06 09:11:11'),
(290, 155, 'D', 'To regulate airflow in the lungs', '2026-04-06 09:11:11', '2026-04-06 09:11:11'),
(291, 156, 'A', 'Asthma', '2026-04-06 09:11:11', '2026-04-06 09:11:11'),
(292, 156, 'B', 'Bronchitis', '2026-04-06 09:11:11', '2026-04-06 09:11:11'),
(293, 156, 'C', 'Pneumonia', '2026-04-06 09:11:11', '2026-04-06 09:11:11'),
(294, 156, 'D', 'Emphysema', '2026-04-06 09:11:11', '2026-04-06 09:11:11'),
(295, 158, 'A', 'By producing hormones', '2026-04-06 09:11:11', '2026-04-06 09:11:11'),
(296, 158, 'B', 'By regulating body temperature', '2026-04-06 09:11:11', '2026-04-06 09:11:11'),
(297, 158, 'C', 'By excreting waste products', '2026-04-06 09:11:11', '2026-04-06 09:11:11'),
(298, 158, 'D', 'By controlling the levels of carbon dioxide in the blood', '2026-04-06 09:11:11', '2026-04-06 09:11:11'),
(299, 159, 'A', 'To transport oxygen in the blood', '2026-04-06 09:11:11', '2026-04-06 09:11:11'),
(300, 159, 'B', 'To produce mucus for lung protection', '2026-04-06 09:11:11', '2026-04-06 09:11:11'),
(301, 159, 'C', 'To facilitate gas exchange in the alveoli', '2026-04-06 09:11:11', '2026-04-06 09:11:11'),
(302, 159, 'D', 'To regulate airflow in the bronchi', '2026-04-06 09:11:11', '2026-04-06 09:11:11'),
(303, 160, 'A', 'To produce mucus for lung protection', '2026-04-06 09:11:11', '2026-04-06 09:11:11'),
(304, 160, 'B', 'To warm and humidify the inhaled air', '2026-04-06 09:11:11', '2026-04-06 09:11:11'),
(305, 160, 'C', 'To filter out dust and particles from the air', '2026-04-06 09:11:11', '2026-04-06 09:11:11'),
(306, 160, 'D', 'To regulate airflow in the bronchi', '2026-04-06 09:11:11', '2026-04-06 09:11:11'),
(307, 162, 'A', 'France', '2026-04-06 09:12:51', '2026-04-06 09:12:51'),
(308, 162, 'B', 'Germany', '2026-04-06 09:12:51', '2026-04-06 09:12:51'),
(309, 162, 'C', 'Italy', '2026-04-06 09:12:51', '2026-04-06 09:12:51'),
(310, 162, 'D', 'Spain', '2026-04-06 09:12:51', '2026-04-06 09:12:51'),
(311, 164, 'A', 'Diwali', '2026-04-06 09:12:51', '2026-04-06 09:12:51'),
(312, 164, 'B', 'Eid al-Fitr', '2026-04-06 09:12:51', '2026-04-06 09:12:51'),
(313, 164, 'C', 'Lunar New Year', '2026-04-06 09:12:51', '2026-04-06 09:12:51'),
(314, 164, 'D', 'Christmas', '2026-04-06 09:12:51', '2026-04-06 09:12:51'),
(315, 166, 'A', 'United States', '2026-04-06 09:12:51', '2026-04-06 09:12:51'),
(316, 166, 'B', 'Ireland', '2026-04-06 09:12:51', '2026-04-06 09:12:51'),
(317, 166, 'C', 'United Kingdom', '2026-04-06 09:12:51', '2026-04-06 09:12:51'),
(318, 166, 'D', 'Australia', '2026-04-06 09:12:51', '2026-04-06 09:12:51'),
(319, 168, 'A', 'France', '2026-04-06 09:12:51', '2026-04-06 09:12:51'),
(320, 168, 'B', 'Spain', '2026-04-06 09:12:51', '2026-04-06 09:12:51'),
(321, 168, 'C', 'Italy', '2026-04-06 09:12:51', '2026-04-06 09:12:51'),
(322, 168, 'D', 'Mexico', '2026-04-06 09:12:51', '2026-04-06 09:12:51'),
(323, 170, 'A', 'Brazil', '2026-04-06 09:12:51', '2026-04-06 09:12:51'),
(324, 170, 'B', 'Spain', '2026-04-06 09:12:51', '2026-04-06 09:12:51'),
(325, 170, 'C', 'Argentina', '2026-04-06 09:12:51', '2026-04-06 09:12:51'),
(326, 170, 'D', 'Portugal', '2026-04-06 09:12:51', '2026-04-06 09:12:51'),
(327, 172, 'A', '45,678', '2026-04-06 09:14:27', '2026-04-06 09:14:27'),
(328, 172, 'B', '23,456', '2026-04-06 09:14:27', '2026-04-06 09:14:27'),
(329, 172, 'C', '56,789', '2026-04-06 09:14:27', '2026-04-06 09:14:27'),
(330, 172, 'D', '12,345', '2026-04-06 09:14:27', '2026-04-06 09:14:27'),
(331, 174, 'A', '34,567', '2026-04-06 09:14:27', '2026-04-06 09:14:27'),
(332, 174, 'B', '45,678', '2026-04-06 09:14:27', '2026-04-06 09:14:27'),
(333, 174, 'C', '23,456', '2026-04-06 09:14:27', '2026-04-06 09:14:27'),
(334, 174, 'D', '56,789', '2026-04-06 09:14:27', '2026-04-06 09:14:27'),
(335, 177, 'A', '23,457', '2026-04-06 09:14:27', '2026-04-06 09:14:27'),
(336, 177, 'B', '56,789', '2026-04-06 09:14:27', '2026-04-06 09:14:27'),
(337, 177, 'C', '34,566', '2026-04-06 09:14:27', '2026-04-06 09:14:27'),
(338, 177, 'D', '43,219', '2026-04-06 09:14:27', '2026-04-06 09:14:27'),
(339, 179, 'A', '12,345', '2026-04-06 09:14:27', '2026-04-06 09:14:27'),
(340, 179, 'B', '23,456', '2026-04-06 09:14:27', '2026-04-06 09:14:27'),
(341, 179, 'C', '45,678', '2026-04-06 09:14:27', '2026-04-06 09:14:27'),
(342, 179, 'D', '56,790', '2026-04-06 09:14:27', '2026-04-06 09:14:27'),
(343, 181, 'A', '23,456', '2026-04-06 09:14:27', '2026-04-06 09:14:27'),
(344, 181, 'B', '45,678', '2026-04-06 09:14:27', '2026-04-06 09:14:27'),
(345, 181, 'C', '56,789', '2026-04-06 09:14:27', '2026-04-06 09:14:27'),
(346, 181, 'D', '23,561', '2026-04-06 09:14:27', '2026-04-06 09:14:27'),
(347, 182, 'A', 'She don\'t like to eat vegetables.', '2026-04-06 09:15:43', '2026-04-06 09:15:43'),
(348, 182, 'B', 'He doesn\'t have any homework.', '2026-04-06 09:15:43', '2026-04-06 09:15:43'),
(349, 182, 'C', 'I seen that movie last week.', '2026-04-06 09:15:43', '2026-04-06 09:15:43'),
(350, 182, 'D', 'We is going to the park.', '2026-04-06 09:15:43', '2026-04-06 09:15:43'),
(351, 184, 'A', 'walked', '2026-04-06 09:15:43', '2026-04-06 09:15:43'),
(352, 184, 'B', 'through', '2026-04-06 09:15:43', '2026-04-06 09:15:43'),
(353, 184, 'C', 'the', '2026-04-06 09:15:43', '2026-04-06 09:15:43'),
(354, 184, 'D', 'door', '2026-04-06 09:15:43', '2026-04-06 09:15:43'),
(355, 185, 'A', 'They is playing soccer.', '2026-04-06 09:15:43', '2026-04-06 09:15:43'),
(356, 185, 'B', 'She have a new bike.', '2026-04-06 09:15:43', '2026-04-06 09:15:43'),
(357, 185, 'C', 'He go to school every day.', '2026-04-06 09:15:43', '2026-04-06 09:15:43'),
(358, 185, 'D', 'We are studying for the test.', '2026-04-06 09:15:43', '2026-04-06 09:15:43'),
(359, 187, 'A', 'I have went to the store.', '2026-04-06 09:15:43', '2026-04-06 09:15:43'),
(360, 187, 'B', 'She sings beautifully.', '2026-04-06 09:15:43', '2026-04-06 09:15:43'),
(361, 187, 'C', 'They are swimming in the pool.', '2026-04-06 09:15:43', '2026-04-06 09:15:43'),
(362, 187, 'D', 'He run fast.', '2026-04-06 09:15:43', '2026-04-06 09:15:43'),
(363, 189, 'A', 'He ran fast.', '2026-04-06 09:15:43', '2026-04-06 09:15:43'),
(364, 189, 'B', 'She likes to sing and dance.', '2026-04-06 09:15:43', '2026-04-06 09:15:43'),
(365, 189, 'C', 'They went to the park.', '2026-04-06 09:15:43', '2026-04-06 09:15:43'),
(366, 189, 'D', 'The cat meowed loudly.', '2026-04-06 09:15:43', '2026-04-06 09:15:43'),
(367, 190, 'A', 'I', '2026-04-06 09:15:43', '2026-04-06 09:15:43'),
(368, 190, 'B', 'go', '2026-04-06 09:15:43', '2026-04-06 09:15:43'),
(369, 190, 'C', 'if', '2026-04-06 09:15:43', '2026-04-06 09:15:43'),
(370, 190, 'D', 'it', '2026-04-06 09:15:43', '2026-04-06 09:15:43'),
(371, 192, 'A', 'Plastic', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(372, 192, 'B', 'Rubber', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(373, 192, 'C', 'Copper', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(374, 192, 'D', 'Wood', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(375, 193, 'A', 'Ampere', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(376, 193, 'B', 'Ohm', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(377, 193, 'C', 'Volt', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(378, 193, 'D', 'Watt', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(379, 194, 'A', 'Voltage', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(380, 194, 'B', 'Current', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(381, 194, 'C', 'Resistance', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(382, 194, 'D', 'Circuit', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(383, 195, 'A', 'Volt', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(384, 195, 'B', 'Watt', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(385, 195, 'C', 'Ohm', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(386, 195, 'D', 'Ampere', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(387, 196, 'A', 'Aluminum', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(388, 196, 'B', 'Copper', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(389, 196, 'C', 'Plastic', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(390, 196, 'D', 'Silver', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(391, 198, 'A', 'Parallel circuit', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(392, 198, 'B', 'Series circuit', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(393, 198, 'C', 'Open circuit', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(394, 198, 'D', 'Short circuit', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(395, 199, 'A', 'Fuse', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(396, 199, 'B', 'Resistor', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(397, 199, 'C', 'Transformer', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(398, 199, 'D', 'Diode', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(399, 200, 'A', 'Insulation', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(400, 200, 'B', 'Conduction', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(401, 200, 'C', 'Induction', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(402, 200, 'D', 'Resistance', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(403, 201, 'A', 'Ampere', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(404, 201, 'B', 'Watt', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(405, 201, 'C', 'Volt', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(406, 201, 'D', 'Ohm', '2026-04-06 09:16:39', '2026-04-06 09:16:39'),
(407, 203, 'A', 'Birth rate and death rate', '2026-04-06 09:18:35', '2026-04-06 09:18:35'),
(408, 203, 'B', 'Weather patterns', '2026-04-06 09:18:35', '2026-04-06 09:18:35'),
(409, 203, 'C', 'Language spoken', '2026-04-06 09:18:35', '2026-04-06 09:18:35'),
(410, 203, 'D', 'Time zone difference', '2026-04-06 09:18:35', '2026-04-06 09:18:35'),
(411, 205, 'A', 'Lack of job opportunities', '2026-04-06 09:18:35', '2026-04-06 09:18:35'),
(412, 205, 'B', 'High quality healthcare', '2026-04-06 09:18:35', '2026-04-06 09:18:35'),
(413, 205, 'C', 'Abundant natural resources', '2026-04-06 09:18:35', '2026-04-06 09:18:35'),
(414, 205, 'D', 'Good education system', '2026-04-06 09:18:35', '2026-04-06 09:18:35'),
(415, 207, 'A', 'Population', '2026-04-06 09:18:35', '2026-04-06 09:18:35'),
(416, 207, 'B', 'Density', '2026-04-06 09:18:35', '2026-04-06 09:18:35'),
(417, 207, 'C', 'Migration', '2026-04-06 09:18:35', '2026-04-06 09:18:35'),
(418, 207, 'D', 'Urbanization', '2026-04-06 09:18:35', '2026-04-06 09:18:35'),
(419, 210, 'A', 'Lack of job opportunities', '2026-04-06 09:18:35', '2026-04-06 09:18:35'),
(420, 210, 'B', 'Access to healthcare facilities', '2026-04-06 09:18:35', '2026-04-06 09:18:35'),
(421, 210, 'C', 'Quality education system', '2026-04-06 09:18:35', '2026-04-06 09:18:35'),
(422, 210, 'D', 'Abundant natural resources', '2026-04-06 09:18:35', '2026-04-06 09:18:35'),
(423, 212, 'A', '987', '2026-04-06 09:21:27', '2026-04-06 09:21:27'),
(424, 212, 'B', '1070', '2026-04-06 09:21:27', '2026-04-06 09:21:27'),
(425, 212, 'C', '1071', '2026-04-06 09:21:27', '2026-04-06 09:21:27'),
(426, 212, 'D', '1069', '2026-04-06 09:21:27', '2026-04-06 09:21:27'),
(427, 213, 'A', '1170', '2026-04-06 09:21:27', '2026-04-06 09:21:27'),
(428, 213, 'B', '1140', '2026-04-06 09:21:27', '2026-04-06 09:21:27'),
(429, 213, 'C', '1120', '2026-04-06 09:21:27', '2026-04-06 09:21:27'),
(430, 213, 'D', '1100', '2026-04-06 09:21:27', '2026-04-06 09:21:27'),
(431, 214, 'A', '433', '2026-04-06 09:21:27', '2026-04-06 09:21:27'),
(432, 214, 'B', '434', '2026-04-06 09:21:27', '2026-04-06 09:21:27'),
(433, 214, 'C', '432', '2026-04-06 09:21:27', '2026-04-06 09:21:27'),
(434, 214, 'D', '431', '2026-04-06 09:21:27', '2026-04-06 09:21:27'),
(435, 215, 'A', '790', '2026-04-06 09:21:27', '2026-04-06 09:21:27'),
(436, 215, 'B', '800', '2026-04-06 09:21:27', '2026-04-06 09:21:27'),
(437, 215, 'C', '810', '2026-04-06 09:21:27', '2026-04-06 09:21:27'),
(438, 215, 'D', '780', '2026-04-06 09:21:27', '2026-04-06 09:21:27'),
(439, 216, 'A', '216', '2026-04-06 09:21:27', '2026-04-06 09:21:27'),
(440, 216, 'B', '218', '2026-04-06 09:21:27', '2026-04-06 09:21:27'),
(441, 216, 'C', '214', '2026-04-06 09:21:27', '2026-04-06 09:21:27'),
(442, 216, 'D', '220', '2026-04-06 09:21:27', '2026-04-06 09:21:27'),
(443, 217, 'A', '1380', '2026-04-06 09:21:27', '2026-04-06 09:21:27'),
(444, 217, 'B', '1340', '2026-04-06 09:21:27', '2026-04-06 09:21:27'),
(445, 217, 'C', '1320', '2026-04-06 09:21:27', '2026-04-06 09:21:27'),
(446, 217, 'D', '1300', '2026-04-06 09:21:27', '2026-04-06 09:21:27'),
(447, 218, 'A', '1054', '2026-04-06 09:21:27', '2026-04-06 09:21:27'),
(448, 218, 'B', '1053', '2026-04-06 09:21:27', '2026-04-06 09:21:27'),
(449, 218, 'C', '1052', '2026-04-06 09:21:27', '2026-04-06 09:21:27'),
(450, 218, 'D', '1051', '2026-04-06 09:21:27', '2026-04-06 09:21:27'),
(451, 219, 'A', '490', '2026-04-06 09:21:28', '2026-04-06 09:21:28'),
(452, 219, 'B', '500', '2026-04-06 09:21:28', '2026-04-06 09:21:28'),
(453, 219, 'C', '510', '2026-04-06 09:21:28', '2026-04-06 09:21:28'),
(454, 219, 'D', '480', '2026-04-06 09:21:28', '2026-04-06 09:21:28'),
(455, 220, 'A', '1701', '2026-04-06 09:21:28', '2026-04-06 09:21:28'),
(456, 220, 'B', '1710', '2026-04-06 09:21:28', '2026-04-06 09:21:28'),
(457, 220, 'C', '1720', '2026-04-06 09:21:28', '2026-04-06 09:21:28'),
(458, 220, 'D', '1690', '2026-04-06 09:21:28', '2026-04-06 09:21:28'),
(459, 221, 'A', '534', '2026-04-06 09:21:28', '2026-04-06 09:21:28'),
(460, 221, 'B', '535', '2026-04-06 09:21:28', '2026-04-06 09:21:28'),
(461, 221, 'C', '536', '2026-04-06 09:21:28', '2026-04-06 09:21:28'),
(462, 221, 'D', '533', '2026-04-06 09:21:28', '2026-04-06 09:21:28'),
(463, 222, 'A', 'Scant', '2026-04-06 09:22:38', '2026-04-06 09:22:38'),
(464, 222, 'B', 'Plentiful', '2026-04-06 09:22:38', '2026-04-06 09:22:38'),
(465, 222, 'C', 'Sparse', '2026-04-06 09:22:38', '2026-04-06 09:22:38'),
(466, 222, 'D', 'Scarce', '2026-04-06 09:22:38', '2026-04-06 09:22:38'),
(467, 224, 'A', 'Fearless', '2026-04-06 09:22:38', '2026-04-06 09:22:38'),
(468, 224, 'B', 'Cowardly', '2026-04-06 09:22:38', '2026-04-06 09:22:38'),
(469, 224, 'C', 'Valiant', '2026-04-06 09:22:38', '2026-04-06 09:22:38'),
(470, 224, 'D', 'Daring', '2026-04-06 09:22:38', '2026-04-06 09:22:38'),
(471, 226, 'A', 'Dull', '2026-04-06 09:22:38', '2026-04-06 09:22:38'),
(472, 226, 'B', 'Bright', '2026-04-06 09:22:38', '2026-04-06 09:22:38'),
(473, 226, 'C', 'Pale', '2026-04-06 09:22:38', '2026-04-06 09:22:38'),
(474, 226, 'D', 'Gloomy', '2026-04-06 09:22:38', '2026-04-06 09:22:38'),
(475, 228, 'A', 'Stingy', '2026-04-06 09:22:38', '2026-04-06 09:22:38'),
(476, 228, 'B', 'Benevolent', '2026-04-06 09:22:38', '2026-04-06 09:22:38'),
(477, 228, 'C', 'Liberal', '2026-04-06 09:22:38', '2026-04-06 09:22:38'),
(478, 228, 'D', 'Altruistic', '2026-04-06 09:22:38', '2026-04-06 09:22:38'),
(479, 230, 'A', 'Confused', '2026-04-06 09:22:38', '2026-04-06 09:22:38'),
(480, 230, 'B', 'Enthralled', '2026-04-06 09:22:38', '2026-04-06 09:22:38'),
(481, 230, 'C', 'Clear', '2026-04-06 09:22:38', '2026-04-06 09:22:38'),
(482, 230, 'D', 'Certain', '2026-04-06 09:22:38', '2026-04-06 09:22:38'),
(483, 232, 'A', 'Hacking', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(484, 232, 'B', 'Cyberbullying', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(485, 232, 'C', 'Cyberstalking', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(486, 232, 'D', 'Phishing', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(487, 233, 'A', 'It reduces pollution', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(488, 233, 'B', 'It has no effect on the environment', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(489, 233, 'C', 'It can cause pollution and resource depletion', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(490, 233, 'D', 'It helps in conservation efforts', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(491, 234, 'A', 'Plagiarism', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(492, 234, 'B', 'Encryption', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(493, 234, 'C', 'Firewall', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(494, 234, 'D', 'Hacking', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(495, 235, 'A', 'It improves face-to-face interactions', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(496, 235, 'B', 'It reduces misunderstandings', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(497, 235, 'C', 'It can lead to miscommunication and social isolation', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(498, 235, 'D', 'It enhances empathy', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(499, 236, 'A', 'Technophobia', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(500, 236, 'B', 'Technophilia', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(501, 236, 'C', 'Cyberphobia', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(502, 236, 'D', 'Technolust', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(503, 237, 'A', 'By reducing access to information', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(504, 237, 'B', 'By limiting collaboration among students', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(505, 237, 'C', 'By providing online resources and interactive learning tools', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(506, 237, 'D', 'By discouraging creativity', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(507, 238, 'A', 'Social engineering', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(508, 238, 'B', 'Cyberbullying', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(509, 238, 'C', 'Astroturfing', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(510, 238, 'D', 'Phishing', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(511, 239, 'A', 'It creates more job opportunities for everyone', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(512, 239, 'B', 'It reduces the need for human workers in certain industries', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(513, 239, 'C', 'It has no effect on job opportunities', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(514, 239, 'D', 'It guarantees job security for all workers', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(515, 240, 'A', 'Cyberbullying', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(516, 240, 'B', 'Cyberstalking', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(517, 240, 'C', 'Surveillance', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(518, 240, 'D', 'Phishing', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(519, 241, 'A', 'It strengthens interpersonal connections', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(520, 241, 'B', 'It encourages face-to-face interactions', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(521, 241, 'C', 'It can lead to social isolation and reduced empathy', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(522, 241, 'D', 'It promotes healthy communication habits', '2026-04-06 09:24:03', '2026-04-06 09:24:03'),
(523, 242, 'A', 'Make laws', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(524, 242, 'B', 'Enforce laws', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(525, 242, 'C', 'Interpret laws', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(526, 242, 'D', 'Review laws', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(527, 243, 'A', 'President', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(528, 243, 'B', 'Judge', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(529, 243, 'C', 'Senator', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(530, 243, 'D', 'Mayor', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(531, 244, 'A', 'Executive branch', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(532, 244, 'B', 'Legislative branch', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(533, 244, 'C', 'Judicial branch', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(534, 244, 'D', 'Administrative branch', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(535, 245, 'A', 'Enforce laws', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(536, 245, 'B', 'Interpret laws', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(537, 245, 'C', 'Make laws', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(538, 245, 'D', 'Review laws', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(539, 246, 'A', 'President', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(540, 246, 'B', 'Judge', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(541, 246, 'C', 'Congress', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(542, 246, 'D', 'Supreme Court', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(543, 247, 'A', 'Executive branch', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(544, 247, 'B', 'Legislative branch', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(545, 247, 'C', 'Judicial branch', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(546, 247, 'D', 'Administrative branch', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(547, 248, 'A', 'Make laws', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(548, 248, 'B', 'Enforce laws', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(549, 248, 'C', 'Interpret laws', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(550, 248, 'D', 'Review laws', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(551, 249, 'A', 'Executive branch', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(552, 249, 'B', 'Legislative branch', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(553, 249, 'C', 'Judicial branch', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(554, 249, 'D', 'Administrative branch', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(555, 250, 'A', 'President', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(556, 250, 'B', 'Judge', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(557, 250, 'C', 'Senator', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(558, 250, 'D', 'Mayor', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(559, 251, 'A', 'Executive branch', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(560, 251, 'B', 'Legislative branch', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(561, 251, 'C', 'Judicial branch', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(562, 251, 'D', 'Administrative branch', '2026-04-06 09:26:24', '2026-04-06 09:26:24'),
(563, 253, 'A', '2.5', '2026-04-06 09:27:40', '2026-04-06 09:27:40'),
(564, 253, 'B', '0', '2026-04-06 09:27:40', '2026-04-06 09:27:40'),
(565, 253, 'C', '1/2', '2026-04-06 09:27:40', '2026-04-06 09:27:40'),
(566, 253, 'D', '-3', '2026-04-06 09:27:40', '2026-04-06 09:27:40'),
(567, 255, 'A', '0', '2026-04-06 09:27:40', '2026-04-06 09:27:40'),
(568, 255, 'B', '1', '2026-04-06 09:27:40', '2026-04-06 09:27:40'),
(569, 255, 'C', '2', '2026-04-06 09:27:40', '2026-04-06 09:27:40'),
(570, 255, 'D', '-1', '2026-04-06 09:27:40', '2026-04-06 09:27:40'),
(571, 257, 'A', '7', '2026-04-06 09:27:40', '2026-04-06 09:27:40'),
(572, 257, 'B', '0', '2026-04-06 09:27:40', '2026-04-06 09:27:40'),
(573, 257, 'C', '-3', '2026-04-06 09:27:40', '2026-04-06 09:27:40'),
(574, 257, 'D', '2.5', '2026-04-06 09:27:40', '2026-04-06 09:27:40'),
(575, 259, 'A', '1000', '2026-04-06 09:27:40', '2026-04-06 09:27:40'),
(576, 259, 'B', '999', '2026-04-06 09:27:40', '2026-04-06 09:27:40'),
(577, 259, 'C', '1001', '2026-04-06 09:27:40', '2026-04-06 09:27:40'),
(578, 259, 'D', '0', '2026-04-06 09:27:40', '2026-04-06 09:27:40'),
(579, 261, 'A', '0', '2026-04-06 09:27:40', '2026-04-06 09:27:40'),
(580, 261, 'B', '2', '2026-04-06 09:27:40', '2026-04-06 09:27:40'),
(581, 261, 'C', '1', '2026-04-06 09:27:40', '2026-04-06 09:27:40'),
(582, 261, 'D', '-3', '2026-04-06 09:27:40', '2026-04-06 09:27:40'),
(583, 262, 'A', 'Adjective', '2026-04-06 09:28:50', '2026-04-06 09:28:50'),
(584, 262, 'B', 'Adverb', '2026-04-06 09:28:50', '2026-04-06 09:28:50'),
(585, 262, 'C', 'Noun', '2026-04-06 09:28:50', '2026-04-06 09:28:50'),
(586, 262, 'D', 'Verb', '2026-04-06 09:28:50', '2026-04-06 09:28:50'),
(587, 263, 'A', 'Noun', '2026-04-06 09:28:50', '2026-04-06 09:28:50'),
(588, 263, 'B', 'Adverb', '2026-04-06 09:28:50', '2026-04-06 09:28:50'),
(589, 263, 'C', 'Verb', '2026-04-06 09:28:50', '2026-04-06 09:28:50'),
(590, 263, 'D', 'Adjective', '2026-04-06 09:28:50', '2026-04-06 09:28:50'),
(591, 264, 'A', 'Adjective', '2026-04-06 09:28:50', '2026-04-06 09:28:50'),
(592, 264, 'B', 'Noun', '2026-04-06 09:28:50', '2026-04-06 09:28:50'),
(593, 264, 'C', 'Verb', '2026-04-06 09:28:50', '2026-04-06 09:28:50'),
(594, 264, 'D', 'Adverb', '2026-04-06 09:28:50', '2026-04-06 09:28:50'),
(595, 265, 'A', 'Preposition', '2026-04-06 09:28:50', '2026-04-06 09:28:50'),
(596, 265, 'B', 'Conjunction', '2026-04-06 09:28:50', '2026-04-06 09:28:50'),
(597, 265, 'C', 'Adverb', '2026-04-06 09:28:50', '2026-04-06 09:28:50'),
(598, 265, 'D', 'Verb', '2026-04-06 09:28:50', '2026-04-06 09:28:50'),
(599, 266, 'A', 'Noun', '2026-04-06 09:28:50', '2026-04-06 09:28:50'),
(600, 266, 'B', 'Adjective', '2026-04-06 09:28:50', '2026-04-06 09:28:50'),
(601, 266, 'C', 'Adverb', '2026-04-06 09:28:50', '2026-04-06 09:28:50'),
(602, 266, 'D', 'Verb', '2026-04-06 09:28:50', '2026-04-06 09:28:50'),
(603, 267, 'A', 'Adjective', '2026-04-06 09:28:50', '2026-04-06 09:28:50'),
(604, 267, 'B', 'Noun', '2026-04-06 09:28:50', '2026-04-06 09:28:50'),
(605, 267, 'C', 'Adverb', '2026-04-06 09:28:50', '2026-04-06 09:28:50'),
(606, 267, 'D', 'Verb', '2026-04-06 09:28:50', '2026-04-06 09:28:50'),
(607, 268, 'A', 'Adjective', '2026-04-06 09:28:51', '2026-04-06 09:28:51'),
(608, 268, 'B', 'Noun', '2026-04-06 09:28:51', '2026-04-06 09:28:51'),
(609, 268, 'C', 'Adverb', '2026-04-06 09:28:51', '2026-04-06 09:28:51'),
(610, 268, 'D', 'Verb', '2026-04-06 09:28:51', '2026-04-06 09:28:51'),
(611, 269, 'A', 'Noun', '2026-04-06 09:28:51', '2026-04-06 09:28:51'),
(612, 269, 'B', 'Adjective', '2026-04-06 09:28:51', '2026-04-06 09:28:51'),
(613, 269, 'C', 'Adverb', '2026-04-06 09:28:51', '2026-04-06 09:28:51'),
(614, 269, 'D', 'Verb', '2026-04-06 09:28:51', '2026-04-06 09:28:51'),
(615, 270, 'A', 'Noun', '2026-04-06 09:28:51', '2026-04-06 09:28:51'),
(616, 270, 'B', 'Verb', '2026-04-06 09:28:51', '2026-04-06 09:28:51'),
(617, 270, 'C', 'Adjective', '2026-04-06 09:28:51', '2026-04-06 09:28:51'),
(618, 270, 'D', 'Adverb', '2026-04-06 09:28:51', '2026-04-06 09:28:51'),
(619, 271, 'A', 'Preposition', '2026-04-06 09:28:51', '2026-04-06 09:28:51'),
(620, 271, 'B', 'Conjunction', '2026-04-06 09:28:51', '2026-04-06 09:28:51'),
(621, 271, 'C', 'Adverb', '2026-04-06 09:28:51', '2026-04-06 09:28:51'),
(622, 271, 'D', 'Verb', '2026-04-06 09:28:51', '2026-04-06 09:28:51'),
(623, 273, 'A', 'Growth', '2026-04-06 09:30:17', '2026-04-06 09:30:17'),
(624, 273, 'B', 'Reproduction', '2026-04-06 09:30:17', '2026-04-06 09:30:17'),
(625, 273, 'C', 'Magnetism', '2026-04-06 09:30:17', '2026-04-06 09:30:17'),
(626, 273, 'D', 'Response to stimuli', '2026-04-06 09:30:17', '2026-04-06 09:30:17'),
(627, 275, 'A', 'Fish', '2026-04-06 09:30:17', '2026-04-06 09:30:17'),
(628, 275, 'B', 'Worm', '2026-04-06 09:30:17', '2026-04-06 09:30:17'),
(629, 275, 'C', 'Spider', '2026-04-06 09:30:17', '2026-04-06 09:30:17'),
(630, 275, 'D', 'Ant', '2026-04-06 09:30:17', '2026-04-06 09:30:17'),
(631, 277, 'A', 'Dog', '2026-04-06 09:30:17', '2026-04-06 09:30:17'),
(632, 277, 'B', 'Tree', '2026-04-06 09:30:17', '2026-04-06 09:30:17'),
(633, 277, 'C', 'Rock', '2026-04-06 09:30:17', '2026-04-06 09:30:17'),
(634, 277, 'D', 'Bird', '2026-04-06 09:30:17', '2026-04-06 09:30:17'),
(635, 279, 'A', 'Leaf', '2026-04-06 09:30:17', '2026-04-06 09:30:17'),
(636, 279, 'B', 'Root', '2026-04-06 09:30:17', '2026-04-06 09:30:17'),
(637, 279, 'C', 'Beak', '2026-04-06 09:30:17', '2026-04-06 09:30:17'),
(638, 279, 'D', 'Stem', '2026-04-06 09:30:17', '2026-04-06 09:30:17'),
(639, 281, 'A', 'Reproduction', '2026-04-06 09:30:17', '2026-04-06 09:30:17'),
(640, 281, 'B', 'Thermometer', '2026-04-06 09:30:17', '2026-04-06 09:30:17'),
(641, 281, 'C', 'Chair', '2026-04-06 09:30:17', '2026-04-06 09:30:17'),
(642, 281, 'D', 'Book', '2026-04-06 09:30:17', '2026-04-06 09:30:17'),
(643, 282, 'A', 'Household', '2026-04-06 09:32:24', '2026-04-06 09:32:24'),
(644, 282, 'B', 'Community', '2026-04-06 09:32:24', '2026-04-06 09:32:24'),
(645, 282, 'C', 'Village', '2026-04-06 09:32:24', '2026-04-06 09:32:24'),
(646, 282, 'D', 'Society', '2026-04-06 09:32:24', '2026-04-06 09:32:24'),
(647, 283, 'A', 'Monogamy', '2026-04-06 09:32:24', '2026-04-06 09:32:24'),
(648, 283, 'B', 'Polyandry', '2026-04-06 09:32:24', '2026-04-06 09:32:24'),
(649, 283, 'C', 'Polygamy', '2026-04-06 09:32:24', '2026-04-06 09:32:24'),
(650, 283, 'D', 'Unemployment', '2026-04-06 09:32:24', '2026-04-06 09:32:24'),
(651, 284, 'A', 'Procreation', '2026-04-06 09:32:24', '2026-04-06 09:32:24'),
(652, 284, 'B', 'Entertainment', '2026-04-06 09:32:24', '2026-04-06 09:32:24'),
(653, 284, 'C', 'Friendship', '2026-04-06 09:32:24', '2026-04-06 09:32:24'),
(654, 284, 'D', 'Education', '2026-04-06 09:32:24', '2026-04-06 09:32:24'),
(655, 285, 'A', 'Parents', '2026-04-06 09:32:24', '2026-04-06 09:32:24'),
(656, 285, 'B', 'Teachers', '2026-04-06 09:32:24', '2026-04-06 09:32:24'),
(657, 285, 'C', 'Government', '2026-04-06 09:32:24', '2026-04-06 09:32:24'),
(658, 285, 'D', 'Neighbors', '2026-04-06 09:32:24', '2026-04-06 09:32:24'),
(659, 286, 'A', 'Two', '2026-04-06 09:32:24', '2026-04-06 09:32:24'),
(660, 286, 'B', 'Three', '2026-04-06 09:32:24', '2026-04-06 09:32:24'),
(661, 286, 'C', 'Four', '2026-04-06 09:32:24', '2026-04-06 09:32:24'),
(662, 286, 'D', 'Five', '2026-04-06 09:32:24', '2026-04-06 09:32:24'),
(663, 293, 'A', 'Resistor', '2026-04-06 09:34:06', '2026-04-06 09:34:06'),
(664, 293, 'B', 'Capacitor', '2026-04-06 09:34:06', '2026-04-06 09:34:06'),
(665, 293, 'C', 'Transistor', '2026-04-06 09:34:06', '2026-04-06 09:34:06'),
(666, 293, 'D', 'Inductor', '2026-04-06 09:34:06', '2026-04-06 09:34:06'),
(667, 295, 'A', 'Diode', '2026-04-06 09:34:06', '2026-04-06 09:34:06'),
(668, 295, 'B', 'Capacitor', '2026-04-06 09:34:06', '2026-04-06 09:34:06'),
(669, 295, 'C', 'Transistor', '2026-04-06 09:34:06', '2026-04-06 09:34:06'),
(670, 295, 'D', 'Resistor', '2026-04-06 09:34:06', '2026-04-06 09:34:06'),
(671, 297, 'A', 'Resistor', '2026-04-06 09:34:06', '2026-04-06 09:34:06'),
(672, 297, 'B', 'Capacitor', '2026-04-06 09:34:06', '2026-04-06 09:34:06'),
(673, 297, 'C', 'Diode', '2026-04-06 09:34:06', '2026-04-06 09:34:06'),
(674, 297, 'D', 'Transistor', '2026-04-06 09:34:06', '2026-04-06 09:34:06'),
(675, 299, 'A', 'Insulator', '2026-04-06 09:34:06', '2026-04-06 09:34:06'),
(676, 299, 'B', 'Conductor', '2026-04-06 09:34:06', '2026-04-06 09:34:06'),
(677, 299, 'C', 'Resistor', '2026-04-06 09:34:06', '2026-04-06 09:34:06'),
(678, 299, 'D', 'Capacitor', '2026-04-06 09:34:06', '2026-04-06 09:34:06'),
(679, 301, 'A', 'Resistor', '2026-04-06 09:34:06', '2026-04-06 09:34:06'),
(680, 301, 'B', 'Capacitor', '2026-04-06 09:34:06', '2026-04-06 09:34:06'),
(681, 301, 'C', 'Diode', '2026-04-06 09:34:06', '2026-04-06 09:34:06'),
(682, 301, 'D', 'Varistor', '2026-04-06 09:34:06', '2026-04-06 09:34:06'),
(683, 305, 'A', '2x + 3', '2026-04-06 09:36:12', '2026-04-06 09:36:12'),
(684, 305, 'B', '2x', '2026-04-06 09:36:12', '2026-04-06 09:36:12'),
(685, 305, 'C', '3x + 1', '2026-04-06 09:36:12', '2026-04-06 09:36:12');
INSERT INTO `options` (`id`, `question_id`, `option_label`, `option_text`, `created_at`, `updated_at`) VALUES
(686, 305, 'D', '6x + 9', '2026-04-06 09:36:12', '2026-04-06 09:36:12'),
(687, 310, 'A', '2x + 3', '2026-04-06 09:36:12', '2026-04-06 09:36:12'),
(688, 310, 'B', '2x', '2026-04-06 09:36:12', '2026-04-06 09:36:12'),
(689, 310, 'C', '3x + 1', '2026-04-06 09:36:12', '2026-04-06 09:36:12'),
(690, 310, 'D', '10x + 15', '2026-04-06 09:36:12', '2026-04-06 09:36:12'),
(691, 313, 'A', 'Simile', '2026-04-06 09:39:07', '2026-04-06 09:39:07'),
(692, 313, 'B', 'Metaphor', '2026-04-06 09:39:07', '2026-04-06 09:39:07'),
(693, 313, 'C', 'Oxymoron', '2026-04-06 09:39:07', '2026-04-06 09:39:07'),
(694, 313, 'D', 'Hyperbole', '2026-04-06 09:39:07', '2026-04-06 09:39:07'),
(695, 316, 'A', 'Personification', '2026-04-06 09:39:07', '2026-04-06 09:39:07'),
(696, 316, 'B', 'Simile', '2026-04-06 09:39:07', '2026-04-06 09:39:07'),
(697, 316, 'C', 'Metaphor', '2026-04-06 09:39:07', '2026-04-06 09:39:07'),
(698, 316, 'D', 'Alliteration', '2026-04-06 09:39:07', '2026-04-06 09:39:07'),
(699, 318, 'A', 'Personification', '2026-04-06 09:39:07', '2026-04-06 09:39:07'),
(700, 318, 'B', 'Simile', '2026-04-06 09:39:07', '2026-04-06 09:39:07'),
(701, 318, 'C', 'Metaphor', '2026-04-06 09:39:07', '2026-04-06 09:39:07'),
(702, 318, 'D', 'Hyperbole', '2026-04-06 09:39:07', '2026-04-06 09:39:07'),
(703, 321, 'A', 'Personification', '2026-04-06 09:39:07', '2026-04-06 09:39:07'),
(704, 321, 'B', 'Simile', '2026-04-06 09:39:07', '2026-04-06 09:39:07'),
(705, 321, 'C', 'Metaphor', '2026-04-06 09:39:07', '2026-04-06 09:39:07'),
(706, 321, 'D', 'Hyperbole', '2026-04-06 09:39:07', '2026-04-06 09:39:07'),
(707, 332, 'A', 'going', '2026-04-06 09:44:19', '2026-04-06 09:44:19'),
(708, 332, 'B', 'went', '2026-04-06 09:44:19', '2026-04-06 09:44:19'),
(709, 332, 'C', 'gone', '2026-04-06 09:44:19', '2026-04-06 09:44:19'),
(710, 332, 'D', 'goed', '2026-04-06 09:44:19', '2026-04-06 09:44:19'),
(711, 334, 'A', 'He buy a new car.', '2026-04-06 09:44:19', '2026-04-06 09:44:19'),
(712, 334, 'B', 'He buys a new car.', '2026-04-06 09:44:19', '2026-04-06 09:44:19'),
(713, 334, 'C', 'He bought a new car.', '2026-04-06 09:44:19', '2026-04-06 09:44:19'),
(714, 334, 'D', 'He buying a new car.', '2026-04-06 09:44:19', '2026-04-06 09:44:19'),
(715, 335, 'A', 'He don\'t eat.', '2026-04-06 09:44:19', '2026-04-06 09:44:19'),
(716, 335, 'B', 'He didn\'t eat.', '2026-04-06 09:44:19', '2026-04-06 09:44:19'),
(717, 335, 'C', 'He eated.', '2026-04-06 09:44:19', '2026-04-06 09:44:19'),
(718, 335, 'D', 'He not eating.', '2026-04-06 09:44:19', '2026-04-06 09:44:19'),
(719, 337, 'A', 'She writed a letter.', '2026-04-06 09:44:19', '2026-04-06 09:44:19'),
(720, 337, 'B', 'She written a letter.', '2026-04-06 09:44:19', '2026-04-06 09:44:19'),
(721, 337, 'C', 'She wrote a letter.', '2026-04-06 09:44:19', '2026-04-06 09:44:19'),
(722, 337, 'D', 'She writing a letter.', '2026-04-06 09:44:19', '2026-04-06 09:44:19'),
(723, 338, 'A', 'sleeping', '2026-04-06 09:44:19', '2026-04-06 09:44:19'),
(724, 338, 'B', 'slept', '2026-04-06 09:44:19', '2026-04-06 09:44:19'),
(725, 338, 'C', 'sleeped', '2026-04-06 09:44:19', '2026-04-06 09:44:19'),
(726, 338, 'D', 'sleaping', '2026-04-06 09:44:19', '2026-04-06 09:44:19'),
(727, 340, 'A', 'They buy a new book.', '2026-04-06 09:44:19', '2026-04-06 09:44:19'),
(728, 340, 'B', 'They bought a new book.', '2026-04-06 09:44:19', '2026-04-06 09:44:19'),
(729, 340, 'C', 'They buying a new book.', '2026-04-06 09:44:19', '2026-04-06 09:44:19'),
(730, 340, 'D', 'They buyed a new book.', '2026-04-06 09:44:19', '2026-04-06 09:44:19'),
(731, 343, 'A', '{1, 2, 3, 4}', '2026-04-06 09:46:03', '2026-04-06 09:46:03'),
(732, 343, 'B', '{2, 3}', '2026-04-06 09:46:03', '2026-04-06 09:46:03'),
(733, 343, 'C', '{2}', '2026-04-06 09:46:03', '2026-04-06 09:46:03'),
(734, 343, 'D', '{3}', '2026-04-06 09:46:03', '2026-04-06 09:46:03'),
(735, 345, 'A', '{a, b, c, d, e}', '2026-04-06 09:46:03', '2026-04-06 09:46:03'),
(736, 345, 'B', '{a, b, c}', '2026-04-06 09:46:03', '2026-04-06 09:46:03'),
(737, 345, 'C', '{c, d, e}', '2026-04-06 09:46:03', '2026-04-06 09:46:03'),
(738, 345, 'D', '{a, b}', '2026-04-06 09:46:03', '2026-04-06 09:46:03'),
(739, 347, 'A', '{1, 2}', '2026-04-06 09:46:03', '2026-04-06 09:46:03'),
(740, 347, 'B', '{3, 4}', '2026-04-06 09:46:03', '2026-04-06 09:46:03'),
(741, 347, 'C', '{5, 6}', '2026-04-06 09:46:03', '2026-04-06 09:46:03'),
(742, 347, 'D', '{1, 2, 5, 6}', '2026-04-06 09:46:03', '2026-04-06 09:46:03'),
(743, 349, 'A', '{apple, banana, pineapple, mango}', '2026-04-06 09:46:03', '2026-04-06 09:46:03'),
(744, 349, 'B', '{apple, banana}', '2026-04-06 09:46:03', '2026-04-06 09:46:03'),
(745, 349, 'C', '{orange}', '2026-04-06 09:46:03', '2026-04-06 09:46:03'),
(746, 349, 'D', '{pineapple, mango}', '2026-04-06 09:46:03', '2026-04-06 09:46:03'),
(747, 351, 'A', '{a}', '2026-04-06 09:46:03', '2026-04-06 09:46:03'),
(748, 351, 'B', '{e}', '2026-04-06 09:46:03', '2026-04-06 09:46:03'),
(749, 351, 'C', '{a, b, c, d, e}', '2026-04-06 09:46:03', '2026-04-06 09:46:03'),
(750, 351, 'D', '{a, e}', '2026-04-06 09:46:03', '2026-04-06 09:46:03'),
(751, 352, 'A', 'Declarative', '2026-04-06 09:47:25', '2026-04-06 09:47:25'),
(752, 352, 'B', 'Interrogative', '2026-04-06 09:47:25', '2026-04-06 09:47:25'),
(753, 352, 'C', 'Imperative', '2026-04-06 09:47:25', '2026-04-06 09:47:25'),
(754, 352, 'D', 'Exclamatory', '2026-04-06 09:47:25', '2026-04-06 09:47:25'),
(755, 354, 'A', 'He went to the store.', '2026-04-06 09:47:25', '2026-04-06 09:47:25'),
(756, 354, 'B', 'She likes tea and coffee.', '2026-04-06 09:47:25', '2026-04-06 09:47:25'),
(757, 354, 'C', 'The cat meowed.', '2026-04-06 09:47:25', '2026-04-06 09:47:25'),
(758, 354, 'D', 'I will finish my homework.', '2026-04-06 09:47:25', '2026-04-06 09:47:25'),
(759, 355, 'A', 'dog', '2026-04-06 09:47:25', '2026-04-06 09:47:25'),
(760, 355, 'B', 'barked', '2026-04-06 09:47:25', '2026-04-06 09:47:25'),
(761, 355, 'C', 'loudly', '2026-04-06 09:47:25', '2026-04-06 09:47:25'),
(762, 355, 'D', 'The', '2026-04-06 09:47:25', '2026-04-06 09:47:25'),
(763, 357, 'A', 'The teacher teaches the students.', '2026-04-06 09:47:25', '2026-04-06 09:47:25'),
(764, 357, 'B', 'The cake was baked by Mary.', '2026-04-06 09:47:25', '2026-04-06 09:47:25'),
(765, 357, 'C', 'She sings beautifully.', '2026-04-06 09:47:25', '2026-04-06 09:47:25'),
(766, 357, 'D', 'We will watch a movie.', '2026-04-06 09:47:25', '2026-04-06 09:47:25'),
(767, 358, 'A', 'park', '2026-04-06 09:47:25', '2026-04-06 09:47:25'),
(768, 358, 'B', 'go', '2026-04-06 09:47:25', '2026-04-06 09:47:25'),
(769, 358, 'C', 'if', '2026-04-06 09:47:25', '2026-04-06 09:47:25'),
(770, 358, 'D', 'raining', '2026-04-06 09:47:25', '2026-04-06 09:47:25'),
(771, 360, 'A', 'She danced all night.', '2026-04-06 09:47:25', '2026-04-06 09:47:25'),
(772, 360, 'B', 'He ate lunch and went for a walk.', '2026-04-06 09:47:25', '2026-04-06 09:47:25'),
(773, 360, 'C', 'Although it was raining, they went outside.', '2026-04-06 09:47:25', '2026-04-06 09:47:25'),
(774, 360, 'D', 'The cat slept peacefully.', '2026-04-06 09:47:25', '2026-04-06 09:47:25'),
(775, 361, 'A', 'Wow', '2026-04-06 09:47:25', '2026-04-06 09:47:25'),
(776, 361, 'B', 'That', '2026-04-06 09:47:25', '2026-04-06 09:47:25'),
(777, 361, 'C', 'was', '2026-04-06 09:47:25', '2026-04-06 09:47:25'),
(778, 361, 'D', 'amazing', '2026-04-06 09:47:25', '2026-04-06 09:47:25'),
(779, 362, 'A', 'Velocity', '2026-04-06 09:48:30', '2026-04-06 09:48:30'),
(780, 362, 'B', 'Acceleration', '2026-04-06 09:48:30', '2026-04-06 09:48:30'),
(781, 362, 'C', 'Distance', '2026-04-06 09:48:30', '2026-04-06 09:48:30'),
(782, 362, 'D', 'Force', '2026-04-06 09:48:30', '2026-04-06 09:48:30'),
(783, 364, 'A', 'A steeply increasing line', '2026-04-06 09:48:30', '2026-04-06 09:48:30'),
(784, 364, 'B', 'A straight horizontal line', '2026-04-06 09:48:30', '2026-04-06 09:48:30'),
(785, 364, 'C', 'A curved line', '2026-04-06 09:48:30', '2026-04-06 09:48:30'),
(786, 364, 'D', 'A steeply decreasing line', '2026-04-06 09:48:30', '2026-04-06 09:48:30'),
(787, 366, 'A', 'm/s', '2026-04-06 09:48:30', '2026-04-06 09:48:30'),
(788, 366, 'B', 'm/s²', '2026-04-06 09:48:30', '2026-04-06 09:48:30'),
(789, 366, 'C', 'm/s³', '2026-04-06 09:48:30', '2026-04-06 09:48:30'),
(790, 366, 'D', 'm²/s', '2026-04-06 09:48:30', '2026-04-06 09:48:30'),
(791, 368, 'A', 'A car speeding up', '2026-04-06 09:48:30', '2026-04-06 09:48:30'),
(792, 368, 'B', 'A rocket launching', '2026-04-06 09:48:30', '2026-04-06 09:48:30'),
(793, 368, 'C', 'A car braking', '2026-04-06 09:48:30', '2026-04-06 09:48:30'),
(794, 368, 'D', 'An object in free fall', '2026-04-06 09:48:30', '2026-04-06 09:48:30'),
(795, 369, 'A', 'Speed = distance / time', '2026-04-06 09:48:30', '2026-04-06 09:48:30'),
(796, 369, 'B', 'Speed = time / distance', '2026-04-06 09:48:30', '2026-04-06 09:48:30'),
(797, 369, 'C', 'Speed = distance * time', '2026-04-06 09:48:30', '2026-04-06 09:48:30'),
(798, 369, 'D', 'Speed = time + distance', '2026-04-06 09:48:30', '2026-04-06 09:48:30'),
(799, 371, 'A', 'Speed', '2026-04-06 09:48:30', '2026-04-06 09:48:30'),
(800, 371, 'B', 'Time', '2026-04-06 09:48:30', '2026-04-06 09:48:30'),
(801, 371, 'C', 'Displacement', '2026-04-06 09:48:30', '2026-04-06 09:48:30'),
(802, 371, 'D', 'Mass', '2026-04-06 09:48:30', '2026-04-06 09:48:30'),
(803, 372, 'A', 'Solid', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(804, 372, 'B', 'Liquid', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(805, 372, 'C', 'Gas', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(806, 372, 'D', 'Plasma', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(807, 373, 'A', 'Sublimation', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(808, 373, 'B', 'Condensation', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(809, 373, 'C', 'Evaporation', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(810, 373, 'D', 'Melting', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(811, 374, 'A', 'Melting ice', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(812, 374, 'B', 'Boiling water', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(813, 374, 'C', 'Burning paper', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(814, 374, 'D', 'Mixing salt and sugar', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(815, 375, 'A', 'Kilogram', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(816, 375, 'B', 'Gram', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(817, 375, 'C', 'Pound', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(818, 375, 'D', 'Ounce', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(819, 376, 'A', 'Saltwater', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(820, 376, 'B', 'Air', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(821, 376, 'C', 'Sand and iron filings', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(822, 376, 'D', 'Sugar dissolved in water', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(823, 377, 'A', 'Increases', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(824, 377, 'B', 'Decreases', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(825, 377, 'C', 'Remains constant', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(826, 377, 'D', 'Depends on the substance', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(827, 378, 'A', 'Flammability', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(828, 378, 'B', 'Color', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(829, 378, 'C', 'Reactivity', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(830, 378, 'D', 'Toxicity', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(831, 379, 'A', '0°C', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(832, 379, 'B', '100°C', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(833, 379, 'C', '273°C', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(834, 379, 'D', '373°C', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(835, 380, 'A', 'Proton', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(836, 380, 'B', 'Neutron', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(837, 380, 'C', 'Electron', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(838, 380, 'D', 'Photon', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(839, 381, 'A', 'Ag', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(840, 381, 'B', 'Au', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(841, 381, 'C', 'Hg', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(842, 381, 'D', 'Fe', '2026-04-06 09:49:35', '2026-04-06 09:49:35'),
(843, 387, 'A', 'Growth', '2026-04-07 10:45:13', '2026-04-07 10:45:13'),
(844, 387, 'B', 'Reproduction', '2026-04-07 10:45:13', '2026-04-07 10:45:13'),
(845, 387, 'C', 'Decomposition', '2026-04-07 10:45:13', '2026-04-07 10:45:13'),
(846, 387, 'D', 'Photosynthesis', '2026-04-07 10:45:13', '2026-04-07 10:45:13'),
(847, 390, 'A', 'Ability to move', '2026-04-07 10:45:14', '2026-04-07 10:45:14'),
(848, 390, 'B', 'Ability to respire', '2026-04-07 10:45:14', '2026-04-07 10:45:14'),
(849, 390, 'C', 'Ability to digest food', '2026-04-07 10:45:14', '2026-04-07 10:45:14'),
(850, 390, 'D', 'Ability to think', '2026-04-07 10:45:14', '2026-04-07 10:45:14'),
(851, 392, 'A', 'Dog', '2026-04-07 10:45:14', '2026-04-07 10:45:14'),
(852, 392, 'B', 'Human', '2026-04-07 10:45:14', '2026-04-07 10:45:14'),
(853, 392, 'C', 'Amoeba', '2026-04-07 10:45:14', '2026-04-07 10:45:14'),
(854, 392, 'D', 'Elephant', '2026-04-07 10:45:14', '2026-04-07 10:45:14'),
(855, 394, 'A', 'Ribosome', '2026-04-07 10:45:14', '2026-04-07 10:45:14'),
(856, 394, 'B', 'Mitochondria', '2026-04-07 10:45:14', '2026-04-07 10:45:14'),
(857, 394, 'C', 'DNA', '2026-04-07 10:45:14', '2026-04-07 10:45:14'),
(858, 394, 'D', 'Endoplasmic reticulum', '2026-04-07 10:45:14', '2026-04-07 10:45:14'),
(859, 396, 'A', 'Animalia', '2026-04-07 10:45:14', '2026-04-07 10:45:14'),
(860, 396, 'B', 'Plantae', '2026-04-07 10:45:14', '2026-04-07 10:45:14'),
(861, 396, 'C', 'Mineralia', '2026-04-07 10:45:14', '2026-04-07 10:45:14'),
(862, 396, 'D', 'Fungi', '2026-04-07 10:45:14', '2026-04-07 10:45:14'),
(863, 407, 'A', 'Ampere', '2026-04-07 10:50:57', '2026-04-07 10:50:57'),
(864, 407, 'B', 'Volt', '2026-04-07 10:50:57', '2026-04-07 10:50:57'),
(865, 407, 'C', 'Ohm', '2026-04-07 10:50:57', '2026-04-07 10:50:57'),
(866, 407, 'D', 'Watt', '2026-04-07 10:50:57', '2026-04-07 10:50:57'),
(867, 410, 'A', 'Rubber', '2026-04-07 10:50:57', '2026-04-07 10:50:57'),
(868, 410, 'B', 'Wood', '2026-04-07 10:50:57', '2026-04-07 10:50:57'),
(869, 410, 'C', 'Copper', '2026-04-07 10:50:57', '2026-04-07 10:50:57'),
(870, 410, 'D', 'Glass', '2026-04-07 10:50:57', '2026-04-07 10:50:57'),
(871, 411, 'A', 'It doubles', '2026-04-07 10:50:57', '2026-04-07 10:50:57'),
(872, 411, 'B', 'It becomes half', '2026-04-07 10:50:57', '2026-04-07 10:50:57'),
(873, 411, 'C', 'It quadruples', '2026-04-07 10:50:57', '2026-04-07 10:50:57'),
(874, 411, 'D', 'It remains the same', '2026-04-07 10:50:57', '2026-04-07 10:50:57'),
(875, 412, 'A', 'To increase resistance', '2026-04-07 10:50:57', '2026-04-07 10:50:57'),
(876, 412, 'B', 'To regulate voltage', '2026-04-07 10:50:57', '2026-04-07 10:50:57'),
(877, 412, 'C', 'To protect against overcurrent', '2026-04-07 10:50:57', '2026-04-07 10:50:57'),
(878, 412, 'D', 'To amplify current', '2026-04-07 10:50:57', '2026-04-07 10:50:57'),
(879, 414, 'A', 'Parallel circuit', '2026-04-07 10:50:57', '2026-04-07 10:50:57'),
(880, 414, 'B', 'Series circuit', '2026-04-07 10:50:57', '2026-04-07 10:50:57'),
(881, 414, 'C', 'Mixed circuit', '2026-04-07 10:50:57', '2026-04-07 10:50:57'),
(882, 414, 'D', 'Complex circuit', '2026-04-07 10:50:57', '2026-04-07 10:50:57'),
(883, 415, 'A', 'Increases resistance', '2026-04-07 10:50:57', '2026-04-07 10:50:57'),
(884, 415, 'B', 'Decreases resistance', '2026-04-07 10:50:57', '2026-04-07 10:50:57'),
(885, 415, 'C', 'No effect on resistance', '2026-04-07 10:50:57', '2026-04-07 10:50:57'),
(886, 415, 'D', 'Changes conductor material', '2026-04-07 10:50:57', '2026-04-07 10:50:57'),
(887, 416, 'A', 'Density', '2026-04-07 10:50:57', '2026-04-07 10:50:57'),
(888, 416, 'B', 'Temperature', '2026-04-07 10:50:57', '2026-04-07 10:50:57'),
(889, 416, 'C', 'Atomic structure', '2026-04-07 10:50:57', '2026-04-07 10:50:57'),
(890, 416, 'D', 'Color', '2026-04-07 10:50:57', '2026-04-07 10:50:57'),
(891, 417, 'A', 'Carbonyl group', '2026-04-07 10:52:54', '2026-04-07 10:52:54'),
(892, 417, 'B', 'Hydroxyl group', '2026-04-07 10:52:54', '2026-04-07 10:52:54'),
(893, 417, 'C', 'Amino group', '2026-04-07 10:52:54', '2026-04-07 10:52:54'),
(894, 417, 'D', 'Ester group', '2026-04-07 10:52:54', '2026-04-07 10:52:54'),
(895, 418, 'A', 'CnH2n', '2026-04-07 10:52:54', '2026-04-07 10:52:54'),
(896, 418, 'B', 'CnH2n+2', '2026-04-07 10:52:54', '2026-04-07 10:52:54'),
(897, 418, 'C', 'CnHn', '2026-04-07 10:52:54', '2026-04-07 10:52:54'),
(898, 418, 'D', 'CnHn+2', '2026-04-07 10:52:54', '2026-04-07 10:52:54'),
(899, 419, 'A', 'Ethanol', '2026-04-07 10:52:54', '2026-04-07 10:52:54'),
(900, 419, 'B', 'Propanol', '2026-04-07 10:52:54', '2026-04-07 10:52:54'),
(901, 419, 'C', 'Isobutanol', '2026-04-07 10:52:54', '2026-04-07 10:52:54'),
(902, 419, 'D', 'Methanol', '2026-04-07 10:52:54', '2026-04-07 10:52:54'),
(903, 421, 'A', 'Ketone group', '2026-04-07 10:52:54', '2026-04-07 10:52:54'),
(904, 421, 'B', 'Aldehyde group', '2026-04-07 10:52:54', '2026-04-07 10:52:54'),
(905, 421, 'C', 'Carboxyl group', '2026-04-07 10:52:54', '2026-04-07 10:52:54'),
(906, 421, 'D', 'Ester group', '2026-04-07 10:52:54', '2026-04-07 10:52:54'),
(907, 423, 'A', 'Hydrogenation', '2026-04-07 10:52:54', '2026-04-07 10:52:54'),
(908, 423, 'B', 'Oxidation', '2026-04-07 10:52:54', '2026-04-07 10:52:54'),
(909, 423, 'C', 'Hydration', '2026-04-07 10:52:54', '2026-04-07 10:52:54'),
(910, 423, 'D', 'Esterification', '2026-04-07 10:52:54', '2026-04-07 10:52:54'),
(911, 424, 'A', 'Ketone group', '2026-04-07 10:52:54', '2026-04-07 10:52:54'),
(912, 424, 'B', 'Alcohol group', '2026-04-07 10:52:54', '2026-04-07 10:52:54'),
(913, 424, 'C', 'Aldehyde group', '2026-04-07 10:52:54', '2026-04-07 10:52:54'),
(914, 424, 'D', 'Ester group', '2026-04-07 10:52:54', '2026-04-07 10:52:54'),
(915, 426, 'A', 'Methanol', '2026-04-07 10:52:54', '2026-04-07 10:52:54'),
(916, 426, 'B', 'Propanol', '2026-04-07 10:52:54', '2026-04-07 10:52:54'),
(917, 426, 'C', 'Isobutanol', '2026-04-07 10:52:54', '2026-04-07 10:52:54'),
(918, 426, 'D', 'Isopropanol', '2026-04-07 10:52:54', '2026-04-07 10:52:54'),
(919, 427, 'A', 'Mutualism', '2026-04-07 10:54:20', '2026-04-07 10:54:20'),
(920, 427, 'B', 'Commensalism', '2026-04-07 10:54:20', '2026-04-07 10:54:20'),
(921, 427, 'C', 'Parasitism', '2026-04-07 10:54:20', '2026-04-07 10:54:20'),
(922, 427, 'D', 'Competition', '2026-04-07 10:54:20', '2026-04-07 10:54:20'),
(923, 428, 'A', 'A group of individuals of the same species living together', '2026-04-07 10:54:20', '2026-04-07 10:54:20'),
(924, 428, 'B', 'All the biotic and abiotic factors in a given area', '2026-04-07 10:54:20', '2026-04-07 10:54:20'),
(925, 428, 'C', 'The process by which organisms produce offspring', '2026-04-07 10:54:20', '2026-04-07 10:54:20'),
(926, 428, 'D', 'A community of organisms interacting with each other', '2026-04-07 10:54:20', '2026-04-07 10:54:20'),
(927, 429, 'A', 'Grass', '2026-04-07 10:54:20', '2026-04-07 10:54:20'),
(928, 429, 'B', 'Hawk', '2026-04-07 10:54:20', '2026-04-07 10:54:20'),
(929, 429, 'C', 'Snake', '2026-04-07 10:54:20', '2026-04-07 10:54:20'),
(930, 429, 'D', 'Rabbit', '2026-04-07 10:54:20', '2026-04-07 10:54:20'),
(931, 431, 'A', 'Tropical Rainforest', '2026-04-07 10:54:21', '2026-04-07 10:54:21'),
(932, 431, 'B', 'Desert', '2026-04-07 10:54:21', '2026-04-07 10:54:21'),
(933, 431, 'C', 'Tundra', '2026-04-07 10:54:21', '2026-04-07 10:54:21'),
(934, 431, 'D', 'Grassland', '2026-04-07 10:54:21', '2026-04-07 10:54:21'),
(935, 433, 'A', 'Mining', '2026-04-07 10:54:21', '2026-04-07 10:54:21'),
(936, 433, 'B', 'Fishing', '2026-04-07 10:54:21', '2026-04-07 10:54:21'),
(937, 433, 'C', 'Agriculture', '2026-04-07 10:54:21', '2026-04-07 10:54:21'),
(938, 433, 'D', 'Wind energy production', '2026-04-07 10:54:21', '2026-04-07 10:54:21'),
(939, 435, 'A', 'Temperature', '2026-04-07 10:54:21', '2026-04-07 10:54:21'),
(940, 435, 'B', 'Water', '2026-04-07 10:54:21', '2026-04-07 10:54:21'),
(941, 435, 'C', 'Sunlight', '2026-04-07 10:54:21', '2026-04-07 10:54:21'),
(942, 435, 'D', 'Fungi', '2026-04-07 10:54:21', '2026-04-07 10:54:21');

-- --------------------------------------------------------

--
-- Table structure for table `passages`
--

CREATE TABLE `passages` (
  `id` bigint NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `class_level_id` int DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_method` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metadata` json DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `amount`, `reference`, `transaction_id`, `status`, `payment_method`, `metadata`, `paid_at`, `created_at`, `updated_at`) VALUES
(25, 6, 1500.00, 'PAY-svcadoNV-1777013556', '6071657847', 'success', 'Paystack', '\"{\\\"payment_type\\\":\\\"email_subscription\\\"}\"', '2026-04-24 05:52:51', '2026-04-24 05:52:36', '2026-04-24 05:52:51');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint NOT NULL,
  `subject_id` bigint DEFAULT NULL,
  `topic_id` int DEFAULT NULL,
  `class_level_id` int DEFAULT NULL,
  `passage_id` bigint DEFAULT NULL,
  `exam_cat_id` bigint DEFAULT NULL,
  `question_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `question_text` text,
  `difficulty` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `year` year DEFAULT NULL,
  `time_limit` int DEFAULT '30',
  `correct_answer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `expected_answer` varchar(255) DEFAULT NULL,
  `explanation` text,
  `created_by` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `school_id` bigint DEFAULT NULL,
  `source` enum('internal','external','ai_generated') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'internal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `subject_id`, `topic_id`, `class_level_id`, `passage_id`, `exam_cat_id`, `question_type`, `question_text`, `difficulty`, `year`, `time_limit`, `correct_answer`, `expected_answer`, `explanation`, `created_by`, `created_at`, `updated_at`, `school_id`, `source`) VALUES
(1, 3, 34, 2, NULL, NULL, 'objective', 'Which sentence is in the future tense?', 'medium', NULL, 30, 'B', NULL, 'The sentence \'She will bake a cake tomorrow.\' is in the future tense as \'will bake\' indicates a future action.', 5, '2026-04-24 20:45:00', '2026-04-24 20:45:00', 2, 'internal'),
(2, 3, 34, 2, NULL, NULL, 'fill_in_the_gap', 'Complete the sentence: I __________ my homework after dinner.', 'medium', NULL, 30, 'will do', NULL, 'The correct answer is \'will do\' as it indicates a future action.', 5, '2026-04-24 20:45:01', '2026-04-24 20:45:01', 2, 'internal'),
(3, 3, 34, 2, NULL, NULL, 'objective', 'What is the future tense of \'eat\'?', 'medium', NULL, 30, 'D', NULL, 'The future tense of \'eat\' is \'will eat\'.', 5, '2026-04-24 20:45:01', '2026-04-24 20:45:01', 2, 'internal'),
(4, 3, 34, 2, NULL, NULL, 'objective', 'Which sentence is in the past tense?', 'medium', NULL, 30, 'C', NULL, 'The sentence \'He danced at the party.\' is in the past tense as \'danced\' indicates a past action.', 5, '2026-04-24 20:45:01', '2026-04-24 20:45:01', 2, 'internal'),
(5, 3, 34, 2, NULL, NULL, 'objective', 'What is the past tense of \'run\'?', 'medium', NULL, 30, 'C', NULL, 'The past tense of \'run\' is \'ran\'.', 5, '2026-04-24 20:45:01', '2026-04-24 20:45:01', 2, 'internal'),
(6, 3, 34, 2, NULL, NULL, 'fill_in_the_gap', 'Fill in the gap: Sarah __________ to the zoo last weekend.', 'medium', NULL, 30, 'went', NULL, 'The correct answer is \'went\' as it is the past form of \'go\'.', 5, '2026-04-24 20:45:01', '2026-04-24 20:45:01', 2, 'internal'),
(7, 3, 34, 2, NULL, NULL, 'fill_in_the_gap', 'Complete the sentence: They __________ to the beach next weekend.', 'medium', NULL, 30, 'will go', NULL, 'The correct answer is \'will go\' as it indicates a future action.', 5, '2026-04-24 20:45:01', '2026-04-24 20:45:01', 2, 'internal'),
(8, 3, 34, 2, NULL, NULL, 'objective', 'Which sentence is in the present tense?', 'medium', NULL, 30, 'C', NULL, 'The sentence \'He plays football every Saturday.\' is in the present tense as \'plays\' indicates a habitual action.', 5, '2026-04-24 20:45:01', '2026-04-24 20:45:01', 2, 'internal'),
(9, 3, 34, 2, NULL, NULL, 'fill_in_the_gap', 'Fill in the gap: The cat __________ on the roof yesterday.', 'medium', NULL, 30, 'was', NULL, 'The correct answer is \'was\' as it is the past form of \'is\'.', 5, '2026-04-24 20:45:01', '2026-04-24 20:45:01', 2, 'internal'),
(10, 1, 22, 2, NULL, NULL, 'objective', 'Which number is both a multiple of 4 and 5?', 'medium', NULL, 30, 'D', NULL, 'Find the common multiples of 4 and 5.', 5, '2026-04-24 20:46:41', '2026-04-24 20:46:41', 2, 'internal'),
(11, 1, 22, 2, NULL, NULL, 'objective', 'Which is the largest prime number between 100 and 110?', 'medium', NULL, 30, 'D', NULL, 'Prime numbers are numbers greater than 1 and divisible only by 1 and themselves.', 5, '2026-04-24 20:46:41', '2026-04-24 20:46:41', 2, 'internal'),
(12, 1, 22, 2, NULL, NULL, 'objective', 'Which is the smallest prime number between 1 and 10?', 'medium', NULL, 30, 'C', NULL, 'Prime numbers are numbers greater than 1 and divisible only by 1 and themselves.', 5, '2026-04-24 20:46:41', '2026-04-24 20:46:41', 2, 'internal'),
(13, 1, 22, 2, NULL, NULL, 'fill_in_the_gap', 'What is the product of 6 and 9?', 'medium', NULL, 30, '54', NULL, 'To find the product of two numbers, multiply them together.', 5, '2026-04-24 20:46:41', '2026-04-24 20:46:41', 2, 'internal'),
(14, 1, 22, 2, NULL, NULL, 'fill_in_the_gap', 'What is the sum of the digits in the number 456?', 'medium', NULL, 30, '15', NULL, 'Add the individual digits: 4 + 5 + 6 = 15.', 5, '2026-04-24 20:46:41', '2026-04-24 20:46:41', 2, 'internal'),
(15, 1, 22, 2, NULL, NULL, 'objective', 'Which whole number comes just before 200?', 'medium', NULL, 30, 'A', NULL, 'To find the number before a given number, subtract 1.', 5, '2026-04-24 20:46:41', '2026-04-24 20:46:41', 2, 'internal'),
(16, 1, 22, 2, NULL, NULL, 'fill_in_the_gap', 'What is the sum of the first 100 whole numbers?', 'medium', NULL, 30, '5050', NULL, 'The sum of the first n natural numbers is given by n*(n+1)/2. Here, n=100.', 5, '2026-04-24 20:46:41', '2026-04-24 20:46:41', 2, 'internal'),
(17, 1, 22, 2, NULL, NULL, 'objective', 'Which is the smallest even number between 50 and 60?', 'medium', NULL, 30, 'B', NULL, 'Even numbers are divisible by 2.', 5, '2026-04-24 20:46:41', '2026-04-24 20:46:41', 2, 'internal'),
(18, 1, 22, 2, NULL, NULL, 'fill_in_the_gap', 'What is the next multiple of 8 after 72?', 'medium', NULL, 30, '80', NULL, 'To find the next multiple of a number, keep adding the number itself.', 5, '2026-04-24 20:46:41', '2026-04-24 20:46:41', 2, 'internal'),
(19, 1, 22, 2, NULL, NULL, 'fill_in_the_gap', 'What is the factor of 35?', 'medium', NULL, 30, '5', NULL, 'Factors are numbers that divide a given number exactly.', 5, '2026-04-24 20:46:41', '2026-04-24 20:46:41', 2, 'internal');

-- --------------------------------------------------------

--
-- Table structure for table `question_banks`
--

CREATE TABLE `question_banks` (
  `id` bigint NOT NULL,
  `subject_id` bigint DEFAULT NULL,
  `topic_id` int DEFAULT NULL,
  `class_level_id` int DEFAULT NULL,
  `passage_id` bigint DEFAULT NULL,
  `exam_cat_id` bigint DEFAULT NULL,
  `question_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `question_text` text,
  `difficulty` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `year` year DEFAULT NULL,
  `time_limit` int DEFAULT '30',
  `correct_answer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `expected_answer` varchar(255) DEFAULT NULL,
  `explanation` text,
  `created_by` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `school_id` bigint DEFAULT NULL,
  `source` enum('internal','external','ai_generated') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'internal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `question_banks`
--

INSERT INTO `question_banks` (`id`, `subject_id`, `topic_id`, `class_level_id`, `passage_id`, `exam_cat_id`, `question_type`, `question_text`, `difficulty`, `year`, `time_limit`, `correct_answer`, `expected_answer`, `explanation`, `created_by`, `created_at`, `updated_at`, `school_id`, `source`) VALUES
(11, 3, 302, 10, NULL, NULL, 'objective', 'Choose the correct sentence with proper grammar:', 'medium', NULL, 30, 'D', NULL, 'The correct sentence is \'I don\'t eat meat.\' The subject \'I\' matches with \'don\'t\' in the negative form.', 73, '2026-03-30 12:02:46', '2026-03-30 12:02:46', 7, 'ai_generated'),
(12, 3, 302, 10, NULL, NULL, 'fill_in_the_gap', 'Fill in the blank with the correct verb form: We _____ to the beach last weekend.', 'medium', NULL, 30, 'went', NULL, 'The correct answer is \'went\'. The past form of the verb \'go\' is \'went\'.', 73, '2026-03-30 12:02:47', '2026-03-30 12:02:47', 7, 'ai_generated'),
(13, 3, 302, 10, NULL, NULL, 'objective', 'Identify the sentence with the correct use of a semicolon:', 'medium', NULL, 30, 'B', NULL, 'The correct sentence is \'He cooked dinner; then he cleaned the kitchen.\' Semicolons can be used to join two closely related independent clauses.', 73, '2026-03-30 12:02:47', '2026-03-30 12:02:47', 7, 'ai_generated'),
(14, 3, 302, 10, NULL, NULL, 'objective', 'Which of the following sentences uses correct subject-verb agreement?', 'hard', NULL, 30, 'A', NULL, 'In this sentence, \'team\' is a singular subject, so the verb \'plays\' should also be singular to maintain subject-verb agreement.', 73, '2026-03-30 13:30:19', '2026-03-30 13:30:19', 7, 'ai_generated'),
(15, 3, 302, 10, NULL, NULL, 'objective', 'Identify the sentence with the correct use of parallel structure:', 'hard', NULL, 30, 'B', NULL, 'Parallel structure requires that the items in a list be in the same form. In this case, \'hiking, swimming, and running\' maintain parallel structure.', 73, '2026-03-30 13:30:19', '2026-03-30 13:30:19', 7, 'ai_generated'),
(16, 3, 302, 10, NULL, NULL, 'objective', 'Choose the correct verb form that agrees with the subject: The team ________ to the championship last year.', 'medium', NULL, 30, 'C', NULL, 'The subject \'team\' is singular and past tense, so \'won\' is the correct verb form that agrees with the subject.', 7, '2026-03-30 14:46:26', '2026-03-30 14:46:26', NULL, 'ai_generated'),
(17, 3, 302, 10, NULL, NULL, 'fill_in_the_gap', 'Fill in the gap with the correct pronoun: Each of the students should submit ________ assignment on time.', 'medium', NULL, 30, 'his or her', NULL, 'When referring to \'each student\', the pronoun \'his or her\' is used to show singular possession without specifying gender.', 7, '2026-03-30 14:46:26', '2026-03-30 14:46:26', NULL, 'ai_generated'),
(18, 3, 302, 10, NULL, NULL, 'objective', 'Select the sentence that demonstrates subject-verb agreement: A) The book on the table is mine. B) The books on the table are mine.', 'medium', NULL, 30, 'A', NULL, 'In sentence A, \'book\' matches with \'is\' (singular), showing proper subject-verb agreement. Sentence B has a plural subject \'books\' but uses a singular verb \'are\', which is incorrect.', 7, '2026-03-30 14:46:26', '2026-03-30 14:46:26', NULL, 'ai_generated'),
(19, 3, 302, 10, NULL, NULL, 'objective', 'Choose the correct verb form to complete the sentence: The group of students _______ going on a field trip.', 'hard', NULL, 30, 'B', NULL, 'The subject \'group\' is singular, but the phrase \'of students\' makes it plural, hence \'are\' is correct.', 7, '2026-03-30 14:55:52', '2026-03-30 14:55:52', NULL, 'ai_generated'),
(20, 3, 302, 10, NULL, NULL, 'fill_in_the_gap', 'Fill in the gap with the correct form of the verb: Neither the teacher nor the students _______ satisfied with the exam results.', 'hard', NULL, 30, 'is', NULL, 'The verb agrees with the closest subject \'teacher\', so \'is\' is the correct form.', 7, '2026-03-30 14:55:52', '2026-03-30 14:55:52', NULL, 'ai_generated'),
(21, 3, 203, 10, NULL, NULL, 'objective', 'Select the option that shows the correct subject-verb agreement: Each of the boys _______ a book.', 'hard', NULL, 30, 'B', NULL, 'When \'each\' is used as the subject, it is always singular, hence \'has\' is correct.', 7, '2026-03-30 14:55:52', '2026-03-30 14:55:52', NULL, 'ai_generated'),
(22, 3, 203, 10, NULL, NULL, 'objective', 'Which sentence shows the correct subject-verb agreement? A) The team of players play well. B) The team of players plays well.', 'hard', NULL, 30, 'B', NULL, 'The subject \'team\' is singular, so \'plays\' should be used for agreement.', 7, '2026-03-30 14:55:52', '2026-03-30 14:55:52', NULL, 'ai_generated'),
(23, 3, 203, 10, NULL, NULL, 'fill_in_the_gap', 'Complete the sentence with the correct verb form: My aunt, along with her friends, _______ planning a surprise party.', 'hard', NULL, 30, 'is', NULL, 'The verb agrees with the closest subject \'aunt\', so \'is\' is the correct form.', 7, '2026-03-30 14:55:52', '2026-03-30 14:55:52', NULL, 'ai_generated'),
(24, 3, 203, 10, NULL, NULL, 'objective', 'Identify the sentence with the correct subject-verb agreement: A) The pair of shoes is under the bed. B) The pair of shoes are under the bed.', 'hard', NULL, 30, 'A', NULL, 'The subject \'pair\' is singular, so \'is\' should be used for agreement.', 7, '2026-03-30 14:55:52', '2026-03-30 14:55:52', NULL, 'ai_generated'),
(25, 3, 203, 10, NULL, NULL, 'objective', 'Choose the correct verb form to complete the sentence: Neither the boys nor the girls _______ ready for the excursion.', 'hard', NULL, 30, 'B', NULL, 'The verb agrees with the closest subject \'girls\', so \'are\' is the correct form.', 7, '2026-03-30 14:55:52', '2026-03-30 14:55:52', NULL, 'ai_generated'),
(26, 3, 203, 10, NULL, NULL, 'fill_in_the_gap', 'Fill in the gap with the appropriate verb form: The committee _______ decided on the new rules.', 'hard', NULL, 30, 'has', NULL, 'The subject \'committee\' is singular, so \'has\' is the correct form.', 7, '2026-03-30 14:55:52', '2026-03-30 14:55:52', NULL, 'ai_generated'),
(27, 3, 203, 10, NULL, NULL, 'objective', 'Select the sentence with the correct subject-verb agreement: A) The herd of cows is grazing in the field. B) The herd of cows are grazing in the field.', 'hard', NULL, 30, 'A', NULL, 'The subject \'herd\' is singular, so \'is\' should be used for agreement.', 7, '2026-03-30 14:55:52', '2026-03-30 14:55:52', NULL, 'ai_generated'),
(28, 3, 203, 10, NULL, NULL, 'fill_in_the_gap', 'Complete the sentence with the correct verb form: My sister, along with her friends, _______ going to the concert.', 'hard', NULL, 30, 'is', NULL, 'The verb agrees with the closest subject \'sister\', so \'is\' is the correct form.', 7, '2026-03-30 14:55:52', '2026-03-30 14:55:52', NULL, 'ai_generated'),
(29, 3, 203, 10, NULL, NULL, 'objective', 'Choose the sentence that demonstrates correct subject-verb agreement: A) The group of students is studying for the exam. B) The group of students are studying for the exam.', 'hard', NULL, 30, 'A', NULL, 'The subject \'group\' is singular, so \'is\' should be used for agreement.', 7, '2026-03-30 14:55:52', '2026-03-30 14:55:52', NULL, 'ai_generated'),
(30, 3, 203, 10, NULL, NULL, 'objective', 'Select the sentence that illustrates the correct subject-verb agreement: A) The set of keys is on the table. B) The set of keys are on the table.', 'hard', NULL, 30, 'A', NULL, 'The subject \'set\' is singular, so \'is\' should be used for agreement.', 7, '2026-03-30 14:55:52', '2026-03-30 14:55:52', NULL, 'ai_generated'),
(56, 3, 294, 10, NULL, NULL, 'objective', 'Identify the sentence that contains an example of alliteration.', 'hard', NULL, 30, 'B', NULL, 'Option B \'Peter Piper picked a peck of pickled peppers\' is an example of alliteration where the same sound is repeated at the beginning of neighboring words.', 7, '2026-04-04 16:37:29', '2026-04-04 16:37:29', NULL, 'ai_generated'),
(57, 3, 294, 10, NULL, NULL, 'fill_in_the_gap', 'Fill in the gap: The _______ of the novel was unexpected and left the readers in awe.', 'hard', NULL, 30, 'climax', NULL, 'The climax of a novel refers to the highest point of tension or turning point in the story.', 7, '2026-04-04 16:37:29', '2026-04-04 16:37:29', NULL, 'ai_generated'),
(63, 1, 2, 1, NULL, NULL, 'objective', 'Which number comes before 25?', 'medium', NULL, 30, 'B', NULL, 'The number before 25 is 24.', 7, '2026-04-05 12:22:23', '2026-04-05 12:22:23', NULL, 'ai_generated'),
(64, 1, 2, 1, NULL, NULL, 'fill_in_the_gap', 'Fill in the gap: 50 + 20 = ___.', 'medium', NULL, 30, '70', NULL, 'When you add 50 and 20, you get 70.', 7, '2026-04-05 12:22:23', '2026-04-05 12:22:23', NULL, 'ai_generated'),
(65, 1, 2, 1, NULL, NULL, 'objective', 'What is the successor of 67?', 'medium', NULL, 30, 'B', NULL, 'Successor means the number that comes next. In this case, 67 + 1 = 68.', 7, '2026-04-05 12:25:29', '2026-04-05 12:25:29', NULL, 'ai_generated'),
(66, 1, 2, 1, NULL, NULL, 'objective', 'Which number comes just before 50?', 'medium', NULL, 30, 'B', NULL, 'To find the number just before, subtract 1 from 50: 50 - 1 = 49.', 7, '2026-04-05 12:25:29', '2026-04-05 12:25:29', NULL, 'ai_generated'),
(67, 1, 2, 1, NULL, NULL, 'fill_in_the_gap', 'Fill in the gap: 56 + __ = 63', 'medium', NULL, 30, '7', NULL, 'To find the missing number, subtract 56 from 63: 63 - 56 = 7.', 7, '2026-04-05 12:25:29', '2026-04-05 12:25:29', NULL, 'ai_generated'),
(68, 1, 2, 1, NULL, NULL, 'objective', 'Which is the smallest number among 31, 47, 25, 39?', 'medium', NULL, 30, 'C', NULL, 'Compare the given numbers to find the smallest one, which is 25.', 7, '2026-04-05 12:25:29', '2026-04-05 12:25:29', NULL, 'ai_generated'),
(69, 1, 2, 1, NULL, NULL, 'objective', 'What is the sum of 45 and 28?', 'medium', NULL, 30, 'B', NULL, 'Simply add the two numbers: 45 + 28 = 73.', 7, '2026-04-05 12:25:29', '2026-04-05 12:25:29', NULL, 'ai_generated'),
(70, 1, 2, 1, NULL, NULL, 'objective', 'Which number is greater: 56 or 65?', 'medium', NULL, 30, 'B', NULL, 'Compare the two numbers to find that 65 is greater than 56.', 7, '2026-04-05 12:25:29', '2026-04-05 12:25:29', NULL, 'ai_generated'),
(71, 1, 2, 1, NULL, NULL, 'objective', 'What is the missing number: 34, 36, __, 40?', 'medium', NULL, 30, 'B', NULL, 'The missing number is 37, which comes between 36 and 40.', 7, '2026-04-05 12:25:29', '2026-04-05 12:25:29', NULL, 'ai_generated'),
(72, 1, 2, 1, NULL, NULL, 'objective', 'Which is the largest number among 12, 45, 32, 28?', 'medium', NULL, 30, 'B', NULL, 'Compare the given numbers to find the largest one, which is 45.', 7, '2026-04-05 12:25:30', '2026-04-05 12:25:30', NULL, 'ai_generated'),
(73, 1, 2, 1, NULL, NULL, 'fill_in_the_gap', 'Fill in the gap: 22 + __ = 100', 'medium', NULL, 30, '78', NULL, 'To find the missing number, subtract 22 from 100: 100 - 22 = 78.', 7, '2026-04-05 12:25:30', '2026-04-05 12:25:30', NULL, 'ai_generated'),
(74, 1, 2, 1, NULL, NULL, 'objective', 'What is the predecessor of 89?', 'medium', NULL, 30, 'A', NULL, 'Predecessor means the number that comes before. In this case, 89 - 1 = 88.', 7, '2026-04-05 12:25:30', '2026-04-05 12:25:30', NULL, 'ai_generated'),
(75, 1, 2, 1, NULL, NULL, 'objective', 'Which number comes just after 77?', 'medium', NULL, 30, 'C', NULL, 'To find the number just after, add 1 to 77: 77 + 1 = 78.', 7, '2026-04-05 12:25:30', '2026-04-05 12:25:30', NULL, 'ai_generated'),
(76, 1, 2, 1, NULL, NULL, 'fill_in_the_gap', 'Fill in the gap: 15 + __ = 30', 'medium', NULL, 30, '15', NULL, 'To find the missing number, subtract 15 from 30: 30 - 15 = 15.', 7, '2026-04-05 12:25:30', '2026-04-05 12:25:30', NULL, 'ai_generated'),
(77, 1, 2, 1, NULL, NULL, 'objective', 'Which is the smallest number among 63, 49, 52, 77?', 'medium', NULL, 30, 'B', NULL, 'Compare the given numbers to find the smallest one, which is 49.', 7, '2026-04-05 12:25:30', '2026-04-05 12:25:30', NULL, 'ai_generated'),
(78, 1, 2, 1, NULL, NULL, 'objective', 'What is the sum of 33 and 45?', 'medium', NULL, 30, 'B', NULL, 'Simply add the two numbers: 33 + 45 = 78.', 7, '2026-04-05 12:25:30', '2026-04-05 12:25:30', NULL, 'ai_generated'),
(79, 1, 2, 1, NULL, NULL, 'objective', 'Which number is greater: 58 or 85?', 'medium', NULL, 30, 'B', NULL, 'Compare the two numbers to find that 85 is greater than 58.', 7, '2026-04-05 12:25:30', '2026-04-05 12:25:30', NULL, 'ai_generated'),
(80, 1, 2, 1, NULL, NULL, 'objective', 'What is the missing number: 41, 43, __, 47?', 'medium', NULL, 30, 'B', NULL, 'The missing number is 44, which comes between 43 and 47.', 7, '2026-04-05 12:25:30', '2026-04-05 12:25:30', NULL, 'ai_generated'),
(81, 1, 2, 1, NULL, NULL, 'objective', 'Which is the largest number among 29, 56, 41, 68?', 'medium', NULL, 30, 'D', NULL, 'Compare the given numbers to find the largest one, which is 68.', 7, '2026-04-05 12:25:30', '2026-04-05 12:25:30', NULL, 'ai_generated'),
(82, 1, 2, 1, NULL, NULL, 'fill_in_the_gap', 'Fill in the gap: 19 + __ = 100', 'medium', NULL, 30, '81', NULL, 'To find the missing number, subtract 19 from 100: 100 - 19 = 81.', 7, '2026-04-05 12:25:30', '2026-04-05 12:25:30', NULL, 'ai_generated'),
(83, 1, 22, 2, NULL, NULL, 'fill_in_the_gap', 'What is the sum of the first 100 whole numbers?', 'medium', NULL, 30, '5050', NULL, 'The sum of the first n natural numbers is given by n*(n+1)/2. Here, n=100.', 7, '2026-04-05 12:28:58', '2026-04-05 12:28:58', NULL, 'ai_generated'),
(84, 1, 22, 2, NULL, NULL, 'objective', 'Which is the smallest prime number between 1 and 10?', 'medium', NULL, 30, 'C', NULL, 'Prime numbers are numbers greater than 1 and divisible only by 1 and themselves.', 7, '2026-04-05 12:28:58', '2026-04-05 12:28:58', NULL, 'ai_generated'),
(85, 1, 22, 2, NULL, NULL, 'fill_in_the_gap', 'What is the next multiple of 8 after 72?', 'medium', NULL, 30, '80', NULL, 'To find the next multiple of a number, keep adding the number itself.', 7, '2026-04-05 12:28:58', '2026-04-05 12:28:58', NULL, 'ai_generated'),
(86, 1, 22, 2, NULL, NULL, 'objective', 'Which whole number comes just before 200?', 'medium', NULL, 30, 'A', NULL, 'To find the number before a given number, subtract 1.', 7, '2026-04-05 12:28:58', '2026-04-05 12:28:58', NULL, 'ai_generated'),
(87, 1, 22, 2, NULL, NULL, 'fill_in_the_gap', 'What is the sum of the digits in the number 456?', 'medium', NULL, 30, '15', NULL, 'Add the individual digits: 4 + 5 + 6 = 15.', 7, '2026-04-05 12:28:58', '2026-04-05 12:28:58', NULL, 'ai_generated'),
(88, 1, 22, 2, NULL, NULL, 'objective', 'Which is the smallest even number between 50 and 60?', 'medium', NULL, 30, 'B', NULL, 'Even numbers are divisible by 2.', 7, '2026-04-05 12:28:58', '2026-04-05 12:28:58', NULL, 'ai_generated'),
(89, 1, 22, 2, NULL, NULL, 'fill_in_the_gap', 'What is the factor of 35?', 'medium', NULL, 30, '5', NULL, 'Factors are numbers that divide a given number exactly.', 7, '2026-04-05 12:28:58', '2026-04-05 12:28:58', NULL, 'ai_generated'),
(90, 1, 22, 2, NULL, NULL, 'objective', 'Which is the largest prime number between 100 and 110?', 'medium', NULL, 30, 'D', NULL, 'Prime numbers are numbers greater than 1 and divisible only by 1 and themselves.', 7, '2026-04-05 12:28:58', '2026-04-05 12:28:58', NULL, 'ai_generated'),
(91, 1, 22, 2, NULL, NULL, 'fill_in_the_gap', 'What is the product of 6 and 9?', 'medium', NULL, 30, '54', NULL, 'To find the product of two numbers, multiply them together.', 7, '2026-04-05 12:28:58', '2026-04-05 12:28:58', NULL, 'ai_generated'),
(92, 1, 22, 2, NULL, NULL, 'objective', 'Which number is both a multiple of 4 and 5?', 'medium', NULL, 30, 'D', NULL, 'Find the common multiples of 4 and 5.', 7, '2026-04-05 12:28:58', '2026-04-05 12:28:58', NULL, 'ai_generated'),
(93, 3, 16, 1, NULL, NULL, 'objective', 'What is a person who flies an airplane called?', 'medium', NULL, 30, 'A', NULL, NULL, 7, '2026-04-05 12:31:06', '2026-04-05 12:31:06', NULL, 'ai_generated'),
(94, 3, 16, 1, NULL, NULL, 'objective', 'Which of the following is a type of vehicle?', 'medium', NULL, 30, 'A', NULL, NULL, 7, '2026-04-05 12:31:06', '2026-04-05 12:31:06', NULL, 'ai_generated'),
(95, 3, 16, 1, NULL, NULL, 'fill_in_the_gap', 'Where do students go to study and learn?', 'medium', NULL, 30, 'school', NULL, 'Students go to school to study and learn.', 7, '2026-04-05 12:31:06', '2026-04-05 12:31:06', NULL, 'ai_generated'),
(96, 3, 16, 1, NULL, NULL, 'fill_in_the_gap', 'Who helps sick people feel better?', 'medium', NULL, 30, 'doctor', NULL, 'A doctor helps sick people feel better.', 7, '2026-04-05 12:31:06', '2026-04-05 12:31:06', NULL, 'ai_generated'),
(97, 3, 16, 1, NULL, NULL, 'objective', 'What is a building where people live called?', 'medium', NULL, 30, 'A', NULL, NULL, 7, '2026-04-05 12:31:06', '2026-04-05 12:31:06', NULL, 'ai_generated'),
(98, 3, 16, 1, NULL, NULL, 'fill_in_the_gap', 'Who tells stories and entertains children?', 'medium', NULL, 30, 'storyteller', NULL, 'A storyteller tells stories and entertains children.', 7, '2026-04-05 12:31:06', '2026-04-05 12:31:06', NULL, 'ai_generated'),
(99, 3, 16, 1, NULL, NULL, 'objective', 'Which of the following is a place for buying groceries?', 'medium', NULL, 30, 'A', NULL, NULL, 7, '2026-04-05 12:31:06', '2026-04-05 12:31:06', NULL, 'ai_generated'),
(100, 3, 16, 1, NULL, NULL, 'fill_in_the_gap', 'Where do you go to see animals and learn about them?', 'medium', NULL, 30, 'zoo', NULL, 'You go to the zoo to see animals and learn about them.', 7, '2026-04-05 12:31:06', '2026-04-05 12:31:06', NULL, 'ai_generated'),
(101, 3, 16, 1, NULL, NULL, 'fill_in_the_gap', 'Who takes care of your teeth and helps you keep them healthy?', 'medium', NULL, 30, 'dentist', NULL, 'A dentist takes care of your teeth and helps you keep them healthy.', 7, '2026-04-05 12:31:06', '2026-04-05 12:31:06', NULL, 'ai_generated'),
(102, 3, 16, 1, NULL, NULL, 'objective', 'What is a place where you can borrow and read books called?', 'medium', NULL, 30, 'A', NULL, NULL, 7, '2026-04-05 12:31:06', '2026-04-05 12:31:06', NULL, 'ai_generated'),
(103, 3, 34, 2, NULL, NULL, 'objective', 'Which sentence is in the present tense?', 'medium', NULL, 30, 'C', NULL, 'The sentence \'He plays football every Saturday.\' is in the present tense as \'plays\' indicates a habitual action.', 7, '2026-04-05 12:33:40', '2026-04-05 12:33:40', NULL, 'ai_generated'),
(104, 3, 34, 2, NULL, NULL, 'fill_in_the_gap', 'Fill in the gap: Sarah __________ to the zoo last weekend.', 'medium', NULL, 30, 'went', NULL, 'The correct answer is \'went\' as it is the past form of \'go\'.', 7, '2026-04-05 12:33:40', '2026-04-05 12:33:40', NULL, 'ai_generated'),
(105, 3, 34, 2, NULL, NULL, 'objective', 'Which sentence is in the future tense?', 'medium', NULL, 30, 'B', NULL, 'The sentence \'She will bake a cake tomorrow.\' is in the future tense as \'will bake\' indicates a future action.', 7, '2026-04-05 12:33:40', '2026-04-05 12:33:40', NULL, 'ai_generated'),
(106, 3, 34, 2, NULL, NULL, 'objective', 'What is the past tense of \'run\'?', 'medium', NULL, 30, 'C', NULL, 'The past tense of \'run\' is \'ran\'.', 7, '2026-04-05 12:33:40', '2026-04-05 12:33:40', NULL, 'ai_generated'),
(107, 3, 34, 2, NULL, NULL, 'fill_in_the_gap', 'Complete the sentence: I __________ my homework after dinner.', 'medium', NULL, 30, 'will do', NULL, 'The correct answer is \'will do\' as it indicates a future action.', 7, '2026-04-05 12:33:40', '2026-04-05 12:33:40', NULL, 'ai_generated'),
(108, 3, 34, 2, NULL, NULL, 'fill_in_the_gap', 'Fill in the gap: The cat __________ on the roof yesterday.', 'medium', NULL, 30, 'was', NULL, 'The correct answer is \'was\' as it is the past form of \'is\'.', 7, '2026-04-05 12:33:40', '2026-04-05 12:33:40', NULL, 'ai_generated'),
(109, 3, 34, 2, NULL, NULL, 'objective', 'What is the future tense of \'eat\'?', 'medium', NULL, 30, 'D', NULL, 'The future tense of \'eat\' is \'will eat\'.', 7, '2026-04-05 12:33:40', '2026-04-05 12:33:40', NULL, 'ai_generated'),
(110, 3, 34, 2, NULL, NULL, 'objective', 'Which sentence is in the past tense?', 'medium', NULL, 30, 'C', NULL, 'The sentence \'He danced at the party.\' is in the past tense as \'danced\' indicates a past action.', 7, '2026-04-05 12:33:40', '2026-04-05 12:33:40', NULL, 'ai_generated'),
(111, 3, 34, 2, NULL, NULL, 'fill_in_the_gap', 'Complete the sentence: They __________ to the beach next weekend.', 'medium', NULL, 30, 'will go', NULL, 'The correct answer is \'will go\' as it indicates a future action.', 7, '2026-04-05 12:33:40', '2026-04-05 12:33:40', NULL, 'ai_generated'),
(112, 1, 48, 3, NULL, NULL, 'fill_in_the_gap', 'What is the area of a rectangle with length 5 cm and width 3 cm?', 'medium', NULL, 30, '15 square cm', NULL, 'To find the area of a rectangle, multiply its length by its width. In this case, 5 cm * 3 cm = 15 square cm.', 7, '2026-04-05 12:35:09', '2026-04-05 12:35:09', NULL, 'ai_generated'),
(113, 1, 48, 3, NULL, NULL, 'fill_in_the_gap', 'A rectangle has a length of 8 units and a width of 4 units. What is its area?', 'medium', NULL, 30, '32 square units', NULL, 'Area of a rectangle = length * width. Given length = 8 units and width = 4 units, the area is 8 * 4 = 32 square units.', 7, '2026-04-05 12:35:09', '2026-04-05 12:35:09', NULL, 'ai_generated'),
(114, 1, 48, 3, NULL, NULL, 'fill_in_the_gap', 'The area of a rectangle is 24 square cm. If the length is 6 cm, what is the width?', 'medium', NULL, 30, '4 cm', NULL, 'To find the width, divide the area by the length. Width = Area / Length = 24 / 6 = 4 cm.', 7, '2026-04-05 12:35:09', '2026-04-05 12:35:09', NULL, 'ai_generated'),
(115, 1, 48, 3, NULL, NULL, 'objective', 'Which formula is used to calculate the area of a rectangle?', 'medium', NULL, 30, 'C', NULL, 'The formula to calculate the area of a rectangle is Area = Length * Width.', 7, '2026-04-05 12:35:09', '2026-04-05 12:35:09', NULL, 'ai_generated'),
(116, 1, 48, 3, NULL, NULL, 'fill_in_the_gap', 'If the area of a rectangle is 35 square units and the length is 7 units, what is the width?', 'medium', NULL, 30, '5 units', NULL, 'To find the width, divide the area by the length. Width = Area / Length = 35 / 7 = 5 units.', 7, '2026-04-05 12:35:09', '2026-04-05 12:35:09', NULL, 'ai_generated'),
(117, 1, 48, 3, NULL, NULL, 'fill_in_the_gap', 'A rectangle has a width of 10 cm and an area of 50 square cm. What is its length?', 'medium', NULL, 30, '5 cm', NULL, 'To find the length, divide the area by the width. Length = Area / Width = 50 / 10 = 5 cm.', 7, '2026-04-05 12:35:09', '2026-04-05 12:35:09', NULL, 'ai_generated'),
(118, 1, 48, 3, NULL, NULL, 'fill_in_the_gap', 'If the area of a rectangle is 45 square units and the width is 9 units, what is the length?', 'medium', NULL, 30, '5 units', NULL, 'To find the length, divide the area by the width. Length = Area / Width = 45 / 9 = 5 units.', 7, '2026-04-05 12:35:09', '2026-04-05 12:35:09', NULL, 'ai_generated'),
(119, 1, 48, 3, NULL, NULL, 'fill_in_the_gap', 'A rectangle has a length of 12 cm and a width of 6 cm. What is its area?', 'medium', NULL, 30, '72 square cm', NULL, 'Area of a rectangle = length * width. Given length = 12 cm and width = 6 cm, the area is 12 * 6 = 72 square cm.', 7, '2026-04-05 12:35:09', '2026-04-05 12:35:09', NULL, 'ai_generated'),
(120, 1, 48, 3, NULL, NULL, 'fill_in_the_gap', 'The area of a rectangle is 28 square units. If the width is 4 units, what is the length?', 'medium', NULL, 30, '7 units', NULL, 'To find the length, divide the area by the width. Length = Area / Width = 28 / 4 = 7 units.', 7, '2026-04-05 12:35:09', '2026-04-05 12:35:09', NULL, 'ai_generated'),
(121, 1, 48, 3, NULL, NULL, 'objective', 'Which of the following statements is true about rectangles?', 'medium', NULL, 30, 'C', NULL, 'Rectangles have opposite sides that are equal, but the length and width may be different lengths.', 7, '2026-04-05 12:35:09', '2026-04-05 12:35:09', NULL, 'ai_generated'),
(122, 3, 53, 3, NULL, NULL, 'objective', 'Which type of verb shows an action?', 'medium', NULL, 30, 'A', NULL, 'Action verbs show actions that can be seen or done.', 7, '2026-04-05 12:35:59', '2026-04-05 12:35:59', NULL, 'ai_generated'),
(123, 3, 53, 3, NULL, NULL, 'fill_in_the_gap', 'Identify the action verb in the sentence: The cat is sleeping peacefully.', 'medium', NULL, 30, 'sleeping', NULL, 'Sleeping is the action being performed by the cat.', 7, '2026-04-05 12:35:59', '2026-04-05 12:35:59', NULL, 'ai_generated'),
(124, 3, 53, 3, NULL, NULL, 'objective', 'What type of verb connects the subject to a subject complement?', 'medium', NULL, 30, 'B', NULL, 'Linking verbs connect the subject to a subject complement.', 7, '2026-04-05 12:35:59', '2026-04-05 12:35:59', NULL, 'ai_generated'),
(125, 3, 53, 3, NULL, NULL, 'fill_in_the_gap', 'Choose the linking verb in the sentence: She looks happy today.', 'medium', NULL, 30, 'looks', NULL, 'Looks is the linking verb connecting \'she\' to \'happy\'.', 7, '2026-04-05 12:35:59', '2026-04-05 12:35:59', NULL, 'ai_generated'),
(126, 3, 53, 3, NULL, NULL, 'objective', 'Which type of verb is used with another verb to show tense or to form a question?', 'medium', NULL, 30, 'C', NULL, 'Helping verbs are used with main verbs to show tense or form questions.', 7, '2026-04-05 12:35:59', '2026-04-05 12:35:59', NULL, 'ai_generated'),
(127, 3, 53, 3, NULL, NULL, 'fill_in_the_gap', 'In the sentence \'They are playing outside\', what is the helping verb?', 'medium', NULL, 30, 'are', NULL, 'Are is the helping verb used with the main verb \'playing\'.', 7, '2026-04-05 12:35:59', '2026-04-05 12:35:59', NULL, 'ai_generated'),
(128, 3, 53, 3, NULL, NULL, 'objective', 'Which type of verb helps the main verb express an action or a state of being?', 'medium', NULL, 30, 'C', NULL, 'Helping verbs assist the main verb in expressing action or state of being.', 7, '2026-04-05 12:35:59', '2026-04-05 12:35:59', NULL, 'ai_generated'),
(129, 3, 53, 3, NULL, NULL, 'fill_in_the_gap', 'Find the helping verb in the sentence: I will finish my homework soon.', 'medium', NULL, 30, 'will', NULL, 'Will is the helping verb used to show future tense.', 7, '2026-04-05 12:35:59', '2026-04-05 12:35:59', NULL, 'ai_generated'),
(130, 3, 53, 3, NULL, NULL, 'objective', 'Which verb type is used to describe an ongoing action or state of being?', 'medium', NULL, 30, 'D', NULL, 'Continuous verbs (also called progressive verbs) describe ongoing actions or states of being.', 7, '2026-04-05 12:35:59', '2026-04-05 12:35:59', NULL, 'ai_generated'),
(131, 3, 53, 3, NULL, NULL, 'fill_in_the_gap', 'Identify the continuous verb in the sentence: She is reading a book.', 'medium', NULL, 30, 'reading', NULL, 'Reading is a continuous verb describing the ongoing action.', 7, '2026-04-05 12:35:59', '2026-04-05 12:35:59', NULL, 'ai_generated'),
(132, 1, 76, 4, NULL, NULL, 'fill_in_the_gap', 'Simplify: 3/5 + 2/3', 'hard', NULL, 30, '19/15', NULL, 'To add fractions, find a common denominator (15) and then add the numerators.', 7, '2026-04-06 09:07:12', '2026-04-06 09:07:12', NULL, 'ai_generated'),
(133, 1, 76, 4, NULL, NULL, 'fill_in_the_gap', 'What is the result of 5/6 - 1/4?', 'hard', NULL, 30, '7/12', NULL, 'To subtract fractions, find a common denominator (12) and then subtract the numerators.', 7, '2026-04-06 09:07:12', '2026-04-06 09:07:12', NULL, 'ai_generated'),
(134, 1, 76, 4, NULL, NULL, 'fill_in_the_gap', 'Calculate: 2/3 + 4/9', 'hard', NULL, 30, '10/9', NULL, 'To add fractions, find a common denominator (9) and then add the numerators.', 7, '2026-04-06 09:07:12', '2026-04-06 09:07:12', NULL, 'ai_generated'),
(135, 1, 76, 4, NULL, NULL, 'fill_in_the_gap', 'Find the value of 7/8 - 3/16', 'hard', NULL, 30, '11/16', NULL, 'To subtract fractions, find a common denominator (16) and then subtract the numerators.', 7, '2026-04-06 09:07:12', '2026-04-06 09:07:12', NULL, 'ai_generated'),
(136, 1, 76, 4, NULL, NULL, 'fill_in_the_gap', 'What is 2/3 + 5/6?', 'hard', NULL, 30, '3/2', NULL, 'To add fractions, find a common denominator (6) and then add the numerators.', 7, '2026-04-06 09:07:12', '2026-04-06 09:07:12', NULL, 'ai_generated'),
(137, 1, 76, 4, NULL, NULL, 'fill_in_the_gap', 'Calculate: 4/5 - 3/10', 'hard', NULL, 30, '3/10', NULL, 'To subtract fractions, find a common denominator (10) and then subtract the numerators.', 7, '2026-04-06 09:07:12', '2026-04-06 09:07:12', NULL, 'ai_generated'),
(138, 1, 76, 4, NULL, NULL, 'fill_in_the_gap', 'Simplify: 1/2 + 1/4 + 1/8', 'hard', NULL, 30, '7/8', NULL, 'To add fractions, find a common denominator (8) and then add the numerators.', 7, '2026-04-06 09:07:12', '2026-04-06 09:07:12', NULL, 'ai_generated'),
(139, 1, 76, 4, NULL, NULL, 'fill_in_the_gap', 'What is the result of 3/4 - 1/3?', 'hard', NULL, 30, '5/12', NULL, 'To subtract fractions, find a common denominator (12) and then subtract the numerators.', 7, '2026-04-06 09:07:12', '2026-04-06 09:07:12', NULL, 'ai_generated'),
(140, 1, 76, 4, NULL, NULL, 'fill_in_the_gap', 'Calculate: 2/7 + 3/5', 'hard', NULL, 30, '31/35', NULL, 'To add fractions, find a common denominator (35) and then add the numerators.', 7, '2026-04-06 09:07:12', '2026-04-06 09:07:12', NULL, 'ai_generated'),
(141, 1, 76, 4, NULL, NULL, 'fill_in_the_gap', 'Find the value of 5/6 - 2/9', 'hard', NULL, 30, '3/2', NULL, 'To subtract fractions, find a common denominator (6) and then subtract the numerators.', 7, '2026-04-06 09:07:12', '2026-04-06 09:07:12', NULL, 'ai_generated'),
(142, 3, 83, 4, NULL, NULL, 'fill_in_the_gap', 'Neither the teacher nor the students _____ happy with the test results.', 'hard', NULL, 30, 'are', NULL, 'When \'neither...nor\' is used, the verb agrees with the noun closer to it. In this case, \'students\' is plural, so the correct verb is \'are.\'', 7, '2026-04-06 09:09:02', '2026-04-06 09:09:02', NULL, 'ai_generated'),
(143, 3, 83, 4, NULL, NULL, 'fill_in_the_gap', 'Each of the boys _____ to bring their own lunch to the picnic.', 'hard', NULL, 30, 'is', NULL, 'When \'each\' is used, the verb should be singular to match it. Therefore, \'is\' is the correct verb in this sentence.', 7, '2026-04-06 09:09:02', '2026-04-06 09:09:02', NULL, 'ai_generated'),
(144, 3, 83, 4, NULL, NULL, 'fill_in_the_gap', 'The cost of living in this city _____ risen dramatically over the past year.', 'hard', NULL, 30, 'has', NULL, 'When talking about a singular subject like \'cost,\' the verb should also be singular. Therefore, \'has\' is the correct verb in this sentence.', 7, '2026-04-06 09:09:02', '2026-04-06 09:09:02', NULL, 'ai_generated'),
(145, 3, 83, 4, NULL, NULL, 'fill_in_the_gap', 'The jury _____ unable to reach a verdict after hours of deliberation.', 'hard', NULL, 30, 'was', NULL, 'When referring to a collective noun like \'jury,\' the verb should be singular. Therefore, \'was\' is the correct verb in this sentence.', 7, '2026-04-06 09:09:02', '2026-04-06 09:09:02', NULL, 'ai_generated'),
(146, 3, 83, 4, NULL, NULL, 'fill_in_the_gap', 'Either the blue dress or the red shoes _____ suitable for the party.', 'hard', NULL, 30, 'is', NULL, 'When \'either...or\' is used, the verb agrees with the noun closer to it. In this case, \'shoes\' is singular, so the correct verb is \'is.\'', 7, '2026-04-06 09:09:02', '2026-04-06 09:09:02', NULL, 'ai_generated'),
(147, 3, 83, 4, NULL, NULL, 'fill_in_the_gap', 'The number of students in the class _____ increased since the last assessment.', 'hard', NULL, 30, 'has', NULL, 'When \'number\' is used, the verb should be singular to match it. Therefore, \'has\' is the correct verb in this sentence.', 7, '2026-04-06 09:09:02', '2026-04-06 09:09:02', NULL, 'ai_generated'),
(148, 3, 83, 4, NULL, NULL, 'fill_in_the_gap', 'One of the books on the shelf _____ missing.', 'hard', NULL, 30, 'is', NULL, 'When \'one of\' is used, the verb should be singular to match it. Therefore, \'is\' is the correct verb in this sentence.', 7, '2026-04-06 09:09:02', '2026-04-06 09:09:02', NULL, 'ai_generated'),
(149, 3, 83, 4, NULL, NULL, 'fill_in_the_gap', 'The committee _____ meeting to discuss the new proposal tomorrow.', 'hard', NULL, 30, 'is', NULL, 'When referring to a collective noun like \'committee,\' the verb should be singular. Therefore, \'is\' is the correct verb in this sentence.', 7, '2026-04-06 09:09:02', '2026-04-06 09:09:02', NULL, 'ai_generated'),
(150, 3, 83, 4, NULL, NULL, 'fill_in_the_gap', 'Each of the students _____ to complete the assignment by tomorrow.', 'hard', NULL, 30, 'needs', NULL, 'When \'each\' is used, the verb should be singular to match it. Therefore, \'needs\' is the correct verb in this sentence.', 7, '2026-04-06 09:09:02', '2026-04-06 09:09:02', NULL, 'ai_generated'),
(151, 3, 83, 4, NULL, NULL, 'fill_in_the_gap', 'The pair of shoes _____ under the bed.', 'hard', NULL, 30, 'is', NULL, 'When referring to a pair, the verb should be singular. Therefore, \'is\' is the correct verb in this sentence.', 7, '2026-04-06 09:09:02', '2026-04-06 09:09:02', NULL, 'ai_generated'),
(152, 4, 93, 4, NULL, NULL, 'objective', 'Which structure in the respiratory system is responsible for gas exchange between the lungs and the blood?', 'hard', NULL, 30, 'B', NULL, 'Alveoli are tiny air sacs in the lungs where the exchange of oxygen and carbon dioxide takes place.', 7, '2026-04-06 09:11:11', '2026-04-06 09:11:11', NULL, 'ai_generated'),
(153, 4, 93, 4, NULL, NULL, 'objective', 'What is the function of the epiglottis in the respiratory system?', 'hard', NULL, 30, 'C', NULL, 'The epiglottis is a flap of tissue that prevents food and drink from entering the trachea during swallowing.', 7, '2026-04-06 09:11:11', '2026-04-06 09:11:11', NULL, 'ai_generated'),
(154, 4, 93, 4, NULL, NULL, 'fill_in_the_gap', 'What is the medical term for the voice box?', 'hard', NULL, 30, 'larynx', NULL, 'The larynx, commonly known as the voice box, houses the vocal cords.', 7, '2026-04-06 09:11:11', '2026-04-06 09:11:11', NULL, 'ai_generated'),
(155, 4, 93, 4, NULL, NULL, 'objective', 'In the respiratory system, what is the role of the bronchioles?', 'hard', NULL, 30, 'D', NULL, 'Bronchioles are small air passages that help regulate airflow in the lungs.', 7, '2026-04-06 09:11:11', '2026-04-06 09:11:11', NULL, 'ai_generated'),
(156, 4, 93, 4, NULL, NULL, 'objective', 'Which respiratory disorder is characterized by the narrowing of the airways, leading to difficulty breathing?', 'hard', NULL, 30, 'A', NULL, 'Asthma is a chronic respiratory condition that causes airway constriction and inflammation.', 7, '2026-04-06 09:11:11', '2026-04-06 09:11:11', NULL, 'ai_generated'),
(157, 4, 93, 4, NULL, NULL, 'fill_in_the_gap', 'What is the main muscle responsible for breathing in humans?', 'hard', NULL, 30, 'diaphragm', NULL, 'The diaphragm is the primary muscle involved in the breathing process, separating the chest cavity from the abdominal cavity.', 7, '2026-04-06 09:11:11', '2026-04-06 09:11:11', NULL, 'ai_generated'),
(158, 4, 93, 4, NULL, NULL, 'objective', 'How does the respiratory system help maintain the body\'s pH balance?', 'hard', NULL, 30, 'D', NULL, 'The respiratory system helps maintain pH balance by controlling the levels of carbon dioxide in the blood through breathing.', 7, '2026-04-06 09:11:11', '2026-04-06 09:11:11', NULL, 'ai_generated'),
(159, 4, 93, 4, NULL, NULL, 'objective', 'What is the role of surfactant in the respiratory system?', 'hard', NULL, 30, 'C', NULL, 'Surfactant is a substance that reduces surface tension in the alveoli, helping with the exchange of gases.', 7, '2026-04-06 09:11:11', '2026-04-06 09:11:11', NULL, 'ai_generated'),
(160, 4, 93, 4, NULL, NULL, 'objective', 'What is the function of the cilia in the respiratory system?', 'hard', NULL, 30, 'C', NULL, 'Cilia are tiny hair-like structures that help sweep mucus, dust, and particles out of the respiratory tract.', 7, '2026-04-06 09:11:11', '2026-04-06 09:11:11', NULL, 'ai_generated'),
(161, 4, 93, 4, NULL, NULL, 'fill_in_the_gap', 'What is the name of the process by which oxygen is transported from the lungs to the body\'s cells?', 'hard', NULL, 30, 'respiration', NULL, 'Respiration is the process by which oxygen is taken up by the blood in the lungs and delivered to the body\'s cells.', 7, '2026-04-06 09:11:11', '2026-04-06 09:11:11', NULL, 'ai_generated'),
(162, 5, 103, 4, NULL, NULL, 'objective', 'Which country is famous for the tradition of Oktoberfest?', 'medium', NULL, 30, 'B', NULL, 'Germany is famous for the tradition of Oktoberfest, a beer festival held annually in Munich.', 7, '2026-04-06 09:12:51', '2026-04-06 09:12:51', NULL, 'ai_generated'),
(163, 5, 103, 4, NULL, NULL, 'fill_in_the_gap', 'What is the traditional dance of Hawaii called?', 'medium', NULL, 30, 'Hula', NULL, 'The traditional dance of Hawaii is called Hula, which often tells a story through hand and hip movements.', 7, '2026-04-06 09:12:51', '2026-04-06 09:12:51', NULL, 'ai_generated'),
(164, 5, 103, 4, NULL, NULL, 'objective', 'Which festival marks the Chinese New Year?', 'medium', NULL, 30, 'C', NULL, 'The Chinese New Year is marked by the Lunar New Year festival, celebrated by Chinese communities around the world.', 7, '2026-04-06 09:12:51', '2026-04-06 09:12:51', NULL, 'ai_generated'),
(165, 5, 103, 4, NULL, NULL, 'fill_in_the_gap', 'What is the traditional Japanese dress called for women?', 'medium', NULL, 30, 'Kimono', NULL, 'The traditional Japanese dress for women is called Kimono, which is often worn on special occasions.', 7, '2026-04-06 09:12:51', '2026-04-06 09:12:51', NULL, 'ai_generated'),
(166, 5, 103, 4, NULL, NULL, 'objective', 'In which country is the tradition of St. Patrick\'s Day celebrated?', 'medium', NULL, 30, 'B', NULL, 'The tradition of St. Patrick\'s Day is celebrated in Ireland, honoring the patron saint of the country.', 7, '2026-04-06 09:12:51', '2026-04-06 09:12:51', NULL, 'ai_generated'),
(167, 5, 103, 4, NULL, NULL, 'fill_in_the_gap', 'What is the traditional Mexican dance often performed during celebrations?', 'medium', NULL, 30, 'Mariachi', NULL, 'The traditional Mexican dance often performed during celebrations is Mariachi, accompanied by lively music.', 7, '2026-04-06 09:12:51', '2026-04-06 09:12:51', NULL, 'ai_generated'),
(168, 5, 103, 4, NULL, NULL, 'objective', 'Which country is known for the tradition of the Running of the Bulls event?', 'medium', NULL, 30, 'B', NULL, 'Spain is known for the tradition of the Running of the Bulls event, particularly in Pamplona.', 7, '2026-04-06 09:12:51', '2026-04-06 09:12:51', NULL, 'ai_generated'),
(169, 5, 103, 4, NULL, NULL, 'fill_in_the_gap', 'What is the traditional greeting in Japan called?', 'medium', NULL, 30, 'Bow', NULL, 'The traditional greeting in Japan is a Bow, which shows respect and politeness.', 7, '2026-04-06 09:12:51', '2026-04-06 09:12:51', NULL, 'ai_generated'),
(170, 5, 103, 4, NULL, NULL, 'objective', 'Which country is famous for the tradition of Flamenco dancing?', 'medium', NULL, 30, 'B', NULL, 'Spain is famous for the tradition of Flamenco dancing, known for its passionate and expressive movements.', 7, '2026-04-06 09:12:51', '2026-04-06 09:12:51', NULL, 'ai_generated'),
(171, 5, 103, 4, NULL, NULL, 'fill_in_the_gap', 'What is the traditional headgear worn by Scottish men called?', 'medium', NULL, 30, 'Tam o\' Shanter', NULL, 'The traditional headgear worn by Scottish men is called Tam o\' Shanter, often worn as part of traditional attire.', 7, '2026-04-06 09:12:51', '2026-04-06 09:12:51', NULL, 'ai_generated'),
(172, 1, 112, 5, NULL, NULL, 'objective', 'Which of the following numbers is the smallest? 45,678, 23,456, 56,789, 12,345', 'medium', NULL, 30, 'D', NULL, '12,345 is the smallest number among the given options.', 7, '2026-04-06 09:14:27', '2026-04-06 09:14:27', NULL, 'ai_generated'),
(173, 1, 112, 5, NULL, NULL, 'fill_in_the_gap', 'What is the sum of 32,457 and 12,345?', 'medium', NULL, 30, '44,802', NULL, 'Adding 32,457 and 12,345 gives a sum of 44,802.', 7, '2026-04-06 09:14:27', '2026-04-06 09:14:27', NULL, 'ai_generated'),
(174, 1, 112, 5, NULL, NULL, 'objective', 'Which of the following numbers is the largest? 34,567, 45,678, 23,456, 56,789', 'medium', NULL, 30, 'D', NULL, '56,789 is the largest number among the given options.', 7, '2026-04-06 09:14:27', '2026-04-06 09:14:27', NULL, 'ai_generated'),
(175, 1, 112, 5, NULL, NULL, 'fill_in_the_gap', 'What is the product of 345 and 123?', 'medium', NULL, 30, '42,435', NULL, 'Multiplying 345 and 123 gives a product of 42,435.', 7, '2026-04-06 09:14:27', '2026-04-06 09:14:27', NULL, 'ai_generated'),
(176, 1, 112, 5, NULL, NULL, 'fill_in_the_gap', 'If you add 10,000 to 25,678, what is the result?', 'medium', NULL, 30, '35,678', NULL, 'Adding 10,000 to 25,678 results in 35,678.', 7, '2026-04-06 09:14:27', '2026-04-06 09:14:27', NULL, 'ai_generated'),
(177, 1, 112, 5, NULL, NULL, 'objective', 'Which of the following numbers is even? 23,457, 56,789, 34,566, 43,219', 'medium', NULL, 30, 'C', NULL, '34,566 is an even number among the given options.', 7, '2026-04-06 09:14:27', '2026-04-06 09:14:27', NULL, 'ai_generated'),
(178, 1, 112, 5, NULL, NULL, 'fill_in_the_gap', 'What is the difference between 65,432 and 23,456?', 'medium', NULL, 30, '41,976', NULL, 'Subtracting 23,456 from 65,432 gives a difference of 41,976.', 7, '2026-04-06 09:14:27', '2026-04-06 09:14:27', NULL, 'ai_generated'),
(179, 1, 112, 5, NULL, NULL, 'objective', 'Which of the following numbers is a multiple of 5? 12,345, 23,456, 45,678, 56,790', 'medium', NULL, 30, 'D', NULL, '56,790 is a multiple of 5 as it is divisible by 5.', 7, '2026-04-06 09:14:27', '2026-04-06 09:14:27', NULL, 'ai_generated'),
(180, 1, 112, 5, NULL, NULL, 'fill_in_the_gap', 'What is the value of the digit in the ten thousands place in the number 34,567?', 'medium', NULL, 30, '3', NULL, 'The digit in the ten thousands place in 34,567 is 3.', 7, '2026-04-06 09:14:27', '2026-04-06 09:14:27', NULL, 'ai_generated'),
(181, 1, 112, 5, NULL, NULL, 'objective', 'Which of the following numbers is a prime number? 23,456, 45,678, 56,789, 23,561', 'medium', NULL, 30, 'D', NULL, '23,561 is a prime number as it is divisible by 1 and itself only.', 7, '2026-04-06 09:14:27', '2026-04-06 09:14:27', NULL, 'ai_generated'),
(182, 3, 122, 5, NULL, NULL, 'objective', 'Which of the following sentences is grammatically correct?', 'medium', NULL, 30, 'B', NULL, 'In this case, the correct sentence is \'He doesn\'t have any homework.\' The subject \'He\' requires the singular form of the verb \'does not.\'', 7, '2026-04-06 09:15:43', '2026-04-06 09:15:43', NULL, 'ai_generated'),
(183, 3, 122, 5, NULL, NULL, 'fill_in_the_gap', 'Choose the correct form of the verb to complete the sentence: The dog _______ in the garden yesterday.', 'medium', NULL, 30, 'played', NULL, 'The correct verb form is \'played\' in the past tense to match the time frame \'yesterday.\'', 7, '2026-04-06 09:15:43', '2026-04-06 09:15:43', NULL, 'ai_generated'),
(184, 3, 122, 5, NULL, NULL, 'objective', 'Identify the preposition in the following sentence: She walked through the door.', 'medium', NULL, 30, 'B', NULL, 'The preposition in this sentence is \'through\' as it shows the relationship between \'walked\' and \'door.\'', 7, '2026-04-06 09:15:43', '2026-04-06 09:15:43', NULL, 'ai_generated'),
(185, 3, 122, 5, NULL, NULL, 'objective', 'Which sentence uses the correct subject-verb agreement?', 'medium', NULL, 30, 'D', NULL, 'The correct sentence is \'We are studying for the test.\' The subject \'We\' agrees with the plural verb \'are studying.\'', 7, '2026-04-06 09:15:43', '2026-04-06 09:15:43', NULL, 'ai_generated'),
(186, 3, 122, 5, NULL, NULL, 'fill_in_the_gap', 'Fill in the blank with the appropriate pronoun: _____ will be here soon.', 'medium', NULL, 30, 'They', NULL, 'The correct pronoun to use in this sentence is \'They\' as it refers to more than one person who will be arriving soon.', 7, '2026-04-06 09:15:43', '2026-04-06 09:15:43', NULL, 'ai_generated'),
(187, 3, 122, 5, NULL, NULL, 'objective', 'Which sentence is grammatically incorrect?', 'medium', NULL, 30, 'A', NULL, 'The sentence \'I have went to the store.\' is incorrect. The correct form should be \'I have gone to the store.\'', 7, '2026-04-06 09:15:43', '2026-04-06 09:15:43', NULL, 'ai_generated'),
(188, 3, 122, 5, NULL, NULL, 'fill_in_the_gap', 'Select the correct form of the adjective: She is the _______ person in the room.', 'medium', NULL, 30, 'tallest', NULL, 'The correct form of the adjective to use in this sentence is \'tallest\' to describe the superlative degree.', 7, '2026-04-06 09:15:43', '2026-04-06 09:15:43', NULL, 'ai_generated'),
(189, 3, 122, 5, NULL, NULL, 'objective', 'Which sentence is an example of a compound sentence?', 'medium', NULL, 30, 'B', NULL, 'The sentence \'She likes to sing and dance.\' is a compound sentence as it consists of two independent clauses joined by a conjunction.', 7, '2026-04-06 09:15:43', '2026-04-06 09:15:43', NULL, 'ai_generated'),
(190, 3, 122, 5, NULL, NULL, 'objective', 'Identify the conjunction in the following sentence: I will go to the beach if it is sunny.', 'medium', NULL, 30, 'C', NULL, 'The conjunction in this sentence is \'if\' as it connects the two parts of the conditional statement.', 7, '2026-04-06 09:15:43', '2026-04-06 09:15:43', NULL, 'ai_generated'),
(191, 3, 122, 5, NULL, NULL, 'fill_in_the_gap', 'Choose the correct form of the verb to complete the sentence: They _______ to the concert last night.', 'medium', NULL, 30, 'went', NULL, 'The correct verb form is \'went\' in the past tense to indicate the action of going to the concert last night.', 7, '2026-04-06 09:15:43', '2026-04-06 09:15:43', NULL, 'ai_generated'),
(192, 4, 132, 5, NULL, NULL, 'objective', 'Which material allows electricity to flow through it easily?', 'medium', NULL, 30, 'C', NULL, 'Copper is a good conductor of electricity, allowing it to flow easily.', 7, '2026-04-06 09:16:39', '2026-04-06 09:16:39', NULL, 'ai_generated'),
(193, 4, 132, 5, NULL, NULL, 'objective', 'What unit is used to measure electrical resistance?', 'medium', NULL, 30, 'B', NULL, 'Ohm is the unit of electrical resistance.', 7, '2026-04-06 09:16:39', '2026-04-06 09:16:39', NULL, 'ai_generated'),
(194, 4, 132, 5, NULL, NULL, 'objective', 'What is the flow of electric charge called?', 'medium', NULL, 30, 'B', NULL, 'The flow of electric charge is called current.', 7, '2026-04-06 09:16:39', '2026-04-06 09:16:39', NULL, 'ai_generated'),
(195, 4, 132, 5, NULL, NULL, 'objective', 'What is the SI unit of electric current?', 'medium', NULL, 30, 'D', NULL, 'Ampere is the SI unit of electric current.', 7, '2026-04-06 09:16:39', '2026-04-06 09:16:39', NULL, 'ai_generated'),
(196, 4, 132, 5, NULL, NULL, 'objective', 'Which of the following is a good insulator of electricity?', 'medium', NULL, 30, 'C', NULL, 'Plastic is a good insulator of electricity.', 7, '2026-04-06 09:16:39', '2026-04-06 09:16:39', NULL, 'ai_generated'),
(197, 4, 132, 5, NULL, NULL, 'fill_in_the_gap', 'What is the symbol for the element Copper in the periodic table?', 'medium', NULL, 30, 'Cu', NULL, 'The symbol for Copper is Cu in the periodic table.', 7, '2026-04-06 09:16:39', '2026-04-06 09:16:39', NULL, 'ai_generated'),
(198, 4, 132, 5, NULL, NULL, 'objective', 'What type of circuit has only one path for current flow?', 'medium', NULL, 30, 'B', NULL, 'A series circuit has only one path for current flow.', 7, '2026-04-06 09:16:39', '2026-04-06 09:16:39', NULL, 'ai_generated'),
(199, 4, 132, 5, NULL, NULL, 'objective', 'What device is used to break an electric circuit?', 'medium', NULL, 30, 'A', NULL, 'A fuse is used to break an electric circuit in case of excess current.', 7, '2026-04-06 09:16:39', '2026-04-06 09:16:39', NULL, 'ai_generated'),
(200, 4, 132, 5, NULL, NULL, 'objective', 'What is the process of transferring electrical energy from one place to another without connecting wires called?', 'medium', NULL, 30, 'C', NULL, 'The process is called electromagnetic induction.', 7, '2026-04-06 09:16:39', '2026-04-06 09:16:39', NULL, 'ai_generated'),
(201, 4, 132, 5, NULL, NULL, 'objective', 'What is the unit used to measure electrical power?', 'medium', NULL, 30, 'B', NULL, 'Watt is the unit of electrical power.', 7, '2026-04-06 09:16:39', '2026-04-06 09:16:39', NULL, 'ai_generated'),
(202, 5, 148, 5, NULL, NULL, 'fill_in_the_gap', 'What is population density?', 'medium', NULL, 30, 'Number of people living in a unit area', NULL, 'Population density is the number of people living in a specific unit area, such as square kilometer.', 7, '2026-04-06 09:18:35', '2026-04-06 09:18:35', NULL, 'ai_generated'),
(203, 5, 148, 5, NULL, NULL, 'objective', 'What factors can affect the population size of a country?', 'medium', NULL, 30, 'A', NULL, 'The population size of a country can be affected by birth rate and death rate.', 7, '2026-04-06 09:18:35', '2026-04-06 09:18:35', NULL, 'ai_generated'),
(204, 5, 148, 5, NULL, NULL, 'fill_in_the_gap', 'Why is it important for governments to study population trends?', 'medium', NULL, 30, 'To plan for future needs and services', NULL, 'Studying population trends helps governments to anticipate and plan for the future needs and services required by the population.', 7, '2026-04-06 09:18:35', '2026-04-06 09:18:35', NULL, 'ai_generated'),
(205, 5, 148, 5, NULL, NULL, 'objective', 'What is an example of a push factor that can lead to migration?', 'medium', NULL, 30, 'A', NULL, 'Lack of job opportunities is a push factor that can lead people to migrate in search of better opportunities.', 7, '2026-04-06 09:18:35', '2026-04-06 09:18:35', NULL, 'ai_generated'),
(206, 5, 148, 5, NULL, NULL, 'fill_in_the_gap', 'How can urbanization impact population growth?', 'medium', NULL, 30, 'By attracting people to cities', NULL, 'Urbanization can impact population growth by attracting people from rural areas to cities in search of better opportunities.', 7, '2026-04-06 09:18:35', '2026-04-06 09:18:35', NULL, 'ai_generated'),
(207, 5, 148, 5, NULL, NULL, 'objective', 'What is the term used to describe the total number of people living in a specific area?', 'medium', NULL, 30, 'A', NULL, 'The total number of people living in a specific area is referred to as the population of that area.', 7, '2026-04-06 09:18:35', '2026-04-06 09:18:35', NULL, 'ai_generated');
INSERT INTO `question_banks` (`id`, `subject_id`, `topic_id`, `class_level_id`, `passage_id`, `exam_cat_id`, `question_type`, `question_text`, `difficulty`, `year`, `time_limit`, `correct_answer`, `expected_answer`, `explanation`, `created_by`, `created_at`, `updated_at`, `school_id`, `source`) VALUES
(208, 5, 148, 5, NULL, NULL, 'fill_in_the_gap', 'What impact can an aging population have on a country\'s economy?', 'medium', NULL, 30, 'Increased healthcare costs', NULL, 'An aging population can lead to increased healthcare costs as the elderly require more medical attention and services.', 7, '2026-04-06 09:18:35', '2026-04-06 09:18:35', NULL, 'ai_generated'),
(209, 5, 148, 5, NULL, NULL, 'fill_in_the_gap', 'Why is it important to study population distribution?', 'medium', NULL, 30, 'To understand how people are spread across a region', NULL, 'Studying population distribution helps in understanding how people are distributed across a region, which is crucial for planning and resource allocation.', 7, '2026-04-06 09:18:35', '2026-04-06 09:18:35', NULL, 'ai_generated'),
(210, 5, 148, 5, NULL, NULL, 'objective', 'What is a common reason for rural depopulation?', 'medium', NULL, 30, 'A', NULL, 'Lack of job opportunities is a common reason for rural depopulation as people move to urban areas in search of work.', 7, '2026-04-06 09:18:35', '2026-04-06 09:18:35', NULL, 'ai_generated'),
(211, 5, 148, 5, NULL, NULL, 'fill_in_the_gap', 'How can family planning programs impact a country\'s population growth?', 'medium', NULL, 30, 'By reducing birth rates', NULL, 'Family planning programs can impact a country\'s population growth by providing education and access to contraception, leading to a decrease in birth rates.', 7, '2026-04-06 09:18:35', '2026-04-06 09:18:35', NULL, 'ai_generated'),
(212, 1, 152, 6, NULL, NULL, 'objective', 'What is the sum of 256, 489, and 325?', 'medium', NULL, 30, 'B', NULL, 'Adding 256 + 489 + 325 gives a total of 1070.', 7, '2026-04-06 09:21:27', '2026-04-06 09:21:27', NULL, 'ai_generated'),
(213, 1, 152, 6, NULL, NULL, 'objective', 'Which number is the product of 234 and 5?', 'medium', NULL, 30, 'A', NULL, 'Multiplying 234 by 5 results in 1170.', 7, '2026-04-06 09:21:27', '2026-04-06 09:21:27', NULL, 'ai_generated'),
(214, 1, 152, 6, NULL, NULL, 'objective', 'What is the value of 678 - 245?', 'medium', NULL, 30, 'A', NULL, 'Subtracting 245 from 678 gives a result of 433.', 7, '2026-04-06 09:21:27', '2026-04-06 09:21:27', NULL, 'ai_generated'),
(215, 1, 152, 6, NULL, NULL, 'objective', 'Which number is the nearest to 800 from 789?', 'medium', NULL, 30, 'B', NULL, '800 is closer to 789 than any other given number.', 7, '2026-04-06 09:21:27', '2026-04-06 09:21:27', NULL, 'ai_generated'),
(216, 1, 152, 6, NULL, NULL, 'objective', 'Find the quotient of 648 ÷ 3.', 'medium', NULL, 30, 'A', NULL, 'Dividing 648 by 3 equals 216.', 7, '2026-04-06 09:21:27', '2026-04-06 09:21:27', NULL, 'ai_generated'),
(217, 1, 152, 6, NULL, NULL, 'objective', 'Which number is the product of 345 and 4?', 'medium', NULL, 30, 'A', NULL, 'Multiplying 345 by 4 results in 1380.', 7, '2026-04-06 09:21:27', '2026-04-06 09:21:27', NULL, 'ai_generated'),
(218, 1, 152, 6, NULL, NULL, 'objective', 'What is the value of 789 + 265?', 'medium', NULL, 30, 'A', NULL, 'Adding 789 + 265 gives a total of 1054.', 7, '2026-04-06 09:21:27', '2026-04-06 09:21:27', NULL, 'ai_generated'),
(219, 1, 152, 6, NULL, NULL, 'objective', 'Which number is the nearest to 500 from 497?', 'medium', NULL, 30, 'B', NULL, '500 is closer to 497 than any other given number.', 7, '2026-04-06 09:21:27', '2026-04-06 09:21:27', NULL, 'ai_generated'),
(220, 1, 152, 6, NULL, NULL, 'objective', 'Find the product of 567 and 3.', 'medium', NULL, 30, 'A', NULL, 'Multiplying 567 by 3 results in 1701.', 7, '2026-04-06 09:21:28', '2026-04-06 09:21:28', NULL, 'ai_generated'),
(221, 1, 152, 6, NULL, NULL, 'objective', 'What is the value of 879 - 345?', 'medium', NULL, 30, 'A', NULL, 'Subtracting 345 from 879 gives a result of 534.', 7, '2026-04-06 09:21:28', '2026-04-06 09:21:28', NULL, 'ai_generated'),
(222, 3, 169, 6, NULL, NULL, 'objective', 'Choose the synonym for \'abundant\'.', 'medium', NULL, 30, 'B', NULL, '\'Abundant\' means a large amount of something, hence \'Plentiful\' is the synonym.', 7, '2026-04-06 09:22:38', '2026-04-06 09:22:38', NULL, 'ai_generated'),
(223, 3, 169, 6, NULL, NULL, 'fill_in_the_gap', 'What is the meaning of \'meticulous\'?', 'medium', NULL, 30, 'Showing great attention to detail', NULL, '\'Meticulous\' means showing great attention to detail.', 7, '2026-04-06 09:22:38', '2026-04-06 09:22:38', NULL, 'ai_generated'),
(224, 3, 169, 6, NULL, NULL, 'objective', 'Which word is an antonym of \'brave\'?', 'medium', NULL, 30, 'B', NULL, '\'Brave\' means courageous, so \'Cowardly\' is the antonym.', 7, '2026-04-06 09:22:38', '2026-04-06 09:22:38', NULL, 'ai_generated'),
(225, 3, 169, 6, NULL, NULL, 'fill_in_the_gap', 'Fill in the blank: She was __________ by the beautiful sunset.', 'medium', NULL, 30, 'Enthralled', NULL, 'Enthralled means captivated or fascinated, which fits in the sentence.', 7, '2026-04-06 09:22:38', '2026-04-06 09:22:38', NULL, 'ai_generated'),
(226, 3, 169, 6, NULL, NULL, 'objective', 'Choose the synonym for \'vivid\'.', 'medium', NULL, 30, 'B', NULL, '\'Vivid\' means bright or intense, so \'Bright\' is the synonym.', 7, '2026-04-06 09:22:38', '2026-04-06 09:22:38', NULL, 'ai_generated'),
(227, 3, 169, 6, NULL, NULL, 'fill_in_the_gap', 'What is the meaning of \'eloquent\'?', 'medium', NULL, 30, 'Fluent or persuasive in speaking or writing', NULL, '\'Eloquent\' refers to being fluent or persuasive in speaking or writing.', 7, '2026-04-06 09:22:38', '2026-04-06 09:22:38', NULL, 'ai_generated'),
(228, 3, 169, 6, NULL, NULL, 'objective', 'Which word is an antonym of \'generous\'?', 'medium', NULL, 30, 'A', NULL, '\'Generous\' means giving more than is necessary, so \'Stingy\' is the antonym.', 7, '2026-04-06 09:22:38', '2026-04-06 09:22:38', NULL, 'ai_generated'),
(229, 3, 169, 6, NULL, NULL, 'fill_in_the_gap', 'Fill in the blank: The room was filled with a ________ fragrance.', 'medium', NULL, 30, 'Lingering', NULL, 'Lingering fragrance means a pleasant smell that remains for a long time.', 7, '2026-04-06 09:22:38', '2026-04-06 09:22:38', NULL, 'ai_generated'),
(230, 3, 169, 6, NULL, NULL, 'objective', 'Choose the synonym for \'puzzled\'.', 'medium', NULL, 30, 'A', NULL, '\'Puzzled\' means confused, so \'Confused\' is the synonym.', 7, '2026-04-06 09:22:38', '2026-04-06 09:22:38', NULL, 'ai_generated'),
(231, 3, 169, 6, NULL, NULL, 'fill_in_the_gap', 'What is the meaning of \'exuberant\'?', 'medium', NULL, 30, 'Full of energy, excitement, and cheerfulness', NULL, '\'Exuberant\' describes someone who is full of energy, excitement, and cheerfulness.', 7, '2026-04-06 09:22:38', '2026-04-06 09:22:38', NULL, 'ai_generated'),
(232, 4, 174, 6, NULL, NULL, 'objective', 'What is the term used to describe the practice of using technology to spy on individuals without their consent?', 'medium', NULL, 30, 'C', NULL, 'Cyberstalking is the act of using technology to spy on individuals without their consent.', 7, '2026-04-06 09:24:03', '2026-04-06 09:24:03', NULL, 'ai_generated'),
(233, 4, 174, 6, NULL, NULL, 'objective', 'How does technology impact the environment?', 'medium', NULL, 30, 'C', NULL, 'Technology can cause pollution and resource depletion through various industrial processes.', 7, '2026-04-06 09:24:03', '2026-04-06 09:24:03', NULL, 'ai_generated'),
(234, 4, 174, 6, NULL, NULL, 'objective', 'What is the term for the unauthorized use or reproduction of someone else\'s work on the internet?', 'medium', NULL, 30, 'A', NULL, 'Plagiarism refers to the unauthorized use or reproduction of someone else\'s work.', 7, '2026-04-06 09:24:03', '2026-04-06 09:24:03', NULL, 'ai_generated'),
(235, 4, 174, 6, NULL, NULL, 'objective', 'How does technology impact communication in society?', 'medium', NULL, 30, 'C', NULL, 'Technology can lead to miscommunication and social isolation due to overreliance on digital communication.', 7, '2026-04-06 09:24:03', '2026-04-06 09:24:03', NULL, 'ai_generated'),
(236, 4, 174, 6, NULL, NULL, 'objective', 'What is the term for the fear or hatred of technology?', 'medium', NULL, 30, 'A', NULL, 'Technophobia is the fear or hatred of technology.', 7, '2026-04-06 09:24:03', '2026-04-06 09:24:03', NULL, 'ai_generated'),
(237, 4, 174, 6, NULL, NULL, 'objective', 'How can technology be used to enhance education in society?', 'medium', NULL, 30, 'C', NULL, 'Technology can enhance education by providing online resources and interactive learning tools for students.', 7, '2026-04-06 09:24:03', '2026-04-06 09:24:03', NULL, 'ai_generated'),
(238, 4, 174, 6, NULL, NULL, 'objective', 'What is the term for the manipulation of public opinion through online platforms?', 'medium', NULL, 30, 'C', NULL, 'Astroturfing is the manipulation of public opinion through online platforms.', 7, '2026-04-06 09:24:03', '2026-04-06 09:24:03', NULL, 'ai_generated'),
(239, 4, 174, 6, NULL, NULL, 'objective', 'How does technology impact job opportunities in society?', 'medium', NULL, 30, 'B', NULL, 'Technology can reduce the need for human workers in certain industries through automation and artificial intelligence.', 7, '2026-04-06 09:24:03', '2026-04-06 09:24:03', NULL, 'ai_generated'),
(240, 4, 174, 6, NULL, NULL, 'objective', 'What is the term for the practice of using technology to track and monitor individuals\' online activities?', 'medium', NULL, 30, 'C', NULL, 'Surveillance is the practice of using technology to track and monitor individuals\' online activities.', 7, '2026-04-06 09:24:03', '2026-04-06 09:24:03', NULL, 'ai_generated'),
(241, 4, 174, 6, NULL, NULL, 'objective', 'How does technology impact social relationships in society?', 'medium', NULL, 30, 'C', NULL, 'Technology can lead to social isolation and reduced empathy as people rely more on digital communication than face-to-face interactions.', 7, '2026-04-06 09:24:03', '2026-04-06 09:24:03', NULL, 'ai_generated'),
(242, 5, 183, 6, NULL, NULL, 'objective', 'What is the role of the executive branch in the government?', 'medium', NULL, 30, 'B', NULL, 'The executive branch is responsible for enforcing laws and implementing policies.', 7, '2026-04-06 09:26:24', '2026-04-06 09:26:24', NULL, 'ai_generated'),
(243, 5, 183, 6, NULL, NULL, 'objective', 'Who is the head of the executive branch in a country?', 'medium', NULL, 30, 'A', NULL, 'The President is typically the head of the executive branch in a country.', 7, '2026-04-06 09:26:24', '2026-04-06 09:26:24', NULL, 'ai_generated'),
(244, 5, 183, 6, NULL, NULL, 'objective', 'Which branch of government is responsible for interpreting laws?', 'medium', NULL, 30, 'C', NULL, 'The judicial branch is responsible for interpreting laws and ensuring their constitutionality.', 7, '2026-04-06 09:26:24', '2026-04-06 09:26:24', NULL, 'ai_generated'),
(245, 5, 183, 6, NULL, NULL, 'objective', 'What is the main role of the legislative branch?', 'medium', NULL, 30, 'C', NULL, 'The legislative branch is responsible for making laws and representing the people.', 7, '2026-04-06 09:26:24', '2026-04-06 09:26:24', NULL, 'ai_generated'),
(246, 5, 183, 6, NULL, NULL, 'objective', 'Who is responsible for reviewing laws to ensure they are fair and constitutional?', 'medium', NULL, 30, 'D', NULL, 'The Supreme Court, part of the judicial branch, reviews laws to ensure they are fair and constitutional.', 7, '2026-04-06 09:26:24', '2026-04-06 09:26:24', NULL, 'ai_generated'),
(247, 5, 183, 6, NULL, NULL, 'objective', 'Which branch of government is responsible for approving the budget and taxes?', 'medium', NULL, 30, 'B', NULL, 'The legislative branch is responsible for approving the budget and taxes as part of its law-making function.', 7, '2026-04-06 09:26:24', '2026-04-06 09:26:24', NULL, 'ai_generated'),
(248, 5, 183, 6, NULL, NULL, 'objective', 'What is the primary function of the judicial branch?', 'medium', NULL, 30, 'C', NULL, 'The primary function of the judicial branch is to interpret laws and administer justice.', 7, '2026-04-06 09:26:24', '2026-04-06 09:26:24', NULL, 'ai_generated'),
(249, 5, 183, 6, NULL, NULL, 'objective', 'Which branch of government is responsible for appointing judges?', 'medium', NULL, 30, 'A', NULL, 'The executive branch is typically responsible for appointing judges in many countries.', 7, '2026-04-06 09:26:24', '2026-04-06 09:26:24', NULL, 'ai_generated'),
(250, 5, 183, 6, NULL, NULL, 'objective', 'Who has the power to veto laws passed by the legislative branch?', 'medium', NULL, 30, 'A', NULL, 'The President often has the power to veto laws passed by the legislative branch.', 7, '2026-04-06 09:26:24', '2026-04-06 09:26:24', NULL, 'ai_generated'),
(251, 5, 183, 6, NULL, NULL, 'objective', 'Which branch of government is responsible for implementing and enforcing laws?', 'medium', NULL, 30, 'A', NULL, 'The executive branch is responsible for implementing and enforcing laws.', 7, '2026-04-06 09:26:24', '2026-04-06 09:26:24', NULL, 'ai_generated'),
(252, 1, 192, 7, NULL, NULL, 'fill_in_the_gap', 'What is the sum of the first 50 whole numbers?', 'medium', NULL, 30, '1275', NULL, 'The sum of the first n whole numbers is given by the formula n*(n+1)/2. Substituting n=50, we get 50*51/2 = 1275.', 7, '2026-04-06 09:27:40', '2026-04-06 09:27:40', NULL, 'ai_generated'),
(253, 1, 192, 7, NULL, NULL, 'objective', 'Which of the following is a whole number?', 'medium', NULL, 30, 'B', NULL, 'Whole numbers include all positive integers including zero. So, 0 is a whole number.', 7, '2026-04-06 09:27:40', '2026-04-06 09:27:40', NULL, 'ai_generated'),
(254, 1, 192, 7, NULL, NULL, 'fill_in_the_gap', 'What is the product of the first 10 odd whole numbers?', 'medium', NULL, 30, '945', NULL, 'The product of the first n odd numbers is n!. Substituting n=10, we get 1*3*5*...*19 = 945.', 7, '2026-04-06 09:27:40', '2026-04-06 09:27:40', NULL, 'ai_generated'),
(255, 1, 192, 7, NULL, NULL, 'objective', 'Which of the following is the smallest whole number?', 'medium', NULL, 30, 'A', NULL, 'The smallest whole number is 0.', 7, '2026-04-06 09:27:40', '2026-04-06 09:27:40', NULL, 'ai_generated'),
(256, 1, 192, 7, NULL, NULL, 'fill_in_the_gap', 'What is the difference between the largest 3-digit whole number and the smallest 4-digit whole number?', 'medium', NULL, 30, '900', NULL, 'The largest 3-digit number is 999 and the smallest 4-digit number is 1000. The difference is 1000 - 999 = 900.', 7, '2026-04-06 09:27:40', '2026-04-06 09:27:40', NULL, 'ai_generated'),
(257, 1, 192, 7, NULL, NULL, 'objective', 'Which of the following is not a whole number?', 'medium', NULL, 30, 'D', NULL, 'Whole numbers are positive integers including zero. 2.5 is not an integer, hence not a whole number.', 7, '2026-04-06 09:27:40', '2026-04-06 09:27:40', NULL, 'ai_generated'),
(258, 1, 192, 7, NULL, NULL, 'fill_in_the_gap', 'Express 5 million in whole number form.', 'medium', NULL, 30, '5000000', NULL, '5 million is written as 5,000,000 in whole number form.', 7, '2026-04-06 09:27:40', '2026-04-06 09:27:40', NULL, 'ai_generated'),
(259, 1, 192, 7, NULL, NULL, 'objective', 'Which of the following is the largest whole number?', 'medium', NULL, 30, 'C', NULL, 'The largest whole number is infinity, but among the given options, 1001 is the largest whole number.', 7, '2026-04-06 09:27:40', '2026-04-06 09:27:40', NULL, 'ai_generated'),
(260, 1, 192, 7, NULL, NULL, 'fill_in_the_gap', 'What is the sum of the first 25 even whole numbers?', 'medium', NULL, 30, '650', NULL, 'The sum of the first n even whole numbers is n*(n+1). Substituting n=25, we get 25*26 = 650.', 7, '2026-04-06 09:27:40', '2026-04-06 09:27:40', NULL, 'ai_generated'),
(261, 1, 192, 7, NULL, NULL, 'objective', 'Which of the following is an odd whole number?', 'medium', NULL, 30, 'D', NULL, 'Odd numbers are integers that are not divisible by 2. -3 is an odd number and hence a whole number.', 7, '2026-04-06 09:27:40', '2026-04-06 09:27:40', NULL, 'ai_generated'),
(262, 3, 207, 7, NULL, NULL, 'objective', 'Identify the part of speech of the word \'quickly\' in the sentence: She quickly ran to catch the bus.', 'medium', NULL, 30, 'B', NULL, 'Quickly is an adverb as it describes how she ran.', 7, '2026-04-06 09:28:50', '2026-04-06 09:28:50', NULL, 'ai_generated'),
(263, 3, 207, 7, NULL, NULL, 'objective', 'In the sentence \'The cat chased the mouse\', what part of speech is \'chased\'?', 'medium', NULL, 30, 'C', NULL, '\'Chased\' is a verb as it shows the action of the cat.', 7, '2026-04-06 09:28:50', '2026-04-06 09:28:50', NULL, 'ai_generated'),
(264, 3, 207, 7, NULL, NULL, 'objective', 'What part of speech is the word \'beautiful\' in the sentence \'She has a beautiful voice\'?', 'medium', NULL, 30, 'A', NULL, '\'Beautiful\' is an adjective describing the voice.', 7, '2026-04-06 09:28:50', '2026-04-06 09:28:50', NULL, 'ai_generated'),
(265, 3, 207, 7, NULL, NULL, 'objective', 'Identify the part of speech of the word \'under\' in the sentence \'The book is under the table\'.', 'medium', NULL, 30, 'A', NULL, '\'Under\' is a preposition showing the relationship between the book and the table.', 7, '2026-04-06 09:28:50', '2026-04-06 09:28:50', NULL, 'ai_generated'),
(266, 3, 207, 7, NULL, NULL, 'objective', 'What part of speech is \'happily\' in the sentence \'She skipped happily in the park\'?', 'medium', NULL, 30, 'C', NULL, '\'Happily\' is an adverb describing how she skipped.', 7, '2026-04-06 09:28:50', '2026-04-06 09:28:50', NULL, 'ai_generated'),
(267, 3, 207, 7, NULL, NULL, 'objective', 'In the sentence \'John is a teacher\', what part of speech is \'teacher\'?', 'medium', NULL, 30, 'B', NULL, '\'Teacher\' is a noun as it is a person, place, thing, or idea.', 7, '2026-04-06 09:28:50', '2026-04-06 09:28:50', NULL, 'ai_generated'),
(268, 3, 207, 7, NULL, NULL, 'objective', 'Identify the part of speech of \'quick\' in the sentence \'She is quick to respond\'.', 'medium', NULL, 30, 'A', NULL, '\'Quick\' is an adjective describing how she responds.', 7, '2026-04-06 09:28:50', '2026-04-06 09:28:50', NULL, 'ai_generated'),
(269, 3, 207, 7, NULL, NULL, 'objective', 'What part of speech is \'suddenly\' in the sentence \'The car stopped suddenly\'?', 'medium', NULL, 30, 'C', NULL, '\'Suddenly\' is an adverb describing how the car stopped.', 7, '2026-04-06 09:28:51', '2026-04-06 09:28:51', NULL, 'ai_generated'),
(270, 3, 207, 7, NULL, NULL, 'objective', 'In the sentence \'They are playing football\', what part of speech is \'playing\'?', 'medium', NULL, 30, 'B', NULL, '\'Playing\' is a verb showing the action of playing football.', 7, '2026-04-06 09:28:51', '2026-04-06 09:28:51', NULL, 'ai_generated'),
(271, 3, 207, 7, NULL, NULL, 'objective', 'Identify the part of speech of \'with\' in the sentence \'He went to the market with his friend\'.', 'medium', NULL, 30, 'A', NULL, '\'With\' is a preposition indicating the relationship between \'he\' and \'his friend\'.', 7, '2026-04-06 09:28:51', '2026-04-06 09:28:51', NULL, 'ai_generated'),
(272, 4, 217, 7, NULL, NULL, 'fill_in_the_gap', 'What is the process by which plants make their food?', 'medium', NULL, 30, 'Photosynthesis', NULL, 'Photosynthesis is the process by which green plants make their food using sunlight, carbon dioxide, and water.', 7, '2026-04-06 09:30:16', '2026-04-06 09:30:16', NULL, 'ai_generated'),
(273, 4, 217, 7, NULL, NULL, 'objective', 'Which of the following is not a characteristic of living things?', 'medium', NULL, 30, 'C', NULL, 'Living things exhibit growth, reproduction, and response to stimuli. Magnetism is not a characteristic of living things.', 7, '2026-04-06 09:30:17', '2026-04-06 09:30:17', NULL, 'ai_generated'),
(274, 4, 217, 7, NULL, NULL, 'fill_in_the_gap', 'What is the basic structural unit of all living organisms?', 'medium', NULL, 30, 'Cell', NULL, 'The cell is the basic structural and functional unit of all living organisms.', 7, '2026-04-06 09:30:17', '2026-04-06 09:30:17', NULL, 'ai_generated'),
(275, 4, 217, 7, NULL, NULL, 'objective', 'Which of the following is an example of a vertebrate animal?', 'medium', NULL, 30, 'A', NULL, 'Fish is an example of a vertebrate animal as it has a backbone. Worm, spider, and ant are invertebrates.', 7, '2026-04-06 09:30:17', '2026-04-06 09:30:17', NULL, 'ai_generated'),
(276, 4, 217, 7, NULL, NULL, 'fill_in_the_gap', 'What is the process of removal of waste materials from the body called?', 'medium', NULL, 30, 'Excretion', NULL, 'Excretion is the process of removing waste materials produced by the body\'s metabolic activities.', 7, '2026-04-06 09:30:17', '2026-04-06 09:30:17', NULL, 'ai_generated'),
(277, 4, 217, 7, NULL, NULL, 'objective', 'Which of the following is a non-living thing?', 'medium', NULL, 30, 'C', NULL, 'Rock is a non-living thing. Dog, tree, and bird are living organisms.', 7, '2026-04-06 09:30:17', '2026-04-06 09:30:17', NULL, 'ai_generated'),
(278, 4, 217, 7, NULL, NULL, 'fill_in_the_gap', 'What is the process by which living organisms produce offspring of their kind?', 'medium', NULL, 30, 'Reproduction', NULL, 'Reproduction is the process by which living organisms produce offspring of their kind to ensure the continuation of the species.', 7, '2026-04-06 09:30:17', '2026-04-06 09:30:17', NULL, 'ai_generated'),
(279, 4, 217, 7, NULL, NULL, 'objective', 'Which of the following is not a plant part?', 'medium', NULL, 30, 'C', NULL, 'Beak is not a plant part. Leaf, root, and stem are parts of a plant.', 7, '2026-04-06 09:30:17', '2026-04-06 09:30:17', NULL, 'ai_generated'),
(280, 4, 217, 7, NULL, NULL, 'fill_in_the_gap', 'What is the green pigment responsible for photosynthesis in plants?', 'medium', NULL, 30, 'Chlorophyll', NULL, 'Chlorophyll is the green pigment in plant cells that captures light energy for photosynthesis.', 7, '2026-04-06 09:30:17', '2026-04-06 09:30:17', NULL, 'ai_generated'),
(281, 4, 217, 7, NULL, NULL, 'objective', 'Which of the following is a characteristic of all living things?', 'medium', NULL, 30, 'A', NULL, 'Reproduction is a characteristic of all living things. Thermometer, chair, and book are non-living objects.', 7, '2026-04-06 09:30:17', '2026-04-06 09:30:17', NULL, 'ai_generated'),
(282, 5, 238, 7, NULL, NULL, 'objective', 'What is the term used to describe a group of people consisting of parents and their children?', 'medium', NULL, 30, 'A', NULL, NULL, 7, '2026-04-06 09:32:24', '2026-04-06 09:32:24', NULL, 'ai_generated'),
(283, 5, 238, 7, NULL, NULL, 'objective', 'Which of the following is NOT a form of marriage?', 'medium', NULL, 30, 'D', NULL, NULL, 7, '2026-04-06 09:32:24', '2026-04-06 09:32:24', NULL, 'ai_generated'),
(284, 5, 238, 7, NULL, NULL, 'objective', 'What is the primary purpose of marriage in many societies?', 'medium', NULL, 30, 'A', NULL, NULL, 7, '2026-04-06 09:32:24', '2026-04-06 09:32:24', NULL, 'ai_generated'),
(285, 5, 238, 7, NULL, NULL, 'objective', 'Who is responsible for the upbringing and welfare of children in a typical family?', 'medium', NULL, 30, 'A', NULL, NULL, 7, '2026-04-06 09:32:24', '2026-04-06 09:32:24', NULL, 'ai_generated'),
(286, 5, 238, 7, NULL, NULL, 'objective', 'In a nuclear family, how many generations typically live together?', 'medium', NULL, 30, 'A', NULL, NULL, 7, '2026-04-06 09:32:24', '2026-04-06 09:32:24', NULL, 'ai_generated'),
(287, 5, 238, 7, NULL, NULL, 'fill_in_the_gap', 'What is the legal union of a man and a woman called?', 'medium', NULL, 30, 'Marriage', NULL, 'Marriage is a legal and social contract between two individuals that unites their lives legally, economically, and emotionally.', 7, '2026-04-06 09:32:24', '2026-04-06 09:32:24', NULL, 'ai_generated'),
(288, 5, 238, 7, NULL, NULL, 'fill_in_the_gap', 'What is the term used to describe a person who has lost their spouse through death?', 'medium', NULL, 30, 'Widow/Widower', NULL, 'A widow is a woman whose spouse has died, while a widower is a man in the same situation.', 7, '2026-04-06 09:32:24', '2026-04-06 09:32:24', NULL, 'ai_generated'),
(289, 5, 238, 7, NULL, NULL, 'fill_in_the_gap', 'What is the legal dissolution of a marriage called?', 'medium', NULL, 30, 'Divorce', NULL, 'Divorce is the legal process of ending a marriage, leading to the termination of marital duties and responsibilities.', 7, '2026-04-06 09:32:24', '2026-04-06 09:32:24', NULL, 'ai_generated'),
(290, 5, 238, 7, NULL, NULL, 'fill_in_the_gap', 'What term describes the practice of having multiple spouses?', 'medium', NULL, 30, 'Polygamy', NULL, 'Polygamy is a marriage system where an individual has more than one spouse at the same time.', 7, '2026-04-06 09:32:24', '2026-04-06 09:32:24', NULL, 'ai_generated'),
(291, 5, 238, 7, NULL, NULL, 'fill_in_the_gap', 'Which family type consists of parents and their children living together?', 'medium', NULL, 30, 'Nuclear family', NULL, 'A nuclear family is a basic family unit consisting of parents and their children.', 7, '2026-04-06 09:32:24', '2026-04-06 09:32:24', NULL, 'ai_generated'),
(292, 6, 233, 7, NULL, NULL, 'fill_in_the_gap', 'What is the basic unit of resistance in electronics?', 'medium', NULL, 30, 'Ohm', NULL, 'The ohm (symbol: Ω) is the SI unit of electrical resistance.', 7, '2026-04-06 09:34:06', '2026-04-06 09:34:06', NULL, 'ai_generated'),
(293, 6, 233, 7, NULL, NULL, 'objective', 'Which component is used to store electrical charge in a circuit?', 'medium', NULL, 30, 'B', NULL, 'A capacitor is a component used to store electrical charge in a circuit.', 7, '2026-04-06 09:34:06', '2026-04-06 09:34:06', NULL, 'ai_generated'),
(294, 6, 233, 7, NULL, NULL, 'fill_in_the_gap', 'What does LED stand for in electronics?', 'medium', NULL, 30, 'Light Emitting Diode', NULL, 'LED stands for Light Emitting Diode, which is a semiconductor light source.', 7, '2026-04-06 09:34:06', '2026-04-06 09:34:06', NULL, 'ai_generated'),
(295, 6, 233, 7, NULL, NULL, 'objective', 'Which component is commonly used to amplify or switch electronic signals?', 'medium', NULL, 30, 'C', NULL, 'A transistor is commonly used to amplify or switch electronic signals.', 7, '2026-04-06 09:34:06', '2026-04-06 09:34:06', NULL, 'ai_generated'),
(296, 6, 233, 7, NULL, NULL, 'fill_in_the_gap', 'In electronics, what does DC stand for?', 'medium', NULL, 30, 'Direct Current', NULL, 'DC stands for Direct Current, which is the flow of electric charge in one direction.', 7, '2026-04-06 09:34:06', '2026-04-06 09:34:06', NULL, 'ai_generated'),
(297, 6, 233, 7, NULL, NULL, 'objective', 'Which component allows current to flow in only one direction?', 'medium', NULL, 30, 'C', NULL, 'A diode is a component that allows current to flow in only one direction.', 7, '2026-04-06 09:34:06', '2026-04-06 09:34:06', NULL, 'ai_generated'),
(298, 6, 233, 7, NULL, NULL, 'fill_in_the_gap', 'What is the SI unit of electric charge?', 'medium', NULL, 30, 'Coulomb', NULL, 'Coulomb is the SI unit of electric charge, representing approximately 6.242 × 10^18 elementary charges.', 7, '2026-04-06 09:34:06', '2026-04-06 09:34:06', NULL, 'ai_generated'),
(299, 6, 233, 7, NULL, NULL, 'objective', 'Which type of material allows electricity to flow easily?', 'medium', NULL, 30, 'B', NULL, 'A conductor is a material that allows electricity to flow easily due to its free electrons.', 7, '2026-04-06 09:34:06', '2026-04-06 09:34:06', NULL, 'ai_generated'),
(300, 6, 233, 7, NULL, NULL, 'fill_in_the_gap', 'What is the function of a transformer in an electrical circuit?', 'medium', NULL, 30, 'Change voltage levels', NULL, 'A transformer is used to change voltage levels in an electrical circuit through electromagnetic induction.', 7, '2026-04-06 09:34:06', '2026-04-06 09:34:06', NULL, 'ai_generated'),
(301, 6, 233, 7, NULL, NULL, 'objective', 'Which component is used to protect other components in a circuit from voltage spikes?', 'medium', NULL, 30, 'D', NULL, 'A varistor is used to protect components from voltage spikes by varying its resistance with voltage changes.', 7, '2026-04-06 09:34:06', '2026-04-06 09:34:06', NULL, 'ai_generated'),
(302, 1, 247, 8, NULL, NULL, 'fill_in_the_gap', 'Simplify the algebraic fraction: (2x^2 + 5x - 3) / (x^2 - 4)', 'medium', NULL, 30, '2x + 3', NULL, 'Factorize the numerator and denominator, then cancel out common factors.', 7, '2026-04-06 09:36:12', '2026-04-06 09:36:12', NULL, 'ai_generated'),
(303, 1, 247, 8, NULL, NULL, 'fill_in_the_gap', 'Find the value of x: (3x + 7) / (x + 2) = 5', 'medium', NULL, 30, '1', NULL, 'Cross multiply and solve the resulting linear equation.', 7, '2026-04-06 09:36:12', '2026-04-06 09:36:12', NULL, 'ai_generated'),
(304, 1, 247, 8, NULL, NULL, 'fill_in_the_gap', 'Simplify the expression: (a^2 - 4) / (a - 2)', 'medium', NULL, 30, 'a + 2', NULL, 'Factorize the numerator as the difference of squares.', 7, '2026-04-06 09:36:12', '2026-04-06 09:36:12', NULL, 'ai_generated'),
(305, 1, 247, 8, NULL, NULL, 'objective', 'Which of the following is equivalent to (6x^2 + 9x) / (3x) ?', 'medium', NULL, 30, 'A', NULL, 'Factor out the common factor in the numerator.', 7, '2026-04-06 09:36:12', '2026-04-06 09:36:12', NULL, 'ai_generated'),
(306, 1, 247, 8, NULL, NULL, 'fill_in_the_gap', 'Solve for x: (2x - 3) / (x + 4) = 1', 'medium', NULL, 30, '3', NULL, 'Cross multiply and solve the resulting linear equation.', 7, '2026-04-06 09:36:12', '2026-04-06 09:36:12', NULL, 'ai_generated'),
(307, 1, 247, 8, NULL, NULL, 'fill_in_the_gap', 'Simplify the algebraic fraction: (4x^3 + 6x^2 - 8x) / (2x^2)', 'medium', NULL, 30, '2x + 3', NULL, 'Factor out the common factor in the numerator and simplify.', 7, '2026-04-06 09:36:12', '2026-04-06 09:36:12', NULL, 'ai_generated'),
(308, 1, 247, 8, NULL, NULL, 'fill_in_the_gap', 'Find the value of x: (5x + 3) / (x - 1) = 8', 'medium', NULL, 30, '5', NULL, 'Cross multiply and solve the resulting linear equation.', 7, '2026-04-06 09:36:12', '2026-04-06 09:36:12', NULL, 'ai_generated'),
(309, 1, 247, 8, NULL, NULL, 'fill_in_the_gap', 'Simplify the expression: (3a^2 - 12) / (a - 2)', 'medium', NULL, 30, '3a + 6', NULL, 'Factorize the numerator and simplify.', 7, '2026-04-06 09:36:12', '2026-04-06 09:36:12', NULL, 'ai_generated'),
(310, 1, 247, 8, NULL, NULL, 'objective', 'Which of the following is equivalent to (10x^2 + 15x) / (5x) ?', 'medium', NULL, 30, 'A', NULL, 'Factor out the common factor in the numerator.', 7, '2026-04-06 09:36:12', '2026-04-06 09:36:12', NULL, 'ai_generated'),
(311, 1, 247, 8, NULL, NULL, 'fill_in_the_gap', 'Solve for x: (3x - 4) / (x + 2) = 2', 'medium', NULL, 30, '2', NULL, 'Cross multiply and solve the resulting linear equation.', 7, '2026-04-06 09:36:12', '2026-04-06 09:36:12', NULL, 'ai_generated'),
(312, 3, 257, 8, NULL, NULL, 'fill_in_the_gap', 'What figure of speech is used in the sentence \'The stars danced playfully in the night sky\'?', 'medium', NULL, 30, 'personification', NULL, 'Personification is the attribution of human characteristics to inanimate objects or abstract ideas.', 7, '2026-04-06 09:39:07', '2026-04-06 09:39:07', NULL, 'ai_generated'),
(313, 3, 257, 8, NULL, NULL, 'objective', 'Identify the figure of speech in the sentence \'His words were a soothing balm to her wounded heart.\'', 'medium', NULL, 30, 'B', NULL, 'Metaphor is a figure of speech that makes a comparison between two unlike things, stating that one thing is another.', 7, '2026-04-06 09:39:07', '2026-04-06 09:39:07', NULL, 'ai_generated'),
(314, 3, 257, 8, NULL, NULL, 'fill_in_the_gap', 'In the phrase \'time flies\', what figure of speech is being used?', 'medium', NULL, 30, 'metaphor', NULL, 'Metaphor is a figure of speech that makes an implicit comparison between two unlike things.', 7, '2026-04-06 09:39:07', '2026-04-06 09:39:07', NULL, 'ai_generated'),
(315, 3, 257, 8, NULL, NULL, 'fill_in_the_gap', 'Which figure of speech is exemplified in the phrase \'raining cats and dogs\'?', 'medium', NULL, 30, 'idiom', NULL, 'An idiom is a phrase or expression that has a figurative meaning different from its literal meaning.', 7, '2026-04-06 09:39:07', '2026-04-06 09:39:07', NULL, 'ai_generated'),
(316, 3, 257, 8, NULL, NULL, 'objective', 'Select the figure of speech used in the sentence \'The sun smiled down on the children at play.\'', 'medium', NULL, 30, 'A', NULL, 'Personification attributes human qualities to non-human things, like the sun smiling.', 7, '2026-04-06 09:39:07', '2026-04-06 09:39:07', NULL, 'ai_generated'),
(317, 3, 257, 8, NULL, NULL, 'fill_in_the_gap', 'What figure of speech is employed in the phrase \'time is a thief\'?', 'medium', NULL, 30, 'metaphor', NULL, 'Metaphor is used to compare time to a thief, implying time steals moments.', 7, '2026-04-06 09:39:07', '2026-04-06 09:39:07', NULL, 'ai_generated'),
(318, 3, 257, 8, NULL, NULL, 'objective', 'Identify the figure of speech in the sentence \'The wind whispered through the trees.\'', 'medium', NULL, 30, 'A', NULL, 'Personification gives human qualities to non-human entities, like the wind whispering.', 7, '2026-04-06 09:39:07', '2026-04-06 09:39:07', NULL, 'ai_generated'),
(319, 3, 257, 8, NULL, NULL, 'fill_in_the_gap', 'In the phrase \'a heart of stone\', what figure of speech is used?', 'medium', NULL, 30, 'metaphor', NULL, 'Metaphor is employed to convey the idea of someone being emotionally cold or unfeeling.', 7, '2026-04-06 09:39:07', '2026-04-06 09:39:07', NULL, 'ai_generated'),
(320, 3, 257, 8, NULL, NULL, 'fill_in_the_gap', 'Which figure of speech is illustrated in the phrase \'burst into tears\'?', 'medium', NULL, 30, 'idiom', NULL, 'An idiom is a phrase with a figurative meaning different from its literal interpretation.', 7, '2026-04-06 09:39:07', '2026-04-06 09:39:07', NULL, 'ai_generated'),
(321, 3, 257, 8, NULL, NULL, 'objective', 'Select the figure of speech used in the sentence \'The camera loves her.\'', 'medium', NULL, 30, 'D', NULL, 'Hyperbole is an exaggeration used for emphasis or effect, as in \'the camera loves her\'.', 7, '2026-04-06 09:39:07', '2026-04-06 09:39:07', NULL, 'ai_generated'),
(322, 1, 269, 9, NULL, NULL, 'fill_in_the_gap', 'Simplify: 5x - 3(x + 2)', 'medium', NULL, 30, '2x - 6', NULL, 'Distribute the -3 to both terms inside the brackets and then combine like terms.', 7, '2026-04-06 09:43:05', '2026-04-06 09:43:05', NULL, 'ai_generated'),
(323, 1, 269, 9, NULL, NULL, 'fill_in_the_gap', 'If 3x + 4 = 19, what is the value of x?', 'medium', NULL, 30, '5', NULL, 'Subtract 4 from both sides and then divide by 3 to find the value of x.', 7, '2026-04-06 09:43:05', '2026-04-06 09:43:05', NULL, 'ai_generated'),
(324, 1, 269, 9, NULL, NULL, 'fill_in_the_gap', 'What is the next term in the sequence: 2, 5, 9, 14, ___?', 'medium', NULL, 30, '20', NULL, 'The sequence is increasing by 3, 4, 5, so the next term should be 14 + 6 = 20.', 7, '2026-04-06 09:43:05', '2026-04-06 09:43:05', NULL, 'ai_generated'),
(325, 1, 269, 9, NULL, NULL, 'fill_in_the_gap', 'Solve for y: 2y + 7 = 15', 'medium', NULL, 30, '4', NULL, 'Subtract 7 from both sides and then divide by 2 to find the value of y.', 7, '2026-04-06 09:43:05', '2026-04-06 09:43:05', NULL, 'ai_generated'),
(326, 1, 269, 9, NULL, NULL, 'fill_in_the_gap', 'What is the value of x if 4x - 3 = 9?', 'medium', NULL, 30, '3', NULL, 'Add 3 to both sides and then divide by 4 to find the value of x.', 7, '2026-04-06 09:43:05', '2026-04-06 09:43:05', NULL, 'ai_generated'),
(327, 1, 269, 9, NULL, NULL, 'fill_in_the_gap', 'Solve for x: 2(x + 3) = 14', 'medium', NULL, 30, '4', NULL, 'Distribute the 2 inside the brackets, then solve for x.', 7, '2026-04-06 09:43:05', '2026-04-06 09:43:05', NULL, 'ai_generated'),
(328, 1, 269, 9, NULL, NULL, 'fill_in_the_gap', 'What is the perimeter of a rectangle with length 6 cm and width 4 cm?', 'medium', NULL, 30, '20 cm', NULL, 'Perimeter = 2(length + width). Substitute the given values to find the perimeter.', 7, '2026-04-06 09:43:05', '2026-04-06 09:43:05', NULL, 'ai_generated'),
(329, 1, 269, 9, NULL, NULL, 'fill_in_the_gap', 'Find the value of x in the equation: 3(x - 2) = 15', 'medium', NULL, 30, '7', NULL, 'Distribute the 3 inside the brackets, then solve for x.', 7, '2026-04-06 09:43:05', '2026-04-06 09:43:05', NULL, 'ai_generated'),
(330, 1, 269, 9, NULL, NULL, 'fill_in_the_gap', 'If 2x + 5 = 17, what is the value of x?', 'medium', NULL, 30, '6', NULL, 'Subtract 5 from both sides and then divide by 2 to find the value of x.', 7, '2026-04-06 09:43:05', '2026-04-06 09:43:05', NULL, 'ai_generated'),
(331, 1, 269, 9, NULL, NULL, 'fill_in_the_gap', 'Evaluate: 3^2 + 4 * 5', 'medium', NULL, 30, '23', NULL, 'Follow the order of operations: first square 3, then multiply 4 by 5, and finally add the results.', 7, '2026-04-06 09:43:05', '2026-04-06 09:43:05', NULL, 'ai_generated'),
(332, 3, 273, 9, NULL, NULL, 'objective', 'Choose the correct past form of the verb: \'go\'', 'medium', NULL, 30, 'B', NULL, '\'Went\' is the past form of the verb \'go\'.', 7, '2026-04-06 09:44:19', '2026-04-06 09:44:19', NULL, 'ai_generated'),
(333, 3, 273, 9, NULL, NULL, 'fill_in_the_gap', 'Fill in the gap with the correct past tense of the verb: She ________ to the store yesterday.', 'medium', NULL, 30, 'went', NULL, 'The correct past tense of \'go\' to be used here is \'went\'.', 7, '2026-04-06 09:44:19', '2026-04-06 09:44:19', NULL, 'ai_generated'),
(334, 3, 273, 9, NULL, NULL, 'objective', 'Choose the sentence with the correct past simple form: A) He buy a new car. B) He buys a new car. C) He bought a new car. D) He buying a new car.', 'medium', NULL, 30, 'C', NULL, 'The correct past simple form is \'He bought a new car.\'', 7, '2026-04-06 09:44:19', '2026-04-06 09:44:19', NULL, 'ai_generated'),
(335, 3, 273, 9, NULL, NULL, 'objective', 'Which sentence uses the correct past form of the verb \'eat\' in the negative form? A) He don\'t eat. B) He didn\'t eat. C) He eated. D) He not eating.', 'medium', NULL, 30, 'B', NULL, 'The correct past form in the negative form is \'He didn\'t eat.\'', 7, '2026-04-06 09:44:19', '2026-04-06 09:44:19', NULL, 'ai_generated'),
(336, 3, 273, 9, NULL, NULL, 'fill_in_the_gap', 'Fill in the gap with the correct past tense of the verb: They ________ to the concert last night.', 'medium', NULL, 30, 'went', NULL, 'The correct past tense of \'go\' to be used here is \'went\'.', 7, '2026-04-06 09:44:19', '2026-04-06 09:44:19', NULL, 'ai_generated'),
(337, 3, 273, 9, NULL, NULL, 'objective', 'Choose the sentence with the correct past simple form: A) She writed a letter. B) She written a letter. C) She wrote a letter. D) She writing a letter.', 'medium', NULL, 30, 'C', NULL, 'The correct past simple form is \'She wrote a letter.\'', 7, '2026-04-06 09:44:19', '2026-04-06 09:44:19', NULL, 'ai_generated'),
(338, 3, 273, 9, NULL, NULL, 'objective', 'Choose the correct past form of the verb: \'sleep\'', 'medium', NULL, 30, 'B', NULL, '\'Slept\' is the past form of the verb \'sleep\'.', 7, '2026-04-06 09:44:19', '2026-04-06 09:44:19', NULL, 'ai_generated'),
(339, 3, 273, 9, NULL, NULL, 'fill_in_the_gap', 'Fill in the gap with the correct past tense of the verb: He ________ his homework yesterday.', 'medium', NULL, 30, 'did', NULL, 'The correct past tense of \'do\' to be used here is \'did\'.', 7, '2026-04-06 09:44:19', '2026-04-06 09:44:19', NULL, 'ai_generated'),
(340, 3, 273, 9, NULL, NULL, 'objective', 'Choose the sentence with the correct past simple form: A) They buy a new book. B) They bought a new book. C) They buying a new book. D) They buyed a new book.', 'medium', NULL, 30, 'B', NULL, 'The correct past simple form is \'They bought a new book.\'', 7, '2026-04-06 09:44:19', '2026-04-06 09:44:19', NULL, 'ai_generated'),
(341, 3, 273, 9, NULL, NULL, 'fill_in_the_gap', 'Fill in the gap with the correct past tense of the verb: She ________ her keys at home this morning.', 'medium', NULL, 30, 'forgot', NULL, 'The correct past tense of \'forget\' to be used here is \'forgot\'.', 7, '2026-04-06 09:44:19', '2026-04-06 09:44:19', NULL, 'ai_generated'),
(342, 1, 278, 10, NULL, NULL, 'fill_in_the_gap', 'What is the universal set in set theory?', 'medium', NULL, 30, 'A universal set is the set of all possible elements under consideration.', NULL, 'The universal set contains all the elements that are being considered or discussed in a given problem or situation.', 7, '2026-04-06 09:46:03', '2026-04-06 09:46:03', NULL, 'ai_generated'),
(343, 1, 278, 10, NULL, NULL, 'objective', 'If A = {1, 2, 3} and B = {2, 3, 4}, what is the intersection of set A and set B?', 'medium', NULL, 30, 'B', NULL, 'The intersection of sets A and B includes only the elements that are common to both sets, which are 2 and 3.', 7, '2026-04-06 09:46:03', '2026-04-06 09:46:03', NULL, 'ai_generated'),
(344, 1, 278, 10, NULL, NULL, 'fill_in_the_gap', 'What is the cardinality of an empty set?', 'medium', NULL, 30, 'The cardinality of an empty set is 0.', NULL, 'An empty set has no elements, so its cardinality is zero.', 7, '2026-04-06 09:46:03', '2026-04-06 09:46:03', NULL, 'ai_generated'),
(345, 1, 278, 10, NULL, NULL, 'objective', 'If A = {a, b, c} and B = {c, d, e}, what is the union of set A and set B?', 'medium', NULL, 30, 'A', NULL, 'The union of sets A and B combines all unique elements from both sets, resulting in {a, b, c, d, e}.', 7, '2026-04-06 09:46:03', '2026-04-06 09:46:03', NULL, 'ai_generated'),
(346, 1, 278, 10, NULL, NULL, 'fill_in_the_gap', 'What is the complement of a set A with respect to the universal set U?', 'medium', NULL, 30, 'The complement of set A with respect to the universal set U consists of all elements in U that are not in set A.', NULL, 'The complement of a set includes all elements in the universal set that do not belong to the given set.', 7, '2026-04-06 09:46:03', '2026-04-06 09:46:03', NULL, 'ai_generated'),
(347, 1, 278, 10, NULL, NULL, 'objective', 'If A = {1, 2, 3, 4} and B = {3, 4, 5, 6}, what is the relative complement of set A with respect to set B?', 'medium', NULL, 30, 'A', NULL, 'The relative complement of A with respect to B includes elements in B that are not in A, which are 5 and 6.', 7, '2026-04-06 09:46:03', '2026-04-06 09:46:03', NULL, 'ai_generated'),
(348, 1, 278, 10, NULL, NULL, 'fill_in_the_gap', 'If A = {x | x is an even number less than 10}, how many elements are in set A?', 'medium', NULL, 30, 'There are 4 elements in set A: {2, 4, 6, 8}.', NULL, 'Set A consists of even numbers less than 10, which are 2, 4, 6, and 8.', 7, '2026-04-06 09:46:03', '2026-04-06 09:46:03', NULL, 'ai_generated'),
(349, 1, 278, 10, NULL, NULL, 'objective', 'If A = {apple, banana, orange} and B = {orange, pineapple, mango}, what is the symmetric difference of set A and set B?', 'medium', NULL, 30, 'A', NULL, 'The symmetric difference of sets A and B includes elements that are in one set but not both, resulting in {apple, banana, pineapple, mango}.', 7, '2026-04-06 09:46:03', '2026-04-06 09:46:03', NULL, 'ai_generated'),
(350, 1, 278, 10, NULL, NULL, 'fill_in_the_gap', 'What is the power set of a set with 3 elements?', 'medium', NULL, 30, 'The power set of a set with 3 elements has 8 subsets.', NULL, 'The power set includes all possible subsets of a given set, and for a set with 3 elements, there are 2^3 = 8 subsets.', 7, '2026-04-06 09:46:03', '2026-04-06 09:46:03', NULL, 'ai_generated'),
(351, 1, 278, 10, NULL, NULL, 'objective', 'If A = {a, b, c, d} and B = {b, c, d, e}, what is the difference of set A and set B?', 'medium', NULL, 30, 'A', NULL, 'The difference of sets A and B includes elements that are in set A but not in set B, which is {a}.', 7, '2026-04-06 09:46:03', '2026-04-06 09:46:03', NULL, 'ai_generated'),
(352, 3, 294, 10, NULL, NULL, 'objective', 'Identify the type of sentence: She is going to the market.', 'medium', NULL, 30, 'A', NULL, 'This is a declarative sentence as it makes a statement.', 7, '2026-04-06 09:47:25', '2026-04-06 09:47:25', NULL, 'ai_generated'),
(353, 3, 294, 10, NULL, NULL, 'fill_in_the_gap', 'Choose the correct verb form: She _______ a book every morning.', 'medium', NULL, 30, 'reads', NULL, 'The correct verb form is \'reads\' in the present simple tense.', 7, '2026-04-06 09:47:25', '2026-04-06 09:47:25', NULL, 'ai_generated'),
(354, 3, 294, 10, NULL, NULL, 'objective', 'Which of the following is a compound sentence?', 'medium', NULL, 30, 'B', NULL, '\'She likes tea and coffee.\' is a compound sentence as it consists of two independent clauses joined by a conjunction.', 7, '2026-04-06 09:47:25', '2026-04-06 09:47:25', NULL, 'ai_generated'),
(355, 3, 294, 10, NULL, NULL, 'objective', 'Identify the adverb in the sentence: The dog barked loudly.', 'medium', NULL, 30, 'C', NULL, '\'Loudly\' is the adverb in the sentence describing how the dog barked.', 7, '2026-04-06 09:47:25', '2026-04-06 09:47:25', NULL, 'ai_generated'),
(356, 3, 294, 10, NULL, NULL, 'fill_in_the_gap', 'Fill in the blank with the correct preposition: She is interested _______ music.', 'medium', NULL, 30, 'in', NULL, 'The correct preposition is \'in\' in this context.', 7, '2026-04-06 09:47:25', '2026-04-06 09:47:25', NULL, 'ai_generated'),
(357, 3, 294, 10, NULL, NULL, 'objective', 'Which sentence is in passive voice?', 'medium', NULL, 30, 'B', NULL, '\'The cake was baked by Mary.\' is in the passive voice where the subject receives the action.', 7, '2026-04-06 09:47:25', '2026-04-06 09:47:25', NULL, 'ai_generated'),
(358, 3, 294, 10, NULL, NULL, 'objective', 'Identify the conjunction in the sentence: I will go to the park if it stops raining.', 'medium', NULL, 30, 'C', NULL, '\'If\' is the conjunction in the sentence connecting the two clauses.', 7, '2026-04-06 09:47:25', '2026-04-06 09:47:25', NULL, 'ai_generated'),
(359, 3, 294, 10, NULL, NULL, 'fill_in_the_gap', 'Choose the correct form of the adjective: This is the _______ book I have ever read.', 'medium', NULL, 30, 'best', NULL, '\'Best\' is the correct form of the adjective in this superlative context.', 7, '2026-04-06 09:47:25', '2026-04-06 09:47:25', NULL, 'ai_generated'),
(360, 3, 294, 10, NULL, NULL, 'objective', 'Which of the following is a complex sentence?', 'medium', NULL, 30, 'C', NULL, '\'Although it was raining, they went outside.\' is a complex sentence with an independent clause and a dependent clause.', 7, '2026-04-06 09:47:25', '2026-04-06 09:47:25', NULL, 'ai_generated'),
(361, 3, 294, 10, NULL, NULL, 'objective', 'Identify the interjection in the sentence: Wow! That was amazing.', 'medium', NULL, 30, 'A', NULL, '\'Wow\' is the interjection expressing emotion in the sentence.', 7, '2026-04-06 09:47:25', '2026-04-06 09:47:25', NULL, 'ai_generated'),
(362, 7, 303, 10, NULL, NULL, 'objective', 'Which of the following is a scalar quantity?', 'medium', NULL, 30, 'C', NULL, 'Distance is a scalar quantity as it only has magnitude and no direction.', 7, '2026-04-06 09:48:30', '2026-04-06 09:48:30', NULL, 'ai_generated'),
(363, 7, 303, 10, NULL, NULL, 'fill_in_the_gap', 'A car accelerates uniformly from rest at 2 m/s². What is its velocity after 5 seconds?', 'medium', NULL, 30, '10 m/s', NULL, 'Using the equation v = u + at, where u=0 m/s, a=2 m/s², and t=5 s, we get v = 0 + 2*5 = 10 m/s.', 7, '2026-04-06 09:48:30', '2026-04-06 09:48:30', NULL, 'ai_generated'),
(364, 7, 303, 10, NULL, NULL, 'objective', 'Which graph represents an object moving at a constant speed?', 'medium', NULL, 30, 'B', NULL, 'A straight horizontal line on a distance-time graph represents constant speed.', 7, '2026-04-06 09:48:30', '2026-04-06 09:48:30', NULL, 'ai_generated'),
(365, 7, 303, 10, NULL, NULL, 'fill_in_the_gap', 'An object is thrown vertically upwards with an initial velocity of 20 m/s. What is the maximum height it reaches?', 'medium', NULL, 30, '20.41 m', NULL, 'The maximum height can be calculated using the equation h = (v^2 - u^2) / (2g), where v=0 m/s, u=20 m/s, and g=9.81 m/s².', 7, '2026-04-06 09:48:30', '2026-04-06 09:48:30', NULL, 'ai_generated'),
(366, 7, 303, 10, NULL, NULL, 'objective', 'What is the SI unit of acceleration?', 'medium', NULL, 30, 'B', NULL, 'Acceleration is measured in meters per second squared (m/s²).', 7, '2026-04-06 09:48:30', '2026-04-06 09:48:30', NULL, 'ai_generated'),
(367, 7, 303, 10, NULL, NULL, 'fill_in_the_gap', 'A car travels a distance of 240 km in 4 hours. What is its average speed?', 'medium', NULL, 30, '60 km/h', NULL, 'Average speed = total distance / total time = 240 km / 4 h = 60 km/h.', 7, '2026-04-06 09:48:30', '2026-04-06 09:48:30', NULL, 'ai_generated'),
(368, 7, 303, 10, NULL, NULL, 'objective', 'Which of the following is an example of deceleration?', 'medium', NULL, 30, 'C', NULL, 'Deceleration means slowing down, which occurs when a car brakes.', 7, '2026-04-06 09:48:30', '2026-04-06 09:48:30', NULL, 'ai_generated'),
(369, 7, 303, 10, NULL, NULL, 'objective', 'What is the formula to calculate average speed?', 'medium', NULL, 30, 'A', NULL, 'Average speed is calculated as total distance divided by total time taken.', 7, '2026-04-06 09:48:30', '2026-04-06 09:48:30', NULL, 'ai_generated'),
(370, 7, 303, 10, NULL, NULL, 'fill_in_the_gap', 'If an object moves at a constant speed of 10 m/s for 5 seconds, how far does it travel?', 'medium', NULL, 30, '50 meters', NULL, 'Distance = speed * time = 10 m/s * 5 s = 50 meters.', 7, '2026-04-06 09:48:30', '2026-04-06 09:48:30', NULL, 'ai_generated'),
(371, 7, 303, 10, NULL, NULL, 'objective', 'Which of the following represents a vector quantity?', 'medium', NULL, 30, 'C', NULL, 'Displacement is a vector quantity as it has both magnitude and direction.', 7, '2026-04-06 09:48:30', '2026-04-06 09:48:30', NULL, 'ai_generated'),
(372, 8, 314, 10, NULL, NULL, 'objective', 'Which state of matter has a definite volume but not a definite shape?', 'medium', NULL, 30, 'B', NULL, 'In a liquid state, the particles have definite volume but can flow and take the shape of their container.', 7, '2026-04-06 09:49:35', '2026-04-06 09:49:35', NULL, 'ai_generated'),
(373, 8, 314, 10, NULL, NULL, 'objective', 'What is the process of a solid directly changing into a gas called?', 'medium', NULL, 30, 'A', NULL, 'Sublimation is the change of a substance from a solid directly into a gas without passing through the liquid state.', 7, '2026-04-06 09:49:35', '2026-04-06 09:49:35', NULL, 'ai_generated');
INSERT INTO `question_banks` (`id`, `subject_id`, `topic_id`, `class_level_id`, `passage_id`, `exam_cat_id`, `question_type`, `question_text`, `difficulty`, `year`, `time_limit`, `correct_answer`, `expected_answer`, `explanation`, `created_by`, `created_at`, `updated_at`, `school_id`, `source`) VALUES
(374, 8, 314, 10, NULL, NULL, 'objective', 'Which of the following is an example of a chemical change?', 'medium', NULL, 30, 'C', NULL, 'Burning paper involves a chemical reaction where the paper is converted into new substances.', 7, '2026-04-06 09:49:35', '2026-04-06 09:49:35', NULL, 'ai_generated'),
(375, 8, 314, 10, NULL, NULL, 'objective', 'What is the SI unit of mass?', 'medium', NULL, 30, 'A', NULL, 'The kilogram (kg) is the base unit of mass in the International System of Units (SI).', 7, '2026-04-06 09:49:35', '2026-04-06 09:49:35', NULL, 'ai_generated'),
(376, 8, 314, 10, NULL, NULL, 'objective', 'Which of the following is an example of a heterogeneous mixture?', 'medium', NULL, 30, 'C', NULL, 'A mixture of sand and iron filings is heterogeneous because its components can be visibly distinguished.', 7, '2026-04-06 09:49:35', '2026-04-06 09:49:35', NULL, 'ai_generated'),
(377, 8, 314, 10, NULL, NULL, 'objective', 'What happens to the density of a substance as its volume increases?', 'medium', NULL, 30, 'B', NULL, 'Density is mass per unit volume, so as volume increases while mass stays constant, density decreases.', 7, '2026-04-06 09:49:35', '2026-04-06 09:49:35', NULL, 'ai_generated'),
(378, 8, 314, 10, NULL, NULL, 'objective', 'Which of the following is a physical property of matter?', 'medium', NULL, 30, 'B', NULL, 'Color is a physical property that can be observed without changing the substance\'s identity.', 7, '2026-04-06 09:49:35', '2026-04-06 09:49:35', NULL, 'ai_generated'),
(379, 8, 314, 10, NULL, NULL, 'objective', 'What is the boiling point of water in Celsius?', 'medium', NULL, 30, 'B', NULL, 'Water boils at 100°C under standard atmospheric pressure.', 7, '2026-04-06 09:49:35', '2026-04-06 09:49:35', NULL, 'ai_generated'),
(380, 8, 314, 10, NULL, NULL, 'objective', 'Which subatomic particle has a positive charge?', 'medium', NULL, 30, 'A', NULL, 'Protons have a positive charge and are found in the nucleus of an atom.', 7, '2026-04-06 09:49:35', '2026-04-06 09:49:35', NULL, 'ai_generated'),
(381, 8, 314, 10, NULL, NULL, 'objective', 'What is the chemical symbol for gold?', 'medium', NULL, 30, 'B', NULL, 'The chemical symbol for gold is Au, derived from the Latin word aurum.', 7, '2026-04-06 09:49:35', '2026-04-06 09:49:35', NULL, 'ai_generated'),
(382, 8, 314, 10, NULL, NULL, 'fill_in_the_gap', 'The state of matter with a definite shape and volume is _____.', 'medium', NULL, 30, 'solid', NULL, 'Solids have a fixed shape and volume because their particles are closely packed together.', 7, '2026-04-07 10:43:24', '2026-04-07 10:43:24', NULL, 'ai_generated'),
(383, 8, 314, 10, NULL, NULL, 'fill_in_the_gap', 'The process of a solid changing directly into a gas is called _____.', 'medium', NULL, 30, 'sublimation', NULL, 'Sublimation is the phase transition of a substance directly from a solid to a gas without passing through the liquid state.', 7, '2026-04-07 10:43:24', '2026-04-07 10:43:24', NULL, 'ai_generated'),
(384, 8, 314, 10, NULL, NULL, 'fill_in_the_gap', 'The state of matter that has a definite volume but takes the shape of its container is _____.', 'medium', NULL, 30, 'liquid', NULL, 'Liquids have a fixed volume but take the shape of their container due to their ability to flow.', 7, '2026-04-07 10:43:24', '2026-04-07 10:43:24', NULL, 'ai_generated'),
(385, 8, 314, 10, NULL, NULL, 'fill_in_the_gap', 'The temperature at which a liquid changes into a gas at atmospheric pressure is called the _____.', 'medium', NULL, 30, 'boiling point', NULL, 'The boiling point is the temperature at which the vapor pressure of the liquid equals the external pressure, leading to boiling.', 7, '2026-04-07 10:43:24', '2026-04-07 10:43:24', NULL, 'ai_generated'),
(386, 8, 314, 10, NULL, NULL, 'fill_in_the_gap', 'The state of matter that has neither a definite shape nor a definite volume is _____.', 'medium', NULL, 30, 'gas', NULL, 'Gases have neither a fixed shape nor volume as their particles are free to move and fill the entire space of their container.', 7, '2026-04-07 10:43:24', '2026-04-07 10:43:24', NULL, 'ai_generated'),
(387, 9, 323, 10, NULL, NULL, 'objective', 'Which of the following is not a characteristic of living organisms?', 'medium', NULL, 30, 'C', NULL, 'Decomposition is a characteristic of non-living organisms.', 7, '2026-04-07 10:45:13', '2026-04-07 10:45:13', NULL, 'ai_generated'),
(388, 9, 323, 10, NULL, NULL, 'fill_in_the_gap', 'What is the process by which living organisms produce energy from food?', 'medium', NULL, 30, 'Respiration', NULL, 'Respiration is the process of producing energy from food in living organisms.', 7, '2026-04-07 10:45:14', '2026-04-07 10:45:14', NULL, 'ai_generated'),
(389, 9, 323, 10, NULL, NULL, 'fill_in_the_gap', 'What is the basic unit of structure and function in living organisms?', 'medium', NULL, 30, 'Cell', NULL, 'Cells are the basic structural and functional units of living organisms.', 7, '2026-04-07 10:45:14', '2026-04-07 10:45:14', NULL, 'ai_generated'),
(390, 9, 323, 10, NULL, NULL, 'objective', 'Which of the following is a characteristic of all living organisms?', 'medium', NULL, 30, 'B', NULL, 'All living organisms have the ability to respire.', 7, '2026-04-07 10:45:14', '2026-04-07 10:45:14', NULL, 'ai_generated'),
(391, 9, 323, 10, NULL, NULL, 'fill_in_the_gap', 'What is the process by which living organisms take in oxygen and release carbon dioxide?', 'medium', NULL, 30, 'Breathing', NULL, 'Breathing is the process of taking in oxygen and releasing carbon dioxide in living organisms.', 7, '2026-04-07 10:45:14', '2026-04-07 10:45:14', NULL, 'ai_generated'),
(392, 9, 323, 10, NULL, NULL, 'objective', 'Which of the following is an example of a unicellular organism?', 'medium', NULL, 30, 'C', NULL, 'Amoeba is a unicellular organism.', 7, '2026-04-07 10:45:14', '2026-04-07 10:45:14', NULL, 'ai_generated'),
(393, 9, 323, 10, NULL, NULL, 'fill_in_the_gap', 'What is the process by which living organisms produce offspring of the same kind?', 'medium', NULL, 30, 'Reproduction', NULL, 'Reproduction is the process of producing offspring of the same kind in living organisms.', 7, '2026-04-07 10:45:14', '2026-04-07 10:45:14', NULL, 'ai_generated'),
(394, 9, 323, 10, NULL, NULL, 'objective', 'Which of the following is responsible for carrying genetic information in living organisms?', 'medium', NULL, 30, 'C', NULL, 'DNA carries genetic information in living organisms.', 7, '2026-04-07 10:45:14', '2026-04-07 10:45:14', NULL, 'ai_generated'),
(395, 9, 323, 10, NULL, NULL, 'fill_in_the_gap', 'What is the process by which living organisms respond to changes in their environment?', 'medium', NULL, 30, 'Stimulus', NULL, 'Living organisms respond to changes in their environment through the process of stimulus.', 7, '2026-04-07 10:45:14', '2026-04-07 10:45:14', NULL, 'ai_generated'),
(396, 9, 323, 10, NULL, NULL, 'objective', 'Which of the following is not a kingdom in the classification of living organisms?', 'medium', NULL, 30, 'C', NULL, 'Mineralia is not a kingdom in the classification of living organisms.', 7, '2026-04-07 10:45:14', '2026-04-07 10:45:14', NULL, 'ai_generated'),
(397, 1, 333, 11, NULL, NULL, 'fill_in_the_gap', 'Find the limit of (3x^2 - 2x + 1) / x as x approaches 2.', 'medium', NULL, 30, '7', NULL, 'Simply substitute x=2 into the expression to get (3(2)^2 - 2(2) + 1) / 2 = 7', 7, '2026-04-07 10:47:06', '2026-04-07 10:47:06', NULL, 'ai_generated'),
(398, 1, 333, 11, NULL, NULL, 'fill_in_the_gap', 'Calculate the limit of (e^x - 1) / x as x approaches 0.', 'medium', NULL, 30, '1', NULL, 'Apply L\'Hopital\'s Rule or use the definition of the derivative of e^x to get the limit as 1.', 7, '2026-04-07 10:47:06', '2026-04-07 10:47:06', NULL, 'ai_generated'),
(399, 1, 333, 11, NULL, NULL, 'fill_in_the_gap', 'What is the limit of sin(2x) / x as x approaches 0?', 'medium', NULL, 30, '2', NULL, 'The limit can be found by recognizing that sin(2x) / x is equivalent to 2 as x approaches 0.', 7, '2026-04-07 10:47:06', '2026-04-07 10:47:06', NULL, 'ai_generated'),
(400, 1, 333, 11, NULL, NULL, 'fill_in_the_gap', 'Evaluate the limit lim(x->1) [(x^2 + 3x - 4) / (x^2 - 1)].', 'medium', NULL, 30, '5', NULL, 'Factorize the expression to simplify and then substitute x=1 to get the limit as 5.', 7, '2026-04-07 10:47:06', '2026-04-07 10:47:06', NULL, 'ai_generated'),
(401, 1, 333, 11, NULL, NULL, 'fill_in_the_gap', 'Find the limit lim(x->3) [(x^3 - 27) / (x - 3)].', 'medium', NULL, 30, '27', NULL, 'Factorize the numerator as (x-3)(x^2+3x+9) and simplify to get the limit as 27.', 7, '2026-04-07 10:47:06', '2026-04-07 10:47:06', NULL, 'ai_generated'),
(402, 1, 333, 11, NULL, NULL, 'fill_in_the_gap', 'Determine the limit lim(x->0) (tan(x) / x).', 'medium', NULL, 30, '1', NULL, 'This limit is a well-known result in calculus and evaluates to 1 as x approaches 0.', 7, '2026-04-07 10:47:06', '2026-04-07 10:47:06', NULL, 'ai_generated'),
(403, 1, 333, 11, NULL, NULL, 'fill_in_the_gap', 'What is the limit lim(x->2) [(x^2 - 4) / (x - 2)].', 'medium', NULL, 30, '4', NULL, 'Simplify the expression to (x-2)(x+2) / (x-2) and evaluate the limit as x=2 to get 4.', 7, '2026-04-07 10:47:06', '2026-04-07 10:47:06', NULL, 'ai_generated'),
(404, 1, 333, 11, NULL, NULL, 'fill_in_the_gap', 'Compute the limit lim(x->pi/4) [(cos(x) - 1) / (x - pi/4)].', 'medium', NULL, 30, '0', NULL, 'Use trigonometric identities to simplify the expression and then substitute x=pi/4 to get the limit as 0.', 7, '2026-04-07 10:47:06', '2026-04-07 10:47:06', NULL, 'ai_generated'),
(405, 1, 333, 11, NULL, NULL, 'fill_in_the_gap', 'Find the limit lim(x->1) [sqrt(x+1) - 2] / [x - 1].', 'medium', NULL, 30, '1/4', NULL, 'Rationalize the numerator and simplify to get the limit as 1/4.', 7, '2026-04-07 10:47:06', '2026-04-07 10:47:06', NULL, 'ai_generated'),
(406, 1, 333, 11, NULL, NULL, 'fill_in_the_gap', 'Calculate the limit lim(x->0) [(1 - cos(x)) / x].', 'medium', NULL, 30, '0', NULL, 'Apply trigonometric identity and simplify to get the limit as 0.', 7, '2026-04-07 10:47:06', '2026-04-07 10:47:06', NULL, 'ai_generated'),
(407, 7, 345, 11, NULL, NULL, 'objective', 'What is the SI unit of electric current?', 'medium', NULL, 30, 'A', NULL, 'The SI unit of electric current is Ampere (A).', 7, '2026-04-07 10:50:57', '2026-04-07 10:50:57', NULL, 'ai_generated'),
(408, 7, 345, 11, NULL, NULL, 'fill_in_the_gap', 'What is the formula to calculate electric power?', 'medium', NULL, 30, 'P = V x I', NULL, 'The formula to calculate electric power is P = V x I, where P is power, V is voltage, and I is current.', 7, '2026-04-07 10:50:57', '2026-04-07 10:50:57', NULL, 'ai_generated'),
(409, 7, 345, 11, NULL, NULL, 'fill_in_the_gap', 'What is the resistance of a circuit if the voltage is 12V and the current is 3A?', 'medium', NULL, 30, '4 Ohms', NULL, 'Using Ohm\'s Law (R = V / I), the resistance is calculated as 12V / 3A = 4 Ohms.', 7, '2026-04-07 10:50:57', '2026-04-07 10:50:57', NULL, 'ai_generated'),
(410, 7, 345, 11, NULL, NULL, 'objective', 'Which material is a good conductor of electricity?', 'medium', NULL, 30, 'C', NULL, 'Copper is a good conductor of electricity due to its high electrical conductivity.', 7, '2026-04-07 10:50:57', '2026-04-07 10:50:57', NULL, 'ai_generated'),
(411, 7, 345, 11, NULL, NULL, 'objective', 'What happens to the resistance of a wire if its length is doubled?', 'medium', NULL, 30, 'A', NULL, 'The resistance of a wire is directly proportional to its length, so if the length is doubled, the resistance also doubles.', 7, '2026-04-07 10:50:57', '2026-04-07 10:50:57', NULL, 'ai_generated'),
(412, 7, 345, 11, NULL, NULL, 'objective', 'What is the purpose of an electric fuse in a circuit?', 'medium', NULL, 30, 'C', NULL, 'An electric fuse is used to protect the circuit against overcurrent by melting and breaking the circuit when the current exceeds a safe level.', 7, '2026-04-07 10:50:57', '2026-04-07 10:50:57', NULL, 'ai_generated'),
(413, 7, 345, 11, NULL, NULL, 'fill_in_the_gap', 'What is the potential difference across a 10-ohm resistor with a current of 2A flowing through it?', 'medium', NULL, 30, '20 Volts', NULL, 'Using Ohm\'s Law (V = I x R), the potential difference is calculated as 2A x 10 Ohms = 20 Volts.', 7, '2026-04-07 10:50:57', '2026-04-07 10:50:57', NULL, 'ai_generated'),
(414, 7, 345, 11, NULL, NULL, 'objective', 'Which type of circuit has all components connected in a single loop?', 'medium', NULL, 30, 'B', NULL, 'In a series circuit, all components are connected in a single loop, providing only one path for the current.', 7, '2026-04-07 10:50:57', '2026-04-07 10:50:57', NULL, 'ai_generated'),
(415, 7, 345, 11, NULL, NULL, 'objective', 'What effect does increasing the temperature of a conductor have on its resistance?', 'medium', NULL, 30, 'A', NULL, 'Increasing the temperature of a conductor increases its resistance due to more collisions between electrons and atoms.', 7, '2026-04-07 10:50:57', '2026-04-07 10:50:57', NULL, 'ai_generated'),
(416, 7, 345, 11, NULL, NULL, 'objective', 'What property of a material determines its electrical conductivity?', 'medium', NULL, 30, 'C', NULL, 'The electrical conductivity of a material is primarily determined by its atomic structure and the availability of free electrons for conduction.', 7, '2026-04-07 10:50:57', '2026-04-07 10:50:57', NULL, 'ai_generated'),
(417, 8, 348, 11, NULL, NULL, 'objective', 'Which functional group is present in an alcohol?', 'medium', NULL, 30, 'B', NULL, 'Alcohols contain the hydroxyl functional group (-OH).', 7, '2026-04-07 10:52:54', '2026-04-07 10:52:54', NULL, 'ai_generated'),
(418, 8, 348, 11, NULL, NULL, 'objective', 'What is the general formula for an alkane?', 'medium', NULL, 30, 'B', NULL, 'Alkanes have the general formula CnH2n+2.', 7, '2026-04-07 10:52:54', '2026-04-07 10:52:54', NULL, 'ai_generated'),
(419, 8, 348, 11, NULL, NULL, 'objective', 'Which of the following is a primary alcohol?', 'medium', NULL, 30, 'A', NULL, 'Ethanol is a primary alcohol where the -OH group is attached to a carbon that is only attached to one other carbon.', 7, '2026-04-07 10:52:54', '2026-04-07 10:52:54', NULL, 'ai_generated'),
(420, 8, 348, 11, NULL, NULL, 'fill_in_the_gap', 'What is the IUPAC name for CH3CH2CH2OH?', 'medium', NULL, 30, 'Butan-1-ol', NULL, 'The IUPAC name for CH3CH2CH2OH is Butan-1-ol.', 7, '2026-04-07 10:52:54', '2026-04-07 10:52:54', NULL, 'ai_generated'),
(421, 8, 348, 11, NULL, NULL, 'objective', 'Which functional group is present in a carboxylic acid?', 'medium', NULL, 30, 'C', NULL, 'Carboxylic acids contain the carboxyl functional group (-COOH).', 7, '2026-04-07 10:52:54', '2026-04-07 10:52:54', NULL, 'ai_generated'),
(422, 8, 348, 11, NULL, NULL, 'fill_in_the_gap', 'What is the product of the complete combustion of an alkane?', 'medium', NULL, 30, 'Carbon dioxide and water', NULL, 'Complete combustion of an alkane produces carbon dioxide and water.', 7, '2026-04-07 10:52:54', '2026-04-07 10:52:54', NULL, 'ai_generated'),
(423, 8, 348, 11, NULL, NULL, 'objective', 'Which type of reaction converts an alkene to an alcohol?', 'medium', NULL, 30, 'C', NULL, 'Hydration is the reaction that converts an alkene to an alcohol by adding water across the double bond.', 7, '2026-04-07 10:52:54', '2026-04-07 10:52:54', NULL, 'ai_generated'),
(424, 8, 348, 11, NULL, NULL, 'objective', 'What is the functional group present in an aldehyde?', 'medium', NULL, 30, 'C', NULL, 'Aldehydes contain the carbonyl functional group (-CHO).', 7, '2026-04-07 10:52:54', '2026-04-07 10:52:54', NULL, 'ai_generated'),
(425, 8, 348, 11, NULL, NULL, 'fill_in_the_gap', 'What is the IUPAC name for CH3COOH?', 'medium', NULL, 30, 'Ethanoic acid', NULL, 'The IUPAC name for CH3COOH is Ethanoic acid.', 7, '2026-04-07 10:52:54', '2026-04-07 10:52:54', NULL, 'ai_generated'),
(426, 8, 348, 11, NULL, NULL, 'objective', 'Which of the following is a secondary alcohol?', 'medium', NULL, 30, 'D', NULL, 'Isopropanol is a secondary alcohol where the -OH group is attached to a carbon that is attached to two other carbons.', 7, '2026-04-07 10:52:54', '2026-04-07 10:52:54', NULL, 'ai_generated'),
(427, 9, 353, 11, NULL, NULL, 'objective', 'What is the term for a close relationship between two species where one organism benefits and the other is neither helped nor harmed?', 'medium', NULL, 30, 'B', NULL, 'Commensalism is a symbiotic relationship where one organism benefits while the other is unaffected.', 7, '2026-04-07 10:54:20', '2026-04-07 10:54:20', NULL, 'ai_generated'),
(428, 9, 353, 11, NULL, NULL, 'objective', 'Which of the following best describes an ecosystem?', 'medium', NULL, 30, 'B', NULL, 'An ecosystem includes all the living (biotic) and non-living (abiotic) components of a specific area.', 7, '2026-04-07 10:54:20', '2026-04-07 10:54:20', NULL, 'ai_generated'),
(429, 9, 353, 11, NULL, NULL, 'objective', 'Which of the following organisms is a primary consumer in a food chain?', 'medium', NULL, 30, 'D', NULL, 'A primary consumer feeds directly on producers, such as plants. In this case, the rabbit consumes the grass.', 7, '2026-04-07 10:54:20', '2026-04-07 10:54:20', NULL, 'ai_generated'),
(430, 9, 353, 11, NULL, NULL, 'fill_in_the_gap', 'What is the process by which green plants and some other organisms use sunlight to synthesize foods with the help of chlorophyll?', 'medium', NULL, 30, 'Photosynthesis', NULL, 'Photosynthesis is the process by which plants convert light energy into chemical energy stored in glucose.', 7, '2026-04-07 10:54:21', '2026-04-07 10:54:21', NULL, 'ai_generated'),
(431, 9, 353, 11, NULL, NULL, 'objective', 'Which of the following biomes is characterized by low temperatures, little precipitation, and permafrost?', 'medium', NULL, 30, 'C', NULL, 'The tundra biome is known for its cold temperatures, minimal precipitation, and frozen subsoil called permafrost.', 7, '2026-04-07 10:54:21', '2026-04-07 10:54:21', NULL, 'ai_generated'),
(432, 9, 353, 11, NULL, NULL, 'fill_in_the_gap', 'What is the term for the gradual process by which ecosystems change and develop over time?', 'medium', NULL, 30, 'Succession', NULL, 'Succession refers to the sequential replacement of plant and animal species in an ecosystem over time.', 7, '2026-04-07 10:54:21', '2026-04-07 10:54:21', NULL, 'ai_generated'),
(433, 9, 353, 11, NULL, NULL, 'objective', 'Which of the following human activities is a major contributor to deforestation?', 'medium', NULL, 30, 'C', NULL, 'Agriculture, especially through practices like slash-and-burn, is a significant cause of deforestation worldwide.', 7, '2026-04-07 10:54:21', '2026-04-07 10:54:21', NULL, 'ai_generated'),
(434, 9, 353, 11, NULL, NULL, 'fill_in_the_gap', 'What is the term for the variety of life in all its forms, levels, and combinations, including ecosystem diversity, species diversity, and genetic diversity?', 'medium', NULL, 30, 'Biodiversity', NULL, 'Biodiversity encompasses the richness and variety of life on Earth, from genes to ecosystems.', 7, '2026-04-07 10:54:21', '2026-04-07 10:54:21', NULL, 'ai_generated'),
(435, 9, 353, 11, NULL, NULL, 'objective', 'Which of the following is a biotic factor in an ecosystem?', 'medium', NULL, 30, 'D', NULL, 'Fungi are living organisms and therefore considered biotic factors in an ecosystem.', 7, '2026-04-07 10:54:21', '2026-04-07 10:54:21', NULL, 'ai_generated'),
(436, 9, 353, 11, NULL, NULL, 'fill_in_the_gap', 'What is the term for the process by which water from plants evaporates into the atmosphere?', 'medium', NULL, 30, 'Transpiration', NULL, 'Transpiration is the release of water vapor from plant leaves into the air, contributing to the water cycle.', 7, '2026-04-07 10:54:21', '2026-04-07 10:54:21', NULL, 'ai_generated');

-- --------------------------------------------------------

--
-- Table structure for table `question_options`
--

CREATE TABLE `question_options` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `result_scores`
--

CREATE TABLE `result_scores` (
  `id` bigint NOT NULL,
  `school_id` bigint NOT NULL,
  `student_details_id` bigint NOT NULL,
  `class_id` bigint NOT NULL,
  `subject_id` bigint NOT NULL,
  `session` varchar(20) NOT NULL,
  `term` varchar(20) NOT NULL,
  `test_score` decimal(5,2) DEFAULT '0.00',
  `exam_score` decimal(5,2) DEFAULT '0.00',
  `total_score` decimal(5,2) DEFAULT '0.00',
  `grade` varchar(5) DEFAULT NULL,
  `remark` varchar(50) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `teacher_remark` text,
  `principal_remark` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `result_scores`
--

INSERT INTO `result_scores` (`id`, `school_id`, `student_details_id`, `class_id`, `subject_id`, `session`, `term`, `test_score`, `exam_score`, `total_score`, `grade`, `remark`, `status`, `created_at`, `updated_at`, `teacher_remark`, `principal_remark`) VALUES
(1, 1, 1, 2, 1, '2025/2026', '1st Term', 28.00, 65.00, 93.00, 'A', 'Excellent', 'released', '2026-04-24 20:52:04', '2026-04-24 20:53:24', NULL, NULL),
(2, 1, 1, 2, 3, '2025/2026', '1st Term', 29.00, 67.00, 96.00, 'A', 'Excellent', 'released', '2026-04-24 20:52:04', '2026-04-24 20:53:24', NULL, NULL),
(3, 1, 1, 2, 1, '2025/2026', '2nd Term', 30.00, 65.00, 95.00, 'A', 'Excellent', 'released', '2026-04-24 21:47:45', '2026-04-24 21:48:47', NULL, NULL),
(4, 1, 1, 2, 3, '2025/2026', '2nd Term', 28.00, 68.00, 96.00, 'A', 'Excellent', 'released', '2026-04-24 21:47:45', '2026-04-24 21:48:47', NULL, NULL),
(5, 1, 1, 2, 1, '2025/2026', '3rd Term', 26.00, 66.00, 92.00, 'A', 'Excellent', 'released', '2026-04-24 22:13:53', '2026-04-24 22:15:32', NULL, NULL),
(6, 1, 1, 2, 3, '2025/2026', '3rd Term', 24.00, 67.00, 91.00, 'A', 'Excellent', 'released', '2026-04-24 22:13:53', '2026-04-24 22:15:32', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `registration_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `referrer_code_used` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `referral_user_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_plan` enum('paid','free') DEFAULT 'paid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `name`, `address`, `registration_number`, `referrer_code_used`, `referral_user_id`, `created_at`, `updated_at`, `payment_plan`) VALUES
(1, 'Hanif School', 'Dalemo', 'SCHFFYTFTDE', NULL, NULL, '2026-04-23 13:45:48', '2026-04-23 13:45:48', 'paid'),
(2, 'Hanif School', 'No, 4 Grace Crescent Avenue.', 'SCH3OKYRPKY', '309899', 2, '2026-04-23 16:44:23', '2026-04-23 16:44:23', 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `school_books`
--

CREATE TABLE `school_books` (
  `id` bigint NOT NULL,
  `school_id` bigint NOT NULL,
  `class_id` bigint NOT NULL,
  `term` varchar(100) NOT NULL,
  `session` varchar(100) NOT NULL,
  `textbooks` text,
  `notebooks` int DEFAULT NULL,
  `workbooks` text,
  `materials` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `school_books`
--

INSERT INTO `school_books` (`id`, `school_id`, `class_id`, `term`, `session`, `textbooks`, `notebooks`, `workbooks`, `materials`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'First Term', '2025/2026', 'Comprehensive English Textbook, math textbook.', NULL, NULL, 'Cleaner, Sharpener, Cardboard, Pens, Pencil.', '2026-04-24 01:06:14', '2026-04-24 01:09:42');

-- --------------------------------------------------------

--
-- Table structure for table `school_classes`
--

CREATE TABLE `school_classes` (
  `id` int NOT NULL,
  `school_id` int NOT NULL,
  `class_level_id` int NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `school_classes`
--

INSERT INTO `school_classes` (`id`, `school_id`, `class_level_id`, `created_at`, `updated_at`) VALUES
(1, 7, 1, '2026-04-08 10:07:16', '2026-04-08 10:07:16'),
(2, 7, 2, '2026-04-08 10:07:16', '2026-04-08 10:07:16'),
(4, 7, 4, '2026-04-08 10:40:07', '2026-04-08 10:40:07'),
(5, 7, 5, '2026-04-08 10:40:07', '2026-04-08 10:40:07'),
(6, 7, 6, '2026-04-08 10:40:07', '2026-04-08 10:40:07'),
(7, 7, 7, '2026-04-08 10:40:07', '2026-04-08 10:40:07'),
(12, 7, 3, '2026-04-08 10:42:33', '2026-04-08 10:42:33'),
(13, 7, 8, '2026-04-08 10:42:33', '2026-04-08 10:42:33'),
(17, 7, 9, '2026-04-08 12:35:25', '2026-04-08 12:35:25'),
(18, 7, 10, '2026-04-08 12:35:25', '2026-04-08 12:35:25'),
(19, 1, 1, '2026-04-23 13:51:01', '2026-04-23 13:51:01'),
(20, 1, 2, '2026-04-23 13:51:01', '2026-04-23 13:51:01'),
(21, 1, 3, '2026-04-23 13:51:01', '2026-04-23 13:51:01'),
(22, 1, 4, '2026-04-23 13:51:01', '2026-04-23 13:51:01'),
(23, 1, 5, '2026-04-23 13:51:01', '2026-04-23 13:51:01'),
(24, 1, 6, '2026-04-23 13:51:01', '2026-04-23 13:51:01'),
(25, 2, 1, '2026-04-23 16:45:32', '2026-04-23 16:45:32'),
(26, 2, 2, '2026-04-23 16:45:32', '2026-04-23 16:45:32'),
(27, 2, 3, '2026-04-23 16:45:32', '2026-04-23 16:45:32'),
(28, 2, 4, '2026-04-23 16:45:32', '2026-04-23 16:45:32'),
(29, 2, 5, '2026-04-23 16:45:32', '2026-04-23 16:45:32'),
(30, 2, 6, '2026-04-23 16:45:32', '2026-04-23 16:45:32');

-- --------------------------------------------------------

--
-- Table structure for table `school_details`
--

CREATE TABLE `school_details` (
  `id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `school_id` bigint NOT NULL,
  `has_paid` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `school_details`
--

INSERT INTO `school_details` (`id`, `user_id`, `school_id`, `has_paid`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '1', '2026-04-23 13:45:48', '2026-04-23 13:45:48'),
(2, 3, 2, '1', '2026-04-23 16:44:23', '2026-04-23 16:44:23');

-- --------------------------------------------------------

--
-- Table structure for table `school_fees`
--

CREATE TABLE `school_fees` (
  `id` bigint NOT NULL,
  `school_id` bigint NOT NULL,
  `class_id` bigint NOT NULL,
  `term` varchar(100) NOT NULL,
  `session` varchar(100) NOT NULL,
  `tuition` decimal(12,2) DEFAULT '0.00',
  `uniforms` decimal(12,2) DEFAULT '0.00',
  `sports_wear` decimal(12,2) DEFAULT '0.00',
  `books` decimal(12,2) DEFAULT '0.00',
  `exam_fee` decimal(12,2) DEFAULT '0.00',
  `pta_levy` decimal(12,2) DEFAULT '0.00',
  `other_fee` decimal(12,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `school_fees`
--

INSERT INTO `school_fees` (`id`, `school_id`, `class_id`, `term`, `session`, `tuition`, `uniforms`, `sports_wear`, `books`, `exam_fee`, `pta_levy`, `other_fee`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'First Term', '2025/2026', 47500.00, 12000.00, NULL, 21500.00, NULL, NULL, NULL, '2026-04-24 00:48:18', '2026-04-24 00:50:14'),
(2, 2, 2, 'First Term', '2025/2026', 49000.00, 12000.00, NULL, 23500.00, NULL, NULL, NULL, '2026-04-24 00:49:37', '2026-04-24 00:49:37'),
(3, 2, 3, 'First Term', '2025/2026', 59000.00, 12000.00, NULL, 43500.00, NULL, NULL, NULL, '2026-04-25 11:10:44', '2026-04-25 11:10:44');

-- --------------------------------------------------------

--
-- Table structure for table `school_fee_payments`
--

CREATE TABLE `school_fee_payments` (
  `id` bigint NOT NULL,
  `student_id` bigint NOT NULL,
  `school_id` bigint NOT NULL,
  `class_id` bigint NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `reference_no` varchar(255) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `proof` varchar(255) DEFAULT NULL,
  `status` varchar(30) DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `school_fee_payments`
--

INSERT INTO `school_fee_payments` (`id`, `student_id`, `school_id`, `class_id`, `amount`, `reference_no`, `payment_date`, `proof`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, 2, 2, 80000.00, 'g&77w899rr0jifij', '2026-04-24', '1776996800.pdf', 'confirmed', '2026-04-24 01:13:20', '2026-04-24 01:19:03');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('rM7v9qCHOrXsSSkqH2xw0o9Uynnydt52f2d3pSwc', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibk8yUmhaOVdSVWh1b1FGa0p6VWVKR24wSkE3TEthNHVENks5alNDYSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zY2hvb2wvdGVhY2hlcnMiO3M6NToicm91dGUiO3M6MTU6InNjaG9vbC50ZWFjaGVycyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1777125137);

-- --------------------------------------------------------

--
-- Table structure for table `student_answers`
--

CREATE TABLE `student_answers` (
  `id` bigint NOT NULL,
  `attempt_id` bigint DEFAULT NULL,
  `question_id` bigint DEFAULT NULL,
  `answer` text,
  `is_correct` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_details`
--

CREATE TABLE `student_details` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `registration_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `has_paid` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_sub` tinyint DEFAULT '0',
  `payment_reference` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_date` timestamp(6) NULL DEFAULT NULL,
  `payment_expiry` timestamp(6) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `school_id` int DEFAULT NULL,
  `class_id` int DEFAULT NULL,
  `teacher_id` bigint DEFAULT NULL,
  `face_descriptor` longtext COLLATE utf8mb4_unicode_ci,
  `face_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referrer_code_used` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_details`
--

INSERT INTO `student_details` (`id`, `user_id`, `registration_number`, `has_paid`, `email_sub`, `payment_reference`, `guardian_email`, `payment_date`, `payment_expiry`, `created_at`, `updated_at`, `school_id`, `class_id`, `teacher_id`, `face_descriptor`, `face_photo`, `referrer_code_used`, `referral_user_id`) VALUES
(1, 6, 'STUIH6QIWUF', '1', 1, 'BULK-C8NDM20T', 'olaitanabidemi2007@gmail.com', '2026-04-23 23:18:38.000000', '2027-04-23 23:18:38.000000', '2026-04-23 23:08:58', '2026-04-25 06:58:12', 2, 2, 5, '[-0.1872820109128952,0.17844688892364502,0.11145588010549545,0.00339215574786067,0.06758920848369598,-0.04497242346405983,0.030650220811367035,-0.028310341760516167,0.15635628998279572,-0.034413985908031464,0.32404229044914246,0.06028227135539055,-0.23126885294914246,-0.16790784895420074,0.06902024149894714,0.09788911044597626,-0.16127513349056244,-0.1064482033252716,-0.04063647240400314,-0.11349879950284958,0.03016326203942299,0.07203730195760727,-0.012348643504083157,0.08336272090673447,-0.10857553780078888,-0.234655499458313,-0.03608227148652077,-0.13808701932430267,0.08841085433959961,-0.10304253548383713,-0.02303662896156311,0.005209000315517187,-0.12030259519815445,-0.0068814740516245365,-0.07583078742027283,0.01031930185854435,0.053369466215372086,-0.03753426671028137,0.2046000063419342,0.0003750549512915313,-0.06774575263261795,-0.08219890296459198,-0.0015342257684096694,0.32663828134536743,0.21706394851207733,-0.05816662311553955,0.01543187815696001,-0.00011163959425175563,0.07407502084970474,-0.21711894869804382,0.002496796427294612,0.13481329381465912,0.20024411380290985,0.1053994670510292,-0.019130822271108627,-0.17322596907615662,-0.055703915655612946,-0.03756962716579437,-0.14499971270561218,0.027485281229019165,-0.02037709392607212,-0.0960797369480133,-0.09169381856918335,-0.01563766598701477,0.3009045720100403,0.06713902205228806,-0.14750374853610992,-0.13520357012748718,0.16693928837776184,-0.0982426181435585,-0.08854249864816666,0.12499535828828812,-0.1466253101825714,-0.08366049081087112,-0.22780586779117584,0.13986842334270477,0.27460551261901855,0.07673850655555725,-0.2161143571138382,0.06935854256153107,-0.23825807869434357,-0.004951740149408579,-0.05475330352783203,0.030992932617664337,-0.09991942346096039,0.0042441715486347675,-0.14672602713108063,0.0469205416738987,0.15089088678359985,-0.020487111061811447,-0.05004166066646576,0.19822221994400024,0.03524993360042572,0.03259246423840523,0.031817566603422165,0.04864555597305298,-0.024085858836770058,-0.0035183520521968603,-0.06022202968597412,-0.032093629240989685,0.14882788062095642,-0.0794706791639328,0.047841768711805344,0.10752573609352112,-0.20910435914993286,0.18279053270816803,0.07009021937847137,0.04350672662258148,0.09432116895914078,0.052024323493242264,-0.09300994873046875,-0.04166693240404129,0.1460757702589035,-0.22747644782066345,0.21545106172561646,0.09280393272638321,0.04145859181880951,0.14480538666248322,0.03128902241587639,0.1387612372636795,-0.07932037115097046,-0.03376184403896332,-0.06182065233588219,-0.04456208646297455,0.06594480574131012,-0.008364783599972725,0.06618153303861618,0.06422778218984604]', 'faces/1777103892_1.png', '309899', 2),
(2, 7, 'STUXBH87ESL', '1', 1, 'BULK-C8NDM20T', 'olaitan.okunloro@etexgroup.com', '2026-04-23 23:18:38.000000', '2027-04-23 23:18:38.000000', '2026-04-23 23:11:35', '2026-04-25 08:13:43', 2, 1, 4, '[-0.16007845103740692,0.07749012112617493,0.03234240412712097,-0.012925814837217331,-0.04920386150479317,-0.08783052861690521,0.06875349581241608,-0.06635565310716629,0.16746126115322113,-0.05491933971643448,0.244417205452919,-0.07496688514947891,-0.1611071079969406,-0.09747574478387833,-0.027477212250232697,0.18330855667591095,-0.17352193593978882,-0.06247754767537117,-0.05126746743917465,-0.08722369372844696,-0.03513650223612785,0.044575948268175125,-0.024330435320734978,0.15089410543441772,-0.09576186537742615,-0.2785014510154724,-0.05877029523253441,-0.21206171810626984,-0.021061766892671585,-0.09906765073537827,0.06513958424329758,0.20473501086235046,-0.12861573696136475,-0.0485403947532177,-0.006895660422742367,0.026585036888718605,0.06721702963113785,0.060461465269327164,0.2157621681690216,0.012820441275835037,-0.14252158999443054,-0.10935527831315994,0.03831889480352402,0.33880653977394104,0.10102898627519608,-0.04404816776514053,-0.002161974087357521,0.031693827360868454,0.05883847549557686,-0.1812972128391266,-0.05505971238017082,0.06704745441675186,0.09263608604669571,0.0385066457092762,-0.01017598807811737,-0.1311655193567276,0.0015955629060044885,0.05816885828971863,-0.2139420062303543,0.04892708733677864,0.02133515104651451,-0.10382422059774399,-0.1135810986161232,-0.009711633436381817,0.2984173893928528,0.06673243641853333,-0.14846965670585632,-0.07822709530591965,0.18815100193023682,-0.15770883858203888,-0.05352451279759407,0.08211051672697067,-0.110165536403656,-0.1583353877067566,-0.31469255685806274,0.04592404142022133,0.39947596192359924,0.1207825317978859,-0.21733321249485016,0.03144083544611931,-0.13968460261821747,-0.025698497891426086,0.06654354929924011,0.0968841016292572,-0.06201579421758652,0.06704490631818771,-0.03481518477201462,-0.020291687920689583,0.11963030695915222,0.056707195937633514,-0.061112385243177414,0.2099388837814331,-0.0069381133653223515,0.010790692642331123,0.007552953436970711,-0.06124243885278702,0.03316095471382141,-0.0764535441994667,-0.12919668853282928,0.0021576732397079468,-0.0175954457372427,-0.08378271013498306,-0.03048778884112835,0.08410388976335526,-0.223867267370224,0.15338869392871857,0.07492586225271225,-0.008652896620333195,-0.04641379043459892,0.13247989118099213,-0.1374056041240692,-0.03283966705203056,0.2091008722782135,-0.24333806335926056,0.1405188888311386,0.14440764486789703,0.027086282148957253,0.15787199139595032,0.04889291152358055,0.06748038530349731,-0.059613749384880066,-0.05841735005378723,-0.11598406732082367,-0.04394662752747536,0.15773367881774902,-0.0962236151099205,0.0739373043179512,0.004161702934652567]', 'faces/1777108423_2.png', '309899', 2);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`) VALUES
(1, 'Mathematics'),
(3, 'English'),
(4, 'Basic Science'),
(5, 'Social Study'),
(6, 'Basic Technology'),
(7, 'Physics'),
(8, 'Chemistry'),
(9, 'Biology');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint NOT NULL,
  `sub_amount` double NOT NULL,
  `email_sub` double NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `sub_amount`, `email_sub`, `created_at`, `updated_at`) VALUES
(1, 3000, 1500, '2026-04-16 13:33:33', '2026-04-16 13:33:33');

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` varchar(30) DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_details`
--

CREATE TABLE `teacher_details` (
  `id` int NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `class_id` int NOT NULL,
  `school_id` int NOT NULL,
  `has_paid` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `teacher_details`
--

INSERT INTO `teacher_details` (`id`, `user_id`, `class_id`, `school_id`, `has_paid`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 2, '1', '2026-04-23 16:48:54', '2026-04-23 16:48:54'),
(2, 5, 2, 2, '1', '2026-04-23 16:58:44', '2026-04-23 16:58:44');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_options`
--

CREATE TABLE `teacher_options` (
  `id` bigint NOT NULL,
  `question_id` bigint DEFAULT NULL,
  `option_label` char(1) DEFAULT NULL,
  `option_text` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `teacher_options`
--

INSERT INTO `teacher_options` (`id`, `question_id`, `option_label`, `option_text`, `created_at`, `updated_at`) VALUES
(1, 1, 'A', 'I am singing in the choir.', '2026-04-24 20:45:00', '2026-04-24 20:45:00'),
(2, 1, 'B', 'She will bake a cake tomorrow.', '2026-04-24 20:45:00', '2026-04-24 20:45:00'),
(3, 1, 'C', 'They are playing in the park now.', '2026-04-24 20:45:00', '2026-04-24 20:45:00'),
(4, 1, 'D', 'He danced at the concert yesterday.', '2026-04-24 20:45:00', '2026-04-24 20:45:00'),
(5, 3, 'A', 'ate', '2026-04-24 20:45:01', '2026-04-24 20:45:01'),
(6, 3, 'B', 'eating', '2026-04-24 20:45:01', '2026-04-24 20:45:01'),
(7, 3, 'C', 'eats', '2026-04-24 20:45:01', '2026-04-24 20:45:01'),
(8, 3, 'D', 'will eat', '2026-04-24 20:45:01', '2026-04-24 20:45:01'),
(9, 4, 'A', 'She will sing at the concert.', '2026-04-24 20:45:01', '2026-04-24 20:45:01'),
(10, 4, 'B', 'They swim in the pool.', '2026-04-24 20:45:01', '2026-04-24 20:45:01'),
(11, 4, 'C', 'He danced at the party.', '2026-04-24 20:45:01', '2026-04-24 20:45:01'),
(12, 4, 'D', 'I have read the book.', '2026-04-24 20:45:01', '2026-04-24 20:45:01'),
(13, 5, 'A', 'runned', '2026-04-24 20:45:01', '2026-04-24 20:45:01'),
(14, 5, 'B', 'running', '2026-04-24 20:45:01', '2026-04-24 20:45:01'),
(15, 5, 'C', 'ran', '2026-04-24 20:45:01', '2026-04-24 20:45:01'),
(16, 5, 'D', 'runs', '2026-04-24 20:45:01', '2026-04-24 20:45:01'),
(17, 8, 'A', 'She danced at the party.', '2026-04-24 20:45:01', '2026-04-24 20:45:01'),
(18, 8, 'B', 'They will swim in the pool.', '2026-04-24 20:45:01', '2026-04-24 20:45:01'),
(19, 8, 'C', 'He plays football every Saturday.', '2026-04-24 20:45:01', '2026-04-24 20:45:01'),
(20, 8, 'D', 'I ate my lunch an hour ago.', '2026-04-24 20:45:01', '2026-04-24 20:45:01'),
(21, 10, 'A', '14', '2026-04-24 20:46:41', '2026-04-24 20:46:41'),
(22, 10, 'B', '20', '2026-04-24 20:46:41', '2026-04-24 20:46:41'),
(23, 10, 'C', '25', '2026-04-24 20:46:41', '2026-04-24 20:46:41'),
(24, 10, 'D', '30', '2026-04-24 20:46:41', '2026-04-24 20:46:41'),
(25, 11, 'A', '101', '2026-04-24 20:46:41', '2026-04-24 20:46:41'),
(26, 11, 'B', '103', '2026-04-24 20:46:41', '2026-04-24 20:46:41'),
(27, 11, 'C', '107', '2026-04-24 20:46:41', '2026-04-24 20:46:41'),
(28, 11, 'D', '109', '2026-04-24 20:46:41', '2026-04-24 20:46:41'),
(29, 12, 'A', '1', '2026-04-24 20:46:41', '2026-04-24 20:46:41'),
(30, 12, 'B', '2', '2026-04-24 20:46:41', '2026-04-24 20:46:41'),
(31, 12, 'C', '3', '2026-04-24 20:46:41', '2026-04-24 20:46:41'),
(32, 12, 'D', '5', '2026-04-24 20:46:41', '2026-04-24 20:46:41'),
(33, 15, 'A', '198', '2026-04-24 20:46:41', '2026-04-24 20:46:41'),
(34, 15, 'B', '199', '2026-04-24 20:46:41', '2026-04-24 20:46:41'),
(35, 15, 'C', '201', '2026-04-24 20:46:41', '2026-04-24 20:46:41'),
(36, 15, 'D', '202', '2026-04-24 20:46:41', '2026-04-24 20:46:41'),
(37, 17, 'A', '50', '2026-04-24 20:46:41', '2026-04-24 20:46:41'),
(38, 17, 'B', '52', '2026-04-24 20:46:41', '2026-04-24 20:46:41'),
(39, 17, 'C', '54', '2026-04-24 20:46:41', '2026-04-24 20:46:41'),
(40, 17, 'D', '56', '2026-04-24 20:46:41', '2026-04-24 20:46:41');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subjects`
--

CREATE TABLE `teacher_subjects` (
  `id` bigint UNSIGNED NOT NULL,
  `teacher_id` bigint UNSIGNED NOT NULL,
  `school_id` int UNSIGNED NOT NULL,
  `subject_id` bigint UNSIGNED NOT NULL,
  `class_id` int UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher_subjects`
--

INSERT INTO `teacher_subjects` (`id`, `teacher_id`, `school_id`, `subject_id`, `class_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 4, 2, 1, 1, 1, '2026-04-23 18:19:13', '2026-04-23 18:19:13'),
(2, 5, 2, 3, 2, 1, '2026-04-23 18:19:13', '2026-04-23 18:19:13');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int NOT NULL,
  `class_level_id` int NOT NULL,
  `subject_id` bigint NOT NULL,
  `topic` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `class_level_id`, `subject_id`, `topic`) VALUES
(2, 1, 1, 'Whole numbers 1-100'),
(3, 1, 1, 'Addition without regrouping'),
(4, 1, 1, 'Subtraction without regrouping'),
(5, 1, 1, 'Multiplication tables 1-5'),
(6, 1, 1, 'Division sharing'),
(7, 1, 1, 'Fractions - halves and quarters'),
(8, 1, 1, 'Money - naira and kobo'),
(9, 1, 1, 'Time - o\'clock, half past'),
(10, 1, 1, 'Length and height'),
(11, 1, 1, 'Weight and capacity'),
(12, 1, 3, 'Alphabet and letter sounds'),
(13, 1, 3, 'Short vowel sounds'),
(14, 1, 3, 'Long vowel sounds'),
(15, 1, 3, 'Consonant blends'),
(16, 1, 3, 'Nouns - people, places, things'),
(17, 1, 3, 'Verbs - action words'),
(18, 1, 3, 'Adjectives - describing words'),
(19, 1, 3, 'Simple sentence structure'),
(20, 1, 3, 'Punctuation - full stop, comma'),
(21, 1, 3, 'Comprehension'),
(22, 2, 1, 'Whole numbers 1-500'),
(23, 2, 1, 'Addition with regrouping'),
(24, 2, 1, 'Subtraction with regrouping'),
(25, 2, 1, 'Multiplication tables 1-10'),
(26, 2, 1, 'Division with remainders'),
(27, 2, 1, 'Fractions - thirds and quarters'),
(28, 2, 1, 'Decimals - tenths'),
(29, 2, 1, 'Money - making change'),
(30, 2, 1, 'Time - quarter past, quarter to'),
(31, 2, 1, 'Perimeter'),
(32, 2, 3, 'Parts of speech'),
(33, 2, 3, 'Pronouns'),
(34, 2, 3, 'Tenses - present, past, future'),
(35, 2, 3, 'Sentence types'),
(36, 2, 3, 'Paragraph writing'),
(37, 2, 3, 'Story writing'),
(38, 2, 3, 'Letter writing'),
(39, 2, 3, 'Synonyms and antonyms'),
(40, 2, 3, 'Homophones'),
(41, 2, 3, 'Comprehension passages'),
(42, 3, 1, 'Whole numbers 1-1000'),
(43, 3, 1, 'Roman numerals I-X'),
(44, 3, 1, 'Multiplication up to 2-digit'),
(45, 3, 1, 'Division with remainder'),
(46, 3, 1, 'Fractions - equivalence'),
(47, 3, 1, 'Decimals - hundredths'),
(48, 3, 1, 'Area of rectangles'),
(49, 3, 1, 'Volume of cubes'),
(50, 3, 1, 'Angles - right, acute, obtuse'),
(51, 3, 1, 'Data handling - pictographs'),
(52, 3, 3, 'Nouns - common, proper, abstract'),
(53, 3, 3, 'Verbs - action, linking, helping'),
(54, 3, 3, 'Adjectives - comparative, superlative'),
(55, 3, 3, 'Adverbs'),
(56, 3, 3, 'Conjunctions'),
(57, 3, 3, 'Prepositions'),
(58, 3, 3, 'Direct and indirect speech'),
(59, 3, 3, 'Active and passive voice'),
(60, 3, 3, 'Composition writing'),
(61, 3, 3, 'Reading comprehension'),
(62, 3, 4, 'Living and non-living things'),
(63, 3, 4, 'Plants'),
(64, 3, 4, 'Animals'),
(65, 3, 4, 'Human body parts'),
(66, 3, 4, 'Sense organs'),
(67, 3, 4, 'Water'),
(68, 3, 4, 'Air'),
(69, 3, 4, 'Weather'),
(70, 3, 4, 'Soil'),
(71, 3, 4, 'Energy'),
(72, 4, 1, 'Whole numbers up to 10,000'),
(73, 4, 1, 'Roman numerals I-L'),
(74, 4, 1, 'Multiplication up to 3-digit'),
(75, 4, 1, 'Division up to 3-digit'),
(76, 4, 1, 'Fractions - addition, subtraction'),
(77, 4, 1, 'Decimals - addition, subtraction'),
(78, 4, 1, 'Percentages'),
(79, 4, 1, 'Ratio and proportion'),
(80, 4, 1, 'Averages'),
(81, 4, 1, 'Geometry - lines, angles, shapes'),
(82, 4, 3, 'Parts of speech review'),
(83, 4, 3, 'Subject-verb agreement'),
(84, 4, 3, 'Sentence structure'),
(85, 4, 3, 'Tenses'),
(86, 4, 3, 'Idioms and proverbs'),
(87, 4, 3, 'Figures of speech'),
(88, 4, 3, 'Essay writing - narrative'),
(89, 4, 3, 'Essay writing - descriptive'),
(90, 4, 3, 'Comprehension and summary'),
(91, 4, 3, 'Vocabulary development'),
(92, 4, 4, 'The digestive system'),
(93, 4, 4, 'The respiratory system'),
(94, 4, 4, 'The circulatory system'),
(95, 4, 4, 'The skeletal system'),
(96, 4, 4, 'Plants - photosynthesis'),
(97, 4, 4, 'Classification of animals'),
(98, 4, 4, 'Habitat and adaptation'),
(99, 4, 4, 'Light and shadow'),
(100, 4, 4, 'Sound'),
(101, 4, 4, 'Magnetism'),
(102, 4, 5, 'The family'),
(103, 4, 5, 'Culture and traditions'),
(104, 4, 5, 'Nigerian history'),
(105, 4, 5, 'Government'),
(106, 4, 5, 'Citizenship'),
(107, 4, 5, 'Community'),
(108, 4, 5, 'Occupation'),
(109, 4, 5, 'Transportation'),
(110, 4, 5, 'Communication'),
(111, 4, 5, 'Map reading'),
(112, 5, 1, 'Whole numbers up to 100,000'),
(113, 5, 1, 'Roman numerals I-C'),
(114, 5, 1, 'LCM and HCF'),
(115, 5, 1, 'Fractions - multiplication, division'),
(116, 5, 1, 'Decimals - multiplication, division'),
(117, 5, 1, 'Percentages - problems'),
(118, 5, 1, 'Simple interest'),
(119, 5, 1, 'Profit and loss'),
(120, 5, 1, 'Algebra - simple equations'),
(121, 5, 1, 'Statistics - mean, median, mode'),
(122, 5, 3, 'Advanced grammar'),
(123, 5, 3, 'Punctuation and capitalization'),
(124, 5, 3, 'Essay writing - expository'),
(125, 5, 3, 'Essay writing - argumentative'),
(126, 5, 3, 'Letter writing - formal'),
(127, 5, 3, 'Letter writing - informal'),
(128, 5, 3, 'Poetry'),
(129, 5, 3, 'Drama'),
(130, 5, 3, 'Oratory and public speaking'),
(131, 5, 3, 'Comprehensive reading'),
(132, 5, 4, 'Electricity'),
(133, 5, 4, 'Simple machines'),
(134, 5, 4, 'Forces and motion'),
(135, 5, 4, 'Heat and temperature'),
(136, 5, 4, 'Rocks and minerals'),
(137, 5, 4, 'The solar system'),
(138, 5, 4, 'The earth and its movements'),
(139, 5, 4, 'Environmental pollution'),
(140, 5, 4, 'Conservation of resources'),
(141, 5, 4, 'Disease prevention'),
(142, 5, 5, 'Nigerian festivals'),
(143, 5, 5, 'Nigerian ethnic groups'),
(144, 5, 5, 'Nigerian economy'),
(145, 5, 5, 'Democracy'),
(146, 5, 5, 'Human rights'),
(147, 5, 5, 'Conflict resolution'),
(148, 5, 5, 'Population'),
(149, 5, 5, 'Urbanization'),
(150, 5, 5, 'Globalization'),
(151, 5, 5, 'Peace education'),
(152, 6, 1, 'Whole numbers up to 1,000,000'),
(153, 6, 1, 'Roman numerals up to M'),
(154, 6, 1, 'Ratio and proportion'),
(155, 6, 1, 'Direct and inverse proportion'),
(156, 6, 1, 'Rate and speed'),
(157, 6, 1, 'Area of triangles and circles'),
(158, 6, 1, 'Volume of prisms'),
(159, 6, 1, 'Graph interpretation'),
(160, 6, 1, 'Algebra - equations'),
(161, 6, 1, 'Probability'),
(162, 6, 3, 'Examination preparation'),
(163, 6, 3, 'Review of all grammar topics'),
(164, 6, 3, 'Summary writing'),
(165, 6, 3, 'Speech writing'),
(166, 6, 3, 'Report writing'),
(167, 6, 3, 'Creative writing'),
(168, 6, 3, 'Literature review'),
(169, 6, 3, 'Vocabulary building'),
(170, 6, 3, 'Common entrance preparation'),
(171, 6, 3, 'Comprehension strategies'),
(172, 6, 4, 'Review of primary science'),
(173, 6, 4, 'Scientific investigation'),
(174, 6, 4, 'Technology and society'),
(175, 6, 4, 'Communication technology'),
(176, 6, 4, 'Agriculture'),
(177, 6, 4, 'Food and nutrition'),
(178, 6, 4, 'Water treatment'),
(179, 6, 4, 'Waste management'),
(180, 6, 4, 'Climate change'),
(181, 6, 4, 'Space exploration'),
(182, 6, 5, 'Nigerian constitution'),
(183, 6, 5, 'Arms of government'),
(184, 6, 5, 'Nigerian leadership'),
(185, 6, 5, 'National symbols'),
(186, 6, 5, 'International organizations'),
(187, 6, 5, 'Citizenship rights'),
(188, 6, 5, 'Family life education'),
(189, 6, 5, 'Drug abuse'),
(190, 6, 5, 'Examination ethics'),
(191, 6, 5, 'Career guidance'),
(192, 7, 1, 'Whole numbers'),
(193, 7, 1, 'Fractions'),
(194, 7, 1, 'Decimals'),
(195, 7, 1, 'Percentages'),
(196, 7, 1, 'Ratio and proportion'),
(197, 7, 1, 'Simple equations'),
(198, 7, 1, 'Number bases'),
(199, 7, 1, 'Modular arithmetic'),
(200, 7, 1, 'Indices'),
(201, 7, 1, 'Logarithms'),
(202, 7, 1, 'Sets'),
(203, 7, 1, 'Algebraic expressions'),
(204, 7, 1, 'Geometry - plane shapes'),
(205, 7, 1, 'Mensuration'),
(206, 7, 1, 'Statistics'),
(207, 7, 3, 'Parts of speech'),
(208, 7, 3, 'Sentence structure'),
(209, 7, 3, 'Tenses'),
(210, 7, 3, 'Active and passive voice'),
(211, 7, 3, 'Direct and indirect speech'),
(212, 7, 3, 'Essay writing'),
(213, 7, 3, 'Comprehension'),
(214, 7, 3, 'Summary'),
(215, 7, 3, 'Letter writing'),
(216, 7, 3, 'Literature'),
(217, 7, 4, 'Living things'),
(218, 7, 4, 'Classification of living things'),
(219, 7, 4, 'Cells and tissues'),
(220, 7, 4, 'Human reproduction'),
(221, 7, 4, 'Growth and development'),
(222, 7, 4, 'Matter'),
(223, 7, 4, 'Elements and compounds'),
(224, 7, 4, 'Mixtures'),
(225, 7, 4, 'Acids and bases'),
(226, 7, 4, 'Energy'),
(227, 7, 6, 'Workshop safety'),
(228, 7, 6, 'Woodwork'),
(229, 7, 6, 'Metalwork'),
(230, 7, 6, 'Drawing'),
(231, 7, 6, 'Building materials'),
(232, 7, 6, 'Electrical installation'),
(233, 7, 6, 'Electronics'),
(234, 7, 6, 'Mechanical systems'),
(235, 7, 6, 'Energy systems'),
(236, 7, 6, 'Maintenance'),
(237, 7, 5, 'Nigerian culture'),
(238, 7, 5, 'Family and marriage'),
(239, 7, 5, 'Citizenship'),
(240, 7, 5, 'Government'),
(241, 7, 5, 'Economy'),
(242, 7, 5, 'Geography'),
(243, 7, 5, 'History'),
(244, 7, 5, 'Human rights'),
(245, 7, 5, 'Social issues'),
(246, 7, 5, 'Sustainable development'),
(247, 8, 1, 'Algebraic fractions'),
(248, 8, 1, 'Linear equations'),
(249, 8, 1, 'Simultaneous equations'),
(250, 8, 1, 'Quadratic equations'),
(251, 8, 1, 'Inequalities'),
(252, 8, 1, 'Variation'),
(253, 8, 1, 'Trigonometric ratios'),
(254, 8, 1, 'Coordinate geometry'),
(255, 8, 1, 'Probability'),
(256, 8, 1, 'Statistics - measures of central tendency'),
(257, 8, 3, 'Figures of speech'),
(258, 8, 3, 'Vocabulary development'),
(259, 8, 3, 'Reading strategies'),
(260, 8, 3, 'Oral English'),
(261, 8, 3, 'Creative writing'),
(262, 8, 3, 'Expository writing'),
(263, 8, 3, 'Argumentative writing'),
(264, 8, 3, 'Speech writing'),
(265, 8, 3, 'Summary writing'),
(266, 8, 3, 'Literary appreciation'),
(267, 9, 1, 'Review of JSS mathematics'),
(268, 9, 1, 'BECE preparation'),
(269, 9, 1, 'Past questions'),
(270, 9, 1, 'Problem solving'),
(271, 9, 1, 'Examination techniques'),
(272, 9, 3, 'BECE preparation'),
(273, 9, 3, 'Past questions'),
(274, 9, 3, 'Examination techniques'),
(275, 9, 4, 'JSCE preparation'),
(276, 9, 6, 'JSCE preparation'),
(277, 9, 5, 'JSCE preparation'),
(278, 10, 1, 'Set theory'),
(279, 10, 1, 'Indices and logarithms'),
(280, 10, 1, 'Surds'),
(281, 10, 1, 'Polynomials'),
(282, 10, 1, 'Quadratic equations'),
(283, 10, 1, 'Simultaneous equations'),
(284, 10, 1, 'Linear inequalities'),
(285, 10, 1, 'Trigonometric functions'),
(286, 10, 1, 'Mensuration'),
(287, 10, 1, 'Statistics'),
(288, 10, 1, 'Probability'),
(289, 10, 1, 'Coordinate geometry'),
(290, 10, 1, 'Binary operations'),
(291, 10, 1, 'Sequences and series'),
(292, 10, 1, 'Matrices'),
(293, 10, 3, 'Oral English'),
(294, 10, 3, 'Lexis and structure'),
(295, 10, 3, 'Comprehension'),
(296, 10, 3, 'Summary'),
(297, 10, 3, 'Essay writing'),
(298, 10, 3, 'Letter writing'),
(299, 10, 3, 'Literature'),
(300, 10, 3, 'Figures of speech'),
(301, 10, 3, 'Vocabulary'),
(302, 10, 3, 'Grammar'),
(303, 10, 7, 'Motion'),
(304, 10, 7, 'Force'),
(305, 10, 7, 'Work, energy, power'),
(306, 10, 7, 'Friction'),
(307, 10, 7, 'Simple machines'),
(308, 10, 7, 'Heat'),
(309, 10, 7, 'Light'),
(310, 10, 7, 'Sound'),
(311, 10, 7, 'Electricity'),
(312, 10, 7, 'Magnetism'),
(313, 10, 8, 'Introduction to chemistry'),
(314, 10, 8, 'Matter'),
(315, 10, 8, 'Atomic structure'),
(316, 10, 8, 'Periodic table'),
(317, 10, 8, 'Chemical bonding'),
(318, 10, 8, 'Stoichiometry'),
(319, 10, 8, 'Gas laws'),
(320, 10, 8, 'Acids and bases'),
(321, 10, 8, 'Salts'),
(322, 10, 8, 'Water'),
(323, 10, 9, 'Living organisms'),
(324, 10, 9, 'Cells'),
(325, 10, 9, 'Tissues'),
(326, 10, 9, 'Systems'),
(327, 10, 9, 'Nutrition'),
(328, 10, 9, 'Transport'),
(329, 10, 9, 'Respiration'),
(330, 10, 9, 'Excretion'),
(331, 10, 9, 'Reproduction'),
(332, 10, 9, 'Growth'),
(333, 11, 1, 'Calculus - limits'),
(334, 11, 1, 'Differentiation'),
(335, 11, 1, 'Integration'),
(336, 11, 1, 'Complex numbers'),
(337, 11, 1, 'Vectors'),
(338, 11, 1, '3D geometry'),
(339, 11, 1, 'Trigonometry'),
(340, 11, 1, 'Statistics - dispersion'),
(341, 11, 1, 'Probability distributions'),
(342, 11, 1, 'Logic'),
(343, 11, 7, 'Waves'),
(344, 11, 7, 'Optics'),
(345, 11, 7, 'Electricity'),
(346, 11, 7, 'Electromagnetism'),
(347, 11, 7, 'Modern physics'),
(348, 11, 8, 'Organic chemistry'),
(349, 11, 8, 'Hydrocarbons'),
(350, 11, 8, 'Functional groups'),
(351, 11, 8, 'Chemical equilibrium'),
(352, 11, 8, 'Electrochemistry'),
(353, 11, 9, 'Ecology'),
(354, 11, 9, 'Genetics'),
(355, 11, 9, 'Evolution'),
(356, 11, 9, 'Classification'),
(357, 11, 9, 'Conservation'),
(358, 13, 1, 'Number and numeration'),
(359, 13, 1, 'Algebra'),
(360, 13, 1, 'Geometry'),
(361, 13, 1, 'Trigonometry'),
(362, 13, 1, 'Calculus'),
(363, 13, 1, 'Statistics'),
(364, 13, 3, 'Lexis and structure'),
(365, 13, 3, 'Comprehension'),
(366, 13, 3, 'Summary'),
(367, 13, 3, 'Essay writing'),
(368, 13, 3, 'Oral English'),
(369, 13, 3, 'Literature'),
(370, 14, 1, 'Number and numeration'),
(371, 14, 1, 'Algebra'),
(372, 14, 1, 'Geometry'),
(373, 14, 1, 'Trigonometry'),
(374, 14, 1, 'Calculus'),
(375, 14, 1, 'Statistics'),
(376, 14, 3, 'Lexis and structure'),
(377, 14, 3, 'Comprehension'),
(378, 14, 3, 'Summary'),
(379, 14, 3, 'Essay writing'),
(380, 14, 3, 'Oral English'),
(381, 14, 3, 'Literature'),
(382, 15, 1, 'Number and numeration'),
(383, 15, 1, 'Algebra'),
(384, 15, 1, 'Geometry'),
(385, 15, 1, 'Trigonometry'),
(386, 15, 1, 'Calculus'),
(387, 15, 1, 'Statistics'),
(388, 15, 3, 'Lexis and structure'),
(389, 15, 3, 'Comprehension'),
(390, 15, 3, 'Summary'),
(391, 15, 3, 'Essay writing'),
(392, 15, 3, 'Oral English'),
(393, 15, 3, 'Literature');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exam_type` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_referrer` tinyint(1) DEFAULT '0',
  `referral_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_alerts` tinyint(1) DEFAULT '1',
  `bank_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `exam_type`, `role`, `is_active`, `remember_token`, `created_at`, `updated_at`, `is_referrer`, `referral_code`, `profile_photo`, `email_alerts`, `bank_name`, `account_name`, `account_number`, `status`) VALUES
(1, 'Super Admin', 'admin@cbtpro.com', NULL, '$2y$12$15J3kukvGjQLTgbCpRjCxeU/dW1ipEXWMbpecJe702cp2tPdfIxqe', '08012345678', 'GENERAL', 'admin', '1', 'iJYGBNkPCn1Nsstz8IyhordAkU6wHpbGevSmKkoxosdXt7LnKQg5ECYb0cNi', '2026-04-23 16:38:51', '2026-04-23 16:38:51', 0, NULL, NULL, 1, NULL, NULL, NULL, 'active'),
(2, 'Referrer', 'referrer@yahoo.com', NULL, '$2y$12$UD5jQATKJKFvCp8VpiARVuwZtz5772NqTZBirI4OG7zXXTGfftk8K', '08024541977', NULL, 'referrer', '0', NULL, '2026-04-23 16:41:15', '2026-04-23 16:41:15', 1, '309899', NULL, 1, NULL, NULL, NULL, 'active'),
(3, 'school admin', 'schooladmin@yahoo.com', NULL, '$2y$12$U7w7aLCBOePbGKbSQwqlz.U0LLNQJ83z/iSgH6Zp/Kkpndwop5v/a', '08024541543', NULL, 'school', '0', NULL, '2026-04-23 16:44:23', '2026-04-24 00:09:15', 0, NULL, '1776990494.jpeg', 1, NULL, NULL, NULL, 'active'),
(4, 'Teacher One', 'teacherone@yahoo.com', NULL, '$2y$12$c1Sg8eEDXSehaQRCtrwY/O5gLfv/Bb1M10/k7H8rFrLr0tMRlYuNa', '09045332113', 'GENERAL', 'teacher', '1', NULL, '2026-04-23 16:48:48', '2026-04-23 16:48:48', 0, NULL, NULL, 1, NULL, NULL, NULL, 'active'),
(5, 'Teacher Two', 'teachertwo@test.com', NULL, '$2y$12$rXBJ6OUX4W.luU.cKMGFS.2o3s146AtI.ktaYwFSKWG/JEuANEbkm', '908077655432', 'GENERAL', 'teacher', '1', NULL, '2026-04-23 16:58:39', '2026-04-23 16:58:39', 0, NULL, NULL, 1, NULL, NULL, NULL, 'active'),
(6, 'Okunloro Olaitan', 'olaitanabidemi2007@gmail.com', NULL, '$2y$12$isHWzDk5S.YCA..pAbPfpuMU/i3pbYzEKpaMxQfhKBm/Qqm1/RH26', '08024541933', 'GENERAL', 'student', '1', NULL, '2026-04-23 23:08:52', '2026-04-24 01:11:50', 0, NULL, NULL, 1, NULL, NULL, NULL, 'active'),
(7, 'Student One', 'studentone@yahoo.com', NULL, '$2y$12$PkacwjmcF6Y8Tx/UxCa8EOIKjK8jOhx4HFuMAqqSWZkfACp8tAgAq', '091776656689', 'GENERAL', 'student', '1', NULL, '2026-04-23 23:11:31', '2026-04-25 12:33:01', 0, NULL, NULL, 1, NULL, NULL, NULL, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `balance` decimal(12,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `user_id`, `balance`, `created_at`, `updated_at`) VALUES
(1, 78, 400.00, '2026-04-19 16:40:28', '2026-04-19 16:40:28'),
(2, 2, 1200.00, '2026-04-23 16:41:15', '2026-04-23 16:41:15');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `bank_name` varchar(150) NOT NULL,
  `account_name` varchar(150) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `status` varchar(30) DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `withdrawals`
--

INSERT INTO `withdrawals` (`id`, `user_id`, `amount`, `bank_name`, `account_name`, `account_number`, `status`, `created_at`, `updated_at`) VALUES
(1, 78, 2000.00, 'GTB', 'Referrer One', '1234567890', 'paid', '2026-04-20 10:20:03', '2026-04-20 15:08:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attempt_id` (`attempt_id`,`question_id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attendances_student_date_unique` (`student_details_id`,`date`);

--
-- Indexes for table `bulk_payments`
--
ALTER TABLE `bulk_payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reference` (`reference`);

--
-- Indexes for table `bulk_payment_students`
--
ALTER TABLE `bulk_payment_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_subjects`
--
ALTER TABLE `class_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `class_level_id` (`class_level_id`);

--
-- Indexes for table `commissions`
--
ALTER TABLE `commissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversation_participants`
--
ALTER TABLE `conversation_participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_cat_id` (`exam_cat_id`);

--
-- Indexes for table `exam_attempts`
--
ALTER TABLE `exam_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_categories`
--
ALTER TABLE `exam_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fill_blank_answers`
--
ALTER TABLE `fill_blank_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passages`
--
ALTER TABLE `passages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payments_reference_unique` (`reference`),
  ADD KEY `payments_user_id_foreign` (`user_id`),
  ADD KEY `payments_status_index` (`status`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_question` (`question_text`(255),`subject_id`,`topic_id`),
  ADD KEY `idx_class` (`class_level_id`),
  ADD KEY `idx_subject` (`subject_id`),
  ADD KEY `idx_exam_type` (`exam_cat_id`),
  ADD KEY `idx_difficulty` (`difficulty`),
  ADD KEY `idx_questions_source` (`source`),
  ADD KEY `idx_questions_difficulty` (`difficulty`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `question_banks`
--
ALTER TABLE `question_banks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_question` (`question_text`(255),`subject_id`,`topic_id`),
  ADD KEY `idx_class` (`class_level_id`),
  ADD KEY `idx_subject` (`subject_id`),
  ADD KEY `idx_exam_type` (`exam_cat_id`),
  ADD KEY `idx_difficulty` (`difficulty`),
  ADD KEY `idx_questions_source` (`source`),
  ADD KEY `idx_questions_difficulty` (`difficulty`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `question_options`
--
ALTER TABLE `question_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `result_scores`
--
ALTER TABLE `result_scores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_books`
--
ALTER TABLE `school_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_classes`
--
ALTER TABLE `school_classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `school_classes_class_level_id_foreign` (`class_level_id`);

--
-- Indexes for table `school_details`
--
ALTER TABLE `school_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_fees`
--
ALTER TABLE `school_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_fee_payments`
--
ALTER TABLE `school_fee_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `student_answers`
--
ALTER TABLE `student_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_details`
--
ALTER TABLE `student_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_school` (`school_id`),
  ADD KEY `fk_class` (`class_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_details`
--
ALTER TABLE `teacher_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `teacher_options`
--
ALTER TABLE `teacher_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_subjects`
--
ALTER TABLE `teacher_subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_teacher_subject_class` (`teacher_id`,`subject_id`,`class_id`),
  ADD KEY `idx_teacher_subjects_teacher_id` (`teacher_id`),
  ADD KEY `idx_teacher_subjects_school_id` (`school_id`),
  ADD KEY `idx_teacher_subjects_subject_id` (`subject_id`),
  ADD KEY `idx_teacher_subjects_class_id` (`class_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `class_level_id` (`class_level_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bulk_payments`
--
ALTER TABLE `bulk_payments`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bulk_payment_students`
--
ALTER TABLE `bulk_payment_students`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `class_subjects`
--
ALTER TABLE `class_subjects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=394;

--
-- AUTO_INCREMENT for table `commissions`
--
ALTER TABLE `commissions`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conversation_participants`
--
ALTER TABLE `conversation_participants`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_attempts`
--
ALTER TABLE `exam_attempts`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_categories`
--
ALTER TABLE `exam_categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fill_blank_answers`
--
ALTER TABLE `fill_blank_answers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=943;

--
-- AUTO_INCREMENT for table `passages`
--
ALTER TABLE `passages`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `question_banks`
--
ALTER TABLE `question_banks`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=437;

--
-- AUTO_INCREMENT for table `question_options`
--
ALTER TABLE `question_options`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `result_scores`
--
ALTER TABLE `result_scores`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `school_books`
--
ALTER TABLE `school_books`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `school_classes`
--
ALTER TABLE `school_classes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `school_details`
--
ALTER TABLE `school_details`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `school_fees`
--
ALTER TABLE `school_fees`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `school_fee_payments`
--
ALTER TABLE `school_fee_payments`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_answers`
--
ALTER TABLE `student_answers`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_details`
--
ALTER TABLE `student_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher_details`
--
ALTER TABLE `teacher_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teacher_options`
--
ALTER TABLE `teacher_options`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `teacher_subjects`
--
ALTER TABLE `teacher_subjects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=513;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `fk_attendance_student` FOREIGN KEY (`student_details_id`) REFERENCES `student_details` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_ibfk_1` FOREIGN KEY (`exam_cat_id`) REFERENCES `exam_categories` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`);

--
-- Constraints for table `question_banks`
--
ALTER TABLE `question_banks`
  ADD CONSTRAINT `question_banks_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`);

--
-- Constraints for table `school_classes`
--
ALTER TABLE `school_classes`
  ADD CONSTRAINT `school_classes_class_level_id_foreign` FOREIGN KEY (`class_level_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `school_classes_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`),
  ADD CONSTRAINT `school_classes_ibfk_2` FOREIGN KEY (`class_level_id`) REFERENCES `classes` (`id`);

--
-- Constraints for table `student_details`
--
ALTER TABLE `student_details`
  ADD CONSTRAINT `fk_class` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `fk_school` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`);

--
-- Constraints for table `teacher_details`
--
ALTER TABLE `teacher_details`
  ADD CONSTRAINT `teacher_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `topics_ibfk_2` FOREIGN KEY (`class_level_id`) REFERENCES `classes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
