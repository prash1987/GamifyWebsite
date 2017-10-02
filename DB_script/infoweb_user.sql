-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: infoweb
-- ------------------------------------------------------
-- Server version	5.7.14

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
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('prash1987@gmail.com','Prashanth','Bhat','561 W Amaryllis Dr','prash1987@gmail.com',309660,'1987-09-05','nothing','what is your nick name?','prash','what is your mothers maiden name','leela'),('pradeep@gmail.com','Pradeep','Bhat','Bloomington','pradeep@gmail.com',1234567890,'1992-10-10','Football, volleyball, cricket, pool','what is your nick name?','prash','what is your mothers maiden name','leela'),('prakash@gmail.com','Prakash','Bhat','Bloomington','prakash@gmail.com',9987654321,'1960-10-03','hockey, soccer, squash','what is your nick name?','prash','what is your mothers maiden name','leela'),('prbhat@indiana.edu','new','guy','bloomington','prbhat@indiana.edu',3333333333,'2017-10-10','cricket','what is your nick name?','prash','what is your mothers maiden name','leela'),('prash.kumta@gmail.com','Prash','Kumta','Bloomington','prash.kumta@gmail.com',1234567890,'1988-10-14','badminton, swimming','what is your nick name?','prash','what is your mothers maiden name','leela');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-01 23:52:59
