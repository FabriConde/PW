<?php
require_once('database.php');

$mensaje = "";
$tipo_mensaje = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $accion = $_POST['accion'] ?? 'insertar';
    
    if (isset($_POST['isbn']) && isset($_POST['titulo']) && isset($_POST['autor']) && 
        isset($_POST['editorial']) && isset($_POST['numPaginas']) && isset($_POST['anio'])) {
        
        $errores = array();
        
        $isbn = trim($_POST['isbn']);
        $titulo = trim($_POST['titulo']);
        $autor = trim($_POST['autor']);
        $editorial = trim($_POST['editorial']);
        $numPaginas = intval($_POST['numPaginas']);
        $anio = intval($_POST['anio']);
        
        if ($accion == 'insertar') {
            $libroExistente = Libro::obtenerLibro($isbn);
            if ($libroExistente) {
                $errores[] = "Ya existe un libro con ese ISBN";
            }
        } elseif ($accion == 'actualizar') {
            $libroExistente = Libro::obtenerLibro($isbn);
            if (!$libroExistente) {
                $errores[] = "No existe un libro con ese ISBN para actualizar";
            }
        }
        
        if (empty($errores)) {
            $datosLibro = array(
                'isbn' => $isbn,
                'titulo' => $titulo,
                'autor' => $autor,
                'editorial' => $editorial,
                'numPaginas' => $numPaginas,
                'anio' => $anio
            );
            
            try {
                if ($accion == 'insertar') {
                    $resultado = Libro::insertarLibro($datosLibro);
                    if ($resultado) {
                        $mensaje = "Libro insertado correctamente";
                        $tipo_mensaje = "exito";
                    }
                } elseif ($accion == 'actualizar') {
                    $resultado = Libro::actualizarLibro($datosLibro);
                    if ($resultado) {
                        $mensaje = "Libro actualizado correctamente";
                        $tipo_mensaje = "exito";
                    }
                }
            } catch (Exception $e) {
                $mensaje = "Error al " . ($accion == 'insertar' ? 'insertar' : 'actualizar') . " el libro: " . $e->getMessage();
                $tipo_mensaje = "error";
            }
        } else {
            $mensaje = implode("<br>", $errores);
            $tipo_mensaje = "error";
        }
    } else {
        $mensaje = "Todos los campos son obligatorios";
        $tipo_mensaje = "error";
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $isbn = trim($_GET['isbn']);
    $libroExistente = Libro::obtenerLibro($isbn);
    if ($libroExistente) {
        // Convertir el objeto Libro a array
        $datos = array(
            'isbn' => $libroExistente->devolverValor('isbn'),
            'titulo' => $libroExistente->devolverValor('titulo'),
            'autor' => $libroExistente->devolverValor('autor'),
            'editorial' => $libroExistente->devolverValor('editorial'),
            'numPaginas' => $libroExistente->devolverValor('numPaginas'),
            'anio' => $libroExistente->devolverValor('anio')
        );
    } else {
        $mensaje = "No se encontró un libro con ese ISBN";
        $tipo_mensaje = "error";
    }
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista</title>
</head>
<body>
    <h2>Resultados</h2>
    
    <?php if (!empty($mensaje)): ?>
        <div class="mensaje <?php echo $tipo_mensaje; ?>">
            <?php echo $mensaje; ?>
        </div>
    <?php endif; ?>
    <hr>
    <br>
    <?php
        // Obtener todos los libros
        try {
            list($libros, $totalLibros) = Libro::obtenerLibros();
        } catch (Exception $e) {
            $error = "Error al obtener los libros: " . $e->getMessage();
        }
    ?>
    <?php if ($totalLibros > 0): ?>
        <table>
            <thead>
                <tr>
                    <th class="isbn-column">ISBN</th>
                    <th class="titulo-column">Título</th>
                    <th class="autor-column">Autor</th>
                    <th class="editorial-column">Editorial</th>
                    <th class="paginas-column">Páginas</th>
                    <th class="anio-column">Año</th>
                    <th class="acciones-column">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($libros as $libro): ?>
                    <tr>
                        <td class="isbn-column"><?php echo htmlspecialchars($libro->devolverValor('isbn')); ?></td>
                        <td class="titulo-column"><?php echo htmlspecialchars($libro->devolverValor('titulo')); ?></td>
                        <td class="autor-column"><?php echo htmlspecialchars($libro->devolverValor('autor')); ?></td>
                        <td class="editorial-column"><?php echo htmlspecialchars($libro->devolverValor('editorial')); ?></td>
                        <td class="paginas-column"><?php echo htmlspecialchars($libro->devolverValor('numPaginas')); ?></td>
                        <td class="anio-column"><?php echo htmlspecialchars($libro->devolverValor('anio')); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <div class="total-libros">
            Total de libros: <?php echo $totalLibros; ?>
        </div>
                
        <?php endif; ?>

        <form id="formularioLibro" method="POST" action="procesar_libro.php">
            <input type="hidden" name="accion" value="<?php echo !empty($datos['isbn']) ? 'actualizar' : 'insertar'; ?>">
            
            <label for="isbn">ISBN:</label>
            <input type="text" id="isbn" value="<?php echo htmlspecialchars($datos['isbn'] ?? ''); ?>" name="isbn" required <?php echo !empty($datos['isbn']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['isbn']) ? 'readonly' : ''; ?>>
        
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" value="<?php echo htmlspecialchars($datos['titulo'] ?? ''); ?>" name="titulo" required>        
        
            <label for="autor">Autor:</label>
            <input type="text" id="autor" value="<?php echo htmlspecialchars($datos['autor'] ?? ''); ?>" name="autor" required>
        
            <label for="editorial">Editorial:</label>
            <input type="text" id="editorial" value="<?php echo htmlspecialchars($datos['editorial'] ?? ''); ?>" name="editorial" required>

            <label for="numPaginas">Número de Páginas:</label>
            <input type="number" id="numPaginas" value="<?php echo htmlspecialchars($datos['numPaginas'] ?? ''); ?>" name="numPaginas" required>
        
            <label for="anio">Año de Publicación:</label>
            <input type="number" id="anio" value="<?php echo htmlspecialchars($datos['anio'] ?? ''); ?>" name="anio" required>

            <button type="submit"><?php echo !empty($datos['isbn']) ? 'Actualizar Libro' : 'Insertar Libro'; ?></button>
        </form>
        
</body>
</html>