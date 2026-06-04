<?php
require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../config/db_viajes.php';

$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$por_pagina = isset($_GET['por_pagina']) ? (int)$_GET['por_pagina'] : 9;
if ($pagina < 1) $pagina = 1;
if ($por_pagina < 1) $por_pagina = 9;
$por_pagina = min($por_pagina, 9); // máximo 9 por página
$filaInicio = ($pagina - 1) * $por_pagina;
$erroresBusqueda = [];
try {
	$continente = isset($_GET['continente']) ? trim($_GET['continente']) : null;
	$pais = isset($_GET['pais']) ? trim($_GET['pais']) : null;

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$campos = ['destino', 'fecha_inicio', 'fecha_fin'];

		foreach ($campos as $campo) {
			if (!isset($_POST[$campo]) || trim($_POST[$campo]) === '') {
				$erroresBusqueda[$campo] = 'Se tiene que rellenar el campo ' . $campo . '.';
			}
		}
		
		$destino_busqueda = $_POST['destino'];
		$fecha_inicio = $_POST['fecha_inicio'];
		$fecha_fin = $_POST['fecha_fin'];

		$_SESSION['destino_busqueda'] = $destino_busqueda;
		$_SESSION['fecha_inicio'] = $fecha_inicio;
		$_SESSION['fecha_fin'] = $fecha_fin;

		if (!empty($erroresBusqueda)) {
			$_SESSION['erroresBusqueda'] = $erroresBusqueda;

			header('Location: ../index.php');
			exit;
		}
		
		if ($destino_busqueda && $fecha_inicio && $fecha_fin) {
			$qs = http_build_query([
				'destino' => $destino_busqueda,
				'fecha_inicio' => $fecha_inicio,
				'fecha_fin' => $fecha_fin,
				'pagina' => 1,
				'por_pagina' => $por_pagina
			]);
			header('Location: ../viajes_buscados.php?' . $qs);
			exit;
		}

	}

	if ($continente && $pais) {
		list($viajes, $total_viajes) = Viajes::obtenerViajesPorContinenteYPais($continente, $pais, $filaInicio, $por_pagina);
		$_SESSION['destino'] = $pais;
	} else {
		list($viajes, $total_viajes) = Viajes::obtenerViajes($filaInicio, $por_pagina);
	}
} catch (Exception $e) {
	$viajes = array();
	$total_viajes = 0;
}

$_SESSION['viajes'] = $viajes;
$_SESSION['total_viajes'] = $total_viajes;
$_SESSION['pagina_actual'] = $pagina;
$_SESSION['por_pagina'] = $por_pagina;
?>

