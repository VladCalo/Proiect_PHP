-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: vlad
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.20-MariaDB

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
-- Table structure for table `consultatii`
--

DROP TABLE IF EXISTS `consultatii`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consultatii` (
  `consultatie_id` int(11) NOT NULL AUTO_INCREMENT,
  `pacient_id` smallint(6) NOT NULL,
  `medic_id` smallint(6) NOT NULL,
  `diagnostic_id` smallint(6) DEFAULT NULL,
  `Tip` varchar(100) DEFAULT NULL,
  `Data` date NOT NULL,
  `Ora` varchar(100) DEFAULT NULL,
  `Internare` bit(1) DEFAULT NULL,
  PRIMARY KEY (`consultatie_id`),
  KEY `consultatii_FK` (`pacient_id`),
  KEY `consultatii_FK_1` (`medic_id`),
  KEY `consultatii_FK_2` (`diagnostic_id`),
  CONSTRAINT `consultatii_FK` FOREIGN KEY (`pacient_id`) REFERENCES `pacienti` (`pacient_id`),
  CONSTRAINT `consultatii_FK_1` FOREIGN KEY (`medic_id`) REFERENCES `medici` (`medic_id`),
  CONSTRAINT `consultatii_FK_2` FOREIGN KEY (`diagnostic_id`) REFERENCES `diagnostice` (`diagnostic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultatii`
--

LOCK TABLES `consultatii` WRITE;
/*!40000 ALTER TABLE `consultatii` DISABLE KEYS */;
INSERT INTO `consultatii` VALUES (1,1,1,NULL,'Online','2022-01-05','16:00','\0'),(2,1,2,2,'Clinica','2022-01-06','09:00',''),(6,1,1,NULL,'Online','2022-01-10','10:00','\0');
/*!40000 ALTER TABLE `consultatii` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diagnostice`
--

