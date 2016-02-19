# ************************************************************
# Sequel Pro SQL dump
# Version 4499
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: abostudio.mx (MySQL 5.5.45-cll-lve)
# Database: abo_masaryk
# Generation Time: 2016-02-19 02:55:30 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table activations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `activations`;

CREATE TABLE `activations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `activations` WRITE;
/*!40000 ALTER TABLE `activations` DISABLE KEYS */;

INSERT INTO `activations` (`id`, `user_id`, `code`, `completed`, `completed_at`, `created_at`, `updated_at`)
VALUES
	(1,1,'SJ5gw1ica7i5372zUBYGJpXdAhwcd0Ot',1,NULL,'2016-01-28 08:55:11','2016-01-28 08:55:11'),
	(2,3,'syMViTDIG6mDKgWZoEzCpggiKxftZz0n',1,'2016-02-01 20:59:13','2016-02-01 20:59:13','2016-02-01 20:59:13'),
	(3,4,'tzXXISeJMK65HZcGdeZcsQ9TvffOCOZk',1,'2016-02-01 21:09:40','2016-02-01 21:09:40','2016-02-01 21:09:40'),
	(4,5,'l4I2XaYvwCVWCmruQieEtxjnrXKVZJoQ',1,'2016-02-01 21:09:46','2016-02-01 21:09:46','2016-02-01 21:09:46'),
	(5,6,'XX6H01a3ljFQFAUU0QctWhW2CF6U5xHX',1,'2016-02-01 21:10:20','2016-02-01 21:10:20','2016-02-01 21:10:20'),
	(6,7,'UFdsQUyz1pFiTQXYScowNOxMDXveuAuw',1,'2016-02-03 06:38:14','2016-02-03 06:38:14','2016-02-03 06:38:14'),
	(7,8,'eFzzcl8ppdKB5XElT0YUESz1eYbOPlVP',1,'2016-02-03 06:46:12','2016-02-03 06:46:12','2016-02-03 06:46:12'),
	(8,9,'uwDWkpcCbbJ3aJvjROMWI8gTTVA6nAEc',1,'2016-02-06 05:22:34','2016-02-06 05:22:34','2016-02-06 05:22:34'),
	(9,10,'lz3IAtbOz0kBKJM3Ww9yldONodgfgrJx',1,'2016-02-06 07:09:04','2016-02-06 07:09:04','2016-02-06 07:09:04'),
	(10,11,'rh4bRmGR1mcUac9FNEFKab78yiGa2QZH',1,'2016-02-06 07:18:44','2016-02-06 07:18:44','2016-02-06 07:18:44');

/*!40000 ALTER TABLE `activations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table activities
# ------------------------------------------------------------

DROP TABLE IF EXISTS `activities`;

CREATE TABLE `activities` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT '',
  `description` text,
  `address` text,
  `date_from` datetime DEFAULT NULL,
  `date_to` datetime DEFAULT NULL,
  `lat` decimal(10,8) DEFAULT NULL,
  `lng` decimal(11,8) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `activities` WRITE;
/*!40000 ALTER TABLE `activities` DISABLE KEYS */;

INSERT INTO `activities` (`id`, `title`, `description`, `address`, `date_from`, `date_to`, `lat`, `lng`, `type_id`, `active`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'Carrera Masaryk','Vive la emoción con la primera carrera deportiva en Av. Masaryk.','Masaryk #451','2016-01-31 16:30:00','2016-01-31 17:30:00',19.43015530,-99.19506210,2,1,'2016-02-01 04:57:00','2016-02-04 05:47:07',NULL),
	(2,'Clases de Yoga','¡Continúan las actividades en Av. Masaryk! Realizan clase masiva de Yoga!','Masaryk #54','2016-01-31 14:00:00','2016-01-31 14:45:00',19.43161226,-99.19712204,1,1,'2016-02-01 04:57:34','2016-02-04 05:44:01',NULL),
	(3,'México y Reino Unido celebran con subasta','México y Reino Unido celebran con una subasta con grandes premios.','Masaryk #201','2016-02-03 09:15:00','2016-02-03 10:00:00',19.43193602,-99.19935363,1,1,'2016-02-04 05:46:59','2016-02-04 05:46:59',NULL),
	(4,'Fashion Night','Celebra una noche con música DJ.','Masaryk #101','2016-02-03 13:00:00','2016-02-03 15:00:00',19.43015530,-99.19506210,2,1,'2016-02-04 05:48:27','2016-02-04 05:48:27',NULL);

