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

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `User_id` varchar(128) DEFAULT NULL,
  `Password` varchar(128) DEFAULT NULL,
  `salt` varchar(128) DEFAULT NULL,
  `email_id` varchar(128) DEFAULT NULL,
  `otp` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`User_id`, `Password`, `salt`, `email_id`, `otp`) VALUES
('prash1987@gmail.com', 'ec68caad2ba36535d2bd4351eb9566e73dcc347762448b6fa65f9cc2c58add04f626c767b0c63b142db1a1e68c0b63133d9eae9da568ae57b65ee174014bb6a2', '27db2649ae7f17d3238ae0ba057ce6205eb72c346767231869f4480763fad06f21068a20663947b03d32f789183ab0830522282ec4b1b722b632dbee980f75d0', 'prash1987@gmail.com', '951660'),
('pradeep@gmail.com', 'c59b7b70b5fa2276dea0475c942c89283904ad304733898e583565a9a7bd2d4077497316d60dfc9bdb7d59282d9888f82d495a14f3bd1b67d0fc9c2c32123c40', '2eebe77c38573d9be763a0fa58af132ed019a0c8718bc00e3b65033007698ed32e2da2301afbf8ee5c605e74df40b15ca3f35012c7160a831ba3895e191af4fb', 'pradeep@gmail.com', ''),
('prakash@gmail.com', 'f6e6566b55dd85ee1ff2c1fd4197e0505ff44bc2514bc05eab7f93041528d550dc21523b6cbd62a5045b31cb1e213efc387f4952889ab2c56154836e7741258d', '3c680ef4dbf476e1547883b84dd44dc81497523c11e87dbb9f39e59496b21c83697a2cd09d0cf3929be220dbc932e9bd14804c2e45805e245fd99082dee405c4', 'prakash@gmail.com', '384545'),
('prbhat@indiana.edu', '6babf659d8671877e5c84dbfa121e1dcfe7ae9c42b68d798090c097a5838864d8c409548604f9370fb064e005c0e8f251d2c9f1e915ab68db9aa896c73a659a5', 'dc1b150fb34f296b81938d6aed1abbc77a811f95d835456d537f33fc280882a39cba7ba5031a4fb2d7d5d1a8311f4c00e56df77dc26d998eb2e33125d6d8d198', 'prbhat@indiana.edu', '230352'),
('prash.kumta@gmail.com', 'c278890e9551c6923fcb28606da350d3ad203c65631eb65200d73313389c03eebeb7c9a0f22d1cda71cec23343672d4b035474b898f0a23798ba76e04de9fd8c', 'e7b8602f12984a6e56367aad76a700cc787207ad040c23566e82d197648c32657fd943230d89f05237fac0520eaedd21eeb4d471e67f02acfc01f1fa28ac4c8f', 'prash.kumta@gmail.com', ''),
('jaidevyd@gmail.com', 'add104b92636397b273eb13992387922b46ce1f302ad1ad638929279ff66fc7846249f5af0b4affde1a96dbf68ccf3b16ee570ae11633af8f50715d9ba057b21', '770bcc2e6308e26c8912e56c53d4617015dcddfda2b069dcb92d3bebd3dca13fde7a6298ed3b55f50eff1544a47d6a414f71f83ee131e3d8d25fb75f9abd3c4f', 'jaidevyd@gmail.com', '371527');

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
(32, 'I wanna play cricket tomorrow. Who all are in?', 'prash1987@gmail.com', '2017-10-11 02:36:12', 'Bloomington', '2017-10-11 00:00:00', 'DSC00154.JPG', 0, 'Cricket', 'A'),
(33, 'lets play badminton tomorrow', 'prash1987@gmail.com', '2017-10-13 20:09:16', 'Bloomington', '2017-10-14 17:00:00', 'DSC00147 - Copy.JPG', 0, 'Badminton', 'M'),
(34, 'lets play cricket today', 'prash1987@gmail.com', '2017-10-14 21:52:26', 'Bloomington', '2017-10-14 20:00:00', 'IMG_20160820_185550137.jpg', 0, 'Cricket', 'A'),
(35, 'lets play cricket today', 'prash1987@gmail.com', '2017-10-14 21:54:36', 'Bloomington', '2017-10-14 20:00:00', 'IMG_20160820_185550137.jpg', 0, 'Cricket', 'A'),
(36, 'lets play badminton', 'prash1987@gmail.com', '2017-10-14 22:02:57', 'Bloomington', '2017-10-14 20:00:00', 'IMG_20160820_185550137.jpg', 0, 'Badminton', 'A'),
(37, 'lets play badminton', 'prash1987@gmail.com', '2017-10-14 22:05:41', 'Bloomington', '2017-10-14 20:00:00', 'IMG_20160820_185550137.jpg', 0, 'Badminton', 'A'),
(38, 'lets play tennis please ', 'prash1987@gmail.com', '2017-10-14 22:08:49', 'Bloomington', '2017-10-15 16:00:00', 'IMG_20160820_185550137.jpg', 0, 'Tennis', 'A'),
(39, 'lets play squash', 'prash1987@gmail.com', '2017-10-14 22:22:19', 'Bloomington', '2017-10-20 17:00:00', 'IMG_20160820_185550137.jpg', 0, 'Squash', 'A'),
(40, 'lets play basketball', 'prash1987@gmail.com', '2017-10-14 22:27:06', 'Bloomington', '2017-10-21 18:00:00', 'IMG_20160820_185550137.jpg', 0, 'Basketball', 'A');

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
  `sec_ans2` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `address`, `email`, `contact`, `dob`, `userbio`, `sec_q1`, `sec_ans1`, `sec_q2`, `sec_ans2`) VALUES
('prash1987@gmail.com', 'Prashanth', 'Bhat', 'Bloomington', 'prash1987@gmail.com', '309660', '1987-09-05', 'Cricket,Badminton,Squash', 'what is your nick name?', 'prash', 'what is your mothers maiden name', 'leela'),
('pradeep@gmail.com', 'Pradeep', 'Bhat', 'Bloomington', 'pradeep@gmail.com', '1234567890', '1992-10-10', 'Football,Cricketl', 'what is your nick name?', 'prash', 'what is your mothers maiden name', 'leela'),
('prakash@gmail.com', 'Prakash', 'Bhat', 'Bloomington', 'prakash@gmail.com', '9987654321', '1960-10-03', 'Football,Squash', 'what is your nick name?', 'prash', 'what is your mothers maiden name', 'leela'),
('prbhat@indiana.edu', 'new', 'guy', 'bloomington', 'prbhat@indiana.edu', '3333333333', '2017-10-10', 'Cricket', 'what is your nick name?', 'prash', 'what is your mothers maiden name', 'leela'),
('prash.kumta@gmail.com', 'Prash', 'Kumta', 'Bloomington', 'prash.kumta@gmail.com', '1234567890', '1988-10-14', 'Badminton,Swimming', 'what is your nick name?', 'prash', 'what is your mothers maiden name', 'leela'),
('jaidevyd@gmail.com', 'Jaidev', 'Dinesh', 'Bloomington', 'jaidevyd@gmail.com', '1231231234', '1990-10-10', 'Football,Cricket,Badminton,Tennis', 'what is your nick name?', 'JD', 'which is your native?', 'mangalore');

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
  ADD KEY `User_id` (`User_id`);

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
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
