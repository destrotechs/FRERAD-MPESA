-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2020 at 12:30 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `radiusdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `amount` double(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `amount`) VALUES
(1, 'dailyplan', 50.00),
(2, 'weekly', 300.00);

-- --------------------------------------------------------

--
-- Table structure for table `radcheck`
--

CREATE TABLE `radcheck` (
  `id` int(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `attribute` varchar(20) NOT NULL,
  `op` varchar(10) NOT NULL,
  `value` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `radcheck`
--

INSERT INTO `radcheck` (`id`, `username`, `attribute`, `op`, `value`) VALUES
(1, 'destro', 'Cleartext-Password', ':=', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `radgroupcheck`
--

CREATE TABLE `radgroupcheck` (
  `id` int(100) NOT NULL,
  `groupname` varchar(20) NOT NULL,
  `attribute` varchar(20) NOT NULL,
  `op` varchar(20) NOT NULL,
  `value` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `radgroupcheck`
--

INSERT INTO `radgroupcheck` (`id`, `groupname`, `attribute`, `op`, `value`) VALUES
(1, 'daiylplan', 'Simultaneous-Use', ':=', '1');

-- --------------------------------------------------------

--
-- Table structure for table `radgroupreply`
--

CREATE TABLE `radgroupreply` (
  `id` int(100) NOT NULL,
  `groupname` varchar(20) NOT NULL,
  `attribute` varchar(100) NOT NULL,
  `op` varchar(20) NOT NULL,
  `value` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `radgroupreply`
--

INSERT INTO `radgroupreply` (`id`, `groupname`, `attribute`, `op`, `value`) VALUES
(1, 'daiylplan', 'WISPr-Bandwidth-Max-Up', ':=', '512000'),
(2, 'dailyplan', 'WISPr-Bandwidth-Max-Down', ':=', '750000');

-- --------------------------------------------------------

--
-- Table structure for table `radreply`
--

CREATE TABLE `radreply` (
  `id` int(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `attribute` varchar(50) NOT NULL,
  `op` varchar(20) NOT NULL,
  `value` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `radreply`
--

INSERT INTO `radreply` (`id`, `username`, `attribute`, `op`, `value`) VALUES
(1, 'destro', 'WISPr-Session-Terminate-Time', ':=', '2020-03-05T11:55:48');

-- --------------------------------------------------------

--
-- Table structure for table `radusergroup`
--

CREATE TABLE `radusergroup` (
  `id` int(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `groupname` varchar(50) NOT NULL,
  `priority` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `radusergroup`
--

INSERT INTO `radusergroup` (`id`, `username`, `groupname`, `priority`) VALUES
(1, 'destro', 'dailyplan', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tempaccount`
--

CREATE TABLE `tempaccount` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `phone` int(20) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tempaccount`
--

INSERT INTO `tempaccount` (`id`, `name`, `phone`, `email`, `username`, `password`) VALUES
(1, 'morris mbae', 701530647, 'morrisdestro@gmail.com', 'destro', '123456'),
(2, 'mike mortisonm', 790261115, '', 'mike', '123456'),
(3, 'Morris Mbae', 703330749, 'dianamukami@gmail.com', 'kami', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `amount` int(100) NOT NULL,
  `plan` varchar(50) NOT NULL,
  `transaction_id` varchar(100) NOT NULL,
  `transaction_date` int(50) NOT NULL,
  `phone_number` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `username`, `payment_method`, `amount`, `plan`, `transaction_id`, `transaction_date`, `phone_number`) VALUES
(1, 'destro', 'M-Pesa', 1, 'dailyplan', 'OC47IP5P95', 2147483647, 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `userbillinginfo`
--

CREATE TABLE `userbillinginfo` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `phone` int(20) NOT NULL,
  `paymentmethod` varchar(20) NOT NULL,
  `transaction_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `radcheck`
--
ALTER TABLE `radcheck`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `radgroupcheck`
--
ALTER TABLE `radgroupcheck`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `radgroupreply`
--
ALTER TABLE `radgroupreply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `radreply`
--
ALTER TABLE `radreply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `radusergroup`
--
ALTER TABLE `radusergroup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tempaccount`
--
ALTER TABLE `tempaccount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userbillinginfo`
--
ALTER TABLE `userbillinginfo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `radcheck`
--
ALTER TABLE `radcheck`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `radgroupcheck`
--
ALTER TABLE `radgroupcheck`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `radgroupreply`
--
ALTER TABLE `radgroupreply`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `radreply`
--
ALTER TABLE `radreply`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `radusergroup`
--
ALTER TABLE `radusergroup`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tempaccount`
--
ALTER TABLE `tempaccount`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `userbillinginfo`
--
ALTER TABLE `userbillinginfo`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
