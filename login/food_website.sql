-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2024 at 03:50 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `favfood`
--

CREATE TABLE `favfood` (
  `favfoodno` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `favfood` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `email`, `pass`) VALUES
('ayan2003', 'ayankoley339@gmail.com', '111111'),
('subha18', 'subhadas18@gmail.com', '1111');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_no` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `review` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_no`, `username`, `review`) VALUES
(1, 'subha18', 'Lovely work');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favfood`
--
ALTER TABLE `favfood`
  ADD PRIMARY KEY (`favfoodno`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_no`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favfood`
--
ALTER TABLE `favfood`
  MODIFY `favfoodno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favfood`
--
ALTER TABLE `favfood`
  ADD CONSTRAINT `favfood_ibfk_1` FOREIGN KEY (`username`) REFERENCES `login` (`username`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`username`) REFERENCES `login` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;