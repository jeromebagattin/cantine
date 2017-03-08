-- MySQL dump 10.15  Distrib 10.0.29-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: localhost
-- ------------------------------------------------------
-- Server version	10.0.29-MariaDB-0+deb8u1

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
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateMenu` date NOT NULL,
  `dateValidation` date NOT NULL,
  `etat` int(11) NOT NULL DEFAULT '0',
  `discr` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `agent` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prixRepa` double DEFAULT NULL,
  `idMenu` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (38,'2017-12-20','2021-03-15',0,'menu',NULL,NULL,NULL);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_plat`
--

DROP TABLE IF EXISTS `menu_plat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_plat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `plat_id` int(11) NOT NULL,
  `lettre` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `jourMenu` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E8775249CCD7E912` (`menu_id`),
  KEY `IDX_E8775249D73DB560` (`plat_id`),
  CONSTRAINT `FK_E8775249CCD7E912` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`),
  CONSTRAINT `FK_E8775249D73DB560` FOREIGN KEY (`plat_id`) REFERENCES `plat` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3240 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_plat`
--

LOCK TABLES `menu_plat` WRITE;
/*!40000 ALTER TABLE `menu_plat` DISABLE KEYS */;
INSERT INTO `menu_plat` VALUES (3155,38,4,'A','2017-12-20'),(3156,38,1,'B','2017-12-20'),(3157,38,1,'C','2017-12-20'),(3158,38,4,'D','2017-12-20'),(3159,38,5,'U','2017-12-20'),(3160,38,5,'G','2017-12-20'),(3161,38,5,'E','2017-12-20'),(3162,38,3,'H','2017-12-20'),(3163,38,10,'O','2017-12-20'),(3164,38,3,'S','2017-12-20'),(3165,38,3,'I','2017-12-20'),(3166,38,6,'R','2017-12-20'),(3167,38,6,'M','2017-12-20'),(3168,38,6,'T','2017-12-20'),(3169,38,2,'F','2017-12-20'),(3170,38,2,'L','2017-12-20'),(3171,38,2,'X','2017-12-20'),(3172,38,1,'A','2017-12-21'),(3173,38,1,'B','2017-12-21'),(3174,38,1,'C','2017-12-21'),(3175,38,1,'D','2017-12-21'),(3176,38,5,'U','2017-12-21'),(3177,38,5,'G','2017-12-21'),(3178,38,5,'E','2017-12-21'),(3179,38,3,'H','2017-12-21'),(3180,38,3,'O','2017-12-21'),(3181,38,3,'S','2017-12-21'),(3182,38,3,'I','2017-12-21'),(3183,38,6,'R','2017-12-21'),(3184,38,6,'M','2017-12-21'),(3185,38,6,'T','2017-12-21'),(3186,38,2,'F','2017-12-21'),(3187,38,2,'L','2017-12-21'),(3188,38,2,'X','2017-12-21'),(3189,38,1,'A','2017-12-22'),(3190,38,1,'B','2017-12-22'),(3191,38,1,'C','2017-12-22'),(3192,38,1,'D','2017-12-22'),(3193,38,5,'U','2017-12-22'),(3194,38,5,'G','2017-12-22'),(3195,38,5,'E','2017-12-22'),(3196,38,3,'H','2017-12-22'),(3197,38,3,'O','2017-12-22'),(3198,38,3,'S','2017-12-22'),(3199,38,3,'I','2017-12-22'),(3200,38,6,'R','2017-12-22'),(3201,38,6,'M','2017-12-22'),(3202,38,6,'T','2017-12-22'),(3203,38,2,'F','2017-12-22'),(3204,38,2,'L','2017-12-22'),(3205,38,2,'X','2017-12-22'),(3206,38,1,'A','2017-12-23'),(3207,38,1,'B','2017-12-23'),(3208,38,1,'C','2017-12-23'),(3209,38,1,'D','2017-12-23'),(3210,38,5,'U','2017-12-23'),(3211,38,5,'G','2017-12-23'),(3212,38,5,'E','2017-12-23'),(3213,38,3,'H','2017-12-23'),(3214,38,3,'O','2017-12-23'),(3215,38,3,'S','2017-12-23'),(3216,38,3,'I','2017-12-23'),(3217,38,6,'R','2017-12-23'),(3218,38,6,'M','2017-12-23'),(3219,38,6,'T','2017-12-23'),(3220,38,2,'F','2017-12-23'),(3221,38,2,'L','2017-12-23'),(3222,38,2,'X','2017-12-23'),(3223,38,1,'A','2017-12-24'),(3224,38,1,'B','2017-12-24'),(3225,38,1,'C','2017-12-24'),(3226,38,1,'D','2017-12-24'),(3227,38,5,'U','2017-12-24'),(3228,38,5,'G','2017-12-24'),(3229,38,5,'E','2017-12-24'),(3230,38,3,'H','2017-12-24'),(3231,38,3,'O','2017-12-24'),(3232,38,3,'S','2017-12-24'),(3233,38,3,'I','2017-12-24'),(3234,38,6,'R','2017-12-24'),(3235,38,7,'M','2017-12-24'),(3236,38,6,'T','2017-12-24'),(3237,38,8,'F','2017-12-24'),(3238,38,8,'L','2017-12-24'),(3239,38,2,'X','2017-12-24');
/*!40000 ALTER TABLE `menu_plat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plat`
--

DROP TABLE IF EXISTS `plat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_plat_id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `porc` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2038A207A4D60759` (`libelle`),
  KEY `IDX_2038A207FF1CDA95` (`type_plat_id`),
  CONSTRAINT `FK_2038A207FF1CDA95` FOREIGN KEY (`type_plat_id`) REFERENCES `type_plat` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plat`
