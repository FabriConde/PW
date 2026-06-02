<?php
//require_once('database.php');

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $campos = ['nombre', 'apellidos', 'fecha-nacimiento', 'edad', 'dni', 'telefono', 'email', 'usuario', 'password', 
    'foto', 'genero', 'nacionalidad', 'destino', 'tipo-viaje', 'acompanantes', 'comentarios', 'web', 'terminos'];

    $camposRellenos = true;

    foreach ($campos as $campo) {
        if (!isset($_POST[$campo]) || trim($_POST[$campo]) === '') {
            $mensaje .= 'Se tiene que rellenar el campo ' . $campo . '.<br>';
            $camposRellenos = false;
            break;
        }
    }

   echo $mensaje;
}






    
    /* if (isset($_POST['isbn']) && isset($_POST['titulo']) && isset($_POST['autor']) && 
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
} */