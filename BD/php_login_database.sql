-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-04-2024 a las 23:05:08
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `php_login_database`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competidores`
--

CREATE TABLE `competidores` (
  `id` int(11) NOT NULL,
  `nombres` varchar(250) NOT NULL,
  `apellidoPaterno` varchar(250) NOT NULL,
  `apellidoMaterno` varchar(250) NOT NULL,
  `categoria` varchar(250) NOT NULL,
  `peso` varchar(50) NOT NULL,
  `gimnasio` varchar(250) NOT NULL,
  `imagen` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `competidores`
--

INSERT INTO `competidores` (`id`, `nombres`, `apellidoPaterno`, `apellidoMaterno`, `categoria`, `peso`, `gimnasio`, `imagen`) VALUES
(3, 'Angel Said', 'Silva', 'Contreras', 'Classic Fat', '105', 'Gimnasio Kamogawa', '1713658750_ippo-makana.jpg'),
(4, '', 'Silva', 'Contreras', 'Classic Fat', '89', 'Gimnasio Kamogawa', '1713652298_cheems.jpg'),
(5, '', 'Silva', 'Contreras', 'Classic Fat', '89', 'Gimnasio Kamogawa', '1713652688_cheems.jpg'),
(6, '', 'Marin', 'Nurin', 'Classic Physic', '63', 'Gimnasio Kamogawa', '1713654609_cheems.jpg'),
(8, 'Chris', 'de anda', 'trejo', 'Classic Physic', '73', 'el de la esquina', '1713753444_levantamiento-de-pesas.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `competidores`
--
ALTER TABLE `competidores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `competidores`
--
ALTER TABLE `competidores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
