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
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login` (
  `User_id` varchar(128) NOT NULL,
  `Password` varchar(128) DEFAULT NULL,
  `salt` varchar(128) DEFAULT NULL,
  `email_id` varchar(128) DEFAULT NULL,
  `otp` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`User_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES ('prash1987@gmail.com','a613599774f20b625ea6c96ae35254e670df7a16456a61dfcf2cb554f54b9b5573b75e02c524e4a1dd2e55a486bf136a381470e76797df28a78ffb20d5789716','35475db5c3e0e68b24fcfc59b471338bae01df5c67d96e965de45eb3350fe618a35d62bb2f72549cb33478e00901a9bfc73595309c8efc46ed0a9b6028b713e8','prash1987@gmail.com','707131'),('pradeep@gmail.com','c59b7b70b5fa2276dea0475c942c89283904ad304733898e583565a9a7bd2d4077497316d60dfc9bdb7d59282d9888f82d495a14f3bd1b67d0fc9c2c32123c40','2eebe77c38573d9be763a0fa58af132ed019a0c8718bc00e3b65033007698ed32e2da2301afbf8ee5c605e74df40b15ca3f35012c7160a831ba3895e191af4fb','pradeep@gmail.com',''),('prakash@gmail.com','f6e6566b55dd85ee1ff2c1fd4197e0505ff44bc2514bc05eab7f93041528d550dc21523b6cbd62a5045b31cb1e213efc387f4952889ab2c56154836e7741258d','3c680ef4dbf476e1547883b84dd44dc81497523c11e87dbb9f39e59496b21c83697a2cd09d0cf3929be220dbc932e9bd14804c2e45805e245fd99082dee405c4','prakash@gmail.com','384545'),('prbhat@indiana.edu','85c4e758fb2351bc929a58ca24c23a1d8590f131d8edebb3b187da277241e0156b4d04abea85aa3ce17cc50ac311a93cbd778c2a250bca6c0f2dd22883486471','85b1bd02cdf40cd17e13c22634f02bcf34912d4a62e21416bf870595f9c61334dd40d14b549a0be816b88c0db7b1563c83007140a4cb8f8f1c76c2c25b9f2b61','prbhat@indiana.edu','680764'),('prash.kumta@gmail.com','c278890e9551c6923fcb28606da350d3ad203c65631eb65200d73313389c03eebeb7c9a0f22d1cda71cec23343672d4b035474b898f0a23798ba76e04de9fd8c','e7b8602f12984a6e56367aad76a700cc787207ad040c23566e82d197648c32657fd943230d89f05237fac0520eaedd21eeb4d471e67f02acfc01f1fa28ac4c8f','prash.kumta@gmail.com',''),('vsriniv@iu.edu','9aa792be0ef6d3f8c7fd753fbef99222181f417444fdcfca1534f4c5e2c53c7d039fbc6e22b29fb0d8fad961aa953765de242c5aef720d4ffe10c7dea5ba8ff9','07808f6e7f8167416e76d2022766aaf5eb280fe2daf755cefad5cc90fd4993f24b20a1b740e4379f78f17121e4e79df9de6fd6c27986876eab5128a47d2abb9e','vsriniv@iu.edu','694759'),('sagar.panchal11@gmail.com','6f1d1a34b1d0a5b33a16f21f8e588e1efba9641338e4b25ab83f5c3f0b35cf215152c97edead203abcaa63d22831296faec725b8fd1c2e872343c6f8badd32d0','67f752d3e791512c179aa63091f4731124dce6642e9c624a3ddef8fb0cfaff9ab383574a16c1b025c8956aededcbd378fba1beef885708f03dfecf0cfdea6f98','sagar.panchal11@gmail.com','989641'),('patilmeghesh91@gmail.com','77875deb20311f14662136da0a4ac9e8e97e45a1d2b443884e89c6e8c179954384b4f24fcba59366dd92d8384fa95e77b7f84ee6ccd2547bba1e83f2af367ef6','c8a7d8c6abc12c6c71333a95c69bcad58284f692d1a8025b7759eef24c11d4771a7f8aa1fe897eaa06533010d182ca62cdf771d9dd36654f9786c30ae491594e','patilmeghesh91@gmail.com','892557'),('test@gmail.com','1c0b67d226b1d644c72717f1f0367e1c98d29cb75b4273c8f4a875c0e87e8dba40a89532746e5b760063afb34c32575ac3eacf45c46fb8923856353a81fdaf6e','543c1ccd7856c641540d16a151ddcd5ba51efb175d3f009fbba0b44a0d868d36d19174315f3538b19aaf87215eaf760cd8aab2a73d1fce8160cd5a5ff79e4cec','test@gmail.com','343370');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
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
