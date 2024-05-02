-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2024 at 05:57 PM
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
-- Table structure for table `login_table`
--

CREATE TABLE `login_table` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `bio` text DEFAULT NULL,
  `coverPhoto` varchar(255) DEFAULT NULL,
  `salt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_table`
--

INSERT INTO `login_table` (`id`, `firstname`, `lastname`, `email`, `profile_picture`, `password`, `bio`, `coverPhoto`, `salt`) VALUES
(4, 'Cy ', 'Gullem', 'cygullem@gmail.com', 'ProfilePictures/6633afc79211e_UserProfile.png', '$2y$10$.R/U9OeZph1cigYmzAXhW.HRInKe.jnllduTjg6Jl4wMlD0Pogwx6', NULL, NULL, '47b31cc6d1bcb532176de37209f12b9c'),
(9, 'Junalisa', 'Jumao-as', 'junalisa@gmail.com', 'ProfilePictures/6633aff25a503_Junalisa.png', '$2y$10$kPXbTwJV35jMzXn/VyiAi.FTET5hrFWBFp./d073Z1UYy/okGlHd2', NULL, NULL, '06a7f8fa27b0cc16c675a182aa081058'),
(10, 'Dhaniel', 'Malinao', 'dhaniel@gmail.com', 'ProfilePictures/6633b020d2513_Dhaniel.png', '$2y$10$fkVXPk.mXWeE8ZJAW0Lbce17Yv7dhnrVYWdB6fSavIDuMGze5GA8a', NULL, NULL, 'bfb147ea8a607393c6c73aebff2f7596'),
(11, 'John Nico', 'Edisan', 'nico@gmail.com', 'ProfilePictures/6633b04584d41_Nico.png', '$2y$10$qJ04eD3bT5o0LTp.5Zs1XejKHhjxnPGshOMqHHer0wpgsE2JfigWy', NULL, NULL, '9025ffa7d103ce2824526f63ff1b941d'),
(12, 'Brent', 'Goden', 'brent@gmail.com', 'ProfilePictures/6633b061cdbd6_Brent.png', '$2y$10$XASfIHF2sYV/BAQ3QfdF5uaDOjh18fG7UesN4pf/xlRApTTIkFHjO', NULL, NULL, 'cf55e8a95fcd98c784d52d2a8fc02ebd'),
(13, 'Lawrenz Xavier', 'Carisusa', 'lawx@gmail.com', 'ProfilePictures/6633b0ffc90bf_Lawrenz.png', '$2y$10$f9DGAGETN9013/M1MZ2Jk.rOcQ.mVw1oTwYd4vNGDzS/P4bmCsAem', NULL, NULL, 'dddc7d47f16aedb9280c475b641ceb96'),
(14, 'Franklin Lloyd', 'Dignos', 'franklin@gmail.com', 'ProfilePictures/6633b12aa7ee4_FranklinLloyd.png', '$2y$10$8JLi9TGqN6vp8rdTX4i8tOIeWHjITdoUVvzagN0haat.amu40wjLe', NULL, NULL, 'c1d68a27035e355bcd4fd69906db0fa8'),
(15, 'Justine', 'Flores', 'justine@gmail.com', 'ProfilePictures/6633b14dc7942_Justine.png', '$2y$10$dFQce9nVNPF8k13ycCDmYuTzPH8KzlCPQdIZa7fDm1g/EX3QLirJe', NULL, NULL, 'a9ba20bee4e08eb1bb1f34e5c0ba8be2'),
(16, 'Christy Lynn Pearl', 'Cose', 'christylynn@gmail.com', 'ProfilePictures/6633b17207986_ChristyLynn.png', '$2y$10$nZ3Gz5ctfujI5ufckMA7r./oOq/2Cv/XW5Sj92Gdj3RQ9XWsMO2DG', NULL, NULL, 'dc6b208505afca907dc8ad6d5fcb780b'),
(17, 'Ann Phia', 'Alfafara', 'annphia@gmail.com', './Assets/default-profilepicture.png', '$2y$10$eakp0jpNBL0iqW9y.9rlR.BT.ySbawxq97N4CRvIUNZZtMF7OXgAm', NULL, NULL, '082b112fe6abe339adf4a53343248acb'),
(18, 'Jessa Mae', 'Redondo', 'jessa@gmail.com', 'ProfilePictures/6633b198e90fc_Jessa.png', '$2y$10$sS.BMALkRI6wZ.olaSd5pOC9NH0j4MYm/X4YVzQ5Nay5V6XvHb0xG', NULL, NULL, '2d08b6ce39597faea298e0de8a2abd28'),
(19, 'Cathlenwin', 'Lawas', 'cathlennwin@gmail.com', 'ProfilePictures/6633b1ddbc4ed_Cathlenwin.png', '$2y$10$kk68o/N5LDr6D.oMDW9Bh.6cVz.0SuPbRq0it5gQV00RaNObyurqe', NULL, NULL, '3a469834d2efcd12fd6385a357c3e5a7'),
(20, 'cyril', 'cyril', 'cyril@gmail.com', './Assets/default-profilepicture.png', '$2y$10$ZU7xu1BF00pdNvkXo3C.lucnCHbQwYeH7Zf2wgyjp3K7NgNi9Pleu', NULL, NULL, '9d9bae3b29422e47da16188306e4853d');

