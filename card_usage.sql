-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2022 at 04:44 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `card_usage`
--

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` bigint(10) UNSIGNED NOT NULL,
  `bank_name` varchar(256) NOT NULL,
  `bank_logo` varchar(256) DEFAULT NULL,
  `bank_hotline` varchar(256) DEFAULT NULL,
  `shortcut_speak` varchar(256) DEFAULT NULL,
  `redeem_web` varchar(256) DEFAULT NULL,
  `min_age` varchar(256) DEFAULT NULL,
  `min_age_sub` varchar(256) DEFAULT NULL,
  `point_value_rm` varchar(256) DEFAULT NULL,
  `point_name` varchar(256) DEFAULT NULL,
  `point_rebate_percentage` varchar(256) DEFAULT NULL,
  `late_charge_fee` varchar(256) DEFAULT NULL,
  `interest_rate` varchar(256) DEFAULT NULL,
  `cash_out_interest` varchar(256) DEFAULT NULL,
  `cash_out_first_charge` varchar(256) DEFAULT NULL,
  `hotline_time` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`hotline_time`)),
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `bank_name`, `bank_logo`, `bank_hotline`, `shortcut_speak`, `redeem_web`, `min_age`, `min_age_sub`, `point_value_rm`, `point_name`, `point_rebate_percentage`, `late_charge_fee`, `interest_rate`, `cash_out_interest`, `cash_out_first_charge`, `hotline_time`, `created_at`, `updated_at`) VALUES
(1, 'Public Bank', 'assets/images/banks/new-author-img.svg', '+6 03-26128121', '1-0-2-0', 'https://www.google123.com/', '21', '18', '0.25', NULL, '0.002', '10', '18', '20', '200', '{\"monday\":{\"start_time\":\"09:00\",\"end_time\":\"21:00\"},\"tuesday\":{\"start_time\":\"\",\"end_time\":\"\"},\"wednesday\":{\"start_time\":\"\",\"end_time\":\"\"},\"thursday\":{\"start_time\":\"\",\"end_time\":\"\"},\"friday\":{\"start_time\":\"\",\"end_time\":\"\"},\"saturday\":{\"start_time\":\"\",\"end_time\":\"\"},\"sunday\":{\"start_time\":\"\",\"end_time\":\"\"}}', '2021-10-05 18:45:48', '2021-10-19 16:40:23'),
(2, 'Maybank', 'assets/images/banks/new-author-img.svg', '+6 13-00886688', '1-4-0', 'www.yahoo.com', '21', '18', '0.25', NULL, '0.125', '15', '15', '18', '300', '{\"monday\":{\"start_time\":\"08:30 AM\",\"end_time\":\"09:00 PM\"},\"tuesday\":{\"start_time\":\"08:30 AM\",\"end_time\":\"09:00 PM\"},\"wednesday\":{\"start_time\":\"08:30 AM\",\"end_time\":\"09:00 PM\"},\"thursday\":{\"start_time\":\"08:30 AM\",\"end_time\":\"09:00 PM\"},\"friday\":{\"start_time\":\"08:30 AM\",\"end_time\":\"09:00 PM\"},\"saturday\":{\"start_time\":\"08:30 AM\",\"end_time\":\"09:00 PM\"},\"sunday\":{\"start_time\":\"\",\"end_time\":\"\"}}', '2021-10-05 18:45:48', '2021-10-05 18:45:48'),
(4, 'United Overseas Bank', 'assets/images/banks/new-author-img.svg', '+6 13-00886688', '1-4-0', 'www.yahoo.com', '21', '18', '0.25', NULL, '0.125', '15', '15', '18', '300', '{\"monday\":{\"start_time\":\"08:30 AM\",\"end_time\":\"09:00 PM\"},\"tuesday\":{\"start_time\":\"08:30 AM\",\"end_time\":\"09:00 PM\"},\"wednesday\":{\"start_time\":\"08:30 AM\",\"end_time\":\"09:00 PM\"},\"thursday\":{\"start_time\":\"08:30 AM\",\"end_time\":\"09:00 PM\"},\"friday\":{\"start_time\":\"08:30 AM\",\"end_time\":\"09:00 PM\"},\"saturday\":{\"start_time\":\"08:30 AM\",\"end_time\":\"09:00 PM\"},\"sunday\":{\"start_time\":\"\",\"end_time\":\"\"}}', '2021-10-05 18:45:48', '2021-10-05 18:45:48'),
(5, 'Citibank', 'assets/images/banks/new-author-img.svg', '+6 13-00886688', '1-4-0', 'www.yahoo.com', '21', '18', '0.25', NULL, '0.125', '15', '15', '18', '300', '{\"monday\":{\"start_time\":\"08:30 AM\",\"end_time\":\"09:00 PM\"},\"tuesday\":{\"start_time\":\"08:30 AM\",\"end_time\":\"09:00 PM\"},\"wednesday\":{\"start_time\":\"08:30 AM\",\"end_time\":\"09:00 PM\"},\"thursday\":{\"start_time\":\"08:30 AM\",\"end_time\":\"09:00 PM\"},\"friday\":{\"start_time\":\"08:30 AM\",\"end_time\":\"09:00 PM\"},\"saturday\":{\"start_time\":\"08:30 AM\",\"end_time\":\"09:00 PM\"},\"sunday\":{\"start_time\":\"\",\"end_time\":\"\"}}', '2021-10-05 18:45:48', '2021-10-05 18:45:48'),
(6, 'HSBC Bank', 'assets/images/banks/new-author-img.svg', '+6 13-00886687', '1-4-0', 'www.yahoo.com', '22', '19', '0.25', NULL, '0.125', '15', '15', '18', '300', '{\"monday\":{\"start_time\":\"09:45\",\"end_time\":\"21:45\"},\"tuesday\":{\"start_time\":\"\",\"end_time\":\"\"},\"wednesday\":{\"start_time\":\"\",\"end_time\":\"\"},\"thursday\":{\"start_time\":\"\",\"end_time\":\"\"},\"friday\":{\"start_time\":\"\",\"end_time\":\"\"},\"saturday\":{\"start_time\":\"\",\"end_time\":\"\"},\"sunday\":{\"start_time\":\"\",\"end_time\":\"\"}}', '2021-10-05 18:45:48', '2022-03-09 16:16:14');

-- --------------------------------------------------------

--
-- Table structure for table `bank_admins`
--

CREATE TABLE `bank_admins` (
  `id` bigint(10) UNSIGNED NOT NULL,
  `bank_id` bigint(10) UNSIGNED NOT NULL,
  `user_id` bigint(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank_admins`
