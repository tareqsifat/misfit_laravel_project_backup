CREATE DATABASE  IF NOT EXISTS `tpit_v2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `tpit_v2`;
-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: localhost    Database: tpit_v2
-- ------------------------------------------------------
-- Server version	8.0.33

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` tinytext COLLATE utf8mb4_unicode_ci,
  `creator` tinyint DEFAULT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_messages`
--

LOCK TABLES `contact_messages` WRITE;
/*!40000 ALTER TABLE `contact_messages` DISABLE KEYS */;
INSERT INTO `contact_messages` VALUES (1,'Ellis','helene56@example.org','Vel eum id in.','Eos autem molestias molestiae enim sequi ut.',NULL,'44562',1,'2023-09-11 18:05:29','2023-09-11 18:05:29'),(2,'Beulah','kaleb78@example.net','Est nostrum.','Et quam at ut sed nostrum voluptas.',NULL,'27943',1,'2023-09-11 18:05:29','2023-09-11 18:05:29'),(3,'Miguel','kub.hadley@example.org','Accusamus.','Ab et modi nihil sequi veritatis.',NULL,'11328',1,'2023-09-11 18:05:29','2023-09-11 18:05:29'),(4,'Krystina','angelo.dach@example.net','Veritatis.','Sit accusantium adipisci et aut est id quia.',NULL,'43539',1,'2023-09-11 18:05:29','2023-09-11 18:05:29'),(5,'Fabiola','elyse.nitzsche@example.com','Quo repellat.','Ut quia sequi ullam laudantium odit reiciendis.',NULL,'23033',1,'2023-09-11 18:05:29','2023-09-11 18:05:29'),(6,'Genesis','jessie11@example.net','Veniam quam ut.','Doloribus aut sit possimus ut iure itaque.',NULL,'36874',1,'2023-09-11 18:05:29','2023-09-11 18:05:29'),(7,'Ebba','brunolfsson@example.net','Fugiat ratione.','Cum qui et et aperiam perferendis.',NULL,'15687',1,'2023-09-11 18:05:29','2023-09-11 18:05:29'),(8,'Bethany','sskiles@example.net','Quidem numquam.','Velit ut est fugiat et velit delectus animi.',NULL,'15245',1,'2023-09-11 18:05:29','2023-09-11 18:05:29'),(9,'Gladyce','emmerich.juana@example.com','Itaque.','Maiores est nemo corrupti.',NULL,'49666',1,'2023-09-11 18:05:29','2023-09-11 18:05:29'),(10,'Demarcus','fred.heller@example.org','Est dolor qui.','Eveniet laboriosam repellat iste assumenda.',NULL,'55344',1,'2023-09-11 18:05:29','2023-09-11 18:05:29'),(11,'Avery','kale.hane@example.net','Eaque iste.','Sunt nihil atque eum.',NULL,'45461',1,'2023-09-11 18:05:29','2023-09-11 18:05:29'),(12,'Catharine','gerald.leannon@example.net','Qui quisquam.','Aut excepturi veniam eum repudiandae dolor.',NULL,'43726',1,'2023-09-11 18:05:29','2023-09-11 18:05:29'),(13,'Orrin','gudrun.glover@example.org','Molestiae.','Aut id error ipsum ab nihil et.',NULL,'12691',1,'2023-09-11 18:05:29','2023-09-11 18:05:29'),(14,'Thora','zmayer@example.org','Iusto quis.','Voluptas modi laudantium pariatur dolor.',NULL,'37283',1,'2023-09-11 18:05:29','2023-09-11 18:05:29'),(15,'Burdette','lind.jessica@example.com','Earum dolores.','Asperiores minima natus quia ea natus molestias.',NULL,'42420',1,'2023-09-11 18:05:29','2023-09-11 18:05:29'),(16,'Dejah','jessika.robel@example.com','Excepturi.','Eum enim et aliquid ut quo reiciendis.',NULL,'49898',1,'2023-09-11 18:05:29','2023-09-11 18:05:29'),(17,'Noelia','alva81@example.com','In soluta enim.','Omnis enim minus sequi ut eaque.',NULL,'24105',1,'2023-09-11 18:05:29','2023-09-11 18:05:29'),(18,'Kiel','qolson@example.org','Aliquam rem.','Assumenda quas sed fugit sequi.',NULL,'30007',1,'2023-09-11 18:05:29','2023-09-11 18:05:29'),(19,'Raymundo','williamson.marietta@example.org','Dolor.','Est et quo non laborum.',NULL,'11003',1,'2023-09-11 18:05:29','2023-09-11 18:05:29'),(20,'Cesar','bill41@example.net','Quia incidunt.','Molestiae ut est delectus nulla quia.',NULL,'42168',1,'2023-09-11 18:05:29','2023-09-11 18:05:29'),(21,'Wilhelmine','gladys98@example.com','Voluptas.','Ipsa vero est rerum nihil.',NULL,'51576',1,'2023-09-11 18:05:29','2023-09-11 18:05:29'),(22,'Lavern','norwood.fisher@example.org','Nihil minus.','Ducimus est et rem qui cupiditate temporibus.',NULL,'24476',1,'2023-09-11 18:05:29','2023-09-11 18:05:29'),(23,'Rahul','brennon16@example.org','Sed et a.','Ipsa labore omnis odio nihil.',NULL,'30235',1,'2023-09-11 18:05:29','2023-09-11 18:05:29'),(24,'Shaylee','mohr.madge@example.org','Laborum quis.','Tenetur cumque omnis iusto laborum nihil magni.',NULL,'45368',1,'2023-09-11 18:05:29','2023-09-11 18:05:29'),(25,'Jewell','mclaughlin.federico@example.com','Facere natus.','Omnis aliquid consequatur aut quasi qui nesciunt.',NULL,'28614',1,'2023-09-11 18:05:29','2023-09-11 18:05:29'),(26,'Garland','gwen.kuhic@example.org','Vero sunt vero.','Sunt iure debitis dicta beatae placeat nulla.',NULL,'23495',1,'2023-09-11 18:05:29','2023-09-11 18:05:29'),(27,'Isobel','hyatt.birdie@example.org','Libero.','Ad cupiditate ratione et ullam dolor dolore et.',NULL,'18932',1,'2023-09-11 18:05:29','2023-09-11 18:05:29'),(28,'Lavada','carroll06@example.net','Aliquid.','Similique perspiciatis consequatur ut non.',NULL,'26905',1,'2023-09-11 18:05:29','2023-09-11 18:05:29'),(29,'Kamille','stokes.kelton@example.com','Mollitia.','Eveniet placeat sunt mollitia omnis in.',NULL,'47038',1,'2023-09-11 18:05:29','2023-09-11 18:05:29'),(30,'Sister','qkozey@example.com','Quis non.','Incidunt quo ut qui molestiae sapiente est.',NULL,'13839',1,'2023-09-11 18:05:29','2023-09-11 18:05:29');
/*!40000 ALTER TABLE `contact_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `examination_part66_modules`
--

