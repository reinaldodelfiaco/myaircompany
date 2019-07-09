-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: voeava
-- ------------------------------------------------------
-- Server version	5.7.25

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
-- Table structure for table `plano_voo`
--

DROP TABLE IF EXISTS `plano_voo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plano_voo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_voo` int(11) NOT NULL,
  `id_aeronave` int(11) NOT NULL,
  `regra_voo` varchar(1) DEFAULT NULL,
  `tipo_voo` varchar(45) DEFAULT NULL,
  `cat_esteira_turbulencia` varchar(45) DEFAULT NULL,
  `equipamento_capacidades` varchar(45) DEFAULT NULL,
  `aerodromo_partida` varchar(45) DEFAULT NULL,
  `hora_partida` time(6) DEFAULT NULL,
  `velocidade_cruzeiro` int(11) DEFAULT NULL,
  `nivel` int(11) DEFAULT NULL,
  `rota` varchar(200) DEFAULT NULL,
  `aerodromo_destino` varchar(45) DEFAULT NULL,
  `eet_total` time(4) DEFAULT NULL,
  `aerodromo_altn` varchar(45) DEFAULT NULL COMMENT 'aerodromo alternativo',
  `segundo_aerodromo_altn` varchar(45) DEFAULT NULL COMMENT '2º aerodromo alternativo',
  `outros_dados` varchar(200) DEFAULT NULL,
  `hora_autonomia` time(4) DEFAULT NULL,
  `pessoas_bordo` varchar(300) DEFAULT NULL,
  `radio_uhf` int(1) DEFAULT NULL,
  `radio_vhf` int(1) DEFAULT NULL,
  `radio_elt` int(1) DEFAULT NULL,
  `survival_polar` int(1) DEFAULT NULL,
  `survival_desert` int(1) DEFAULT NULL,
  `survival_maritime` int(1) DEFAULT NULL,
  `survival_jungle` int(1) DEFAULT NULL,
  `colete_luz` int(1) DEFAULT NULL,
  `colete_fluor` int(1) DEFAULT NULL,
  `colete_uhf` int(1) DEFAULT NULL,
  `colete_vhf` int(1) DEFAULT NULL,
  `botes_numero` int(11) DEFAULT NULL,
  `botes_capacidade` int(11) DEFAULT NULL,
  `abrigo_cor` varchar(45) DEFAULT NULL,
  `cor_marca_aeronave` varchar(45) DEFAULT NULL,
  `observacoes` varchar(45) DEFAULT NULL,
  `id_piloto_comando` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_aeronave_idx` (`id_aeronave`),
  KEY `fk_id_piloto_comando_idx` (`id_piloto_comando`),
  KEY `fk_id_voo_idx` (`id_voo`),
  CONSTRAINT `fk_id_aeronave` FOREIGN KEY (`id_aeronave`) REFERENCES `aeronaves` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_piloto_comando` FOREIGN KEY (`id_piloto_comando`) REFERENCES `chefias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_voo_plano` FOREIGN KEY (`id_voo`) REFERENCES `voos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `plano_voo_cartas`
--

DROP TABLE IF EXISTS `plano_voo_cartas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plano_voo_cartas` (
  `nome_carta` varchar(55) NOT NULL,
  `icao` varchar(6) NOT NULL,
  `id_plano_voo` int(11) NOT NULL,
  PRIMARY KEY (`nome_carta`,`icao`,`id_plano_voo`),
  KEY `fk_plano_voo_idx` (`id_plano_voo`),
  CONSTRAINT `fk_plano_voo` FOREIGN KEY (`id_plano_voo`) REFERENCES `plano_voo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `plano_voo_meteorologia`
--

DROP TABLE IF EXISTS `plano_voo_meteorologia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plano_voo_meteorologia` (
  `msg_metar` varchar(500) DEFAULT NULL,
  `msg_taf` varchar(500) DEFAULT NULL,
  `icao` varchar(6) NOT NULL,
  `id_plano_voo` int(11) NOT NULL,
  KEY `fk_plano_voo_met_idx` (`id_plano_voo`),
  CONSTRAINT `fk_plano_voo_met` FOREIGN KEY (`id_plano_voo`) REFERENCES `plano_voo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `plano_voo_nascer_por_sol`
--

DROP TABLE IF EXISTS `plano_voo_nascer_por_sol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plano_voo_nascer_por_sol` (
  `data` varchar(25) NOT NULL,
  `sunrise` varchar(45) NOT NULL,
  `sunset` varchar(45) NOT NULL,
  `icao` varchar(45) NOT NULL,
  `id_plano_voo` int(11) NOT NULL,
  KEY `fk_plano_voo_ns_por_sol_idx` (`id_plano_voo`),
  CONSTRAINT `fk_plano_voo_ns_por_sol` FOREIGN KEY (`id_plano_voo`) REFERENCES `plano_voo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `plano_voo_notam`
--

DROP TABLE IF EXISTS `plano_voo_notam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plano_voo_notam` (
  `cod_notam` varchar(10) NOT NULL,
  `id_plano_voo` int(11) NOT NULL,
  `icao` varchar(45) NOT NULL,
  KEY `fk_id_plano_voo_idx` (`id_plano_voo`),
  CONSTRAINT `fk_id_plano_voo` FOREIGN KEY (`id_plano_voo`) REFERENCES `plano_voo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `voos`
--

DROP TABLE IF EXISTS `voos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aeronave` int(11) DEFAULT NULL,
  `lugares` int(11) DEFAULT NULL,
  `origem` varchar(50) DEFAULT NULL,
  `destino` varchar(50) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `hora_partida` time DEFAULT NULL,
  `hora_chegada` time DEFAULT NULL,
  `data_cadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-15  0:25:58
