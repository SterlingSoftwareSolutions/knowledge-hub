-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2023 at 06:48 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `video` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `body` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `published` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `topic_id`, `title`, `image`, `video`, `body`, `published`, `created_at`) VALUES
(23, 43, 2, 'First Topic', '1673500778_508313_ImageGalleryLightboxLarge.jpg', '1673499775_Countdown 5 seconds timer.mp4', '&lt;p&gt;First Topic First Topic First Topic First Topic&lt;/p&gt;', 1, '2023-01-12 10:32:55'),
(31, 43, 2, 'Second Topic', '1673500715_106800953-1606145912385-WA-Maldives-Ithaafushi-Terra_HR.jpg', '1673500715_Beautiful sea beach ??? _Nature whatsapp status _sad song whatsapp status.mp4', '&lt;p&gt;Second TopicSecond TopicSecond TopicSecond TopicSecond TopicSecond TopicSecond Topic&lt;/p&gt;', 1, '2023-01-12 10:48:35'),
(32, 43, 3, 'Third Topic', '1673500816_Beach.png', '1673500816_Countdown 5 seconds timer.mp4', '&lt;p&gt;Third TopicThird TopicThird TopicThird TopicThird TopicThird Topic&lt;/p&gt;', 1, '2023-01-12 10:50:16'),
(33, 43, 8, 'Fourth Topic', '1673500923_200512103822-maldives-bungalow-aerial.jpg', '1673500923_Countdown 5 seconds timer.mp4', '&lt;p&gt;Fourth TopicFourth TopicFourth TopicFourth TopicFourth TopicFourth Topic&lt;/p&gt;', 1, '2023-01-12 10:52:03'),
(34, 43, 3, 'Fifth Topic', '1673501103__methode_times_prod_web_bin_7541bf62-1cf5-11eb-8696-f5d5fcef88fd.jpg', '1673501103_Beautiful sea beach ??? _Nature whatsapp status _sad song whatsapp status.mp4', '&lt;p&gt;&amp;nbsp;Fifth TopicFifth TopicFifth TopicFifth TopicFifth Topic&lt;/p&gt;', 1, '2023-01-12 10:55:03'),
(35, 43, 2, 'HEllo', '1673502181__methode_times_prod_web_bin_7541bf62-1cf5-11eb-8696-f5d5fcef88fd.jpg', '1673502181_Beautiful sea beach ??? _Nature whatsapp status _sad song whatsapp status.mp4', '&lt;p&gt;HElloHElloHElloHElloHEllo&lt;/p&gt;', 1, '2023-01-12 11:13:01');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `name`, `description`) VALUES
(2, 'Relax', '<p>&nbsp;Relax Relax Relax RelaxRelaxRelax Relax Relax RelaxRelaxRelax Relax Relax RelaxRelaxRelax Relax Relax RelaxRelaxRelax Relax Relax RelaxRelax</p>'),
(3, 'Perfect', '<p>PerfectPerfectPerfectPerfectPerfectPerfectPerfectPerfectPerfectPerfectPerfectPerfect</p>'),
(8, 'Demonstrate', '<p>DemonstrateDemonstrateDemonstrateDemonstrateDemonstrateDemonstrateDemonstrate</p>');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `admin`, `username`, `email`, `password`, `created_at`) VALUES
(42, 1, 'John', 'john@gmail.com', '$2y$10$xjxk3Tgy7EQWFZBNmMZXi.9k2I6WvzMlHbsylTSU/fbVGRwltG/5m', '2022-10-05 08:16:59'),
(43, 1, 'Dilshad', '111@gmail.com', '$2y$10$AfzBh9xZE2sV/8udFOZeOO6Eh5PSfguUgWKYAv.cWsJVaEDkADIpi', '2023-01-12 04:10:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

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
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
