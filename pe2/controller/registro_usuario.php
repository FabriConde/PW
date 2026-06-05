<?php
require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../config/db_usuarios.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $campos_obligatorios = ['nombre', 'apellidos', 'fecha-nacimiento', 'edad', 'dni', 'telefono', 'email', 'usuario', 'password',
    'genero', 'nacionalidad', 'destino', 'tipo-viaje', 'acompanantes',];

    foreach ($campos_obligatorios as $campo) {
        if (!isset($_POST[$campo]) || trim($_POST[$campo]) === '') {
            $_SESSION['error'] = 'Por favor, completa todos los campos obligatorios.';
            $_SESSION['datosUsuario'] = $_POST;
            header('Location: ../altausuarios.php');
            exit;
        }
    }
    
    if (!isset($_POST['condiciones'])) {
        $_SESSION['error'] = 'Debes aceptar las condiciones de uso.';
        $_SESSION['datosUsuario'] = $_POST;
        header('Location: ../altausuarios.php');
        exit;
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
        //Comprobar si se ha subido una foto, si no se ha subido, asignar un valor por defecto: default.jpg
        'foto' => (isset($_FILES['foto']['name']) && trim($_FILES['foto']['name']) !== '') ? $_FILES['foto']['name'] : 'default.jpg',
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

    try {
        $resultado = Usuario::insertarUsuario($datosUsuario);
        if ($resultado) {
            $_SESSION['mensaje'] = "Usuario registrado correctamente";
            header('Location: ../altausuarios.php');
            exit;
        } else {
            $_SESSION['error'] = 'Error al registrar el usuario.';
            $_SESSION['datosUsuario'] = $_POST;
            header('Location: ../altausuarios.php');
            exit;
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        $_SESSION['datosUsuario'] = $_POST;
        header('Location: ../altausuarios.php');
        exit;
    }
}