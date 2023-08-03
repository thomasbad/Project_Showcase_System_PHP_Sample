-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2023 at 03:22 AM
-- Server version: 5.7.17
-- PHP Version: 7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `showcasedb`
--
CREATE DATABASE IF NOT EXISTS `showcasedb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `showcasedb`;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `CCID` int(11) NOT NULL,
  `course_code` int(4) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `department_name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`CCID`, `course_code`, `course_name`, `department_name`) VALUES
(1, 1, 'High Diploma of Art & Design', 'Art and Design'),
(2, 2, 'Bachelor of Environmental Science', 'Built Environment'),
(3, 3, 'Bachelor of Creative Media', 'Creative Media Technology'),
(4, 4, 'Advanced Diploma of Engineering', 'Engineering'),
(5, 5, 'High Diploma of Human Resource Management', 'Humanities'),
(6, 6, 'High Diploma of Performing Arts', 'Performing Arts'),
(7, 7, 'Research PhD students', 'Research'),
(8, 8, 'High Diploma of Science', 'Science');

-- --------------------------------------------------------

--
-- Table structure for table `department_info`
--

CREATE TABLE `department_info` (
  `DID` int(11) NOT NULL,
  `department_name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_info`
--

INSERT INTO `department_info` (`DID`, `department_name`) VALUES
(1, 'Art and Design'),
(2, 'Creative Media Technology'),
(3, 'Built Environment'),
(4, 'Engineering'),
(5, 'Humanities'),
(6, 'Performing Arts'),
(7, 'Research'),
(8, 'Science');

-- --------------------------------------------------------

--
-- Table structure for table `document_upload`
--

CREATE TABLE `document_upload` (
  `DOID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `file_id` varchar(500) NOT NULL,
  `project_showcase` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document_upload`
--

INSERT INTO `document_upload` (`DOID`, `username`, `file_id`, `project_showcase`) VALUES
(1, 'tomchan', 'https://drive.google.com/file/d/1aORecQpIOYMpbGGx5kPihZXH_oqUIdI7/view?usp=drive_link', 'HR exit interview research'),
(2, 'maryyeung', 'https://drive.google.com/file/d/1fzX56MeDg7uVRCqkd3W6LM4cDw3DnTKT/view?usp=drive_link', 'World history\'s building'),
(3, 'peterchow', 'https://drive.google.com/file/d/1bLmql47eaN87VK8Yf6ometkVIc_-9URU/view?usp=drive_link', 'Calculation of brain wave'),
(4, 'lily1990', 'https://drive.google.com/file/d/1eTWF97-zR6Fa-qr60W9RiY6xuAIqLgf5/view?usp=drive_link', 'Golden Art method on Design'),
(5, 'candy8989', 'https://drive.google.com/file/d/1Jc3-kt39EvmIP0VKWJJd_zy9VVyAtj1D/view?usp=drive_link', 'History of Fruit Drawing');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `UID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_type` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`UID`, `username`, `password`, `user_type`) VALUES
(1, 'admin', 'admin', 'admin'),
(2, 'tomchan', 'password', 'student'),
(3, 'guest', 'guest', 'guest'),
(4, 'maryyeung', 'password', 'student'),
(5, 'peterchow', 'password', 'student'),
(6, 'lily1990', 'password', 'student'),
(7, 'candy8989', 'password', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `PID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `midname` varchar(20) DEFAULT NULL,
  `lastname` varchar(20) NOT NULL,
  `department_name` varchar(50) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `grad_year` int(4) NOT NULL,
  `self_intro` varchar(200) DEFAULT NULL,
  `show_profile` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`PID`, `username`, `firstname`, `midname`, `lastname`, `department_name`, `course_name`, `grad_year`, `self_intro`, `show_profile`) VALUES
(1, 'admin', 'Global', NULL, 'Admin', '', '', 9999, NULL, 1),
(2, 'guest', 'Guest', NULL, 'Guest', '', '', 9999, NULL, 0),
(3, 'candy8989', 'Candy', NULL, 'Liu', 'Performing Arts', 'High Diploma of Performing Arts', 2025, 'I am Candy!', 1),
(4, 'lily1990', 'Lily', 'Mary', 'Cruse', 'Creative Media Technology', 'Bachelor of Creative Media', 2026, 'This is Lily from Hong Kong, studying creative media in HKIT', 1),
(5, 'maryyeung', 'Mary', NULL, 'Yeung', 'Engineering', 'Advanced Diploma of Engineering', 2027, 'Hardworking student!!', 1),
(6, 'peterchow', 'Peter', NULL, 'Chow', 'Science', 'High Diploma of Science', 2021, 'Hope can invent something and change the world', 1),
(7, 'tomchan', 'Tom', '', 'Chan', 'Humanities', 'High Diploma of Human Resource Management', 2027, 'Will be the best HR in the world !', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `ID` int(11) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`ID`, `type`) VALUES
(1, 'admin'),
(2, 'student'),
(3, 'guest');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`CCID`),
  ADD UNIQUE KEY `course_code` (`course_code`),
  ADD UNIQUE KEY `course_name` (`course_name`);

--
-- Indexes for table `department_info`
--
ALTER TABLE `department_info`
  ADD PRIMARY KEY (`DID`),
  ADD UNIQUE KEY `department_name` (`department_name`);

--
-- Indexes for table `document_upload`
--
ALTER TABLE `document_upload`
  ADD PRIMARY KEY (`DOID`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`UID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`PID`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `account_type` (`type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `CCID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `department_info`
--
ALTER TABLE `department_info`
  MODIFY `DID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `document_upload`
--
ALTER TABLE `document_upload`
  MODIFY `DOID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
