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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `crianca`
--

LOCK TABLES `crianca` WRITE;
/*!40000 ALTER TABLE `crianca` DISABLE KEYS */;
INSERT INTO `crianca` VALUES (24,'teste_etec_ds',21,'2023-10-04',NULL),(25,'teste_etec_ds_2',21,'2024-08-07',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `iteracoes`
--

LOCK TABLES `iteracoes` WRITE;
/*!40000 ALTER TABLE `iteracoes` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `responsavel`
--

LOCK TABLES `responsavel` WRITE;
/*!40000 ALTER TABLE `responsavel` DISABLE KEYS */;
INSERT INTO `responsavel` VALUES (21,'Teste_etec','tcc_ds@etec.com','123456','2025-05-26 22:03:50');
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

-- Dump completed on 2025-05-26 22:20:53
