-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2025 at 10:09 AM
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
-- Database: `hospital_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `status` enum('Scheduled','Completed','Cancelled') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `payment_status` enum('Paid','Pending') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `specialization` varchar(100) DEFAULT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `availability_schedule` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `photo` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `serial_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `specialization`, `contact`, `email`, `availability_schedule`, `created_at`, `photo`, `status`, `serial_number`) VALUES
(8, 'abhi', 'heart ', '8754308754', 'abhi@gmail.com', '24hrs 3', '2024-12-20 04:52:58', '20241220310688.jpg', 0, NULL),
(9, 'u', 'heart robber', '9879879879', 'visoi@gmail.com', 'uj', '2024-12-20 05:00:32', '20241220819787.jpeg', 0, NULL),
(10, 'abhi', 'dental ', '8278272340', 'vgv@gmail.com', 'gfx', '2024-12-20 09:20:17', '20241220143372.jpg', 0, NULL),
(11, 'siva', 'ramaram', '43543', 'visoi@gmail.com', 'f', '2024-12-25 07:20:19', '20241225463340.jpeg', 1, NULL),
(12, 'sat', 'dental ', '9879879879', 'vgv@gmail.com', 'rh', '2024-12-28 06:44:36', '20241228243111.jpeg', 1, NULL),
(13, 'labes', 'we', '9879879879', 'latha@gmail.com', 'reg', '2024-12-28 06:44:51', '20241228451413.jpeg', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nurses`
--

CREATE TABLE `nurses` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `department` varchar(100) DEFAULT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `availability_schedule` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `photo` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `serial_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nurses`
--

INSERT INTO `nurses` (`id`, `name`, `department`, `contact`, `email`, `availability_schedule`, `created_at`, `photo`, `status`, `serial_number`) VALUES
(5, 'latha', 'dental', '24324324', 'latha@gmail.com', 'ttlfdml435345', '2024-12-20 04:53:55', '20241220212114.png', 0, NULL),
(6, 'labes', 'ew', '8278272340', 'latha@gmail.com', 'tu', '2024-12-25 07:20:44', '20241225835202.png', 0, NULL),
(7, 'oi', 'ew', '9887985879', 'visoi@gmail.com', 'yt', '2024-12-26 05:22:16', '2024122619002.jpg', 0, NULL),
(8, 'labes', 'dental', '8278272340', 'vgv@gmail.com', 'rg', '2024-12-28 06:45:26', '20241228720249.png', 1, NULL),
(9, 'arega', 'ew', '234', 'latha@gmail.com', 'f', '2024-12-28 07:19:25', '20241228319022.png', 0, NULL),
(10, 'ge', 'ew', '8278272340', 'vgv@gmail.com', 'rf', '2024-12-28 07:19:43', '20241228231054.jpg', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `medical_history` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `serial_number` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `name`, `age`, `gender`, `contact`, `address`, `medical_history`, `created_at`, `serial_number`, `status`) VALUES
(8, 'vision', 33, 'Female', '9879879879', 'rjy', 'non', '2024-12-20 08:48:48', NULL, 1),
(10, 'new', 22, 'Male', '9879879879', '3f', '32f', '2024-12-28 05:59:15', NULL, 1),
(11, 'vision', 234, 'Female', '9879879879', 'mn', 'n/', '2024-12-28 06:47:10', NULL, 1),
(12, 'tttttt', 234, 'Female', '9879879879', 'dbx', 'trb', '2024-12-28 09:18:03', NULL, 1),
(13, 'jack ', 77, 'Male', '242', 'fb', '45t', '2024-12-30 06:16:59', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `patients_opd`
--

CREATE TABLE `patients_opd` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `doctor` varchar(255) DEFAULT NULL,
  `contact` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `admission_type` enum('Casualty','OPD') NOT NULL,
  `admission_date` datetime DEFAULT current_timestamp(),
  `medical_history` text DEFAULT NULL,
  `documents` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients_opd`
--

INSERT INTO `patients_opd` (`id`, `name`, `age`, `gender`, `doctor`, `contact`, `address`, `admission_type`, `admission_date`, `medical_history`, `documents`, `created_at`, `updated_at`) VALUES
(1, 'vision2233tt', 2, 'Male', 'wwe', '234', 'f', '', '2024-12-30 12:43:55', 'fc', '', '2024-12-30 12:43:55', '2025-01-03 11:33:37'),
(6, 'raja', 10, 'Male', 'agarwal', '44334', 'fd', 'Casualty', '2024-12-30 16:39:14', 'ehe', '', '2024-12-30 16:39:14', '2025-01-04 11:53:00'),
(15, 'vision', 22, 'Male', 'wer', '9879879879', 'are', 'OPD', '2025-01-04 09:54:02', 'vg4', '', '2025-01-04 09:54:02', '2025-01-04 11:52:38'),
(19, 'a', 4, 'Male', 'A', '3', 'a', 'Casualty', '2025-01-04 09:55:14', 'g', '', '2025-01-04 09:55:14', '2025-01-04 09:55:14'),
(21, 'fd', 4, 'Male', 'b', '32', 'd', 'OPD', '2025-01-04 09:55:49', 'x', '', '2025-01-04 09:55:49', '2025-01-04 09:55:49'),
(22, 'MANI', 22, 'Male', 'raha', '1', 'X', 'Casualty', '2025-01-04 10:11:44', 'HFJA', '', '2025-01-04 10:11:44', '2025-01-04 10:11:44'),
(26, 'reddy', 52, 'Male', 'tt', '44', 'dd', 'Casualty', '2025-01-04 10:13:51', 'dd', '', '2025-01-04 10:13:51', '2025-01-04 10:13:51'),
(27, 'sai', 55, 'Male', 'raha', '55', 'ee', 'Casualty', '2025-01-04 10:14:16', 'ee', '', '2025-01-04 10:14:16', '2025-01-04 10:14:16'),
(28, 'abhi', 85, 'Male', 'sdf', '66', 'ff', 'Casualty', '2025-01-04 10:14:43', 'ff', '', '2025-01-04 10:14:43', '2025-01-04 10:14:43'),
(29, 'satya', 98, 'Female', 'sdf', '77', 'gg', 'Casualty', '2025-01-04 10:15:18', 'gg\r\n', '', '2025-01-04 10:15:18', '2025-01-04 10:15:18'),
(31, 'raja', 234, 'Male', 'tt', '99', 'ii', 'Casualty', '2025-01-04 10:16:18', 'ii', '', '2025-01-04 10:16:18', '2025-01-04 10:16:18'),
(32, 'raju', 22, 'Male', 'sdf', '99', 'jj', 'Casualty', '2025-01-04 10:16:43', 'jj\r\n', '', '2025-01-04 10:16:43', '2025-01-04 10:16:43'),
(33, 'mohan', 22, 'Male', 'sdf', '61', 'aaa', 'OPD', '2025-01-04 10:17:13', 'aaa', '', '2025-01-04 10:17:13', '2025-01-04 10:17:13'),
(34, 'mani', 23, 'Male', 'raha', '62', 'bbb', 'OPD', '2025-01-04 10:17:41', 'bbb', '', '2025-01-04 10:17:41', '2025-01-04 10:17:41'),
(35, 'kumar', 24, 'Male', 'wwe', '63', 'ccc', 'OPD', '2025-01-04 10:18:14', 'ccc', '', '2025-01-04 10:18:14', '2025-01-04 10:18:14'),
(36, 'kavya', 22, 'Female', 'tt', '64', 'ddd', 'OPD', '2025-01-04 10:18:44', 'ddd', '', '2025-01-04 10:18:44', '2025-01-04 10:18:44'),
(37, 'rajini', 52, 'Female', 'fe', '65', 'eee', 'OPD', '2025-01-04 10:19:17', 'eee', '', '2025-01-04 10:19:17', '2025-01-04 10:19:17'),
(38, 'ramesh', 234, 'Female', 'ram', '66', 'fff', 'OPD', '2025-01-04 10:19:47', 'fff', '', '2025-01-04 10:19:47', '2025-01-04 10:19:47'),
(39, 'sai', 32, 'Male', 'sdf', '67', 'ggg', 'OPD', '2025-01-04 10:20:15', 'ggg', '', '2025-01-04 10:20:15', '2025-01-04 10:20:15'),
(40, 'satya', 65, 'Female', 'raha', '68', 'iii', 'OPD', '2025-01-04 10:20:54', 'iii', '', '2025-01-04 10:20:54', '2025-01-04 10:20:54'),
(41, 'roja', 29, 'Female', 'fe', '69', 'kkk', 'OPD', '2025-01-04 10:21:37', 'kkk', '', '2025-01-04 10:21:37', '2025-01-04 10:21:37'),
(43, 'satish', 45, 'Male', 'wwe', '70', 'nnn', 'OPD', '2025-01-04 10:23:15', 'nnn', '', '2025-01-04 10:23:15', '2025-01-04 10:23:15'),
(44, 'ramu', 66, 'Male', 'tt', '65', 'sss', 'OPD', '2025-01-04 10:24:03', 'sss', '', '2025-01-04 10:24:03', '2025-01-04 10:24:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `created_at`) VALUES
(1, 'bhavi', 'creations', 'bhavicreations@gmail.com', '600c304331ed6847dd108dea621d56ea', '2024-11-29 12:29:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nurses`
--
ALTER TABLE `nurses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients_opd`
--
ALTER TABLE `patients_opd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `nurses`
--
ALTER TABLE `nurses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `patients_opd`
--
ALTER TABLE `patients_opd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`);

--
-- Constraints for table `billing`
--
ALTER TABLE `billing`
  ADD CONSTRAINT `billing_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
