-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-07-2016 a las 18:20:55
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `couchinn`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `idComment` int(11) NOT NULL,
  `pregunta` text CHARACTER SET latin1 NOT NULL,
  `respuesta` text CHARACTER SET latin1 NOT NULL,
  `idCouch` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idDuenio` int(11) NOT NULL,
  `respondido` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`idComment`, `pregunta`, `respuesta`, `idCouch`, `idUsuario`, `idDuenio`, `respondido`) VALUES
(2, 'hola soy luciano', 'kolaaaaaaaaaaaaaaaaaaaaaaaaaa', 35, 2, 4, 0),
(3, 'hola 2do intento de ingresar comentario', 's', 35, 4, 4, 0),
(4, 'hola soy luc y vos?', 'yo soy e duenio del couch, te interesa?\nquizás puedas entender lo qeu me pasa a mi esta noche, ñandú', 28, 4, 2, 0),
(16, 'la re aaa', 'a ver si anda, decime que siiiiiiiiiiiii', 28, 4, 2, 0),
(17, '13 que te parece?\r\n', 'a ver si anda, decime que siiiiiiiiiiiii', 28, 4, 4, 0),
(18, '13 que te parece?\r\n', 'aaaaaaaaaa', 28, 4, 2, 0),
(19, '13 que te parece?\r\n', '', 28, 4, 2, 0),
(20, 'hola, juli', 'juli, hola', 34, 4, 3, 0),
(39, 'hola, que sucedde?', '', 35, 3, 4, 0),
(40, 'holaaaaaaaaaaaaaaaaaaa llanuraaaaaaa', '', 32, 3, 2, 0),
(41, 'hola llanura', '', 32, 3, 2, 0),
(42, 'hola llanura', '', 32, 3, 2, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`idComment`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `idComment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
