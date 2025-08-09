-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: aventuretrip
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bookings` (
  `tour_id` bigint unsigned NOT NULL,
  `tour_departure_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adults` int NOT NULL DEFAULT '1',
  `children` int NOT NULL DEFAULT '0',
  `num_people` int NOT NULL DEFAULT '1',
  `special_request` text COLLATE utf8mb4_unicode_ci,
  `total_price` decimal(10,2) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `passport_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  KEY `bookings_tour_id_foreign` (`tour_id`),
  KEY `bookings_tour_departure_id_foreign` (`tour_departure_id`),
  CONSTRAINT `bookings_tour_departure_id_foreign` FOREIGN KEY (`tour_departure_id`) REFERENCES `tour_departures` (`id`),
  CONSTRAINT `bookings_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `countries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `countries_name_unique` (`name`),
  UNIQUE KEY `countries_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'Thailand','thailand','2025-07-31 20:51:30','2025-07-31 20:51:30'),(2,'Vietnam','vietnam','2025-07-31 21:32:29','2025-07-31 21:32:29'),(3,'Laos','laos','2025-07-31 21:38:50','2025-07-31 21:38:50');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `country_tour`
--

DROP TABLE IF EXISTS `country_tour`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `country_tour` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `country_id` bigint unsigned NOT NULL,
  `tour_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `country_tour_country_id_foreign` (`country_id`),
  KEY `country_tour_tour_id_foreign` (`tour_id`),
  CONSTRAINT `country_tour_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  CONSTRAINT `country_tour_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `country_tour`
--

