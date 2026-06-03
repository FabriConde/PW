-- Script para crear la tabla `viajes` en MySQL
CREATE TABLE IF NOT EXISTS viajes (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  destino VARCHAR(255) NOT NULL,
  fecha_inicio DATE DEFAULT NULL,
  fecha_fin DATE DEFAULT NULL,
  descripcion_corta VARCHAR(255) DEFAULT NULL,
  descripcion_larga TEXT DEFAULT NULL,
  precio DECIMAL(10,2) DEFAULT NULL,
  incluye TEXT DEFAULT NULL,
  alojamientos TEXT DEFAULT NULL,
  imagen VARCHAR(255) DEFAULT NULL,
  continente VARCHAR(100) DEFAULT NULL,
  pais VARCHAR(100) DEFAULT NULL
);

INSERT INTO viajes (destino, fecha_inicio, fecha_fin, descripcion_corta, descripcion_larga, precio, incluye, alojamientos, imagen, continente, pais) VALUES 
-- FRANCIA
('París', '2026-05-10', '2026-05-17', 'Hotel céntrico, visitas guiadas y crucero por el Sena.', NULL, NULL, NULL, NULL, 'imagenes/francia/paris.jpg', 'Europa', 'Francia'),
('Lyon', '2026-06-01', '2026-06-08', 'Ruta de bouchons, casco antiguo y cata de vinos.', NULL, NULL, NULL, NULL, 'imagenes/francia/lyon.jpg', 'Europa', 'Francia'),
('Niza', '2026-06-12', '2026-06-19', 'Playas mediterráneas, pueblos costeros y tiempo libre.', NULL, NULL, NULL, NULL, 'imagenes/francia/niza.jpg', 'Europa', 'Francia'),
('Burdeos', '2026-06-20', '2026-06-27', 'Enoturismo, arquitectura clásica y ruta en bicicleta.', NULL, NULL, NULL, NULL, 'imagenes/francia/burdeos.jpg', 'Europa', 'Francia'),
('Marsella', '2026-07-10', '2026-07-17', 'Puerto antiguo, calas mediterráneas y gastronomía marinera.', NULL, NULL, NULL, NULL, 'imagenes/francia/marsella.jpg', 'Europa', 'Francia'),
('Toulouse', '2026-07-12', '2026-07-19', 'Ciudad rosa, canales y ambiente universitario.', NULL, NULL, NULL, NULL, 'imagenes/francia/toulouse.jpg', 'Europa', 'Francia'),

-- ITALIA
('Roma', '2026-05-05', '2026-05-12', 'El Coliseo, el Vaticano y la historia del Imperio Romano.', NULL, NULL, NULL, NULL, 'imagenes/italia/roma.jpg', 'Europa', 'Italia'),
('Florencia', '2026-05-13', '2026-05-17', 'Cuna del Renacimiento, el Duomo y la Galería Uffizi.', NULL, NULL, NULL, NULL, 'imagenes/italia/florencia.jpg', 'Europa', 'Italia'),
('Venecia', '2026-02-20', '2026-02-25', 'Canales románticos, góndolas y la Plaza de San Marcos.', NULL, NULL, NULL, NULL, 'imagenes/italia/venecia.jpg', 'Europa', 'Italia'),
('Milán', '2026-10-10', '2026-10-15', 'Capital de la moda, el Duomo y el teatro de La Scala.', NULL, NULL, NULL, NULL, 'imagenes/italia/milan.jpg', 'Europa', 'Italia'),
('Nápoles', '2026-06-12', '2026-06-18', 'Historia viva, Pompeya y la auténtica pizza napolitana.', NULL, NULL, NULL, NULL, 'imagenes/italia/napoles.jpg', 'Europa', 'Italia'),
('Palermo', '2026-09-15', '2026-09-21', 'Tesoros árabes-normandos y mercados sicilianos vibrantes.', NULL, NULL, NULL, NULL, 'imagenes/italia/palermo.jpg', 'Europa', 'Italia'),

