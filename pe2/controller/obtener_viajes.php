<?php
require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../config/db_viajes.php';

$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$por_pagina = isset($_GET['por_pagina']) ? (int)$_GET['por_pagina'] : 9;
if ($pagina < 1) $pagina = 1;
if ($por_pagina < 1) $por_pagina = 9;
$por_pagina = min($por_pagina, 9); // máximo 9 por página
$filaInicio = ($pagina - 1) * $por_pagina;

try {
	$continente = isset($_GET['continente']) ? trim($_GET['continente']) : null;
	$pais = isset($_GET['pais']) ? trim($_GET['pais']) : null;
	if ($continente && $pais) {
		list($viajes, $total_viajes) = Viajes::obtenerViajesPorContinenteYPais($continente, $pais, $filaInicio, $por_pagina);
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

