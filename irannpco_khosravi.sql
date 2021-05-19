-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 17, 2021 at 03:55 PM
-- Server version: 10.3.28-MariaDB-log-cll-lve
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `irannpco_khosravi`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_card` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `shaba` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `user_id`, `full_name`, `number_card`, `shaba`, `created_at`, `updated_at`) VALUES
(3, 2, 'امین بالاور', '6221061212244664', 'IRdlkskdafwer34324', '2021-04-03 11:07:37', '2021-04-03 11:07:37');

-- --------------------------------------------------------

--
-- Table structure for table `active_reserves`
--

CREATE TABLE `active_reserves` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_host_id` int(11) NOT NULL,
  `host_id` int(11) NOT NULL,
  `group_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token_cancel` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `active_reserves`
--

INSERT INTO `active_reserves` (`id`, `user_id`, `user_host_id`, `host_id`, `group_code`, `token`, `token_cancel`, `created_at`, `updated_at`) VALUES
(1, 8, 2, 5, 'zdmdPN20210407164333|||1617797613', '4162', 9721, '2021-04-07 12:13:33', '2021-04-07 12:13:33'),
(2, 8, 2, 5, 'cdxd9X20210407164401|||1617797641', '1260', 7945, '2021-04-07 12:14:01', '2021-04-07 12:14:01'),
(3, 8, 2, 5, 'QCpxOr20210407164444|||1617797684', '2989', 5941, '2021-04-07 12:14:44', '2021-04-07 12:14:44');

-- --------------------------------------------------------

--
-- Table structure for table `admin_payments`
--

CREATE TABLE `admin_payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'آی دی کاربر دریافت کننده پول',
  `price` int(11) NOT NULL,
  `bank_receipt_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'شماره رسید بانکی',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_payments`
--

INSERT INTO `admin_payments` (`id`, `user_id`, `price`, `bank_receipt_number`, `created_at`, `updated_at`) VALUES
(1, 2, 200000, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province_id` int(11) NOT NULL,
  `township_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `name`, `province_id`, `township_id`, `city_id`, `active`, `created_at`, `updated_at`) VALUES
(1, 'منطقه ۱', 1, 1, 1, 1, '2018-05-21 19:30:00', '2018-05-22 07:48:53'),
(2, 'منطقه ۲', 1, 1, 1, 1, '2018-05-22 07:37:47', '2018-05-22 07:47:04'),
(3, 'منطقه ۳', 1, 1, 1, 1, '2018-05-23 00:56:41', '2018-05-23 00:56:41'),
(4, 'منطقه ۴', 1, 1, 1, 1, '2018-05-21 19:30:00', '2018-05-22 07:48:53'),
(5, 'منطقه ۵', 1, 1, 1, 1, '2018-05-22 07:37:47', '2018-05-22 07:47:04'),
(6, 'منطقه ۶', 1, 1, 1, 1, '2018-05-23 00:56:41', '2018-05-23 00:56:41'),
(7, 'منطقه ۷', 1, 1, 1, 1, '2018-05-21 19:30:00', '2018-05-22 07:48:53'),
(8, 'منطقه ۸', 1, 1, 1, 1, '2018-05-22 07:37:47', '2018-05-22 07:47:04'),
(9, 'منطقه ۹', 1, 1, 1, 1, '2018-05-23 00:56:41', '2018-05-23 00:56:41'),
(10, 'منطقه ۱۰', 1, 1, 1, 1, '2018-05-21 19:30:00', '2018-05-22 07:48:53'),
(11, 'منطقه ۱۱', 1, 1, 1, 1, '2018-05-22 07:37:47', '2018-05-22 07:47:04'),
(12, 'منطقه ۱۲', 1, 1, 1, 1, '2018-05-23 00:56:41', '2018-05-23 00:56:41'),
(13, 'منطقه ۱۳', 1, 1, 1, 1, '2018-05-23 00:56:41', '2018-05-23 00:56:41'),
(14, 'منطقه ۱۴', 1, 1, 1, 1, '2018-05-21 19:30:00', '2018-05-22 07:48:53'),
(15, 'منطقه ۱۵', 1, 1, 1, 1, '2018-05-22 07:37:47', '2018-05-22 07:47:04'),
(16, 'منطقه ۱۶', 1, 1, 1, 1, '2018-05-23 00:56:41', '2018-05-23 00:56:41'),
(17, 'منطقه ۱۷', 1, 1, 1, 1, '2018-05-21 19:30:00', '2018-05-22 07:48:53'),
(18, 'منطقه ۱۸', 1, 1, 1, 1, '2018-05-22 07:37:47', '2018-05-22 07:47:04'),
(19, 'منطقه ۱۹', 1, 1, 1, 1, '2018-05-23 00:56:41', '2018-05-23 00:56:41'),
(20, 'منطقه ۲۰', 1, 1, 1, 1, '2018-05-21 19:30:00', '2018-05-22 07:48:53'),
(21, 'منطقه ۲۱', 1, 1, 1, 1, '2018-05-22 07:37:47', '2018-05-23 00:58:57'),
(22, 'منطقه ۲۲', 1, 1, 1, 1, '2018-05-23 00:56:41', '2018-05-23 00:56:41');

-- --------------------------------------------------------

--
-- Table structure for table `blocked_days`
--

CREATE TABLE `blocked_days` (
  `id` int(11) NOT NULL,
  `host_id` int(11) NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `building_types`
--

CREATE TABLE `building_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `building_types`
--

INSERT INTO `building_types` (`id`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, 'آپارتمان', 1, '2018-08-25 12:25:53', '2021-02-23 08:57:58'),
(2, 'سوئیت', 1, '2018-08-25 12:25:58', '2019-08-24 08:23:40'),
(3, 'هتل', 1, '2018-08-25 12:26:13', '2019-08-24 08:24:15'),
(4, 'اقامتگاه بوم گردی', 1, '2019-08-24 08:24:30', '2019-08-24 08:24:30'),
(5, 'مسافرخانه', 1, '2019-08-24 08:25:04', '2019-08-24 08:25:04'),
(6, 'ویلا', 1, '2019-08-24 08:25:31', '2019-08-24 08:25:31'),
(7, 'خانه ویلایی', 1, '2019-08-24 08:26:13', '2019-08-24 08:26:13'),
(8, 'کلبه', 1, '2019-08-24 08:30:04', '2019-08-24 08:30:04'),
(21, 'هتل آپارتمان', 1, '2019-08-24 08:30:04', '2019-08-24 08:30:04');

-- --------------------------------------------------------

--
-- Table structure for table `cancel_rules`
--

CREATE TABLE `cancel_rules` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cancel_rules`
--

INSERT INTO `cancel_rules` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'سهلگیرانه', 'صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. ک', '2019-06-20 19:30:00', '2019-06-20 19:30:00'),
(2, 'متعادل', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. ک', '2019-06-20 19:30:00', '2019-06-20 19:30:00'),
(3, 'سختگیرانه', 'چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. ک', '2019-06-20 19:30:00', '2019-06-20 19:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `view` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_infos`
--

CREATE TABLE `contact_infos` (
  `id` int(10) UNSIGNED NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aparat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telegram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_infos`
--

INSERT INTO `contact_infos` (`id`, `phone`, `about`, `email`, `aparat`, `telegram`, `whatsapp`, `instagram`, `address`, `latitude`, `longitude`) VALUES
(1, '02100000', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی \r\n', 'info@npco.ir', 'http://aparat.com', 'http://Telegram.com', 'https://whatsapp.com', 'http://Instagram.com', 'تهران', 35.7125, 51.3675);

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` int(11) NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `content` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL DEFAULT 1,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `alias`, `title`, `content`, `type`, `active`, `created_at`, `updated_at`) VALUES
(1, 'درباره-ما', 'درباره ما', '<p>تست</p>', 1, 1, '2021-02-14 09:18:34', '2021-02-14 09:18:34'),
(2, 'ثبت-شکایات', 'ثبت شکایات', '<p>تست</p>', 1, 1, '2021-02-14 09:18:46', '2021-02-14 09:18:46'),
(3, 'مقررات-و-راهنمای-ثبت-نام', 'مقررات و راهنمای ثبت نام', '<p>تست</p>', 1, 1, '2021-02-14 09:19:29', '2021-02-14 09:19:29'),
(4, 'پیشنهادات', 'پیشنهادات', '<p>تست</p>', 2, 1, '2021-02-14 09:19:54', '2021-02-14 09:19:54'),
(5, 'راهنمای-درخواست-رزرو', 'راهنمای درخواست رزرو', '<p>تست</p>', 2, 1, '2021-02-14 09:20:18', '2021-02-14 09:20:18');

-- --------------------------------------------------------

--
-- Table structure for table `discount_days`
--

CREATE TABLE `discount_days` (
  `id` int(11) NOT NULL,
  `host_id` int(11) NOT NULL,
  `number_days` int(11) DEFAULT 0,
  `percent` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discount_days`
--

INSERT INTO `discount_days` (`id`, `host_id`, `number_days`, `percent`, `created_at`, `updated_at`) VALUES
(1, 1, 10, 5, '2021-02-13 12:25:23', '2021-02-13 12:25:23'),
(2, 5, 3, 5, '2021-03-03 13:26:31', '2021-03-03 13:26:31'),
(3, 5, 5, 10, '2021-03-03 13:26:31', '2021-03-03 13:26:31'),
(5, 7, 1, 5, '2021-03-06 10:03:03', '2021-03-06 10:03:03'),
(7, 7, 5, 5, '2021-03-06 10:46:11', '2021-03-06 10:46:11'),
(10, 6, 5, 10, '2021-03-06 13:30:06', '2021-03-06 13:30:06'),
(11, 6, 3, 10, '2021-03-06 13:30:06', '2021-03-06 13:30:06'),
(12, 4, 9, 10, '2021-03-08 06:08:23', '2021-03-08 06:08:23');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province_id` int(11) NOT NULL,
  `township_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`, `province_id`, `township_id`, `city_id`, `area_id`, `active`, `created_at`, `updated_at`) VALUES
(1, 'ازگل', 1, 1, 1, 1, 1, '2018-05-21 19:30:00', '2018-07-16 07:19:56'),
(2, 'اراج', 1, 1, 1, 1, 1, '2018-05-23 00:54:34', '2018-07-16 07:19:46'),
(3, 'اما م زاده قاسم(ع)', 1, 1, 1, 1, 1, '2018-07-16 07:20:28', '2018-07-16 07:20:28'),
(4, 'اوین', 1, 1, 1, 1, 1, '2018-07-16 07:21:01', '2018-07-16 07:21:01'),
(5, 'باغ فردوس', 1, 1, 1, 1, 1, '2018-07-16 07:21:16', '2018-07-16 07:21:16'),
(6, 'تجریش', 1, 1, 1, 1, 1, '2018-07-16 07:21:28', '2018-07-16 07:21:28'),
(7, 'جماران', 1, 1, 1, 1, 1, '2018-07-16 07:21:42', '2018-07-16 07:21:42'),
(8, 'چیذر', 1, 1, 1, 1, 1, '2018-07-16 07:22:04', '2018-07-16 07:22:04'),
(9, 'حصار بوعلی', 1, 1, 1, 1, 1, '2018-07-16 07:22:33', '2018-07-16 07:22:33'),
(10, 'حکمت', 1, 1, 1, 1, 1, '2018-07-16 07:22:50', '2018-07-16 07:22:50'),
(11, 'دارآباد', 1, 1, 1, 1, 1, '2018-07-16 07:23:04', '2018-07-16 07:23:04'),
(12, 'دانشگاه/گلها', 1, 1, 1, 1, 1, '2018-07-16 07:23:28', '2018-07-16 07:23:28'),
(13, 'دربند', 1, 1, 1, 1, 1, '2018-07-16 07:23:47', '2018-07-16 07:23:47'),
(14, 'درکه', 1, 1, 1, 1, 1, '2018-07-16 07:23:59', '2018-07-16 07:23:59'),
(15, 'دزاشیب', 1, 1, 1, 1, 1, '2018-07-16 07:24:14', '2018-07-16 07:24:14'),
(16, 'زعفرانیه', 1, 1, 1, 1, 1, '2018-07-16 07:24:29', '2018-07-16 07:24:29'),
(17, 'سوهانک', 1, 1, 1, 1, 1, '2018-07-16 07:24:56', '2018-07-16 07:24:56'),
(18, 'شهرک نفت', 1, 1, 1, 1, 1, '2018-07-16 07:25:27', '2018-07-16 07:25:27'),
(19, 'فرمانیه', 1, 1, 1, 1, 1, '2018-07-16 07:25:46', '2018-07-16 07:25:46'),
(20, 'قیطریه', 1, 1, 1, 1, 1, '2018-07-16 07:26:07', '2018-07-16 07:26:07'),
(21, 'کاشانک', 1, 1, 1, 1, 1, '2018-07-16 07:26:22', '2018-07-16 07:26:22'),
(22, 'کوهسار', 1, 1, 1, 1, 1, '2018-07-16 07:26:43', '2018-07-16 07:26:43'),
(23, 'گلابدره', 1, 1, 1, 1, 1, '2018-07-16 07:26:58', '2018-07-16 07:26:58'),
(24, 'محلاتی', 1, 1, 1, 1, 1, '2018-07-16 07:27:14', '2018-07-16 07:27:14'),
(25, 'محمودیه', 1, 1, 1, 1, 1, '2018-07-16 07:27:33', '2018-07-16 07:27:33'),
(26, 'نیاوران', 1, 1, 1, 1, 1, '2018-07-16 07:27:54', '2018-07-16 07:27:54'),
(27, 'ولنجک', 1, 1, 1, 1, 1, '2018-07-16 07:28:07', '2018-07-16 07:28:07'),
(28, 'تست', 1, 1, 1, 1, 1, '2018-08-28 11:02:48', '2018-08-28 11:02:48');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) NOT NULL COMMENT 'نوع مدرک',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `user_id`, `file`, `type`, `created_at`, `updated_at`) VALUES
(1, 2, '6961801617436793.jpg', 4, '2021-04-03 07:59:53', '2021-04-03 07:59:53');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `host_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `host_id`, `created_at`, `updated_at`) VALUES
(10, 2, 6, '2021-03-10 12:08:01', '2021-03-10 12:08:01');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` int(11) NOT NULL,
  `host_id` int(11) NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `host_id`, `img`, `active`, `created_at`, `updated_at`) VALUES
