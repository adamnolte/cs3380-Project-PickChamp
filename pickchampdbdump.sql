-- MySQL dump 10.13  Distrib 5.5.46, for debian-linux-gnu (x86_64)
--
-- Host: us-cdbr-azure-central-a.cloudapp.net    Database: cs-PickChamp
-- ------------------------------------------------------
-- Server version	5.5.40-log

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
-- Table structure for table `contests`
--

DROP TABLE IF EXISTS `contests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contests` (
  `contest_id` int(50) NOT NULL AUTO_INCREMENT,
  `sport` varchar(3) DEFAULT NULL,
  `away_team` varchar(30) DEFAULT NULL,
  `home_team` varchar(30) DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `winner` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`contest_id`),
  KEY `sport_index` (`sport`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `expired_contests`
--

DROP TABLE IF EXISTS `expired_contests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expired_contests` (
  `contest_id` int(10) NOT NULL,
  `sport` varchar(3) DEFAULT NULL,
  `away_team` varchar(30) DEFAULT NULL,
  `home_team` varchar(30) DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `winner` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`contest_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `login_timestamp`
--

DROP TABLE IF EXISTS `login_timestamp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_timestamp` (
  `email` varchar(30) DEFAULT NULL,
  `login_time` time DEFAULT NULL,
  KEY `login_email_index` (`email`),
  KEY `login_time_index` (`login_time`),
  CONSTRAINT `login_timestamp_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `email` varchar(30) NOT NULL,
  `hashed_password` varchar(256) DEFAULT NULL,
  `firstname` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `zip` int(5) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `admin` int(1) DEFAULT NULL,
  `mlb_wins` int(10) NOT NULL DEFAULT '0',
  `nba_wins` int(10) NOT NULL DEFAULT '0',
  `nhl_wins` int(10) NOT NULL DEFAULT '0',
  `nfl_wins` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`email`),
  KEY `email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_picks`
--

DROP TABLE IF EXISTS `user_picks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_picks` (
  `email` varchar(50) DEFAULT NULL,
  `contest_id` int(10) NOT NULL DEFAULT '0',
  `pick` varchar(50) DEFAULT NULL,
  `winner` varchar(50) DEFAULT NULL,
  `sport` varchar(3) DEFAULT NULL,
  KEY `email` (`email`),
  CONSTRAINT `user_picks_ibfk_2` FOREIGN KEY (`email`) REFERENCES `user` (`email`),
  CONSTRAINT `user_picks_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-12-15 20:55:18