DROP TABLE IF EXISTS `diagnostice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `diagnostice` (
  `diagnostic_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `Nume` varchar(100) NOT NULL,
  `Tratament` varchar(500) DEFAULT NULL,
  `Descriere` varchar(500) NOT NULL,
  PRIMARY KEY (`diagnostic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diagnostice`
--

LOCK TABLES `diagnostice` WRITE;
/*!40000 ALTER TABLE `diagnostice` DISABLE KEYS */;
INSERT INTO `diagnostice` VALUES (1,'Boala cardiaca reumatismala','Manifestarile febrei cardiace acute vor fi tratate cu salicilati: aspirina si steroizi. Daca cardita determina cardiomegalie, insuficienta cardiaca congestiva sau bloc cardiac de gradul trei la terapia cu salicilati se va adauga prednison pentru 2-6 saptamani in functie de severitatea carditei. Terapia aditionala pentru pacientii cu febra reumatica auta si insuficienta cardiaca congestiva include administrarea de: digoxin, diuretice, suplimentarea cu oxigen, repaus la pat si restrictionarea cons','Deteriorarea muschiului cardiac si a valvelor cardiace provocate de febra reumatica, determinata de bacterii streptococice.'),(2,'Tromboza venoasa profunda (TVP) si embolism pulmonar','Tratamentul si monitorizarea initiala in spital dureaza cateva zile, insa anticoagularea trebuie continuata pe o durata mai lunga, de cel putin 3 luni. Ulterior, in functie de starea pacientului si de prezenta factorilor de risc, tratamentul anticoagulant poate fi prelungit 1 an de zile sau pe o perioada indefinita. Decizia este una complexa si este luata de catre medicul cardiolog impreuna cu pacientul. Termenul „indefinit” nu inseamna neaparat „pe viata”. Medicul va evalua periodic echilibrul ','Trombii de la nivelul venelor picioarelor, care se pot disloca si muta la nivelul inimii si plamanilor. Factori de risc: Interventie chirurgicala, obezitate, cancer, episod anterior de TVP, nastere recenta, folosirea contraceptivelor orale si a terapiei de substitutie hormonala, perioade lungi de imobilitate (de exemplu, in calatorii), niveluri ridicate de hemocisteina in sange.'),(3,'Clinic sanatos','odihna, mancare si apa. fara excese','fara modificari patologice');
/*!40000 ALTER TABLE `diagnostice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facturi`
--

DROP TABLE IF EXISTS `facturi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facturi` (
  `factura_id` int(11) NOT NULL AUTO_INCREMENT,
  `pacient_id` smallint(6) NOT NULL,
  `Numar` varchar(100) NOT NULL,
  `Data` date NOT NULL,
  `Detalii` varchar(200) NOT NULL,
  `Valoare` decimal(10,0) NOT NULL,
  PRIMARY KEY (`factura_id`),
  KEY `facturi_FK` (`pacient_id`),
  CONSTRAINT `facturi_FK` FOREIGN KEY (`pacient_id`) REFERENCES `pacienti` (`pacient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facturi`
--

LOCK TABLES `facturi` WRITE;
/*!40000 ALTER TABLE `facturi` DISABLE KEYS */;
INSERT INTO `facturi` VALUES (1,1,'44','2022-01-05','Servicii medicale 2022-01-05',200);
/*!40000 ALTER TABLE `facturi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fise`
--

DROP TABLE IF EXISTS `fise`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fise` (
  `pacient_id` smallint(6) NOT NULL,
  `consultatie_id` int(11) NOT NULL,
  `Data` date NOT NULL,
  `Status` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`pacient_id`,`consultatie_id`),
  KEY `fise_FK_1` (`consultatie_id`),
  CONSTRAINT `fise_FK` FOREIGN KEY (`pacient_id`) REFERENCES `pacienti` (`pacient_id`),
  CONSTRAINT `fise_FK_1` FOREIGN KEY (`consultatie_id`) REFERENCES `consultatii` (`consultatie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fise`
--

LOCK TABLES `fise` WRITE;
/*!40000 ALTER TABLE `fise` DISABLE KEYS */;
/*!40000 ALTER TABLE `fise` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `internari`
--

DROP TABLE IF EXISTS `internari`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `internari` (
  `internare_id` int(11) NOT NULL AUTO_INCREMENT,
  `consultatie_id` int(11) NOT NULL,
  `Data_checkin` date NOT NULL,
  `Data_checkout` date DEFAULT NULL,
  `Camera` varchar(100) DEFAULT NULL,
  `Pat` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`internare_id`),
  KEY `internari_FK` (`consultatie_id`),
  CONSTRAINT `internari_FK` FOREIGN KEY (`consultatie_id`) REFERENCES `consultatii` (`consultatie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `internari`
--

LOCK TABLES `internari` WRITE;
/*!40000 ALTER TABLE `internari` DISABLE KEYS */;
INSERT INTO `internari` VALUES (1,2,'2022-01-06',NULL,'4','1');
/*!40000 ALTER TABLE `internari` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medici`
--

DROP TABLE IF EXISTS `medici`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medici` (
  `medic_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `Specialitate` varchar(100) NOT NULL,
  `Nume` varchar(100) NOT NULL,
  `Prenume` varchar(100) NOT NULL,
  `Pret_consultatie` int(11) NOT NULL,
  PRIMARY KEY (`medic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medici`
--

LOCK TABLES `medici` WRITE;
/*!40000 ALTER TABLE `medici` DISABLE KEYS */;
INSERT INTO `medici` VALUES (1,'Ginecologie','Marian','Stejaru',200),(2,'Ecografie','Ciprian','Duta',150);
/*!40000 ALTER TABLE `medici` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pacienti`
--

DROP TABLE IF EXISTS `pacienti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pacienti` (
  `pacient_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `Nume` varchar(100) NOT NULL,
  `Prenume` varchar(100) NOT NULL,
  `CNP` varchar(15) NOT NULL,
  `Adresa` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`pacient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pacienti`
--

LOCK TABLES `pacienti` WRITE;
/*!40000 ALTER TABLE `pacienti` DISABLE KEYS */;
INSERT INTO `pacienti` VALUES (1,'Popescu','Marian','1561010443322','Aviatorilor 12, Bucuresti'),(2,'Ionescu','Andreea','2641010332211','Decebal 23, Bucuresti'),(3,'Iamandi','Costantin','1780822876652','Dezrobirii 44'),(10,'Vlad','Soare','1770510445544','Iuliu Maniu 33, Bucuresti'),(11,'Alexandra','Caramitru','2851030768452','Calea Victoriei 22, Bucuresti');
/*!40000 ALTER TABLE `pacienti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plati`
--

DROP TABLE IF EXISTS `plati`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plati` (
  `plata_id` int(11) NOT NULL AUTO_INCREMENT,
  `factura_id` int(11) NOT NULL,
  `Data` date NOT NULL,
  `Valoare` decimal(10,0) NOT NULL,
  PRIMARY KEY (`plata_id`),
  KEY `plati_FK` (`factura_id`),
  CONSTRAINT `plati_FK` FOREIGN KEY (`factura_id`) REFERENCES `facturi` (`factura_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plati`
--

LOCK TABLES `plati` WRITE;
/*!40000 ALTER TABLE `plati` DISABLE KEYS */;
INSERT INTO `plati` VALUES (1,1,'2022-01-06',200);
/*!40000 ALTER TABLE `plati` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Vlad','vlad','vlad','vlad@vlad.co');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'vlad'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-01-07 13:22:44