-- ESPAÑA
('Madrid', '2026-05-15', '2026-05-22', 'Museos del Prado y Reina Sofía, Retiro y vida nocturna.', NULL, NULL, NULL, NULL, 'imagenes/espana/madrid.jpg', 'Europa', 'España'),
('Barcelona', '2026-05-25', '2026-06-01', 'Arquitectura de Gaudí, Sagrada Familia y playas urbanas.', NULL, NULL, NULL, NULL, 'imagenes/espana/barcelona.jpg', 'Europa', 'España'),
('Sevilla', '2026-04-10', '2026-04-17', 'Reales Alcázares, la Giralda y esencia del flamenco.', NULL, NULL, NULL, NULL, 'imagenes/espana/sevilla.jpg', 'Europa', 'España'),
('Granada', '2026-04-18', '2026-04-22', 'El majestuoso conjunto de la Alhambra y el barrio del Albaicín.', NULL, NULL, NULL, NULL, 'imagenes/espana/granada.jpg', 'Europa', 'España'),
('Valencia', '2026-03-12', '2026-03-19', 'Ciudad de las Artes y las Ciencias y cuna de la paella.', NULL, NULL, NULL, NULL, 'imagenes/espana/valencia.jpg', 'Europa', 'España'),
('Bilbao', '2026-09-05', '2026-09-12', 'Museo Guggenheim, gastronomía vasca y diseño moderno.', NULL, NULL, NULL, NULL, 'imagenes/espana/bilbao.jpg', 'Europa', 'España'),

-- CANADÁ
('Montreal', '2026-05-14', '2026-05-21', 'Recorrido histórico, gastronomía local y excursión urbana.', NULL, NULL, NULL, NULL, 'imagenes/canada/montreal.jpg', 'América', 'Canadá'),
('Quebec', '2026-06-03', '2026-06-11', 'Patrimonio UNESCO, museos y paseo por ciudad amurallada.', NULL, NULL, NULL, NULL, 'imagenes/canada/quebec.jpg', 'América', 'Canadá'),
('Toronto', '2026-06-15', '2026-06-23', 'CN Tower, crucero urbano y escapada a Niágara.', NULL, NULL, NULL, NULL, 'imagenes/canada/toronto.jpg', 'América', 'Canadá'),
('Vancouver', '2026-06-22', '2026-06-30', 'Parques, senderismo suave y barrio costero de moda.', NULL, NULL, NULL, NULL, 'imagenes/canada/vancouver.jpg', 'América', 'Canadá'),
('Ottawa', '2026-06-29', '2026-07-06', 'Parlamento, museos nacionales y bicicleta urbana.', NULL, NULL, NULL, NULL, 'imagenes/canada/ottawa.jpg', 'América', 'Canadá'),
('Victoria', '2026-07-20', '2026-07-28', 'Jardines, puerto pintoresco y estilo británico.', NULL, NULL, NULL, NULL, 'imagenes/canada/victoria.jpg', 'América', 'Canadá'),

-- BRASIL
('Río de Janeiro', '2026-02-12', '2026-02-20', 'El Cristo Redentor, el Pan de Azúcar y Copacabana.', NULL, NULL, NULL, NULL, 'imagenes/brasil/rio-janeiro.jpg', 'América', 'Brasil'),
('São Paulo', '2026-03-15', '2026-03-22', 'Metrópolis cultural, arte callejero y alta cocina.', NULL, NULL, NULL, NULL, 'imagenes/brasil/sao-paulo.jpg', 'América', 'Brasil'),
('Salvador de Bahía', '2026-01-05', '2026-01-12', 'El Pelourinho, cultura afro-brasileña y percusión.', NULL, NULL, NULL, NULL, 'imagenes/brasil/salvador-bahia.jpg', 'América', 'Brasil'),
('Manaos', '2026-07-10', '2026-07-17', 'Puerta de entrada a la selva del Amazonas.', NULL, NULL, NULL, NULL, 'imagenes/brasil/manaos.jpg', 'América', 'Brasil'),
('Brasilia', '2026-08-15', '2026-08-20', 'Arquitectura modernista de Oscar Niemeyer.', NULL, NULL, NULL, NULL, 'imagenes/brasil/brasilia.jpg', 'América', 'Brasil'),
('Florianópolis', '2026-12-01', '2026-12-08', 'Playas vírgenes e islas paradisíacas al sur.', NULL, NULL, NULL, NULL, 'imagenes/brasil/florianopolis.jpg', 'América', 'Brasil'),