LOCK TABLES `country_tour` WRITE;
/*!40000 ALTER TABLE `country_tour` DISABLE KEYS */;
INSERT INTO `country_tour` VALUES (1,1,1,NULL,NULL),(2,1,2,NULL,NULL),(3,3,3,NULL,NULL),(4,1,3,NULL,NULL),(5,1,4,NULL,NULL),(6,3,5,NULL,NULL),(7,1,5,NULL,NULL),(8,2,5,NULL,NULL),(9,1,6,NULL,NULL),(10,1,7,NULL,NULL);
/*!40000 ALTER TABLE `country_tour` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tour_id` bigint unsigned NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_cover` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `images_tour_id_foreign` (`tour_id`),
  CONSTRAINT `images_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_06_11_052311_create_tours_table',1),(5,'2025_06_11_052312_create_tour_itineraries_table',1),(6,'2025_06_11_052313_create_tour_departures_table',1),(7,'2025_06_11_052314_create_bookings_table',1),(8,'2025_06_11_052315_create_images_table',1),(9,'2025_06_11_063950_create_tour_inclusions_table',1),(10,'2025_06_11_063951_create_tour_accommodations_table',1),(11,'2025_06_11_063952_create_tour_preparations_table',1),(12,'2025_06_11_064616_add_start_end_location_to_tours_table',1),(13,'2025_06_25_054621_add_category_to_tours_table',2),(14,'2025_06_12_084512_add_nationality_to_bookings_table',3),(15,'2025_06_12_085519_add_adults_children_num_people_to_bookings_table',4),(16,'2025_06_12_091209_add_special_request_to_bookings_table',4),(17,'2025_06_13_101403_add_filename_to_images_table',4),(18,'2025_06_13_101834_make_path_nullable_in_images_table',4),(19,'2025_06_15_095738_add_child_price_to_tour_departures_table',4),(20,'2025_06_20_062846_add_fields_to_bookings_table',4),(21,'2025_07_24_023519_add_itinerary_and_faq_to_tours_table',4),(22,'2025_07_24_045213_add_itinerary_and_faq_to_tours_table',5),(23,'2025_07_24_070135_create_tour_prices_table',6),(24,'2025_07_26_094727_add_available_note_to_tours_table',7),(25,'2025_07_27_033217_add_price_note_to_tours_table',8),(26,'2025_07_31_085343_add_finish_location_to_tours_table',9),(27,'2025_07_31_121323_create_countries_table',10),(28,'2025_07_31_121442_create_country_tour_table',10),(29,'2025_08_01_054548_add_fields_to_tours_table',11),(30,'2025_08_06_015216_create_f_a_q_s_table',12),(31,'2025_08_06_015227_create_gallery_images_table',12),(32,'2025_08_08_060555_create_country_tour_table',13),(33,'2025_08_08_062751_add_image_to_tours_table',14);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('xrBKQQX1Dc52WXJiJxKUvtl10QGCXRoty7Xhq2rU',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 Edg/138.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiblIzVXNyWUYxS1J0Tzh6YTVpRERmS2ZaN2VSQzlteVhad3l0YlZOMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1754639110);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tour_accommodations`
--

DROP TABLE IF EXISTS `tour_accommodations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tour_accommodations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tour_id` bigint unsigned NOT NULL,
  `day_number` tinyint unsigned NOT NULL,
  `stars` tinyint unsigned NOT NULL DEFAULT '2',
  `shared_room` tinyint(1) NOT NULL DEFAULT '1',
  `single_supplement_price` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tour_accommodations_tour_id_foreign` (`tour_id`),
  CONSTRAINT `tour_accommodations_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tour_accommodations`
--

LOCK TABLES `tour_accommodations` WRITE;
/*!40000 ALTER TABLE `tour_accommodations` DISABLE KEYS */;
INSERT INTO `tour_accommodations` VALUES (1,1,1,3,1,120.00,NULL,NULL),(2,1,2,2,1,100.00,NULL,NULL),(3,1,1,3,1,120.00,NULL,NULL),(4,1,2,2,1,100.00,NULL,NULL),(5,1,1,3,1,120.00,NULL,NULL),(6,1,2,2,1,100.00,NULL,NULL);
/*!40000 ALTER TABLE `tour_accommodations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tour_departures`
--

DROP TABLE IF EXISTS `tour_departures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tour_departures` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tour_id` bigint unsigned NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `child_price` decimal(8,2) DEFAULT NULL,
  `capacity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tour_departures_tour_id_foreign` (`tour_id`),
  CONSTRAINT `tour_departures_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tour_departures`
--

LOCK TABLES `tour_departures` WRITE;
/*!40000 ALTER TABLE `tour_departures` DISABLE KEYS */;
/*!40000 ALTER TABLE `tour_departures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tour_inclusions`
--

DROP TABLE IF EXISTS `tour_inclusions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tour_inclusions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tour_id` bigint unsigned NOT NULL,
  `includes_insurance` tinyint(1) NOT NULL DEFAULT '0',
  `includes_local_guide` tinyint(1) NOT NULL DEFAULT '0',
  `includes_admission` tinyint(1) NOT NULL DEFAULT '0',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tour_inclusions_tour_id_foreign` (`tour_id`),
  CONSTRAINT `tour_inclusions_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tour_inclusions`
--

LOCK TABLES `tour_inclusions` WRITE;
/*!40000 ALTER TABLE `tour_inclusions` DISABLE KEYS */;
INSERT INTO `tour_inclusions` VALUES (1,1,1,1,1,'Basic travel insurance is included for emergencies. Coverage is subject to provider terms. Activity availability may vary due to local conditions.',NULL,NULL),(2,1,1,1,1,'Basic travel insurance is included for emergencies. Coverage is subject to provider terms. Activity availability may vary due to local conditions.',NULL,NULL),(3,1,1,1,1,'Basic travel insurance is included for emergencies. Coverage is subject to provider terms. Activity availability may vary due to local conditions.',NULL,NULL);
/*!40000 ALTER TABLE `tour_inclusions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tour_itineraries`
--

DROP TABLE IF EXISTS `tour_itineraries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tour_itineraries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tour_id` bigint unsigned NOT NULL,
  `day` int NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meals` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tour_itineraries_tour_id_foreign` (`tour_id`),
  CONSTRAINT `tour_itineraries_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tour_itineraries`
--

LOCK TABLES `tour_itineraries` WRITE;
/*!40000 ALTER TABLE `tour_itineraries` DISABLE KEYS */;
/*!40000 ALTER TABLE `tour_itineraries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tour_preparations`
--

DROP TABLE IF EXISTS `tour_preparations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tour_preparations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tour_id` bigint unsigned NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tour_preparations_tour_id_foreign` (`tour_id`),
  CONSTRAINT `tour_preparations_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tour_preparations`
--

LOCK TABLES `tour_preparations` WRITE;
/*!40000 ALTER TABLE `tour_preparations` DISABLE KEYS */;
INSERT INTO `tour_preparations` VALUES (1,1,'- Valid passport (at least 6 months before expiry)\n- Personal medications\n- Light rain jacket or windbreaker\n- Universal power adapter\n- Power bank / mobile charger\n- Reusable tote bag or water bottle\n- Comfortable walking shoes',NULL,NULL),(2,1,'- Valid passport (at least 6 months before expiry)\n- Personal medications\n- Light rain jacket or windbreaker\n- Universal power adapter\n- Power bank / mobile charger\n- Reusable tote bag or water bottle\n- Comfortable walking shoes',NULL,NULL),(3,1,'- Valid passport (at least 6 months before expiry)\n- Personal medications\n- Light rain jacket or windbreaker\n- Universal power adapter\n- Power bank / mobile charger\n- Reusable tote bag or water bottle\n- Comfortable walking shoes',NULL,NULL);
/*!40000 ALTER TABLE `tour_preparations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tour_prices`
--

DROP TABLE IF EXISTS `tour_prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tour_prices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tour_id` bigint unsigned NOT NULL,
  `pax_min` int unsigned NOT NULL,
  `pax_max` int unsigned NOT NULL,
  `price_per_person` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tour_prices_tour_id_foreign` (`tour_id`),
  CONSTRAINT `tour_prices_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tour_prices`
--

LOCK TABLES `tour_prices` WRITE;
/*!40000 ALTER TABLE `tour_prices` DISABLE KEYS */;
INSERT INTO `tour_prices` VALUES (1,1,2,2,5250.00,'2025-07-24 00:12:32','2025-07-24 00:12:32'),(2,1,3,3,4900.00,'2025-07-24 00:12:41','2025-07-24 00:12:41'),(3,1,4,4,4600.00,'2025-07-24 00:12:55','2025-07-24 00:12:55'),(4,1,5,9,4300.00,'2025-07-24 00:13:03','2025-07-24 00:13:03'),(5,2,2,2,5250.00,'2025-08-03 05:36:34','2025-08-03 05:36:34'),(6,2,3,3,4900.00,'2025-08-03 05:36:34','2025-08-03 05:36:34'),(7,2,4,4,4600.00,'2025-08-03 05:36:34','2025-08-03 05:36:34'),(8,2,5,9,4300.00,'2025-08-03 05:36:34','2025-08-03 05:36:34'),(9,6,2,2,4900.00,'2025-08-03 19:38:07','2025-08-03 19:38:07'),(10,6,3,3,4500.00,'2025-08-03 19:38:07','2025-08-03 19:38:07'),(11,6,4,4,4200.00,'2025-08-03 19:38:07','2025-08-03 19:38:07'),(12,6,5,9,3900.00,'2025-08-03 19:38:07','2025-08-03 19:38:07'),(13,7,2,2,400.00,'2025-08-03 19:55:56','2025-08-03 19:55:56'),(14,7,3,3,380.00,'2025-08-03 19:55:56','2025-08-03 19:55:56'),(15,7,4,4,360.00,'2025-08-03 19:55:56','2025-08-03 19:55:56'),(16,7,5,9,340.00,'2025-08-03 19:55:56','2025-08-03 19:55:56'),(17,4,2,2,4200.00,'2025-08-03 20:18:02','2025-08-03 20:18:02'),(18,4,3,3,3800.00,'2025-08-03 20:18:02','2025-08-03 20:18:02'),(19,4,4,4,3500.00,'2025-08-03 20:18:02','2025-08-03 20:18:02'),(20,4,5,9,3200.00,'2025-08-03 20:18:02','2025-08-03 20:18:02'),(21,3,2,2,2200.00,'2025-08-03 20:52:57','2025-08-03 20:52:57'),(22,3,3,3,1950.00,'2025-08-03 20:52:57','2025-08-03 20:52:57'),(23,3,4,4,1750.00,'2025-08-03 20:52:57','2025-08-03 20:52:57'),(24,3,5,9,1600.00,'2025-08-03 20:52:57','2025-08-03 20:52:57'),(25,5,2,2,2500.00,'2025-08-03 21:09:29','2025-08-03 21:09:29'),(26,5,3,3,2200.00,'2025-08-03 21:09:29','2025-08-03 21:09:29'),(27,5,4,4,2000.00,'2025-08-03 21:09:29','2025-08-03 21:09:29'),(28,5,5,9,1800.00,'2025-08-03 21:09:29','2025-08-03 21:09:29'),(29,5,2,2,42000.00,'2025-08-03 21:10:31','2025-08-03 21:10:31'),(30,5,3,3,39000.00,'2025-08-03 21:10:31','2025-08-03 21:10:31'),(31,5,4,4,36000.00,'2025-08-03 21:10:31','2025-08-03 21:10:31'),(32,5,5,9,33000.00,'2025-08-03 21:10:32','2025-08-03 21:10:32'),(33,5,2,2,42000.00,'2025-08-03 21:13:09','2025-08-03 21:13:09'),(34,5,3,3,39000.00,'2025-08-03 21:13:09','2025-08-03 21:13:09'),(35,5,4,4,36000.00,'2025-08-03 21:13:09','2025-08-03 21:13:09'),(36,5,5,9,33000.00,'2025-08-03 21:13:12','2025-08-03 21:13:12'),(37,5,2,2,42000.00,'2025-08-03 21:24:19','2025-08-03 21:24:19'),(38,5,3,3,39000.00,'2025-08-03 21:24:19','2025-08-03 21:24:19'),(39,5,4,4,36000.00,'2025-08-03 21:24:19','2025-08-03 21:24:19'),(40,5,5,9,33000.00,'2025-08-03 21:24:19','2025-08-03 21:24:19');
/*!40000 ALTER TABLE `tour_prices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tours`
--

DROP TABLE IF EXISTS `tours`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tours` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'series',
  `destination` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Bangkok',
  `start_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `finish_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `price` decimal(10,2) DEFAULT NULL,
  `price_note` text COLLATE utf8mb4_unicode_ci,
  `available_note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_description` text COLLATE utf8mb4_unicode_ci,
  `duration` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overview` text COLLATE utf8mb4_unicode_ci,
  `itinerary` longtext COLLATE utf8mb4_unicode_ci,
  `faqs` text COLLATE utf8mb4_unicode_ci,
  `highlights` text COLLATE utf8mb4_unicode_ci,
  `physical_rating` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tour_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_popular` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `start` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tours_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tours`
--

LOCK TABLES `tours` WRITE;
/*!40000 ALTER TABLE `tours` DISABLE KEYS */;
INSERT INTO `tours` VALUES (1,'Bangkok Royal Heritage: Grand Palace, Temples, Royal Barge & Canal Tour','ayutthaya-ancient-city-temples-tour.jpg','bangkok-grand-palace-temple-tour.jpg','fullday','Bangkok','Bangkok','Bangkok',0.00,3200.00,NULL,NULL,'Discover Bangkok’s iconic Grand Palace, majestic temples, and vibrant markets in one unforgettable day tour.\r\nVisit Wat Phra Kaew (Temple of the Emerald Buddha), Wat Pho, and Wat Arun, cruise along the Chao Phraya River on a traditional royal barge, and sample authentic Thai street food.\r\nThis guided tour offers the best city sightseeing experience, perfect for travelers wanting to explore Bangkok’s rich heritage, culture, and culinary delights.\r\nIncludes hotel pickup, English-speaking guide, and entry fees.',NULL,'\r\n<h4 class=\"fw-bold text-primary\">Tour Highlights:</h4>\r\n<ul class=\"list-unstyled ps-3\">\r\n    <li><span class=\"fw-bold\">Grand Palace & Emerald Buddha (Wat Phra Kaew)</span> — Thailand’s most sacred royal landmark.</li>\r\n    <li><span class=\"fw-bold\">Wat Pho (Reclining Buddha Temple)</span> — Home to the massive 46-meter-long Reclining Buddha.</li>\r\n    <li><span class=\"fw-bold\">Wat Arun (Temple of Dawn)</span> — Stunning riverside temple with panoramic city views.</li>\r\n    <li><span class=\"fw-bold\">Long-Tail Boat Ride</span> — Cruise through peaceful Thonburi canals and observe riverside local life.</li>\r\n    <li><span class=\"fw-bold\">Royal Barge Museum</span> — Admire Thailand’s elaborately carved and gilded ceremonial barges.</li>\r\n</ul>\r\n<h4 class=\"fw-bold text-success mt-4\">What\'s Included:</h4>\r\n<ul class=\"list-unstyled ps-3\">\r\n    <li>✔️ Hotel Pickup & Drop-off within Bangkok</li>\r\n    <li>✔️ All Entrance Tickets (no hidden fees)</li>\r\n    <li>✔️ Private Air-Conditioned Van & English-speaking Guide</li>\r\n    <li>✔️ Long-tail Boat Canal Tour & Royal Barge Museum Visit</li>\r\n    <li>✔️ Complimentary Drinking Water & Cold Towel Service</li>\r\n</ul>\r\n<p class=\"mt-3\"><strong>Perfect For:</strong> Couples, Families, Small Groups (up to 9 pax) seeking a rich cultural immersion in style and comfort.</p>\r\n<h5 class=\"fw-bold text-warning mt-4\">Important Notes:</h5>\r\n<ul class=\"ps-3\">\r\n    <li>Modest clothing is required for temple visits (long pants, covered shoulders).</li>\r\n    <li>The Grand Palace may close for official ceremonies — alternative arrangements will be provided if needed.</li>\r\n</ul>\r\n<p class=\"mt-3\"><strong>Tour Duration:</strong> Approx. 6–7 Hours (08:00 – 15:30)<br>\r\n<strong>Private Tour Only</strong> — No join-in groups.</p>\r\n','08:00 — Hotel pickup in Bangkok  \r\n08:30 — Visit Grand Palace & Emerald Buddha  \r\n10:00 — Explore Wat Pho (Reclining Buddha Temple)  \r\n11:00 — Cross Chao Phraya River to Wat Arun (Temple of Dawn)  \r\n12:00 — Canal tour by long-tail boat & visit Royal Barge Museum  \r\n13:30 — Refreshment break (own expense)  \r\n15:30 — Tour concludes at last sightseeing spot  \r\n16:30 — Drop-off at hotel or preferred location within Bangkok (traffic depending)','Q: What should I wear?  \r\nA: Modest clothing. Long pants and covered shoulders are required.\r\nQ: Are entrance tickets included?  \r\nA: Yes, all tickets are fully included in the tour price.\r\nQ: Is this a private tour?  \r\nA: Yes, it is an exclusive private tour with your own guide and van.\r\nQ: Can I request to be dropped off somewhere else after the tour?  \r\nA: Yes, we can drop you off at any location within Bangkok.\r\nQ: Can I customize the pickup location or time?  \r\nA: Standard pickup is at 08:00 AM from your hotel in Bangkok, but we are flexible and can adjust within reasonable timing if needed.\r\nQ: Is lunch included in this tour?  \r\nA: Lunch is not included in the tour price. Your guide will recommend local eateries where you can enjoy authentic Thai food at your own expense.\r\nQ: Will the tour operate in case of rain?  \r\nA: Yes, the tour operates rain or shine. Please bring an umbrella or raincoat. Indoor attractions and covered boats are available.',NULL,NULL,NULL,NULL,0,'2025-07-31 05:43:13','2025-08-04 02:55:36',NULL,1),(2,'Floating Market & Railway Market Adventure with Coconut Farm','bangkok-grand-palace-temple-tour.jpg','floating-market-railway-tour.jpg','fullday','Bangkok','Bangkok','Bankgok',0.00,3500.00,NULL,NULL,'',NULL,'<h4 class=\"fw-bold text-primary mt-4\">Tour Highlights:</h4>\r\n<ul class=\"list-unstyled ps-3\">\r\n  <li><span class=\"fw-bold\">Maeklong Railway Market (Talad Rom Hub)</span> — Watch vendors quickly fold umbrellas as the train approaches.</li>\r\n  <li><span class=\"fw-bold\">Coconut Sugar Farm Visit</span> — Discover how locals craft coconut sugar & taste fresh palm products.</li>\r\n  <li><span class=\"fw-bold\">Damnoen Saduak Floating Market</span> — Navigate bustling canals filled with colorful boats and vendors.</li>\r\n  <li><span class=\"fw-bold\">Optional Paddle Boat Ride</span> — Get a closer look inside the floating market alleys (optional add-on).</li>\r\n</ul>\r\n<h4 class=\"fw-bold text-success mt-4\">What\'s Included:</h4>\r\n<ul class=\"list-unstyled ps-3\">\r\n  <li>✔️ Hotel Pickup & Drop-off within Bangkok</li>\r\n  <li>✔️ Private Air-Conditioned Van & English-speaking Guide</li>\r\n  <li>✔️ Railway Market & Floating Market Visit</li>\r\n  <li>✔️ Coconut Farm Experience & Tasting</li>\r\n  <li>✔️ Complimentary Drinking Water & Cold Towel Service</li>\r\n</ul>\r\n<p class=\"mt-3\"><strong>Perfect For:</strong> Families, Friends, and First-time Visitors wanting a must-see experience of Thailand’s unique markets.</p>\r\n<h5 class=\"fw-bold text-warning mt-4\">Important Notes:</h5>\r\n<ul class=\"ps-3\">\r\n  <li>❗ The train market schedule may vary slightly due to real-time train operations.</li>\r\n</ul>\r\n<p class=\"mt-3\"><strong>Tour Duration:</strong> Approx. 6–7 Hours (07:00 – 15:00)</p>\r\n<p><strong>Private Tour Only</strong> — No join-in groups.</p>','07:00 — Pickup from your hotel in Bangkok  \r\n08:30 — Arrive at Maeklong Railway Market (Train Passing Moment)  \r\n09:30 — Visit a local Coconut Sugar Farm (Demonstration & Tasting)  \r\n10:30 — Explore Damnoen Saduak Floating Market  \r\n11:00 — Optional Paddle Boat Ride (Own Expense)  \r\n12:00 — Lunch Break (Own Expense)  \r\n13:00 — Depart Floating Market, return to Bangkok  \r\n14:30 — Drop-off at your hotel or chosen location in Bangkok.','Q: What should I wear?  \r\nA: Comfortable casual wear, hat, and sunscreen are recommended.\r\nQ: Are entrance tickets included?  \r\nA: Yes, all entrance fees and paddle boat ride are fully included in the tour price.\r\nQ: Is this a private tour?  \r\nA: Yes, this is an exclusive private tour with your own guide and air-conditioned van.\r\nQ: Can I request to be dropped off somewhere else after the tour?  \r\nA: Yes, we can drop you off at any location within Bangkok.\r\nQ: Can I customize the pickup location or time?  \r\nA: Standard pickup is at 07:00 AM from your hotel in Bangkok, but we can adjust within reasonable timing if needed.\r\nQ: Is lunch included in this tour?  \r\nA: Lunch is not included in the tour price. Your guide will recommend authentic local eateries at your own expense.\r\nQ: Will the tour operate in case of rain?  \r\nA: Yes, the tour operates rain or shine. The floating market has covered boats, and umbrellas will be provided if needed.',NULL,NULL,NULL,NULL,0,'2025-07-31 05:43:13','2025-08-04 03:06:39',NULL,1),(3,'Roam Thailand & Laos: The Jungles, Temples & Waterfalls Adventure','eastern-thailand-discovery.jpg','roam-thailand-laos-adventure-tour.jpg','series','Laos','Bangkok','Laos',0.00,2900.00,NULL,NULL,'Discover the majestic Angkor Wat and ancient temples.','8 days 7 nights','<h4 class=\"fw-bold text-primary mt-4\">Tour Highlights:</h4>\r\n<ul class=\"list-unstyled ps-3\">\r\n  <li><span class=\"fw-bold\">Ayutthaya\'s UNESCO Temples</span> — Explore ancient ruins and riverside temples.</li>\r\n  <li><span class=\"fw-bold\">Khao Yai National Park</span> — Jungle trekking, wildlife spotting & night safari adventure.</li>\r\n  <li><span class=\"fw-bold\">Phanom Rung & Muang Tam</span> — Discover majestic Khmer temples in Buriram.</li>\r\n  <li><span class=\"fw-bold\">Glowing Temple in Ubon Ratchathani</span> — Visit the enchanting luminous temple at night.</li>\r\n  <li><span class=\"fw-bold\">Tad Fane Waterfalls (Laos)</span> — Trek & Zipline adventure over twin waterfalls.</li>\r\n  <li><span class=\"fw-bold\">Bolaven Plateau Coffee Trails</span> — Taste Laos\' best coffee straight from the plantation.</li>\r\n</ul>\r\n<h4 class=\"fw-bold text-success mt-4\">What\'s Included:</h4>\r\n<ul class=\"list-unstyled ps-3\">\r\n  <li>✔️ Private air-conditioned van & English-speaking guide</li>\r\n  <li>✔️ All entrance tickets, trekking permits & activity fees</li>\r\n  <li>✔️ Accommodation 8 nights (twin-share, 3-4 star hotels & resorts)</li>\r\n  <li>✔️ Zipline equipment & professional guides for safety</li>\r\n  <li>✔️ Complimentary bottled water & cold towels on board</li>\r\n</ul>\r\n<p class=\"mt-3\"><strong>Perfect For:</strong> Adventure seekers, nature lovers, and cultural explorers wanting an immersive Thailand-Laos journey.</p>\r\n<h5 class=\"fw-bold text-warning mt-4\">Important Notes:</h5>\r\n<ul class=\"ps-3\">\r\n  <li>❗ Visa requirements may apply for Laos (we’ll assist with the process).</li>\r\n  <li>❗ No domestic flights — Overland travel by private van throughout the tour.</li>\r\n  <li>❗ Moderate physical fitness recommended for trekking & zipline activities.</li>\r\n</ul>\r\n<p class=\"mt-3\"><strong>Tour Duration:</strong> 9 Days 8 Nights</p>\r\n<p><strong>Tour Style:</strong> Private Exclusive | Group forming available upon request.</p>','<div class=\"card border-0 mb-4\">\r\n  <div class=\"card-body p-0\">\r\n    <div class=\"mb-3\">\r\n      <h5 class=\"fw-bold text-primary\">Day 1: Bangkok Arrival & Welcome Briefing</h5>\r\n      <ul class=\"ps-4\">\r\n        <li>17:00 Meet & greet at your hotel in Bangkok.</li>\r\n        <li>Evening tuk-tuk street food tour through vibrant night markets.</li>\r\n      </ul>\r\n    </div>\r\n    <div class=\"mb-3\">\r\n      <h5 class=\"fw-bold text-primary\">Day 2: Bangkok → Ayutthaya Ancient City</h5>\r\n      <ul class=\"ps-4\">\r\n        <li>Morning bicycle ride through Ayutthaya\'s historic island.</li>\r\n        <li>Visit local floating market & riverside temples.</li>\r\n        <li>Overnight in Ayutthaya.</li>\r\n      </ul>\r\n    </div>\r\n    <div class=\"mb-3\">\r\n      <h5 class=\"fw-bold text-primary\">Day 3: Ayutthaya → Khao Yai National Park</h5>\r\n      <ul class=\"ps-4\">\r\n        <li>Scenic drive via Saraburi\'s old wood markets.</li>\r\n        <li>Enter Khao Yai & explore the visitor center.</li>\r\n        <li>Evening: Relax at resort in Khao Yai.</li>\r\n      </ul>\r\n    </div>\r\n    <div class=\"mb-3\">\r\n      <h5 class=\"fw-bold text-primary\">Day 4: Khao Yai Jungle Trek & Night Safari</h5>\r\n      <ul class=\"ps-4\">\r\n        <li>Guided jungle trek to Orchid Cliff & Haew Suwat Waterfall.</li>\r\n        <li>Wildlife spotting along nature trails.</li>\r\n        <li>Evening: Khao Yai Night Safari adventure.</li>\r\n      </ul>\r\n    </div>\r\n    <div class=\"mb-3\">\r\n      <h5 class=\"fw-bold text-primary\">Day 5: Khao Yai → Phanom Rung & Muang Tam (Buriram)</h5>\r\n      <ul class=\"ps-4\">\r\n        <li>Travel to Buriram province.</li>\r\n        <li>Visit Phanom Rung Historical Park & Muang Tam Khmer Temples.</li>\r\n        <li>Overnight in Buriram.</li>\r\n      </ul>\r\n    </div>\r\n    <div class=\"mb-3\">\r\n      <h5 class=\"fw-bold text-primary\">Day 6: Buriram → Ubon Ratchathani — Glowing Temple</h5>\r\n      <ul class=\"ps-4\">\r\n        <li>Cross rice field landscapes of Isaan.</li>\r\n        <li>Visit Sirindhorn Wararam Phu Prao Temple (Glowing Temple) at sunset.</li>\r\n        <li>Overnight in Ubon Ratchathani.</li>\r\n      </ul>\r\n    </div>\r\n    <div class=\"mb-3\">\r\n      <h5 class=\"fw-bold text-primary\">Day 7: Cross to Laos — Pakse & Tad Fane Waterfalls</h5>\r\n      <ul class=\"ps-4\">\r\n        <li>Morning border crossing at Chong Mek.</li>\r\n        <li>Visit Pakse morning market.</li>\r\n        <li>Head to Bolaven Plateau for Tad Fane twin waterfalls.</li>\r\n        <li>Enjoy zipline adventure over the falls.</li>\r\n        <li>Overnight at Tad Fane Resort.</li>\r\n      </ul>\r\n    </div>\r\n    <div class=\"mb-3\">\r\n      <h5 class=\"fw-bold text-primary\">Day 8: Coffee Trails & Waterfalls (Laos)</h5>\r\n      <ul class=\"ps-4\">\r\n        <li>Explore Bolaven Plateau coffee plantations.</li>\r\n        <li>Visit Tad Yuang & Tad Champee Waterfalls.</li>\r\n        <li>Optional: Local handicraft & soap-making workshops.</li>\r\n        <li>Overnight in Pakse.</li>\r\n      </ul>\r\n    </div>\r\n    <div>\r\n      <h5 class=\"fw-bold text-primary\">Day 9: Return to Thailand</h5>\r\n      <ul class=\"ps-4\">\r\n        <li>Cross border back to Thailand via Chong Mek.</li>\r\n        <li>Drop-off at Ubon Ratchathani Airport or Bus Terminal.</li>\r\n      </ul>\r\n    </div>\r\n  </div>\r\n</div>','Q: How strenuous is the tour?\nA: Moderate. Includes light trekking, cycling, and ziplining. Suitable for travelers with basic fitness.\n\nQ: Are meals included?\nA: Breakfast is included daily. Some lunches/dinners are included — your guide will also recommend authentic local restaurants.\n\nQ: What should I bring?\nA: Comfortable walking shoes, light jacket, swimwear, insect repellent, and passport for Lao border crossing.\n\nQ: Do I need a visa for Laos?\nA: Most nationalities can get a visa on arrival at the Chong Mek border. Please check your country’s requirements.\n\nQ: Is accommodation included?\nA: Yes, 8 nights in carefully selected hotels/resorts with private bathrooms.',NULL,NULL,NULL,NULL,0,'2025-07-31 05:43:13','2025-08-04 03:22:27','Bangkok',NULL),(4,'Eastern Thailand Discovery: Pattaya & Chanthaburi Coastal Culture Adventure','floating-market-railway-tour.jpg','eastern-thailand-discovery.jpg','series','Eastern of Thailand','Bangkok','Bangkok',0.00,2900.00,NULL,NULL,'','3 days 2 nights',' Eastern Thailand Discovery: Pattaya & Chanthaburi Coastal Culture Adventure\r\nImmerse yourself in the charm of Thailand’s Eastern region through a slow-paced, cultural, and authentic local experience. Perfect for travelers seeking a relaxing yet vibrant journey filled with nature, heritage, arts, and amazing seafood feasts.\r\n✨ Tour Highlights:\r\n The Sanctuary of Truth – Magnificent hand-carved wooden temple by the sea.\r\n Nong Nooch Tropical Garden – World-class botanical garden and cultural shows.\r\n Fruit Orchard Tour (Seasonal) – All-you-can-eat tropical fruits straight from the farm.\r\n Old Chanthaboon Waterfront Community – Charming old town, artsy cafes, and local crafts.\r\n Mangrove Boardwalk – Nature walk along the eco-reserve.\r\n Relaxation time on the serene beaches of Pattaya & Chanthaburi.\r\n',' Sample Itinerary\r\n Day 1: Bangkok → Pattaya — Culture & Sea\r\n08:00 — Meet at Bangkok Hotel and depart for Pattaya.\r\n09:30 — Visit The Sanctuary of Truth, a massive wooden marvel.\r\n12:00 — Seafood lunch by the beach.\r\n14:00 — Choose between Nong Nooch Tropical Garden or free beach time.\r\n17:00 — Hotel Check-in & Relax.\r\n19:00 — Dinner at local restaurant or hotel.\r\nOptional: Pattaya Walking Street / Cabaret Show (own expense).\r\n Day 2: Pattaya → Chanthaburi — Fruits & Local Living\r\n07:30 — Breakfast & check-out.\r\n09:30 — Visit a local seafood market for souvenirs.\r\n12:00 — Lunch by Chanthaburi coast.\r\n13:30 — Select Activity:\r\n Fruit Orchard Buffet (May-Jul)\r\n Mangrove Eco-Walk\r\n Explore Old Chanthaboon Town\r\n17:30 — Check-in at homestay/eco-lodge.\r\n19:00 — Dinner with local seafood delicacies.\r\n Day 3: Chanthaburi → Bangkok — Heritage & Shopping\r\n07:30 — Breakfast & check-out.\r\n08:30 — Visit the Immaculate Conception Cathedral.\r\n09:30 — Explore Chanthaboon Riverside Community.\r\n12:00 — Lunch at local eatery.\r\n14:00 — Stop for souvenir shopping (dried fruits & seafood).\r\n18:00 — Arrive back in Bangkok.','Q: What is included in this tour?\r\nA: Private van, English-speaking guide, accommodation (2 nights), entrance fees, 7 meals, and travel insurance.\r\nQ: Are the fruit orchard and mangrove walk included?\r\nA: Yes, you can select 1 activity per preference (seasonal availability applies).\r\nQ: Is lunch included every day?\r\nA: Yes, lunch is included for all 3 days, but some dinners are flexible for your own exploration.\r\nQ: Where will we stay?\r\nA: Carefully selected homestay/eco-lodges or 3–4 star hotels in Pattaya and Chanthaburi.\r\nQ: Are water activities extra?\r\nA: Optional water activities in Pattaya are available at your own expense.',NULL,NULL,NULL,NULL,0,'2025-07-31 05:43:13','2025-08-03 20:18:02','Bangkok',1),(5,'One Ride, One Life: Thailand – Laos – Vietnam — 3 Countries, No Regret','kanchanaburi-river-kwai-death-railway-tour.jpg','thailand-laos-vietnam-discovery-tour.jpg','series','Vietnam','Bangkok','Vietnam',0.00,2800.00,NULL,' Booking opens — confirmed once group is formed\n️ Group Dates: Oct 1–8, Oct 15–22, Nov 1–8, Nov 15–22, Dec 1–8','','8 days 7 nights',' One Ride, One Life: Thailand – Laos – Vietnam — 3 Countries, No Regret\r\nEmbark on a 9-Day, 8-Night cross-country adventure through Thailand, Laos, and Vietnam. This immersive journey blends cultural heritage, thrilling adventures, and authentic local experiences across Southeast Asia. Perfect for those seeking a unique, off-the-beaten-path experience with comfort and style.\r\n✨ Tour Highlights:\r\n– Bangkok Welcome Briefing & Street Food Night Tour\r\n– Explore Khmer Temples at Phimai Historical Park\r\n– Cross into Laos for a Tad Fane Zipline Adventure & Coffee Tasting\r\n– Slow life experience in Bolaven Plateau’s hidden waterfalls\r\n– Journey to Central Vietnam via Lao Bao Border\r\n– Hue Imperial City motorbike tour & Marble Mountains\r\n– Full-day exploration in Hoi An Ancient Town with Lantern Workshop\r\n– Private Van Service — No domestic flights required\r\n',' Day 1: Bangkok – Welcome Briefing & Street Food Adventure\r\n17:00 Meet at Bangkok Hotel for team briefing, trip Q&A, and enjoy a night Tuk Tuk ride exploring Chinatown\'s vibrant street food scene.\r\n Day 2: Bangkok → Korat\r\nVisit Phimai Historical Park and Don Toei Handicraft Village, experience Isan culture, and overnight in Korat.\r\n Day 3: Korat → Ubon Ratchathani\r\nJourney to Ubon Ratchathani, visit Sirindhorn Wararam Phu Prao Temple (Glowing Temple), and prepare for Laos border crossing.\r\n Day 4: Cross to Laos → Bolaven Plateau Zipline Adventure\r\nCross Chong Mek Border, explore Pakse, and zipline over Tad Fane Waterfalls.\r\n Day 5: Bolaven Slow Life Day\r\nRelax with coffee plantation tours, hidden waterfalls, and artisan workshops in the serene Bolaven Plateau.\r\n Day 6: Bolaven → Cross to Vietnam → Hue City\r\nCross Lao Bao Border, drive through central Vietnam, and overnight in Hue.\r\n Day 7: Hue → Danang → Hoi An\r\nImperial City motorbike tour, Hai Van Pass, Marble Mountain, and enter Hoi An for an evening stroll.\r\n Day 8: Full Day Hoi An Exploration\r\nLantern making workshop, market visits, (optional) cooking class, and farewell dinner along the river.\r\n Day 9: Departure from Danang (DAD)\r\nTransfer to Danang Airport after breakfast.\r\n','\r\nQ: Do I need a visa for Laos and Vietnam?\r\nA: Visa requirements depend on your nationality. Our team will assist with border crossing procedures.\r\nQ: Is domestic flight included?\r\nA: No flights are needed. This is a full overland tour with private van service.\r\nQ: How difficult is the zipline adventure?\r\nA: Moderate fitness is required. Safety equipment and briefings will be provided.\r\nQ: Can I leave from Hanoi or Ho Chi Minh City?\r\nA: The tour ends in Danang. Extensions to Hanoi or Ho Chi Minh can be arranged separately.\r\n',NULL,NULL,NULL,NULL,0,'2025-07-31 05:43:13','2025-08-03 21:24:19','Bangkok',NULL),(6,'Ayutthaya Ancient City, World Heritage and the Lost Empire Discovery','roam-thailand-laos-adventure-tour.jpg','ayutthaya-ancient-city-temples-tour.jpg','fullday','Ayutthaya','Bangkok','Bangkok',0.00,2700.00,NULL,NULL,NULL,NULL,'\r\n **Ayutthaya Ancient City, World Heritage and the Lost Empire Discovery**  \r\nStep into Thailand’s Golden Age!  \r\nEmbark on a full-day private tour to Ayutthaya, the ancient capital of Siam. Witness towering temples, majestic Buddha statues, and experience life along the scenic riverfront with a long-tail boat ride.\r\n✨ **Tour Highlights:**  \r\n **Wat Yai Chai Mongkol** — Iconic chedi with the massive Reclining Buddha.  \r\n **Wat Luang Phor To (หลวงพ่อโต)** — Revered giant seated Buddha.  \r\n **Wat Ratchaburana** — Ancient temple ruins & pagodas.  \r\n **Wat Mongkhon Bophit** — Home to one of Thailand’s largest bronze Buddha statues.  \r\n **Scenic Boat Ride** — Cruise around Ayutthaya Island to see the historic city from the water.\r\n✅ **What’s Included:**  \r\n Hotel Pickup & Drop-off within Bangkok  \r\n Private Air-Conditioned Van & English-speaking Guide  \r\n Entrance Tickets to All Sites  \r\n Scenic Boat Tour around Ayutthaya Island  \r\n Complimentary Drinking Water & Cold Towel Service\r\n⚠️ **Important Notes:**  \r\n Modest clothing is required for temple visits (long pants, covered shoulders).  \r\n️ Lunch is not included — your guide will recommend the Michelin Star Pad Thai Restaurant (own expense).  \r\n Tour Duration: Approx. 10 Hours (07:30 – 18:00).  \r\n Private Tour Only — No join-in groups.\r\n','\r\n07:30 — Hotel Pickup in Bangkok  \r\n09:00 — Visit Wat Yai Chai Mongkol  \r\n10:00 — Visit Wat Luang Phor To (หลวงพ่อโต)  \r\n11:00 — Explore Wat Ratchaburana  \r\n12:00 — Visit Wat Mongkhon Bophit  \r\n13:00 — Enjoy Michelin Star Pad Thai Lunch (own expense)  \r\n14:30 — Scenic Boat Tour around Ayutthaya Island  \r\n16:00 — Depart Ayutthaya, Return to Bangkok  \r\n18:00 — Drop-off at Hotel\r\n','\r\nQ: What should I wear?  \r\nA: Comfortable casual wear. Modest clothing for temple visits (long pants, covered shoulders).\r\nQ: Is lunch included?  \r\nA: Lunch is not included. Your guide will recommend the Michelin Star Pad Thai Restaurant.\r\nQ: Will the tour operate in case of rain?  \r\nA: Yes, the tour operates rain or shine. Please bring an umbrella or raincoat.\r\n',NULL,NULL,NULL,NULL,0,'2025-07-31 20:28:14','2025-08-03 19:40:26',NULL,1),(7,'River Kwai, Death Railway, Hell Fire & WW2 Memorial Adventure','thailand-laos-vietnam-discovery-tour.jpg','kanchanaburi-river-kwai-death-railway-tour.jpg','series','Kanchanaburi','Bangkok','Bangkok',0.00,2900.00,NULL,NULL,NULL,'3 days 2 nights',' River Kwai, Death Railway, Hellfire Pass & Floating Jungle Raft Adventure — 3 Days 2 Nights\r\nEmbark on a historic and nature-filled private tour exploring Kanchanaburi’s World War II heritage and serene natural wonders. Ride the famous Death Railway, trek the Hellfire Pass, marvel at Erawan Waterfalls, and stay on a floating jungle raft house.\r\n✨ Tour Highlights:\r\n River Kwai Bridge — Walk on the legendary bridge over the River Kwai.\r\n Death Railway Train Ride — Scenic train journey across wooden trestles to Tham Krasae Cave.\r\n Hellfire Pass — Emotional walk through WWII Memorial Trail & Museum.\r\n Erawan Waterfall — Explore 7 tiers of crystal-clear emerald pools.\r\n��️ Stay at Floating Jungle Raft House — A unique riverfront resort experience.\r\n️ JEATH War Museum & Kanchanaburi Cemetery — Tribute to WWII POWs.\r\n✅ What’s Included:\r\n✔️ Private air-conditioned van & English-speaking guide\r\n✔️ All entrance tickets and activity fees\r\n✔️ Death Railway Train Ride ticket\r\n✔️ Boat transfers to Floating Raft House\r\n✔️ 2 Nights Accommodation (1 night city hotel, 1 night floating house)\r\n✔️ Complimentary drinking water & cold towel service\r\n⚠️ Important Notes:\r\n- Lunch & Dinner not included — guide will recommend great local restaurants.\r\n- Moderate walking required, especially at Hellfire Pass and Erawan Falls.\r\n- Private Tour Only — No join-in groups.\r\n','️ Day 1:\r\n08:00 — Pickup from Bangkok hotel\r\n10:00 — Visit River Kwai Bridge\r\n10:30 — Death Railway Train Ride to Tham Krasae Cave\r\n12:00 — Lunch & transfer to Hellfire Pass\r\n13:30 — Visit Hellfire Pass & Memorial Museum\r\n16:00 — Check-in City Hotel in Kanchanaburi (Free Evening)\r\n️ Day 2:\r\n09:00 — Depart hotel to Erawan Waterfall\r\n10:00 — Explore Erawan Waterfall (7 tiers)\r\n13:00 — Lunch & transfer to Jungle Raft House Pier\r\n15:00 — Boat transfer to Floating Jungle Raft House\r\n16:00 — Check-in & relax\r\n️ Day 3:\r\n09:00 — Checkout & boat transfer back to pier\r\n10:00 — Visit Kanchanaburi War Cemetery\r\n11:00 — Visit JEATH Museum\r\n12:30 — Lunch (own expense)\r\n13:30 — Depart for Bangkok\r\n17:00 — Drop-off at your hotel\r\n','Q: What should I bring?\r\nA: Comfortable shoes, swimwear for waterfalls, sunscreen, and insect repellent.\r\nQ: Are meals included?\r\nA: Breakfast is included at hotels. Lunch and dinner are at own expense.\r\nQ: Is this a private tour?\r\nA: Yes, this is an exclusive private tour with your own guide and van.\r\nQ: Can I extend my stay at the floating raft house?\r\nA: Yes, please inform us in advance for arrangements.\r\n',NULL,NULL,NULL,NULL,0,'2025-07-31 20:29:02','2025-08-03 19:55:58',NULL,1);
/*!40000 ALTER TABLE `tours` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Test User','test@example.com','2025-06-24 22:35:44','$2y$12$b3U/Gfs8qj382tqDmtrYBuPmmks33yL1H4ZzkJ/UEX7q1jVm/DwJu','CgGc9u9RHN','2025-06-24 22:35:44','2025-06-24 22:35:44');
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

-- Dump completed on 2025-08-08 14:57:22