--

INSERT INTO `bank_admins` (`id`, `bank_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2021-10-17 14:44:49', '2021-10-17 14:44:49'),
(2, 4, 3, '2022-03-09 17:10:22', '2022-03-09 17:10:22'),
(3, 2, 4, '2022-03-09 17:12:09', '2022-03-09 17:12:09'),
(4, 5, 5, '2022-03-09 17:13:54', '2022-03-09 17:13:54'),
(5, 6, 6, '2022-03-09 17:15:04', '2022-03-09 17:15:04');

-- --------------------------------------------------------

--
-- Table structure for table `benefits`
--

CREATE TABLE `benefits` (
  `id` bigint(10) UNSIGNED NOT NULL,
  `card_id` bigint(10) UNSIGNED NOT NULL,
  `merchant_id` bigint(10) UNSIGNED NOT NULL,
  `merchant_benefit_description` text DEFAULT NULL,
  `benefit_day_mon` tinyint(1) NOT NULL DEFAULT 0,
  `benefit_day_tue` tinyint(1) NOT NULL DEFAULT 0,
  `benefit_day_wed` tinyint(1) NOT NULL DEFAULT 0,
  `benefit_day_thu` tinyint(1) NOT NULL DEFAULT 0,
  `benefit_day_fri` tinyint(1) NOT NULL DEFAULT 0,
  `benefit_day_sat` tinyint(1) NOT NULL DEFAULT 0,
  `benefit_day_sun` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `benefits`
--

INSERT INTO `benefits` (`id`, `card_id`, `merchant_id`, `merchant_benefit_description`, `benefit_day_mon`, `benefit_day_tue`, `benefit_day_wed`, `benefit_day_thu`, `benefit_day_fri`, `benefit_day_sat`, `benefit_day_sun`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '<p>Description of merchant write here. Description of merchant write here.Description of merchant write here. can insert take like this. <strong style=\"color: rgb(102, 185, 102);\">15%</strong></p>', 1, 0, 0, 1, 0, 0, 1, '2021-08-28 08:24:36', '2021-08-28 08:24:36'),
(2, 1, 5, '<p>Description of merchant write here. Description of merchant write here.Description of merchant write here. can insert take like this. <strong style=\"color: rgb(102, 185, 102);\">15%</strong></p>', 1, 1, 1, 1, 1, 1, 1, '2021-08-28 08:25:20', '2021-08-28 08:25:20'),
(3, 1, 9, '<p>Description of merchant write here. Description of merchant write here.Description of merchant write here. can insert take like this. <strong style=\"color: rgb(102, 185, 102);\">15%</strong></p>', 0, 0, 1, 0, 0, 0, 0, '2021-08-28 08:25:20', '2021-08-28 08:25:20'),
(4, 1, 10, '<p>Description of merchant write here. Description of merchant write here.Description of merchant write here. can insert take like this. <strong style=\"color: rgb(102, 185, 102);\">15%</strong></p>', 0, 0, 1, 0, 0, 0, 0, '2021-08-28 08:26:48', '2021-08-28 08:26:48'),
(5, 1, 11, '<p>Description of merchant write here. Description of merchant write here.Description of merchant write here. can insert take like this. <strong style=\"color: rgb(102, 185, 102);\">15%</strong></p>', 0, 0, 0, 0, 1, 0, 0, '2021-08-28 08:26:48', '2021-08-28 08:26:48'),
(6, 1, 15, '<p>Description of merchant write here. Description of merchant write here.Description of merchant write here. can insert take like this. <strong style=\"color: rgb(102, 185, 102);\">15%</strong></p>', 0, 0, 0, 0, 1, 0, 0, '2021-08-28 08:27:44', '2021-08-28 08:27:44'),
(7, 1, 12, '<p>Description of merchant write here. Description of merchant write here.Description of merchant write here. can insert take like this. <strong style=\"color: rgb(102, 185, 102);\">15%</strong></p>', 0, 0, 0, 0, 0, 1, 0, '2021-08-28 08:27:44', '2021-08-28 08:27:44'),
(8, 1, 18, '<p>Description of merchant write here. Description of merchant write here.Description of merchant write here. can insert take like this. <strong style=\"color: rgb(102, 185, 102);\">15%</strong></p>', 0, 0, 0, 0, 0, 0, 1, '2021-08-28 08:31:14', '2021-08-28 08:31:14'),
(9, 1, 3, '<p>Description of merchant write here. Description of merchant write here.Description of merchant write here. can insert take like this. <strong style=\"color: rgb(102, 185, 102);\">15%</strong></p>', 0, 0, 0, 0, 0, 0, 1, '2021-08-28 08:31:15', '2021-08-28 08:31:15'),
(10, 1, 2, '<p>Description of merchant write here. Description of merchant write here.Description of merchant write here. can insert take like this. <strong style=\"color: rgb(102, 185, 102);\">15%</strong></p>', 1, 0, 0, 0, 0, 0, 1, '2021-08-28 08:31:15', '2021-08-28 08:31:15'),
(11, 5, 1, '<p>Description of merchant write here. Description of merchant write here.Description of merchant write here. can insert take like this. <strong style=\"color: rgb(102, 185, 102);\">15%</strong></p>', 1, 0, 0, 1, 0, 0, 0, '2021-08-28 08:24:36', '2021-08-28 08:24:36'),
(12, 5, 5, '<p>Description of merchant write here. Description of merchant write here.Description of merchant write here. can insert take like this. <strong style=\"color: rgb(102, 185, 102);\">15%</strong></p>', 1, 1, 1, 1, 1, 1, 1, '2021-08-28 08:25:20', '2021-08-28 08:25:20'),
(13, 5, 9, '<p>Description of merchant write here. Description of merchant write here.Description of merchant write here. can insert take like this. <strong style=\"color: rgb(102, 185, 102);\">15%</strong></p>', 0, 0, 1, 0, 0, 0, 0, '2021-08-28 08:25:20', '2021-08-28 08:25:20');

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` bigint(10) UNSIGNED NOT NULL,
  `card_name` varchar(256) DEFAULT NULL,
  `card_info_url` varchar(256) DEFAULT NULL,
  `card_type_id` bigint(10) UNSIGNED DEFAULT NULL,
  `bank_id` bigint(10) UNSIGNED DEFAULT NULL,
  `point_or_cashrebate` varchar(256) DEFAULT NULL,
  `point_or_cashrebate_description` text DEFAULT NULL,
  `point_name` varchar(256) DEFAULT NULL,
  `annual_fee` varchar(256) DEFAULT NULL,
  `annual_fee_sub` varchar(256) DEFAULT NULL,
  `annual_fee_free_1_year` varchar(256) DEFAULT NULL,
  `annual_fee_waived` varchar(256) DEFAULT NULL,
  `point_value_rm` varchar(256) DEFAULT NULL,
  `point_rebate_percentage` varchar(256) DEFAULT NULL,
  `card_image` varchar(256) DEFAULT NULL,
  `late_charge_fee` varchar(256) DEFAULT NULL,
  `interest_type` varchar(256) DEFAULT NULL,
  `interest_rate` varchar(256) DEFAULT NULL,
  `cashout_can` varchar(256) DEFAULT NULL,
  `cash_out_interest` varchar(256) DEFAULT NULL,
  `cash_out_first_charge` varchar(256) DEFAULT NULL,
  `statement_days_can` varchar(256) DEFAULT NULL,
  `card_des` varchar(256) DEFAULT NULL,
  `min_income` varchar(256) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `card_name`, `card_info_url`, `card_type_id`, `bank_id`, `point_or_cashrebate`, `point_or_cashrebate_description`, `point_name`, `annual_fee`, `annual_fee_sub`, `annual_fee_free_1_year`, `annual_fee_waived`, `point_value_rm`, `point_rebate_percentage`, `card_image`, `late_charge_fee`, `interest_type`, `interest_rate`, `cashout_can`, `cash_out_interest`, `cash_out_first_charge`, `statement_days_can`, `card_des`, `min_income`, `created_at`, `updated_at`) VALUES
