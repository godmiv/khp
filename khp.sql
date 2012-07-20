-- MySQL dump 10.10
--
-- Host: sapr02    Database: khp
-- ------------------------------------------------------
-- Server version	5.1.12-beta-community-nt

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
-- Table structure for table `codifier_divisions`
--

DROP TABLE IF EXISTS `codifier_divisions`;
CREATE TABLE `codifier_divisions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 11264 kB';

--
-- Dumping data for table `codifier_divisions`
--

LOCK TABLES `codifier_divisions` WRITE;
/*!40000 ALTER TABLE `codifier_divisions` DISABLE KEYS */;
INSERT INTO `codifier_divisions` VALUES (1,'ПДО'),(2,'ТОМО'),(3,'12/1'),(4,'12/2'),(5,'12/3'),(6,'12/7');
/*!40000 ALTER TABLE `codifier_divisions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `codifier_instr`
--

DROP TABLE IF EXISTS `codifier_instr`;
CREATE TABLE `codifier_instr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `numstart` int(11) DEFAULT NULL,
  `numend` int(11) DEFAULT NULL,
  `sokr` char(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `codifier_instr`
--

LOCK TABLES `codifier_instr` WRITE;
/*!40000 ALTER TABLE `codifier_instr` DISABLE KEYS */;
INSERT INTO `codifier_instr` VALUES (1,'ММ',0,0,'ММ'),(2,'Электрод',7680,7857,'Э'),(3,'Шаблон',8370,9999,'Ш'),(4,'Калибр',8130,8369,'Ка'),(5,'Резец',2199,2298,'Р'),(6,'Фреза',2299,2299,'Ф'),(7,'Копир-модель',7054,7098,'КпМ'),(8,'Приспособление',7099,7308,'П'),(9,'Зенкер',2339,2398,'З'),(10,'Развёртка',2399,2798,'Рз'),(11,'Оправка',6299,7053,'О'),(12,'Ролик',7990,8129,'Рол'),(13,'Сверло',2300,2338,'С'),(14,'Кондуктор',7309,7679,'К'),(15,'Притир',2799,6298,'Пт'),(16,'Давильник',1479,1498,'Д'),(17,'Прессформа',1499,1548,'Пф'),(18,'ЭХО',793,798,'ЭХО'),(19,'Просечка',1549,2198,'Пр'),(20,'Тара',1039,1478,'Т'),(21,'Клеймо',7858,7989,'Кл'),(22,'Разное (терм)',799,1038,'Ра');
/*!40000 ALTER TABLE `codifier_instr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `codifier_tasks`
--

DROP TABLE IF EXISTS `codifier_tasks`;
CREATE TABLE `codifier_tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `division_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_division` (`division_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 11264 kB';

--
-- Dumping data for table `codifier_tasks`
--

