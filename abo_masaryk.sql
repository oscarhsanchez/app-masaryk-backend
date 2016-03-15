# ************************************************************
# Sequel Pro SQL dump
# Version 4529
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: abostudio.mx (MySQL 5.5.45-cll-lve)
# Database: abo_masaryk
# Generation Time: 2016-03-15 07:17:31 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


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
  `date_alert` datetime DEFAULT NULL,
  `lat` decimal(10,8) DEFAULT NULL,
  `lng` decimal(11,8) DEFAULT NULL,
  `url` text,
  `type_id` int(11) DEFAULT NULL,
  `status_id` tinyint(4) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `activities` WRITE;
/*!40000 ALTER TABLE `activities` DISABLE KEYS */;

INSERT INTO `activities` (`id`, `title`, `description`, `address`, `date_from`, `date_to`, `date_alert`, `lat`, `lng`, `url`, `type_id`, `status_id`, `active`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'Carrera Masaryk','Vive la emoción con la primera carrera deportiva en Av. Masaryk.','Masaryk #451','2016-01-31 16:30:00','2016-01-31 17:30:00','2016-03-01 08:06:00',19.43015530,-99.19506210,'http://caminamasaryk.com/',2,1,1,'2016-02-01 04:57:00','2016-03-09 02:12:42',NULL),
	(2,'Clases de Yoga','¡Continúan las actividades en Av. Masaryk! Realizan clase masiva de Yoga!','Masaryk #54','2016-01-31 14:00:00','2016-01-31 14:45:00',NULL,19.43161226,-99.19712204,'http://caminamasaryk.com',1,1,1,'2016-02-01 04:57:34','2016-02-04 05:44:01',NULL),
	(3,'México y Reino Unido celebran con subasta','México y Reino Unido celebran con una subasta con grandes premios.','Masaryk #201','2016-02-03 09:15:00','2016-02-03 10:00:00',NULL,19.43193602,-99.19935363,'http://caminamasaryk.com',1,2,1,'2016-02-04 05:46:59','2016-02-04 05:46:59',NULL),
	(4,'Fashion Night','Celebra una noche con música DJ.','Masaryk #101','2016-02-03 13:00:00','2016-02-03 15:00:00',NULL,19.43015530,-99.19506210,'http://caminamasaryk.com',2,3,1,'2016-02-04 05:48:27','2016-02-04 05:48:27',NULL);

/*!40000 ALTER TABLE `activities` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table activities_status
# ------------------------------------------------------------

DROP TABLE IF EXISTS `activities_status`;

CREATE TABLE `activities_status` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `activities_status` WRITE;
/*!40000 ALTER TABLE `activities_status` DISABLE KEYS */;

INSERT INTO `activities_status` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'Abierto',NULL,NULL,NULL),
	(2,'Pocos lugares',NULL,NULL,NULL),
	(3,'Cerrado',NULL,NULL,NULL);

