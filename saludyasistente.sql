-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 27-11-2024 a las 04:14:24
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `saludyasistente`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `affiliation`
--

CREATE TABLE `affiliation` (
  `idAffiliation` int NOT NULL,
  `typeAffiliation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `affiliation`
--

INSERT INTO `affiliation` (`idAffiliation`, `typeAffiliation`) VALUES
(1, 'EPS'),
(2, 'ARL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incapacity`
--

CREATE TABLE `incapacity` (
  `idIncapacity` int NOT NULL,
  `idAffiliation` int NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci,
  `regimen` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `durationDays` int DEFAULT NULL,
  `idUser` int NOT NULL,
  `statusIncapacity` text COLLATE utf8mb3_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `incapacity`
--

INSERT INTO `incapacity` (`idIncapacity`, `idAffiliation`, `description`, `regimen`, `durationDays`, `idUser`, `statusIncapacity`) VALUES
(4, 2, 'Vacaciones', '', 14, 1, '1'),
(5, 1, '123asd', '', 12, 1, '1'),
(6, 1, '12334', '', 12, 1, '1'),
(7, 1, 'qerw', '', 12, 1, '1'),
(8, 2, 'quuwnis', 'quuwuuru', 12, 1, '1'),
(9, 2, 'quuwnis', 'quuwuuru', 12, 1, '1'),
(10, 2, 'quuwnis', 'quuwuuru', 12, 1, '1'),
(11, 1, 'agwvdavda', 'aduywdvavs', 12, 1, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `people`
--

CREATE TABLE `people` (
  `idPerson` int NOT NULL,
  `Document` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `Names` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `Lastname` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `Email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `Phone` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `Address` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `Gender` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `Birthdate` date DEFAULT NULL,
  `IdTypeDocument` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `people`
--

INSERT INTO `people` (`idPerson`, `Document`, `Names`, `Lastname`, `Email`, `Phone`, `Address`, `Gender`, `Birthdate`, `IdTypeDocument`) VALUES
(6, '1007631122', 'Admin', 'Administrador', 'Admin@gmail.com.co', '3126130091', '', 'male', '2024-11-21', 1),
(7, '1007631122', 'Santiago', 'Alvarez', 'sfelipe188@gmail.com', '3126130091', 'Avenida 4Bello', 'female', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idRol` int NOT NULL,
  `rolDescription` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `statusRol` tinyint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idRol`, `rolDescription`, `statusRol`) VALUES
(1, 'Admin', 1),
(2, 'Empleado ', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `typedocuments`
--

CREATE TABLE `typedocuments` (
  `idTypeDocument` int NOT NULL,
  `Description` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `typedocuments`
--

INSERT INTO `typedocuments` (`idTypeDocument`, `Description`) VALUES
(1, 'DNI'),
(2, 'Passport'),
(3, 'PEP');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `idUser` int NOT NULL,
  `userName` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `PASSWORD` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `statusUser` tinyint DEFAULT NULL,
  `idPerson` int DEFAULT NULL,
  `idRol` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`idUser`, `userName`, `PASSWORD`, `statusUser`, `idPerson`, `idRol`) VALUES
(1, 'Admin', '1234', 1, 6, 1),
(4, 'Salvarez', '1234', 1, 7, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacation`
--

CREATE TABLE `vacation` (
  `idVacation` int NOT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `totalDays` int DEFAULT NULL,
  `statusVacation` tinyint DEFAULT NULL,
  `idUser` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `vacation`
--

INSERT INTO `vacation` (`idVacation`, `startDate`, `endDate`, `totalDays`, `statusVacation`, `idUser`) VALUES
(84, NULL, NULL, NULL, NULL, NULL),
(85, '2024-11-02', '2024-11-07', 5, NULL, 1),
(86, '2024-11-02', '2024-11-07', 5, NULL, 1),
(87, NULL, NULL, NULL, NULL, NULL),
(88, NULL, NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `affiliation`
--
ALTER TABLE `affiliation`
  ADD PRIMARY KEY (`idAffiliation`);

--
-- Indices de la tabla `incapacity`
--
ALTER TABLE `incapacity`
  ADD PRIMARY KEY (`idIncapacity`);

--
-- Indices de la tabla `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`idPerson`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `typedocuments`
--
ALTER TABLE `typedocuments`
  ADD PRIMARY KEY (`idTypeDocument`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`);

--
-- Indices de la tabla `vacation`
--
ALTER TABLE `vacation`
  ADD PRIMARY KEY (`idVacation`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `affiliation`
--
ALTER TABLE `affiliation`
  MODIFY `idAffiliation` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `incapacity`
--
ALTER TABLE `incapacity`
  MODIFY `idIncapacity` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `people`
--
ALTER TABLE `people`
  MODIFY `idPerson` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idRol` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `typedocuments`
--
ALTER TABLE `typedocuments`
  MODIFY `idTypeDocument` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `vacation`
--
ALTER TABLE `vacation`
  MODIFY `idVacation` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
