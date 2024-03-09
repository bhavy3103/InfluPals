-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2024 at 05:59 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mad`
--

-- --------------------------------------------------------

--
-- Table structure for table `creator`
--

CREATE TABLE `creator` (
  `id` bigint(18) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `posts` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `followers` int(10) NOT NULL,
  `category` varchar(200) NOT NULL,
  `bio` varchar(1000) NOT NULL,
  `impressions` int(10) NOT NULL,
  `profile_view` int(10) NOT NULL,
  `demographic_id` bigint(20) NOT NULL,
  `recentposts_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `demographics`
--

CREATE TABLE `demographics` (
  `id` bigint(20) NOT NULL,
  `follower_city` mediumtext NOT NULL,
  `follower_age` mediumtext NOT NULL,
  `follower_gender` mediumtext NOT NULL,
  `engaged_city` mediumtext NOT NULL,
  `engaged_age` mediumtext NOT NULL,
  `engaged_gender` mediumtext NOT NULL,
  `reach_city` mediumtext NOT NULL,
  `reach_age` mediumtext NOT NULL,
  `reach_gender` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` bigint(18) NOT NULL,
  `media_type` varchar(10) NOT NULL,
  `thumbnail` mediumtext NOT NULL,
  `url` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `recentposts`
--

CREATE TABLE `recentposts` (
  `id` bigint(18) NOT NULL,
  `post1` bigint(18) NOT NULL,
  `post2` bigint(18) NOT NULL,
  `post3` bigint(18) NOT NULL,
  `post4` bigint(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `creator`
--
ALTER TABLE `creator`
  ADD PRIMARY KEY (`id`),
  ADD KEY `demographic_id` (`demographic_id`),
  ADD KEY `recentposts_id` (`recentposts_id`);

--
-- Indexes for table `demographics`
--
ALTER TABLE `demographics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recentposts`
--
ALTER TABLE `recentposts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post1` (`post1`),
  ADD KEY `post2` (`post2`),
  ADD KEY `post3` (`post3`),
  ADD KEY `post4` (`post4`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `creator`
--
ALTER TABLE `creator`
  ADD CONSTRAINT `creator_ibfk_1` FOREIGN KEY (`demographic_id`) REFERENCES `demographics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `creator_ibfk_2` FOREIGN KEY (`recentposts_id`) REFERENCES `recentposts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recentposts`
--
ALTER TABLE `recentposts`
  ADD CONSTRAINT `recentposts_ibfk_1` FOREIGN KEY (`post1`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recentposts_ibfk_2` FOREIGN KEY (`post2`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recentposts_ibfk_3` FOREIGN KEY (`post3`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recentposts_ibfk_4` FOREIGN KEY (`post4`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
