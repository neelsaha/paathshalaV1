-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2019 at 05:40 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paathshalaprd`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendence`
--

CREATE TABLE `attendence` (
  `date` date NOT NULL,
  `student_id` int(50) NOT NULL,
  `class` text COLLATE utf8_unicode_ci NOT NULL,
  `section` text COLLATE utf8_unicode_ci NOT NULL,
  `comment` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `board_master`
--

CREATE TABLE `board_master` (
  `board_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `class_value` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `examId` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL,
  `class` int(10) NOT NULL,
  `section` int(10) NOT NULL,
  `exam_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` int(10) NOT NULL,
  `total_marks` int(10) NOT NULL,
  `timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `schooldID` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Board` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tuitionFees` int(11) NOT NULL,
  `developmentFees` int(11) NOT NULL,
  `labFees` int(11) NOT NULL,
  `misc Fees` int(11) NOT NULL,
  `bookFees` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leavenote`
--

CREATE TABLE `leavenote` (
  `schoolID` int(11) NOT NULL,
  `StudentRegistration` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `Remarks` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lesson`
--

CREATE TABLE `lesson` (
  `date` date NOT NULL,
  `class` int(11) NOT NULL,
  `section` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subjectID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `student_id` int(10) DEFAULT NULL,
  `teacher_id` int(10) DEFAULT NULL,
  `organization_id` int(10) DEFAULT NULL,
  `role` int(10) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp(),
  `isDeleted` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `schoolID` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StudentRegistration` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subjectId` int(10) NOT NULL,
  `examId` int(11) NOT NULL,
  `Remarks` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SignTimeStamp` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `Date` date NOT NULL,
  `studentRegistration` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Comment` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `organization_id` int(50) NOT NULL,
  `org_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `pincode` int(10) NOT NULL,
  `state` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `board_id` int(10) NOT NULL,
  `isDeleted` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organization_class_mapping`
--

CREATE TABLE `organization_class_mapping` (
  `organization_id` int(10) NOT NULL,
  `class` int(10) NOT NULL,
  `section` int(10) NOT NULL,
  `class_teacher_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `query`
--

CREATE TABLE `query` (
  `queryId` int(20) NOT NULL,
  `teacherId` int(20) NOT NULL,
  `schoolId` int(20) NOT NULL,
  `userId` int(20) NOT NULL,
  `timeStamp` date NOT NULL,
  `isClosed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `querymessage`
--

CREATE TABLE `querymessage` (
  `messageId` int(10) NOT NULL,
  `queryId` int(10) NOT NULL,
  `timestamp` date NOT NULL,
  `sender` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questionbank`
--

CREATE TABLE `questionbank` (
  `schoolID` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subjectId` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `remarks`
--

CREATE TABLE `remarks` (
  `remarks_id` int(11) NOT NULL,
  `student_id` int(50) NOT NULL,
  `teacher_id` int(10) NOT NULL,
  `remarks` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `reply` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_master`
--

CREATE TABLE `role_master` (
  `role_id` int(11) NOT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `sec_value` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(50) NOT NULL,
  `registration_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `organization_id` int(50) NOT NULL,
  `student_first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `student_last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `rollno` int(5) NOT NULL,
  `class` int(11) NOT NULL,
  `section` int(11) NOT NULL,
  `attd_percentage` decimal(5,2) NOT NULL,
  `isDeleted` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `studentsubjectmapping`
--

CREATE TABLE `studentsubjectmapping` (
  `studentRegistration` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subjectId` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `syllabus`
--

CREATE TABLE `syllabus` (
  `examId` int(11) NOT NULL,
  `studentId` int(11) NOT NULL,
  `Content` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` int(10) NOT NULL,
  `teacher_first_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_last_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qualification` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organization_id` int(50) NOT NULL,
  `class` int(10) DEFAULT NULL,
  `isDeleted` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teachersubjectmapping`
--

CREATE TABLE `teachersubjectmapping` (
  `TeacherId` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subjectId` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class` int(10) NOT NULL,
  `section` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `class` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `section` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_id` int(10) NOT NULL,
  `class_teacher` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendence`
--
ALTER TABLE `attendence`
  ADD PRIMARY KEY (`date`,`student_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `board_master`
--
ALTER TABLE `board_master`
  ADD PRIMARY KEY (`board_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `class_value` (`class_value`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`examId`),
  ADD KEY `class` (`class`),
  ADD KEY `organization_id` (`organization_id`),
  ADD KEY `section` (`section`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`date`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `username_2` (`username`),
  ADD KEY `organization_id` (`organization_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `role` (`role`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`Date`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`organization_id`),
  ADD KEY `board_id` (`board_id`);

--
-- Indexes for table `organization_class_mapping`
--
ALTER TABLE `organization_class_mapping`
  ADD PRIMARY KEY (`organization_id`,`class`,`section`),
  ADD KEY `class` (`class`),
  ADD KEY `section` (`section`),
  ADD KEY `class_teacher_id` (`class_teacher_id`);

--
-- Indexes for table `remarks`
--
ALTER TABLE `remarks`
  ADD PRIMARY KEY (`remarks_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `role_master`
--
ALTER TABLE `role_master`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sec_value` (`sec_value`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`) USING BTREE,
  ADD KEY `school_id` (`organization_id`),
  ADD KEY `class` (`class`),
  ADD KEY `section` (`section`);

--
-- Indexes for table `studentsubjectmapping`
--
ALTER TABLE `studentsubjectmapping`
  ADD PRIMARY KEY (`studentRegistration`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`),
  ADD UNIQUE KEY `subject_name` (`subject_name`);

--
-- Indexes for table `syllabus`
--
ALTER TABLE `syllabus`
  ADD PRIMARY KEY (`examId`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`),
  ADD KEY `organization_id` (`organization_id`),
  ADD KEY `class` (`class`);

--
-- Indexes for table `teachersubjectmapping`
--
ALTER TABLE `teachersubjectmapping`
  ADD PRIMARY KEY (`TeacherId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `board_master`
--
ALTER TABLE `board_master`
  MODIFY `board_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `examId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `organization_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `remarks`
--
ALTER TABLE `remarks`
  MODIFY `remarks_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_master`
--
ALTER TABLE `role_master`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendence`
--
ALTER TABLE `attendence`
  ADD CONSTRAINT `attendence_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `exam_ibfk_1` FOREIGN KEY (`class`) REFERENCES `class` (`id`),
  ADD CONSTRAINT `exam_ibfk_2` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`organization_id`),
  ADD CONSTRAINT `exam_ibfk_3` FOREIGN KEY (`section`) REFERENCES `section` (`id`),
  ADD CONSTRAINT `exam_ibfk_4` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`);

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_2` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`organization_id`),
  ADD CONSTRAINT `login_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `login_ibfk_4` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`),
  ADD CONSTRAINT `login_ibfk_5` FOREIGN KEY (`role`) REFERENCES `role_master` (`role_id`);

--
-- Constraints for table `organization`
--
ALTER TABLE `organization`
  ADD CONSTRAINT `organization_ibfk_1` FOREIGN KEY (`board_id`) REFERENCES `board_master` (`board_id`);

--
-- Constraints for table `organization_class_mapping`
--
ALTER TABLE `organization_class_mapping`
  ADD CONSTRAINT `organization_class_mapping_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`organization_id`),
  ADD CONSTRAINT `organization_class_mapping_ibfk_2` FOREIGN KEY (`class`) REFERENCES `class` (`id`),
  ADD CONSTRAINT `organization_class_mapping_ibfk_3` FOREIGN KEY (`section`) REFERENCES `section` (`id`),
  ADD CONSTRAINT `organization_class_mapping_ibfk_4` FOREIGN KEY (`class_teacher_id`) REFERENCES `teacher` (`teacher_id`);

--
-- Constraints for table `remarks`
--
ALTER TABLE `remarks`
  ADD CONSTRAINT `remarks_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`class`) REFERENCES `class` (`id`),
  ADD CONSTRAINT `student_ibfk_3` FOREIGN KEY (`section`) REFERENCES `section` (`id`),
  ADD CONSTRAINT `student_ibfk_4` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`organization_id`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`organization_id`),
  ADD CONSTRAINT `teacher_ibfk_2` FOREIGN KEY (`class`) REFERENCES `class` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
