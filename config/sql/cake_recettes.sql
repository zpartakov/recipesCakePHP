-- MySQL dump 10.13  Distrib 5.5.49, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: cake_recettes
-- ------------------------------------------------------
-- Server version	5.5.38-0ubuntu0.12.04.1

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
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recette_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `zip` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=133 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `diets`
--

DROP TABLE IF EXISTS `diets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `diets` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `lib` varchar(255) NOT NULL,
  `rem` text NOT NULL,
  `date_mod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COMMENT='régimes';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `emails`
--

DROP TABLE IF EXISTS `emails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emails` (
  `email` varchar(200) NOT NULL DEFAULT '',
  `date` date NOT NULL DEFAULT '0000-00-00',
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `epices`
--

DROP TABLE IF EXISTS `epices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `epices` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `lib` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `def` text COLLATE utf8_unicode_ci NOT NULL,
  `util` text COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `origine` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=354 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `epices00`
--

DROP TABLE IF EXISTS `epices00`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `epices00` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `lib` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `def` text COLLATE utf8_unicode_ci NOT NULL,
  `util` text COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `origine` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=354 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `glossaires`
--

DROP TABLE IF EXISTS `glossaires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `glossaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(250) NOT NULL DEFAULT '',
  `definition1` text NOT NULL,
  `definition2` text NOT NULL,
  `definition3` text NOT NULL,
  `definition4` text NOT NULL,
  `source` varchar(250) NOT NULL DEFAULT '',
  `type` enum('action','ustensile','ingredient','recette','autre') NOT NULL DEFAULT 'action',
  `image` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `libelle` (`libelle`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=510 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingredients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(250) NOT NULL DEFAULT '',
  `typ` enum('Agneau','Bases','Boeuf','Cave','Céréales','Champignons','Crèmerie','Épicerie','Épices','Fines herbes','Fruits','Légumes','Légumineuses','Mollusques et crustacés','Pâtisserie','Poissons de mer','Poissons eau douce','Porc','Veau','Volaille - gibier') NOT NULL DEFAULT 'Agneau',
  `unit` varchar(25) NOT NULL DEFAULT '0',
  `kcal` int(11) NOT NULL DEFAULT '0',
  `price` decimal(11,2) NOT NULL DEFAULT '0.00',
  `img` varchar(50) NOT NULL DEFAULT '0',
  `commissions` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `libelle` (`libelle`)
) ENGINE=MyISAM AUTO_INCREMENT=574 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `invitations`
--

DROP TABLE IF EXISTS `invitations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invitations` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `invites` text COLLATE utf8_unicode_ci NOT NULL,
  `menu_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remarques` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='journal des repas et des invités';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `liens`
--

DROP TABLE IF EXISTS `liens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `liens` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `lib` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=118 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `linked_recettes`
--

DROP TABLE IF EXISTS `linked_recettes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `linked_recettes` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `recette_id` int(12) NOT NULL,
  `recettes_id` int(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci COMMENT='linked recipes';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `identifiantmenu` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `recette_id` int(12) NOT NULL,
  `rem` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mode_cuissons`
--

DROP TABLE IF EXISTS `mode_cuissons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mode_cuissons` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `parent` int(3) NOT NULL,
  `lib` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rem` text COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `body` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `r_ingrs`
--

DROP TABLE IF EXISTS `r_ingrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `r_ingrs` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `recette_id` int(12) NOT NULL,
  `ingr` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14892 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `r_preps`
--

DROP TABLE IF EXISTS `r_preps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `r_preps` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `recette_id` int(12) NOT NULL,
  `prep` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18725 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `recette_user`
--

DROP TABLE IF EXISTS `recette_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recette_user` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `recette_id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci COMMENT='liaison utilisateurs - recettes';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `recettes`
--

DROP TABLE IF EXISTS `recettes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recettes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prov` text NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `temps` text NOT NULL,
  `pers` tinyint(2) NOT NULL DEFAULT '0',
  `type_id` int(12) NOT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `score` tinyint(4) NOT NULL DEFAULT '0',
  `source` text NOT NULL,
  `pict` text NOT NULL,
  `private` tinyint(1) NOT NULL DEFAULT '0',
  `mode_cuisson_id` int(9) NOT NULL,
  `time` int(2) NOT NULL,
  `difficulty` int(2) NOT NULL,
  `price` int(2) NOT NULL,
  `diet_id` int(9) NOT NULL,
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `titre` (`titre`)
) ENGINE=MyISAM AUTO_INCREMENT=14319 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `recettes00`
--

