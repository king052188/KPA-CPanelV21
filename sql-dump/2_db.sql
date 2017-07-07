CREATE DATABASE  IF NOT EXISTS `kpa_cpanelv21` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `kpa_cpanelv21`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: kpa_cpanelv21
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
  `path` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ftp_account_table`
--

LOCK TABLES `ftp_account_table` WRITE;
/*!40000 ALTER TABLE `ftp_account_table` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_table`
--

LOCK TABLES `member_table` WRITE;
/*!40000 ALTER TABLE `member_table` DISABLE KEYS */;
INSERT INTO `member_table` VALUES (1,3,'cb3edcdc9f2ef43883521f23c80098a3','kingpaulo.1','b25526a48931746448b72e11aad21ae4','King Paulo','Cabalo','Aquino','1988-05-21 00:00:00',1,'king@cdgpacific.com','09177715380',NULL,NULL,NULL,3,'2017-04-19 06:06:21','2017-04-19 03:28:29');
/*!40000 ALTER TABLE `member_table` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mysql_account_table`
--

LOCK TABLES `mysql_account_table` WRITE;
/*!40000 ALTER TABLE `mysql_account_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `mysql_account_table` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mysql_database_table`
--

LOCK TABLES `mysql_database_table` WRITE;
/*!40000 ALTER TABLE `mysql_database_table` DISABLE KEYS */;
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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-19 22:46:43
