-- Archivo SQL para crear la tabla de libros
-- Base de datos: dbfabriconde_pw2526

-- Crear la tabla libros si no existe
CREATE TABLE IF NOT EXISTS libros (
    isbn VARCHAR(13) NOT NULL PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    autor VARCHAR(100) NOT NULL,
    editorial VARCHAR(100) NOT NULL,
    numPaginas INT NOT NULL,
    anio INT NOT NULL
);

-- Insertar algunos libros de ejemplo (opcional)
INSERT IGNORE INTO libros (isbn, titulo, autor, editorial, numPaginas, anio) VALUES 
('9781234567890', 'Don Quijote de La Mancha', 'Miguel de Cervantes', 'Editorial Planeta', 863, 1605),
('9780987654321', 'Cien años de soledad', 'Gabriel García Márquez', 'Editorial Sudamericana', 471, 1967),
('9781111111111', 'La Casa de los Espíritus', 'Isabel Allende', 'Editorial Plaza & Janés', 433, 1982),
('9782222222222', 'Rayuela', 'Julio Cortázar', 'Editorial Sudamericana', 635, 1963),
('9783333333333', 'El Aleph', 'Jorge Luis Borges', 'Editorial Emecé', 203, 1949);

-- Verificar que la tabla se creó correctamente
DESCRIBE libros;