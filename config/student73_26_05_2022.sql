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
(1, 'admin', 'admin', '', '', 2, '', '', 0, 'adminservices@hoteldelasnieves.com', '12345', '1982-02-19');

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
  ADD CONSTRAINT `73_clientes_ibfk_1` FOREIGN KEY (`tipo_id`) REFERENCES `73_tipos_usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- Filtros para la tabla `73_habitacio`

ALTER TABLE `73_habitacio`
  ADD CONSTRAINT `73_habitacio_ibfk_1` FOREIGN KEY (`cerrada`) REFERENCES `73_estado_habitacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `73_habitacio_ibfk_2` FOREIGN KEY (`tipo_habitacion`) REFERENCES `73_tipushabitacio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE; 

-- Filtros para la tabla `73_reservas`

ALTER TABLE `73_reservas`
  ADD CONSTRAINT `73_reservas_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `73_clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `73_reservas_ibfk_2` FOREIGN KEY (`tipoHabitacion_id`) REFERENCES `73_tipushabitacio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `73_reservas_ibfk_3` FOREIGN KEY (`estado_id`) REFERENCES `73_estado_reserva` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `73_reservas_ibfk_4` FOREIGN KEY (`pension_id`) REFERENCES `73_pension` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `73_reservas_ibfk_5` FOREIGN KEY (`habitacion_id`) REFERENCES `73_habitacio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;