-- --------------------------------------------------------

--
-- Table structure for table `post_table`
--

CREATE TABLE `post_table` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `caption` text DEFAULT NULL,
  `imagePost` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_table`
--

INSERT INTO `post_table` (`id`, `user_id`, `caption`, `imagePost`, `created_at`) VALUES
(1, 4, 'ahshhahah', NULL, '2024-05-02 05:12:17');

-- --------------------------------------------------------

--
-- Table structure for table `user_following`
--

CREATE TABLE `user_following` (
  `id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `followed_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_following`
--

INSERT INTO `user_following` (`id`, `follower_id`, `followed_id`, `created_at`) VALUES
(50, 14, 20, '2024-04-30 16:09:36'),
(51, 14, 12, '2024-04-30 16:09:42'),
(52, 14, 13, '2024-04-30 16:09:46'),
(53, 14, 11, '2024-04-30 16:09:53'),
(54, 14, 10, '2024-04-30 16:09:56'),
(56, 4, 19, '2024-05-02 15:32:57'),
(57, 4, 18, '2024-05-02 15:33:00'),
(58, 4, 16, '2024-05-02 15:33:24'),
(60, 4, 14, '2024-05-02 15:33:28'),
(61, 4, 15, '2024-05-02 15:33:29'),
(62, 4, 13, '2024-05-02 15:33:31'),
(64, 4, 11, '2024-05-02 15:33:35'),
(65, 4, 12, '2024-05-02 15:33:36'),
(66, 4, 10, '2024-05-02 15:33:38'),
(67, 4, 9, '2024-05-02 15:33:40'),
(68, 9, 4, '2024-05-02 15:52:04'),
(69, 9, 13, '2024-05-02 15:52:07'),
(70, 9, 12, '2024-05-02 15:52:09'),
(71, 9, 11, '2024-05-02 15:52:11'),
(72, 9, 10, '2024-05-02 15:52:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login_table`
--
ALTER TABLE `login_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_table`
--
ALTER TABLE `post_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_following`
--
ALTER TABLE `user_following`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_follower` (`follower_id`),
  ADD KEY `fk_followed` (`followed_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login_table`
--
ALTER TABLE `login_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `post_table`
--
ALTER TABLE `post_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_following`
--
ALTER TABLE `user_following`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_following`
--
ALTER TABLE `user_following`
  ADD CONSTRAINT `fk_followed` FOREIGN KEY (`followed_id`) REFERENCES `login_table` (`id`),
  ADD CONSTRAINT `fk_follower` FOREIGN KEY (`follower_id`) REFERENCES `login_table` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
