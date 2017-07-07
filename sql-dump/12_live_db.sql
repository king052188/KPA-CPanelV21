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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disk_table`
--

LOCK TABLES `disk_table` WRITE;
/*!40000 ALTER TABLE `disk_table` DISABLE KEYS */;
INSERT INTO `disk_table` VALUES (1,1,1.0000,NULL,'2017-05-19 00:25:25','2017-05-19 00:25:25'),(2,2,1.0000,NULL,'2017-05-19 00:27:37','2017-05-19 00:27:37'),(3,3,1.0000,NULL,'2017-05-19 00:39:41','2017-05-19 00:39:41');
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
INSERT INTO `ftp_account_table` VALUES (1,1,'kingpaulo.1','123456','/kingpaulo.1',2,'2017-05-19 00:25:26','2017-05-19 00:25:26'),(2,2,'kingpaulo.2','222316491','/kingpaulo.2',2,'2017-05-19 00:27:37','2017-05-19 00:27:37'),(3,3,'lester.3','302758195','/lester.3',2,'2017-05-19 00:39:41','2017-05-19 00:39:41'),(4,3,'paopao','111111','\\\\lester.3\\\\demo.lester.kpa21.com\\\\',2,'2017-05-19 10:22:06','2017-05-19 10:22:06'),(5,3,'march','111111','\\\\lester.3\\\\march.lesterdigital.com\\\\',2,'2017-05-19 10:27:26','2017-05-19 10:27:26');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_table`
--

LOCK TABLES `member_table` WRITE;
/*!40000 ALTER TABLE `member_table` DISABLE KEYS */;
INSERT INTO `member_table` VALUES (1,3,'kpa','292e68deec3f5b0a646e02c4e85c4d0c','kingpaulo.1','3e9e1868bb0ecdff876f11a6ae5388ba','King Paulo','Cabalo','Aquino','2016-07-14 00:00:00',1,'me@kpa21.info','09177715380',NULL,NULL,NULL,3,'2017-05-04 06:18:00','2017-04-26 06:20:15'),(2,1,'kpa','b67d801dce6f111471e925ef6b9c3924','kingpaulo.2','19f533b42cf943fc8f3aaa40162687ff','King Paulo','Cabalo','Aquino','2017-04-12 00:00:00',1,'kingpauloaquino@gmail.com','09474746282',NULL,NULL,NULL,3,'2017-05-19 00:26:48','2017-04-26 06:49:30'),(3,1,'mag','b67d801dce6f111471e925ef6b62433d','lester.3','19f533b42cf943fc8f3aaa40162687ff','Lester','Magazine','Digital',NULL,1,'magazine.lester@gmail.com','12042184295',NULL,NULL,NULL,3,'2017-05-19 00:44:02','2017-05-19 00:33:37');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mysql_account_privileges_table`
--

LOCK TABLES `mysql_account_privileges_table` WRITE;
/*!40000 ALTER TABLE `mysql_account_privileges_table` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mysql_account_table`
--

LOCK TABLES `mysql_account_table` WRITE;
/*!40000 ALTER TABLE `mysql_account_table` DISABLE KEYS */;
INSERT INTO `mysql_account_table` VALUES (1,3,2,'lester','MAG12mag',2,'2017-05-19 01:13:00','2017-05-19 01:13:00'),(2,3,2,'paopao','ABC12abc',2,'2017-05-19 10:19:26','2017-05-19 10:19:26'),(3,1,2,'sms_api','ABC12abc',2,'2017-05-22 08:00:00','2017-05-22 08:00:00');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mysql_database_shared_table`
--

LOCK TABLES `mysql_database_shared_table` WRITE;
/*!40000 ALTER TABLE `mysql_database_shared_table` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mysql_database_table`
--

