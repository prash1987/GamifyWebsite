-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2017 at 01:10 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
(1, 'Nice Image', 'sagar.panchal11@gmail.com', '2017-10-16 15:34:39', 8),
(2, 'hi', 'sagar.panchal11@gmail.com', '2017-10-20 23:26:58', 12),
(3, 'wassupp', 'sagar.panchal11@gmail.com', '2017-10-20 23:27:14', 12),
(4, 'thanx', 'sagar.panchal11@gmail.com', '2017-10-21 23:40:34', 16),
(5, 'Hi', 'sagar.panchal11@gmail.com', '2017-10-27 15:52:03', 16),
(6, 'Wasssuppp', 'sagar.panchal11@gmail.com', '2017-10-29 19:42:57', 14);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `feedback` varchar(200) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `phone` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `feedback`, `name`, `email`, `phone`) VALUES
(6, 'good website!!', 'gamer1', 'gamer1@gmail.com', '9234435256'),
(7, 'just checking it', 'Prashanth Bhat', 'prbhat@indiana.edu', '3096602233');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `username` varchar(80) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `username`, `post_id`) VALUES
(2, 'patilmeghesh91@gmail.com', 12),
(3, 'patilmeghesh91@gmail.com', 8);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `User_id` varchar(128) NOT NULL,
  `Password` varchar(128) DEFAULT NULL,
  `salt` varchar(128) DEFAULT NULL,
  `email_id` varchar(128) DEFAULT NULL,
  `otp` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`User_id`, `Password`, `salt`, `email_id`, `otp`) VALUES
('prash1987@gmail.com', '8761d26a9842f4bff35f97c33103b6ef0ac8194c836f9aae36317f9c533c99d821a81b1f1e8c682fc17c65da732b8a26375e42596aa8c77cf8571c81c1e286c2', 'b181d782ee22623a47b8c3729ee30a216e1c12b187bb7b1d913d79037f3468102c6131214e0efb84f93dc95333cae94fa87d374c0a622f9c6d0cb92acffe7c89', 'prash1987@gmail.com', '967068'),
('pradeep@gmail.com', 'c59b7b70b5fa2276dea0475c942c89283904ad304733898e583565a9a7bd2d4077497316d60dfc9bdb7d59282d9888f82d495a14f3bd1b67d0fc9c2c32123c40', '2eebe77c38573d9be763a0fa58af132ed019a0c8718bc00e3b65033007698ed32e2da2301afbf8ee5c605e74df40b15ca3f35012c7160a831ba3895e191af4fb', 'pradeep@gmail.com', ''),
('prakash@gmail.com', 'f6e6566b55dd85ee1ff2c1fd4197e0505ff44bc2514bc05eab7f93041528d550dc21523b6cbd62a5045b31cb1e213efc387f4952889ab2c56154836e7741258d', '3c680ef4dbf476e1547883b84dd44dc81497523c11e87dbb9f39e59496b21c83697a2cd09d0cf3929be220dbc932e9bd14804c2e45805e245fd99082dee405c4', 'prakash@gmail.com', '384545'),
('prbhat@indiana.edu', '85c4e758fb2351bc929a58ca24c23a1d8590f131d8edebb3b187da277241e0156b4d04abea85aa3ce17cc50ac311a93cbd778c2a250bca6c0f2dd22883486471', '85b1bd02cdf40cd17e13c22634f02bcf34912d4a62e21416bf870595f9c61334dd40d14b549a0be816b88c0db7b1563c83007140a4cb8f8f1c76c2c25b9f2b61', 'prbhat@indiana.edu', '680764'),
('prash.kumta@gmail.com', 'c278890e9551c6923fcb28606da350d3ad203c65631eb65200d73313389c03eebeb7c9a0f22d1cda71cec23343672d4b035474b898f0a23798ba76e04de9fd8c', 'e7b8602f12984a6e56367aad76a700cc787207ad040c23566e82d197648c32657fd943230d89f05237fac0520eaedd21eeb4d471e67f02acfc01f1fa28ac4c8f', 'prash.kumta@gmail.com', ''),
('vsriniv@iu.edu', '9aa792be0ef6d3f8c7fd753fbef99222181f417444fdcfca1534f4c5e2c53c7d039fbc6e22b29fb0d8fad961aa953765de242c5aef720d4ffe10c7dea5ba8ff9', '07808f6e7f8167416e76d2022766aaf5eb280fe2daf755cefad5cc90fd4993f24b20a1b740e4379f78f17121e4e79df9de6fd6c27986876eab5128a47d2abb9e', 'vsriniv@iu.edu', '694759'),
('sagar.panchal11@gmail.com', 'd97ca7d3a0c8121a9bdbad4f59d80b9e1cfb343cffa5b66015143d65d39ee21bcd8815de2a0ed0db29587ca726877459ba372b9baa940e95585933f68f1e9a84', '79de448641c1ac5c0b8c4c828665ff6d65a8bfab0a49bb0396439eb7506cd6a7b6001a182bb775f0b5bc3f9314e81bc0247ffb74ae7876d0d783a2d04eb626b8', 'sagar.panchal11@gmail.com', '462357'),
('patilmeghesh91@gmail.com', '2696156399925b69bebb13071984c113e8f62b5afdf5e019490a4906e4705c23b3224b77b00e054133f57c5206d3a4b720dfb82f2b0625c063552cadf1ad88d9', '346534yr8we8fhwe', 'patilmeghesh91@gmail.com', '550080');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `date` datetime NOT NULL,
  `opened` int(11) NOT NULL,
  `viewed` int(11) NOT NULL,
  `deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_to`, `user_from`, `body`, `date`, `opened`, `viewed`, `deleted`) VALUES
