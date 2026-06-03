<?php
session_start();
require_once __DIR__ . '/../config/db_viajes.php';

$erroresViaje = [];
$mensajeViaje = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {   
    $campos = ['destino', 'fecha-inicio', 'fecha-fin', 'descripcion', 'descripcion_larga', 'precio', 'incluye', 'alojamientos', 'continente', 'pais', 'imagen'];

    foreach ($campos as $campo) {
        if (!isset($_POST[$campo]) || trim($_POST[$campo]) === '') {
            $erroresViaje[$campo] = 'Se tiene que rellenar el campo ' . $campo . '.';
        }
    }

    $datosViaje = array(
        'destino' => $_POST['destino'],
        'fecha-inicio' => $_POST['fecha-inicio'],
        'fecha-fin' => $_POST['fecha-fin'],
        'descripcion' => $_POST['descripcion'],
        'descripcion_larga' => $_POST['descripcion_larga'],
        'precio' => $_POST['precio'],
        'incluye' => $_POST['incluye'],
        'alojamientos' => $_POST['alojamientos'],
        'continente' => $_POST['continente'],
        'pais' => $_POST['pais'],
        'imagen' => $_POST['imagen'],
    );
    
    $_SESSION['datosViaje'] = $datosViaje;

    if (!empty($erroresViaje)) {
        $_SESSION['erroresViaje'] = $erroresViaje;

        header('Location: ../alta_viaje.php');
        exit;
    }

    try {
        $resultado = Viajes::insertarViaje($datosViaje);
        if ($resultado) {
            $_SESSION['mensajeViaje'] = "Viaje creado correctamente";    
            header('Location: ../alta_viaje.php');
            exit;
        }   else {
            $_SESSION['erroresViaje']['general'] = 'Error al crear el viaje.';
            header('Location: ../alta_viaje.php');
            exit;
        }
    } catch (Exception $e) {
        $_SESSION['erroresViaje']['general'] = $e->getMessage();
        header('Location: ../alta_viaje.php');
        exit;
    }    
}