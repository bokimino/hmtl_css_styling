-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2024 at 10:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `igralishte`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessories`
--

CREATE TABLE `accessories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accessories`
--

INSERT INTO `accessories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Accessory 1', NULL, NULL),
(2, 'Accessory 2', NULL, NULL),
(3, 'Accessory 3', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `is_active`, `description`, `created_at`, `updated_at`) VALUES
(32, 'Barcelona FC', 0, 'asd', '2024-03-20 14:50:05', '2024-03-24 18:57:54'),
(33, 'H&M', 1, 'das', '2024-03-20 19:55:42', '2024-03-20 19:55:42'),
(36, 'Armani', 0, 'Armani brand', '2024-03-24 15:35:19', '2024-03-24 15:35:33'),
(37, 'Givanchy', 1, 'Givanchy опис', '2024-03-24 18:42:59', '2024-03-24 18:42:59'),
(38, 'Zshdane', 0, 'Zshdane', '2024-03-24 18:54:07', '2024-03-24 18:55:15');

-- --------------------------------------------------------

--
-- Table structure for table `brand_brand_category`
--

CREATE TABLE `brand_brand_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `brand_category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brand_brand_category`
--

INSERT INTO `brand_brand_category` (`id`, `brand_id`, `brand_category_id`, `created_at`, `updated_at`) VALUES
(22, 33, 2, NULL, NULL),
(32, 36, 2, NULL, NULL),
(33, 37, 2, NULL, NULL),
(34, 37, 3, NULL, NULL),
(35, 38, 3, NULL, NULL),
(36, 38, 4, NULL, NULL),
(37, 33, 3, NULL, NULL),
(38, 33, 4, NULL, NULL),
(39, 33, 5, NULL, NULL),
(40, 32, 3, NULL, NULL),
(41, 32, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brand_brand_tag`
--

CREATE TABLE `brand_brand_tag` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `brand_tag_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brand_brand_tag`
--

