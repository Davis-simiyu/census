-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2024 at 05:53 PM
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
-- Database: `population_census`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password_hash`, `created_at`) VALUES
(1, 'sadiw', '$2y$10$XTNwzhdIn.azEMN3bMAbYOgLQFhdN5NO/5ZdlV3QnrgtjZSx1o6ay', '2024-11-27 03:26:15'),
(3, 'sadiq', '$12345', '2024-11-27 03:33:29'),
(4, 'simiyu', '$2y$10$WzJTGgZoJnkRZtiP6tA0cOWrJyzRaaVu4h3h3oZ5l1rxa9tkS6TtW', '2024-11-27 10:48:17');

-- --------------------------------------------------------

--
-- Table structure for table `birth_records`
--

CREATE TABLE `birth_records` (
  `id` int(11) NOT NULL,
  `child_name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `place_of_birth` varchar(255) NOT NULL,
  `parent_name` varchar(255) NOT NULL,
  `birth_certificate_path` varchar(255) DEFAULT NULL,
  `location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `birth_records`
--

INSERT INTO `birth_records` (`id`, `child_name`, `dob`, `place_of_birth`, `parent_name`, `birth_certificate_path`, `location`) VALUES
(1, 'davis', '2008-04-23', 'kenyatta', 'wanjala', 'uploads/concept diagram.jpeg', ''),
(2, 'dfgyh', '0789-05-04', 'kenyatta', 'wanjala', 'uploads/concept diagram.jpeg', ''),
(3, 'drfgyuhj', '0054-04-23', 'kenyatta', 'wanjala', 'uploads/concept diagram.jpeg', ''),
(4, 'drfgyuhj', '0014-12-31', 'kenyatta', 'wanjala', 'uploads/concept diagram.jpeg', '');

-- --------------------------------------------------------

--
-- Table structure for table `citizens`
--

CREATE TABLE `citizens` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('Male','Female','Other','Prefer Not to Say') NOT NULL,
  `marital_status` enum('Single','Married','Divorced','Widowed') NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `citizens`
--

INSERT INTO `citizens` (`id`, `name`, `dob`, `age`, `gender`, `marital_status`, `address`, `phone`) VALUES
(1, 'davis', '2006-03-24', 12, 'Male', 'Single', '2345', '3242567'),
(2, 'davis', '2008-03-04', 12, 'Male', 'Single', '2345', '3242567'),
(3, 'davis', '2008-03-04', 12, 'Male', 'Single', '2345', '3242567'),
(4, 'davis', '2006-04-24', 12, 'Male', 'Single', '2345', '3242567'),
(5, 'davis', '6666-03-31', 12, 'Female', 'Single', '2345', '3242567'),
(6, 'davis', '0000-00-00', 12, 'Female', 'Single', '2345', '3242567'),
(7, 'davis', '0000-00-00', 12, 'Female', 'Single', '2345', '3242567'),
(8, 'davis', '2006-03-24', 12, 'Male', 'Single', '2345', '3242567'),
(9, 'mary', '1998-04-26', 45, 'Female', 'Single', 'fghjk', '0794629940'),
(10, 'mary', '2004-04-23', 45, 'Female', 'Single', 'fghjk', '0794629940'),
(21, 'tenny', '0544-04-03', 32, 'Male', 'Married', 'we3', '0794629940'),
(22, 'tenny', '2005-04-02', 23, 'Female', 'Married', 'we3', '0794629940'),
(23, 'Davis Wanjala', '2005-12-12', 18, 'Male', 'Single', 'kilimani', '07212227175'),
(24, 'mimi', '1990-12-11', -34, 'Male', 'Married', 'nbi', '079462994000');

-- --------------------------------------------------------

--
-- Table structure for table `death_records`
--

CREATE TABLE `death_records` (
  `id` int(11) NOT NULL,
  `deceased_name` varchar(255) NOT NULL,
  `date_of_death` date NOT NULL,
  `cause_of_death` varchar(255) NOT NULL,
  `place_of_death` varchar(255) NOT NULL,
  `death_certificate_path` varchar(255) DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `death_records`
--

INSERT INTO `death_records` (`id`, `deceased_name`, `date_of_death`, `cause_of_death`, `place_of_death`, `death_certificate_path`, `submitted_at`, `location`) VALUES
(1, 'eerewdsd', '2009-04-03', 'car accident', 'nairobi', 'uploads/concept diagram.jpeg', '2024-11-26 07:20:35', ''),
(2, 'eerewdsd', '2004-04-23', 'car accident', 'nairobi', 'uploads/concept diagram.jpeg', '2024-11-26 08:38:29', '');

-- --------------------------------------------------------

--
-- Table structure for table `enumerators`
--

CREATE TABLE `enumerators` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enumerators`
--

INSERT INTO `enumerators` (`id`, `username`, `password`, `location`, `status`, `created_at`) VALUES
(1, 'fuhgjkl@zsdfghj', '$2y$10$9mol6EuQlnuOYiHmTylPfet7cbqvUXJ48Lg36oFLPnZ4KWFtZV5pm', 'kiambu', 'Inactive', '2024-11-26 07:40:04'),
(2, 'sadiq', '$2y$10$vHp.jwzTL79Iwg7EDr1dpO85A0KcT4BCdvDVHVEVtqrjpkHD5wSaa', 'katirs', 'Active', '2024-11-26 07:40:40'),
(3, 'davis.wanjala@strathmore.edu', '$2y$10$SRtrftiNHkXWL8ErczYmWOFQ0HZxX7Huh5fsTOaSqyjJ7b7T.3RK6', 'kiambu', 'Active', '2024-11-26 10:51:34'),
(6, 'omollo', '$2y$10$N.9QFFfN9epwB5e7FCVIoOrUiHgnaKoJZWv2FKWQ7zvOS.nGYlE2y', 'kericho', 'Active', '2024-11-27 08:55:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `birth_records`
--
ALTER TABLE `birth_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `citizens`
--
ALTER TABLE `citizens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `death_records`
--
ALTER TABLE `death_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enumerators`
--
ALTER TABLE `enumerators`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `birth_records`
--
ALTER TABLE `birth_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `citizens`
--
ALTER TABLE `citizens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `death_records`
--
ALTER TABLE `death_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enumerators`
--
ALTER TABLE `enumerators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
