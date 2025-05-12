-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2025 at 10:31 AM
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
-- Database: `it9project`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Rice', 'bugas', '2025-03-30 11:01:49', '2025-03-30 11:01:49'),
(3, 'Frozen', 'foods', '2025-03-30 11:04:57', '2025-03-30 11:04:57'),
(4, 'Fruits', 'prutas', '2025-03-30 11:05:48', '2025-03-30 11:05:48'),
(5, 'Vegetables', 'Gulay', '2025-03-30 11:06:01', '2025-03-30 11:06:01'),
(6, 'Chips', 'junkfoods', '2025-03-30 11:06:16', '2025-03-30 11:06:16'),
(7, 'Candy', 'yum', '2025-03-30 11:06:36', '2025-03-30 11:06:36'),
(8, 'Soup', 'sopas', '2025-03-30 11:06:54', '2025-03-30 11:06:54'),
(9, 'Condiment', 'Sauce', '2025-04-01 10:30:38', '2025-04-01 10:30:38'),
(10, 'Alcohol Beverage', 'drink', '2025-04-01 10:31:31', '2025-04-01 10:31:31');

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_03_23_112933_create_categories_table', 1),
(5, '2025_03_23_114807_create_products_table', 1),
(6, '2025_03_25_153650_create_suppliers_table', 1),
(7, '2025_03_25_154146_add_supplier_id_to_products_table', 1),
(8, '2025_03_25_161542_update_suppliers_table', 1),
(9, '2025_03_25_164715_modify_suppliers_table', 1),
(10, '2025_03_25_172753_add_cost_price_and_update_price_in_products_table', 1),
(11, '2025_03_30_165549_create_stock_ins_table', 1),
(12, '2025_03_30_181638_create_stock_orders_table', 1),
(13, '2025_03_30_182225_update_stock_ins_table_for_orders', 1),
(14, '2025_05_05_125302_create_transactions_table', 2),
(15, '2025_05_05_125541_create_transaction_items_table', 3);

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `sell_price` decimal(10,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `barcode` varchar(12) NOT NULL,
  `cost_price` decimal(10,2) NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `sell_price`, `quantity`, `barcode`, `cost_price`, `category_id`, `supplier_id`, `created_at`, `updated_at`) VALUES
