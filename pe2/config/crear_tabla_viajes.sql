-- Base de datos: dbfabriconde_pw2526
CREATE TABLE IF NOT EXISTS viajes (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  destino VARCHAR(255) NOT NULL,
  fecha_inicio DATE NOT NULL,
  fecha_fin DATE NOT NULL,
  descripcion_corta VARCHAR(255) NOT NULL,
  descripcion_larga TEXT NOT NULL,
  precio DECIMAL(10,2) NOT NULL,
  incluye TEXT NOT NULL,
  alojamientos TEXT NOT NULL,
  imagen VARCHAR(255) NOT NULL,
  continente VARCHAR(100) NOT NULL,
  pais VARCHAR(100) NOT NULL
);

INSERT INTO viajes (destino, fecha_inicio, fecha_fin, descripcion_corta, descripcion_larga, precio, incluye, alojamientos, imagen, continente, pais) VALUES 
-- FRANCIA
('París', '2026-05-10', '2026-05-17', 'Hotel céntrico, visitas guiadas y crucero por el Sena.', '', 0.00, '', '', 'francia/paris.jpg', 'Europa', 'Francia'),
('Lyon', '2026-06-01', '2026-06-08', 'Ruta de bouchons, casco antiguo y cata de vinos.', '', 0.00, '', '', 'francia/lyon.jpg', 'Europa', 'Francia'),
('Niza', '2026-06-12', '2026-06-19', 'Playas mediterráneas, pueblos costeros y tiempo libre.', '', 0.00, '', '', 'francia/niza.jpg', 'Europa', 'Francia'),
('Burdeos', '2026-06-20', '2026-06-27', 'Enoturismo, arquitectura clásica y ruta en bicicleta.', '', 0.00, '', '', 'francia/burdeos.jpg', 'Europa', 'Francia'),
('Marsella', '2026-07-10', '2026-07-17', 'Puerto antiguo, calas mediterráneas y gastronomía marinera.', '', 0.00, '', '', 'francia/marsella.jpg', 'Europa', 'Francia'),
('Toulouse', '2026-07-12', '2026-07-19', 'Ciudad rosa, canales y ambiente universitario.', '', 0.00, '', '', 'francia/toulouse.jpg', 'Europa', 'Francia'),

-- ITALIA
('Roma', '2026-05-05', '2026-05-12', 'El Coliseo, el Vaticano y la historia del Imperio Romano.', '', 0.00, '', '', 'italia/roma.jpg', 'Europa', 'Italia'),
('Florencia', '2026-05-13', '2026-05-17', 'Cuna del Renacimiento, el Duomo y la Galería Uffizi.', '', 0.00, '', '', 'italia/florencia.jpg', 'Europa', 'Italia'),
('Venecia', '2026-02-20', '2026-02-25', 'Canales románticos, góndolas y la Plaza de San Marcos.', '', 0.00, '', '', 'italia/venecia.jpg', 'Europa', 'Italia'),
('Milán', '2026-10-10', '2026-10-15', 'Capital de la moda, el Duomo y el teatro de La Scala.', '', 0.00, '', '', 'italia/milan.jpg', 'Europa', 'Italia'),
('Nápoles', '2026-06-12', '2026-06-18', 'Historia viva, Pompeya y la auténtica pizza napolitana.', '', 0.00, '', '', 'italia/napoles.jpg', 'Europa', 'Italia'),
('Palermo', '2026-09-15', '2026-09-21', 'Tesoros árabes-normandos y mercados sicilianos vibrantes.', '', 0.00, '', '', 'italia/palermo.jpg', 'Europa', 'Italia'),

-- ESPAÑA
('Madrid', '2026-05-15', '2026-05-22', 'Museos del Prado y Reina Sofía, Retiro y vida nocturna.', '', 0.00, '', '', 'espana/madrid.jpg', 'Europa', 'España'),
('Barcelona', '2026-05-25', '2026-06-01', 'Arquitectura de Gaudí, Sagrada Familia y playas urbanas.', '', 0.00, '', '', 'espana/barcelona.jpg', 'Europa', 'España'),
('Sevilla', '2026-04-10', '2026-04-17', 'Reales Alcázares, la Giralda y esencia del flamenco.', '', 0.00, '', '', 'espana/sevilla.jpg', 'Europa', 'España'),
('Granada', '2026-04-18', '2026-04-22', 'El majestuoso conjunto de la Alhambra y el barrio del Albaicín.', '', 0.00, '', '', 'espana/granada.jpg', 'Europa', 'España'),
('Valencia', '2026-03-12', '2026-03-19', 'Ciudad de las Artes y las Ciencias y cuna de la paella.', '', 0.00, '', '', 'espana/valencia.jpg', 'Europa', 'España'),
('Bilbao', '2026-09-05', '2026-09-12', 'Museo Guggenheim, gastronomía vasca y diseño moderno.', '', 0.00, '', '', 'espana/bilbao.jpg', 'Europa', 'España'),