(1, 'PB World MasterCard Credit Card (fake)', 'https://www.maybank2u.com.my/maybank2u/malaysia/en/personal/cards/credit/maybank_2_platinum_card.page?', 1, 1, 'point', '', 'Air Miles Points', '0', '0', NULL, NULL, '0.002', '0.002', 'storage/uploads/cards/1.jpg', '10', 'High', '18', 'yes', '20', '200', '2,3,7,12,15,20,22,25', 'Earn up to 3x Airmiles points for every ringgit spent', '150,000', '2021-08-27 18:40:49', '2021-08-27 18:40:49'),
(5, 'Maybank 2 Platinum Cards', 'https://www.maybank2u.com.my/maybank2u/malaysia/en/personal/cards/credit/maybank_2_platinum_card.page?', 2, 2, 'point', NULL, 'Treatpoints', '600', '200', 'yes', 'you need to use the card once each month', '0.00125', '0.125', 'storage/uploads/cards/2.jpg', '15', 'Medium', '15', 'yes', '18', '300', '12,15,20,22,25', 'Bla bla 2', '72000', '2021-09-20 19:14:05', '2021-09-20 19:14:05');

-- --------------------------------------------------------

--
-- Table structure for table `card_types`
--

CREATE TABLE `card_types` (
  `id` bigint(10) UNSIGNED NOT NULL,
  `label` varchar(256) NOT NULL,
  `card_type` varchar(256) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `card_types`
--

INSERT INTO `card_types` (`id`, `label`, `card_type`, `created_at`, `updated_at`) VALUES
(1, 'Visa', 'visa', '2021-10-05 18:46:36', '2021-10-05 18:46:36'),
(2, 'Mastercard', 'master', '2021-10-05 18:46:36', '2021-10-05 18:46:36'),
(3, 'American Express', 'american_express', '2021-11-14 08:34:58', '2021-11-14 08:34:58');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(10) UNSIGNED NOT NULL,
  `slug` varchar(256) NOT NULL,
  `category` varchar(256) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `slug`, `category`, `created_at`, `updated_at`) VALUES
