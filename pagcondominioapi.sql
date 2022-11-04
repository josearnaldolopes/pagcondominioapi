-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 03/11/2022 às 21:57
-- Versão do servidor: 8.0.31-0ubuntu0.20.04.1
-- Versão do PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pagcondominioapi`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `boleto`
--

CREATE TABLE `boleto` (
  `id` int NOT NULL,
  `nome` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `site` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `telefone` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cartao`
--

CREATE TABLE `cartao` (
  `id` int NOT NULL,
  `token` varchar(255) NOT NULL,
  `idcondomino` int DEFAULT NULL,
  `documento` varchar(255) NOT NULL,
  `nome` varchar(155) NOT NULL,
  `numero` varchar(255) DEFAULT NULL,
  `digitos` varchar(4) NOT NULL,
  `bandeira` varchar(50) NOT NULL,
  `validade` varchar(10) NOT NULL,
  `cvv` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `condominio`
--

CREATE TABLE `condominio` (
  `id` int NOT NULL,
  `cep` varchar(9) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `logradouro` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `numero` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `bairro` varchar(80) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `cidade` varchar(80) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `estado` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `condominio` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `documento` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `sindico` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `telefone` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `administradora` varchar(255) DEFAULT NULL,
  `administradoraAPI` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `banco` varchar(20) DEFAULT NULL,
  `agencia` varchar(10) DEFAULT NULL,
  `conta` varchar(15) DEFAULT NULL,
  `valor` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `apiPagamento` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `adiantamento` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `porcentagem` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `taxa` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `liberacao` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `chave` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `origem` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `exibicao` varchar(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `condomino`
--

CREATE TABLE `condomino` (
  `id` int NOT NULL,
  `idresposta` int DEFAULT NULL,
  `idcard` int DEFAULT NULL,
  `condominio` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `idcondominio` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `bloco` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `apartamento` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `complemento` varchar(150) NOT NULL,
  `senha` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `nome` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `documento` varchar(150) NOT NULL,
  `rg` varchar(70) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `cpf` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `telefone` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `telefoneSec` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `nomecard` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `numerocard` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `datacard` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `cvv` int DEFAULT NULL,
  `nomecard2` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `numerocard2` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `datacard2` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `cvv2` int DEFAULT NULL,
  `administradora` int DEFAULT NULL,
  `administradoranome` varchar(70) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `statusDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `recorrencia` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `boleto`
--
ALTER TABLE `boleto`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `cartao`
--
ALTER TABLE `cartao`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `condominio`
--
ALTER TABLE `condominio`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `condomino`
--
ALTER TABLE `condomino`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `boleto`
--
ALTER TABLE `boleto`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cartao`
--
ALTER TABLE `cartao`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `condominio`
--
ALTER TABLE `condominio`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `condomino`
--
ALTER TABLE `condomino`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
