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
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` varchar(30) NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `contact` decimal(10,0) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `userbio` varchar(200) DEFAULT NULL,
  `sec_q1` varchar(150) DEFAULT NULL,
  `sec_ans1` varchar(150) DEFAULT NULL,
  `sec_q2` varchar(150) DEFAULT NULL,
  `sec_ans2` varchar(150) DEFAULT NULL,
  `propic` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `address`, `email`, `contact`, `dob`, `userbio`, `sec_q1`, `sec_ans1`, `sec_q2`, `sec_ans2`, `propic`) VALUES
('prash1987@gmail.com', 'Prashanth', 'Bhat', 'Bloomington', 'prash1987@gmail.com', '309660', '1987-09-05', 'CRICKET,BADMINTON,SQUASH', 'what is your nick name?', 'prash', 'what is your mothers maiden name', 'leela', 'DSC00167 - Copy.JPG'),
('pradeep@gmail.com', 'Pradeep', 'Bhat', 'Bloomington', 'pradeep@gmail.com', '1234567890', '1992-10-10', 'FOOTBALL,CRICKET', 'what is your nick name?', 'prash', 'what is your mothers maiden name', 'leela', 'pro_pic.png'),
('prakash@gmail.com', 'Prakash', 'Bhat', 'Bloomington', 'prakash@gmail.com', '9987654321', '1960-10-03', 'FOOTBALL,SQUASH', 'what is your nick name?', 'prash', 'what is your mothers maiden name', 'leela', 'pro_pic.png'),
('prbhat@indiana.edu', 'new', 'guy', 'bloomington', 'prbhat@indiana.edu', '3333333333', '2017-10-10', 'CRICKET', 'what is your nick name?', 'prash', 'what is your mothers maiden name', 'leela', 'pro_pic.png'),
('prash.kumta@gmail.com', 'Prashanth', 'Kumta', 'Bloomington', 'prash.kumta@gmail.com', '1234567890', '1987-10-30', 'BADMINTON,SQUASH,DANCE', 'what is your nick name?', 'prash', 'which is your native?', 'kumta', 'DSC00554 - Copy.JPG'),
('jaidevyd@gmail.com', 'Jaidev', 'Dinesh', 'Bloomington', 'jaidevyd@gmail.com', '1231231234', '1990-10-10', 'CRICKET,FOOTBALL,BADMINTON,TENNIS', 'what is your nick name?', 'JD', 'which is your native?', 'mangalore', 'pro_pic.png'),
('patilmeghesh91@gmail.com', 'Meghesh', 'Patil', 'Bloomington', 'patilmeghesh91@gmail.com', '1234567890', '1990-10-17', 'CRICKET,BADMINTON', 'what is your nick name?', 'meghesh', 'which is your native?', 'india', 'DSC00106.JPG'),
('sagar.panchal11@gmail.com', 'Sagar', 'Panchal', 'Bloomington', 'sagar.panchal11@gmail.com', '1234567890', '1991-10-18', 'CRICKET,SQUASH,TENNIS', 'which is your favorite game?', 'cricket', 'which is your native?', 'india', 'DSC00209.JPG'),
('sri@yahoo.com', 'sri', 'harsha', 'Bloomington', 'sri@yahoo.com', '10', '1987-10-21', 'CYCLING,GYM,DANCE,', 'what is your nick name?', 'harsha', 'which is your native?', 'india', 'pro_pic.png'),
('prad92@gmail.com', 'Anna', 'Bond', 'Bloomington', 'prad92@gmail.com', '1234567892', '1992-10-07', 'CYCLING,GYM,SOCCER,BOXING', 'what is your nick name?', 'pradeep', 'which is your native?', 'india', 'pro_pic.png'),
('prash1988@gmail.com', 'test', 'test', 'Bloomington', 'prash1988@gmail.com', '1232534543', '1992-10-13', 'GYM,', 'what is your nick name?', 'test', 'which is your native?', 'india', 'pro_pic.png'),
('prashant4782003@yahoo.com', 'test23', 'test23', 'Bloomington', 'prashant4782003@yahoo.com', '2369864531', '1987-10-05', 'GYM,DANCE,CHESS', 'born', 'india', 'father', '1956', 'pro_pic.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
