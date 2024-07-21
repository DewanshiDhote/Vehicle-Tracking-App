-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2024 at 05:25 PM
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
-- Database: `ip_address_trace`
--

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `vehicle_name` varchar(255) NOT NULL,
  `vehicle_number_plate` varchar(255) NOT NULL,
  `user_ip_address` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `vehicle_name`, `vehicle_number_plate`, `user_ip_address`, `created_at`) VALUES
(7, 'Audi', '6583', '103.183.91.73', '2024-07-09 08:12:16'),
(8, 'Alto', '657765', '172.70.142.209', '2024-07-09 08:13:01'),
(9, 'Audi', '79', '103.183.91.73', '2024-07-09 08:17:36');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_locations`
--

CREATE TABLE `vehicle_locations` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `recorded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `vehicle_locations`
--

INSERT INTO `vehicle_locations` (`id`, `vehicle_id`, `latitude`, `longitude`, `recorded_at`) VALUES
(4, 7, 21.1458, 79.08816, '2024-07-09 08:12:16'),
(5, 8, 1.29041, 103.85211, '2024-07-09 08:13:01'),
(6, 9, 21.1458, 79.08816, '2024-07-09 08:17:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_locations`
--
ALTER TABLE `vehicle_locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_id` (`vehicle_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `vehicle_locations`
--
ALTER TABLE `vehicle_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `vehicle_locations`
--
ALTER TABLE `vehicle_locations`
  ADD CONSTRAINT `vehicle_locations_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