--

LOCK TABLES `plat` WRITE;
/*!40000 ALTER TABLE `plat` DISABLE KEYS */;
INSERT INTO `plat` VALUES (1,2,'carottes rapées',0),(2,1,'clémentine',0),(3,4,'frites',0),(4,2,'paté',1),(5,3,'steak',0),(6,5,'yaourt',0),(7,5,'fromage',0),(8,1,'patisserie',0),(9,3,'lomo',1),(10,4,'courgettes',0);
/*!40000 ALTER TABLE `plat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_plat`
--

DROP TABLE IF EXISTS `type_plat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type_plat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F737670FA4D60759` (`libelle`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_plat`
--

LOCK TABLES `type_plat` WRITE;
/*!40000 ALTER TABLE `type_plat` DISABLE KEYS */;
INSERT INTO `type_plat` VALUES (1,'dessert'),(2,'entrée'),(5,'laitage'),(4,'légume'),(3,'plat');
/*!40000 ALTER TABLE `type_plat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_8D93D649C05FB297` (`confirmation_token`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (2,'test','test','test@test.com','test@test.com',1,'DuDGdFHnixLH7xM93UuZlCIJqyOUlvCVngzLQQpPR6o','test{DuDGdFHnixLH7xM93UuZlCIJqyOUlvCVngzLQQpPR6o}','2017-02-15 09:52:20',NULL,NULL,'a:1:{i:0;s:8:\"ROLE_CAF\";}'),(3,'jerome.bagattin@cafbayonne.cnaf','jerome.bagattin@cafbayonne.cnaf','jerome.bagattin@cafbayonne.cnafmail.fr','jerome.bagattin@cafbayonne.cnafmail.fr',1,'uG/hkjIAxBwhJb2UfeM.mvqKiSvyQAnXQI8eu/DbUUw','LeMot2Passe7gg{uG/hkjIAxBwhJb2UfeM.mvqKiSvyQAnXQI8eu/DbUUw}','2017-03-07 11:30:56',NULL,NULL,'a:3:{i:0;s:11:\"ROLE_AUTEUR\";i:1;s:10:\"ROLE_ADMIN\";i:2;s:6:\"AUTEUR\";}');
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

-- Dump completed on 2017-03-08 16:03:11
