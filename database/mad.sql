-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2024 at 10:31 AM
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
  `profile_photo` mediumtext NOT NULL,
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

--
-- Dumping data for table `creator`
--

INSERT INTO `creator` (`id`, `name`, `username`, `profile_photo`, `posts`, `email`, `followers`, `category`, `bio`, `impressions`, `profile_view`, `demographic_id`, `recentposts_id`) VALUES
(17841401935231775, 'Virat Kohli', 'virat.kohli', 'https://scontent.famd6-1.fna.fbcdn.net/v/t51.2885-15/331017149_3373809859551320_1963035851400324431_n.jpg?_nc_cat=1&ccb=1-7&_nc_sid=7d201b&_nc_ohc=IR37IiETpLwAX_fV2xv&_nc_ht=scontent.famd6-1.fna&edm=AL-3X8kEAAAA&oh=00_AfB9GhOcdP7NyARhqwpvyCfw-JpLQuLA4AEx_RwC5OWfng&oe=65F1CDBE', 1663, '', 266886075, '', 'Carpediem!', 0, 0, 1, 1),
(17841460128374183, 'BMark', 'bmark_project', 'https://scontent.famd6-1.fna.fbcdn.net/v/t51.2885-15/429675810_768642138535009_6674726623162999018_n.jpg?_nc_cat=105&ccb=1-7&_nc_sid=7d201b&_nc_ohc=tmeMHLjk5ucAX9UgTyh&_nc_oc=AQlRt0sV5AIdpgstRy6T-0Hieeu0T9GAcMgJapQyKm3RGhCQY3xMPldVDKKVXwi6B1_8hoagttw9GQsPjsWOnQ6N&_nc_ht=scontent.famd6-1.fna&edm=AL-3X8kEAAAA&oh=00_AfDMAIsYikhsvFKXEfis8M5LH-7wcEwJkcvETyqNzORRCQ&oe=65F2BD04', 4, '', 1, '', 'This account is for personal use for our project development.', 0, 0, 1, 0);

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

--
-- Dumping data for table `demographics`
--

INSERT INTO `demographics` (`id`, `follower_city`, `follower_age`, `follower_gender`, `engaged_city`, `engaged_age`, `engaged_gender`, `reach_city`, `reach_age`, `reach_gender`) VALUES
(1, '', '', '', '', '', '', '', '', '');

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

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `media_type`, `thumbnail`, `url`) VALUES
(17892148769920719, 'IMAGE', 'https://scontent.cdninstagram.com/v/t51.29350-15/432321954_1634510173990407_682465498958405258_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=18de74&_nc_ohc=8nEIJhz16ToAX_yQrF5&_nc_oc=AQmV3bnbe88wYCf9IodjEh7URB4p0gc4RSQS6wsowEnBA8MZ4lDk0h07AaiP0PBoNRQwMKBXyTfakPI8RqKtPcoy&_nc_ht=scontent.cdninstagram.com&edm=AEQ6tj4EAAAA&oh=00_AfBsCjkgtXwoXd04D1ofWLekJ1Hf5cldYWipABbI_0BGTQ&oe=65F17137', 'https://www.instagram.com/p/C4QSueZMvr1/'),
(17949141836768838, 'Image', 'hello', 'hello'),
(17996777375451752, 'Image', 'hello', 'hello'),
(18001825979411239, 'IMAGE', 'https://scontent.cdninstagram.com/v/t51.29350-15/432326193_789886229664347_3953511338229169757_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=18de74&_nc_ohc=IGyeSWVWQoEAX-fzmtA&_nc_ht=scontent.cdninstagram.com&edm=AEQ6tj4EAAAA&oh=00_AfAYFEif7fCm9tdHe9MJMasVrmgJfx2Wciz23159AQ-JmA&oe=65F35DB1', 'https://www.instagram.com/p/C4TT60wMIdI/'),
(18006784358516627, 'IMAGE', 'https://scontent.cdninstagram.com/v/t51.29350-15/429959071_2573857556151520_1614173144033438709_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=18de74&_nc_ohc=qk0o5A3Y-1cAX9gmsSq&_nc_ht=scontent.cdninstagram.com&edm=AEQ6tj4EAAAA&oh=00_AfDsKrFKAoqIYZWi64d44208Go-FXS7ydV1lUhebBH7wFA&oe=65F21A87', 'https://www.instagram.com/p/C34v7CtMrGh/'),
(18013087925165000, 'Video', 'hello', 'hello'),
(18073284763450237, 'Video', 'hello', 'hello'),
(18312272122130132, 'IMAGE', 'https://scontent.cdninstagram.com/v/t51.29350-15/432293839_914141853739890_6997066684382459735_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=18de74&_nc_ohc=yZcH0g8M7wcAX8JRqWM&_nc_ht=scontent.cdninstagram.com&edm=AEQ6tj4EAAAA&oh=00_AfDF4GT4zuBUV1uBvYsCYLuxad43TiKUYzBB4S6eUbF7Ig&oe=65F25B20', 'https://www.instagram.com/p/C4TT_4UMzLv/');

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
-- Dumping data for table `recentposts`
--

INSERT INTO `recentposts` (`id`, `post1`, `post2`, `post3`, `post4`) VALUES
(0, 18312272122130132, 18001825979411239, 17892148769920719, 18006784358516627),
(1, 17949141836768838, 17996777375451752, 18013087925165000, 18073284763450237);

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
