-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 12-Mar-2019 às 01:48
-- Versão do servidor: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdnp`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `anulacao`
--


CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Admin', '1', 1551991719);

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text,
  `rule_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('Admin', 1, 'Administrador', NULL, NULL, NULL, NULL),
('menu/create', 2, 'Criar Menu', NULL, NULL, NULL, NULL),
('menu/delete', 2, 'Eliminar Menu', NULL, NULL, NULL, NULL),
('menu/index', 2, 'Lista de Menu', NULL, NULL, NULL, NULL),
('menu/update', 2, 'Atualizar Menu', NULL, NULL, NULL, NULL),
('menu/view', 2, 'Visualizar Menu', NULL, NULL, NULL, NULL),
('permission/create', 2, 'Gestão de Permissão', NULL, NULL, NULL, NULL),
('permission/delete', 2, 'Eliminar Permissão', NULL, NULL, NULL, NULL),
('permission/index', 2, 'Lista de Permissão', NULL, NULL, NULL, NULL),
('permission/update', 2, 'Atualizar Permissão', NULL, NULL, NULL, NULL),
('permission/view', 2, 'Visualizar Permissão', NULL, NULL, NULL, NULL),
('profile/create', 2, 'Criar Perfil', NULL, NULL, NULL, NULL),
('profile/delete', 2, 'Eliminar Perfil', NULL, NULL, NULL, NULL),
('profile/index', 2, 'Lista de Perfil', NULL, NULL, NULL, NULL),
('profile/update', 2, 'Atualizar Perfil', NULL, NULL, NULL, NULL),
('profile/view', 2, 'Visualizar Perfil', NULL, NULL, NULL, NULL),
('user/create', 2, 'Criar User', NULL, NULL, NULL, NULL),
('user/delete', 2, 'Eliminar Utilizador', NULL, NULL, NULL, NULL),
('user/index', 2, 'Lista de User', NULL, NULL, NULL, NULL),
('user/update', 2, 'Atualizar User', NULL, NULL, NULL, NULL),
('user/view', 2, 'Visualizar User', NULL, NULL, NULL, NULL),
('utente/create', 2, 'Criar Utente', NULL, NULL, NULL, NULL),
('utente/index', 2, 'Lista de Utente', NULL, NULL, NULL, NULL),
('utente/pesquisa-utente', 2, 'Pesquisa Utente', NULL, NULL, NULL, NULL),
('utente/prescricao-medica', 2, 'Prescricao Medica', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) CHARACTER SET utf8 NOT NULL,
  `child` varchar(64) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Extraindo dados da tabela `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('Admin', 'menu/create'),
('Admin', 'menu/delete'),
('Admin', 'menu/index'),
('Admin', 'menu/update'),
('Admin', 'menu/view'),
('Admin', 'permission/create'),
('Admin', 'permission/delete'),
('Admin', 'permission/index'),
('Admin', 'permission/update'),
('Admin', 'permission/view'),
('Admin', 'profile/create'),
('Admin', 'profile/delete'),
('Admin', 'profile/index'),
('Admin', 'profile/update'),
('Admin', 'profile/view'),
('Admin', 'user/create'),
('Admin', 'user/delete'),
('Admin', 'user/index'),
('Admin', 'user/update'),
('Admin', 'user/view'),
('Admin', 'utente/create'),
('Admin', 'utente/index'),
('Admin', 'utente/pesquisa-utente'),
('Admin', 'utente/prescricao-medica');

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------


CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_general_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_general_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_general_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_general_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'aVeQxCxiyI9lCTbg_J9i13LV1tGc6X8R', '$2y$13$5qgMnZRqOXR5klpeX0zh2OJJ6/tnzmgQswPmFjp9g/bPpEABK/Cza', NULL, 'admin@gmail.com', 10, 1551142509, 1551142509);

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `menu` (`id`, `name`, `parent`, `route`, `order`, `data`) VALUES
(1, 'Gestão de Acesso', NULL, NULL, NULL, NULL),
(2, 'Gestão de Perfil', 1, 'profile/index', 1, NULL),
(3, 'Gestão de Menu', 1, 'menu/index', NULL, NULL),
(4, 'Gestão de Permissão', 1, 'permission/index', NULL, NULL),
(5, 'Gestão de Utilizadores', 1, 'user/index', NULL, NULL);


CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent` (`parent`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);
  
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`);

--
-- Limitadores para a tabela `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limitadores para a tabela `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`),
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`);

--
-- Limitadores para a tabela `menu`
--

ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