(1, 'vsriniv@iu.edu', 'sagar.panchal11@gmail.com', 'Hi wassupp,', '2017-10-28 01:07:43', 0, 0, 0),
(2, 'vsriniv@iu.edu', 'sagar.panchal11@gmail.com', 'heya', '2017-10-28 01:09:01', 0, 0, 0),
(3, 'vsriniv@iu.edu', 'sagar.panchal11@gmail.com', 'dasdasdasd', '2017-10-28 01:09:05', 0, 0, 0),
(4, 'vsriniv@iu.edu', 'sagar.panchal11@gmail.com', 'csdkcmaocm', '2017-10-28 01:09:13', 0, 0, 0),
(5, 'sagar.panchal11@gmail.com', 'vsriniv@iu.edu', 'Hi ', '2017-10-28 01:29:17', 0, 0, 0),
(6, 'sagar.panchal11@gmail.com', 'vsriniv@iu.edu', 'wassupp', '2017-10-28 01:29:29', 0, 0, 0),
(7, 'sagar.panchal11@gmail.com', 'vsriniv@iu.edu', 'completed sprint #3?', '2017-10-28 01:29:41', 0, 0, 0),
(11, 'vsriniv@iu.edu', 'sagar.panchal11@gmail.com', 'wassupp', '2017-10-28 19:22:55', 0, 0, 0),
(12, 'vsriniv@iu.edu', 'sagar.panchal11@gmail.com', 'su karo cho', '2017-10-28 19:23:09', 0, 0, 0),
(13, 'vsriniv@iu.edu', 'sagar.panchal11@gmail.com', 'majama ne', '2017-10-28 19:23:15', 0, 0, 0),
(14, 'vsriniv@iu.edu', 'sagar.panchal11@gmail.com', 'majama ne', '2017-10-28 19:25:15', 0, 0, 0),
(15, 'vsriniv@iu.edu', 'sagar.panchal11@gmail.com', 'majama ne', '2017-10-28 19:25:18', 0, 0, 0),
(16, 'vsriniv@iu.edu', 'sagar.panchal11@gmail.com', 'majama ne', '2017-10-28 19:30:08', 0, 0, 0),
(17, 'vsriniv@iu.edu', 'sagar.panchal11@gmail.com', 'dssdf', '2017-10-28 19:30:12', 0, 0, 0),
(18, 'vsriniv@iu.edu', 'sagar.panchal11@gmail.com', 'abdasbd', '2017-10-28 19:30:19', 0, 0, 0),
(19, 'vsriniv@iu.edu', 'sagar.panchal11@gmail.com', 'abdasbd', '2017-10-28 19:30:37', 0, 0, 0),
(20, 'vsriniv@iu.edu', 'sagar.panchal11@gmail.com', 'abdasbd', '2017-10-28 19:32:59', 0, 0, 0),
(21, 'vsriniv@iu.edu', 'sagar.panchal11@gmail.com', 'abdasbd', '2017-10-28 19:33:03', 0, 0, 0),
(22, 'vsriniv@iu.edu', 'sagar.panchal11@gmail.com', 'abdasbd', '2017-10-28 19:33:13', 0, 0, 0),
(23, 'vsriniv@iu.edu', 'sagar.panchal11@gmail.com', 'abdasbd', '2017-10-28 19:34:32', 0, 0, 0),
(24, 'vsriniv@iu.edu', 'sagar.panchal11@gmail.com', 'abdasbd', '2017-10-28 20:01:47', 0, 0, 0),
(25, 'vsriniv@iu.edu', 'sagar.panchal11@gmail.com', 'abdasbd', '2017-10-28 20:02:11', 0, 0, 0),
(26, 'vsriniv@iu.edu', 'sagar.panchal11@gmail.com', 'abdasbd', '2017-10-28 20:02:16', 0, 0, 0),
(27, 'patilmeghesh91@gmail.com', 'vsriniv@iu.edu', 'Heya, wassupp', '2017-10-28 22:49:20', 0, 0, 0),
(28, 'sagar.panchal11@gmail.com', 'vsriniv@iu.edu', 'waddupp', '2017-10-28 22:52:26', 0, 0, 0),
(29, 'sagar.panchal11@gmail.com', 'vsriniv@iu.edu', 'waddupp', '2017-10-28 22:52:55', 0, 0, 0),
(30, 'sagar.panchal11@gmail.com', 'vsriniv@iu.edu', 'waddupp', '2017-10-28 22:53:29', 0, 0, 0),
(31, 'sagar.panchal11@gmail.com', 'vsriniv@iu.edu', 'waddupp', '2017-10-28 22:53:42', 0, 0, 0),
(32, 'sagar.panchal11@gmail.com', 'vsriniv@iu.edu', 'waddupp', '2017-10-28 22:53:53', 0, 0, 0),
(33, 'sagar.panchal11@gmail.com', 'vsriniv@iu.edu', 'waddupp', '2017-10-28 22:54:03', 0, 0, 0),
(34, 'prash1987@gmail.com', 'sagar.panchal11@gmail.com', 'hey wassuppp?', '2017-10-29 19:10:17', 0, 0, 0),
(35, 'prash1987@gmail.com', 'sagar.panchal11@gmail.com', 'hey wassuppp?', '2017-10-29 19:10:47', 0, 0, 0);

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
  `gender` char(1) NOT NULL,
  `deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `posted_by`, `time_stamp`, `location`, `play_time`, `image_path`, `likes`, `game`, `gender`, `deleted`) VALUES
(1, 'My 1st post ever', 'sagar.panchal11@gmail.com', '2017-10-13 15:56:58', 'Bloomington', '2017-10-13 00:00:00', '332EE38400000578-4125738-image-a-132_1484600112489.jpg', 0, 'Cricket', 'M', 1),
(2, 'My 1st post ever', 'sagar.panchal11@gmail.com', '2017-10-13 15:58:39', 'Bloomington', '2017-10-13 00:00:00', 'fjords.jpg', 0, 'Football', 'A', 1),
(3, '2nd post for Men only', 'sagar.panchal11@gmail.com', '2017-10-13 15:59:42', 'Bloomington', '2017-10-17 00:00:00', 'IMG_20160820_185550137.jpg', 0, 'Dance', 'A', 1),
(4, '2nd post for Men only', 'sagar.panchal11@gmail.com', '2017-10-13 16:00:08', 'Bloomington', '2017-10-17 00:00:00', 'embed2.jpg', 0, 'Cricket', 'M', 0),
(5, '2nd post for Men only', 'sagar.panchal11@gmail.com', '2017-10-13 16:01:22', 'Bloomington', '2017-10-17 00:00:00', 'lights.jpg', 0, 'Football', 'F', 0),
(7, 'Women only event', 'sagar.panchal11@gmail.com', '2017-10-13 16:49:50', 'Bloomington', '2017-10-24 21:00:00', 'facebook.png', 0, 'Gym', 'F', 0),
(8, 'Test of post with image', 'sagar.panchal11@gmail.com', '2017-10-16 15:29:38', 'Bloomington', '2017-11-25 10:00:00', 'Rootstock-Sidechains-696x464.png', 1, 'Cricket', 'A', 1),
(9, 'Meghesh\'s 1st post', 'patilmeghesh91@gmail.com', '2017-10-16 19:24:06', 'Bloomington', '2017-10-17 22:00:00', 'Untitled.png', 0, 'Cricket', '', 0),
(10, 'Meghesh\'s 1st post', 'patilmeghesh91@gmail.com', '2017-10-16 19:25:20', 'Bloomington', '2017-10-17 22:00:00', 'Untitled.png', 0, 'Cricket', '', 0),
(11, 'Meghesh\'s 1st post', 'patilmeghesh91@gmail.com', '2017-10-16 19:26:32', 'Bloomington', '2017-10-17 22:00:00', 'Untitled.png', 0, 'Cricket', '', 0),
(12, 'Meghesh\'s 1st post', 'patilmeghesh91@gmail.com', '2017-10-16 19:27:10', 'Bloomington', '2017-10-17 22:00:00', 'Untitled.png', 1, 'Cricket', '', 0),
(13, 'Hi Vaishnavi', 'patilmeghesh91@gmail.com', '2017-10-16 19:43:00', 'Bloomington', '2017-10-03 17:00:00', 'Family pic.jpeg', 0, 'Football', 'F', 0),
(14, 'Hi Vaishnavi', 'patilmeghesh91@gmail.com', '2017-10-16 19:49:44', 'Bloomington', '2017-10-03 17:00:00', 'Family pic.jpeg', 0, 'Football', 'F', 0),
(15, 'i gay\r\n', 'sagar.panchal11@gmail.com', '2017-10-21 23:39:06', '', '0000-00-00 00:00:00', '', 0, 'Cricket', '', 0),
(16, 'HIii', 'sagar.panchal11@gmail.com', '2017-10-21 23:40:02', 'Bloomington', '2017-01-30 12:59:00', 'Family pic.jpeg', 0, 'Cricket', '', 1);

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
('prash1987@gmail.com', 'Prashanth', 'Bhat', '561 W Amaryllis Dr', 'prash1987@gmail.com', '309660', '1987-09-05', 'nothing', 'what is your nick name?', 'prash', 'what is your mothers maiden name', 'leela', ''),
('pradeep@gmail.com', 'Pradeep', 'Bhat', 'Bloomington', 'pradeep@gmail.com', '1234567890', '1992-10-10', 'Football, volleyball, cricket, pool', 'what is your nick name?', 'prash', 'what is your mothers maiden name', 'leela', ''),
('prakash@gmail.com', 'Prakash', 'Bhat', 'Bloomington', 'prakash@gmail.com', '9987654321', '1960-10-03', 'hockey, soccer, squash', 'what is your nick name?', 'prash', 'what is your mothers maiden name', 'leela', ''),
('prbhat@indiana.edu', 'new', 'guy', 'bloomington', 'prbhat@indiana.edu', '3333333333', '2017-10-10', 'cricket', 'what is your nick name?', 'prash', 'what is your mothers maiden name', 'leela', ''),
('prash.kumta@gmail.com', 'Prash', 'Kumta', 'Bloomington', 'prash.kumta@gmail.com', '1234567890', '1988-10-14', 'badminton, swimming', 'what is your nick name?', 'prash', 'what is your mothers maiden name', 'leela', ''),
('sagar.panchal11@gmail.com', 'Sagar', 'Panchal', 'Bloomington', 'sagar.panchal11@gmail.com', '8123692183', '2017-10-09', 'Cricket,Badminton,Dance', 'born', 'gujarat', 'father', '1969', 'sagar-panchal.png'),
('vsriniv@iu.edu', 'Vaishnavi', 'Srinivasan', 'Bloomington', 'vsriniv@iu.edu', '8123609651', '2017-10-05', 'Tennis', 'Favorite color', 'white', 'Favourite car', 'Audi', ''),
('patilmeghesh91@gmail.com', 'Meghesh', 'Patil', 'Bloomington', 'patilmeghesh91@gmail.com', '8937289145', '2017-10-02', 'Cricket,Football', 'car', 'audi', 'bike', 'dhoom', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`User_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
