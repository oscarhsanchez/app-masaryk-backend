# ************************************************************
# Sequel Pro SQL dump
# Version 4499
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: abostudio.mx (MySQL 5.5.45-cll-lve)
# Database: abo_masaryk
# Generation Time: 2016-02-02 02:10:23 +0000
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
	(5,6,'XX6H01a3ljFQFAUU0QctWhW2CF6U5xHX',1,'2016-02-01 21:10:20','2016-02-01 21:10:20','2016-02-01 21:10:20');

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
	(1,'Actividad 1','Una descripción','Test','2016-01-31 00:00:00','2016-01-31 00:00:00',19.43015530,-99.19506210,1,1,'2016-02-01 04:57:00','2016-02-01 04:57:00',NULL),
	(2,'Actividad 2','Una descripción','Test','2016-01-31 00:00:00','2016-01-31 00:00:00',19.43015530,-99.19506210,1,1,'2016-02-01 04:57:34','2016-02-01 04:57:34',NULL);

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
	(18,1,'hFgCV1OZLkwB6yeoldnGF9TqQIPU1g2Y','2016-02-02 01:42:17','2016-02-02 01:42:17'),
	(19,1,'DJkQNbLOUpV7JAjdZudN6bOpptX0ZtUW','2016-02-02 01:43:02','2016-02-02 01:43:02'),
	(20,1,'yRfcIS3J5aYVsDpThHPknKEnuxAuxpm4','2016-02-02 01:43:27','2016-02-02 01:43:27'),
	(21,1,'ATANxg44q57aQoncvtdIAaKfl9hJLt4Y','2016-02-02 01:43:33','2016-02-02 01:43:33'),
	(22,1,'iI6SIYO0k85qWanE4ZFydHrS31k2ZBdj','2016-02-02 01:43:54','2016-02-02 01:43:54'),
	(23,1,'j0Z2WIU28o7wIeruN737yWDvAqRy2XMv','2016-02-02 01:44:06','2016-02-02 01:44:06'),
	(24,1,'pevkXeAEbPIP0IyrJPdKF0mYynLIPbFx','2016-02-02 01:44:41','2016-02-02 01:44:41'),
	(25,1,'JwwLBolvNrQb6zE9Hnsxk0DPKpQQO3yw','2016-02-02 01:44:47','2016-02-02 01:44:47'),
	(26,1,'3LSeQPN3In96nPg1168XAQZ64yLnkuPp','2016-02-02 01:44:50','2016-02-02 01:44:50'),
	(27,1,'lD642lpjBLavnWW161cRXeAzGPp05kfV','2016-02-02 01:45:00','2016-02-02 01:45:00'),
	(28,1,'VrhrBQv73wqhkkQUmMdx8dRmFdSuTyQR','2016-02-02 01:58:37','2016-02-02 01:58:37');

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
	(2,'Promo 1',0,0,1,'2016-02-01 05:32:09','2016-02-01 05:32:09',NULL),
	(3,'Promo 2',0,1,1,'2016-02-01 06:43:44','2016-02-01 06:43:44',NULL);

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
	(1,1,'IIlBRdY2rTIaV9TCKw2vQSSTZP5Lw5r3',0,NULL,'2016-02-01 23:27:42','2016-02-01 23:27:42'),
	(2,1,'9drMHBInt3eSlaahebJ9xM5xyMThsEz2',0,NULL,'2016-02-02 00:31:44','2016-02-02 00:31:44'),
	(3,1,'aM4wtcn2lVuTiZMGVNyWjejMQpIIqETH',0,NULL,'2016-02-02 00:33:13','2016-02-02 00:33:13'),
	(4,1,'lBTkK3bm1odKSbtsGi0yWwuH1RNkhvz4',0,NULL,'2016-02-02 00:33:48','2016-02-02 00:33:48'),
	(5,1,'iPs8oPyQ2b3ncd7vmcczltUb6RannHg7',0,NULL,'2016-02-02 00:35:37','2016-02-02 00:35:37'),
	(6,1,'CIDTL4fWLAK7g6UyK71mEDtwXJd5MJSV',0,NULL,'2016-02-02 00:37:33','2016-02-02 00:37:33'),
	(7,1,'Rx7sg0bW3tpeSjpxXdR7JziigK2crpYU',0,NULL,'2016-02-02 00:37:58','2016-02-02 00:37:58'),
	(8,1,'1I6NnLQ5onyvqwTe8WeiM5Spy97w8l2X',0,NULL,'2016-02-02 00:39:37','2016-02-02 00:39:37'),
	(9,1,'9b0LoPdJIk18mlcMjm8gKqe9NhydFbLR',0,NULL,'2016-02-02 00:41:13','2016-02-02 00:41:13'),
	(10,1,'XsZz3nN9fmqAXcRwxAsrFu62WB4MLAQP',0,NULL,'2016-02-02 00:41:15','2016-02-02 00:41:15'),
	(11,1,'WFizIkSBgCVQ8Y030lkLWNiMDhOsZmyE',0,NULL,'2016-02-02 00:41:50','2016-02-02 00:41:50'),
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
	(1,'Tienda 1','Flannel cliche taxidermy mustache consequat, pariatur lo-fi DIY sartorial green juice chia odio try-hard fanny pack.','55-55-55-55',19.43015530,-99.19506210,1,1,'2016-01-31 07:30:03','2016-01-31 07:30:03',NULL);

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
	(38,NULL,'ip','187.230.14.27','2016-02-02 01:42:33','2016-02-02 01:42:33');

