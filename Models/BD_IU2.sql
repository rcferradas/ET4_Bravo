-- Bravo - 17/01/2019
-- script de creación de la bd
-- creación de tabla e insert sobre la misma.
--
-- CREAR LA BD BORRANDOLA SI YA EXISTIESE
--
DROP DATABASE IF EXISTS `IU2018`;
CREATE DATABASE `IU2018` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
--
-- SELECCIONAMOS PARA USAR
--
USE `IU2018`;
--
-- DAMOS PERMISO USO Y BORRAMOS EL USUARIO QUE QUEREMOS CREAR POR SI EXISTE
--
GRANT USAGE ON * . * TO `iu2018`@`localhost`;
	DROP USER `iu2018`@`localhost`;
--
-- CREAMOS EL USUARIO Y LE DAMOS PASSWORD,DAMOS PERMISO DE USO Y DAMOS PERMISOS SOBRE LA BASE DE DATOS.
--
CREATE USER IF NOT EXISTS `iu2018`@`localhost` IDENTIFIED BY 'pass2018';
GRANT USAGE ON *.* TO `iu2018`@`localhost` REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
GRANT ALL PRIVILEGES ON `IU2018`.* TO `iu2018`@`localhost` WITH GRANT OPTION;
--
-- Estructura de tabla para la tabla `datos`
--
CREATE TABLE IF NOT EXISTS `USUARIOS` (

`login` varchar(15),
`password` varchar(128) NOT NULL,
`DNI` varchar(9),
`nombre` varchar(30) NOT NULL,
`apellidos` varchar(50) NOT NULL,
`telefono` varchar(11) NOT NULL,
`email` varchar(60),
`rol` enum('admin', 'centro') NOT NULL,

PRIMARY KEY (`login`),
UNIQUE KEY `DNI` (`DNI`),
UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Base de datos: `iu2018`
--

-- Estructura de tabla para la tabla `empresas`
CREATE TABLE IF NOT EXISTS `empresas` (
  `CIF` varchar(10),
  `nombre` varchar(30) NOT NULL,
  `tipo` enum('certificador','mantenimiento','reparacion','') NOT NULL DEFAULT '',
  `telefono` varchar(30) NOT NULL,
  `localizacion` varchar(50) NOT NULL,
PRIMARY KEY (`CIF`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Estructura de tabla para la tabla `centro`
CREATE TABLE IF NOT EXISTS `centros` (
  `nombre` varchar(30),
  `lugar` varchar(30) NOT NULL,
  `usuarioAsignado` varchar(15),
PRIMARY KEY (`nombre`),
FOREIGN KEY (`usuarioAsignado`) REFERENCES `USUARIOS`(`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Estructura de tabla para la tabla `contratos`
CREATE TABLE IF NOT EXISTS `contratos` (
  `cod` INT(10) NOT NULL AUTO_INCREMENT,
  `centro` varchar(30),
  `tipo` enum('certificador','mantenimiento','reparacion','') NOT NULL DEFAULT '',
  `estado` enum('realizado','norealizado','pagado','') NOT NULL DEFAULT '',
  `cifEmpresa` varchar(10),
  `documento` varchar(50) NOT NULL,
  `periodoinicio` date NOT NULL,
  `periodofin` date NOT NULL,
  `frecuenciaVisitas` enum('diaria','semanal','mensual','trimestral','anual','quinquenal') NOT NULL DEFAULT 'anual',
  `importe` DEC(10,2) NOT NULL,
PRIMARY KEY (`cod`),
FOREIGN KEY (`cifEmpresa`) REFERENCES `empresas`(`CIF`)
              ON DELETE CASCADE,
FOREIGN KEY (`centro`) REFERENCES `centros`(`nombre`)
              ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- Tabla visitas
CREATE TABLE IF NOT EXISTS `visitas` (
  `codVisita` INT(10) NOT NULL,
  `estado` enum('realizada','pendiente','incidencia', '') NOT NULL DEFAULT '',
  `tipo` enum('certificador','mantenimiento','reparacion','') NOT NULL DEFAULT '',
  `codContrato` INT (10),
  `informe` varchar(120),
  `fecha` date NOT NULL,
  `frutoVisitaProg` INT(10),
PRIMARY KEY (`codVisita`),
FOREIGN KEY (`frutoVisitaProg`) REFERENCES `visitas`(`codVisita`)
                  ON DELETE CASCADE,
FOREIGN KEY (`codContrato`) REFERENCES `contratos`(`cod`)
                  ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