(8, 2, '1613393579_2_602a6eab1cc67.jpg', 1, '2021-02-15 12:52:59', '2021-02-15 12:52:59'),
(12, 3, '1614079096_1_6034e4783f030.jpg', 1, '2021-02-23 11:18:16', '2021-02-23 11:18:16'),
(13, 3, '1614079122_1_6034e492eee62.jpg', 1, '2021-02-23 11:18:42', '2021-02-23 11:18:42'),
(14, 3, '1614079178_1_6034e4ca6d618.jpg', 1, '2021-02-23 11:19:38', '2021-02-23 11:19:38'),
(15, 4, '1614602895_6_603ce28fa01a9.jpg', 1, '2021-03-01 12:48:15', '2021-03-01 12:48:15'),
(16, 5, '1614777835_2_603f8deb29f83.jpg', 1, '2021-03-03 13:23:55', '2021-03-03 13:23:55'),
(20, 6, '1615014716_2_60432b3c3d0b8.jpg', 1, '2021-03-06 07:11:56', '2021-03-06 07:11:56'),
(21, 6, '1615014734_2_60432b4e7e4fe.jpg', 1, '2021-03-06 07:12:14', '2021-03-06 07:12:14'),
(22, 7, '1615024851_2_604352d3cdc20.jpg', 1, '2021-03-06 10:00:51', '2021-03-06 10:00:51'),
(23, 8, '1615104802_2_60448b22659cb.jpg', 1, '2021-03-07 08:13:22', '2021-03-07 08:13:22'),
(28, 4, '1615108037_6_604497c5007a3.jpg', 1, '2021-03-07 09:07:17', '2021-03-07 09:07:17'),
(29, 4, '1615108042_6_604497ca9cd25.jpg', 1, '2021-03-07 09:07:22', '2021-03-07 09:07:22'),
(30, 9, '1615185029_6_6045c485c973e.jpg', 1, '2021-03-08 06:30:29', '2021-03-08 06:30:29'),
(31, 9, '1615187801_6_6045cf59622ba.jpg', 1, '2021-03-08 07:16:41', '2021-03-08 07:16:41'),
(33, 1, '1615715803_2_604ddddb6c608.jpg', 1, '2021-03-14 09:56:43', '2021-03-14 09:56:43'),
(34, 8, '1617787413_2_606d7a15c7791.jpg', 1, '2021-04-07 09:23:33', '2021-04-07 09:23:33'),
(35, 8, '1617787577_2_606d7ab908111.jpg', 1, '2021-04-07 09:26:17', '2021-04-07 09:26:17');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_integrated`
--

CREATE TABLE `gallery_integrated` (
  `id` int(11) NOT NULL,
  `integrated_id` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home_types`
--

CREATE TABLE `home_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `home_types`
--

INSERT INTO `home_types` (`id`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, 'دربستی', 1, '2018-08-25 11:46:33', '2018-08-25 11:52:11'),
(2, 'اتاق شخصی', 1, '2018-08-25 12:11:20', '2018-08-25 12:11:20'),
(3, 'اتاق مشترک', 1, '2018-08-25 12:11:24', '2018-08-25 12:11:24');

-- --------------------------------------------------------

--
-- Table structure for table `hosts`
--

CREATE TABLE `hosts` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meter` int(11) DEFAULT NULL,
  `meter_total` int(11) DEFAULT 0,
  `building_floor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'تعداد طبقات کل ساختمان',
  `floor` int(11) DEFAULT NULL,
  `plaque` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '1400',
  `reconstruction` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'مدل بازسازی',
  `shape_host` int(11) DEFAULT NULL COMMENT 'شکل اقامتگاه',
  `single_bed_reception` int(11) DEFAULT NULL COMMENT 'تخت یک نفره پذیرایی',
  `double_bed_reception` int(11) DEFAULT NULL COMMENT 'تخت دو نفره پذیرایی',
  `sofa_bed_reception` int(11) DEFAULT NULL COMMENT 'مبل تخت خواب شو پذیرایی',
  `traditional_bedding_reception` int(11) DEFAULT NULL COMMENT 'رخت خواب سنتی پذیرایی',
  `type_rent` int(11) DEFAULT NULL COMMENT 'نوع اجاره مجزا یا اشتراکی',
  `register_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `units_per_floor` int(11) DEFAULT NULL COMMENT 'تعداد واحد در هر طبقه',
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `township_id` int(11) DEFAULT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_type_id` smallint(6) DEFAULT NULL,
  `building_type_id` smallint(6) DEFAULT NULL,
  `position_array_1` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `vision` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `distance_shopping` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parking` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_position` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'اطلاعات جغرافیایی دیگر',
  `shared_yard` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'حیاط اشتراکی',
  `standard_guest` int(11) DEFAULT 0 COMMENT 'ظرفیت استاندارد',
  `count_guest` int(11) DEFAULT 0 COMMENT 'ظرفیت میهمان',
  `count_room` int(11) NOT NULL DEFAULT 0,
  `count_bathroom` smallint(6) DEFAULT 0,
  `count_traditional_bed` int(11) NOT NULL DEFAULT 0 COMMENT 'زخت خواب سنتی',
  `single_bed` int(11) NOT NULL DEFAULT 0 COMMENT 'تخت یک نفره',
  `double_bed` int(11) NOT NULL DEFAULT 0 COMMENT 'تخت دو نفره',
  `count_toilet` smallint(6) DEFAULT 0,
  `min_reserve_day` smallint(6) DEFAULT 1 COMMENT 'حداقل تعداد روز رزرو',
  `time_enter_from` smallint(6) NOT NULL DEFAULT 14,
  `time_enter_to` smallint(6) DEFAULT 0,
  `time_exit` smallint(6) NOT NULL DEFAULT 12,
  `special_price` int(11) NOT NULL DEFAULT 0,
  `one_person_price` int(11) NOT NULL DEFAULT 0 COMMENT 'قسمت هر نفر اضافه',
  `latitude` float DEFAULT 35.7115,
  `longitude` float DEFAULT 51.3905,
  `new_rule` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancel_rule_id` int(11) NOT NULL DEFAULT 1 COMMENT 'قوانین رزرو و کنسل آن',
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_admin` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `count_reserve` int(11) NOT NULL DEFAULT 0 COMMENT 'تعداد رزرو اقامتگاه',
  `max_day_show_calendar` int(11) DEFAULT 0 COMMENT 'تعداد روزهای قابل نمایش در تقویم',
  `percent_instantaneous` int(11) NOT NULL DEFAULT 0 COMMENT 'تخفیف در صورت فعال بودن رزرو فوری',
  `integrated_id` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `step` int(11) NOT NULL DEFAULT 0 COMMENT '100: end host',
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hosts`
--

