CREATE DATABASE  IF NOT EXISTS `kpa_cpanelv21` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `kpa_cpanelv21`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: kpa_cpanelv21
-- ------------------------------------------------------
-- Server version	5.7.18-log

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
-- Table structure for table `disk_table`
--

DROP TABLE IF EXISTS `disk_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `disk_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `quota` decimal(18,4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disk_table`
--

LOCK TABLES `disk_table` WRITE;
/*!40000 ALTER TABLE `disk_table` DISABLE KEYS */;
INSERT INTO `disk_table` VALUES (1,7,15.0000,2,'2017-04-30 12:45:56','2017-04-30 12:45:56'),(2,8,10.0000,2,'2017-05-01 01:35:36','2017-05-01 01:35:36'),(3,8,1.0000,NULL,'2017-05-03 13:12:13','2017-05-03 13:12:13'),(4,8,1.0000,NULL,'2017-05-03 13:12:26','2017-05-03 13:12:26'),(5,8,1.0000,NULL,'2017-05-03 13:17:28','2017-05-03 13:17:28'),(6,8,1.0000,NULL,'2017-05-03 13:22:40','2017-05-03 13:22:40');
/*!40000 ALTER TABLE `disk_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ftp_account_table`
--

DROP TABLE IF EXISTS `ftp_account_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ftp_account_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `path` varchar(200) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ftp_account_table`
--

LOCK TABLES `ftp_account_table` WRITE;
/*!40000 ALTER TABLE `ftp_account_table` DISABLE KEYS */;
INSERT INTO `ftp_account_table` VALUES (1,7,'kpa123','111111','\\\\kingpaulo.7\\\\cpanelV21.kpa21.com\\\\public',2,'2017-04-30 13:15:16','2017-04-30 13:15:16'),(2,7,'kpa111','111111','\\\\kingpaulo.7\\\\my_ftp_folder\\\\',2,'2017-04-30 13:17:34','2017-04-30 13:17:34'),(3,2,'kayra201620','111111','\\\\king.8\\\\fbase.com\\\\',2,'2017-05-01 01:42:48','2017-05-01 01:42:48'),(4,2,'ronald','111111','\\\\king.8\\\\ronald.com\\\\public',2,'2017-05-03 10:20:46','2017-05-03 10:20:46'),(5,8,'king.8','550319210','/king.8/king.8/',2,'2017-05-03 13:22:41','2017-05-03 13:22:41');
/*!40000 ALTER TABLE `ftp_account_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member_basic_table`
--

DROP TABLE IF EXISTS `member_basic_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member_basic_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `streets` varchar(300) DEFAULT NULL,
  `barangay` varchar(80) DEFAULT NULL,
  `city` varchar(60) DEFAULT NULL,
  `province` varchar(60) DEFAULT NULL,
  `zip_code` varchar(10) DEFAULT NULL,
  `telephone` varchar(30) DEFAULT NULL,
  `mobile` varchar(30) DEFAULT NULL,
  `education_attainment` tinyint(4) DEFAULT NULL,
  `profession` varchar(200) DEFAULT NULL,
  `skills` varchar(200) DEFAULT NULL,
  `citizenship` varchar(20) DEFAULT NULL,
  `blood_type` varchar(10) DEFAULT NULL,
  `civil_status` tinyint(4) DEFAULT NULL,
  `sss_no` varchar(20) DEFAULT NULL,
  `tin_no` varchar(20) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_basic_table`
--

LOCK TABLES `member_basic_table` WRITE;
/*!40000 ALTER TABLE `member_basic_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `member_basic_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member_beneficiary_table`
--

DROP TABLE IF EXISTS `member_beneficiary_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member_beneficiary_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `name_of_beneficiary` varchar(200) DEFAULT NULL,
  `same_with_primary` tinyint(4) DEFAULT NULL,
  `streets` varchar(300) DEFAULT NULL,
  `barangay` varchar(80) DEFAULT NULL,
  `city` varchar(60) DEFAULT NULL,
  `province` varchar(60) DEFAULT NULL,
  `zip_code` varchar(10) DEFAULT NULL,
  `telephone` varchar(30) DEFAULT NULL,
  `mobile` varchar(30) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_beneficiary_table`
--

LOCK TABLES `member_beneficiary_table` WRITE;
/*!40000 ALTER TABLE `member_beneficiary_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `member_beneficiary_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member_table`
--

DROP TABLE IF EXISTS `member_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `role` tinyint(4) DEFAULT NULL,
  `group_name` varchar(40) DEFAULT NULL,
  `hash_code` varchar(60) DEFAULT NULL,
  `username` varchar(40) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `middle_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `birth_date` datetime DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `endorse_uid` int(11) DEFAULT NULL,
  `specialist_uid` int(11) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_table`
--

LOCK TABLES `member_table` WRITE;
/*!40000 ALTER TABLE `member_table` DISABLE KEYS */;
INSERT INTO `member_table` VALUES (7,3,'ckt','292e68deec3f5b0a646e02c4e85c4d0c','kingpaulo.7','c95ab01b6906c2acb760fc85196f968e','King Paulo','Cabalo','Aquino','2016-07-14 00:00:00',1,'king@cdgpacific.com','09177715380',NULL,NULL,NULL,3,'2017-04-30 11:21:09','2017-04-26 06:20:15'),(8,1,'kpa','b67d801dce6f111471e925ef6b9c3924','king.8','182d3db361e15ef93f0b4e2c8178f838','king','paulo','aquino','2017-04-12 00:00:00',1,'kingpauloaquino@gmail.com','09474746282',NULL,NULL,NULL,3,'2017-05-03 15:11:12','2017-04-26 06:49:30'),(9,1,NULL,'bed9c516174c50550914dadfd8a48cdb','paopao.9','bd8dbf00053528869d4bbe534f62d2cc','Paopao','Cabalo','Aquino',NULL,1,'ptxt4wrd@gmail.com','09177715381',NULL,NULL,NULL,2,'2017-04-26 08:39:01','2017-04-26 08:39:01');
/*!40000 ALTER TABLE `member_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mysql_account_privileges_table`
--

DROP TABLE IF EXISTS `mysql_account_privileges_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mysql_account_privileges_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `role` tinyint(4) DEFAULT NULL,
  `account_name` varchar(50) DEFAULT NULL,
  `database_name` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mysql_account_privileges_table`
--

LOCK TABLES `mysql_account_privileges_table` WRITE;
/*!40000 ALTER TABLE `mysql_account_privileges_table` DISABLE KEYS */;
INSERT INTO `mysql_account_privileges_table` VALUES (1,7,2,'mjt','ckt7_paopao_db',2,'2017-04-26 06:40:04','2017-04-26 06:40:04');
/*!40000 ALTER TABLE `mysql_account_privileges_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mysql_account_table`
--

DROP TABLE IF EXISTS `mysql_account_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mysql_account_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `role` tinyint(4) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mysql_account_table`
--

LOCK TABLES `mysql_account_table` WRITE;
/*!40000 ALTER TABLE `mysql_account_table` DISABLE KEYS */;
INSERT INTO `mysql_account_table` VALUES (13,7,2,'paopao','111111',2,'2017-04-26 06:38:09','2017-04-26 06:38:09'),(14,8,2,'mjt','111111',2,'2017-04-26 06:39:34','2017-04-26 06:39:34'),(15,8,2,'kayra2016','111111',2,'2017-05-01 01:40:31','2017-05-01 01:40:31');
/*!40000 ALTER TABLE `mysql_account_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mysql_database_shared_table`
--

DROP TABLE IF EXISTS `mysql_database_shared_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mysql_database_shared_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_uid` int(11) DEFAULT NULL,
  `shared_uid` int(11) DEFAULT NULL,
  `role` tinyint(4) DEFAULT NULL,
  `account_name` varchar(50) DEFAULT NULL,
  `database_name` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mysql_database_shared_table`
--

LOCK TABLES `mysql_database_shared_table` WRITE;
/*!40000 ALTER TABLE `mysql_database_shared_table` DISABLE KEYS */;
INSERT INTO `mysql_database_shared_table` VALUES (3,7,7,2,'paopao','ckt7_paopao_db',2,'2017-04-27 08:47:29','2017-04-27 08:47:29'),(5,7,8,2,'mjt','ckt7_paopao_db',2,'2017-04-27 09:29:42','2017-04-27 09:29:42');
/*!40000 ALTER TABLE `mysql_database_shared_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mysql_database_table`
--

DROP TABLE IF EXISTS `mysql_database_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mysql_database_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `account_name` varchar(50) DEFAULT NULL,
  `database_name` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mysql_database_table`
--

LOCK TABLES `mysql_database_table` WRITE;
/*!40000 ALTER TABLE `mysql_database_table` DISABLE KEYS */;
INSERT INTO `mysql_database_table` VALUES (20,7,'paopao','ckt7_paopao_db',2,'2017-04-26 06:38:37','2017-04-26 06:38:37'),(21,8,'kayra2016','kpa8_fbase',2,'2017-05-01 01:41:03','2017-05-01 01:41:03');
/*!40000 ALTER TABLE `mysql_database_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_table`
--

DROP TABLE IF EXISTS `payment_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `mode_of_payment` tinyint(4) DEFAULT NULL,
  `amount` decimal(18,4) DEFAULT NULL,
  `proof_of_payment_url` varchar(300) DEFAULT NULL,
  `id_picture_url` varchar(300) DEFAULT NULL,
  `signature_url` varchar(300) DEFAULT NULL,
  `valid_id_url` varchar(300) DEFAULT NULL,
  `confirming_a` tinyint(4) DEFAULT NULL,
  `confirming_b` tinyint(4) DEFAULT NULL,
  `confirming_c` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_table`
--

LOCK TABLES `payment_table` WRITE;
/*!40000 ALTER TABLE `payment_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quota_reference_table`
--

DROP TABLE IF EXISTS `quota_reference_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quota_reference_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `code_name` varchar(50) DEFAULT NULL,
  `code_description` varchar(200) DEFAULT NULL,
  `disk` decimal(18,4) DEFAULT NULL,
  `web` tinyint(4) DEFAULT NULL,
  `mysql` tinyint(4) DEFAULT NULL,
  `ftp` tinyint(4) DEFAULT NULL,
  `hostname` tinyint(4) DEFAULT NULL,
  `port` tinyint(4) DEFAULT NULL,
  `price_usd` decimal(18,4) DEFAULT NULL,
  `price_ph` decimal(18,4) DEFAULT NULL,
  `discount` decimal(18,4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quota_reference_table`
--

LOCK TABLES `quota_reference_table` WRITE;
/*!40000 ALTER TABLE `quota_reference_table` DISABLE KEYS */;
INSERT INTO `quota_reference_table` VALUES (1,'Free','',1.0000,1,1,1,1,0,0.0000,51.0000,0.0000,3,'2017-05-01 00:00:00','2017-05-01 01:35:36'),(2,'Starter',NULL,10.0000,2,2,5,1,2,7.9900,51.0000,0.1000,2,'2017-05-01 00:00:00','2017-05-01 00:00:00'),(3,'Basic',NULL,10.0000,1,1,1,1,10,3.9900,249.9900,NULL,1,'2017-05-01 00:00:00','2017-05-01 00:00:00'),(4,'Business',NULL,20.0000,3,3,5,2,3,11.9900,51.0000,0.1000,4,'2017-05-01 00:00:00','2017-05-01 00:00:00'),(5,'Deluxe',NULL,20.0000,3,3,5,1,30,7.9900,399.9900,NULL,1,'2017-05-01 00:00:00','2017-05-01 00:00:00'),(6,'Ultimate',NULL,30.0000,5,5,10,3,5,14.9900,51.0000,0.1200,2,'2017-05-01 00:00:00','2017-05-01 00:00:00');
/*!40000 ALTER TABLE `quota_reference_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quota_table`
--

DROP TABLE IF EXISTS `quota_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quota_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `quota_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quota_table`
--

LOCK TABLES `quota_table` WRITE;
/*!40000 ALTER TABLE `quota_table` DISABLE KEYS */;
INSERT INTO `quota_table` VALUES (8,1,8,NULL,'2017-05-03 13:22:41','2017-05-03 13:22:41');
/*!40000 ALTER TABLE `quota_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_table`
--

DROP TABLE IF EXISTS `web_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `root_path` text,
  `site_name` varchar(200) DEFAULT NULL,
  `binding_type` tinyint(4) DEFAULT NULL,
  `binding_ip` varchar(15) DEFAULT NULL,
  `binding_port` mediumint(9) DEFAULT NULL,
  `binding_hostname` varchar(200) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_table`
--

LOCK TABLES `web_table` WRITE;
/*!40000 ALTER TABLE `web_table` DISABLE KEYS */;
INSERT INTO `web_table` VALUES (1,7,'\\kingpaulo.7','cpanelV21.kpa21.com',1,'127.0.0.1',80,'cpanelV21.kpa21.com',2,NULL,NULL),(2,8,'/king.8/121.cpv21-host.ddns.net/wwwroot/public','121.cpv21-host.ddns.net',1,'127.0.0.1',80,'121.cpv21-host.ddns.net',2,'2017-05-03 14:48:04','2017-05-03 14:48:04');
/*!40000 ALTER TABLE `web_table` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-03 23:53:07
