<?php
require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../config/db_viajes.php';

// Leer parámetros GET
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$por_pagina = isset($_GET['por_pagina']) ? (int)$_GET['por_pagina'] : 9;
if ($pagina < 1) $pagina = 1;
if ($por_pagina < 1) $por_pagina = 9;
$por_pagina = min($por_pagina, 9); // máximo 9 por página
$filaInicio = ($pagina - 1) * $por_pagina;

try {
	list($viajes, $total_viajes) = Viajes::obtenerViajes($filaInicio, $por_pagina);
} catch (Exception $e) {
	$viajes = array();
	$total_viajes = 0;
}

// Guardar en sesión con nombres en español
$_SESSION['viajes'] = $viajes;
$_SESSION['total_viajes'] = $total_viajes;
$_SESSION['pagina_actual'] = $pagina;
$_SESSION['por_pagina'] = $por_pagina;
?>

