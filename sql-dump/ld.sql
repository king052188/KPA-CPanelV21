CREATE DATABASE  IF NOT EXISTS `laradnet_v1` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `laradnet_v1`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: laradnet_v1
-- ------------------------------------------------------
-- Server version	5.7.17-log

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
-- Table structure for table `token_table`
--

DROP TABLE IF EXISTS `token_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `token_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `app_id` varchar(60) DEFAULT NULL,
  `app_role` tinyint(4) DEFAULT NULL,
  `app_token` varchar(60) DEFAULT NULL,
  `app_name` varchar(60) DEFAULT NULL,
  `app_status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `token_table`
--

LOCK TABLES `token_table` WRITE;
/*!40000 ALTER TABLE `token_table` DISABLE KEYS */;
INSERT INTO `token_table` VALUES (99,'1',1,'90620049-1c70-4d6e-8c82-f40959d67884','KPACPanelV21',2,'2017-04-30 11:21:14','2017-04-30 09:37:04'),(101,'1',1,'e12cd09a-ad77-49f0-b367-175f509ffa5c','KPACPanelV21',2,'2017-04-30 11:27:39','2017-04-30 11:24:38'),(102,'1',1,'23db6bff-49b3-4467-816b-b7ef94623e03','KPACPanelV21',2,'2017-04-30 12:04:00','2017-04-30 11:30:39'),(103,'1',1,'207361ed-96b7-42bd-aeb3-5a54bfdd3040','KPACPanelV21',2,'2017-04-30 12:10:57','2017-04-30 12:10:57'),(104,'1',1,'c1f8adb5-22f3-41f8-88de-b6e4e79a2c92','KPACPanelV21',2,'2017-04-30 12:14:40','2017-04-30 12:14:40'),(105,'1',1,'11494366-7d19-4053-84c4-4d4ac0c4c9c0','KPACPanelV21',2,'2017-04-30 12:24:15','2017-04-30 12:18:05'),(106,'1',1,'14b080cf-db52-4cd0-ad8b-05b722782d43','KPACPanelV21',1,'2017-04-30 14:04:15','2017-04-30 12:27:22');
/*!40000 ALTER TABLE `token_table` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-30 14:07:28
