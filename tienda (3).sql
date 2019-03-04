-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-03-2019 a las 07:27:45
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `categoria_id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `anuncio` varchar(85) COLLATE utf8_spanish_ci DEFAULT NULL,
  `visible` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`categoria_id`, `nombre`, `descripcion`, `anuncio`, `visible`) VALUES
(1, 'Informatica', 'Productos informaticos', NULL, 1),
(2, 'Jardineria', 'Productos de Jardineria', NULL, 1),
(3, 'Instrumentos', 'Instrumentos musicales', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea_pedido`
--

CREATE TABLE `linea_pedido` (
  `linea_pedido_id` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `importe` decimal(2,0) DEFAULT NULL,
  `producto_id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `pedido_id` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `estado` char(2) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `producto_id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `descuento` int(11) DEFAULT NULL,
  `imagen` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `iva` int(11) DEFAULT NULL,
  `descripcion` varchar(1000) COLLATE utf8_spanish_ci DEFAULT NULL,
  `anuncio` varchar(75) COLLATE utf8_spanish_ci DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `categoria_id` int(11) NOT NULL,
  `visible` tinyint(4) DEFAULT NULL,
  `destacado` tinyint(4) DEFAULT NULL,
  `fecha_inicio_destacado` date DEFAULT NULL,
  `fecha_fin_destacado` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`producto_id`, `nombre`, `precio`, `descuento`, `imagen`, `iva`, `descripcion`, `anuncio`, `stock`, `categoria_id`, `visible`, `destacado`, `fecha_inicio_destacado`, `fecha_fin_destacado`) VALUES
