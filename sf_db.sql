-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-04-2023 a las 01:57:55
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `sf_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sf_db`;
-- Base de datos: `sf_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_actividad`
--

CREATE TABLE `tbl_actividad` (
  `id` int(11) NOT NULL,
  `activity` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_actividad`
--

INSERT INTO `tbl_actividad` (`id`, `activity`) VALUES
(1, 'Análisis'),
(2, 'Desarrollo'),
(3, 'Construcción'),
(4, 'Pruebas'),
(5, 'Traslado'),
(6, 'Estudio'),
(7, 'Tiempo muerto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cliente`
--

CREATE TABLE `tbl_cliente` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_cliente`
--

INSERT INTO `tbl_cliente` (`id`, `name`) VALUES
(0, ''),
(1, 'FLEXI'),
(2, 'SAN JACINTO'),
(3, 'NIPPON '),
(4, 'TRACUSA '),
(5, 'AGH '),
(6, 'ARTHA '),
(7, 'DKS'),
(8, 'CONVER '),
(9, 'BADER '),
(10, 'CUZCATLAN ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_horario`
--

CREATE TABLE `tbl_horario` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `duration` int(11) NOT NULL,
  `ticket` int(11) DEFAULT NULL,
  `id_client` int(11) DEFAULT NULL,
  `id_site` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `id_activity` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_horario`
--

INSERT INTO `tbl_horario` (`id`, `title`, `start`, `end`, `duration`, `ticket`, `id_client`, `id_site`, `description`, `id_activity`, `id_usuario`) VALUES
(3, 'prueba 2', '2023-04-20 14:00:00', '2023-04-20 15:00:00', 60, 1234, 10, 1, 'esto es una pruba', 3, 1),
(4, 'prueba ultima', '2023-04-20 15:00:00', '2023-04-20 17:00:00', 120, 123, 7, 1, 'esta es la ultima prueba', 4, 1),
(5, 'prueba 2', '2023-04-27 13:00:00', '2023-04-27 18:00:00', 300, 12345, 9, 1, 'esto es una prueba de inserción', 4, 1),
(6, 'sitio web', '2023-04-28 10:30:00', '2023-04-28 15:30:00', 300, 12345, 1, 1, 'se genero un eb para gestionar actividades del personal de sf', 4, 1),
(7, 'prueba de activitie', '2023-04-28 15:30:00', '2023-04-28 17:30:00', 120, 345, 1, 1, 'prueba 2', 1, 1),
(10, 'prueba de estudio', '2023-04-27 07:00:00', '2023-04-27 14:00:00', 420, 123456, 0, 1, 'prueba de estudio', 6, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_lugar`
--

CREATE TABLE `tbl_lugar` (
  `id` int(11) NOT NULL,
  `site` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_lugar`
--

INSERT INTO `tbl_lugar` (`id`, `site`) VALUES
(1, 'Remoto'),
(2, 'Flexi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_rol`
--

CREATE TABLE `tbl_rol` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_rol`
--

INSERT INTO `tbl_rol` (`id`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Local');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario`
--

CREATE TABLE `tbl_usuario` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`id`, `username`, `password`, `rol_id`, `status`, `name`) VALUES
(1, 'esau@admin', 'f865b53623b121fd34ee5426c792e5c33af8c227', 1, 1, 'Esau Padilla'),
(15, 'ivan_lopez@local', '8cb2237d0679ca88db6464eac60da96345513964', 2, 1, 'ivan lopez');

-- --------------------------------------------------------
--
-- Indices de la tabla `tbl_actividad`
--
ALTER TABLE `tbl_actividad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_cliente`
--
ALTER TABLE `tbl_cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_horario`
--
ALTER TABLE `tbl_horario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `actividad` (`id_activity`),
  ADD KEY `cliente` (`id_client`),
  ADD KEY `sitio` (`id_site`),
  ADD KEY `usuario` (`id_usuario`);

--
-- Indices de la tabla `tbl_lugar`
--
ALTER TABLE `tbl_lugar`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_rol`
--
ALTER TABLE `tbl_rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_rol_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_horario`
--
ALTER TABLE `tbl_horario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_horario`
--
ALTER TABLE `tbl_horario`
  ADD CONSTRAINT `actividad` FOREIGN KEY (`id_activity`) REFERENCES `tbl_actividad` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cliente` FOREIGN KEY (`id_client`) REFERENCES `tbl_cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sitio` FOREIGN KEY (`id_site`) REFERENCES `tbl_lugar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD CONSTRAINT `fk_rol_id` FOREIGN KEY (`rol_id`) REFERENCES `tbl_rol` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

CREATE VIEW `vista_horario` AS SELECT h.id, h.title, h.start, h.end, h.duration, h.ticket, c.name AS client_name, l.site AS site_name, h.description, a.activity AS activity_name, u.name AS user_name FROM `tbl_horario` h LEFT JOIN `tbl_cliente` c ON h.id_client = c.id LEFT JOIN `tbl_lugar` l ON h.id_site = l.id LEFT JOIN `tbl_actividad` a ON h.id_activity = a.id LEFT JOIN `tbl_usuario` u ON h.id_usuario = u.id;

