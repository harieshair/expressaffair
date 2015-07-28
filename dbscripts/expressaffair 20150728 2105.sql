-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.31


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema eventmanager
--

CREATE DATABASE IF NOT EXISTS eventmanager;
USE eventmanager;

--
-- Definition of table `catalog_master`
--

DROP TABLE IF EXISTS `catalog_master`;
CREATE TABLE `catalog_master` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catalog_master`
--

/*!40000 ALTER TABLE `catalog_master` DISABLE KEYS */;
INSERT INTO `catalog_master` (`id`,`name`,`description`,`created_on`) VALUES 
 (1,'Size','size','2015-07-18 12:25:41'),
 (2,'Color','Color desc','2015-07-18 15:50:25'),
 (3,'Services','','2015-07-26 13:41:40');
/*!40000 ALTER TABLE `catalog_master` ENABLE KEYS */;


--
-- Definition of table `catalog_value`
--

DROP TABLE IF EXISTS `catalog_value`;
CREATE TABLE `catalog_value` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `catalog_value` varchar(90) DEFAULT NULL,
  `catalogmaster_id` int(10) unsigned DEFAULT NULL,
  `catalogvalue_id` int(10) unsigned DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catalog_value`
--

/*!40000 ALTER TABLE `catalog_value` DISABLE KEYS */;
INSERT INTO `catalog_value` (`id`,`catalog_value`,`catalogmaster_id`,`catalogvalue_id`,`created_on`) VALUES 
 (2,'s1',1,NULL,'2015-07-18 13:20:43'),
 (3,'s2',1,NULL,'2015-07-18 13:20:43'),
 (4,'s3',1,NULL,'2015-07-18 13:20:43'),
 (5,'s4',1,NULL,'2015-07-18 13:20:43'),
 (6,'Red',2,NULL,'2015-07-18 15:50:25'),
 (7,'Green',2,NULL,'2015-07-18 15:50:25'),
 (8,'Yellow',2,NULL,'2015-07-18 15:50:25'),
 (9,'Blue',2,NULL,'2015-07-18 15:50:25'),
 (10,'S5',1,NULL,'2015-07-23 07:48:43'),
 (11,'Mandap',3,NULL,'2015-07-26 13:41:40'),
 (12,'Catering',3,NULL,'2015-07-26 13:41:40');
/*!40000 ALTER TABLE `catalog_value` ENABLE KEYS */;


--
-- Definition of table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(254) DEFAULT NULL,
  `status` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`,`name`,`status`) VALUES 
 (1,'Admin',NULL),
 (2,'Admin',NULL),
 (3,'Vendors',NULL),
 (4,'Vendors',NULL),
 (5,'jkhihgi',NULL),
 (6,'jkhihgi',NULL),
 (7,'fwe',NULL),
 (8,'fwe',NULL),
 (9,'fwe',NULL),
 (10,'fwe',NULL),
 (11,'fwe',NULL),
 (12,'fwe',NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;


--
-- Definition of table `site_log`
--

DROP TABLE IF EXISTS `site_log`;
CREATE TABLE `site_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `message` varchar(254) DEFAULT NULL,
  `log_date` datetime DEFAULT NULL,
  `log_ip` varchar(45) DEFAULT NULL,
  `roleid` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_log`
--

/*!40000 ALTER TABLE `site_log` DISABLE KEYS */;
INSERT INTO `site_log` (`id`,`user_id`,`message`,`log_date`,`log_ip`,`roleid`) VALUES 
 (1,1,'User senthil Logged In','2015-07-25 22:31:52','127.0.0.1',NULL),
 (2,1,'User senthil Logged In','2015-07-25 22:31:52','127.0.0.1',NULL),
 (3,1,'User senthil Logged In','2015-07-25 22:31:52','127.0.0.1',NULL),
 (4,1,'User senthil Logged In','2015-07-25 22:31:52','127.0.0.1',NULL),
 (5,1,'User senthil Logged In','2015-07-25 22:33:41','127.0.0.1',NULL),
 (6,1,'User senthil Logged In','2015-07-25 22:33:41','127.0.0.1',NULL),
 (7,1,'User senthil Logged In','2015-07-25 22:33:41','127.0.0.1',NULL),
 (8,1,'User senthil Logged In','2015-07-25 22:33:41','127.0.0.1',NULL),
 (9,1,'User senthil Logged In','2015-07-25 22:33:41','127.0.0.1',NULL),
 (10,1,'User senthil Logged In','2015-07-26 08:04:17','127.0.0.1',NULL),
 (11,1,'User senthil Logged In','2015-07-26 08:04:17','127.0.0.1',NULL),
 (12,1,'User senthil Logged In','2015-07-26 13:46:19','127.0.0.1',NULL),
 (13,1,'User senthil Logged In','2015-07-26 15:46:23','127.0.0.1',NULL),
 (14,1,'User senthil Logged In','2015-07-26 15:47:11','127.0.0.1',NULL),
 (15,1,'User senthil Logged In','2015-07-26 16:03:09','127.0.0.1',NULL),
 (16,1,'User senthil Logged In','2015-07-26 16:07:02','127.0.0.1',NULL),
 (17,1,'User senthil Logged In','2015-07-26 16:07:02','127.0.0.1',NULL),
 (18,1,'User senthil Logged In','2015-07-26 16:07:02','127.0.0.1',NULL),
 (19,1,'User senthil Logged In','2015-07-26 16:54:50','127.0.0.1',NULL),
 (20,1,'User senthil Logged In','2015-07-26 16:57:56','127.0.0.1',NULL),
 (21,1,'User senthil Logged In','2015-07-26 21:06:58','127.0.0.1',NULL),
 (22,1,'User senthil Logged In','2015-07-26 21:06:58','127.0.0.1',NULL),
 (23,1,'User senthil Logged In','2015-07-26 21:20:19','127.0.0.1',NULL),
 (24,1,'User senthil Logged In','2015-07-26 22:27:25','127.0.0.1',NULL),
 (25,1,'User senthil Logged In','2015-07-26 22:35:26','127.0.0.1',NULL),
 (26,1,'User senthil Logged In','2015-07-26 22:41:25','127.0.0.1',NULL),
 (27,1,'User senthil Logged In','2015-07-27 06:43:05','127.0.0.1',NULL),
 (28,1,'User senthil Logged In','2015-07-27 06:43:05','127.0.0.1',NULL),
 (29,1,'User senthil Logged In','2015-07-28 21:02:48','127.0.0.1',NULL);
/*!40000 ALTER TABLE `site_log` ENABLE KEYS */;


--
-- Definition of table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `role_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;


