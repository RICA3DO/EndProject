-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: end_project_ricardo
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `availability` varchar(255) NOT NULL,
  `description` varchar(355) NOT NULL,
  `price` varchar(25) NOT NULL,
  `date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,'HTML','html.png','available','HTML, in full hypertext markup language, a formatting system for displaying material retrieved over the Internet. Each retrieval unit is known as a Web page (from World Wide Web), and such pages frequently contain hypertext links that allow related pages to be retrieved.\r\n','150€','10.02.2022.-11.02.2022.'),(3,'CSS','css.png','available','What is CSS? CSS is the language for describing the presentation of Web pages, including colors, layout, and fonts. It allows one to adapt the presentation to different types of devices, such as large screens, small screens, or printers. CSS is independent of HTML and can be used with any XML-based markup language.\r\n','150€','20.03.2022.-21.03.2022.'),(4,'Javascript','javascript.png','available','JavaScript is a dynamic computer programming language. It is lightweight and most commonly used as a part of web pages, whose implementations allow client-side script to interact with the user and make dynamic pages. It is an interpreted programming language with object-oriented capabilities.','450€','10.01.2023.-13.01.2023.'),(5,'Python','python.png','available','Python is an interpreted, object-oriented, high-level programming language with dynamic semantics developed by Guido van Rossum. It was originally released in 1991. Designed to be easy as well as fun, the name ','450€','25.06.2022.-28.06.2022.');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses_joined`
--

DROP TABLE IF EXISTS `courses_joined`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses_joined` (
  `courses_joinedID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fk_userID` int(11) NOT NULL,
  `fk_course_id` int(11) NOT NULL,
  PRIMARY KEY (`courses_joinedID`),
  KEY `fk_userID` (`fk_userID`),
  KEY `fk_petID` (`fk_course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses_joined`
--

LOCK TABLES `courses_joined` WRITE;
/*!40000 ALTER TABLE `courses_joined` DISABLE KEYS */;
INSERT INTO `courses_joined` VALUES (1,1,1),(2,1,1),(3,1,1),(4,1,4),(5,1,5),(6,3,4),(7,3,3),(8,4,1),(9,4,3),(10,4,4),(11,5,5),(12,5,1),(13,6,1),(14,6,3),(15,6,4),(16,6,5);
/*!40000 ALTER TABLE `courses_joined` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses_joined_by_user`
--

DROP TABLE IF EXISTS `courses_joined_by_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses_joined_by_user` (
  `courses_joinedID` int(10) unsigned NOT NULL DEFAULT 0,
  `course_id` int(11) DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `userID` int(11) NOT NULL DEFAULT 0,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses_joined_by_user`
--

LOCK TABLES `courses_joined_by_user` WRITE;
/*!40000 ALTER TABLE `courses_joined_by_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `courses_joined_by_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'adm','adm','a@adm.com',12312412,'adm12','user.png','c415e920e0281339d3633ab0c19d3b11c5a70a52ad2e17e405ef66723c51294c','adm'),(4,'Peter','Parker','p@parker.com',123356434,'ppark12','626f3bdca24c2.jpg','20e09e434912381a1c6b13d77536d6786742fc5a11639eba8faae8fada86bfd7','user'),(5,'Mary','Jane','m@jane.com',91383872,'jane423','user.png','bf7b011ba496d91329581dda5089cf041768286116f373f32ff4ab878ea360e1','user'),(6,'Ricardo','Madarasz','m@mada.com',48384727,'mada293','626f3cbb6f003.jpg','03b0d6a0f429734bc8b96b0fdcd4423638b4e25e26e6a1ef05a6913952d9f652','user');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-02 15:02:53
