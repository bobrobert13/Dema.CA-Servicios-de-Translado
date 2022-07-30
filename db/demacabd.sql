-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 02, 2018 at 12:38 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demacabd`
--

-- --------------------------------------------------------

--
-- Table structure for table `chofer`
--

DROP TABLE IF EXISTS `chofer`;
CREATE TABLE IF NOT EXISTS `chofer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(12) NOT NULL,
  `nombreCompleto` varchar(200) NOT NULL,
  `dirreccion` varchar(300) NOT NULL,
  `telf` varchar(12) NOT NULL,
  `estado` varchar(13) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `precios`
--

DROP TABLE IF EXISTS `precios`;
CREATE TABLE IF NOT EXISTS `precios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idTraslado` int(11) NOT NULL,
  `salida` varchar(50) NOT NULL,
  `horaSalida` time NOT NULL,
  `Llegada` varchar(50) NOT NULL,
  `horaLlegada` time NOT NULL,
  `precio` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `solicitud`
--

DROP TABLE IF EXISTS `solicitud`;
CREATE TABLE IF NOT EXISTS `solicitud` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombrePasajero` varchar(50) NOT NULL,
  `chofer` varchar(50) NOT NULL,
  `fechaChofer` date NOT NULL,
  `veiculo` varchar(50) NOT NULL,
  `horaVeiculo` time NOT NULL,
  `detalles` varchar(50) NOT NULL,
  `estado` varchar(13) NOT NULL,
  `fechaTransito` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCompleto` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `nombreUsuario` varchar(50) NOT NULL,
  `contrasena` varchar(50) NOT NULL,
  `estado` varchar(13) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombreCompleto`, `correo`, `nombreUsuario`, `contrasena`, `estado`) VALUES
(1, 'admin', 'admin@admin.admin', 'admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `veiculo`
--

DROP TABLE IF EXISTS `veiculo`;
CREATE TABLE IF NOT EXISTS `veiculo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricula` varchar(20) NOT NULL,
  `capacidad` varchar(3) NOT NULL,
  `tipo` varchar(200) NOT NULL,
  `estado` varchar(13) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