(1, 'restaurant', 'Restaurant', '2021-08-27 19:06:34', '2021-08-27 19:06:34'),
(2, 'online-purchase', 'Online Purchase', '2021-08-28 08:11:08', '2021-08-28 08:11:08'),
(3, 'petrol', 'Petrol', '2021-08-28 08:11:08', '2021-08-28 08:11:08'),
(4, 'travel', 'Travel', '2021-08-28 08:11:37', '2021-08-28 08:11:37'),
(5, 'grocery', 'Grocery', '2021-08-28 08:11:37', '2021-08-28 08:11:37'),
(6, 'e-wallet', 'e-Wallet', '2021-08-28 08:12:19', '2021-08-28 08:12:19'),
(7, 'movie', 'Movie', '2021-08-28 08:12:19', '2021-08-28 08:12:19'),
(8, 'e-hailing', 'e-Hailing', '2021-08-28 08:13:08', '2021-08-28 08:13:08'),
(9, 'fashion', 'Fashion', '2021-08-28 08:15:50', '2021-08-28 08:15:50');

-- --------------------------------------------------------

--
-- Table structure for table `merchants`
--

CREATE TABLE `merchants` (
  `id` bigint(10) UNSIGNED NOT NULL,
  `slug` varchar(256) NOT NULL,
  `category_id` bigint(10) UNSIGNED NOT NULL,
  `merchant_name` varchar(256) NOT NULL,
  `merchant_image` text DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `merchants`
--

INSERT INTO `merchants` (`id`, `slug`, `category_id`, `merchant_name`, `merchant_image`, `is_approved`, `created_at`, `updated_at`) VALUES
(1, 'kfc', 1, 'KFC', 'storage/uploads/merchants/kfc.jpg', 1, '2021-08-27 19:07:30', '2021-08-27 19:07:30'),
(2, 'mcdonalds', 1, 'McDonald\'s', 'storage/uploads/merchants/mc-donalds.jpg', 1, '2021-08-28 08:14:39', '2021-08-28 08:14:39'),
(3, 'uniqlo', 9, 'Uniqlo', 'storage/uploads/merchants/uniqlo.jpg', 1, '2021-08-28 08:16:23', '2021-08-28 08:16:23'),
(4, 'plaza-premium-lounge', 4, 'Plaza Premium Lounge', 'storage/uploads/merchants/plaza-premium-lounge.jpg', 1, '2021-08-28 08:16:23', '2021-08-28 08:16:23'),
(5, 'airasia', 4, 'AirAsia', 'storage/uploads/merchants/air-asia.jpg', 1, '2021-08-28 08:17:14', '2021-08-28 08:17:14'),
(6, 'tesco', 5, 'Tesco', 'storage/uploads/merchants/tesco.jpg', 1, '2021-08-28 08:17:14', '2021-08-28 08:17:14'),
(7, 'jaya-grocer', 5, 'Jaya Grocer', 'storage/uploads/merchants/jaya-grocer.jpg', 1, '2021-08-28 08:18:25', '2021-08-28 08:18:25'),
(8, 'gaint', 5, 'Gaint', 'storage/uploads/merchants/gaint.jpg', 1, '2021-08-28 08:18:25', '2021-08-28 08:18:25'),
(9, 'touchngo', 6, 'Touchngo', 'storage/uploads/merchants/touchngo.jpg', 1, '2021-08-28 08:19:01', '2021-08-28 08:19:01'),
(10, 'gsc', 7, 'GSC', 'storage/uploads/merchants/gsc.jpg', 1, '2021-08-28 08:19:01', '2021-08-28 08:19:01'),
(11, 'all-online-shop', 2, 'All Online Shop ', 'storage/uploads/merchants/all-online-shop.jpg', 1, '2021-08-28 08:19:42', '2021-08-28 08:19:42'),
(12, 'grabcar', 8, 'Grabcar', 'storage/uploads/merchants/grab-car.jpg', 1, '2021-08-28 08:19:42', '2021-08-28 08:19:42'),
(13, 'mytaxi', 8, 'MyTaxi', 'storage/uploads/merchants/my-taxi.jpg', 1, '2021-08-28 08:20:19', '2021-08-28 08:20:19'),
(14, 'airasiago', 8, 'AirAsiaGo', 'storage/uploads/merchants/air-asia-go.jpg', 1, '2021-08-28 08:20:19', '2021-08-28 08:20:19'),
(15, 'shopee', 2, 'Shopee', 'storage/uploads/merchants/shopee.jpg', 1, '2021-08-28 08:21:01', '2021-08-28 08:21:01'),
(16, 'lazada', 2, 'Lazada', 'storage/uploads/merchants/lazada.jpg', 1, '2021-08-28 08:21:01', '2021-08-28 08:21:01'),
(17, 'oversea-purchase', 4, 'Oversea Purchase', 'storage/uploads/merchants/oversea-purchase.jpg', 1, '2021-08-28 08:21:39', '2021-08-28 08:21:39'),
(18, 'dine-in-only', 1, 'Dine In Only', 'storage/uploads/merchants/dine-in-only.jpg', 1, '2021-08-28 08:21:39', '2021-08-28 08:21:39');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(10) UNSIGNED NOT NULL,
  `user_id` bigint(10) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `cover_image` text DEFAULT NULL,
  `bank_id` bigint(10) UNSIGNED NOT NULL,
  `card_type_id` bigint(10) UNSIGNED NOT NULL,
  `description` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `user_id`, `title`, `cover_image`, `bank_id`, `card_type_id`, `description`, `created_at`, `updated_at`) VALUES
