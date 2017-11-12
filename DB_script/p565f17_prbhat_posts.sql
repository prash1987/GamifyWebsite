-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: db.soic.indiana.edu    Database: p565f17_prbhat
-- ------------------------------------------------------
-- Server version	5.5.56-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (0,'2nd post for Men only','sagar.panchal11@gmail.com','2017-10-13 16:01:22','Bloomington','2017-10-17 00:00:00','football.jpg',0,'FOOTBALL','F',0),(1,'My 1st post ever','sagar.panchal11@gmail.com','2017-10-13 15:56:58','Bloomington','2017-10-13 00:00:00','DSC00154.JPG',0,'CRICKET','M',1),(2,'My 1st post ever','sagar.panchal11@gmail.com','2017-10-13 15:58:39','Bloomington','2017-10-13 00:00:00','DSC00147 - Copy.JPG',0,'FOOTBALL','A',1),(3,'2nd post for Men only','sagar.panchal11@gmail.com','2017-10-13 15:59:42','Bloomington','2017-10-17 00:00:00','IMG_20160820_185550137.jpg',0,'DANCE','A',1),(4,'2nd post for Men only','sagar.panchal11@gmail.com','2017-10-13 16:00:08','Bloomington','2017-10-17 00:00:00','cricket.jpg',0,'CRICKET','M',0),(7,'Women only event','sagar.panchal11@gmail.com','2017-10-13 16:49:50','Bloomington','2017-10-24 21:00:00','basketball2.jpg',0,'GYM','F',0),(8,'Test of post with image','sagar.panchal11@gmail.com','2017-10-16 15:29:38','Bloomington','2017-11-25 10:00:00','cricket.jpg',1,'CRICKET','A',1),(9,'Meghesh\'s 1st post','patilmeghesh91@gmail.com','2017-10-16 19:24:06','Bloomington','2017-10-17 22:00:00','cricket.jpg',0,'CRICKET','A',0),(10,'Meghesh\'s 1st post','patilmeghesh91@gmail.com','2017-10-16 19:25:20','Bloomington','2017-10-17 22:00:00','basketball.jpg',0,'CRICKET','A',0),(11,'Meghesh\'s 1st post','patilmeghesh91@gmail.com','2017-10-16 19:26:32','Bloomington','2017-10-17 22:00:00','cricket.jpg',0,'CRICKET','A',0),(12,'Meghesh\'s 1st post','patilmeghesh91@gmail.com','2017-10-16 19:27:10','Bloomington','2017-10-17 22:00:00','soccer2.jpg',1,'CRICKET','A',0),(13,'Hi Vaishnavi','patilmeghesh91@gmail.com','2017-10-16 19:43:00','Bloomington','2017-10-03 17:00:00','football.jpg',0,'FOOTBALL','F',0),(14,'Hi Vaishnavi','patilmeghesh91@gmail.com','2017-10-16 19:49:44','Bloomington','2017-10-03 17:00:00','football2.jpg',0,'FOOTBALL','F',0),(15,'i gay\r\n','sagar.panchal11@gmail.com','2017-10-21 23:39:06','Bloomington','0000-00-00 00:00:00','cricket.jpg',0,'CRICKET','A',0),(16,'HIii','sagar.panchal11@gmail.com','2017-10-21 23:40:02','Bloomington','2017-01-30 12:59:00','soccer.jpg',0,'CRICKET','A',1),(17,'lets play cricket this weekend','prash1987@gmail.com','2017-11-01 16:22:16','Bloomington','2017-11-05 17:00:00','Volleyball.jpg',0,'CRICKET','A',0);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-11 18:57:01
