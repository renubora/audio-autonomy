
/*
Copyright (C) 2015,  Andrew McConachie and Renu Bora. All rights reserved.

This file is part of this program.

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License Version 2 (GPLv2) as published by
the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

 You should have received a copy of the GNU General Public License Version 2 in LICENSE.txt in the root folder.  If not, see http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */


-- MySQL dump 10.13  Distrib 5.5.41, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: groundhog
-- ------------------------------------------------------
-- Server version	5.5.41-0+wheezy1

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
-- Table structure for table `caregivers`
--

DROP TABLE IF EXISTS `caregivers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caregivers` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(1000) NOT NULL,
  `cookie` varchar(1000) DEFAULT NULL,
  `patientID` int(11) NOT NULL,
  `password` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caregivers`
--

LOCK TABLES `caregivers` WRITE;
/*!40000 ALTER TABLE `caregivers` DISABLE KEYS */;
INSERT INTO `caregivers` VALUES (1,'andrew','56125',2,'abc123'),(2,'bob','56906',1,'abc123'),(3,'ben','29430',5,'abc123');
/*!40000 ALTER TABLE `caregivers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `start` datetime NOT NULL,
  `allDay` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `patientID` int(11) DEFAULT NULL,
  `argList` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `className` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=600 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (385,'Prayer Reminder','2015-05-07 04:30:00','',2,'',''),(389,'Fraud Prevention','2015-05-04 02:00:00','',2,'','fc-event'),(536,'Prayer Reminder','2015-05-03 04:30:00','',2,'','fc-event'),(537,'Medication Reminder','2015-05-03 01:30:00','',2,'','fc-event'),(547,'Question and Response','2015-05-05 00:00:00','true',5,'what time is dinner_dinner is at five thirty','fc-event-question'),(548,'Fraud Prevention','2015-05-04 08:00:00','',5,'','fc-event'),(552,'Pet Feeding Reminder','2015-05-04 15:00:00','',5,'','fc-event'),(553,'Prayer Reminder','2015-05-04 06:30:00','',5,'','fc-event'),(554,'Grooming Reminder','2015-05-04 12:00:00','',5,'','fc-event'),(555,'Oven Reminder','2015-05-04 17:00:00','',5,'','fc-event'),(556,'Question and Response','2015-05-04 00:00:00','true',5,'Is your diaper wet?_Change your diaper!','fc-event-question'),(557,'Question and Response','2015-05-06 00:00:00','true',5,'When can I go out?_Never','fc-event-question'),(578,'Fraud Prevention','2015-05-03 00:00:00','',2,'','fc-event'),(579,'Oven Reminder','2015-05-04 00:00:00','',2,'','fc-event'),(582,'Question and Response','2015-05-03 00:00:00','true',2,'s_a','fc-event-question'),(585,'Grooming Reminder','2015-05-05 10:00:00','',2,'','fc-event'),(586,'Prayer Reminder','2015-05-05 10:00:00','',2,'','fc-event'),(589,'Medication Reminder','2015-05-05 06:30:00','',2,'','fc-event'),(590,'Oven Reminder','2015-05-05 09:00:00','',2,'','fc-event'),(591,'Medication Reminder','2015-05-05 13:00:00','',2,'','fc-event'),(592,'Oven Reminder','2015-05-07 09:30:00','',2,'','fc-event'),(593,'Play Favorite Song','2015-05-05 12:00:00','',2,'','fc-event'),(594,'Play Favorite Song','2015-05-04 13:00:00','',2,'','fc-event'),(595,'Medication Reminder','2015-05-03 10:00:00','',2,'','fc-event'),(596,'Grooming Reminder','2015-05-03 10:30:00','',2,'','fc-event'),(597,'Play Favorite Song','2015-05-03 11:30:00','',2,'','fc-event'),(598,'Play Favorite Song','2015-05-04 11:00:00','',2,'','fc-event'),(599,'Fraud Prevention','2015-05-03 07:30:00','',2,'','fc-event');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patients`
--

DROP TABLE IF EXISTS `patients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patients` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(1000) NOT NULL,
  `lastName` varchar(1000) NOT NULL,
  `phone` varchar(1000) DEFAULT NULL,
  `pin` varchar(10) NOT NULL,
  `helpNumber` varchar(1000) DEFAULT NULL,
  `cookie` varchar(1000) DEFAULT NULL,
  `fraudNumber` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patients`
--

LOCK TABLES `patients` WRITE;
/*!40000 ALTER TABLE `patients` DISABLE KEYS */;
INSERT INTO `patients` VALUES (1,'Andrew','McConachie','4124184165','cactus','5106466190','32434',NULL),(2,'Andrew','Smutt','smutticus','dragon','sip:smutt@iptel.org','23912','sip:smutt@iptel.org'),(3,'Renu','Bora','3104355344','tiger',NULL,'18782',NULL),(4,'Noriko','Misra','8478685734','puppy',NULL,NULL,NULL),(5,'Ben','Shapiro','3104300405','tofu','5106466190','62515',NULL);
/*!40000 ALTER TABLE `patients` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-05-07 12:14:50
