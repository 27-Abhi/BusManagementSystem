-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2022 at 06:29 AM
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
  `Source` varchar(255) NOT NULL,
  `Destination` varchar(255) NOT NULL,
  `TripDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user_name`, `password`) VALUES
('', ''),
('C001', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `login_admin`
--

CREATE TABLE `login_admin` (
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login_admin`
--

INSERT INTO `login_admin` (`user_name`, `password`) VALUES
('admin', '12345678'),
('abhinav', 'abhinav'),
('navin', 'navin');

-- --------------------------------------------------------

--
-- Table structure for table `login_driver`
--

CREATE TABLE `login_driver` (
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login_driver`
--

INSERT INTO `login_driver` (`user_name`, `password`) VALUES
('', ''),
('D001', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `lossmaking`
--

CREATE TABLE `lossmaking` (
  `Trip_no` int(11) NOT NULL,
  `revenue` int(11) NOT NULL,
  `tickets_sold` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in structure for view `mileage`
-- (See below for the actual view)
--
CREATE TABLE `mileage` (
`bus_no` int(11)
,`MILAGE` decimal(18,8)
);

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `phone_no` varchar(255) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `ticket_price` int(11) NOT NULL,
  `Passenger_source` varchar(255) NOT NULL,
  `trip_no_passenger` int(11) NOT NULL,
  `Passenger_destination` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `quicktrips`
--

CREATE TABLE `quicktrips` (
  `Trip_no` int(11) NOT NULL,
  `fuel` int(11) NOT NULL,
  `arrival_time` int(11) NOT NULL,
  `departure_time` int(11) NOT NULL,
  `km_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in structure for view `revenueperbus`
-- (See below for the actual view)
--
CREATE TABLE `revenueperbus` (
`bus_no` int(11)
,`revenue` decimal(32,0)
,`tickets_sold` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `trip_incharge`
--

CREATE TABLE `trip_incharge` (
  `trip_no_incharge` int(11) NOT NULL,
  `Driver_emp_id` varchar(255) NOT NULL,
  `Conductor_emp_id` varchar(255) NOT NULL,
  `scheduled_dept_time` time NOT NULL,
  `scheduled_arr_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trip_real_details`
--

CREATE TABLE `trip_real_details` (
  `trip_no_real` int(11) NOT NULL,
  `fuel` int(11) NOT NULL,
  `arrival_time` time NOT NULL,
  `departure_time` time NOT NULL,
  `km_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `trip_real_details`
--
DELIMITER $$
CREATE TRIGGER `QuickTrips` AFTER INSERT ON `trip_real_details` FOR EACH ROW BEGIN IF NEW.arrival_time-NEW.departure_time<=3000 THEN 
INSERT INTO quicktrips(Trip_no,fuel,arrival_time,departure_time,km_count) VALUES(new.trip_no_real,new.fuel,new.arrival_time,new.departure_time,new.km_count);
END IF; END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `trip_result`
--

CREATE TABLE `trip_result` (
  `trip_no_result` int(11) NOT NULL,
  `revenue` int(11) NOT NULL,
  `tickets_sold` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `trip_result`
--
DELIMITER $$
CREATE TRIGGER `LowRevenue` AFTER INSERT ON `trip_result` FOR EACH ROW BEGIN
    IF NEW.revenue<1000 THEN
        INSERT INTO lossmaking(Trip_no,revenue,tickets_sold)
       VALUES(new.trip_no_result,new.revenue,new.tickets_sold);
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure for view `mileage`
--
DROP TABLE IF EXISTS `mileage`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `mileage`  AS SELECT `bus_details`.`bus_no` AS `bus_no`, avg(`trip_real_details`.`km_count` / `trip_real_details`.`fuel`) AS `MILAGE` FROM (`bus_details` join `trip_real_details` on(`trip_real_details`.`trip_no_real` = `bus_details`.`trip_no`)) GROUP BY `bus_details`.`bus_no``bus_no`  ;

-- --------------------------------------------------------

--
-- Structure for view `revenueperbus`
--
DROP TABLE IF EXISTS `revenueperbus`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `revenueperbus`  AS SELECT `bus_details`.`bus_no` AS `bus_no`, sum(`trip_result`.`revenue`) AS `revenue`, sum(`trip_result`.`tickets_sold`) AS `tickets_sold` FROM (`bus_details` join `trip_result` on(`trip_result`.`trip_no_result` = `bus_details`.`trip_no`)) GROUP BY `bus_details`.`bus_no``bus_no`  ;

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
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user_name`);

--
-- Indexes for table `passenger`
--
ALTER TABLE `passenger`
  ADD KEY `passenger_ibfk_1` (`trip_no_passenger`);

--
-- Indexes for table `trip_incharge`
--
ALTER TABLE `trip_incharge`
  ADD KEY `trip_incharge_ibfk_1` (`trip_no_incharge`);

--
-- Indexes for table `trip_real_details`
--
ALTER TABLE `trip_real_details`
  ADD KEY `trip_real_details_ibfk_1` (`trip_no_real`);

--
-- Indexes for table `trip_result`
--
ALTER TABLE `trip_result`
  ADD KEY `trip_result_ibfk_1` (`trip_no_result`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `passenger`
--
ALTER TABLE `passenger`
  ADD CONSTRAINT `passenger_ibfk_1` FOREIGN KEY (`trip_no_passenger`) REFERENCES `bus_details` (`trip_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trip_incharge`
--
ALTER TABLE `trip_incharge`
  ADD CONSTRAINT `trip_incharge_ibfk_1` FOREIGN KEY (`trip_no_incharge`) REFERENCES `bus_details` (`trip_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trip_real_details`
--
ALTER TABLE `trip_real_details`
  ADD CONSTRAINT `trip_real_details_ibfk_1` FOREIGN KEY (`trip_no_real`) REFERENCES `bus_details` (`trip_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trip_result`
--
ALTER TABLE `trip_result`
  ADD CONSTRAINT `trip_result_ibfk_1` FOREIGN KEY (`trip_no_result`) REFERENCES `bus_details` (`trip_no`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