DROP TABLE IF EXISTS `examination_part66_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `examination_part66_modules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `education_qualification` json DEFAULT NULL,
  `category_of_exam` json DEFAULT NULL,
  `application_for` json DEFAULT NULL,
  `essay` json DEFAULT NULL,
  `previous_attemped` json DEFAULT NULL,
  `application_status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `creator` bigint unsigned DEFAULT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint unsigned NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `examination_part66_modules`
--

LOCK TABLES `examination_part66_modules` WRITE;
/*!40000 ALTER TABLE `examination_part66_modules` DISABLE KEYS */;
/*!40000 ALTER TABLE `examination_part66_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2016_06_01_000001_create_oauth_auth_codes_table',1),(4,'2016_06_01_000002_create_oauth_access_tokens_table',1),(5,'2016_06_01_000003_create_oauth_refresh_tokens_table',1),(6,'2016_06_01_000004_create_oauth_clients_table',1),(7,'2016_06_01_000005_create_oauth_personal_access_clients_table',1),(8,'2019_08_19_000000_create_failed_jobs_table',1),(9,'2022_11_23_044055_create_user_roles_table',1),(10,'2022_11_23_063518_create_user_permissions_table',1),(11,'2023_02_13_225810_create_contact_messages_table',1),(12,'2023_08_03_032804_create_examination_part66_modules_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `client_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_access_tokens`
--

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
INSERT INTO `oauth_access_tokens` VALUES ('4e7479e2f8eee1240c000759b2fb6acaf74a58f3eab8c04410911d5c08bcc15cfd2ac71aa4c0ade0',2,'9a1c1dfd-81e7-4588-b5a2-190583b66a6e','accessToken','[]',0,'2023-09-11 18:59:31','2023-09-11 18:59:31','2024-09-12 00:59:31');
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `client_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_auth_codes`
--

