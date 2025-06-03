CREATE DATABASE  IF NOT EXISTS `unibellezaaditha` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `unibellezaaditha`;
-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: localhost    Database: unibellezaaditha
-- ------------------------------------------------------
-- Server version	8.0.42-0ubuntu0.22.04.1

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
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria` (
  `idcategoria` int NOT NULL,
  `nombre_categoria` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'Maquillaje','Todo tipo de maquillaje'),(2,'Fragancias','Para dama y caballero'),(3,'Cuidado Facial','Mantener tu piel');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente` (
  `idcliente` int NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `telefono` int DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idcliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'Ana ','Flores','ana@gmail.com',989563120,'Las acacias'),(2,'Maria','Valencia','mari@gmail.com',912456790,'Aire libre'),(3,'Fernando','Quintero','fer@gmail.com',944445678,'Esmeraldas libre'),(4,'Carolina','Mera','car@gmail.com',945872130,'15 de marzo'),(5,'Jessica','Morales','jesi@gmail.com',957893670,'Tolita 2');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detallepedido`
--

DROP TABLE IF EXISTS `detallepedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detallepedido` (
  `iddetallepedido` int NOT NULL,
  `cantidad` varchar(45) DEFAULT NULL,
  `precio_unitario` varchar(45) DEFAULT NULL,
  `precio_total` varchar(45) DEFAULT NULL,
  `fk_idpedido` int NOT NULL,
  `fk_idproducto` int NOT NULL,
  PRIMARY KEY (`iddetallepedido`),
  KEY `fk_detallepedido_pedido1_idx` (`fk_idpedido`),
  KEY `fk_detallepedido_producto1_idx` (`fk_idproducto`),
  CONSTRAINT `fk_detallepedido_pedido1` FOREIGN KEY (`fk_idpedido`) REFERENCES `pedido` (`idpedido`),
  CONSTRAINT `fk_detallepedido_producto1` FOREIGN KEY (`fk_idproducto`) REFERENCES `producto` (`idproducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detallepedido`
--

LOCK TABLES `detallepedido` WRITE;
/*!40000 ALTER TABLE `detallepedido` DISABLE KEYS */;
INSERT INTO `detallepedido` VALUES (1,'5 labiales','$3','$15',4,2),(2,'7 rubores','$4','$28',1,4),(3,'8 perfumes','$30','$240',2,3),(4,'20 cremas','$5','$100',3,1),(5,'14 desodorantes','$3','$42',5,5),(6,'2 Bases','$10','$20',2,1),(7,'2','25','50',2,3);
/*!40000 ALTER TABLE `detallepedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedido`
--

DROP TABLE IF EXISTS `pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedido` (
  `idpedido` int NOT NULL,
  `fecha_pedido` varchar(45) DEFAULT NULL,
  `estado_pedido` varchar(45) DEFAULT NULL,
  `fk_idcliente` int NOT NULL,
  PRIMARY KEY (`idpedido`),
  KEY `fk_pedido_cliente1_idx` (`fk_idcliente`),
  CONSTRAINT `fk_pedido_cliente1` FOREIGN KEY (`fk_idcliente`) REFERENCES `cliente` (`idcliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido`
--

LOCK TABLES `pedido` WRITE;
/*!40000 ALTER TABLE `pedido` DISABLE KEYS */;
INSERT INTO `pedido` VALUES (1,'13/05/2024','Entregado',1),(2,'11/02/2025','Entregado',2),(3,'09/10/2024','Entregado',3),(4,'01/03/2025','Entregado',4),(5,'24/04/2025','En ruta',5);
/*!40000 ALTER TABLE `pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `producto` (
  `idproducto` int NOT NULL,
  `Portada` varchar(255) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `precio` varchar(45) DEFAULT NULL,
  `fk_idcategoria` int NOT NULL,
  `createAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idproducto`),
  KEY `fk_producto_categoria1_idx` (`fk_idcategoria`),
  CONSTRAINT `fk_producto_categoria1` FOREIGN KEY (`fk_idcategoria`) REFERENCES `categoria` (`idcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (1,'1.Labial Ya.jpg','Labial Ya','Labial en barra','3',1,'2025-05-07 02:02:01','2025-05-19 21:50:57'),(2,'2.Barra multiuso.jpg','Barra multiuso','Barra color rosa,  se usa como sombra, rubor y labial.','3',1,'2025-05-07 02:02:01','2025-05-21 02:53:41'),(3,'3.Osadia Infinita.jpg','Osadia Infinita','Perfume para dama','25',2,'2025-05-07 02:02:01','2025-05-21 20:47:23'),(4,'4.Rubor.jpg','Rubor','Color rosa','4',1,'2025-05-07 02:02:01','2025-05-20 00:22:01'),(5,'5.Desodorante Arom.jpg','Desodorante Arom','Desodorante para caballero','3',2,'2025-05-07 02:02:01','2025-05-20 00:23:17');
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `auth_key` varchar(45) DEFAULT NULL,
  `access_token` varchar(45) DEFAULT NULL,
  `role` varchar(45) DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'usu1','ada','galarza','$2y$13$WTGxIQ4CqkUQSBjc/gj7runjzlwPGSZ962jDjH9f4PwE8TUVwyAy.','ww5Im5njARX9QxhExa0D63JXGbDpMc5d','y2HQNbknTEOcDVME7rv3JbPYEC5xGZ29','admin'),(2,'usu2','naomi','caicedo','$2y$13$2gxi8l8.m5tjn8jY1vVxUePZmpQjhPAb/I.9TP3TaMm1lb/uf2DDq','XukoXhbnF1ng84HnGTF_5wtYGnQmhneo','wYCJ2X_0FhSEpQ4D-D3FmyCqiyhoudUx','user');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-03 12:52:20
