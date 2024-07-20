-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 20-07-2024 a las 02:33:19
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mercurio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formsatisfaccion`
--

DROP TABLE IF EXISTS `formsatisfaccion`;
CREATE TABLE IF NOT EXISTS `formsatisfaccion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `comentarios` varchar(255) DEFAULT NULL,
  `audio` varchar(255) DEFAULT NULL,
  `fhsubida` date DEFAULT NULL,
  `idticket` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_idticket` (`idticket`)
) ENGINE=MyISAM AUTO_INCREMENT=186 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `formsatisfaccion`
--

INSERT INTO `formsatisfaccion` (`id`, `comentarios`, `audio`, `fhsubida`, `idticket`) VALUES
(185, 'Test_Comentario_183', 'Test_Audio_183', '2024-07-08', 183);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `email` varchar(100) NOT NULL,
  `logindate` datetime NOT NULL,
  `ip` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `numeros_accesos`
--

DROP TABLE IF EXISTS `numeros_accesos`;
CREATE TABLE IF NOT EXISTS `numeros_accesos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idpersona` int NOT NULL,
  `numero` int NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `fhcreacion` datetime NOT NULL,
  `activo` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

DROP TABLE IF EXISTS `personas`;
CREATE TABLE IF NOT EXISTS `personas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `fhcreado` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

DROP TABLE IF EXISTS `registro`;
CREATE TABLE IF NOT EXISTS `registro` (
  `registerKey` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbestado`
--

DROP TABLE IF EXISTS `tbestado`;
CREATE TABLE IF NOT EXISTS `tbestado` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbgps`
--

DROP TABLE IF EXISTS `tbgps`;
CREATE TABLE IF NOT EXISTS `tbgps` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gps` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbmensajes`
--

DROP TABLE IF EXISTS `tbmensajes`;
CREATE TABLE IF NOT EXISTS `tbmensajes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idticket` int NOT NULL,
  `personal` int NOT NULL,
  `tecnico` int NOT NULL,
  `mensaje` varchar(250) NOT NULL,
  `fecha` datetime NOT NULL,
  `estado` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbpersonal`
--

DROP TABLE IF EXISTS `tbpersonal`;
CREATE TABLE IF NOT EXISTS `tbpersonal` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nomcorto` varchar(25) NOT NULL,
  `nomcompleto` varchar(100) NOT NULL,
  `idpersona` int NOT NULL,
  `estado` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tbpersonal`
--

INSERT INTO `tbpersonal` (`id`, `nomcorto`, `nomcompleto`, `idpersona`, `estado`) VALUES
(1, 'Rene', 'Rene Sanchez', 0, 1),
(2, 'Alfonso', 'Alfonso Ruiz', 0, 1),
(3, 'Daniel Chávez', 'Daniel Chávez', 0, 1),
(4, 'Daniel Diaz', 'Daniel Diaz', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbprioridad`
--

DROP TABLE IF EXISTS `tbprioridad`;
CREATE TABLE IF NOT EXISTS `tbprioridad` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tbprioridad`
--

INSERT INTO `tbprioridad` (`id`, `tipo`) VALUES
(1, 'Baja'),
(2, 'Media'),
(3, 'Alta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbservicios`
--

DROP TABLE IF EXISTS `tbservicios`;
CREATE TABLE IF NOT EXISTS `tbservicios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `servicio` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbticket`
--

DROP TABLE IF EXISTS `tbticket`;
CREATE TABLE IF NOT EXISTS `tbticket` (
  `idTicket` int NOT NULL AUTO_INCREMENT,
  `fhticket` datetime DEFAULT NULL,
  `nombre` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `numTrabajador` int DEFAULT NULL,
  `uso` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `laboratorio` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `oficina` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `numCliente` int DEFAULT NULL,
  `dispositivo` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `imeiCliente` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fhRevision` datetime DEFAULT NULL,
  `numContacto` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `nomContacto` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `placasContacto` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `marcaContacto` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `edificio` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `area` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `equipo` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `prioridad` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `asunto` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `descripcion` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `estado` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `domicilio` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ciudad` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `domestado` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `codpostal` int DEFAULT NULL,
  `domdescripcion` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `servicio` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `asignado` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `st_estado` tinyint(1) NOT NULL,
  `evidencia` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'sin_evidencia',
  `evidenciaAbierto` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `evidenciaHaciendo` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `evidenciaHecho` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `txt_contestacion` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fh_contestacion` datetime DEFAULT NULL,
  `fh_programada` datetime DEFAULT NULL,
  `fh_eliminacion` datetime DEFAULT NULL,
  `motivo_eliminacion` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `eliminadopor` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `correo` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idTicket`)
) ENGINE=InnoDB AUTO_INCREMENT=194 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `tbticket`
--

