-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2022 at 10:20 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

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
  `sub_meter_id` int(255) DEFAULT NULL,
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
  `task_id` int(255) NOT NULL,
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
  `alternet_no` varchar(15) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cost_center_master`
--

CREATE TABLE `cost_center_master` (
  `costc_id` int(255) NOT NULL,
  `company_id` int(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_by` int(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `serviceno_master`
--

CREATE TABLE `serviceno_master` (
  `sno_id` int(255) NOT NULL,
  `consumer_name` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `location` int(255) NOT NULL,
  `company_id` int(255) NOT NULL,
  `connection_type` enum('parmanent','temporary') NOT NULL,
  `renewal_date` datetime DEFAULT NULL,
  `meter_no` varchar(30) NOT NULL,
  `pole_no` varchar(30) NOT NULL,
  `zone` varchar(50) NOT NULL,
  `zone_address` text NOT NULL,
  `zone_contact` varchar(20) NOT NULL,
  `purpose` text NOT NULL,
  `tarrif_category` enum('one') NOT NULL,
  `phase` int(11) NOT NULL,
  `connected_load` varchar(10) NOT NULL,
  `security_deposit` float(10,2) NOT NULL,
  `created_by` int(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `submeter_master`
--

CREATE TABLE `submeter_master` (
  `sub_meter_id` int(255) NOT NULL,
  `purpose` varchar(50) NOT NULL,
  `service_no` int(255) NOT NULL,
  `created_by` int(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `task_assign`
--

CREATE TABLE `task_assign` (
  `task_id` int(255) NOT NULL,
  `task_type` enum('meter reading','bill upload') NOT NULL,
  `sno_id` int(255) NOT NULL,
  `sub_meter_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `frequency` int(11) NOT NULL DEFAULT '1',
  `created_by` int(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `password` varchar(100) NOT NULL,
  `sex` enum('male','female') NOT NULL,
  `created_by` int(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `utype`, `fname`, `lname`, `email`, `contact_no`, `password`, `sex`, `created_by`, `created_at`, `status`) VALUES
(1, 1, 'rahul', 'sinha', 'rahul@gmail.com', '9770866241', '123', 'male', NULL, '2022-02-17 04:10:35', 1);

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
(2, 'admin', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `sno_id` (`sno_id`),
  ADD KEY `sub_meter_id` (`sub_meter_id`),
  ADD KEY `task_id` (`task_id`),
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
-- Indexes for table `serviceno_master`
--
ALTER TABLE `serviceno_master`
  ADD PRIMARY KEY (`sno_id`),
  ADD KEY `location` (`location`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `submeter_master`
--
ALTER TABLE `submeter_master`
  ADD PRIMARY KEY (`sub_meter_id`),
  ADD KEY `service_no` (`service_no`),
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
  MODIFY `cid` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cost_center_master`
--
ALTER TABLE `cost_center_master`
  MODIFY `costc_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `location_master`
--
ALTER TABLE `location_master`
  MODIFY `loc_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `serviceno_master`
--
ALTER TABLE `serviceno_master`
  MODIFY `sno_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `submeter_master`
--
ALTER TABLE `submeter_master`
  MODIFY `sub_meter_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_assign`
--
ALTER TABLE `task_assign`
  MODIFY `task_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `utype_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`uid`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_ibfk_2` FOREIGN KEY (`sno_id`) REFERENCES `serviceno_master` (`sno_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_ibfk_3` FOREIGN KEY (`sub_meter_id`) REFERENCES `submeter_master` (`sub_meter_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_ibfk_4` FOREIGN KEY (`task_id`) REFERENCES `task_assign` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `serviceno_master`
--
ALTER TABLE `serviceno_master`
  ADD CONSTRAINT `serviceno_master_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company_master` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `serviceno_master_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`uid`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `serviceno_master_ibfk_3` FOREIGN KEY (`location`) REFERENCES `location_master` (`loc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `submeter_master`
--
ALTER TABLE `submeter_master`
  ADD CONSTRAINT `submeter_master_ibfk_1` FOREIGN KEY (`service_no`) REFERENCES `serviceno_master` (`sno_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `task_assign`
--
ALTER TABLE `task_assign`
  ADD CONSTRAINT `task_assign_ibfk_1` FOREIGN KEY (`sno_id`) REFERENCES `serviceno_master` (`sno_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_assign_ibfk_2` FOREIGN KEY (`sub_meter_id`) REFERENCES `submeter_master` (`sub_meter_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_assign_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`uid`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`utype`) REFERENCES `users` (`uid`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
