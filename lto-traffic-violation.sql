-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 16, 2022 at 02:10 PM
-- Server version: 5.7.34
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lto-traffic-violation`
--

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `driver_id` int(11) NOT NULL,
  `license_no` varchar(20) NOT NULL,
  `license_type` varchar(200) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `birth_date` date NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street_name` varchar(200) DEFAULT NULL,
  `village_name` varchar(200) DEFAULT NULL,
  `barangay` varchar(200) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `region` char(200) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`driver_id`, `license_no`, `license_type`, `first_name`, `last_name`, `birth_date`, `phone`, `email`, `street_name`, `village_name`, `barangay`, `city`, `region`, `created_at`, `updated_at`) VALUES
(1, 'N10-11-123456', 'Professional', 'Onalyn', 'Go', '1985-02-27', '09123456789', 'onalyngo@gmail.com', 'Umali', 'Summitville', 'Putatan', 'Muntinlupa', 'NCR', '2022-09-13 23:39:39', NULL),
(2, 'N10-12-123455', 'Professional', 'Noly', 'Go', '1985-02-23', '09123456569', 'nolygo@gmail.com', 'Bolzano', 'Bella Vista', 'Santiago', 'General Trias', 'Cavite', '2022-09-14 00:26:36', '2022-09-14 19:13:17'),
(3, 'N10-12-123456', 'Professional', 'Noly', 'Go', '1985-02-23', '09123456569', 'nolygo@gmail.com', 'Bolzano', 'Bella Vista', 'Santiago', 'General Trias', 'Cavite', '2022-09-14 00:28:37', '2022-09-14 19:13:27'),
(4, 'N12-12-221145', 'Non-Professional', 'Onalyn', 'Gervacio', '1985-02-27', '09128934542', 'onalyngo@gmail.com', 'Umali', 'Summitville', 'Putatan', 'Muntinlupa', 'NCR', '2022-09-14 00:32:13', '2022-09-14 00:32:13'),
(6, 'N12-12-221145', 'Non-Professional', 'Onalyn', 'Gervacio', '1985-02-27', '09128934542', 'onalyngo@gmail.com', 'Umali', 'Summitville', 'Putatan', 'Muntinlupa', 'NCR', '2022-09-14 00:32:13', '2022-09-14 00:32:13'),
(7, 'S12-22-129356', 'Student Permit', 'Sofia Mikaela', 'Ramos', '2006-04-29', '09991235982', 'sofiameka@gmail.com', 'Umali', 'Summitville', 'Putatan', 'Muntinlupa', 'Metro Manila', '2022-09-14 00:32:13', '2022-09-14 03:12:29'),
(8, 'N12-12-221145', 'Non-Professional', 'Onalyn', 'Gervacio', '1985-02-27', '09128934542', 'onalyngo@gmail.com', 'Umali', 'Summitville', 'Putatan', 'Muntinlupa', 'NCR', '2022-09-14 00:32:13', '2022-09-14 00:32:13'),
(9, 'N12-12-221145', 'Non-Professional', 'Onalyn', 'Gervacio', '1985-02-27', '09128934542', 'onalyngo@gmail.com', 'Umali', 'Summitville', 'Putatan', 'Muntinlupa', 'NCR', '2022-09-14 00:32:13', '2022-09-14 00:32:13'),
(10, 'N12-12-221145', 'Non-Professional', 'Onalyn', 'Gervacio', '1985-02-27', '09128934542', 'onalyngo@gmail.com', 'Umali', 'Summitville', 'Putatan', 'Muntinlupa', 'NCR', '2022-09-14 00:32:13', '2022-09-14 00:32:13'),
(11, 'N12-12-221145', 'Non-Professional', 'Onalyn', 'Gervacio', '1985-02-27', '09128934542', 'onalyngo@gmail.com', 'Umali', 'Summitville', 'Putatan', 'Muntinlupa', 'NCR', '2022-09-14 00:32:13', '2022-09-14 00:32:13'),
(12, 'N11-21-110099', 'Student', 'Willie', 'Gundan', '2012-04-24', '09123448341', 'williegundan@gmail.com', 'Umali Road', 'Summitville 2', 'Putatan', 'Muntinlupa', 'NCR', '2022-09-15 16:37:26', NULL),
(13, 'N00-00-110099', 'Student', 'Rolf', 'Ramos', '2007-12-21', '09990009999', 'rolfzandrie@gmail.com', 'Umali Road', 'Summitville', 'Bayanan', 'Muntinlupa', 'NCR', '2022-09-15 16:39:40', NULL),
(14, 'N00-00-110099', 'Student', 'Rolf', 'Ramos', '2007-12-21', '09990009999', 'rolfzandrie@gmail.com', 'Umali Road', 'Summitville', 'Bayanan', 'Muntinlupa', 'NCR', '2022-09-15 16:40:12', NULL),
(15, 'N12-00-123456', 'Non-Professional', 'Nenita', 'Gervacio', '1958-12-04', '09123345529', 'nenitago@gmail.com', 'Sample Street', 'Sample Village', 'Sample Barangay', 'Sample City', 'Sample Region', '2022-09-15 17:26:55', '2022-09-15 17:27:34'),
(16, 'N11-12-3456', 'Student', 'Sample', 'Sample', '2000-11-11', '09123456', 'email@gmail.com', 'street', 'village', 'barangay', 'city', 'region', '2022-09-15 17:36:17', NULL),
(17, 'N23-05-005975', 'Professional', 'Meghan', 'Trainor', '1987-12-23', '09987562431', 'meghantrainor@gmail.com', 'Sunshine Street', 'SunValley', 'Don Bosco', 'Paranaque', 'NCR', '2022-09-16 15:52:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `record_id` int(11) NOT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `violation_id` int(11) DEFAULT NULL,
  `ticket_no` varchar(50) NOT NULL,
  `enforcer_id` varchar(20) NOT NULL,
  `enforcer_name` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=pending, 1=paid',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`record_id`, `driver_id`, `violation_id`, `ticket_no`, `enforcer_id`, `enforcer_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 14, 7, 'TIC-12345', 'OFC-1234', 'Guillermo Eleazar', 1, '2022-09-15 18:41:00', '2022-09-16 15:47:18'),
(4, 15, 1, 'TIC-12345', 'OFC-12345', 'Kunwari Enforcer', 0, '2022-09-16 01:25:00', '2022-09-16 06:16:21'),
(6, 8, 5, 'TIC-444456', 'OFC-44444', 'Miguel Gonzaga', 0, '2022-09-16 03:10:00', '2022-09-16 06:44:08'),
(7, 12, 1, 'TIC-99882', 'OFC-223344', 'John David', 0, '2022-09-16 15:49:00', NULL),
(8, 1, 1, 'Sample Ticket Number', 'Sample Officer ID', 'Sample Officer Name', 1, '2022-09-16 15:55:00', '2022-09-16 22:04:54');

-- --------------------------------------------------------

--
-- Table structure for table `violations`
--

CREATE TABLE `violations` (
  `violation_id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `description` text NOT NULL,
  `penalty` float NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `violations`
--

INSERT INTO `violations` (`violation_id`, `code`, `name`, `description`, `penalty`, `created_at`, `updated_at`) VALUES
(1, 'TVC-0001', 'Driving without a valid driver’s license', 'Driving without a valid license will result in a fine of ₱3,000. On top of the fine, this will result in you being disqualified from getting a driver’s license and not being able to drive for a year.', 3000, '2022-09-14 17:28:26', '2022-09-14 19:05:07'),
(2, 'TVC-0002', 'Driving under the influence of alcohol, dangerous drugs, and/or similar substance.', 'The RA No. 10586 was signed by the former President Benigno Aquino III on the 27th of May 2013. The law is also known as an Act Penalizing Persons Driving Under the Influence of Alcohol, Dangerous Drugs, and Other Similar Substances.', 20000, '2022-09-14 23:51:36', NULL),
(3, 'TVC-0003', 'Reckless driving', 'First offense	₱2,000; Second offense	₱3,000; Subsequent offense	₱10,000', 2000, '2022-09-14 23:52:42', NULL),
(4, 'TVC-0004', 'Not wearing a seatbelt', 'First offense	₱1,000; Second offense	₱2,000; Subsequent offense	₱5,000', 1000, '2022-09-14 23:53:21', '2022-09-15 02:17:23'),
(5, 'TVC-0005', 'Not wearing a helmet', 'First offense	₱1,500; Second offense	₱3,000; Third offense	₱5,000; Subsequent offense	₱10,000', 1500, '2022-09-14 23:54:23', '2022-09-15 02:17:32'),
(6, 'TVC-0006', 'Failure to carry a driver’s license or official registration', 'Failure to carry your driver’s license or official registration will result in an LTO fine of ₱1,000. Showing pictures of your driver’s license using your smartphone is not allowed.', 1000, '2022-09-14 23:54:57', NULL),
(7, 'TVC-0007', 'All other violations of traffic rules and regulation', 'Other violations of LTO traffic rules and regulations will result in a fine of ₱1,000. This includes the most common traffic violations like: Illegal parking, Disobeying traffic lights, Driving on prohibited roads, Failure to darken headlamps, and Illegal turn or overtaking.', 1000, '2022-09-14 23:55:59', NULL),
(8, 'TVC-0008', 'Unregistered vehicle', 'Driving an unregistered vehicle will result in a fine of ₱10,000.00. This includes expired, revoked, suspended, invalid registration, fake substitute, replacement engine, or chassis.', 10000, '2022-09-14 23:57:26', NULL),
(9, 'TVC-0009', 'Unauthorized modification', 'Modifying your vehicle without any authorization will result in a fine of ₱5,000.00. This includes changes in color and other unauthorized modifications of the standard manufacturer’s specification.', 5000, '2022-09-14 23:58:22', NULL),
(10, 'TVC-0010', 'Right-hand vehicle', 'Driving a right-hand vehicle will result in an LTO fine of ₱50,000.00. According to the Republic Act No. 8506, it is prohibited to operate a right-hand steering wheel motor vehicle on both public and private roads in the Philippines.', 50000, '2022-09-14 23:58:43', NULL),
(11, 'TVC-0011', 'Without or defective accessories, devices, equipment, and parts', 'The fine for driving a vehicle with defective parts is ₱5,000. This includes inappropriate use of bells, horns, whistles, blinkers, early warning devices (EWD), etc.', 5000, '2022-09-15 00:01:31', NULL),
(13, 'TVC-0011', 'sample violation name', 'Sample lang ito', 500000, '2022-09-15 16:53:27', NULL),
(14, 'TVC-0012', 'sample violation 12', 'sample lang ulit ito.', 55000, '2022-09-15 16:54:55', NULL),
(15, 'TVC-0013', 'Sample Violation Name 13', 'sample na sample na sample', 12000, '2022-09-15 16:55:59', NULL),
(16, 'TVC-0014', 'Sample Violation Name 13', 'sample na sample na sample', 12000, '2022-09-15 16:56:33', '2022-09-15 20:32:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`driver_id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `driver_id` (`driver_id`),
  ADD KEY `violation_id` (`violation_id`);

--
-- Indexes for table `violations`
--
ALTER TABLE `violations`
  ADD PRIMARY KEY (`violation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `violations`
--
ALTER TABLE `violations`
  MODIFY `violation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `records`
--
ALTER TABLE `records`
  ADD CONSTRAINT `records_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`driver_id`),
  ADD CONSTRAINT `records_ibfk_2` FOREIGN KEY (`violation_id`) REFERENCES `violations` (`violation_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
