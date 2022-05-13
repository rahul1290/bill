<<<<<<< HEAD
-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2022 at 01:30 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bill_record`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `bill_id` int(255) NOT NULL,
  `sno_id` int(255) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `bill_no` varchar(30) NOT NULL,
  `date_of_bill` date NOT NULL,
  `due_date` date NOT NULL,
  `reading` float(10,2) NOT NULL,
  `reading_date` date NOT NULL,
  `power_consumption` float(10,2) DEFAULT NULL,
  `power_factor` varchar(200) DEFAULT NULL,
  `total_consumption` float(10,2) NOT NULL,
  `highest_demand_reading` float(10,2) DEFAULT NULL,
  `je_ae_name` varchar(50) NOT NULL,
  `je_ae_contact_no` varchar(15) NOT NULL,
  `ae_ee_name` varchar(50) NOT NULL,
  `ae_ee_contact_no` varchar(15) NOT NULL,
  `fixed_demand_charges` float(10,2) DEFAULT NULL,
  `minimum_charges` float(10,2) DEFAULT NULL,
  `energy_charges` float(10,2) DEFAULT NULL,
  `total_charges` float(10,2) NOT NULL,
  `electricity_duty` float(10,2) DEFAULT NULL,
  `cess` float(10,2) DEFAULT NULL,
  `welding_capacitor_overload` float(10,2) DEFAULT NULL,
  `meter_fare` float(10,2) DEFAULT NULL,
  `vca_charge` float(10,2) DEFAULT NULL,
  `security_deposit` float(10,2) DEFAULT NULL,
  `concession_amount` float(10,2) DEFAULT NULL,
  `total_bill` float(10,2) NOT NULL,
  `deviation_adjustment` float(10,2) DEFAULT NULL,
  `past_dues` float(10,2) NOT NULL,
  `security_fund_outstanding` float(10,2) DEFAULT NULL,
  `payable_amount` float(10,2) NOT NULL,
  `extra` float(10,2) DEFAULT NULL,
  `gross_amount` float(10,2) NOT NULL,
  `overload` float(10,2) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company_master`
--

