-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2025 at 09:21 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cpsu_be`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblbooking`
--

CREATE TABLE `tblbooking` (
  `RowNum` int(11) NOT NULL,
  `ArtistUserID` varchar(250) NOT NULL,
  `UserID` char(50) NOT NULL,
  `TDate` datetime NOT NULL,
  `PinLocationAddress` varchar(250) NOT NULL,
  `Services` varchar(250) NOT NULL,
  `OtherNameServices` text DEFAULT NULL,
  `TypeService` text NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `SampleOutcome` bit(1) NOT NULL,
  `SampleOutcomeImg` varchar(250) NOT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbldescription`
--

CREATE TABLE `tbldescription` (
  `RowNum` int(11) NOT NULL,
  `UserID` varchar(250) NOT NULL,
  `ServiceCatNo` int(11) NOT NULL,
  `ServicesName` text DEFAULT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblmessages`
--

CREATE TABLE `tblmessages` (
  `id` int(11) NOT NULL,
  `UserID` int(50) NOT NULL,
  `receiver_id` int(50) NOT NULL,
  `message` text NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `StatusRead` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblprofimages`
--

CREATE TABLE `tblprofimages` (
  `RowNum` int(11) NOT NULL,
  `UserID` varchar(50) NOT NULL,
  `ServiceCatNo` int(11) NOT NULL,
  `ServicesName` text NOT NULL,
  `Images` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblreservedate`
--

CREATE TABLE `tblreservedate` (
  `id` int(11) NOT NULL,
  `UserID` varchar(50) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblreview`
--

CREATE TABLE `tblreview` (
  `id` int(11) NOT NULL,
  `UserID` varchar(250) NOT NULL,
  `ArtistUserID` varchar(250) NOT NULL,
  `RevStars` double NOT NULL,
  `RevMessage` varchar(250) NOT NULL,
  `Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblservicecategory`
--

CREATE TABLE `tblservicecategory` (
  `id` int(11) NOT NULL,
  `ServiceName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblservicecategory`
--

INSERT INTO `tblservicecategory` (`id`, `ServiceName`) VALUES
(1, 'Facials'),
(2, 'Waxing'),
(3, 'Threading'),
(4, 'Eyelash Extensions'),
(5, 'Brow Tinting'),
(6, 'Manicures'),
(7, 'Pedicures'),
(8, 'Makeup Application'),
(9, 'Hair Coloring'),
(10, 'Hair Styling'),
(11, 'Haircuts'),
(12, 'Spray Tanning'),
(13, 'Microblading'),
(14, 'Chemical Peels'),
(15, 'Acne Treatments'),
(16, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `tblservices`
--

CREATE TABLE `tblservices` (
  `RowNum` int(11) NOT NULL,
  `UserID` varchar(50) NOT NULL,
  `ServiceCatNo` int(11) NOT NULL,
  `ServicesName` varchar(50) DEFAULT NULL,
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
  `ContactNumber` char(10) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(250) NOT NULL,
  `TypeUser` varchar(50) NOT NULL,
  `ProfImg` varchar(50) NOT NULL,
  `Status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`RowNum`, `UserID`, `FName`, `MName`, `LName`, `Age`, `Birthdate`, `CivilStatus`, `Brgy`, `City`, `CompleteAddress`, `ContactNumber`, `UserName`, `Password`, `TypeUser`, `ProfImg`, `Status`) VALUES
(3, '560350889', 'admin1', 'admin1', 'admin1', 12, '2024-12-31 00:00:00', 'Single', 'admin1', 'admin1', 'admin1', '', 'admin1', 'e00cf25ad42683b3df678c61f42c6bda', 'Admin', 'default.png', NULL),
(27, '693930370', 'artist1', 'artist1', 'artist1', 25, '2000-08-07 00:00:00', 'Single', 'artist1', 'artist1', 'artist1', '9948487917', 'artist1', '8507c08cd2743274878fb97302e42cf8', 'Artist', 'default.png', 'Accept'),
(28, '1762237924', 'client', 'client', 'client', 25, '2000-08-07 00:00:00', 'Single', 'client', 'client', 'client', '9948487917', 'client', '62608e08adc29a8d6dbc9754e659f125', 'Client', 'default.png', 'Accept');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblbooking`
--
ALTER TABLE `tblbooking`
  ADD PRIMARY KEY (`RowNum`,`ArtistUserID`);

--
-- Indexes for table `tbldescription`
--
ALTER TABLE `tbldescription`
  ADD PRIMARY KEY (`RowNum`,`UserID`);

--
-- Indexes for table `tblmessages`
--
ALTER TABLE `tblmessages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblprofimages`
--
ALTER TABLE `tblprofimages`
  ADD PRIMARY KEY (`RowNum`,`UserID`);

--
-- Indexes for table `tblreservedate`
--
ALTER TABLE `tblreservedate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblreview`
--
ALTER TABLE `tblreview`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblservicecategory`
--
ALTER TABLE `tblservicecategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblservices`
--
ALTER TABLE `tblservices`
  ADD PRIMARY KEY (`RowNum`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`RowNum`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblbooking`
--
ALTER TABLE `tblbooking`
  MODIFY `RowNum` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbldescription`
--
ALTER TABLE `tbldescription`
  MODIFY `RowNum` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblmessages`
--
ALTER TABLE `tblmessages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblprofimages`
--
ALTER TABLE `tblprofimages`
  MODIFY `RowNum` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblreservedate`
--
ALTER TABLE `tblreservedate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblreview`
--
ALTER TABLE `tblreview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblservicecategory`
--
ALTER TABLE `tblservicecategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tblservices`
--
ALTER TABLE `tblservices`
  MODIFY `RowNum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `RowNum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
