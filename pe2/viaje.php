<?php include 'includes/header.php'; 
require_once __DIR__ . '/config/session.php';
require_once __DIR__ . '/config/db_viajes.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    
    $idEdicion = (int)$_GET['id'];
    try {
        $resultado = Viajes::obtenerViajePorId($idEdicion);
        if ($resultado) {
            $datosViaje = $resultado;
        } else {
            $mensajeErrorViaje = "Viaje no encontrado para edición.";
        }
    } catch (Exception $e) {
        $erroresViaje['general'] = $e->getMessage();
    }
}
?>
<main>
    <img src="imagenes/<?php echo htmlspecialchars($datosViaje['imagen']); ?>" alt="<?php echo htmlspecialchars($datosViaje['destino']); ?>">
    <article class="viaje-contenido">
        <section class="info-viaje">
            <h3>Bienvenido a <?php echo htmlspecialchars($datosViaje['destino']); ?></h3>
            <p><?php echo htmlspecialchars($datosViaje['descripcion_larga']); ?></p>
            <p><strong>Fechas:</strong> <?php echo htmlspecialchars($datosViaje['fecha_inicio']); ?> - <?php echo htmlspecialchars($datosViaje['fecha_fin']); ?></p>
            <p><strong>Precio:</strong> <?php echo htmlspecialchars($datosViaje['precio']); ?>€ por persona</p>
            <p><strong>Incluye:</strong> <?php echo htmlspecialchars($datosViaje['incluye']); ?></p>
            
            <?php
            $alojamientos = isset($datosViaje['alojamientos']) ? $datosViaje['alojamientos'] : null;
            if (!empty($alojamientos)) {
                $lines = preg_split("/\r\n|\n|\r/", $alojamientos);
                $lines = array_filter(array_map('trim', $lines));
                if (!empty($lines)) {
                    echo '<p>Lista de alojamientos disponibles:</p>';
                    echo "<ul>\n";
                    foreach ($lines as $line) {
                        echo '<li>' . htmlspecialchars($line) . '</li>\n';
                    }
                    echo "</ul>\n";
                } else {
                    echo '<p>No hay alojamientos disponibles.</p>';
                }
            } else {
                echo '<p>No hay alojamientos disponibles.</p>';
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