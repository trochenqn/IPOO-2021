-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-06-2021 a las 23:20:59
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_teatro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcion`
--

CREATE TABLE `funcion` (
  `idfuncion` int(11) NOT NULL,
  `nombreFuncion` varchar(50) NOT NULL,
  `horarioFuncion` varchar(50) NOT NULL,
  `horarioDuracion` varchar(50) NOT NULL,
  `precio` double(10,2) NOT NULL,
  `id_teatro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `funcion`
--

INSERT INTO `funcion` (`idfuncion`, `nombreFuncion`, `horarioFuncion`, `horarioDuracion`, `precio`, `id_teatro`) VALUES
(283, 'el rey leon', '15:00', '00:55', 500.00, 28),
(288, 'marcos', '14:00', '1:00', 55.00, 28);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obracine`
--

CREATE TABLE `obracine` (
  `idfuncion` int(11) NOT NULL,
  `genero` varchar(50) NOT NULL,
  `paisOrigen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obramusical`
--

CREATE TABLE `obramusical` (
  `idfuncion` int(11) NOT NULL,
  `director` varchar(50) NOT NULL,
  `cantPersona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `obramusical`
--

INSERT INTO `obramusical` (`idfuncion`, `director`, `cantPersona`) VALUES
(283, 'carlos', 35);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obrateatro`
--

CREATE TABLE `obrateatro` (
  `idfuncion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `obrateatro`
--

INSERT INTO `obrateatro` (`idfuncion`) VALUES
(288);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `teatro`
--

CREATE TABLE `teatro` (
  `idteatro` int(11) NOT NULL,
  `nombreTeatro` varchar(50) NOT NULL,
  `direccionTeatro` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `teatro`
--

INSERT INTO `teatro` (`idteatro`, `nombreTeatro`, `direccionTeatro`) VALUES
(28, 'rex', 'av. san martin nro 1050');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `funcion`
--
ALTER TABLE `funcion`
  ADD PRIMARY KEY (`idfuncion`),
  ADD KEY `id_teatro` (`id_teatro`) USING BTREE;

--
-- Indices de la tabla `obracine`
--
ALTER TABLE `obracine`
  ADD PRIMARY KEY (`idfuncion`);

--
-- Indices de la tabla `obramusical`
--
ALTER TABLE `obramusical`
  ADD PRIMARY KEY (`idfuncion`);

--
-- Indices de la tabla `obrateatro`
--
ALTER TABLE `obrateatro`
  ADD PRIMARY KEY (`idfuncion`);

--
-- Indices de la tabla `teatro`
--
ALTER TABLE `teatro`
  ADD PRIMARY KEY (`idteatro`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `funcion`
--
ALTER TABLE `funcion`
  MODIFY `idfuncion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=289;

--
-- AUTO_INCREMENT de la tabla `teatro`
--
ALTER TABLE `teatro`
  MODIFY `idteatro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `funcion`
--
ALTER TABLE `funcion`
  ADD CONSTRAINT `funcion_ibfk_1` FOREIGN KEY (`id_teatro`) REFERENCES `teatro` (`idteatro`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `obracine`
--
ALTER TABLE `obracine`
  ADD CONSTRAINT `obracine_ibfk_1` FOREIGN KEY (`idfuncion`) REFERENCES `funcion` (`idfuncion`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `obramusical`
--
ALTER TABLE `obramusical`
  ADD CONSTRAINT `obramusical_ibfk_1` FOREIGN KEY (`idfuncion`) REFERENCES `funcion` (`idfuncion`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `obrateatro`
--
ALTER TABLE `obrateatro`
  ADD CONSTRAINT `obrateatro_ibfk_1` FOREIGN KEY (`idfuncion`) REFERENCES `funcion` (`idfuncion`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
