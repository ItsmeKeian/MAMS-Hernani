-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: mamshernani
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `aid_distribution`
--

DROP TABLE IF EXISTS `aid_distribution`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aid_distribution` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `beneficiary_id` int(11) DEFAULT NULL,
  `date_given` date DEFAULT NULL,
  `receiving_member` varchar(150) DEFAULT NULL,
  `emergency_disaster` varchar(150) DEFAULT NULL,
  `assistance` varchar(150) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `provider` varchar(150) DEFAULT NULL,
  `signature` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `beneficiary_id` (`beneficiary_id`),
  CONSTRAINT `aid_distribution_ibfk_1` FOREIGN KEY (`beneficiary_id`) REFERENCES `beneficiaries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aid_distribution`
--

LOCK TABLES `aid_distribution` WRITE;
/*!40000 ALTER TABLE `aid_distribution` DISABLE KEYS */;
/*!40000 ALTER TABLE `aid_distribution` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assistance_records`
--

DROP TABLE IF EXISTS `assistance_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assistance_records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `beneficiary_id` int(11) NOT NULL,
  `date_received` date DEFAULT NULL,
  `receiving_name` varchar(150) DEFAULT NULL,
  `disaster_type` varchar(150) DEFAULT NULL,
  `assistance_type` varchar(100) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `provider` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `beneficiary_id` (`beneficiary_id`),
  CONSTRAINT `assistance_records_ibfk_1` FOREIGN KEY (`beneficiary_id`) REFERENCES `beneficiaries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assistance_records`
--

LOCK TABLES `assistance_records` WRITE;
/*!40000 ALTER TABLE `assistance_records` DISABLE KEYS */;
INSERT INTO `assistance_records` VALUES (21,59,'2026-03-23','keian','bagyo','cash','1',3,2000.00,'mayor','2026-03-22 18:38:40'),(22,60,'2026-03-23','Nekko Layd','Lindol','cash','1',2,2000.00,'DSWD','2026-03-22 18:40:04'),(23,61,'2026-03-23','Siomai','bagyo','cash','1',12,3222.00,'DSWD','2026-03-22 18:41:12'),(25,63,'2026-03-23','mama mo','bagyo','cash','1',2,2500.00,'mayor','2026-03-22 22:25:34'),(26,64,'2026-03-23','new','bagyo','food packs','1',2,150.00,'mayor','2026-03-22 22:39:00'),(30,66,'2026-03-24','mama mo','bagyo','Foods ','2',2,200.00,'mayor','2026-03-23 20:30:33'),(32,67,'2026-03-24','Nekko Layd','bagyo','food packs','2',2,250.00,'DSWD','2026-03-23 20:50:19');
/*!40000 ALTER TABLE `assistance_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `beneficiaries`
--

DROP TABLE IF EXISTS `beneficiaries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `beneficiaries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `municipality` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `barangay` varchar(100) DEFAULT NULL,
  `evacuation_site` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `name_ext` varchar(20) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `place_of_birth` varchar(150) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `civil_status` varchar(50) DEFAULT NULL,
  `mothers_maiden_name` varchar(150) DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `monthly_income` decimal(10,2) DEFAULT NULL,
  `id_card_presented` varchar(100) DEFAULT NULL,
  `id_number` varchar(100) DEFAULT NULL,
  `contact_number` varchar(50) DEFAULT NULL,
  `house_no` varchar(50) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `sitio` varchar(100) DEFAULT NULL,
  `addr_barangay` varchar(100) DEFAULT NULL,
  `addr_city` varchar(100) DEFAULT NULL,
  `addr_province` varchar(100) DEFAULT NULL,
  `zip_code` varchar(20) DEFAULT NULL,
  `is_4ps` tinyint(1) DEFAULT NULL,
  `ip_type` varchar(100) DEFAULT NULL,
  `bank_wallet` varchar(100) DEFAULT NULL,
  `account_name` varchar(100) DEFAULT NULL,
  `account_type` varchar(100) DEFAULT NULL,
  `account_number` varchar(100) DEFAULT NULL,
  `ownership` enum('owner','renter','sharer') DEFAULT NULL,
  `damage_classification` enum('Partially damage','Totally damage') DEFAULT NULL,
  `date_registered` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `beneficiaries`
--