--
-- Definition of table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `version` int(10) unsigned DEFAULT NULL,
  `login_name` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `usertype` int(10) unsigned DEFAULT NULL,
  `status` int(10) unsigned DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `lastloginip` varchar(45) DEFAULT NULL,
  `employeeid` varchar(45) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `photo` varchar(150) DEFAULT NULL,
  `securitycode` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`,`version`,`login_name`,`password`,`email`,`phone`,`usertype`,`status`,`lastlogin`,`lastloginip`,`employeeid`,`updated_on`,`name`,`photo`,`securitycode`) VALUES 
 (1,1,'admin','078bbb4bf0f7117fb131ec45f15b5b87','senthil@event.com','3213123123123',1,0,'2015-07-28 21:02:48','127.0.0.1','','2015-07-25 22:21:35','senthil',NULL,NULL),
 (2,1,'rajeshes','e360bc13bcba071f4746adbb334cd78e','rajesh@mail.com','23wkwgdsk',1,0,NULL,NULL,'','2015-07-26 16:06:18','rajesh',NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


--
-- Definition of table `vendor`
--

DROP TABLE IF EXISTS `vendor`;
CREATE TABLE `vendor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `phone1` varchar(15) DEFAULT NULL,
  `phone2` varchar(15) DEFAULT NULL,
  `phone3` varchar(15) DEFAULT NULL,
  `contact_person` varchar(45) DEFAULT NULL,
  `profile_images` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

/*!40000 ALTER TABLE `vendor` DISABLE KEYS */;
/*!40000 ALTER TABLE `vendor` ENABLE KEYS */;


--
-- Definition of table `vendor_locations`
--

DROP TABLE IF EXISTS `vendor_locations`;
CREATE TABLE `vendor_locations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` int(10) unsigned DEFAULT NULL,
  `state_id` int(10) unsigned DEFAULT NULL,
  `address_id` int(10) unsigned DEFAULT NULL,
  `contact_person` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `phone1` varchar(15) DEFAULT NULL,
  `phone2` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor_locations`
--

/*!40000 ALTER TABLE `vendor_locations` DISABLE KEYS */;
/*!40000 ALTER TABLE `vendor_locations` ENABLE KEYS */;


--
-- Definition of table `vendor_service_location`
--

DROP TABLE IF EXISTS `vendor_service_location`;
CREATE TABLE `vendor_service_location` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vendor_id` int(10) unsigned DEFAULT NULL,
  `service_id` int(10) unsigned DEFAULT NULL,
  `location_id` int(10) unsigned DEFAULT NULL,
  `package_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor_service_location`
--

/*!40000 ALTER TABLE `vendor_service_location` DISABLE KEYS */;
/*!40000 ALTER TABLE `vendor_service_location` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
