-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2025 at 11:26 AM
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
  `ServicesName` text NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbldescription`
--

INSERT INTO `tbldescription` (`RowNum`, `UserID`, `ServicesName`, `Description`) VALUES
(1, '2108113524', '', 'askdjhakjsdkjawd\r\nasdlkhaslkdjkasjdjasd.\r\nlkjhasjdkajshdljkahsddd'),
(3, '716792885', 'Testing1233', 'asddd'),
(4, '716792885', 'aaa', 'asd'),
(5, '716792885', 'testing', 'Within 3 days ahead of the schedule of booking.');

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
  `ServicesName` text NOT NULL,
  `Images` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblprofimages`
--

INSERT INTO `tblprofimages` (`RowNum`, `UserID`, `ServicesName`, `Images`) VALUES
(13, '716792885', 'aaa', 'man.png'),
(14, '716792885', 'testing', 'man.png'),
(15, '716792885', 'Testing1233', 'men-women-who-show-love-each-other-b.png'),
(16, '716792885', 'Testing1233', 'men-women-who-show-love-each-other.png'),
(17, '716792885', 'Testing1233', 'watercolor-valentine-s-day-flowers-illustration-b.png');

-- --------------------------------------------------------

--
-- Table structure for table `tblreservedate`
--

CREATE TABLE `tblreservedate` (
  `id` int(11) NOT NULL,
  `UserID` varchar(50) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblreservedate`
--

INSERT INTO `tblreservedate` (`id`, `UserID`, `date`) VALUES
(53, '1848684243', '2024-09-17'),
(56, '1848684243', '2024-09-11'),
(59, '1848684243', '2024-09-18'),
(60, '716792885', '2025-02-26'),
(61, '716792885', '2025-02-27'),
(62, '716792885', '2025-02-28');

-- --------------------------------------------------------

--
-- Table structure for table `tblservices`
--

CREATE TABLE `tblservices` (
  `RowNum` int(11) NOT NULL,
  `UserID` varchar(50) NOT NULL,
  `ServicesName` varchar(50) NOT NULL,
  `Price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblservices`
--

INSERT INTO `tblservices` (`RowNum`, `UserID`, `ServicesName`, `Price`) VALUES
(1, '2108113524', 'Hair Cut', 500.00),
(2, '1848684243', 'asddd', 123.00),
(4, '716792885', 'Testing1233', 1200.00),
(5, '716792885', 'aaa', 500.00),
(6, '716792885', 'testing', 200.00);

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
(20, '1848684243', 'Company testing', '', '', 0, '0000-00-00 00:00:00', '', 'brgy1', 'kab', 'brgy 1 kab city', '1234567911', 'company', '93c731f1c3a84ef05cd54d044c379eaa', 'Artist', 'default.png', 'Accept'),
(21, '274811832', 'abc', 'abc', 'abc', 12, '2024-12-31 00:00:00', 'Single', 'abc', 'abc', 'abc', '9948487917', 'abc', '900150983cd24fb0d6963f7d28e17f72', 'Client', 'default.png', 'Accept'),
(22, '716792885', 'testing', 'testing', 'testing', 12, '2024-08-30 00:00:00', 'Married', 'testing', 'testing', 'testing', '9948487917', 'testing', 'ae2b1fca515949e5d54fb22b8ed95575', 'Artist', 'DSC_0350.JPG', 'Accept');

-- --------------------------------------------------------

--
-- Stand-in structure for view `viewbooking`
-- (See below for the actual view)
--
CREATE TABLE `viewbooking` (
`RowNum` int(11)
,`ArtistUserID` varchar(250)
,`FName` varchar(50)
,`MName` varchar(50)
,`LName` varchar(50)
,`Age` int(11)
,`Birthdate` datetime
,`CivilStatus` varchar(50)
,`CompleteAddress` varchar(250)
,`ContactNumber` char(10)
,`ProfImg` varchar(50)
,`ClientUserID` char(50)
,`TDate` datetime
,`Services` varchar(250)
,`Date` date
,`Time` time
,`PinLocationAddress` varchar(250)
,`SampleOutcome` bit(1)
,`SampleOutcomeImg` varchar(250)
,`Status` varchar(50)
);

-- --------------------------------------------------------

--
-- Structure for view `viewbooking`
--
DROP TABLE IF EXISTS `viewbooking`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewbooking`  AS SELECT `tblbooking`.`RowNum` AS `RowNum`, `tblbooking`.`ArtistUserID` AS `ArtistUserID`, `tbluser`.`FName` AS `FName`, `tbluser`.`MName` AS `MName`, `tbluser`.`LName` AS `LName`, `tbluser`.`Age` AS `Age`, `tbluser`.`Birthdate` AS `Birthdate`, `tbluser`.`CivilStatus` AS `CivilStatus`, `tbluser`.`CompleteAddress` AS `CompleteAddress`, `tbluser`.`ContactNumber` AS `ContactNumber`, `tbluser`.`ProfImg` AS `ProfImg`, `tblbooking`.`UserID` AS `ClientUserID`, `tblbooking`.`TDate` AS `TDate`, `tblbooking`.`Services` AS `Services`, `tblbooking`.`Date` AS `Date`, `tblbooking`.`Time` AS `Time`, `tblbooking`.`PinLocationAddress` AS `PinLocationAddress`, `tblbooking`.`SampleOutcome` AS `SampleOutcome`, `tblbooking`.`SampleOutcomeImg` AS `SampleOutcomeImg`, `tblbooking`.`Status` AS `Status` FROM (`tbluser` join `tblbooking`) WHERE `tbluser`.`UserID` = `tblbooking`.`UserID` ORDER BY `tbluser`.`RowNum` ASC ;

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
  MODIFY `RowNum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbldescription`
--
ALTER TABLE `tbldescription`
  MODIFY `RowNum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblmessages`
--
ALTER TABLE `tblmessages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `tblprofimages`
--
ALTER TABLE `tblprofimages`
  MODIFY `RowNum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tblreservedate`
--
ALTER TABLE `tblreservedate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `tblservices`
--
ALTER TABLE `tblservices`
  MODIFY `RowNum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `RowNum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