CREATE TABLE `company_master` (
  `cid` int(255) NOT NULL,
  `name` varchar(300) NOT NULL,
  `address` varchar(500) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `alternet_no` varchar(15) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `created_at` date NOT NULL,
  `created_by` int(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_master`
--

INSERT INTO `company_master` (`cid`, `name`, `address`, `contact_no`, `alternet_no`, `email`, `created_at`, `created_by`, `status`) VALUES
(4, 'vnr-corporate', 'raipur ', '9770866241', NULL, NULL, '2022-02-19', 1, 1),
(5, 'vnr-plant', 'raipur ', '9770866241', NULL, NULL, '2022-02-19', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cost_center_master`
--

CREATE TABLE `cost_center_master` (
  `costc_id` int(255) NOT NULL,
  `company_id` int(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_by` int(255) NOT NULL,
  `created_at` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cost_center_master`
--

INSERT INTO `cost_center_master` (`costc_id`, `company_id`, `name`, `created_by`, `created_at`, `status`) VALUES
(4, 4, 'durg', 1, '2022-02-19', 0),
(5, 4, 'raipur', 1, '2022-02-19', 1),
(6, 4, 'dhamdha', 1, '2022-02-19', 1),
(7, 5, '123', 1, '2022-02-26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `location_master`
--

CREATE TABLE `location_master` (
  `loc_id` int(255) NOT NULL,
  `cost_center_id` int(255) NOT NULL,
  `name` varchar(200) NOT NULL,
  `created_by` int(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location_master`
--

INSERT INTO `location_master` (`loc_id`, `cost_center_id`, `name`, `created_by`, `created_at`, `status`) VALUES
(1, 5, 'bhilai', 1, '2022-02-19 00:00:00', 0),
(2, 5, 'sarona', 1, '2022-02-19 00:00:00', 1),
(3, 7, 'asd2', 1, '2022-02-26 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `meter_master`
--

CREATE TABLE `meter_master` (
  `mid` int(255) NOT NULL,
  `parent_meter` int(255) DEFAULT NULL,
  `bpno` varchar(100) NOT NULL,
  `mtype` enum('main-meter','sub-meter') NOT NULL DEFAULT 'main-meter',
  `cid` int(255) NOT NULL,
  `costc_id` int(255) NOT NULL,
  `loc_id` int(255) NOT NULL,
  `created_by` int(255) NOT NULL,
  `created_at` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meter_master`
--

INSERT INTO `meter_master` (`mid`, `parent_meter`, `bpno`, `mtype`, `cid`, `costc_id`, `loc_id`, `created_by`, `created_at`, `status`) VALUES
(1, NULL, 'bpno-123', 'main-meter', 4, 5, 2, 1, '2022-02-25', 1),
(2, 1, 'bpno-124', 'sub-meter', 4, 5, 2, 1, '2022-02-25', 1),
(3, 1, 'bpno-101', 'sub-meter', 4, 5, 2, 1, '2022-02-25', 1),
(4, NULL, 'bpno-102', 'main-meter', 4, 5, 2, 1, '2022-02-25', 1),
(5, 4, 'bpno-103', 'sub-meter', 4, 5, 2, 1, '2022-02-25', 1),
(6, NULL, 'bpno-104', 'main-meter', 4, 5, 2, 1, '2022-02-25', 1),
(7, 1, 'bpno-105', 'sub-meter', 4, 5, 2, 1, '2022-02-25', 1),
(8, NULL, 'bpno-106', 'main-meter', 5, 7, 3, 1, '2022-02-26', 1),
(10, NULL, 'bpno-107', 'sub-meter', 5, 7, 3, 1, '2022-02-26', 1),
(11, NULL, 'bpno-108', 'sub-meter', 5, 7, 3, 1, '2022-02-26', 1),
(12, 8, 'bpno-109', 'sub-meter', 5, 7, 3, 1, '2022-02-26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `meter_reading`
--

CREATE TABLE `meter_reading` (
  `mr_id` int(255) NOT NULL,
  `bpno` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `reading_date` date NOT NULL,
  `reading_value` varchar(20) NOT NULL,
  `image` varchar(500) DEFAULT NULL,
  `created_at` date NOT NULL,
  `created_by` int(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meter_reading`
--

INSERT INTO `meter_reading` (`mr_id`, `bpno`, `user_id`, `reading_date`, `reading_value`, `image`, `created_at`, `created_by`, `status`) VALUES
(1, 1, 5, '2022-03-02', '100', 'b98a36bf384a7f2afe46f9d278376240.png', '2022-03-03', 5, 1),
(2, 1, 5, '2022-03-03', '200', 'b98a36bf384a7f2afe46f9d278376240.png', '2022-03-03', 5, 1),
(3, 4, 5, '2022-03-04', '300', 'b98a36bf384a7f2afe46f9d278376240.png', '2022-03-03', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `task_assign`
--

CREATE TABLE `task_assign` (
  `task_id` int(255) NOT NULL,
  `sno_id` int(255) NOT NULL,
  `sub_meter_id` int(255) DEFAULT NULL,
  `user_id` int(255) NOT NULL,
  `meter_reading` tinyint(1) NOT NULL DEFAULT '0',
  `reading_frq` int(11) DEFAULT NULL,
  `bill_upload` tinyint(1) NOT NULL DEFAULT '0',
  `upload_frq` int(11) DEFAULT NULL,
  `created_by` int(255) NOT NULL,
  `created_at` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task_assign`
--

INSERT INTO `task_assign` (`task_id`, `sno_id`, `sub_meter_id`, `user_id`, `meter_reading`, `reading_frq`, `bill_upload`, `upload_frq`, `created_by`, `created_at`, `status`) VALUES
(6, 1, NULL, 5, 1, 1, 1, 1, 1, '2022-03-02', 1),
(7, 4, 5, 5, 1, 1, 1, 1, 1, '2022-03-02', 1),
(8, 4, NULL, 5, 1, 1, 1, 1, 1, '2022-03-02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(255) NOT NULL,
  `utype` int(255) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `password` varchar(500) NOT NULL,
  `sex` enum('male','female') NOT NULL,
  `created_by` int(255) DEFAULT NULL,
  `created_at` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `utype`, `fname`, `lname`, `email`, `contact_no`, `password`, `sex`, `created_by`, `created_at`, `status`) VALUES
(1, 1, 'rahul', 'sinha', 'admin@gmail.com', '9770866241', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'male', NULL, '2022-02-17', 1),
(2, 2, 'manoj', 'sinha21', 'manoj@gmail.com', '9770866241', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'male', 1, '2022-02-19', 1),
(5, 3, 'manoj', 'kumar', 'manoj@gmail.com', '9770866241', '50a12dd50d40e23444069e97d689c74f3a39a787', 'male', 1, '2022-02-28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `utype_id` int(255) NOT NULL,
  `type_name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`utype_id`, `type_name`, `status`) VALUES
(1, 'super_admin', 1),
(2, 'admin', 1),
(3, 'operator', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `sno_id` (`sno_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `company_master`
--
ALTER TABLE `company_master`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `cost_center_master`
--
ALTER TABLE `cost_center_master`
  ADD PRIMARY KEY (`costc_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `location_master`
--
ALTER TABLE `location_master`
  ADD PRIMARY KEY (`loc_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `cost_center_id` (`cost_center_id`);

--
-- Indexes for table `meter_master`
--
ALTER TABLE `meter_master`
  ADD PRIMARY KEY (`mid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `costc_id` (`costc_id`),
  ADD KEY `loc_id` (`loc_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `meter_reading`
--
ALTER TABLE `meter_reading`
  ADD PRIMARY KEY (`mr_id`),
  ADD KEY `bpno` (`bpno`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `task_assign`
--
ALTER TABLE `task_assign`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `service_no` (`sno_id`),
  ADD KEY `sub_meter_id` (`sub_meter_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `utype` (`utype`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`utype_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `bill_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_master`
--
ALTER TABLE `company_master`
  MODIFY `cid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cost_center_master`
--
ALTER TABLE `cost_center_master`
  MODIFY `costc_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `location_master`
--
ALTER TABLE `location_master`
  MODIFY `loc_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `meter_master`
--
ALTER TABLE `meter_master`
  MODIFY `mid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `meter_reading`
--
ALTER TABLE `meter_reading`
  MODIFY `mr_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `task_assign`
--
ALTER TABLE `task_assign`
  MODIFY `task_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `utype_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`uid`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_ibfk_2` FOREIGN KEY (`sno_id`) REFERENCES `meter_master` (`mid`) ON UPDATE CASCADE;

--
-- Constraints for table `company_master`
--
ALTER TABLE `company_master`
  ADD CONSTRAINT `company_master_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`uid`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `cost_center_master`
--
ALTER TABLE `cost_center_master`
  ADD CONSTRAINT `cost_center_master_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`uid`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `cost_center_master_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `company_master` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `location_master`
--
ALTER TABLE `location_master`
  ADD CONSTRAINT `location_master_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`uid`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `location_master_ibfk_2` FOREIGN KEY (`cost_center_id`) REFERENCES `cost_center_master` (`costc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `meter_master`
--
ALTER TABLE `meter_master`
  ADD CONSTRAINT `meter_master_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `company_master` (`cid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `meter_master_ibfk_2` FOREIGN KEY (`costc_id`) REFERENCES `cost_center_master` (`costc_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `meter_master_ibfk_3` FOREIGN KEY (`loc_id`) REFERENCES `location_master` (`loc_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `meter_master_ibfk_4` FOREIGN KEY (`created_by`) REFERENCES `users` (`uid`) ON UPDATE CASCADE;

--
-- Constraints for table `task_assign`
--
ALTER TABLE `task_assign`
  ADD CONSTRAINT `task_assign_ibfk_1` FOREIGN KEY (`sno_id`) REFERENCES `meter_master` (`mid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `task_assign_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`uid`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`utype`) REFERENCES `user_type` (`utype_id`) ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
=======
-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2022 at 01:22 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bill_record`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `bill_id` int(255) NOT NULL,
  `sno_id` int(255) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `bill_no` varchar(30) NOT NULL,
  `date_of_bill` date NOT NULL,
  `due_date` date NOT NULL,
  `reading` float(10,2) NOT NULL,
  `reading_date` date NOT NULL,
  `previous_reading` varchar(20) DEFAULT NULL,
  `previous_reading_date` date DEFAULT NULL,
  `power_consumption` float(10,2) DEFAULT NULL,
  `power_factor` varchar(200) DEFAULT NULL,
  `total_consumption` float(10,2) NOT NULL,
  `highest_demand_reading` float(10,2) DEFAULT NULL,
  `je_ae_name` varchar(50) NOT NULL,
  `je_ae_contact_no` varchar(15) NOT NULL,
  `ae_ee_name` varchar(50) NOT NULL,
  `ae_ee_contact_no` varchar(15) NOT NULL,
  `fixed_demand_charges` float(10,2) DEFAULT NULL,
  `minimum_charges` float(10,2) DEFAULT NULL,
  `energy_charges` float(10,2) DEFAULT NULL,
  `total_charges` float(10,2) NOT NULL,
  `electricity_duty` float(10,2) DEFAULT NULL,
  `cess` float(10,2) DEFAULT NULL,
  `welding_capacitor_overload` float(10,2) DEFAULT NULL,
  `meter_fare` float(10,2) DEFAULT NULL,
  `vca_charge` float(10,2) DEFAULT NULL,
  `security_deposit` float(10,2) DEFAULT NULL,
  `concession_amount` float(10,2) DEFAULT NULL,
  `total_bill` float(10,2) NOT NULL,
  `deviation_adjustment` float(10,2) DEFAULT NULL,
  `past_dues` float(10,2) NOT NULL,
  `security_fund_outstanding` float(10,2) DEFAULT NULL,
  `payable_amount` float(10,2) NOT NULL,
  `extra` float(10,2) DEFAULT NULL,
  `gross_amount` float(10,2) NOT NULL,
  `overload` float(10,2) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `payment_amount` float(10,9) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_by` int(255) DEFAULT NULL,
  `payment_type` enum('cash','check') DEFAULT NULL,
  `check_no` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`bill_id`, `sno_id`, `from_date`, `to_date`, `bill_no`, `date_of_bill`, `due_date`, `reading`, `reading_date`, `previous_reading`, `previous_reading_date`, `power_consumption`, `power_factor`, `total_consumption`, `highest_demand_reading`, `je_ae_name`, `je_ae_contact_no`, `ae_ee_name`, `ae_ee_contact_no`, `fixed_demand_charges`, `minimum_charges`, `energy_charges`, `total_charges`, `electricity_duty`, `cess`, `welding_capacitor_overload`, `meter_fare`, `vca_charge`, `security_deposit`, `concession_amount`, `total_bill`, `deviation_adjustment`, `past_dues`, `security_fund_outstanding`, `payable_amount`, `extra`, `gross_amount`, `overload`, `image`, `payment_amount`, `payment_date`, `payment_by`, `payment_type`, `check_no`, `created_at`, `created_by`, `status`) VALUES
(1, 1, '2022-02-01', '2022-02-28', 'bp1002', '2022-02-28', '2022-03-15', 3000.00, '2022-03-03', '1000', '2022-02-28', 0.00, '', 3000.00, 0.00, '', '', '', '', 0.00, 0.00, 0.00, 5000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 5000.00, 0.00, 1000.00, 0.00, 2000.00, 0.00, 6000.00, 0.00, '', NULL, NULL, NULL, NULL, NULL, '2022-03-08 00:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `company_master`
--

CREATE TABLE `company_master` (
  `cid` int(255) NOT NULL,
  `name` varchar(300) NOT NULL,
  `address` varchar(500) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `alternet_no` varchar(15) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `created_at` date NOT NULL,
  `created_by` int(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_master`
--

INSERT INTO `company_master` (`cid`, `name`, `address`, `contact_no`, `alternet_no`, `email`, `created_at`, `created_by`, `status`) VALUES
(1, 'VNR SEEDS PRIVATE LIMITED', 'Corporate Centre, Canal Raod Crossing, Ring Road No. -01, Raipur - CG', '07714350005', '', 'info@vnrseeds.com', '2022-03-08', 1, 1),
(2, 'ARPA FRUITS PRIVATE LIMITED', 'Corporate Centre, Canal Raod Crossing, Ring Road No. -01, Raipur - CG', '', '', '', '2022-03-08', 1, 1),
(3, 'ARVIND KUMAR AGRAWAL', 'Corporate Centre, Canal Raod Crossing, Ring Road No. -01, Raipur - CG', '', '', '', '2022-03-08', 1, 1),
(4, 'RAIPUR SEEDS PRIVATE LIMITED', 'Corporate Centre, Canal Raod Crossing, Ring Road No. -01, Raipur - CG', '', '', '', '2022-03-08', 1, 1),
(5, 'ATUL SAH', 'Corporate Centre, Canal Raod Crossing, Ring Road No. -01, Raipur - CG', '', '', '', '2022-03-08', 1, 1),
(6, 'CHAWDA PLANTATIONS PRIVATE LIMITED', 'Corporate Centre, Canal Raod Crossing, Ring Road No. -01, Raipur - CG', '', '', '', '2022-03-08', 1, 1),
(7, 'DREAM AGRI RESEARCH PRIVATE LIMITED', 'Corporate Centre, Canal Raod Crossing, Ring Road No. -01, Raipur - CG', '', '', '', '2022-03-08', 1, 1),
(8, 'DURGA KRISHI FARM', 'Corporate Centre, Canal Raod Crossing, Ring Road No. -01, Raipur - CG', '', '', '', '2022-03-08', 1, 1),
(9, 'FAST BIOTECH PRIVATE LIMITED', 'Corporate Centre, Canal Raod Crossing, Ring Road No. -01, Raipur - CG', '', '', '', '2022-03-08', 1, 1),
(10, 'FORTUNE BIOSCIENCE PRIVATE LIMITED', 'Corporate Centre, Canal Raod Crossing, Ring Road No. -01, Raipur - CG', '', '', '', '2022-03-08', 1, 1),
(11, 'RAIPUR AGRI RESEARCH PRIVATE LIMITED', 'Corporate Centre, Canal Raod Crossing, Ring Road No. -01, Raipur - CG', '', '', '', '2022-03-08', 1, 1),
(12, 'HEMA CHAWDA', 'Corporate Centre, Canal Raod Crossing, Ring Road No. -01, Raipur - CG', '', '', '', '2022-03-08', 1, 1),
(13, 'HEMA SEEDS PRIVATE LIMITED', 'Corporate Centre, Canal Raod Crossing, Ring Road No. -01, Raipur - CG', '', '', '', '2022-03-08', 1, 1),
(14, 'MAI AGRI IMPEX PRIVATE LIMITED', 'Corporate Centre, Canal Raod Crossing, Ring Road No. -01, Raipur - CG', '', '', '', '2022-03-08', 1, 1),
(15, 'PARAG AGRAWAL', 'Corporate Centre, Canal Raod Crossing, Ring Road No. -01, Raipur - CG', '', '', '', '2022-03-08', 1, 1),
(16, 'RAIPUR HORTICULTURAL FARMS PRIVATE LIMITED', 'Corporate Centre, Canal Raod Crossing, Ring Road No. -01, Raipur - CG', '', '', '', '2022-03-08', 1, 1),
(17, 'RAJ KUMAR KUNDU', 'Corporate Centre, Canal Raod Crossing, Ring Road No. -01, Raipur - CG', '', '', '', '2022-03-08', 1, 1),
(18, 'SHRI NARAYAN CHAWDA', 'Corporate Centre, Canal Raod Crossing, Ring Road No. -01, Raipur - CG', '', '', '', '2022-03-08', 1, 1),
(19, 'SHRI VIMAL CHAWDA', 'Corporate Centre, Canal Raod Crossing, Ring Road No. -01, Raipur - CG', '', '', '', '2022-03-08', 1, 1),
(20, 'SMT VELU CHAWDA', 'Corporate Centre, Canal Raod Crossing, Ring Road No. -01, Raipur - CG', '', '', '', '2022-03-08', 1, 1),
(21, 'VNR  NURSERY PRIVATE LIMITED', 'Corporate Centre, Canal Raod Crossing, Ring Road No. -01, Raipur - CG', '', '', '', '2022-03-08', 1, 1),
(22, 'VNR FARMS PRIVATE LIMITED', 'Corporate Centre, Canal Raod Crossing, Ring Road No. -01, Raipur - CG', '', '', '', '2022-03-08', 1, 1),
(23, 'VNR KRISHI FARM PRIVATE LIMITED', 'Corporate Centre, Canal Raod Crossing, Ring Road No. -01, Raipur - CG', '', '', '', '2022-03-08', 1, 1),
(24, 'VNR SEEDS PRIVATE LIMITED', 'Corporate Centre, Canal Raod Crossing, Ring Road No. -01, Raipur - CG', '', '', '', '2022-03-08', 1, 1),
(25, 'AKSHAY CHAUHAN', 'Corporate Centre, Canal Raod Crossing, Ring Road No. -01, Raipur - CG', '', '', '', '2022-03-08', 1, 1),
(26, 'RAM NANDAN SINGH', 'Corporate Centre, Canal Raod Crossing, Ring Road No. -01, Raipur - CG', '', '', '', '2022-03-08', 1, 1),
(27, 'VNR AGRI RESEARCH', 'Corporate Centre, Canal Raod Crossing, Ring Road No. -01, Raipur - CG', '', '', '', '2022-03-08', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cost_center`
--

CREATE TABLE `cost_center` (
  `cc_id` int(10) NOT NULL,
  `cc_name` varchar(30) DEFAULT NULL,
  `created_by` int(2) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cost_center`
--

INSERT INTO `cost_center` (`cc_id`, `cc_name`, `created_by`, `created_at`, `status`) VALUES
(1, 'RAIPUR', 1, '2022-03-08', 1),
(2, 'JAGDALPUR', 1, '2022-03-08', 1),
(5, 'KOHADIYA', 1, '2022-03-08', 1),
(6, 'GOMCHI', 1, '2022-03-08', 1),
(7, 'DHABA', 1, '2022-03-08', 1),
(8, 'BERLA', 1, '2022-03-08', 1),
(9, 'MAHASAMUND', 1, '2022-03-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cost_center_master`
--

CREATE TABLE `cost_center_master` (
  `costc_id` int(255) NOT NULL,
  `company_id` int(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `cc_id` int(10) DEFAULT NULL,
  `created_by` int(255) NOT NULL,
  `created_at` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cost_center_master`
--

INSERT INTO `cost_center_master` (`costc_id`, `company_id`, `name`, `cc_id`, `created_by`, `created_at`, `status`) VALUES
(1, 1, 'RAIPUR', 1, 1, '2022-03-08', 1),
(2, 11, 'RAIPUR', 1, 1, '2022-03-08', 1),
(3, 3, 'RAIPUR', 1, 1, '2022-03-08', 1),
(4, 22, 'RAIPUR', 1, 1, '2022-03-08', 1),
(7, 5, 'RAIPUR', 1, 1, '2022-03-08', 0),
(8, 5, 'KOHADIYA', 5, 1, '2022-03-08', 0),
(9, 19, 'KOHADIYA', 5, 1, '2022-03-08', 1),
(10, 19, 'GOMCHI', 6, 1, '2022-03-08', 1),
(11, 18, 'GOMCHI', 6, 1, '2022-03-08', 1),
(12, 18, 'KOHADIYA', 5, 1, '2022-03-08', 1),
(13, 18, 'DHABA', 7, 1, '2022-03-08', 1),
(14, 19, 'DHABA', 7, 1, '2022-03-08', 1),
(15, 13, 'BERLA', 8, 1, '2022-03-08', 1),
(16, 2, 'JAGDALPUR', 2, 1, '2022-03-08', 1),
(17, 9, 'JAGDALPUR', 2, 1, '2022-03-08', 1),
(18, 10, 'JAGDALPUR', 2, 1, '2022-03-08', 1),
(20, 25, 'JAGDALPUR', 2, 1, '2022-03-08', 1),
(21, 5, 'JAGDALPUR', 2, 1, '2022-03-08', 1),
(22, 15, 'JAGDALPUR', 2, 1, '2022-03-08', 1),
(23, 17, 'JAGDALPUR', 2, 1, '2022-03-08', 1),
(24, 26, 'JAGDALPUR', 2, 1, '2022-03-08', 1),
(25, 27, 'JAGDALPUR', 2, 1, '2022-03-08', 1),
(26, 22, 'JAGDALPUR', 2, 1, '2022-03-08', 1),
(28, 6, 'KOHADIYA', 5, 1, '2022-03-08', 1),
(29, 7, 'JAGDALPUR', 2, 1, '2022-03-08', 1),
(30, 7, 'BERLA', 8, 1, '2022-03-08', 1),
(32, 4, 'BERLA', 8, 1, '2022-03-08', 1),
(33, 16, 'KOHADIYA', 5, 1, '2022-03-08', 1),
(34, 16, 'BERLA', 8, 1, '2022-03-08', 1),
(36, 14, 'RAIPUR', 1, 1, '2022-03-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `lc_id` int(10) NOT NULL,
  `lc_name` varchar(30) DEFAULT NULL,
  `created_by` int(2) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`lc_id`, `lc_name`, `created_by`, `created_at`, `status`) VALUES
(1, 'BAKAWAND', 1, '2022-03-08', 1),
(2, 'KORTA', 1, '2022-03-08', 1),
(3, 'BANIYAGAON', 1, '2022-03-08', 1),
(4, 'CHHOTE DEWDA', 1, '2022-03-08', 1),
(5, 'TALLUR', 1, '2022-03-08', 1),
(6, 'BEDAGAON', 1, '2022-03-08', 1),
(7, 'MARETHA', 1, '2022-03-08', 1),
(8, 'KOSMI', 1, '2022-03-08', 1),
(9, 'CHOKNAR', 1, '2022-03-08', 1),
(10, 'SATLAWAND', 1, '2022-03-08', 1),
(11, 'MAGNAR', 1, '2022-03-08', 1),
(12, 'NALPAWAND', 1, '2022-03-08', 1),
(13, 'DASAPAL', 1, '2022-03-08', 1),
(14, 'JAITGIRI', 1, '2022-03-08', 1),
(15, 'DURGABEDA', 1, '2022-03-08', 1),
(16, 'AWARABHATA', 1, '2022-03-08', 1),
(17, 'BHOND', 1, '2022-03-08', 1),
(18, 'MULI', 1, '2022-03-08', 1),
(19, 'SAKRA', 1, '2022-03-08', 1),
(20, 'TARPONGI', 1, '2022-03-08', 1),
(21, 'KHUDMUDA', 1, '2022-03-08', 1),
(22, 'ABHANPUR', 1, '2022-03-08', 1),
(23, 'SEMARIYA', 1, '2022-03-08', 1),
(24, 'ANADGAON', 1, '2022-03-08', 1),
(25, 'SAKRA-TARPONGI', 1, '2022-03-08', 1),
(26, 'BANBARAT', 1, '2022-03-08', 1),
(27, 'KHAMTARAI', 1, '2022-03-08', 1),
(28, 'KURUD', 1, '2022-03-08', 1),
(29, 'MUJGHAN', 1, '2022-03-08', 1),
(30, 'SIRSAKALA', 1, '2022-03-08', 1),
(31, 'SANDI-1', 1, '2022-03-08', 1),
(32, 'SANDI-2', 1, '2022-03-08', 1),
(33, 'NANDINI-2', 1, '2022-03-08', 1),
(34, 'KOHADIYA', 1, '2022-03-08', 1),
(35, 'BOHARDIH', 1, '2022-03-08', 1),
(36, 'GOMCHI', 1, '2022-03-08', 1),
(37, 'DHABA', 1, '2022-03-08', 1),
(38, 'KIRNA', 1, '2022-03-08', 1),
(39, 'SILPATTI', 1, '2022-03-08', 1),
(40, 'DADAR', 1, '2022-03-08', 1),
(41, 'NANDANI', 1, '2022-03-08', 1),
(42, 'LENJUWARA', 1, '2022-03-08', 1),
(43, 'MUHRENGA', 1, '2022-03-08', 1),
(44, 'BERLA', 1, '2022-03-08', 1),
(45, 'NEVNARA', 1, '2022-03-08', 1),
(46, 'BORSI', 1, '2022-03-08', 1),
(47, 'BORIA', 1, '2022-03-08', 1),
(48, 'RAIPUR', 1, '2022-03-08', 1),
(49, 'NAYA RAIPUR', 1, '2022-03-08', 1),
(50, 'TATIBANDH', 1, '2022-03-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `location_master`
--

CREATE TABLE `location_master` (
  `loc_id` int(255) NOT NULL,
  `cost_center_id` int(255) NOT NULL,
  `name` varchar(200) NOT NULL,
  `lc_id` int(10) DEFAULT NULL,
  `created_by` int(255) NOT NULL,
  `created_at` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location_master`
--

INSERT INTO `location_master` (`loc_id`, `cost_center_id`, `name`, `lc_id`, `created_by`, `created_at`, `status`) VALUES
(2, 28, 'KOHADIYA', 34, 1, '2022-03-08', 1),
(3, 29, 'BHOND', 17, 1, '2022-03-08', 1),
(4, 29, 'MULI', 18, 1, '2022-03-08', 1),
(5, 30, 'LENJUWARA', 42, 1, '2022-03-08', 1),
(6, 30, 'MUHRENGA', 43, 1, '2022-03-08', 1),
(7, 2, 'BANBARAT', 26, 1, '2022-03-08', 1),
(8, 2, 'KHAMTARAI', 27, 1, '2022-03-08', 1),
(9, 2, 'KURUD', 28, 1, '2022-03-08', 1),
(10, 2, 'MUJGHAN', 29, 1, '2022-03-08', 1),
(11, 2, 'NANDINI-2', 33, 1, '2022-03-08', 1),
(12, 2, 'SANDI-1', 31, 1, '2022-03-08', 1),
(13, 2, 'SANDI-2', 32, 1, '2022-03-08', 1),
(14, 2, 'SIRSAKALA', 30, 1, '2022-03-08', 1),
(15, 32, 'BORIA', 47, 1, '2022-03-08', 1),
(16, 33, 'KOHADIYA', 34, 1, '2022-03-08', 1),
(17, 34, 'NEVNARA', 45, 1, '2022-03-08', 1),
(18, 34, 'BORSI', 46, 1, '2022-03-08', 1),
(19, 3, 'SAKRA', 19, 1, '2022-03-08', 1),
(20, 3, 'TARPONGI', 20, 1, '2022-03-08', 1),
(21, 3, 'SAKRA-TARPONGI', 25, 1, '2022-03-08', 1),
(22, 20, 'KOSMI', 8, 1, '2022-03-08', 1),
(23, 20, 'CHOKNAR', 9, 1, '2022-03-08', 0),
(24, 22, 'SATLAWAND', 10, 1, '2022-03-08', 1),
(25, 20, 'MAGNAR', 11, 1, '2022-03-08', 0),
(26, 21, 'CHOKNAR', 9, 1, '2022-03-08', 1),
(27, 23, 'MAGNAR', 11, 1, '2022-03-08', 1),
(28, 24, 'NALPAWAND', 12, 1, '2022-03-08', 1),
(29, 25, 'DASAPAL', 13, 1, '2022-03-08', 1),
(30, 26, 'JAITGIRI', 14, 1, '2022-03-08', 1),
(31, 26, 'DURGABEDA', 15, 1, '2022-03-08', 1),
(32, 26, 'AWARABHATA', 16, 1, '2022-03-08', 1),
(33, 4, 'KHUDMUDA', 21, 1, '2022-03-08', 1),
(34, 4, 'ABHANPUR', 22, 1, '2022-03-08', 1),
(35, 4, 'SEMARIYA', 23, 1, '2022-03-08', 1),
(36, 4, 'ANADGAON', 24, 1, '2022-03-08', 1),
(37, 4, 'KOHADIYA', 34, 1, '2022-03-08', 1),
(38, 16, 'BAKAWAND', 1, 1, '2022-03-08', 1),
(39, 16, 'KORTA', 2, 1, '2022-03-08', 1),
(40, 17, 'BANIYAGAON', 3, 1, '2022-03-08', 1),
(41, 17, 'CHHOTE DEWDA', 4, 1, '2022-03-08', 1),
(42, 18, 'TALLUR', 5, 1, '2022-03-08', 1),
(43, 18, 'BEDAGAON', 6, 1, '2022-03-08', 1),
(44, 18, 'MARETHA', 7, 1, '2022-03-08', 1),
(45, 12, 'KOHADIYA', 34, 1, '2022-03-08', 1),
(46, 11, 'GOMCHI', 36, 1, '2022-03-08', 1),
(47, 13, 'DHABA', 37, 1, '2022-03-08', 1),
(48, 15, 'SILPATTI', 39, 1, '2022-03-08', 1),
(49, 15, 'KIRNA', 38, 1, '2022-03-08', 1),
(50, 15, 'DADAR', 40, 1, '2022-03-08', 1),
(51, 15, 'NANDANI', 41, 1, '2022-03-08', 1),
(52, 9, 'KOHADIYA', 34, 1, '2022-03-08', 1),
(53, 9, 'BOHARDIH', 35, 1, '2022-03-08', 1),
(54, 10, 'GOMCHI', 36, 1, '2022-03-08', 1),
(55, 1, 'RAIPUR', 48, 1, '2022-03-08', 1),
(56, 36, 'NAYA RAIPUR', 49, 1, '2022-03-08', 1),
(57, 36, 'TATIBANDH', 50, 1, '2022-03-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `meter_master`
--

CREATE TABLE `meter_master` (
  `mid` int(255) NOT NULL,
  `parent_meter` int(255) DEFAULT NULL,
  `sort_code` varchar(200) DEFAULT NULL,
  `bpno` varchar(100) NOT NULL,
  `mtype` enum('main-meter','sub-meter') NOT NULL DEFAULT 'main-meter',
  `cid` int(255) NOT NULL,
  `costc_id` int(255) NOT NULL,
  `loc_id` int(255) NOT NULL,
  `connection_type` enum('permanent','temporary') NOT NULL DEFAULT 'permanent',
  `connection_from_date` date DEFAULT NULL,
  `connection_to_date` date DEFAULT NULL,
  `created_by` int(255) NOT NULL,
  `created_at` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meter_master`
--

INSERT INTO `meter_master` (`mid`, `parent_meter`, `sort_code`, `bpno`, `mtype`, `cid`, `costc_id`, `loc_id`, `connection_type`, `connection_from_date`, `connection_to_date`, `created_by`, `created_at`, `status`) VALUES
(1, NULL, NULL, 'bp-101', 'main-meter', 1, 1, 55, 'permanent', '2020-01-26', '2025-12-12', 1, '2022-03-08', 1),
(2, 1, NULL, 'bp-101/1', 'sub-meter', 1, 1, 55, '', '0000-00-00', '0000-00-00', 1, '2022-03-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `meter_reading`
--

CREATE TABLE `meter_reading` (
  `mr_id` int(255) NOT NULL,
  `bpno` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `reading_date` date NOT NULL,
  `reading_value` varchar(20) NOT NULL,
  `image` varchar(500) DEFAULT NULL,
  `created_at` date NOT NULL,
  `created_by` int(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `task_assign`
--

CREATE TABLE `task_assign` (
  `task_id` int(255) NOT NULL,
  `sno_id` int(255) NOT NULL,
  `sub_meter_id` int(255) DEFAULT NULL,
  `user_id` int(255) NOT NULL,
  `meter_reading` tinyint(1) NOT NULL DEFAULT '0',
  `reading_frq` int(11) DEFAULT NULL,
  `bill_upload` tinyint(1) NOT NULL DEFAULT '0',
  `upload_frq` int(11) DEFAULT NULL,
  `created_by` int(255) NOT NULL,
  `created_at` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task_assign`
--

INSERT INTO `task_assign` (`task_id`, `sno_id`, `sub_meter_id`, `user_id`, `meter_reading`, `reading_frq`, `bill_upload`, `upload_frq`, `created_by`, `created_at`, `status`) VALUES
(2, 1, NULL, 2, 1, 1, 1, 1, 1, '2022-03-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(255) NOT NULL,
  `utype` int(255) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `password` varchar(500) NOT NULL,
  `sex` enum('male','female') NOT NULL,
  `created_by` int(255) DEFAULT NULL,
  `created_at` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `utype`, `fname`, `lname`, `email`, `contact_no`, `password`, `sex`, `created_by`, `created_at`, `status`) VALUES
(1, 1, 'admin', 'istator', 'admin@gmail.com', '9770866241', '8cb2237d0679ca88db6464eac60da96345513964', 'male', NULL, '2022-02-17', 1),
(2, 2, 'vimla', 'sahu', 'fa3@vnrseeds.com', '9179311318', 'e927774093a1c5b6e5f94b9babc6193b76a264c5', 'female', 1, '2022-03-08', 1),
(3, 2, 'kiran', 'joshi', 'fa4@vnrseeds.com', '7415293641', 'eb0851fb94b5599e28d204c9279414e7049c2c97', 'female', 1, '2022-03-08', 1),
(4, 2, 'vikash', 'signghal', 'fa6@vnrseeds.com', '8160071337', '47af84ae00795987579970eca10218441f3a094b', 'male', 1, '2022-03-08', 1),
(5, 2, 'jayesh', 'pooniya', 'fa9@vnrseeds.com', '7987090923', 'f7b24de42792bc0b7483728f652bcf2adc306a14', 'male', 1, '2022-03-08', 1),
(6, 2, 'durga', 'devangan', 'fa11@vnrseeds.com', '7694979373', '4e95c796d0d4962c6b1db6af6764cd7ba2cdc2b5', 'female', 1, '2022-03-08', 1),
(7, 2, 'jitendra', 'gcc', 'fa10@vnrseeds.com', '9981995398', 'dca8edce98d11a3d806b520ec0c68e71e6971b78', 'male', 1, '2022-03-08', 1),
(8, 2, 'swapnil', 'Agrawal', 'agr.swapnil@gmail.com', '7869944007', '51dbe5d135be7cb4500fd34833bfec0a0fd1414b', 'male', 1, '2022-03-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `utype_id` int(255) NOT NULL,
  `type_name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`utype_id`, `type_name`, `status`) VALUES
(1, 'super_admin', 1),
(2, 'admin', 1),
(3, 'operator', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `sno_id` (`sno_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `payment_by` (`payment_by`);

--
-- Indexes for table `company_master`
--
ALTER TABLE `company_master`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `cost_center`
--
ALTER TABLE `cost_center`
  ADD PRIMARY KEY (`cc_id`),
  ADD KEY `cc_id` (`cc_id`);

--
-- Indexes for table `cost_center_master`
--
ALTER TABLE `cost_center_master`
  ADD PRIMARY KEY (`costc_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `cc_id` (`cc_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`lc_id`),
  ADD KEY `lc_id` (`lc_id`);

--
-- Indexes for table `location_master`
--
ALTER TABLE `location_master`
  ADD PRIMARY KEY (`loc_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `cost_center_id` (`cost_center_id`);

--
-- Indexes for table `meter_master`
--
ALTER TABLE `meter_master`
  ADD PRIMARY KEY (`mid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `costc_id` (`costc_id`),
  ADD KEY `loc_id` (`loc_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `meter_reading`
--
ALTER TABLE `meter_reading`
  ADD PRIMARY KEY (`mr_id`),
  ADD KEY `bpno` (`bpno`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `task_assign`
--
ALTER TABLE `task_assign`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `service_no` (`sno_id`),
  ADD KEY `sub_meter_id` (`sub_meter_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `utype` (`utype`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`utype_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `bill_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company_master`
--
ALTER TABLE `company_master`
  MODIFY `cid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `cost_center`
--
ALTER TABLE `cost_center`
  MODIFY `cc_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cost_center_master`
--
ALTER TABLE `cost_center_master`
  MODIFY `costc_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `lc_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `location_master`
--
ALTER TABLE `location_master`
  MODIFY `loc_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `meter_master`
--
ALTER TABLE `meter_master`
  MODIFY `mid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `meter_reading`
--
ALTER TABLE `meter_reading`
  MODIFY `mr_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_assign`
--
ALTER TABLE `task_assign`
  MODIFY `task_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `utype_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`uid`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_ibfk_2` FOREIGN KEY (`sno_id`) REFERENCES `meter_master` (`mid`) ON UPDATE CASCADE;

--
-- Constraints for table `company_master`
--
ALTER TABLE `company_master`
  ADD CONSTRAINT `company_master_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`uid`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `cost_center_master`
--
ALTER TABLE `cost_center_master`
  ADD CONSTRAINT `cost_center_master_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`uid`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `cost_center_master_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `company_master` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `location_master`
--
ALTER TABLE `location_master`
  ADD CONSTRAINT `location_master_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`uid`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `location_master_ibfk_2` FOREIGN KEY (`cost_center_id`) REFERENCES `cost_center_master` (`costc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `meter_master`
--
ALTER TABLE `meter_master`
  ADD CONSTRAINT `meter_master_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `company_master` (`cid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `meter_master_ibfk_2` FOREIGN KEY (`costc_id`) REFERENCES `cost_center_master` (`costc_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `meter_master_ibfk_3` FOREIGN KEY (`loc_id`) REFERENCES `location_master` (`loc_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `meter_master_ibfk_4` FOREIGN KEY (`created_by`) REFERENCES `users` (`uid`) ON UPDATE CASCADE;

--
-- Constraints for table `task_assign`
--
ALTER TABLE `task_assign`
  ADD CONSTRAINT `task_assign_ibfk_1` FOREIGN KEY (`sno_id`) REFERENCES `meter_master` (`mid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `task_assign_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`uid`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`utype`) REFERENCES `user_type` (`utype_id`) ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
>>>>>>> b8649bfae6c73219475d2f68c496ec4191cab5fc