/*!40000 ALTER TABLE `throttle` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` timestamp NULL DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
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

INSERT INTO `users` (`id`, `first_name`, `last_name`, `city`, `birthday`, `email`, `password`, `remember_token`, `facebook_token`, `created_at`, `updated_at`, `deleted_at`, `last_login`)
VALUES
	(1,'Daniel','Fernandez','Mexico','0000-00-00 00:00:00','daniel.fer@avanna.com.mx','$2y$10$DVtfLJukAu5z3qCDpY5uwe/9WcBjH6/Xk5ISkUQLJUf2z4RW4hq.m','$2y$10$Q4XwT1cHHOVZRe.pa5Z0NOIroMxBj7q0UOjFgufPvkVAc88XMHPKG','','2016-02-01 18:58:37','2016-02-02 01:58:37',NULL,'2016-02-02 01:58:37'),
	(2,'John','Doe','Mexico','2014-03-10 00:00:00','john.doe@example.com','$2y$10$QI2pcHK2vvSkVdFYLOEjGu1GRMuz.oYZ5JeQWnBbD.6hZQfVoRP6S','$2y$10$OleO8N6IURAGF58pI8jQi.MIMTrr9mGb6/zkPJ73RzgNffRhBPwra','','2016-02-01 18:52:39','2016-02-01 22:41:06',NULL,'0000-00-00 00:00:00'),
	(3,'Juan','Peréz','Mexico','0000-00-00 00:00:00','juanperez@hotmail.com','$2y$10$hI7DSjqOPxEJLrMsVzFmg.5NfN6Ss0mc8FRvHw0UassmltnTLPpNK','$2y$10$ZIwuLtjkVqT5hDlhyMuthenZjBDVUAZAsdSxyHKoHC/qYvNlc/VeW','','2016-02-01 18:52:44','2016-02-01 20:59:13',NULL,'0000-00-00 00:00:00'),
	(4,'María','Saenz','Sonora','0000-00-00 00:00:00','lamaria@gmail.com','$2y$10$2hCE.p8U/gcsQZmK2dstzuwV6t5rOcEn3V0WwUzyEkUCiskVug3NK','$2y$10$lTwGUay8IhKOdSXHJbLFBeU.6R.AN6MHhlbqOWclK4TqtZzt4XJ1.','','2016-02-01 18:52:49','2016-02-01 21:09:40',NULL,'0000-00-00 00:00:00'),
	(5,'Carlos','Murillo','Villahermosa','0000-00-00 00:00:00','cmurillo@outlook.com','$2y$10$POyNQ8BQN.jgNLm4Q5A2quehSWB19F33kPSV7LX82vtZ3yttEx6mC','$2y$10$3kaifWKXAs4C.16Q0yp7AeAexaOph6ZdSRNhrg.ry2CfUsymSGfKa','','2016-02-01 18:52:52','2016-02-01 21:09:46',NULL,'0000-00-00 00:00:00'),
	(6,'Javier','Ortega','Mexico','0000-00-00 00:00:00','javi@yahoo.com.mx','$2y$10$MObvi6o7tYsXx0NDPJ46teGO8fVBa43dHb3I8VqWF7Y3PIfXbTpFa','$2y$10$fY9yn.6uicMYlRDt8uRe.eAh0dCfVV1r6SQ6DpWMLZtJp2hL8g5Dq','','2016-02-01 18:52:57','2016-02-01 21:10:20',NULL,'0000-00-00 00:00:00');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users_info
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users_info`;

CREATE TABLE `users_info` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `surename` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `birthday` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `users_info` WRITE;
/*!40000 ALTER TABLE `users_info` DISABLE KEYS */;

INSERT INTO `users_info` (`id`, `user_id`, `name`, `surename`, `city`, `birthday`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,1,'Test','test','asddas','0000-00-00 00:00:00',NULL,NULL,NULL);

/*!40000 ALTER TABLE `users_info` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
