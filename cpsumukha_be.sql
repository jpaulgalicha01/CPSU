-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2024 at 11:46 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cpsumukha_be`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblprofimages`
--

CREATE TABLE `tblprofimages` (
  `RowNum` int(11) NOT NULL,
  `UserID` varchar(50) NOT NULL,
  `Images` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblservices`
--

CREATE TABLE `tblservices` (
  `RowNum` int(11) NOT NULL,
  `UserID` varchar(50) NOT NULL,
  `Images` varchar(250) NOT NULL,
  `ServicesName` varchar(50) NOT NULL,
  `Price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `RowNum` int(11) NOT NULL,
  `UserID` varchar(250) NOT NULL,
  `FName` varchar(50) NOT NULL,
  `MName` varchar(50) NOT NULL,
  `LName` varchar(50) NOT NULL,
  `Age` int(11) NOT NULL,
  `Birthdate` datetime NOT NULL,
  `CivilStatus` varchar(50) NOT NULL,
  `Brgy` varchar(50) NOT NULL,
  `City` varchar(50) NOT NULL,
  `CompleteAddress` varchar(250) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(250) NOT NULL,
  `TypeUser` varchar(50) NOT NULL,
  `ProfImg` varchar(50) NOT NULL,
  `Status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`RowNum`, `UserID`, `FName`, `MName`, `LName`, `Age`, `Birthdate`, `CivilStatus`, `Brgy`, `City`, `CompleteAddress`, `UserName`, `Password`, `TypeUser`, `ProfImg`, `Status`) VALUES
(3, '560350889', 'admin1', 'admin1', 'admin1', 12, '2024-12-31 00:00:00', 'Single', 'admin1', 'admin1', 'admin1', 'admin1', 'e00cf25ad42683b3df678c61f42c6bda', 'Admin', 'default.png', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblprofimages`
--
ALTER TABLE `tblprofimages`
  ADD PRIMARY KEY (`RowNum`,`UserID`);

--
-- Indexes for table `tblservices`
--
ALTER TABLE `tblservices`
  ADD PRIMARY KEY (`RowNum`,`UserID`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`RowNum`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblprofimages`
--
ALTER TABLE `tblprofimages`
  MODIFY `RowNum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblservices`
--
ALTER TABLE `tblservices`
  MODIFY `RowNum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `RowNum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
