-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2021 at 03:25 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `currencyconversiondb`
--
CREATE DATABASE IF NOT EXISTS `currencyconversiondb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `currencyconversiondb`;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE `client` (
  `clientID` int(11) NOT NULL,
  `clientName` varchar(50) NOT NULL,
  `licenseNumber` varchar(256) NOT NULL,
  `licenseStartDate` date NOT NULL,
  `licenseEndDate` date NOT NULL,
  `licenseKey` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`clientID`, `clientName`, `licenseNumber`, `licenseStartDate`, `licenseEndDate`, `licenseKey`) VALUES
(1, 'TechInc', 'ABC123', '2021-10-12', '2021-12-24', 'KEYABC123');

-- --------------------------------------------------------

--
-- Table structure for table `conversion`
--

DROP TABLE IF EXISTS `conversion`;
CREATE TABLE `conversion` (
  `conversionID` int(11) NOT NULL,
  `clientID` int(11) NOT NULL,
  `requestDate` date NOT NULL,
  `completionDate` date NOT NULL,
  `originalCurrency` varchar(3) NOT NULL,
  `convertedCurrency` varchar(3) NOT NULL,
  `originalAmount` decimal(38,2) NOT NULL,
  `convertedAmount` decimal(38,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `conversion`
--

INSERT INTO `conversion` (`conversionID`, `clientID`, `requestDate`, `completionDate`, `originalCurrency`, `convertedCurrency`, `originalAmount`, `convertedAmount`) VALUES
(4, 1, '2021-12-13', '2021-12-13', 'USD', 'CAD', '11.00', '31.00');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
CREATE TABLE `currencies` (
  `currency_id` int(11) NOT NULL,
  `currency` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`currency_id`, `currency`) VALUES
(1, 'USD'),
(2, 'EUR'),
(3, 'JPY'),
(4, 'GBP'),
(5, 'AUD'),
(6, 'CAD'),
(7, 'CHF'),
(8, 'CNY'),
(9, 'HKD'),
(10, 'NZD');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`clientID`);

--
-- Indexes for table `conversion`
--
ALTER TABLE `conversion`
  ADD PRIMARY KEY (`conversionID`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`currency_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `clientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `conversion`
--
ALTER TABLE `conversion`
  MODIFY `conversionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `currency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
