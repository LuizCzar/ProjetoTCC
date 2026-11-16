-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 06/03/2026 às 20:28
-- Versão do servidor: 9.1.0
-- Versão do PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projetotcc`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `curso`
--

DROP TABLE IF EXISTS `curso`;
CREATE TABLE IF NOT EXISTS `curso` (
  `id_curso` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id_curso`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `curso`
--

INSERT INTO `curso` (`id_curso`, `nome`) VALUES
(1, 'Tec. em Informática'),
(2, 'Tec. em Mineração '),
(3, 'Tec. em Meio-Ambiente'),
(4, 'Lic. em Computação');

-- --------------------------------------------------------

--
-- Estrutura para tabela `habilidade`
--

DROP TABLE IF EXISTS `habilidade`;
CREATE TABLE IF NOT EXISTS `habilidade` (
  `id_habilidade` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id_habilidade`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `habilidade`
--

INSERT INTO `habilidade` (`id_habilidade`, `nome`) VALUES
(1, 'Painel de Controle'),
(2, 'Java'),
(3, 'PHP'),
(4, 'HTML'),
(5, 'CSS'),
(6, 'JavaScript'),
(7, 'TypeScript'),
(8, 'Python'),
(9, 'C'),
(10, 'C++'),
(11, 'C#'),
(12, 'MySQL'),
(13, 'PostgreSQL'),
(14, 'MongoDB'),
(15, 'Node.js'),
(16, 'React'),
(17, 'Angular'),
(18, 'Vue.js'),
(19, 'Bootstrap'),
(20, 'Git'),
(21, 'GitHub'),
(22, 'Docker'),
(23, 'Linux'),
(24, 'API REST'),
(25, 'Laravel'),
(26, 'Spring Boot');

-- --------------------------------------------------------

--
-- Estrutura para tabela `projeto`
--

DROP TABLE IF EXISTS `projeto`;
CREATE TABLE IF NOT EXISTS `projeto` (
  `id_projeto` int NOT NULL AUTO_INCREMENT,
  `id_habil` int NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `descricao` varchar(250) NOT NULL,
  `link` varchar(150) DEFAULT NULL,
  `id_time` int NOT NULL,
  PRIMARY KEY (`id_projeto`),
  KEY `fk_habil` (`id_habil`),
  KEY `fk_idtime` (`id_time`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `projeto`
--

INSERT INTO `projeto` (`id_projeto`, `id_habil`, `nome`, `descricao`, `link`, `id_time`) VALUES
(1, 1, 'Painel de controle', 'Um exemplo de painel de controle', NULL, 1),
(2, 1, 'LinkIFBA', 'Site com foco em facilitar a procura de pessoas com base em suas habilidades', NULL, 2),
(3, 1, 'TCC', 'Projeto de finalização de curso', 'https://www.google.com/webhp?hl=pt-BR&sa=X&ved=0ahUKEwjMqP2D8MqSAxXDH7kGHb7nKzYQPAgJ&zx=1770587401462&no_sw_cr=1', 3),
(5, 22, 'Spotify', 'Projeto para facilitar a disponibilidade de musicas e podcast', 'https://open.spotify.com/intl-pt', 1),
(6, 18, 'G1', 'Um site noticiario ', 'https://g1.globo.com', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `time`
--

DROP TABLE IF EXISTS `time`;
CREATE TABLE IF NOT EXISTS `time` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `time`
--

INSERT INTO `time` (`id`, `nome`) VALUES
(1, 'Grupo 1'),
(2, 'Grupo 2'),
(3, 'Grupo 3');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `apelido` varchar(50) DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'uploads/perfis/padrao.png',
  `curso` int NOT NULL,
  `turma` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `turno` enum('matutino','vespertino','noturno') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `github` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gmail` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `fk_id_curso` (`curso`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `email`, `senha`, `nome`, `bio`, `apelido`, `foto`, `curso`, `turma`, `turno`, `facebook`, `whatsapp`, `instagram`, `github`, `gmail`) VALUES
(1, 'apollo@email.com', '123456', 'Apollo Silva', 'Eu sou apollo o deus do sol', 'apollo', 'uploads/perfis/perfil_699b8ae36425c.jpg', 1, '1911', 'noturno', '', '99 999999999', 'apollo321', 'Apollo123', 'apolloPJT@email.com'),
(2, 'ana@email.com', '123456', 'Ana Souza', NULL, 'ana', 'uploads/perfis/perfil_697a67ea5e179.png', 2, '1814', 'matutino', '', '0', '', '', ''),
(3, 'bruno@email.com', '123456', 'Bruno Lima', 'meu nome é bruno ', 'bruno', 'uploads/perfis/perfil_697be26a3f4de.jpg', 3, '1911', 'vespertino', '', '0', '', '', ''),
(4, 'carla@email.com', '123456', 'Carla Mendes', NULL, 'carla', 'uploads/perfis/perfil_697a7273dae8e.png', 2, '1814', 'noturno', '', '0', '', '', ''),
(5, 'diego@email.com', '123456', 'João Vitor', 'dasdsdaw', 'Vitor', 'uploads/perfis/padrao.png', 1, '3512', 'vespertino', '', '0', '', '', ''),
(6, 'elaine@email.com', '123456', 'Elaine Rocha', NULL, 'elaine', 'uploads/perfis/perfil_697be67f005bb.jpg', 3, '2012', 'vespertino', '', '0', '', '', ''),
(7, 'felipe@email.com', '123456', 'Pedro Gosalves', '', 'Pedrinho', 'uploads/perfis/perfil_697a779439946.jpeg', 1, '1534', 'vespertino', '', '0', '', '', ''),
(8, 'gabriel@email.com', '123456', 'Gabriel Nunes', NULL, 'gabriel', 'uploads/perfis/perfil_697a6c7f6e4b9.jfif', 4, '1814', 'matutino', '', '0', '', '', ''),
(10, 'mariovieira@gmail.com', '123456', 'Mario Vieira', NULL, NULL, 'uploads/perfis/padrao.png', 2, '1234', 'vespertino', '', '0', '', '', ''),
(11, 'josedasilva@gmail.com', '123456', 'jose da silva', NULL, NULL, 'uploads/perfis/padrao.png', 3, '5643', 'noturno', '', '0', '', '', ''),
(13, 'ronaldooliveira@gmail.com', '123456', 'Ronaldo Lima', 'Profissional de Informática apaixonado por tecnologia e inovação.\r\nExperiência em suporte técnico, desenvolvimento e soluções digitais.\r\nSempre em busca de aprendizado e novos desafios.\r\n', 'Ronaldinho', 'uploads/perfis/perfil_69a8b22f6200f.png', 1, '1354', 'noturno', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usutime`
--

DROP TABLE IF EXISTS `usutime`;
CREATE TABLE IF NOT EXISTS `usutime` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `id_time` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario` (`id_usuario`),
  KEY `fk_time` (`id_time`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `usutime`
--

INSERT INTO `usutime` (`id`, `id_usuario`, `id_time`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 2),
(6, 6, 2),
(7, 7, 2),
(8, 8, 2),
(9, 9, 3),
(10, 10, 3),
(11, 11, 3),
(12, 12, 3),
(13, 1, 2),
(14, 1, 3),
(15, 2, 2),
(17, 1, 5);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
