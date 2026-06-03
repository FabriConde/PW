<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config/db_usuarios.php';

$errores = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $campos = ['nombre', 'apellidos', 'fecha-nacimiento', 'edad', 'dni', 'telefono', 'email', 'usuario', 'password',
    'genero', 'nacionalidad', 'destino', 'tipo-viaje', 'acompanantes',];

    foreach ($campos as $campo) {
        if (!isset($_POST[$campo]) || trim($_POST[$campo]) === '') {
            $errores[$campo] = 'Se tiene que rellenar el campo ' . $campo . '.';
        }
    }

    /* if (!isset($_FILES['foto']) || $_FILES['foto']['error'] != 0) {
        $errores['foto'] = 'Debe seleccionar una foto.';
    } */

    if (!isset($_POST['condiciones'])) {
        $errores['condiciones'] = 'Debe aceptar los términos.';
    }

    $datosUsuario = array(
        'nombre' => $_POST['nombre'],
        'apellidos' => $_POST['apellidos'],
        'fecha-nacimiento' => $_POST['fecha-nacimiento'],
        'edad' => $_POST['edad'],
        'dni' => $_POST['dni'],
        'telefono' => $_POST['telefono'],
        'email' => $_POST['email'],
        'usuario' => $_POST['usuario'],
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
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

    if (!empty($errores)) {
        $_SESSION['errores'] = $errores;

        header('Location: ../altausuarios.php');
        exit;
    }

    try {
        $resultado = Usuario::insertarUsuario($datosUsuario);
        if ($resultado) {
            $_SESSION['mensaje'] = "Usuario registrado correctamente";
            header('Location: ../altausuarios.php');
            exit;
        } else {
            $_SESSION['erroresGenerales']['general'] = 'Error al registrar el usuario.';
            header('Location: ../altausuarios.php');
            exit;
        }
    } catch (Exception $e) {
        $_SESSION['erroresGenerales']['general'] = $e->getMessage();
        header('Location: ../altausuarios.php');
        exit;
    }
}

    
    