/*!40000 ALTER TABLE `activities` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table activities_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `activities_type`;

CREATE TABLE `activities_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `activities_type` WRITE;
/*!40000 ALTER TABLE `activities_type` DISABLE KEYS */;

INSERT INTO `activities_type` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'Gratuito',NULL,NULL,NULL),
	(2,'Paga',NULL,NULL,NULL);

/*!40000 ALTER TABLE `activities_type` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table beacons
# ------------------------------------------------------------

DROP TABLE IF EXISTS `beacons`;

CREATE TABLE `beacons` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `beacons` WRITE;
/*!40000 ALTER TABLE `beacons` DISABLE KEYS */;

INSERT INTO `beacons` (`id`, `uuid`, `active`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'0117C5358438',1,'2016-02-01 05:54:41','2016-02-01 05:54:41',NULL);

/*!40000 ALTER TABLE `beacons` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`migration`, `batch`)
VALUES
	('2014_10_12_000000_create_users_table',1),
	('2014_10_12_100000_create_password_resets_table',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table persistences
# ------------------------------------------------------------

DROP TABLE IF EXISTS `persistences`;

CREATE TABLE `persistences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `persistences_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `persistences` WRITE;
/*!40000 ALTER TABLE `persistences` DISABLE KEYS */;

INSERT INTO `persistences` (`id`, `user_id`, `code`, `created_at`, `updated_at`)
VALUES
	(1,1,'qjc9zuV9f3aapCEThWZgbE30kez0Tx7E','2016-01-28 08:55:39','2016-01-28 08:55:39'),
	(2,1,'c9Vqd21cKxYQ1fvXWFFtYxDVBRyrMc3Q','2016-01-28 08:56:27','2016-01-28 08:56:27'),
	(3,1,'WFjnb5xYE62qI9voE7S3G2Ag9N9w3d0S','2016-01-30 04:27:45','2016-01-30 04:27:45'),
	(4,1,'epwlfk0hLVHwetJcAQ5AqhwkQgxf3ZJW','2016-01-30 07:05:15','2016-01-30 07:05:15'),
	(5,1,'S4KJcvs4KQMJqONXSUCUNHjW6Vo2zn3z','2016-01-30 19:01:15','2016-01-30 19:01:15'),
	(19,1,'DJkQNbLOUpV7JAjdZudN6bOpptX0ZtUW','2016-02-02 01:43:02','2016-02-02 01:43:02'),
	(20,1,'yRfcIS3J5aYVsDpThHPknKEnuxAuxpm4','2016-02-02 01:43:27','2016-02-02 01:43:27'),
	(21,1,'ATANxg44q57aQoncvtdIAaKfl9hJLt4Y','2016-02-02 01:43:33','2016-02-02 01:43:33'),
	(22,1,'iI6SIYO0k85qWanE4ZFydHrS31k2ZBdj','2016-02-02 01:43:54','2016-02-02 01:43:54'),
	(23,1,'j0Z2WIU28o7wIeruN737yWDvAqRy2XMv','2016-02-02 01:44:06','2016-02-02 01:44:06'),
	(24,1,'pevkXeAEbPIP0IyrJPdKF0mYynLIPbFx','2016-02-02 01:44:41','2016-02-02 01:44:41'),
	(25,1,'JwwLBolvNrQb6zE9Hnsxk0DPKpQQO3yw','2016-02-02 01:44:47','2016-02-02 01:44:47'),
	(26,1,'3LSeQPN3In96nPg1168XAQZ64yLnkuPp','2016-02-02 01:44:50','2016-02-02 01:44:50'),
	(27,1,'lD642lpjBLavnWW161cRXeAzGPp05kfV','2016-02-02 01:45:00','2016-02-02 01:45:00'),
	(29,1,'kV1cggthC1rZPOrBokFZSdC2PnnoOwDW','2016-02-02 15:14:31','2016-02-02 15:14:31'),
	(32,1,'rmRDabJv4bDdGnZwTrDqwpRrM1H2JLZD','2016-02-02 16:23:41','2016-02-02 16:23:41'),
	(33,1,'RUnlELOBXZK6znxzCWExh2oEKfkcWHrW','2016-02-02 18:35:32','2016-02-02 18:35:32'),
	(34,1,'0TnC30bp0QSMkoB1slYa3dXuMN2cx1ls','2016-02-02 18:35:37','2016-02-02 18:35:37'),
	(35,1,'mKTBx6cfH2pGfXK2WTPXRpmeOBKIOFCV','2016-02-02 18:46:44','2016-02-02 18:46:44'),
	(36,1,'IF4XAY74lXHBGdsiY4wk3bJ7sAny7OOt','2016-02-02 18:46:45','2016-02-02 18:46:45'),
	(37,1,'kcKM2gr9eQ3u5uULF2IPmRdYiOy2EeTW','2016-02-03 00:02:24','2016-02-03 00:02:24'),
	(38,1,'ydlorCgDW4DQzwO2IGbo8lLLfpRxMk5N','2016-02-03 00:04:08','2016-02-03 00:04:08'),
	(39,1,'ygGEfFF1KmcPToN1iHa7IsQ1nqwZ8hu2','2016-02-03 00:06:10','2016-02-03 00:06:10'),
	(40,1,'ZN0EVTt9xHSyAgmCFHZL5SJy7nGkU0RY','2016-02-03 00:11:10','2016-02-03 00:11:10'),
	(41,1,'ZVdGsf8tQuzql0eVsG9dq02SnW6Ulutn','2016-02-03 00:12:31','2016-02-03 00:12:31'),
	(42,1,'SvICZDAEdnOsZN3FhLZRE3qEML16ELv4','2016-02-03 00:12:32','2016-02-03 00:12:32'),
	(43,1,'JaPyzS6nXivqjgilLYTLSs5oprsTFWXz','2016-02-03 00:16:14','2016-02-03 00:16:14'),
	(44,1,'nuR7SK58u1PgQmENqugBeewN0zwL9isL','2016-02-03 01:03:46','2016-02-03 01:03:46'),
	(45,1,'X0lWeCALN8GLfKRDVEXVula0eTyEDdTx','2016-02-03 02:42:11','2016-02-03 02:42:11'),
	(46,7,'sF3C7XL87zUf4ZIs1Zg9rnsEyJZyH1FQ','2016-02-03 06:38:14','2016-02-03 06:38:14'),
	(47,8,'3RzHXsMLsWtJ4gZe8V46RipfADExqdG3','2016-02-03 06:46:12','2016-02-03 06:46:12'),
	(48,1,'6UDpvkoBUxXMCUI3Q9DPpVMh9ttNJvHZ','2016-02-03 06:50:31','2016-02-03 06:50:31'),
	(49,1,'sK5QGOQv38J2RATfMsGnyUaDJhBwJIry','2016-02-04 00:35:47','2016-02-04 00:35:47'),
	(50,1,'qYalSXo2b6SgUEPelFKs2bTS432MZ8I0','2016-02-04 00:48:04','2016-02-04 00:48:04'),
	(52,1,'6O4YR3dlCMG2f8rVXZlCYODstXywCiST','2016-02-04 22:52:19','2016-02-04 22:52:19'),
	(53,1,'DOzWgGWDp5DRwS8FzlMsmEcXbyPvYslt','2016-02-05 06:47:45','2016-02-05 06:47:45'),
	(54,9,'i5Ar12Qh0MQLQ7k5oO0cgj7VvohwyeNo','2016-02-06 05:22:34','2016-02-06 05:22:34'),
	(55,7,'wOT21dNBlqrwOHEQvTUkRkGl9dylvnMZ','2016-02-06 06:31:07','2016-02-06 06:31:07'),
	(56,7,'40tiD2nnpqw5bNMW1wyLB2Td8inXRIQc','2016-02-06 06:34:17','2016-02-06 06:34:17'),
	(57,10,'FgbOOOEMDIh2GV6mUhFZJR1gxIeB3T7G','2016-02-06 07:09:04','2016-02-06 07:09:04'),
	(58,11,'nErV8X21WZ04l63zXQBYewoVDzJ15Dgz','2016-02-06 07:18:44','2016-02-06 07:18:44'),
	(59,1,'kqAn3TA66WZ0jNsp5RW9Sunm6yFocqEL','2016-02-17 01:27:29','2016-02-17 01:27:29'),
	(60,1,'4id4XtcdB89OJw21TYm7SNU2ZVCx2tDQ','2016-02-18 05:31:39','2016-02-18 05:31:39'),
	(61,1,'xiCrVifNREJZODkAI2JgRqlvX4ITz5lL','2016-02-18 07:47:58','2016-02-18 07:47:58'),
	(62,1,'FzepNDoINboZA4icVTqd0bF8xsYm58Ta','2016-02-19 02:07:47','2016-02-19 02:07:47'),
	(63,1,'DUdL5XkJZM4PKi6v4iCyAWgoNGaubfnR','2016-02-19 02:16:42','2016-02-19 02:16:42'),
	(64,1,'rIoFmh4xqwlRzBldxgPVVQMWBSTnsJFK','2016-02-19 02:45:28','2016-02-19 02:45:28');

