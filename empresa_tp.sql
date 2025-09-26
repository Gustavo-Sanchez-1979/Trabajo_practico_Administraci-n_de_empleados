
-- Base de datos: `empresa_tp`

-- Estructura de tabla para la tabla `empleados`


CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `apellido` varchar(60) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `email` varchar(120) NOT NULL,
  `puesto` varchar(80) NOT NULL,
  `salario` decimal(10,2) NOT NULL DEFAULT 0.00,
  `fecha_ingreso` date NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombre`, `apellido`, `dni`, `email`, `puesto`, `salario`, `fecha_ingreso`, `creado_en`) VALUES
(1, 'María', 'Gómez', '30111222', 'maria.gomez@empresa.com', 'Administrativa', 150000.00, '2022-03-01', '2025-09-26 21:14:54'),
(2, 'Juan', 'Pérez', '28999444', 'juan.perez@empresa.com', 'Analista', 200000.00, '2021-07-15', '2025-09-26 21:14:54'),
(3, 'Lucía', 'Fernández', '33222333', 'lucia.fernandez@empresa.com', 'Recursos Humanos', 180000.00, '2023-01-10', '2025-09-26 21:14:54'),
(4, 'Carlos', 'López', '27888777', 'carlos.lopez@empresa.com', 'Programador', 250000.00, '2020-11-20', '2025-09-26 21:14:54'),
(5, 'Sofía', 'Martínez', '35444555', 'sofia.martinez@empresa.com', 'Contadora', 220000.00, '2022-06-05', '2025-09-26 21:14:54'),
(6, 'Diego', 'Ramírez', '31222999', 'diego.ramirez@empresa.com', 'Técnico', 170000.00, '2023-02-14', '2025-09-26 21:14:54'),
(7, 'Ana', 'Suárez', '27666111', 'ana.suarez@empresa.com', 'Diseñadora', 210000.00, '2021-09-30', '2025-09-26 21:14:54'),
(8, 'Martín', 'Torres', '29888777', 'martin.torres@empresa.com', 'Jefe de Proyecto', 300000.00, '2019-05-25', '2025-09-26 21:14:54'),
(9, 'Paula', 'Díaz', '33444999', 'paula.diaz@empresa.com', 'Secretaria', 140000.00, '2022-12-01', '2025-09-26 21:14:54'),
(10, 'Fernando', 'Castro', '32222111', 'fernando.castro@empresa.com', 'Gerente General', 450000.00, '2018-08-12', '2025-09-26 21:14:54');


ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`);


ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;


