CREATE DATABASE  IF NOT EXISTS `cinema` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `cinema`;
-- MySQL dump 10.13  Distrib 5.7.12, for osx10.9 (x86_64)
--
-- Host: 127.0.0.1    Database: cinema
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.19-MariaDB

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
-- Table structure for table `ACTOR`
--

DROP TABLE IF EXISTS `ACTOR`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ACTOR` (
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`nombre`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ACTOR`
--

LOCK TABLES `ACTOR` WRITE;
/*!40000 ALTER TABLE `ACTOR` DISABLE KEYS */;
INSERT INTO `ACTOR` VALUES ('Amy Adams'),('Benedict Cumberbatch'),('Chiwetel Ejiofor'),('Jeremy Renner'),('Mads Mikkelsen'),('Rachel McAdams');
/*!40000 ALTER TABLE `ACTOR` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ACTUA`
--

DROP TABLE IF EXISTS `ACTUA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ACTUA` (
  `PELICULA_id_pelicula` int(11) NOT NULL,
  `ACTOR_nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`PELICULA_id_pelicula`,`ACTOR_nombre`),
  KEY `fk_ACTUA_PELICULA1_idx` (`PELICULA_id_pelicula`),
  KEY `fk_ACTUA_ACTOR1_idx` (`ACTOR_nombre`),
  CONSTRAINT `fk_ACTUA_ACTOR1` FOREIGN KEY (`ACTOR_nombre`) REFERENCES `ACTOR` (`nombre`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_ACTUA_PELICULA1` FOREIGN KEY (`PELICULA_id_pelicula`) REFERENCES `PELICULA` (`id_pelicula`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ACTUA`
--

LOCK TABLES `ACTUA` WRITE;
/*!40000 ALTER TABLE `ACTUA` DISABLE KEYS */;
INSERT INTO `ACTUA` VALUES (1,'Benedict Cumberbatch'),(1,'Chiwetel Ejiofor'),(1,'Mads Mikkelsen'),(1,'Rachel McAdams'),(2,'Amy Adams'),(2,'Jeremy Renner');
/*!40000 ALTER TABLE `ACTUA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CINE`
--

DROP TABLE IF EXISTS `CINE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CINE` (
  `id_cine` int(11) NOT NULL AUTO_INCREMENT,
  `comuna` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_cine`),
  UNIQUE KEY `id_cine_UNIQUE` (`id_cine`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CINE`
--

LOCK TABLES `CINE` WRITE;
/*!40000 ALTER TABLE `CINE` DISABLE KEYS */;
INSERT INTO `CINE` VALUES (1,'Santiago'),(2,'La Florida');
/*!40000 ALTER TABLE `CINE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CLIENTE`
--

DROP TABLE IF EXISTS `CLIENTE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CLIENTE` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `USUARIO_user` varchar(15) NOT NULL,
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `id_cliente_UNIQUE` (`id_cliente`),
  KEY `fk_CLIENTE_USUARIO1_idx` (`USUARIO_user`),
  CONSTRAINT `fk_CLIENTE_USUARIO1` FOREIGN KEY (`USUARIO_user`) REFERENCES `USUARIO` (`user`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CLIENTE`
--

LOCK TABLES `CLIENTE` WRITE;
/*!40000 ALTER TABLE `CLIENTE` DISABLE KEYS */;
INSERT INTO `CLIENTE` VALUES (1,'bstinson'),(2,'tmosby');
/*!40000 ALTER TABLE `CLIENTE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `COMENTARIO`
--

DROP TABLE IF EXISTS `COMENTARIO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `COMENTARIO` (
  `USUARIO_user` varchar(15) NOT NULL,
  `PELICULA_id_pelicula` int(11) NOT NULL,
  `texto` varchar(500) DEFAULT NULL,
  KEY `fk_COMENTARIO_PELICULA1_idx` (`PELICULA_id_pelicula`),
  KEY `fk_COMENTARIO_USUARIO1` (`USUARIO_user`),
  CONSTRAINT `fk_COMENTARIO_PELICULA1` FOREIGN KEY (`PELICULA_id_pelicula`) REFERENCES `PELICULA` (`id_pelicula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_COMENTARIO_USUARIO1` FOREIGN KEY (`USUARIO_user`) REFERENCES `USUARIO` (`user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `COMENTARIO`
--

LOCK TABLES `COMENTARIO` WRITE;
/*!40000 ALTER TABLE `COMENTARIO` DISABLE KEYS */;
INSERT INTO `COMENTARIO` VALUES ('eparedes',1,'[E] Que grande que es Sherlock'),('bstinson',1,'Ahí noma');
/*!40000 ALTER TABLE `COMENTARIO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `DIRECTOR`
--

DROP TABLE IF EXISTS `DIRECTOR`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DIRECTOR` (
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`nombre`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DIRECTOR`
--

LOCK TABLES `DIRECTOR` WRITE;
/*!40000 ALTER TABLE `DIRECTOR` DISABLE KEYS */;
INSERT INTO `DIRECTOR` VALUES ('Denis Villeneuve'),('Scott Derrickson');
/*!40000 ALTER TABLE `DIRECTOR` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `DIRIGE`
--

DROP TABLE IF EXISTS `DIRIGE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DIRIGE` (
  `PELICULA_id_pelicula` int(11) NOT NULL,
  `DIRECTOR_nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`PELICULA_id_pelicula`,`DIRECTOR_nombre`),
  KEY `fk_DIRIGE_PELICULA1_idx` (`PELICULA_id_pelicula`),
  KEY `fk_DIRIGE_DIRECTOR1_idx` (`DIRECTOR_nombre`),
  CONSTRAINT `fk_DIRIGE_DIRECTOR1` FOREIGN KEY (`DIRECTOR_nombre`) REFERENCES `DIRECTOR` (`nombre`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_DIRIGE_PELICULA1` FOREIGN KEY (`PELICULA_id_pelicula`) REFERENCES `PELICULA` (`id_pelicula`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DIRIGE`
--

LOCK TABLES `DIRIGE` WRITE;
/*!40000 ALTER TABLE `DIRIGE` DISABLE KEYS */;
INSERT INTO `DIRIGE` VALUES (1,'Scott Derrickson'),(2,'Denis Villeneuve');
/*!40000 ALTER TABLE `DIRIGE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EMPLEADO`
--

DROP TABLE IF EXISTS `EMPLEADO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EMPLEADO` (
  `id_empleado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `sueldo` int(11) DEFAULT '300000',
  `CINE_id_cine` int(11) NOT NULL,
  `USUARIO_user` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_empleado`),
  UNIQUE KEY `id_empleado_UNIQUE` (`id_empleado`),
  KEY `fk_EMPLEADO_CINE1_idx` (`CINE_id_cine`),
  KEY `fk_EMPLEADO_USUARIO1_idx` (`USUARIO_user`),
  CONSTRAINT `fk_EMPLEADO_CINE1` FOREIGN KEY (`CINE_id_cine`) REFERENCES `CINE` (`id_cine`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_EMPLEADO_USUARIO1` FOREIGN KEY (`USUARIO_user`) REFERENCES `USUARIO` (`user`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EMPLEADO`
--

LOCK TABLES `EMPLEADO` WRITE;
/*!40000 ALTER TABLE `EMPLEADO` DISABLE KEYS */;
INSERT INTO `EMPLEADO` VALUES (1,'Esteban Paredes',300000,1,'eparedes'),(2,'Justo Villar',300000,1,'jvillar'),(3,'Claudio Baeza',300000,2,'cbaeza'),(4,'Jaime Valdés',300000,2,'jvaldes');
/*!40000 ALTER TABLE `EMPLEADO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `FUNCION`
--

DROP TABLE IF EXISTS `FUNCION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FUNCION` (
  `SALA_n_sala` int(11) NOT NULL,
  `PELICULA_id_pelicula` int(11) NOT NULL,
  `dia` int(11) NOT NULL,
  `hora` time NOT NULL,
  PRIMARY KEY (`SALA_n_sala`,`PELICULA_id_pelicula`,`dia`,`hora`),
  KEY `fk_FUNCION_PELICULA1_idx` (`PELICULA_id_pelicula`),
  CONSTRAINT `fk_FUNCION_PELICULA1` FOREIGN KEY (`PELICULA_id_pelicula`) REFERENCES `PELICULA` (`id_pelicula`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_FUNCION_SALA1` FOREIGN KEY (`SALA_n_sala`) REFERENCES `SALA` (`n_sala`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `FUNCION`
--

LOCK TABLES `FUNCION` WRITE;
/*!40000 ALTER TABLE `FUNCION` DISABLE KEYS */;
/*!40000 ALTER TABLE `FUNCION` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PELICULA`
--

DROP TABLE IF EXISTS `PELICULA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PELICULA` (
  `id_pelicula` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) NOT NULL,
  `genero` varchar(15) DEFAULT NULL,
  `clasificacion` varchar(5) DEFAULT 'TE',
  `precio` int(11) DEFAULT '5000',
  PRIMARY KEY (`id_pelicula`),
  UNIQUE KEY `id_pelicula_UNIQUE` (`id_pelicula`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PELICULA`
--

LOCK TABLES `PELICULA` WRITE;
/*!40000 ALTER TABLE `PELICULA` DISABLE KEYS */;
INSERT INTO `PELICULA` VALUES (1,'Dr. Strange','Fantasía','PG-13',5000),(2,'Arrival','Ciencia Ficción','PG-13',5000);
/*!40000 ALTER TABLE `PELICULA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PROYECTADOR`
--

DROP TABLE IF EXISTS `PROYECTADOR`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PROYECTADOR` (
  `EMPLEADO_id_empleado` int(11) NOT NULL,
  PRIMARY KEY (`EMPLEADO_id_empleado`),
  UNIQUE KEY `EMPLEADO_id_empleado_UNIQUE` (`EMPLEADO_id_empleado`),
  CONSTRAINT `fk_PROYECTADOR_EMPLEADO1` FOREIGN KEY (`EMPLEADO_id_empleado`) REFERENCES `EMPLEADO` (`id_empleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PROYECTADOR`
--

LOCK TABLES `PROYECTADOR` WRITE;
/*!40000 ALTER TABLE `PROYECTADOR` DISABLE KEYS */;
INSERT INTO `PROYECTADOR` VALUES (1),(3);
/*!40000 ALTER TABLE `PROYECTADOR` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SALA`
--

DROP TABLE IF EXISTS `SALA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SALA` (
  `n_sala` int(11) NOT NULL,
  `n_asientos` int(11) DEFAULT '100',
  `CINE_id_cine` int(11) NOT NULL,
  PRIMARY KEY (`n_sala`,`CINE_id_cine`),
  KEY `fk_SALA_CINE_idx` (`CINE_id_cine`),
  CONSTRAINT `fk_SALA_CINE` FOREIGN KEY (`CINE_id_cine`) REFERENCES `CINE` (`id_cine`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SALA`
--

LOCK TABLES `SALA` WRITE;
/*!40000 ALTER TABLE `SALA` DISABLE KEYS */;
INSERT INTO `SALA` VALUES (1,100,1),(1,100,2),(2,100,1),(2,100,2),(3,100,1),(3,100,2);
/*!40000 ALTER TABLE `SALA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TICKET`
--

DROP TABLE IF EXISTS `TICKET`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TICKET` (
  `n_ticket` int(11) NOT NULL AUTO_INCREMENT,
  `asiento` varchar(5) DEFAULT NULL,
  `TRANSACCION_id_transaccion` int(11) NOT NULL,
  `FUNCION_SALA_n_sala` int(11) NOT NULL,
  `FUNCION_PELICULA_id_pelicula` int(11) NOT NULL,
  `FUNCION_dia` int(11) NOT NULL,
  `FUNCION_hora` time NOT NULL,
  PRIMARY KEY (`n_ticket`),
  UNIQUE KEY `n_ticket_UNIQUE` (`n_ticket`),
  KEY `fk_TICKET_TRANSACCION1_idx` (`TRANSACCION_id_transaccion`),
  KEY `fk_TICKET_FUNCION1_idx` (`FUNCION_SALA_n_sala`,`FUNCION_PELICULA_id_pelicula`,`FUNCION_dia`,`FUNCION_hora`),
  CONSTRAINT `fk_TICKET_FUNCION1` FOREIGN KEY (`FUNCION_SALA_n_sala`, `FUNCION_PELICULA_id_pelicula`, `FUNCION_dia`, `FUNCION_hora`) REFERENCES `FUNCION` (`SALA_n_sala`, `PELICULA_id_pelicula`, `dia`, `hora`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_TICKET_TRANSACCION1` FOREIGN KEY (`TRANSACCION_id_transaccion`) REFERENCES `TRANSACCION` (`id_transaccion`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TICKET`
--

LOCK TABLES `TICKET` WRITE;
/*!40000 ALTER TABLE `TICKET` DISABLE KEYS */;
/*!40000 ALTER TABLE `TICKET` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TRANSACCION`
--

DROP TABLE IF EXISTS `TRANSACCION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TRANSACCION` (
  `id_transaccion` int(11) NOT NULL AUTO_INCREMENT,
  `CLIENTE_id_cliente` int(11) NOT NULL,
  `VENDEDOR_EMPLEADO_id_empleado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_transaccion`),
  UNIQUE KEY `id_transaccion_UNIQUE` (`id_transaccion`),
  KEY `fk_TRANSACCION_CLIENTE1_idx` (`CLIENTE_id_cliente`),
  KEY `fk_TRANSACCION_VENDEDOR1_idx` (`VENDEDOR_EMPLEADO_id_empleado`),
  CONSTRAINT `fk_TRANSACCION_CLIENTE1` FOREIGN KEY (`CLIENTE_id_cliente`) REFERENCES `CLIENTE` (`id_cliente`) ON UPDATE CASCADE,
  CONSTRAINT `fk_TRANSACCION_VENDEDOR1` FOREIGN KEY (`VENDEDOR_EMPLEADO_id_empleado`) REFERENCES `VENDEDOR` (`EMPLEADO_id_empleado`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TRANSACCION`
--

LOCK TABLES `TRANSACCION` WRITE;
/*!40000 ALTER TABLE `TRANSACCION` DISABLE KEYS */;
/*!40000 ALTER TABLE `TRANSACCION` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TURNO`
--

DROP TABLE IF EXISTS `TURNO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TURNO` (
  `hora` int(11) NOT NULL,
  `dia` int(11) NOT NULL,
  `PROYECTADOR_EMPLEADO_id_empleado` int(11) NOT NULL,
  `SALA_n_sala` int(11) NOT NULL,
  `SALA_CINE_id_cine` int(11) NOT NULL,
  PRIMARY KEY (`hora`,`dia`,`PROYECTADOR_EMPLEADO_id_empleado`,`SALA_n_sala`,`SALA_CINE_id_cine`),
  KEY `fk_TURNO_PROYECTADOR1_idx` (`PROYECTADOR_EMPLEADO_id_empleado`),
  KEY `fk_TURNO_SALA1_idx` (`SALA_n_sala`,`SALA_CINE_id_cine`),
  CONSTRAINT `fk_TURNO_PROYECTADOR1` FOREIGN KEY (`PROYECTADOR_EMPLEADO_id_empleado`) REFERENCES `PROYECTADOR` (`EMPLEADO_id_empleado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_TURNO_SALA1` FOREIGN KEY (`SALA_n_sala`, `SALA_CINE_id_cine`) REFERENCES `SALA` (`n_sala`, `CINE_id_cine`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TURNO`
--

LOCK TABLES `TURNO` WRITE;
/*!40000 ALTER TABLE `TURNO` DISABLE KEYS */;
/*!40000 ALTER TABLE `TURNO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `USUARIO`
--

DROP TABLE IF EXISTS `USUARIO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `USUARIO` (
  `user` varchar(15) NOT NULL,
  `rut` varchar(12) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`user`),
  UNIQUE KEY `user_UNIQUE` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `USUARIO`
--

LOCK TABLES `USUARIO` WRITE;
/*!40000 ALTER TABLE `USUARIO` DISABLE KEYS */;
INSERT INTO `USUARIO` VALUES ('bstinson','','1234'),('cbaeza',NULL,'1234'),('eparedes',NULL,'1234'),('jvaldes',NULL,'1234'),('jvillar',NULL,'1234'),('tmosby','','1234');
/*!40000 ALTER TABLE `USUARIO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `VENDEDOR`
--

DROP TABLE IF EXISTS `VENDEDOR`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VENDEDOR` (
  `EMPLEADO_id_empleado` int(11) NOT NULL,
  PRIMARY KEY (`EMPLEADO_id_empleado`),
  UNIQUE KEY `EMPLEADO_id_empleado_UNIQUE` (`EMPLEADO_id_empleado`),
  CONSTRAINT `fk_VENDEDOR_EMPLEADO1` FOREIGN KEY (`EMPLEADO_id_empleado`) REFERENCES `EMPLEADO` (`id_empleado`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `VENDEDOR`
--

LOCK TABLES `VENDEDOR` WRITE;
/*!40000 ALTER TABLE `VENDEDOR` DISABLE KEYS */;
INSERT INTO `VENDEDOR` VALUES (2),(4);
/*!40000 ALTER TABLE `VENDEDOR` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-02 21:32:43
