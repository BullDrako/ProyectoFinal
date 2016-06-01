-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 01-06-2016 a las 23:54:04
-- Versión del servidor: 5.5.49-0ubuntu0.14.04.1
-- Versión de PHP: 5.6.22-1+donate.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `symfony-proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_user`
--

CREATE TABLE IF NOT EXISTS `app_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `upated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_88BDF3E992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_88BDF3E9A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `app_user`
--

INSERT INTO `app_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `created_at`, `upated_at`) VALUES
(1, 'huevón33', 'huevón33', 'pruebassymfonytest@gmail.com', 'pruebassymfonytest@gmail.com', 1, '7xeqemooby804o08goos04888w8844g', '$2y$13$kq.a37vDATz.k.a1gq9Es.KHD/6eqbqYPTx72vHeLG0mqakqiggvO', '2016-06-01 23:38:02', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '2016-02-16 15:43:51', '2016-06-01 23:38:02'),
(2, 'administrador', 'administrador', 'edcafi07@gmail.com', 'edcafi07@gmail.com', 1, '19fionx6d4748cks0ggko08g4ocwo08', '$2y$13$pBSyF0Iw1Xd6sa9YVn8ZAO48yFvXjf6dazI5/OtBPzyB1Nwc2uMOG', '2016-06-01 23:31:38', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 0, NULL, '2016-03-01 16:12:18', '2016-06-01 23:31:38'),
(6, 'jorge', 'jorge', 'symfonyclassgeorge@gmail.com', 'symfonyclassgeorge@gmail.com', 1, '6ujvtderk2skw04owcsscgk8gkgo80s', '$2y$13$d0.cTu0/iZlZLvSmDKHVAu7C4nn4GMHdjT25to3cmySBLBdpRV1CC', '2016-05-27 18:57:41', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '2016-05-27 18:55:55', '2016-05-27 18:57:41'),
(9, 'BullDrako', 'bulldrako', 'ecf_06@hotmail.com', 'ecf_06@hotmail.com', 1, 'fb5ge9ngtlsk0gww8k4c4s4ksc440oc', '$2y$13$xItFQCxXtaBDkj4g15OGO.eIdIpN0Lr/jrWCW1ECqdMpc8Xo6sDoq', '2016-06-01 23:36:42', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '2016-06-01 22:45:19', '2016-06-01 23:36:42'),
(10, 'león21', 'león21', 'edgarcabezafigueras@gmail.com', 'edgarcabezafigueras@gmail.com', 1, '4lz01ebwq680w0ck8o84sk8okw8gsg0', '$2y$13$3VA3Ad2QaUK8UX6pw8uZW.32a9cbsp9gmCRdNh3kHW0Ek8edSqbiO', '2016-06-01 23:37:27', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '2016-06-01 22:49:07', '2016-06-01 23:37:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_4E10122D3A909126` (`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=78 ;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `createdAt`, `updatedAt`) VALUES
(59, 'Amistad', '2016-05-25 22:02:09', '2016-05-25 22:02:09'),
(61, 'Trabajo', '2016-05-26 17:18:11', '2016-05-26 17:18:11'),
(62, 'Estudios', '2016-05-26 19:01:15', '2016-05-26 19:01:15'),
(63, 'Dinero', '2016-05-26 19:01:18', '2016-05-26 19:01:18'),
(64, 'Familia', '2016-05-26 19:01:21', '2016-05-26 19:01:21'),
(65, 'Salud', '2016-05-26 19:01:24', '2016-05-26 19:01:24'),
(72, 'Varios', '2016-05-27 12:04:59', '2016-05-27 12:04:59'),
(73, 'Amor', '2016-05-27 12:05:09', '2016-05-27 12:05:09'),
(74, 'León', '2016-05-27 12:05:29', '2016-05-27 12:05:29'),
(75, 'Huevón', '2016-05-27 12:05:36', '2016-05-27 12:05:36'),
(76, 'Deporte', '2016-05-27 15:56:26', '2016-05-27 15:56:26'),
(77, 'Humor', '2016-05-27 15:56:51', '2016-05-27 15:56:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `autor_id` int(11) DEFAULT NULL,
  `publicacion_id` int(11) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `comentario` longtext COLLATE utf8_unicode_ci NOT NULL,
  `votosPositivos` int(11) NOT NULL,
  `votosNegativos` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4B91E70214D45BBE` (`autor_id`),
  KEY `IDX_4B91E7029ACBB5E7` (`publicacion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=50 ;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`id`, `autor_id`, `publicacion_id`, `createdAt`, `updatedAt`, `comentario`, `votosPositivos`, `votosNegativos`) VALUES
(42, 9, 71, '2016-06-01 23:23:00', '2016-06-01 23:23:00', 'Qué gracia! Vaya crack!!', 0, 0),
(43, 9, 70, '2016-06-01 23:23:38', '2016-06-01 23:23:38', 'A veces hay que callarse!', 0, 0),
(44, 10, 68, '2016-06-01 23:24:50', '2016-06-01 23:24:50', 'Vaya sobre!!', 0, 0),
(45, 1, 72, '2016-06-01 23:28:29', '2016-06-01 23:28:29', 'Gracias por el aviso.', 0, 0),
(46, 9, 72, '2016-06-01 23:28:58', '2016-06-01 23:28:58', 'Ok', 0, 0),
(47, 1, 71, '2016-06-01 23:30:22', '2016-06-01 23:30:22', 'Como se te ocurre decirle eso!!', 0, 0),
(48, 9, 73, '2016-06-01 23:37:12', '2016-06-01 23:37:12', 'Vaya juventud :(', 0, 0),
(49, 10, 73, '2016-06-01 23:37:50', '2016-06-01 23:37:50', 'Esto te pasa por meterte en su conversación.', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logro`
--

CREATE TABLE IF NOT EXISTS `logro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_7439301C3A909126` (`nombre`),
  KEY `IDX_7439301CDB38439E` (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `logro`
--

INSERT INTO `logro` (`id`, `usuario_id`, `nombre`, `descripcion`, `createdAt`, `updatedAt`) VALUES
(1, 2, 'Iniciado', 'Publicar una vez', '2016-05-09 00:00:00', '0000-00-00 00:00:00'),
(2, NULL, 'comentar 1', 'comentar una vez', '2016-05-22 13:37:38', '2016-05-22 13:37:38'),
(3, NULL, 'Publicador', 'Publica 20 veces', '2016-05-22 13:41:29', '2016-05-22 13:41:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacion`
--

CREATE TABLE IF NOT EXISTS `publicacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `autor_id` int(11) DEFAULT NULL,
  `contenido` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `votosNegativos` int(11) NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `image_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `votosPositivos` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_62F2085F14D45BBE` (`autor_id`),
  KEY `IDX_62F2085F7E3C61F9` (`owner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=74 ;

--
-- Volcado de datos para la tabla `publicacion`
--

INSERT INTO `publicacion` (`id`, `autor_id`, `contenido`, `createdAt`, `updatedAt`, `votosNegativos`, `owner_id`, `image_name`, `votosPositivos`) VALUES
(63, 6, 'Mi pronostico para este partido de final de Chamipons es Real Madrid 1 Atletico de Madrid 2 ¿León o Huevón?', '2016-05-27 18:58:36', '2016-05-29 17:09:47', 1, NULL, 'logo-champions-league-39705.jpg', 4),
(66, 1, 'Por 5ª vez este mes, mi novia me deja tirado para ir con sus amigas, haciendo justo lo que teníamos planeado hacer juntos. Yo el 90% de las veces rechazo las propuestas de quedar y salir con mis amigos para que no se sienta mal.  ¿León o Huevón?', '2016-06-01 22:53:45', '2016-06-01 23:31:17', 1, NULL, NULL, 1),
(67, 10, 'Esta noche, mi mujer me ha preguntado qué opinaba sobre qué vestido iba a ponerse. Opiné que debería ponerse a dieta. Escribo esto desde el coche ¿León o Huevón?', '2016-06-01 23:07:07', '2016-06-01 23:31:05', 1, NULL, NULL, 2),
(68, 9, '¿León o Huevón?', '2016-06-01 23:10:24', '2016-06-01 23:30:50', 0, NULL, 'notas.jpg', 1),
(69, 1, 'Desde siempre, mi novia ha sido mi jefa. Desde hace poco me trata fatal en el trabajo pero en casa en la mejor pareja posible. He pensado en dejara, pero necesito el dinero para pagar el último plazo de la moto. Si la dejo de despide ¿León o Huevón?', '2016-06-01 23:14:26', '2016-06-01 23:29:31', 5, NULL, NULL, 0),
(70, 10, 'Ayer, pensando en como se lo diría, le dije a mi mujer que no pensaba ir a la boda de su amiga porque es una pesada y no para de pavonearse y no hablemos del novio. Me relajé mucho al decírselo. Hoy he visto mi maleta en la puerta ¿León o Huevón?', '2016-06-01 23:20:36', '2016-06-01 23:29:40', 2, NULL, NULL, 3),
(71, 10, '¿León o Huevón?', '2016-06-01 23:22:13', '2016-06-01 23:29:49', 1, NULL, 'cochejpg', 2),
(72, 2, '¡Aviso a todos los usuarios! La página está en fase de desarrollo. Con lo cual, si ven alguna modificación inesperada no se alarmen. Atentamente, el Administrador.', '2016-06-01 23:28:01', '2016-06-01 23:28:01', 0, NULL, NULL, 0),
(73, 1, 'Estaba con unos amigos de mi hermano de entre 13-16 años (yo tengo 27). Estábamos pasando por un viaducto y dijeron que sería muy fácil hacer uno y yo respondí que son obras con muchísimos cálculos. Me dijeron "Tú qué sabrás, pringao!" ¿León o Huevón?', '2016-06-01 23:36:20', '2016-06-01 23:41:16', 0, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacion_categoria`
--

CREATE TABLE IF NOT EXISTS `publicacion_categoria` (
  `publicacion_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  PRIMARY KEY (`publicacion_id`,`categoria_id`),
  KEY `IDX_512C82169ACBB5E7` (`publicacion_id`),
  KEY `IDX_512C82163397707A` (`categoria_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `publicacion_categoria`
--

INSERT INTO `publicacion_categoria` (`publicacion_id`, `categoria_id`) VALUES
(63, 63),
(63, 76),
(66, 73),
(66, 75),
(67, 72),
(67, 73),
(67, 74),
(67, 75),
(68, 62),
(68, 74),
(68, 77),
(69, 61),
(69, 63),
(69, 64),
(69, 73),
(69, 75),
(70, 59),
(70, 64),
(70, 73),
(70, 74),
(70, 75),
(71, 64),
(71, 72),
(71, 74),
(71, 77),
(73, 59),
(73, 62);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `FK_4B91E70214D45BBE` FOREIGN KEY (`autor_id`) REFERENCES `app_user` (`id`),
  ADD CONSTRAINT `FK_4B91E7029ACBB5E7` FOREIGN KEY (`publicacion_id`) REFERENCES `publicacion` (`id`);

--
-- Filtros para la tabla `logro`
--
ALTER TABLE `logro`
  ADD CONSTRAINT `FK_7439301CDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `app_user` (`id`);

--
-- Filtros para la tabla `publicacion`
--
ALTER TABLE `publicacion`
  ADD CONSTRAINT `FK_62F2085F14D45BBE` FOREIGN KEY (`autor_id`) REFERENCES `app_user` (`id`),
  ADD CONSTRAINT `FK_62F2085F7E3C61F9` FOREIGN KEY (`owner_id`) REFERENCES `app_user` (`id`);

--
-- Filtros para la tabla `publicacion_categoria`
--
ALTER TABLE `publicacion_categoria`
  ADD CONSTRAINT `FK_512C82163397707A` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_512C82169ACBB5E7` FOREIGN KEY (`publicacion_id`) REFERENCES `publicacion` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
