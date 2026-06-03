-- Base de datos: dbfabriconde_pw2526

-- Crear la tabla usuarios si no existe
CREATE TABLE IF NOT EXISTS  usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(40) NOT NULL,
    apellidos VARCHAR(60) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    edad INT NOT NULL,
    dni VARCHAR(9) NOT NULL UNIQUE,
    telefono VARCHAR(15) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    foto VARCHAR(255) NOT NULL,
    genero VARCHAR(20) NOT NULL,
    nacionalidad VARCHAR(50) NOT NULL,
    destino VARCHAR(100) NOT NULL,
    tipo_viaje VARCHAR(50) NOT NULL,
    acompanantes INT NOT NULL,
    comentarios TEXT,
    web VARCHAR(255) NOT NULL,
    condiciones BOOLEAN DEFAULT FALSE NOT NULL,
    admin BOOLEAN DEFAULT FALSE NOT NULL
);