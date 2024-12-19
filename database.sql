-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 19, 2024 at 05:15 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `symfony`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `long_description` longtext COLLATE utf8mb4_unicode_ci,
  `price` double DEFAULT NULL,
  `supplier_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `name`, `short_description`, `long_description`, `price`, `supplier_id`) VALUES
(1, 'Activity 1', 'Short description of activity 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum vestibulum.', 50, 1),
(2, 'Activity 2', 'Short description of activity 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam tincidunt sit amet risus eu fermentum.', 75, 2),
(3, 'Activity 3', 'Short description of activity 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vehicula orci at odio malesuada auctor.', 100, 3),
(4, 'Activity 4', 'Short description of activity 4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae nisi sit amet libero interdum commodo.', 125, 4),
(5, 'Activity 5', 'Short description of activity 5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ac nunc libero.', 150, 5),
(6, 'Activity 6', 'Short description of activity 6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque habitant morbi tristique senectus.', 175, 6),
(7, 'Activity 7', 'Short description of activity 7', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur venenatis eu nisi vel blandit.', 200, 7),
(8, 'Activity 8', 'Short description of activity 8', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce pharetra nisi id ligula venenatis, eu tincidunt enim malesuada.', 225, 8),
(9, 'Test', 'Short description of activity 9', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel lacus tincidunt, aliquam lorem sed, fermentum nulla.', 250, 9),
(10, 'Activity 10', 'Short description of activity 10', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut aliquam urna sit amet neque sollicitudin vehicula.', 275, NULL),
(11, 'Hiking Adventure', 'A short trip to the mountains', 'An amazing hiking adventure through scenic trails in the mountains. Suitable for all skill levels.', 49.99, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20241219133533', '2024-12-19 13:36:50', 28),
('DoctrineMigrations\\Version20241219133642', '2024-12-19 14:40:46', 27),
('DoctrineMigrations\\Version20241219143828', '2024-12-19 14:40:46', 33);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`) VALUES
(1, 'Supplier 1'),
(2, 'Supplier 2'),
(3, 'Supplier 3'),
(4, 'Supplier 4'),
(5, 'Supplier 5'),
(6, 'Supplier 6'),
(7, 'Supplier 7'),
(8, 'Supplier 8'),
(9, 'Supplier 9'),
(10, 'Supplier 10');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`) VALUES
(1, 'testuser', '$2y$13$JMWWpuqP1tB8yXZttHg2w.0BEVOQP7CZkByMEiy8hYHdArQMOQcei');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_AC74095A2ADD6D8C` (`supplier_id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `FK_AC74095A2ADD6D8C` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
