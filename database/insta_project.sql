-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2024 at 06:33 AM
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
-- Database: `insta_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `user` (
  `id` bigint(20) NOT NULL,
  `Name` varchar(1000) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `phone` int(11) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `booking_details` (
  `id` bigint(20) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `contact` int(10) NOT NULL,
  `requirements` varchar(10000) NOT NULL,
  `budget` bigint(20) NOT NULL,
  `page_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` bigint(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `image_url` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `demographics`
--

CREATE TABLE `demographics` (
  `id` bigint(20) NOT NULL,
  `page_id` bigint(20) NOT NULL,
  `city` mediumtext NOT NULL,
  `gender` mediumtext NOT NULL,
  `age` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) NOT NULL,
  `page_id` bigint(20) NOT NULL,
  `like_count` bigint(20) NOT NULL DEFAULT 0,
  `comments_count` bigint(20) NOT NULL DEFAULT 0,
  `permalink` varchar(5000) NOT NULL,
  `media_url` varchar(5000) NOT NULL,
  `media_type` varchar(100) NOT NULL,
  `media_product_type` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `thumbnail_url` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` bigint(20) NOT NULL,
  `type` varchar(12) NOT NULL DEFAULT 'facebook',
  `name` varchar(50) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `profile_picture_url` mediumtext DEFAULT NULL,
  `media_count` int(11) NOT NULL DEFAULT 0,
  `followers_count` bigint(20) NOT NULL DEFAULT 0,
  `category` varchar(100) NOT NULL,
  `biography` varchar(1000) DEFAULT NULL,
  `location` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pricing`
--

CREATE TABLE `pricing` (
  `id` bigint(20) NOT NULL,
  `page_id` bigint(20) NOT NULL,
  `story` int(15) NOT NULL DEFAULT 0,
  `igtv_video` int(15) NOT NULL DEFAULT 0,
  `reel` int(15) NOT NULL DEFAULT 0,
  `live_stream` int(15) NOT NULL DEFAULT 0,
  `feed_post` int(15) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creator_id` (`page_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `demographics`
--
ALTER TABLE `demographics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_demographics_page_id` (`page_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_media_page_id` (`page_id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pricing`
--
ALTER TABLE `pricing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_id` (`page_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `demographics`
--
ALTER TABLE `demographics`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pricing`
--
ALTER TABLE `pricing`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


-- Category added to into database no need to run query using this
INSERT INTO `category` (`id`, `name`, `image_url`) VALUES ('1', 'Lifestyle', 'https://creatorhub.in/wp-content/uploads/2023/04/Lifestyle-bloggers.jpg'), ('2', 'Fitness', 'https://images.news9live.com/wp-content/uploads/2023/12/Untitled-design-2023-12-30T133024.077.jpg?w=802&enlarge=true'), ('3', 'Fashion', 'https://stylesociety.co.za/wp-content/uploads/2020/05/How-To-Start-A-Fashion-Blog.jpg'), ('4', 'Art', 'https://www.plannthat.com/wp-content/uploads/2021/07/pexels-anthony-shkraba-4348401.jpg'), ('5', 'Food', 'https://www.indiafoodnetwork.in/wp-content/uploads/2020/09/bloggers.jpg'), ('6', 'Makeup', 'https://images.prismic.io/mojo-website/8f42ffc0-d2f5-4eb0-9939-69c63c2b3329_insta-cosmetic-center.jpg?auto=compress,format&q=90&w=1040&fm=webp'), ('7', 'Photography', 'https://intellectualpropertyplanet.wordpress.com/wp-content/uploads/2020/10/pexels-photo-3768187.jpeg?w=1024'), ('8', 'OTHERS', 'https://www.indiafoodnetwork.in/wp-content/uploads/2020/09/bloggers.jpg');


--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD CONSTRAINT `booking_details_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `demographics`
--
ALTER TABLE `demographics`
  ADD CONSTRAINT `fk_demographics_page_id` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `fk_media_page_id` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pricing`
--
ALTER TABLE `pricing`
  ADD CONSTRAINT `pricing_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON DELETE CASCADE;


ALTER TABLE `booking_details` ADD `page_username` varchar(1000) NOT NULL;

-- user table
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `booking_details` ADD `user_id` INT NOT NULL AFTER `page_id`;

ALTER TABLE `category` MODIFY COLUMN `image_url` MEDIUMTEXT DEFAULT NULL;

COMMIT;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
