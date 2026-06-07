<?php include 'includes/header.php'; 
require_once __DIR__ . '/config/session.php';
require_once __DIR__ . '/config/db_viajes.php';

$datosViaje = null;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idEdicion = (int)$_GET['id'];
    try {
        $resultado = Viajes::obtenerViajePorId($idEdicion);
        if ($resultado !== null && is_array($resultado)) {
            $datosViaje = $resultado;
        } else {
            header('HTTP/1.1 404 Not Found');
            echo 'Viaje no encontrado.';
            exit;
        }
    } catch (Exception $e) {
        $erroresViaje['general'] = $e->getMessage();
    }
}
?>
<main>
    <img class="banner-viaje" src="imagenes/<?php echo htmlspecialchars($datosViaje['imagen']); ?>" alt="<?php echo htmlspecialchars($datosViaje['destino']); ?>">
    <article class="viaje-contenido">
        <section class="info-viaje">
            <h3>Bienvenido a <?php echo htmlspecialchars($datosViaje['destino']); ?></h3>
            <p><?php echo htmlspecialchars($datosViaje['descripcion-larga']); ?></p>
            <p><strong>Fechas:</strong> <?php echo htmlspecialchars($datosViaje['fecha-inicio']); ?> - <?php echo htmlspecialchars($datosViaje['fecha-fin']); ?></p>
            <p><strong>Precio:</strong> <?php echo htmlspecialchars($datosViaje['precio']); ?>€ por persona</p>
            <p><strong>Incluye:</strong> <?php echo htmlspecialchars($datosViaje['incluye']); ?></p>
            
            <?php
                $alojamientos =  $datosViaje['alojamientos'] ?? '';

                if (!empty($alojamientos)) {
                    $listaAlojamientos = explode(',', $alojamientos);

                    echo '<ul>';
                    foreach ($listaAlojamientos as $alojamiento) {
                        echo '<li>' . htmlspecialchars(trim($alojamiento)) . '</li>';
                    }
                    echo '</ul>';
                } else {
                    echo '<p>No se han especificado alojamientos para este viaje.</p>';
                }   
            ?>
            
           
        </section>
        <aside class="destinos-relacionados">
            <h3>Destinos relacionados</h3>
            <?php
            try {
                $numViajeRelacionados = rand(6, 8);
                $viajesRelacionados = Viajes::obtenerViajesAleatorios( isset($datosViaje['id']) ? $datosViaje['id'] : null, $numViajeRelacionados );
                if ( !empty( $viajesRelacionados ) ) {
                    foreach ( $viajesRelacionados as $viajeRelacionado ) {
                        $link = 'viaje.php?id=' . urlencode( $viajeRelacionado['id'] );
                        echo '<a href="' . htmlspecialchars($link) . '" class="w3-bar-item w3-button w3-border-bottom">' . htmlspecialchars( $viajeRelacionado['destino'] ) . '</a>';
                    }
                } else {
                    echo '<p>No hay destinos relacionados.</p>';
                }
            } catch ( Exception $e ) {
                echo '<p>Error al cargar destinos relacionados.</p>';
            }
            ?>
        </aside>
    </article>
</main>
<?php include 'includes/footer.php'; ?>