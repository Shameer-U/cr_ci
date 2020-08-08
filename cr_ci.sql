-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2019 at 08:47 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `complaintsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `otp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `otp`) VALUES
(1, 'shameer', 'shameer@gmail.com', 'shami1234', '88451'),
(5, 'qwerty', 'qwerty@gmail.com', 'qwerty1234', '74464'),
(7, 'shameer', 'shameeru@gmail.com', 'shameershahul', '28434');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `complaint_no` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `mobile_no` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `complaint` varchar(255) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`complaint_no`, `customer_name`, `mobile_no`, `date`, `address`, `item_name`, `complaint`, `barcode`, `status`) VALUES
(39, 'tony stark aa', '1212121212', '17/08/2019', 't', 't', 't', 't', 'completed'),
(40, 'shameer', '1231231234', '17/08/2019', 'q', 'q', 'q', 'q', 'rejected'),
(41, 'shameer shahul ullattil', '1111111111', '17/08/2019', 'asdfghjkl', 'qw', 'wq', '', 'rejected'),
(42, 'shani shanid', '1111111111', '17/08/2019', 'sssssssssssss', 'ssssssssss', 'ssssssss', 'ssssssssss', 'pending'),
(43, 'jude', '1111111111', '17/08/2019', 'aaaaaaa', 'aaaaaaaa', 'aaaaaaaa', 'aaaaaaa', 'completed'),
(45, 'qqqqqqqqq', '1111111111', '17/08/2019', 'sssssss', 'd', 'd', 'd', 'approved'),
(60, 'sachin', '1212121212', '19/11/2019', 'dhfjhdjf', 'dfjdhfjh', 'shfjshjfh', 'jshfjhfh', 'approved'),
(61, 'what do you want', '2321321333', '19/11/2019', 'dfjdfhjfhhhhh', 'jfkjkfjkjjf', 'djfkjdfjdkjf', 'lskfkskff', 'approved'),
(62, 'alavi', '6575555555', '21/11/2019', 'hhhghgjhgjhg', 'hjhhjhhjhh', 'jkjkjjjjkjjjk', 'illa', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `status_track`
--

CREATE TABLE `status_track` (
  `id` int(11) NOT NULL,
  `complaint_no` varchar(255) NOT NULL,
  `pending` varchar(255) NOT NULL,
  `waiting_for_approval` varchar(255) NOT NULL,
  `approved` varchar(255) NOT NULL,
  `rejected` varchar(255) NOT NULL,
  `completed` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_track`
--

INSERT INTO `status_track` (`id`, `complaint_no`, `pending`, `waiting_for_approval`, `approved`, `rejected`, `completed`) VALUES
(5, '38', '17-08-2019', '17-08-2019', '17-08-2019', '18-10-2019', '25-09-2019'),
(6, '39', '28-11-2019', '28-11-2019', '28-11-2019', '31-10-2019', '28-11-2019'),
(7, '40', '18-10-2019', '18-10-2019', '18-10-2019', '27-10-2019', '18-10-2019'),
(8, '41', '17-08-2019', '17-08-2019', '17-08-2019', '27-10-2019', '17-08-2019'),
(9, '42', '17-08-2019', '17-08-2019', '17-08-2019', '17-08-2019', '17-08-2019'),
(10, '43', '17-08-2019', '17-08-2019', '17-08-2019', '17-08-2019', '21-11-2019'),
(11, '44', '17-08-2019', '17-08-2019', '18-11-2019', '18-11-2019', '17-08-2019'),
(12, '45', '17/08/2019', '17-08-2019', '18-10-2019', '17-08-2019', '17-08-2019'),
(13, '46', '19/08/2019', '19-08-2019', '19-08-2019', '', '19-08-2019'),
(14, '47', '03/10/2019', '', '', '', '31-10-2019'),
(15, '49', '01/10/2019', '', '', '', ''),
(16, '50', '27/10/2019', '27-10-2019', '', '', ''),
(17, '60', '19/11/2019', '', '18-11-2019', '', ''),
(18, '61', '19/11/2019', '18-11-2019', '18-11-2019', '', ''),
(19, '62', '21/11/2019', '', '21-11-2019', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`complaint_no`);

--
-- Indexes for table `status_track`
--
ALTER TABLE `status_track`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `complaint_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `status_track`
--
ALTER TABLE `status_track`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
