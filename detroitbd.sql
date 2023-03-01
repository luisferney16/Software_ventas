-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 08-02-2021 a las 22:23:50
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
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `Referencia` varchar(20) NOT NULL,
  `Producto` varchar(100) NOT NULL,
  `Precio_Mayor` decimal(10,0) NOT NULL,
  `Proveedor` varchar(50) DEFAULT NULL,
  `Foto` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`Referencia`, `Producto`, `Precio_Mayor`, `Proveedor`, `Foto`) VALUES
('011', 'sueter', '17000', 'manbashe', NULL),
('020', 'sueter', '20000', 'isla', ''),
('SB01', 'sueters basico aritex ', '8600', 'aritex', ''),
('SE01', 'Sueter estampado', '13000', 'aritex', ''),
('SB02', 'Sueter estampado', '17000', 'aritex', ''),
('SB03', 'Sueter estampado', '17000', 'aritex', NULL),
('SB04', 'Sueter estampado', '17000', 'aritex', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
