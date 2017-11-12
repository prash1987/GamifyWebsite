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
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,'vsriniv@iu.edu','sagar.panchal11@gmail.com','Hi wassupp,','2017-10-28 01:07:43',0,0,0),(2,'vsriniv@iu.edu','sagar.panchal11@gmail.com','heya','2017-10-28 01:09:01',0,0,0),(3,'vsriniv@iu.edu','sagar.panchal11@gmail.com','dasdasdasd','2017-10-28 01:09:05',0,0,0),(4,'vsriniv@iu.edu','sagar.panchal11@gmail.com','csdkcmaocm','2017-10-28 01:09:13',0,0,0),(5,'sagar.panchal11@gmail.com','vsriniv@iu.edu','Hi ','2017-10-28 01:29:17',0,0,0),(6,'sagar.panchal11@gmail.com','vsriniv@iu.edu','wassupp','2017-10-28 01:29:29',0,0,0),(7,'sagar.panchal11@gmail.com','vsriniv@iu.edu','completed sprint #3?','2017-10-28 01:29:41',0,0,0),(11,'vsriniv@iu.edu','sagar.panchal11@gmail.com','wassupp','2017-10-28 19:22:55',0,0,0),(12,'vsriniv@iu.edu','sagar.panchal11@gmail.com','su karo cho','2017-10-28 19:23:09',0,0,0),(13,'vsriniv@iu.edu','sagar.panchal11@gmail.com','majama ne','2017-10-28 19:23:15',0,0,0),(14,'vsriniv@iu.edu','sagar.panchal11@gmail.com','majama ne','2017-10-28 19:25:15',0,0,0),(15,'vsriniv@iu.edu','sagar.panchal11@gmail.com','majama ne','2017-10-28 19:25:18',0,0,0),(16,'vsriniv@iu.edu','sagar.panchal11@gmail.com','majama ne','2017-10-28 19:30:08',0,0,0),(17,'vsriniv@iu.edu','sagar.panchal11@gmail.com','dssdf','2017-10-28 19:30:12',0,0,0),(18,'vsriniv@iu.edu','sagar.panchal11@gmail.com','abdasbd','2017-10-28 19:30:19',0,0,0),(19,'vsriniv@iu.edu','sagar.panchal11@gmail.com','abdasbd','2017-10-28 19:30:37',0,0,0),(20,'vsriniv@iu.edu','sagar.panchal11@gmail.com','abdasbd','2017-10-28 19:32:59',0,0,0),(21,'vsriniv@iu.edu','sagar.panchal11@gmail.com','abdasbd','2017-10-28 19:33:03',0,0,0),(22,'vsriniv@iu.edu','sagar.panchal11@gmail.com','abdasbd','2017-10-28 19:33:13',0,0,0),(23,'vsriniv@iu.edu','sagar.panchal11@gmail.com','abdasbd','2017-10-28 19:34:32',0,0,0),(24,'vsriniv@iu.edu','sagar.panchal11@gmail.com','abdasbd','2017-10-28 20:01:47',0,0,0),(25,'vsriniv@iu.edu','sagar.panchal11@gmail.com','abdasbd','2017-10-28 20:02:11',0,0,0),(26,'vsriniv@iu.edu','sagar.panchal11@gmail.com','abdasbd','2017-10-28 20:02:16',0,0,0),(27,'patilmeghesh91@gmail.com','vsriniv@iu.edu','Heya, wassupp','2017-10-28 22:49:20',0,0,0),(28,'sagar.panchal11@gmail.com','vsriniv@iu.edu','waddupp','2017-10-28 22:52:26',0,0,0),(29,'sagar.panchal11@gmail.com','vsriniv@iu.edu','waddupp','2017-10-28 22:52:55',0,0,0),(30,'sagar.panchal11@gmail.com','vsriniv@iu.edu','waddupp','2017-10-28 22:53:29',0,0,0),(31,'sagar.panchal11@gmail.com','vsriniv@iu.edu','waddupp','2017-10-28 22:53:42',0,0,0),(32,'sagar.panchal11@gmail.com','vsriniv@iu.edu','waddupp','2017-10-28 22:53:53',0,0,0),(33,'sagar.panchal11@gmail.com','vsriniv@iu.edu','waddupp','2017-10-28 22:54:03',0,0,0),(34,'prash1987@gmail.com','sagar.panchal11@gmail.com','hey wassuppp?','2017-10-29 19:10:17',0,0,0),(35,'prash1987@gmail.com','sagar.panchal11@gmail.com','hey wassuppp?','2017-10-29 19:10:47',0,0,0),(36,'sagar.panchal11@gmail.com','prash1987@gmail.com','hi\r\n','2017-11-01 16:25:16',0,0,0),(37,'sagar.panchal11@gmail.com','prash1987@gmail.com','testing 1st november\r\n','2017-11-01 16:25:43',0,0,0),(38,'prash1987@gmail.com','sagar.panchal11@gmail.com','hi','2017-11-01 16:26:11',0,0,0),(39,'sagar.panchal11@gmail.com','prash1987@gmail.com','testing 1st november\r\n','2017-11-01 16:26:20',0,0,0),(40,'sagar.panchal11@gmail.com','prash1987@gmail.com','testing 1st november\r\n','2017-11-01 16:26:28',0,0,0),(41,'sagar.panchal11@gmail.com','prash1987@gmail.com','testing ok\r\n','2017-11-01 16:26:42',0,0,0),(42,'prash1987@gmail.com','patilmeghesh91@gmail.com','Hi this is a test','2017-11-07 20:23:24',0,0,0),(47,'sagar.panchal11@gmail.com','patilmeghesh91@gmail.com','HI','2017-11-10 10:20:36',0,0,0),(48,'sagar.panchal11@gmail.com','patilmeghesh91@gmail.com','hello\r\n','2017-11-10 15:05:16',0,0,0),(49,'prash1987@gmail.com','patilmeghesh91@gmail.com','hello test','2017-11-10 15:06:08',0,0,0),(50,'prash1987@gmail.com','patilmeghesh91@gmail.com','hi\r\n','2017-11-10 15:08:59',0,0,0),(51,'patilmeghesh91@gmail.com','prash1987@gmail.com','how are u','2017-11-10 15:09:20',0,0,0),(52,'prash1987@gmail.com','patilmeghesh91@gmail.com','i am good','2017-11-10 15:09:56',0,0,0),(53,'patilmeghesh91@gmail.com','prash1987@gmail.com','where are you?','2017-11-11 22:52:25',0,0,0),(69,'patilmeghesh91@gmail.com','prash1987@gmail.com','are you there?','2017-11-11 23:51:36',0,0,0),(70,'patilmeghesh91@gmail.com','prash1987@gmail.com','are you there?','2017-11-11 23:52:51',0,0,0);
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
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
