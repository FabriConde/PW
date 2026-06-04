<?php include 'includes/header.php';
require_once __DIR__ . '/config/session.php';
require_once __DIR__ . '/config/db_viajes.php';


$destino = isset($_GET['destino']) ? trim($_GET['destino']) : '';
$fecha_inicio = isset($_GET['fecha_inicio']) ? trim($_GET['fecha_inicio']) : '';
$fecha_fin = isset($_GET['fecha_fin']) ? trim($_GET['fecha_fin']) : '';
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$por_pagina = isset($_GET['por_pagina']) ? (int)$_GET['por_pagina'] : 9;
if ($pagina < 1) $pagina = 1;
if ($por_pagina < 1) $por_pagina = 9;
$por_pagina = min($por_pagina, 9);
$filaInicio = ($pagina - 1) * $por_pagina;

$viajes = array();
$total_viajes = 0;
if ($destino !== '' && $fecha_inicio !== '' && $fecha_fin !== '') {
    list($viajes, $total_viajes) = Viajes::obtenerViajesDestinoYFechas($destino, $fecha_inicio, $fecha_fin, $filaInicio, $por_pagina);
}

// Guardar en sesión para que `ventana_viajes.php` funcione sin cambios
$_SESSION['viajes'] = $viajes;
$_SESSION['total_viajes'] = $total_viajes;
$_SESSION['pagina_actual'] = $pagina;
$_SESSION['por_pagina'] = $por_pagina;
?>
<main>  
    <section class="viajes">    
        <h2>Catálogo de viajes para el destino: <?php echo htmlspecialchars($destino); ?></h2>
        <?php include 'includes/ventana_viajes.php'; ?>
    </section>            
</main>
<?php include 'includes/footer.php'; ?>