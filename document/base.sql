-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 06-Fev-2022 às 18:46
-- Versão do servidor: 5.6.41-84.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `padra741_vista`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `contrato`
--

CREATE TABLE `contrato` (
  `con_id` int(11) NOT NULL,
  `imo_id` int(11) NOT NULL,
  `lcd_id` int(11) NOT NULL,
  `loc_id` int(11) NOT NULL,
  `con_data_inicio` date DEFAULT NULL,
  `con_data_fim` date DEFAULT NULL,
  `con_taxa_adm` double(15,2) DEFAULT NULL,
  `con_aluguel` double(15,2) DEFAULT NULL,
  `con_condominio` double(15,2) DEFAULT NULL,
  `con_iptu` double(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `imovel`
--

CREATE TABLE `imovel` (
  `imo_id` int(11) NOT NULL,
  `lcd_id` int(11) NOT NULL,
  `imo_cod` int(11) DEFAULT NULL,
  `imo_cidade` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imo_bairro` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imo_endereco` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `locador`
--

CREATE TABLE `locador` (
  `lcd_id` int(11) NOT NULL,
  `lcd_nome` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `lcd_email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `lcd_telefone` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `lcd_dia_repasse` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `locador`
--

INSERT INTO `locador` (`lcd_id`, `lcd_nome`, `lcd_email`, `lcd_telefone`, `lcd_dia_repasse`) VALUES
(2, 'Joao marques', 'j.marques@email.com', '4899998888', 10),
(3, 'Thiago manoel', 't.manoel@email.com', '4877552233', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `locatario`
--

CREATE TABLE `locatario` (
  `loc_id` int(11) NOT NULL,
  `loc_nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `loc_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `loc_telefone` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `locatario`
--

INSERT INTO `locatario` (`loc_id`, `loc_nome`, `loc_email`, `loc_telefone`) VALUES
(16, 'Pedro da Silva', 'p.silva@email.com', '4899999999'),
(17, 'Roberto wiggers', 'r.wiggers@email.com', '4888997744');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensalidade`
--

CREATE TABLE `mensalidade` (
  `men_id` int(11) NOT NULL,
  `con_id` int(11) NOT NULL,
  `men_data` date DEFAULT NULL,
  `men_status` int(11) DEFAULT NULL,
  `men_valor` double(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `repasse`
--

CREATE TABLE `repasse` (
  `rep_id` int(11) NOT NULL,
  `men_id` int(11) NOT NULL,
  `rep_data` date DEFAULT NULL,
  `rep_status` int(11) DEFAULT NULL,
  `rep_valor` double(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `contrato`
--
ALTER TABLE `contrato`
  ADD PRIMARY KEY (`con_id`),
  ADD KEY `imo_id` (`imo_id`),
  ADD KEY `lcd_id` (`lcd_id`),
  ADD KEY `loc_id` (`loc_id`);

--
-- Índices para tabela `imovel`
--
ALTER TABLE `imovel`
  ADD PRIMARY KEY (`imo_id`),
  ADD KEY `lcd_id` (`lcd_id`);

--
-- Índices para tabela `locador`
--
ALTER TABLE `locador`
  ADD PRIMARY KEY (`lcd_id`);

--
-- Índices para tabela `locatario`
--
ALTER TABLE `locatario`
  ADD PRIMARY KEY (`loc_id`);

--
-- Índices para tabela `mensalidade`
--
ALTER TABLE `mensalidade`
  ADD PRIMARY KEY (`men_id`),
  ADD KEY `con_id` (`con_id`);

--
-- Índices para tabela `repasse`
--
ALTER TABLE `repasse`
  ADD PRIMARY KEY (`rep_id`),
  ADD KEY `men_id` (`men_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `contrato`
--
ALTER TABLE `contrato`
  MODIFY `con_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de tabela `imovel`
--
ALTER TABLE `imovel`
  MODIFY `imo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `locador`
--
ALTER TABLE `locador`
  MODIFY `lcd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `locatario`
--
ALTER TABLE `locatario`
  MODIFY `loc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `mensalidade`
--
ALTER TABLE `mensalidade`
  MODIFY `men_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=783954;

--
-- AUTO_INCREMENT de tabela `repasse`
--
ALTER TABLE `repasse`
  MODIFY `rep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `contrato`
--
ALTER TABLE `contrato`
  ADD CONSTRAINT `contrato_ibfk_1` FOREIGN KEY (`imo_id`) REFERENCES `imovel` (`imo_id`),
  ADD CONSTRAINT `contrato_ibfk_2` FOREIGN KEY (`lcd_id`) REFERENCES `locador` (`lcd_id`),
  ADD CONSTRAINT `contrato_ibfk_3` FOREIGN KEY (`loc_id`) REFERENCES `locatario` (`loc_id`);

--
-- Limitadores para a tabela `imovel`
--
ALTER TABLE `imovel`
  ADD CONSTRAINT `imovel_ibfk_1` FOREIGN KEY (`lcd_id`) REFERENCES `locador` (`lcd_id`);

--
-- Limitadores para a tabela `mensalidade`
--
ALTER TABLE `mensalidade`
  ADD CONSTRAINT `mensalidade_ibfk_1` FOREIGN KEY (`con_id`) REFERENCES `contrato` (`con_id`);

--
-- Limitadores para a tabela `repasse`
--
ALTER TABLE `repasse`
  ADD CONSTRAINT `repasse_ibfk_1` FOREIGN KEY (`men_id`) REFERENCES `mensalidade` (`men_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
