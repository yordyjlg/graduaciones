-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-02-2016 a las 00:24:43
-- Versión del servidor: 5.5.27-log
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `graduaciones`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE IF NOT EXISTS `actividades` (
  `id_actividades` int(11) NOT NULL AUTO_INCREMENT,
  `hora` varchar(45) DEFAULT NULL,
  `actividad` varchar(45) DEFAULT NULL,
  `lugar` varchar(45) DEFAULT NULL,
  `fecha` varchar(45) DEFAULT NULL,
  `id_Cronograma` int(11) NOT NULL,
  PRIMARY KEY (`id_actividades`),
  KEY `fk_actividades_cronograma1_idx` (`id_Cronograma`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id_actividades`, `hora`, `actividad`, `lugar`, `fecha`, `id_Cronograma`) VALUES
(1, '10:00', 'misa', 'iglesia', '2014-10-03', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE IF NOT EXISTS `almacen` (
  `idalmacen` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_producto` varchar(45) DEFAULT NULL,
  `cantidad` varchar(45) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  PRIMARY KEY (`idalmacen`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`idalmacen`, `nombre_producto`, `cantidad`, `precio`) VALUES
(11, 'TÍTULO', 'N/A', 500),
(12, 'DIPLOMA', 'N/A', 250),
(13, 'MEDALLA', 'N/A', 300),
(14, 'BOTÓN', 'N/A', 50),
(15, 'LLAVERO', 'N/A', 50),
(16, 'VIDEO', 'N/A', 100),
(17, 'FOTOS TAMAÑO 10X15 CM', 'N/A', 150),
(18, 'FOTOS TAMAÑO 20X25 CM', 'N/A', 200),
(19, 'ARREGLOS FLORALES', 'N/A', 16.8),
(20, 'MISA DE GRADUACIÓN', 'N/A', 50),
(21, 'ALQUILER DE TOGA Y BIRRETE', '1600', 100),
(22, 'PLACA DE RECONOCIMIENTO', 'N/A', 400),
(23, 'ÁLBUM UNIVERSITARIO CON OVALO EXTRA LUJO', 'N/A', 150),
(25, 'PORTA TÍTULO FORRADO EN PERCALINA CON LOGO', 'N/A', 250),
(28, 'Mejor producto', '2000', 3500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato`
--

CREATE TABLE IF NOT EXISTS `contrato` (
  `idcontrato` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` varchar(45) DEFAULT NULL,
  `pago_idpago` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcontrato`),
  KEY `fk_contrato_pago1_idx` (`pago_idpago`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacion`
--

CREATE TABLE IF NOT EXISTS `cotizacion` (
  `idcotizacion` int(11) NOT NULL,
  `num_graduandos` varchar(45) DEFAULT NULL,
  `bs` varchar(45) DEFAULT NULL,
  `estatus` varchar(45) DEFAULT NULL,
  `usuario_ci_usuario` varchar(45) DEFAULT NULL,
  `fecha` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idcotizacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cronograma`
--

CREATE TABLE IF NOT EXISTS `cronograma` (
  `id_Cronograma` int(11) NOT NULL AUTO_INCREMENT,
  `TituloCrono` varchar(45) DEFAULT NULL,
  `Universidad_idUniversidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_Cronograma`),
  KEY `fk_Cronograma_Universidad1_idx` (`Universidad_idUniversidad`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `cronograma`
--

INSERT INTO `cronograma` (`id_Cronograma`, `TituloCrono`, `Universidad_idUniversidad`) VALUES
(1, 'cronograma 2014 agosto', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deposito`
--

CREATE TABLE IF NOT EXISTS `deposito` (
  `numero_deposito` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `monto` varchar(45) DEFAULT NULL,
  `banco` varchar(45) DEFAULT NULL,
  `numero_cuenta` varchar(45) DEFAULT NULL,
  `pago_idpago` int(11) DEFAULT NULL,
  PRIMARY KEY (`numero_deposito`),
  KEY `fk_doposito_pago1_idx` (`pago_idpago`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galeria`
--

CREATE TABLE IF NOT EXISTS `galeria` (
  `idGaleria` int(11) NOT NULL AUTO_INCREMENT,
  `Imagen` varchar(45) DEFAULT NULL,
  `Universidad_idUniversidad` int(11) DEFAULT NULL,
  `directorio` varchar(45) NOT NULL,
  PRIMARY KEY (`idGaleria`),
  KEY `fk_Galeria_Universidad1_idx` (`Universidad_idUniversidad`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Volcado de datos para la tabla `galeria`
--

INSERT INTO `galeria` (`idGaleria`, `Imagen`, `Universidad_idUniversidad`, `directorio`) VALUES
(27, 'CIMG1154.JPG', 4, 'galeria'),
(28, 'CIMG1170.JPG', 4, 'galeria'),
(29, 'CIMG1169.JPG', 4, 'galeria'),
(30, 'CIMG1163.JPG', 4, 'galeria'),
(31, 'CIMG1219.JPG', 4, 'galeria'),
(32, 'CIMG1184.JPG', 4, 'galeria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacion`
--

CREATE TABLE IF NOT EXISTS `notificacion` (
  `idNotificacion` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_ci_usuario` int(11) DEFAULT NULL,
  `productos_idproductos` int(11) DEFAULT NULL,
  `estatus` varchar(45) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `fecha` varchar(45) DEFAULT NULL,
  `montoBs` float NOT NULL,
  PRIMARY KEY (`idNotificacion`),
  KEY `fk_Notificacion_usuario1_idx` (`usuario_ci_usuario`),
  KEY `fk_notificacion_productos1_idx` (`productos_idproductos`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `notificacion`
--

INSERT INTO `notificacion` (`idNotificacion`, `usuario_ci_usuario`, `productos_idproductos`, `estatus`, `cantidad`, `fecha`, `montoBs`) VALUES
(2, 241260101, 125, 'VISTOUSU', 100, '2015-10-10', 500),
(3, 241260101, 127, 'Enviado', 20, '2015-12-07', 0),
(4, 241260101, 124, 'Enviado', 10, '2015-12-13', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones_mesajes`
--

CREATE TABLE IF NOT EXISTS `notificaciones_mesajes` (
  `idNotf` int(11) NOT NULL AUTO_INCREMENT,
  `mensaje` varchar(45) NOT NULL,
  `idNotificaciones` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `estatus` varchar(15) NOT NULL,
  `usuario_ci_usuario` int(11) NOT NULL,
  PRIMARY KEY (`idNotf`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `notificaciones_mesajes`
--

INSERT INTO `notificaciones_mesajes` (`idNotf`, `mensaje`, `idNotificaciones`, `fecha`, `estatus`, `usuario_ci_usuario`) VALUES
(1, 'cuanto', 2, '2015-10-10', '', 241260101),
(2, 'Somos un grupo de estudiantes interesados.', 3, '2015-12-07', '', 241260101),
(15, 'Lo necesitamos urgente', 3, '2015-12-13', '', 241260101),
(16, 'dentro de una semana', 4, '2015-12-13', '', 24126010),
(17, 'si.', 2, '2015-12-16', '', 24126010),
(18, '1000', 2, '2016-01-02', '', 24126010);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE IF NOT EXISTS `pago` (
  `idpago` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_ci_usuario` int(11) DEFAULT NULL,
  `idPaquete` int(11) NOT NULL,
  PRIMARY KEY (`idpago`),
  KEY `fk_pago_usuario1_idx` (`usuario_ci_usuario`),
  KEY `fk_pago_paquete1_idx` (`idPaquete`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete`
--

CREATE TABLE IF NOT EXISTS `paquete` (
  `idPaquete` int(11) NOT NULL AUTO_INCREMENT,
  `NombrePaquete` varchar(45) DEFAULT NULL,
  `informacion` varchar(45) DEFAULT NULL,
  `monto` float DEFAULT NULL,
  `fecha_tope_contrato` date DEFAULT NULL,
  `numgraduand` int(10) NOT NULL,
  `estatus` varchar(45) NOT NULL,
  PRIMARY KEY (`idPaquete`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquetes_grados`
--

CREATE TABLE IF NOT EXISTS `paquetes_grados` (
  `idpaquetes_grados` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idpaquetes_grados`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `paquetes_grados`
--

INSERT INTO `paquetes_grados` (`idpaquetes_grados`, `nombre`, `imagen`) VALUES
(4, 'Paquete A', 'stark_house.jpg'),
(5, 'Paquete B', 'gantz_00272958.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete_productos`
--

CREATE TABLE IF NOT EXISTS `paquete_productos` (
  `idpaquete_productos` int(11) NOT NULL AUTO_INCREMENT,
  `paquete_idPaquete` int(11) DEFAULT NULL,
  `almacen_idalmacen` int(11) DEFAULT NULL,
  PRIMARY KEY (`idpaquete_productos`),
  KEY `fk_paquete_productos_paquete1` (`paquete_idPaquete`),
  KEY `fk_paquete_productos_almacen1` (`almacen_idalmacen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `idproductos` int(11) NOT NULL AUTO_INCREMENT,
  `NombreProd` varchar(45) DEFAULT NULL,
  `DescripcionPro` varchar(245) DEFAULT NULL,
  `ImagenPro` varchar(45) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idproductos`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=129 ;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idproductos`, `NombreProd`, `DescripcionPro`, `ImagenPro`, `tipo`) VALUES
(122, 'Anillo 1', 'El mejor anillo, para todos exelente precio', 'gantz_00272958.jpg', 'ANILLO'),
(123, 'Anillo 2', 'Some default panel content here. Nulla vitae elit libero, a pharetra augue. Aenean lacinia bibendum nulla sed consectetur. Aenean eu leo quam.', 'anillo.jpg', 'ANILLO'),
(124, 'Anillo 3s', 'Some default panel content here. Nulla vitae elit libero, a pharetra augue. Aenean lacinia bibendum nulla sed consectetur. Aenean eu leo quam.s', 'Gantz_full_color_by_uchihaZero.jpg', 'ANILLO'),
(125, 'Anillo 4', 'Some default panel content here. Nulla vitae elit libero, a pharetra augue. Aenean lacinia bibendum nulla sed consectetur. Aenean eu leo quam.', 'stark_house.jpg', 'ANILLO'),
(126, 'Anillo 5', 'Some default panel content here. Nulla vitae elit libero, a pharetra augue. Aenean lacinia bibendum nulla sed consectetur. Aenean eu leo quam.', 'foto.jpg', 'ANILLO'),
(127, 'medalla ', 'For performance reasons, all icons require a base class and individual icon class. To use, place the following code just about anywhere. Be sure to leave a space between the icon and text for proper padding.', 'medallas.jpg', 'MEDALLA'),
(128, 'medalla 1', 'For performance reasons, all icons require a base class and individual icon class. To use, place the following code just about anywhere. Be sure to leave a space between the icon and text for proper padding.', 'DSC_0491.JPG', 'MEDALLA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_pqt`
--

CREATE TABLE IF NOT EXISTS `productos_pqt` (
  `almacen_idalmacen` int(11) NOT NULL,
  `grados_idpaquetes_grados` int(11) NOT NULL,
  PRIMARY KEY (`almacen_idalmacen`,`grados_idpaquetes_grados`),
  KEY `fk_productos_pqt_paquetes_grados1_idx` (`grados_idpaquetes_grados`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos_pqt`
--

INSERT INTO `productos_pqt` (`almacen_idalmacen`, `grados_idpaquetes_grados`) VALUES
(14, 4),
(15, 4),
(16, 4),
(17, 4),
(20, 4),
(21, 4),
(22, 4),
(23, 4),
(25, 4),
(28, 4),
(14, 5),
(15, 5),
(16, 5),
(17, 5),
(22, 5),
(23, 5),
(25, 5),
(28, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_cotizacion`
--

CREATE TABLE IF NOT EXISTS `product_cotizacion` (
  `cotizacion_idcotizacion` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `almacen_idalmacen` int(11) NOT NULL,
  PRIMARY KEY (`cotizacion_idcotizacion`,`almacen_idalmacen`),
  KEY `fk_product_cotizacion_almacen1_idx` (`almacen_idalmacen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_presupuesto`
--

CREATE TABLE IF NOT EXISTS `solicitud_presupuesto` (
  `idsolicitud_presupuesto` int(11) NOT NULL AUTO_INCREMENT,
  `numero_graduandos` varchar(45) DEFAULT NULL,
  `bs` varchar(45) DEFAULT NULL,
  `estatus` varchar(45) DEFAULT NULL,
  `idpaquetes_grados` int(11) NOT NULL,
  `ci_usuario` int(11) NOT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idsolicitud_presupuesto`),
  KEY `fk_solicitud_presupuesto_paquetes_grados1_idx` (`idpaquetes_grados`),
  KEY `fk_solicitud_presupuesto_usuario1_idx` (`ci_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `solicitud_presupuesto`
--

INSERT INTO `solicitud_presupuesto` (`idsolicitud_presupuesto`, `numero_graduandos`, `bs`, `estatus`, `idpaquetes_grados`, `ci_usuario`, `fecha`) VALUES
(1, '50', NULL, 'ENVIADO', 4, 241260101, '2015-12-07 02:51:29'),
(2, '50', NULL, 'ENVIADO', 4, 241260101, '2015-12-07 03:01:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `universidad`
--

CREATE TABLE IF NOT EXISTS `universidad` (
  `idUniversidad` int(11) NOT NULL AUTO_INCREMENT,
  `NombreUniversidad` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `Paquete_idPaquete` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idUniversidad`),
  KEY `fk_Universidad_Paquete1_idx` (`Paquete_idPaquete`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `universidad`
--

INSERT INTO `universidad` (`idUniversidad`, `NombreUniversidad`, `direccion`, `Paquete_idPaquete`, `estado`) VALUES
(4, 'UPTNMLS', 'CARIPITO', NULL, 1),
(5, 'UPT PUNTA DE MATA', 'PUNTA DE MATA', NULL, 1),
(6, 'UDO', 'MATURIN', NULL, 1),
(8, 'UBV', 'CARUPANO', NULL, 1),
(9, 'NOSEe', 'NOSE', NULL, 1),
(10, 'prueba', 'prueba', NULL, 1),
(11, 'prueba1', 'prueba1', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `ci_usuario` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Apellido` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `ciudad` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `institucion` int(11) DEFAULT NULL,
  `NombreUsuario` varchar(45) DEFAULT NULL,
  `Clave` varchar(45) DEFAULT NULL,
  `estatus` int(11) DEFAULT NULL,
  `especialidad` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ci_usuario`),
  KEY `fk_usuario_universidad1_idx` (`institucion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ci_usuario`, `Nombre`, `Apellido`, `telefono`, `email`, `ciudad`, `direccion`, `institucion`, `NombreUsuario`, `Clave`, `estatus`, `especialidad`) VALUES
(24126010, 'yordy', 'lopez', '24587548754', 'yordyjlg@gmail.com', 'maturin', 'quiriquire', 4, 'yordy', '49301478cbe0fda806e59201324741a0', 666, 'informatica'),
(24126012, 'JAVIERSV', 'LOPEZSV', '04164547545', 'YORDYJLG@GMAIL.COM', 'MATURIN', 'QUIRIQUIRE', 6, 'JAVIERSV', 'ce2d416546df2c7de38c73539c726b9675feb7ba', 1, 'INFORMATICA'),
(241260101, 'javier', 'lopez', '04165487548', 'yordyjlg@hotmail.com', 'maturin', 'quiriquire', 4, 'javier', '3c9c03d6008a5adf42c2a55dd4a1a9f2', 1, 'informatica');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `fk_actividades_cronograma1` FOREIGN KEY (`id_Cronograma`) REFERENCES `cronograma` (`id_Cronograma`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD CONSTRAINT `fk_contrato_pago1` FOREIGN KEY (`pago_idpago`) REFERENCES `pago` (`idpago`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cronograma`
--
ALTER TABLE `cronograma`
  ADD CONSTRAINT `fk_Cronograma_Universidad1` FOREIGN KEY (`Universidad_idUniversidad`) REFERENCES `universidad` (`idUniversidad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `deposito`
--
ALTER TABLE `deposito`
  ADD CONSTRAINT `fk_doposito_pago1` FOREIGN KEY (`pago_idpago`) REFERENCES `pago` (`idpago`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `galeria`
--
ALTER TABLE `galeria`
  ADD CONSTRAINT `fk_Galeria_Universidad1` FOREIGN KEY (`Universidad_idUniversidad`) REFERENCES `universidad` (`idUniversidad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD CONSTRAINT `fk_notificacion_productos1` FOREIGN KEY (`productos_idproductos`) REFERENCES `productos` (`idproductos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Notificacion_usuario1` FOREIGN KEY (`usuario_ci_usuario`) REFERENCES `usuario` (`ci_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `fk_pago_paquete1` FOREIGN KEY (`idPaquete`) REFERENCES `paquete` (`idPaquete`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pago_usuario1` FOREIGN KEY (`usuario_ci_usuario`) REFERENCES `usuario` (`ci_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `paquete_productos`
--
ALTER TABLE `paquete_productos`
  ADD CONSTRAINT `fk_paquete_productos_almacen1` FOREIGN KEY (`almacen_idalmacen`) REFERENCES `almacen` (`idalmacen`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_paquete_productos_paquete1` FOREIGN KEY (`paquete_idPaquete`) REFERENCES `paquete` (`idPaquete`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos_pqt`
--
ALTER TABLE `productos_pqt`
  ADD CONSTRAINT `fk_productos_pqt_almacen1` FOREIGN KEY (`almacen_idalmacen`) REFERENCES `almacen` (`idalmacen`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_productos_pqt_paquetes_grados1` FOREIGN KEY (`grados_idpaquetes_grados`) REFERENCES `paquetes_grados` (`idpaquetes_grados`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `product_cotizacion`
--
ALTER TABLE `product_cotizacion`
  ADD CONSTRAINT `fk_product_cotizacion_almacen1` FOREIGN KEY (`almacen_idalmacen`) REFERENCES `almacen` (`idalmacen`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_product_cotizacion_cotizacion1` FOREIGN KEY (`cotizacion_idcotizacion`) REFERENCES `cotizacion` (`idcotizacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `solicitud_presupuesto`
--
ALTER TABLE `solicitud_presupuesto`
  ADD CONSTRAINT `fk_solicitud_presupuesto_paquetes_grados1` FOREIGN KEY (`idpaquetes_grados`) REFERENCES `paquetes_grados` (`idpaquetes_grados`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_solicitud_presupuesto_usuario1` FOREIGN KEY (`ci_usuario`) REFERENCES `usuario` (`ci_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `universidad`
--
ALTER TABLE `universidad`
  ADD CONSTRAINT `fk_Universidad_Paquete1` FOREIGN KEY (`Paquete_idPaquete`) REFERENCES `paquete` (`idPaquete`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_universidad1` FOREIGN KEY (`institucion`) REFERENCES `universidad` (`idUniversidad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
