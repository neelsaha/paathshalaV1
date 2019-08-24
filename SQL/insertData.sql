-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2019 at 10:27 PM
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

--
-- Dumping data for table `board_master`
--

INSERT INTO `board_master` (`board_id`, `name`) VALUES
(1, 'ICSE'),
(2, 'CBSE');

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `class_value`) VALUES
(1, 'I'),
(2, 'II'),
(3, 'III'),
(4, 'IV'),
(5, 'V'),
(6, 'VI'),
(7, 'VII'),
(8, 'VIII'),
(9, 'IX'),
(10, 'X'),
(11, 'XI'),
(12, 'XII');

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user_id`, `username`, `password`, `first_name`, `last_name`, `mobile`, `student_id`, `teacher_id`, `organization_id`, `role`, `last_login`, `isDeleted`) VALUES
(1, 'testStudent', '8D969EEF6ECAD3C29A3A629280E686CF0C3F5D5A86AFF3CA12020C923ADC6C92', 'Test', 'Student', '9876543210', 1, NULL, 1, 1, '2019-08-21 19:49:27', 'N'),
(2, 'testParent', '8D969EEF6ECAD3C29A3A629280E686CF0C3F5D5A86AFF3CA12020C923ADC6C92', 'Test', 'Parent', '9876543210', 1, NULL, 1, 2, '2019-08-21 19:49:27', 'N'),
(3, 'testTeacher', '8D969EEF6ECAD3C29A3A629280E686CF0C3F5D5A86AFF3CA12020C923ADC6C92', 'Test', 'Teacher', '9876543210', NULL, 1, 1, 3, '2019-08-21 19:49:27', 'N'),
(4, 'testSchoolAdmin', '8D969EEF6ECAD3C29A3A629280E686CF0C3F5D5A86AFF3CA12020C923ADC6C92', 'Test', 'SchoolAdmin', '9876543210', NULL, NULL, 1, 4, '2019-08-21 19:49:27', 'N'),
(5, 'testAdmin', '8D969EEF6ECAD3C29A3A629280E686CF0C3F5D5A86AFF3CA12020C923ADC6C92', 'Test', 'Admin', '9876543210', NULL, NULL, NULL, 5, '2019-08-21 19:49:27', 'N');

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`organization_id`, `org_name`, `address`, `pincode`, `state`, `city`, `phone`, `email`, `board_id`, `isDeleted`) VALUES
(1, 'Test School', 'Kolkata', 700028, 'West Bengal', 'Kolkata', '9876543210', 'test@test.com', 1, 'N'),
(2, 'Test School 2', 'test', 700052, 'WB', 'Kolkata', '123456789', 'test@test.com', 2, 'N');

--
-- Dumping data for table `organization_class_mapping`
--

INSERT INTO `organization_class_mapping` (`organization_id`, `class`, `section`, `class_teacher_id`) VALUES
(1, 11, 3, NULL),
(2, 3, 2, NULL),
(1, 5, 1, 1);

--
-- Dumping data for table `role_master`
--

INSERT INTO `role_master` (`role_id`, `role`) VALUES
(1, 'Student'),
(2, 'Parent'),
(3, 'Teacher'),
(4, 'Organization Admin'),
(5, 'Super Admin');

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `sec_value`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'Science'),
(4, 'Commerce');

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `registration_id`, `organization_id`, `student_first_name`, `student_last_name`, `rollno`, `class`, `section`, `attd_percentage`, `isDeleted`) VALUES
(1, 'Test/01', 1, 'Neelanjan', 'Saha', 1, 5, 1, '100.00', 'N'),
(2, 'test/02', 2, 'Test', 'Test last', 5, 7, 2, '100.00', 'N');

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `teacher_first_name`, `teacher_last_name`, `phone`, `qualification`, `organization_id`, `class`, `isDeleted`) VALUES
(1, 'Test', 'Teacher', '9876543210', 'PHD in Physics', 1, 5, 'N');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
