-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-05-2024 a las 07:50:53
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `areropuerto2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aerolinea`
--

CREATE TABLE `aerolinea` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `pais_origen` varchar(100) DEFAULT NULL,
  `contacto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `aerolinea`
--

INSERT INTO `aerolinea` (`id`, `nombre`, `pais_origen`, `contacto`) VALUES
(8, 'latam2', 'peruanos', '5612856'),
(9, 'latam', 'peru', '1256856415642');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avion`
--

CREATE TABLE `avion` (
  `id` int(11) NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `aerolinea_id` int(11) DEFAULT NULL,
  `capacidad_pasajeros` int(11) DEFAULT NULL,
  `ano_fabricacion` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `avion`
--

INSERT INTO `avion` (`id`, `modelo`, `aerolinea_id`, `capacidad_pasajeros`, `ano_fabricacion`) VALUES
(10, 'kya', 9, 20, '2004'),
(11, 'mi openhaimer', 8, 30, '2004'),
(12, 'mi openhaimer', 9, 20, '2000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `piloto`
--

CREATE TABLE `piloto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `aerolinea_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `piloto`
--

INSERT INTO `piloto` (`id`, `nombre`, `apellido`, `aerolinea_id`) VALUES
(10, 'carlos', 'perez', 8),
(11, 'christian', 'sanclemente', 9),
(12, 'carlos', 'sanclemente', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `id` int(11) NOT NULL,
  `vuelo_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`id`, `vuelo_id`, `usuario_id`) VALUES
(32, 23, 21),
(33, 23, 20),
(34, 24, 21),
(35, 26, 21),
(36, 26, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `correo_electronico` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `nacionalidad` varchar(100) DEFAULT NULL,
  `contrasena` varchar(255) NOT NULL,
  `rol` enum('usuario','administrador') NOT NULL DEFAULT 'usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `correo_electronico`, `telefono`, `fecha_nacimiento`, `nacionalidad`, `contrasena`, `rol`) VALUES
(20, 'paulina', 'sanchez', 'admin@gmail.com', '3014848268', '2024-05-20', 'argentina', 'dd8f12d3a14f56bb03b6bbf8afe7c6d7', 'administrador'),
(21, 'christian', 'sanclemente', 'usuario@gmail.com', '3014848268', '2024-05-13', 'colombia', 'dd8f12d3a14f56bb03b6bbf8afe7c6d7', 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vuelo`
--

CREATE TABLE `vuelo` (
  `id` int(11) NOT NULL,
  `numero_vuelo` varchar(50) NOT NULL,
  `aerolinea_id` int(11) DEFAULT NULL,
  `avion_id` int(11) DEFAULT NULL,
  `piloto_id` int(11) DEFAULT NULL,
  `origen` varchar(100) DEFAULT NULL,
  `destino` varchar(100) DEFAULT NULL,
  `hora_salida` datetime DEFAULT NULL,
  `hora_llegada` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vuelo`
--

INSERT INTO `vuelo` (`id`, `numero_vuelo`, `aerolinea_id`, `avion_id`, `piloto_id`, `origen`, `destino`, `hora_salida`, `hora_llegada`) VALUES
(23, '1', 8, 11, 10, 'okinawa', 'ecuador', '2024-05-26 12:39:00', '2024-05-27 12:39:00'),
(24, '2', 9, 10, 11, 'colombia', 'ecuador', '2024-05-24 12:48:00', '2024-05-26 12:49:00'),
(25, '3', 9, 10, 11, 'colombia', 'ecuador', '2024-05-17 17:11:00', '2024-05-18 17:11:00'),
(26, '4', 9, 10, 11, 'okinawa', 'ecuador', '2024-05-23 10:15:00', '2024-05-25 10:15:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aerolinea`
--
ALTER TABLE `aerolinea`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `avion`
--
ALTER TABLE `avion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aerolinea_id` (`aerolinea_id`);

--
-- Indices de la tabla `piloto`
--
ALTER TABLE `piloto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aerolinea_id` (`aerolinea_id`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vuelo_id` (`vuelo_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vuelo`
--
ALTER TABLE `vuelo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aerolinea_id` (`aerolinea_id`),
  ADD KEY `avion_id` (`avion_id`),
  ADD KEY `piloto_id` (`piloto_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aerolinea`
--
ALTER TABLE `aerolinea`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `avion`
--
ALTER TABLE `avion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `piloto`
--
ALTER TABLE `piloto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `vuelo`
--
ALTER TABLE `vuelo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `avion`
--
ALTER TABLE `avion`
  ADD CONSTRAINT `avion_ibfk_1` FOREIGN KEY (`aerolinea_id`) REFERENCES `aerolinea` (`id`);

--
-- Filtros para la tabla `piloto`
--
ALTER TABLE `piloto`
  ADD CONSTRAINT `piloto_ibfk_1` FOREIGN KEY (`aerolinea_id`) REFERENCES `aerolinea` (`id`);

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`vuelo_id`) REFERENCES `vuelo` (`id`),
  ADD CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `vuelo`
--
ALTER TABLE `vuelo`
  ADD CONSTRAINT `vuelo_ibfk_1` FOREIGN KEY (`aerolinea_id`) REFERENCES `aerolinea` (`id`),
  ADD CONSTRAINT `vuelo_ibfk_2` FOREIGN KEY (`avion_id`) REFERENCES `avion` (`id`),
  ADD CONSTRAINT `vuelo_ibfk_3` FOREIGN KEY (`piloto_id`) REFERENCES `piloto` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
