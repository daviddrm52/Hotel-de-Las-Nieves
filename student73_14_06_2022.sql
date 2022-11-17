USE `hotel`;

-- Eliminación de claves foraneas

ALTER TABLE `73_clientes`
  DROP CONSTRAINT IF EXISTS `73_clientes_ibfk_1`;

-- Filtros para la tabla `73_habitacio`

ALTER TABLE `73_habitacio`
  DROP CONSTRAINT IF EXISTS `73_habitacio_ibfk_1`,
  DROP CONSTRAINT IF EXISTS `73_habitacio_ibfk_2`; 

-- Filtros para la tabla `73_reservas`

ALTER TABLE `73_reservas`
  DROP CONSTRAINT IF EXISTS `73_reservas_ibfk_1`,
  DROP CONSTRAINT IF EXISTS `73_reservas_ibfk_2`,
  DROP CONSTRAINT IF EXISTS `73_reservas_ibfk_3`,
  DROP CONSTRAINT IF EXISTS `73_reservas_ibfk_4`,
  DROP CONSTRAINT IF EXISTS `73_reservas_ibfk_5`;
COMMIT;

-- Estructura de tabla para la tabla `73_clientes`

DROP TABLE IF EXISTS `73_clientes`;

CREATE TABLE `73_clientes` (
  `id` int(11) NOT NULL,
  `usuario` varchar(32) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `apellido_primero` varchar(32) NOT NULL,
  `apellido_segundo` varchar(32) NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `dni` varchar(9) NOT NULL,
  `direccion` varchar(128) NOT NULL,
  `telefono` int(18) NOT NULL,
  `email` varchar(128) NOT NULL,
  `contrasena` varchar(64) NOT NULL,
  `fecha_nacimiento` date NOT NULL
);

-- Volcado de datos para la tabla `73_clientes`

INSERT INTO `73_clientes` (`id`, `usuario`, `nombre`, `apellido_primero`, `apellido_segundo`, `tipo_id`, `dni`, `direccion`, `telefono`, `email`, `contrasena`, `fecha_nacimiento`) VALUES
(1, 'admin', 'admin', '', '', 2, '', '', 0, 'adminservices@hoteldelasnieves.com', '12345', '1982-02-19'),
(2, 'clienteTesting1', 'Cliente', 'Probando', 'Paredes', 1, '12345678K', 'Avenida del Valle Nevado Nº389', 670596823, 'dawbdmadridrueda@iesjoanramis.org', '12345678', '1998-01-29'),
(3, 'manualFacil', 'Manuel', 'Fernandez', 'Amongus', 1, '45828174F', 'Calle WorldLiner Nº2, Valle Nevado', 670384924, 'dawbdmadridrueda@iesjoanramis.org', '12345678', '1994-06-08');

-- Estructura de tabla para la tabla `73_estado_habitacion`

DROP TABLE IF EXISTS `73_estado_habitacion`;

CREATE TABLE `73_estado_habitacion` (
  `id` int(11) NOT NULL,
  `estado` varchar(32) NOT NULL
);

-- Volcado de datos para la tabla `73_estado_habitacion`

INSERT INTO `73_estado_habitacion` (`id`, `estado`) VALUES
(1, 'Abierta'),
(2, 'Cerrada');

-- Estructura de tabla para la tabla `73_estado_reserva`

DROP TABLE IF EXISTS `73_estado_reserva`;

CREATE TABLE `73_estado_reserva` (
  `id` int(11) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `descripcion` varchar(255) NOT NULL
);

-- Volcado de datos para la tabla `73_estado_reserva`

INSERT INTO `73_estado_reserva` (`id`, `nombre`, `descripcion`) VALUES
(1, 'reservado', 'La reserva esta activa.'),
(2, 'check-in', 'El cliente esta en el hotel.'),
(3, 'check-out', 'El cliente ha salido del hotel.'),
(4, 'no-show', 'El cliente no se ha presentado.'),
(5, 'cancelada', 'La reserva ha sido cancelada.'),
(6, 'finalizada', 'La reserva ha terminado.');

-- Estructura de tabla para la tabla `73_habitacio`

DROP TABLE IF EXISTS `73_habitacio`;

CREATE TABLE `73_habitacio` (
  `id` int(11) NOT NULL,
  `tipo_habitacion` int(11) NOT NULL,
  `numero` int(4) NOT NULL,
  `nombre` varchar(64) NOT NULL,
  `cerrada` int(11) NOT NULL DEFAULT 0,
  `descripcion` varchar(512) NOT NULL,
  `observaciones` varchar(512) NOT NULL
);

-- Volcado de datos para la tabla `73_habitacio`