(1, 'Hotdog', 30.00, 0, '13J31N231N3J', 25.00, 3, NULL, '2025-03-30 11:05:30', '2025-04-14 15:03:38'),
(2, 'Banana', 15.00, 0, '12NL13N13N13', 12.00, 4, NULL, '2025-03-30 11:08:12', '2025-05-05 06:12:16'),
(3, 'Strawberry', 18.00, 16, 'CC3JEJ3E3V3V', 16.00, 4, NULL, '2025-03-30 11:08:39', '2025-05-05 06:19:55'),
(4, 'Tanduay', 141.00, 0, '2CE1C12E1C1C', 130.00, 10, NULL, '2025-04-01 10:31:48', '2025-04-01 20:00:05'),
(5, 'Snowbear', 45.00, 0, 'CE12CE12CD12', 12.00, 7, NULL, '2025-04-01 10:32:05', '2025-04-01 10:32:05'),
(6, 'Lollipop', 17.00, 0, 'WCD1CEC1D1C2', 15.00, 7, NULL, '2025-04-01 10:32:34', '2025-04-01 10:32:34'),
(7, 'Papa Ketchup', 16.00, 0, 'EC12CDC12D1C', 14.00, 9, NULL, '2025-04-01 10:32:57', '2025-04-01 10:32:57'),
(8, 'Fries', 176.00, 12, 'WD1EC1D1WDC1', 156.00, 3, NULL, '2025-04-01 10:33:46', '2025-04-01 11:15:16'),
(9, 'Skittles', 55.21, 19, 'EBI1B2EIBIWB', 50.30, 7, NULL, '2025-05-05 04:36:29', '2025-05-05 04:39:35');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1SNoh4pxQuRBtuzSOQr0GDuo4bKSkfeFmYcTtRWQ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 OPR/117.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoicFRHTjBnUWc3eWhRZlFYcXcwWU54cVJ4WWRZWHZOZG1DVm9ENFg1WCI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3RyYW5zYWN0aW9uX2xvZyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NDoiY2FydCI7YToxOntpOjM7YTo0OntzOjI6ImlkIjtpOjM7czo0OiJuYW1lIjtzOjEwOiJTdHJhd2JlcnJ5IjtzOjU6InByaWNlIjtzOjU6IjE4LjAwIjtzOjg6InF1YW50aXR5IjtpOjE7fX19', 1746461841),
('aXtSItvJ2tYh9RWdUFAN27iNrCSoCzhvPqPNZAR3', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 OPR/117.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoic1NtdDRCb2JVMVkzcXV6b2xic21ZOFpFUHp2c0l1cXRNblVvaHNFcCI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyOToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3Byb2R1Y3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1746448549),
('cE7EZ3R2fOEJEXiTRCfkSaryHv3aWI3O3yZbzdhq', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 OPR/117.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiU0FFRnRrUHNXTlB3amdsbUhIOXZjZ2VFZHZZYlZxaU9Yd1RYdEJtaSI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyOToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3Byb2R1Y3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1746448549),
('IZPi0irpn9p8mH17iwr8DtU18ojU1qXeXCLjYBGK', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 OPR/117.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNzBucGRZazM2MVJlZFJKYmtlaDVsSGVwcW1YWDNUa3BHNW1jeUxLVSI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3RyYW5zYWN0aW9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1746524768),
('oFNBa927EYD7hlz9phMZEK8z3Q4dQW9wSVq3h5pM', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 OPR/117.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOTg4SmFCZWtGeXFMZUs1THVmTVVpOUs3QmxQN1MyY3dEUkpmY21sNiI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3RyYW5zYWN0aW9uX2xvZyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1746524892),
('VeVDyXo95J4knbpjLPgUDpRF8Kml47CwFd8Ena4h', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 OPR/117.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVElGd3NLRTVxV0E4d2VPMFFjYkFNRVlXYmppOEdZYTk0RGxTN2lEOCI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3RyYW5zYWN0aW9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1746501649),
('XN44rQm4HsBbcMajP4gjL4V4i0WcfoQ5s25bL4f3', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 OPR/117.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZWg1Q2sxY3hhV1ZMN01hVGxHR1ZkSFVzS3lBZlNMdGpTcWV4bGVOdSI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3RyYW5zYWN0aW9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1746491576),
('zbSA9Tb1RNKr2sIBrZdjuNEu2JOQAAS3ZdYXTmpH', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 OPR/117.0.0.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiWDFCRVdJOXlTTzJxcDZ5OExHYjV4NXBvVWIzbUNsWUljQVN1Y2wzaiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1746448546);

-- --------------------------------------------------------

--
-- Table structure for table `stock_ins`
--

