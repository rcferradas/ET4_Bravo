-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-12-2018 a las 21:13:34
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: 'iu2018'
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla 'contratos'
--

CREATE TABLE 'contratos' (
  'cod' varchar(10) NOT NULL,
  'centro' varchar(30) NOT NULL,
  'tipo' enum('certificador','mantenimiento','reparacion','') NOT NULL DEFAULT '',
  'empresa' varchar(30) NOT NULL,
  'documento' varchar(50) NOT NULL,
  'periodoinicio' datetime NOT NULL,
  'periodofin' datetime NOT NULL,
  'importe' decimal(10,3) NOT NULL,
  'estado' enum('completo','incompleto','incidencia','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla 'contratos'
--

INSERT INTO 'contratos' ('cod', 'centro', 'tipo', 'empresa', 'documento', 'periodoinicio', 'periodofin', 'importe', 'estado') VALUES
('a', 'a', '', 'a', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0.000', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla 'contratos'
--
ALTER TABLE 'contratos'
  ADD PRIMARY KEY ('cod');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