(1, 'HP Envy 5030', '84.00', 20, 'HPEnvy5030.jpg', 21, 'Conectividad inalámbrica en la que puede confiar \r\nAhorre hasta el 70% en tinta con HP Instant Ink \r\nRapidez y facilidad, impresión, escaneado, copia \r\nVelocidad de impresión: ISO de hasta 10 ppm en negro (A4); ISO de hasta 7 ppm en color (A4) \r\nConectividad: 1 USB 2.0 estándar de alta velocidad; 1 Wi-Fi 802.11n', NULL, 20, 1, 1, 1, NULL, NULL),
(2, 'Kingston SSD A400', '110.20', 70, 'KingstonSSDA400.jpg', 21, 'La unidad A400 de estado sólido de Kingston ofrece mejoras en la velocidad de respuesta, sin actualizaciones adicionales del hardware. Brinda lapsos de arranque, carga y de transferencia de archivos increíblemente más breves en comparación con las unidades de disco duro mecánico. Apoyada en su controlador de la generación, que ofrece velocidades de lectura y escritura de hasta 500 MB/s y 450 MB/s respectivamente, esta unidad SSD es 10 veces más rápida que los discos duros tradicionales y provee un mejor rendimiento, velocidad de respuesta ultrarrápida en el procesamiento multitareas y una aceleración general del sistema.', NULL, 5, 1, 1, 1, NULL, NULL),
(3, 'Mars Gaming MPII550', '24.99', 20, 'MarsGamingMPII550.jpg', 21, 'La fuente de alimentación MPII550, de diseño ecológico y con una eficiencia extremadamente alta de hasta un 85% para el ahorro de energía y una larga vida, se presenta alojada en una caja con recubrimiento negro mate y rejilla negra. Contiene un ventilador de alta calidad con sistema anti vibraciones y sistema inteligente de control de velocidad Tacens, aspas rojas y marco negro. La fuente de alimentación MPII550 está preparada para procesadores Intel de cuarta generación \"Haswell\", tiene una potencia de 550W y cuenta con una potente tecnología de rail único de 12V para un rendimiento extremadamente estable y potente. Sus protecciones eléctricas y filtrado de grado industrial hacen que su funcionamiento sea seguro. Su corrección de potencia activa, con un 99% de eficiencia para una conversión estable y eficiente, compensa todas las fluctuaciones del suministro eléctrico.', NULL, 8, 1, 1, 0, NULL, NULL),
(4, 'Microsoft Surface Pro 6', '1359.99', 11, 'MicrosoftSurfacePro6.jpg', 21, 'Ligera, versátil y más potente con la 8ª generación de procesadores de Intel. Con Surface Pro 6 puedes colaborar en línea, crear presentaciones y mucho más. Crea desde el asiento de tu coche hasta desde la oficina. Su versatilidad te permite llevarla a cualquier lugar adaptándose a tus necesidades personales como profesionales.', NULL, 31, 1, 1, 0, NULL, NULL),
(5, 'Mini Teclado Inalámbrico MECO Mini', '15.99', 19, 'MiniTecladoInalámbricoMECOMini.jpg', 21, 'Teclado y mouse 2 en 1;\r\nPlug and play, más rápido y más conveniente;\r\nFunción de reposo automático del teclado;\r\nTeclado retroiluminado para una operación conveniente en una habitación oscura (presion Tecla \"bombilla\").\r\nPresione \"Fn+spacebar\" para ajustar la sensibilidad del touchpad;', NULL, 12, 1, 1, 1, NULL, NULL),
(6, 'Netgear', '34.99', 7, 'Netgear.jpg', 21, 'Netgear EX3700-100PES, 10/100Base-T(X), IEEE 802.11ac, IEEE 802.11b, IEEE 802.11g, IEEE 802.11n, IEEE 802.3, IEEE 802.3u, 802.11ac, 802.11b, 802.11g, 802.11n, 5,517 cm, 6,717 cm, 3,9 cm', NULL, 4, 1, 1, 0, NULL, NULL),
(7, 'Raspberry', '37.39', 0, 'Raspberry.jpg', 21, 'RASPBERRY PI 3 MODEL B+', NULL, 22, 1, 1, 0, NULL, NULL),
(8, 'SanDisk Ultra Flair 64GB', '15.99', 26, 'SanDiskUltraFlair64GB.jpg', 21, 'La memoria SanDisk Ultra Flair USB 3.0 mueve tus archivos con rapidez. Pasa menos tiempo esperando para transferir archivos y disfruta del rendimiento USB 3.0 con altas velocidades de hasta 150 MB/s. Con velocidades de transferencia hasta 15 veces más rápidas que las de las memorias USB 2.0 estándar, puedes transferir una película en menos de 30 segundos. Su carcasa de metal duradera y elegante es lo bastante resistente para soportar los golpes con estilo. Y, gracias a la protección con contraseña, puedes estar seguro de que tus archivos privados estarán a buen recaudo. Protege tus archivos con estilo con la memoria flash SanDisk Ultra Flair USB 3.0.', NULL, 45, 1, 1, 1, NULL, NULL),
(9, 'VicTsing Ratón Inalámbrico Mini', '9.99', 0, 'VicTsingRatónInalámbricoMini.jpg', 21, 'Este es un nuevo ratón inalámbrico de alta calidad con DPI de 5 niveles ajustables (2400 Superior ) y 6 botones. El ratón de VicTsing tiene fiabilidad, facilidad de uso y comodidad para el usuario, le trae una transmisión de datos rápida sin demoras ni abandonos. ¡Te lo mereces!', NULL, 33, 1, 1, 0, NULL, NULL),
(10, 'Lenovo100S 14IBR Ordenador portátil', '999.00', 0, 'Lenovo100S-14IBR-Ordenadorportátil.jpg', 21, '330-15igm i7-8550u 8/256 15w freed', NULL, 4, 1, 1, 0, NULL, NULL),
(11, 'Etiquetas y marcadores', '7.99', 0, 'Etiquetasymarcadores.jpg', 21, 'Ideal para etiquetar tus plantas', NULL, 70, 2, 1, 0, NULL, NULL),
(12, 'Fibra de coco', '4.90', 0, 'Fibradecoco.jpg', 21, 'Los bricks de fibra de coco Batlle están formados 100 % por fibra de coco totalmente natural, compactada y deshidratada para facilitar su manejo y ser de fácil transporte. Hidratar con agua para conseguir unos 7-8l de fibra de coco natural. La fibra de coco es un producto aireado y esponjoso, que retiene agua y nutrientes asimilables para la planta al mismo tiempo que evita el encharcamiento y propicia una excelente aireación y espacio para el desarrollo de un sistema radicular completo. Ideal para utilizar como medio de cultivo ya sea de forma directa o mezclado con otros materiales, tales como la turba rubia, turba negra, perlita, vermiculita.', NULL, 25, 2, 1, 1, NULL, NULL),
(13, 'HOMCOM Invernadero', '119.99', 10, 'HOMCOMInvernadero.jpg', 21, 'Estructura de tubo de acero de alta calidad \r\nTela de polietileno, robusto, durable y resistente \r\nGran entrada desplegable, para que el aire circule \r\nEstructura muy solida hecha de tubos de acero con recubrimiento de polvo \r\nTela de PE resistente a rayos solares UV y resistente a roturas (polietileno 140 g / m²) \r\nGran entrada: apertura con cremallera con facil acceso \r\n8 Ventanas laterales con mosquitera asegurar una ventilacion adecuada \r\nNota: La entrega de este producto se realiza a pie de la calle. Los transportistas no tienen la obligación de subir el producto a su domicilio.', NULL, 34, 2, 1, 0, NULL, NULL),
(14, 'Maceta pequeña para siembra', '17.07', 11, 'Macetapequeñaparasiembra.jpg', 21, 'Las macetas pequeñas termoformadas están disponibles en 16 colores para diferenciar sus variedades de planes', NULL, 4, 2, 1, 0, NULL, NULL),
(15, 'Maceta Vivero', '10.78', 11, 'MacetaVivero.jpg', 21, 'Ideal para macetas de plantas de semillero más grandes o para el cultivo de hierbas y pequeñas hortalizas anuales ', NULL, 6, 2, 1, 1, NULL, NULL),
(16, 'Semillas de Cesped', '9.75', 0, 'SemillasdeCesped.jpg', 21, 'Se trata de una especie bastante utilizada en mezclas, presente en la mayoría de ellas, destacando por su textura de hoja, su buen comportamiento con las temperaturas medias y sobre todo por su hábito rizoma toso siendo a veces excesivamente agresiva.', NULL, 43, 2, 1, 1, NULL, NULL),
(17, 'Semillas de tomate Krakus', '3.20', 10, 'SemillasdetomateKrakus.jpg', 21, 'Tomate y lsquo; Krakus y rsquo; es una variedad alta medio tardía que requiere ser replanteada debido a su tamano considerable; esta planta está destinada a ser cultivada bajo cubierta o en el campo.', NULL, 14, 2, 1, 0, NULL, NULL),
(18, 'Semillas Ecologicas', '1.59', 0, 'SemillasEcologicas.jpg', 21, 'Nuestras semillas de Albahaca producen una planta anual, de entre 20-40 cm. de altura. Se utiliza las hojas, extremos en flor y aceite esencial. Muy utilizada en cocina, actúa principalmente en el sistema nervioso como sedante y para favorecer la digestión. También es repelente de insectos.', NULL, 23, 2, 1, 1, NULL, NULL),
(19, 'Sustrato Universa l20l', '5.99', 0, 'SustratoUniversal20l.jpg', 21, 'Sustrato de cultivo de muy altas prestaciones pensado para todo tipo de plantas ornamentales y hortícolas, en condiciones tanto de interior como de exterior.', NULL, 42, 2, 1, 0, NULL, NULL),
(20, 'Fertilizante Plantas', '4.75', 8, 'FertilizantePlantas.jpg', 21, 'El fertilizante para plantas ácidas y delicadas de Batlle es aplicable en todas las condiciones: interior, terraza y jardín.', NULL, 22, 2, 1, 0, NULL, NULL),
(21, 'Audio y Splitter Cable', '6.99', 5, 'AudioySplitterCable.jpg', 21, 'Comparado con otras marcas de cables de audio de PVC, este diesel está blindado y es mucho más duradero con la chaqueta trenzada de nylon y el cuerpo de aluminio.', NULL, 11, 3, 1, 1, NULL, NULL),
(22, 'Blue Microphones Yeti', '145.20', 3, 'BlueMicrophonesYeti.jpg', 21, 'Blue Microphones YETI - Micrófono para ordenador USB, plateado', NULL, 14, 3, 1, 0, NULL, NULL),
(23, 'Classic Cantabile DP-50RH', '566.00', 0, 'ClassicCantabileDP-50RH.jpg', 21, 'Teclas ponderadas de martillo con dinamismo de toque regulable. \r\nEl teclado ponderado del DP-50 con autentica mecánica de martillo simula para el pianista la sensación autentica de un piano acústico. Las teclas llaman la atención por tener una cierta resistencia “natural” al presionar la tecla, tal como se da en los pianos clásicos acústicos. El teclado además es de dinámica de toque.', NULL, 4, 3, 1, 0, NULL, NULL),
(24, 'DAddario EJ45', '9.90', 0, 'DAddarioEJ45.jpg', 21, 'EJ45 de tensión normal es el juego para guitarra clásica más vendido de DAddario, elegido por su equilibrio de tono robusto, sensación de comodidad al tacto y proyección dinámica. Pro-Arte, las cuerdas para guitarra clásica conforman los juegos de cuerdas para guitarra clásica de calidad superior de DAddario. Todas las cuerdas agudas de Pro-Arte se clasifican mediante una máquina láser sofisticada', NULL, 5, 3, 1, 1, NULL, NULL),
(25, 'DAddario EXL115 Electric Guitar', '6.40', 10, 'DAddarioEXL115ElectricGuitar.jpg', 21, 'EXL115 es la opción popular para guitarristas que prefieren flexibilidad moderada y un tono pleno y fuerte.', NULL, 2, 3, 1, 1, NULL, NULL),
(26, 'Gibson les Paul Z.Wyl', '28.09', 29, 'GibsonlesPaulZ.Wyl.jpg', 21, 'Miniatura de la legendaria guitarra de paul Z.Wyl', NULL, 1, 3, 1, 0, NULL, NULL),
(27, 'LTD 312602EC', '1059.89', 2, 'LTD312602EC.jpg', 21, 'Ltd EC 1001 fr stblk SeeThru Black LP Style - Set de escala 24,75 cuerpo de caoba con cuello Flamed Maple Top Cuello Thin U-shape con diapasón de palisandro', NULL, 5, 3, 1, 0, NULL, NULL),
(28, 'LTD Guitars & Basses EC-256BLK', '399.00', 13, 'LTDGuitars&BassesEC-256BLK.jpg', 21, 'Cuerpo de caoba. Mástil de caoba encolado. Diapasón de palorrosa. Pastillas ESP Designed LH-150. Puente Tonepros Locking TOM. Herrajes cromados.', NULL, 6, 3, 1, 1, NULL, NULL),
(29, 'Soporte Pared Guitarra', '9.45', 0, 'SoporteParedGuitarra.jpg', 21, 'GIM 2 Piezas Ganchos Para Colgar Guitarras y Similares Instumentos', NULL, 2, 3, 1, 0, NULL, NULL),
(30, 'Zambomba mediana', '26.92', 10, 'Zambombamediana.jpg', 21, 'Zambomba mediana. Tradicional. 18 cm altura x Ø13 cm. Marca: Samba. Fabricado en España', NULL, 1, 3, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `provincia_id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `comunidad_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`provincia_id`, `nombre`, `comunidad_id`) VALUES
(1, 'Alava', 16),
(2, 'Albacete', 7),
(3, 'Alicante', 10),
(4, 'Almera', 1),
(5, 'Avila', 8),
(6, 'Badajoz', 11),
(7, 'Balears (Illes)', 4),
(8, 'Barcelona', 9),
(9, 'Burgos', 8),
(10, 'Cáceres', 11),
(11, 'Cádiz', 1),
(12, 'Castellón', 10),
(13, 'Ciudad Real', 7),
(14, 'Córdoba', 1),
(15, 'Coruña (A)', 12),
(16, 'Cuenca', 7),
(17, 'Girona', 9),
(18, 'Granada', 1),
(19, 'Guadalajara', 7),
(20, 'Guipzcoa', 16),
(21, 'Huelva', 1),
(22, 'Huesca', 2),
(23, 'Jaén', 1),
(24, 'León', 8),
(25, 'Lleida', 9),
(26, 'Rioja (La)', 17),
(27, 'Lugo', 12),
(28, 'Madrid', 13),
(29, 'Málaga', 1),
(30, 'Murcia', 14),
(31, 'Navarra', 15),
(32, 'Ourense', 12),
(33, 'Asturias', 3),
(34, 'Palencia', 8),
(35, 'Palmas (Las)', 5),
(36, 'Pontevedra', 12),
(37, 'Salamanca', 8),
(38, 'Santa Cruz de Tenerife', 5),
(39, 'Cantabria', 6),
(40, 'Segovia', 8),
(41, 'Sevilla', 1),
(42, 'Soria', 8),
(43, 'Tarragona', 9),
(44, 'Teruel', 2),
(45, 'Toledo', 7),
(46, 'Valencia', 10),
(47, 'Valladolid', 8),
(48, 'Vizcaya', 16),
(49, 'Zamora', 8),
(50, 'Zaragoza', 2),
(51, 'Ceuta', 18),
(52, 'Melilla', 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL,
  `nombre_usuario` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `contraseña` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellidos` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `dni` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `provincia_id` int(11) NOT NULL,
  `administrador` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `nombre_usuario`, `contraseña`, `email`, `nombre`, `apellidos`, `dni`, `direccion`, `provincia_id`, `administrador`) VALUES
(2, 'Admin2', 'Admin2', 'Prueba@hotmail.com', 'Administrador', 'Admin', '12345678T', 'Huelva', 21, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indices de la tabla `linea_pedido`
--
ALTER TABLE `linea_pedido`
  ADD PRIMARY KEY (`linea_pedido_id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`pedido_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`producto_id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`provincia_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`),
  ADD KEY `provincia_id` (`provincia_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `categoria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `linea_pedido`
--
ALTER TABLE `linea_pedido`
  MODIFY `linea_pedido_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `pedido_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `producto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `linea_pedido`
--
ALTER TABLE `linea_pedido`
  ADD CONSTRAINT `pedido_id` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`pedido_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `producto_id` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`producto_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `categoria_id` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`categoria_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `provincia_id` FOREIGN KEY (`provincia_id`) REFERENCES `provincias` (`provincia_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
