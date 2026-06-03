<?php
session_start();
require_once __DIR__ . '/../config/db_alta_usuario.php';

$errores = [];
$mensaje = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {   
    $campos = ['email', 'password'];

    foreach ($campos as $campo) {
        if (!isset($_POST[$campo]) || trim($_POST[$campo]) === '') {
            $errores[$campo] = 'Se tiene que rellenar el campo ' . $campo . '.';
        }
    }

    $datosUsuario = array(
        'email' => $_POST['email'],
    );
    
    $_SESSION['datosUsuario'] = $datosUsuario;

    if (!empty($errores)) {
        $_SESSION['errores'] = $errores;

        header('Location: ../index.php');
        exit;
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
            
            header('Location: ../index.php');
            exit;
        }
    } catch (Exception $e) {
        $_SESSION['errores'][] = $e->getMessage();
        header('Location: ../index.php');
        exit;
    }    
}

    
    