INSERT INTO `brand_brand_tag` (`id`, `brand_id`, `brand_tag_id`, `created_at`, `updated_at`) VALUES
(45, 38, 18, NULL, NULL),
(46, 38, 19, NULL, NULL),
(47, 38, 20, NULL, NULL),
(48, 32, 19, NULL, NULL),
(49, 33, 21, NULL, NULL),
(50, 33, 22, NULL, NULL),
(51, 37, 12, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brand_categories`
--

CREATE TABLE `brand_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brand_categories`
--

INSERT INTO `brand_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Fashion', NULL, NULL),
(2, 'Блузи', NULL, NULL),
(3, 'Долна Облека', NULL, NULL),
(4, 'Пантолони', NULL, NULL),
(5, 'Јакни', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brand_images`
--

CREATE TABLE `brand_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brand_images`
--

INSERT INTO `brand_images` (`id`, `brand_id`, `image_path`, `created_at`, `updated_at`) VALUES
(49, 32, 'brand_images/2EYTGHt21avkFAiHDAbiR36Mx99XUClcJNME7pRO.png', '2024-03-20 14:50:05', '2024-03-24 20:36:13'),
(50, 33, 'brand_images/Bwm0t8ikTMrOoNcrloHcUrIqZmf5PPYgday4uAGU.png', '2024-03-20 19:55:43', '2024-03-20 20:32:56'),
(51, 33, 'brand_images/7NgsIBANa8d4afRs5L5tFqiG0t3LHJAEglk4kL30.png', '2024-03-20 19:55:43', '2024-03-20 19:55:43'),
(52, 33, 'brand_images/rlxgQl90Ds3doh33SK2pugHC97NzMMjfjDMsXifN.png', '2024-03-20 19:55:43', '2024-03-20 20:32:56'),
(53, 33, 'brand_images/yNiZKExHJ3hR3IAvjVAUkxvX5du0ahAxbpOQGAuy.png', '2024-03-20 20:31:30', '2024-03-20 20:32:56'),
(54, 32, 'brand_images/YYLOOmia5WZVY0g3nHuVVSZaK0RJ710xgFTDFiwa.png', '2024-03-21 18:53:10', '2024-03-24 20:36:13'),
(55, 32, 'brand_images/rEgjQqSvwZ8pYUl6hMTMJgoCIO7a5VJrkYkaO0I5.png', '2024-03-21 18:53:10', '2024-03-21 18:53:10'),
(56, 32, 'brand_images/goQzpxSUEJM4D6S0Y1uMuT4PTmvWcEH4Toxywlt7.png', '2024-03-21 18:53:10', '2024-03-21 18:53:10'),
(64, 36, 'brand_images/X1Ab7eGyjoFEGg9IK4V5i0gXiZ9eyU5VHlzbrIqy.png', '2024-03-24 15:35:20', '2024-03-24 15:35:20'),
(65, 36, 'brand_images/zHLwGy1j1lQsWBqhl06vGpghpGYxg5qqHjOOusNr.png', '2024-03-24 15:35:33', '2024-03-24 15:35:33'),
(66, 37, 'brand_images/wXfTpIapmYBXIKH4ctaeYtO796XdleoYGK7Wjh4r.png', '2024-03-24 18:42:59', '2024-03-24 19:35:37'),
(67, 37, 'brand_images/3oVdcKDi5xGBDAtfb1qOx7Vjybp1MEIOiP1ni9cC.png', '2024-03-24 18:50:15', '2024-03-24 18:50:15'),
(68, 38, 'brand_images/toqWpASoOt9EW99naGQbjpwsd2q46gU5C67hQZ1B.png', '2024-03-24 18:54:07', '2024-03-24 18:54:07'),
(69, 38, 'brand_images/PDjwgSfW7JDw1wz2RMganWgsmL7xjCYTc4E9k7va.png', '2024-03-24 18:54:07', '2024-03-24 18:54:07'),
(70, 38, 'brand_images/xy4p26jbIJx2MPejD0OZFoHn2A6TUtL7bnxKuGuE.png', '2024-03-24 18:56:03', '2024-03-24 18:56:03'),
(71, 37, 'brand_images/K3N8zyMV0CSmkHTgnJ86W0f87drpeggWTkL0XQd6.png', '2024-03-24 19:35:09', '2024-03-24 19:35:09'),
(72, 37, 'brand_images/lgYh9dkVNTwCKlftsYPYa5UlmWfXPSv3cet6cwm5.png', '2024-03-24 19:35:09', '2024-03-24 19:35:09');

-- --------------------------------------------------------

--
-- Table structure for table `brand_tags`
--

CREATE TABLE `brand_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brand_tags`
--

INSERT INTO `brand_tags` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'vintage', NULL, NULL),
(2, 'new', NULL, NULL),
(3, 'Luxury', NULL, NULL),
(4, 'vintage', NULL, NULL),
(5, 'new', NULL, NULL),
(6, 'Luxury', NULL, NULL),
(7, 'vintage', NULL, NULL),
(8, 'new', NULL, NULL),
(9, 'Luxury', NULL, NULL),
(10, 'prase', '2024-03-14 19:06:14', '2024-03-14 19:06:14'),
(11, 'lux', '2024-03-18 19:40:39', '2024-03-18 19:40:39'),
(12, 'asd', '2024-03-19 12:48:13', '2024-03-19 12:48:13'),
(13, 'wallet', '2024-03-20 19:55:42', '2024-03-20 19:55:42'),
(14, 'tommy', '2024-03-20 19:55:43', '2024-03-20 19:55:43'),
(15, 'jimmy', '2024-03-20 19:55:43', '2024-03-20 19:55:43'),
(16, 'armani', '2024-03-24 15:35:19', '2024-03-24 15:35:19'),
(17, 'тест', '2024-03-24 18:42:59', '2024-03-24 18:42:59'),
(18, 'Zshdane', '2024-03-24 18:54:07', '2024-03-24 18:54:07'),
(19, 'test', '2024-03-24 18:54:07', '2024-03-24 18:54:07'),
(20, 'окаѕ', '2024-03-24 18:55:22', '2024-03-24 18:55:22'),
(21, 'style', '2024-03-24 19:07:10', '2024-03-24 19:07:10'),
(22, 'fashion', '2024-03-24 19:07:10', '2024-03-24 19:07:10');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `hex` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`, `hex`, `created_at`, `updated_at`) VALUES
(5, 'Red', '#FF835E', NULL, NULL),
(6, 'Orange', '#FBC26C', NULL, NULL),
(7, 'Yellow', '#FCFF81', NULL, NULL),
(8, 'Green', '#B9E5A4', NULL, NULL),
(9, 'Blue', '#75D7F0', NULL, NULL),
(10, 'Pink', '#FFDBDB', NULL, NULL),
(11, 'Purple', '#EA97FF', NULL, NULL),
(12, 'Gray', '#D9D9D9', NULL, NULL),
(13, 'White', '#FFFFFF', NULL, NULL),
(14, 'Black', '#232221', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `discount` int(10) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `discount_category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `code`, `discount`, `is_active`, `discount_category_id`, `created_at`, `updated_at`) VALUES
(3, 'NEW', 35, 1, 4, '2024-03-11 07:41:37', '2024-03-24 20:06:34'),
(4, 'Sezonski', 70, 0, 5, '2024-03-11 11:12:30', '2024-03-11 12:06:21'),
(7, '25% Попуст', 26, 1, 1, '2024-03-24 11:03:27', '2024-03-24 12:17:14'),
(8, '20% Попуст', 20, 0, 4, '2024-03-24 19:02:33', '2024-03-24 19:02:41');

-- --------------------------------------------------------

--
-- Table structure for table `discount_categories`
--

CREATE TABLE `discount_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discount_categories`
--

INSERT INTO `discount_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Summer', NULL, NULL),
(2, 'Winter', NULL, NULL),
(3, 'Spring', NULL, NULL),
(4, 'Black Friday', NULL, NULL),
(5, 'School', NULL, NULL),
(6, 'Fall', NULL, NULL);

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
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_02_29_155010_create_accessories_table', 1),
(7, '2024_02_29_155412_create_product_categories_table', 1),
(8, '2024_02_29_155516_create_product_tags_table', 1),
(9, '2024_02_29_161000_create_discount_categories_table', 1),
(10, '2024_02_29_161019_create_brand_categories_table', 1),
(11, '2024_02_29_161044_create_brand_tags_table', 1),
(12, '2024_02_29_161110_create_discounts_table', 1),
(13, '2024_02_29_161117_create_brands_table', 1),
(14, '2024_02_29_171122_create_colors_table', 1),
(15, '2024_02_29_171132_create_sizes_table', 1),
(16, '2024_02_29_180111_create_products_table', 1),
(17, '2024_03_07_103628_create_brand_brand_tag_table', 1),
(18, '2024_03_07_104037_create_product_color_table', 1),
(19, '2024_03_07_104114_create_product_size_table', 1),
(20, '2024_03_07_104210_create_product_product_tag_table', 1),
(21, '2024_03_07_104656_create_product_images_table', 1),
(22, '2024_03_07_104804_create_brand_images_table', 1),
(23, '2024_03_08_143704_edit_brands_table', 2),
(24, '2024_03_08_194317_modify_brand_images_table', 3),
(25, '2024_03_13_103600_add_quantity_to_products_table', 4),
(26, '2024_03_13_153545_remove_color_size_from_products_table', 5),
(27, '2024_03_14_104149_alter_products_table', 6),
(29, '2024_03_14_134631_create_brand_brand_category_table', 7),
(30, '2024_03_14_191905_remove_brand_category_id_from_brands_table', 8),
(31, '2024_03_17_153038_add_hex_column_to_colors_table', 9),
(32, '2024_03_17_175702_add_brand_category_id_to_products_table', 10),
(33, '2024_03_19_193534_add_null_to_brand_to_products_table', 11),
(36, '2024_03_23_164857_add_additional_fields_to_users_table', 12),
(37, '2024_03_24_183235_change_price_column_type_in_products_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `size_description` text DEFAULT NULL,
  `material` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `maintenance` varchar(255) NOT NULL,
  `discount_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `accessories_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `is_active`, `size_description`, `material`, `quantity`, `maintenance`, `discount_id`, `brand_id`, `brand_category_id`, `accessories_id`, `created_at`, `updated_at`) VALUES
(15, 'Leather Jacket', 'Jacket опис', 5900, 1, 'Оваа величина', NULL, 2, 'Насоки за одржување за јакна', 3, 36, 2, NULL, '2024-03-17 17:05:00', '2024-03-24 20:06:34'),
(16, 'Polo shirt', 'опис за Поло', 1250, 1, 'okay M L selected 2 quantities green and yellow', NULL, 3, 'Nasokite', 3, 33, 2, NULL, '2024-03-21 19:30:33', '2024-03-24 20:06:34'),
(17, 'Bluza', 'das', 199, 1, 'okay M L selected 2 quantities green and yellow', NULL, 2, 'asd', NULL, 38, 3, NULL, '2024-03-21 19:31:25', '2024-03-24 19:16:41'),
(18, 'Fustance', 'asdasdasd', 10999, 0, 'асд', NULL, 7, 'asd', NULL, 37, 2, NULL, '2024-03-21 20:14:35', '2024-03-24 19:47:03'),
(19, 'Pink Dress', 'test', 3000, 1, 'testtest', NULL, 2, 'test', NULL, 38, 3, NULL, '2024-03-24 10:24:15', '2024-03-24 20:02:13'),
(20, 'Leather Jeans', 'test', 999, 1, 'testtest', NULL, 2, 'test', NULL, 33, 3, NULL, '2024-03-24 10:25:26', '2024-03-24 20:06:03'),
(22, 'Blue dress', 'Опис на продукт', 250, 1, 'Совет сза величина', NULL, 3, 'Насоки за одржување', NULL, 38, 3, NULL, '2024-03-24 16:08:31', '2024-03-24 19:23:37'),
(23, 'Pinc Partywear dress', 'dress nice', 2900, 1, 'velcina', NULL, 3, 'nasoki', NULL, 32, 3, NULL, '2024-03-24 20:42:44', '2024-03-24 20:43:21');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Category 1', NULL, NULL),
(2, 'Category 2', NULL, NULL),
(3, 'Category 3', NULL, NULL),
(4, 'Category 4', NULL, NULL),
(5, 'Category 5', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_color`
--

CREATE TABLE `product_color` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_color`
--

INSERT INTO `product_color` (`id`, `product_id`, `color_id`, `created_at`, `updated_at`) VALUES
(16, 15, 6, NULL, NULL),
(17, 16, 7, NULL, NULL),
(18, 16, 8, NULL, NULL),
(19, 17, 7, NULL, NULL),
(20, 17, 8, NULL, NULL),
(21, 18, 6, NULL, NULL),
(22, 19, 6, NULL, NULL),
(23, 20, 6, NULL, NULL),
(26, 22, 5, NULL, NULL),
(27, 22, 6, NULL, NULL),
(28, 22, 7, NULL, NULL),
(29, 22, 8, NULL, NULL),
(30, 15, 11, NULL, NULL),
(31, 15, 12, NULL, NULL),
(32, 16, 6, NULL, NULL),
(33, 18, 8, NULL, NULL),
(34, 18, 9, NULL, NULL),
(35, 18, 10, NULL, NULL),
(36, 18, 11, NULL, NULL),
(37, 19, 7, NULL, NULL),
(38, 19, 8, NULL, NULL),
(39, 19, 9, NULL, NULL),
(40, 19, 10, NULL, NULL),
(41, 20, 7, NULL, NULL),
(42, 20, 8, NULL, NULL),
(43, 20, 9, NULL, NULL),
(44, 20, 10, NULL, NULL),
(45, 20, 11, NULL, NULL),
(46, 23, 6, NULL, NULL),
(47, 23, 7, NULL, NULL),
(48, 23, 8, NULL, NULL),
(49, 23, 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(13, 17, 'product_images/OB22pyziAaP0F87YOiB2KCGKJuIJ0qdr5ljghtRB.png', '2024-03-21 20:08:31', '2024-03-21 20:08:31'),
(24, 22, 'product_images/ULbYFYuZIKGINizQJnNZytdA9itLItYALEPFC0WJ.png', '2024-03-24 16:17:43', '2024-03-24 16:17:43'),
(25, 22, 'product_images/4p3fgvYWSXI3vRMldjdMaNvmxMfZoqK9Gj0kZ0U7.png', '2024-03-24 16:23:11', '2024-03-24 16:23:11'),
(26, 22, 'product_images/15QYEHyzsxkBlMTTbZBgO9AgnvewDdEvaDt8hjzc.png', '2024-03-24 16:23:24', '2024-03-24 16:23:24'),
(27, 15, 'product_images/KHYRTrjRiVMizSXKgK3DuhZY281IDTwV0YhrswkG.png', '2024-03-24 19:06:39', '2024-03-24 19:06:39'),
(28, 15, 'product_images/CzpSJ3NSDusum46hiKoVcMZ1MBtOnjOCBJEDecrV.png', '2024-03-24 19:06:39', '2024-03-24 19:06:39'),
(29, 16, 'product_images/3thQ3pUhdfGpzqqly6E3sYg20iyVTb5A9QJx2cCJ.png', '2024-03-24 19:08:08', '2024-03-24 19:08:08'),
(30, 16, 'product_images/8ZilGK1RLt2fXBIgLGfMsrko4WkyenNXyI7BEbWa.png', '2024-03-24 19:08:08', '2024-03-24 19:08:08'),
(31, 18, 'product_images/enxqd1icfHEAogSts5Xkc77oWcKsCQifCKgM6VhP.png', '2024-03-24 19:17:42', '2024-03-24 19:17:42'),
(32, 18, 'product_images/iJWRrfxMi1P5EryPjBtSQMmEXXeTjvX1QLrrA85K.png', '2024-03-24 19:17:42', '2024-03-24 19:17:42'),
(33, 18, 'product_images/cFwMj4NBwCQ72DjzYH9ZK20Lg2SqeVLVxqOZJnqc.png', '2024-03-24 19:17:42', '2024-03-24 19:17:42'),
(35, 22, 'product_images/i9W478ASgcLfHdOZmzckKv4bhrJAWcqWZtWwrid3.png', '2024-03-24 19:23:37', '2024-03-24 19:23:37'),
(36, 22, 'product_images/0E0GeUfP5xXaVWaKPkW5WuEyY3oKa3yAoTKTQhHp.png', '2024-03-24 19:23:37', '2024-03-24 19:23:37'),
(39, 19, 'product_images/voXEJhmssat6OLgrPY6CFLy3FPlrnsFbi5R3LlZ3.png', '2024-03-24 19:51:14', '2024-03-24 19:51:14'),
(43, 19, 'product_images/ijOxSNFBHsUA6cDnSs2Qbfr07RSSdR9krdXfAndj.png', '2024-03-24 20:02:13', '2024-03-24 20:02:13'),
(44, 19, 'product_images/gc4PKSHG8kfT7gZ0uwgPI7xyPvjIZaX753NKn7mz.png', '2024-03-24 20:02:13', '2024-03-24 20:02:13'),
(45, 20, 'product_images/vtMYuK14XcK8agYMrmC9lpnP0dNIrgB276QUhmk7.png', '2024-03-24 20:04:49', '2024-03-24 20:04:49'),
(46, 20, 'product_images/wa211uBXFo3eJFosIHtFEvfptKOXeOCSwoBdU5yP.png', '2024-03-24 20:04:49', '2024-03-24 20:04:49'),
(47, 23, 'product_images/Aq1qEfr3D3J2216dh0DzXcLIyHsXjP2A20V0idUK.png', '2024-03-24 20:42:44', '2024-03-24 20:42:44'),
(49, 23, 'product_images/BKoGe2OTecTwEyjiWJgVgL24xh6u7GiSM7oCNxJ1.png', '2024-03-24 20:43:21', '2024-03-24 20:43:21'),
(50, 23, 'product_images/nJmiesoBsCX0502eGTqkTi7wwgVSmiPWv829UaSb.png', '2024-03-24 20:43:21', '2024-03-24 20:43:21');

-- --------------------------------------------------------

--
-- Table structure for table `product_product_tag`
--

CREATE TABLE `product_product_tag` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_tag_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_product_tag`
--

INSERT INTO `product_product_tag` (`id`, `product_id`, `product_tag_id`, `created_at`, `updated_at`) VALUES
(27, 17, 11, NULL, NULL),
(28, 17, 8, NULL, NULL),
(29, 18, 4, NULL, NULL),
(30, 19, 12, NULL, NULL),
(31, 20, 12, NULL, NULL),
(34, 22, 13, NULL, NULL),
(35, 22, 14, NULL, NULL),
(36, 15, 15, NULL, NULL),
(37, 15, 16, NULL, NULL),
(38, 16, 17, NULL, NULL),
(39, 16, 18, NULL, NULL),
(40, 23, 19, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_size`
--

CREATE TABLE `product_size` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `size_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_size`
--

INSERT INTO `product_size` (`id`, `product_id`, `size_id`, `created_at`, `updated_at`) VALUES
(18, 15, 2, NULL, NULL),
(19, 16, 2, NULL, NULL),
(20, 16, 3, NULL, NULL),
(21, 17, 2, NULL, NULL),
(22, 17, 3, NULL, NULL),
(23, 18, 2, NULL, NULL),
(24, 19, 2, NULL, NULL),
(25, 20, 2, NULL, NULL),
(28, 22, 1, NULL, NULL),
(29, 22, 2, NULL, NULL),
(30, 15, 1, NULL, NULL),
(31, 16, 4, NULL, NULL),
(32, 18, 3, NULL, NULL),
(33, 18, 4, NULL, NULL),
(34, 19, 3, NULL, NULL),
(35, 19, 4, NULL, NULL),
(36, 20, 1, NULL, NULL),
(37, 20, 3, NULL, NULL),
(38, 20, 4, NULL, NULL),
(39, 23, 2, NULL, NULL),
(40, 23, 3, NULL, NULL),
(41, 23, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_tags`
--

CREATE TABLE `product_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_tags`
--

INSERT INTO `product_tags` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'wallet', '2024-03-14 08:55:52', '2024-03-14 08:55:52'),
(2, 'tommy', '2024-03-14 08:57:52', '2024-03-14 08:57:52'),
(3, 'jimmy', '2024-03-14 08:59:15', '2024-03-14 08:59:15'),
(4, 'asd', '2024-03-14 09:31:06', '2024-03-14 09:31:06'),
(5, 'bobbt', '2024-03-14 11:22:44', '2024-03-14 11:22:44'),
(6, 'product', '2024-03-14 12:14:16', '2024-03-14 12:14:16'),
(7, 'alista', '2024-03-14 12:14:16', '2024-03-14 12:14:16'),
(8, 'prase', '2024-03-14 19:00:07', '2024-03-14 19:00:07'),
(9, '#jiggy', '2024-03-17 16:34:26', '2024-03-17 16:34:26'),
(10, '#lala', '2024-03-17 16:34:26', '2024-03-17 16:34:26'),
(11, 'new', '2024-03-21 19:30:33', '2024-03-21 19:30:33'),
(12, 'test', '2024-03-24 10:24:15', '2024-03-24 10:24:15'),
(13, 'таг', '2024-03-24 16:08:31', '2024-03-24 16:08:31'),
(14, 'таг2', '2024-03-24 16:09:18', '2024-03-24 16:09:18'),
(15, 'leather', '2024-03-24 19:06:39', '2024-03-24 19:06:39'),
(16, 'јакна', '2024-03-24 19:06:39', '2024-03-24 19:06:39'),
(17, 'стајл', '2024-03-24 19:08:08', '2024-03-24 19:08:08'),
(18, 'фешн', '2024-03-24 19:08:08', '2024-03-24 19:08:08'),
(19, 'fancy', '2024-03-24 20:42:44', '2024-03-24 20:42:44');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'XS', NULL, NULL),
(2, 's', NULL, NULL),
(3, 'm', NULL, NULL),
(4, 'l', NULL, NULL),
(5, 'XL', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `biography` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `phone`, `is_admin`, `image`, `remember_token`, `created_at`, `updated_at`, `surname`, `address`, `biography`) VALUES
(1, 'Admin', '$2y$12$C6goy9wtZf4X8Ms.giBr7..6UbQWp4fs3qhfkAWrJw/BRmIBy7UDi', 'admin@example.com', '723223413', 1, 'profile_images/Ua3sW8q809FucEq3bNoi721vNxB91muC71sbMjqA.png', NULL, '2024-03-07 17:53:03', '2024-03-24 20:35:10', NULL, NULL, NULL),
(3, 'Bojan', '$2y$12$bCEbp7Zf9Xe7wkQbEhp2MuB4XKXkhZrR3IwDRs1mnyL5FCBLUWQaG', 'boki_it@live.com', NULL, 0, NULL, NULL, '2024-03-23 17:17:04', '2024-03-23 17:17:04', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessories`
--
ALTER TABLE `accessories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand_brand_category`
--
ALTER TABLE `brand_brand_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_brand_category_brand_id_foreign` (`brand_id`),
  ADD KEY `brand_brand_category_brand_category_id_foreign` (`brand_category_id`);

--
-- Indexes for table `brand_brand_tag`
--
ALTER TABLE `brand_brand_tag`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brand_brand_tag_brand_id_brand_tag_id_unique` (`brand_id`,`brand_tag_id`),
  ADD KEY `brand_brand_tag_brand_tag_id_foreign` (`brand_tag_id`);

--
-- Indexes for table `brand_categories`
--
ALTER TABLE `brand_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand_images`
--
ALTER TABLE `brand_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_images_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `brand_tags`
--
ALTER TABLE `brand_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discounts_discount_category_id_foreign` (`discount_category_id`);

--
-- Indexes for table `discount_categories`
--
ALTER TABLE `discount_categories`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_discount_id_foreign` (`discount_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_accessories_id_foreign` (`accessories_id`),
  ADD KEY `products_brand_category_id_foreign` (`brand_category_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_color`
--
ALTER TABLE `product_color`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_color_product_id_foreign` (`product_id`),
  ADD KEY `product_color_color_id_foreign` (`color_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_product_tag`
--
ALTER TABLE `product_product_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_product_tag_product_id_foreign` (`product_id`),
  ADD KEY `product_product_tag_product_tag_id_foreign` (`product_tag_id`);

--
-- Indexes for table `product_size`
--
ALTER TABLE `product_size`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_size_product_id_foreign` (`product_id`),
  ADD KEY `product_size_size_id_foreign` (`size_id`);

--
-- Indexes for table `product_tags`
--
ALTER TABLE `product_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `accessories`
--
ALTER TABLE `accessories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `brand_brand_category`
--
ALTER TABLE `brand_brand_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `brand_brand_tag`
--
ALTER TABLE `brand_brand_tag`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `brand_categories`
--
ALTER TABLE `brand_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `brand_images`
--
ALTER TABLE `brand_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `brand_tags`
--
ALTER TABLE `brand_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `discount_categories`
--
ALTER TABLE `discount_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_color`
--
ALTER TABLE `product_color`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `product_product_tag`
--
ALTER TABLE `product_product_tag`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `product_size`
--
ALTER TABLE `product_size`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `product_tags`
--
ALTER TABLE `product_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `brand_brand_category`
--
ALTER TABLE `brand_brand_category`
  ADD CONSTRAINT `brand_brand_category_brand_category_id_foreign` FOREIGN KEY (`brand_category_id`) REFERENCES `brand_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `brand_brand_category_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `brand_brand_tag`
--
ALTER TABLE `brand_brand_tag`
  ADD CONSTRAINT `brand_brand_tag_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `brand_brand_tag_brand_tag_id_foreign` FOREIGN KEY (`brand_tag_id`) REFERENCES `brand_tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `brand_images`
--
ALTER TABLE `brand_images`
  ADD CONSTRAINT `brand_images_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `discounts`
--
ALTER TABLE `discounts`
  ADD CONSTRAINT `discounts_discount_category_id_foreign` FOREIGN KEY (`discount_category_id`) REFERENCES `discount_categories` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_accessories_id_foreign` FOREIGN KEY (`accessories_id`) REFERENCES `accessories` (`id`),
  ADD CONSTRAINT `products_brand_category_id_foreign` FOREIGN KEY (`brand_category_id`) REFERENCES `brand_categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `products_discount_id_foreign` FOREIGN KEY (`discount_id`) REFERENCES `discounts` (`id`);

--
-- Constraints for table `product_color`
--
ALTER TABLE `product_color`
  ADD CONSTRAINT `product_color_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_color_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_product_tag`
--
ALTER TABLE `product_product_tag`
  ADD CONSTRAINT `product_product_tag_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_product_tag_product_tag_id_foreign` FOREIGN KEY (`product_tag_id`) REFERENCES `product_tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_size`
--
ALTER TABLE `product_size`
  ADD CONSTRAINT `product_size_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_size_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
