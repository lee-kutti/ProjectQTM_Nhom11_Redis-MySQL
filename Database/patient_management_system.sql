-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 09, 2021 at 05:23 AM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+07:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `patient_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `age` int(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `others` varchar(2000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `name`, `gender`, `dob`, `age`, `phone`, `email`, `others`, `created_at`) VALUES
(1, 'First Patient', 'Male', '2021-10-05', 16, '+603334445555', 'test@sd.taylors.edu.my', 'test.com', '2021-10-26 05:06:53'),
(2, 'Jane Doe', 'Female', '1993-05-08', 28, '+60193458793', 'janedoe@jane.co', 'Allergic to Seaweed.\r\nHusband is John Doe.', '2021-10-26 05:15:28'),
(8, 'Leslie Cheung', 'Male', '1956-09-12', 47, '+60188888888', 'lesliecheung@leslie.com', 'Leslie Cheung is not allergic to anything.\r\n\r\nLeslie Cheung is from Hong Kong.\r\n\r\nHe was 47 years old of age.', '2021-10-27 05:20:29'),
(9, 'Mr Johhny Boy', 'Male', '2021-10-05', 23, '+60192345893', 'johhny@johnny.co', 'Johnny loves seafood but is allergic to seafood. Unfortunate.', '2021-10-27 11:56:05'),
(12, 'I am to be edited', 'Male', '2021-10-06', 33, '+603334445555', 'ddw@doo.dooe', 'EDITED', '2021-10-30 08:14:38'),
(13, 'Only Allow Two Email Domain', 'Male', '2021-10-05', 33, '+603334445555', 'iamoneemail@taylors.edu.my', 'I am the first email @taylors.edu.my', '2021-10-30 08:47:06'),
(14, 'Lan Chee Onn', 'Male', '2021-10-06', 18, '+60178892822', 'cheeonn.lan@taylors.edu.my', 'Lan Chee Onn is not allergic to anything ', '2021-10-30 08:52:03'),
(15, 'Lan Chee Onn', 'Male', '2001-10-01', 20, '+60178892822', 'cheeonn.lan@sd.taylors.edu.my', 'Lan Chee Onn is not allergic to anything', '2021-10-30 08:59:52'),
(17, 'Email Two', 'Female', '2021-10-06', 80, '+601788928222', 'test@sd.taylors.edu.my', 'Allergic Info ', '2021-10-30 09:09:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$lcrJsXCvYqI/6wth3PLGbeYCPJ1h/ca1ydL3pTg0QKQh9TgEGBhV.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
