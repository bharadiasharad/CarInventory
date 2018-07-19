-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 20, 2018 at 01:19 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_inventory_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `car_company`
--

CREATE TABLE `car_company` (
  `car_company_id` int(11) NOT NULL,
  `car_company_name` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `car_company`
--

INSERT INTO `car_company` (`car_company_id`, `car_company_name`) VALUES
(115, 'Audi'),
(116, 'Volvo '),
(117, 'BMW'),
(118, 'Honda'),
(119, 'Hyundai'),
(120, 'TATA');

-- --------------------------------------------------------

--
-- Table structure for table `car_model`
--

CREATE TABLE `car_model` (
  `car_model_id` int(11) NOT NULL,
  `car_company_id` int(11) NOT NULL,
  `car_model_name` varchar(50) NOT NULL,
  `car_model_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `car_model`
--

INSERT INTO `car_model` (`car_model_id`, `car_company_id`, `car_model_name`, `car_model_count`) VALUES
(74, 115, 'Audi R8 Coupe', 0),
(75, 115, 'Audi Q2', 4),
(76, 116, 'Volvo V60 Cross Country', 8),
(77, 116, 'Volvo S60 Cross Country', 2),
(78, 116, 'Volvo XC90', 13),
(79, 117, 'BMW 2-series Cabrio', 8),
(80, 117, 'BMW 2-series Gran Tourer', 32),
(81, 117, 'BMW X4', 3),
(82, 118, 'Honda Civic Tourer', 8),
(83, 118, 'Honda CR-Z', 7),
(84, 118, 'Honda Insight', 4),
(85, 118, 'Honda FR-V', 8),
(86, 118, 'Honda Accord Tourer', 3),
(87, 119, 'Hyundai Ioniq', 9),
(88, 119, 'Hyundai i20 Coupe', 1),
(89, 120, 'TATA Hexa', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car_company`
--
ALTER TABLE `car_company`
  ADD PRIMARY KEY (`car_company_id`);

--
-- Indexes for table `car_model`
--
ALTER TABLE `car_model`
  ADD PRIMARY KEY (`car_model_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car_company`
--
ALTER TABLE `car_company`
  MODIFY `car_company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `car_model`
--
ALTER TABLE `car_model`
  MODIFY `car_model_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