LOCK TABLES `codifier_tasks` WRITE;
/*!40000 ALTER TABLE `codifier_tasks` DISABLE KEYS */;
INSERT INTO `codifier_tasks` VALUES (1,'Технологическая проработка',2),(2,'Заказ материалов',1),(3,'Изготовление',3),(4,'Программы ЧПУ',2);
/*!40000 ALTER TABLE `codifier_tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `date_upload` datetime NOT NULL,
  `owner` varchar(50) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` VALUES (1,99,'upload/99/b8003510d254a8b1190c04b9f9f50595.jpg','2012-07-18 12:26:04','pot','проверка'),(2,99,'upload/99/52598319a0932d052a01095ed9476aa3.jpg','2012-07-18 15:53:47','pot','тест'),(3,99,'upload/99/a70c3e9f8989551d60b75f0514782500.jpg','2012-07-19 09:35:20','pot','проверка загрузки файлов'),(4,99,'upload/99/05c8831c9567a316c740de338251f9e8.jpg','2012-07-19 09:56:03','pot','вап'),(5,96,'upload/96/4853f9b23f89982aac129fe16ed33649.jpg','2012-07-19 09:56:51','pot','тест');
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) DEFAULT NULL,
  `status` char(10) DEFAULT NULL,
  `detalavto` varchar(30) DEFAULT NULL,
  `nazvdet` varchar(50) DEFAULT NULL,
  `nosnas` varchar(30) DEFAULT NULL,
  `nizv` varchar(15) DEFAULT NULL,
  `kodinstr` varchar(30) DEFAULT NULL,
  `nizvins` varchar(15) DEFAULT NULL,
  `osin` char(1) DEFAULT NULL,
  `text` text,
  `user_start` varchar(50) DEFAULT NULL,
  `group_start` char(20) DEFAULT NULL,
  `date_start` datetime DEFAULT NULL,
  `comment_start` text,
  `user_accept` varchar(50) DEFAULT NULL,
  `comment_accept` text,
  `date_accept` datetime DEFAULT NULL,
  `sum` char(5) DEFAULT NULL,
  `document` varchar(50) DEFAULT NULL,
  `doer` varchar(50) DEFAULT NULL,
  `date_plan` datetime DEFAULT NULL,
  `date_finish` datetime DEFAULT NULL,
  `comment_finish` text,
  `files` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `number` (`number`)
) ENGINE=MyISAM AUTO_INCREMENT=114 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,NULL,'Возврат','2121-00000001','электрод','123-4567-9012-001','111','890-7680-1234-001',NULL,NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,NULL,'Возврат','2121-00000001','шаблон','123-4567-8901','111','890-8372-4567-002',NULL,NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,NULL,'Возврат','2121-00000001','шаблон','123-4567-8901','111','890-8373-1234-001',NULL,NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16,NULL,'Возврат','','Электрод','','','890-7680-1237','',NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,NULL,'Возврат','','Электрод','','','890-7680-1235','',NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,NULL,'Возврат','','Шаблон','','','890-8373-1235','',NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,NULL,'Возврат','','Электрод','','','890-7680-1235','',NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,NULL,'Возврат','','Шаблон','','','890-8373-1235','',NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,NULL,'Возврат','','Электрод','','','890-7680-1235','',NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(14,NULL,'Возврат','','Электрод','','','890-7680-1236','',NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(12,NULL,'Возврат','','Электрод','','','890-7680-1236','',NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(13,NULL,'Возврат','','Электрод','','','890-7680-1236','',NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(15,NULL,'Возврат','','Электрод','','','890-7680-1236','',NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(31,NULL,'Возврат','','Электрод','','','890-7680-1240','',NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(25,NULL,'Возврат','','Шаблон','','','890-8373-1236','',NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(26,NULL,'Возврат','','Электрод','','','890-7680-1238','',NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(27,NULL,'Возврат','','Электрод','','','890-7680-1239','',NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(28,NULL,'Возврат','','Шаблон','','','890-8373-1237','',NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(29,NULL,'Возврат','','Шаблон','','','890-8373-1238','',NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(30,NULL,'Возврат','','Шаблон','','','890-8373-1239','',NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(32,NULL,'Возврат','','Электрод','','','890-7680-1241','',NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(33,NULL,'Возврат','','Электрод','','','890-7680-1242','',NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(34,NULL,'Возврат','','Электрод','','','890-7680-1243','',NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(35,NULL,'Возврат','','Электрод','','','890-7680-1244','',NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(36,NULL,'Возврат','','Электрод','','','890-7680-1244','',NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(37,NULL,'Возврат','','Электрод','','','890-7680-1245','',NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(38,NULL,'Возврат','','Электрод','','','890-7680-1246','',NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(39,NULL,'Возврат','','Шаблон','','','890-8373-1240','',NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(40,NULL,'Возврат','','Электрод','','','890-7680-1247','',NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(41,NULL,'Возврат','','Шаблон','','','890-8373-1241','',NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(44,7,'План','','Электрод','','','890-7680-1250','',NULL,NULL,'testuser',NULL,'2012-05-17 12:42:32',NULL,NULL,'','2012-05-17 12:44:32',NULL,NULL,'Портнов','2012-05-23 12:29:24',NULL,NULL,NULL),(45,5,'Готов','','Электрод','','','890-7680-1251','',NULL,NULL,'testuser',NULL,'2012-03-21 13:21:02',NULL,NULL,NULL,'2012-05-11 15:36:51',NULL,NULL,'Поташов','2012-05-16 15:30:47','2012-05-17 12:20:33',NULL,NULL),(46,5,'Готов','','Шаблон','','','890-8373-1242','',NULL,NULL,'testuser',NULL,'2012-03-21 13:21:02',NULL,NULL,NULL,'2012-05-11 15:36:51',NULL,NULL,'Поташов','2012-05-16 15:30:47','2012-05-17 12:20:33',NULL,NULL),(48,6,'План','','Электрод','','','890-7680-1252','',NULL,NULL,'testuser',NULL,'2012-05-11 15:42:43',NULL,NULL,'по служебной 1000','2012-05-11 15:47:48',NULL,NULL,'Павличенко','2012-05-17 16:53:31',NULL,NULL,NULL),(50,5,'Готов','','Электрод','','','890-7680-1253','',NULL,NULL,'testuser',NULL,'2012-03-21 13:21:02',NULL,NULL,NULL,'2012-05-11 15:36:51',NULL,NULL,'Поташов','2012-05-16 15:30:47','2012-05-17 12:20:33',NULL,NULL),(52,NULL,'Возврат','','Электрод','','','890-7680-1254','',NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(53,NULL,'Возврат','','Электрод','','','890-7680-1255','',NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(54,5,'Готов','','Электрод','','','890-7680-1256','',NULL,NULL,'testuser',NULL,'2012-03-21 13:21:02',NULL,NULL,NULL,'2012-05-11 15:36:51',NULL,NULL,'Поташов','2012-05-16 15:30:47','2012-05-17 12:20:33',NULL,NULL),(55,5,'Готов','','Электрод','','','890-7680-1257','',NULL,NULL,'testuser',NULL,'2012-03-21 13:21:02',NULL,NULL,NULL,'2012-05-11 15:36:51',NULL,NULL,'Поташов','2012-05-16 15:30:47','2012-05-17 12:20:33',NULL,NULL),(56,5,'Готов','','Электрод','','','890-7680-1258','',NULL,NULL,'testuser',NULL,'2012-03-21 13:21:02',NULL,NULL,'рпараопаорполпрлорлдлодло','2012-05-11 15:36:51',NULL,NULL,'Поташов','2012-05-16 15:30:47','2012-05-17 12:20:33','',NULL),(57,4,NULL,'','Электрод','','','890-7680-1259','',NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(58,3,'Готов','','Электрод','','','890-7680-1260','',NULL,NULL,'testuser',NULL,'2012-05-11 15:42:46',NULL,NULL,NULL,'2012-05-11 15:48:19',NULL,NULL,'Митричев','2012-05-16 13:51:02','2012-05-17 10:44:52','орп',NULL),(59,3,'Готов','','Электрод','','','890-7680-1261','',NULL,NULL,'testuser',NULL,'2012-05-11 15:42:46',NULL,NULL,'рпар','2012-05-11 15:48:19',NULL,NULL,'Митричев','2012-05-16 13:51:02','2012-05-17 10:44:52',NULL,NULL),(70,1,NULL,'','Электрод','','','890-7680-1263','',NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(69,2,'План','','Электрод','','','890-7680-1262','',NULL,NULL,'testuser',NULL,'2012-05-11 16:44:39',NULL,NULL,'авпавр','2012-05-11 16:44:47',NULL,NULL,'Митричев','2012-05-16 15:42:46',NULL,NULL,NULL),(72,NULL,'Возврат','','Электрод','','','890-7680-1264','',NULL,'','testuser',NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(73,NULL,'Возврат','','Электрод','','','890-7680-1265','',NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(76,14,'Выдан','1','1','4','','','',NULL,'Абырвалг','testuser',NULL,'2012-05-12 09:39:24',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(77,8,'Возврат','1','2111','5','','','',NULL,'Текст','testuser',NULL,'2012-03-26 13:00:18',NULL,NULL,'','2012-03-27 12:18:35',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(78,9,'Готов','','Электрод','','','890-7680-1266','',NULL,'','testuser',NULL,'2012-03-22 08:50:21',NULL,NULL,NULL,'2012-03-27 12:12:50',NULL,NULL,'Поташов','2012-05-17 12:34:43','2012-05-17 16:25:25',NULL,NULL),(82,14,'Выдан','','Электрод','','','890-7680-1269','',NULL,'','testuser','testgroup','2012-05-12 09:39:24',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(79,9,'Готов','','Электрод','','','890-7680-1267','',NULL,'','testuser','testgroup','2012-03-22 08:50:21',NULL,NULL,NULL,'2012-03-27 12:12:50',NULL,NULL,'Поташов','2012-05-17 12:34:43','2012-05-17 16:25:25',NULL,NULL),(80,9,'Готов','','Шаблон','','','890-8373-1243','',NULL,'','testuser','testgroup','2012-03-22 08:50:21',NULL,NULL,'Коментарий добавляется только в одну из деталей заказа, но относится ко всему заказу.','2012-03-27 12:12:50',NULL,NULL,'Поташов','2012-05-17 12:34:43','2012-05-17 16:25:25','',NULL),(81,14,'Выдан','','Электрод','','','890-7680-1268','',NULL,'','testuser','testgroup','2012-05-12 09:39:24',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(83,14,'Выдан','','dsgdfhf','4315423','','890-8373-1244','',NULL,'','testuser','testgroup','2012-05-12 09:39:24',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(84,14,'Выдан','','Электрод','','','890-7680-1270','',NULL,'','testuser','testgroup','2012-05-12 09:39:24',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(85,10,'Готов','','Электрод','','','890-7680-1271','',NULL,'','testuser','testgroup','2012-03-26 09:16:48',NULL,NULL,'опо','2012-03-27 12:00:19',NULL,NULL,'Портнов','2012-05-16 15:32:02','2012-05-17 12:20:09','',NULL),(86,13,'Выдан','21111','Электрод','11111','1111','890-7680-1271','111',NULL,'ffsds','testuser','testgroup','2012-05-12 09:04:35',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(87,13,'Выдан','','Электрод','','','890-7680-1272','',NULL,'','testuser','testgroup','2012-05-12 09:04:35',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(88,11,'Готов','','Электрод','','','890-7680-1273','',NULL,'ТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекстТекст','testuser','testgroup','2012-03-27 09:39:00',NULL,NULL,'опо','2012-03-27 11:05:47',NULL,NULL,'Митричев','2012-05-16 15:31:48','2012-05-17 10:44:33','',NULL),(89,13,'Выдан','','Электрод','','','890-7680-1274','',NULL,'','testuser','testgroup','2012-05-12 09:04:35',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(90,NULL,'Возврат',NULL,'Калибр',NULL,NULL,'890-8130-0001',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2012-05-16 12:12:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(91,12,'Возврат','','Калибр','','','890-8130-0002','',NULL,'','testuser','testgroup','2012-05-11 10:38:56',NULL,NULL,'','2012-05-11 10:39:20',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(92,15,'Возврат','','Электрод','','','890-7680-1275','',NULL,'Электрод 1275','testuser','testgroup','2012-05-12 09:49:27',NULL,NULL,NULL,'2012-05-22 09:57:59',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(93,15,'Возврат','','Электрод','','','890-7680-1276','',NULL,'Электрод 1276','testuser','testgroup','2012-05-12 09:49:27',NULL,NULL,'jhgjhgjh','2012-05-22 09:57:59',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(94,NULL,NULL,'','Электрод','','','890-7680-1277','',NULL,'','testuser','testgroup',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(95,NULL,NULL,'','Шаблон','','','890-8373-1245','',NULL,'','testuser','testgroup',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(96,NULL,NULL,'','Электрод','','','890-7680-1278','',NULL,'','testuser','testgroup',NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1'),(97,NULL,NULL,'','Калибр','','','890-8130-0003','',NULL,'','testuser','testgroup',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(98,NULL,NULL,'','Калибр','','','890-8130-0004','',NULL,'','testuser','testgroup',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(99,21,NULL,'','Электрод','','','890-7680-1279','',NULL,'','testuser','testgroup',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1'),(100,20,NULL,'','Электрод','','','890-7680-1280','',NULL,'','testuser','testgroup',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(101,18,'Готов','','Шаблон','','','890-8373-1246','',NULL,'','testuser','testgroup','2012-05-17 12:42:30',NULL,NULL,NULL,'2012-05-17 12:44:23',NULL,NULL,'Митричев','2012-05-17 12:45:10','2012-05-17 12:45:41',NULL,NULL),(102,18,'Готов','','Калибр','','','890-8130-0005','',NULL,'','testuser','testgroup','2012-05-17 12:42:30',NULL,NULL,NULL,'2012-05-17 12:44:23',NULL,NULL,'Митричев','2012-05-17 12:45:10','2012-05-17 12:45:41',NULL,NULL),(103,18,'Готов','','Электрод','','','890-7680-1281','',NULL,'','testuser','testgroup','2012-05-17 12:42:30',NULL,NULL,'','2012-05-17 12:44:23',NULL,NULL,'Митричев','2012-05-17 12:45:10','2012-05-17 12:45:41','',NULL),(104,7,'План','','Калибр','','','890-8130-0006','',NULL,'','testuser','testgroup','2012-05-17 12:42:32',NULL,NULL,NULL,'2012-05-17 12:44:32',NULL,NULL,'Портнов','2012-05-23 12:29:24',NULL,NULL,NULL),(105,16,'Готов','','Шаблон','','','890-8373-1247','',NULL,'','testuser','testgroup','2012-05-17 08:49:51',NULL,NULL,NULL,'2012-05-17 08:50:17',NULL,NULL,'Поташов','2012-05-17 08:50:31','2012-05-17 10:10:59',NULL,NULL),(106,16,'Готов','','Шаблон','','','890-8373-1248','',NULL,'','testuser','testgroup','2012-05-17 08:49:51',NULL,NULL,NULL,'2012-05-17 08:50:17',NULL,NULL,'Поташов','2012-05-17 08:50:31','2012-05-17 10:10:59',NULL,NULL),(107,16,'Готов','','Электрод','','','890-7680-1282','',NULL,'','testuser','testgroup','2012-05-17 08:49:51',NULL,NULL,NULL,'2012-05-17 08:50:17',NULL,NULL,'Поташов','2012-05-17 08:50:31','2012-05-17 10:10:59',NULL,NULL),(108,16,'Готов','','Электрод','','','890-7680-1283','',NULL,'','testuser','testgroup','2012-05-17 08:49:51',NULL,NULL,'','2012-05-17 08:50:17',NULL,NULL,'Поташов','2012-05-17 08:50:31','2012-05-17 10:10:59',NULL,NULL),(109,17,'Готов','','Электрод','','','890-7680-1284','',NULL,NULL,'testuser','testgroup','2012-05-17 10:22:05','ваывавыпа',NULL,'рлапвпа','2012-05-17 10:22:17',NULL,NULL,'Поташов','2012-05-17 10:22:30','2012-05-17 10:22:35','',NULL),(110,7,'План','','Электрод','','','890-7680-1285','',NULL,NULL,'testuser','testgroup','2012-05-17 12:42:32','',NULL,NULL,'2012-05-17 12:44:32',NULL,NULL,'Портнов','2012-05-23 12:29:24',NULL,NULL,NULL),(111,7,'План','','Электрод','','','890-7680-1286','',NULL,NULL,'testuser','testgroup','2012-05-17 12:42:32','',NULL,NULL,'2012-05-17 12:44:32',NULL,NULL,'Портнов','2012-05-23 12:29:24',NULL,NULL,NULL),(112,7,'План','','Электрод','','','890-7680-1287','',NULL,NULL,'testuser','testgroup','2012-05-17 12:42:32','',NULL,NULL,'2012-05-17 12:44:32',NULL,NULL,'Портнов','2012-05-23 12:29:24',NULL,NULL,NULL),(113,19,'Готов','','Электрод_1','','','890-7680-1288','',NULL,NULL,'testuser','testgroup','2012-05-22 09:57:02','',NULL,'','2012-05-22 09:57:43',NULL,NULL,'Митричев','2012-05-22 09:58:44','2012-05-22 09:59:14','',NULL);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `prod_view`
--

DROP TABLE IF EXISTS `prod_view`;
/*!50001 DROP VIEW IF EXISTS `prod_view`*/;
/*!50001 CREATE TABLE `prod_view` (
  `id` int(11),
  `name` varchar(50),
  `code` varchar(50),
  `type` varchar(50)
) */;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parrent_id` int(11) NOT NULL DEFAULT '0',
  `type_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 11264 kB';

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,0,1,'Матрица','890-7680-1234-001'),(2,1,2,'Электрод','856-1234-5678'),(3,0,1,'Пуансон','890-7680-1234-003'),(4,1,2,'Шаблон','856-1235-5678');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_types`
--

DROP TABLE IF EXISTS `products_types`;
CREATE TABLE `products_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 11264 kB';

