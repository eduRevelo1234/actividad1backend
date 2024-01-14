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
