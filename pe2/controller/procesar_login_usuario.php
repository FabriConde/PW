<?php
session_start();
require_once __DIR__ . '/../config/db_alta_usuario.php';

$errores = [];
$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $campos = ['nombre', 'apellidos', 'fecha-nacimiento', 'edad', 'dni', 'telefono', 'email', 'usuario', 'password',
    'genero', 'nacionalidad', 'destino', 'tipo-viaje', 'acompanantes', 'comentarios', 'web'];

    $camposRellenos = true;

    foreach ($campos as $campo) {
        if (!isset($_POST[$campo]) || trim($_POST[$campo]) === '') {
            $errores[$campo] = 'Se tiene que rellenar el campo ' . $campo . '.';
            $camposRellenos = false;
        }
    }

    /* if (!isset($_FILES['foto']) || $_FILES['foto']['error'] != 0) {
        $errores['foto'] = 'Debe seleccionar una foto.';
    } */

    if (!isset($_POST['condiciones'])) {
        $errores['terminos'] = 'Debe aceptar los términos.';
    }

    $_SESSION['errores'] = $errores;
    $datosUsuario = array(
        'nombre' => $_POST['nombre'],
        'apellidos' => $_POST['apellidos'],
        'fecha-nacimiento' => $_POST['fecha-nacimiento'],
        'edad' => $_POST['edad'],
        'dni' => $_POST['dni'],
        'telefono' => $_POST['telefono'],
        'email' => $_POST['email'],
        'usuario' => $_POST['usuario'],
        'password' => $_POST['password'],
        'foto' => 'testo.jpg', // Aquí deberías manejar la subida de la foto y obtener su nombre o ruta
        'genero' => $_POST['genero'],
        'nacionalidad' => $_POST['nacionalidad'],
        'destino' => $_POST['destino'],
        'tipo-viaje' => $_POST['tipo-viaje'],
        'acompanantes' => $_POST['acompanantes'],
        'comentarios' => $_POST['comentarios'],
        'web' => $_POST['web'],
        'condiciones' => isset($_POST['condiciones']) ? true : false,
        "admin" => false
    );
    $_SESSION['datosUsuario'] = $datosUsuario;
    if (!$camposRellenos) {
        header('Location: ../altausuarios.php');
        exit;
    }

    try {
        $resultado = Usuario::insertarUsuario($datosUsuario);
        if ($resultado) {
            $mensaje = "Usuario insertado correctamente";
        }
    } catch (Exception $e) {
        $mensaje = "Error al insertar el usuario: " . $e->getMessage();
    }

     $_SESSION['mensaje'] = $mensaje;

    echo '<pre>';
    print_r($errores);
    echo '</pre>';


}



$passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);


    
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