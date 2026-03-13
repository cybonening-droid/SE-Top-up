-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Mar 13, 2026 at 09:30 AM
-- Server version: 8.4.8
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `se_topup`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('ON','OFF') DEFAULT 'ON',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `name`, `image`, `status`, `created_at`) VALUES
(1, 'ROV', 'uploads/rov.jpg', 'ON', '2026-03-13 03:55:14'),
(2, 'Free Fire', 'uploads/freefire.png', 'ON', '2026-03-13 03:55:14'),
(3, 'PUBG Mobile', 'uploads/pubg.jpeg', 'ON', '2026-03-13 03:55:14'),
(4, 'Genshin Impact', 'uploads/genshin.jpg', 'ON', '2026-03-13 04:09:36'),
(6, 'P U N N', 'uploads/1773375570_sdsdadas.png', 'ON', '2026-03-13 04:19:30');

-- --------------------------------------------------------

--
-- Table structure for table `game_uids`
--

CREATE TABLE `game_uids` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `game_id` int NOT NULL,
  `uid` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `game_uids`
--

INSERT INTO `game_uids` (`id`, `user_id`, `game_id`, `uid`, `created_at`) VALUES
(1, 1, 1, '123456789', '2026-03-13 04:06:13'),
(2, 1, 1, '987654321', '2026-03-13 04:06:13'),
(3, 2, 2, '555666777', '2026-03-13 04:06:13');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `package_id` int NOT NULL,
  `game_uid` varchar(100) NOT NULL,
  `status` enum('pending','success','cancel') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `package_id`, `game_uid`, `status`, `created_at`) VALUES
(9, 1, 1, '123456789', 'success', '2026-03-11 04:30:00'),
(10, 2, 2, '987654321', 'success', '2026-03-12 04:04:30'),
(11, 3, 3, '555666777', 'cancel', '2026-03-13 04:04:30'),
(12, 1, 4, '888999000', 'success', '2026-03-13 04:04:30'),
(15, 4, 8, '800123456', 'pending', '2026-03-13 04:11:24'),
(16, 4, 9, '800123456', 'success', '2026-03-13 04:11:24'),
(17, 4, 10, '800987654', 'success', '2026-03-13 04:11:24');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int NOT NULL,
  `game_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` enum('ON','OFF') DEFAULT 'ON',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `game_id`, `name`, `price`, `status`, `created_at`) VALUES
(1, 1, '60 UC', 30.00, 'ON', '2026-03-13 04:03:10'),
(2, 1, '300 UC', 149.00, 'ON', '2026-03-13 04:03:10'),
(3, 2, '100 Diamonds', 50.00, 'ON', '2026-03-13 04:03:10'),
(4, 3, '325 UC', 150.00, 'ON', '2026-03-13 04:03:10'),
(8, 4, '60 Genesis Crystals', 29.00, 'ON', '2026-03-13 04:09:55'),
(9, 4, '300 Genesis Crystals', 149.00, 'ON', '2026-03-13 04:09:55'),
(10, 4, '980 Genesis Crystals', 449.00, 'ON', '2026-03-13 04:09:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `balance` decimal(10,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `phone`, `balance`, `created_at`) VALUES
(1, 'player1', '1234', 'player1@email.com', '0811111111', 500.00, '2026-03-13 04:02:12'),
(2, 'player2', '1234', 'player2@email.com', '0822222222', 300.00, '2026-03-13 04:02:12'),
(3, 'gamerx', '1234', 'gamerx@email.com', '0833333333', 1000.00, '2026-03-13 04:02:12'),
(4, 'traveler', '1234', 'traveler@email.com', '0812345678', 500.00, '2026-03-13 04:10:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game_uids`
--
ALTER TABLE `game_uids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `game_uids`
--
ALTER TABLE `game_uids`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `game_uids`
--
ALTER TABLE `game_uids`
  ADD CONSTRAINT `game_uids_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `game_uids_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`);

--
-- Constraints for table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
