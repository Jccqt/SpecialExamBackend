-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2025 at 03:16 AM
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
-- Table structure for table `applicationcourseexam`
--

CREATE TABLE `applicationcourseexam` (
  `ApplicationID` varchar(50) NOT NULL,
  `CourseID` varchar(50) NOT NULL,
  `ExamID` varchar(50) NOT NULL,
  `Room` varchar(50) NOT NULL,
  `ExamDate` date DEFAULT NULL,
  `CourseExamStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `applicationimages`
--

CREATE TABLE `applicationimages` (
  `ImageID` int(11) NOT NULL,
  `ApplicationID` varchar(50) NOT NULL,
  `ImageName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `ApplicationID` varchar(50) NOT NULL,
  `UserID` varchar(50) NOT NULL,
  `ProgramID` varchar(50) NOT NULL,
  `ReasonType` varchar(50) NOT NULL,
  `Reason` varchar(255) NOT NULL,
  `PaymentType` varchar(50) DEFAULT NULL,
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
('EXAM1', '2025', '2026', 'PRELIM', 1, '2025-05-31', '2025-06-07', 1);

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

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`LogID`, `UserID`, `LogType`, `Description`, `date`) VALUES
('LOG1', '02000286986', 'LOGIN', 'Has logged in on mobile app', '2025-05-31 07:20:00'),
('LOG2', '02000286986', 'LOGIN', 'Has logged in on mobile app', '2025-05-31 07:36:00'),
('LOG3', '02000286986', 'LOGIN', 'Has logged in on mobile app', '2025-05-31 07:36:00'),
('LOG4', '02000286986', 'LOGIN', 'Has logged in on mobile app', '2025-05-31 07:38:00'),
('LOG5', '02000286986', 'LOGIN', 'Has logged in on mobile app', '2025-05-31 08:11:00'),
('LOG6', '02000286986', 'LOGIN', 'Has logged in on mobile app', '2025-05-31 08:13:00'),
('LOG7', '02000286986', 'LOGIN', 'Has logged in on mobile app', '2025-05-31 10:14:00'),
('LOG8', '02000286986', 'LOGIN', 'Has logged in on mobile app', '2025-05-31 11:00:00'),
('LOG9', '297700', 'LOGIN', 'Has logged in on mobile app', '2025-06-06 07:40:00');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `NotificationID` int(11) NOT NULL,
  `UserID` varchar(50) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Message` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`NotificationID`, `UserID`, `Title`, `Message`, `date`) VALUES
(5, '02000286986', 'APPLICATION1 result', 'APPLICATION1 has been Approved', '2025-05-31'),
(6, '02000286986', 'APPLICATION2 result', 'APPLICATION2 has been Approved', '2025-05-31'),
(7, '02000286986', 'APPLICATION3 result', 'APPLICATION3 has been Declined', '2025-05-31');

-- --------------------------------------------------------

--
-- Table structure for table `programcourses`
--

CREATE TABLE `programcourses` (
  `ProgramID` varchar(50) NOT NULL,
  `CourseID` varchar(50) NOT NULL,
  `Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programcourses`
--

INSERT INTO `programcourses` (`ProgramID`, `CourseID`, `Status`) VALUES
('BSIT3A', 'GE1904', 1),
('BSIT3A', 'IT1914', 1),
('BSIT3A', 'IT1915', 1),
('BSIT3A', 'IT1918', 1),
('BSIT3A', 'IT2034', 1),
('BSIT3A', 'IT2301', 1),
('BSIT3A', 'IT2409', 1);

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
('BSIT3A', '02000286986', 1),
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
('02000286986', 'Adrianne', 'Villa', 'Lapada', 'villa.286986@balagtas.sti.edu.ph', '$2y$10$qYz2vDGjlo5Axct1c9npie78sxTSe8LLG9thkYtRVxUqfdnT.95mS', 'Student', 1, 13),
('297700', 'Jose Crisanto', 'Calayag', 'Buensuceso', 'calayag.297700@balagtas.sti.edu.ph', '$2y$10$Mook6nuGdxxK0UHEugzHtOLq.KwQzBz7HwQS.NOCEMAkKbp.lnU8u', 'Student', 1, 21),
('PROGHEAD1', 'Regina', 'Mape', 'R.', '123sample@balagtas.sti.edu.ph', '$2y$10$qVO1xCkIgPRB9gpe0Jt44.DxRViItf/Hi6IoxaCJEi1DXE.QKLKjO', 'Academic Head', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicationcourseexam`
--
ALTER TABLE `applicationcourseexam`
  ADD PRIMARY KEY (`ApplicationID`,`CourseID`,`ExamID`),
  ADD KEY `ApplicationCourseExam->Courses` (`CourseID`),
  ADD KEY `ApplicationCourseExam->Examinations` (`ExamID`);

--
-- Indexes for table `applicationimages`
--
ALTER TABLE `applicationimages`
  ADD PRIMARY KEY (`ImageID`),
  ADD KEY `ApplicationImages->Applications` (`ApplicationID`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`ApplicationID`),
  ADD KEY `Applications->Users` (`UserID`),
  ADD KEY `Applications->Programs` (`ProgramID`);

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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`NotificationID`),
  ADD KEY `Notifications->Users` (`UserID`);

--
-- Indexes for table `programcourses`
--
ALTER TABLE `programcourses`
  ADD PRIMARY KEY (`ProgramID`,`CourseID`),
  ADD KEY `ProgramCourses->Courses` (`CourseID`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`ProgramID`),
  ADD KEY `Programs->Users` (`UserID`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicationimages`
--
ALTER TABLE `applicationimages`
  MODIFY `ImageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `NotificationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applicationcourseexam`
--
ALTER TABLE `applicationcourseexam`
  ADD CONSTRAINT `ApplicationCourseExam->Applications` FOREIGN KEY (`ApplicationID`) REFERENCES `applications` (`ApplicationID`),
  ADD CONSTRAINT `ApplicationCourseExam->Courses` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`),
  ADD CONSTRAINT `ApplicationCourseExam->Examinations` FOREIGN KEY (`ExamID`) REFERENCES `examinations` (`ExamID`);

--
-- Constraints for table `applicationimages`
--
ALTER TABLE `applicationimages`
  ADD CONSTRAINT `ApplicationImages->Applications` FOREIGN KEY (`ApplicationID`) REFERENCES `applications` (`ApplicationID`);

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `Applications->Programs` FOREIGN KEY (`ProgramID`) REFERENCES `programs` (`ProgramID`),
  ADD CONSTRAINT `Applications->Users` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `Logs->Users` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `Notifications->Users` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `programcourses`
--
ALTER TABLE `programcourses`
  ADD CONSTRAINT `ProgramCourses->Courses` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`),
  ADD CONSTRAINT `ProgramCourses->Programs` FOREIGN KEY (`ProgramID`) REFERENCES `programs` (`ProgramID`);

--
-- Constraints for table `programs`
--
ALTER TABLE `programs`
  ADD CONSTRAINT `Programs->Users` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

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
