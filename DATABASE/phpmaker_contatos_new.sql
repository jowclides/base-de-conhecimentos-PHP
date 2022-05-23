-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23-Maio-2022 às 16:53
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `phpmaker_contatos_new`
--

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `all_contacts_new`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `all_contacts_new` (
`id` int(11)
,`avatar` varchar(255)
,`nome_completo` varchar(255)
,`email` varchar(255)
,`telefone` varchar(255)
,`celular` varchar(255)
,`empresa` int(11)
,`cargo` int(11)
,`responsabilidades` varchar(255)
,`obs` varchar(255)
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargos`
--

CREATE TABLE `cargos` (
  `id` int(11) NOT NULL,
  `nome_cargo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `contatos`
--

CREATE TABLE `contatos` (
  `id` int(11) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `nome_completo` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `celular` varchar(255) DEFAULT NULL,
  `empresa` int(11) DEFAULT NULL,
  `cargo` int(11) DEFAULT NULL,
  `responsabilidades` varchar(255) DEFAULT NULL,
  `obs` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresas`
--

CREATE TABLE `empresas` (
  `id` int(11) NOT NULL,
  `nome_empreasa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `know_base`
--

CREATE TABLE `know_base` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `procedimento` longtext DEFAULT NULL,
  `categoria` int(11) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `know_base_categorias`
--

CREATE TABLE `know_base_categorias` (
  `id` int(11) NOT NULL,
  `nome_categoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tarefas`
--

CREATE TABLE `tarefas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `criticidade_id` int(11) NOT NULL,
  `owner` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `memo` longtext DEFAULT NULL,
  `prazo_entrega` date DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tarefas_criticidade`
--

CREATE TABLE `tarefas_criticidade` (
  `id` int(11) NOT NULL,
  `criticidade` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tarefas_status`
--

CREATE TABLE `tarefas_status` (
  `id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `userlevelpermissions`
--

CREATE TABLE `userlevelpermissions` (
  `userlevelid` int(11) NOT NULL,
  `tablename` varchar(191) NOT NULL,
  `permission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `userlevels`
--

CREATE TABLE `userlevels` (
  `userlevelid` int(11) NOT NULL,
  `userlevelname` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `userlevel` int(11) DEFAULT NULL,
  `ativado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `view1`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `view1` (
`id` int(11)
,`avatar` varchar(255)
,`nome_completo` varchar(255)
,`email` varchar(255)
,`telefone` varchar(255)
,`celular` varchar(255)
,`nome_empreasa` varchar(255)
,`responsabilidades` varchar(255)
,`obs` varchar(255)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `view2`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `view2` (
`id` int(11)
,`avatar` varchar(255)
,`nome_completo` varchar(255)
,`email` varchar(255)
,`telefone` varchar(255)
,`celular` varchar(255)
,`nome_empreasa` varchar(255)
,`nome_cargo` varchar(255)
,`responsabilidades` varchar(255)
,`obs` varchar(255)
);

-- --------------------------------------------------------

--
-- Estrutura para vista `all_contacts_new`
--
DROP TABLE IF EXISTS `all_contacts_new`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `all_contacts_new`  AS SELECT `contatos`.`id` AS `id`, `contatos`.`avatar` AS `avatar`, `contatos`.`nome_completo` AS `nome_completo`, `contatos`.`email` AS `email`, `contatos`.`telefone` AS `telefone`, `contatos`.`celular` AS `celular`, `contatos`.`empresa` AS `empresa`, `contatos`.`cargo` AS `cargo`, `contatos`.`responsabilidades` AS `responsabilidades`, `contatos`.`obs` AS `obs` FROM `contatos` ;

-- --------------------------------------------------------

--
-- Estrutura para vista `view1`
--
DROP TABLE IF EXISTS `view1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view1`  AS SELECT `contatos`.`id` AS `id`, `contatos`.`avatar` AS `avatar`, `contatos`.`nome_completo` AS `nome_completo`, `contatos`.`email` AS `email`, `contatos`.`telefone` AS `telefone`, `contatos`.`celular` AS `celular`, `empresas`.`nome_empreasa` AS `nome_empreasa`, `contatos`.`responsabilidades` AS `responsabilidades`, `contatos`.`obs` AS `obs` FROM ((`contatos` join `empresas` on(`contatos`.`empresa` = `empresas`.`id`)) join `cargos` on(`contatos`.`cargo` = `cargos`.`id`)) ;

-- --------------------------------------------------------

--
-- Estrutura para vista `view2`
--
DROP TABLE IF EXISTS `view2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view2`  AS SELECT `contatos`.`id` AS `id`, `contatos`.`avatar` AS `avatar`, `contatos`.`nome_completo` AS `nome_completo`, `contatos`.`email` AS `email`, `contatos`.`telefone` AS `telefone`, `contatos`.`celular` AS `celular`, `empresas`.`nome_empreasa` AS `nome_empreasa`, `cargos`.`nome_cargo` AS `nome_cargo`, `contatos`.`responsabilidades` AS `responsabilidades`, `contatos`.`obs` AS `obs` FROM ((`contatos` join `empresas` on(`contatos`.`empresa` = `empresas`.`id`)) join `cargos` on(`contatos`.`cargo` = `cargos`.`id`)) ;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `contatos`
--
ALTER TABLE `contatos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `know_base`
--
ALTER TABLE `know_base`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `know_base_categorias`
--
ALTER TABLE `know_base_categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tarefas`
--
ALTER TABLE `tarefas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tarefas_criticidade`
--
ALTER TABLE `tarefas_criticidade`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tarefas_status`
--
ALTER TABLE `tarefas_status`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `userlevelpermissions`
--
ALTER TABLE `userlevelpermissions`
  ADD PRIMARY KEY (`userlevelid`,`tablename`);

--
-- Índices para tabela `userlevels`
--
ALTER TABLE `userlevels`
  ADD PRIMARY KEY (`userlevelid`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `contatos`
--
ALTER TABLE `contatos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `know_base`
--
ALTER TABLE `know_base`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `know_base_categorias`
--
ALTER TABLE `know_base_categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tarefas`
--
ALTER TABLE `tarefas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tarefas_criticidade`
--
ALTER TABLE `tarefas_criticidade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tarefas_status`
--
ALTER TABLE `tarefas_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