CREATE TABLE `stock_ins` (
  `stockin_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `stock_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity_added` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_ins`
--

INSERT INTO `stock_ins` (`stockin_id`, `product_id`, `stock_order_id`, `supplier_id`, `quantity_added`, `created_at`, `updated_at`) VALUES
(64, 1, 34, 3, 15, '2025-04-01 11:43:45', '2025-04-01 11:43:45'),
(65, 4, 34, 3, 13, '2025-04-01 11:43:45', '2025-04-01 11:43:45'),
(66, 3, 35, 5, 10, '2025-04-01 11:44:09', '2025-04-01 11:44:09'),
(67, 1, 36, 3, 3, '2025-04-01 19:57:20', '2025-04-01 19:57:20'),
(68, 3, 36, 3, 3, '2025-04-01 19:57:20', '2025-04-01 19:57:20'),
(69, 1, 37, 2, 1, '2025-04-01 20:06:26', '2025-04-01 20:06:26'),
(70, 1, 37, 2, 1, '2025-04-01 20:06:26', '2025-04-01 20:06:26'),
(71, 9, 38, 4, 20, '2025-05-05 04:38:39', '2025-05-05 04:38:39');

-- --------------------------------------------------------

--
-- Table structure for table `stock_orders`
--

CREATE TABLE `stock_orders` (
  `stock_order_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `reference_number` varchar(255) NOT NULL,
  `status` enum('draft','ordered','received','partial','cancelled') NOT NULL DEFAULT 'draft',
  `notes` text DEFAULT NULL,
  `expected_delivery_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_orders`
--

INSERT INTO `stock_orders` (`stock_order_id`, `user_id`, `supplier_id`, `reference_number`, `status`, `notes`, `expected_delivery_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(34, 1, 3, 'PO-67EC41F1E10A5', 'cancelled', NULL, NULL, '2025-04-01 11:43:45', '2025-04-01 20:00:05', NULL),
(35, 1, 5, 'PO-67EC42093BBEA', 'received', NULL, NULL, '2025-04-01 11:44:09', '2025-04-01 11:46:03', NULL),
(36, 1, 3, 'PO-67ECB5A0DBF00', 'ordered', NULL, NULL, '2025-04-01 19:57:20', '2025-04-01 20:01:08', NULL),
(37, 1, 2, 'PO-67ECB7C2D3522', 'ordered', NULL, NULL, '2025-04-01 20:06:26', '2025-04-01 20:06:40', NULL),
(38, 1, 4, 'PO-6818B14F58235', 'received', NULL, NULL, '2025-05-05 04:38:39', '2025-05-05 04:38:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact_number` varchar(12) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `name`, `contact_number`, `created_at`, `updated_at`, `location`) VALUES
(2, 'NCCC', '09112318310', '2025-03-30 11:03:05', '2025-04-01 10:36:28', 'Calinan'),
(3, 'Gaisano', '01923803103', '2025-04-01 09:33:26', '2025-04-01 09:33:26', 'Maa'),
(4, 'S&R', '09833192381', '2025-04-01 10:35:56', '2025-04-01 10:35:56', 'Maa'),
(5, 'Felcris', '09638172381', '2025-04-01 10:36:23', '2025-04-01 10:36:23', 'Calinan');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `total_with_tax` decimal(10,2) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `total`, `discount`, `total_with_tax`, `payment_method`, `payment_amount`, `created_at`, `updated_at`) VALUES
(1, 105.00, 0.00, 117.60, 'card', 200.00, '2025-05-05 05:56:49', '2025-05-05 05:56:49'),
(2, 105.00, 0.00, 117.60, 'card', 200.00, '2025-05-05 05:57:38', '2025-05-05 05:57:38'),
(3, 105.00, 0.00, 117.60, 'cash', 200.00, '2025-05-05 05:57:43', '2025-05-05 05:57:43'),
(4, 105.00, 0.00, 117.60, 'cash', 200.00, '2025-05-05 05:58:12', '2025-05-05 05:58:12'),
(5, 105.00, 0.00, 117.60, 'card', 1000.00, '2025-05-05 06:06:08', '2025-05-05 06:06:08'),
(6, 54.00, 0.00, 60.48, 'card', 100.00, '2025-05-05 06:10:13', '2025-05-05 06:10:13'),
(7, 90.00, 0.00, 100.80, 'cash', 1000.00, '2025-05-05 06:10:53', '2025-05-05 06:10:53'),
(8, 69.00, 0.00, 77.28, 'cash', 500.00, '2025-05-05 06:12:16', '2025-05-05 06:12:16'),
(9, 18.00, 0.00, 20.16, 'cash', 100.00, '2025-05-05 06:13:40', '2025-05-05 06:13:40'),
(10, 108.00, 0.00, 120.96, 'cash', 500.00, '2025-05-05 06:15:31', '2025-05-05 06:15:31'),
(11, 54.00, 0.00, 60.48, 'cash', 300.00, '2025-05-05 06:19:55', '2025-05-05 06:19:55');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_items`
--

CREATE TABLE `transaction_items` (
  `transaction_item_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_items`
--

INSERT INTO `transaction_items` (`transaction_item_id`, `transaction_id`, `product_id`, `quantity`, `price`, `discount`, `created_at`, `updated_at`) VALUES
(1, 5, 3, 5, 18.00, 0.00, '2025-05-05 06:06:08', '2025-05-05 06:06:08'),
(2, 5, 2, 1, 15.00, 0.00, '2025-05-05 06:06:08', '2025-05-05 06:06:08'),
(3, 6, 3, 3, 18.00, 0.00, '2025-05-05 06:10:13', '2025-05-05 06:10:13'),
(4, 7, 3, 5, 18.00, 0.00, '2025-05-05 06:10:53', '2025-05-05 06:10:53'),
(5, 8, 3, 3, 18.00, 0.00, '2025-05-05 06:12:16', '2025-05-05 06:12:16'),
(6, 8, 2, 1, 15.00, 0.00, '2025-05-05 06:12:16', '2025-05-05 06:12:16'),
(7, 9, 3, 1, 18.00, 0.00, '2025-05-05 06:13:40', '2025-05-05 06:13:40'),
(8, 10, 3, 6, 18.00, 0.00, '2025-05-05 06:15:31', '2025-05-05 06:15:31'),
(9, 11, 3, 3, 18.00, 0.00, '2025-05-05 06:19:55', '2025-05-05 06:19:55');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'ron', 'ronaldculas27@gmail.com', NULL, '$2y$12$7N.r.cfCRgU7lBuNpdIrtOzebPUiyZLa44N2cy0gco66b3YFEKZjO', 'F5N67ocwFkcBwEghEVdX2STR9uYJIrfxQZgJEu5gCjlckGVXN99BcWZriYUY', '2025-03-30 11:01:24', '2025-03-30 11:01:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `categories_category_name_unique` (`category_name`);

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
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `products_barcode_unique` (`barcode`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stock_ins`
--
ALTER TABLE `stock_ins`
  ADD PRIMARY KEY (`stockin_id`),
  ADD KEY `fk_stockins_product` (`product_id`),
  ADD KEY `fk_stockins_stockorder` (`stock_order_id`),
  ADD KEY `fk_stockins_supplier` (`supplier_id`);

--
-- Indexes for table `stock_orders`
--
ALTER TABLE `stock_orders`
  ADD PRIMARY KEY (`stock_order_id`),
  ADD UNIQUE KEY `stock_orders_reference_number_unique` (`reference_number`),
  ADD KEY `stock_orders_user_id_foreign` (`user_id`),
  ADD KEY `stock_orders_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD PRIMARY KEY (`transaction_item_id`),
  ADD KEY `transaction_items_transaction_id_foreign` (`transaction_id`),
  ADD KEY `transaction_items_product_id_foreign` (`product_id`);

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
  MODIFY `category_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `stock_ins`
--
ALTER TABLE `stock_ins`
  MODIFY `stockin_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `stock_orders`
--
ALTER TABLE `stock_orders`
  MODIFY `stock_order_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transaction_items`
--
ALTER TABLE `transaction_items`
  MODIFY `transaction_item_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `products_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `stock_ins`
--
ALTER TABLE `stock_ins`
  ADD CONSTRAINT `fk_stockins_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_stockins_stockorder` FOREIGN KEY (`stock_order_id`) REFERENCES `stock_orders` (`stock_order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_stockins_supplier` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_ins_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `stock_ins_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`) ON DELETE SET NULL;

--
-- Constraints for table `stock_orders`
--
ALTER TABLE `stock_orders`
  ADD CONSTRAINT `stock_orders_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD CONSTRAINT `transaction_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_items_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`transaction_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
