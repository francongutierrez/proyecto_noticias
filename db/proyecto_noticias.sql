-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-05-2024 a las 23:48:28
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
-- Base de datos: `proyecto_noticias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cambios`
--

CREATE TABLE `cambios` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `realizado_por` int(11) NOT NULL,
  `noticia_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cambios`
--

INSERT INTO `cambios` (`id`, `descripcion`, `fecha`, `hora`, `realizado_por`, `noticia_id`) VALUES
(2, 'Noticia creada', '2024-05-13', '21:17:08', 2, 32),
(3, 'Noticia creada', '2024-05-13', '21:18:22', 2, 33),
(4, 'Noticia creada', '2024-05-13', '21:20:02', 3, 34),
(5, 'Noticia creada', '2024-05-13', '21:21:35', 3, 35),
(6, 'Noticia creada', '2024-05-13', '21:22:49', 5, 36),
(7, 'Noticia creada', '2024-05-13', '21:23:38', 5, 37),
(8, 'Noticia creada', '2024-05-13', '21:24:56', 5, 38),
(9, 'Noticia creada', '2024-05-13', '21:26:00', 6, 39),
(10, 'Noticia creada', '2024-05-13', '21:26:55', 6, 40),
(11, 'Publicada', '2024-05-13', '21:27:06', 6, 32),
(12, 'Publicada', '2024-05-13', '21:28:50', 6, 32),
(13, 'Publicada', '2024-05-13', '21:29:03', 6, 34),
(14, 'Enviada a borradores', '2024-05-13', '22:30:27', 6, 36),
(15, 'Rechazada', '2024-05-13', '22:30:35', 6, 38),
(16, 'Publicada', '2024-05-13', '22:31:44', 7, 40),
(19, 'Edición', '2024-05-13', '22:34:13', 6, 31),
(20, 'Edición', '2024-05-13', '22:35:26', 6, 31),
(21, 'Noticia creada', '2024-05-13', '22:37:10', 6, 41),
(22, 'Noticia creada', '2024-05-13', '22:38:30', 6, 42),
(23, 'Noticia creada', '2024-05-13', '22:40:11', 2, 43),
(24, 'Noticia creada', '2024-05-13', '22:41:23', 2, 44),
(26, 'Edición', '2024-05-13', '22:42:45', 2, 45),
(27, 'Publicada', '2024-05-13', '22:43:14', 7, 43),
(28, 'Publicada', '2024-05-13', '22:43:31', 7, 31),
(29, 'Edición: titulo', '2024-05-14', '22:55:27', 6, 39),
(30, 'Edición: titulo, descripc', '2024-05-14', '22:56:59', 6, 39),
(31, 'Edición: titulo, descripcion', '2024-05-14', '23:02:43', 6, 39),
(32, 'Edición: titulo, descripción, categoria', '2024-05-14', '23:06:04', 6, 39);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Deportes'),
(2, 'Política'),
(3, 'Tecnología'),
(4, 'Entretenimiento'),
(5, 'Cultura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` varchar(2000) NOT NULL,
  `categoria` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `estado` varchar(15) DEFAULT NULL,
  `vigencia` varchar(15) DEFAULT NULL,
  `publicada_automaticamente` int(11) NOT NULL,
  `recien_creada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id`, `titulo`, `descripcion`, `categoria`, `fecha`, `usuario_id`, `imagen`, `estado`, `vigencia`, `publicada_automaticamente`, `recien_creada`) VALUES