-- ESTADOS UNIDOS
('Nueva York', '2026-09-10', '2026-09-17', 'Times Square, Central Park y el Empire State Building.', NULL, NULL, NULL, NULL, 'imagenes/eeuu/nueva-york.jpg', 'América', 'Estados Unidos'),
('Miami', '2026-03-01', '2026-03-08', 'Playas de Art Deco, cultura latina y compras de lujo.', NULL, NULL, NULL, NULL, 'imagenes/eeuu/miami.jpg', 'América', 'Estados Unidos'),
('Los Ángeles', '2026-05-15', '2026-05-22', 'Hollywood, Santa Mónica y el muelle de la fama.', NULL, NULL, NULL, NULL, 'imagenes/eeuu/la.jpg', 'América', 'Estados Unidos'),
('San Francisco', '2026-10-10', '2026-10-17', 'El puente Golden Gate y las colinas victorianas.', NULL, NULL, NULL, NULL, 'imagenes/eeuu/san-francisco.jpg', 'América', 'Estados Unidos'),
('Las Vegas', '2026-04-12', '2026-04-17', 'El Strip, espectáculos mundiales y casinos icónicos.', NULL, NULL, NULL, NULL, 'imagenes/eeuu/las-vegas.jpg', 'América', 'Estados Unidos'),
('Chicago', '2026-06-15', '2026-06-21', 'Arquitectura rascacielos, parques y el lago Michigan.', NULL, NULL, NULL, NULL, 'imagenes/eeuu/chicago.jpg', 'América', 'Estados Unidos'),

-- CHINA
('Pekín', '2026-05-20', '2026-05-30', 'Ciudad Prohibida, Gran Muralla y mercado nocturno.', NULL, NULL, NULL, NULL, 'imagenes/china/pekin.jpg', 'Asia', 'China'),
('Shanghái', '2026-06-05', '2026-06-14', 'Skyline del Bund, jardines clásicos y compras.', NULL, NULL, NULL, NULL, 'imagenes/china/shanghai.jpg', 'Asia', 'China'),
('Xi''an', '2026-06-17', '2026-06-25', 'Guerreros de terracota y rutas culturales.', NULL, NULL, NULL, NULL, 'imagenes/china/xian.jpg', 'Asia', 'China'),
('Guangzhou', '2026-06-24', '2026-07-02', 'Templos, mercados y experiencia culinaria cantonesa.', NULL, NULL, NULL, NULL, 'imagenes/china/guangzhou.jpg', 'Asia', 'China'),
('Suzhou', '2026-06-30', '2026-07-08', 'Canales antiguos, jardines clásicos y té tradicional.', NULL, NULL, NULL, NULL, 'imagenes/china/suzhou.jpg', 'Asia', 'China'),
('Hong Kong', '2026-07-10', '2026-07-18', 'Rascacielos, mercados nocturnos y vistas al puerto.', NULL, NULL, NULL, NULL, 'imagenes/china/hong-kong.jpg', 'Asia', 'China'),