/*!40000 ALTER TABLE `persistences` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table promos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `promos`;

CREATE TABLE `promos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `beacon_id` int(11) DEFAULT '0',
  `store_id` int(11) DEFAULT '0',
  `active` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `promos` WRITE;
/*!40000 ALTER TABLE `promos` DISABLE KEYS */;

INSERT INTO `promos` (`id`, `title`, `beacon_id`, `store_id`, `active`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(2,'Barbería Capital',0,0,1,'2016-02-01 05:32:09','2016-02-03 07:38:18',NULL),
	(3,'Raven Music',0,1,1,'2016-02-01 06:43:44','2016-02-03 07:40:03',NULL),
	(4,'Harry Grill',0,0,1,'2016-02-03 07:41:08','2016-02-03 07:41:08',NULL),
	(5,'De Antro',0,0,1,'2016-02-03 07:41:53','2016-02-03 07:41:53',NULL),
	(6,'Celtics',0,0,1,'2016-02-03 07:42:47','2016-02-03 07:42:47',NULL),
	(7,'Las Alitas',0,0,1,'2016-02-03 07:43:08','2016-02-03 07:43:08',NULL),
	(8,'Costeñito Market',0,0,1,'2016-02-03 07:43:40','2016-02-03 07:43:40',NULL),
	(9,'The Key',0,0,1,'2016-02-03 07:44:18','2016-02-03 07:44:18',NULL),
	(10,'La Chilanguita',0,0,1,'2016-02-03 07:45:20','2016-02-03 07:45:20',NULL);

/*!40000 ALTER TABLE `promos` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table promos_stores
# ------------------------------------------------------------

DROP TABLE IF EXISTS `promos_stores`;

CREATE TABLE `promos_stores` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `promo_id` int(11) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table reminders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reminders`;

CREATE TABLE `reminders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `reminders` WRITE;
/*!40000 ALTER TABLE `reminders` DISABLE KEYS */;

INSERT INTO `reminders` (`id`, `user_id`, `code`, `completed`, `completed_at`, `created_at`, `updated_at`)
VALUES
	(12,1,'9YDRAy19RNi1Gt9gbZt4qBsSWOybjnbE',1,'2016-02-02 00:48:03','2016-02-02 00:46:56','2016-02-02 00:48:03'),
	(13,1,'u6EuuWN5CAH2DCgweehrJMaBVZFEuif5',1,'2016-02-02 00:50:39','2016-02-02 00:50:20','2016-02-02 00:50:39'),
	(14,1,'wcFdrD1pwjoac7mQyeiFGUCpVGDv4NNF',1,'2016-02-02 00:59:53','2016-02-02 00:58:46','2016-02-02 00:59:53'),
	(15,1,'dJQgIgJyJDDHA9BOVozj2LrFpMYbwU7t',1,'2016-02-02 01:24:44','2016-02-02 01:24:30','2016-02-02 01:24:44');

/*!40000 ALTER TABLE `reminders` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table role_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `role_users`;

CREATE TABLE `role_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `role_users` WRITE;
/*!40000 ALTER TABLE `role_users` DISABLE KEYS */;

INSERT INTO `role_users` (`user_id`, `role_id`, `created_at`, `updated_at`)
VALUES
	(1,1,'2016-01-30 20:20:08','2016-01-30 20:20:08');

/*!40000 ALTER TABLE `role_users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `slug`, `name`, `permissions`, `created_at`, `updated_at`)
VALUES
	(1,'admin','Admin','{\"access.admin\":true}','2016-01-30 13:22:30','2016-01-30 20:22:30');

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table stores
# ------------------------------------------------------------

DROP TABLE IF EXISTS `stores`;

CREATE TABLE `stores` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `address` text,
  `phone` varchar(100) DEFAULT NULL,
  `lat` decimal(10,8) DEFAULT NULL,
  `lng` decimal(11,8) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `stores` WRITE;
/*!40000 ALTER TABLE `stores` DISABLE KEYS */;

INSERT INTO `stores` (`id`, `title`, `address`, `phone`, `lat`, `lng`, `type_id`, `active`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'Prada ','Flannel cliche taxidermy mustache consequat, pariatur lo-fi DIY sartorial green juice chia odio try-hard fanny pack.','55555555',19.43015530,-99.19506210,2,1,'2016-01-31 07:30:03','2016-02-04 08:53:26',NULL),
	(2,'Dolce Gabanna','Flannel cliche taxidermy mustache consequat, pariatur lo-fi DIY sartorial green juice chia odio try-hard fanny pack.','55555555',19.43193602,-99.19677871,0,1,'2016-02-03 09:01:58','2016-02-03 09:01:58',NULL),
	(3,'Mac Store','Flannel cliche taxidermy mustache consequat, pariatur lo-fi DIY sartorial green juice chia odio try-hard fanny pack.','55555555',19.43145037,-99.18733734,2,1,'2016-02-03 09:04:57','2016-02-03 09:04:57',NULL),
	(4,'Porche','Flannel cliche taxidermy mustache consequat, pariatur lo-fi DIY sartorial green juice chia odio try-hard fanny pack.','55555555',19.43234073,-99.20192856,2,1,'2016-02-03 09:05:45','2016-02-03 09:05:45',NULL),
	(5,'Nesspreso','Flannel cliche taxidermy mustache consequat, pariatur lo-fi DIY sartorial green juice chia odio try-hard fanny pack.','55555555',19.43015530,-99.19506210,1,1,'2016-02-03 09:06:25','2016-02-03 09:06:25',NULL),
	(6,'Channel','Flannel cliche taxidermy mustache consequat, pariatur lo-fi DIY sartorial green juice chia odio try-hard fanny pack.','55555555',19.43145037,-99.19291633,2,1,'2016-02-03 09:06:54','2016-02-03 09:07:02',NULL);

/*!40000 ALTER TABLE `stores` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table stores_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `stores_type`;

CREATE TABLE `stores_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `stores_type` WRITE;
/*!40000 ALTER TABLE `stores_type` DISABLE KEYS */;

INSERT INTO `stores_type` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'Restaurante',NULL,NULL,NULL),
	(2,'Tienda',NULL,NULL,NULL);