(31, 'Presidente firma acuerdo comercial con naciones vecinas en cumbre regional', 'En una cumbre regional histórica, el presidente de una nación sudamericana firmó un acuerdo comercial con países vecinos para fortalecer la integración económica y la cooperación regional. Este pacto busca impulsar el desarrollo y la estabilidad en la región.', 2, '2024-05-13', 6, 'C:\\xampp\\htdocs\\proyecto_noticias\\public\\uploads\\south-america-74073_1284.jpg', 'publicada', 'activa', 0, 0),
(32, 'Descubren antigua ciudad maya bajo selva guatemalteca', 'Arqueólogos han descubierto los restos de una antigua ciudad maya oculta bajo la densa selva de Guatemala. Este hallazgo arroja nueva luz sobre la civilización precolombina y promete revelar secretos enterrados durante siglos.\r\n', 5, '2024-05-12', 2, 'C:\\xampp\\htdocs\\proyecto_noticias\\public\\uploads\\ai-generated-8628821_1280.jpg', 'publicada', 'activa', 0, 0),
(33, 'Equipo nacional gana medalla de oro en los Juegos Olímpicos de Verano', 'El equipo nacional de un país celebró la victoria al ganar la medalla de oro en una emocionante competencia en los Juegos Olímpicos de Verano. Los atletas demostraron su habilidad y dedicación en el escenario mundial, llevando orgullo a su nación.\r\n', 1, '2024-05-11', 2, 'C:\\xampp\\htdocs\\proyecto_noticias\\public\\uploads\\football-8748181_1280.jpg', 'borrador', 'activa', 0, 1),
(34, 'Empresa líder presenta avance revolucionario en inteligencia artificial', 'Una empresa líder en tecnología ha presentado un avance revolucionario en inteligencia artificial que promete transformar diversas industrias. Este desarrollo podría cambiar la forma en que interactuamos con la tecnología y mejorar la eficiencia en múltiples campos.', 3, '2024-05-11', 3, 'C:\\xampp\\htdocs\\proyecto_noticias\\public\\uploads\\ai-generated-8155552_1280.jpg', 'publicada', 'activa', 0, 0),
(35, 'Estrella de cine internacional anuncia su retiro de la actuación', 'Una renombrada estrella de cine internacional ha anunciado su retiro de la actuación después de una exitosa carrera en la industria del entretenimiento. La noticia ha conmovido a sus fans en todo el mundo, quienes celebran sus contribuciones al cine.', 4, '2024-05-12', 3, 'C:\\xampp\\htdocs\\proyecto_noticias\\public\\uploads\\ai-generated-7710720_1280.jpg', 'borrador', 'activa', 0, 1),
(36, 'Reforma educativa es aprobada por el parlamento nacional', 'El parlamento nacional ha aprobado una ambiciosa reforma educativa destinada a mejorar la calidad y accesibilidad de la educación en todo el país. Esta medida representa un paso significativo hacia un sistema educativo más equitativo y efectivo.', 2, '2024-05-12', 5, 'C:\\xampp\\htdocs\\proyecto_noticias\\public\\uploads\\student-8750011_1280.jpg', 'borrador', 'activa', 0, 0),
(37, 'Festival de música electrónica atrae a miles de aficionados internacionales', 'Un festival de música electrónica celebrado en una ciudad europea ha atraído a miles de aficionados de todo el mundo. Con actuaciones de renombrados DJs y artistas, el evento se ha convertido en una experiencia inolvidable para los amantes de la música electrónica.', 5, '2024-05-13', 5, 'C:\\xampp\\htdocs\\proyecto_noticias\\public\\uploads\\ai-generated-8559577_1280.jpg', 'borrador', 'activa', 0, 1),
(38, 'Equipo nacional avanza a la final en campeonato mundial de fútbol', 'El equipo nacional de fútbol de un país ha avanzado a la final en el campeonato mundial, después de una emocionante victoria en las semifinales. Los aficionados están ansiosos por presenciar el enfrentamiento decisivo en la búsqueda del título mundial.', 1, '2024-05-12', 5, 'C:\\xampp\\htdocs\\proyecto_noticias\\public\\uploads\\football-156645_1280.png', 'rechazada', 'desactiva', 0, 0),
(39, 'Startup tecnológica obtiene financiamiento récord para desarrollar vehículos autónomos', 'Una startup tecnológica ha obtenido un financiamiento récord para desarrollar vehículos autónomos de próxima generación. Este respaldo financiero permitirá acelerar la investigación y el desarrollo en el nuevo campo de la conducción autónoma.\r\n', 5, '2024-05-12', 6, 'C:\\xampp\\htdocs\\proyecto_noticias\\public\\uploads\\car-1300629_1280.png', 'borrador', 'activa', 0, 0),
(40, 'Celebridades internacionales asisten a gala benéfica para la conservación del medio ambiente', 'Reconocidas celebridades internacionales se han unido en una gala benéfica para recaudar fondos destinados a la conservación del medio ambiente. El evento ha destacado la importancia de la acción colectiva en la protección de nuestro planeta.\r\n', 2, '2024-05-12', 6, 'C:\\xampp\\htdocs\\proyecto_noticias\\public\\uploads\\recycle-29227_1280.png', 'publicada', 'activa', 0, 0),
(41, 'Líderes mundiales se reúnen en cumbre climática para abordar crisis ambiental', 'En una cumbre climática histórica, líderes mundiales se han reunido para discutir soluciones urgentes ante la crisis ambiental global. El evento busca impulsar acciones concretas para mitigar el cambio climático y proteger el futuro del planeta.', 2, '2024-05-02', 6, 'C:\\xampp\\htdocs\\proyecto_noticias\\public\\uploads\\mountains-1412683_1280.png', 'validar', 'activa', 0, 1),
(42, 'Nuevo museo de arte contemporáneo abre sus puertas en el centro de la ciudad', 'Un nuevo museo de arte contemporáneo ha abierto sus puertas en el corazón de la ciudad, exhibiendo una colección diversa de obras de artistas locales e internacionales. Esta incorporación cultural promete enriquecer la escena artística de la comunidad.\r\n', 5, '2024-05-05', 6, 'C:\\xampp\\htdocs\\proyecto_noticias\\public\\uploads\\castle-1998435_1280.jpg', 'borrador', 'activa', 0, 1),
(43, 'Equipo de investigación descubre posible cura para enfermedad neurodegenerativa', 'Un equipo de investigación ha anunciado el descubrimiento de una posible cura para una enfermedad neurodegenerativa que afecta a millones de personas en todo el mundo. Este avance médico ofrece esperanza a aquellos que sufren de esta condición debilitante.', 3, '2024-05-04', 2, 'C:\\xampp\\htdocs\\proyecto_noticias\\public\\uploads\\laboratory-3827745_1280.jpg', 'publicada', 'activa', 0, 0),
(44, 'Atleta femenina establece nuevo récord mundial en competencia de natación', 'Una destacada atleta femenina ha establecido un nuevo récord mundial en una emocionante competencia de natación. Su impresionante actuación ha inspirado a muchos y ha puesto de relieve el talento y la dedicación en el deporte femenino.\r\n', 1, '2024-03-10', 2, 'C:\\xampp\\htdocs\\proyecto_noticias\\public\\uploads\\woman-422546_1280.jpg', 'validar', 'activa', 0, 1),
(45, 'Exitoso estreno de la esperada película de superhéroes en cines de todo el mundo', 'La esperada película de superhéroes ha tenido un exitoso estreno en cines de todo el mundo, atrayendo a multitudes de fanáticos que esperaban ansiosamente su llegada a la gran pantalla. La película ha recibido elogios por su acción emocionante y efectos visuales fascinantes. ', 4, '2024-05-08', 2, 'C:\\xampp\\htdocs\\proyecto_noticias\\public\\uploads\\comics-999504_1281.jpg', 'validar', 'activa', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(200) NOT NULL,
  `tipo` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`, `tipo`) VALUES
(2, 'juangomez@gmail.com', '$2y$10$xDpzPFT7yDykksCVdz8mNecfrv8mF/C.VAgoHWHfleHQeDP11GLbm', 0),
(3, 'juanavila@gmail.com', '$2y$10$9r4iMLcD4biH6WgrhZsnGOonWYbOwh0mb3mIVtppkO6p56y626iKC', 0),
(5, 'julianalvarez@gmail.com', '$2y$10$L8CdyNgfbRj5k5KHvkpBJumPKnEHjGZD.Baw3tBeCkl3v0Oq0wN4y', 0),
(6, 'juanrodriguez@gmail.com', '$2y$10$51J5BeiVRY9oCTNRcm0YW.ap5/47Zf1CV4eqKOKE8n32t4wZZQYgC', 2),
(7, 'juanperez@gmail.com', '$2y$10$3m3jrKKUlGbIsylXkBPoyeASXY9dWrn8Td/0r3.36Oa497r/m532y', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cambios`
--
ALTER TABLE `cambios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_realizado_por` (`realizado_por`),
  ADD KEY `fk_noticia_id` (`noticia_id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categoria` (`categoria`),
  ADD KEY `fk_noticias_usuarios` (`usuario_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cambios`
--
ALTER TABLE `cambios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cambios`
--
ALTER TABLE `cambios`
  ADD CONSTRAINT `fk_noticia_id` FOREIGN KEY (`noticia_id`) REFERENCES `noticias` (`id`),
  ADD CONSTRAINT `fk_realizado_por` FOREIGN KEY (`realizado_por`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `fk_noticias_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`usuario_proyecto`@`%` EVENT `publicar_noticia_21` ON SCHEDULE AT '2024-05-10 13:21:22' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
                    UPDATE noticias
                    SET estado = 'publicada', publicada_automaticamente = 1
                    WHERE id = 21 AND estado = 'validar';
                
                    -- Insertar registro de cambio
                    INSERT INTO cambios (descripcion, fecha, hora, realizado_por, noticia_id)
                    VALUES ('Noticia publicada automáticamente', CURDATE(), CURTIME(), 0, 21);
                END$$

CREATE DEFINER=`usuario_proyecto`@`%` EVENT `publicar_noticia_27` ON SCHEDULE AT '2024-05-13 20:20:12' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
                    UPDATE noticias
                    SET estado = 'publicada', publicada_automaticamente = 1
                    WHERE id = 21 AND estado = 'validar';
                
                    -- Insertar registro de cambio
                    INSERT INTO cambios (descripcion, fecha, hora, realizado_por, noticia_id)
                    VALUES ('Noticia publicada automáticamente', CURDATE(), CURTIME(), 0, 21);
                END$$

CREATE DEFINER=`usuario_proyecto`@`%` EVENT `finalizar_noticia_27` ON SCHEDULE AT '2024-05-15 20:21:21' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
                UPDATE noticias
                SET estado = 'finalizada', vigencia = 'desactivada'
                WHERE id = 27 AND estado = 'publicada';
        
                -- Insertar registro de cambio
                INSERT INTO cambios (descripcion, relacionado_a, fecha, hora, realizado_por, noticia_id)
                VALUES ('Noticia finalizada automáticamente', 'Noticia', CURDATE(), CURTIME(), 0, 27);
            END$$

CREATE DEFINER=`usuario_proyecto`@`%` EVENT `publicar_noticia_28` ON SCHEDULE AT '2024-05-16 19:45:05' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
                    UPDATE noticias
                    SET estado = 'publicada', publicada_automaticamente = 1
                    WHERE id = 21 AND estado = 'validar';
                
                    -- Insertar registro de cambio
                    INSERT INTO cambios (descripcion, fecha, hora, realizado_por, noticia_id)
                    VALUES ('Noticia publicada automáticamente', CURDATE(), CURTIME(), 0, 21);
                END$$

CREATE DEFINER=`usuario_proyecto`@`%` EVENT `finalizar_noticia_28` ON SCHEDULE AT '2024-05-18 19:50:27' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
                UPDATE noticias
                SET estado = 'finalizada', vigencia = 'desactivada'
                WHERE id = 28 AND estado = 'publicada';
        
                -- Insertar registro de cambio
                INSERT INTO cambios (descripcion, relacionado_a, fecha, hora, realizado_por, noticia_id)
                VALUES ('Noticia finalizada automáticamente', 'Noticia', CURDATE(), CURTIME(), 0, 28);
            END$$

CREATE DEFINER=`usuario_proyecto`@`%` EVENT `publicar_noticia_30` ON SCHEDULE AT '2024-05-16 20:43:31' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
                    UPDATE noticias
                    SET estado = 'publicada', publicada_automaticamente = 1
                    WHERE id = 21 AND estado = 'validar';
                
                    -- Insertar registro de cambio
                    INSERT INTO cambios (descripcion, fecha, hora, realizado_por, noticia_id)
                    VALUES ('Noticia publicada automáticamente', CURDATE(), CURTIME(), 0, 21);
                END$$

CREATE DEFINER=`usuario_proyecto`@`%` EVENT `finalizar_noticia_30` ON SCHEDULE AT '2024-05-18 20:45:32' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
                UPDATE noticias
                SET estado = 'finalizada', vigencia = 'desactivada'
                WHERE id = 30 AND estado = 'publicada';
        
                -- Insertar registro de cambio
                INSERT INTO cambios (descripcion, relacionado_a, fecha, hora, realizado_por, noticia_id)
                VALUES ('Noticia finalizada automáticamente', 'Noticia', CURDATE(), CURTIME(), 0, 30);
            END$$

CREATE DEFINER=`usuario_proyecto`@`%` EVENT `publicar_noticia_32` ON SCHEDULE AT '2024-05-18 21:17:08' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
                    UPDATE noticias
                    SET estado = 'publicada', publicada_automaticamente = 1
                    WHERE id = 21 AND estado = 'validar';
                
                    -- Insertar registro de cambio
                    INSERT INTO cambios (descripcion, fecha, hora, realizado_por, noticia_id)
                    VALUES ('Noticia publicada automáticamente', CURDATE(), CURTIME(), 0, 21);
                END$$

CREATE DEFINER=`usuario_proyecto`@`%` EVENT `publicar_noticia_34` ON SCHEDULE AT '2024-05-18 21:20:02' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
                    UPDATE noticias
                    SET estado = 'publicada', publicada_automaticamente = 1
                    WHERE id = 21 AND estado = 'validar';
                
                    -- Insertar registro de cambio
                    INSERT INTO cambios (descripcion, fecha, hora, realizado_por, noticia_id)
                    VALUES ('Noticia publicada automáticamente', CURDATE(), CURTIME(), 0, 21);
                END$$

CREATE DEFINER=`usuario_proyecto`@`%` EVENT `publicar_noticia_36` ON SCHEDULE AT '2024-05-18 21:22:49' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
                    UPDATE noticias
                    SET estado = 'publicada', publicada_automaticamente = 1
                    WHERE id = 21 AND estado = 'validar';
                
                    -- Insertar registro de cambio
                    INSERT INTO cambios (descripcion, fecha, hora, realizado_por, noticia_id)
                    VALUES ('Noticia publicada automáticamente', CURDATE(), CURTIME(), 0, 21);
                END$$

CREATE DEFINER=`usuario_proyecto`@`%` EVENT `publicar_noticia_38` ON SCHEDULE AT '2024-05-18 21:24:56' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
                    UPDATE noticias
                    SET estado = 'publicada', publicada_automaticamente = 1
                    WHERE id = 21 AND estado = 'validar';
                
                    -- Insertar registro de cambio
                    INSERT INTO cambios (descripcion, fecha, hora, realizado_por, noticia_id)
                    VALUES ('Noticia publicada automáticamente', CURDATE(), CURTIME(), 0, 21);
                END$$

CREATE DEFINER=`usuario_proyecto`@`%` EVENT `publicar_noticia_40` ON SCHEDULE AT '2024-05-18 21:26:55' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
                    UPDATE noticias
                    SET estado = 'publicada', publicada_automaticamente = 1
                    WHERE id = 21 AND estado = 'validar';
                
                    -- Insertar registro de cambio
                    INSERT INTO cambios (descripcion, fecha, hora, realizado_por, noticia_id)
                    VALUES ('Noticia publicada automáticamente', CURDATE(), CURTIME(), 0, 21);
                END$$

CREATE DEFINER=`usuario_proyecto`@`%` EVENT `finalizar_noticia_32` ON SCHEDULE AT '2024-05-20 21:27:06' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
                UPDATE noticias
                SET estado = 'finalizada', vigencia = 'desactivada'
                WHERE id = 32 AND estado = 'publicada';
        
                -- Insertar registro de cambio
                INSERT INTO cambios (descripcion, relacionado_a, fecha, hora, realizado_por, noticia_id)
                VALUES ('Noticia finalizada automáticamente', 'Noticia', CURDATE(), CURTIME(), 0, 32);
            END$$

CREATE DEFINER=`usuario_proyecto`@`%` EVENT `finalizar_noticia_34` ON SCHEDULE AT '2024-05-20 21:29:03' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
                UPDATE noticias
                SET estado = 'finalizada', vigencia = 'desactivada'
                WHERE id = 34 AND estado = 'publicada';
        
                -- Insertar registro de cambio
                INSERT INTO cambios (descripcion, relacionado_a, fecha, hora, realizado_por, noticia_id)
                VALUES ('Noticia finalizada automáticamente', 'Noticia', CURDATE(), CURTIME(), 0, 34);
            END$$

CREATE DEFINER=`usuario_proyecto`@`%` EVENT `finalizar_noticia_40` ON SCHEDULE AT '2024-05-20 22:31:44' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
                UPDATE noticias
                SET estado = 'finalizada', vigencia = 'desactivada'
                WHERE id = 40 AND estado = 'publicada';
        
                -- Insertar registro de cambio
                INSERT INTO cambios (descripcion, relacionado_a, fecha, hora, realizado_por, noticia_id)
                VALUES ('Noticia finalizada automáticamente', 'Noticia', CURDATE(), CURTIME(), 0, 40);
            END$$

CREATE DEFINER=`usuario_proyecto`@`%` EVENT `publicar_noticia_41` ON SCHEDULE AT '2024-05-18 22:37:10' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
                    UPDATE noticias
                    SET estado = 'publicada', publicada_automaticamente = 1
                    WHERE id = 21 AND estado = 'validar';
                
                    -- Insertar registro de cambio
                    INSERT INTO cambios (descripcion, fecha, hora, realizado_por, noticia_id)
                    VALUES ('Noticia publicada automáticamente', CURDATE(), CURTIME(), 0, 21);
                END$$

CREATE DEFINER=`usuario_proyecto`@`%` EVENT `publicar_noticia_43` ON SCHEDULE AT '2024-05-18 22:40:11' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
                    UPDATE noticias
                    SET estado = 'publicada', publicada_automaticamente = 1
                    WHERE id = 21 AND estado = 'validar';
                
                    -- Insertar registro de cambio
                    INSERT INTO cambios (descripcion, fecha, hora, realizado_por, noticia_id)
                    VALUES ('Noticia publicada automáticamente', CURDATE(), CURTIME(), 0, 21);
                END$$

CREATE DEFINER=`usuario_proyecto`@`%` EVENT `publicar_noticia_44` ON SCHEDULE AT '2024-05-18 22:41:23' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
                    UPDATE noticias
                    SET estado = 'publicada', publicada_automaticamente = 1
                    WHERE id = 21 AND estado = 'validar';
                
                    -- Insertar registro de cambio
                    INSERT INTO cambios (descripcion, fecha, hora, realizado_por, noticia_id)
                    VALUES ('Noticia publicada automáticamente', CURDATE(), CURTIME(), 0, 21);
                END$$

CREATE DEFINER=`usuario_proyecto`@`%` EVENT `finalizar_noticia_43` ON SCHEDULE AT '2024-05-20 22:43:14' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
                UPDATE noticias
                SET estado = 'finalizada', vigencia = 'desactivada'
                WHERE id = 43 AND estado = 'publicada';
        
                -- Insertar registro de cambio
                INSERT INTO cambios (descripcion, relacionado_a, fecha, hora, realizado_por, noticia_id)
                VALUES ('Noticia finalizada automáticamente', 'Noticia', CURDATE(), CURTIME(), 0, 43);
            END$$

CREATE DEFINER=`usuario_proyecto`@`%` EVENT `finalizar_noticia_31` ON SCHEDULE AT '2024-05-20 22:43:31' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
                UPDATE noticias
                SET estado = 'finalizada', vigencia = 'desactivada'
                WHERE id = 31 AND estado = 'publicada';
        
                -- Insertar registro de cambio
                INSERT INTO cambios (descripcion, relacionado_a, fecha, hora, realizado_por, noticia_id)
                VALUES ('Noticia finalizada automáticamente', 'Noticia', CURDATE(), CURTIME(), 0, 31);
            END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
