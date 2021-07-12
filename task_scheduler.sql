-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2021 at 06:44 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task_scheduler`
--

-- --------------------------------------------------------

--
-- Table structure for table `cron_logs`
--

CREATE TABLE `cron_logs` (
  `id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL COMMENT 'fk: schedules',
  `scheduled_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `completed_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `status` tinyint(4) DEFAULT NULL COMMENT '1: failed, 2: success',
  `message` text DEFAULT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cron_logs`
--

INSERT INTO `cron_logs` (`id`, `schedule_id`, `scheduled_at`, `completed_at`, `status`, `message`, `added_on`) VALUES
(1, 2, '2021-07-09 23:34:53', NULL, 2, NULL, '2021-07-10 15:04:53'),
(2, 2, '2021-07-09 23:35:58', NULL, 2, NULL, '2021-07-10 15:05:58'),
(3, 2, '2021-07-09 23:36:13', NULL, 2, NULL, '2021-07-10 15:06:13'),
(4, 2, '2021-07-09 23:36:24', NULL, 2, NULL, '2021-07-10 15:06:24'),
(5, 2, '2021-07-09 23:36:33', NULL, 2, NULL, '2021-07-10 15:06:33'),
(6, 2, '2021-07-09 23:37:30', NULL, 2, NULL, '2021-07-10 15:07:30'),
(7, 2, '2021-07-09 23:41:46', NULL, 2, NULL, '2021-07-10 15:11:46'),
(8, 2, '2021-07-09 23:43:24', NULL, 2, NULL, '2021-07-10 15:13:24'),
(9, 2, '2021-07-09 23:43:35', NULL, 2, NULL, '2021-07-10 15:13:35'),
(10, 2, '2021-07-09 23:43:48', NULL, 2, NULL, '2021-07-10 15:13:48'),
(11, 2, '2021-07-09 23:48:00', NULL, 2, NULL, '2021-07-10 15:18:00'),
(12, 2, '2021-07-09 23:50:39', NULL, 2, NULL, '2021-07-10 15:20:39'),
(13, 2, '2021-07-09 23:50:51', NULL, 2, NULL, '2021-07-10 15:20:51'),
(14, 2, '2021-07-09 23:51:24', NULL, 2, NULL, '2021-07-10 15:21:24'),
(15, 2, '2021-07-09 23:51:41', NULL, 2, NULL, '2021-07-10 15:21:41'),
(16, 2, '2021-07-09 23:54:09', '2021-07-09 23:54:09', 2, NULL, '2021-07-10 15:24:09'),
(17, 2, '2021-07-10 00:00:01', '2021-07-10 00:00:01', 2, NULL, '2021-07-10 15:30:01');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `schedule_id` int(11) NOT NULL,
  `schedule_uid` varchar(50) NOT NULL,
  `name` varchar(128) NOT NULL,
  `enabled` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0: not enabled, 1: enabled',
  `minute` varchar(10) DEFAULT NULL,
  `hour` varchar(10) DEFAULT NULL,
  `day` varchar(10) DEFAULT NULL,
  `month` varchar(10) DEFAULT NULL,
  `weekday` varchar(10) DEFAULT NULL,
  `command` text NOT NULL,
  `starts_on` datetime DEFAULT NULL,
  `ends_on` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_triggered_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`schedule_id`, `schedule_uid`, `name`, `enabled`, `minute`, `hour`, `day`, `month`, `weekday`, `command`, `starts_on`, `ends_on`, `created_at`, `updated_at`, `last_triggered_at`) VALUES
(1, 'ashfkjdshfdufndf7dsfbuds', 'Per minute routine checkup', 0, NULL, NULL, NULL, NULL, NULL, 'C:\\xampp\\php\\php.exe  C:\\xampp\\htdocs\\projects\\task-scheduler\\tasks\\routineTaskCheck.php', NULL, NULL, '2021-07-09 06:27:54', '2021-07-10 15:29:40', '2021-07-09 03:00:22'),
(2, 'asdfdsfdssahjdhfkfd', 'Weather data fetcher API per 3 Mins', 1, '*/3', NULL, NULL, NULL, NULL, 'C:\\xampp\\php\\php.exe C:\\xampp\\htdocs\\projects\\task-scheduler\\tasks\\weatherDataFetcher.php', NULL, NULL, '2021-07-09 06:39:12', '2021-07-10 15:30:01', '2021-07-10 00:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `weather`
--

CREATE TABLE `weather` (
  `id` int(11) NOT NULL,
  `city` varchar(128) NOT NULL,
  `date` date NOT NULL,
  `value` decimal(4,1) NOT NULL,
  `time` time NOT NULL,
  `added_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `weather`
--

INSERT INTO `weather` (`id`, `city`, `date`, `value`, `time`, `added_on`, `updated_on`) VALUES
(1, 'London', '2021-07-10', '16.0', '05:20:39', '2021-07-10 05:20:39', '0000-00-00 00:00:00'),
(2, 'London', '2021-07-10', '16.0', '05:20:51', '2021-07-10 05:20:51', '0000-00-00 00:00:00'),
(3, 'London', '2021-07-10', '16.0', '05:21:24', '2021-07-10 05:21:24', '0000-00-00 00:00:00'),
(4, 'London', '2021-07-10', '16.0', '05:21:41', '2021-07-10 05:21:41', '0000-00-00 00:00:00'),
(5, 'London', '2021-07-10', '16.0', '05:24:09', '2021-07-10 05:24:09', '0000-00-00 00:00:00'),
(6, 'London', '2021-07-10', '17.0', '05:30:01', '2021-07-10 05:30:01', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cron_logs`
--
ALTER TABLE `cron_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`schedule_id`),
  ADD UNIQUE KEY `schedule_uid` (`schedule_uid`);

--
-- Indexes for table `weather`
--
ALTER TABLE `weather`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cron_logs`
--
ALTER TABLE `cron_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `weather`
--
ALTER TABLE `weather`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
