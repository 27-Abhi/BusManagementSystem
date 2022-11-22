-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2022 at 12:32 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test4`
--

-- --------------------------------------------------------

--
-- Table structure for table `bus_details`
--

CREATE TABLE `bus_details` (
  `bus_no` int(11) NOT NULL,
  `trip_no` int(11) NOT NULL,
  `route` varchar(255) DEFAULT NULL,
  `TripDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `phone_no` int(11) DEFAULT NULL,
  `ticket_id` int(11) NOT NULL,
  `passenger_id` int(11) NOT NULL,
  `ticket_price` int(11) DEFAULT NULL,
  `passenger_route` varchar(255) DEFAULT NULL,
  `trip_no_passenger` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trip_incharge`
--

CREATE TABLE `trip_incharge` (
  `trip_no_incharge` int(11) DEFAULT NULL,
  `Driver_emp_id` int(11) NOT NULL,
  `Conductor_emp_id` int(11) NOT NULL,
  `scheduled_dept_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `scheduled_arr_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trip_real_details`
--

CREATE TABLE `trip_real_details` (
  `trip_no_real` int(11) DEFAULT NULL,
  `fuel` int(11) DEFAULT NULL,
  `arrival_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `departure_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `km_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trip_result`
--

CREATE TABLE `trip_result` (
  `trip_no_result` int(11) DEFAULT NULL,
  `revenue` int(11) DEFAULT NULL,
  `tickets_sold` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bus_details`
--
ALTER TABLE `bus_details`
  ADD PRIMARY KEY (`bus_no`,`trip_no`),
  ADD UNIQUE KEY `trip_no` (`trip_no`);

--
-- Indexes for table `passenger`
--
ALTER TABLE `passenger`
  ADD PRIMARY KEY (`ticket_id`,`passenger_id`),
  ADD UNIQUE KEY `trip_no_passenger` (`trip_no_passenger`);

--
-- Indexes for table `trip_incharge`
--
ALTER TABLE `trip_incharge`
  ADD PRIMARY KEY (`Driver_emp_id`,`Conductor_emp_id`),
  ADD KEY `trip_no_incharge` (`trip_no_incharge`);

--
-- Indexes for table `trip_real_details`
--
ALTER TABLE `trip_real_details`
  ADD KEY `trip_no_real` (`trip_no_real`);

--
-- Indexes for table `trip_result`
--
ALTER TABLE `trip_result`
  ADD KEY `trip_no_result` (`trip_no_result`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `passenger`
--
ALTER TABLE `passenger`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bus_details`
--
ALTER TABLE `bus_details`
  ADD CONSTRAINT `bus_details_ibfk_1` FOREIGN KEY (`trip_no`) REFERENCES `passenger` (`trip_no_passenger`);

--
-- Constraints for table `trip_incharge`
--
ALTER TABLE `trip_incharge`
  ADD CONSTRAINT `trip_incharge_ibfk_1` FOREIGN KEY (`trip_no_incharge`) REFERENCES `bus_details` (`trip_no`);

--
-- Constraints for table `trip_real_details`
--
ALTER TABLE `trip_real_details`
  ADD CONSTRAINT `trip_real_details_ibfk_1` FOREIGN KEY (`trip_no_real`) REFERENCES `bus_details` (`trip_no`);

--
-- Constraints for table `trip_result`
--
ALTER TABLE `trip_result`
  ADD CONSTRAINT `trip_result_ibfk_1` FOREIGN KEY (`trip_no_result`) REFERENCES `bus_details` (`trip_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
