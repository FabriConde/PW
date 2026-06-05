<?php
require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../config/db_usuarios.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $campos_obligatorios = ['email', 'password'];

    foreach ($campos_obligatorios as $campo) {
        if (!isset($_POST[$campo]) || trim($_POST[$campo]) === '') {
            $_SESSION['errorLogin'] = 'Por favor, completa todos los campos obligatorios.';
            header('Location: ../index.php');
            exit;
        }
    }

    $datosUsuario = array(
        'email' => $_POST['email'],
        'password' => $_POST['password']
    );

    try {
        $resultado = Usuario::logearUsuario($datosUsuario);
        if ($resultado) {
            session_regenerate_id(true);
            $_SESSION['logeado'] = true;
            $_SESSION['nombreUsuario'] = $resultado['usuario'];
            $_SESSION['esAdmin'] = $resultado['admin'];
            header('Location: ../index.php');
            exit;
        } else {
            $_SESSION['errorLogin'] = 'Usuario o contraseña incorrectos.';
            header('Location: ../index.php');
            exit;
        }
    } catch (Exception $e) {
        $_SESSION['errorLogin'] = $e->getMessage();
        header('Location: ../index.php');
        exit;
    }    
}

    
    