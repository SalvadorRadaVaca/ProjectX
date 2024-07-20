-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-07-2024 a las 03:00:01
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
-- Base de datos: `projectx`
--

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `appointment_event_user_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `appointment_event_user_view` (
`id` bigint(20)
,`date_time` timestamp
,`event_id` bigint(20)
,`user_id` bigint(20)
,`event` varchar(255)
,`email` varchar(255)
,`appointment_type` varchar(255)
,`reminder` varchar(255)
,`confirmed` tinyint(4)
,`cancelled` tinyint(4)
,`state` tinyint(4)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `appointment_table`
--

CREATE TABLE `appointment_table` (
  `id` bigint(20) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `event_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `appointment_type` varchar(255) NOT NULL,
  `reminder` varchar(255) NOT NULL,
  `confirmed` tinyint(4) NOT NULL,
  `cancelled` tinyint(4) NOT NULL,
  `state` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `appointment_table`
--

INSERT INTO `appointment_table` (`id`, `date_time`, `event_id`, `user_id`, `appointment_type`, `reminder`, `confirmed`, `cancelled`, `state`) VALUES
(1, '2024-07-01 04:43:43', 1, 38, 'Individual', 'Email', 1, 0, 1),
(2, '2024-07-02 17:00:00', 2, 39, 'Group', 'Email', 1, 0, 1),
(3, '2024-07-05 05:59:05', 3, 40, 'Individual', 'Email', 1, 0, 1),
(4, '2024-07-06 20:05:08', 4, 41, 'Group', 'Email', 1, 0, 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `bill_client_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `bill_client_view` (
`id` bigint(20)
,`hire_date` date
,`invoice` int(11)
,`package_description` varchar(255)
,`initial_contracted_amount` double
,`balance` double
,`client_id` bigint(20)
,`state` tinyint(4)
,`name` varchar(255)
,`last_name` varchar(255)
,`email` varchar(255)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bill_table`
--

CREATE TABLE `bill_table` (
  `id` bigint(20) NOT NULL,
  `hire_date` date NOT NULL,
  `invoice` int(11) NOT NULL,
  `package_description` varchar(255) NOT NULL,
  `initial_contracted_amount` double NOT NULL,
  `balance` double NOT NULL,
  `client_id` bigint(20) NOT NULL,
  `state` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `bill_table`
--

INSERT INTO `bill_table` (`id`, `hire_date`, `invoice`, `package_description`, `initial_contracted_amount`, `balance`, `client_id`, `state`) VALUES
(1, '2024-07-15', 1205, '3 group photos and 5 individual photos', 1000, 3000, 38, 1),
(6, '2024-07-22', 1208, '3 group photos and 5 individual photos', 1000, 3000, 39, 1),
(7, '2024-07-29', 1215, '3 group photos and 5 individual photos', 1000, 3000, 40, 1),
(8, '2024-08-05', 1225, '3 group photos and 5 individual photos', 1000, 3000, 41, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `event_table`
--

CREATE TABLE `event_table` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `location` varchar(1000) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `state` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `event_table`
--

INSERT INTO `event_table` (`id`, `name`, `date`, `location`, `user_id`, `state`) VALUES
(1, 'Wedding', '2024-07-30', 'Parroquia El Expiatorio del Santísimo Sacramento, C. Manuel López Cotilla 935, Col Americana, Americana, 44160 Guadalajara, Jal.', 38, 1),
(2, 'Christening', '2024-07-19', 'Templo San Juan Diego, C. Copal 2951, 44980 Guadalajara, Jal.', 39, 1),
(3, 'First Communion', '2024-07-09', 'Santuario San Nicolás De Bari, Cáncer # 4190-A Col 45120, Juan Manuel Vallarta, 45120 Zapopan, Jal.', 40, 1),
(4, 'Funeral', '2024-07-25', 'Capilla Funeraria San Pablo, Av. Belisario Domínguez 480, San Juan de Dios, 44360 Guadalajara, Jal.', 41, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_table`
--

CREATE TABLE `login_table` (
  `id` bigint(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `login_table`
--

INSERT INTO `login_table` (`id`, `email`, `password`) VALUES
(1, 'radavacasalvador@gmail.com', '5b6e3e4614b5dbd4e70161a810fa5e12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens_table`
--

CREATE TABLE `password_reset_tokens_table` (
  `id` bigint(20) NOT NULL,
  `token` varchar(1000) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `expiry_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `password_reset_tokens_table`
--

INSERT INTO `password_reset_tokens_table` (`id`, `token`, `user_id`, `expiry_date`) VALUES
(7, '1234abcd5678efgh', 38, '2024-07-15'),
(8, '1234abcd5678efgh', 39, '2024-07-15'),
(9, '1234abcd5678efgh', 40, '2024-07-08'),
(10, '1234abcd5678efgh', 41, '2024-07-08');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `payment_bill_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `payment_bill_view` (
`id` bigint(20)
,`payment_date` date
,`amount_paid` double
,`way_to_pay` varchar(255)
,`bill_id` bigint(20)
,`bill` bigint(20)
,`state` tinyint(4)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_table`
--

CREATE TABLE `payment_table` (
  `id` bigint(20) NOT NULL,
  `payment_date` date NOT NULL,
  `amount_paid` double NOT NULL,
  `way_to_pay` varchar(255) NOT NULL,
  `bill_id` bigint(20) NOT NULL,
  `state` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `payment_table`
--

INSERT INTO `payment_table` (`id`, `payment_date`, `amount_paid`, `way_to_pay`, `bill_id`, `state`) VALUES
(1, '2024-07-22', 1000, 'Credit Card', 1, 1),
(2, '2024-08-05', 1000, 'Cash', 6, 1),
(3, '2024-08-12', 1000, 'Credit Card', 7, 1),
(4, '2024-08-26', 1000, 'Cash', 8, 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `photography_appointment_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `photography_appointment_view` (
`id` bigint(20)
,`image_url` text
,`appointment_id` bigint(20)
,`selected` tinyint(4)
,`watermark` tinyint(4)
,`balance` double
,`state` tinyint(4)
,`user_id` bigint(20)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `photography_table`
--

CREATE TABLE `photography_table` (
  `id` bigint(20) NOT NULL,
  `image_url` text NOT NULL,
  `appointment_id` bigint(20) NOT NULL,
  `selected` tinyint(4) NOT NULL,
  `watermark` tinyint(4) NOT NULL,
  `balance` double NOT NULL,
  `state` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `photography_table`
--

INSERT INTO `photography_table` (`id`, `image_url`, `appointment_id`, `selected`, `watermark`, `balance`, `state`) VALUES
(1, '1720387781_me.jpg', 1, 1, 1, 250, 1),
(2, '1720294056_me.jpg', 2, 1, 1, 250, 1),
(3, '1720294150_me.jpg', 3, 1, 1, 250, 1),
(4, '1720294237_me.jpg', 4, 1, 1, 250, 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `user_event_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `user_event_view` (
`id` bigint(20)
,`event` varchar(255)
,`date` date
,`location` varchar(1000)
,`user_id` bigint(20)
,`name` varchar(255)
,`last_name` varchar(255)
,`email` varchar(255)
,`state` tinyint(4)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_table`
--

CREATE TABLE `user_table` (
  `id` bigint(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token_confirmation` varchar(1000) NOT NULL,
  `rol` varchar(255) NOT NULL,
  `enabled` tinyint(4) NOT NULL,
  `state` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `user_table`
--

INSERT INTO `user_table` (`id`, `name`, `last_name`, `email`, `password`, `token_confirmation`, `rol`, `enabled`, `state`) VALUES
(38, 'Salvador', 'Rada Vaca', 'radavacasalvador@gmail.com', '5b6e3e4614b5dbd4e70161a810fa5e12', '1234abcd5678efgh', 'Administrator', 1, 1),
(39, 'Rodrigo', 'Rada Vaca', 'rodrigo.bartman@hotmail.com', '68d9aac8af273629c7c6f182007bf930', '1234abcd5678efgh', 'User', 1, 1),
(40, 'Angelica', 'Rada Vaca', 'angie@hotmail.com', 'eb6f8de591ee39332296c955e83ce779', '1234abcd5678efgh', 'User', 1, 1),
(41, 'Salvador', 'Rada Bonilla', 'salvador.rada@gmail.com', 'f1dc0a004197e938220c9a7735038981', '1234abcd5678efgh', 'User', 1, 1);

-- --------------------------------------------------------

--
-- Estructura para la vista `appointment_event_user_view`
--
DROP TABLE IF EXISTS `appointment_event_user_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `appointment_event_user_view`  AS   (select `appointment_table`.`id` AS `id`,`appointment_table`.`date_time` AS `date_time`,`appointment_table`.`event_id` AS `event_id`,`appointment_table`.`user_id` AS `user_id`,`event_table`.`name` AS `event`,`user_table`.`email` AS `email`,`appointment_table`.`appointment_type` AS `appointment_type`,`appointment_table`.`reminder` AS `reminder`,`appointment_table`.`confirmed` AS `confirmed`,`appointment_table`.`cancelled` AS `cancelled`,`appointment_table`.`state` AS `state` from ((`appointment_table` left join `event_table` on(`appointment_table`.`event_id` = `event_table`.`id`)) left join `user_table` on(`appointment_table`.`user_id` = `user_table`.`id`)))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `bill_client_view`
--
DROP TABLE IF EXISTS `bill_client_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bill_client_view`  AS   (select `bill_table`.`id` AS `id`,`bill_table`.`hire_date` AS `hire_date`,`bill_table`.`invoice` AS `invoice`,`bill_table`.`package_description` AS `package_description`,`bill_table`.`initial_contracted_amount` AS `initial_contracted_amount`,`bill_table`.`balance` AS `balance`,`bill_table`.`client_id` AS `client_id`,`bill_table`.`state` AS `state`,`user_table`.`name` AS `name`,`user_table`.`last_name` AS `last_name`,`user_table`.`email` AS `email` from (`bill_table` left join `user_table` on(`bill_table`.`client_id` = `user_table`.`id`)))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `payment_bill_view`
--
DROP TABLE IF EXISTS `payment_bill_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payment_bill_view`  AS   (select `payment_table`.`id` AS `id`,`payment_table`.`payment_date` AS `payment_date`,`payment_table`.`amount_paid` AS `amount_paid`,`payment_table`.`way_to_pay` AS `way_to_pay`,`payment_table`.`bill_id` AS `bill_id`,`bill_table`.`id` AS `bill`,`payment_table`.`state` AS `state` from (`payment_table` left join `bill_table` on(`payment_table`.`bill_id` = `bill_table`.`id`)))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `photography_appointment_view`
--
DROP TABLE IF EXISTS `photography_appointment_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `photography_appointment_view`  AS   (select `photography_table`.`id` AS `id`,`photography_table`.`image_url` AS `image_url`,`photography_table`.`appointment_id` AS `appointment_id`,`photography_table`.`selected` AS `selected`,`photography_table`.`watermark` AS `watermark`,`photography_table`.`balance` AS `balance`,`photography_table`.`state` AS `state`,`appointment_table`.`user_id` AS `user_id` from (`photography_table` left join `appointment_table` on(`photography_table`.`appointment_id` = `appointment_table`.`id`)))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `user_event_view`
--
DROP TABLE IF EXISTS `user_event_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_event_view`  AS   (select `event_table`.`id` AS `id`,`event_table`.`name` AS `event`,`event_table`.`date` AS `date`,`event_table`.`location` AS `location`,`event_table`.`user_id` AS `user_id`,`user_table`.`name` AS `name`,`user_table`.`last_name` AS `last_name`,`user_table`.`email` AS `email`,`event_table`.`state` AS `state` from (`user_table` left join `event_table` on(`user_table`.`id` = `event_table`.`user_id`)))  ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `appointment_table`
--
ALTER TABLE `appointment_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indices de la tabla `bill_table`
--
ALTER TABLE `bill_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indices de la tabla `event_table`
--
ALTER TABLE `event_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `login_table`
--
ALTER TABLE `login_table`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens_table`
--
ALTER TABLE `password_reset_tokens_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `payment_table`
--
ALTER TABLE `payment_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_id` (`bill_id`);

--
-- Indices de la tabla `photography_table`
--
ALTER TABLE `photography_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointment_id` (`appointment_id`);

--
-- Indices de la tabla `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `appointment_table`
--
ALTER TABLE `appointment_table`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `bill_table`
--
ALTER TABLE `bill_table`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `event_table`
--
ALTER TABLE `event_table`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `login_table`
--
ALTER TABLE `login_table`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `password_reset_tokens_table`
--
ALTER TABLE `password_reset_tokens_table`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `payment_table`
--
ALTER TABLE `payment_table`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `photography_table`
--
ALTER TABLE `photography_table`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `user_table`
--
ALTER TABLE `user_table`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `appointment_table`
--
ALTER TABLE `appointment_table`
  ADD CONSTRAINT `appointment_table_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_table` (`id`),
  ADD CONSTRAINT `appointment_table_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `event_table` (`id`);

--
-- Filtros para la tabla `bill_table`
--
ALTER TABLE `bill_table`
  ADD CONSTRAINT `bill_table_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `user_table` (`id`);

--
-- Filtros para la tabla `event_table`
--
ALTER TABLE `event_table`
  ADD CONSTRAINT `event_table_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_table` (`id`);

--
-- Filtros para la tabla `password_reset_tokens_table`
--
ALTER TABLE `password_reset_tokens_table`
  ADD CONSTRAINT `password_reset_tokens_table_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_table` (`id`);

--
-- Filtros para la tabla `payment_table`
--
ALTER TABLE `payment_table`
  ADD CONSTRAINT `payment_table_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bill_table` (`id`);

--
-- Filtros para la tabla `photography_table`
--
ALTER TABLE `photography_table`
  ADD CONSTRAINT `photography_table_ibfk_1` FOREIGN KEY (`appointment_id`) REFERENCES `appointment_table` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
