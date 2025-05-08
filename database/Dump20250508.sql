-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: localhost    Database: papinho
-- ------------------------------------------------------
-- Server version	8.0.41

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
  `id_categoria` int NOT NULL AUTO_INCREMENT,
  `nome_categoria` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descricao_categoria` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'emocao','emoções das crianças'),(5,'familia','familiares da criança'),(6,'Fome','imagens relacionadas a alimentação'),(7,'atividades','atividaes que a criança realiza');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `crianca`
--

DROP TABLE IF EXISTS `crianca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `crianca` (
  `id_crianca` int NOT NULL AUTO_INCREMENT,
  `nome_crianca` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `id_responsavel` int DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `genero` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_crianca`),
  KEY `id_responsavel` (`id_responsavel`),
  CONSTRAINT `crianca_ibfk_1` FOREIGN KEY (`id_responsavel`) REFERENCES `responsavel` (`id_responsavel`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `crianca`
--

LOCK TABLES `crianca` WRITE;
/*!40000 ALTER TABLE `crianca` DISABLE KEYS */;
INSERT INTO `crianca` VALUES (1,'gergwegwegerg',NULL,'1456-11-11',NULL),(2,'gergwegwegerg',NULL,'1456-11-11',NULL),(3,'gestrudes',9,'2025-04-16',NULL),(4,'gestrudes',10,'2021-01-06',NULL),(5,'marilia',11,'1998-11-11',NULL),(6,'amado',3,'2025-04-14',NULL),(7,'amado',13,'2025-04-14',NULL),(8,'sdrgdfhdfhdfh',14,'2024-12-18',NULL),(9,'kuftysryesdtyfhj',15,'2025-04-03',NULL),(10,'saulo',3,'2024-12-04',NULL),(11,'sdrgdfhdfhdfh',17,'2025-04-23',NULL),(12,'testejr',18,'2025-04-01',NULL),(13,'testejr',3,'2020-01-10',NULL),(14,'Ronaldo femonemo',13,'2024-12-03',NULL),(15,'Macarena julia',13,'2018-01-24',NULL),(16,'mico leao',3,'2017-01-30',NULL),(17,'Getulio Vargas',13,'1976-01-07',NULL),(18,'Gabriel o Pensador',19,'2024-02-06',NULL),(19,'teste_relatorio',3,'2025-01-06',NULL);
/*!40000 ALTER TABLE `crianca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imagem`
--

DROP TABLE IF EXISTS `imagem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `imagem` (
  `id_imagem` int NOT NULL AUTO_INCREMENT,
  `nome_imagem` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `id_categoria` int DEFAULT NULL,
  PRIMARY KEY (`id_imagem`),
  KEY `id_categoria` (`id_categoria`),
  CONSTRAINT `imagem_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagem`
--

LOCK TABLES `imagem` WRITE;
/*!40000 ALTER TABLE `imagem` DISABLE KEYS */;
INSERT INTO `imagem` VALUES (2,'Triste',1),(3,'Bravo',1),(4,'Feliz',1),(6,'Água',6),(11,'Pai',5),(12,'Mãe',5),(13,'Vô',5),(14,'Vó',5),(15,'Desenhar',7),(16,'Livro',7),(17,'Parquinho',7),(18,'Fome',6),(19,'Fruta',6),(20,'Lanche',6),(21,'Leite',6);
/*!40000 ALTER TABLE `imagem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `iteracoes`
--

DROP TABLE IF EXISTS `iteracoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `iteracoes` (
  `id_iteracao` int NOT NULL AUTO_INCREMENT,
  `id_imagem` int DEFAULT NULL,
  `id_crianca` int DEFAULT NULL,
  `data_iteracao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_iteracao`),
  KEY `id_imagem` (`id_imagem`),
  KEY `id_crianca` (`id_crianca`),
  CONSTRAINT `iteracoes_ibfk_1` FOREIGN KEY (`id_imagem`) REFERENCES `imagem` (`id_imagem`),
  CONSTRAINT `iteracoes_ibfk_2` FOREIGN KEY (`id_crianca`) REFERENCES `crianca` (`id_crianca`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `iteracoes`
--

LOCK TABLES `iteracoes` WRITE;
/*!40000 ALTER TABLE `iteracoes` DISABLE KEYS */;
INSERT INTO `iteracoes` VALUES (1,3,3,'2025-04-29 17:38:05'),(2,3,6,'2025-04-29 18:48:44'),(3,2,6,'2025-04-29 18:50:18'),(4,4,10,'2025-04-29 18:50:25'),(5,3,10,'2025-04-29 18:50:41'),(6,3,6,'2025-04-29 18:50:44'),(7,3,13,'2025-04-29 19:34:43'),(8,3,13,'2025-04-29 19:34:44'),(9,4,13,'2025-04-29 19:34:46'),(10,4,13,'2025-04-29 19:34:47'),(11,3,14,'2025-04-29 19:36:04'),(12,3,14,'2025-04-29 19:36:06'),(13,4,14,'2025-04-29 19:36:07'),(14,2,14,'2025-04-29 19:36:08'),(15,3,15,'2025-04-29 19:38:20'),(16,3,15,'2025-04-29 19:38:21'),(17,3,6,'2025-04-29 20:15:01'),(18,4,6,'2025-04-29 20:15:04'),(19,2,6,'2025-04-29 20:15:05'),(20,3,16,'2025-04-29 20:18:45'),(21,3,16,'2025-04-29 20:18:47'),(22,3,16,'2025-04-29 20:18:49'),(23,4,16,'2025-04-29 20:18:51'),(24,4,16,'2025-04-29 20:18:52'),(25,2,6,'2025-05-06 13:00:33'),(26,4,6,'2025-05-06 13:00:34'),(27,3,6,'2025-05-06 13:00:35'),(28,6,14,'2025-05-06 13:40:08'),(29,18,14,'2025-05-06 13:40:10'),(30,19,14,'2025-05-06 13:40:12'),(31,20,14,'2025-05-06 13:40:13'),(32,21,14,'2025-05-06 13:40:14'),(33,12,14,'2025-05-06 13:40:16'),(34,11,14,'2025-05-06 13:40:17'),(35,14,14,'2025-05-06 13:40:18'),(36,13,14,'2025-05-06 13:40:19'),(37,2,14,'2025-05-06 13:40:21'),(38,4,14,'2025-05-06 13:40:22'),(39,3,14,'2025-05-06 13:40:23'),(40,15,14,'2025-05-06 13:40:25'),(41,16,14,'2025-05-06 13:40:26'),(42,17,14,'2025-05-06 13:40:27'),(43,6,7,'2025-05-06 13:43:12'),(44,6,7,'2025-05-06 13:43:13'),(45,6,7,'2025-05-06 13:43:14'),(46,6,7,'2025-05-06 13:43:15'),(47,6,7,'2025-05-06 13:43:16'),(48,6,15,'2025-05-06 13:44:54'),(49,6,15,'2025-05-06 13:44:56'),(50,6,15,'2025-05-06 13:44:57'),(51,6,15,'2025-05-06 13:44:58'),(52,6,18,'2025-05-06 18:49:14'),(53,20,18,'2025-05-06 18:49:19'),(54,6,16,'2025-05-08 14:00:03'),(55,6,16,'2025-05-08 14:00:04'),(56,6,16,'2025-05-08 14:00:05'),(57,18,16,'2025-05-08 14:00:06'),(58,19,16,'2025-05-08 14:00:07'),(59,20,16,'2025-05-08 14:00:07'),(60,21,16,'2025-05-08 14:00:08'),(61,13,16,'2025-05-08 14:00:09'),(62,11,16,'2025-05-08 14:00:11'),(63,12,16,'2025-05-08 14:00:11'),(64,20,16,'2025-05-08 14:00:12'),(65,19,16,'2025-05-08 14:00:13'),(66,6,6,'2025-05-08 14:30:34'),(67,18,6,'2025-05-08 14:30:36'),(68,19,6,'2025-05-08 14:30:37'),(69,20,6,'2025-05-08 14:30:38'),(70,21,6,'2025-05-08 14:30:39'),(71,12,6,'2025-05-08 14:30:41'),(72,11,6,'2025-05-08 14:30:42'),(73,14,6,'2025-05-08 14:30:43'),(74,13,6,'2025-05-08 14:30:44'),(75,2,6,'2025-05-08 14:30:46'),(76,4,6,'2025-05-08 14:30:47'),(77,3,6,'2025-05-08 14:30:48'),(78,15,6,'2025-05-08 14:30:50'),(79,16,6,'2025-05-08 14:30:51'),(80,17,6,'2025-05-08 14:30:52'),(81,3,6,'2025-05-08 14:31:28'),(82,3,6,'2025-05-08 14:31:29'),(83,3,6,'2025-05-08 14:31:29'),(84,3,6,'2025-05-08 14:31:30'),(85,3,6,'2025-05-08 14:31:30'),(86,3,6,'2025-05-08 14:31:31'),(87,3,6,'2025-05-08 14:31:32'),(88,3,6,'2025-05-08 14:31:32'),(89,3,6,'2025-05-08 14:31:33'),(90,3,6,'2025-05-08 14:31:33'),(91,6,19,'2025-05-08 16:02:16'),(92,18,19,'2025-05-08 16:02:17'),(93,19,19,'2025-05-08 16:02:19'),(94,20,19,'2025-05-08 16:02:20'),(95,21,19,'2025-05-08 16:02:21'),(96,12,19,'2025-05-08 16:02:25'),(97,11,19,'2025-05-08 16:02:26'),(98,14,19,'2025-05-08 16:02:27'),(99,13,19,'2025-05-08 16:02:29'),(100,2,19,'2025-05-08 16:02:31'),(101,4,19,'2025-05-08 16:02:31'),(102,3,19,'2025-05-08 16:02:32'),(103,15,19,'2025-05-08 16:02:34'),(104,16,19,'2025-05-08 16:02:34'),(105,17,19,'2025-05-08 16:02:36');
/*!40000 ALTER TABLE `iteracoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relatorios`
--

DROP TABLE IF EXISTS `relatorios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `relatorios` (
  `id_relatorio` int NOT NULL AUTO_INCREMENT,
  `id_crianca` int DEFAULT NULL,
  `gerado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_relatorio`),
  KEY `id_crianca` (`id_crianca`),
  CONSTRAINT `relatorios_ibfk_1` FOREIGN KEY (`id_crianca`) REFERENCES `crianca` (`id_crianca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relatorios`
--

LOCK TABLES `relatorios` WRITE;
/*!40000 ALTER TABLE `relatorios` DISABLE KEYS */;
/*!40000 ALTER TABLE `relatorios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `responsavel`
--

DROP TABLE IF EXISTS `responsavel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `responsavel` (
  `id_responsavel` int NOT NULL AUTO_INCREMENT,
  `nome_responsavel` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `senha` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_responsavel`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `responsavel`
--

LOCK TABLES `responsavel` WRITE;
/*!40000 ALTER TABLE `responsavel` DISABLE KEYS */;
INSERT INTO `responsavel` VALUES (2,'teste input','testeinput@teste.com','teste input','2025-01-13 15:07:15'),(3,'pedro','p.nac124111@gmail.com','12345678','2025-01-13 15:12:58'),(4,'pedro','p.nac124111@gmail.com','12345678','2025-01-13 15:15:20'),(5,'pedro','p.nac124111@gmail.com','12345678','2025-01-13 15:15:36'),(6,'pedro','p.nac124111@gmail.com','12345678','2025-01-13 15:15:38'),(7,'Marciolio dias','maria_vai_com_as_outras@gmail.com','1234567','2025-04-01 08:18:19'),(8,'gerome pique','gerome123@hotmail.com','1234567','2025-04-01 08:20:13'),(9,'carabino','carabinadime123@hotmail.com','1234567','2025-04-01 08:26:45'),(10,'FOSEFINA DE AMARAL','JOSEFINA JUNIA','1234567','2025-04-01 19:46:34'),(11,'Tatiana do Carmo','tadificil@gmail.com','12345678','2025-04-01 19:55:24'),(12,'joelma santos','pedro_vitor14@hotmail.com','1234567','2025-04-01 20:02:06'),(13,'cecilia santos','cecilia@gmail.com','1234567','2025-04-01 20:10:33'),(14,'Marcos kjashdkjahsd','marquito@iifusshdf','12345678','2025-04-05 19:53:24'),(15,' kgjkfthdtrryd','mhgfjhfjuyf@xn--kllklk-wuabc','12345678','2025-04-05 21:15:17'),(16,'arnobio santos','arnobio@arnobio1.com','12345678','2025-04-06 20:53:33'),(17,'pedro','pee.nac124111@gmail.com','12345','2025-04-06 23:09:11'),(18,'tetestehoje','teste@hoje.com','12345678','2025-04-16 21:46:12'),(19,'Eduardo Batista','eduardo@batista.com.br','12345678','2025-05-06 15:48:18');
/*!40000 ALTER TABLE `responsavel` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-08 13:17:46
