<?php
require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../config/db_viajes.php';

$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$por_pagina = isset($_GET['por_pagina']) ? (int)$_GET['por_pagina'] : 9;
if ($pagina < 1) $pagina = 1;
if ($por_pagina < 1) $por_pagina = 9;
$por_pagina = min($por_pagina, 9); // máximo 9 por página
$filaInicio = ($pagina - 1) * $por_pagina;
$datosBusqueda = [];
try {
	$continente = isset($_GET['continente']) ? trim($_GET['continente']) : null;
	$pais = isset($_GET['pais']) ? trim($_GET['pais']) : null;

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$campos_obligatorios = ['destino', 'fecha_inicio', 'fecha_fin'];

		foreach ($campos_obligatorios as $campo) {
			if (!isset($_POST[$campo]) || trim($_POST[$campo]) === '') {
                $_SESSION['error'] = 'Por favor, completa todos los campos.';
                $_SESSION['datosBusqueda'] = $_POST;
                header('Location: ../index.php');
                exit;
			}
		}

		$datosBusqueda = array(
			'destino' => $_POST['destino'],
			'fecha_inicio' => $_POST['fecha_inicio'],
			'fecha_fin' => $_POST['fecha_fin']
		);
		
		if ($datosBusqueda) {
			$qs = http_build_query([
				'destino' => $datosBusqueda['destino'],
				'fecha_inicio' => $datosBusqueda['fecha_inicio'],
				'fecha_fin' => $datosBusqueda['fecha_fin'],
				'pagina' => 1,
				'por_pagina' => $por_pagina
			]);
			header('Location: ../viajes_buscados.php?' . $qs);
			exit;
		}
	}

	if ($continente && $pais) {
		list($viajes, $total_viajes) = Viajes::obtenerViajesPorContinenteYPais($continente, $pais, $filaInicio, $por_pagina);
	} else {
		list($viajes, $total_viajes) = Viajes::obtenerViajes($filaInicio, $por_pagina);
	}
} catch (Exception $e) {
	$viajes = array();
	$total_viajes = 0;
}
?>

