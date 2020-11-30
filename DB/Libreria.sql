CREATE DATABASE  IF NOT EXISTS `libreria` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `libreria`;
-- MySQL dump 10.13  Distrib 8.0.20, for Win64 (x86_64)
--
-- Host: localhost    Database: libreria
-- ------------------------------------------------------
-- Server version	8.0.20

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `carrito`
--

DROP TABLE IF EXISTS `carrito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carrito` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `IDUsuario` int NOT NULL,
  `IDLibro` int NOT NULL,
  `Libro` varchar(50) NOT NULL,
  `Precio` decimal(6,2) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `IDUsuario` (`IDUsuario`),
  KEY `IDLibro` (`IDLibro`),
  CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`IDUsuario`) REFERENCES `usuario` (`ID`),
  CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`IDLibro`) REFERENCES `libro` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrito`
--

LOCK TABLES `carrito` WRITE;
/*!40000 ALTER TABLE `carrito` DISABLE KEYS */;
/*!40000 ALTER TABLE `carrito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deseados`
--

DROP TABLE IF EXISTS `deseados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `deseados` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `IDUsuario` int NOT NULL,
  `IDLibro` int NOT NULL,
  `Libro` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `IDUsuario` (`IDUsuario`),
  KEY `IDLibro` (`IDLibro`),
  CONSTRAINT `deseados_ibfk_1` FOREIGN KEY (`IDUsuario`) REFERENCES `usuario` (`ID`),
  CONSTRAINT `deseados_ibfk_2` FOREIGN KEY (`IDLibro`) REFERENCES `libro` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deseados`
--

LOCK TABLES `deseados` WRITE;
/*!40000 ALTER TABLE `deseados` DISABLE KEYS */;
/*!40000 ALTER TABLE `deseados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `libro`
--

DROP TABLE IF EXISTS `libro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `libro` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Titulo` varchar(50) NOT NULL,
  `Descripcion` text,
  `Precio` decimal(6,2) NOT NULL,
  `Stock` int NOT NULL,
  `Foto` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libro`
--

LOCK TABLES `libro` WRITE;
/*!40000 ALTER TABLE `libro` DISABLE KEYS */;
/*!40000 ALTER TABLE `libro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pago`
--

DROP TABLE IF EXISTS `pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pago` (
  `IDUsuario` int NOT NULL,
  `IDCarrito` int NOT NULL,
  `Metodo` varchar(50) NOT NULL,
  `Monto` varchar(50) NOT NULL,
  `Cantidad` int NOT NULL,
  `Fecha` date NOT NULL,
  PRIMARY KEY (`IDUsuario`,`IDCarrito`),
  KEY `IDCarrito` (`IDCarrito`),
  CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`IDUsuario`) REFERENCES `usuario` (`ID`),
  CONSTRAINT `pago_ibfk_2` FOREIGN KEY (`IDCarrito`) REFERENCES `carrito` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pago`
--

LOCK TABLES `pago` WRITE;
/*!40000 ALTER TABLE `pago` DISABLE KEYS */;
/*!40000 ALTER TABLE `pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Usuario` varchar(50) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Direccion` varchar(200) NOT NULL,
  `EsEmpleado` int DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'asdasdasdsad@sadad.da','asdasd sadas','12345','asdasda',0);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-11-30 15:03:38
