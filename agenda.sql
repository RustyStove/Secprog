-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2024 at 10:50 AM
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
-- Database: `agenda`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `author` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `progress` enum('In Progress','Finished','Past Deadline') NOT NULL DEFAULT 'In Progress'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `author`, `date`, `progress`) VALUES
(9, 'idk', 'admin', '2024-09-11', 'Finished'),
(12, 'czc', 'qicoy', '2024-10-30', 'In Progress');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `attempt_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `username`, `attempt_time`) VALUES
(20, 'arrya', '2024-09-26 14:15:45'),
(21, 'arrya', '2024-09-26 14:15:50'),
(22, 'arrya', '2024-09-26 14:15:54'),
(23, 'aaa', '2024-09-26 14:15:57'),
(24, 'aaaaaa', '2024-09-26 14:16:02'),
(25, 'qicoy120', '2024-11-15 16:44:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `profile_pic` varchar(255) DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `profile_pic`) VALUES
(0, 'qicoy', '$2y$10$q1RxdUQwA93qAUaAqMJhL.PePwTIzlX9V9hcj3hzDY/JIHFwdjh6e', 'user', 'default.png'),
(1, 'admin', '$2y$10$RcVHRrxFaZ2Pky.xuUd.XuoxdyUhdsl9JH/PzmgSvnQgRqD6uRDnS', 'admin', 'default.png'),
(7, 'arrya', '$2y$10$oSkamVCUI2TCsz2tYCfBQOaectAuS09SynTxYn/zioxKFCiaT4ywa', 'user', 'default.png'),
(9, 'qicoy120', '$2y$10$ugc2DMWNoZOjyQCUKORhZuo4ZViiFGxAw.ZEv93PcE86liKeQtbLC', 'user', 'default.png'),
(10, 'balabala', '$2y$10$plR/JcfmTv3bTzYFYw8UzOUwCruWELYtoJeFzymLE8TQB0e.NINOu', 'user', 'default.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