INSERT INTO `73_habitacio` (`id`, `tipo_habitacion`, `numero`, `nombre`, `cerrada`, `descripcion`, `observaciones`) VALUES
(1, 1, 101, 'Individual', 2, 'Habitacion con una cama, ademas del baño, tele, minibar y balcon', 'Salida de emergencia justo delante'),
(2, 1, 102, 'Habitacion individual', 2, 'Habitacion con una cama, ademas del baño, tele, minibar y balcon', 'Salida de emergencia justo delante'),
(3, 1, 103, 'Habitacion individual', 2, 'Habitacion con una cama, ademas del baño, tele, minibar y balcon', 'Salida de emergencia justo delante'),
(4, 1, 104, 'Habitacion individual', 2, 'Habitacion con una cama, ademas del baño, tele, minibar y balcon', 'Sin observaciones');

-- Estructura de tabla para la tabla `73_hotel`

DROP TABLE IF EXISTS `73_hotel`;

CREATE TABLE `73_hotel` (
  `id` int(11) NOT NULL,
  `nombre` varchar(64) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `num_habitaciones` int(3) NOT NULL,
  `direccion` varchar(128) NOT NULL,
  `codigo_postal` varchar(5) NOT NULL,
  `telefono` int(9) NOT NULL,
  `web` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `CIF` varchar(9) NOT NULL,
  `fotos` varchar(255) NOT NULL,
  `categoria` int(5) NOT NULL
);

-- Volcado de datos para la tabla `73_hotel`

INSERT INTO `73_hotel` (`id`, `nombre`, `descripcion`, `num_habitaciones`, `direccion`, `codigo_postal`, `telefono`, `web`, `email`, `CIF`, `fotos`, `categoria`) VALUES
(1, 'Hotel de Las Nieves', 'Hotel en la zona residencial de Ciudad Madera, cerca del Parque Natural del Valle Nevado.', 30, 'Avenida de los comercios Nº8, Ciudad Madera', '18772', 672093508, 'https://www.hoteldelasnieves.com/', 'customerservice@hoteldelasnieves.com', 'J37614827', '/student73/dwes/img/imagen_principal.jpeg', 4);

-- Estructura de tabla para la tabla `73_pension`

DROP TABLE IF EXISTS `73_pension`;

CREATE TABLE `73_pension` (
  `id` int(11) NOT NULL,
  `nombre_corto` varchar(2) NOT NULL,
  `nombre_largo` varchar(64) NOT NULL
);
-- Volcado de datos para la tabla `73_pension`

INSERT INTO `73_pension` (`id`, `nombre_corto`, `nombre_largo`) VALUES
(1, 'SA', 'Solo Alojamiento'),
(2, 'AD', 'Alojamiento y Desayuno'),
(3, 'MD', 'Merienda y Desayuno'),
(4, 'PC', 'Pensión Completa'),
(5, 'TI', 'Todo Incluido');

-- Estructura de tabla para la tabla `73_reservas`

DROP TABLE IF EXISTS `73_reservas`;

CREATE TABLE `73_reservas` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `entrada` date NOT NULL,
  `salida` date NOT NULL,
  `tipoHabitacion_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `noches` int(2) NOT NULL,
  `precio` double(7,2) NOT NULL,
  `pension_id` int(11) NOT NULL,
  `habitacion_id` int(11) NOT NULL
);

-- Volcado de datos para la tabla `73_reservas`

INSERT INTO `73_reservas` (`id`, `cliente_id`, `entrada`, `salida`, `tipoHabitacion_id`, `estado_id`, `noches`, `precio`, `pension_id`, `habitacion_id`) VALUES
(15, 1, '2022-06-26', '2022-09-27', 1, 6, 93, 4710.00, 4, 1),
(16, 1, '2022-06-19', '2022-06-22', 1, 6, 3, 175.00, 3, 1),
(17, 1, '2022-06-26', '2022-06-29', 1, 6, 3, 150.00, 1, 1),
(18, 2, '2022-06-27', '2022-06-30', 1, 1, 3, 210.00, 4, 1),
(19, 2, '2022-06-27', '2022-06-30', 1, 1, 3, 150.00, 1, 1),
(20, 2, '2022-06-13', '2022-06-25', 1, 1, 12, 625.00, 3, 1),
(21, 2, '2022-06-26', '2022-06-30', 1, 1, 4, 200.00, 1, 1),
(22, 1, '2022-06-26', '2022-06-28', 0, 6, 2, 220.00, 5, 2),
(23, 1, '2022-06-20', '2022-06-30', 0, 6, 10, 525.00, 3, 4),
(24, 1, '2022-06-20', '2022-06-30', 0, 6, 10, 515.00, 2, 3),
(25, 1, '2022-06-12', '2022-06-19', 0, 1, 7, 350.00, 1, 4),
(26, 3, '2022-07-06', '2022-07-20', 0, 1, 14, 700.00, 1, 4);

-- Estructura de tabla para la tabla `73_tipos_usuarios`

DROP TABLE IF EXISTS `73_tipos_usuarios`;

CREATE TABLE `73_tipos_usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(32) NOT NULL
);
-- Volcado de datos para la tabla `73_tipos_usuarios`