LOCK TABLES `oauth_auth_codes` WRITE;
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_clients` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_clients`
--

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` VALUES ('9a1c1dfd-81e7-4588-b5a2-190583b66a6e',NULL,'Laravel Personal Access Client','z7oLm106tANcChyi8g87PXZwtzXcmGgVO2Da9SSz',NULL,'http://localhost',1,0,0,'2023-09-11 18:05:29','2023-09-11 18:05:29'),('9a1c1dfd-8717-4cc1-acac-b5288a2ba3ca',NULL,'Laravel Password Grant Client','yD6qm06dAYXIcDSXlS015TNqEg4PlWop8VFHW6og','users','http://localhost',0,1,0,'2023-09-11 18:05:29','2023-09-11 18:05:29');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_personal_access_clients`
--

LOCK TABLES `oauth_personal_access_clients` WRITE;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
INSERT INTO `oauth_personal_access_clients` VALUES (1,'9a1c1dfd-81e7-4588-b5a2-190583b66a6e','2023-09-11 18:05:29','2023-09-11 18:05:29');
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_refresh_tokens`
--

LOCK TABLES `oauth_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_permissions`
--

DROP TABLE IF EXISTS `user_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission_serial` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `creator` tinyint DEFAULT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_permissions_permission_serial_unique` (`permission_serial`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_permissions`
--

LOCK TABLES `user_permissions` WRITE;
/*!40000 ALTER TABLE `user_permissions` DISABLE KEYS */;
INSERT INTO `user_permissions` VALUES (1,'can_create','1',NULL,NULL,1,'2023-09-11 18:05:28','2023-09-11 18:05:28'),(2,'can_edit','2',NULL,NULL,1,'2023-09-11 18:05:28','2023-09-11 18:05:28'),(3,'can_delete','3',NULL,NULL,1,'2023-09-11 18:05:28','2023-09-11 18:05:28');
/*!40000 ALTER TABLE `user_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_serial` int DEFAULT NULL,
  `creator` tinyint DEFAULT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_roles_role_serial_unique` (`role_serial`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_roles`
--

LOCK TABLES `user_roles` WRITE;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
INSERT INTO `user_roles` VALUES (10,'super_admin',1,NULL,NULL,1,'2023-09-11 18:05:28','2023-09-11 18:05:28'),(20,'admin',2,NULL,NULL,1,'2023-09-11 18:05:28','2023-09-11 18:05:28'),(30,'user',3,NULL,NULL,1,'2023-09-11 18:05:28','2023-09-11 18:05:28');
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_user_permission`
--

DROP TABLE IF EXISTS `user_user_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_user_permission` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint DEFAULT NULL,
  `user_permission_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_user_permission`
--

LOCK TABLES `user_user_permission` WRITE;
/*!40000 ALTER TABLE `user_user_permission` DISABLE KEYS */;
INSERT INTO `user_user_permission` VALUES (1,1,1,NULL,NULL),(2,1,2,NULL,NULL),(3,1,3,NULL,NULL),(4,2,1,NULL,NULL),(5,2,2,NULL,NULL),(6,3,1,NULL,NULL);
/*!40000 ALTER TABLE `user_user_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_user_role`
--

DROP TABLE IF EXISTS `user_user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_user_role` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint DEFAULT NULL,
  `user_role_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_user_role`
--

LOCK TABLES `user_user_role` WRITE;
/*!40000 ALTER TABLE `user_user_role` DISABLE KEYS */;
INSERT INTO `user_user_role` VALUES (1,1,1,NULL,NULL),(2,2,2,NULL,NULL),(3,3,3,NULL,NULL);
/*!40000 ALTER TABLE `user_user_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telegram_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telegram_name` text COLLATE utf8mb4_unicode_ci,
  `mobile_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'avatar.png',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_user_name_unique` (`user_name`),
  UNIQUE KEY `users_mobile_number_unique` (`mobile_number`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'super','admin','super admin','812239513',NULL,'016123','avatar.png','superadmin@gmail.com',NULL,'$2y$10$vBdX3qqzKkNYrox7qS99s.ZgN7mqP4g1bRO7XlbPHiB8R0JKFYuBe','67315434',1,NULL,'2023-09-11 18:05:28','2023-09-11 18:05:28'),(2,'mr','admin','admin','812239513',NULL,'016124','avatar.png','admin@gmail.com',NULL,'$2y$10$N9PUG9kERE1.umpYjnGbseWvXLCpoXECi3FL4cZhf7MA8VsqfaVDS','71124896',1,NULL,'2023-09-11 18:05:28','2023-09-11 18:05:28'),(3,'mr','user','user','812239513',NULL,'016125','avatar.png','user@gmail.com',NULL,'$2y$10$JHye35/vUDdSygK8Vz1aL.rUz8mHbytg6j9okDLgKTyeh0WrOdrjq','65532451',1,NULL,'2023-09-11 18:05:28','2023-09-11 18:05:28'),(4,'Ralph','Heller','Elijah Bartoletti II',NULL,NULL,'803.613.9341 x108','avatar.png','samson.parker@example.org','2023-09-11 18:05:28','$2y$10$31dNVU1dRMd0vtPcMc201uKNjCNAZRmc/FrLf9ZbjB/2CBUgqc/fm','84941028',1,'dxsU5EXEQJ','2023-09-11 18:05:29','2023-09-11 18:05:29'),(5,'Myah','Huel','Jerald Cummings',NULL,NULL,'532.422.2775 x2971','avatar.png','shirthe@example.net','2023-09-11 18:05:28','$2y$10$FpcjakPiu2AHzn1PV6xjyOLixoh1UgvGKkgzvIoYt39T2CwHo1BiK','48051561',1,'88vvfwyA5y','2023-09-11 18:05:29','2023-09-11 18:05:29'),(6,'Alda','Kertzmann','Talia Borer',NULL,NULL,'+1.527.478.8403','avatar.png','christiansen.dakota@example.net','2023-09-11 18:05:28','$2y$10$dFlqbC6uNc.EkML0x0YO.ewKaqXiSs9f9aJTYeDCsIBCw9WLFDSoG','72967774',1,'Kipa4R07Ym','2023-09-11 18:05:29','2023-09-11 18:05:29'),(7,'Harold','Treutel','Madyson Johnston',NULL,NULL,'(860) 282-5578','avatar.png','ewehner@example.com','2023-09-11 18:05:28','$2y$10$PENrIyY6kXNFdCqPdP5squPLchIAHueorH7Bv23ARaJmA.MRk5kAC','63077252',1,'3X5BnQANBl','2023-09-11 18:05:29','2023-09-11 18:05:29'),(8,'Norene','Gutmann','Amara Morar',NULL,NULL,'(342) 327-7267 x48246','avatar.png','bins.michel@example.net','2023-09-11 18:05:28','$2y$10$OAJnk1foZWVi9RFkwYxRYugMsquLukoFyg1Dyf0h0CM6hVJ4gx6fS','37482254',1,'t8CPPDBMBH','2023-09-11 18:05:29','2023-09-11 18:05:29');
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

-- Dump completed on 2023-09-12  1:01:36