(5, 2, 'Apple Event on September 14 Announced', NULL, 1, 1, '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.</p><p><br></p><p>Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a</p>', '2021-10-11 17:01:29', '2021-10-11 17:01:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL,
  `user_type_id` bigint(11) UNSIGNED NOT NULL,
  `image` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_type_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 'David B.', 1, 'assets/images/users/user-img.png', '2021-09-13 18:41:53', '2021-09-13 18:41:53'),
(2, 'Gourge', 2, 'assets/images/users/user-img.png', '2021-09-13 18:58:07', '2021-09-13 18:58:07'),
(3, 'Richard', 2, 'assets/images/users/user-img.png', '2021-09-13 18:58:07', '2021-09-13 18:58:07'),
(4, 'Robert', 2, 'assets/images/users/user-img.png', '2021-09-13 18:58:07', '2021-09-13 18:58:07'),
(5, 'Michael', 2, 'assets/images/users/user-img.png', '2021-09-13 18:58:07', '2021-09-13 18:58:07'),
(6, 'Thomas', 2, 'assets/images/users/user-img.png', '2021-09-13 18:58:07', '2021-09-13 18:58:07');

-- --------------------------------------------------------

--
-- Table structure for table `user_card_notes`
--

CREATE TABLE `user_card_notes` (
  `id` bigint(10) UNSIGNED NOT NULL,
  `card_id` bigint(10) UNSIGNED NOT NULL,
  `user_id` bigint(10) UNSIGNED NOT NULL,
  `title` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_card_notes`
--

INSERT INTO `user_card_notes` (`id`, `card_id`, `user_id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(2, 1, 2, 'Title goes here', 'Title goes here', '2022-03-27 14:21:10', '2022-03-27 14:21:10'),
(3, 1, 2, 'Title 2 goes here', 'Title 2 goes here', '2022-03-27 14:23:43', '2022-03-27 14:23:43'),
(4, 1, 2, 'Title goes here 3', 'Title goes here 3', '2022-03-27 14:24:47', '2022-03-27 14:24:47');

-- --------------------------------------------------------

--
-- Table structure for table `user_messages`
--

CREATE TABLE `user_messages` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `user_id` bigint(11) UNSIGNED NOT NULL,
  `card_id` bigint(11) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `parent_message_id` bigint(11) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_messages`
--

INSERT INTO `user_messages` (`id`, `user_id`, `card_id`, `message`, `parent_message_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Did touch n go top consider online purchase to rebate 4%?', NULL, '2021-09-13 18:47:00', '2021-09-13 18:47:00'),
(2, 1, 1, 'Where can i use touch n go feature ?', NULL, '2021-09-13 18:47:00', '2021-09-13 18:47:00'),
(3, 2, 1, 'Yes, sir', 1, '2021-09-13 18:58:41', '2021-09-13 18:58:41'),
(4, 2, 1, 'On touchngo website', 2, '2021-09-13 18:59:21', '2021-09-13 18:59:21'),
(5, 1, 1, 'Please reply fast.', 1, '2021-09-13 19:18:07', '2021-09-13 19:18:07'),
(6, 1, 5, 'Demo question for 2nd credit card\r\n', NULL, '2021-09-13 18:47:00', '2021-09-13 18:47:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `name` varchar(256) NOT NULL,
  `label` varchar(256) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `name`, `label`, `created_at`, `updated_at`) VALUES
(1, 'customer', 'Customer', '2021-09-14 18:10:20', '2021-09-14 18:10:20'),
(2, 'card_admin', 'Card Admin', '2021-09-14 18:10:20', '2021-09-14 18:10:20'),
(3, 'volunteer', 'Volunteer', '2021-09-14 18:19:41', '2021-09-14 18:19:41'),
(4, 'service_agent', '10Card', '2021-09-14 18:19:41', '2021-09-14 18:19:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_admins`
--
ALTER TABLE `bank_admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bank_admin_users` (`user_id`),
  ADD KEY `fk_banks` (`bank_id`);

--
-- Indexes for table `benefits`
--
ALTER TABLE `benefits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_benefits_cards` (`card_id`),
  ADD KEY `fk_benefit_merchants` (`merchant_id`);

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cards_card_types` (`card_type_id`),
  ADD KEY `fk_cards_banks` (`bank_id`);

--
-- Indexes for table `card_types`
--
ALTER TABLE `card_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merchants`
--
ALTER TABLE `merchants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_merchants_category` (`category_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_types` (`user_type_id`);

--
-- Indexes for table `user_card_notes`
--
ALTER TABLE `user_card_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_card_notes_cards` (`card_id`),
  ADD KEY `fk_user_card_notes_users` (`user_id`);

--
-- Indexes for table `user_messages`
--
ALTER TABLE `user_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users` (`user_id`),
  ADD KEY `fk_cards` (`card_id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bank_admins`
--
ALTER TABLE `bank_admins`
  MODIFY `id` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `benefits`
--
ALTER TABLE `benefits`
  MODIFY `id` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `card_types`
--
ALTER TABLE `card_types`
  MODIFY `id` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `merchants`
--
ALTER TABLE `merchants`
  MODIFY `id` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_card_notes`
--
ALTER TABLE `user_card_notes`
  MODIFY `id` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_messages`
--
ALTER TABLE `user_messages`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bank_admins`
--
ALTER TABLE `bank_admins`
  ADD CONSTRAINT `fk_bank_admin_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_banks` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `benefits`
--
ALTER TABLE `benefits`
  ADD CONSTRAINT `fk_benefit_merchants` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_benefits_cards` FOREIGN KEY (`card_id`) REFERENCES `cards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cards`
--
ALTER TABLE `cards`
  ADD CONSTRAINT `fk_cards_banks` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cards_card_types` FOREIGN KEY (`card_type_id`) REFERENCES `card_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `merchants`
--
ALTER TABLE `merchants`
  ADD CONSTRAINT `fk_merchants_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_types` FOREIGN KEY (`user_type_id`) REFERENCES `user_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_card_notes`
--
ALTER TABLE `user_card_notes`
  ADD CONSTRAINT `fk_user_card_notes_cards` FOREIGN KEY (`card_id`) REFERENCES `cards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_card_notes_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_messages`
--
ALTER TABLE `user_messages`
  ADD CONSTRAINT `fk_cards` FOREIGN KEY (`card_id`) REFERENCES `cards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
