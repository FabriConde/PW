<?php
require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../config/db_usuarios.php';

$erroresLogin = [];
$mensaje = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {   
    $campos = ['email', 'password'];

    foreach ($campos as $campo) {
        if (!isset($_POST[$campo]) || trim($_POST[$campo]) === '') {
            $erroresLogin[$campo] = 'Se tiene que rellenar el campo ' . $campo . '.';
        }
    }

    $datosUsuario = array(
        'email' => $_POST['email'],
    );
    
    $_SESSION['datosUsuario'] = $datosUsuario;

    if (!empty($erroresLogin)) {
        $_SESSION['erroresLogin'] = $erroresLogin;

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
            $_SESSION['esAdmin'] = $resultado['admin'];
            
            header('Location: ../index.php');
            exit;
        }   else {
            $_SESSION['erroresLogin']['general'] = 'Usuario o contraseña incorrectos.';
            header('Location: ../index.php');
            exit;
        }
    } catch (Exception $e) {
        $_SESSION['erroresLogin']['general'] = $e->getMessage();
        header('Location: ../index.php');
        exit;
    }    
}

    
    