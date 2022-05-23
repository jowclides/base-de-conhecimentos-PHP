-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03/04/2020 às 15:44
-- Versão do servidor: 10.4.11-MariaDB
-- Versão do PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `phpmaker_contatos`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cargos`
--

CREATE TABLE `cargos` (
  `id` int(11) NOT NULL,
  `nome_cargo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `cargos`
--

INSERT INTO `cargos` (`id`, `nome_cargo`) VALUES
(1, 'TSBR-OPM'),
(2, 'TSBR-DBA'),
(3, 'TSBR-WINDOWS_ANALYST'),
(4, 'TSBR-NETWORK_ANALYST'),
(5, 'TSBR-FIREWALL_ANALYST'),
(6, 'TSBR-STORAGE_ANALYST'),
(7, 'TSBR-BACKUP_ANALYST');

-- --------------------------------------------------------

--
-- Estrutura para tabela `contatos`
--

CREATE TABLE `contatos` (
  `id` int(11) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `nome_completo` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `celular` varchar(50) DEFAULT NULL,
  `empresa` int(11) DEFAULT NULL,
  `cargo` int(11) DEFAULT NULL,
  `responsabilidades` varchar(255) DEFAULT NULL,
  `obs` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `contatos`
--

INSERT INTO `contatos` (`id`, `avatar`, `nome_completo`, `email`, `telefone`, `celular`, `empresa`, `cargo`, `responsabilidades`, `obs`) VALUES
(1, 'unnamed.png', 'Emerson Pereira da Silva', 'emerson.silva@t-systems.com.br', '11 3293-6941', '11 94112-8482', 1, 1, 'OPM,', 'Nenhuma');

-- --------------------------------------------------------

--
-- Estrutura para tabela `empresas`
--

CREATE TABLE `empresas` (
  `id` int(11) NOT NULL,
  `nome_empreasa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `empresas`
--

INSERT INTO `empresas` (`id`, `nome_empreasa`) VALUES
(1, 'T-SYSTEMS'),
(2, 'INTERFILE'),
(3, 'ATENTO');

-- --------------------------------------------------------

--
-- Estrutura para tabela `userlevelpermissions`
--

CREATE TABLE `userlevelpermissions` (
  `userlevelid` int(11) NOT NULL,
  `tablename` varchar(191) NOT NULL,
  `permission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `userlevelpermissions`
--

INSERT INTO `userlevelpermissions` (`userlevelid`, `tablename`, `permission`) VALUES
(-2, '{1079899E-BF32-4AEF-ABD0-B5D298775F5F}cargos', 0),
(-2, '{1079899E-BF32-4AEF-ABD0-B5D298775F5F}contatos', 0),
(-2, '{1079899E-BF32-4AEF-ABD0-B5D298775F5F}empresas', 0),
(-2, '{1079899E-BF32-4AEF-ABD0-B5D298775F5F}grupos', 0),
(-2, '{1079899E-BF32-4AEF-ABD0-B5D298775F5F}usuarios', 0),
(0, '{1079899E-BF32-4AEF-ABD0-B5D298775F5F}cargos', 0),
(0, '{1079899E-BF32-4AEF-ABD0-B5D298775F5F}contatos', 0),
(0, '{1079899E-BF32-4AEF-ABD0-B5D298775F5F}empresas', 0),
(0, '{1079899E-BF32-4AEF-ABD0-B5D298775F5F}grupos', 0),
(0, '{1079899E-BF32-4AEF-ABD0-B5D298775F5F}usuarios', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `userlevels`
--

CREATE TABLE `userlevels` (
  `userlevelid` int(11) NOT NULL,
  `userlevelname` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `userlevels`
--

INSERT INTO `userlevels` (`userlevelid`, `userlevelname`) VALUES
(-2, 'Anonymous'),
(-1, 'Administrator'),
(0, 'Default');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `perfil` int(11) DEFAULT NULL,
  `ativado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `senha`, `email`, `perfil`, `ativado`) VALUES
(1, 'emerson', 'sucesso1', 'emerson.silva@t-systems.com.br', -1, 1);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `contatos`
--
ALTER TABLE `contatos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `userlevelpermissions`
--
ALTER TABLE `userlevelpermissions`
  ADD PRIMARY KEY (`userlevelid`,`tablename`);

--
-- Índices de tabela `userlevels`
--
ALTER TABLE `userlevels`
  ADD PRIMARY KEY (`userlevelid`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `contatos`
--
ALTER TABLE `contatos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
