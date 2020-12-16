-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-05-2020 a las 00:05:29
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id_compra` int(5) NOT NULL,
  `id_producto_compra` varchar(5) DEFAULT NULL,
  `id_usuario_compra` int(5) DEFAULT NULL,
  `fecha_compra` date NOT NULL,
  `fecha_entrega` date NOT NULL,
  `devuelto` tinyint(1) DEFAULT 0,
  `hora_compra` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id_compra`, `id_producto_compra`, `id_usuario_compra`, `fecha_compra`, `fecha_entrega`, `devuelto`, `hora_compra`) VALUES
(1, 'AA002', 1, '2020-05-30', '2020-06-06', 1, '20:04:54'),
(2, 'AA002', 1, '2020-05-30', '2020-06-06', 1, '20:04:54'),
(3, 'AB004', 1, '2020-05-30', '2020-06-06', 0, '20:04:55'),
(4, 'ABC01', 1, '2020-05-30', '2020-06-06', 0, '20:04:55'),
(5, 'ABCD3', 1, '2020-05-30', '2020-06-06', 0, '20:04:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` varchar(5) NOT NULL,
  `marca` varchar(100) NOT NULL,
  `modelo` varchar(200) NOT NULL,
  `precio` double(3,1) DEFAULT NULL,
  `anio_creacion` int(4) NOT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `id_proveedor_producto` int(5) DEFAULT NULL,
  `talla` varchar(3) NOT NULL DEFAULT 'M',
  `cantidad` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `marca`, `modelo`, `precio`, `anio_creacion`, `foto`, `id_proveedor_producto`, `talla`, `cantidad`) VALUES
('AA001', 'Bomber Nagato', 'Cruiser', 34.7, 2017, 'images/Bomber Nagato.jpg', 1, 'S', 20),
('AA002', 'Bomber Nagato', 'Cruiser', 34.7, 2017, 'images/Bomber Nagato.jpg', 1, 'M', 21),
('AA003', 'Bomber Nagato', 'Cruiser', 34.7, 2017, 'images/Bomber Nagato.jpg', 1, 'L', 20),
('AA004', 'Bomber Nagato', 'Cruiser', 34.7, 2017, 'images/Bomber Nagato.jpg', 1, 'XL', 20),
('AB001', 'Bomber Ronin', 'Stallion', 45.8, 2020, 'images/Bomber ronin.png', 2, 'S', 20),
('AB002', 'Bomber Ronin', 'Stallion', 45.8, 2020, 'images/Bomber ronin.png', 2, 'M', 20),
('AB003', 'Bomber Ronin', 'Stallion', 45.8, 2020, 'images/Bomber ronin.png', 2, 'L', 20),
('AB004', 'Bomber Ronin', 'Stallion', 45.8, 2020, 'images/Bomber ronin.png', 2, 'XL', 19),
('ABC01', 'Bomber verde', 'Crusher', 78.9, 2018, 'images/Bomber verde.jpg', 3, 'S', 39),
('ABC02', 'Bomber verde', 'Crusher', 78.9, 2018, 'images/Bomber verde.jpg', 3, 'M', 40),
('ABC03', 'Bomber verde', 'Crusher', 78.9, 2018, 'images/Bomber verde.jpg', 3, 'L', 40),
('ABC04', 'Bomber verde', 'Crusher', 78.9, 2018, 'images/Bomber verde.jpg', 3, 'XL', 40),
('ABCD1', 'Camiseta jutsu', 'Crow', 54.2, 2017, 'images/Camiseta jutsu.jpg', 1, 'S', 40),
('ABCD2', 'Camiseta jutsu', 'Crow', 54.2, 2017, 'images/Camiseta jutsu.jpg', 1, 'M', 40),
('ABCD3', 'Camiseta jutsu', 'Crow', 54.2, 2017, 'images/Camiseta jutsu.jpg', 1, 'L', 39),
('ABCD4', 'Camiseta jutsu', 'Crow', 54.2, 2017, 'images/Camiseta jutsu.jpg', 1, 'XL', 40),
('XA001', 'Camiseta kawaguchi', 'Strider', 80.0, 2017, 'images/Camiseta kawaguchi.jpg', 2, 'S', 10),
('XA002', 'Camiseta kawaguchi', 'Strider', 80.0, 2017, 'images/Camiseta kawaguchi.jpg', 2, 'M', 10),
('XA003', 'Camiseta kawaguchi', 'Strider', 80.0, 2017, 'images/Camiseta kawaguchi.jpg', 2, 'L', 10),
('XA004', 'Camiseta kawaguchi', 'Strider', 80.0, 2017, 'images/Camiseta kawaguchi.jpg', 2, 'XL', 10),
('XAB01', 'Camiseta raijin', 'Kiri', 55.5, 2019, 'images/Camiseta raijin.jpg', 3, 'S', 30),
('XAB02', 'Camiseta raijin', 'Kiri', 55.5, 2019, 'images/Camiseta raijin.jpg', 3, 'M', 30),
('XAB03', 'Camiseta raijin', 'Kiri', 55.5, 2019, 'images/Camiseta raijin.jpg', 3, 'L', 30),
('XAB04', 'Camiseta raijin', 'Kiri', 55.5, 2019, 'images/Camiseta raijin.jpg', 3, 'XL', 30),
('XABC1', 'Camiseta red sakura', 'Stomper', 76.8, 2018, 'images/Camiseta red sakura.jpg', 1, 'S', 45),
('XABC2', 'Camiseta red sakura', 'Stomper', 76.8, 2018, 'images/Camiseta red sakura.jpg', 1, 'M', 45),
('XABC3', 'Camiseta red sakura', 'Stomper', 76.8, 2018, 'images/Camiseta red sakura.jpg', 1, 'L', 45),
('XABC4', 'Camiseta red sakura', 'Stomper', 76.8, 2018, 'images/Camiseta red sakura.jpg', 1, 'XL', 45);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(5) NOT NULL,
  `nif` varchar(9) DEFAULT NULL,
  `nombre_proveedor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `nif`, `nombre_proveedor`) VALUES
(1, '4343465D', 'High Entity'),
(2, '9025625C', 'Hagakure Do'),
(3, '8349245D', 'Nagato');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(5) NOT NULL,
  `dni` varchar(9) DEFAULT NULL,
  `nombre_usuario` varchar(100) NOT NULL,
  `user` varchar(20) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `trabajador` tinyint(1) DEFAULT 0,
  `productos_comprados` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `dni`, `nombre_usuario`, `user`, `pass`, `trabajador`, `productos_comprados`) VALUES
(1, '4334554Y', 'Mario Barzola', 'usuario_1', '122b738600a0f74f7c331c0ef59bc34c', 0, 2),
(2, '7543823Y', 'Lara Valenzuela', 'trabajador_1', 'da01242ca949263cde1967d81e51a33c', 1, 0),
(3, '1875324G', 'Remi Bonjaski', 'usuario_2', '2fb6c8d2f3842a5ceaa9bf320e649ff0', 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `fk_producto` (`id_producto_compra`),
  ADD KEY `fk_usuario` (`id_usuario_compra`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `fk_proveedor` (`id_proveedor_producto`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`),
  ADD UNIQUE KEY `nif` (`nif`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `dni` (`dni`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id_compra` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fk_producto` FOREIGN KEY (`id_producto_compra`) REFERENCES `producto` (`id_producto`),
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`id_usuario_compra`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_proveedor` FOREIGN KEY (`id_proveedor_producto`) REFERENCES `proveedor` (`id_proveedor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
