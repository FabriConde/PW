<?php
require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../config/db_viajes.php';

//Obtener viaje
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    
    $idEdicion = (int)$_GET['id'];
    try {
        $resultado = Viajes::obtenerViajePorId($idEdicion);
        if ($resultado) {
            $_SESSION['datosViaje'] = $resultado;
            $_SESSION['esEditar'] = true;
            header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?'));
            exit;
        } else {
             $_SESSION['errorViaje'] = "Viaje no encontrado para edición.";
            header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?'));
            exit;
        }
    } catch (Exception $e) {
        $_SESSION['errorViaje'] = $e->getMessage();
    }
}

//Alta/edición viaje
if ($_SERVER['REQUEST_METHOD'] == 'POST') {   
    $campos_oblogatorios = ['destino', 'fecha-inicio', 'fecha-fin', 'descripcion-corta', 'descripcion-larga', 
    'precio', 'incluye', 'alojamientos', 'continente', 'pais', 'imagen'];

    foreach ($campos_oblogatorios as $campo) {
        if (!isset($_POST[$campo]) || trim($_POST[$campo]) === '') {
            $_SESSION['errorViaje'] = 'Por favor, completa todos los campos obligatorios.';
            $_SESSION['datosViaje'] = $_POST;
            header('Location: ../alta_viaje.php');
            exit;
        }
    }

    try {
        // Si viene un id en el POST actualizamos
        if (isset($_POST['id']) && is_numeric($_POST['id'])) {
            $idEdicion = (int)$_POST['id'];
            $datosUpdate = array(
                'id' => $idEdicion,
                'destino' => $_POST['destino'],
                'fecha-inicio' => $_POST['fecha-inicio'],
                'fecha-fin' => $_POST['fecha-fin'],
                'descripcion-corta' => $_POST['descripcion-corta'],
                'descripcion-larga' => $_POST['descripcion-larga'],
                'precio' => $_POST['precio'],
                'incluye' => $_POST['incluye'],
                'alojamientos' => $_POST['alojamientos'],
                'continente' => $_POST['continente'],
                'pais' => $_POST['pais'],
                'imagen' => $_POST['imagen'],
            );
            $resultado = Viajes::actualizarViaje($datosUpdate);
            if ($resultado) {
                $_SESSION['mensajeViaje'] = "Viaje actualizado correctamente";
                header('Location: ../alta_viaje.php?id=' . $idEdicion);
                exit;
            } else {
                $_SESSION['errorViaje'] = 'Error al actualizar el viaje.';
                header('Location: ../alta_viaje.php?id=' . $idEdicion);
                exit;
            }
        }

        // Si no es actualización se insertar nuevo
        $datosViaje = array(
            'destino' => $_POST['destino'],
            'fecha-inicio' => $_POST['fecha-inicio'],
            'fecha-fin' => $_POST['fecha-fin'],
            'descripcion-corta' => $_POST['descripcion-corta'],
            'descripcion-larga' => $_POST['descripcion-larga'],
            'precio' => $_POST['precio'],
            'incluye' => $_POST['incluye'],
            'alojamientos' => $_POST['alojamientos'],
            'continente' => $_POST['continente'],
            'pais' => $_POST['pais'],
            'imagen' => $_POST['imagen'],
        );
        $resultado = Viajes::insertarViaje($datosViaje);
        if ($resultado) {
            $_SESSION['mensajeViaje'] = "Viaje creado correctamente";    
            header('Location: ../alta_viaje.php');
            exit;
        }   else {
            $_SESSION['errorViaje'] = 'Error al crear el viaje.';
            header('Location: ../alta_viaje.php');
            exit;
        }
    } catch (Exception $e) {
        $_SESSION['errorViaje'] = $e->getMessage();
        header('Location: ../alta_viaje.php');
        exit;
    }    
}