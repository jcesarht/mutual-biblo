-- MySQL dump 10.13  Distrib 5.5.19, for Linux (x86_64)
--
-- Host: 97.74.149.131    Database: tbridtracker
-- ------------------------------------------------------
-- Server version	5.5.51-38.1-log

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
-- Table structure for table `comandos`
--

DROP TABLE IF EXISTS `comandos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comandos` (
  `id` bigint(50) NOT NULL AUTO_INCREMENT,
  `dispositivo_id` bigint(50) NOT NULL,
  `comando` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `programacion` enum('unico','diario','','') COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(10) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'activo',
  `fecha_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comandos`
--

LOCK TABLES `comandos` WRITE;
/*!40000 ALTER TABLE `comandos` DISABLE KEYS */;
INSERT INTO `comandos` VALUES (1,55,'14','Desbloquea Encendido de Motor','diario','eliminado','2020-04-10 16:51:00');
INSERT INTO `comandos` VALUES (2,55,'14','Desbloquea Encendido de Motor','unico','activo','2020-04-13 12:56:33');
INSERT INTO `comandos` VALUES (3,55,'14','Desbloquea Encendido de Motor','unico','activo','2020-04-13 13:22:02');
INSERT INTO `comandos` VALUES (4,55,'14','Desbloquea Encendido de Motor','unico','activo','2020-04-15 14:30:15');
INSERT INTO `comandos` VALUES (5,55,'14','Desbloquea Encendido de Motor','unico','activo','2020-04-15 15:28:29');
INSERT INTO `comandos` VALUES (6,55,'14','Desbloquea Encendido de Motor','unico','activo','2020-04-15 15:40:23');
INSERT INTO `comandos` VALUES (7,55,'14','Desbloquea Encendido de Motor','unico','activo','2020-04-17 07:16:59');
INSERT INTO `comandos` VALUES (8,55,'13','Apaga el Motor','unico','activo','2020-04-17 07:30:54');
INSERT INTO `comandos` VALUES (9,55,'14','Desbloquea Encendido de Motor','diario','eliminado','2020-04-17 07:31:53');
INSERT INTO `comandos` VALUES (10,55,'13','Apaga el Motor','diario','eliminado','2020-04-17 07:35:26');
INSERT INTO `comandos` VALUES (11,55,'21','Apagar Motor','diario','eliminado','2020-06-11 09:18:58');
INSERT INTO `comandos` VALUES (12,55,'21','Apagar Motor','diario','activo','2020-09-23 14:45:41');
/*!40000 ALTER TABLE `comandos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `frameworks`
--

DROP TABLE IF EXISTS `frameworks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `frameworks` (
  `id` bigint(30) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `logo` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `frameworks`
--

LOCK TABLES `frameworks` WRITE;
/*!40000 ALTER TABLE `frameworks` DISABLE KEYS */;
/*!40000 ALTER TABLE `frameworks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `programaciones_diarias`
--

DROP TABLE IF EXISTS `programaciones_diarias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `programaciones_diarias` (
  `id` bigint(50) NOT NULL AUTO_INCREMENT,
  `comando_id` bigint(50) NOT NULL,
  `mes` int(2) NOT NULL,
  `dias_semana` varchar(14) COLLATE utf8_spanish_ci NOT NULL,
  `hora` time NOT NULL,
  `estado` varchar(10) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'activo',
  `fecha_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programaciones_diarias`
--

LOCK TABLES `programaciones_diarias` WRITE;
/*!40000 ALTER TABLE `programaciones_diarias` DISABLE KEYS */;
INSERT INTO `programaciones_diarias` VALUES (3,1,4,'6:','19:00:00','eliminado','2020-04-10 16:51:00');
INSERT INTO `programaciones_diarias` VALUES (4,9,4,'6:','10:00:00','eliminado','2020-04-17 07:31:53');
INSERT INTO `programaciones_diarias` VALUES (5,10,4,'6:','10:15:00','eliminado','2020-04-17 07:35:26');
INSERT INTO `programaciones_diarias` VALUES (6,11,-1,'1:2:3:4:5:6:7:','21:00:00','eliminado','2020-06-11 09:18:58');
INSERT INTO `programaciones_diarias` VALUES (7,12,-1,'1:2:3:4:5:6:7:','20:00:00','activo','2020-09-23 14:45:41');
/*!40000 ALTER TABLE `programaciones_diarias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `programaciones_unicas`
--

DROP TABLE IF EXISTS `programaciones_unicas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `programaciones_unicas` (
  `id` bigint(50) NOT NULL AUTO_INCREMENT,
  `comando_id` bigint(50) NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_test` datetime DEFAULT NULL,
  `estado` varchar(10) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'activo',
  `fecha_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programaciones_unicas`
--

LOCK TABLES `programaciones_unicas` WRITE;
/*!40000 ALTER TABLE `programaciones_unicas` DISABLE KEYS */;
INSERT INTO `programaciones_unicas` VALUES (1,2,'2020-04-13 15:00:00',NULL,'activo','2020-04-13 12:56:33');
INSERT INTO `programaciones_unicas` VALUES (2,3,'2020-04-13 15:30:00',NULL,'activo','2020-04-13 13:22:02');
INSERT INTO `programaciones_unicas` VALUES (3,4,'2020-04-15 16:45:00',NULL,'activo','2020-04-15 14:30:15');
INSERT INTO `programaciones_unicas` VALUES (4,5,'2020-04-15 17:30:00','2020-04-15 17:30:00','ejecutado','2020-04-15 15:28:29');
INSERT INTO `programaciones_unicas` VALUES (5,6,'2020-04-15 18:00:03','2020-04-15 18:00:04','ejecutado','2020-04-15 15:40:23');
INSERT INTO `programaciones_unicas` VALUES (6,7,'2020-04-17 09:30:00','2020-04-17 09:30:00','ejecutado','2020-04-17 07:16:59');
INSERT INTO `programaciones_unicas` VALUES (7,8,'2020-04-17 09:45:00','2020-04-17 09:45:00','ejecutado','2020-04-17 07:30:54');
/*!40000 ALTER TABLE `programaciones_unicas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vinculos`
--

DROP TABLE IF EXISTS `vinculos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vinculos` (
  `id` bigint(30) NOT NULL AUTO_INCREMENT,
  `vhadmin_id` bigint(30) NOT NULL,
  `vhtrack_id` bigint(30) NOT NULL,
  `framework_id` bigint(30) NOT NULL,
  `usuario_track` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `pass_track` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `servidor` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `protocolo` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(15) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'activo',
  `fecha_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vinculos`
--

LOCK TABLES `vinculos` WRITE;
/*!40000 ALTER TABLE `vinculos` DISABLE KEYS */;
INSERT INTO `vinculos` VALUES (1,1625,16,1,'sut.servi@gmail.com ','jggps','158.69.1.53','http://','eliminado','2019-09-22 18:52:17');
INSERT INTO `vinculos` VALUES (2,1625,21,1,'gps@simbiotica.com.co','admin','158.69.1.53','http://','eliminado','2019-09-22 19:05:54');
INSERT INTO `vinculos` VALUES (3,1625,21,1,'gps@simbiotica.com.co','admin','158.69.1.53','http://','eliminado','2019-09-22 19:09:41');
INSERT INTO `vinculos` VALUES (4,1625,16,1,'sut.servi@gmail.com','jggps','158.69.1.53','http://','eliminado','2019-09-23 08:31:37');
INSERT INTO `vinculos` VALUES (5,1420,17,1,'sut.servi@gmail.com','jggps','158.69.1.53','http://','eliminado','2019-09-26 12:26:02');
INSERT INTO `vinculos` VALUES (6,1402,17,1,'sut.servi@gmail.com','servintegrados2019*','158.69.1.53','http://','activo','2019-10-30 15:46:59');
INSERT INTO `vinculos` VALUES (7,1426,18,1,'sut.servi@gmail.com','servintegrados2019*','158.69.1.53','http://','activo','2019-11-01 13:31:17');
INSERT INTO `vinculos` VALUES (8,2039,25,1,'sut.servi@gmail.com','servintegrados2019*','158.69.1.53','http://','activo','2019-11-01 13:38:23');
INSERT INTO `vinculos` VALUES (9,1420,23,1,'sut.servi@gmail.com','servintegrados2019*','158.69.1.53','http://','activo','2019-11-01 13:33:54');
INSERT INTO `vinculos` VALUES (10,1404,24,1,'sut.servi@gmail.com','servintegrados2019*','158.69.1.53','http://','activo','2019-11-01 13:39:27');
INSERT INTO `vinculos` VALUES (11,1419,26,1,'sut.servi@gmail.com','servintegrados2019*','158.69.1.53','http://','activo','2019-11-01 13:43:31');
INSERT INTO `vinculos` VALUES (12,1415,28,1,'sut.servi@gmail.com','servintegrados2019*','158.69.1.53','http://','activo','2019-11-01 13:48:29');
INSERT INTO `vinculos` VALUES (13,1398,29,1,'sut.servi@gmail.com','servintegrados2019*','158.69.1.53','http://','activo','2019-11-01 13:45:48');
INSERT INTO `vinculos` VALUES (14,1416,27,1,'sut.servi@gmail.com','servintegrados2019*','158.69.1.53','http://','activo','2019-11-01 13:42:00');
INSERT INTO `vinculos` VALUES (15,2040,32,1,'sut.servi@gmail.com','servintegrados2019*','158.69.1.53','http://','activo','2019-11-01 13:12:43');
INSERT INTO `vinculos` VALUES (16,1409,16,1,'sut.servi@gmail.com','servintegrados2019*','158.69.1.53','http://','activo','2019-11-01 13:06:04');
INSERT INTO `vinculos` VALUES (17,1400,30,1,'sut.servi@gmail.com','servintegrados2019*','158.69.1.53','http://','activo','2019-11-01 13:20:07');
INSERT INTO `vinculos` VALUES (18,1625,16,1,'sut.servi@gmail.com','servintegrados2019*','158.69.1.53','http://','eliminado','2019-11-07 06:53:38');
INSERT INTO `vinculos` VALUES (19,1625,55,1,'gps@simbiotica.com.co','soporte2019*','158.69.1.53','http://','activo','2020-06-11 09:00:00');
/*!40000 ALTER TABLE `vinculos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-10-16 12:21:39