-- CANADÁ
('Montreal', '2026-05-14', '2026-05-21', 'Recorrido histórico, gastronomía local y excursión urbana.', '', 0.00, '', '', 'canada/montreal.jpg', 'América', 'Canadá'),
('Quebec', '2026-06-03', '2026-06-11', 'Patrimonio UNESCO, museos y paseo por ciudad amurallada.', '', 0.00, '', '', 'canada/quebec.jpg', 'América', 'Canadá'),
('Toronto', '2026-06-15', '2026-06-23', 'CN Tower, crucero urbano y escapada a Niágara.', '', 0.00, '', '', 'canada/toronto.jpg', 'América', 'Canadá'),
('Vancouver', '2026-06-22', '2026-06-30', 'Parques, senderismo suave y barrio costero de moda.', '', 0.00, '', '', 'canada/vancouver.jpg', 'América', 'Canadá'),
('Ottawa', '2026-06-29', '2026-07-06', 'Parlamento, museos nacionales y bicicleta urbana.', '', 0.00, '', '', 'canada/ottawa.jpg', 'América', 'Canadá'),
('Victoria', '2026-07-20', '2026-07-28', 'Jardines, puerto pintoresco y estilo británico.', '', 0.00, '', '', 'canada/victoria.jpg', 'América', 'Canadá'),

-- BRASIL
('Río de Janeiro', '2026-02-12', '2026-02-20', 'El Cristo Redentor, el Pan de Azúcar y Copacabana.', '', 0.00, '', '', 'brasil/rio-janeiro.jpg', 'América', 'Brasil'),
('São Paulo', '2026-03-15', '2026-03-22', 'Metrópolis cultural, arte callejero y alta cocina.', '', 0.00, '', '', 'brasil/sao-paulo.jpg', 'América', 'Brasil'),
('Salvador de Bahía', '2026-01-05', '2026-01-12', 'El Pelourinho, cultura afro-brasileña y percusión.', '', 0.00, '', '', 'brasil/salvador-bahia.jpg', 'América', 'Brasil'),
('Manaos', '2026-07-10', '2026-07-17', 'Puerta de entrada a la selva del Amazonas.', '', 0.00, '', '', 'brasil/manaos.jpg', 'América', 'Brasil'),
('Brasilia', '2026-08-15', '2026-08-20', 'Arquitectura modernista de Oscar Niemeyer.', '', 0.00, '', '', 'brasil/brasilia.jpg', 'América', 'Brasil'),
('Florianópolis', '2026-12-01', '2026-12-08', 'Playas vírgenes e islas paradisíacas al sur.', '', 0.00, '', '', 'brasil/florianopolis.jpg', 'América', 'Brasil'),

-- ESTADOS UNIDOS
('Nueva York', '2026-09-10', '2026-09-17', 'Times Square, Central Park y el Empire State Building.', '', 0.00, '', '', 'eeuu/nueva-york.jpg', 'América', 'Estados Unidos'),
('Miami', '2026-03-01', '2026-03-08', 'Playas de Art Deco, cultura latina y compras de lujo.', '', 0.00, '', '', 'eeuu/miami.jpg', 'América', 'Estados Unidos'),
('Los Ángeles', '2026-05-15', '2026-05-22', 'Hollywood, Santa Mónica y el muelle de la fama.', '', 0.00, '', '', 'eeuu/la.jpg', 'América', 'Estados Unidos'),
('San Francisco', '2026-10-10', '2026-10-17', 'El puente Golden Gate y las colinas victorianas.', '', 0.00, '', '', 'eeuu/san-francisco.jpg', 'América', 'Estados Unidos'),
('Las Vegas', '2026-04-12', '2026-04-17', 'El Strip, espectáculos mundiales y casinos icónicos.', '', 0.00, '', '', 'eeuu/las-vegas.jpg', 'América', 'Estados Unidos'),
('Chicago', '2026-06-15', '2026-06-21', 'Arquitectura rascacielos, parques y el lago Michigan.', '', 0.00, '', '', 'eeuu/chicago.jpg', 'América', 'Estados Unidos'),