INSERT INTO `73_tipos_usuarios` (`id`, `nombre`) VALUES
(1, 'Usuario'),
(2, 'Administrador');

-- Estructura de tabla para la tabla `73_tipushabitacio`

DROP TABLE IF EXISTS `73_tipushabitacio`;

CREATE TABLE `73_tipushabitacio` (
  `id` int(11) NOT NULL,
  `nombre` varchar(64) NOT NULL,
  `precio` int(3) NOT NULL,
  `descripcion` varchar(512) NOT NULL,
  `capacidad` int(2) NOT NULL,
  `codigo` varchar(5) NOT NULL,
  `fotos` varchar(255) NOT NULL,
  `extras` varchar(255) NOT NULL
);

-- Volcado de datos para la tabla `73_tipushabitacio`

INSERT INTO `73_tipushabitacio` (`id`, `nombre`, `precio`, `descripcion`, `capacidad`, `codigo`, `fotos`, `extras`) VALUES
(1, 'Individual', 50, 'Habitacion con una cama, ademas del baño, tele, minibar y balcon', 1, 'INV1C', 'https://www.marinador.com/sites/default/files/styles/gallery/public/habitacion2-gd.jpg?itok=0c24XoJt', 'Wi-Fi con un 25% de descuento'),
(2, 'Habitacion individual', 130, 'Habitacion con dos camas, ademas del baño, tele, minibar y balcon', 2, 'INV1C', 'https://www.abbahoteles.com/idb/72372/hotel_balmoral_individual-600x400.jpg', 'Minibar lleno');

-- Índices para tablas volcadas

-- Indices de la tabla `73_clientes`

ALTER TABLE `73_clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `tipo_id` (`tipo_id`);

-- Indices de la tabla `73_estado_habitacion`

ALTER TABLE `73_estado_habitacion`
  ADD PRIMARY KEY (`id`);

-- Indices de la tabla `73_estado_reserva`

ALTER TABLE `73_estado_reserva`
  ADD PRIMARY KEY (`id`);

-- Indices de la tabla `73_habitacio`

ALTER TABLE `73_habitacio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipo_habitacion` (`tipo_habitacion`,`cerrada`),
  ADD KEY `cerrada` (`cerrada`);

-- Indices de la tabla `73_hotel`

ALTER TABLE `73_hotel`
  ADD PRIMARY KEY (`id`);

-- Indices de la tabla `73_pension`

ALTER TABLE `73_pension`
  ADD PRIMARY KEY (`id`);

-- Indices de la tabla `73_reservas`

ALTER TABLE `73_reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estado_id` (`estado_id`),
  ADD KEY `pension_id` (`pension_id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `habitacion_id` (`habitacion_id`),
  ADD KEY `tipoHabitacion_id` (`tipoHabitacion_id`);

-- Indices de la tabla `73_tipos_usuarios`

ALTER TABLE `73_tipos_usuarios`
  ADD PRIMARY KEY (`id`);

-- Indices de la tabla `73_tipushabitacio`

ALTER TABLE `73_tipushabitacio`
  ADD PRIMARY KEY (`id`);

-- AUTO_INCREMENT de las tablas volcadas

ALTER TABLE `73_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `73_estado_habitacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `73_estado_reserva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `73_habitacio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `73_hotel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `73_pension`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `73_reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `73_tipos_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `73_tipushabitacio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- Restricciones para tablas volcadas

-- Filtros para la tabla `73_clientes`

ALTER TABLE `73_clientes`
  ADD CONSTRAINT `73_clientes_ibfk_1` FOREIGN KEY (`tipo_id`) REFERENCES `73_tipos_usuarios` (`id`);

-- Filtros para la tabla `73_habitacio`

ALTER TABLE `73_habitacio`
  ADD CONSTRAINT `73_habitacio_ibfk_1` FOREIGN KEY (`cerrada`) REFERENCES `73_estado_habitacion` (`id`),
  ADD CONSTRAINT `73_habitacio_ibfk_2` FOREIGN KEY (`tipo_habitacion`) REFERENCES `73_tipushabitacio` (`id`);

-- Filtros para la tabla `73_reservas`

ALTER TABLE `73_reservas`
  ADD CONSTRAINT `73_reservas_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `73_clientes` (`id`),
  ADD CONSTRAINT `73_reservas_ibfk_3` FOREIGN KEY (`estado_id`) REFERENCES `73_estado_reserva` (`id`),
  ADD CONSTRAINT `73_reservas_ibfk_4` FOREIGN KEY (`pension_id`) REFERENCES `73_pension` (`id`);
COMMIT;