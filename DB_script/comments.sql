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
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_body` text NOT NULL,
  `posted_by` varchar(80) NOT NULL,
  `time_stamp` datetime NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_body`, `posted_by`, `time_stamp`, `post_id`) VALUES
(1, 'message me before you start playing', 'jaidevyd@gmail.com', '2017-10-15 21:03:29', 38),
(2, 'Why are you uploading the same pic for every event?', 'jaidevyd@gmail.com', '2017-10-15 21:04:53', 34),
(3, 'at what time are we playing?', 'patilmeghesh91@gmail.com', '2017-10-20 20:19:47', 35),
(4, 'i am in for this', 'sagar.panchal11@gmail.com', '2017-10-20 20:28:04', 36),
(5, 'anyone?', 'sagar.panchal11@gmail.com', '2017-10-20 20:32:02', 42),
(6, 'I am in', 'patilmeghesh91@gmail.com', '2017-10-20 20:32:45', 42),
(7, 'Me too', 'sri@yahoo.com', '2017-10-22 18:53:46', 42),
(8, 'Anyone? Pls respond.', 'sagar.panchal11@gmail.com', '2017-10-22 19:25:15', 49),
(9, 'I am in', 'prash1987@gmail.com', '2017-10-22 19:26:01', 49),
(10, 'guys, anyone interested?', 'prash1987@gmail.com', '2017-10-23 01:01:57', 50);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
