-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-04-2024 a las 02:56:18
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rentcar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `sexo` enum('M','F') NOT NULL,
  `whatsapp` varchar(20) DEFAULT NULL,
  `correo` varchar(100) NOT NULL,
  `telefonol` varchar(20) DEFAULT NULL,
  `telefono2` varchar(20) DEFAULT NULL,
  `estado` enum('activo','inactivo') NOT NULL,
  `tipo_identificacion` varchar(50) NOT NULL,
  `numero_identificacion` varchar(20) NOT NULL,
  `usuario_registro` varchar(50) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_modificado` varchar(50) DEFAULT NULL,
  `fecha_modificado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `apellido`, `sexo`, `whatsapp`, `correo`, `telefonol`, `telefono2`, `estado`, `tipo_identificacion`, `numero_identificacion`, `usuario_registro`, `fecha_registro`, `usuario_modificado`, `fecha_modificado`) VALUES
(1, 'Juan', 'Pérez', 'M', '5551234567', 'juanperez@example.com', '5558889999', '5557776666', 'inactivo', 'CC', '1234567890', 'usuario_ejemplo', '2024-04-10 10:10:35', NULL, NULL),
(2, 'María', 'Gómez', 'F', '5552345678', 'mariagomez@example.com', '5559998888', '5556665555', 'activo', 'TI', '9876543210', 'usuario_ejemplo', '2024-04-10 10:10:35', NULL, NULL),
(3, 'Ga', 'Apellido', 'M', '1234567890', 'correo@example.com', '9876543210', '5678901234', 'activo', 'DNI', '12345678', 'usuario_admin', '2024-04-04 10:00:00', 'usuario_admin', '2024-04-10 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallefactura`
--

CREATE TABLE `detallefactura` (
  `idfacturadetalle` int(11) NOT NULL,
  `idfactura` int(11) DEFAULT NULL,
  `idvehiculo` int(11) DEFAULT NULL,
  `monto` decimal(10,2) DEFAULT NULL,
  `descuento` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detallefactura`
--

INSERT INTO `detallefactura` (`idfacturadetalle`, `idfactura`, `idvehiculo`, `monto`, `descuento`) VALUES
(1, 1, 1, 1000.00, 999.99),
(2, 2, 2, 10000.00, 999.99);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `idempresa` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`idempresa`, `nombre`, `estado`, `idusuario`) VALUES
(1, '', 'A', 0),
(2, 'm', 'A', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `idfactura` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `idcliente` int(11) DEFAULT NULL,
  `monto` decimal(10,2) DEFAULT NULL,
  `descuento` decimal(5,2) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `idgastos` int(11) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `monto` decimal(10,2) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

CREATE TABLE `ingresos` (
  `idingreso` int(11) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `monto` decimal(10,2) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reparaciones`
--

CREATE TABLE `reparaciones` (
  `idreparacion` int(11) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `idvehiculo` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservacion`
--

CREATE TABLE `reservacion` (
  `idreservacion` int(11) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `fechainicio` date DEFAULT NULL,
  `fechafin` date DEFAULT NULL,
  `idcliente` int(11) DEFAULT NULL,
  `idvehiculo` int(11) DEFAULT NULL,
  `monto` decimal(10,2) DEFAULT NULL,
  `descuento` decimal(5,2) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `fecharegistro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `idsucursal` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `idempresa` int(11) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`idsucursal`, `nombre`, `estado`, `idempresa`, `idusuario`) VALUES
(1, 'Gabrielll', 'I', 1, 1),
(2, 'Gabriel', 'A', 1, 1),
(3, 'Gabriel', 'A', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `clave` varchar(255) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `tipo_usuario` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `usuario`, `clave`, `estado`, `tipo_usuario`) VALUES
(1, 'jeremy', 'jeremy', '1234', 'A', 'ADM'),
(2, 'inmortus', 'inmortus', '1234', 'A', 'USR'),
(3, 'ramatut', 'ramatut', '1234', 'A', 'ADM'),
(4, 'Gabriel', 'Gabriel', '1234', 'A', 'ADM'),
(5, 'prueba', 'prueba', '1234', 'A', 'ADM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `idvehiculo` int(11) NOT NULL,
  `marca` varchar(100) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `chasis` varchar(100) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `combustible` varchar(50) DEFAULT NULL,
  `modelo` int(11) DEFAULT NULL,
  `ultimomantenimiento` date DEFAULT NULL,
  `seguro` varchar(100) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `segurovence` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`idvehiculo`, `marca`, `nombre`, `descripcion`, `estado`, `chasis`, `color`, `combustible`, `modelo`, `ultimomantenimiento`, `seguro`, `idusuario`, `fecha`, `segurovence`) VALUES
(1, 'bmwww', 'x6', 'El BMW X6 es un automóvil todoterreno de gran lujo...', 'A', 'M', 'Azul', 'Gasolina', 555, '0000-00-00', 'full', 1, '0000-00-00', '0000-00-00'),
(2, 'bmw', 'x6', 'El BMW X6 es un automóvil todoterreno de gran lujo del segmento E del fabricante alemán BMW, que salió a la venta en enero de 2008 junto con su presentación en el salón del Automóvil de Detroit.', 'A', 'M', 'Azul', 'gasolina', 123, '0000-00-00', 'full', 1, '2024-02-01', '2024-02-24'),
(3, 'bmw', 'x6', 'El BMW X6 es un automóvil todoterreno de gran lujo...', 'A', 'M', 'Azul', 'Gasolina', 555, '0000-00-00', 'full', 1, '0000-00-00', '0000-00-00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD PRIMARY KEY (`idfacturadetalle`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`idempresa`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`idfactura`);

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`idgastos`);

--
-- Indices de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD PRIMARY KEY (`idingreso`);

--
-- Indices de la tabla `reparaciones`
--
ALTER TABLE `reparaciones`
  ADD PRIMARY KEY (`idreparacion`);

--
-- Indices de la tabla `reservacion`
--
ALTER TABLE `reservacion`
  ADD PRIMARY KEY (`idreservacion`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`idsucursal`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`idvehiculo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  MODIFY `idfacturadetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `idempresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `idfactura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `idgastos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  MODIFY `idingreso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reparaciones`
--
ALTER TABLE `reparaciones`
  MODIFY `idreparacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reservacion`
--
ALTER TABLE `reservacion`
  MODIFY `idreservacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `idsucursal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `idvehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
