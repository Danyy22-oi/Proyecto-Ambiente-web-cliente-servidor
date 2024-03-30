-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-03-2024 a las 02:27:13
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `Id_Carrito` int(11) NOT NULL,
  `Id_Usuario` int(11) NOT NULL,
  `Id_Producto` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `Id_Categoria` int(11) NOT NULL,
  `Descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`Id_Categoria`, `Descripcion`) VALUES
(1, 'Hombres'),
(2, 'Mujeres'),
(3, 'Accesorios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

CREATE TABLE `direccion` (
  `id_direccion` int(11) NOT NULL,
  `direccion_1` varchar(255) DEFAULT NULL,
  `direccio_2` varchar(255) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `Id_Factura` int(11) NOT NULL,
  `Id_Producto` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Precio` decimal(10,0) NOT NULL,
  `Total` decimal(10,0) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `Id_Producto` int(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Descripcion` varchar(255) NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Imagen` varchar(255) DEFAULT NULL,
  `Id_Categoria` int(11) NOT NULL,
  `Id_Proveedor` int(11) NOT NULL,
  `Id_Subcategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`Id_Producto`, `Nombre`, `Descripcion`, `Precio`, `Imagen`, `Id_Categoria`, `Id_Proveedor`, `Id_Subcategoria`) VALUES
(64, 'Tacon de Cenicienta', 'Hermosos tacones tipo cenicienta para una ocasión especial', 35000.00, 'https://img.freepik.com/fotos-premium/zapatos-mujer-hd-8k-fondo-pantalla-imagen-fotografica-archivo_890746-23894.jpg', 2, 3, 5),
(65, 'Tenis Nike deportivas', 'Tenis deportivos para hacer ejercicio.', 50000.00, 'https://cdn.pixabay.com/photo/2016/11/19/18/06/feet-1840619_1280.jpg', 2, 5, 1),
(66, 'Tenis Jordan', 'Tenis Jordan marca Nike', 70000.00, 'https://media.gq.com.mx/photos/61d470c5619ec7f7ff2376ab/16:9/w_2560%2Cc_limit/Air-Jordan-2022.jpg', 1, 5, 1),
(67, 'Collar de Corazones', 'Hermoso collar de corazones perfecto para cualquier ocasión.', 15000.00, 'https://cdn-media.glamira.com/media/catalog/category/product_image_top_banner_colliers.jpg', 3, 3, 6),
(68, 'Choker negro', 'Collar tipo Choker de lencería color negro.', 15000.00, 'https://i.etsystatic.com/11105354/r/il/16d751/2783828756/il_570xN.2783828756_lmoz.jpg', 3, 3, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_talla`
--

CREATE TABLE `producto_talla` (
  `Id_Talla` int(11) NOT NULL,
  `Id_Producto` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `producto_talla`
--

INSERT INTO `producto_talla` (`Id_Talla`, `Id_Producto`, `Cantidad`) VALUES
(3, 64, 5),
(4, 64, 2),
(5, 64, 3),
(9, 65, 5),
(10, 65, 5),
(11, 65, 5),
(10, 66, 5),
(11, 66, 10),
(12, 66, 10),
(14, 67, 5),
(13, 68, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `Id_Proveedor` int(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`Id_Proveedor`, `Nombre`, `Logo`) VALUES
(3, 'Calzados Emme', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTXNezspNVM_wSkMqMtdeblXx7EU4u5UNUgaXdz0qxL9w&s'),
(4, 'Adidas', 'https://upload.wikimedia.org/wikipedia/commons/2/24/Adidas_logo.png'),
(5, 'Nike', 'https://upload.wikimedia.org/wikipedia/commons/3/36/Logo_nike_principal.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre_rol`) VALUES
(1, 'admin'),
(2, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria`
--

CREATE TABLE `subcategoria` (
  `id_SubCategoria` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `subcategoria`
--

INSERT INTO `subcategoria` (`id_SubCategoria`, `nombre`, `descripcion`, `status`) VALUES
(1, 'Zapatos Deportivos', 'Zapatos diseñados para actividades deportivas.', 1),
(2, 'Zapatos Formales', 'Zapatos adecuados para ocasiones formales o de negocios.', 1),
(5, 'Zapatos de Tacón', 'Zapatos con tacón alto, generalmente usados por mujeres.', 1),
(6, 'Collares', 'Accesorios para el cuello, generalmente hechos de diferentes materiales.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tallas`
--

CREATE TABLE `tallas` (
  `Id_Talla` int(11) NOT NULL,
  `Descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tallas`
--

INSERT INTO `tallas` (`Id_Talla`, `Descripcion`) VALUES
(1, 'Talla 32'),
(2, 'Talla 33'),
(3, 'Talla 34'),
(4, 'Talla 35'),
(5, 'Talla 36'),
(6, 'Talla 37'),
(7, 'Talla 38'),
(8, 'Talla 39'),
(9, 'Talla 40'),
(10, 'Talla 41'),
(11, 'Talla 42'),
(12, 'Talla 43'),
(13, 'XS'),
(14, 'S'),
(15, 'M'),
(16, 'L');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `correo` varchar(250) NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `correo`, `telefono`, `contrasena`, `id_rol`) VALUES
(1, 'Luis Daniel', 'Pérez Sánchez', 'ldperez.0711@gmail.com', '86239520', '$2y$10$8o7TajdZ.AkB4wskmA2/6uzLdXTlJ/WjQ2nf8Ai/6psLBCupZM.0i', 1),
(2, 'Karla', 'Badilla Gutierrez', 'karlabadilla@gmail.com', '86239520', '$2y$10$smOeLJPlj3jT87Ckyh9npe4eIUHhGXCWxk/NSFqCx.cjYU/pnTz9u', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`Id_Carrito`),
  ADD KEY `FK_CARRITO_PRODUCTO` (`Id_Producto`),
  ADD KEY `FK_CARRITO_USUARIO` (`Id_Usuario`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`Id_Categoria`);

--
-- Indices de la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`id_direccion`),
  ADD KEY `FK_USUARIO_DIRECCION` (`id_usuario`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`Id_Factura`),
  ADD KEY `FK_Facturas_Productos` (`Id_Producto`),
  ADD KEY `FK_Facturas_Usuarios` (`id_usuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`Id_Producto`),
  ADD KEY `FK_PRODUCTOS_CATEGORIA` (`Id_Categoria`),
  ADD KEY `FK_PRODUCTOS_PROVEEDOR` (`Id_Proveedor`),
  ADD KEY `FK_PRODUCTOS_SUBCATEGORIA` (`Id_Subcategoria`);

--
-- Indices de la tabla `producto_talla`
--
ALTER TABLE `producto_talla`
  ADD KEY `FK_PRODUCTO_TALLA_Producto` (`Id_Producto`),
  ADD KEY `Id_Talla` (`Id_Talla`) USING BTREE;

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`Id_Proveedor`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD PRIMARY KEY (`id_SubCategoria`);

--
-- Indices de la tabla `tallas`
--
ALTER TABLE `tallas`
  ADD PRIMARY KEY (`Id_Talla`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `FK_USUARIO_ROL` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `Id_Carrito` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `Id_Categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `direccion`
--
ALTER TABLE `direccion`
  MODIFY `id_direccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `Id_Producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `Id_Proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  MODIFY `id_SubCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tallas`
--
ALTER TABLE `tallas`
  MODIFY `Id_Talla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `FK_CARRITO_PRODUCTO` FOREIGN KEY (`Id_Producto`) REFERENCES `productos` (`Id_Producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_CARRITO_USUARIO` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD CONSTRAINT `FK_USUARIO_DIRECCION` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `FK_Facturas_Productos` FOREIGN KEY (`Id_Producto`) REFERENCES `productos` (`Id_Producto`),
  ADD CONSTRAINT `FK_Facturas_Usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `FK_PRODUCTOS_CATEGORIA` FOREIGN KEY (`Id_Categoria`) REFERENCES `categorias` (`Id_Categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_PRODUCTOS_PROVEEDOR` FOREIGN KEY (`Id_Proveedor`) REFERENCES `proveedores` (`Id_Proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_PRODUCTOS_SUBCATEGORIA` FOREIGN KEY (`Id_Subcategoria`) REFERENCES `subcategoria` (`id_SubCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto_talla`
--
ALTER TABLE `producto_talla`
  ADD CONSTRAINT `FK_PRODUCTO_TALLA_Producto` FOREIGN KEY (`Id_Producto`) REFERENCES `productos` (`Id_Producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_PRODUCTO_TALLA_TALLA` FOREIGN KEY (`Id_Talla`) REFERENCES `tallas` (`Id_Talla`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_USUARIO_ROL` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

