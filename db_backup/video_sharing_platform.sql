-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 08, 2023 at 12:56 PM
-- Server version: 8.0.31
-- PHP Version: 8.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `video_sharing_platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `alerts`
--

CREATE TABLE `alerts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `alert` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alerts`
--

INSERT INTO `alerts` (`id`, `user_id`, `alert`, `created_at`, `updated_at`) VALUES
(1, 1, 0, '2023-06-04 09:17:43', '2023-06-05 08:30:30'),
(2, 2, 0, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(3, 3, 0, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(4, 4, 0, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(5, 5, 0, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(6, 6, 0, '2023-06-04 09:17:43', '2023-06-04 09:17:43');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `video_id` bigint UNSIGNED NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `video_id`, `body`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'شكرًا لكم عل هذه الدورة الرائعة', '2023-06-04 09:17:42', '2023-06-04 09:17:42'),
(2, 4, 2, 'أرجو لكم المزيد من النجاح، دورة رائعة واستفدت منها كثيرًا', '2023-06-04 09:17:42', '2023-06-04 09:17:42'),
(3, 1, 4, 'شكرًا لكم عل هذه الدورة الرائعة', '2023-06-04 09:17:42', '2023-06-04 09:17:42'),
(4, 5, 4, 'أرجو لكم المزيد من النجاح، دورة رائعة واستفدت منها كثيرًا', '2023-06-04 09:17:42', '2023-06-04 09:17:42'),
(5, 3, 3, 'شكرًا لكم عل هذه الدورة الرائعة', '2023-06-04 09:17:42', '2023-06-04 09:17:42'),
(6, 5, 3, 'أرجو لكم المزيد من النجاح، دورة رائعة واستفدت منها كثيرًا', '2023-06-04 09:17:42', '2023-06-04 09:17:42'),
(7, 3, 1, 'شكرًا لكم عل هذه الدورة الرائعة', '2023-06-04 09:17:42', '2023-06-04 09:17:42'),
(8, 4, 1, 'أرجو لكم المزيد من النجاح، دورة رائعة واستفدت منها كثيرًا', '2023-06-04 09:17:42', '2023-06-04 09:17:42'),
(9, 5, 5, 'شكرًا لكم عل هذه الدورة الرائعة', '2023-06-04 09:17:42', '2023-06-04 09:17:42'),
(10, 4, 5, 'أرجو لكم المزيد من النجاح، دورة رائعة واستفدت منها كثيرًا', '2023-06-04 09:17:42', '2023-06-04 09:17:42'),
(11, 5, 6, 'شكرًا لكم عل هذه الدورة الرائعة', '2023-06-04 09:17:42', '2023-06-04 09:17:42'),
(12, 4, 6, 'أرجو لكم المزيد من النجاح، دورة رائعة واستفدت منها كثيرًا', '2023-06-04 09:17:42', '2023-06-04 09:17:42'),
(13, 1, 6, 'شكرًا لكم عل هذه الدورة الرائعة', '2023-06-04 09:17:42', '2023-06-04 09:17:42'),
(14, 4, 7, 'أرجو لكم المزيد من النجاح، دورة رائعة واستفدت منها كثيرًا', '2023-06-04 09:17:42', '2023-06-04 09:17:42'),
(15, 5, 7, 'شكرًا لكم عل هذه الدورة الرائعة', '2023-06-04 09:17:42', '2023-06-04 09:17:42');

-- --------------------------------------------------------

--
-- Table structure for table `converted_videos`
--

CREATE TABLE `converted_videos` (
  `id` bigint UNSIGNED NOT NULL,
  `video_id` bigint UNSIGNED NOT NULL,
  `mp4_Format_240` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mp4_Format_360` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mp4_Format_480` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mp4_Format_720` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mp4_Format_1080` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `webm_Format_240` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `webm_Format_360` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `webm_Format_480` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `webm_Format_720` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `webm_Format_1080` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `converted_videos`
--

INSERT INTO `converted_videos` (`id`, `video_id`, `mp4_Format_240`, `mp4_Format_360`, `mp4_Format_480`, `mp4_Format_720`, `mp4_Format_1080`, `webm_Format_240`, `webm_Format_360`, `webm_Format_480`, `webm_Format_720`, `webm_Format_1080`, `created_at`, `updated_at`) VALUES
(1, 1, 'test/computer-science/240p-computer-science.mp4', 'test/computer-science/360p-computer-science.mp4', 'test/computer-science/480p-computer-science.mp4', 'test/computer-science/720p-computer-science.mp4', 'No Video', 'test/computer-science/240p-computer-science.webm', 'test/computer-science/360p-computer-science.webm', 'test/computer-science/480p-computer-science.webm', 'test/computer-science/720p-computer-science.webm', 'No Video', '2023-06-04 09:17:42', '2023-06-04 09:17:42'),
(2, 2, 'test/frontend/240p-frontend.mp4', 'test/frontend/360p-frontend.mp4', 'test/frontend/480p-frontend.mp4', 'No Video', 'No Video', 'test/frontend/240p-frontend.webm', 'test/frontend/360p-frontend.webm', 'test/frontend/480p-frontend.webm', 'No Video', 'No Video', '2023-06-04 09:17:42', '2023-06-04 09:17:42'),
(3, 3, 'test/javascript/240p-javascript.mp4', 'test/javascript/360p-javascript.mp4', 'No Video', 'No Video', 'No Video', 'test/javascript/240p-javascript.webm', 'test/javascript/360p-javascript.webm', 'No Video', 'No Video', 'No Video', '2023-06-04 09:17:42', '2023-06-04 09:17:42'),
(4, 4, 'test/cordova/240p-cordova.mp4', 'test/cordova/360p-cordova.mp4', 'No Video', 'No Video', 'No Video', 'test/cordova/240p-cordova.webm', 'test/cordova/360p-cordova.webm', 'No Video', 'No Video', 'No Video', '2023-06-04 09:17:42', '2023-06-04 09:17:42'),
(5, 5, 'test/mostaql/240p-mostaql.mp4', 'test/mostaql/360p-mostaql.mp4', 'No Video', 'No Video', 'No Video', 'test/mostaql/240p-mostaql.webm', 'test/mostaql/360p-mostaql.webm', 'No Video', 'No Video', 'No Video', '2023-06-04 09:17:42', '2023-06-04 09:17:42'),
(6, 6, 'test/khamsat/240p-khamsat.mp4', 'test/khamsat/360p-khamsat.mp4', 'test/khamsat/480p-khamsat.mp4', 'test/khamsat/720p-khamsat.mp4', 'No Video', 'test/khamsat/240p-khamsat.webm', 'test/khamsat/360p-khamsat.webm', 'test/khamsat/480p-khamsat.webm', 'test/khamsat/720p-khamsat.webm', 'No Video', '2023-06-04 09:17:42', '2023-06-04 09:17:42'),
(7, 7, 'test/baaed/240p-baaed.mp4', 'No Video', 'No Video', 'No Video', 'No Video', 'test/baaed/240p-baaed.webm', 'No Video', 'No Video', 'No Video', 'No Video', '2023-06-04 09:17:42', '2023-06-04 09:17:42'),
(9, 9, '240p-ZkOZE4vXi2lh7dBY.mp4', '360p-ZkOZE4vXi2lh7dBY.mp4', '480p-ZkOZE4vXi2lh7dBY.mp4', '720p-ZkOZE4vXi2lh7dBY.mp4', '1080p-ZkOZE4vXi2lh7dBY.mp4', '240p-ZkOZE4vXi2lh7dBY.webm', '360p-ZkOZE4vXi2lh7dBY.webm', '480p-ZkOZE4vXi2lh7dBY.webm', '720p-ZkOZE4vXi2lh7dBY.webm', '1080p-ZkOZE4vXi2lh7dBY.webm', '2023-06-05 08:29:52', '2023-06-05 08:29:52');

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

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `video_id` bigint UNSIGNED NOT NULL,
  `liked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `video_id`, `liked`, `created_at`, `updated_at`) VALUES
