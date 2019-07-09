-- --------------------------------------------------------
-- Servidor:                     31.170.161.238
-- Versão do servidor:           10.2.24-MariaDB - MariaDB Server
-- OS do Servidor:               Linux
-- HeidiSQL Versão:              10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para voeavasi_bd
CREATE DATABASE IF NOT EXISTS `voeavasi_bd` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `voeavasi_bd`;

-- Copiando estrutura para tabela voeavasi_bd.aeronaves
CREATE TABLE IF NOT EXISTS `aeronaves` (
  `id` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `categoria_do_voo` varchar(255) NOT NULL,
  `matricula` varchar(255) NOT NULL,
  `fabricante` varchar(255) NOT NULL,
  `tipo_icao` varchar(255) NOT NULL,
  `anoFabricacao` varchar(4) NOT NULL,
  `cor` varchar(255) NOT NULL,
  `proprietario` varchar(255) NOT NULL,
  `operador` varchar(255) NOT NULL,
  `pax_max` varchar(255) NOT NULL,
  `preco_custo_hora` int(15) NOT NULL,
  `preco_custo_panoramico` int(15) NOT NULL,
  `preco_hora` int(15) NOT NULL,
  `preco_panoramico` int(15) NOT NULL,
  `iam` date NOT NULL,
  `extintor` date NOT NULL,
  `seguro` date NOT NULL,
  `ca` date NOT NULL,
  `cm` date NOT NULL,
  `estacao` date NOT NULL,
  `cons_comb_hora_kg` varchar(5) NOT NULL COMMENT 'Consumo de combustível por hora',
  `pilotos` text NOT NULL,
  `data_cad` date NOT NULL,
  `extras` text NOT NULL,
  `crew_min` varchar(2) NOT NULL,
  `cat_esteira_de_turbulencia` varchar(1) NOT NULL,
  `numeroSerie` varchar(8) NOT NULL,
  `modelo` varchar(4) NOT NULL,
  `equipamento_capacidades` varchar(25) NOT NULL,
  `acft_ativa` int(1) NOT NULL,
  `hora_total_inicial` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela voeavasi_bd.aeronaves: 14 rows
/*!40000 ALTER TABLE `aeronaves` DISABLE KEYS */;
INSERT INTO `aeronaves` (`id`, `categoria_do_voo`, `matricula`, `fabricante`, `tipo_icao`, `anoFabricacao`, `cor`, `proprietario`, `operador`, `pax_max`, `preco_custo_hora`, `preco_custo_panoramico`, `preco_hora`, `preco_panoramico`, `iam`, `extintor`, `seguro`, `ca`, `cm`, `estacao`, `cons_comb_hora_kg`, `pilotos`, `data_cad`, `extras`, `crew_min`, `cat_esteira_de_turbulencia`, `numeroSerie`, `modelo`, `equipamento_capacidades`, `acft_ativa`, `hora_total_inicial`) VALUES
	(00001, 'PrÃ³pria', 'PT-ETV', 'Neiva', 'Pa32', '1978', 'Branco Com Faixas Vermelhas ', 'Joao Batista Freitas ', 'Jefferson Da Silva Freitas-me', '6', 0, 0, 0, 0, '2018-11-30', '2020-11-30', '2019-08-17', '2022-01-01', '2022-01-01', '2019-03-31', '60', '8-2-1-3-16-5-20', '2017-01-12', '', '1', 'L', '', 'Emb-', 'Vhf', 0, '2540'),
	(00002, 'Fretada', 'PT-CAA', 'Cessna', 'C-172', '1964', 'Branca Com Faixas Azuis ', 'Yuri De Freitas E Silva ', 'Yuri De Freitas E Silva ', '3', 0, 0, 0, 50000, '2017-01-10', '2017-02-01', '2017-03-14', '2018-02-14', '2017-08-17', '2017-04-20', '0', '2', '2017-02-23', '', '1', '', '', '', '', 0, '4200'),
	(00003, 'Fretada', 'PT-DXE', 'Cessna', 'C -182', '1971', 'Branco Com Faixas Azuils', 'Christian GonÃ§alves De Oliveira', 'Luan Anderson', '3', 0, 0, 0, 50000, '2017-10-31', '0000-00-00', '2017-12-27', '2017-08-31', '0000-00-00', '0000-00-00', '60', '4', '2017-03-06', '', '1', '', '', '', '', 1, '2621'),
	(00004, 'Fretada', 'PT-CFA', 'Cessna', 'C-172', '1964', 'Branca Com Faixas Azuis ', 'Hinaldo B Pianco ', 'Hinaldo Pianco ', '3', 0, 0, 0, 50000, '2017-09-30', '2017-11-25', '2018-03-13', '2018-03-23', '0000-00-00', '0000-00-00', '30', '5', '2017-06-23', '', '1', '', '', '', '', 0, '1705'),
	(00005, 'Fretada', 'PT-BHC', 'Cessna', 'C172', '', 'Branca', 'MURILLO EFRAIN SILVA DE OLIVEIRA', 'MURILLO EFRAIN SILVA DE OLIVEIRA', '3', 0, 0, 0, 50000, '2018-08-01', '2018-08-01', '2018-08-01', '2020-03-28', '2020-03-28', '2018-08-01', '25', '6', '2017-08-12', '', '1', '', '', '', '', 0, '1000'),
	(00006, 'Fretada', 'PT-RPG', 'Piper', 'Pa28t', '1985', 'Branca Com Faixas Azuis', 'Valeria LobÃ£o Reis', 'Valeria LobÃ£o Reis', '3', 0, 0, 0, 125000, '2018-11-11', '2018-11-11', '2018-10-21', '2023-11-11', '2018-11-21', '2018-11-11', '32', '5', '2017-12-21', '', '1', '', '', '', '', 0, '1000'),
	(00007, 'Fretada', 'PT-RAF', 'Neiva', 'Pa32a', '1979', 'Branca Com Faixas Azuis', 'R.a. Neiva Nunes - ME', 'R.a. Neiva Nunes - ME', '5', 0, 0, 0, 187500, '2018-10-05', '2019-08-10', '2018-08-01', '2019-08-19', '2019-08-19', '2019-08-19', '0', '9', '2017-12-30', '', '1', '', '', '', '', 0, '1000'),
	(00008, 'PrÃ³pria', 'PT-OUE', 'Cessna Aircraft', 'C172', '1979', 'Branco Com Faixas Vermelhas ', 'Elizangela Bandeira Lima Santos Monteiro', 'Elizangela Bandeira Lima Santos Monteiro', '3', 0, 0, 0, 0, '2019-05-09', '2019-05-09', '2019-03-21', '2023-03-27', '2023-03-27', '2023-03-10', '20', '1-3-12-5', '2018-02-12', '', '1', 'L', '1727', '172n', 'Vfr', 0, '3170'),
	(00009, 'Fretada', 'PT-ETW', 'Neiva', 'Emb-720c', '1978', 'Branca Com Faixas Azuis ', 'RTR ENGENHARIA & COMERCIO LTDA', 'RTR ENGENHARIA & COMERCIO LTDA', '5', 0, 0, 0, 200000, '2018-08-12', '2019-08-12', '2019-08-12', '2019-06-12', '0000-00-00', '0000-00-00', '60', '5', '2018-08-27', '', '1', '', '', '', '', 0, '1000'),
	(00010, 'Fretada', 'PT-DOT', 'Piper Aircraft', 'P28r', '1970', 'Branco Com Faixas Pretas ', 'Francilio Alberto Da Silva Lopes', 'Francilio Alberto Da Silva Lopes', '3', 0, 0, 0, 0, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '14', '2018-09-01', '', '1', 'L', '28R3', 'Pa-2', 'Vfr', 0, '2455'),
	(00012, 'Fretada', 'PT-RNN', 'Neiva ', 'EMB-721D (Sertanejo) ', '1982', 'Banco Com LiStras Pretas ', 'A. Vale Dames E Cia. LtdA', 'A. Vale Dames E Cia. LtdA', '5', 0, 0, 0, 0, '2022-12-21', '0000-00-00', '0000-00-00', '2022-11-09', '0000-00-00', '0000-00-00', '0', '5', '2018-11-17', '', '1', '', '', '', '', 0, '1000'),
	(00013, 'Fretada', 'PR-CDA', 'Piper Aircraft', 'Pa-28r-200', '1971', 'Branco Com Preto ', 'Leonardo Oliveira AbreU', 'Leonardo Oliveira Abreu ', '3', 0, 0, 0, 210000, '2019-04-02', '0000-00-00', '0000-00-00', '2019-02-21', '0000-00-00', '0000-00-00', '0', '15', '2018-11-20', '', '1', '', '', '', '', 0, '1000'),
	(00014, 'Fretada', 'PT-KMJ', 'CESSNA AIRCRAFT ', 'C182', '1974', 'Branca', 'ZOROASTRO SOARES ', 'ZOROASTRO SOARES ', '3', 0, 0, 0, 0, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '', '2019-05-07', '', '1', '5', '2552', '182p', 'Jljl', 0, ''),
	(00015, 'Fretada', 'PT-CTB', 'CESSNA AIRCRAFT ', 'C172 ', '1966', 'Branca', 'UNICARE EMERGENCY ASSIST.MED.HOSP.LT-ME ', 'UNICARE EMERGENCY ASSIST.MED.HOSP.LT-ME ', '3', 0, 0, 0, 0, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '24', '2019-05-13', '', '1', '0', '1725', '172G', '1', 0, '');
/*!40000 ALTER TABLE `aeronaves` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