INSERT INTO `hosts` (`id`, `user_id`, `name`, `meter`, `meter_total`, `building_floor`, `floor`, `plaque`, `postal_code`, `year`, `reconstruction`, `shape_host`, `single_bed_reception`, `double_bed_reception`, `sofa_bed_reception`, `traditional_bedding_reception`, `type_rent`, `register_by`, `units_per_floor`, `unit`, `province_id`, `township_id`, `district`, `address`, `home_type_id`, `building_type_id`, `position_array_1`, `vision`, `distance_shopping`, `parking`, `other_position`, `shared_yard`, `standard_guest`, `count_guest`, `count_room`, `count_bathroom`, `count_traditional_bed`, `single_bed`, `double_bed`, `count_toilet`, `min_reserve_day`, `time_enter_from`, `time_enter_to`, `time_exit`, `special_price`, `one_person_price`, `latitude`, `longitude`, `new_rule`, `cancel_rule_id`, `description`, `description_admin`, `count_reserve`, `max_day_show_calendar`, `percent_instantaneous`, `integrated_id`, `active`, `status`, `step`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 2, 'سوییت مبله', 50, 150, '1', NULL, NULL, NULL, NULL, '1393', 1, 0, 0, 0, 0, 1, '1', 2, NULL, 4, 275, NULL, NULL, NULL, 2, 'a:2:{i:0;s:1:\"1\";i:1;s:1:\"2\";}', 'a:1:{i:0;s:2:\"15\";}', NULL, NULL, NULL, 0, 2, 3, 1, 0, 0, 0, 0, 0, 2, 13, 21, 12, 200000, 60000, 35.7115, 51.3905, NULL, 1, 'توصیه ما به شما این است که حتی‌‌الامکان برنامه های سفر خودتان را به تعویق بیندازید اما اگر به هر دلیلی قصد مسافرت داشتید این اقامتگاه‌‌ها تمامی شرایطی که اتاقک برای حفظ سلامت میهمانان تعیین کرده که شامل موارد زیر است را رعایت کرده است: 1-بلافاصله بعد از خروج هر مهمان، امکان حضور فرد جدید در این اقامتگاه وجود ندارد و میزبان به فاصله چند ساعت تا یک روز زمان برای ضد‌‌‌‌عفونی کردن اقامتگاه نیاز دارد. 2- میزبان این اقامتگاه علاوه بر رعایت کامل موارد بهداشتی که در حالت عادی انجام می‌‌شود، مواردی مثل ض', NULL, 0, 60, 0, 0, 1, 2, 100, 0, '2021-02-09 14:41:30', '2021-04-03 06:22:06'),
(2, 2, 'نالهللهال', 50, NULL, '1', NULL, NULL, NULL, NULL, '1', 1, 0, 0, 0, 0, 1, '1', 1, NULL, 5, 303, NULL, NULL, NULL, 1, 'a:1:{i:0;s:1:\"2\";}', NULL, 'undefined', 'undefined', NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 14, 0, 12, 0, 412321, 35.7115, 51.3905, NULL, 1, 'توصیه ما به شما این است که حتی‌‌الامکان برنامه های سفر خودتان را به تعویق بیندازید اما اگر به هر دلیلی قصد مسافرت داشتید این اقامتگاه‌‌ها تمامی شرایطی که اتاقک برای حفظ سلامت میهمانان تعیین کرده که شامل موارد زیر است را رعایت کرده است: 1-بلافاصله بعد از خروج هر مهمان، امکان حضور فرد جدید در این اقامتگاه وجود ندارد و میزبان به فاصله چند ساعت تا یک روز زمان برای ضد‌‌‌‌عفونی کردن اقامتگاه نیاز دارد. 2- میزبان این اقامتگاه علاوه بر رعایت کامل موارد بهداشتی که در حالت عادی انجام می‌‌شود، مواردی مثل ضدعفونی تمام لوازم خانه از جمله لوازم آشپزخانه، سرویس خواب، سرویس بهداشتی، حمام و بقیه قسمت های خانه را به صورت کاملا دقیق انجام خواهد داد. کلیه تجهیزات رفاهی برای اقامت شما عزیزان به بهترین شکل ممکن تدارک دیده شده و آشپزخانه ی مجهز این سوئیت دارای امکانات کافی جهت آشپزی در طول اقامت شما می باشد. این سوئیت دارای آسانسور بوده که برای اقامت معلولین محترم و سالمندان عزیز بسیار راحت می باشد. سیستم صوتی و تصویری به روز همچنین سیستم سرمایش و گرمایش عالی از ویژگی های خوب این سوئیت زیبا می باشد. رستوران در نزدیکی مجموعه میباشد پارکینگ طبقاتی عمومی در نزدیکی مجموعه است', NULL, 0, 45, 0, 0, 1, 0, 100, 0, '2021-02-13 12:45:08', '2021-03-03 11:24:35'),
(3, 1, 'سشیشس', 23, NULL, '1', NULL, '23', '323232323', NULL, '1', 1, 0, 0, 0, 0, 1, '1', 1, NULL, 7, 378, 'ستارخان', NULL, NULL, 2, 'a:1:{i:0;s:1:\"5\";}', NULL, 'undefined', 'undefined', NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 14, 0, 12, 0, 0, 35.7115, 51.3905, NULL, 1, 'توصیه ما به شما این است که حتی‌‌الامکان برنامه های سفر خودتان را به تعویق بیندازید اما اگر به هر دلیلی قصد مسافرت داشتید این اقامتگاه‌‌ها تمامی شرایطی که اتاقک برای حفظ سلامت میهمانان تعیین کرده که شامل موارد زیر است را رعایت کرده است: 1-بلافاصله بعد از خروج هر مهمان، امکان حضور فرد جدید در این اقامتگاه وجود ندارد و میزبان به فاصله چند ساعت تا یک روز زمان برای ضد‌‌‌‌عفونی کردن اقامتگاه نیاز دارد. 2- میزبان این اقامتگاه علاوه بر رعایت کامل موارد بهداشتی که در حالت عادی انجام می‌‌شود، مواردی مثل ضدعفونی تمام لوازم خانه از جمله لوازم آشپزخانه، سرویس خواب، سرویس بهداشتی، حمام و بقیه قسمت های خانه را به صورت کاملا دقیق انجام خواهد داد. کلیه تجهیزات رفاهی برای اقامت شما عزیزان به بهترین شکل ممکن تدارک دیده شده و آشپزخانه ی مجهز این سوئیت دارای امکانات کافی جهت آشپزی در طول اقامت شما می باشد. این سوئیت دارای آسانسور بوده که برای اقامت معلولین محترم و سالمندان عزیز بسیار راحت می باشد. سیستم صوتی و تصویری به روز همچنین سیستم سرمایش و گرمایش عالی از ویژگی های خوب این سوئیت زیبا می باشد. رستوران در نزدیکی مجموعه میباشد پارکینگ طبقاتی عمومی در نزدیکی مجموعه است', NULL, 0, 0, 0, 0, 0, 0, 3, 0, '2021-02-14 09:18:50', '2021-02-23 11:04:52'),
(4, 6, 'واحد لوکس', 50, 0, '1', 1, '15', '2568971250', NULL, 'undefined', 1, 0, 0, 0, 0, 1, '1', 1, '1', 7, 378, 'ستارخان', 'تهران ستارخان', NULL, 1, 'a:1:{i:0;s:0:\"\";}', 'undefined', 'undefined', 'undefined', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ', 0, 2, 2, 0, 0, 0, 0, 0, 0, 1, 14, 0, 12, 0, 540000000, 35.8289, 51.3905, 'asdasdasd', 1, 'توصیه ما به شما این است که حتی‌‌الامکان برنامه های سفر خودتان را به تعویق بیندازید اما اگر به هر دلیلی قصد مسافرت داشتید این اقامتگاه‌‌ها تمامی شرایطی که اتاقک برای حفظ سلامت میهمانان تعیین کرده که شامل موارد زیر است را رعایت کرده است: 1-بلافاصله بعد از خروج هر مهمان، امکان حضور فرد جدید در این اقامتگاه وجود ندارد و میزبان به فاصله چند ساعت تا یک روز زمان برای ضد‌‌‌‌عفونی کردن اقامتگاه نیاز دارد. 2- میزبان این اقامتگاه علاوه بر رعایت کامل موارد بهداشتی که در حالت عادی انجام می‌‌شود، مواردی مثل ضدعفونی تمام لوازم خانه از جمله لوازم آشپزخانه، سرویس خواب، سرویس بهداشتی، حمام و بقیه قسمت های خانه را به صورت کاملا دقیق انجام خواهد داد. کلیه تجهیزات رفاهی برای اقامت شما عزیزان به بهترین شکل ممکن تدارک دیده شده و آشپزخانه ی مجهز این سوئیت دارای امکانات کافی جهت آشپزی در طول اقامت شما می باشد. این سوئیت دارای آسانسور بوده که برای اقامت معلولین محترم و سالمندان عزیز بسیار راحت می باشد. سیستم صوتی و تصویری به روز همچنین سیستم سرمایش و گرمایش عالی از ویژگی های خوب این سوئیت زیبا می باشد. رستوران در نزدیکی مجموعه میباشد پارکینگ طبقاتی عمومی در نزدیکی مجموعه است', NULL, 0, 90, 0, 0, 1, 0, 100, 0, '2021-02-27 08:32:29', '2021-03-08 06:08:23'),
(5, 2, 'آپارتمان مبله تمیز و مرتب نوساز', 55, 0, '5', 1, '10', '4224422222', NULL, '1', 1, 1, 0, 0, 1, 1, '1', 1, '1', 2, 319, 'ری', 'ری شهر', NULL, 1, 'a:1:{i:0;s:1:\"5\";}', 'دریا', 'undefined', 'undefined', 'خاکی', 0, 2, 3, 2, 0, 0, 0, 0, 0, 1, 14, 16, 12, 0, 50, 35.7115, 51.3905, 'قوانین رعایت شود', 1, 'توصیه ما به شما این است که حتی‌‌الامکان برنامه های سفر خودتان را به تعویق بیندازید اما اگر به هر دلیلی قصد مسافرت داشتید این اقامتگاه‌‌ها تمامی شرایطی که اتاقک برای حفظ سلامت میهمانان تعیین کرده که شامل موارد زیر است را رعایت کرده است: 1-بلافاصله بعد از خروج هر مهمان، امکان حضور فرد جدید در این اقامتگاه وجود ندارد و میزبان به فاصله چند ساعت تا یک روز زمان برای ضد‌‌‌‌عفونی کردن اقامتگاه نیاز دارد. 2- میزبان این اقامتگاه علاوه بر رعایت کامل موارد بهداشتی که در حالت عادی انجام می‌‌شود، مواردی مثل ضدعفونی تمام لوازم خانه از جمله لوازم آشپزخانه، سرویس خواب، سرویس بهداشتی، حمام و بقیه قسمت های خانه را به صورت کاملا دقیق انجام خواهد داد. کلیه تجهیزات رفاهی برای اقامت شما عزیزان به بهترین شکل ممکن تدارک دیده شده و آشپزخانه ی مجهز این سوئیت دارای امکانات کافی جهت آشپزی در طول اقامت شما می باشد. این سوئیت دارای آسانسور بوده که برای اقامت معلولین محترم و سالمندان عزیز بسیار راحت می باشد. سیستم صوتی و تصویری به روز همچنین سیستم سرمایش و گرمایش عالی از ویژگی های خوب این سوئیت زیبا می باشد. رستوران در نزدیکی مجموعه میباشد پارکینگ طبقاتی عمومی در نزدیکی مجموعه است', NULL, 0, 45, 0, 0, 1, 1, 100, 0, '2021-03-03 11:24:38', '2021-03-03 13:26:31'),
(6, 2, 'اقامتگاه مبله دربست', 80, 0, '3', 4, '342', '1652031563', NULL, '2', 1, 0, 0, 1, 0, 2, '1', 1, '2', 7, 378, 'ستارخان', 'تهران ستارخان خیابان شادمان نبش کوچه گل افشان پلاک 342', NULL, 1, 'a:1:{i:0;s:1:\"2\";}', NULL, 'undefined', 'undefined', 'نزدیک مترو و فروشگاه، دسترسی آسان', 0, 2, 4, 2, 0, 0, 0, 0, 0, 3, 14, 16, 12, 0, 150000, 35.6997, 51.3905, 'همراه داشتن کارت ملی الزامی است', 1, 'توصیه ما به شما این است که حتی‌‌الامکان برنامه های سفر خودتان را به تعویق بیندازید اما اگر به هر دلیلی قصد مسافرت داشتید این اقامتگاه‌‌ها تمامی شرایطی که اتاقک برای حفظ سلامت میهمانان تعیین کرده که شامل موارد زیر است را رعایت کرده است: 1-بلافاصله بعد از خروج هر مهمان، امکان حضور فرد جدید در این اقامتگاه وجود ندارد و میزبان به فاصله چند ساعت تا یک روز زمان برای ضد‌‌‌‌عفونی کردن اقامتگاه نیاز دارد. 2- میزبان این اقامتگاه علاوه بر رعایت کامل موارد بهداشتی که در حالت عادی انجام می‌‌شود، مواردی مثل ضدعفونی تمام لوازم خانه از جمله لوازم آشپزخانه، سرویس خواب، سرویس بهداشتی، حمام و بقیه قسمت های خانه را به صورت کاملا دقیق انجام خواهد داد. کلیه تجهیزات رفاهی برای اقامت شما عزیزان به بهترین شکل ممکن تدارک دیده شده و آشپزخانه ی مجهز این سوئیت دارای امکانات کافی جهت آشپزی در طول اقامت شما می باشد. این سوئیت دارای آسانسور بوده که برای اقامت معلولین محترم و سالمندان عزیز بسیار راحت می باشد. سیستم صوتی و تصویری به روز همچنین سیستم سرمایش و گرمایش عالی از ویژگی های خوب این سوئیت زیبا می باشد. رستوران در نزدیکی مجموعه میباشد پارکینگ طبقاتی عمومی در نزدیکی مجموعه است', NULL, 0, 180, 0, 0, 1, 1, 100, 0, '2021-03-03 13:27:05', '2021-03-14 09:22:52'),
(7, 2, 'سوییت مبله شیک', 50, 0, '12', 6, '12', '1212121212', NULL, '2', 1, 0, 1, 0, 0, 1, '1', 1, '1', 11, 70, NULL, 'خیابان رهبر', NULL, 2, 'a:1:{i:0;s:1:\"9\";}', 'خیابان', 'undefined', 'undefined', 'راه خاکی', 0, 2, 2, 0, 0, 0, 0, 0, 0, 1, 14, 0, 12, 0, 50000, 35.7115, 51.3905, NULL, 1, 'توصیه ما به شما این است که حتی‌‌الامکان برنامه های سفر خودتان را به تعویق بیندازید اما اگر به هر دلیلی قصد مسافرت داشتید این اقامتگاه‌‌ها تمامی شرایطی که اتاقک برای حفظ سلامت میهمانان تعیین کرده که شامل موارد زیر است را رعایت کرده است: 1-بلافاصله بعد از خروج هر مهمان، امکان حضور فرد جدید در این اقامتگاه وجود ندارد و میزبان به فاصله چند ساعت تا یک روز زمان برای ضد‌‌‌‌عفونی کردن اقامتگاه نیاز دارد. 2- میزبان این اقامتگاه علاوه بر رعایت کامل موارد بهداشتی که در حالت عادی انجام می‌‌شود، مواردی مثل ضدعفونی تمام لوازم خانه از جمله لوازم آشپزخانه، سرویس خواب، سرویس بهداشتی، حمام و بقیه قسمت های خانه را به صورت کاملا دقیق انجام خواهد داد. کلیه تجهیزات رفاهی برای اقامت شما عزیزان به بهترین شکل ممکن تدارک دیده شده و آشپزخانه ی مجهز این سوئیت دارای امکانات کافی جهت آشپزی در طول اقامت شما می باشد. این سوئیت دارای آسانسور بوده که برای اقامت معلولین محترم و سالمندان عزیز بسیار راحت می باشد. سیستم صوتی و تصویری به روز همچنین سیستم سرمایش و گرمایش عالی از ویژگی های خوب این سوئیت زیبا می باشد. رستوران در نزدیکی مجموعه میباشد پارکینگ طبقاتی عمومی در نزدیکی مجموعه است', NULL, 0, 45, 0, 0, 0, 0, 100, 0, '2021-03-06 07:43:01', '2021-03-14 11:52:16'),
(8, 2, 'خانه ویلایی شیک و تمیز', 400, 300, '4', 1, '12', '1212121212', NULL, '1395', 1, 1, 1, 0, 0, 1, '1', 4, '1', 4, 258, 'سیجان', 'اصفهان خیابان امام', NULL, 7, 'a:1:{i:0;s:0:\"\";}', 'undefined', 'undefined', 'undefined', NULL, 0, 1, 3, 1, 0, 0, 0, 0, 0, 1, 14, 0, 12, 0, 0, 35.7115, 51.3905, NULL, 1, NULL, NULL, 0, 0, 0, 0, 0, 0, 3, 0, '2021-03-06 13:21:26', '2021-04-10 11:07:38'),
(9, 6, 'ghfghgh', 345345, 0, '17', 1, NULL, NULL, '1400', '0', 3, 2, 5, 4, 5, 3, '1', 6, '1', 9, 104, 'fdgkdfg', 'rsdtffsdf', NULL, 2, 'a:1:{i:0;s:0:\"\";}', 'undefined', 'undefined', 'undefined', NULL, 0, 2, 3, 0, 0, 0, 0, 0, 0, 1, 14, 0, 12, 0, 0, 35.7115, 51.3905, NULL, 1, NULL, 'خوش حساب', 0, 0, 0, 0, 0, -1, 5, 0, '2021-03-08 06:09:50', '2021-04-03 07:20:38'),
(12, 8, NULL, NULL, 0, NULL, NULL, NULL, NULL, '1400', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 14, 0, 12, 0, 0, 35.7115, 51.3905, NULL, 1, NULL, NULL, 0, 0, 0, 0, 1, 0, 0, 0, '2021-04-07 11:40:59', '2021-04-07 11:40:59');

-- --------------------------------------------------------

--
-- Table structure for table `host_possibilities`
--

CREATE TABLE `host_possibilities` (
  `id` int(11) NOT NULL,
  `host_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `host_possibilities`
--

INSERT INTO `host_possibilities` (`id`, `host_id`, `option_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 10, 1, '', '2021-03-08 13:57:34', '2021-03-08 13:57:34'),
(2, 10, 3, '', '2021-03-08 13:57:34', '2021-03-08 13:57:34'),
(3, 10, 5, '', '2021-03-08 13:57:34', '2021-03-08 13:57:34'),
(18, 8, 23, '', '2021-04-10 11:07:38', '2021-04-10 11:07:38'),
(19, 8, 29, '', '2021-04-10 11:07:38', '2021-04-10 11:07:38');

-- --------------------------------------------------------

--
-- Table structure for table `host_rules`
--

CREATE TABLE `host_rules` (
  `id` int(11) NOT NULL,
  `host_id` int(11) NOT NULL,
  `rule_id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `host_rules`
--

INSERT INTO `host_rules` (`id`, `host_id`, `rule_id`, `description`, `created_at`, `updated_at`) VALUES
(3, 8, 1, 'فقط سیگار', '2021-04-07 09:27:59', '2021-04-07 09:27:59'),
(4, 8, 5, '', '2021-04-07 09:27:59', '2021-04-07 09:27:59');

-- --------------------------------------------------------

--
-- Table structure for table `info_provinces`
--

CREATE TABLE `info_provinces` (
  `id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `center_province` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `speech_language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `important_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `important_attractions` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'جاذبه های مهم',
  `population` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `info_townships`
--

CREATE TABLE `info_townships` (
  `id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `township_id` int(11) NOT NULL,
  `important_attractions` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `population` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plate_car` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instant_bookings`
--

CREATE TABLE `instant_bookings` (
  `id` int(11) NOT NULL,
  `host_id` int(11) NOT NULL,
  `from_date` timestamp NULL DEFAULT NULL,
  `to_date` timestamp NULL DEFAULT NULL,
  `min_day_reserve` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instant_bookings`
--

INSERT INTO `instant_bookings` (`id`, `host_id`, `from_date`, `to_date`, `min_day_reserve`, `created_at`, `updated_at`) VALUES
(3, 7, '2021-02-28 20:30:00', '2021-03-17 20:30:00', 2, '2021-03-17 14:17:50', '2021-03-17 14:17:50'),
(4, 5, '2021-04-05 19:30:00', '2021-04-11 19:30:00', 3, '2021-03-30 10:43:29', '2021-03-30 10:43:29');

-- --------------------------------------------------------

--
-- Table structure for table `integrateds`
--

CREATE TABLE `integrateds` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `count_host` int(11) NOT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` float(8,6) DEFAULT NULL,
  `longitude` float(9,6) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invite_transactions`
--

CREATE TABLE `invite_transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent_user_id` int(11) NOT NULL COMMENT 'آی دی کاربری که دعوتش کرده',
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `last_minute_reserves`
--

CREATE TABLE `last_minute_reserves` (
  `id` int(11) NOT NULL,
  `host_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `price_person` int(11) NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `last_minute_reserves`
--

INSERT INTO `last_minute_reserves` (`id`, `host_id`, `price`, `price_person`, `date`, `created_at`, `updated_at`) VALUES
(3, 5, 60000, 50000, '2021-03-16 20:30:00', '2021-03-17 14:18:02', '2021-03-17 14:18:02'),
(4, 2, 20000000, 10000, '2021-03-29 19:30:00', '2021-03-30 10:49:44', '2021-03-30 10:49:44'),
(5, 7, 120000, 150000, '2021-03-29 19:30:00', '2021-03-30 10:58:59', '2021-03-30 10:58:59');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `sender_id` int(10) UNSIGNED NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `view` smallint(6) NOT NULL,
  `sms` tinyint(1) NOT NULL DEFAULT 0,
  `reply` tinyint(4) NOT NULL DEFAULT 0,
  `parent_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `title`, `message`, `file`, `view`, `sms`, `reply`, `parent_id`, `created_at`, `updated_at`) VALUES
(2, 1, 2, 'خوش آمدید', 'به سایت خانه رو خوش آمدید، لحظات خوشی را برای شما آرزومندیم.', NULL, 1, 0, 0, 0, '2021-03-08 11:39:56', '2021-03-13 15:07:02'),
(3, 2, 1, NULL, 'با سلام و خسته نباشید ، ممنون از تیم پشتیبانی سایت', NULL, 0, 0, 0, 0, '2021-03-14 11:29:40', '2021-03-14 11:29:40'),
(4, 8, 2, 'رزرو اقامتگاه', 'درخواست رزرو اقامتگاه آپارتمان مبله تمیز و مرتب نوساز از طرف   به مدت 4 شب برای شما فرستاده شده است', NULL, 0, 0, 0, 0, '2021-04-07 12:13:33', '2021-04-07 12:13:33'),
(5, 8, 2, 'رزرو اقامتگاه', 'درخواست رزرو اقامتگاه آپارتمان مبله تمیز و مرتب نوساز از طرف   به مدت 4 شب برای شما فرستاده شده است', NULL, 0, 0, 0, 0, '2021-04-07 12:14:01', '2021-04-07 12:14:01'),
(6, 8, 2, 'رزرو اقامتگاه', 'درخواست رزرو اقامتگاه آپارتمان مبله تمیز و مرتب نوساز از طرف   به مدت 4 شب برای شما فرستاده شده است', NULL, 0, 0, 0, 0, '2021-04-07 12:14:44', '2021-04-07 12:14:44');

-- --------------------------------------------------------

--
-- Table structure for table `months`
--

CREATE TABLE `months` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_day` int(11) NOT NULL,
  `first_day_id` int(11) NOT NULL COMMENT 'در تاریخ های جدید آپدیت شود - در یک سال آینده-مثل سایت تایم دات آی ار'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `months`
--

INSERT INTO `months` (`id`, `name`, `number_day`, `first_day_id`) VALUES
(1, 'فروردین', 31, 2),
(2, 'اردیبهشت', 31, 5),
(3, 'خرداد', 31, 1),
(4, 'تیر', 31, 4),
(5, 'مرداد', 31, 7),
(6, 'شهریور', 31, 3),
(7, 'مهر', 30, 6),
(8, 'آبان', 30, 1),
(9, 'آذر', 30, 3),
(10, 'دی', 30, 5),
(11, 'بهمن', 30, 5),
(12, 'اسفند', 30, 7);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT 'توضیحات',
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT 1,
  `type` int(11) DEFAULT 1 COMMENT 'امکانات / خدمات',
  `active` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `name`, `description`, `img`, `priority`, `type`, `active`, `created_at`, `updated_at`) VALUES
(1, 'تلویزیون', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(2, 'اینترنت', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(3, 'استخر', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(4, 'پارکینگ', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(5, 'ظروف آشپزخانه', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(6, 'اجاق گاز', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(7, 'یخچال', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(8, 'مبلمان', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(9, 'سیستم سرمایشی', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(10, 'سیستم گرمایشی', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(11, 'حمام', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(12, 'بالکن', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(13, 'توالت ایرانی', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(14, 'توالت فرنگی', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(15, 'آسانسور', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(16, 'آبگرم کن', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(17, 'جارو برقی', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(18, 'اتو', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(19, 'سشوار', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(20, 'ماشین لباسشویی', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(21, 'حیاط', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(22, 'کابینت', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(23, 'میز ناهارخوری', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(24, 'ماکروفر', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(25, 'سونا', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(26, 'جکوزی', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(27, 'میز بیلیارد', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(28, 'میز پینگ پونگ', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(29, 'سالن بدنسازی', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(30, 'فوتبال دستی', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(31, 'سیستم صوتی', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(32, 'باربیکیو', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(33, 'سیستم تهویه مطبوع', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(34, 'سیستم اطفا حریق', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(35, 'کپسول آتش نشانی', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(36, 'وان', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(37, 'سیخ', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(38, 'نگهبان / سرایدار', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(39, 'آنتن دهی ایرانسل', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(40, 'آنتن دهی همراه اول', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(41, 'آنتن دهی رایتل', 'توضیحات', NULL, 1, 1, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(42, 'صبحانه', 'توضیحات', NULL, 1, 2, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(43, 'ناهار', 'توضیحات', NULL, 1, 2, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(44, 'شام', 'توضیحات', NULL, 1, 2, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(45, 'تحویل ملحفه تمیز', 'توضیحات', NULL, 1, 2, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(46, 'لوازم بهداشتی', 'توضیحات', NULL, 1, 2, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53'),
(47, 'نظافت اقامتگاه', 'توضیحات', NULL, 1, 2, '1', '2021-03-08 13:41:53', '2021-03-08 13:41:53');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `remaining_price` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `reserve_code` varchar(255) NOT NULL,
  `tracking_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `type` int(11) DEFAULT 1 COMMENT '1: bank 2: wallet',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `price`, `remaining_price`, `user_id`, `reserve_code`, `tracking_code`, `ref_id`, `status`, `type`, `created_at`, `updated_at`) VALUES
(1, 160000, 0, 2, 'juhhuilhuilgilufly', '564564', NULL, 1, 1, '2020-04-26 08:07:38', '2020-04-26 08:07:38');

-- --------------------------------------------------------

--
-- Table structure for table `position_types`
--

CREATE TABLE `position_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) DEFAULT 1,
  `active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `position_types`
--

INSERT INTO `position_types` (`id`, `name`, `type`, `active`, `created_at`, `updated_at`) VALUES
(1, 'کویری', 1, 1, '2018-08-25 12:50:28', '2018-08-25 12:50:52'),
(2, 'شهری', 1, 1, '2018-08-25 12:50:32', '2018-08-25 12:50:32'),
(3, 'صنعتی', 1, 1, '2018-08-25 12:50:36', '2018-08-25 12:50:36'),
(4, 'تاریخی', 1, 1, '2018-08-25 12:50:40', '2018-08-25 12:50:40'),
(5, 'نزدیک دریا', 1, 1, '2018-08-25 12:50:43', '2018-08-25 12:50:49'),
(6, 'بومی', 1, 1, '2018-08-25 12:50:58', '2018-08-25 12:50:58'),
(7, 'شهرکی', 1, 1, '2018-08-25 12:51:01', '2018-08-25 12:51:01'),
(8, 'جنگلی', 1, 1, '2018-08-25 12:51:05', '2018-08-25 12:51:05'),
(9, 'نزدیک رودخانه', 1, 1, '2018-08-25 12:51:08', '2018-08-25 12:51:08'),
(10, 'نزدیک حرم', 1, 1, '2018-08-25 12:51:11', '2018-08-25 12:51:11'),
(11, 'ساحلی', 1, 1, '2018-08-25 12:51:15', '2018-08-25 12:51:15'),
(12, 'روستایی', 1, 1, '2018-08-25 12:51:15', '2018-08-25 12:51:15'),
(13, 'شهر', 2, 1, '2018-08-25 12:50:58', '2018-08-25 12:50:58'),
(14, 'دریا', 2, 1, '2018-08-25 12:51:01', '2018-08-25 12:51:01'),
(15, 'جنگل', 2, 1, '2018-08-25 12:51:05', '2018-08-25 12:51:05'),
(16, 'کوهستان', 2, 1, '2018-08-25 12:51:08', '2018-08-25 12:51:08'),
(17, 'باغ', 2, 1, '2018-08-25 12:51:11', '2018-08-25 12:51:11'),
(18, 'دشت', 2, 1, '2018-08-25 12:51:15', '2018-08-25 12:51:15'),
(19, 'رودخانه', 2, 1, '2018-08-25 12:51:15', '2018-08-25 12:51:15');

-- --------------------------------------------------------

--
-- Table structure for table `price_days`
--

CREATE TABLE `price_days` (
  `id` int(11) NOT NULL,
  `host_id` int(11) NOT NULL,
  `week_id` int(11) NOT NULL,
  `price` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `price_days`
--

INSERT INTO `price_days` (`id`, `host_id`, `week_id`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 123000, '2021-02-13 12:25:23', '2021-02-13 12:25:23'),
(2, 1, 2, 123000, '2021-02-13 12:25:23', '2021-02-13 12:25:23'),
(3, 1, 3, 123000, '2021-02-13 12:25:23', '2021-02-13 12:25:23'),
(4, 1, 4, 123000, '2021-02-13 12:25:23', '2021-02-13 12:25:23'),
(5, 1, 5, 123000, '2021-02-13 12:25:23', '2021-02-13 12:25:23'),
(6, 1, 6, 150000, '2021-02-13 12:25:23', '2021-02-13 12:25:23'),
(7, 1, 7, 180000, '2021-02-13 12:25:23', '2021-02-13 12:25:23'),
(8, 2, 1, 121212000, '2021-03-03 11:24:35', '2021-03-03 11:24:35'),
(9, 2, 2, 121212000, '2021-03-03 11:24:35', '2021-03-03 11:24:35'),
(10, 2, 3, 121212000, '2021-03-03 11:24:35', '2021-03-03 11:24:35'),
(11, 2, 4, 121212000, '2021-03-03 11:24:35', '2021-03-03 11:24:35'),
(12, 2, 5, 13213000, '2021-03-03 11:24:35', '2021-03-03 11:24:35'),
(13, 2, 6, 123213000, '2021-03-03 11:24:35', '2021-03-03 11:24:35'),
(14, 2, 7, 123123000, '2021-03-03 11:24:35', '2021-03-03 11:24:35'),
(15, 5, 1, 200000, '2021-03-03 13:26:31', '2021-03-03 13:26:31'),
(16, 5, 2, 200000, '2021-03-03 13:26:31', '2021-03-03 13:26:31'),
(17, 5, 3, 200000, '2021-03-03 13:26:31', '2021-03-03 13:26:31'),
(18, 5, 4, 200000, '2021-03-03 13:26:31', '2021-03-03 13:26:31'),
(19, 5, 5, 250000, '2021-03-03 13:26:31', '2021-03-03 13:26:31'),
(20, 5, 6, 300000, '2021-03-03 13:26:31', '2021-03-03 13:26:31'),
(21, 5, 7, 300000, '2021-03-03 13:26:31', '2021-03-03 13:26:31'),
(44, 7, 1, 200000, '2021-03-06 10:46:11', '2021-03-06 10:46:11'),
(45, 7, 2, 200000, '2021-03-06 10:46:11', '2021-03-06 10:46:11'),
(46, 7, 3, 200000, '2021-03-06 10:46:11', '2021-03-06 10:46:11'),
(47, 7, 4, 200000, '2021-03-06 10:46:11', '2021-03-06 10:46:11'),
(48, 7, 5, 250000, '2021-03-06 10:46:11', '2021-03-06 10:46:11'),
(49, 7, 6, 300000, '2021-03-06 10:46:11', '2021-03-06 10:46:11'),
(50, 7, 7, 300000, '2021-03-06 10:46:11', '2021-03-06 10:46:11'),
(51, 7, 8, 1000, '2021-03-06 10:46:11', '2021-03-06 10:46:11'),
(60, 6, 1, 500000, '2021-03-06 13:30:06', '2021-03-06 13:30:06'),
(61, 6, 2, 500000, '2021-03-06 13:30:06', '2021-03-06 13:30:06'),
(62, 6, 3, 500000, '2021-03-06 13:30:06', '2021-03-06 13:30:06'),
(63, 6, 4, 500000, '2021-03-06 13:30:06', '2021-03-06 13:30:06'),
(64, 6, 5, 500000, '2021-03-06 13:30:06', '2021-03-06 13:30:06'),
(65, 6, 6, 600000, '2021-03-06 13:30:06', '2021-03-06 13:30:06'),
(66, 6, 7, 500000, '2021-03-06 13:30:06', '2021-03-06 13:30:06'),
(67, 6, 8, 1000, '2021-03-06 13:30:06', '2021-03-06 13:30:06'),
(68, 4, 1, 540000000, '2021-03-08 06:08:23', '2021-03-08 06:08:23'),
(69, 4, 2, 540000000, '2021-03-08 06:08:23', '2021-03-08 06:08:23'),
(70, 4, 3, 540000000, '2021-03-08 06:08:23', '2021-03-08 06:08:23'),
(71, 4, 4, 540000000, '2021-03-08 06:08:23', '2021-03-08 06:08:23'),
(72, 4, 5, 540000000, '2021-03-08 06:08:23', '2021-03-08 06:08:23'),
(73, 4, 6, 540000000, '2021-03-08 06:08:23', '2021-03-08 06:08:23'),
(74, 4, 7, 540000000, '2021-03-08 06:08:23', '2021-03-08 06:08:23');

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `name`, `country_id`, `active`, `created_at`, `updated_at`) VALUES
(1, 'آذربایجان شرقی\r\n', 114, 1, '2019-08-05 19:30:00', '2019-08-05 19:30:00'),
(2, 'آذربايجان غربي', 114, 1, '2019-08-05 19:30:00', '2019-08-05 19:30:00'),
(3, 'اردبيل', 114, 1, '2019-08-05 19:30:00', '2019-08-05 19:30:00'),
(4, 'اصفهان', 114, 1, '2019-08-05 19:30:00', '2019-08-05 19:30:00'),
(5, 'ايلام', 114, 1, '2019-08-05 19:30:00', '2019-08-05 19:30:00'),
(6, 'بوشهر', 114, 1, '2019-08-05 19:30:00', '2019-08-05 19:30:00'),
(7, 'تهران', 114, 1, '2019-08-05 19:30:00', '2019-08-05 19:30:00'),
(8, 'چهارمحال بختياري', 114, 1, '2019-08-05 19:30:00', '2019-08-05 19:30:00'),
(9, 'خراسان جنوبي', 114, 1, '2019-08-05 19:30:00', '2019-08-05 19:30:00'),
(10, 'خراسان رضوی', 114, 1, '2019-08-05 19:30:00', '2019-08-05 19:30:00'),
(11, 'خراسان شمالي', 114, 1, '2019-08-05 19:30:00', '2019-08-05 19:30:00'),
(12, 'خوزستان', 114, 1, '2019-08-05 19:30:00', '2019-08-05 19:30:00'),
(13, 'زنجان', 114, 1, '2019-08-05 19:30:00', '2019-08-05 19:30:00'),
(14, 'سمنان', 114, 1, '2019-08-05 19:30:00', '2019-08-05 19:30:00'),
(15, 'سيستان و بلوچستان', 114, 1, '2019-08-05 19:30:00', '2019-08-05 19:30:00'),
(16, 'فارس', 114, 1, '2019-08-05 19:30:00', '2019-08-05 19:30:00'),
(17, 'قزوین', 114, 1, '2019-08-05 19:30:00', '2019-08-05 19:30:00'),
(18, 'قم', 114, 1, '2019-08-05 19:30:00', '2019-08-05 19:30:00'),
(19, 'البرز', 114, 1, '2019-08-05 19:30:00', '2019-08-05 19:30:00'),
(20, 'کردستان', 114, 1, '2019-08-05 19:30:00', '2019-08-05 19:30:00'),
(21, 'کرمان', 114, 1, '2019-08-05 19:30:00', '2019-08-05 19:30:00'),
(22, 'کرمانشاه', 114, 1, '2019-08-05 19:30:00', '2019-08-05 19:30:00'),
(23, 'کهگیلویه و بویراحمد', 114, 1, '2019-08-05 19:30:00', '2019-08-05 19:30:00'),
(24, 'گلستان', 114, 1, '2019-08-05 19:30:00', '2019-08-05 19:30:00'),
(25, 'گیلان', 114, 1, '2019-08-05 19:30:00', '2019-08-05 19:30:00'),
(26, 'لرستان', 114, 1, '2019-08-05 19:30:00', '2019-08-05 19:30:00'),
(27, 'مازندران', 114, 1, '2019-08-05 19:30:00', '2019-08-05 19:30:00'),
(28, 'مرکزی', 114, 1, '2019-08-05 19:30:00', '2019-08-05 19:30:00'),
(29, 'هرمزگان', 114, 1, '2019-08-05 19:30:00', '2019-08-05 19:30:00'),
(30, 'همدان', 114, 1, '2019-08-05 19:30:00', '2019-08-05 19:30:00'),
(31, 'یزد', 114, 1, '2019-08-05 19:30:00', '2019-08-05 19:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `answer`, `active`, `created_at`, `updated_at`) VALUES
(1, 'مراحل راه اندازی وب سایت چیست؟', 'تحلیل و مشاوره در خصوص انتخاب امکانات مورد نیاز برای وب سایت\r\nانتخاب نام مناسب برای سایت \r\nعقد قرار داد و دریافت پیش پرداخت\r\nثبت دامنه (نام سایت) Domain Registration  \r\nدریافت اطلاعات اولیه و نظرات شما در خصوص نوع طراحی\r\nانجام مراحل طراحی گرافیکی قالب و ظاهر سایت \r\nتائید طرح توسط شما\r\nایجاد استراتژی از عملکرد سایت \r\nورود اطلاعات اولیه وب سایت(اطلاعات نمونه)\r\nطراحی صفحات بر اساس آخرین استانداردها \r\nاختصاص فضای اینترنتی (هاستینگ) Hosting \r\nبارگذاری سایت طراحی شده بر روی فضای اینترنت \r\nتحویل و آموزش وب سایت در محل شرکت\r\nدریافت با ماباقی مبلغ قرارداد \r\nشروع پشتیبانی یکساله وب سایت ( شامل آپدیت های نرم افزاری - برطرف کردن اشکالات احتمالی و فنی وب سایت )', 1, '2018-04-15 04:12:08', '2018-05-05 07:37:51'),
(2, 'دامنه چیست؟', 'دامنه نام منحصر به فردی است کهه برای شناسایی سایت اینترنتی مورد استفاده قرار می گیرد  و از یک یا چند قسمت تشکیل شده است که با نقطه ( دات ) از هم جدا شده اند . قسمت اول ماهیت آدرس www قسمت دوم نام دامنه domain name و به قسمت سوم پسوند دامنه می گویند.', 1, '2018-04-15 04:30:31', '2018-04-29 03:30:30'),
(3, 'پشتیبانی وب سایت چیست؟', 'نگهداری و پشتیبانی سایت ،سرویسی است که به شما این امکان را می دهد  که وب سایت خود را به روز نگه دارید همچنین سرویس پشتیبانی به شما کمک می کند تا ترافیک خود را افزایش دهید و کاربران بسیاری را جذب خود کنید. پیشنهاد ما یک سرویس  نگهداری و پشتیبانی وب سایت سفارشی است که به شما امکان ویرایش، بروزرسانی و مدیریت وب سایت را می دهد ما چندین بسته ی پشتیبانی وب سایت را به شما ارائه خواهیم داد تا بر اساس نیاز های خود یکی از بسته ها را انتخاب کنید.', 1, '2018-04-15 04:30:50', '2018-04-15 04:30:50'),
(4, 'وب سایت واکنش گرا (Responsive) چیست؟', 'در گذشته برای نمایش یک سایت در موبایل یک طراحی مجزا انجام می دادند در این نوع طراحی سرور با توجه به شناسه مرورگر کاربر تشخیص  می داد که کاربر سایت را با موبایل بازدید می کند در این حالت محتوای موبایل را در همان آدرس به او نشان می داد یا او را به URL مخصوص موبایل هدایت می نمود. اما در طراحی سایت واکنش گرا که بیشتر به همان  Responsive Webdesign   مشهور است ساختار لایه های سایت به صورت شناور طراحی می شود و با کمک خاصیت Media در تگ Link با توجه به سایز صفحه css  مربوطه بارگزاری می شود که باعث تنظیم عرض صفحه، سایز متن و چینش محتوا در ابعاد مختلف می شود.', 1, '2018-04-15 04:31:15', '2018-04-15 04:31:15'),
(5, 'بهینه سازی وب سایت چیست؟', 'روشی برای ارتقاء یک وب سایت به منظور افزایش تعداد بازدیدکننده هایی است که از موتورهای جستجو دریافت می کند سئو  جنبه های متفاوتی دارد از کلماتی که در وب سایت استفاده می کنید گرفته تا لینک هایی که دیگر سایت ها به شما می دهند ، به عبارت دیگر سئو به این معناست : اطمینان از این که ساختار وب سایت به سادگی و راحتی برای موتورهای جستجو قابل فهم است.سئو تنها درباره ی موتورهای جستجو نیست  بلکه در طرف مقابل به معنای ساخت وب سایت به طوری است که برای کاربران خوشایند باشد.', 1, '2018-04-15 04:41:42', '2018-04-15 04:41:42'),
(6, 'سایت داینامیک و استاتیک چه تفاوت هایی دارند؟', 'اصولا سایتهای ایستا یا استاتیک سایتهایی هستند که ضرورتی برای تغییر مداوم اطلاعات آنها احساس نمی شود. اینگونه وب سایتها معمولا تنها جهت معرفی کاربرد دارند،عملیات محتوایی سایت به ندرت صورت می پذیرد و در مقابل سایتهای پویا نیاز شدید به تغییر مداوم اطلاعات و محتوا داشته و بنا به نیازمندی و کاربرد سایت طراحی و توسعه می یابند .', 1, '2018-04-15 04:41:59', '2018-04-15 04:41:59'),
(7, 'مراحل راه اندازی وب سایت چیست؟', 'تحلیل و مشاوره در خصوص انتخاب امکانات مورد نیاز برای وب سایت\r\nانتخاب نام مناسب برای سایت \r\nعقد قرار داد و دریافت پیش پرداخت\r\nثبت دامنه (نام سایت) Domain Registration  \r\nدریافت اطلاعات اولیه و نظرات شما در خصوص نوع طراحی\r\nانجام مراحل طراحی گرافیکی قالب و ظاهر سایت \r\nتائید طرح توسط شما\r\nایجاد استراتژی از عملکرد سایت \r\nورود اطلاعات اولیه وب سایت(اطلاعات نمونه)\r\nطراحی صفحات بر اساس آخرین استانداردها \r\nاختصاص فضای اینترنتی (هاستینگ) Hosting \r\nبارگذاری سایت طراحی شده بر روی فضای اینترنت \r\nتحویل و آموزش وب سایت در محل شرکت\r\nدریافت با ماباقی مبلغ قرارداد \r\nشروع پشتیبانی یکساله وب سایت ( شامل آپدیت های نرم افزاری - برطرف کردن اشکالات احتمالی و فنی وب سایت )', 0, '2018-04-15 04:12:08', '2018-04-29 03:30:33');

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `host_id` int(11) NOT NULL,
  `rate1` int(11) NOT NULL DEFAULT 1,
  `rate2` int(11) NOT NULL DEFAULT 1,
  `rate3` int(11) NOT NULL DEFAULT 1,
  `rate4` int(11) DEFAULT 1,
  `rate5` int(11) NOT NULL DEFAULT 1,
  `comment` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reserves`
--

CREATE TABLE `reserves` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `host_id` int(11) NOT NULL,
  `group_code` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `reserve_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `week_id` int(1) NOT NULL,
  `day_price` int(11) NOT NULL,
  `special` tinyint(1) NOT NULL DEFAULT 0,
  `special_price` int(11) NOT NULL DEFAULT 0,
  `percent` int(11) NOT NULL DEFAULT 0,
  `extra_price_person` int(11) NOT NULL DEFAULT 0 COMMENT 'هزینه هفرات اضافی',
  `final_price` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `submit_rate` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '  0 : در خواست 1 : در انتظار پرداخت 2 :پرداخت شده -1 : رد شده -2 : کنسل شده توسط کاربر  -100:منقضی شده',
  `step` int(11) DEFAULT 1 COMMENT '0:درخواست  1:تایید  2:پرداخت  3:کلید',
  `type_payment` int(11) DEFAULT 1 COMMENT '1 = bank 2 = wallet',
  `level_reserve` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reserves`
--

INSERT INTO `reserves` (`id`, `user_id`, `host_id`, `group_code`, `reserve_date`, `week_id`, `day_price`, `special`, `special_price`, `percent`, `extra_price_person`, `final_price`, `description`, `submit_rate`, `status`, `step`, `type_payment`, `level_reserve`, `created_at`, `updated_at`) VALUES
(1, 8, 5, 'zdmdPN20210407164333|||1617797613', '2021-04-06 19:30:00', 5, 250000, 0, 0, 5, 100, 237600, 'یه روز خوب !', 0, 0, 1, 1, 0, '2021-04-07 12:13:33', '2021-04-07 12:13:33'),
(2, 8, 5, 'zdmdPN20210407164333|||1617797613', '2021-04-07 19:30:00', 6, 300000, 0, 0, 5, 100, 285100, 'یه روز خوب !', 0, 0, 1, 1, 0, '2021-04-07 12:13:33', '2021-04-07 12:13:33'),
(3, 8, 5, 'zdmdPN20210407164333|||1617797613', '2021-04-08 19:30:00', 7, 300000, 0, 0, 5, 100, 285100, 'یه روز خوب !', 0, 0, 1, 1, 0, '2021-04-07 12:13:33', '2021-04-07 12:13:33'),
(4, 8, 5, 'zdmdPN20210407164333|||1617797613', '2021-04-09 19:30:00', 1, 200000, 0, 0, 5, 100, 190100, 'یه روز خوب !', 0, 0, 1, 1, 0, '2021-04-07 12:13:33', '2021-04-07 12:13:33'),
(5, 8, 5, 'cdxd9X20210407164401|||1617797641', '2021-04-06 19:30:00', 5, 250000, 0, 0, 5, 100, 237600, 'یه روز خوب !', 0, 0, 1, 1, 0, '2021-04-07 12:14:01', '2021-04-07 12:14:01'),
(6, 8, 5, 'cdxd9X20210407164401|||1617797641', '2021-04-07 19:30:00', 6, 300000, 0, 0, 5, 100, 285100, 'یه روز خوب !', 0, 0, 1, 1, 0, '2021-04-07 12:14:01', '2021-04-07 12:14:01'),
(7, 8, 5, 'cdxd9X20210407164401|||1617797641', '2021-04-08 19:30:00', 7, 300000, 0, 0, 5, 100, 285100, 'یه روز خوب !', 0, 0, 1, 1, 0, '2021-04-07 12:14:01', '2021-04-07 12:14:01'),
(8, 8, 5, 'cdxd9X20210407164401|||1617797641', '2021-04-09 19:30:00', 1, 200000, 0, 0, 5, 100, 190100, 'یه روز خوب !', 0, 0, 1, 1, 0, '2021-04-07 12:14:01', '2021-04-07 12:14:01'),
(9, 8, 5, 'QCpxOr20210407164444|||1617797684', '2021-04-06 19:30:00', 5, 250000, 0, 0, 5, 100, 237600, 'یه روز خوب !', 0, 0, 1, 1, 0, '2021-04-07 12:14:44', '2021-04-07 12:14:44'),
(10, 8, 5, 'QCpxOr20210407164444|||1617797684', '2021-04-07 19:30:00', 6, 300000, 0, 0, 5, 100, 285100, 'یه روز خوب !', 0, 0, 1, 1, 0, '2021-04-07 12:14:44', '2021-04-07 12:14:44'),
(11, 8, 5, 'QCpxOr20210407164444|||1617797684', '2021-04-08 19:30:00', 7, 300000, 0, 0, 5, 100, 285100, 'یه روز خوب !', 0, 0, 1, 1, 0, '2021-04-07 12:14:44', '2021-04-07 12:14:44'),
(12, 8, 5, 'QCpxOr20210407164444|||1617797684', '2021-04-09 19:30:00', 1, 200000, 0, 0, 5, 100, 190100, 'یه روز خوب !', 0, 0, 1, 1, 0, '2021-04-07 12:14:44', '2021-04-07 12:14:44');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `role`) VALUES
(1, 'مدیریت سایت', 'admin'),
(2, 'میزبان/میهمان', 'host/guest');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `host_id` int(11) NOT NULL,
  `single_beds` smallint(6) NOT NULL DEFAULT 0,
  `double_beds` smallint(6) NOT NULL DEFAULT 0,
  `sofa_beds` smallint(6) NOT NULL DEFAULT 0,
  `traditional_beds` smallint(6) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `host_id`, `single_beds`, `double_beds`, `sofa_beds`, `traditional_beds`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 1, 0, 0, 1, '2021-02-09 12:24:21', '2021-02-09 12:24:21'),
(2, 1, 0, 0, 0, 2, 1, '2021-02-09 12:24:21', '2021-02-09 12:24:21'),
(3, 1, 0, 0, 0, 0, 1, '2021-02-09 15:09:33', '2021-02-09 15:09:33'),
(4, 2, 1, 1, 1, 1, 1, '2021-02-14 13:06:14', '2021-02-14 13:06:14'),
(5, 2, 3, 0, 0, 0, 1, '2021-02-14 13:42:57', '2021-02-14 13:42:57'),
(6, 2, 0, 1, 0, 0, 1, '2021-02-14 13:42:57', '2021-02-14 13:42:57'),
(7, 2, 2, 0, 0, 0, 1, '2021-02-15 08:50:34', '2021-02-15 08:50:34'),
(8, 2, 0, 2, 0, 0, 1, '2021-02-15 08:50:34', '2021-02-15 08:50:34'),
(9, 2, 0, 0, 0, 0, 1, '2021-02-17 15:52:05', '2021-02-17 15:52:05'),
(10, 2, 2, 4, 4, 4, 1, '2021-02-17 15:52:05', '2021-02-17 15:52:05'),
(11, 2, 0, 0, 0, 0, 1, '2021-02-17 15:52:05', '2021-02-17 15:52:05'),
(12, 2, 3, 0, 0, 0, 1, '2021-02-20 12:30:30', '2021-02-20 12:30:30'),
(13, 2, 0, 0, 0, 0, 1, '2021-02-23 08:21:03', '2021-02-23 08:21:03'),
(14, 2, 0, 0, 0, 0, 1, '2021-02-23 12:53:23', '2021-02-23 12:53:23'),
(15, 2, 1, 1, 0, 0, 1, '2021-02-24 10:10:37', '2021-02-24 10:10:37'),
(16, 2, 0, 0, 0, 0, 1, '2021-02-24 11:51:10', '2021-02-24 11:51:10'),
(17, 5, 0, 1, 0, 0, 1, '2021-03-03 13:02:35', '2021-03-03 13:02:35'),
(18, 5, 0, 1, 0, 0, 1, '2021-03-03 13:16:45', '2021-03-03 13:16:45'),
(19, 5, 0, 0, 0, 0, 1, '2021-03-03 13:17:09', '2021-03-03 13:17:09'),
(20, 5, 0, 0, 0, 0, 1, '2021-03-03 13:17:09', '2021-03-03 13:17:09'),
(21, 5, 0, 0, 0, 0, 1, '2021-03-03 13:17:09', '2021-03-03 13:17:09'),
(22, 5, 0, 0, 0, 0, 1, '2021-03-03 13:17:53', '2021-03-03 13:17:53'),
(23, 5, 0, 0, 0, 0, 1, '2021-03-03 13:17:53', '2021-03-03 13:17:53'),
(40, 6, 0, 1, 0, 0, 1, '2021-03-06 11:26:58', '2021-03-06 11:26:58'),
(41, 6, 0, 1, 0, 0, 1, '2021-03-06 11:26:58', '2021-03-06 11:26:58'),
(71, 8, 0, 0, 0, 0, 1, '2021-04-10 11:06:54', '2021-04-10 11:06:54');

-- --------------------------------------------------------

--
-- Table structure for table `room_commons`
--

CREATE TABLE `room_commons` (
  `id` int(11) NOT NULL,
  `host_id` int(11) NOT NULL,
  `count_man` int(11) NOT NULL,
  `count_woman` int(11) NOT NULL,
  `count_child` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

CREATE TABLE `rules` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'placeholder',
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rules`
--

INSERT INTO `rules` (`id`, `name`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 'امکان استعمال دخانیات', 'توضیحات ...', 1, '2018-08-26 05:36:21', '2021-02-23 10:28:39'),
(2, 'امکان ورود حیوانات خانگی', 'توضیحات ...', 1, '2018-08-26 05:36:37', '2018-08-28 11:24:04'),
(3, 'امکان برگزاری جشن و مراسم', 'توضیحات ...', 1, '2018-08-26 05:36:42', '2021-02-23 10:32:42'),
(4, 'ارائه مدرک محرمیت برای زوجین مطابق مقررات', 'توضیحات ...', 1, '2018-08-26 05:36:49', '2021-02-23 10:32:37'),
(5, 'محدودیت تردد غیر ضروری از ساعت 12 شب تا 6 صبح', 'توضیحات ...', 1, '2018-08-26 05:36:57', '2021-02-23 10:32:29');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `img1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content1` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content2` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content3` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `img1`, `img2`, `img3`, `content1`, `content2`, `content3`, `created_at`, `updated_at`) VALUES
(2, 'img3.png', 'img2.png', 'eCc5lp1597414081.png', 'درخواست رزرو بده\r\nیک مکان شگفت انگیز انتخاب کن و  درخواست رزرو بده', 'درخواست تو نهایی کن                                                                                                                   \r\nشما منتظر تایید از طرف میزبان هستید ...\r\nتاییدیه درخواست و لینک پرداخت برات پیامک میشه \r\nبا پیش پرداخت یا پرداخت کامل \r\nدرخواست تو نهایی کن\r\n(هیچ مبلغ اضافی به غیر از مبلغ اجاره ازمهمان دریافت نمی گردد)', 'از سفر لذت ببر\r\nرسید سفر (ادرس ، تلفن) برات پیامک میشه\r\nاسوده خاطر با پشتیبانی رنت در تمامی مراحل سفر از سفرت لذت ببر', '2018-12-08 22:00:00', '2020-08-14 14:08:01');

-- --------------------------------------------------------

--
-- Table structure for table `slideshows`
--

CREATE TABLE `slideshows` (
  `id` int(11) NOT NULL,
  `township_id` int(11) DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_users`
--

CREATE TABLE `sms_users` (
  `id` int(11) NOT NULL,
  `user_type` int(11) NOT NULL,
  `message` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `special_dates`
--

CREATE TABLE `special_dates` (
  `id` int(11) NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `special_days`
--

CREATE TABLE `special_days` (
  `id` int(11) NOT NULL,
  `host_id` int(11) NOT NULL,
  `date_from` timestamp NULL DEFAULT NULL,
  `date_to` timestamp NULL DEFAULT NULL,
  `percent` int(11) NOT NULL COMMENT 'درصد تخفیف',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `special_days`
--

INSERT INTO `special_days` (`id`, `host_id`, `date_from`, `date_to`, `percent`, `created_at`, `updated_at`) VALUES
(1, 1, '2021-02-13 20:30:00', '2021-02-16 20:30:00', 10, '2021-02-13 12:25:23', '2021-02-13 12:25:23');

-- --------------------------------------------------------

--
-- Table structure for table `townships`
--

CREATE TABLE `townships` (
  `id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `priority` int(11) DEFAULT 0,
  `latitude` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `townships`
--

INSERT INTO `townships` (`id`, `province_id`, `name`, `priority`, `latitude`, `longitude`, `active`, `created_at`, `updated_at`) VALUES
(1, 30, 'اسدآباد', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(2, 30, 'بهار', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(3, 30, 'تويسركان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(4, 30, 'رزن', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(5, 30, 'فامنين', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(6, 30, 'كبودرآهنگ', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(7, 30, 'ملاير', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(8, 30, 'نهاوند', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(9, 30, 'همدان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(10, 24, 'آزادشهر', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(11, 24, 'آق قلا', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(12, 24, 'بندرگز', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(13, 24, 'تركمن', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(14, 24, 'راميان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(15, 24, 'علي آباد', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(16, 24, 'كردكوي', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(17, 24, 'كلاله', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(18, 24, 'مراوه تپه', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(19, 24, 'مينودشت', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(20, 24, 'گاليكش', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(21, 24, 'گرگان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(22, 24, 'گميشان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(23, 24, 'گنبد كاووس', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(24, 25, 'آستارا', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(25, 25, 'آستانه اشرفيه', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(26, 25, 'املش', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(27, 25, 'بندر انزلي', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(28, 25, 'رشت', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(29, 25, 'رضواشهر', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(30, 25, 'رودبار', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(31, 25, 'رودسر', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(32, 25, 'سياهكل', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(33, 25, 'شفت', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(34, 25, 'صومعه سرا', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(35, 25, 'طوالش', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(36, 25, 'فومن', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(37, 25, 'لاهيجان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(38, 25, 'لنگرود', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(39, 25, 'ماسال', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(40, 16, 'آباده', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(41, 16, 'ارسنجان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(42, 16, 'استهبان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(43, 16, 'اقليد', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(44, 16, 'بوانات', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(45, 16, 'جهرم', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(46, 16, 'خرم بيد', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(47, 16, 'خنج', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(48, 16, 'داراب', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(49, 16, 'رستم', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(50, 16, 'زرين دشت', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(51, 16, 'سروستان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(52, 16, 'سپيدان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(53, 16, 'شيراز', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(54, 16, 'فراشبند', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(55, 16, 'فسا', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(56, 16, 'فيروزآباد', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(57, 16, 'قيروكارزين', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(58, 16, 'كازرون', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(59, 16, 'لارستان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(60, 16, 'لامرد', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(61, 16, 'مرودشت', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(62, 16, 'ممسني', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(63, 16, 'مهر', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(64, 16, 'ني ريز', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(65, 16, 'پاسارگاد', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(66, 16, 'گراش', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(67, 11, 'اسفراين', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(68, 11, 'بجنورد', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(69, 11, 'جاجرم', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(70, 11, 'شيروان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(71, 11, 'فاروج', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(72, 11, 'مانه و سملقان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(73, 11, 'گرمه', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(74, 10, 'باخرز', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(75, 10, 'بجستان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(76, 10, 'بردسكن', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(77, 10, 'بينالود', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(78, 10, 'تايباد', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(79, 10, 'تخت جلگه', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(80, 10, 'تربت جام', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(81, 10, 'تربت حيدريه', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(82, 10, 'جغتاي', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(83, 10, 'جوين', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(84, 10, 'خليل آباد', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(85, 10, 'خواف', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(86, 10, 'خوشاب', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(87, 10, 'درگز', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(88, 10, 'رشتخوار', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(89, 10, 'زاوه', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(90, 10, 'سبزوار', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(91, 10, 'سرخس', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(92, 10, 'فريمان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(93, 10, 'قوچان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(94, 10, 'كاشمر', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(95, 10, 'كلات', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(96, 10, 'مشهد', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(97, 10, 'مه ولات', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(98, 10, 'نيشابور', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(99, 10, 'چناران', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(100, 10, 'گناباد', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(101, 9, 'بشرويه', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(102, 9, 'بيرجند', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(103, 9, 'درميان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(104, 9, 'سرايان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(105, 9, 'سربيشه', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(106, 9, 'فردوس', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(107, 9, 'قائنات', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(108, 9, 'نهبندان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(109, 12, 'آبادان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(110, 12, 'اميديه', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(111, 12, 'انديكا', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(112, 12, 'انديمشك', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(113, 12, 'اهواز', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(114, 12, 'ايذه', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(115, 12, 'باغ ملك', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(116, 12, 'باوي', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(117, 12, 'بندر ماهشهر', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(118, 12, 'بهبهان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(119, 12, 'خرمشهر', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(120, 12, 'دزفول', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(121, 12, 'دشت آزادگان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(122, 12, 'رامشير', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(123, 12, 'رامهرمز', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(124, 12, 'شادگان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(125, 12, 'شوش', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(126, 12, 'شوشتر', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(127, 12, 'لالي', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(128, 12, 'مسجد سليمان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(129, 12, 'هفتگل', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(130, 12, 'هنديجان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(131, 12, 'هويزه', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(132, 12, 'گتوند', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(133, 1, 'آذرشهر', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(134, 1, 'اسكو', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(135, 1, 'اهر', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(136, 1, 'بستان آباد', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(137, 1, 'بناب', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(138, 1, 'تبريز', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(139, 1, 'جلفا', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(140, 1, 'سراب', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(141, 1, 'شبستر', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(142, 1, 'عجب شير', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(143, 1, 'كليبر', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(144, 1, 'مراغه', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(145, 1, 'مرند', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(146, 1, 'ملكان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(147, 1, 'ميانه', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(148, 1, 'هريس', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(149, 1, 'هشترود', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(150, 1, 'ورزقان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(151, 1, 'چاراويماق', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(152, 22, 'اسلام آباد غرب', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(153, 22, 'ثلاث باباجاني', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(154, 22, 'جوانرود', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(155, 22, 'دالاهو', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(156, 22, 'روانسر', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(157, 22, 'سرپل ذهاب', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(158, 22, 'سنقر', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(159, 22, 'صحنه', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(160, 22, 'قصر شيرين', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(161, 22, 'كرمانشاه', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(162, 22, 'كنگاور', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(163, 22, 'هرسين', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(164, 22, 'پاوه', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(165, 22, 'گيلانغرب', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(166, 8, 'اردل', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(167, 8, 'بروجن', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(168, 8, 'شهركرد', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(169, 8, 'فارسان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(170, 8, 'كوهرنگ', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(171, 8, 'كيار', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(172, 8, 'لردگان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(173, 21, 'انار', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(174, 21, 'بافت', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(175, 21, 'بردسير', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(176, 21, 'بم', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(177, 21, 'جيرفت', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(178, 21, 'رابر', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(179, 21, 'راور', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(180, 21, 'رفسنجان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(181, 21, 'رودبار جنوب', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(182, 21, 'ريگان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(183, 21, 'زرند', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(184, 21, 'سيرجان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(185, 21, 'شهربابك', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(186, 21, 'عنبرآباد', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(187, 21, 'فهرج', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(188, 21, 'قلعه گنج', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(189, 21, 'كرمان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(190, 21, 'كهنوج', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(191, 21, 'كوهبنان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(192, 21, 'منوجان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(193, 28, 'آشتيان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(194, 28, 'اراك', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(195, 28, 'تفرش', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(196, 28, 'خمين', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(197, 28, 'خنداب', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(198, 28, 'دليجان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(199, 28, 'زرنديه', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(200, 28, 'ساوه', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(201, 28, 'شازند', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(202, 28, 'كميجان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(203, 28, 'محلات', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(204, 27, 'آمل', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(205, 27, 'بابل', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(206, 27, 'بابلسر', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(207, 27, 'بهشهر', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(208, 27, 'تنکابن', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(209, 27, 'جويبار', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(210, 27, 'رامسر', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(211, 27, 'ساري', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(212, 27, 'سوادکوه', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(213, 27, 'عباس آباد', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(214, 27, 'فريدونکنار', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(215, 27, 'قائمشهر', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(216, 27, 'محمودآباد', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(217, 27, 'نور', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(218, 27, 'نوشهر', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(219, 27, 'نکا', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(220, 27, 'چالوس', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(221, 27, 'گلوگاه', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(222, 17, 'آبيك', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(223, 17, 'البرز', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(224, 17, 'بوئين زهرا', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(225, 17, 'تاكستان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(226, 17, 'قزوين', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(227, 18, 'قم', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(228, 14, 'دامغان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(229, 14, 'سمنان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(230, 14, 'شاهرود', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(231, 14, 'مهدي شهر', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(232, 14, 'گرمسار', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(233, 15, 'ايرانشهر', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(234, 15, 'خاش', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(235, 15, 'دلگان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(236, 15, 'زابل', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(237, 15, 'زابلي', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(238, 15, 'زاهدان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(239, 15, 'زهك', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(240, 15, 'سراوان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(241, 15, 'سرباز', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(242, 15, 'سيب سوران', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(243, 15, 'كنارك', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(244, 15, 'نيك شهر', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(245, 15, 'هيرمند', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(246, 15, 'چاه بهار', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(247, 6, 'بوشهر', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(248, 6, 'تنگستان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(249, 6, 'جم', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(250, 6, 'دشتستان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(251, 6, 'دشتي', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(252, 6, 'دير', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(253, 6, 'ديلم', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(254, 6, 'كنگان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(255, 6, 'گناوه', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(256, 4, 'آران و بيدگل', 0, '', '', 1, '2019-06-03 08:06:25', '2021-04-10 12:16:13'),
(257, 4, 'اردستان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(258, 4, 'اصفهان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(259, 4, 'برخوار', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(260, 4, 'تيران و كرون', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(261, 4, 'خميني شهر', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(262, 4, 'خوانسار', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(263, 4, 'خور و بيابانك', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(264, 4, 'دهاقان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(265, 4, 'سميرم', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(266, 4, 'شاهين شهر و ميمه', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(267, 4, 'شهرضا', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(268, 4, 'فريدن', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(269, 4, 'فريدونشهر', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(270, 4, 'فلاورجان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(271, 4, 'كاشان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(272, 4, 'لنجان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(273, 4, 'مباركه', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(274, 4, 'نائين', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(275, 4, 'نجف آباد', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(276, 4, 'نطنز', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(277, 4, 'چادگان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(278, 4, 'گلپايگان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(279, 26, 'ازنا', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(280, 26, 'اليگودرز', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(281, 26, 'بروجرد', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(282, 26, 'خرم آباد', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(283, 26, 'دلفان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(284, 26, 'دوره', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(285, 26, 'دورود', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(286, 26, 'سلسله', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(287, 26, 'كوهدشت', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(288, 26, 'پلدختر', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(289, 3, 'اردبيل', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(290, 3, 'بيله سوار', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(291, 3, 'خلخال', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(292, 3, 'سرعين', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(293, 3, 'كوثر', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(294, 3, 'مشگين شهر', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(295, 3, 'نمين', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(296, 3, 'نير', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(297, 3, 'پارس آباد', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(298, 3, 'گرمي', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(299, 5, 'آبدانان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(300, 5, 'ايلام', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(301, 5, 'ايوان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(302, 5, 'دره شهر', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(303, 5, 'دهلران', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(304, 5, 'شيروان و چرداول', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(305, 5, 'ملكشاهي', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(306, 5, 'مهران', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(307, 20, 'بانه', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(308, 20, 'بيجار', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(309, 20, 'دهگلان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(310, 20, 'ديواندره', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(311, 20, 'سروآباد', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(312, 20, 'سقز', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(313, 20, 'سنندج', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(314, 20, 'قروه', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(315, 20, 'كامياران', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(316, 20, 'مريوان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(317, 2, 'اروميه', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(318, 2, 'اشنويه', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(319, 2, 'بوكان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(320, 2, 'تكاب', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(321, 2, 'خوي', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(322, 2, 'سردشت', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(323, 2, 'سلماس', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(324, 2, 'شاهين دژ', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(325, 2, 'شوط', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(326, 2, 'ماكو', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(327, 2, 'مهاباد', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(328, 2, 'مياندوآب', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(329, 2, 'نقده', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(330, 2, 'پلدشت', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(331, 2, 'پيرانشهر', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(332, 2, 'چالدران', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(333, 2, 'چايپاره', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(334, 31, 'ابركوه', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(335, 31, 'اردكان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(336, 31, 'بافق', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(337, 31, 'بهاباد', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(338, 31, 'تفت', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(339, 31, 'خاتم', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(340, 31, 'صدوق', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(341, 31, 'طبس', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(342, 31, 'مهريز', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(343, 31, 'ميبد', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(344, 31, 'يزد', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(345, 13, 'ابهر', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(346, 13, 'ايجرود', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(347, 13, 'خدابنده', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(348, 13, 'خرمدره', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(349, 13, 'زنجان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(350, 13, 'طارم', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(351, 13, 'ماه نشان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(352, 19, 'ساوجبلاغ', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(353, 19, 'طالقان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(354, 19, 'كرج', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(355, 19, 'نظرآباد', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(356, 29, 'ابوموسي', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(357, 29, 'بستك', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(358, 29, 'بشاگرد', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(359, 29, 'بندر لنگه', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(360, 29, 'بندرعباس', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(361, 29, 'جاسك', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(362, 29, 'حاجي آباد', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(363, 29, 'خمير', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(364, 29, 'رودان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(365, 29, 'سيريك', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(366, 29, 'قشم', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(367, 29, 'ميناب', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(368, 29, 'پارسيان', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(369, 23, 'باشت', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(370, 23, 'بهمئي', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(371, 23, 'بويراحمد', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(372, 23, 'دنا', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(373, 23, 'كهگيلويه', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(374, 23, 'چرام', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(375, 23, 'گچساران', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(376, 7, 'اسلامشهر', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(377, 7, 'پاكدشت', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(378, 7, 'تهران', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(379, 7, 'دماوند', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(380, 7, 'رباط كريم', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(381, 7, 'ري', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(382, 7, 'شميرانات', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(383, 7, 'شهريار', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(384, 7, 'فيروزكوه', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(385, 7, 'قدس', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(386, 7, 'ملارد', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(387, 7, 'ورامين', 0, '', '', 1, '2019-06-03 08:06:25', '2019-06-03 08:06:25'),
(388, 29, 'کیش', 0, NULL, NULL, 1, '2019-09-16 10:39:43', '2019-09-16 10:39:43');

-- --------------------------------------------------------

--
-- Table structure for table `townshipssss`
--

CREATE TABLE `townshipssss` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province_id` int(11) NOT NULL,
  `priority` tinyint(2) NOT NULL DEFAULT 1,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` int(11) DEFAULT 0,
  `role_id` int(10) UNSIGNED NOT NULL DEFAULT 2,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` tinyint(1) DEFAULT 1,
  `marital_status` int(11) DEFAULT 1,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `first_login` tinyint(1) DEFAULT 0,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'default-user.png',
  `birth_date` timestamp NULL DEFAULT NULL,
  `nt_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `n_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emergency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img_national_card` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirm_rules` tinyint(1) DEFAULT 0,
  `parent_id` int(11) DEFAULT 0 COMMENT 'آی دی کاربری که دعوتش کرده',
  `credit` int(11) DEFAULT 0,
  `payment_wait` int(11) DEFAULT 0 COMMENT 'هنگام پرداخت مبلغ فعلی کیف پول در این فیلد ریخته می شود و پس از انجام نهایی پرداخت از سمت بانک صفر می شود و در صورت عدم پرداخت قطعی به کیف پول اضافه می شود',
  `card_bank_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'شماره حساب بانکی',
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shaba_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirm_user` int(11) DEFAULT 0 COMMENT 'کاربر تایید شده توسط مدیر 2 == در انتظار تایید 1 == تایید شده',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `user_name`, `password`, `city_id`, `role_id`, `mobile`, `telephone`, `email`, `sex`, `marital_status`, `active`, `first_login`, `avatar`, `birth_date`, `nt_code`, `n_number`, `address`, `job`, `instagram`, `about`, `emergency`, `language`, `img_national_card`, `confirm_rules`, `parent_id`, `credit`, `payment_wait`, `card_bank_number`, `account_name`, `shaba_number`, `confirm_user`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'مدیر سایت', NULL, '09123456789', '$2y$10$TAp1A9krQmaObtVwUOiSXuqCSdLCE7xnycUa60.6sGqzJ0hY/wIYG', 1, 1, '09123456789', NULL, NULL, 1, 1, 1, 1, 'admin-1600720753.jpg', '2018-04-16 19:39:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, NULL, NULL, NULL, 1, 'uyv8UbSyWchL9KatyfR2kc6hGQ4729RUjbBvNJ8KpdZB86CES8vLVKhwgFUi', NULL, '2018-04-16 19:30:00', '2020-09-21 20:39:13'),
(2, 'amin', 'balavar', '09121111111', '$2y$10$TAp1A9krQmaObtVwUOiSXuqCSdLCE7xnycUa60.6sGqzJ0hY/wIYG', 382, 2, '09121111111', NULL, 'amin.balavar@yahoo.com', 2, 2, 1, 1, '7922051615033263.png', '1993-08-05 11:09:56', '0016105564', '0016105564', 'تهران - تهران - محله سعادت آباد', 'آزاد', 'alksdjfsdjfksdjflkbr_23', 'sg3654rgg1fgdfgfdg', '44444444444', 'arab', '16117319129895_2_601113c8739f4.jpg', 1, 0, 0, 0, NULL, 'amin balavarسیسیسشیشس', NULL, 1, 'STL2nhvXIgNK0NcqImbiaexOm4i9K7fWNh5X634kkl5hlFsrynJaai5nt6gg', NULL, '2020-04-26 08:07:38', '2021-04-10 12:12:54'),
(6, NULL, NULL, '09396800779', '$2y$10$TAp1A9krQmaObtVwUOiSXuqCSdLCE7xnycUa60.6sGqzJ0hY/wIYG', 0, 1, '09396800779', '0', NULL, 1, 1, 1, 1, 'default-user.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, NULL, NULL, NULL, 0, 'vDizZ5co9LVx98gYajfdbeaW1eWfc232Ay5sUV8TDttdtb3meNA4M0iB5ZfE', NULL, '2021-02-21 09:50:05', '2021-03-14 11:48:31'),
(8, NULL, NULL, '09122222222', '$2y$10$sXhmysDhuLzmFNW6zdycSOyVYpS17C8vhO4lASMNn/Is.J2B9TdTG', 0, 2, '09122222222', '0', NULL, 1, 1, 1, 0, 'default-user.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, '2021-04-07 11:36:16', '2021-04-10 12:12:51');

-- --------------------------------------------------------

--
-- Table structure for table `user_activations`
--

CREATE TABLE `user_activations` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_activations`
--

INSERT INTO `user_activations` (`id`, `user_id`, `email`, `token`, `created_at`, `updated_at`) VALUES
(7, 7, NULL, '57170', '2020-05-26 11:40:42', '2020-05-26 11:40:42'),
(8, 8, NULL, '78574', '2020-05-26 11:42:05', '2020-05-26 11:42:05'),
(12, 9, NULL, '28901', '2020-05-26 12:01:35', '2020-05-26 12:01:35'),
(17, 6, NULL, '65941', '2021-02-21 09:29:17', '2021-02-21 09:29:17'),
(18, 7, NULL, '75794', '2021-02-21 09:33:57', '2021-02-21 09:33:57'),
(20, 3, NULL, '61202', '2021-02-21 09:45:12', '2021-02-21 09:45:12'),
(23, 4, NULL, '58738', '2021-02-21 09:46:22', '2021-02-21 09:46:22'),
(25, 5, NULL, '66420', '2021-02-21 09:47:50', '2021-02-21 09:47:50'),
(26, 6, NULL, '15289', '2021-02-21 09:50:05', '2021-02-21 09:50:05'),
(28, 8, NULL, '94315', '2021-04-07 11:36:16', '2021-04-07 11:36:16');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reserve_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'اگر یک بود تراکنش واریز کیف پول به شماره حساب کاربر',
  `payment_id` int(11) NOT NULL COMMENT 'اگر صفر بود تراکنش واریز کیف پول به شماره حساب کاربر',
  `price` int(11) NOT NULL DEFAULT 0,
  `type` int(11) NOT NULL DEFAULT 1 COMMENT '1: variz 2: bardasht',
  `award` int(11) NOT NULL DEFAULT 0 COMMENT 'پاداش دعوت از دوستان',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `user_id`, `reserve_code`, `payment_id`, `price`, `type`, `award`, `description`, `created_at`, `updated_at`) VALUES
(1, 2, '1', 0, 200000, 2, 0, 'مبلغ 200000 هزار تومان از کیف پول شما به حساب شماره کارت  واریز شد', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `weeks`
--

CREATE TABLE `weeks` (
  `id` int(10) UNSIGNED NOT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `e_day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sign` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `weeks`
--

INSERT INTO `weeks` (`id`, `day`, `e_day`, `sign`, `active`, `created_at`, `updated_at`) VALUES
(1, 'شنبه', 'Saturday', '6', 1, NULL, NULL),
(2, 'یکشنبه', 'Sunday', '7', 1, NULL, NULL),
(3, 'دوشنبه', 'Monday', '1', 1, NULL, NULL),
(4, 'سه شنبه', 'Tuesday', '2', 1, NULL, NULL),
(5, 'چهارشنبه', 'Wednesday', '3', 1, NULL, NULL),
(6, 'پنجشنبه', 'Thursday', '4', 1, NULL, NULL),
(7, 'جمعه', 'Friday', '5', 1, NULL, NULL),
(8, 'تمام روزهای هفته', 'All', '0', 0, '2018-02-16 20:30:00', '2018-02-16 20:30:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `active_reserves`
--
ALTER TABLE `active_reserves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_payments`
--
ALTER TABLE `admin_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blocked_days`
--
ALTER TABLE `blocked_days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `building_types`
--
ALTER TABLE `building_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cancel_rules`
--
ALTER TABLE `cancel_rules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_infos`
--
ALTER TABLE `contact_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alias` (`alias`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `discount_days`
--
ALTER TABLE `discount_days`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discount_days_host_id_foreign` (`host_id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favorites_host_id_foreign` (`host_id`),
  ADD KEY `favorites_user_id_foreign` (`user_id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galleries_host_id_foreign` (`host_id`);

--
-- Indexes for table `gallery_integrated`
--
ALTER TABLE `gallery_integrated`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_types`
--
ALTER TABLE `home_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hosts`
--
ALTER TABLE `hosts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id_foreign` (`user_id`),
  ADD KEY `hosts_township_id_foreign` (`township_id`);

--
-- Indexes for table `host_possibilities`
--
ALTER TABLE `host_possibilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `host_rules`
--
ALTER TABLE `host_rules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `info_provinces`
--
ALTER TABLE `info_provinces`
  ADD PRIMARY KEY (`id`),
  ADD KEY `info_provinces_province_id_foreign` (`province_id`);

--
-- Indexes for table `info_townships`
--
ALTER TABLE `info_townships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `info_townships_township_id_foreign` (`township_id`);

--
-- Indexes for table `instant_bookings`
--
ALTER TABLE `instant_bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `integrateds`
--
ALTER TABLE `integrateds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invite_transactions`
--
ALTER TABLE `invite_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `last_minute_reserves`
--
ALTER TABLE `last_minute_reserves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_sender_id_foreign` (`sender_id`);

--
-- Indexes for table `months`
--
ALTER TABLE `months`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position_types`
--
ALTER TABLE `position_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price_days`
--
ALTER TABLE `price_days`
  ADD PRIMARY KEY (`id`),
  ADD KEY `price_days_host_id_foreign` (`host_id`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reserves`
--
ALTER TABLE `reserves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reserves_host_id_foreign` (`host_id`),
  ADD KEY `reservs_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_commons`
--
ALTER TABLE `room_commons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slideshows`
--
ALTER TABLE `slideshows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_users`
--
ALTER TABLE `sms_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `special_dates`
--
ALTER TABLE `special_dates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `special_days`
--
ALTER TABLE `special_days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `townships`
--
ALTER TABLE `townships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `townshipssss`
--
ALTER TABLE `townshipssss`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_activations`
--
ALTER TABLE `user_activations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weeks`
--
ALTER TABLE `weeks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `active_reserves`
--
ALTER TABLE `active_reserves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin_payments`
--
ALTER TABLE `admin_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `blocked_days`
--
ALTER TABLE `blocked_days`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `building_types`
--
ALTER TABLE `building_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `cancel_rules`
--
ALTER TABLE `cancel_rules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_infos`
--
ALTER TABLE `contact_infos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `discount_days`
--
ALTER TABLE `discount_days`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `gallery_integrated`
--
ALTER TABLE `gallery_integrated`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_types`
--
ALTER TABLE `home_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hosts`
--
ALTER TABLE `hosts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `host_possibilities`
--
ALTER TABLE `host_possibilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `host_rules`
--
ALTER TABLE `host_rules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `info_provinces`
--
ALTER TABLE `info_provinces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `info_townships`
--
ALTER TABLE `info_townships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instant_bookings`
--
ALTER TABLE `instant_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `integrateds`
--
ALTER TABLE `integrateds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invite_transactions`
--
ALTER TABLE `invite_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `last_minute_reserves`
--
ALTER TABLE `last_minute_reserves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `months`
--
ALTER TABLE `months`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `position_types`
--
ALTER TABLE `position_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `price_days`
--
ALTER TABLE `price_days`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reserves`
--
ALTER TABLE `reserves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `room_commons`
--
ALTER TABLE `room_commons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rules`
--
ALTER TABLE `rules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `slideshows`
--
ALTER TABLE `slideshows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_users`
--
ALTER TABLE `sms_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `special_dates`
--
ALTER TABLE `special_dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `special_days`
--
ALTER TABLE `special_days`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `townships`
--
ALTER TABLE `townships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=389;

--
-- AUTO_INCREMENT for table `townshipssss`
--
ALTER TABLE `townshipssss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_activations`
--
ALTER TABLE `user_activations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `weeks`
--
ALTER TABLE `weeks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `discount_days`
--
ALTER TABLE `discount_days`
  ADD CONSTRAINT `discount_days_host_id_foreign` FOREIGN KEY (`host_id`) REFERENCES `hosts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_host_id_foreign` FOREIGN KEY (`host_id`) REFERENCES `hosts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `galleries`
--
ALTER TABLE `galleries`
  ADD CONSTRAINT `galleries_host_id_foreign` FOREIGN KEY (`host_id`) REFERENCES `hosts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hosts`
--
ALTER TABLE `hosts`
  ADD CONSTRAINT `hosts_township_id_foreign` FOREIGN KEY (`township_id`) REFERENCES `townships` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `info_provinces`
--
ALTER TABLE `info_provinces`
  ADD CONSTRAINT `info_provinces_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `info_townships`
--
ALTER TABLE `info_townships`
  ADD CONSTRAINT `info_townships_township_id_foreign` FOREIGN KEY (`township_id`) REFERENCES `townships` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `price_days`
--
ALTER TABLE `price_days`
  ADD CONSTRAINT `price_days_host_id_foreign` FOREIGN KEY (`host_id`) REFERENCES `hosts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reserves`
--
ALTER TABLE `reserves`
  ADD CONSTRAINT `reserves_host_id_foreign` FOREIGN KEY (`host_id`) REFERENCES `hosts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