LOCK TABLES `beneficiaries` WRITE;
/*!40000 ALTER TABLE `beneficiaries` DISABLE KEYS */;
INSERT INTO `beneficiaries` VALUES (59,'VIII','EASTERN SAMAR','HERNANI','2','Padang','Padang','Gacillos','Keian','Camposano','jr','2002-12-02',25,'HERNANI','Male','SINGLE','MA. ANGELES CAMPOSANO','CATHOLIC','NONE',5000.00,'NA','NA','09123456789','02','streeet','steet','Padang','borongan','EASTERNSAMAR','6817',1,'aweawe','NA','NA','NA','NA','owner','Totally damage','2026-03-01','2026-03-22 18:38:40'),(60,'VIII','EASTERN SAMAR','HERNANI','2','Padang','Padang','Campo','NEKON','Camposano','jr','2002-12-02',25,'HERNANI','Male','SINGLE','MA. ANGELES CAMPOSANO','CATHOLIC','NONE',5000.00,'NA','NA','09123456789','02','streeet','steet','Padang','borongan','EASTERNSAMAR','6817',0,'aweawe','NA','NA','NA','NA','renter','Partially damage','2026-03-23','2026-03-22 18:40:04'),(61,'VIII','EASTERN SAMAR','HERNANI','2','Padang','Padang','Siomai','Rice','Bowl','jr','2002-12-02',25,'HERNANI','Female','SINGLE','MA. ANGELES CAMPOSANO','CATHOLIC','NONE',5000.00,'NA','NA','09123456789','02','streeet','steet','Padang','borongan','EASTERNSAMAR','6817',1,'','NA','NA','NA','NA','owner','Totally damage','2026-03-23','2026-03-22 18:41:12'),(63,'VIII','EASTERN SAMAR','HERNANI','2','Poblacion 01','Padang','Mama mo','Rice','Bowl','jr','2002-12-02',25,'HERNANI','Male','SINGLE','MA. ANGELES CAMPOSANO','CATHOLIC','NONE',5000.00,'NA','NA','09123456789','02','streeet','steet','Poblacion 01','borongan','EASTERNSAMAR','6817',0,'','NA','NA','NA','NA','owner','Partially damage','2026-03-23','2026-03-22 22:25:34'),(64,'VIII','EASTERN SAMAR','HERNANI','2','Nagaja','Nagaja','New record','Rice','Bowl','jr','2002-12-02',25,'HERNANI','Female','SINGLE','MA. ANGELES CAMPOSANO','CATHOLIC','NONE',5000.00,'NA','NA','09123456789','02','streeet','steet','Nagaja','borongan','EASTERNSAMAR','6817',1,'','NA','NA','NA','NA','owner','Partially damage','2026-03-22','2026-03-22 22:39:00'),(66,'VIII','EASTERN SAMAR','HERNANI','2','Nagaja','Nagaja','test logs','Norlan','Bowl','jr','2002-12-02',25,'HERNANI','Male','SINGLE','MA. ANGELES CAMPOSANO','CATHOLIC','NONE',5000.00,'NA','NA','09123456789','02','streeet','steet','Nagaja','borongan','EASTERNSAMAR','6817',1,'aweawe','NA','NA','NA','NA','sharer','Partially damage','2026-03-24','2026-03-23 19:44:52'),(67,'VIII','EASTERN SAMAR','HERNANI','2','Nagaja','Nagaja','NEW LOGS','Norlan','Bowl','jr','2002-12-02',25,'HERNANI','Male','SINGLE','MA. ANGELES CAMPOSANO','CATHOLIC','NONE',5000.00,'NA','NA','09123456789','02','street','street','Poblacion 02','borongan','EASTERNSAMAR','6817',1,'aweawe','NA','NA','NA','NA','renter','Totally damage','2026-03-26','2026-03-23 20:49:37');
/*!40000 ALTER TABLE `beneficiaries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `family_members`
--

DROP TABLE IF EXISTS `family_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `family_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `beneficiary_id` int(11) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `relation` varchar(50) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `education` varchar(100) DEFAULT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `vulnerability` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `beneficiary_id` (`beneficiary_id`),
  CONSTRAINT `family_members_ibfk_1` FOREIGN KEY (`beneficiary_id`) REFERENCES `beneficiaries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `family_members`
--

LOCK TABLES `family_members` WRITE;
/*!40000 ALTER TABLE `family_members` DISABLE KEYS */;
INSERT INTO `family_members` VALUES (17,59,'Kyle','brother','2026-03-04',10,'Male','school','occupay','vulnera'),(18,59,'Kin','sister','2026-03-23',30,'Female','school','occupay','vulnera'),(19,60,'Kyle','brother','2026-03-04',10,'Male','school','occupay','vulnera'),(20,60,'Kin','sister','2026-03-23',30,'Male','school','occupay','vulnera'),(21,60,'Mark kin','bro','2026-03-23',123,'Male','school','occupay','vulnera'),(24,66,'Kyle','cousin','2026-03-04',23,'Male','school','occupay','vulnera'),(26,67,'Kyle','cousin','2026-03-04',23,'Male','school','occupay','vulnera');
/*!40000 ALTER TABLE `family_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(100) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `module` varchar(50) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `log_date` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (11,'user1','create','beneficiary','Created beneficiary: Norlan NEW LOGS','2026-03-24 04:49:37'),(12,'user1','update','beneficiary','Updated beneficiary: Norlan NEW LOGS','2026-03-24 04:50:19'),(13,'user1','export','aid_distribution','Exported aid distribution | Barangay: Poblacion 02','2026-03-24 04:50:34'),(14,'user1','print','aid_distribution','Printed aid distribution | Brgy: Poblacion 02','2026-03-24 04:50:46'),(15,'user1','export','aid_distribution','Exported aid distribution','2026-03-24 04:51:02'),(16,'user1','export','beneficiaries','Exported beneficiaries','2026-03-24 04:51:29'),(17,'user1','print','beneficiaries','Printed beneficiary report','2026-03-24 04:51:52'),(18,'user1','backup','database','Created database backup','2026-03-24 04:52:07'),(19,'user1','login','auth','User logged in','2026-03-24 04:57:53'),(20,'user1','logout','auth','User logged out','2026-03-24 04:58:07');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user',
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','admin','$2y$10$kP3H3.FLS2EZYfTYYmbFregQFCTEIgpS8Crn32VxOEEsCEUTtixRW','admin','admin@gmail.com','2026-03-21 19:34:28'),(2,'Keian C. Gacillos','user1','$2y$10$tf9rX2Dvoe2MQjePQa5GyupVIXpgfhZWBcI57DHhtBZmcGHrV5z1y','user','user@gmail.com','2026-03-21 19:35:01'),(8,'Keian C1222211. Gacillos','keian@gmail.com','aweaeaw','user','1@gmail.com','2026-03-21 20:06:35');
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

-- Dump completed on 2026-03-25  4:54:05
