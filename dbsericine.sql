-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 14, 2024 at 01:28 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbsericine`
--

-- --------------------------------------------------------

--
-- Table structure for table `actors`
--

CREATE TABLE `actors` (
  `id` int(11) NOT NULL,
  `idperson` int(11) DEFAULT NULL,
  `code` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `status` enum('Activa','Inactiva') COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `actors`
--

INSERT INTO `actors` (`id`, `idperson`, `code`, `status`) VALUES
(1, 1, 'AC-001', 'Activa'),
(2, 2, 'AC002', 'Activa');

-- --------------------------------------------------------

--
-- Table structure for table `actor_film_detail`
--

CREATE TABLE `actor_film_detail` (
  `id` int(11) NOT NULL,
  `idactor` int(11) NOT NULL,
  `idfilm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `actor_film_detail`
--

INSERT INTO `actor_film_detail` (`id`, `idactor`, `idfilm`) VALUES
(34, 2, 11),
(37, 2, 1),
(38, 2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `actor_serie_detail`
--

CREATE TABLE `actor_serie_detail` (
  `id` int(11) NOT NULL,
  `idactor` int(11) NOT NULL,
  `idserie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `actor_serie_detail`
--

INSERT INTO `actor_serie_detail` (`id`, `idactor`, `idserie`) VALUES
(1, 1, 2),
(5, 2, 1),
(6, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `id` int(11) NOT NULL,
  `number` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `id_season` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `directors`
--

CREATE TABLE `directors` (
  `id` int(11) NOT NULL,
  `idperson` int(11) DEFAULT NULL,
  `code` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `status` enum('Activa','Inactiva') COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `directors`
--

INSERT INTO `directors` (`id`, `idperson`, `code`, `status`) VALUES
(1, 2, 'Dir-001', 'Activa'),
(2, 1, 'Dir-002', 'Activa'),
(3, 3, 'Dir-003', 'Activa');

-- --------------------------------------------------------

--
-- Table structure for table `films`
--

CREATE TABLE `films` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `idplatform` int(11) DEFAULT NULL,
  `iddirector` int(11) DEFAULT NULL,
  `premiereyear` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `films`
--

INSERT INTO `films` (`id`, `title`, `idplatform`, `iddirector`, `premiereyear`) VALUES
(1, 'Titanic', 5, 1, 2010),
(9, 'Hombre de la Mascara d Hierro', 4, 1, 2000),
(10, 'Iron Man 1', 6, 1, 2015),
(11, 'Capitan America', 10, 3, 2223),
(12, 'Rapidos y Furiosos x', 5, 1, 2023),
(13, 'Prueba 1', 7, 1, 2023),
(17, 'qqqqq', 11, 1, 1526),
(18, 'Prueba de id', 4, 1, 8020),
(19, 'Prueba 2 de Id', 4, 1, 8978),
(20, 'Prueba 3 del id', 7, 1, 2023),
(21, 'Prueba 4', 6, 1, 2025),
(22, 'Prueba 5', 10, 1, 2525),
(23, 'Prueba 6 de id', 17, 1, 4525),
(24, 'Prueba 7', 20, 2, 2556),
(25, 'Prueba 251', 20, 2, 2556),
(26, 'Prueba definitiva id1', 18, 1, 2023),
(27, 'Borrar 49', 16, 1, 2024);

-- --------------------------------------------------------

--
-- Table structure for table `languageaudio_film_detail`
--

CREATE TABLE `languageaudio_film_detail` (
  `id` int(11) NOT NULL,
  `idfilm` int(11) NOT NULL,
  `idlanguage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `languageaudio_film_detail`
--

INSERT INTO `languageaudio_film_detail` (`id`, `idfilm`, `idlanguage`) VALUES
(19, 12, 1),
(20, 12, 2),
(113, 13, 1),
(114, 13, 2),
(127, 25, 1),
(128, 25, 5),
(131, 26, 3),
(132, 26, 5),
(141, 9, 2),
(157, 27, 1),
(158, 27, 2),
(175, 11, 2),
(178, 1, 3),
(181, 10, 1),
(182, 10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `languageaudio_serie_detail`
--

CREATE TABLE `languageaudio_serie_detail` (
  `id` int(11) NOT NULL,
  `idserie` int(11) NOT NULL,
  `idlanguage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `languageaudio_serie_detail`
--

INSERT INTO `languageaudio_serie_detail` (`id`, `idserie`, `idlanguage`) VALUES
(9, 2, 1),
(10, 2, 2),
(15, 1, 3),
(16, 1, 5),
(17, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `languagecaption_film_detail`
--

CREATE TABLE `languagecaption_film_detail` (
  `id` int(11) NOT NULL,
  `idfilm` int(11) NOT NULL,
  `idlanguage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `languagecaption_film_detail`
--

INSERT INTO `languagecaption_film_detail` (`id`, `idfilm`, `idlanguage`) VALUES
(13, 13, 3),
(14, 13, 5),
(27, 25, 2),
(28, 25, 3),
(43, 26, 1),
(44, 26, 2),
(56, 9, 1),
(57, 9, 2),
(59, 27, 1),
(68, 11, 5),
(71, 1, 5),
(74, 10, 2),
(75, 10, 5);

-- --------------------------------------------------------

--
-- Table structure for table `languagecaption_serie_detail`
--

CREATE TABLE `languagecaption_serie_detail` (
  `id` int(11) NOT NULL,
  `idserie` int(11) NOT NULL,
  `idlanguage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `languagecaption_serie_detail`
--

INSERT INTO `languagecaption_serie_detail` (`id`, `idserie`, `idlanguage`) VALUES
(9, 2, 3),
(10, 2, 5),
(15, 1, 2),
(16, 1, 3),
(17, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `isocode` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `isocode`) VALUES
(1, 'afar', 'aa'),
(2, 'abjasiano', 'ab'),
(3, 'español', 'es'),
(5, 'ingles', 'in');

-- --------------------------------------------------------

--
-- Table structure for table `nationalities`
--

CREATE TABLE `nationalities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `nationalities`
--

INSERT INTO `nationalities` (`id`, `name`) VALUES
(1, 'Ecuatoriano'),
(2, 'Colombiano'),
(3, 'Argentino');

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE `persons` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `code` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `datebirth` date DEFAULT NULL,
  `idnationality` int(11) DEFAULT NULL,
  `status` enum('Activa','Inactiva') COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `persons`
--

INSERT INTO `persons` (`id`, `name`, `lastname`, `code`, `datebirth`, `idnationality`, `status`) VALUES
(1, 'Darwin', 'Lara', '1802816809', '1975-12-08', 1, 'Activa'),
(2, 'Enrique', 'Robayo', '1803346152', '2023-01-12', 2, 'Activa'),
(3, 'Mercy', 'Parra', '180334615-2', '1975-01-11', 3, 'Activa'),
(4, 'Borrar', 'Borrar', '1802566', '1969-12-31', 3, 'Activa');

-- --------------------------------------------------------

--
-- Table structure for table `platforms`
--

CREATE TABLE `platforms` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `status` enum('Activa','Inactiva') COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `platforms`
--

INSERT INTO `platforms` (`id`, `name`, `status`) VALUES
(4, 'HBOsed', 'Inactiva'),
(5, 'HBO', 'Inactiva'),
(6, 'Borrar', 'Inactiva'),
(7, 'Borrar4', 'Inactiva'),
(8, 'borrar1', 'Inactiva'),
(9, 'borrar1', 'Inactiva'),
(10, 'Amazon', 'Activa'),
(11, 'Prueba 100', 'Inactiva'),
(12, 'Asociacn', 'Inactiva'),
(13, 'Plataforma', 'Inactiva'),
(14, 'PlataformaBorrar', 'Inactiva'),
(15, 'PlataformaBorrar1', 'Inactiva'),
(16, 'Plataforma nueva', 'Activa'),
(17, 'Plataforma inexistente', 'Activa'),
(18, 'Ultima', 'Activa'),
(19, 'Prueba 200', 'Activa'),
(20, 'Prueba 300', 'Activa'),
(21, 'Prueba 600', 'Activa'),
(22, 'Prueba 701', 'Activa'),
(23, 'Darwin', 'Activa'),
(24, 'Mercy Parra', 'Activa'),
(25, 'Darq', 'Activa'),
(26, 'BHO', 'Activa'),
(27, 'BHOs', 'Activa'),
(28, 'Disney', 'Inactiva');

-- --------------------------------------------------------

--
-- Table structure for table `prueba`
--

CREATE TABLE `prueba` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `edad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `prueba`
--

INSERT INTO `prueba` (`id`, `nombre`, `edad`) VALUES
(2, 'Mercy', 32),
(3, 'Pato', 34),
(6, 'Cindy', 35),
(8, 'Emily', 37);

-- --------------------------------------------------------

--
-- Table structure for table `seasons`
--

CREATE TABLE `seasons` (
  `id` int(11) NOT NULL,
  `number` int(11) DEFAULT NULL,
  `id_serie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `series`
--

CREATE TABLE `series` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `idplatform` int(11) DEFAULT NULL,
  `iddirector` int(11) DEFAULT NULL,
  `premiereyear` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `series`
--

INSERT INTO `series` (`id`, `title`, `idplatform`, `iddirector`, `premiereyear`) VALUES
(1, 'FRIENDS', 5, 2, 1980),
(2, 'La casa de Papel', 4, 3, 2020),
(4, 'Batman', 10, 2, 2020);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actors`
--
ALTER TABLE `actors`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `pr` (`idperson`) USING BTREE;

--
-- Indexes for table `actor_film_detail`
--
ALTER TABLE `actor_film_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_actor` (`idactor`),
  ADD KEY `id_film` (`idfilm`);

--
-- Indexes for table `actor_serie_detail`
--
ALTER TABLE `actor_serie_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idactor` (`idactor`),
  ADD KEY `idserie` (`idserie`);

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `caj_capitulo_temporada` (`id_season`) USING BTREE;

--
-- Indexes for table `directors`
--
ALTER TABLE `directors`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `caj_director_persona` (`idperson`) USING BTREE;

--
-- Indexes for table `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `caj_pelicula_director` (`iddirector`) USING BTREE,
  ADD KEY `caj_pelicula_plataforma` (`idplatform`) USING BTREE;

--
-- Indexes for table `languageaudio_film_detail`
--
ALTER TABLE `languageaudio_film_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_film` (`idfilm`),
  ADD KEY `id_language` (`idlanguage`);

--
-- Indexes for table `languageaudio_serie_detail`
--
ALTER TABLE `languageaudio_serie_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idlanguage` (`idlanguage`),
  ADD KEY `idserie` (`idserie`);

--
-- Indexes for table `languagecaption_film_detail`
--
ALTER TABLE `languagecaption_film_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_film` (`idfilm`),
  ADD KEY `id_language` (`idlanguage`);

--
-- Indexes for table `languagecaption_serie_detail`
--
ALTER TABLE `languagecaption_serie_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idlanguage` (`idlanguage`),
  ADD KEY `idserie` (`idserie`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `nationalities`
--
ALTER TABLE `nationalities`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `caj_persona_nacionalidad` (`idnationality`) USING BTREE;

--
-- Indexes for table `platforms`
--
ALTER TABLE `platforms`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `prueba`
--
ALTER TABLE `prueba`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seasons`
--
ALTER TABLE `seasons`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `caj_temporada_serie` (`id_serie`) USING BTREE;

--
-- Indexes for table `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `caj_serie_director` (`iddirector`) USING BTREE,
  ADD KEY `caj_serie_plataforma` (`idplatform`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actors`
--
ALTER TABLE `actors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `actor_film_detail`
--
ALTER TABLE `actor_film_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `actor_serie_detail`
--
ALTER TABLE `actor_serie_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `directors`
--
ALTER TABLE `directors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `films`
--
ALTER TABLE `films`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `languageaudio_film_detail`
--
ALTER TABLE `languageaudio_film_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT for table `languageaudio_serie_detail`
--
ALTER TABLE `languageaudio_serie_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `languagecaption_film_detail`
--
ALTER TABLE `languagecaption_film_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `languagecaption_serie_detail`
--
ALTER TABLE `languagecaption_serie_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nationalities`
--
ALTER TABLE `nationalities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `persons`
--
ALTER TABLE `persons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `platforms`
--
ALTER TABLE `platforms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `prueba`
--
ALTER TABLE `prueba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `seasons`
--
ALTER TABLE `seasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `series`
--
ALTER TABLE `series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `actors`
--
ALTER TABLE `actors`
  ADD CONSTRAINT `actors_ibfk_1` FOREIGN KEY (`idperson`) REFERENCES `persons` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `actor_film_detail`
--
ALTER TABLE `actor_film_detail`
  ADD CONSTRAINT `actor_film_detail_ibfk_1` FOREIGN KEY (`idactor`) REFERENCES `actors` (`id`),
  ADD CONSTRAINT `actor_film_detail_ibfk_2` FOREIGN KEY (`idfilm`) REFERENCES `films` (`id`);

--
-- Constraints for table `actor_serie_detail`
--
ALTER TABLE `actor_serie_detail`
  ADD CONSTRAINT `actor_serie_detail_ibfk_1` FOREIGN KEY (`idactor`) REFERENCES `actors` (`id`),
  ADD CONSTRAINT `actor_serie_detail_ibfk_2` FOREIGN KEY (`idserie`) REFERENCES `series` (`id`);

--
-- Constraints for table `chapters`
--
ALTER TABLE `chapters`
  ADD CONSTRAINT `chapters_ibfk_1` FOREIGN KEY (`id_season`) REFERENCES `seasons` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `directors`
--
ALTER TABLE `directors`
  ADD CONSTRAINT `directors_ibfk_1` FOREIGN KEY (`idperson`) REFERENCES `persons` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `films`
--
ALTER TABLE `films`
  ADD CONSTRAINT `caj_pelicula_director` FOREIGN KEY (`iddirector`) REFERENCES `directors` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `caj_pelicula_plataforma` FOREIGN KEY (`idplatform`) REFERENCES `platforms` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `languageaudio_film_detail`
--
ALTER TABLE `languageaudio_film_detail`
  ADD CONSTRAINT `languageaudio_film_detail_ibfk_1` FOREIGN KEY (`idfilm`) REFERENCES `films` (`id`),
  ADD CONSTRAINT `languageaudio_film_detail_ibfk_2` FOREIGN KEY (`idlanguage`) REFERENCES `languages` (`id`);

--
-- Constraints for table `languageaudio_serie_detail`
--
ALTER TABLE `languageaudio_serie_detail`
  ADD CONSTRAINT `languageaudio_serie_detail_ibfk_1` FOREIGN KEY (`idlanguage`) REFERENCES `languages` (`id`),
  ADD CONSTRAINT `languageaudio_serie_detail_ibfk_2` FOREIGN KEY (`idserie`) REFERENCES `series` (`id`);

--
-- Constraints for table `languagecaption_film_detail`
--
ALTER TABLE `languagecaption_film_detail`
  ADD CONSTRAINT `languagecaption_film_detail_ibfk_1` FOREIGN KEY (`idfilm`) REFERENCES `films` (`id`),
  ADD CONSTRAINT `languagecaption_film_detail_ibfk_2` FOREIGN KEY (`idlanguage`) REFERENCES `languages` (`id`);

--
-- Constraints for table `languagecaption_serie_detail`
--
ALTER TABLE `languagecaption_serie_detail`
  ADD CONSTRAINT `languagecaption_serie_detail_ibfk_1` FOREIGN KEY (`idlanguage`) REFERENCES `languages` (`id`),
  ADD CONSTRAINT `languagecaption_serie_detail_ibfk_2` FOREIGN KEY (`idserie`) REFERENCES `series` (`id`);

--
-- Constraints for table `persons`
--
ALTER TABLE `persons`
  ADD CONSTRAINT `persons_ibfk_1` FOREIGN KEY (`idnationality`) REFERENCES `nationalities` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `seasons`
--
ALTER TABLE `seasons`
  ADD CONSTRAINT `seasons_ibfk_1` FOREIGN KEY (`id_serie`) REFERENCES `series` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `series`
--
ALTER TABLE `series`
  ADD CONSTRAINT `series_ibfk_1` FOREIGN KEY (`idplatform`) REFERENCES `platforms` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `series_ibfk_2` FOREIGN KEY (`iddirector`) REFERENCES `directors` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
