-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2022 at 01:19 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.23

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`bill_id`, `sno_id`, `from_date`, `to_date`, `bill_no`, `date_of_bill`, `due_date`, `reading`, `reading_date`, `previous_reading`, `previous_reading_date`, `power_consumption`, `power_factor`, `total_consumption`, `highest_demand_reading`, `je_ae_name`, `je_ae_contact_no`, `ae_ee_name`, `ae_ee_contact_no`, `fixed_demand_charges`, `minimum_charges`, `energy_charges`, `total_charges`, `electricity_duty`, `cess`, `welding_capacitor_overload`, `meter_fare`, `vca_charge`, `security_deposit`, `concession_amount`, `total_bill`, `deviation_adjustment`, `past_dues`, `security_fund_outstanding`, `payable_amount`, `extra`, `gross_amount`, `overload`, `image`, `payment_amount`, `payment_date`, `payment_by`, `payment_type`, `check_no`, `created_at`, `created_by`, `status`) VALUES
(1, 1, '2022-02-01', '2022-02-28', 'bno123', '2022-03-08', '2022-03-01', 2300.00, '2022-03-05', '200', '2022-03-01', 0.00, '', 5600.00, 0.00, '', '', '', '', 0.00, 0.00, 0.00, 2000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2300.00, 0.00, 0.00, 0.00, 2300.00, 0.00, 3000.00, 0.00, '', NULL, NULL, NULL, NULL, NULL, '2022-03-08 00:00:00', 1, 1);

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
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_master`
--

INSERT INTO `company_master` (`cid`, `name`, `address`, `contact_no`, `alternet_no`, `email`, `created_at`, `created_by`, `status`) VALUES
(1, 'vnr', 'corporate Center, Raipur', '9770866241', '', 'vnr@gmail.com', '2022-03-07', 1, 1),
(2, '123', 'sdq', '9770866241', '', 'rahul@gmail.com', '2022-03-08', 1, 0);

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
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cost_center_master`
--

INSERT INTO `cost_center_master` (`costc_id`, `company_id`, `name`, `created_by`, `created_at`, `status`) VALUES
(1, 1, 'taatibandh', 1, '2022-03-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `location_master`
--

CREATE TABLE `location_master` (
  `loc_id` int(255) NOT NULL,
  `cost_center_id` int(255) NOT NULL,
  `name` varchar(200) NOT NULL,
  `created_by` int(255) NOT NULL,
  `created_at` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location_master`
--

INSERT INTO `location_master` (`loc_id`, `cost_center_id`, `name`, `created_by`, `created_at`, `status`) VALUES
(1, 1, 'raipur-location', 1, '2022-03-07', 0),
(2, 1, 'raipur-location', 1, '2022-03-07', 0),
(3, 1, 'raipur-location', 1, '2022-03-07', 1);

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
  `created_by` int(255) NOT NULL,
  `created_at` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meter_master`
--

INSERT INTO `meter_master` (`mid`, `parent_meter`, `sort_code`, `bpno`, `mtype`, `cid`, `costc_id`, `loc_id`, `created_by`, `created_at`, `status`) VALUES
(1, NULL, NULL, 'bp101', 'main-meter', 1, 1, 3, 1, '2022-03-07', 1);

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
  `status` tinyint(1) NOT NULL DEFAULT 1
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
  `meter_reading` tinyint(1) NOT NULL DEFAULT 0,
  `reading_frq` int(11) DEFAULT NULL,
  `bill_upload` tinyint(1) NOT NULL DEFAULT 0,
  `upload_frq` int(11) DEFAULT NULL,
  `created_by` int(255) NOT NULL,
  `created_at` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
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
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `utype`, `fname`, `lname`, `email`, `contact_no`, `password`, `sex`, `created_by`, `created_at`, `status`) VALUES
(1, 1, 'admin', 'istator', 'admin@gmail.com', '9770866241', '8cb2237d0679ca88db6464eac60da96345513964', 'male', NULL, '2022-02-17', 1),
(2, 2, 'fa', '1', 'fa1@gmail.com', '9770866241', '50a12dd50d40e23444069e97d689c74f3a39a787', 'male', 1, '2022-03-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `utype_id` int(255) NOT NULL,
  `type_name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
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
  MODIFY `bill_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company_master`
--
ALTER TABLE `company_master`
  MODIFY `cid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cost_center_master`
--
ALTER TABLE `cost_center_master`
  MODIFY `costc_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `location_master`
--
ALTER TABLE `location_master`
  MODIFY `loc_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `meter_master`
--
ALTER TABLE `meter_master`
  MODIFY `mid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `uid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