INSERT INTO `tbticket` (`idTicket`, `fhticket`, `nombre`, `numTrabajador`, `uso`, `laboratorio`, `oficina`, `numCliente`, `dispositivo`, `imeiCliente`, `fhRevision`, `numContacto`, `nomContacto`, `placasContacto`, `marcaContacto`, `edificio`, `area`, `equipo`, `prioridad`, `asunto`, `descripcion`, `estado`, `domicilio`, `ciudad`, `domestado`, `codpostal`, `domdescripcion`, `servicio`, `asignado`, `st_estado`, `evidencia`, `evidenciaAbierto`, `evidenciaHaciendo`, `evidenciaHecho`, `txt_contestacion`, `fh_contestacion`, `fh_programada`, `fh_eliminacion`, `motivo_eliminacion`, `eliminadopor`, `correo`, `token`) VALUES
(154, '2024-06-04 09:36:19', 'Test', 0, 'Test', 'Test', 'Test', 0, 'Test', '000', '2024-06-04 09:36:19', '000', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Alta', 'Test', NULL, 'Test', 'Test', 'Test', 'Test', 0, 'Test', '0', 'Test', 0, 'sin_evidencia', NULL, NULL, NULL, 'Test', '2024-07-03 13:19:09', NULL, NULL, NULL, NULL, NULL, ''),
(155, '2024-06-17 11:28:01', 'test', 0, NULL, NULL, NULL, 0, 'TEST', '000', NULL, '000', 'TEST', 'TEST', 'TEST', NULL, NULL, NULL, 'Pendiente', 'TEST', 'TEST', 'Creado', 'TEST', 'TEST', 'TEST', 0, 'TEST', '0', NULL, 0, '../../assets/imgTickets/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(156, '2024-06-26 10:09:17', 'test', 0, NULL, NULL, NULL, 0, 'Test', '000', NULL, '000', 'Test', 'Test', 'Test', NULL, NULL, NULL, 'Pendiente', 'Test', 'Test', 'Creado', 'Test', 'Test', 'Test', 0, 'Test', '0', NULL, 0, '../../assets/imgTickets/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test@test.com', ''),
(157, '2024-06-26 10:11:01', 'test', 0, NULL, NULL, NULL, 0, 'Test', 'Test', NULL, 'Test', 'Test', 'Test', 'Test', NULL, NULL, NULL, 'Pendiente', 'Test', 'Test', 'Creado', 'Test', 'Test', 'Test', 0, 'Test', '0', NULL, 0, '../../assets/imgTickets/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pedravi.avi@gmail.com', ''),
(158, '2024-06-26 10:21:08', 'test', 0, NULL, NULL, NULL, 0, 'Test', 'Test', NULL, '000', 'Test', 'Test', 'Test', NULL, NULL, NULL, 'Pendiente', 'Test', 'Test', 'Creado', 'Test', 'Test', 'Test', 0, 'Test', '0', NULL, 0, '../../assets/imgTickets/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pedravi.avi@gmail.com', ''),
(159, '2024-06-26 10:43:53', 'test', 0, NULL, NULL, NULL, 0, 'Test', 'Test', NULL, 'Test', 'Test', 'Test', 'Test', NULL, NULL, NULL, 'Pendiente', 'Test', 'Test', 'Creado', 'Test', 'Test', 'Test', 0, 'Test', '0', NULL, 0, '../../assets/imgTickets/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pedravi.avi@gmail.com', ''),
(160, '2024-06-26 10:49:27', 'test', 0, NULL, NULL, NULL, 0, 'Test', 'Test', NULL, '000', 'Test', 'Test', 'Test', NULL, NULL, NULL, 'Pendiente', 'Test', 'Test', 'Creado', 'Test', 'Test', 'Test', 0, 'Test', '0', NULL, 0, '../../assets/imgTickets/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pedravi.avi@gmail.com', ''),
(161, '2024-06-26 10:57:30', 'test', 0, NULL, NULL, NULL, 0, 'Test', 'Test', NULL, 'Test', 'Test', 'Test', 'Test', NULL, NULL, NULL, 'Pendiente', 'Test', 'Test', 'Creado', 'Test', 'Test', 'Test', 0, 'Test', '0', NULL, 0, '../../assets/imgTickets/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pedravi.avi@gmail.com', ''),
(162, '2024-06-26 10:58:44', 'test', 0, NULL, NULL, NULL, 0, 'Test', 'Test', NULL, 'Test', 'Test', 'Test', 'Test', NULL, NULL, NULL, 'Pendiente', 'Test', 'Test', 'Creado', 'Test', 'Test', 'Test', 0, 'Test', '0', NULL, 0, '../../assets/imgTickets/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pedravi.avi@gmail.com', ''),
(163, '2024-06-26 11:08:08', 'test', 0, NULL, NULL, NULL, 0, 'Test', 'Test', NULL, 'Test', 'Test', 'Test', 'Test', NULL, NULL, NULL, 'Pendiente', 'Test', 'Test', 'Creado', 'Test', 'Test', 'Test', 0, 'Test', '0', NULL, 0, '../../assets/imgTickets/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pedravi.avi@gmail.com', ''),
(164, '2024-06-26 11:11:53', 'test', 0, NULL, NULL, NULL, 0, 'Test', 'Test', NULL, 'Test', 'Test', 'Test', 'Test', NULL, NULL, NULL, 'Pendiente', 'Test', 'Test', 'Creado', 'Test', 'Test', 'Test', 0, 'Test', '0', NULL, 0, '../../assets/imgTickets/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pedravi.avi@gmail.com', ''),
(165, '2024-06-26 12:48:57', 'test', 0, NULL, NULL, NULL, 0, 'TEST3', 'TEST3', NULL, 'TEST3', 'TEST3', 'TEST3', 'TEST3', NULL, NULL, NULL, 'Pendiente', 'TEST3', 'TEST3', 'Creado', 'TEST3', 'TEST3', 'TEST3', 0, 'TEST3', '0', NULL, 0, '../../assets/imgTickets/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pedravi.avi@gmail.com', ''),
(166, '2024-06-26 12:50:20', 'test', 0, NULL, NULL, NULL, 0, 'TEST4', 'TEST4', NULL, 'TEST4', 'TEST4', 'TEST4', 'TEST4', NULL, NULL, NULL, 'Pendiente', 'TEST4', 'TEST4', 'Creado', 'TEST4', 'TEST4', 'TEST4', 0, 'TEST4', '0', NULL, 0, '../../assets/imgTickets/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pedravi.avi@gmail.com', ''),
(167, '2024-06-26 12:51:23', 'test', 0, NULL, NULL, NULL, 0, 'TEST5', 'TEST5', NULL, 'TEST5', 'TEST5', 'TEST5', 'TEST5', NULL, NULL, NULL, 'Pendiente', 'TEST5', 'TEST5', 'Creado', 'TEST5', 'TEST5', 'TEST5', 0, 'TEST5', '0', NULL, 0, '../../assets/imgTickets/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pedravi.avi@gmail.com', ''),
(168, '2024-06-26 12:51:56', 'test', 0, NULL, NULL, NULL, 0, '000', '00', NULL, '00', '00', '0', '0', NULL, NULL, NULL, 'Pendiente', '0', '0', 'Creado', '00', '0', '0', 0, '0', '0', NULL, 0, '../../assets/imgTickets/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pedravi.avi@gmail.com', ''),
(169, '2024-06-26 13:02:04', 'test', 0, NULL, NULL, NULL, 0, 'TEST6', 'TEST6', NULL, 'TEST6', 'TEST6', 'TEST6', 'TEST6', NULL, NULL, NULL, 'Pendiente', 'TEST6', 'TEST6', 'Creado', 'TEST6', 'TEST6', 'TEST6', 0, 'TEST6', '0', NULL, 0, '../../assets/imgTickets/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pedravi.avi@gmail.com', ''),
(170, '2024-06-26 13:03:29', 'test', 0, NULL, NULL, NULL, 0, 'TEST7', 'TEST7', NULL, 'TEST7', 'TEST7', 'TEST7', 'TEST7', NULL, NULL, NULL, 'Pendiente', 'TEST7', 'TEST7', 'Creado', 'TEST7', 'TEST7', 'TEST7', 0, 'TEST7', '0', NULL, 0, '../../assets/imgTickets/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pedravi.avi@gmail.com', ''),
(171, '2024-06-29 11:44:08', 'test', 0, NULL, NULL, NULL, 0, 'Test10', '000', NULL, '000', 'Test10', 'Test10', 'Test10', NULL, NULL, NULL, 'Pendiente', 'Test10', 'Test10', 'Creado', 'Test10', 'Test10', 'Test10', 0, 'Test10', '0', NULL, 0, '../../assets/imgTickets/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pedravi.avi@gmail.com', ''),
(172, '2024-07-02 11:21:20', 'test', 0, NULL, NULL, NULL, 0, 'TestTest', '000', NULL, '000', 'TestTest', 'TestTest', 'TestTest', NULL, NULL, NULL, 'Pendiente', 'TestTest', 'TestTest', 'Creado', 'TestTest', 'TestTest', 'TestTest', 0, 'TestTest', '0', NULL, 0, '../../assets/imgTickets/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pedravi.avi@gmail.com', 'cf10ea6e9bedf2428dd46814e5dc2928d035b7a367320461b03961ac83915ee9eb68269937fb3c873407b8a5f01cbe6e5562'),
(173, '2024-07-02 11:25:52', 'test', 0, NULL, NULL, NULL, 0, 'TestTest', 'TestTest', NULL, 'TestTest', 'TestTest', 'TestTest', 'TestTest', NULL, NULL, NULL, 'Pendiente', 'TestTest', 'TestTest', 'Creado', 'TestTest', 'TestTest', 'TestTest', 0, 'TestTest', '0', NULL, 0, '../../assets/imgTickets/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pedravi.avi@gmail.com', 'caac6f5e4fc220b8531e4e6c56033f8acad7019611f979ddd92a316010d64de6e85257e203eef7d4c18a22dec38f966abce0'),
(174, '2024-07-02 11:26:18', 'test', 0, NULL, NULL, NULL, 0, 'TestTest', 'TestTest', NULL, 'TestTest', 'TestTest', 'TestTest', 'TestTest', NULL, NULL, NULL, 'Pendiente', 'TestTest', 'TestTest', 'Creado', 'TestTest', 'TestTest', 'TestTest', 0, 'TestTest', '1', NULL, 0, '../../assets/imgTickets/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pedravi.avi@gmail.com', 'd508ed519c28eaaa5643be24d2376e29f991d036024736572ec6e2bb60fee64077619d3be025bfb1818e946997fd88eb4c3a'),
(175, '2024-07-02 11:26:48', 'test', 0, NULL, NULL, NULL, 0, 'TestTest', 'TestTest', NULL, 'TestTest', 'TestTest', 'TestTest', 'TestTest', NULL, NULL, NULL, 'Pendiente', 'TestTest', 'TestTest', 'Creado', '', '', '', 0, '', '0', NULL, 0, '../../assets/imgTickets/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pedravi.avi@gmail.com', '4b7879feab4c38633384821cd118208853ce52412088257cc6216440007538ecb750c2077059c1e5b9192b355c4dcecde673'),
(176, '2024-07-02 11:27:31', 'test', 0, NULL, NULL, NULL, 0, 'TestTest', 'TestTest', NULL, 'TestTest', 'TestTest', 'TestTest', 'TestTest', NULL, NULL, NULL, 'Pendiente', 'TestTest', 'TestTest', 'Creado', '', '', '', 0, '', '0', NULL, 0, '../../assets/imgTickets/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pedravi.avi@gmail.com', '63838429b7719851e7f171a1ccbbeae370953d253e71c56a08997a11692e007657b1c8e5368e3f473acc67d210cc2732b7b2'),
(177, '2024-07-02 11:32:17', 'test', 0, NULL, NULL, NULL, 0, 'TestTestTest', 'TestTestTest', NULL, 'TestTestTest', 'TestTestTest', 'TestTestTe', 'TestTestTest', NULL, NULL, NULL, 'Pendiente', 'TestTestTest', 'TestTestTest', 'Creado', 'TestTestTest', 'TestTestTest', 'TestTestTest', 0, 'TestTestTest', '0', NULL, 0, '../../assets/imgTickets/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pedravi.avi@gmail.com', 'f106933290bdc0b0466be931bfa0c50ccba51afc8339475bd53cac5bc04a135466e0bf1e4d0fb0edd2f7cca0caa2b41b7d3f'),
(178, '2024-07-02 11:39:54', 'test', 0, NULL, NULL, NULL, 0, 'TestTestTest', 'TestTestTest', NULL, 'TestTestTest', 'TestTestTest', 'TestTestTe', 'TestTestTest', NULL, NULL, NULL, 'Pendiente', 'TestTestTest', 'TestTestTest', 'Creado', 'TestTestTest', 'TestTestTest', 'TestTestTest', 0, 'TestTestTest', '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pedravi.avi@gmail.com', '0f52e04b55f636a3e0bbd23cf28385b16decfa54193204f654fbd68308ac80dd221f548efe37e395b0a81d15ce674776a230'),
(179, '2024-07-02 11:46:49', 'test', 0, NULL, NULL, NULL, 0, 'TestTestTest', 'TestTestTest', NULL, 'TestTestTest', 'TestTestTest', 'TestTestTe', 'TestTestTest', NULL, NULL, NULL, 'Pendiente', 'TestTestTest', 'TestTestTest', 'Creado', 'TestTestTest', 'TestTestTest', 'TestTestTest', 0, 'TestTestTest', '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pedrac', '815b2b3f770579fde352df47173979c480a85052baec7fb5545155caf12c38655c1d798045e1c570f529fe5d3dffa5115963'),
(180, '2024-07-02 11:47:06', 'test', 0, NULL, NULL, NULL, 0, 'TestTestTest', 'TestTestTest', NULL, 'TestTestTest', 'TestTestTest', 'TestTestTe', 'TestTestTest', NULL, NULL, NULL, 'Pendiente', 'TestTestTest', 'TestTestTest', 'Creado', '', '', '', 0, '', '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pedravi.avi@gmail.com', 'b1c2fa7be1f536dca16d837a13eaf9542b86a0c64b0b7e056ed685735fcb52af31974e74de91ddb78104949a0aff30ad4f06'),
(181, '2024-07-02 12:06:15', 'test', 0, NULL, NULL, NULL, 0, 'TestTestTest', 'TestTestTest', NULL, 'TestTestTest', 'TestTestTest', 'TestTestTe', 'TestTestTest', NULL, NULL, NULL, 'Pendiente', 'TestTestTest', 'TestTestTest', 'Creado', '', '', '', 0, '', '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pedravi.avi@gmail.com', 'f4d8207274ae8f12656779b5541f68890213c0d44cfc72e11be3608f87f135c783c0aeb0e78557f8b6b71f8789b6be720126'),
(182, '2024-07-02 12:13:25', 'test', 0, NULL, NULL, NULL, 0, 'TestTestTest', 'TestTestTest', NULL, 'TestTestTest', 'TestTestTest', 'TestTestTe', 'TestTestTest', NULL, NULL, NULL, '1', 'TestTestTest', 'TestTestTest', '1', '', '', '', 0, '', '0', '4', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-08 16:25:23', 'Test_Eliminacion_182', NULL, 'pedravi.avi@gmail.com', 'bedd497c567ec847ca9a9b6a77facb36e47be5e5f06fe5a1e61316ea1e51f2f30e8299e07fcd64fea846974b6930c97dde89'),
(183, '2024-07-02 12:15:49', 'test', 0, NULL, NULL, NULL, 0, 'TestTestTest', 'TestTestTest', NULL, 'TestTestTest', 'TestTestTest', 'TestTestTe', 'TestTestTest', NULL, NULL, NULL, '1', 'TestTestTest', 'TestTestTest', '0', '', '', '', 0, '', '0', '4', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-06 18:13:42', 'Test_Eliminacion_3', NULL, 'pedravi.avi@gmail.com', NULL),
(184, '2024-07-02 12:23:13', 'test', 0, NULL, NULL, NULL, 0, 'TestTestTest', 'TestTestTest', NULL, 'TestTestTest', 'TestTestTest', 'TestTestTe', 'TestTestTest', NULL, NULL, NULL, 'Pendiente', 'TestTestTest', 'TestTestTest', '4', '', '', '', 0, '', '0', NULL, 0, NULL, NULL, NULL, NULL, 'Test', '2024-07-03 13:19:46', NULL, NULL, NULL, NULL, 'pedravi.avi@gmail.com', NULL),
(185, '2024-07-05 09:37:27', 'test', 0, NULL, NULL, NULL, 2426, 'Test_Dipositivo', 'Test_ESN', NULL, '314 118 3785', 'Test_Contacto', 'Test_Placa', 'Test_Marca/Modelo', NULL, NULL, NULL, '1', 'Test_Asunto', 'Test_Descripcion', '1', 'Test_Domicilio', 'Test_Ciudad', 'Test_Estado_Ciudad', 0, 'Test_Desc_Lugar', 'Instalación', '4', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ASD3', NULL, 'pedravi.avi@gmai.com', 'bedd497c567ec847ca9a9b6a77facb36e47be5e5f06fe5a1e61316ea1e51f2f30e8299e07fcd64fea846974b6930c97dde88'),
(187, '2024-07-08 13:31:16', 'Admin', 0, NULL, NULL, NULL, 0, 'Test_Semifinal', 'Test_Semifinal', NULL, 'Test_Semifinal', 'Test_Semifinal', 'Test_Semif', 'Test_Semifinal', NULL, NULL, NULL, '2', 'Test_Semifinal', 'Test_Semifinal', '3', 'Test_Semifinal', 'Test_Semifinal', 'Test_Semifinal', 28869, 'Test_Semifinal', 'Selecciona una opció', '4', 0, NULL, NULL, NULL, NULL, 'Test_187_Realizando', '2024-07-17 15:31:44', NULL, NULL, NULL, NULL, 'pedravi.avi@gmail.com', 'be411560474315c1d97c7323cfbaa8564d3d2b61775f630c658c9c9f9bd651eb20c07f19c371b85ecfa62eaf1e2b1ef17c4d'),
(188, '2024-07-17 12:59:31', 'Admin', 0, NULL, NULL, NULL, 20210052, 'Test_Final_Ticket', '00023203203', NULL, '314 118 3785', 'Pedro Luis Pérez Flores', 'A23-23-42', 'Kwid Renault', NULL, NULL, NULL, 'Pendiente', 'Instalación de GPS', 'Instalación de GPS a cliente Pedro Luis Pérez Flores', '1', 'Calle Molusco #194', 'Manzanillo', 'Colima', 28869, 'Entre calle Concha Nacar y Caracol', 'Instalación', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pedravi.avi@gmail.com', '3b999bbfda3c127383cde058636e804608d1a2659a57189e74530827dfb353d7f05ea7f420f0ef1a61c77b3209399a721be4'),
(189, '2024-07-17 13:28:29', 'Admin', 0, NULL, NULL, NULL, 0, 'Test_Imagen', 'Test_Imagen', NULL, 'Test_Imagen', 'Test_Imagen', 'Test_Image', 'Test_Imagen', NULL, NULL, NULL, 'Pendiente', 'Test_Imagen', 'Test_Imagen', '1', 'Test_Imagen', 'Test_Imagen', 'Test_Imagen', 0, 'Test_Imagen', 'Instalación', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '67cff98ea5749b7929aa8734912a69b402ab36de14605eb137874a18f9a342871e0c3dbbca42b6cc54628ea726a1c6bf27bb'),
(190, '2024-07-17 13:38:42', 'Admin', 0, NULL, NULL, NULL, 0, 'Test_Imagen_2', 'Test_Imagen_2', NULL, 'Test_Imagen_2', 'Test_Imagen_2', 'Test_Image', 'Test_Imagen_2', NULL, NULL, NULL, 'Pendiente', 'Test_Imagen_2', 'Test_Imagen_2', '1', 'Test_Imagen_2', 'Test_Imagen_2', 'Test_Imagen_2', 0, 'Test_Imagen_2', 'Instalación', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '37018b961d014dc2337e37fade077ca68c8050c57b6624004bafd91fb5dd7e0fd0f21585afae2a20708a16bfae10ae71edda'),
(191, '2024-07-17 13:40:50', 'Admin', 0, NULL, NULL, NULL, 0, 'Test_Imagen_3', 'Test_Imagen_3', NULL, 'Test_Imagen_3', 'Test_Imagen_3', 'Test_Image', 'Test_Imagen_3', NULL, NULL, NULL, 'Pendiente', 'Test_Imagen_3', 'Test_Imagen_3', '1', 'Test_Imagen_3', 'Test_Imagen_3', 'Test_Imagen_3', 0, 'Test_Imagen_3', 'Selecciona una opció', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'a48531283ea6843ebb753a92859975268a14812f3fbcee140f77d59287edb69d4d46123e3d52f1da5dbefe3ec7f0d1e6cb70'),
(192, '2024-07-17 13:44:38', 'Admin', 0, NULL, NULL, NULL, 0, 'Test_Imagen_4', 'Test_Imagen_4', NULL, 'Test_Imagen_4', 'Test_Imagen_4', 'Test_Image', 'Test_Imagen_4', NULL, NULL, NULL, 'Pendiente', 'Test_Imagen_4', 'Test_Imagen_4', '1', 'Test_Imagen_4', 'Test_Imagen_4', 'Test_Imagen_4', 0, 'Test_Imagen_4', 'Instalación', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'c39888d6c6b6749d7ee3d8d494c9a0fb0d9a0d6693f9611afe6bca031f7459e4906352e66161bc44c169bf51270334cd54f2'),
(193, '2024-07-18 12:08:35', 'Admin', 0, NULL, NULL, NULL, 0, 'Test_Imagen_5', 'Test_Imagen_5', NULL, 'Test_Imagen_5', 'Test_Imagen_5', 'Test_Image', 'Test_Imagen_5', NULL, NULL, NULL, 'Pendiente', 'Test_Imagen_5_Edit_2', 'Test_Imagen_5_Edit', '1', 'Test_Imagen_5', 'Test_Imagen_5', 'Test_Imagen_5', 0, 'Test_Imagen_5_Edit', 'Instalación', NULL, 0, '3779802.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '57d93c51fb30d185874b6da81177c9a1a55633e9ab5cfb1414f65d1a073aa41e5562fa85b54724a722d2c91574eed3effbb7');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userId` int NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `nombre` varchar(55) NOT NULL,
  `apellido` varchar(55) NOT NULL,
  `email` varchar(200) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `tipo` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `token_expiration` timestamp NULL DEFAULT NULL,
  `userStatus` tinyint NOT NULL,
  `fhCreacion` datetime NOT NULL,
  `fhBaja` datetime DEFAULT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`userId`, `user`, `nombre`, `apellido`, `email`, `imagen`, `tipo`, `password`, `code`, `token`, `token_expiration`, `userStatus`, `fhCreacion`, `fhBaja`) VALUES
(1, 'PedroFlores', 'Pedro Luis', 'Pérez Flores', 'pedravi.avi@gmail.com', 'default.png', 'admin', '$2y$10$RUR4MTg4Dh4dWuIY1lHPXu88DLDASlpIT6AWIYJ1lGtP7Bcs/IsaG', NULL, NULL, NULL, 0, '2024-05-30 12:52:41', NULL),
(3, 'root', 'Admin', 'Edit2', 'root@test.com', '', 'admin', '$2y$10$RUR4MTg4Dh4dWuIY1lHPXu88DLDASlpIT6AWIYJ1lGtP7Bcs/IsaG', NULL, NULL, NULL, 0, '2024-06-17 10:25:47', NULL),
(4, 'tecnico', 'Tecnico', 'Edit5', 'developergrupoc@gmail.com', 'WhatsApp Image 2024-07-15 at 9.34.22 PM.jpeg', 'tecnico', '$2y$10$RUR4MTg4Dh4dWuIY1lHPXu88DLDASlpIT6AWIYJ1lGtP7Bcs/IsaG', NULL, NULL, NULL, 1, '2024-06-17 12:13:16', '2024-07-19 19:46:38');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
