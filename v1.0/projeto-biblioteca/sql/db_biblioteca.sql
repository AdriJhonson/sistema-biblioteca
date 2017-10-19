-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2017 at 12:46 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_biblioteca`
--
CREATE DATABASE IF NOT EXISTS `bd_biblioteca` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bd_biblioteca`;

-- --------------------------------------------------------

--
-- Table structure for table `tb_alunos`
--

CREATE TABLE `tb_alunos` (
  `id_aluno` int(11) NOT NULL,
  `nome_aluno` varchar(100) NOT NULL,
  `email_aluno` varchar(100) DEFAULT NULL,
  `login_aluno` varchar(100) NOT NULL,
  `senha_aluno` varchar(100) NOT NULL,
  `livro_alugado` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_alunos`
--

INSERT INTO `tb_alunos` (`id_aluno`, `nome_aluno`, `email_aluno`, `login_aluno`, `senha_aluno`, `livro_alugado`) VALUES
(1, 'Adri Silva', 'adri@email.com', 'adrisilva', '123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_autores`
--

CREATE TABLE `tb_autores` (
  `id_autor` int(11) NOT NULL,
  `nome_autor` varchar(100) NOT NULL,
  `id_livro_escrito` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_autores`
--

INSERT INTO `tb_autores` (`id_autor`, `nome_autor`, `id_livro_escrito`) VALUES
(1, 'Paul Deitel', 1),
(2, 'Harvey Deitel', 1),
(3, 'Octavio Ianni', 2),
(4, 'Wanda Maleronka', 3),
(5, 'Beatriz Salomão', 4),
(6, 'Jéssica Santos', 4),
(7, 'Katia Machado', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tb_livros`
--

CREATE TABLE `tb_livros` (
  `id_livro` int(11) NOT NULL,
  `titulo_livro` varchar(150) NOT NULL,
  `qtd_estoque_livro` int(11) NOT NULL,
  `editora` varchar(100) DEFAULT NULL,
  `categoria` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_livros`
--

INSERT INTO `tb_livros` (`id_livro`, `titulo_livro`, `qtd_estoque_livro`, `editora`, `categoria`) VALUES
(1, 'Java - Como Programar ', 20, 'Pearson', 'tec_informatica'),
(2, 'Estado e planejamento econômico no Brasil', 5, 'Civilização brasileira', 'tec_financas'),
(3, 'Fazer Roupa Virou Moda', 10, 'Senac', 'tec_moda'),
(4, 'Vigilância em saúde', 15, 'RET-SUS', 'tec_enfermagem'),
(5, 'livro1', 10, 'editora', 'tec_informatica');

-- --------------------------------------------------------

--
-- Table structure for table `tb_livros_alugados`
--

CREATE TABLE `tb_livros_alugados` (
  `id_aluno` int(11) NOT NULL,
  `id_livro` int(11) NOT NULL,
  `data_alugado` date NOT NULL,
  `data_entrega` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_livros_reservados`
--

CREATE TABLE `tb_livros_reservados` (
  `fk_aluno` int(11) NOT NULL,
  `fk_livro` int(11) NOT NULL,
  `dt_reserva` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_alunos`
--
ALTER TABLE `tb_alunos`
  ADD PRIMARY KEY (`id_aluno`);

--
-- Indexes for table `tb_autores`
--
ALTER TABLE `tb_autores`
  ADD PRIMARY KEY (`id_autor`),
  ADD KEY `id_livro_escrito_idx` (`id_livro_escrito`);

--
-- Indexes for table `tb_livros`
--
ALTER TABLE `tb_livros`
  ADD PRIMARY KEY (`id_livro`);

--
-- Indexes for table `tb_livros_alugados`
--
ALTER TABLE `tb_livros_alugados`
  ADD KEY `id_aluno_idx` (`id_aluno`),
  ADD KEY `id_livro_idx` (`id_livro`);

--
-- Indexes for table `tb_livros_reservados`
--
ALTER TABLE `tb_livros_reservados`
  ADD KEY `fk_aluno_idx` (`fk_aluno`),
  ADD KEY `fk_livro_idx` (`fk_livro`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_alunos`
--
ALTER TABLE `tb_alunos`
  MODIFY `id_aluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_autores`
--
ALTER TABLE `tb_autores`
  MODIFY `id_autor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tb_livros`
--
ALTER TABLE `tb_livros`
  MODIFY `id_livro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_autores`
--
ALTER TABLE `tb_autores`
  ADD CONSTRAINT `id_livro_escrito` FOREIGN KEY (`id_livro_escrito`) REFERENCES `tb_livros` (`id_livro`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_livros_alugados`
--
ALTER TABLE `tb_livros_alugados`
  ADD CONSTRAINT `id_aluno` FOREIGN KEY (`id_aluno`) REFERENCES `tb_alunos` (`id_aluno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_livro` FOREIGN KEY (`id_livro`) REFERENCES `tb_livros` (`id_livro`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_livros_reservados`
--
ALTER TABLE `tb_livros_reservados`
  ADD CONSTRAINT `fk_aluno` FOREIGN KEY (`fk_aluno`) REFERENCES `tb_alunos` (`id_aluno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_livro` FOREIGN KEY (`fk_livro`) REFERENCES `tb_livros` (`id_livro`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