LOCK TABLES `mysql_database_table` WRITE;
/*!40000 ALTER TABLE `mysql_database_table` DISABLE KEYS */;
INSERT INTO `mysql_database_table` VALUES (1,3,'lester','mag3_magazine_v1',2,'2017-05-19 01:16:25','2017-05-19 01:16:25'),(2,1,'sms_api','kpa1_smsdb',2,'2017-05-22 08:21:00','2017-05-22 08:21:00');
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
  `type` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quota_reference_table`
--

LOCK TABLES `quota_reference_table` WRITE;
/*!40000 ALTER TABLE `quota_reference_table` DISABLE KEYS */;
INSERT INTO `quota_reference_table` VALUES (1,'Free','',1.0000,1,1,1,1,0,0.0000,51.0000,0.0000,3,2,'2017-05-01 00:00:00','2017-05-01 01:35:36'),(2,'Personal',NULL,10.0000,2,2,5,1,2,2.9900,51.0000,0.1000,1,1,'2017-05-01 00:00:00','2017-05-01 00:00:00'),(3,'Basic',NULL,10.0000,1,1,1,1,10,2.9900,51.0000,0.1000,2,3,'2017-05-01 00:00:00','2017-05-01 00:00:00'),(4,'Business',NULL,20.0000,3,3,5,2,3,11.9900,51.0000,0.1000,4,3,'2017-05-01 00:00:00','2017-05-01 00:00:00'),(5,'Deluxe',NULL,20.0000,3,3,5,1,30,7.9900,399.9900,0.1000,1,1,'2017-05-01 00:00:00','2017-05-01 00:00:00'),(6,'Ultimate',NULL,30.0000,5,5,10,3,5,14.9900,51.0000,0.1200,2,3,'2017-05-01 00:00:00','2017-05-01 00:00:00'),(7,'Magazine.Lester',NULL,100.0000,10,10,10,0,10,0.0000,0.0000,0.0000,1,2,'2017-05-01 00:00:00','2017-05-01 00:00:00');
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
  `server_id` int(11) DEFAULT NULL,
  `quota_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quota_table`
--

LOCK TABLES `quota_table` WRITE;
/*!40000 ALTER TABLE `quota_table` DISABLE KEYS */;
INSERT INTO `quota_table` VALUES (1,2,1,1,2,'2017-05-19 00:25:26','2017-05-19 00:25:26'),(2,2,1,2,2,'2017-05-19 00:27:37','2017-05-19 00:27:37'),(3,2,7,3,2,'2017-05-19 00:39:41','2017-05-19 00:39:41');
/*!40000 ALTER TABLE `quota_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servers_table`
--

DROP TABLE IF EXISTS `servers_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servers_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `region` varchar(50) DEFAULT NULL,
  `country` varchar(500) DEFAULT NULL,
  `ip_host_address` varchar(60) DEFAULT NULL,
  `port_number` mediumint(9) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servers_table`
--

LOCK TABLES `servers_table` WRITE;
/*!40000 ALTER TABLE `servers_table` DISABLE KEYS */;
INSERT INTO `servers_table` VALUES (1,'Buffalo','New York','69.4.84.226',21001,2,'2017-05-17 01:21:30','2017-05-17 01:21:30'),(2,'Scottsdale','Arizona','107.180.69.59',21001,2,'2017-05-17 01:21:30','2017-05-17 01:21:30'),(3,'Olongapo','Zambales','123.456.789.123',21001,3,'2017-05-17 01:21:30','2017-05-17 01:21:30'),(4,'Subic','Zambales','122.53.53.53',21001,4,'2017-05-17 01:21:30','2017-05-17 01:21:30');
/*!40000 ALTER TABLE `servers_table` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_table`
--

LOCK TABLES `web_table` WRITE;
/*!40000 ALTER TABLE `web_table` DISABLE KEYS */;
INSERT INTO `web_table` VALUES (1,3,'/lester.3/web.lesterdigital.com/wwwroot/public','web.lesterdigital.com',1,'127.0.0.1',80,'web.lesterdigital.com',2,'2017-05-19 01:05:34','2017-05-19 01:05:34'),(2,3,'/lester.3/account.lesterdigital.com/wwwroot/public','account.lesterdigital.com',1,'127.0.0.1',80,'account.lesterdigital.com',2,'2017-05-19 01:10:47','2017-05-19 01:10:47'),(3,3,'/lester.3/api.lesterdigital.com/wwwroot/public','api.lesterdigital.com',1,'127.0.0.1',80,'api.lesterdigital.com',2,'2017-05-19 08:36:45','2017-05-19 08:36:45'),(4,3,'/lester.3/demo.lester.kpa21.com/wwwroot/public','demo.lester.kpa21.com',1,'127.0.0.1',80,'demo.lester.kpa21.com',2,'2017-05-19 10:13:00','2017-05-19 10:13:00'),(5,3,'/lester.3/march.lesterdigital.com/wwwroot/public','march.lesterdigital.com',1,'127.0.0.1',80,'march.lesterdigital.com',2,'2017-05-19 10:26:23','2017-05-19 10:26:23'),(6,1,'/kingpaulo.1/sms-api.lester.kpa21.com/wwwroot/public','sms-api.lester.kpa21.com',1,'127.0.0.1',80,'sms-api.lester.kpa21.com',2,'2017-05-22 07:47:23','2017-05-22 07:47:23');
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

-- Dump completed on 2017-05-22 20:09:56
