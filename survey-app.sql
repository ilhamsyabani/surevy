-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 18, 2023 at 12:52 PM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `survey-app`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'tidak ada', '2023-10-17 18:00:05', '2023-10-17 18:00:05'),
(2, 'bahasa', '2023-10-17 18:04:35', '2023-10-17 18:04:35'),
(3, 'tampilan', '2023-10-17 18:05:03', '2023-10-17 18:05:03');

-- --------------------------------------------------------

--
-- Table structure for table `category_results`
--

CREATE TABLE `category_results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `result_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `feedback_id` bigint(20) UNSIGNED NOT NULL,
  `total_points` int(11) NOT NULL DEFAULT '0',
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_results`
--

INSERT INTO `category_results` (`id`, `result_id`, `category_id`, `feedback_id`, `total_points`, `attachment`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 4, 13, 'uploads/c60hZyC3PNDSFCBAzj92Hog0BSc4pMGRXTYPPkb2.pdf', '2023-10-17 18:47:17', '2023-10-17 18:57:56'),
(2, 2, 2, 4, 14, 'uploads/LQcTX0TkuvL1K1JrAjylGOzIBGGNMwyFsrfCefIy.pdf', '2023-10-18 00:05:07', '2023-10-18 00:05:07'),
(3, 2, 3, 7, 11, 'belum di isi', '2023-10-18 00:05:07', '2023-10-18 00:05:07');

-- --------------------------------------------------------

--
-- Table structure for table `evidence`
--

CREATE TABLE `evidence` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categori_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `evidence` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categori_id` int(11) DEFAULT NULL,
  `score` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `feedback` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max` int(11) NOT NULL,
  `min` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `categori_id`, `score`, `feedback`, `max`, `min`, `created_at`, `updated_at`) VALUES
(1, 1, '0', 'Belum lengkap', 0, 0, NULL, NULL),
(2, 2, 'D', 'kurang bagus', 8, 5, NULL, NULL),
(3, 2, 'C', 'Lumayanlah buat pemula', 12, 9, NULL, NULL),
(4, 2, 'B', 'Wah kamu cukup pintar', 17, 13, NULL, NULL),
(5, 2, 'A', 'Keren', 20, 18, NULL, NULL),
(6, 3, 'D', 'kurang bagus', 8, 5, NULL, NULL),
(7, 3, 'C', 'Lumayanlah buat pemula', 12, 9, NULL, NULL),
(8, 3, 'B', 'Wah kamu cukup pintar', 17, 13, NULL, NULL),
(9, 3, 'A', 'Keren', 20, 18, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `instansions`
--

CREATE TABLE `instansions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instansions`
--

INSERT INTO `instansions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'SMA N 2 Cikarang Selatan', '2023-10-17 21:50:41', '2023-10-17 21:50:41');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_02_04_020715_create_permissions_table', 1),
(6, '2022_02_04_020803_create_roles_table', 1),
(7, '2022_02_04_020910_create_role_user_table', 1),
(8, '2022_02_04_021018_create_permission_role_table', 1),
(9, '2022_04_13_070826_create_categories_table', 1),
(10, '2022_04_13_070920_create_questions_table', 1),
(11, '2022_04_13_071022_create_options_table', 1),
(12, '2022_04_13_072027_create_results_table', 1),
(13, '2023_10_13_065910_create_feedback_table', 1),
(14, '2023_10_13_071213_create_evidence_table', 1),
(15, '2023_10_13_123957_create_instansions_table', 1),
(16, '2023_10_14_113214_create_category_result_table', 1),
(17, '2023_10_15_010923_create_question_results_table', 1),
(18, '2023_10_18_082926_create_reviews_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `option_text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `points` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `question_id`, `option_text`, `points`, `created_at`, `updated_at`) VALUES
(1, 1, 'tidak', 1, '2023-10-17 18:09:25', '2023-10-17 18:09:25'),
(2, 1, 'kurang', 2, '2023-10-17 18:09:25', '2023-10-17 18:09:25'),
(3, 1, 'menarik', 3, '2023-10-17 18:09:25', '2023-10-17 18:09:25'),
(4, 1, 'sangat menarik', 4, '2023-10-17 18:09:25', '2023-10-17 18:09:25'),
(5, 2, 'tidak', 1, '2023-10-17 18:10:32', '2023-10-17 18:10:32'),
(6, 2, 'kurang', 2, '2023-10-17 18:10:32', '2023-10-17 18:10:32'),
(7, 2, 'mudah dipahami', 3, '2023-10-17 18:10:32', '2023-10-17 18:10:32'),
(8, 2, 'sangat mudah dipahami', 4, '2023-10-17 18:10:32', '2023-10-17 18:10:32'),
(9, 3, 'tidak jelas', 1, '2023-10-17 18:11:28', '2023-10-17 18:11:28'),
(10, 3, 'kurang jelas', 2, '2023-10-17 18:11:28', '2023-10-17 18:11:28'),
(11, 3, 'cukup jelas', 3, '2023-10-17 18:11:28', '2023-10-17 18:11:28'),
(12, 3, 'sangat jelas', 4, '2023-10-17 18:11:28', '2023-10-17 18:11:28'),
(13, 4, 'tidak', 1, '2023-10-17 18:12:09', '2023-10-17 18:12:09'),
(14, 4, 'kurang', 2, '2023-10-17 18:12:09', '2023-10-17 18:12:09'),
(15, 4, 'tepat', 3, '2023-10-17 18:12:09', '2023-10-17 18:12:09'),
(16, 4, 'sangat tepat', 4, '2023-10-17 18:12:09', '2023-10-17 18:12:09'),
(17, 5, 'banyak', 1, '2023-10-17 18:13:53', '2023-10-17 18:13:53'),
(18, 5, 'beberapa kata', 2, '2023-10-17 18:13:53', '2023-10-17 18:13:53'),
(19, 5, 'hampir tidak ada', 3, '2023-10-17 18:13:53', '2023-10-17 18:13:53'),
(20, 5, 'tidak ada', 4, '2023-10-17 18:13:53', '2023-10-17 18:13:53'),
(21, 6, 'tidak menarik', 1, '2023-10-17 18:14:45', '2023-10-17 18:14:45'),
(22, 6, 'kurang menarik', 2, '2023-10-17 18:14:45', '2023-10-17 18:14:45'),
(23, 6, 'cukup menarik', 3, '2023-10-17 18:14:45', '2023-10-17 18:14:45'),
(24, 6, 'sangat menarik', 4, '2023-10-17 18:14:45', '2023-10-17 18:14:45'),
(25, 7, 'tidak sesuai', 1, '2023-10-17 18:15:46', '2023-10-17 18:15:46'),
(26, 7, 'cukup sesuai', 2, '2023-10-17 18:15:46', '2023-10-17 18:15:46'),
(27, 7, 'sesuai', 3, '2023-10-17 18:15:46', '2023-10-17 18:15:46'),
(28, 7, 'sangat sesuai', 4, '2023-10-17 18:15:46', '2023-10-17 18:15:46'),
(29, 8, 'tidak nyaman', 1, '2023-10-17 18:16:47', '2023-10-17 18:16:47'),
(30, 8, 'cukup nyaman', 2, '2023-10-17 18:16:47', '2023-10-17 18:16:47'),
(31, 8, 'nyaman', 3, '2023-10-17 18:16:47', '2023-10-17 18:16:47'),
(32, 8, 'sangat nyaman', 4, '2023-10-17 18:16:47', '2023-10-17 18:16:47');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'user_management_access', NULL, NULL),
(2, 'user_management_create', NULL, NULL),
(3, 'user_management_edit', NULL, NULL),
(4, 'user_management_view', NULL, NULL),
(5, 'user_management_delete', NULL, NULL),
(6, 'permission_access', NULL, NULL),
(7, 'permission_create', NULL, NULL),
(8, 'permission_edit', NULL, NULL),
(9, 'permission_view', NULL, NULL),
(10, 'permission_delete', NULL, NULL),
(11, 'role_access', NULL, NULL),
(12, 'role_create', NULL, NULL),
(13, 'role_edit', NULL, NULL),
(14, 'role_view', NULL, NULL),
(15, 'role_delete', NULL, NULL),
(16, 'user_access', NULL, NULL),
(17, 'user_create', NULL, NULL),
(18, 'user_edit', NULL, NULL),
(19, 'user_view', NULL, NULL),
(20, 'user_delete', NULL, NULL),
(22, 'result_access', '2023-10-17 22:46:49', '2023-10-17 22:47:11');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 1, NULL, NULL),
(3, 3, 1, NULL, NULL),
(4, 4, 1, NULL, NULL),
(5, 5, 1, NULL, NULL),
(6, 6, 1, NULL, NULL),
(7, 7, 1, NULL, NULL),
(8, 8, 1, NULL, NULL),
(9, 9, 1, NULL, NULL),
(10, 10, 1, NULL, NULL),
(11, 11, 1, NULL, NULL),
(12, 12, 1, NULL, NULL),
(13, 13, 1, NULL, NULL),
(14, 14, 1, NULL, NULL),
(15, 15, 1, NULL, NULL),
(16, 16, 1, NULL, NULL),
(17, 17, 1, NULL, NULL),
(18, 18, 1, NULL, NULL),
(19, 19, 1, NULL, NULL),
(20, 20, 1, NULL, NULL),
(24, 19, 2, NULL, NULL),
(46, 1, 4, NULL, NULL),
(47, 16, 4, NULL, NULL),
(48, 22, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `question_text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `category_id`, `question_text`, `created_at`, `updated_at`) VALUES
(1, 2, 'Apakah bahasa yang digunakan menarik', '2023-10-17 18:09:25', '2023-10-17 18:09:25'),
(2, 2, 'Apkah kata-kata yang disampaikan mudah dipahami', '2023-10-17 18:10:32', '2023-10-17 18:10:32'),
(3, 2, 'Apkah bahasa yang digunakan jelas', '2023-10-17 18:11:28', '2023-10-17 18:11:28'),
(4, 2, 'Apkah penggunaan bahsa tepat', '2023-10-17 18:12:09', '2023-10-17 18:12:09'),
(5, 2, 'adakah kata-kata yang tidak sesuai', '2023-10-17 18:13:53', '2023-10-17 18:13:53'),
(6, 3, 'Apakah tampilan menarik', '2023-10-17 18:14:45', '2023-10-17 18:14:45'),
(7, 3, 'apakah illustrasi yang digunakan cukup untuk menggambarkan materi', '2023-10-17 18:15:46', '2023-10-17 18:15:46'),
(8, 3, 'Apakah pilihan warna yang digunakan nyaman untuk dilihat', '2023-10-17 18:16:47', '2023-10-17 18:16:47');

-- --------------------------------------------------------

--
-- Table structure for table `question_results`
--

CREATE TABLE `question_results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_result_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `option_id` bigint(20) UNSIGNED DEFAULT NULL,
  `points` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question_results`
--

INSERT INTO `question_results` (`id`, `category_result_id`, `question_id`, `option_id`, `points`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 4, 4, '2023-10-17 18:47:17', '2023-10-17 18:47:17'),
(2, 1, 2, 7, 3, '2023-10-17 18:47:17', '2023-10-17 18:47:17'),
(3, 1, 3, 11, 3, '2023-10-17 18:47:17', '2023-10-17 18:47:17'),
(4, 1, 4, 15, 3, '2023-10-17 18:47:17', '2023-10-17 18:47:17'),
(5, 2, 1, 3, 3, '2023-10-18 00:05:07', '2023-10-18 00:05:07'),
(6, 2, 2, 7, 3, '2023-10-18 00:05:07', '2023-10-18 00:05:07'),
(7, 2, 3, 11, 3, '2023-10-18 00:05:07', '2023-10-18 00:05:07'),
(8, 2, 4, 14, 2, '2023-10-18 00:05:07', '2023-10-18 00:05:07'),
(9, 2, 5, 19, 3, '2023-10-18 00:05:07', '2023-10-18 00:05:07'),
(10, 3, 6, 24, 4, '2023-10-18 00:05:07', '2023-10-18 00:05:07'),
(11, 3, 7, 27, 3, '2023-10-18 00:05:07', '2023-10-18 00:05:07'),
(12, 3, 8, 32, 4, '2023-10-18 00:05:07', '2023-10-18 00:05:07');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total_points` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `user_id`, `total_points`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 13, 'simpan', '2023-10-17 18:32:45', '2023-10-17 18:58:08'),
(2, 4, 25, 'simpan', '2023-10-18 00:05:07', '2023-10-18 00:12:03');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_result_id` bigint(20) UNSIGNED NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `category_result_id`, `review`, `created_at`, `updated_at`) VALUES
(1, 5, 2, 'halo baik', '2023-10-18 02:36:11', '2023-10-18 02:36:11'),
(2, 5, 2, 'halo baik', '2023-10-18 02:36:40', '2023-10-18 02:36:40'),
(3, 5, 2, 'halo baik', '2023-10-18 02:36:55', '2023-10-18 02:36:55'),
(4, 5, 2, 'halo baik', '2023-10-18 02:37:17', '2023-10-18 02:37:17');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL),
(2, 'user', NULL, NULL),
(4, 'evaluator', '2023-10-17 23:28:08', '2023-10-17 23:28:08');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(5, 2, 4, NULL, NULL),
(6, 4, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instansion_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `instansion_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@example.com', NULL, '$2y$10$LnMRAaOg9N98hsBgRZr6KOVqVcl6KMZ4F43U.hFRwWVMxHDxYo0Iy', NULL, NULL, NULL, NULL),
(4, 'siti aminah', 'sitiaminah@mail.com', NULL, '$2y$10$lpUNYo.UAfzRZTDL4c6tX.1/aP98qsZWaywFqkxmD89UrIEkX5PBO', '1', NULL, '2023-10-17 23:27:38', '2023-10-17 23:27:38'),
(5, 'Ilham syabani', 'syabani.ilhamsi@gmail.com', NULL, '$2y$10$X2w5VSvJuSrcn9VPmc6NNetLSwRE/BXXyJpPcQkypcNa.MJfYGY5m', '1', NULL, '2023-10-17 23:28:31', '2023-10-17 23:28:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_results`
--
ALTER TABLE `category_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_results_result_id_foreign` (`result_id`),
  ADD KEY `category_results_category_id_foreign` (`category_id`),
  ADD KEY `category_results_feedback_id_foreign` (`feedback_id`);

--
-- Indexes for table `evidence`
--
ALTER TABLE `evidence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instansions`
--
ALTER TABLE `instansions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `options_question_id_foreign` (`question_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_category_id_foreign` (`category_id`);

--
-- Indexes for table `question_results`
--
ALTER TABLE `question_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_results_category_result_id_foreign` (`category_result_id`),
  ADD KEY `question_results_question_id_foreign` (`question_id`),
  ADD KEY `question_results_option_id_foreign` (`option_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `results_user_id_foreign` (`user_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_category_result_id_foreign` (`category_result_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category_results`
--
ALTER TABLE `category_results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `evidence`
--
ALTER TABLE `evidence`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `instansions`
--
ALTER TABLE `instansions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `question_results`
--
ALTER TABLE `question_results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_results`
--
ALTER TABLE `category_results`
  ADD CONSTRAINT `category_results_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_results_feedback_id_foreign` FOREIGN KEY (`feedback_id`) REFERENCES `feedback` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_results_result_id_foreign` FOREIGN KEY (`result_id`) REFERENCES `results` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `question_results`
--
ALTER TABLE `question_results`
  ADD CONSTRAINT `question_results_category_result_id_foreign` FOREIGN KEY (`category_result_id`) REFERENCES `category_results` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `question_results_option_id_foreign` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `question_results_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_category_result_id_foreign` FOREIGN KEY (`category_result_id`) REFERENCES `category_results` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
