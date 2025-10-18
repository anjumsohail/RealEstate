-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2025 at 08:17 AM
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
-- Database: `pinspk`
--

-- --------------------------------------------------------

--
-- Table structure for table `property_advertisements`
--

CREATE TABLE `property_advertisements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `town_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sector_id` bigint(20) UNSIGNED DEFAULT NULL,
  `block_id` bigint(20) UNSIGNED DEFAULT NULL,
  `purpose` enum('Sale','Rent') NOT NULL,
  `category` enum('Residential','Commercial') NOT NULL,
  `proptype` enum('Plot','Home','Apartment','Portion','Cottage') NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `area_size` decimal(10,2) NOT NULL,
  `size_unit` text NOT NULL,
  `positioning` enum('East Open','West Open','North Open','South Open') DEFAULT NULL,
  `front_face` varchar(255) DEFAULT NULL,
  `back_site` varchar(255) DEFAULT NULL,
  `demand_price` decimal(15,2) NOT NULL,
  `pricetype` varchar(255) DEFAULT NULL,
  `floor` varchar(255) DEFAULT NULL,
  `bedrooms` varchar(255) DEFAULT NULL,
  `consage` varchar(255) DEFAULT NULL,
  `conscond` varchar(255) DEFAULT NULL,
  `postas` varchar(255) DEFAULT NULL,
  `social` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_advertisements`
--

INSERT INTO `property_advertisements` (`id`, `city_id`, `town_id`, `sector_id`, `block_id`, `purpose`, `category`, `proptype`, `title`, `description`, `address`, `latitude`, `longitude`, `area_size`, `size_unit`, `positioning`, `front_face`, `back_site`, `demand_price`, `pricetype`, `floor`, `bedrooms`, `consage`, `conscond`, `postas`, `social`, `user_id`, `created_at`, `updated_at`) VALUES
(53, 1, 13, 445, 870, 'Sale', 'Residential', 'Plot', 'Golden Urban house for Sell', 'Best Location', 'Main University Road Safoora', 24.9429278, 67.1591958, 240.00, 'Sqf', 'East Open', 'Main Road', 'Playgound', 12000.00, 'Total Price', NULL, '3', NULL, NULL, 'Individual', 'Y', 1, '2025-10-02 00:00:36', '2025-10-02 00:00:36'),
(54, 1, 13, 17, 143, 'Rent', 'Residential', 'Plot', 'Golden Urban house for Rent', 'Good Location', 'Near Safoora', 24.9417890, 67.1628307, 250.00, 'Sqy', 'North Open', 'Apartment', 'Park', 18000.00, 'Own Price', NULL, '4', NULL, NULL, 'Individual', 'Y', 1, '2025-10-02 00:02:43', '2025-10-02 00:02:43'),
(55, 1, 3, 28, NULL, 'Rent', 'Residential', 'Home', '120 Sqft Luxary Home', 'Best Location, Gated Community', 'Gulistan e Johar Blk 7, Safoora', 24.9392926, 67.1624279, 120.00, 'Sqf', 'East Open', 'Main Road', 'Mosque', 12000.00, 'Total Price', NULL, '3', 'New', 'Normal', 'Individual', 'Y', 1, '2025-10-07 23:15:58', '2025-10-07 23:15:58'),
(56, 1, 2, NULL, NULL, 'Sale', 'Residential', 'Cottage', '150 Yards Cottage, Part  view', 'Road Facing, Good Location', 'Blk-7, Safoora, Gulzar Hijri', 24.9437482, 67.1487164, 150.00, 'Sqy', 'East Open', 'Mosque', 'Jinnah Avenue', 200000.00, 'Own Price', '2nd', NULL, 'New', 'Demolish', 'Individual', 'Y', 1, '2025-10-07 23:20:32', '2025-10-07 23:20:32'),
(57, 1, 3, 28, 168, 'Rent', 'Residential', 'Apartment', '240 Sqft Prime Location', 'Best Value for Money', 'Sunlay Apartments Safoora', 24.9445848, 67.1662045, 240.00, 'Sqf', 'West Open', 'Homes', 'Compound', 25000.00, 'Booking Price', '2nd', NULL, 'New', 'Renovated', 'Individual', 'Y', 1, '2025-10-07 23:22:43', '2025-10-07 23:22:43'),
(58, 1, 2, NULL, NULL, 'Sale', 'Residential', 'Home', '80 Yards Home', 'New Location, Park Facing', 'Saima Presidency', 24.9414718, 67.1569347, 80.00, 'Sqy', 'North Open', 'Park', 'Park', 9800.00, 'Own Price', NULL, '2', 'New', 'Demolish', 'Individual', 'Y', 1, '2025-10-07 23:24:23', '2025-10-07 23:24:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `property_advertisements`
--
ALTER TABLE `property_advertisements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_advertisements_user_id_foreign` (`user_id`),
  ADD KEY `property_advertisements_city_id_foreign` (`city_id`),
  ADD KEY `property_advertisements_town_id_foreign` (`town_id`),
  ADD KEY `property_advertisements_sector_id_foreign` (`sector_id`),
  ADD KEY `property_advertisements_block_id_foreign` (`block_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `property_advertisements`
--
ALTER TABLE `property_advertisements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `property_advertisements`
--
ALTER TABLE `property_advertisements`
  ADD CONSTRAINT `property_advertisements_block_id_foreign` FOREIGN KEY (`block_id`) REFERENCES `blocks` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `property_advertisements_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `property_advertisements_sector_id_foreign` FOREIGN KEY (`sector_id`) REFERENCES `sectors` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `property_advertisements_town_id_foreign` FOREIGN KEY (`town_id`) REFERENCES `towns` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `property_advertisements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
