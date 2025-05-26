-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2025 at 10:21 AM
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
-- Database: `exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `AnnouncementID` varchar(50) NOT NULL,
  `UserID` varchar(50) NOT NULL,
  `Recipient` varchar(50) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Message` varchar(255) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `ApplicationID` varchar(50) NOT NULL,
  `UserID` varchar(50) NOT NULL,
  `ReasonType` varchar(50) NOT NULL,
  `Reason` varchar(255) NOT NULL,
  `ApplicationDate` datetime NOT NULL,
  `VerdictDate` datetime DEFAULT NULL,
  `ApplicationStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `CourseID` varchar(50) NOT NULL,
  `CourseName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`CourseID`, `CourseName`) VALUES
('GE1904', 'Great Books'),
('IT1914', 'Information Assurance and Security'),
('IT1915', 'Management Information System'),
('IT1918', 'Mobile Systems and Technologies'),
('IT2034', 'IT Capstone Project 1'),
('IT2301', 'Web Systems and Technologies'),
('IT2409', 'Programming Languages');

-- --------------------------------------------------------

--
-- Table structure for table `examinations`
--

CREATE TABLE `examinations` (
  `ExamID` varchar(50) NOT NULL,
  `SchoolYearStart` year(4) NOT NULL,
  `SchoolYearEnd` year(4) NOT NULL,
  `GradingPeriod` varchar(50) NOT NULL,
  `Term` int(11) NOT NULL,
  `SubmissionStart` date NOT NULL,
  `SubmissionEnd` date NOT NULL,
  `ExamStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `examinations`
--

INSERT INTO `examinations` (`ExamID`, `SchoolYearStart`, `SchoolYearEnd`, `GradingPeriod`, `Term`, `SubmissionStart`, `SubmissionEnd`, `ExamStatus`) VALUES
('EXAM1', '2024', '2025', 'MIDTERM', 2, '2025-05-27', '2025-05-30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `LogID` varchar(50) NOT NULL,
  `UserID` varchar(50) NOT NULL,
  `LogType` varchar(50) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `ProgramID` varchar(50) NOT NULL,
  `UserID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`ProgramID`, `UserID`) VALUES
('BSIT3A', 'PROGHEAD1');

-- --------------------------------------------------------

--
-- Table structure for table `studentcourses`
--

CREATE TABLE `studentcourses` (
  `CourseID` varchar(50) NOT NULL,
  `UserID` varchar(50) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studentcourses`
--

INSERT INTO `studentcourses` (`CourseID`, `UserID`, `Status`) VALUES
('GE1904', '297700', 1),
('IT1914', '297700', 1),
('IT1915', '297700', 1),
('IT1918', '297700', 1),
('IT2034', '297700', 1),
('IT2301', '297700', 1),
('IT2409', '297700', 1);

-- --------------------------------------------------------

--
-- Table structure for table `studentprograms`
--

CREATE TABLE `studentprograms` (
  `ProgramID` varchar(50) NOT NULL,
  `UserID` varchar(50) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studentprograms`
--

INSERT INTO `studentprograms` (`ProgramID`, `UserID`, `Status`) VALUES
('BSIT3A', '297700', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` varchar(50) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `MiddleName` varchar(50) DEFAULT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(250) NOT NULL,
  `Role` varchar(50) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 1,
  `LogCount` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `FirstName`, `LastName`, `MiddleName`, `Email`, `Password`, `Role`, `Status`, `LogCount`) VALUES
('297700', 'Jose Crisanto', 'Calayag', 'Buensuceso', 'calayag.297700@balagtas.sti.edu.ph', '$2y$10$Mook6nuGdxxK0UHEugzHtOLq.KwQzBz7HwQS.NOCEMAkKbp.lnU8u', 'Student', 1, 17),
('PROGHEAD1', 'Regina', 'Mape', 'R.', '123sample@balagtas.sti.edu.ph', '$2y$10$qVO1xCkIgPRB9gpe0Jt44.DxRViItf/Hi6IoxaCJEi1DXE.QKLKjO', 'Program Head', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`AnnouncementID`),
  ADD KEY `Announcements->Users` (`UserID`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`ApplicationID`),
  ADD KEY `Applications->Users` (`UserID`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`CourseID`);

--
-- Indexes for table `examinations`
--
ALTER TABLE `examinations`
  ADD PRIMARY KEY (`ExamID`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`LogID`),
  ADD KEY `Logs->Users` (`UserID`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`ProgramID`),
  ADD KEY `Programs->Users` (`UserID`);

--
-- Indexes for table `studentcourses`
--
ALTER TABLE `studentcourses`
  ADD PRIMARY KEY (`CourseID`,`UserID`),
  ADD KEY `StudentCourses->Users` (`UserID`);

--
-- Indexes for table `studentprograms`
--
ALTER TABLE `studentprograms`
  ADD PRIMARY KEY (`ProgramID`,`UserID`),
  ADD KEY `StudentPrograms->Users` (`UserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `Announcements->Users` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `Applications->Users` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `Logs->Users` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `programs`
--
ALTER TABLE `programs`
  ADD CONSTRAINT `Programs->Users` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `studentcourses`
--
ALTER TABLE `studentcourses`
  ADD CONSTRAINT `StudentCourses->Courses` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`),
  ADD CONSTRAINT `StudentCourses->Users` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `studentprograms`
--
ALTER TABLE `studentprograms`
  ADD CONSTRAINT `StudentPrograms->Programs` FOREIGN KEY (`ProgramID`) REFERENCES `programs` (`ProgramID`),
  ADD CONSTRAINT `StudentPrograms->Users` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
