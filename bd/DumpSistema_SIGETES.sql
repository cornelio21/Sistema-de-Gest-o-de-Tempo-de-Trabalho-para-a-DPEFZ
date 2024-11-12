CREATE DATABASE  IF NOT EXISTS `sistema_sigetes` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `sistema_sigetes`;
-- MySQL dump 10.13  Distrib 5.7.33, for Linux (x86_64)
--
-- Host: localhost    Database: sistema_sigetes
-- ------------------------------------------------------
-- Server version	5.7.33-0ubuntu0.18.04.1

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
-- Table structure for table `ROLE_USERS`
--

DROP TABLE IF EXISTS `ROLE_USERS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ROLE_USERS` (
  `idROLE_USER` int(11) NOT NULL AUTO_INCREMENT,
  `tipoROLE_USER` varchar(50) NOT NULL,
  PRIMARY KEY (`idROLE_USER`),
  UNIQUE KEY `tipoROLE_USER` (`tipoROLE_USER`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ROLE_USERS`
--

LOCK TABLES `ROLE_USERS` WRITE;
/*!40000 ALTER TABLE `ROLE_USERS` DISABLE KEYS */;
INSERT INTO `ROLE_USERS` VALUES (2,'admin'),(1,'super-admin'),(3,'usuario-sistema-repartição-cadastro'),(4,'usuario-sistema-repartição-pessoal');
/*!40000 ALTER TABLE `ROLE_USERS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departamentos` (
  `idDepartamento` int(11) NOT NULL AUTO_INCREMENT,
  `nomeDepartamento` varchar(100) NOT NULL,
  `numeroTotalFuncionarios` int(11) DEFAULT '0',
  `dataRegisto` date NOT NULL,
  PRIMARY KEY (`idDepartamento`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamentos`
--

LOCK TABLES `departamentos` WRITE;
/*!40000 ALTER TABLE `departamentos` DISABLE KEYS */;
INSERT INTO `departamentos` VALUES (1,'TIC e Imagem',1,'2021-05-22'),(2,'Recursos Humanos',3,'2021-05-22'),(3,'Contabilidade',2,'2021-05-22');
/*!40000 ALTER TABLE `departamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionarios`
--

DROP TABLE IF EXISTS `funcionarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `funcionarios` (
  `idFuncionario` int(11) NOT NULL AUTO_INCREMENT,
  `idDepartamento` int(11) DEFAULT NULL,
  `nomeFuncionario` varchar(100) NOT NULL,
  `generoFuncionario` enum('M','F') NOT NULL,
  `dataNascimento` date NOT NULL,
  `numeroNUIT` varchar(9) NOT NULL,
  `numeroBI` varchar(13) NOT NULL,
  `escalaoFuncionario` enum('1','2','3','4') NOT NULL,
  `classeFuncionario` enum('A','B','C','E') NOT NULL,
  `cargo` varchar(100) NOT NULL,
  `dataInicioCarreira` date NOT NULL,
  `isAposentado` enum('Sim','Não') NOT NULL DEFAULT 'Não',
  `isUserSystem` enum('Sim','Não') NOT NULL DEFAULT 'Não',
  `dataRegisto` date NOT NULL,
  PRIMARY KEY (`idFuncionario`),
  UNIQUE KEY `numeroNUIT` (`numeroNUIT`),
  UNIQUE KEY `numeroBI` (`numeroBI`),
  KEY `funcionarios_ibfk_1` (`idDepartamento`),
  CONSTRAINT `funcionarios_ibfk_1` FOREIGN KEY (`idDepartamento`) REFERENCES `departamentos` (`idDepartamento`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionarios`
--

LOCK TABLES `funcionarios` WRITE;
/*!40000 ALTER TABLE `funcionarios` DISABLE KEYS */;
INSERT INTO `funcionarios` VALUES (1,1,'Ernesto Silva','M','1986-03-19','341244141','988791280101A','4','B','Técnico Informática','2020-02-22','Não','Sim','2021-05-22'),(2,2,'Maria Henriques','F','1989-08-11','324234234','754325678899A','3','B','Técnica dos Recursos Humanos','2013-07-18','Não','Sim','2021-05-22'),(3,3,'João Henrique Silva','M','1994-07-08','234234233','899898374029R','3','A','Técnico de contabilidade','2019-08-23','Não','Sim','2021-05-22'),(4,3,'Sergio Xavier','M','1997-02-07','131312431','124143181273S','2','B','Técnico de contabilidade','2020-01-22','Não','Não','2021-05-22'),(5,2,'Joaquim Da Silva','M','1950-06-06','112131313','719872812731A','1','C','Técnico dos Recursos Humanos','1977-11-25','Sim','Não','2021-05-25'),(6,2,'Bernarda Jaime','F','1971-12-23','234234234','131231243325A','2','A','Técnica dos Recursos Humanos','1986-10-17','Não','Sim','2021-06-02');
/*!40000 ALTER TABLE `funcionarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `sistema_sigetes`.`actualizaNumeroFuncionariosPorDepartamento` AFTER INSERT ON `funcionarios` FOR EACH ROW
BEGIN
update departamentos set numeroTotalFuncionarios = numeroTotalFuncionarios + 1 where new.idDepartamento = idDepartamento;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `sistema_sigetes`.`funcionarioAfterUpdate` AFTER UPDATE ON `funcionarios` FOR EACH ROW
BEGIN
if (new.classeFuncionario <> old.classeFuncionario) then
insert into funcionarios_promocao_carreiras (idFuncionario, idDepartamento, classe_antiga, classe_actual, dataRegisto_promocao) values (new.idFuncionario, new.idDepartamento, old.classeFuncionario, new.classeFuncionario, now());
END if;

if(new.escalaoFuncionario <> old.escalaoFuncionario) then
insert into funcionarios_progressao_carreiras (idFuncionario, idDepartamento, escalao_antigo, escalao_actual, dataRegisto_progressao) values (new.idFuncionario, new.idDepartamento, old.escalaoFuncionario, new.escalaoFuncionario, now());
END if;

if(new.isAposentado <> old.isAposentado) then 
insert into funcionarios_aposentados (idFuncionario, idDepartamento, descricao, dataAposentadoria) values (new.idFuncionario, new.idDepartamento, "Aposentado", now());
END if;

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `sistema_sigetes`.`funcionarios_AFTER_DELETE` AFTER DELETE ON `funcionarios` FOR EACH ROW
BEGIN
update departamentos set numeroTotalFuncionarios = numeroTotalFuncionarios - 1 where old.idDepartamento = idDepartamento;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `funcionarios_aposentados`
--

DROP TABLE IF EXISTS `funcionarios_aposentados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `funcionarios_aposentados` (
  `idFuncionario_aposentado` int(11) NOT NULL AUTO_INCREMENT,
  `idFuncionario` int(11) NOT NULL,
  `idDepartamento` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `dataAposentadoria` date NOT NULL,
  PRIMARY KEY (`idFuncionario_aposentado`),
  KEY `idFuncionario` (`idFuncionario`),
  KEY `idDepartamento` (`idDepartamento`),
  CONSTRAINT `funcionarios_aposentados_ibfk_1` FOREIGN KEY (`idFuncionario`) REFERENCES `funcionarios` (`idFuncionario`),
  CONSTRAINT `funcionarios_aposentados_ibfk_2` FOREIGN KEY (`idDepartamento`) REFERENCES `departamentos` (`idDepartamento`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionarios_aposentados`
--

LOCK TABLES `funcionarios_aposentados` WRITE;
/*!40000 ALTER TABLE `funcionarios_aposentados` DISABLE KEYS */;
INSERT INTO `funcionarios_aposentados` VALUES (1,5,2,'Aposentado','2021-05-29');
/*!40000 ALTER TABLE `funcionarios_aposentados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionarios_chefes_departamentos`
--

DROP TABLE IF EXISTS `funcionarios_chefes_departamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `funcionarios_chefes_departamentos` (
  `idFuncionarios_chefes_departamentos` int(11) NOT NULL AUTO_INCREMENT,
  `idFuncionario` int(11) DEFAULT '0',
  `idDepartamento` int(11) NOT NULL,
  `dataRegisto` date DEFAULT NULL,
  PRIMARY KEY (`idFuncionarios_chefes_departamentos`),
  KEY `idDepartamento` (`idDepartamento`),
  KEY `funcionarios_chefes_departamentos_ibfk_1` (`idFuncionario`),
  CONSTRAINT `funcionarios_chefes_departamentos_ibfk_1` FOREIGN KEY (`idFuncionario`) REFERENCES `funcionarios` (`idFuncionario`),
  CONSTRAINT `funcionarios_chefes_departamentos_ibfk_2` FOREIGN KEY (`idDepartamento`) REFERENCES `departamentos` (`idDepartamento`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionarios_chefes_departamentos`
--

LOCK TABLES `funcionarios_chefes_departamentos` WRITE;
/*!40000 ALTER TABLE `funcionarios_chefes_departamentos` DISABLE KEYS */;
INSERT INTO `funcionarios_chefes_departamentos` VALUES (1,1,1,'2021-05-22'),(2,2,2,'2021-05-22'),(3,3,3,'2021-05-22');
/*!40000 ALTER TABLE `funcionarios_chefes_departamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionarios_progressao_carreiras`
--

DROP TABLE IF EXISTS `funcionarios_progressao_carreiras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `funcionarios_progressao_carreiras` (
  `idFuncionario_progressao` int(11) NOT NULL AUTO_INCREMENT,
  `idFuncionario` int(11) NOT NULL,
  `idDepartamento` int(11) NOT NULL,
  `escalao_antigo` enum('1','2','3','4') DEFAULT NULL,
  `escalao_actual` enum('1','2','3','4') DEFAULT NULL,
  `dataRegisto_progressao` date DEFAULT NULL,
  PRIMARY KEY (`idFuncionario_progressao`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionarios_progressao_carreiras`
--

LOCK TABLES `funcionarios_progressao_carreiras` WRITE;
/*!40000 ALTER TABLE `funcionarios_progressao_carreiras` DISABLE KEYS */;
INSERT INTO `funcionarios_progressao_carreiras` VALUES (1,1,1,'2','1','2021-05-29'),(2,1,1,'1','3','2021-05-29'),(3,2,2,'1','2','2021-05-29'),(4,2,2,'2','3','2021-05-29'),(5,1,1,'3','2','2021-05-29'),(6,1,1,'2','4','2021-05-29'),(7,3,3,'2','3','2021-05-29');
/*!40000 ALTER TABLE `funcionarios_progressao_carreiras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionarios_promocao_carreiras`
--

DROP TABLE IF EXISTS `funcionarios_promocao_carreiras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `funcionarios_promocao_carreiras` (
  `idFuncionario_promovido` int(11) NOT NULL AUTO_INCREMENT,
  `idFuncionario` int(11) NOT NULL,
  `idDepartamento` int(11) NOT NULL,
  `classe_antiga` enum('A','B','C','E') NOT NULL,
  `classe_actual` enum('A','B','C','E') NOT NULL,
  `dataRegisto_promocao` date NOT NULL,
  PRIMARY KEY (`idFuncionario_promovido`),
  KEY `idFuncionario` (`idFuncionario`),
  KEY `idDepartamento` (`idDepartamento`),
  CONSTRAINT `funcionarios_promocao_carreiras_ibfk_1` FOREIGN KEY (`idFuncionario`) REFERENCES `funcionarios` (`idFuncionario`),
  CONSTRAINT `funcionarios_promocao_carreiras_ibfk_2` FOREIGN KEY (`idDepartamento`) REFERENCES `departamentos` (`idDepartamento`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionarios_promocao_carreiras`
--

LOCK TABLES `funcionarios_promocao_carreiras` WRITE;
/*!40000 ALTER TABLE `funcionarios_promocao_carreiras` DISABLE KEYS */;
INSERT INTO `funcionarios_promocao_carreiras` VALUES (4,2,2,'B','A','2021-05-25'),(5,2,2,'A','B','2021-05-25'),(6,5,2,'A','B','2021-05-26'),(7,5,2,'B','C','2021-05-29'),(8,1,1,'C','B','2021-05-29');
/*!40000 ALTER TABLE `funcionarios_promocao_carreiras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `idRole_Users` int(11) NOT NULL,
  `idFuncionario` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `dataRegistoUsuario` date DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `idFuncionario_UNIQUE` (`idFuncionario`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `idRole_Users` (`idRole_Users`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idRole_Users`) REFERENCES `ROLE_USERS` (`idROLE_USER`),
  CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`idFuncionario`) REFERENCES `funcionarios` (`idFuncionario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,1,1,'ernesto@gmail.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef','2021-05-22'),(2,2,2,'maria@gmail.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef','2021-05-22'),(3,3,3,'joao@gmail.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef','2021-05-22'),(4,4,6,'bernarda@gmail.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef','2021-06-02');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 trigger afterInsertUsuario after insert on usuarios for each row update funcionarios set isUserSystem = "Sim" where idFuncionario = NEW.idFuncionario */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-17  5:00:56
