-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-02-2024 a las 04:19:35
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
-- Base de datos: `zapateriaproyecto`
--

-- --------------------------------------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
  `Total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

/*IMPORTANTE SE MODIFICO ESTA TABLA  RECOMIENDO VOLVERLA A CREAR
SE CREO AÑADIO EL ATRIBUTO ID SUB CATEGORIA*/
Create TABLE `productos` (
  `Id_Producto` int(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Descripcion` varchar(255) NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Talla` int(11) NOT NULL,
  `Imagen` varchar(255) DEFAULT NULL,
  `Id_Categoria` int(11) NOT NULL,
  `Id_Proveedor` int(11) NOT NULL,
  `Id_Subcategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


/*===============================================================================================================================================================*/
/*llaves y primarias  foraneas productos*/
ALTER TABLE `productos`
  MODIFY `Id_Producto` int(11)  primary key NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;


ALTER TABLE `productos`
ADD CONSTRAINT FK_PRODUCTOS_SUB_CATEGORIA Foreign Key(`id_SubCategoria`) REFERENCES subcategoria (`id_SubCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `productos`
ADD CONSTRAINT FK_PRODUCTOS_Categoria Foreign Key(`Id_Categoria`) REFERENCES categorias (`Id_Categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `productos`
ADD CONSTRAINT FK_PRODUCTOS_Proovedor Foreign Key(`Id_Proveedor`) REFERENCES proveedores (`Id_Proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;


/*===============================================================================================================================================================*/
--
-- Volcado de datos para la tabla `productos`
--SE MODIFICARON LAS INSERCIONES PARA SUBCATEGORIAS, RECOMIENDO VOLVER A CREAR PRODUCTOS E INSERTAR ESTAS
INSERT INTO `productos` (`Id_Producto`, `Nombre`, `Descripcion`, `Precio`, `Cantidad`, `Talla`, `Imagen`, `Id_Categoria`, `Id_Proveedor`, `Id_Subcategoria`) VALUES
(1, 'Tacon tipo Cenicienta', 'Hermosos tacones tipo cenicienta para una ocasión especial', 35000.00, 5, 36, 'https://img.freepik.com/fotos-premium/zapatos-mujer-hd-8k-fondo-pantalla-imagen-fotografica-archivo_890746-23894.jpg', 2, 1,5),
(2, 'Tenis Nike deportivas', 'Tenis deportivos para hacer ejercicio', 50000.00, 5, 36, 'https://cdn.pixabay.com/photo/2016/11/19/18/06/feet-1840619_1280.jpg', 2, 2,1),
(6, 'Tenis Jordan', 'Tenis Jordan marca Nike', 70000.00, 5, 38, 'https://media.gq.com.mx/photos/61d470c5619ec7f7ff2376ab/16:9/w_2560%2Cc_limit/Air-Jordan-2022.jpg', 1, 2,1),
(7,'Collar de corazones', 'Hermoso collar de corazones perfecto para cualquier ocasión', 15000.00, 5, 45, 'https://cdn-media.glamira.com/media/catalog/category/product_image_top_banner_colliers.jpg', 3, 1,6);
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
(1, 'Calzados Emme', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTXNezspNVM_wSkMqMtdeblXx7EU4u5UNUgaXdz0qxL9w&s'),
(2, 'Nike', 'https://upload.wikimedia.org/wikipedia/commons/3/36/Logo_nike_principal.jpg');

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
-- Estructura de tabla para la tabla `subcategoria 
--BORRAR Y CREAR DE NUEVO`
--

Create TABLE `subcategoria` (
  `id_SubCategoria` int(11)  auto_increment primary key NOT NULL,
  `nombre` varchar(50) NOT NULL,
   `descripcion` varchar(255) NOT NULL,
   `status` boolean NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



-- --------------------------------------------------------
/*INSERCIONES SUB CATEGORIA*/

INSERT INTO `subcategoria` (`nombre`, `descripcion`, `status`) VALUES
('Zapatos Deportivos', 'Zapatos diseñados para actividades deportivas.', 1),
('Zapatos Formales', 'Zapatos adecuados para ocasiones formales o de negocios.', 1),
('Zapatos Casuales', 'Zapatos informales para uso diario.', 1),
('Zapatos de Vestir', 'Zapatos elegantes para eventos especiales o ceremonias.', 1),
('Zapatos de Tacón', 'Zapatos con tacón alto, generalmente usados por mujeres.', 1),
('Collares', 'Accesorios para el cuello, generalmente hechos de diferentes materiales.', 1);


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
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`Id_Carrito`),
  ADD KEY `FK_Carrito_Usuario` (`Id_Usuario`),
  ADD KEY `FK_Carrito_Producto` (`Id_Producto`);

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
  ADD FOREIGN KEY `FK_USUARIO_DIRECCION`(id_usuario) REFERENCES usuario (`id_usuario`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`Id_Factura`),
  ADD KEY `FK_Facturas_Productos` (`Id_Producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`Id_Producto`),
  ADD KEY `FK_Productos_Categoria` (`Id_Categoria`),
  ADD KEY `FK_Productos_Proveedor` (`Id_Proveedor`);

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
-- Indices de la tabla `subcategoria` usar esto si es necesario
--
ALTER TABLE `subcategoria`
  ADD PRIMARY KEY (`id_SubCategoria`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `FK_ROL_USUARIO` (`id_rol`);

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
  MODIFY `id_direccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `Id_Factura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `Id_Producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `Id_Proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `subcategoria USAR SOLO SI ES NECESARIO EN LA TABLA YA VIENE CONFIGURADA`
--
ALTER TABLE `subcategoria`
  MODIFY `id_SubCategoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `FK_Carrito_Producto` FOREIGN KEY (`Id_Producto`) REFERENCES `productos` (`Id_Producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Carrito_Usuario` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD CONSTRAINT `FK_USUARIO_DIRECCION` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `FK_Facturas_Productos` FOREIGN KEY (`Id_Producto`) REFERENCES `productos` (`Id_Producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `FK_Productos_Categoria` FOREIGN KEY (`Id_Categoria`) REFERENCES `categorias` (`Id_Categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Productos_Proveedor` FOREIGN KEY (`Id_Proveedor`) REFERENCES `proveedores` (`Id_Proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;


--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_ROL_USUARIO` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
