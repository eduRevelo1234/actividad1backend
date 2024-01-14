-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 14, 2024 at 07:56 PM
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
(3, 5, 'AC-001', 'Activa'),
(4, 6, 'AC-002', 'Activa'),
(5, 7, 'AC-003', 'Activa'),
(6, 8, 'AC-004', 'Activa'),
(7, 9, 'AC-006', 'Activa'),
(8, 10, 'AC-007', 'Activa'),
(9, 11, 'AC-008', 'Activa'),
(10, 12, 'AC-009', 'Activa'),
(11, 13, 'AC-010', 'Activa'),
(12, 14, 'AC-005', 'Activa'),
(13, 16, 'AC-011', 'Activa'),
(14, 17, 'AC-025', 'Activa'),
(15, 20, 'AC-056', 'Activa'),
(16, 22, 'AC-089', 'Activa'),
(17, 24, 'AC-0067', 'Activa'),
(18, 26, 'AC-0057', 'Activa'),
(19, 28, 'AC-0046', 'Activa'),
(20, 30, 'AC-0015', 'Activa'),
(21, 32, 'AC-0036', 'Activa'),
(22, 34, 'AC-0425', 'Activa'),
(23, 35, 'AC-0064', 'Activa'),
(24, 37, 'AC-0525', 'Activa'),
(25, 38, 'AC-0564', 'Activa'),
(26, 40, 'AC-0235', 'Activa'),
(27, 41, 'AC-0236', 'Activa'),
(28, 43, 'AC-0125', 'Activa'),
(29, 44, 'AC-063', 'Activa'),
(30, 45, 'AC-0051', 'Activa'),
(31, 46, 'AC-267', 'Activa'),
(32, 47, 'AC-0129', 'Activa'),
(33, 48, 'AC-0065', 'Activa'),
(34, 49, 'AC-869', 'Activa'),
(35, 50, 'AC-0120', 'Activa'),
(36, 52, 'ac-0045', 'Activa'),
(37, 53, 'AC-0037', 'Activa'),
(38, 55, 'AC-0093', 'Activa');

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
(39, 3, 28),
(40, 13, 28),
(41, 13, 29),
(42, 14, 29),
(44, 4, 30),
(45, 5, 31),
(46, 16, 31),
(47, 6, 32),
(48, 17, 32),
(49, 7, 33),
(50, 18, 33),
(51, 8, 34),
(52, 19, 34),
(54, 9, 35),
(55, 20, 35),
(58, 10, 36),
(59, 21, 36),
(60, 36, 37),
(61, 37, 37);

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
(7, 22, 5),
(8, 23, 5),
(9, 24, 6),
(10, 25, 6),
(11, 26, 7),
(12, 27, 7),
(13, 28, 8),
(14, 29, 8),
(15, 31, 9),
(16, 32, 9),
(17, 34, 10),
(18, 35, 10),
(19, 37, 11),
(20, 38, 11);

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
(4, 16, 'DIR-001', 'Activa'),
(5, 15, 'DIR-002', 'Activa'),
(6, 19, 'DIR-025', 'Activa'),
(7, 21, 'DIR-045', 'Activa'),
(8, 23, 'DIR-0047', 'Activa'),
(9, 25, 'DIR-0067', 'Activa'),
(10, 27, 'DIR-0078', 'Activa'),
(11, 29, 'DIR-0036', 'Activa'),
(12, 31, 'AC-0079', 'Activa'),
(13, 33, 'DIR-0154', 'Activa'),
(14, 36, 'DIR-0478', 'Activa'),
(15, 39, 'DIR-098', 'Activa'),
(16, 42, 'DIR-0012', 'Activa'),
(17, 48, 'DIR-003', 'Activa'),
(18, 51, 'DIR-0054', 'Activa'),
(19, 54, 'DIR-0073', 'Activa');

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
(28, 'Dia de Entrenamiento', 31, 5, 2001),
(29, 'Blaze', 29, 4, 2019),
(30, 'Faustine et le bel été', 33, 6, 1972),
(31, 'Petróleo Sangriento ', 32, 7, 2007),
(32, 'John Wick', 31, 8, 2014),
(33, 'Moulin Rouge!', 36, 9, 2001),
(34, 'El expreso del miedo', 37, 10, 2013),
(35, 'La gran belleza', 39, 11, 2013),
(36, 'LA CENIZA ES EL BLANCO MÁS PURO', 34, 12, 2014),
(37, 'BIG BANG', 29, 18, 2007);

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
(183, 28, 6),
(184, 28, 7),
(185, 29, 6),
(186, 29, 8),
(187, 30, 6),
(188, 30, 17),
(189, 32, 6),
(190, 32, 7),
(191, 34, 6),
(192, 34, 14),
(193, 36, 6),
(194, 36, 14),
(195, 37, 6),
(196, 37, 7);

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
(18, 5, 7),
(19, 5, 9),
(20, 6, 6),
(21, 6, 7),
(22, 6, 8),
(23, 6, 9),
(24, 7, 6),
(25, 7, 7),
(26, 7, 8),
(27, 8, 6),
(28, 8, 7),
(29, 8, 9),
(30, 9, 6),
(31, 9, 7),
(32, 9, 14),
(33, 10, 6),
(34, 10, 7),
(35, 11, 6),
(36, 11, 7),
(37, 11, 8);

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
(76, 28, 6),
(77, 28, 7),
(78, 28, 8),
(79, 28, 9),
(80, 29, 7),
(81, 29, 8),
(82, 29, 9),
(83, 30, 7),
(84, 30, 8),
(85, 30, 9),
(86, 32, 8),
(87, 32, 9),
(88, 34, 7),
(89, 34, 13),
(90, 34, 15),
(91, 36, 7),
(92, 36, 15),
(93, 36, 16),
(94, 37, 8),
(95, 37, 9),
(96, 37, 10),
(97, 37, 14),
(98, 37, 15),
(99, 37, 16),
(100, 37, 17);

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
(18, 5, 6),
(19, 5, 8),
(20, 6, 6),
(21, 6, 7),
(22, 6, 8),
(23, 6, 9),
(24, 6, 10),
(25, 6, 11),
(26, 7, 6),
(27, 7, 7),
(28, 7, 15),
(29, 7, 16),
(30, 7, 17),
(31, 8, 7),
(32, 8, 8),
(33, 8, 9),
(34, 8, 15),
(35, 9, 10),
(36, 9, 16),
(37, 9, 17),
(38, 10, 8),
(39, 10, 10),
(40, 10, 17),
(41, 11, 8),
(42, 11, 15),
(43, 11, 16);

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
(6, 'Ingles', 'en'),
(7, 'Español', 'es'),
(8, 'Aleman', 'de'),
(9, 'Italiano', 'it'),
(10, 'Japones', 'ja'),
(11, 'Noruego', 'nb'),
(12, 'Turco', 'tr'),
(13, 'Vietnamita', 'vi'),
(14, 'Chino', 'zh'),
(15, 'sueco', 'sv'),
(16, 'Rumano', 'ro'),
(17, 'Frances', 'fr');

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
(5, 'Estado Unidense'),
(6, 'Francesa'),
(7, 'Ingles'),
(8, 'Canadiense'),
(9, 'Surcoreano'),
(10, 'Italiano'),
(11, 'Chino'),
(12, 'Aleman'),
(13, 'Española');

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
(5, 'Denzel', 'Washington', '123', '1954-12-28', 5, 'Activa'),
(6, 'Isabelle ', 'Huppert', '1234', '1953-03-16', 6, 'Activa'),
(7, 'Daniel', 'Day-Lewis', '1245', '1957-04-29', 7, 'Activa'),
(8, 'Keanu', 'Reeves', '2567', '1964-09-02', 8, 'Activa'),
(9, 'Nicole', 'Kidman', '897888', '1967-06-20', 5, 'Activa'),
(10, 'Song', 'Kang Ho', '458752', '1967-01-17', 9, 'Activa'),
(11, 'Toni', 'Servillo', '4587', '1959-01-25', 10, 'Activa'),
(12, 'Zhao', 'Tao', '45666', '1977-01-28', 11, 'Activa'),
(13, 'Viola', 'Davis', '4577', '1965-08-11', 5, 'Activa'),
(14, 'Saoirse', 'Ronan', '455666', '1964-04-12', 5, 'Activa'),
(15, 'Antoine', 'Fuqua', '5697', '1965-05-30', 5, 'Activa'),
(16, 'Ethan ', 'Hawke', 'dd444', '1970-11-06', 5, 'Activa'),
(17, 'Charlie', 'Sexton', 'sss456', '1968-08-11', 5, 'Activa'),
(18, 'Michael ', 'Haneke', 'asa68855', '1942-03-23', 12, 'Activa'),
(19, 'Nina ', 'Companeez', 'aa555', '1937-08-26', 6, 'Activa'),
(20, 'Nathalie ', 'Baye', 'qq88888', '1948-07-06', 6, 'Activa'),
(21, 'Paul ', 'Thomas Anderson', 'err8888', '1970-06-26', 5, 'Activa'),
(22, 'Paul', 'Dano', 'etetet-89', '1984-06-19', 5, 'Activa'),
(23, 'Chad ', 'Stahelski', 'qpljk-003', '1968-09-20', 5, 'Activa'),
(24, 'Ian ', 'McShane', 'qlop-006', '1942-09-29', 7, 'Activa'),
(25, 'Baz ', 'Luhrmann', 'lop-005', '1962-09-17', 8, 'Activa'),
(26, 'Ewan ', 'McGregor', '6587ert', '1971-03-31', 5, 'Activa'),
(27, 'Bong ', 'Joon-ho', 'qpla-0064', '1969-09-14', 9, 'Activa'),
(28, 'Chris ', 'Evans', 'lqpe-44457', '1981-06-13', 5, 'Activa'),
(29, 'Paolo ', 'Sorrentino', 'sld-006', '1970-05-31', 10, 'Activa'),
(30, 'Sabrina ', 'Ferilli', 'lpsd65878', '1964-06-28', 10, 'Activa'),
(31, 'Jia ', 'Zhangke', 'lpo-064', '1970-05-24', 11, 'Activa'),
(32, 'LIAO ', 'FAN', 'qkekepo-0445', '1974-02-14', 11, 'Activa'),
(33, 'Elisa ', 'Amoruso', 'poq-677', '1981-04-29', 10, 'Activa'),
(34, 'Barbara ', 'Chichiarelli', 'sfad698', '1980-12-31', 10, 'Activa'),
(35, 'Simona ', 'Distefano', '455ee', '1985-09-04', 10, 'Activa'),
(36, 'Jesus', 'Colmenar', 'sw55', '1980-02-01', 13, 'Activa'),
(37, 'Álvaro ', 'Morte', 'lqo', '1975-02-23', 13, 'Activa'),
(38, 'Pedro ', 'Alonso', 'loqp-00677', '1971-06-21', 13, 'Activa'),
(39, 'Frank ', 'Darabont', 'lopq2345', '1959-01-28', 5, 'Activa'),
(40, 'Andrew ', 'Lincoln', 'lpqpq', '1973-09-14', 5, 'Activa'),
(41, 'Sarah ', 'Wayne Callies', 'poqo999', '1977-06-01', 5, 'Activa'),
(42, 'David ', 'Crane', 'lpq89664455', '1957-08-13', 5, 'Activa'),
(43, 'Jennifer ', 'Aniston', 'poqoqo-65656', '1969-02-11', 5, 'Activa'),
(44, 'Matt ', 'LeBlanc', 'kslqp7895', '1967-07-25', 5, 'Activa'),
(45, 'RACHEL ', 'TALALAY', 'lpoad646', '1978-08-25', 5, 'Activa'),
(46, 'BENEDICT ', 'CUMBERBATCH', 'qoei-0067', '1976-07-19', 5, 'Activa'),
(47, 'MARTIN ', 'FREEMAN', 'lpqpq-0067', '1971-09-08', 7, 'Activa'),
(48, 'MATT ', 'DUFFER', 'lpoq', '1984-02-15', 5, 'Activa'),
(49, 'NATALIA ', 'DYER', 'plqo098', '1997-01-13', 5, 'Activa'),
(50, 'CHARLIE ', 'HEATON', 'poq56879', '1994-02-06', 5, 'Activa'),
(51, 'MARK ', 'CENDROWSKI', 'lop8965', '1980-08-26', 5, 'Activa'),
(52, 'JIM ', 'PARSONS', 'poq20202', '1973-03-24', 5, 'Activa'),
(53, 'KALEY ', 'CUOCO', '456789', '1985-11-30', 5, 'Activa'),
(54, 'GREG ', 'YAITANES', '101019991', '1970-06-18', 5, 'Activa'),
(55, 'HUGH ', 'LAURIE', '78956214', '1959-06-11', 7, 'Activa'),
(56, 'OMAR ', 'EPPS', '9687856', '1973-07-20', 5, 'Activa');

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
(29, 'Netflix', 'Activa'),
(30, 'Amazon Prime Video', 'Activa'),
(31, 'HBO ', 'Activa'),
(32, 'SKY', 'Activa'),
(33, 'Rakuten TV', 'Activa'),
(34, 'Filmin', 'Activa'),
(35, 'Disney+', 'Activa'),
(36, 'Movistar+ Lite', 'Activa'),
(37, 'Apple TV', 'Activa'),
(38, 'YouTube en directo', 'Activa'),
(39, 'Hulu', 'Activa');

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
(5, 'Las buenas madres', 30, 13, 2020),
(6, 'La casa de papel', 29, 14, 2017),
(7, 'The Walking Dead', 37, 15, 2010),
(8, 'Friends', 29, 16, 1994),
(9, 'SHERLOCK', 29, 16, 2010),
(10, 'STRANGER THINGS', 29, 17, 2020),
(11, 'HOUSE', 29, 19, 2004);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `actor_film_detail`
--
ALTER TABLE `actor_film_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `actor_serie_detail`
--
ALTER TABLE `actor_serie_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `directors`
--
ALTER TABLE `directors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `films`
--
ALTER TABLE `films`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `languageaudio_film_detail`
--
ALTER TABLE `languageaudio_film_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT for table `languageaudio_serie_detail`
--
ALTER TABLE `languageaudio_serie_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `languagecaption_film_detail`
--
ALTER TABLE `languagecaption_film_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `languagecaption_serie_detail`
--
ALTER TABLE `languagecaption_serie_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `nationalities`
--
ALTER TABLE `nationalities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `persons`
--
ALTER TABLE `persons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `platforms`
--
ALTER TABLE `platforms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `seasons`
--
ALTER TABLE `seasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `series`
--
ALTER TABLE `series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
