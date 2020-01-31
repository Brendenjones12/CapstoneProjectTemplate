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

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`classID`, `crseID`, `sectNum`, `crseName`) VALUES
(1, 'EX101', 1, 'Example Course, Section 1'),
(2, 'EX101', 2, 'Example Course, Section 2');

--
-- Dumping data for table `classquestions`
--

INSERT INTO `classquestions` (`classID`, `quesID`) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4);

--
-- Dumping data for table `classsyllabus`
--

INSERT INTO `classsyllabus` (`classID`, `syllabusID`) VALUES
(1, 1),
(2, 2);

--
-- Dumping data for table `classuserroster`
--

INSERT INTO `classuserroster` (`classID`, `username`) VALUES
(1, 'exampleProfessor'),
(1, 'exampleStudent'),
(2, 'exampleProfessor'),
(2, 'exampleStudent');

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`quesID`, `qtext`, `atext`) VALUES
(1, 'What section of the course is this?', 'Section 1.'),
(2, 'What is 2 + 2?', '4.'),
(3, 'What section of the course is this?', 'Section 2.'),
(4, 'What is 2 * 3?', '6.');

--
-- Dumping data for table `syllabus`
--

INSERT INTO `syllabus` (`syllabusID`, `courseTitle`, `contactInformation`, `officeHoursPolicy`, `courseDescription`, `courseGoals`, `requiredMaterials`, `gradingPolicy`, `attendancePolicy`, `universityPolicy`, `studentResources`) VALUES
(1, 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf'),
(2, 'asdf', 'asfd', 'asdf', 'asdf', 'afd', 'asdf', 'asdf', 'af', 'asdf', 'asdf');

--
-- Dumping data for table `university`
--

INSERT INTO `university` (`uniID`, `name`) VALUES
(2, 'Example University');

--
-- Dumping data for table `universityclassroster`
--

INSERT INTO `universityclassroster` (`uniID`, `classID`) VALUES
(2, 1),
(2, 2);

--
-- Dumping data for table `universityusersroster`
--

INSERT INTO `universityusersroster` (`uniID`, `username`) VALUES
(2, 'exampleProfessor'),
(2, 'exampleStudent');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `fname`, `lname`, `isProf`, `userID`) VALUES
('exampleProfessor', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'First Name', 'Last Name', 1, NULL),
('exampleStudent', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'First Name', 'Last name', 0, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
