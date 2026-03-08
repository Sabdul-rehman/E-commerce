-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2026 at 04:16 PM
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
-- Database: `ecommerce`
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
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `Cid` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `session_id`, `Cid`, `size`, `type`, `quantity`, `created_at`, `updated_at`) VALUES
(35, NULL, 'XaQoF0oJAEqQ4sSIJTyyfFcX8AzWiI1bVYAFgz7X', 38, 'Medium', 'Embroidery', 1, '2026-03-05 10:34:47', '2026-03-05 10:34:47');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `Cid` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `old_price` decimal(10,2) DEFAULT NULL,
  `description` text NOT NULL,
  `size` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `homepage_choice` varchar(255) NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `category` varchar(255) NOT NULL,
  `availability` enum('In Stock','Out of Stock') NOT NULL DEFAULT 'In Stock',
  `sku` varchar(255) NOT NULL,
  `fabric` varchar(255) DEFAULT NULL,
  `style_detail` varchar(255) DEFAULT NULL,
  `care` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`Cid`, `product_name`, `price`, `old_price`, `description`, `size`, `type`, `homepage_choice`, `quantity`, `category`, `availability`, `sku`, `fabric`, `style_detail`, `care`, `color`, `image`, `created_at`, `updated_at`) VALUES
(32, 'Elegant Lawn Suit – Stitched', 4500.00, 4000.00, 'dsfg argaer', '[\"Small\",\"Medium\"]', '[\"Unstitched\",\"Embroidery\"]', '[\"Featured Product\",\"Bestsellers of the Month\"]', 1, 'Ladies Clothing', 'In Stock', 'AN-LC-345', 'Lawn', 'Stitched / Unstitched', 'Hand wash recommended', 'As shown', '[\"1771686926_p1.webp\",\"1771686926_p2.webp\",\"1771686926_p3.webp\",\"1771686926_p11.webp\"]', '2026-02-21 10:15:26', '2026-02-21 10:15:26'),
(33, 'cotton suite', 1500.00, NULL, 'asfra argfa', '[\"Medium\",\"XL\",\"XXL\"]', '[\"Stitched\",\"Unstitched\",\"Embroidery\"]', '[\"Featured Product\",\"Bestsellers of the Month\"]', 1, 'Ladies Clothing', 'In Stock', 'AN-LC-', 'Lawn', 'Stitched / Unstitched', 'Hand wash recommended', 'As shown', '[\"1771686972_p51.webp\",\"1771686972_p52.jpg\",\"1771686972_p53.jpg\",\"1771686972_p54.jpg\",\"1771686972_p55.jpg\"]', '2026-02-21 10:16:12', '2026-03-02 13:27:20'),
(34, 'linen and lawn', 4500.00, NULL, 'asdf adgf', '[\"Small\",\"Medium\",\"Large\"]', '[\"Stitched\",\"Unstitched\",\"Embroidery\"]', '[\"Featured Product\",\"Bestsellers of the Month\"]', 1, 'Ladies Clothing', 'In Stock', 'AN-LC-1345', 'Lawn', 'Stitched / Unstitched', 'Hand wash recommended', 'As shown', '[\"1771687010_p41.webp\",\"1771687010_p42.webp\",\"1771687010_p43.webp\",\"1771687010_p44.webp\",\"1771687010_p45.webp\"]', '2026-02-21 10:16:50', '2026-02-21 10:16:50'),
(35, 'cotton suite', 4500.00, NULL, 'darfgera', '[\"Small\",\"Medium\",\"Large\",\"XL\",\"XXL\",\"XXXL\"]', '[\"Stitched\",\"Unstitched\",\"Embroidery\"]', '[\"Featured Product\",\"Bestsellers of the Month\"]', 1, 'Ladies Clothing', 'In Stock', 'AN-LC-256', 'Lawn', 'Stitched / Unstitched', 'Hand wash recommended', NULL, '[\"1771687053_p31.webp\",\"1771687053_p32.jpg\",\"1771687053_p33.jpg\",\"1771687053_p34.webp\",\"1771687053_p35.webp\",\"1771687053_p36.webp\"]', '2026-02-21 10:17:33', '2026-02-21 10:17:33'),
(36, 'Elegant Lawn Suit – Stitched', 3500.00, NULL, 'erhge', '[\"Small\",\"Medium\",\"Large\"]', '[\"Stitched\",\"Unstitched\",\"Embroidery\"]', '[\"Featured Product\",\"Bestsellers of the Month\"]', 1, 'Ladies Clothing', 'Out of Stock', 'AN-LC-43654', 'Lawn', 'Stitched / Unstitched', 'Hand wash recommended', NULL, '[\"1771687101_p11.webp\",\"1771687101_p12.webp\",\"1771687101_p13.webp\",\"1771687101_p14.webp\",\"1771687101_p15.webp\"]', '2026-02-21 10:18:21', '2026-02-21 10:18:21'),
(37, 'Elegant Lawn Suit – Stitched', 3500.00, NULL, 'zfdgafg', '[\"Small\",\"Large\",\"XXL\"]', '[\"Stitched\",\"Unstitched\"]', '[\"Featured Product\",\"Bestsellers of the Month\"]', 1, 'Ladies Clothing', 'In Stock', 'AN-LC-352', NULL, NULL, NULL, NULL, '[\"1772475964_p51.webp\",\"1772475964_p52.jpg\",\"1772475964_p53.jpg\",\"1772475964_p54.jpg\",\"1772475964_p55.jpg\"]', '2026-03-02 13:26:04', '2026-03-02 13:26:04'),
(38, 'Elegant Lawn Suit – Stitched', 5000.00, 8000.00, 'lawn suit', '[\"Small\",\"Medium\",\"Large\",\"XXXL\"]', '[\"Stitched\",\"Unstitched\",\"Embroidery\"]', '[\"Featured Product\",\"Bestsellers of the Month\"]', 1, 'Ladies Clothing', 'In Stock', 'AN-LC-954', 'Lawn', 'Stitched / Unstitched', 'Hand wash recommended', 'As shown', '[\"1772563260_p51.webp\",\"1772563260_p52.jpg\",\"1772563260_p53.jpg\",\"1772563260_p54.jpg\",\"1772563260_p55.jpg\"]', '2026-03-03 13:41:00', '2026-03-03 13:41:00');

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
(4, '2026_02_08_160819_create_categories_table', 1),
(5, '2026_02_12_162933_update_categories_table', 2),
(6, '2026_02_15_090810_create_carts_table', 3),
(7, '2026_02_21_120000_create_orders_table', 4),
(8, '2026_02_21_120100_create_order_items_table', 4),
(9, '2026_02_26_000000_add_role_to_users_table', 5),
(10, '2026_03_04_174801_create_reviews_table', 6),
(11, '2026_03_05_120000_add_approval_fields_to_reviews_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `order_number` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_phone` varchar(30) NOT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `shipping_address` text NOT NULL,
  `shipping_city` varchar(100) NOT NULL,
  `payment_method` varchar(30) NOT NULL DEFAULT 'COD',
  `subtotal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `delivery_charges` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` varchar(30) NOT NULL DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `session_id`, `order_number`, `customer_name`, `customer_phone`, `customer_email`, `shipping_address`, `shipping_city`, `payment_method`, `subtotal`, `delivery_charges`, `discount`, `total_amount`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(2, NULL, 'jFpqXVtWLJR0lZzMUWR3zA5QuZ911OPLp00OvPw0', 'ORD-LCWOWEQI8A', 'Zain', '03282736122', 'araptech273@gmail.com', 'Nazimabad 5-c , Karachi', 'Lahore', 'COD', 9000.00, 0.00, 0.00, 9000.00, 'completed', NULL, '2026-02-22 07:54:37', '2026-03-02 13:24:10'),
(3, 7, NULL, 'ORD-VZKA2PSW77', 'Ali', '0358465982', 'ali@gmail.com', '9/16 nazimabad', 'queeta', 'COD', 8000.00, 0.00, 0.00, 8000.00, 'pending', NULL, '2026-02-25 10:27:43', '2026-03-02 13:25:05'),
(4, 7, NULL, 'ORD-PPAMPFD2DG', 'zain', '03268859571', 'zain@gmail.com', 'DHA', 'karachi', 'COD', 1500.00, 200.00, 0.00, 1700.00, 'dispatched', NULL, '2026-03-02 13:29:00', '2026-03-03 13:38:14'),
(5, 9, NULL, 'ORD-JAAXW3M3A1', 'ar', '0359295795', 'ar@gmail.com', 'DHA', 'karachi', 'COD', 4500.00, 0.00, 0.00, 4500.00, 'pending', NULL, '2026-03-03 13:19:35', '2026-03-03 13:39:21'),
(6, 7, NULL, 'ORD-4BYXVZAQMD', 'Syed Abdul Rehman', '03282736122', 'araptech273@gmail.com', 'Nazimabad 5-c , Karachi', 'karachi', 'COD', 1500.00, 200.00, 0.00, 1700.00, 'pending', NULL, '2026-03-05 10:36:31', '2026-03-05 10:36:31');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `Cid` bigint(20) UNSIGNED NOT NULL,
  `product_name_snapshot` varchar(255) NOT NULL,
  `price_snapshot` decimal(10,2) NOT NULL,
  `size` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `line_total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `Cid`, `product_name_snapshot`, `price_snapshot`, `size`, `type`, `quantity`, `line_total`, `created_at`, `updated_at`) VALUES
(1, 2, 35, 'cotton suite', 4500.00, 'Large', 'Embroidery', 1, 4500.00, '2026-02-22 07:54:37', '2026-02-22 07:54:37'),
(2, 2, 34, 'linen and lawn', 4500.00, 'Medium', 'Stitched', 1, 4500.00, '2026-02-22 07:54:37', '2026-02-22 07:54:37'),
(3, 3, 33, 'cotton suite', 3500.00, 'Medium', 'Stitched', 1, 3500.00, '2026-02-25 10:27:43', '2026-02-25 10:27:43'),
(4, 3, 35, 'cotton suite', 4500.00, 'Medium', 'Stitched', 1, 4500.00, '2026-02-25 10:27:43', '2026-02-25 10:27:43'),
(5, 4, 33, 'cotton suite', 1500.00, 'Medium', 'Stitched', 1, 1500.00, '2026-03-02 13:29:00', '2026-03-02 13:29:00'),
(6, 5, 34, 'linen and lawn', 4500.00, 'Medium', 'Stitched', 1, 4500.00, '2026-03-03 13:19:35', '2026-03-03 13:19:35'),
(7, 6, 33, 'cotton suite', 1500.00, 'XL', 'Embroidery', 1, 1500.00, '2026-03-05 10:36:31', '2026-03-05 10:36:31');

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
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL COMMENT 'Rating from 1 to 5',
  `comment` text DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `rating`, `comment`, `status`, `approved_by`, `approved_at`, `created_at`, `updated_at`) VALUES
(1, 7, 33, 4, 'zsrg', 'approved', 7, '2026-03-05 11:44:46', '2026-03-05 11:33:17', '2026-03-05 11:44:46');

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
  `role` varchar(20) NOT NULL DEFAULT 'customer',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(7, 'Syed Abdul Rehman', 'araptech273@gmail.com', NULL, '$2y$12$5GElhmcurpSm56w4PNockOvt0OUe6VjFsKVy1Vpf2RrXxIotMInPu', 'admin', 'Ov2LfXx5RZBIyrbXwQn1TEjtqRjulaOsRkOwbRIakBzd0robIrtPuU5Vlcfg', '2026-02-09 16:22:34', '2026-02-09 16:22:34'),
(8, 'ali', 'ali@gmail.com', NULL, '$2y$12$KYTBYmUUnnMPHgFd2y5cD.pEEtnwMqRWyAhj/kaIeIP0qv4Dz.owi', 'customer', NULL, '2026-02-25 10:41:21', '2026-02-25 10:41:21'),
(9, 'AR', 'ar@gmail.com', NULL, '$2y$12$CXhP2X2zDVwVFw9i9o1IXOWP/xn5oPUezgkch8CFwFeGAS0oIBOoa', 'customer', NULL, '2026-03-03 13:15:21', '2026-03-03 13:15:21');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_cid_foreign` (`Cid`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`Cid`),
  ADD UNIQUE KEY `categories_sku_unique` (`sku`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_cid_foreign` (`Cid`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`),
  ADD KEY `reviews_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `Cid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_cid_foreign` FOREIGN KEY (`Cid`) REFERENCES `categories` (`Cid`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_cid_foreign` FOREIGN KEY (`Cid`) REFERENCES `categories` (`Cid`),
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `categories` (`Cid`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