(1, 5, 2, 1, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(2, 1, 2, 0, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(3, 3, 4, 1, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(4, 5, 6, 0, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(5, 3, 5, 1, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(6, 1, 5, 0, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(7, 4, 7, 1, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(8, 2, 2, 1, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(9, 4, 3, 1, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(10, 4, 7, 0, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(11, 5, 4, 1, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(12, 5, 1, 1, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(13, 2, 7, 1, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(14, 3, 1, 0, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(15, 3, 6, 1, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(16, 3, 7, 1, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(17, 2, 1, 0, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(18, 2, 5, 1, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(19, 6, 7, 0, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(20, 6, 5, 1, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(21, 1, 1, 0, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(22, 1, 6, 1, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(23, 4, 1, 0, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(24, 5, 7, 0, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(25, 1, 3, 0, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(26, 6, 7, 0, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(27, 4, 1, 1, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(28, 6, 6, 1, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(29, 5, 4, 1, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(30, 4, 2, 1, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(31, 4, 1, 0, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(32, 5, 7, 0, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(33, 2, 5, 1, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(34, 5, 3, 0, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(35, 3, 4, 0, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(36, 1, 4, 1, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(37, 3, 1, 1, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(38, 2, 2, 0, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(39, 2, 7, 1, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(40, 3, 5, 0, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(41, 2, 7, 0, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(42, 5, 6, 1, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(43, 5, 7, 0, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(44, 5, 5, 0, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(45, 3, 3, 1, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(46, 2, 4, 1, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(47, 2, 1, 1, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(48, 4, 3, 0, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(49, 4, 6, 0, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(50, 4, 2, 0, '2023-06-04 09:17:43', '2023-06-04 09:17:43');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2020_05_21_100000_create_teams_table', 1),
(7, '2020_05_21_200000_create_team_user_table', 1),
(8, '2020_05_21_300000_create_team_invitations_table', 1),
(9, '2023_05_14_075802_create_sessions_table', 1),
(10, '2023_05_14_085933_create_videos_table', 1),
(11, '2023_05_14_090314_create_converted_videos_table', 1),
(12, '2023_05_14_090425_create_likes_table', 1),
(13, '2023_05_14_090533_create_comments_table', 1),
(14, '2023_05_14_090631_create_views_table', 1),
(15, '2023_05_14_090740_create_notifications_table', 1),
(16, '2023_05_14_090925_create_alerts_table', 1),
(17, '2023_05_14_091140_create_video_user_table', 1),
(18, '2023_05_16_071532_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `notification` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `success` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `notification`, `success`, `created_at`, `updated_at`) VALUES
(1, 1, 'دورة علوم الحاسوب - أكاديمية حسوب', 1, '2023-06-04 09:17:42', '2023-06-04 09:17:42'),
(2, 1, 'دورة تطوير واجهات المستخدم - أكاديمية حسوب', 0, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(3, 1, 'دورة تطوير واجهات المستخدم - أكاديمية حسوب', 1, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(4, 2, 'دورة تطوير الويب باستخدام لغة جافاسكريبت', 1, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(5, 2, 'دورة تطوير تطبيقات الهاتف باستخدام Cordova', 1, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(6, 3, 'خمسة نصائح لاختيار أفضل المستقلين للعمل على مشروعك', 1, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(7, 5, 'اعرض خدماتك في أكبر سوق عربي لعرض وشراء الخدمات المصغرة', 1, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(8, 4, 'وظف أفضل المستقلين الموجودين في الوطن العربي عن بعد', 1, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(9, 1, 'xsasx', 1, '2023-06-04 09:26:42', '2023-06-04 09:26:42'),
(10, 1, 'test 1', 1, '2023-06-05 08:29:52', '2023-06-05 08:29:52');

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('oDa1iCcivMQOEvdihbkCzBFBe7CwKVUTF1KvIINl', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRVkwQ25aQnd0bFNaN3Fock1zSE9naGRobHRCck5wa09CRno3cnlJVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjM6Imh0dHA6Ly92aWRlb19zaGFyaW5nX3BsYXRmb3JtLmxvY2FsaG9zdC9hZG1pbi90b3Atdmlld2VkLXZpZGVvcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTAkMGlhcU9CVlhMZHpIMklFUzVoODYuZW1GbHJYcEdvMWQzb1NKdU1mVi5PWWp3RDN1SzJkVmUiO30=', 1685965145);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_team` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_invitations`
--

CREATE TABLE `team_invitations` (
  `id` bigint UNSIGNED NOT NULL,
  `team_id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_user`
--

CREATE TABLE `team_user` (
  `id` bigint UNSIGNED NOT NULL,
  `team_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `administration_level` int UNSIGNED NOT NULL DEFAULT '0',
  `block` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `administration_level`, `block`, `created_at`, `updated_at`) VALUES
(1, 'hsoub-academy', 'academy-hsoub@gmail.com', NULL, '$2y$10$0iaqOBVXLdzH2IES5h86.emFlrXpGo1d3oSJuMfV.OYjwD3uK2dVe', NULL, NULL, NULL, NULL, 1, NULL, 2, 0, '2023-06-04 09:17:42', '2023-06-04 09:17:42'),
(2, 'hsoub', 'hsoub@gmail.com', NULL, '$2y$10$FiSm01XfpGAc/xihlg4FsOxpgPEdxjVtoqQHi/fgVoehOq3G6RsEa', NULL, NULL, NULL, NULL, 2, NULL, 0, 0, '2023-06-04 09:17:42', '2023-06-04 09:17:42'),
(3, 'Mostaql', 'Mostaql@gmail.com', NULL, '$2y$10$EfMdckmjTItllrX/BLD9xeDpt.ZmJ/nsKp/Tb.slezontfR9MCdyu', NULL, NULL, NULL, NULL, 3, NULL, 0, 0, '2023-06-04 09:17:42', '2023-06-04 09:17:42'),
(4, 'Baaed', 'Baeed@gmail.com', NULL, '$2y$10$n1/tgcCksfkjj8nP4.epzeHkS1J/9d1HKCHUCI35Ed63LiayVXAJi', NULL, NULL, NULL, NULL, 4, NULL, 0, 0, '2023-06-04 09:17:42', '2023-06-04 09:17:42'),
(5, 'Khamsat', 'Khamsat@gmail.com', NULL, '$2y$10$Hkejcz3g5X9iCKb.gaPWcujiR4vQkRoAVIa8vjdyyj754vOaAC92W', NULL, NULL, NULL, NULL, 5, NULL, 0, 0, '2023-06-04 09:17:42', '2023-06-04 09:17:42'),
(6, 'Ana', 'Ana@gmail.com', NULL, '$2y$10$6eT4mpc8WzjqNwpp0/Xu3eJ6IwbpavFwR90n/t60qygHewuwtVMYa', NULL, NULL, NULL, NULL, 6, NULL, 0, 0, '2023-06-04 09:17:42', '2023-06-04 09:17:42');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hours` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `minutes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seconds` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `processed` tinyint(1) NOT NULL DEFAULT '0',
  `Longitudinal` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `user_id`, `title`, `disk`, `video_path`, `image_path`, `hours`, `minutes`, `seconds`, `quality`, `processed`, `Longitudinal`, `created_at`, `updated_at`) VALUES
(1, 1, 'دورة علوم الحاسوب - أكاديمية حسوب', 'test', 'test', 'test/computer-science/computer-science.png', '0', '2', '4', '720', 1, 0, '2023-06-04 09:17:42', '2023-06-04 09:17:42'),
(2, 1, 'دورة تطوير واجهات المستخدم - أكاديمية حسوب', 'test', 'test', 'test/frontend/frontend.jpg', '0', '1', '57', '480', 1, 0, '2023-06-04 09:17:42', '2023-06-04 09:17:42'),
(3, 2, 'دورة تطوير الويب باستخدام لغة جافاسكريبت', 'test', 'test', 'test/javascript/javascript.png', '0', '2', '1', '360', 1, 0, '2023-06-04 09:17:42', '2023-06-04 09:17:42'),
(4, 2, 'دورة تطوير تطبيقات الهاتف باستخدام Cordova', 'test', 'test', 'test/cordova/cordova.jpg', '0', '2', '14', '360', 1, 0, '2023-06-04 09:17:42', '2023-06-04 09:17:42'),
(5, 3, 'خمسة نصائح لاختيار أفضل المستقلين للعمل على مشروعك', 'test', 'test', 'test/mostaql/mostaql.png', '0', '1', '43', '360', 1, 0, '2023-06-04 09:17:42', '2023-06-04 09:17:42'),
(6, 5, 'اعرض خدماتك في أكبر سوق عربي لعرض وشراء الخدمات المصغرة', 'test', 'test', 'test/khamsat/khamsat.png', '0', '1', '37', '720', 1, 0, '2023-06-04 09:17:42', '2023-06-04 09:17:42'),
(7, 4, 'وظف أفضل المستقلين الموجودين في الوطن العربي عن بعد', 'test', 'test', 'test/baaed/baaed.png', '0', '0', '10', '240', 1, 1, '2023-06-04 09:17:42', '2023-06-04 09:17:42'),
(9, 1, 'test 1', 'public', 'ZkOZE4vXi2lh7dBY.mp4', 'ZkOZE4vXi2lh7dBY.jpg', '0', '0', '20', '1080', 1, 0, '2023-06-05 08:25:12', '2023-06-05 08:29:52');

-- --------------------------------------------------------

--
-- Table structure for table `video_user`
--

CREATE TABLE `video_user` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `video_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `video_user`
--

INSERT INTO `video_user` (`id`, `user_id`, `video_id`, `created_at`, `updated_at`) VALUES
(21, 1, 1, '2023-06-05 08:14:16', '2023-06-05 08:14:16'),
(22, 1, 2, '2023-06-05 08:14:25', '2023-06-05 08:14:25');

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `video_id` bigint UNSIGNED NOT NULL,
  `views_number` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `views`
--

INSERT INTO `views` (`id`, `user_id`, `video_id`, `views_number`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 70, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(2, 1, 2, 40, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(3, 2, 3, 45, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(4, 2, 4, 58, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(5, 3, 5, 20, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(6, 5, 6, 67, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(7, 4, 7, 15, '2023-06-04 09:17:43', '2023-06-04 09:17:43'),
(9, 1, 9, 0, '2023-06-05 08:25:12', '2023-06-05 08:25:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alerts`
--
ALTER TABLE `alerts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_video_id_foreign` (`video_id`);

--
-- Indexes for table `converted_videos`
--
ALTER TABLE `converted_videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `converted_videos_video_id_foreign` (`video_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teams_user_id_index` (`user_id`);

--
-- Indexes for table `team_invitations`
--
ALTER TABLE `team_invitations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_invitations_team_id_email_unique` (`team_id`,`email`);

--
-- Indexes for table `team_user`
--
ALTER TABLE `team_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_user_team_id_user_id_unique` (`team_id`,`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `videos_user_id_foreign` (`user_id`);

--
-- Indexes for table `video_user`
--
ALTER TABLE `video_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `video_user_user_id_foreign` (`user_id`),
  ADD KEY `video_user_video_id_foreign` (`video_id`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `views_user_id_foreign` (`user_id`),
  ADD KEY `views_video_id_foreign` (`video_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alerts`
--
ALTER TABLE `alerts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `converted_videos`
--
ALTER TABLE `converted_videos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_invitations`
--
ALTER TABLE `team_invitations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_user`
--
ALTER TABLE `team_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `video_user`
--
ALTER TABLE `video_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_video_id_foreign` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `converted_videos`
--
ALTER TABLE `converted_videos`
  ADD CONSTRAINT `converted_videos_video_id_foreign` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `team_invitations`
--
ALTER TABLE `team_invitations`
  ADD CONSTRAINT `team_invitations_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `video_user`
--
ALTER TABLE `video_user`
  ADD CONSTRAINT `video_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `video_user_video_id_foreign` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `views`
--
ALTER TABLE `views`
  ADD CONSTRAINT `views_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `views_video_id_foreign` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
