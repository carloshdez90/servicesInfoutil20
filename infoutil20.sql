-- phpMyAdmin SQL Dump
-- version 3.3.10.4
-- http://www.phpmyadmin.net
--
-- Host: infoutil20db.fernandomarroquin.com
-- Generation Time: Dec 16, 2014 at 07:37 AM
-- Server version: 5.1.56
-- PHP Version: 5.3.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- --------------------------------------------------------

--
-- Table structure for table `CALIFICACION`
--

CREATE TABLE IF NOT EXISTS `CALIFICACION` (
  `IDELEMENTO` char(10) DEFAULT NULL,
  `IDUSUARIO` char(255) DEFAULT NULL,
  `IDCALIFICACION` char(10) NOT NULL,
  `CALIFICACION` int(11) NOT NULL,
  `FECHA` date NOT NULL,
  `CATEGORIA_ID` int(11) NOT NULL,
  `SUBCATEGORIA_ID` int(11) NOT NULL,
  PRIMARY KEY (`IDCALIFICACION`),
  KEY `FK_POSEECALIF` (`IDELEMENTO`),
  KEY `FK_CALIFICA` (`IDUSUARIO`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `CATEGORIA`
--

CREATE TABLE IF NOT EXISTS `CATEGORIA` (
  `IDCATEGORIA` char(10) NOT NULL,
  `NOMBRECATEGORIA` char(50) NOT NULL,
  `DESCRIPCION` varchar(50) NOT NULL,
  PRIMARY KEY (`IDCATEGORIA`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `COMENTARIO`
--

CREATE TABLE IF NOT EXISTS `COMENTARIO` (
  `IDCOMENTARIO` int(10) NOT NULL AUTO_INCREMENT,
  `IDELEMENTO` int(11) NOT NULL,
  `IDSUBCATEGORIA` int(11) NOT NULL,
  `IDCATEGORIA` int(11) NOT NULL,
  `TIPO` int(11) DEFAULT NULL,
  `NOMBREUSUARIO` varchar(50) NOT NULL,
  `COMENTARIO` varchar(160) NOT NULL,
  `EVALUACION` int(11) NOT NULL,
  `FECHA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`IDCOMENTARIO`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=187 ;

-- --------------------------------------------------------

--
-- Table structure for table `DENUNCIA`
--

CREATE TABLE IF NOT EXISTS `DENUNCIA` (
  `IDCATEGORIA` varchar(10) NOT NULL,
  `IDSUBCATEGORIA` varchar(10) NOT NULL,
  `IDELEMENTO` varchar(10) NOT NULL,
  `IDUSUARIO` char(255) DEFAULT NULL,
  `IDDENUNCIA` char(10) NOT NULL,
  `IDTIPO` char(10) DEFAULT NULL,
  PRIMARY KEY (`IDDENUNCIA`),
  KEY `FK_DENUNCIA` (`IDUSUARIO`),
  KEY `FK_POSEETIPO` (`IDTIPO`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ELEMENTO`
--

CREATE TABLE IF NOT EXISTS `ELEMENTO` (
  `IDELEMENTO` char(10) NOT NULL,
  `IDSUBCATEGORIA` char(10) NOT NULL DEFAULT '',
  `IDCATEGORIA` varchar(10) NOT NULL,
  `CANTCOMENTARIOS` int(11) NOT NULL,
  `VISITAS` int(11) DEFAULT NULL,
  `PROMEVALUACION` float NOT NULL,
  `DENUNCIAS` int(11) NOT NULL,
  PRIMARY KEY (`IDELEMENTO`,`IDSUBCATEGORIA`,`IDCATEGORIA`),
  KEY `FK_PERTENECESUB` (`IDSUBCATEGORIA`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `SUBCATEGORIA`
--

CREATE TABLE IF NOT EXISTS `SUBCATEGORIA` (
  `IDSUBCATEGORIA` char(10) NOT NULL,
  `IDCATEGORIA` char(10) DEFAULT NULL,
  `NOMBRESUBCATEGORIA` char(200) NOT NULL,
  PRIMARY KEY (`IDSUBCATEGORIA`),
  KEY `FK_PERTENECECAT` (`IDCATEGORIA`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `TIPODENUNCIA`
--

CREATE TABLE IF NOT EXISTS `TIPODENUNCIA` (
  `IDTIPO` char(10) NOT NULL,
  `IDSUBCATEGORIA` char(10) DEFAULT NULL,
  `DENUNCIA` char(255) NOT NULL,
  PRIMARY KEY (`IDTIPO`),
  KEY `FK_POSEEDENUNC` (`IDSUBCATEGORIA`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `USUARIO`
--

CREATE TABLE IF NOT EXISTS `USUARIO` (
  `IDUSUARIO` char(255) NOT NULL,
  `NOMBRE` char(50) NOT NULL,
  `APELLIDO` char(50) NOT NULL,
  PRIMARY KEY (`IDUSUARIO`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------