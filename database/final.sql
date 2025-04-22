-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: fast-food-shop-nguyenhoanghiep478-9317.j.aivencloud.com    Database: defaultdb
-- ------------------------------------------------------
-- Server version	8.0.35

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
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;
SET @@SESSION.SQL_LOG_BIN= 0;

--
-- GTID state at the beginning of the backup 
--



--
-- Table structure for table `categories`
--
use duanweb2;
DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `images_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status` tinyint DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES ('40d72ee9-1389-11f0-ab99-6ef87da1f643','ASDASDASDASD','asd','2025-04-07 08:21:06','/duanweb2/public/images/categories/asdasdasdasd.jpg',NULL),('867ea50f-1389-11f0-ab99-6ef87da1f643','DSASDSAAASSSAAA','asdasdasd','2025-04-07 08:23:03','/duanweb2/public/images/categories/dsasdsaaasssaaa.jpg',NULL),('993e6b00-137f-11f0-ab99-6ef87da1f643','dasadsad','1  hello ','2025-04-07 07:12:00','/duanweb2/public/images/categories/dasadsad.png',NULL),('a6ab0397-0c45-11f0-ab99-6ef87da1f643','Fast FOOD ','sadsa\nsá','2025-03-29 02:29:33','https://t4.ftcdn.net/jpg/02/74/99/01/360_F_274990113_ffVRBygLkLCZAATF9lWymzE6bItMVuH1.jpg',NULL),('a6ae6cac-0c45-11f0-ab99-6ef87da1f643','Beverages','Soft drinks, coffee, and juicesasdsa','2025-03-29 02:29:33','https://t4.ftcdn.net/jpg/02/74/99/01/360_F_274990113_ffVRBygLkLCZAATF9lWymzE6bItMVuH1.jpg',NULL),('a6b130e3-0c45-11f0-ab99-6ef87da1f643','Desserts','Cakes, ice cream, and sweet dishes','2025-03-29 02:29:33','https://t4.ftcdn.net/jpg/02/74/99/01/360_F_274990113_ffVRBygLkLCZAATF9lWymzE6bItMVuH1.jpg',1),('a6b1347f-0c45-11f0-ab99-6ef87da1f643','Asian Cuisine','Chinese, Japanese, and Thai foodddsada','2025-03-29 02:29:33','https://t4.ftcdn.net/jpg/02/74/99/01/360_F_274990113_ffVRBygLkLCZAATF9lWymzE6bItMVuH1.jpg',NULL),('a6b13539-0c45-11f0-ab99-6ef87da1f643','Italian Cuisine','Pizza, pasta, and risotto','2025-03-29 02:29:33','https://t4.ftcdn.net/jpg/02/74/99/01/360_F_274990113_ffVRBygLkLCZAATF9lWymzE6bItMVuH1.jpg',1),('a6b240cd-0c45-11f0-ab99-6ef87da1f643','Vegetarian','Plant-based and vegetarian meals','2025-03-29 02:29:33','https://t4.ftcdn.net/jpg/02/74/99/01/360_F_274990113_ffVRBygLkLCZAATF9lWymzE6bItMVuH1.jpg',1),('a6b2ec69-0c45-11f0-ab99-6ef87da1f643','Seafood','Fish, shrimp, and other seafood','2025-03-29 02:29:33','https://t4.ftcdn.net/jpg/02/74/99/01/360_F_274990113_ffVRBygLkLCZAATF9lWymzE6bItMVuH1.jpg',1),('a6b2eea9-0c45-11f0-ab99-6ef87da1f643','BBQ & Grilled','Grilled meat, BBQ, and smoked dishes','2025-03-29 02:29:33','https://t4.ftcdn.net/jpg/02/74/99/01/360_F_274990113_ffVRBygLkLCZAATF9lWymzE6bItMVuH1.jpg',1),('a6b2ef83-0c45-11f0-ab99-6ef87da1f643','Healthy Food','Salads, low-calorie meals, and healthy snacks','2025-03-29 02:29:33','https://t4.ftcdn.net/jpg/02/74/99/01/360_F_274990113_ffVRBygLkLCZAATF9lWymzE6bItMVuH1.jpg',1),('cd630086-1389-11f0-ab99-6ef87da1f643','dasdasdasdasd','asdasdasdasd','2025-04-07 08:25:02','/duanweb2/public/images/categories/dasdasdasdasd.jpg',NULL),('ee441557-1389-11f0-ab99-6ef87da1f643','asdasdddssssaaa','asdddsssaaa','2025-04-07 08:25:57','/duanweb2/public/images/categories/asdasdddssssaaa.',NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupon_usages`
--

DROP TABLE IF EXISTS `coupon_usages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coupon_usages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `coupon_id` int DEFAULT NULL,
  `user_id` varchar(64) DEFAULT NULL,
  `used_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `coupon_id` (`coupon_id`),
  CONSTRAINT `coupon_usages_ibfk_1` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupon_usages`
--

LOCK TABLES `coupon_usages` WRITE;
/*!40000 ALTER TABLE `coupon_usages` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupon_usages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coupons` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `code` varchar(50) NOT NULL,
  `description` text,
  `discount_type` enum('percentage','fixed','free_shipping') DEFAULT NULL,
  `discount_amount` decimal(10,2) DEFAULT NULL,
  `valid_from` date DEFAULT NULL,
  `valid_until` date DEFAULT NULL,
  `minimum_spend` decimal(10,2) DEFAULT NULL,
  `maximum_spend` decimal(10,2) DEFAULT NULL,
  `usage_limit` int DEFAULT NULL,
  `usage_limit_per_user` int DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
INSERT INTO `coupons` VALUES (1,'Giảm giá cực mạnh','XWFWYV76','','percentage',5.00,'2025-04-13','2025-10-13',100000.00,200000.00,100,1,1,'2025-04-13 13:10:30','2025-04-13 13:50:42');
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
  `id` char(36) NOT NULL,
  `order_id` char(36) NOT NULL,
  `product_id` char(36) NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_chk_1` CHECK ((`quantity` > 0)),
  CONSTRAINT `order_items_chk_2` CHECK ((`price` > 0))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES ('13f8ea53-1b9d-11f0-ab99-6ef87da1f643','139db8da-1b9d-11f0-ab99-6ef87da1f643','1506674e-0c46-11f0-ab99-6ef87da1f643',1,6.00),('140f2c1b-1b9d-11f0-ab99-6ef87da1f643','139db8da-1b9d-11f0-ab99-6ef87da1f643','1506cdbd-0c46-11f0-ab99-6ef87da1f643',2,4.00),('14253dd1-1b9d-11f0-ab99-6ef87da1f643','139db8da-1b9d-11f0-ab99-6ef87da1f643','1506d44a-0c46-11f0-ab99-6ef87da1f643',1,7.00),('1cdf85ab-1af3-11f0-ab99-6ef87da1f643','1c8877b7-1af3-11f0-ab99-6ef87da1f643','1506674e-0c46-11f0-ab99-6ef87da1f643',4,6.00),('1cf50f96-1af3-11f0-ab99-6ef87da1f643','1c8877b7-1af3-11f0-ab99-6ef87da1f643','1506cdbd-0c46-11f0-ab99-6ef87da1f643',1,4.00),('1d0b6ef8-1af3-11f0-ab99-6ef87da1f643','1c8877b7-1af3-11f0-ab99-6ef87da1f643','1506da13-0c46-11f0-ab99-6ef87da1f643',1,10.00),('1d2113a3-1af3-11f0-ab99-6ef87da1f643','1c8877b7-1af3-11f0-ab99-6ef87da1f643','1506d7a0-0c46-11f0-ab99-6ef87da1f643',1,13.00),('4bea8b18-1ba1-11f0-ab99-6ef87da1f643','4b8da499-1ba1-11f0-ab99-6ef87da1f643','1506cdbd-0c46-11f0-ab99-6ef87da1f643',2,4.00),('4c050dd2-1ba1-11f0-ab99-6ef87da1f643','4b8da499-1ba1-11f0-ab99-6ef87da1f643','5c7bdf45-0ea0-11f0-ab99-6ef87da1f643',2,74682.00),('918edae0-1ba5-11f0-ab99-6ef87da1f643','913b3b87-1ba5-11f0-ab99-6ef87da1f643','1506674e-0c46-11f0-ab99-6ef87da1f643',3,6.00),('91a3ebb2-1ba5-11f0-ab99-6ef87da1f643','913b3b87-1ba5-11f0-ab99-6ef87da1f643','1506cdbd-0c46-11f0-ab99-6ef87da1f643',2,4.00),('91b8c653-1ba5-11f0-ab99-6ef87da1f643','913b3b87-1ba5-11f0-ab99-6ef87da1f643','1506d44a-0c46-11f0-ab99-6ef87da1f643',3,7.00),('93a88bfa-1ba5-11f0-ab99-6ef87da1f643','935638e7-1ba5-11f0-ab99-6ef87da1f643','1506674e-0c46-11f0-ab99-6ef87da1f643',3,6.00),('93bd1d1a-1ba5-11f0-ab99-6ef87da1f643','935638e7-1ba5-11f0-ab99-6ef87da1f643','1506cdbd-0c46-11f0-ab99-6ef87da1f643',2,4.00),('93d1c870-1ba5-11f0-ab99-6ef87da1f643','935638e7-1ba5-11f0-ab99-6ef87da1f643','1506d44a-0c46-11f0-ab99-6ef87da1f643',3,7.00),('961b583e-1ba5-11f0-ab99-6ef87da1f643','95b6ed95-1ba5-11f0-ab99-6ef87da1f643','1506674e-0c46-11f0-ab99-6ef87da1f643',3,6.00),('963280b5-1ba5-11f0-ab99-6ef87da1f643','95b6ed95-1ba5-11f0-ab99-6ef87da1f643','1506cdbd-0c46-11f0-ab99-6ef87da1f643',2,4.00),('96498d9b-1ba5-11f0-ab99-6ef87da1f643','95b6ed95-1ba5-11f0-ab99-6ef87da1f643','1506d44a-0c46-11f0-ab99-6ef87da1f643',3,7.00),('97b0efa0-1b9d-11f0-ab99-6ef87da1f643','9755ddca-1b9d-11f0-ab99-6ef87da1f643','1506cdbd-0c46-11f0-ab99-6ef87da1f643',2,4.00),('98aa3567-1ba5-11f0-ab99-6ef87da1f643','9856ba17-1ba5-11f0-ab99-6ef87da1f643','1506674e-0c46-11f0-ab99-6ef87da1f643',3,6.00),('98bf240b-1ba5-11f0-ab99-6ef87da1f643','9856ba17-1ba5-11f0-ab99-6ef87da1f643','1506cdbd-0c46-11f0-ab99-6ef87da1f643',2,4.00),('98d40483-1ba5-11f0-ab99-6ef87da1f643','9856ba17-1ba5-11f0-ab99-6ef87da1f643','1506d44a-0c46-11f0-ab99-6ef87da1f643',3,7.00),('9b03c025-1ba5-11f0-ab99-6ef87da1f643','9aafd9fc-1ba5-11f0-ab99-6ef87da1f643','1506674e-0c46-11f0-ab99-6ef87da1f643',3,6.00),('9b188118-1ba5-11f0-ab99-6ef87da1f643','9aafd9fc-1ba5-11f0-ab99-6ef87da1f643','1506cdbd-0c46-11f0-ab99-6ef87da1f643',2,4.00),('9b2d57bd-1ba5-11f0-ab99-6ef87da1f643','9aafd9fc-1ba5-11f0-ab99-6ef87da1f643','1506d44a-0c46-11f0-ab99-6ef87da1f643',3,7.00),('ad531622-1ba0-11f0-ab99-6ef87da1f643','acf30735-1ba0-11f0-ab99-6ef87da1f643','1506cdbd-0c46-11f0-ab99-6ef87da1f643',2,4.00),('ae23682d-1ba5-11f0-ab99-6ef87da1f643','add054d3-1ba5-11f0-ab99-6ef87da1f643','1506674e-0c46-11f0-ab99-6ef87da1f643',3,6.00),('ae37ff37-1ba5-11f0-ab99-6ef87da1f643','add054d3-1ba5-11f0-ab99-6ef87da1f643','1506cdbd-0c46-11f0-ab99-6ef87da1f643',2,4.00),('ae4cbccf-1ba5-11f0-ab99-6ef87da1f643','add054d3-1ba5-11f0-ab99-6ef87da1f643','1506d44a-0c46-11f0-ab99-6ef87da1f643',3,7.00),('b03c71e6-1ba5-11f0-ab99-6ef87da1f643','afe93ec0-1ba5-11f0-ab99-6ef87da1f643','1506674e-0c46-11f0-ab99-6ef87da1f643',3,6.00),('b0515e00-1ba5-11f0-ab99-6ef87da1f643','afe93ec0-1ba5-11f0-ab99-6ef87da1f643','1506cdbd-0c46-11f0-ab99-6ef87da1f643',2,4.00),('b06622a6-1ba5-11f0-ab99-6ef87da1f643','afe93ec0-1ba5-11f0-ab99-6ef87da1f643','1506d44a-0c46-11f0-ab99-6ef87da1f643',3,7.00),('b80628a0-1ba5-11f0-ab99-6ef87da1f643','b7b193ef-1ba5-11f0-ab99-6ef87da1f643','1506674e-0c46-11f0-ab99-6ef87da1f643',3,6.00),('b81b2690-1ba5-11f0-ab99-6ef87da1f643','b7b193ef-1ba5-11f0-ab99-6ef87da1f643','1506cdbd-0c46-11f0-ab99-6ef87da1f643',2,4.00),('b8302483-1ba5-11f0-ab99-6ef87da1f643','b7b193ef-1ba5-11f0-ab99-6ef87da1f643','1506d44a-0c46-11f0-ab99-6ef87da1f643',3,7.00),('ba2a90d7-1ba5-11f0-ab99-6ef87da1f643','b9d5c8db-1ba5-11f0-ab99-6ef87da1f643','1506674e-0c46-11f0-ab99-6ef87da1f643',3,6.00),('ba3f63da-1ba5-11f0-ab99-6ef87da1f643','b9d5c8db-1ba5-11f0-ab99-6ef87da1f643','1506cdbd-0c46-11f0-ab99-6ef87da1f643',2,4.00),('ba543fbe-1ba5-11f0-ab99-6ef87da1f643','b9d5c8db-1ba5-11f0-ab99-6ef87da1f643','1506d44a-0c46-11f0-ab99-6ef87da1f643',3,7.00),('ccfddc3d-1b9d-11f0-ab99-6ef87da1f643','cc9fb7d1-1b9d-11f0-ab99-6ef87da1f643','1506cdbd-0c46-11f0-ab99-6ef87da1f643',2,4.00),('d1417114-1af2-11f0-ab99-6ef87da1f643','d0e97fd2-1af2-11f0-ab99-6ef87da1f643','1506674e-0c46-11f0-ab99-6ef87da1f643',4,6.00),('d1577542-1af2-11f0-ab99-6ef87da1f643','d0e97fd2-1af2-11f0-ab99-6ef87da1f643','1506cdbd-0c46-11f0-ab99-6ef87da1f643',1,4.00),('d16db50b-1af2-11f0-ab99-6ef87da1f643','d0e97fd2-1af2-11f0-ab99-6ef87da1f643','1506da13-0c46-11f0-ab99-6ef87da1f643',1,10.00),('d183dacf-1af2-11f0-ab99-6ef87da1f643','d0e97fd2-1af2-11f0-ab99-6ef87da1f643','1506d7a0-0c46-11f0-ab99-6ef87da1f643',1,13.00),('ea00043d-1b9d-11f0-ab99-6ef87da1f643','e9a5532d-1b9d-11f0-ab99-6ef87da1f643','1506cdbd-0c46-11f0-ab99-6ef87da1f643',4,4.00),('eab4a325-1af2-11f0-ab99-6ef87da1f643','ea5d3c3f-1af2-11f0-ab99-6ef87da1f643','1506674e-0c46-11f0-ab99-6ef87da1f643',4,6.00),('eacab954-1af2-11f0-ab99-6ef87da1f643','ea5d3c3f-1af2-11f0-ab99-6ef87da1f643','1506cdbd-0c46-11f0-ab99-6ef87da1f643',1,4.00),('eae0bcdc-1af2-11f0-ab99-6ef87da1f643','ea5d3c3f-1af2-11f0-ab99-6ef87da1f643','1506da13-0c46-11f0-ab99-6ef87da1f643',1,10.00),('eaf6f92f-1af2-11f0-ab99-6ef87da1f643','ea5d3c3f-1af2-11f0-ab99-6ef87da1f643','1506d7a0-0c46-11f0-ab99-6ef87da1f643',1,13.00),('ff42105a-1b9c-11f0-ab99-6ef87da1f643','fee9465c-1b9c-11f0-ab99-6ef87da1f643','1506674e-0c46-11f0-ab99-6ef87da1f643',1,6.00),('ff585aa6-1b9c-11f0-ab99-6ef87da1f643','fee9465c-1b9c-11f0-ab99-6ef87da1f643','1506cdbd-0c46-11f0-ab99-6ef87da1f643',2,4.00),('ff746e78-1b9c-11f0-ab99-6ef87da1f643','fee9465c-1b9c-11f0-ab99-6ef87da1f643','1506d44a-0c46-11f0-ab99-6ef87da1f643',1,7.00);
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_status`
--

DROP TABLE IF EXISTS `order_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` char(36) NOT NULL,
  `status` varchar(50) NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `order_status_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_status`
--

LOCK TABLES `order_status` WRITE;
/*!40000 ALTER TABLE `order_status` DISABLE KEYS */;
INSERT INTO `order_status` VALUES (6,'e9a5532d-1b9d-11f0-ab99-6ef87da1f643','delivering','Order status changed to delivering','2025-04-17 15:09:11'),(7,'fee9465c-1b9c-11f0-ab99-6ef87da1f643','completed','Order status changed to completed','2025-04-17 15:11:06'),(8,'e9a5532d-1b9d-11f0-ab99-6ef87da1f643','completed','Order status changed to completed','2025-04-17 15:11:35'),(9,'cc9fb7d1-1b9d-11f0-ab99-6ef87da1f643','completed','Order status changed to completed','2025-04-17 15:12:43'),(10,'acf30735-1ba0-11f0-ab99-6ef87da1f643','delivering','Order status changed to delivering','2025-04-17 15:28:59'),(11,'4b8da499-1ba1-11f0-ab99-6ef87da1f643','delivering','Order status changed to delivering','2025-04-17 15:33:24'),(12,'935638e7-1ba5-11f0-ab99-6ef87da1f643','delivering','Order status changed to delivering','2025-04-17 16:04:24'),(13,'add054d3-1ba5-11f0-ab99-6ef87da1f643','delivering','Order status changed to delivering','2025-04-17 16:04:51'),(14,'afe93ec0-1ba5-11f0-ab99-6ef87da1f643','delivering','Order status changed to delivering','2025-04-17 16:04:58');
/*!40000 ALTER TABLE `order_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` char(36) NOT NULL,
  `user_id` char(36) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('pending','preparing','delivering','completed','canceled') DEFAULT 'pending',
  `store_id` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `delivery_address_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `store_id` (`store_id`),
  KEY `fk_orders_delivery_address` (`delivery_address_id`),
  CONSTRAINT `fk_orders_delivery_address` FOREIGN KEY (`delivery_address_id`) REFERENCES `user_addresses` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_chk_1` CHECK ((`total_price` >= 0))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES ('139db8da-1b9d-11f0-ab99-6ef87da1f643','dc9ca8a2-1307-11f0-ab99-6ef87da1f643',25019.00,'delivering','ee70a51b-0c45-11f0-ab99-6ef87da1f643','2025-04-17 15:03:10','67fff6d2431fc'),('1c8877b7-1af3-11f0-ab99-6ef87da1f643','dc9ca8a2-1307-11f0-ab99-6ef87da1f643',25050.00,'completed','ee70a51b-0c45-11f0-ab99-6ef87da1f643','2025-04-16 18:46:30','67fff6d2431fc'),('4b8da499-1ba1-11f0-ab99-6ef87da1f643','dc9ca8a2-1307-11f0-ab99-6ef87da1f643',166902.00,'delivering','ee70a51b-0c45-11f0-ab99-6ef87da1f643','2025-04-17 15:33:21','67fff6d2431fc'),('913b3b87-1ba5-11f0-ab99-6ef87da1f643','dc9ca8a2-1307-11f0-ab99-6ef87da1f643',25045.00,'pending','ee70a51b-0c45-11f0-ab99-6ef87da1f643','2025-04-17 16:03:56','67fff6d2431fc'),('935638e7-1ba5-11f0-ab99-6ef87da1f643','dc9ca8a2-1307-11f0-ab99-6ef87da1f643',25045.00,'delivering','ee70a51b-0c45-11f0-ab99-6ef87da1f643','2025-04-17 16:04:00','67fff6d2431fc'),('95b6ed95-1ba5-11f0-ab99-6ef87da1f643','dc9ca8a2-1307-11f0-ab99-6ef87da1f643',25045.00,'pending','ee70a51b-0c45-11f0-ab99-6ef87da1f643','2025-04-17 16:04:04','67fff6d2431fc'),('9755ddca-1b9d-11f0-ab99-6ef87da1f643','dc9ca8a2-1307-11f0-ab99-6ef87da1f643',25007.00,'delivering','ee70a51b-0c45-11f0-ab99-6ef87da1f643','2025-04-17 15:06:51','67fff6d2431fc'),('9856ba17-1ba5-11f0-ab99-6ef87da1f643','dc9ca8a2-1307-11f0-ab99-6ef87da1f643',25045.00,'pending','ee70a51b-0c45-11f0-ab99-6ef87da1f643','2025-04-17 16:04:08','67fff6d2431fc'),('9aafd9fc-1ba5-11f0-ab99-6ef87da1f643','dc9ca8a2-1307-11f0-ab99-6ef87da1f643',25045.00,'pending','ee70a51b-0c45-11f0-ab99-6ef87da1f643','2025-04-17 16:04:12','67fff6d2431fc'),('acf30735-1ba0-11f0-ab99-6ef87da1f643','dc9ca8a2-1307-11f0-ab99-6ef87da1f643',25007.00,'delivering','ee70a51b-0c45-11f0-ab99-6ef87da1f643','2025-04-17 15:28:55','67fff6d2431fc'),('add054d3-1ba5-11f0-ab99-6ef87da1f643','dc9ca8a2-1307-11f0-ab99-6ef87da1f643',25045.00,'delivering','ee70a51b-0c45-11f0-ab99-6ef87da1f643','2025-04-17 16:04:44','67fff6d2431fc'),('afe93ec0-1ba5-11f0-ab99-6ef87da1f643','dc9ca8a2-1307-11f0-ab99-6ef87da1f643',25045.00,'delivering','ee70a51b-0c45-11f0-ab99-6ef87da1f643','2025-04-17 16:04:48','67fff6d2431fc'),('b7b193ef-1ba5-11f0-ab99-6ef87da1f643','dc9ca8a2-1307-11f0-ab99-6ef87da1f643',25045.00,'pending','ee70a51b-0c45-11f0-ab99-6ef87da1f643','2025-04-17 16:05:01','67fff6d2431fc'),('b9d5c8db-1ba5-11f0-ab99-6ef87da1f643','dc9ca8a2-1307-11f0-ab99-6ef87da1f643',25045.00,'pending','ee70a51b-0c45-11f0-ab99-6ef87da1f643','2025-04-17 16:05:04','67fff6d2431fc'),('cc9fb7d1-1b9d-11f0-ab99-6ef87da1f643','dc9ca8a2-1307-11f0-ab99-6ef87da1f643',25007.00,'completed','ee70a51b-0c45-11f0-ab99-6ef87da1f643','2025-04-17 15:08:20','67fff6d2431fc'),('d0e97fd2-1af2-11f0-ab99-6ef87da1f643','dc9ca8a2-1307-11f0-ab99-6ef87da1f643',25050.00,'completed','ee70a51b-0c45-11f0-ab99-6ef87da1f643','2025-04-16 18:44:23','67fff6d2431fc'),('e9a5532d-1b9d-11f0-ab99-6ef87da1f643','dc9ca8a2-1307-11f0-ab99-6ef87da1f643',25014.00,'completed','ee70a51b-0c45-11f0-ab99-6ef87da1f643','2025-04-17 15:09:09','67fff6d2431fc'),('ea5d3c3f-1af2-11f0-ab99-6ef87da1f643','dc9ca8a2-1307-11f0-ab99-6ef87da1f643',50.00,'completed','ee70a51b-0c45-11f0-ab99-6ef87da1f643','2025-04-16 18:45:06','67fff6d2431fc'),('fee9465c-1b9c-11f0-ab99-6ef87da1f643','dc9ca8a2-1307-11f0-ab99-6ef87da1f643',25019.00,'completed','ee70a51b-0c45-11f0-ab99-6ef87da1f643','2025-04-17 15:02:35','67fff6d2431fc');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `id` char(36) NOT NULL,
  `order_id` char(36) NOT NULL,
  `user_id` char(36) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` enum('cash','credit_card','momo','vnpay') NOT NULL,
  `status` enum('pending','paid','failed') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `payments_chk_1` CHECK ((`amount` >= 0))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `category_id` char(36) DEFAULT NULL,
  `image_url` text,
  `stock` int DEFAULT '100',
  `store_id` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `fk_store` (`store_id`),
  CONSTRAINT `fk_product_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `fk_store` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `products_chk_1` CHECK ((`price` > 0)),
  CONSTRAINT `products_chk_2` CHECK ((`stock` >= 0))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES ('1506674e-0c46-11f0-ab99-6ef87da1f643','Cheese Burger','Nóng hổi với lớp phô mai tan chảy béo ngậy, kẹp giữa bánh mì mềm và nhân thịt nướng đậm đà, quyến rũ từ ánh nhìn đến hương vị.',5.99,'a6ab0397-0c45-11f0-ab99-6ef87da1f643','/duanweb2/public/images/cheeseburger.jpg',59,'ee70a51b-0c45-11f0-ab99-6ef87da1f643','2025-03-29 02:32:38',1),('1506cdbd-0c46-11f0-ab99-6ef87da1f643','Latte','Lớp bọt sữa mịn màng, quyện cùng hương cà phê nồng nàn, mang đến cảm giác ấm áp và thư giãn trong từng ngụm.',3.50,'a6ae6cac-0c45-11f0-ab99-6ef87da1f643','/duanweb2/public/images/latte.jpg',13,'ee70d020-0c45-11f0-ab99-6ef87da1f643','2025-03-29 02:32:38',1),('1506d44a-0c46-11f0-ab99-6ef87da1f643','Chocolate Cake','Cốt bánh ẩm mịn quyện cùng lớp kem socola béo ngậy, ngọt ngào và đầy mê hoặc trong từng lớp bánh.',6.99,'a6b130e3-0c45-11f0-ab99-6ef87da1f643','/duanweb2/public/images/chocolatecake.jpg',1,'ee70d4b8-0c45-11f0-ab99-6ef87da1f643','2025-03-29 02:32:38',1),('1506d7a0-0c46-11f0-ab99-6ef87da1f643','Grilled Salmon','Cá hồi nướng chín vàng, thơm lừng mùi khói, thịt cá mềm béo tan chảy, hòa quyện cùng lớp da giòn rụm đầy hấp dẫn.',12.99,'a6b2ec69-0c45-11f0-ab99-6ef87da1f643','/duanweb2/public/images/grilledsalmon.jpg',17,'ee70d56e-0c45-11f0-ab99-6ef87da1f643','2025-03-29 02:32:38',1),('1506da13-0c46-11f0-ab99-6ef87da1f643','Pepperoni Pizza','Lớp phô mai kéo sợi béo ngậy, phủ đầy lát pepperoni cay nhẹ, giòn rụm, lan tỏa hương thơm khó cưỡng trong từng miếng bánh.',9.99,'a6b13539-0c45-11f0-ab99-6ef87da1f643','/duanweb2/public/images/pizza.jpg',37,'ee70d608-0c45-11f0-ab99-6ef87da1f643','2025-03-29 02:32:38',1),('160459ce-0c46-11f0-ab99-6ef87da1f643','Kebab','Nóng giòn, kẹp đầy thịt nướng thơm lừng, rau củ tươi mát và nước sốt đậm đà, tạo nên hương vị hài hòa khó cưỡng trong từng miếng cắn.',3.50,'a6ae6cac-0c45-11f0-ab99-6ef87da1f643','/duanweb2/public/images/kebab.jpg',50,'ee70d020-0c45-11f0-ab99-6ef87da1f643','2025-03-29 02:32:40',1),('16045e69-0c46-11f0-ab99-6ef87da1f643','Beef Steak','Thịt bò được nướng vừa chín tới, mềm mọng, lớp ngoài vàng xém giòn, hòa quyện cùng gia vị đậm đà, mang đến một bữa ăn đầy đẳng cấp và hấp dẫn.',6.99,'a6b130e3-0c45-11f0-ab99-6ef87da1f643','/duanweb2/public/images/beefsteak.jpg',30,'ee70d4b8-0c45-11f0-ab99-6ef87da1f643','2025-03-29 02:32:40',1),('160460e8-0c46-11f0-ab99-6ef87da1f643','Xúc Xích','Vàng óng, thơm lừng, lớp vỏ giòn nhẹ bao bọc phần nhân đậm đà, béo ngậy, mang đến hương vị hấp dẫn khó quên trong mỗi lần thưởng thức.',12.99,'a6b2ec69-0c45-11f0-ab99-6ef87da1f643','/duanweb2/public/images/xucxich.webp',20,'ee70d56e-0c45-11f0-ab99-6ef87da1f643','2025-03-29 02:32:40',1),('16046336-0c46-11f0-ab99-6ef87da1f643','Cánh Gà','Giòn rụm, áo đều lớp sốt mặn ngọt đậm đà, thơm nức mùi tỏi phi, khiến ai nếm thử cũng phải xuýt xoa vì quá đỗi hấp dẫn.',9.99,'a6b13539-0c45-11f0-ab99-6ef87da1f643','/duanweb2/public/images/canhga.jpg',40,'ee70d608-0c45-11f0-ab99-6ef87da1f643','2025-03-29 02:32:40',1),('5c7a6136-0ea0-11f0-ab99-6ef87da1f643','Trà Sữa Trân Châu','Ngọt dịu vị trà, hòa quyện cùng những viên trân châu dẻo dai, tạo nên hương vị ngọt ngào và vui miệng trong từng ngụm.',113000.00,'a6b2eea9-0c45-11f0-ab99-6ef87da1f643','/duanweb2/public/images/trasua.jpg',38,'ee70a51b-0c45-11f0-ab99-6ef87da1f643','2025-04-01 02:19:22',1),('5c7b494a-0ea0-11f0-ab99-6ef87da1f643','Gà Rán','Giòn rụm bên ngoài, mềm ngọt bên trong, hấp dẫn ngay từ miếng đầu tiên.',50000.00,'a6b1347f-0c45-11f0-ab99-6ef87da1f643','/duanweb2/public/images/garan.jpg',7,'ee70a51b-0c45-11f0-ab99-6ef87da1f643','2025-04-01 02:19:22',1),('5c7b570c-0ea0-11f0-ab99-6ef87da1f643','Phở Bò','Nước dùng trong veo, thơm ngát mùi quế hồi, bánh phở mềm mượt quyện cùng từng lát thịt bò tái hồng tươi ngon, làm ấm lòng từ thìa đầu tiên.',105672.00,'a6b1347f-0c45-11f0-ab99-6ef87da1f643','/duanweb2/public/images/phobo.jpg',14,'ee70a51b-0c45-11f0-ab99-6ef87da1f643','2025-04-01 02:20:21',1),('5c7bda63-0ea0-11f0-ab99-6ef87da1f643','Pizza Hải Sản','Phủ đầy tôm mực tươi ngon, hòa quyện cùng phô mai béo ngậy và sốt cà chua đậm đà, giòn rụm trong từng miếng bánh nóng hổi.',114899.00,'a6b13539-0c45-11f0-ab99-6ef87da1f643','/duanweb2/public/images/pizzahaisan.jpg',18,'ee70a51b-0c45-11f0-ab99-6ef87da1f643','2025-04-01 02:20:21',1),('5c7bdc5f-0ea0-11f0-ab99-6ef87da1f643','Nem Rán','Giòn tan bên ngoài, nhân bên trong đầy đặn với thịt, mộc nhĩ và miến, thấm đẫm hương vị truyền thống, ăn kèm rau sống và nước chấm chua ngọt thì chuẩn vị tuyệt vời.',62447.00,'a6b1347f-0c45-11f0-ab99-6ef87da1f643','/duanweb2/public/images/nemran.jpg',11,'ee70a51b-0c45-11f0-ab99-6ef87da1f643','2025-04-01 02:20:21',1),('5c7bdd66-0ea0-11f0-ab99-6ef87da1f643','Cà Phê Sữa Đá','Đậm đà, thơm nồng vị cà phê rang xay, quyện cùng vị ngọt béo của sữa đặc, mát lạnh sảng khoái, đánh thức mọi giác quan trong từng ngụm.',38522.00,'a6ae6cac-0c45-11f0-ab99-6ef87da1f643','/duanweb2/public/images/caphesua.jpg',50,'ee70a51b-0c45-11f0-ab99-6ef87da1f643','2025-04-01 02:20:21',1),('5c7bde67-0ea0-11f0-ab99-6ef87da1f643','Kem Cone','Mát lạnh, mềm mịn tan chảy nơi đầu lưỡi, kết hợp với lớp ốc quế giòn thơm, mang đến hương vị ngọt ngào và đầy thú vị trong từng miếng cắn.',120364.00,'a6b130e3-0c45-11f0-ab99-6ef87da1f643','/duanweb2/public/images/kemcone.png',19,'ee70a51b-0c45-11f0-ab99-6ef87da1f643','2025-04-01 02:20:21',1),('5c7bdf45-0ea0-11f0-ab99-6ef87da1f643','Gà Rán','Món gà rán thuộc danh mục fast food',74682.00,'a6ab0397-0c45-11f0-ab99-6ef87da1f643','/duanweb2/public/images/garan.jpg',39,'ee70a51b-0c45-11f0-ab99-6ef87da1f643','2025-04-01 02:20:21',1),('9fec08de-0ea8-11f0-ab99-6ef87da1f643','Burger SGU CS2','Burger thuộc fast food',70000.00,'a6ab0397-0c45-11f0-ab99-6ef87da1f643','/duanweb2/public/images/burger2.jpg',40,'ee70a51b-0c45-11f0-ab99-6ef87da1f643','2025-04-01 03:23:04',1),('b8f89bab-0ea8-11f0-ab99-6ef87da1f643','Burger SGU CS2','Burger thuộc fast food',50000.00,'a6ab0397-0c45-11f0-ab99-6ef87da1f643','/duanweb2/public/images/burger2.jpg',34,'ee70a51b-0c45-11f0-ab99-6ef87da1f643','2025-04-01 03:23:46',1),('cda562f6-0ea8-11f0-ab99-6ef87da1f643','Burger SGU CS2','Burger thuộc fast food',10000.00,'a6ab0397-0c45-11f0-ab99-6ef87da1f643','/duanweb2/public/images/burger2.jpg',19,'ee70a51b-0c45-11f0-ab99-6ef87da1f643','2025-04-01 03:24:21',1);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `key_name` varchar(100) NOT NULL,
  `value` text,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key_name` (`key_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stores`
--

DROP TABLE IF EXISTS `stores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stores` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` text NOT NULL,
  `phone` varchar(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(100) DEFAULT NULL,
  `currency` varchar(10) DEFAULT 'VND',
  `minimum_order_amount` decimal(10,2) DEFAULT '0.00',
  `delivery_fee` decimal(10,2) DEFAULT '0.00',
  `free_delivery_enabled` tinyint(1) DEFAULT '0',
  `_delivery_threshold` decimal(10,2) DEFAULT '0.00',
  `tax_calculation_method` varchar(50) DEFAULT 'per_item',
  `default_tax_rate` decimal(5,2) DEFAULT '0.00',
  `tax_display_option` varchar(50) DEFAULT 'including_tax',
  `tax_rounding` varchar(50) DEFAULT 'round_nearest',
  `enable_taxes` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stores`
--

LOCK TABLES `stores` WRITE;
/*!40000 ALTER TABLE `stores` DISABLE KEYS */;
INSERT INTO `stores` VALUES ('ee70a51b-0c45-11f0-ab99-6ef87da1f643','Fast Food Corner','123 Main Street','0123456789','2025-03-29 02:31:34',NULL,'VND',0.00,25000.00,0,0.00,'per_item',0.00,'including_tax','round_nearest',1),('ee70d020-0c45-11f0-ab99-6ef87da1f643','Beverage Hub','456 Market Avenue','0987654321','2025-03-29 02:31:34',NULL,'VND',0.00,0.00,0,0.00,'per_item',0.00,'including_tax','round_nearest',1),('ee70d4b8-0c45-11f0-ab99-6ef87da1f643','Sweet Delights','789 Dessert Lane','0345678901','2025-03-29 02:31:34',NULL,'VND',0.00,0.00,0,0.00,'per_item',0.00,'including_tax','round_nearest',1),('ee70d56e-0c45-11f0-ab99-6ef87da1f643','Seafood Heaven','101 Ocean Road','0567890123','2025-03-29 02:31:34',NULL,'VND',0.00,0.00,0,0.00,'per_item',0.00,'including_tax','round_nearest',1),('ee70d608-0c45-11f0-ab99-6ef87da1f643','Pizza World','202 Italian St','0789012345','2025-03-29 02:31:34',NULL,'VND',0.00,0.00,0,0.00,'per_item',0.00,'including_tax','round_nearest',1);
/*!40000 ALTER TABLE `stores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tax_classes`
--

DROP TABLE IF EXISTS `tax_classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tax_classes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tax_classes`
--

LOCK TABLES `tax_classes` WRITE;
/*!40000 ALTER TABLE `tax_classes` DISABLE KEYS */;
INSERT INTO `tax_classes` VALUES (1,'Standard','Standard tax class for most items','2025-04-12 01:36:21'),(2,'Reduced Rate','Reduced tax rate for specific items','2025-04-12 01:36:21'),(3,'Zero Rate','Zero tax rate for exempt items','2025-04-12 01:36:21');
/*!40000 ALTER TABLE `tax_classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tax_rules`
--

DROP TABLE IF EXISTS `tax_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tax_rules` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `rate` decimal(5,2) NOT NULL,
  `country` varchar(100) NOT NULL,
  `state` varchar(100) DEFAULT NULL,
  `priority` int DEFAULT '1',
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tax_class_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_rules_class` (`tax_class_id`),
  CONSTRAINT `fk_rules_class` FOREIGN KEY (`tax_class_id`) REFERENCES `tax_classes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tax_rules`
--

LOCK TABLES `tax_rules` WRITE;
/*!40000 ALTER TABLE `tax_rules` DISABLE KEYS */;
INSERT INTO `tax_rules` VALUES (1,'Bảo vệ môi trường',5.00,'VN','all',1,1,'2025-04-12 04:07:59','2025-04-13 13:00:34',1);
/*!40000 ALTER TABLE `tax_rules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_addresses`
--

DROP TABLE IF EXISTS `user_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_addresses` (
  `id` char(36) NOT NULL,
  `user_id` char(36) NOT NULL,
  `address_name` varchar(255) DEFAULT 'Nhà',
  `address` text NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_user_address_user` (`user_id`),
  CONSTRAINT `fk_user_address_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_addresses`
--

LOCK TABLES `user_addresses` WRITE;
/*!40000 ALTER TABLE `user_addresses` DISABLE KEYS */;
INSERT INTO `user_addresses` VALUES ('67fff6d2431fc','dc9ca8a2-1307-11f0-ab99-6ef87da1f643','Home','273 An Dương Vương Phường 3 quận 5','+84965478891',1,'2025-04-16 18:28:48'),('efbe7f63-1103-11f0-ab99-6ef87da1f643','1','Nhà','helli','09089899',1,'2025-04-04 03:21:45'),('efbee614-1103-11f0-ab99-6ef87da1f643','94010196-0bf0-11f0-ab99-6ef87da1f643','Nhà','a','a',1,'2025-04-04 03:21:45');
/*!40000 ALTER TABLE `user_addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text,
  `password` varchar(255) NOT NULL,
  `role` enum('customer','admin','staff') DEFAULT 'customer',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `verify_token` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT '0',
  `is_block` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('1','minh1','hoangminh200401@gmail.com','09089899','helli','123456','admin','2025-03-18 15:40:38','1743055784232',1,0),('4f556a7a-132c-11f0-ab99-6ef87da1f643','Do Van Quy','dovanquy2005@gmail.com','0382888888','Thành thái quận 10','111','customer','2025-04-06 21:15:47','17ea6f9f68a47c6fea7ef22680b91e533ded48a6b7d287a0c5f3540d39189039',1,0),('94010196-0bf0-11f0-ab99-6ef87da1f643','a','admin@gmail.com','a','a','admin','admin','2025-03-28 16:20:35','c580d5c4b39811e054294615d15d45b2aec20a23f7999f242c70322b584ac9b8',1,0),('dc9ca8a2-1307-11f0-ab99-6ef87da1f643','Thanh Tuấn','npttcontact@gmail.com','0335487385','...','thanhtuan','customer','2025-04-06 16:54:53','3f6139d727c0436fd448f5fa3d825e5d27cd6412ecc34315fba826599fb2f41a',1,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-18 12:29:47