/*!40000 ALTER TABLE `stores_type` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table throttle
# ------------------------------------------------------------

DROP TABLE IF EXISTS `throttle`;

CREATE TABLE `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `throttle_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `throttle` WRITE;
/*!40000 ALTER TABLE `throttle` DISABLE KEYS */;

INSERT INTO `throttle` (`id`, `user_id`, `type`, `ip`, `created_at`, `updated_at`)
VALUES
	(1,NULL,'global',NULL,'2016-01-30 04:28:18','2016-01-30 04:28:18'),
	(2,NULL,'ip','187.230.14.27','2016-01-30 04:28:18','2016-01-30 04:28:18'),
	(3,1,'user',NULL,'2016-01-30 04:28:18','2016-01-30 04:28:18'),
	(4,NULL,'global',NULL,'2016-01-30 04:33:52','2016-01-30 04:33:52'),
	(5,NULL,'ip','187.230.14.27','2016-01-30 04:33:52','2016-01-30 04:33:52'),
	(6,1,'user',NULL,'2016-01-30 04:33:52','2016-01-30 04:33:52'),
	(7,NULL,'global',NULL,'2016-01-31 21:27:16','2016-01-31 21:27:16'),
	(8,NULL,'ip','187.190.155.170','2016-01-31 21:27:16','2016-01-31 21:27:16'),
	(9,1,'user',NULL,'2016-01-31 21:27:16','2016-01-31 21:27:16'),
	(10,NULL,'global',NULL,'2016-01-31 21:27:23','2016-01-31 21:27:23'),
	(11,NULL,'ip','187.190.155.170','2016-01-31 21:27:23','2016-01-31 21:27:23'),
	(12,1,'user',NULL,'2016-01-31 21:27:23','2016-01-31 21:27:23'),
	(13,NULL,'global',NULL,'2016-01-31 21:27:31','2016-01-31 21:27:31'),
	(14,NULL,'ip','187.190.155.170','2016-01-31 21:27:31','2016-01-31 21:27:31'),
	(15,1,'user',NULL,'2016-01-31 21:27:31','2016-01-31 21:27:31'),
	(16,NULL,'global',NULL,'2016-01-31 21:27:39','2016-01-31 21:27:39'),
	(17,NULL,'ip','187.190.155.170','2016-01-31 21:27:39','2016-01-31 21:27:39'),
	(18,1,'user',NULL,'2016-01-31 21:27:39','2016-01-31 21:27:39'),
	(19,NULL,'global',NULL,'2016-02-01 15:15:31','2016-02-01 15:15:31'),
	(20,NULL,'ip','189.191.60.194','2016-02-01 15:15:31','2016-02-01 15:15:31'),
	(21,1,'user',NULL,'2016-02-01 15:15:31','2016-02-01 15:15:31'),
	(22,NULL,'global',NULL,'2016-02-01 15:15:37','2016-02-01 15:15:37'),
	(23,NULL,'ip','189.191.60.194','2016-02-01 15:15:37','2016-02-01 15:15:37'),
	(24,1,'user',NULL,'2016-02-01 15:15:37','2016-02-01 15:15:37'),
	(25,NULL,'global',NULL,'2016-02-01 15:15:43','2016-02-01 15:15:43'),
	(26,NULL,'ip','189.191.60.194','2016-02-01 15:15:43','2016-02-01 15:15:43'),
	(27,1,'user',NULL,'2016-02-01 15:15:43','2016-02-01 15:15:43'),
	(28,NULL,'global',NULL,'2016-02-01 15:15:48','2016-02-01 15:15:48'),
	(29,NULL,'ip','189.191.60.194','2016-02-01 15:15:48','2016-02-01 15:15:48'),
	(30,1,'user',NULL,'2016-02-01 15:15:48','2016-02-01 15:15:48'),
	(31,NULL,'global',NULL,'2016-02-02 00:51:32','2016-02-02 00:51:32'),
	(32,NULL,'ip','187.230.14.27','2016-02-02 00:51:32','2016-02-02 00:51:32'),
	(33,1,'user',NULL,'2016-02-02 00:51:32','2016-02-02 00:51:32'),
	(34,NULL,'global',NULL,'2016-02-02 00:52:00','2016-02-02 00:52:00'),
	(35,NULL,'ip','187.230.14.27','2016-02-02 00:52:00','2016-02-02 00:52:00'),
	(36,1,'user',NULL,'2016-02-02 00:52:00','2016-02-02 00:52:00'),
	(37,NULL,'global',NULL,'2016-02-02 01:42:33','2016-02-02 01:42:33'),
	(38,NULL,'ip','187.230.14.27','2016-02-02 01:42:33','2016-02-02 01:42:33'),
	(39,NULL,'global',NULL,'2016-02-02 05:12:17','2016-02-02 05:12:17'),
	(40,NULL,'ip','189.191.60.194','2016-02-02 05:12:17','2016-02-02 05:12:17'),
	(41,NULL,'global',NULL,'2016-02-02 18:46:49','2016-02-02 18:46:49'),
	(42,NULL,'ip','187.230.14.27','2016-02-02 18:46:49','2016-02-02 18:46:49'),
	(43,NULL,'global',NULL,'2016-02-03 02:22:08','2016-02-03 02:22:08'),
	(44,NULL,'ip','187.190.155.170','2016-02-03 02:22:08','2016-02-03 02:22:08'),
	(45,NULL,'global',NULL,'2016-02-03 02:22:11','2016-02-03 02:22:11'),
	(46,NULL,'ip','187.190.155.170','2016-02-03 02:22:11','2016-02-03 02:22:11'),
	(47,NULL,'global',NULL,'2016-02-03 02:22:16','2016-02-03 02:22:16'),
	(48,NULL,'ip','187.190.155.170','2016-02-03 02:22:16','2016-02-03 02:22:16'),
	(49,NULL,'global',NULL,'2016-02-03 02:22:19','2016-02-03 02:22:19'),
	(50,NULL,'ip','187.190.155.170','2016-02-03 02:22:19','2016-02-03 02:22:19'),
	(51,NULL,'global',NULL,'2016-02-03 02:22:23','2016-02-03 02:22:23'),
	(52,NULL,'ip','187.190.155.170','2016-02-03 02:22:23','2016-02-03 02:22:23'),
	(53,NULL,'global',NULL,'2016-02-03 02:22:39','2016-02-03 02:22:39'),
	(54,NULL,'ip','187.190.155.170','2016-02-03 02:22:39','2016-02-03 02:22:39'),
	(55,NULL,'global',NULL,'2016-02-04 22:50:10','2016-02-04 22:50:10'),
	(56,NULL,'ip','189.191.60.194','2016-02-04 22:50:10','2016-02-04 22:50:10'),
	(57,NULL,'global',NULL,'2016-02-18 05:30:53','2016-02-18 05:30:53'),
	(58,NULL,'global',NULL,'2016-02-18 05:30:53','2016-02-18 05:30:53'),
	(59,NULL,'ip','201.153.252.173','2016-02-18 05:30:53','2016-02-18 05:30:53'),
	(60,NULL,'ip','201.153.252.173','2016-02-18 05:30:53','2016-02-18 05:30:53'),
	(61,NULL,'global',NULL,'2016-02-18 07:37:40','2016-02-18 07:37:40'),
	(62,NULL,'ip','201.153.252.173','2016-02-18 07:37:40','2016-02-18 07:37:40'),
	(63,NULL,'global',NULL,'2016-02-18 07:37:43','2016-02-18 07:37:43'),
	(64,NULL,'ip','201.153.252.173','2016-02-18 07:37:43','2016-02-18 07:37:43'),
	(65,NULL,'global',NULL,'2016-02-18 07:37:50','2016-02-18 07:37:50'),
	(66,NULL,'ip','201.153.252.173','2016-02-18 07:37:50','2016-02-18 07:37:50');

