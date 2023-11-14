-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para sistema_asistencia
CREATE DATABASE IF NOT EXISTS `sistema_asistencia` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sistema_asistencia`;

-- Volcando estructura para tabla sistema_asistencia.alumnos
CREATE TABLE IF NOT EXISTS `alumnos` (
  `dni` int NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '',
  `apellido` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '',
  `fecha_nacimiento` date DEFAULT NULL,
  PRIMARY KEY (`dni`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla sistema_asistencia.alumnos: ~26 rows (aproximadamente)
INSERT INTO `alumnos` (`dni`, `nombre`, `apellido`, `fecha_nacimiento`) VALUES
	(38570361, 'Marcos', 'Reynoso', NULL),
	(39255959, 'Franco Antonio', 'Robles', NULL),
	(40018598, 'Kevin Gustavo', 'Quiroga', NULL),
	(40790201, 'Esteban', 'Copello', NULL),
	(40790545, 'Daian Exequiel', 'Fernandez', NULL),
	(41872676, 'Facundo Ariel', 'Janusa', NULL),
	(42069298, 'Marcos Damián', 'Godoy', NULL),
	(42070085, 'María Pia', 'Melgarejo', NULL),
	(42850626, 'Lucas Gabriel', 'Barreiro', NULL),
	(43149316, 'Franco Agustín', 'Chappe', NULL),
	(43414566, 'Maximiliano', 'Weyler', NULL),
	(43631710, 'Thiago Jeremías', 'Meseguer', NULL),
	(43631803, 'Bruno', 'Godoy', NULL),
	(43632750, 'Román', 'Coletti', NULL),
	(44282007, 'Bianca Ariana', 'Quiroga', NULL),
	(44623314, 'Facundo Gerónimo', 'Figún', NULL),
	(44644523, 'Ignacio Agustín', 'Piter', NULL),
	(44980999, 'Nicolás Osvaldo', 'Fernandez', NULL),
	(44981059, 'Federico José', 'Martinolich', NULL),
	(45048325, 'Felipe', 'Franco', NULL),
	(45048950, 'Facundo Martín', 'Jara', NULL),
	(45385675, 'Teo', 'Hildt', NULL),
	(45387761, 'Santiago Nicolás', 'Martinez Bender', NULL),
	(45389325, 'Lucas Jeremías', 'Fiorotto', NULL),
	(45741185, 'Pablo Federico', 'Martinez', NULL),
	(45847922, 'Franco', 'Cabrera', NULL);

-- Volcando estructura para tabla sistema_asistencia.asistencias
CREATE TABLE IF NOT EXISTS `asistencias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dni_alumno` int NOT NULL,
  `fecha_hora` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `fk_alumno_asistencia` (`dni_alumno`),
  CONSTRAINT `fk_alumno_asistencia` FOREIGN KEY (`dni_alumno`) REFERENCES `alumnos` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla sistema_asistencia.asistencias: ~0 rows (aproximadamente)

-- Volcando estructura para tabla sistema_asistencia.parametros
CREATE TABLE IF NOT EXISTS `parametros` (
  `cdad_clases` int DEFAULT NULL,
  `porc_promocion` int DEFAULT NULL,
  `porc_regular` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla sistema_asistencia.parametros: ~1 rows (aproximadamente)
INSERT INTO `parametros` (`cdad_clases`, `porc_promocion`, `porc_regular`) VALUES
	(0, 0, 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
