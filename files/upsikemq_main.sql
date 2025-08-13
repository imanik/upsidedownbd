-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 23, 2021 at 04:35 AM
-- Server version: 10.3.30-MariaDB-log-cll-lve
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `upsikemq_main`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `check_in` time DEFAULT NULL,
  `check_out` time DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `regular_price` int(11) NOT NULL,
  `child_price` int(11) NOT NULL,
  `slot_visitors_count` int(11) NOT NULL DEFAULT 5,
  `status` enum('active','closed','upcoming') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `mobile`, `address`, `regular_price`, `child_price`, `slot_visitors_count`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Dhanmondi', '01615710070', 'House 2/6, Block #C, Lalmatia, Dhaka 1207', 400, 250, 5, 'active', NULL, NULL, NULL),
(2, 'Uttara', '01881288281', 'House 29, 5th Floor, Garib E Newaz Ave Sector 13#, Uttara, Dhaka', 400, 250, 5, 'active', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bundles`
--

CREATE TABLE `bundles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `regular_ticket_count` int(11) NOT NULL DEFAULT 0,
  `child_ticket_count` int(11) NOT NULL DEFAULT 0,
  `normal_price` decimal(11,2) NOT NULL DEFAULT 0.00,
  `offer_price` decimal(11,2) NOT NULL DEFAULT 0.00,
  `status` enum('active','expired') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bundles`
--

INSERT INTO `bundles` (`id`, `title`, `subtitle`, `photo`, `description`, `regular_ticket_count`, `child_ticket_count`, `normal_price`, `offer_price`, `status`, `branch_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Advanced', 'Advanced package for all', NULL, '', 10, 0, 4000.00, 2000.00, 'active', 1, NULL, '2021-08-20 05:59:10', NULL),
(2, 'Starter', 'Starter package for all', NULL, '', 5, 0, 2000.00, 1000.00, 'active', 1, NULL, '2021-08-20 05:59:10', NULL),
(3, 'Advanced', 'Advanced package for all', NULL, '', 10, 0, 4000.00, 2000.00, 'active', 2, NULL, '2021-08-20 05:59:10', NULL),
(4, 'Starter', 'Starter package for all', NULL, '', 5, 0, 2000.00, 1000.00, 'active', 2, NULL, '2021-08-20 05:59:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` int(11) NOT NULL,
  `day` tinyint(4) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `discount`, `day`, `start_date`, `end_date`, `branch_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'c5', 5, NULL, '2021-08-01', '2021-08-31', 1, NULL, NULL, NULL),
(2, 'c10', 10, NULL, '2021-08-01', '2021-08-31', 1, NULL, NULL, NULL),
(3, 'c15', 15, NULL, '2021-08-01', '2021-08-31', 1, NULL, NULL, NULL),
(4, 'c20', 20, NULL, '2021-08-01', '2021-08-31', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','active','suspended','blocked') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Volunteer', NULL, NULL),
(2, 'Photographer', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `designation_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('active','inactive','suspended','archived') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` int(11) NOT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `title`, `cost`, `branch_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'DSLR - 50 photos', 300, 1, NULL, NULL, NULL),
(2, 'DSLR - 100 photos', 500, 1, NULL, NULL, NULL),
(3, 'DSLR - 50 photos', 300, 2, NULL, NULL, NULL),
(4, 'DSLR - 100 photos', 500, 2, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_01_01_000000_create_notifications_table', 1),
(5, '2020_01_01_000000_create_settings_table', 1),
(6, '2020_07_15_000000_create_roles_table', 1),
(7, '2020_07_16_000000_create_branches_table', 1),
(8, '2020_07_18_000000_update_users_table', 1),
(9, '2021_05_03_000000_create_customers_table', 1),
(10, '2021_05_04_000000_create_designations_table', 1),
(11, '2021_05_04_000000_create_employees_table', 1),
(12, '2021_05_04_000005_create_attendances_table', 1),
(13, '2021_05_05_100000_create_slots_table', 1),
(14, '2021_05_05_200000_create_coupons_table', 1),
(15, '2021_05_05_200000_create_facilities_table', 1),
(16, '2021_05_06_000000_create_tickets_table', 1),
(17, '2021_05_06_000002_create_ticket_slots_table', 1),
(18, '2021_05_06_100000_create_ticket_facilities_table', 1),
(19, '2021_05_07_000000_create_refunds_table', 1),
(20, '2021_05_07_000000_create_reschedules_table', 1),
(21, '2021_05_08_000000_create_bundles_table', 1),
(22, '2021_05_08_000000_create_user_bundles_table', 1),
(23, '2021_05_08_100000_create_user_bundle_usages_table', 1),
(24, '2021_05_31_000000_create_payments_table', 1),
(25, '2021_08_10_000000_create_ticket_payments_table', 1),
(26, '2021_08_10_100000_create_user_bundle_payments_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` double DEFAULT NULL,
  `status` enum('Pending','Initiated','Processing','Failed','Complete','Canceled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `tran_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_data` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `amount`, `status`, `tran_id`, `currency`, `post_data`, `created_at`, `updated_at`) VALUES
(1, 1147.5, 'Failed', '61209d1b030a7', 'BDT', '{\"total_amount\":\"1147.50\",\"currency\":\"BDT\",\"tran_id\":\"61209d1b030a7\",\"cus_name\":\"I Manik\",\"cus_email\":\"imanik007@gmail.com\",\"cus_add1\":\"Dhaka\",\"cus_add2\":\"Dhaka\",\"cus_city\":\"Dhaka\",\"cus_state\":\"Dhaka\",\"cus_postcode\":\"1200\",\"cus_country\":\"Bangladesh\",\"cus_phone\":null,\"cus_fax\":\"\",\"ship_name\":\"Store\",\"ship_add1\":\"Dhaka\",\"ship_add2\":\"Dhaka\",\"ship_city\":\"Dhaka\",\"ship_state\":\"Dhaka\",\"ship_postcode\":\"1000\",\"ship_phone\":\"\",\"ship_country\":\"Bangladesh\",\"shipping_method\":\"NO\",\"product_name\":\"Ticket\",\"product_category\":\"Dhanmondi\",\"product_profile\":\"visiting\",\"ticket_id\":1,\"branch_id\":\"1\"}', '2021-08-21 16:28:43', '2021-08-21 16:33:54'),
(2, 1147.5, 'Pending', '61209e5338f27', 'BDT', '{\"total_amount\":\"1147.50\",\"currency\":\"BDT\",\"tran_id\":\"61209e5338f27\",\"cus_name\":\"I Manik\",\"cus_email\":\"imanik007@gmail.com\",\"cus_add1\":\"Dhaka\",\"cus_add2\":\"Dhaka\",\"cus_city\":\"Dhaka\",\"cus_state\":\"Dhaka\",\"cus_postcode\":\"1200\",\"cus_country\":\"Bangladesh\",\"cus_phone\":null,\"cus_fax\":\"\",\"ship_name\":\"Store\",\"ship_add1\":\"Dhaka\",\"ship_add2\":\"Dhaka\",\"ship_city\":\"Dhaka\",\"ship_state\":\"Dhaka\",\"ship_postcode\":\"1000\",\"ship_phone\":\"\",\"ship_country\":\"Bangladesh\",\"shipping_method\":\"NO\",\"product_name\":\"Ticket\",\"product_category\":\"Dhanmondi\",\"product_profile\":\"visiting\",\"ticket_id\":1,\"branch_id\":\"1\"}', '2021-08-21 16:33:55', '2021-08-21 16:33:55'),
(3, 400, 'Initiated', '61209f6cc1be2', 'BDT', '{\"total_amount\":\"400.00\",\"currency\":\"BDT\",\"tran_id\":\"61209f6cc1be2\",\"cus_name\":\"Ashrafi\",\"cus_email\":\"ashrafi.mohiuddin@gmail.com\",\"cus_add1\":\"Dhaka\",\"cus_add2\":\"Dhaka\",\"cus_city\":\"Dhaka\",\"cus_state\":\"Dhaka\",\"cus_postcode\":\"1200\",\"cus_country\":\"Bangladesh\",\"cus_phone\":\"0176097557\",\"cus_fax\":\"\",\"ship_name\":\"Store\",\"ship_add1\":\"Dhaka\",\"ship_add2\":\"Dhaka\",\"ship_city\":\"Dhaka\",\"ship_state\":\"Dhaka\",\"ship_postcode\":\"1000\",\"ship_phone\":\"\",\"ship_country\":\"Bangladesh\",\"shipping_method\":\"NO\",\"product_name\":\"Ticket\",\"product_category\":\"Uttara\",\"product_profile\":\"visiting\",\"ticket_id\":2,\"branch_id\":\"2\"}', '2021-08-21 16:38:36', '2021-08-21 16:38:43'),
(4, 892.5, 'Complete', '6120abfe9a889', 'BDT', '{\"total_amount\":\"892.50\",\"currency\":\"BDT\",\"tran_id\":\"6120abfe9a889\",\"cus_name\":\"Abdullah Al Mahabub\",\"cus_email\":\"akknitbd@gmail.com\",\"cus_add1\":\"Dhaka\",\"cus_add2\":\"Dhaka\",\"cus_city\":\"Dhaka\",\"cus_state\":\"Dhaka\",\"cus_postcode\":\"1200\",\"cus_country\":\"Bangladesh\",\"cus_phone\":\"01977862862\",\"cus_fax\":\"\",\"ship_name\":\"Store\",\"ship_add1\":\"Dhaka\",\"ship_add2\":\"Dhaka\",\"ship_city\":\"Dhaka\",\"ship_state\":\"Dhaka\",\"ship_postcode\":\"1000\",\"ship_phone\":\"\",\"ship_country\":\"Bangladesh\",\"shipping_method\":\"NO\",\"product_name\":\"Ticket\",\"product_category\":\"Dhanmondi\",\"product_profile\":\"visiting\",\"ticket_id\":3,\"branch_id\":\"1\"}', '2021-08-21 17:32:14', '2021-08-21 17:34:44'),
(5, 2040, 'Canceled', '612132d3eff59', 'BDT', '{\"total_amount\":\"2040.00\",\"currency\":\"BDT\",\"tran_id\":\"612132d3eff59\",\"cus_name\":\"Abdullah Al Mahabub\",\"cus_email\":\"akknitbd@gmail.com\",\"cus_add1\":\"Dhaka\",\"cus_add2\":\"Dhaka\",\"cus_city\":\"Dhaka\",\"cus_state\":\"Dhaka\",\"cus_postcode\":\"1200\",\"cus_country\":\"Bangladesh\",\"cus_phone\":\"01977862862\",\"cus_fax\":\"\",\"ship_name\":\"Store\",\"ship_add1\":\"Dhaka\",\"ship_add2\":\"Dhaka\",\"ship_city\":\"Dhaka\",\"ship_state\":\"Dhaka\",\"ship_postcode\":\"1000\",\"ship_phone\":\"\",\"ship_country\":\"Bangladesh\",\"shipping_method\":\"NO\",\"product_name\":\"Ticket\",\"product_category\":\"Dhanmondi\",\"product_profile\":\"visiting\",\"ticket_id\":4,\"branch_id\":\"1\"}', '2021-08-22 03:07:31', '2021-08-22 03:13:11'),
(6, 2040, 'Pending', '61213427a484a', 'BDT', '{\"total_amount\":\"2040.00\",\"currency\":\"BDT\",\"tran_id\":\"61213427a484a\",\"cus_name\":\"Abdullah Al Mahabub\",\"cus_email\":\"akknitbd@gmail.com\",\"cus_add1\":\"Dhaka\",\"cus_add2\":\"Dhaka\",\"cus_city\":\"Dhaka\",\"cus_state\":\"Dhaka\",\"cus_postcode\":\"1200\",\"cus_country\":\"Bangladesh\",\"cus_phone\":\"01977862862\",\"cus_fax\":\"\",\"ship_name\":\"Store\",\"ship_add1\":\"Dhaka\",\"ship_add2\":\"Dhaka\",\"ship_city\":\"Dhaka\",\"ship_state\":\"Dhaka\",\"ship_postcode\":\"1000\",\"ship_phone\":\"\",\"ship_country\":\"Bangladesh\",\"shipping_method\":\"NO\",\"product_name\":\"Ticket\",\"product_category\":\"Dhanmondi\",\"product_profile\":\"visiting\",\"ticket_id\":4,\"branch_id\":\"1\"}', '2021-08-22 03:13:11', '2021-08-22 03:13:11'),
(7, 1100, 'Initiated', '61233209220e2', 'BDT', '{\"total_amount\":\"1100.00\",\"currency\":\"BDT\",\"tran_id\":\"61233209220e2\",\"cus_name\":\"Asif Nazrul\",\"cus_email\":\"asifnazrul@gmail.com\",\"cus_add1\":\"Dhaka\",\"cus_add2\":\"Dhaka\",\"cus_city\":\"Dhaka\",\"cus_state\":\"Dhaka\",\"cus_postcode\":\"1200\",\"cus_country\":\"Bangladesh\",\"cus_phone\":\"01719221144\",\"cus_fax\":\"\",\"ship_name\":\"Store\",\"ship_add1\":\"Dhaka\",\"ship_add2\":\"Dhaka\",\"ship_city\":\"Dhaka\",\"ship_state\":\"Dhaka\",\"ship_postcode\":\"1000\",\"ship_phone\":\"\",\"ship_country\":\"Bangladesh\",\"shipping_method\":\"NO\",\"product_name\":\"Ticket\",\"product_category\":\"Dhanmondi\",\"product_profile\":\"visiting\",\"ticket_id\":5,\"branch_id\":\"1\"}', '2021-08-23 15:28:41', '2021-08-23 15:29:05');

-- --------------------------------------------------------

--
-- Table structure for table `refunds`
--

CREATE TABLE `refunds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','refunded','declined') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `refunded_at` datetime DEFAULT NULL,
  `ticket_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reschedules`
--

CREATE TABLE `reschedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `previous_date` date NOT NULL,
  `change_date` date NOT NULL,
  `previous_slot_id` bigint(20) UNSIGNED NOT NULL,
  `changed_slot_id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `slug`, `name`, `permissions`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 'Admin', '{\"admin\":{\"bundle\":\"on\"},\"manager\":{\"bundle\":\"on\"}}', NULL, '2021-08-21 16:59:58', NULL),
(2, 'manager', 'Manager', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'contact', '+8801615710070', NULL, NULL),
(2, 'email', 'info@upsidedownbd.com', NULL, NULL),
(3, 'address', 'House 2/6, Block #C, Lalmatia, Dhaka 1207', NULL, NULL),
(4, 'facebook_link', 'https://www.facebook.com/upsidedownbd/', NULL, NULL),
(5, 'ticket_validity_in_days', '30', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `slots`
--

CREATE TABLE `slots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('active','closed') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slots`
--

INSERT INTO `slots` (`id`, `name`, `time`, `branch_id`, `status`, `date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'slot# 11:00am', '11:00am', 1, NULL, NULL, NULL, NULL, NULL),
(2, 'slot# 11:15am', '11:15am', 1, NULL, NULL, NULL, NULL, NULL),
(3, 'slot# 11:30am', '11:30am', 1, NULL, NULL, NULL, NULL, NULL),
(4, 'slot# 11:45am', '11:45am', 1, NULL, NULL, NULL, NULL, NULL),
(5, 'slot# 12:00pm', '12:00pm', 1, NULL, NULL, NULL, NULL, NULL),
(6, 'slot# 12:15pm', '12:15pm', 1, NULL, NULL, NULL, NULL, NULL),
(7, 'slot# 12:30pm', '12:30pm', 1, NULL, NULL, NULL, NULL, NULL),
(8, 'slot# 12:45pm', '12:45pm', 1, NULL, NULL, NULL, NULL, NULL),
(9, 'slot# 01:00pm', '01:00pm', 1, NULL, NULL, NULL, NULL, NULL),
(10, 'slot# 01:15pm', '01:15pm', 1, NULL, NULL, NULL, NULL, NULL),
(11, 'slot# 01:30pm', '01:30pm', 1, NULL, NULL, NULL, NULL, NULL),
(12, 'slot# 01:45pm', '01:45pm', 1, NULL, NULL, NULL, NULL, NULL),
(13, 'slot# 02:00pm', '02:00pm', 1, NULL, NULL, NULL, NULL, NULL),
(14, 'slot# 02:15pm', '02:15pm', 1, NULL, NULL, NULL, NULL, NULL),
(15, 'slot# 02:30pm', '02:30pm', 1, NULL, NULL, NULL, NULL, NULL),
(16, 'slot# 02:45pm', '02:45pm', 1, NULL, NULL, NULL, NULL, NULL),
(17, 'slot# 03:00pm', '03:00pm', 1, NULL, NULL, NULL, NULL, NULL),
(18, 'slot# 03:15pm', '03:15pm', 1, NULL, NULL, NULL, NULL, NULL),
(19, 'slot# 03:30pm', '03:30pm', 1, NULL, NULL, NULL, NULL, NULL),
(20, 'slot# 03:45pm', '03:45pm', 1, NULL, NULL, NULL, NULL, NULL),
(21, 'slot# 04:00pm', '04:00pm', 1, NULL, NULL, NULL, NULL, NULL),
(22, 'slot# 04:15pm', '04:15pm', 1, NULL, NULL, NULL, NULL, NULL),
(23, 'slot# 04:30pm', '04:30pm', 1, NULL, NULL, NULL, NULL, NULL),
(24, 'slot# 04:45pm', '04:45pm', 1, NULL, NULL, NULL, NULL, NULL),
(25, 'slot# 05:00pm', '05:00pm', 1, NULL, NULL, NULL, NULL, NULL),
(26, 'slot# 05:15pm', '05:15pm', 1, NULL, NULL, NULL, NULL, NULL),
(27, 'slot# 05:30pm', '05:30pm', 1, NULL, NULL, NULL, NULL, NULL),
(28, 'slot# 05:45pm', '05:45pm', 1, NULL, NULL, NULL, NULL, NULL),
(29, 'slot# 06:00pm', '06:00pm', 1, NULL, NULL, NULL, NULL, NULL),
(30, 'slot# 06:15pm', '06:15pm', 1, NULL, NULL, NULL, NULL, NULL),
(31, 'slot# 06:30pm', '06:30pm', 1, NULL, NULL, NULL, NULL, NULL),
(32, 'slot# 06:45pm', '06:45pm', 1, NULL, NULL, NULL, NULL, NULL),
(33, 'slot# 07:00pm', '07:00pm', 1, NULL, NULL, NULL, NULL, NULL),
(34, 'slot# 07:15pm', '07:15pm', 1, NULL, NULL, NULL, NULL, NULL),
(35, 'slot# 07:30pm', '07:30pm', 1, NULL, NULL, NULL, NULL, NULL),
(36, 'slot# 07:45pm', '07:45pm', 1, NULL, NULL, NULL, NULL, NULL),
(37, 'slot# 08:00pm', '08:00pm', 1, NULL, NULL, NULL, NULL, NULL),
(38, 'slot# 08:15pm', '08:15pm', 1, NULL, NULL, NULL, NULL, NULL),
(39, 'slot# 08:30pm', '08:30pm', 1, NULL, NULL, NULL, NULL, NULL),
(40, 'slot# 08:45pm', '08:45pm', 1, NULL, NULL, NULL, NULL, NULL),
(41, 'slot# 09:00pm', '09:00pm', 1, NULL, NULL, NULL, NULL, NULL),
(42, 'slot# 09:15pm', '09:15pm', 1, NULL, NULL, NULL, NULL, NULL),
(43, 'slot# 09:30pm', '09:30pm', 1, NULL, NULL, NULL, NULL, NULL),
(44, 'slot# 09:45pm', '09:45pm', 1, NULL, NULL, NULL, NULL, NULL),
(45, 'slot# 12:00pm', '12:00pm', 2, NULL, NULL, NULL, NULL, NULL),
(46, 'slot# 12:15pm', '12:15pm', 2, NULL, NULL, NULL, NULL, NULL),
(47, 'slot# 12:30pm', '12:30pm', 2, NULL, NULL, NULL, NULL, NULL),
(48, 'slot# 12:45pm', '12:45pm', 2, NULL, NULL, NULL, NULL, NULL),
(49, 'slot# 01:00pm', '01:00pm', 2, NULL, NULL, NULL, NULL, NULL),
(50, 'slot# 01:15pm', '01:15pm', 2, NULL, NULL, NULL, NULL, NULL),
(51, 'slot# 01:30pm', '01:30pm', 2, NULL, NULL, NULL, NULL, NULL),
(52, 'slot# 01:45pm', '01:45pm', 2, NULL, NULL, NULL, NULL, NULL),
(53, 'slot# 02:00pm', '02:00pm', 2, NULL, NULL, NULL, NULL, NULL),
(54, 'slot# 02:15pm', '02:15pm', 2, NULL, NULL, NULL, NULL, NULL),
(55, 'slot# 02:30pm', '02:30pm', 2, NULL, NULL, NULL, NULL, NULL),
(56, 'slot# 02:45pm', '02:45pm', 2, NULL, NULL, NULL, NULL, NULL),
(57, 'slot# 03:00pm', '03:00pm', 2, NULL, NULL, NULL, NULL, NULL),
(58, 'slot# 03:15pm', '03:15pm', 2, NULL, NULL, NULL, NULL, NULL),
(59, 'slot# 03:30pm', '03:30pm', 2, NULL, NULL, NULL, NULL, NULL),
(60, 'slot# 03:45pm', '03:45pm', 2, NULL, NULL, NULL, NULL, NULL),
(61, 'slot# 04:00pm', '04:00pm', 2, NULL, NULL, NULL, NULL, NULL),
(62, 'slot# 04:15pm', '04:15pm', 2, NULL, NULL, NULL, NULL, NULL),
(63, 'slot# 04:30pm', '04:30pm', 2, NULL, NULL, NULL, NULL, NULL),
(64, 'slot# 04:45pm', '04:45pm', 2, NULL, NULL, NULL, NULL, NULL),
(65, 'slot# 05:00pm', '05:00pm', 2, NULL, NULL, NULL, NULL, NULL),
(66, 'slot# 05:15pm', '05:15pm', 2, NULL, NULL, NULL, NULL, NULL),
(67, 'slot# 05:30pm', '05:30pm', 2, NULL, NULL, NULL, NULL, NULL),
(68, 'slot# 05:45pm', '05:45pm', 2, NULL, NULL, NULL, NULL, NULL),
(69, 'slot# 06:00pm', '06:00pm', 2, NULL, NULL, NULL, NULL, NULL),
(70, 'slot# 06:15pm', '06:15pm', 2, NULL, NULL, NULL, NULL, NULL),
(71, 'slot# 06:30pm', '06:30pm', 2, NULL, NULL, NULL, NULL, NULL),
(72, 'slot# 06:45pm', '06:45pm', 2, NULL, NULL, NULL, NULL, NULL),
(73, 'slot# 07:00pm', '07:00pm', 2, NULL, NULL, NULL, NULL, NULL),
(74, 'slot# 07:15pm', '07:15pm', 2, NULL, NULL, NULL, NULL, NULL),
(75, 'slot# 07:30pm', '07:30pm', 2, NULL, NULL, NULL, NULL, NULL),
(76, 'slot# 07:45pm', '07:45pm', 2, NULL, NULL, NULL, NULL, NULL),
(77, 'slot# 08:00pm', '08:00pm', 2, NULL, NULL, NULL, NULL, NULL),
(78, 'slot# 08:15pm', '08:15pm', 2, NULL, NULL, NULL, NULL, NULL),
(79, 'slot# 08:30pm', '08:30pm', 2, NULL, NULL, NULL, NULL, NULL),
(80, 'slot# 08:45pm', '08:45pm', 2, NULL, NULL, NULL, NULL, NULL),
(81, 'slot# 09:00pm', '09:00pm', 2, NULL, NULL, NULL, NULL, NULL),
(82, 'slot# 09:15pm', '09:15pm', 2, NULL, NULL, NULL, NULL, NULL),
(83, 'slot# 09:30pm', '09:30pm', 2, NULL, NULL, NULL, NULL, NULL),
(84, 'slot# 09:45pm', '09:45pm', 2, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `regular_ticket_count` int(11) DEFAULT NULL,
  `child_ticket_count` int(11) DEFAULT NULL,
  `regular_ticket_price` int(11) DEFAULT NULL,
  `child_ticket_price` int(11) DEFAULT NULL,
  `sub_total` decimal(11,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(11,2) NOT NULL DEFAULT 0.00,
  `total` decimal(11,2) NOT NULL DEFAULT 0.00,
  `vat` decimal(11,2) NOT NULL DEFAULT 0.00,
  `grand_total` decimal(11,2) NOT NULL DEFAULT 0.00,
  `status` enum('visited','not-visited') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not-visited',
  `photos_link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slot_id` bigint(20) UNSIGNED NOT NULL,
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `volunteer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `facility_id` bigint(20) UNSIGNED DEFAULT NULL,
  `facility_provider_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `visited_at` timestamp NULL DEFAULT NULL,
  `payment_status` enum('unpaid','partial','paid','refunded') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `reference`, `regular_ticket_count`, `child_ticket_count`, `regular_ticket_price`, `child_ticket_price`, `sub_total`, `discount`, `total`, `vat`, `grand_total`, `status`, `photos_link`, `slot_id`, `coupon_id`, `customer_id`, `volunteer_id`, `facility_id`, `facility_provider_id`, `branch_id`, `date`, `visited_at`, `payment_status`, `created_at`, `updated_at`) VALUES
(3, '210821133214', 2, 1, 400, 250, 1050.00, 15.00, 892.50, 0.00, 892.50, 'not-visited', NULL, 1, 3, 5, NULL, NULL, NULL, 1, '2021-08-25 04:00:00', NULL, 'paid', '2021-08-21 17:32:14', '2021-08-21 17:34:44'),
(5, '6123320726f05', 2, NULL, 400, 250, 1100.00, 0.00, 1100.00, 0.00, 1100.00, 'not-visited', NULL, 15, NULL, 6, NULL, 1, NULL, 1, '2021-08-27 04:00:00', NULL, 'unpaid', '2021-08-23 15:28:39', '2021-08-23 15:28:39');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_facilities`
--

CREATE TABLE `ticket_facilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `publishable` tinyint(1) NOT NULL DEFAULT 0,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facility_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ticket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_payments`
--

CREATE TABLE `ticket_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_payments`
--

INSERT INTO `ticket_payments` (`id`, `ticket_id`, `payment_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2021-08-21 16:28:43', '2021-08-21 16:28:43'),
(2, 1, 2, '2021-08-21 16:33:55', '2021-08-21 16:33:55'),
(3, 2, 3, '2021-08-21 16:38:36', '2021-08-21 16:38:36'),
(4, 3, 4, '2021-08-21 17:32:14', '2021-08-21 17:32:14'),
(5, 4, 5, '2021-08-22 03:07:31', '2021-08-22 03:07:31'),
(6, 4, 6, '2021-08-22 03:13:11', '2021-08-22 03:13:11'),
(7, 5, 7, '2021-08-23 15:28:41', '2021-08-23 15:28:41');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_slots`
--

CREATE TABLE `ticket_slots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('free','booked') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'free',
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `slot_id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_slots`
--

INSERT INTO `ticket_slots` (`id`, `status`, `branch_id`, `slot_id`, `ticket_id`, `date`, `created_at`, `updated_at`) VALUES
(1, 'free', 1, 1, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(2, 'free', 1, 2, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(3, 'free', 1, 3, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(4, 'free', 1, 4, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(5, 'free', 1, 5, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(6, 'free', 1, 6, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(7, 'free', 1, 7, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(8, 'free', 1, 8, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(9, 'free', 1, 9, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(10, 'free', 1, 10, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(11, 'free', 1, 11, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(12, 'free', 1, 12, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(13, 'free', 1, 13, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(14, 'free', 1, 14, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(15, 'free', 1, 15, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(16, 'free', 1, 16, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(17, 'free', 1, 17, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(18, 'free', 1, 18, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(19, 'free', 1, 19, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(20, 'free', 1, 20, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(21, 'free', 1, 21, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(22, 'free', 1, 22, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-22 17:00:46'),
(23, 'free', 1, 23, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(24, 'free', 1, 24, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(25, 'free', 1, 25, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(26, 'free', 1, 26, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(27, 'free', 1, 27, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(28, 'free', 1, 28, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(29, 'free', 1, 29, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(30, 'free', 1, 30, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(31, 'free', 1, 31, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(32, 'free', 1, 32, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(33, 'free', 1, 33, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(34, 'free', 1, 34, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(35, 'free', 1, 35, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(36, 'free', 1, 36, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(37, 'free', 1, 37, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(38, 'free', 1, 38, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(39, 'free', 1, 39, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(40, 'free', 1, 40, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(41, 'free', 1, 41, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(42, 'free', 1, 42, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(43, 'free', 1, 43, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(44, 'free', 1, 44, NULL, '2021-08-24', '2021-08-21 16:27:44', '2021-08-21 16:27:44'),
(45, 'free', 2, 45, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(46, 'free', 2, 46, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(47, 'free', 2, 47, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(48, 'free', 2, 48, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(49, 'free', 2, 49, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(50, 'free', 2, 50, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(51, 'free', 2, 51, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(52, 'free', 2, 52, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(53, 'free', 2, 53, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(54, 'free', 2, 54, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(55, 'free', 2, 55, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(56, 'free', 2, 56, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(57, 'free', 2, 57, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(58, 'free', 2, 58, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(59, 'free', 2, 59, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(60, 'free', 2, 60, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(61, 'free', 2, 61, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(62, 'free', 2, 62, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(63, 'free', 2, 63, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(64, 'free', 2, 64, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(65, 'free', 2, 65, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(66, 'free', 2, 66, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(67, 'free', 2, 67, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(68, 'free', 2, 68, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(69, 'free', 2, 69, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(70, 'free', 2, 70, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(71, 'free', 2, 71, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(72, 'free', 2, 72, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(73, 'free', 2, 73, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(74, 'free', 2, 74, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(75, 'free', 2, 75, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(76, 'free', 2, 76, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(77, 'free', 2, 77, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(78, 'free', 2, 78, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(79, 'free', 2, 79, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(80, 'free', 2, 80, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(81, 'free', 2, 81, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(82, 'free', 2, 82, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(83, 'free', 2, 83, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(84, 'free', 2, 84, NULL, '2021-08-31', '2021-08-21 16:36:59', '2021-08-21 16:36:59'),
(85, 'free', 2, 45, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(86, 'free', 2, 46, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(87, 'free', 2, 47, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(88, 'free', 2, 48, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(89, 'free', 2, 49, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(90, 'free', 2, 50, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(91, 'free', 2, 51, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(92, 'free', 2, 52, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(93, 'free', 2, 53, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(94, 'free', 2, 54, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(95, 'free', 2, 55, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(96, 'free', 2, 56, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(97, 'free', 2, 57, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(98, 'free', 2, 58, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(99, 'free', 2, 59, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(100, 'free', 2, 60, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(101, 'free', 2, 61, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(102, 'free', 2, 62, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(103, 'free', 2, 63, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(104, 'free', 2, 64, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(105, 'free', 2, 65, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(106, 'free', 2, 66, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(107, 'free', 2, 67, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(108, 'free', 2, 68, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(109, 'free', 2, 69, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(110, 'free', 2, 70, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(111, 'free', 2, 71, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(112, 'free', 2, 72, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(113, 'free', 2, 73, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(114, 'free', 2, 74, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(115, 'free', 2, 75, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(116, 'free', 2, 76, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(117, 'free', 2, 77, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(118, 'free', 2, 78, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(119, 'free', 2, 79, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(120, 'free', 2, 80, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(121, 'free', 2, 81, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(122, 'free', 2, 82, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(123, 'free', 2, 83, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(124, 'free', 2, 84, NULL, '2021-08-24', '2021-08-21 17:28:59', '2021-08-21 17:28:59'),
(125, 'booked', 1, 1, 3, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:32:14'),
(126, 'free', 1, 2, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(127, 'free', 1, 3, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(128, 'free', 1, 4, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(129, 'free', 1, 5, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(130, 'free', 1, 6, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(131, 'free', 1, 7, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(132, 'free', 1, 8, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(133, 'free', 1, 9, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(134, 'free', 1, 10, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(135, 'free', 1, 11, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(136, 'free', 1, 12, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(137, 'free', 1, 13, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(138, 'free', 1, 14, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(139, 'free', 1, 15, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(140, 'free', 1, 16, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(141, 'free', 1, 17, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(142, 'free', 1, 18, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(143, 'free', 1, 19, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(144, 'free', 1, 20, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(145, 'free', 1, 21, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(146, 'free', 1, 22, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(147, 'free', 1, 23, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(148, 'free', 1, 24, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(149, 'free', 1, 25, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(150, 'free', 1, 26, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(151, 'free', 1, 27, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(152, 'free', 1, 28, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(153, 'free', 1, 29, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(154, 'free', 1, 30, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(155, 'free', 1, 31, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(156, 'free', 1, 32, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(157, 'free', 1, 33, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(158, 'free', 1, 34, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(159, 'free', 1, 35, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(160, 'free', 1, 36, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(161, 'free', 1, 37, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(162, 'free', 1, 38, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(163, 'free', 1, 39, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(164, 'free', 1, 40, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(165, 'free', 1, 41, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(166, 'free', 1, 42, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(167, 'free', 1, 43, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(168, 'free', 1, 44, NULL, '2021-08-25', '2021-08-21 17:31:09', '2021-08-21 17:31:09'),
(169, 'free', 1, 1, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(170, 'free', 1, 2, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(171, 'free', 1, 3, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(172, 'free', 1, 4, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(173, 'free', 1, 5, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(174, 'free', 1, 6, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(175, 'free', 1, 7, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(176, 'free', 1, 8, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(177, 'free', 1, 9, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(178, 'free', 1, 10, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(179, 'free', 1, 11, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(180, 'free', 1, 12, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(181, 'free', 1, 13, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(182, 'free', 1, 14, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(183, 'free', 1, 15, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(184, 'free', 1, 16, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(185, 'free', 1, 17, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(186, 'free', 1, 18, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(187, 'free', 1, 19, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(188, 'free', 1, 20, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(189, 'free', 1, 21, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(190, 'free', 1, 22, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(191, 'free', 1, 23, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(192, 'free', 1, 24, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(193, 'free', 1, 25, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(194, 'free', 1, 26, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(195, 'free', 1, 27, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(196, 'free', 1, 28, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(197, 'free', 1, 29, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(198, 'free', 1, 30, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(199, 'free', 1, 31, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(200, 'free', 1, 32, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-23 04:00:20'),
(201, 'free', 1, 33, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(202, 'free', 1, 34, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(203, 'free', 1, 35, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(204, 'free', 1, 36, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(205, 'free', 1, 37, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(206, 'free', 1, 38, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(207, 'free', 1, 39, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(208, 'free', 1, 40, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(209, 'free', 1, 41, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(210, 'free', 1, 42, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(211, 'free', 1, 43, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(212, 'free', 1, 44, NULL, '2021-08-26', '2021-08-22 03:06:22', '2021-08-22 03:06:22'),
(213, 'free', 1, 1, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(214, 'free', 1, 2, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(215, 'free', 1, 3, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(216, 'free', 1, 4, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(217, 'free', 1, 5, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(218, 'free', 1, 6, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(219, 'free', 1, 7, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(220, 'free', 1, 8, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(221, 'free', 1, 9, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(222, 'free', 1, 10, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(223, 'free', 1, 11, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(224, 'free', 1, 12, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(225, 'free', 1, 13, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(226, 'free', 1, 14, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(227, 'free', 1, 15, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(228, 'free', 1, 16, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(229, 'free', 1, 17, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(230, 'free', 1, 18, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(231, 'free', 1, 19, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(232, 'free', 1, 20, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(233, 'free', 1, 21, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(234, 'free', 1, 22, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(235, 'free', 1, 23, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(236, 'free', 1, 24, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(237, 'free', 1, 25, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(238, 'free', 1, 26, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(239, 'free', 1, 27, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(240, 'free', 1, 28, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(241, 'free', 1, 29, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(242, 'free', 1, 30, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(243, 'free', 1, 31, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(244, 'free', 1, 32, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(245, 'free', 1, 33, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(246, 'free', 1, 34, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(247, 'free', 1, 35, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(248, 'free', 1, 36, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(249, 'free', 1, 37, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(250, 'free', 1, 38, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(251, 'free', 1, 39, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(252, 'free', 1, 40, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(253, 'free', 1, 41, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(254, 'free', 1, 42, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(255, 'free', 1, 43, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22'),
(256, 'free', 1, 44, NULL, '2021-08-27', '2021-08-23 15:27:22', '2021-08-23 15:27:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','active','suspended','blocked') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `slug`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `mobile`, `address`, `photo`, `status`, `is_admin`, `branch_id`, `role_id`, `deleted_at`) VALUES
(1, NULL, 'Im Anik', 'imanik007@gmail.com', NULL, '$2y$10$FOcrmIlcKVzSu044KzQfN.pl2B.RIvptDF8Crr2VfJtXVIAviv8ZC', NULL, NULL, NULL, NULL, NULL, NULL, 'active', 1, NULL, NULL, NULL),
(2, NULL, 'USBD Dhanmondi Admin', 'usbd@gmail.com', NULL, '$2y$10$.UA4kcVHfH/qNOpUxWOPO.dIrN0Wvbw1GUfG36jpwxAMugEDrcEQy', NULL, NULL, NULL, NULL, NULL, NULL, 'active', 0, 1, 1, NULL),
(3, NULL, 'USBD Uttara Admin', 'usbd.u@gmail.com', NULL, '$2y$10$3FLF/nQcsp8dk9HUzV3fh.gBynQL6mmhxd6wXiPQhmm0sqYf/rxli', NULL, NULL, NULL, NULL, NULL, NULL, 'active', 0, 2, 1, NULL),
(4, NULL, 'Ashrafi', 'ashrafi.mohiuddin@gmail.com', NULL, '$2y$10$oGDfXuIPd8ZZYk6GfbLIjeSzDKur7tMbz/5LoAA5ke6nOMQF8Fr1e', NULL, '2021-08-21 16:38:30', '2021-08-21 16:38:30', '0176097557', 'Khilgaon', NULL, 'active', 0, NULL, NULL, NULL),
(5, NULL, 'Abdullah Al Mahabub', 'akknitbd@gmail.com', NULL, '$2y$10$1ExwkwsT6sdEUVi.2hyPpusgL0ehtjHN.DLRsqyM80oFhUhbMfu4y', NULL, '2021-08-21 17:32:07', '2021-08-21 17:32:07', '01977862862', 'House:36, Flat:7A, Road:3, Dhanmondi -1205 (Lake Side Masjid Building)', NULL, 'active', 0, NULL, NULL, NULL),
(6, NULL, 'Asif Nazrul', 'asifnazrul@gmail.com', NULL, '$2y$10$W.xOdKANH8Il6RamD9PAeeXEV6C.UkfNtVEniIDkPMkUQ.J7WAzji', NULL, '2021-08-23 15:28:33', '2021-08-23 15:28:33', '01719221144', '11 Dilkusha,Dhaka-1000', NULL, 'active', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_bundles`
--

CREATE TABLE `user_bundles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `regular_ticket_count` int(11) DEFAULT NULL,
  `child_ticket_count` int(11) DEFAULT NULL,
  `payment_status` enum('unpaid','partial','paid','refunded') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bundle_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_bundle_payments`
--

CREATE TABLE `user_bundle_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_bundle_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_bundle_usages`
--

CREATE TABLE `user_bundle_usages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `regular_ticket_count` int(11) DEFAULT NULL,
  `child_ticket_count` int(11) DEFAULT NULL,
  `ticket_id` bigint(20) UNSIGNED NOT NULL,
  `bundle_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendances_branch_id_foreign` (`branch_id`),
  ADD KEY `attendances_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bundles`
--
ALTER TABLE `bundles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bundles_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupons_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_branch_id_foreign` (`branch_id`),
  ADD KEY `employees_designation_id_foreign` (`designation_id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facilities_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `refunds`
--
ALTER TABLE `refunds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refunds_ticket_id_foreign` (`ticket_id`);

--
-- Indexes for table `reschedules`
--
ALTER TABLE `reschedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reschedules_previous_slot_id_foreign` (`previous_slot_id`),
  ADD KEY `reschedules_changed_slot_id_foreign` (`changed_slot_id`),
  ADD KEY `reschedules_ticket_id_foreign` (`ticket_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slots`
--
ALTER TABLE `slots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slots_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tickets_reference_unique` (`reference`),
  ADD KEY `tickets_slot_id_foreign` (`slot_id`),
  ADD KEY `tickets_coupon_id_foreign` (`coupon_id`),
  ADD KEY `tickets_customer_id_foreign` (`customer_id`),
  ADD KEY `tickets_volunteer_id_foreign` (`volunteer_id`),
  ADD KEY `tickets_facility_id_foreign` (`facility_id`),
  ADD KEY `tickets_facility_provider_id_foreign` (`facility_provider_id`),
  ADD KEY `tickets_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `ticket_facilities`
--
ALTER TABLE `ticket_facilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_facilities_facility_id_foreign` (`facility_id`),
  ADD KEY `ticket_facilities_ticket_id_foreign` (`ticket_id`);

--
-- Indexes for table `ticket_payments`
--
ALTER TABLE `ticket_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_payments_ticket_id_foreign` (`ticket_id`),
  ADD KEY `ticket_payments_payment_id_foreign` (`payment_id`);

--
-- Indexes for table `ticket_slots`
--
ALTER TABLE `ticket_slots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_slots_branch_id_foreign` (`branch_id`),
  ADD KEY `ticket_slots_slot_id_foreign` (`slot_id`),
  ADD KEY `ticket_slots_ticket_id_foreign` (`ticket_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_branch_id_foreign` (`branch_id`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_bundles`
--
ALTER TABLE `user_bundles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_bundles_customer_id_foreign` (`customer_id`),
  ADD KEY `user_bundles_bundle_id_foreign` (`bundle_id`);

--
-- Indexes for table `user_bundle_payments`
--
ALTER TABLE `user_bundle_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_bundle_payments_user_bundle_id_foreign` (`user_bundle_id`),
  ADD KEY `user_bundle_payments_payment_id_foreign` (`payment_id`);

--
-- Indexes for table `user_bundle_usages`
--
ALTER TABLE `user_bundle_usages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_bundle_usages_ticket_id_foreign` (`ticket_id`),
  ADD KEY `user_bundle_usages_bundle_id_foreign` (`bundle_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bundles`
--
ALTER TABLE `bundles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `refunds`
--
ALTER TABLE `refunds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reschedules`
--
ALTER TABLE `reschedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `slots`
--
ALTER TABLE `slots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ticket_facilities`
--
ALTER TABLE `ticket_facilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket_payments`
--
ALTER TABLE `ticket_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ticket_slots`
--
ALTER TABLE `ticket_slots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=257;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_bundles`
--
ALTER TABLE `user_bundles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_bundle_payments`
--
ALTER TABLE `user_bundle_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_bundle_usages`
--
ALTER TABLE `user_bundle_usages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