-- CHINA
('Pekín', '2026-05-20', '2026-05-30', 'Ciudad Prohibida, Gran Muralla y mercado nocturno.', '', 0.00, '', '', 'china/pekin.jpg', 'Asia', 'China'),
('Shanghái', '2026-06-05', '2026-06-14', 'Skyline del Bund, jardines clásicos y compras.', '', 0.00, '', '', 'china/shanghai.jpg', 'Asia', 'China'),
('Xi''an', '2026-06-17', '2026-06-25', 'Guerreros de terracota y rutas culturales.', '', 0.00, '', '', 'china/xian.jpg', 'Asia', 'China'),
('Guangzhou', '2026-06-24', '2026-07-02', 'Templos, mercados y experiencia culinaria cantonesa.', '', 0.00, '', '', 'china/guangzhou.jpg', 'Asia', 'China'),
('Suzhou', '2026-06-30', '2026-07-08', 'Canales antiguos, jardines clásicos y té tradicional.', '', 0.00, '', '', 'china/suzhou.jpg', 'Asia', 'China'),
('Hong Kong', '2026-07-10', '2026-07-18', 'Rascacielos, mercados nocturnos y vistas al puerto.', '', 0.00, '', '', 'china/hong-kong.jpg', 'Asia', 'China'),

-- JAPÓN
('Tokio', '2026-03-25', '2026-04-02', 'El cruce de Shibuya, templos antiguos y luces de neón.', '', 0.00, '', '', 'japon/tokio.jpg', 'Asia', 'Japón'),
('Kioto', '2026-04-03', '2026-04-08', 'Tradición milenaria, geishas y el Pabellón Dorado.', '', 0.00, '', '', 'japon/kioto.jpg', 'Asia', 'Japón'),
('Osaka', '2026-04-10', '2026-04-15', 'Gastronomía callejera, Universal Studios y ambiente urbano.', '', 0.00, '', '', 'japon/osaka.jpg', 'Asia', 'Japón'),
('Hiroshima', '2026-05-20', '2026-05-24', 'Parque de la Paz e isla de Miyajima con su torii flotante.', '', 0.00, '', '', 'japon/hiroshima.jpg', 'Asia', 'Japón'),
('Nara', '2026-11-05', '2026-11-08', 'Ciervos sagrados en libertad y el Buda gigante de Todai-ji.', '', 0.00, '', '', 'japon/nara.jpg', 'Asia', 'Japón'),
('Sapporo', '2026-02-01', '2026-02-08', 'Festival de la nieve, termas naturales y paisajes nórdicos.', '', 0.00, '', '', 'japon/sapporo.jpg', 'Asia', 'Japón'),

-- MARRUECOS
('Marrakech', '2026-10-10', '2026-10-17', 'Plaza Jemaa el-Fna, zocos y jardines Majorelle.', '', 0.00, '', '', 'marruecos/marrakech.jpg', 'África', 'Marruecos'),
('Fez', '2026-10-18', '2026-10-23', 'La medina peatonal más grande del mundo y curtidurías.', '', 0.00, '', '', 'marruecos/fez.jpg', 'África', 'Marruecos'),
('Casablanca', '2026-04-05', '2026-04-10', 'La Gran Mezquita Hassan II y modernidad atlántica.', '', 0.00, '', '', 'marruecos/casablanca.jpg', 'África', 'Marruecos'),
('Rabat', '2026-04-12', '2026-04-16', 'Capital administrativa, la Torre Hassan y el Mausoleo.', '', 0.00, '', '', 'marruecos/rabat.jpg', 'África', 'Marruecos'),
('Tánger', '2026-05-15', '2026-05-20', 'Puerta entre Europa y África con encanto literario.', '', 0.00, '', '', 'marruecos/tanger.jpg', 'África', 'Marruecos'),
('Chefchaouen', '2026-05-22', '2026-05-26', 'La famosa ciudad azul en las montañas del Rif.', '', 0.00, '', '', 'marruecos/chefchaouen.jpg', 'África', 'Marruecos'),

-- TAILANDIA
('Bangkok', '2026-01-10', '2026-01-17', 'Templos dorados, palacios reales y mercados flotantes.', '', 0.00, '', '', 'tailandia/bangkok.jpg', 'Asia', 'Tailandia'),
('Chiang Mai', '2026-01-18', '2026-01-23', 'Santuarios de elefantes y templos en la montaña.', '', 0.00, '', '', 'tailandia/chiangmai.jpg', 'Asia', 'Tailandia'),
('Phuket', '2026-02-01', '2026-02-08', 'Playas de aguas cristalinas y vida nocturna animada.', '', 0.00, '', '', 'tailandia/phuket.jpg', 'Asia', 'Tailandia'),
('Krabi', '2026-02-10', '2026-02-15', 'Acantilados de piedra caliza y cuevas junto al mar.', '', 0.00, '', '', 'tailandia/krabi.jpg', 'Asia', 'Tailandia'),
('Ayutthaya', '2026-11-15', '2026-11-18', 'Ruinas históricas del antiguo reino de Siam.', '', 0.00, '', '', 'tailandia/ayutthaya.jpg', 'Asia', 'Tailandia'),
('Pattaya', '2026-11-20', '2026-11-25', 'Resorts costeros, parques temáticos y ocio familiar.', '', 0.00, '', '', 'tailandia/pattaya.jpg', 'Asia', 'Tailandia');
