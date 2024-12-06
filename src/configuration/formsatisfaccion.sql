-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 26-10-2024 a las 17:13:58
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
  `idForm` int NOT NULL AUTO_INCREMENT,
  `idTicket` int NOT NULL,
  `servCalificacion` int NOT NULL,
  `servSatisEvi` int NOT NULL,
  `servProbEfec` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `servProbEfecMotivo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `servSatisSistVis` int NOT NULL,
  `tecnAtencion` int NOT NULL,
  `tecnComentario` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `prodSatis` int NOT NULL,
  `prodUso` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `prodUsoFrec` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `prodCaract` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `empSent` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `empMejExp` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `empComp` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `empPalabra` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `comentario` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `firma` int NOT NULL,
  PRIMARY KEY (`idForm`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
