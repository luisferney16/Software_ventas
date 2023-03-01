-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 25-02-2021 a las 19:48:03
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `detroitbd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dfactura`
--

CREATE TABLE IF NOT EXISTS `dfactura` (
  `IDDetalleFactura` int(11) NOT NULL AUTO_INCREMENT,
  `IDProducto` varchar(20) NOT NULL,
  `Precio` decimal(10,0) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  PRIMARY KEY (`IDDetalleFactura`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mfactura`
--

CREATE TABLE IF NOT EXISTS `mfactura` (
  `IDFactura` int(11) NOT NULL AUTO_INCREMENT,
  `IDDetalleFactura` int(11) NOT NULL,
  `Total` decimal(10,0) NOT NULL,
  `Fecha` date NOT NULL,
  PRIMARY KEY (`IDFactura`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE IF NOT EXISTS `movimientos` (
  `IDMovimiento` int(11) NOT NULL AUTO_INCREMENT,
  `IDProducto` varchar(20) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  PRIMARY KEY (`IDMovimiento`),
  KEY `IDProducto` (`IDProducto`),
  KEY `IDProducto_2` (`IDProducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`IDMovimiento`, `IDProducto`, `Cantidad`, `Fecha`) VALUES
(1, 'SB8', 1, '2021-02-19'),
(2, 'SB8', 10, '0000-00-00'),
(3, 'SE02', 10, '2021-02-02'),
(4, 'SE01', 20, '2021-02-02'),
(5, 'SB02', 50, '2021-02-02'),
(6, 'SB03', 30, '2021-02-02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `Referencia` varchar(20) NOT NULL,
  `Producto` varchar(100) NOT NULL,
  `Precio_Mayor` decimal(10,0) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Proveedor` varchar(50) DEFAULT NULL,
  `Foto` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`Referencia`),
  UNIQUE KEY `Referencia` (`Referencia`),
  KEY `Referencia_2` (`Referencia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`Referencia`, `Producto`, `Precio_Mayor`, `Cantidad`, `Proveedor`, `Foto`) VALUES
('011', 'sueter', '17000', 0, 'manbashe', NULL),
('020', 'sueter', '20000', 0, 'isla', ''),
('030', 'Gorra', '40000', 0, 'fjhh', NULL),
('SB01', 'sueters basico aritex ', '8600', 2, 'aritex', ''),
('SB02', 'Sueter estampado', '17000', 0, 'aritex', ''),
('SB03', 'Sueter estampado', '17000', 0, 'aritex', NULL),
('SB04', 'Sueter estampado', '17000', 0, 'aritex', NULL),
('SB05', 'sudadera', '40000', 0, 'fdfddfr', NULL),
('SB06', 'Perfume', '70000', 0, 'kfhjgujkf', NULL),
('SB07', 'Perfume Dama', '70000', 0, 'kfhjgujkf', NULL),
('SB08', 'Pantaloneta lisa', '80000', 0, 'kjfdhgr', NULL),
('SB11', 'Blusa', '12000', 0, 'aritex', NULL),
('SB8', 'Boxer', '8000', 10, 'Isla', NULL),
('SE01', 'Sueter estampado', '13000', 0, 'aritex', ''),
('SE02', 'Camiseta Dama Basica', '6000', 0, 'Yodais', NULL),
('SE03', 'Gorra Lisa', '8000', 0, 'Centro', NULL),
('SE04', 'Sueter estampado dama', '5000', 0, 'fdfddfr', NULL),
('SE05', 'LICRA', '20000', 0, 'isla', NULL),
('SE06', 'licra niÃ±a', '12000', 0, 'aritex', NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `movimientos_ibfk_2` FOREIGN KEY (`IDProducto`) REFERENCES `productos` (`Referencia`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
