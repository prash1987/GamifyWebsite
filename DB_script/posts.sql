-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2017 at 01:12 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamify`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `body` text NOT NULL,
  `posted_by` varchar(80) NOT NULL,
  `time_stamp` datetime NOT NULL,
  `location` varchar(80) NOT NULL,
  `play_time` datetime NOT NULL,
  `image_path` text NOT NULL,
  `likes` int(11) NOT NULL,
  `game` varchar(45) NOT NULL,
  `gender` varchar(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `posted_by`, `time_stamp`, `location`, `play_time`, `image_path`, `likes`, `game`, `gender`) VALUES
(32, 'I wanna play cricket tomorrow. Who all are in?', 'prash1987@gmail.com', '2017-10-11 02:36:12', 'Bloomington', '2017-10-11 00:00:00', 'DSC00154.JPG', 0, 'CRICKET', 'A'),
(33, 'lets play badminton tomorrow', 'prash1987@gmail.com', '2017-10-13 20:09:16', 'Bloomington', '2017-10-14 17:00:00', 'DSC00147 - Copy.JPG', 0, 'BADMINTON', 'M'),
(34, 'lets play cricket today', 'prash1987@gmail.com', '2017-10-14 21:52:26', 'Bloomington', '2017-10-14 20:00:00', 'IMG_20160820_185550137.jpg', 0, 'CRICKET', 'A'),
(35, 'lets play cricket today', 'prash1987@gmail.com', '2017-10-14 21:54:36', 'Bloomington', '2017-10-14 20:00:00', 'IMG_20160820_185550137.jpg', 0, 'CRICKET', 'A'),
(36, 'lets play badminton', 'prash1987@gmail.com', '2017-10-14 22:02:57', 'Bloomington', '2017-10-14 20:00:00', 'IMG_20160820_185550137.jpg', 0, 'BADMINTON', 'A'),
(37, 'lets play badminton', 'prash1987@gmail.com', '2017-10-14 22:05:41', 'Bloomington', '2017-10-14 20:00:00', 'IMG_20160820_185550137.jpg', 1, 'BADMINTON', 'A'),
(38, 'lets play tennis please ', 'prash1987@gmail.com', '2017-10-14 22:08:49', 'Bloomington', '2017-10-15 16:00:00', 'IMG_20160820_185550137.jpg', 0, 'TENNIS', 'A'),
(39, 'lets play squash', 'prash1987@gmail.com', '2017-10-14 22:22:19', 'Bloomington', '2017-10-20 17:00:00', 'IMG_20160820_185550137.jpg', 3, 'SQUASH', 'A'),
(40, 'lets play basketball', 'prash1987@gmail.com', '2017-10-14 22:27:06', 'Bloomington', '2017-10-21 18:00:00', 'IMG_20160820_185550137.jpg', 0, 'BASKETBALL', 'A'),
(41, 'Who wanna play basketball this weekend', 'sagar.panchal11@gmail.com', '2017-10-20 20:29:01', 'Bloomington', '2017-10-22 17:00:00', 'DSC00195.JPG', 0, 'BASKETBALL', 'A'),
(42, 'lets play cricket tomorrow', 'sagar.panchal11@gmail.com', '2017-10-20 20:31:42', 'Bloomington', '2017-10-21 16:00:00', 'DSC00209.JPG', 11, 'CRICKET', 'A'),
(43, 'Anyone wants to join me for cycling on 30th?', 'prash1987@gmail.com', '2017-10-22 05:42:03', 'Bloomington', '2017-10-30 17:00:00', 'DSC00191.JPG', 4, 'CYCLING', 'A'),
(44, 'who wants to join me for a work-out session on 28th', 'sri@yahoo.com', '2017-10-22 18:13:57', 'Bloomington', '2017-10-28 16:00:00', 'default_post.jpg', 5, 'GYM', 'A'),
(45, 'who wants to join me for a dance session on 30th', 'sri@yahoo.com', '2017-10-22 18:21:41', 'Bloomington', '2017-10-30 10:00:00', 'default_post.jpg', 4, 'DANCE', 'F'),
(49, 'Guys, how about karate session tonight?', 'sagar.panchal11@gmail.com', '2017-10-22 19:24:24', 'Bloomington', '2017-10-22 20:00:00', 'default_post.jpg', 1, 'MARTIALARTS', 'A'),
(50, 'cricket tomorrow?', 'prash1987@gmail.com', '2017-10-23 01:01:27', 'Bloomington', '2017-10-23 17:30:00', 'default_post.jpg', 0, 'CRICKET', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
