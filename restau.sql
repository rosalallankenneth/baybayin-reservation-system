-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2020 at 04:53 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restau`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `email` varchar(100) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`email`, `lastname`, `firstname`, `mobile`, `password`) VALUES
('allankenneth143@gmail.com', 'Rosal', 'Allan Kenneth', '09059563057', '$2y$10$FWcpDG0fEc7MKjfJfkrI1.IycdTf/7Ytg7NKUHUzmHjDHSLi.8SIi'),
('sample@email.com', 'Sam', 'Sample Name', '09099990099', '$2y$10$LPz.I4mh36UmXqYzB2d80OBgFocYO2ZZbbymLJx7dTgzJ4CS.rDau');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date` varchar(50) NOT NULL,
  `time` varchar(20) NOT NULL,
  `type` int(2) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'PENDING'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `email`, `date`, `time`, `type`, `status`) VALUES
(2, 'allankenneth143@gmail.com', '2020-04-22', '12PM - 1PM', 1, 'PENDING'),
(3, 'allankenneth143@gmail.com', '2020-04-22', '9PM - 10PM', 6, 'PENDING'),
(4, 'allankenneth143@gmail.com', '2020-04-24', '8AM - 9AM', 12, 'PENDING'),
(5, 'sample@email.com', '2020-04-20', '9AM - 10AM', 2, 'CANCELED'),
(6, 'sample@email.com', '2020-04-30', '11AM - 12PM', 4, 'PENDING'),
(7, 'sample@email.com', '2020-04-21', '5PM - 6PM', 4, 'CONFIRMED');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `contact_no` (`mobile`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
