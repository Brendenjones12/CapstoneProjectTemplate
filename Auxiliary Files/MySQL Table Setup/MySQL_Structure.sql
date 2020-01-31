-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2020 at 12:25 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `3isds27gpp`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `classID` int(11) NOT NULL,
  `crseID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sectNum` int(11) NOT NULL,
  `crseName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classquestions`
--

CREATE TABLE `classquestions` (
  `classID` int(11) NOT NULL,
  `quesID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classsyllabus`
--

CREATE TABLE `classsyllabus` (
  `classID` int(11) NOT NULL,
  `syllabusID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classuserroster`
--

CREATE TABLE `classuserroster` (
  `classID` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `quesID` int(11) NOT NULL,
  `qtext` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `atext` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `syllabus`
--

CREATE TABLE `syllabus` (
  `syllabusID` int(11) NOT NULL,
  `courseTitle` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `contactInformation` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `officeHoursPolicy` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `courseDescription` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `courseGoals` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `requiredMaterials` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `gradingPolicy` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `attendancePolicy` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `universityPolicy` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `studentResources` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

CREATE TABLE `university` (
  `uniID` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `universityclassroster`
--

CREATE TABLE `universityclassroster` (
  `uniID` int(11) NOT NULL,
  `classID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `universityusersroster`
--

CREATE TABLE `universityusersroster` (
  `uniID` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isProf` tinyint(1) NOT NULL,
  `userID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`classID`);

--
-- Indexes for table `classquestions`
--
ALTER TABLE `classquestions`
  ADD PRIMARY KEY (`classID`,`quesID`),
  ADD KEY `quesID` (`quesID`);

--
-- Indexes for table `classsyllabus`
--
ALTER TABLE `classsyllabus`
  ADD PRIMARY KEY (`classID`,`syllabusID`),
  ADD KEY `syllabusID` (`syllabusID`);

--
-- Indexes for table `classuserroster`
--
ALTER TABLE `classuserroster`
  ADD PRIMARY KEY (`classID`,`username`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`quesID`);

--
-- Indexes for table `syllabus`
--
ALTER TABLE `syllabus`
  ADD PRIMARY KEY (`syllabusID`);

--
-- Indexes for table `university`
--
ALTER TABLE `university`
  ADD PRIMARY KEY (`uniID`);

--
-- Indexes for table `universityclassroster`
--
ALTER TABLE `universityclassroster`
  ADD PRIMARY KEY (`uniID`,`classID`),
  ADD KEY `classID` (`classID`);

--
-- Indexes for table `universityusersroster`
--
ALTER TABLE `universityusersroster`
  ADD PRIMARY KEY (`uniID`,`username`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `classID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `quesID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `syllabus`
--
ALTER TABLE `syllabus`
  MODIFY `syllabusID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `university`
--
ALTER TABLE `university`
  MODIFY `uniID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `universityusersroster`
--
ALTER TABLE `universityusersroster`
  ADD CONSTRAINT `UniversityUsersRoster_ibfk_1` FOREIGN KEY (`uniID`) REFERENCES `university` (`uniID`) ON DELETE CASCADE,
  ADD CONSTRAINT `UniversityUsersRoster_ibfk_2` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
