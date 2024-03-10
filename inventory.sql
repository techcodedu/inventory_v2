-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2024 at 11:08 AM
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
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CategoryID`, `CategoryName`) VALUES
(5, 'AIDE'),
(8, 'ANIMAL BITE TREATMENT CENTER'),
(3, 'DENTAL CLINIC'),
(1, 'LABORATORY SUPPLIES'),
(11, 'MEDICAL EQUIPMENT'),
(2, 'MEDICAL SUPPLIES'),
(10, 'MEDICINES'),
(12, 'PROCUREMENT OF IT EQUIPMENT'),
(13, 'PROCUREMENT OF OFFICE EQUIPMENT'),
(14, 'PROCUREMENT OF OTHER MACHINERIES'),
(4, 'SANITARY OFFICE'),
(6, 'TB-DOTS'),
(9, 'VACCINATION'),
(7, 'X-RAY / ULTRASOUND');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_transactions`
--

CREATE TABLE `inventory_transactions` (
  `TransactionID` int(11) NOT NULL,
  `ItemID` int(11) NOT NULL,
  `QuantityChanged` int(11) NOT NULL,
  `TransactionType` enum('IN','OUT') NOT NULL,
  `TransactionDate` datetime NOT NULL DEFAULT current_timestamp(),
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `ItemID` int(11) NOT NULL,
  `Code` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `UnitOfMeasure` varchar(255) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `EstimatedBudget` decimal(10,2) NOT NULL,
  `ModeOfProcurement` varchar(255) NOT NULL,
  `CategoryID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ItemID`, `Code`, `Name`, `Description`, `UnitOfMeasure`, `Quantity`, `EstimatedBudget`, `ModeOfProcurement`, `CategoryID`) VALUES
(29, 'sx', 'sx', 'sx', 'sx', 4, 5.00, 'sx', 8),
(30, 'aa', 'aa', 'ax', 'aa', 3, 34.00, 'aa', 3);

-- --------------------------------------------------------

--
-- Table structure for table `procurement_schedule`
--

CREATE TABLE `procurement_schedule` (
  `ScheduleID` int(11) NOT NULL,
  `ItemID` int(11) NOT NULL,
  `PlannedDate` date NOT NULL,
  `MilestoneDescription` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `RoleID` int(11) NOT NULL,
  `RoleName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`RoleID`, `RoleName`) VALUES
(1, 'Administrator'),
(3, 'Staff'),
(2, 'Supply Officer');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `RoleID` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `RoleID`, `Email`, `Created_at`) VALUES
(1, 'admin', '$2a$12$yuhqz8HJMu74sMpC.Di2tuVprzJmo0ZNnqe6EmPiDEAN1tzorGxC2', 1, 'admin@example.com', '2024-02-19 22:30:08'),
(2, 'supply_officer', '$2a$12$yuhqz8HJMu74sMpC.Di2tuVprzJmo0ZNnqe6EmPiDEAN1tzorGxC2', 2, 'supply@example.com', '2024-02-19 22:30:08'),
(3, 'staff1', '$2a$12$yuhqz8HJMu74sMpC.Di2tuVprzJmo0ZNnqe6EmPiDEAN1tzorGxC2', 3, 'staff1@example.com', '2024-02-19 22:30:08'),
(4, 'staff2', '$2a$12$yuhqz8HJMu74sMpC.Di2tuVprzJmo0ZNnqe6EmPiDEAN1tzorGxC2', 3, 'staff2@example.com', '2024-02-19 22:30:08'),
(5, 'staff3', '$2a$12$yuhqz8HJMu74sMpC.Di2tuVprzJmo0ZNnqe6EmPiDEAN1tzorGxC2', 3, 'staff3@example.com', '2024-02-19 22:30:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryID`),
  ADD UNIQUE KEY `CategoryName` (`CategoryName`);

--
-- Indexes for table `inventory_transactions`
--
ALTER TABLE `inventory_transactions`
  ADD PRIMARY KEY (`TransactionID`),
  ADD KEY `ItemID` (`ItemID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`ItemID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- Indexes for table `procurement_schedule`
--
ALTER TABLE `procurement_schedule`
  ADD PRIMARY KEY (`ScheduleID`),
  ADD KEY `ItemID` (`ItemID`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`RoleID`),
  ADD UNIQUE KEY `RoleName` (`RoleName`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `RoleID` (`RoleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `inventory_transactions`
--
ALTER TABLE `inventory_transactions`
  MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `procurement_schedule`
--
ALTER TABLE `procurement_schedule`
  MODIFY `ScheduleID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `RoleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory_transactions`
--
ALTER TABLE `inventory_transactions`
  ADD CONSTRAINT `inventory_transactions_ibfk_1` FOREIGN KEY (`ItemID`) REFERENCES `items` (`ItemID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inventory_transactions_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`CategoryID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `procurement_schedule`
--
ALTER TABLE `procurement_schedule`
  ADD CONSTRAINT `procurement_schedule_ibfk_1` FOREIGN KEY (`ItemID`) REFERENCES `items` (`ItemID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `roles` (`RoleID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