DROP TABLE IF EXISTS `recettes00`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recettes00` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prov` text NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `temps` text NOT NULL,
  `ingr` longtext NOT NULL,
  `pers` tinyint(2) NOT NULL DEFAULT '0',
  `type_id` int(12) NOT NULL,
  `prep` longtext NOT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `score` tinyint(4) NOT NULL DEFAULT '0',
  `source` text NOT NULL,
  `pict` text NOT NULL,
  `private` tinyint(1) NOT NULL DEFAULT '0',
  `mode_cuisson_id` int(9) NOT NULL,
  `time` int(2) NOT NULL,
  `difficulty` int(2) NOT NULL,
  `price` int(2) NOT NULL,
  `diet_id` int(9) NOT NULL,
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `titre` (`titre`)
) ENGINE=MyISAM AUTO_INCREMENT=14318 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `recettes_ingr`
--

DROP TABLE IF EXISTS `recettes_ingr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recettes_ingr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(250) NOT NULL DEFAULT '',
  `typ` enum('Agneau','Bases','Boeuf','Cave','Céréales','Champignons','Crèmerie','Épicerie','Épices','Fines herbes','Fruits','Légumes','Légumineuses','Mollusques et crustacés','Pâtisserie','Poissons de mer','Poissons eau douce','Porc','Veau','Volaille - gibier') NOT NULL DEFAULT 'Agneau',
  `unit` varchar(25) NOT NULL DEFAULT '0',
  `kcal` int(11) NOT NULL DEFAULT '0',
  `price` decimal(11,2) NOT NULL DEFAULT '0.00',
  `img` varchar(50) NOT NULL DEFAULT '0',
  `commissions` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `libelle` (`libelle`)
) ENGINE=MyISAM AUTO_INCREMENT=564 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `recettes_orthographe`
--

DROP TABLE IF EXISTS `recettes_orthographe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recettes_orthographe` (
  `orthographe` varchar(250) NOT NULL DEFAULT '',
  `aurtograf` varchar(250) NOT NULL DEFAULT '',
  UNIQUE KEY `aurtograf` (`aurtograf`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `recettes_tags`
--

DROP TABLE IF EXISTS `recettes_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recettes_tags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `recette_id` int(11) unsigned NOT NULL,
  `tag_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `restaurants`
--

DROP TABLE IF EXISTS `restaurants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurants` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `adresse` text,
  `tel` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `pays` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `rem` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `gps` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `stats`
--

DROP TABLE IF EXISTS `stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stats` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `recette_id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1311 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `synonymes`
--

DROP TABLE IF EXISTS `synonymes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `synonymes` (
  `orthographe` varchar(250) NOT NULL DEFAULT '',
  `aurtograf` varchar(250) NOT NULL DEFAULT '',
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `aurtograf` (`aurtograf`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `lib` varchar(255) NOT NULL,
  `datein` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='tags pour les recettes';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `types`
--

DROP TABLE IF EXISTS `types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `types` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL DEFAULT '',
  `order` int(3) NOT NULL COMMENT 'ordre / rank',
  PRIMARY KEY (`id`),
  UNIQUE KEY `order` (`order`)
) ENGINE=MyISAM AUTO_INCREMENT=95 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT 'www',
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `dateIn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users_tags`
--

DROP TABLE IF EXISTS `users_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_tags` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `user_id` int(12) NOT NULL,
  `recette_id` int(12) NOT NULL,
  `tag_id` int(12) NOT NULL,
  `note` text NOT NULL,
  `datein` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COMMENT='liaison utilisateurs recettes';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `vins_cepages`
--

DROP TABLE IF EXISTS `vins_cepages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vins_cepages` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `cepage` varchar(250) NOT NULL DEFAULT '',
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `vins_millesimes`
--

DROP TABLE IF EXISTS `vins_millesimes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vins_millesimes` (
  `an` varchar(6) NOT NULL DEFAULT '0',
  `millesime` tinyint(4) NOT NULL DEFAULT '0',
  `vin_type_id` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `vins_types`
--

DROP TABLE IF EXISTS `vins_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vins_types` (
  `id` varchar(50) NOT NULL DEFAULT '',
  `libelle` text NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-29 14:33:36