/*!40000 ALTER TABLE `throttle` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `facebook_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_token` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `facebook_id`, `email`, `password`, `first_name`, `last_name`, `city`, `birthday`, `remember_token`, `facebook_token`, `created_at`, `updated_at`, `deleted_at`, `last_login`)
VALUES
	(1,'100000119631602','daniel.fer@avanna.com.mx','$2y$10$DVtfLJukAu5z3qCDpY5uwe/9WcBjH6/Xk5ISkUQLJUf2z4RW4hq.m','Daniel','Fernandez','México','0000-00-00','$2y$10$Q4XwT1cHHOVZRe.pa5Z0NOIroMxBj7q0UOjFgufPvkVAc88XMHPKG','CAAO2AcRaUI0BAELqSyT8gZBcWyOWznD5mtPCTE3EUatDfvPpclhbU6s3f7EGCZB1thi0P4Nqj76Lr44VPFyhLwHK62e9dlxp1kkYmaSwFcus852NqCxWfZCURZBk8hBZCSVmlkwXCBf5kdORpfDS1HUP6FF1d6JjbQW78VZBvhZAplDxtUjH6UCnZBnDLPmbZCz4lliitkhBvVWTkUw29sJ7ZATBOMJzuHB9fcT6anWYpnqgZDZD','2016-02-18 19:45:28','2016-02-19 02:45:28',NULL,'2016-02-19 02:45:28'),
	(2,'','john.doe@example.com','$2y$10$QI2pcHK2vvSkVdFYLOEjGu1GRMuz.oYZ5JeQWnBbD.6hZQfVoRP6S','John','Doe','México','2014-03-10','$2y$10$OleO8N6IURAGF58pI8jQi.MIMTrr9mGb6/zkPJ73RzgNffRhBPwra','','2016-02-18 17:26:05','2016-02-01 22:41:06',NULL,'0000-00-00 00:00:00'),
	(3,'','juanperez@hotmail.com','$2y$10$hI7DSjqOPxEJLrMsVzFmg.5NfN6Ss0mc8FRvHw0UassmltnTLPpNK','Juan','Peréz','México','0000-00-00','$2y$10$ZIwuLtjkVqT5hDlhyMuthenZjBDVUAZAsdSxyHKoHC/qYvNlc/VeW','','2016-02-18 17:26:06','2016-02-01 20:59:13',NULL,'0000-00-00 00:00:00'),
	(4,'','lamaria@gmail.com','$2y$10$2hCE.p8U/gcsQZmK2dstzuwV6t5rOcEn3V0WwUzyEkUCiskVug3NK','María','Saenz','Sonora','0000-00-00','$2y$10$lTwGUay8IhKOdSXHJbLFBeU.6R.AN6MHhlbqOWclK4TqtZzt4XJ1.','','2016-02-01 18:52:49','2016-02-01 21:09:40',NULL,'0000-00-00 00:00:00'),
	(5,'','cmurillo@outlook.com','$2y$10$POyNQ8BQN.jgNLm4Q5A2quehSWB19F33kPSV7LX82vtZ3yttEx6mC','Carlos','Murillo','Villahermosa','0000-00-00','$2y$10$3kaifWKXAs4C.16Q0yp7AeAexaOph6ZdSRNhrg.ry2CfUsymSGfKa','','2016-02-01 18:52:52','2016-02-01 21:09:46',NULL,'0000-00-00 00:00:00'),
	(6,'','javi@yahoo.com.mx','$2y$10$MObvi6o7tYsXx0NDPJ46teGO8fVBa43dHb3I8VqWF7Y3PIfXbTpFa','Javier','Ortega','Mexico','0000-00-00','$2y$10$fY9yn.6uicMYlRDt8uRe.eAh0dCfVV1r6SQ6DpWMLZtJp2hL8g5Dq','','2016-02-01 18:52:57','2016-02-01 21:10:20',NULL,'0000-00-00 00:00:00');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users_activities
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users_activities`;

CREATE TABLE `users_activities` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `activity_id` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
