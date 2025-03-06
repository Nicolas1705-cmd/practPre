-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-02-2025 a las 22:55:10
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
-- Base de datos: `dbwce2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcargo`
--

CREATE TABLE `tcargo` (
  `idCargo` tinyint(1) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tcargo`
--

INSERT INTO `tcargo` (`idCargo`, `name`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'EMPLEADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tnotify`
--

CREATE TABLE `tnotify` (
  `idnotify` int(10) NOT NULL,
  `idPersonal` int(10) DEFAULT NULL,
  `typemessage` tinyint(1) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `idProvider` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tnotify`
--

INSERT INTO `tnotify` (`idnotify`, `idPersonal`, `typemessage`, `status`, `idProvider`) VALUES
(1, 1, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tpersonal`
--

CREATE TABLE `tpersonal` (
  `idPersonal` int(10) NOT NULL,
  `names` varchar(70) NOT NULL,
  `idCargo` tinyint(1) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `dateRegister` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tpersonal`
--

INSERT INTO `tpersonal` (`idPersonal`, `names`, `idCargo`, `email`, `password`, `status`, `dateRegister`) VALUES
(1, 'Jorge Andres', 1, 'andres@gmail.com', '$2y$10$.2tv9Wg.bP6v2QMADskA/OrW/SsM2NovA3CpJ1t.DltzBAYtAC.7S', 1, '2025-02-05 16:39:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tplaca`
--

CREATE TABLE `tplaca` (
  `idplaca` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  `codigo` varchar(8) NOT NULL,
  `marcavh` varchar(20) NOT NULL,
  `modelo` varchar(20) NOT NULL,
  `serie` varchar(25) NOT NULL,
  `motor` varchar(15) NOT NULL,
  `combustible` varchar(15) NOT NULL,
  `yearf` year(4) NOT NULL,
  `ne` int(11) NOT NULL,
  `nr` int(11) NOT NULL,
  `na` int(11) NOT NULL,
  `np` int(11) NOT NULL,
  `laa` varchar(30) NOT NULL,
  `pneto` decimal(12,2) NOT NULL,
  `pbruto` decimal(12,2) NOT NULL,
  `putil` decimal(12,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tplaca`
--

INSERT INTO `tplaca` (`idplaca`, `name`, `codigo`, `marcavh`, `modelo`, `serie`, `motor`, `combustible`, `yearf`, `ne`, `nr`, `na`, `np`, `laa`, `pneto`, `pbruto`, `putil`, `status`) VALUES
(1, '45E-rt4', 'wce234', 'toyota', 'for3ww3', 'fr12', 'vr55', 'diesel', '2010', 275, 544, 265, 547, '4545/5545/554', 600.00, 600.00, 800.00, 1),
(2, 'C8K-915', 'VH1', 'KIA', 'K2700', 'KNCSE911267127752', 'J2438310', 'Diesel', '2005', 2, 6, 3, 2, '5.22/1.87/2.59', 2000.00, 3450.00, 1450.00, 1),
(3, 'F5N-933', 'VH3', 'SHINERAY', 'SY5020', 'LSYFJD2D8DG251277', 'DL465Q5033907', 'Gasolina', '2013', 2, 4, 2, 1, '4.592/1.5/2.1', 950.00, 1820.00, 870.00, 1),
(4, 'B6F-794', 'VH4', 'KIA', 'K2700', 'KNCS1X73AC7634420', 'D4BHB075121', 'Diesel', '2011', 2, 6, 3, 2, '5.04/1.88/2.70', 2000.00, 3350.00, 1350.00, 1),
(5, 'AUR-864', 'VH6', 'HYUNDAI', 'HD78', 'KMFGA17PPHC313105', 'D4DDGJ637408', 'Diesel', '2017', 2, 6, 3, 2, '7.02/2.30/3.55', 4275.00, 7800.00, 3525.00, 1),
(6, 'AUR-894', 'VH7', 'HYUNDAI', 'HD78', 'KMFGA17PPHC313104', 'D4DDGJ637439', 'Diesel', '2017', 2, 6, 3, 2, '7.02/2.30/3.55', 4275.00, 7800.00, 3525.00, 1),
(7, 'AUR-736', 'VH8', 'HYUNDAI', 'HD120', 'KMFLA18KPJC108984', 'D6GAHJ218020', 'Diesel', '2017', 2, 6, 3, 2, '8.85/2.60/3.95', 6000.00, 12520.00, 6520.00, 1),
(8, '123', '23', '21312', '3123', '21321', '3123', '12312', '1924', 22, 2, 2, 2, '2', 2.00, 2.00, 2.00, 1),
(9, 'dasd', 'asda', 'dsad', 'asdasd', 'dasd', 'adass', 'asda', '2028', 23423, 234, 3424, 234, '423', 23423.00, 234.00, 234.00, 0),
(10, 'a', '342', '4234', '32423423', '423', '4234', '23432', '1927', 324, 2342, 3423, 423, '234', 2342.00, 34.00, 234.00, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tcargo`
--
ALTER TABLE `tcargo`
  ADD PRIMARY KEY (`idCargo`);

--
-- Indices de la tabla `tnotify`
--
ALTER TABLE `tnotify`
  ADD PRIMARY KEY (`idnotify`),
  ADD KEY `idPersonal` (`idPersonal`),
  ADD KEY `idProvider` (`idProvider`);

--
-- Indices de la tabla `tpersonal`
--
ALTER TABLE `tpersonal`
  ADD PRIMARY KEY (`idPersonal`),
  ADD KEY `idCargo` (`idCargo`);

--
-- Indices de la tabla `tplaca`
--
ALTER TABLE `tplaca`
  ADD PRIMARY KEY (`idplaca`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tcargo`
--
ALTER TABLE `tcargo`
  MODIFY `idCargo` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tnotify`
--
ALTER TABLE `tnotify`
  MODIFY `idnotify` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tpersonal`
--
ALTER TABLE `tpersonal`
  MODIFY `idPersonal` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tplaca`
--
ALTER TABLE `tplaca`
  MODIFY `idplaca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tpersonal`
--
ALTER TABLE `tpersonal`
  ADD CONSTRAINT `tpersonal_ibfk_1` FOREIGN KEY (`idCargo`) REFERENCES `tcargo` (`idCargo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
