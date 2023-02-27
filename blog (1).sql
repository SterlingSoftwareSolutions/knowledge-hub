-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2023 at 10:05 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

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
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `video` varchar(255) CHARACTER SET utf8 NOT NULL,
  `body` text CHARACTER SET utf8 NOT NULL,
  `published` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `isAdmin` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `topic_id`, `title`, `video`, `body`, `published`, `created_at`, `isAdmin`) VALUES
(387, 48, 11, 'Amazing Sri-Lanka', '1676948065_sampleVideo.mp4', '&lt;p&gt;&lt;strong&gt;Sri Lanka&lt;/strong&gt; is an island nation located in the Indian Ocean, just off the southeastern coast of India. Despite its modest size&mdash;slightly larger than the state of West Virginia&mdash;Sri Lanka has a population of about 20 million people, almost equal to the population of Texas. The island is rich in natural resources, and has a diverse economy based on agriculture, mining, fishing, manufacturing, and tourism. On becoming an independent nation in 1948 Sri Lanka (formerly called Ceylon) seemed to be headed for a future as a stable and prosperous democracy. Since the 1970s, however, the country has been torn by violent struggles between the two main ethnic groups, Sinhalese and Tamils, that make up its population. Sri Lanka suffered severe damage and loss of life from the tsunami of 2004; what effect that disaster will have on the country&rsquo;s political future remains to be seen.&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Geography&lt;/strong&gt;&lt;br&gt;Shaped like a teardrop, the island of Sri Lanka measures about 255 miles (415 km.) from north to south, and about 135 miles (220 km.) from east to west, with a total land area of about 25,300 square miles (65,600 square km.). It has more than 830 miles (1340 km.) of coastline. The island is ringed by a broad coastal plain, rising to an inland terrain of gently rolling hills. A range of mountains dominates the south-central interior, with the highest peak, Mt. Piduruthalagala, reaching more than 8200 feet (2524 meters) in height.&lt;/p&gt;&lt;p&gt;Located between 5 and 10 degrees latitude north of the equator, Sri Lanka has a tropical climate dominated by two monsoon seasons. The summer monsoon lasts from mid-May to October, when winds from the southwest bring rain from the Indian Ocean to the southern and western parts of the island. During the winter monsoon, from December through March, winds from the northeast bring rain from the Bay of Bengal to northern and eastern regions. Monsoon rains are constant and heavy, with up to 100 inches of rain per month falling during the summer monsoon in the southwest. October-November and mid-March to mid-May are intermonsoon seasons, with less rainfall. The climate is hot and humid for much of the year, but is cooler in the highlands.&lt;/p&gt;', 1, '2023-02-21 08:24:25', 0),
(388, 48, 12, 'jhjlhbkm,mn', '', '&lt;p&gt;dt5xrdtrr&lt;/p&gt;', 1, '2023-02-21 09:25:34', 0),
(389, 48, 12, 'no video', '', '&lt;p&gt;wrgwht&lt;/p&gt;', 1, '2023-02-21 09:26:20', 0),
(390, 48, 11, 'deqfwe', '1676964760_fish.mp4', '&lt;p&gt;wrqg&lt;/p&gt;', 1, '2023-02-21 13:02:40', 0);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `name`, `description`) VALUES
(10, 'Hostingsge', '<p>asf</p>'),
(11, 'Development', ''),
(12, 'Styling', ''),
(13, 'Migrations', ''),
(14, 'Email', '');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` int(12) NOT NULL,
  `images` varchar(255) DEFAULT NULL,
  `date_time` datetime DEFAULT current_timestamp(),
  `postId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `images`, `date_time`, `postId`) VALUES
(197, 'one-of-the-best-travel.jpg', '2023-02-21 03:54:25', 387),
(198, 'sl2.jpg', '2023-02-21 03:54:25', 387),
(200, 'maxresdefault-850x560.jpg', '2023-02-21 03:55:43', 387),
(201, 'image-15-768x383.png', '2023-02-21 04:55:34', 388),
(202, 'image-14-705x1024.png', '2023-02-21 04:55:34', 388),
(203, 'cat.jpg', '2023-02-21 04:56:20', 389),
(204, 'sl2.jpg', '2023-02-21 08:32:40', 390);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `admin`, `username`, `email`, `password`, `created_at`) VALUES
(45, 1, 'admin', 'thafnaz42@gmail.com', '$2y$10$B8oV65lLx2cZQClXyY9MzeAx8V4pOrb6IN.kB2lbWpyB4ZxWlYm5i', '2023-02-02 02:03:26'),
(46, 0, 'user1', 'user1@gmail.com', '$2y$10$V7bW11Ce19UcuU/WnobGreiWxquD9b4cvc1Tr9SX6r2qZR8f7bGo.', '2023-02-16 01:31:40'),
(48, 1, 'Thaf', 'admin2@gmail.com', '$2y$10$BzDsgwT2cqGWOwZgBxr4l..hSmDDOdlZZJjeaJhP45EpV2tzCrBbi', '2023-02-16 01:39:36');

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
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postId` (`postId`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=391;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
