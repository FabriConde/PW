<?php
require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../config/db_viajes.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    
    $idViaje = (int)$_GET['id'];
    try {
        $eliminado = Viajes::eliminarViaje($idViaje);
        if ($eliminado) {
            $_SESSION['viajeEliminado'] = true;
            header('Location: ../viajes.php');
            exit;
        } else {
            $_SESSION['errorEliminado'] = "No se pudo eliminar el viaje.";
            header('Location: ../viajes.php');
            exit;
        }
    } catch (Exception $e) {
        $_SESSION['errorEliminado'] = $e->getMessage();
        header('Location: ../viajes.php');
        exit;
    }
}

