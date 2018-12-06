-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:33065
-- Tiempo de generación: 06-12-2018 a las 20:10:49
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `petcommunity`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE `archivos` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `ruta` varchar(100) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `size` int(50) NOT NULL,
  `publicacion` int(11) NOT NULL,
  `filtro` varchar(255) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `archivos`
--

INSERT INTO `archivos` (`id`, `user`, `ruta`, `tipo`, `size`, `publicacion`, `filtro`, `fecha`) VALUES
(1, 1, 'ID-1-NAME-AE0F6B.jpg', 'image/jpeg', 30509, 1, 'kelvin', '2018-12-06 09:12:16'),
(2, 3, 'ID-2-NAME-D39E0B.jpg', 'image/jpeg', 13473, 2, 'gingham', '2018-12-06 11:58:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `idComentario` int(11) NOT NULL,
  `idPublicacion` int(11) NOT NULL,
  `idComentarista` int(11) NOT NULL,
  `Comentario` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

CREATE TABLE `likes` (
  `idLike` int(11) NOT NULL,
  `idPublicacion` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones`
--

CREATE TABLE `publicaciones` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `ubicacion` varchar(255) NOT NULL,
  `fecha` datetime NOT NULL,
  `adopcion` enum('si','no') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `publicaciones`
--

INSERT INTO `publicaciones` (`id`, `user`, `descripcion`, `ubicacion`, `fecha`, `adopcion`) VALUES
(1, 1, 'Perrito en el Atardecer', '', '2018-12-06 09:12:16', 'no'),
(2, 3, 'Busca Hogar mi conejito', '', '2018-12-06 11:58:10', 'si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguidores`
--

CREATE TABLE `seguidores` (
  `idSeguimiento` int(11) NOT NULL,
  `idFollowed` int(11) NOT NULL,
  `idFollower` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `seguidores`
--

INSERT INTO `seguidores` (`idSeguimiento`, `idFollowed`, `idFollower`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` text COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `phone` text COLLATE utf8_unicode_ci,
  `birthday` date DEFAULT NULL,
  `location` text COLLATE utf8_unicode_ci NOT NULL,
  `sex` enum('male','female','other') COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `site_language` bigint(20) UNSIGNED DEFAULT '1',
  `avatar` varchar(225) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default.png',
  `code` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `signup_date` datetime NOT NULL,
  `signup_ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `phone`, `birthday`, `location`, `sex`, `bio`, `site_language`, `avatar`, `code`, `token`, `signup_date`, `signup_ip`) VALUES
(1, 'iBlackFox98', '81dc9bdb52d04dc20036dbd8313ed055', '3cjimenezkerem2014@gmail.com', 'Kerem Jimenez Carmona', '6241220275', '1998-03-04', 'La Paz, Baja California Sur', 'male', NULL, 1, 'ID-1-NAME-021B6C.jpg', '5c0944cc29cda', '', '2018-12-06 08:48:28', NULL),
(2, 'Lipe', '202cb962ac59075b964b07152d234b70', 'Luiis@gmail.com', 'Luis', '64626456264', '2004-04-04', 'La Paz, Baja California Sur', 'male', NULL, 1, 'default.png', '5c0969e6eeda1', '', '2018-12-06 11:26:46', NULL),
(3, 'Pablito Pablito', '81dc9bdb52d04dc20036dbd8313ed055', 'Pablito@hotmail.com', 'Pablo Sarabia Alcala', '6124556556', '2005-01-06', 'La Paz, Baja California Sur', 'male', NULL, 1, 'ID-2-NAME-4CDF5B.jpg', '5c097098cb502', '', '2018-12-06 11:55:20', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`idComentario`);

--
-- Indices de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `seguidores`
--
ALTER TABLE `seguidores`
  ADD PRIMARY KEY (`idSeguimiento`) USING BTREE;

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivos`
--
ALTER TABLE `archivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `idComentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `seguidores`
--
ALTER TABLE `seguidores`
  MODIFY `idSeguimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