-- JAPÓN
('Tokio', '2026-03-25', '2026-04-02', 'El cruce de Shibuya, templos antiguos y luces de neón.', NULL, NULL, NULL, NULL, 'imagenes/japon/tokio.jpg', 'Asia', 'Japón'),
('Kioto', '2026-04-03', '2026-04-08', 'Tradición milenaria, geishas y el Pabellón Dorado.', NULL, NULL, NULL, NULL, 'imagenes/japon/kioto.jpg', 'Asia', 'Japón'),
('Osaka', '2026-04-10', '2026-04-15', 'Gastronomía callejera, Universal Studios y ambiente urbano.', NULL, NULL, NULL, NULL, 'imagenes/japon/osaka.jpg', 'Asia', 'Japón'),
('Hiroshima', '2026-05-20', '2026-05-24', 'Parque de la Paz e isla de Miyajima con su torii flotante.', NULL, NULL, NULL, NULL, 'imagenes/japon/hiroshima.jpg', 'Asia', 'Japón'),
('Nara', '2026-11-05', '2026-11-08', 'Ciervos sagrados en libertad y el Buda gigante de Todai-ji.', NULL, NULL, NULL, NULL, 'imagenes/japon/nara.jpg', 'Asia', 'Japón'),
('Sapporo', '2026-02-01', '2026-02-08', 'Festival de la nieve, termas naturales y paisajes nórdicos.', NULL, NULL, NULL, NULL, 'imagenes/japon/sapporo.jpg', 'Asia', 'Japón'),

-- MARRUECOS
('Marrakech', '2026-10-10', '2026-10-17', 'Plaza Jemaa el-Fna, zocos y jardines Majorelle.', NULL, NULL, NULL, NULL, 'imagenes/marruecos/marrakech.jpg', 'África', 'Marruecos'),
('Fez', '2026-10-18', '2026-10-23', 'La medina peatonal más grande del mundo y curtidurías.', NULL, NULL, NULL, NULL, 'imagenes/marruecos/fez.jpg', 'África', 'Marruecos'),
('Casablanca', '2026-04-05', '2026-04-10', 'La Gran Mezquita Hassan II y modernidad atlántica.', NULL, NULL, NULL, NULL, 'imagenes/marruecos/casablanca.jpg', 'África', 'Marruecos'),
('Rabat', '2026-04-12', '2026-04-16', 'Capital administrativa, la Torre Hassan y el Mausoleo.', NULL, NULL, NULL, NULL, 'imagenes/marruecos/rabat.jpg', 'África', 'Marruecos'),
('Tánger', '2026-05-15', '2026-05-20', 'Puerta entre Europa y África con encanto literario.', NULL, NULL, NULL, NULL, 'imagenes/marruecos/tanger.jpg', 'África', 'Marruecos'),
('Chefchaouen', '2026-05-22', '2026-05-26', 'La famosa ciudad azul en las montañas del Rif.', NULL, NULL, NULL, NULL, 'imagenes/marruecos/chefchaouen.jpg', 'África', 'Marruecos'),

-- TAILANDIA
('Bangkok', '2026-01-10', '2026-01-17', 'Templos dorados, palacios reales y mercados flotantes.', NULL, NULL, NULL, NULL, 'imagenes/tailandia/bangkok.jpg', 'Asia', 'Tailandia'),
('Chiang Mai', '2026-01-18', '2026-01-23', 'Santuarios de elefantes y templos en la montaña.', NULL, NULL, NULL, NULL, 'imagenes/tailandia/chiangmai.jpg', 'Asia', 'Tailandia'),
('Phuket', '2026-02-01', '2026-02-08', 'Playas de aguas cristalinas y vida nocturna animada.', NULL, NULL, NULL, NULL, 'imagenes/tailandia/phuket.jpg', 'Asia', 'Tailandia'),
('Krabi', '2026-02-10', '2026-02-15', 'Acantilados de piedra caliza y cuevas junto al mar.', NULL, NULL, NULL, NULL, 'imagenes/tailandia/krabi.jpg', 'Asia', 'Tailandia'),
('Ayutthaya', '2026-11-15', '2026-11-18', 'Ruinas históricas del antiguo reino de Siam.', NULL, NULL, NULL, NULL, 'imagenes/tailandia/ayutthaya.jpg', 'Asia', 'Tailandia'),
('Pattaya', '2026-11-20', '2026-11-25', 'Resorts costeros, parques temáticos y ocio familiar.', NULL, NULL, NULL, NULL, 'imagenes/tailandia/pattaya.jpg', 'Asia', 'Tailandia');
