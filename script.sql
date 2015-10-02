SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE DATABASE IF NOT EXISTS `proyectos` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci;
USE `proyectos`;

DELIMITER $$
DROP PROCEDURE IF EXISTS `pCantidadProyectosFecha`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pCantidadProyectosFecha`(
    p_fechaInicioProyecto date,
    OUT contador INT,
    OUT total INT
)
BEGIN
select count(*) into contador from proyectos where fechaInicioProyecto > p_fechaInicioProyecto;
select count(*) into total from proyectos;
END$$

DROP PROCEDURE IF EXISTS `pInsertaProyecto`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pInsertaProyecto`(
    p_codProyecto char(6),
    p_nomProyecto char(20),
    p_nomDepartamento char(20),
    p_fechaInicioProyecto date
)
BEGIN
DECLARE codDepart int;
select codDepartamento into codDepart from departamentos where nomDepartamento = p_nomDepartamento;
INSERT INTO proyectos
VALUES (p_codProyecto,p_nomProyecto,codDepart,p_fechaInicioProyecto);
END$$

DROP PROCEDURE IF EXISTS `pListaProyectosDeptTipo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pListaProyectosDeptTipo`(
    p_nomDepartamento char(20)
)
BEGIN
DECLARE codDepart int;
select codDepartamento into codDepart from departamentos where nomDepartamento = p_nomDepartamento;
select nomProyecto from proyectos where codDepartamento = codDepart;
END$$

DROP FUNCTION IF EXISTS `fCantidadProyectosTipo`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `fCantidadProyectosTipo`(f_nomDepartamento CHAR(20)) RETURNS int(11)
    DETERMINISTIC
BEGIN
DECLARE cantidad int;
SELECT count(*) into cantidad FROM departamentos WHERE nomDepartamento = f_nomDepartamento;
RETURN cantidad;
END$$

DELIMITER ;

DROP TABLE IF EXISTS `departamentos`;
CREATE TABLE IF NOT EXISTS `departamentos` (
  `codDepartamento` int(11) NOT NULL AUTO_INCREMENT,
  `nomDepartamento` char(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`codDepartamento`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=4 ;

INSERT INTO `departamentos` VALUES(1, 'contabilidad');
INSERT INTO `departamentos` VALUES(2, 'Marketing');
INSERT INTO `departamentos` VALUES(3, 'Ventas');

DROP TABLE IF EXISTS `proyectos`;
CREATE TABLE IF NOT EXISTS `proyectos` (
  `codProyecto` char(6) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '',
  `nomProyecto` char(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codDepartamento` int(11) DEFAULT NULL,
  `fechaInicioProyecto` date DEFAULT NULL,
  PRIMARY KEY (`codProyecto`),
  KEY `fk_proyectos_codDepartamento_departamentos` (`codDepartamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO `proyectos` VALUES('1', 'Publicidad', 2, '2014-10-17');
INSERT INTO `proyectos` VALUES('2', 'Cuentas', 1, '2014-10-17');
INSERT INTO `proyectos` VALUES('3', 'Ventas', 3, '2014-10-17');
INSERT INTO `proyectos` VALUES('4', 'Publicidad online', 2, '2014-10-17');
INSERT INTO `proyectos` VALUES('5', 'Ventas online', 3, '2014-10-17');
INSERT INTO `proyectos` VALUES('6', 'Ventas a domicilio', 3, '2014-10-17');
INSERT INTO `proyectos` VALUES('7', 'Liquidacion', 1, '2014-10-17');

DROP TABLE IF EXISTS `trabajadores`;
CREATE TABLE IF NOT EXISTS `trabajadores` (
  `dni` char(12) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '',
  `nombre` char(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `telefono` char(12) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `activo` enum('a','d') COLLATE utf8_spanish2_ci DEFAULT 'a',
  PRIMARY KEY (`dni`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO `trabajadores` VALUES('12345678-a', 'Juan', '922-77-88-99', 'a');
INSERT INTO `trabajadores` VALUES('12345678-n', 'Javier', '922-11-22-33', 'a');
INSERT INTO `trabajadores` VALUES('12345678-z', 'Pepe', '922-44-55-66', 'a');
DROP TRIGGER IF EXISTS `trEliminaTrabajador`;
DELIMITER //
CREATE TRIGGER `trEliminaTrabajador` BEFORE DELETE ON `trabajadores`
 FOR EACH ROW BEGIN
INSERT IGNORE INTO trabajadoresborrados (dni, nombre, telefono, activo)
VALUES (OLD.dni, OLD.nombre, OLD.telefono, 'd');
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `trInsertarTrabajador`;
DELIMITER //
CREATE TRIGGER `trInsertarTrabajador` BEFORE INSERT ON `trabajadores`
 FOR EACH ROW BEGIN
IF NEW.telefono NOT RLIKE '[0-9]{3}-[0-9]{2}-[0-9]{2}-[0-9]{2}'
THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'Error con el formato del telefono';
END IF;
END
//
DELIMITER ;

DROP TABLE IF EXISTS `trabajadoresborrados`;
CREATE TABLE IF NOT EXISTS `trabajadoresborrados` (
  `dni` char(12) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '',
  `nombre` char(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `telefono` char(12) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `activo` enum('a','d') COLLATE utf8_spanish2_ci DEFAULT 'd',
  PRIMARY KEY (`dni`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

DROP TABLE IF EXISTS `trabajadorproyecto`;
CREATE TABLE IF NOT EXISTS `trabajadorproyecto` (
  `dni` char(12) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '',
  `codProyecto` char(6) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '',
  `fechaInicioTrabajador` date DEFAULT NULL,
  PRIMARY KEY (`dni`,`codProyecto`),
  KEY `fk_trabajadorProyecto_codProyecto_proyectos` (`codProyecto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO `trabajadorproyecto` VALUES('12345678-a', '1', '2014-10-17');
INSERT INTO `trabajadorproyecto` VALUES('12345678-a', '2', '2014-10-16');
INSERT INTO `trabajadorproyecto` VALUES('12345678-a', '3', '2014-10-17');
INSERT INTO `trabajadorproyecto` VALUES('12345678-a', '7', '2014-10-17');
INSERT INTO `trabajadorproyecto` VALUES('12345678-n', '1', '2014-10-16');
INSERT INTO `trabajadorproyecto` VALUES('12345678-n', '3', '2014-10-17');
INSERT INTO `trabajadorproyecto` VALUES('12345678-n', '4', '2014-10-17');
INSERT INTO `trabajadorproyecto` VALUES('12345678-n', '5', '2014-10-16');
INSERT INTO `trabajadorproyecto` VALUES('12345678-z', '1', '2014-10-13');
INSERT INTO `trabajadorproyecto` VALUES('12345678-z', '4', '2014-10-15');
INSERT INTO `trabajadorproyecto` VALUES('12345678-z', '6', '2014-10-15');
INSERT INTO `trabajadorproyecto` VALUES('12345678-z', '7', '2014-10-17');


ALTER TABLE `proyectos`
  ADD CONSTRAINT `fk_proyectos_codDepartamento_departamentos` FOREIGN KEY (`codDepartamento`) REFERENCES `departamentos` (`codDepartamento`);

ALTER TABLE `trabajadorproyecto`
  ADD CONSTRAINT `fk_trabajadorProyecto_codProyecto_proyectos` FOREIGN KEY (`codProyecto`) REFERENCES `proyectos` (`codProyecto`),
  ADD CONSTRAINT `fk_trabajadorProyecto_dni_trabajadores` FOREIGN KEY (`dni`) REFERENCES `trabajadores` (`dni`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