--
-- Dumping data for table `products_types`
--

LOCK TABLES `products_types` WRITE;
/*!40000 ALTER TABLE `products_types` DISABLE KEYS */;
INSERT INTO `products_types` VALUES (1,'Оснастка'),(2,'И2П');
/*!40000 ALTER TABLE `products_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codifier_id` int(11) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 11264 kB';

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` VALUES (1,1,'2011-12-21 00:00:00',NULL,1,1),(2,2,NULL,NULL,2,1),(3,3,NULL,NULL,3,1),(4,1,NULL,NULL,1,2),(5,4,NULL,NULL,2,2),(6,3,NULL,NULL,3,2),(7,2,NULL,NULL,4,2);
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `tasksview`
--

DROP TABLE IF EXISTS `tasksview`;
/*!50001 DROP VIEW IF EXISTS `tasksview`*/;
/*!50001 CREATE TABLE `tasksview` (
  `task_id` int(11),
  `start` datetime,
  `end` datetime,
  `number` int(11),
  `taskname` varchar(50),
  `name` varchar(50),
  `productid` int(11),
  `code` varchar(50)
) */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group` varchar(10) NOT NULL,
  `login` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `rang` varchar(50) DEFAULT NULL,
  `f` varchar(25) DEFAULT NULL,
  `i` varchar(25) DEFAULT NULL,
  `o` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'kbimo','mitr','1',NULL,'Митричев',NULL,NULL),(2,'kbimo','pot','1',NULL,'Поташов',NULL,NULL),(3,'kbimo','port','1','1','Портнов',NULL,NULL),(4,'kbimo','pav','1',NULL,'Павличенко',NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `prod_view`
--

/*!50001 DROP TABLE IF EXISTS `prod_view`*/;
/*!50001 DROP VIEW IF EXISTS `prod_view`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `prod_view` AS select `products`.`id` AS `id`,`products`.`name` AS `name`,`products`.`code` AS `code`,`products_types`.`name` AS `type` from (`products` left join `products_types` on((`products`.`type_id` = `products_types`.`id`))) */;

--
-- Final view structure for view `tasksview`
--

/*!50001 DROP TABLE IF EXISTS `tasksview`*/;
/*!50001 DROP VIEW IF EXISTS `tasksview`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `tasksview` AS select `tasks`.`id` AS `task_id`,`tasks`.`start` AS `start`,`tasks`.`end` AS `end`,`tasks`.`number` AS `number`,`codifier_tasks`.`name` AS `taskname`,`products`.`name` AS `name`,`products`.`id` AS `productid`,`products`.`code` AS `code` from ((`tasks` left join `codifier_tasks` on((`tasks`.`codifier_id` = `codifier_tasks`.`id`))) left join `products` on((`tasks`.`product_id` = `products`.`id`))) */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-07-19 12:54:32