/*!40000 ALTER TABLE `activities_status` ENABLE KEYS */;
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
	('2016_03_09_023423_create_users_table',2),
	('2016_03_09_023322_entrust_setup_tables',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table options
# ------------------------------------------------------------

DROP TABLE IF EXISTS `options`;

CREATE TABLE `options` (
  `key` varchar(50) NOT NULL DEFAULT '',
  `value` text,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `options` WRITE;
/*!40000 ALTER TABLE `options` DISABLE KEYS */;

INSERT INTO `options` (`key`, `value`)
VALUES
	('splash','8'),
	('last','2016-03-09 12:16:18');

/*!40000 ALTER TABLE `options` ENABLE KEYS */;
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



# Dump of table permission_role
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permission_role`;

CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



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



# Dump of table role_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `role_user`;

CREATE TABLE `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;

INSERT INTO `role_user` (`user_id`, `role_id`)
VALUES
	(1,1);

/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`)
VALUES
	(1,'admin','Admin','',NULL,NULL);

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table stores
# ------------------------------------------------------------

DROP TABLE IF EXISTS `stores`;

CREATE TABLE `stores` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `address` text,
  `description` text,
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

INSERT INTO `stores` (`id`, `title`, `address`, `description`, `phone`, `lat`, `lng`, `type_id`, `active`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'Prada ','Flannel cliche taxidermy mustache consequat, pariatur lo-fi DIY sartorial green juice chia odio try-hard fanny pack.','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','55555555',19.43015530,-99.19506210,2,1,'2016-01-31 07:30:03','2016-02-04 08:53:26',NULL),
	(2,'Dolce Gabanna','Flannel cliche taxidermy mustache consequat, pariatur lo-fi DIY sartorial green juice chia odio try-hard fanny pack.','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','55555555',19.43193602,-99.19677871,0,1,'2016-02-03 09:01:58','2016-02-03 09:01:58',NULL),
	(3,'Mac Store','Flannel cliche taxidermy mustache consequat, pariatur lo-fi DIY sartorial green juice chia odio try-hard fanny pack.','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','55555555',19.43145037,-99.18733734,2,1,'2016-02-03 09:04:57','2016-02-03 09:04:57',NULL),
	(4,'Porche','Flannel cliche taxidermy mustache consequat, pariatur lo-fi DIY sartorial green juice chia odio try-hard fanny pack.','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','55555555',19.43234073,-99.20192856,2,1,'2016-02-03 09:05:45','2016-02-03 09:05:45',NULL),
	(5,'Nesspreso','Flannel cliche taxidermy mustache consequat, pariatur lo-fi DIY sartorial green juice chia odio try-hard fanny pack.','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','55555555',19.43015530,-99.19506210,1,1,'2016-02-03 09:06:25','2016-02-03 09:06:25',NULL),
	(6,'Channel','Flannel cliche taxidermy mustache consequat, pariatur lo-fi DIY sartorial green juice chia odio try-hard fanny pack.','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','55555555',19.43145037,-99.19291633,2,1,'2016-02-03 09:06:54','2016-02-03 09:07:02',NULL);

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
  `phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_token` text COLLATE utf8_unicode_ci,
  `active` tinyint(4) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `facebook_id`, `email`, `password`, `first_name`, `last_name`, `city`, `birthday`, `phone`, `remember_token`, `facebook_token`, `active`, `created_at`, `updated_at`, `deleted_at`, `last_login`)
VALUES
	(1,'100000119631602','daniel.fer@avanna.com.mx','$2y$10$DVtfLJukAu5z3qCDpY5uwe/9WcBjH6/Xk5ISkUQLJUf2z4RW4hq.m','Daniel1','Fernández','México','0000-00-00','555555555','2WVEXm9FXqNdNJXv5YcAhxMmEWP0h0uV5ROrti7mRapR2wDhoXJ3VHyYkpvj','CAAO2AcRaUI0BAELqSyT8gZBcWyOWznD5mtPCTE3EUatDfvPpclhbU6s3f7EGCZB1thi0P4Nqj76Lr44VPFyhLwHK62e9dlxp1kkYmaSwFcus852NqCxWfZCURZBk8hBZCSVmlkwXCBf5kdORpfDS1HUP6FF1d6JjbQW78VZBvhZAplDxtUjH6UCnZBnDLPmbZCz4lliitkhBvVWTkUw29sJ7ZATBOMJzuHB9fcT6anWYpnqgZDZD',1,'2016-03-08 21:29:59','2016-03-09 04:29:59',NULL,'2016-03-09 00:38:22'),
	(2,'','john.doe@example.com','$2y$10$QI2pcHK2vvSkVdFYLOEjGu1GRMuz.oYZ5JeQWnBbD.6hZQfVoRP6S','John','Doe','México','2014-03-10','','$2y$10$OleO8N6IURAGF58pI8jQi.MIMTrr9mGb6/zkPJ73RzgNffRhBPwra','',1,'2016-02-22 17:55:38','2016-02-01 22:41:06',NULL,'0000-00-00 00:00:00'),
	(3,'','juanperez@hotmail.com','$2y$10$hI7DSjqOPxEJLrMsVzFmg.5NfN6Ss0mc8FRvHw0UassmltnTLPpNK','Juan','Peréz','México','0000-00-00','','$2y$10$ZIwuLtjkVqT5hDlhyMuthenZjBDVUAZAsdSxyHKoHC/qYvNlc/VeW','',1,'2016-02-22 17:55:39','2016-02-01 20:59:13',NULL,'0000-00-00 00:00:00'),
	(4,'','lamaria@gmail.com','$2y$10$D6TkA1QUuE/vAhkuod28o.EoFQ/8/vdA4Gq.PrbnHuI3EJw2D8Lfe','María1','Saenz1','Sonora','2016-03-08','','$2y$10$lTwGUay8IhKOdSXHJbLFBeU.6R.AN6MHhlbqOWclK4TqtZzt4XJ1.','',1,'2016-03-08 19:50:24','2016-03-09 02:50:24',NULL,'0000-00-00 00:00:00'),
	(5,'','cmurillo@outlook.com','$2y$10$POyNQ8BQN.jgNLm4Q5A2quehSWB19F33kPSV7LX82vtZ3yttEx6mC','Carlos','Murillo','Villahermosa','0000-00-00','','$2y$10$3kaifWKXAs4C.16Q0yp7AeAexaOph6ZdSRNhrg.ry2CfUsymSGfKa','',1,'2016-02-22 17:55:40','2016-02-01 21:09:46',NULL,'0000-00-00 00:00:00'),
	(6,'','javi@yahoo.com.mx','$2y$10$MObvi6o7tYsXx0NDPJ46teGO8fVBa43dHb3I8VqWF7Y3PIfXbTpFa','Javier','Ortega','Mexico','0000-00-00','','$2y$10$fY9yn.6uicMYlRDt8uRe.eAh0dCfVV1r6SQ6DpWMLZtJp2hL8g5Dq','',1,'2016-02-22 17:55:40','2016-02-01 21:10:20',NULL,'0000-00-00 00:00:00'),
	(12,'','angel@abostudio.mx','$2y$10$1SD9CmccLbcEs5ipryNLo.u/pZwC4ifj0Y/nwZWlPvm4a/i4v5DZS','Ángel ','Ortega ','México ','1994-12-02','','$2y$10$Eyoo9m6GzzQo5X6LXkn/HureLPSeK7Pj6xT9/RZmHuvW6X.DPaPw2','',1,'2016-02-24 21:37:08','2016-02-25 04:37:08',NULL,'2016-02-25 04:37:08'),
	(13,'','andrea@avanna.com.mx','$2y$10$6oqz4wEdWkkWRpJCLUnJG.xc329Pj.OnyQ4oW7JFfyhdVP4b047Fy','Andrea ','Villanuevs','Mexico','1987-10-16',NULL,'$2y$10$MJU7XGfwqLCg/P.zSAJqx.vtPe/VzU5j5KyWt5TmZOSvePMc3XnqC','',1,'2016-02-23 15:36:15','2016-02-23 22:36:15',NULL,'2016-02-23 22:36:15'),
	(14,'','tangamampilia@hotmail.com','$2y$10$rqDfItqne.CqkRay.C6NSufUd/M1fDv1Xvzg5eWduiRIA3sp2WWd2','Daniel','Fernandez','Mexico','1995-12-02',NULL,'$2y$10$q5BxdrXzaDVxgzWRTYdAqO2ccWvwTXo6ruEYYMeLkrnsmBpCMcvHK','',1,'2016-03-08 22:31:36','2016-03-09 05:31:36',NULL,'2016-02-24 18:57:50'),
	(15,'','jaime.banus@rbconsulting.es','$2y$10$KA11QFDoZ58gVd1O8PHa9uGUjX/0vQsEiZIVvHo6Almt4IO0kckNG','jaine','banus','Madrid','1980-10-07',NULL,'$2y$10$O1YshYnl4.dFWsDeqHNeIOtPheQhfBe.j1uPu3L5H5TDdqrWm6YHG','',1,'2016-03-06 06:15:30','2016-03-06 13:15:30',NULL,'2016-03-06 13:15:30'),
	(16,'','test@test.com','$2y$10$pUPfyfONfjDtiy6llKzPou68D3kaHV2QydFtNHKFpPbqneFp1qsXG','test','test','test','0000-00-00',NULL,'cyFYTF09fULtOkm6VQh2IJiZ4VbIB7QQ7zjxH0EIUWjF57kt0JRK542L7tVC','',1,'2016-03-08 20:44:52','2016-03-09 03:44:52',NULL,'0000-00-00 00:00:00');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users_activities
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users_activities`;

CREATE TABLE `users_activities` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `activity_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `users_activities` WRITE;
/*!40000 ALTER TABLE `users_activities` DISABLE KEYS */;

INSERT INTO `users_activities` (`id`, `user_id`, `activity_id`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(6,1,2,NULL,NULL,NULL),
	(7,1,4,NULL,NULL,NULL);

/*!40000 ALTER TABLE `users_activities` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users_notifications
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users_notifications`;

CREATE TABLE `users_notifications` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `device` varchar(11) DEFAULT NULL,
  `token` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `users_notifications` WRITE;
/*!40000 ALTER TABLE `users_notifications` DISABLE KEYS */;

INSERT INTO `users_notifications` (`id`, `user_id`, `device`, `token`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,1,'iOS','8e1a7d6d4a4faee175f8787889cf41c85dcb08686882451a3b390a37523802a9','2016-02-25 02:59:34','2016-02-25 02:59:34',NULL),
	(3,12,'iOS','8ef563a57047a59fa297231217e424ccb13b25e8f8027681e02e533ea5b28fdc','2016-02-25 04:37:09','2016-02-25 04:37:09',NULL),
	(4,1,'iOS','7318d8ef221f79473f6306256962c233bc149d1b5a144ae9767b4766d741ddff','2016-02-28 01:40:54','2016-02-28 01:40:54',NULL),
	(8,1,'iOS','e1169d863b0883bb1f01f048f9e84b8c143c3d3db96f7ab56ffb0b4fe5f42d21','2016-03-09 00:38:22','2016-03-09 00:38:22',NULL),
	(9,14,'iOS','6b55313df06096a2be047f109c0f2a61e1905555285ec648eeb58d221d1eb07c','2016-03-09 03:28:23','2016-03-09 05:32:01',NULL),
	(20,1,'Android','frvDxFJ5g3s:APA91bFYU4PSj_bLl2cJ7xnhyhaWI98O4wg8WsuAvzA4kxhRfarHAFY5GI8Fnqexv3Lc7AfaxztuBnu-V2QTSd_HdnHj9C7L2QaAH0BhC_qvMg-T32p9oLPjIxbdTTg-SJZnRa8_SyEu','2016-03-09 18:11:56','2016-03-09 18:11:56',NULL),
	(21,1,'iOS','53a11ca7c6d54ee519b3b7a29923427bc9ceddeff225d1f99bf4a610b4fae367','2016-03-10 00:15:01','2016-03-10 00:15:01',NULL);

/*!40000 ALTER TABLE `users_notifications` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
