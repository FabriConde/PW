<?php
require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../config/db_viajes.php';

$erroresViaje = [];
$mensajeViaje = "";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    
    $idEdicion = (int)$_GET['id'];
    try {
        $resultado = Viajes::obtenerViajePorId($idEdicion);
        if ($resultado) {
            $_SESSION['datosViaje'] = $resultado;
            header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?'));
            exit;
        } else {
            $mensajeErrorEditar = "Viaje no encontrado para edición.";
            header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?'));
            exit;
        }
    } catch (Exception $e) {
        $erroresViaje['general'] = $e->getMessage();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {   
    $campos = ['destino', 'fecha-inicio', 'fecha-fin', 'descripcion_corta', 'descripcion_larga', 'precio', 'incluye', 'alojamientos', 'continente', 'pais', 'imagen'];

    foreach ($campos as $campo) {
        if (!isset($_POST[$campo]) || trim($_POST[$campo]) === '') {
            $erroresViaje[$campo] = 'Se tiene que rellenar el campo ' . $campo . '.';
        }
    }

    $datosViaje = array(
        'destino' => $_POST['destino'],
        'fecha-inicio' => $_POST['fecha-inicio'],
        'fecha-fin' => $_POST['fecha-fin'],
        'descripcion_corta' => $_POST['descripcion_corta'],
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
        // Si viene un id en POST, actualizamos
        if (isset($_POST['id']) && is_numeric($_POST['id'])) {
            $idEdicion = (int)$_POST['id'];
            // Mapear claves para el método actualizarViaje (usa guiones bajos en nombres de fecha)
            $datosUpdate = array(
                'destino' => $_POST['destino'],
                'fecha_inicio' => $_POST['fecha-inicio'],
                'fecha_fin' => $_POST['fecha-fin'],
                'descripcion_corta' => $_POST['descripcion_corta'],
                'descripcion_larga' => $_POST['descripcion_larga'],
                'precio' => $_POST['precio'],
                'incluye' => $_POST['incluye'],
                'alojamientos' => $_POST['alojamientos'],
                'continente' => $_POST['continente'],
                'pais' => $_POST['pais'],
                'imagen' => $_POST['imagen'],
            );
            $resultado = Viajes::actualizarViaje($idEdicion, $datosUpdate);
            if ($resultado) {
                $_SESSION['mensajeViaje'] = "Viaje actualizado correctamente";
                header('Location: ../alta_viaje.php?id=' . $idEdicion);
                exit;
            } else {
                $_SESSION['erroresViaje']['general'] = 'Error al actualizar el viaje.';
                header('Location: ../alta_viaje.php?id=' . $idEdicion);
                exit;
            }
        }

        // Si no es actualización, insertar nuevo
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