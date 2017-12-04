CREATE DATABASE  IF NOT EXISTS `p565f17_prbhat`
USE `p565f17_prbhat`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: db.soic.indiana.edu    Database: p565f17_prbhat
-- ------------------------------------------------------
-- Server version	5.5.56-MariaDB
--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_body` text NOT NULL,
  `posted_by` varchar(80) NOT NULL,
  `time_stamp` datetime NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `feedback` varchar(200) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `phone` varchar(10) NOT NULL,
  PRIMARY KEY (`feedback_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;


--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(45) NOT NULL,
  `admin` varchar(60) NOT NULL,
  `members` text,
  PRIMARY KEY (`group_id`),
  UNIQUE KEY `group_name_UNIQUE` (`group_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;


--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;

CREATE TABLE `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(80) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;


--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;

CREATE TABLE `login` (
  `User_id` varchar(128) NOT NULL,
  `Password` varchar(128) DEFAULT NULL,
  `salt` varchar(128) DEFAULT NULL,
  `email_id` varchar(128) DEFAULT NULL,
  `otp` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`User_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `date` datetime NOT NULL,
  `opened` int(11) NOT NULL,
  `viewed` int(11) NOT NULL,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=171 DEFAULT CHARSET=latin1;


--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `body` text NOT NULL,
  `posted_by` varchar(80) NOT NULL,
  `time_stamp` datetime NOT NULL,
  `location` varchar(80) NOT NULL,
  `play_time` datetime NOT NULL,
  `image_path` text NOT NULL,
  `likes` int(11) NOT NULL,
  `game` varchar(45) NOT NULL,
  `gender` char(1) NOT NULL,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;


--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;

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
  `propic` varchar(150) DEFAULT NULL,
  `status_timestamp` int(11) DEFAULT NULL,
  `friend_array` text,
  `my_blocks` text,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- Dump completed on 2017-12-03 23:48:35
