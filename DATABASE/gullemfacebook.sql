-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2024 at 06:08 PM
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
-- Database: `gullemfacebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `follow_table`
--

CREATE TABLE `follow_table` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_table`
--

CREATE TABLE `login_table` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_table`
--

INSERT INTO `login_table` (`id`, `firstname`, `lastname`, `email`, `profile_picture`, `password`, `salt`) VALUES
(4, 'Cy ', 'Gullem', 'cygullem@gmail.com', './Assets/default-profilepicture.png', '$2y$10$.R/U9OeZph1cigYmzAXhW.HRInKe.jnllduTjg6Jl4wMlD0Pogwx6', '47b31cc6d1bcb532176de37209f12b9c'),
(6, 'Junalisa ', 'Jumao-as', 'junalisa@gmail.com', './Assets/default-profilepicture.png', '$2y$10$t6HQHFyVkIlU7vhvuBO3nuob.fY018zRUfy/sCMIGOoEetlH2KVj6', '0aa3706baa30b10097472dbbbe6f8978'),
(7, 'Dhaniel', 'Malinao', 'dhaniel@gmail.com', './Assets/default-profilepicture.png', '$2y$10$mFTFSUv7AYHfbVfbWel4SeohLvWSsqivPmH07Mr/CscleP1ERP0Pq', 'e431a4b54bb1d18d6b4637763fc44531'),
(8, 'Nico', 'Edisan', 'nico@gmail.com', './Assets/default-profilepicture.png', '$2y$10$6IrfoBAaXVrw9TUD0XSeWumsJ5DoBVRaG3Y4LtnWhhigX6SEctrdi', '76d46ea9b2e50db47f1291f4cb067726');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `follow_table`
--
ALTER TABLE `follow_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_table`
--
ALTER TABLE `login_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `follow_table`
--
ALTER TABLE `follow_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_table`
--
ALTER TABLE `login_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
