<?php include 'includes/header.php';
include __DIR__ . '/controller/obtener_viajes.php';
$esAdmin = $_SESSION['esAdmin'] ?? false; 
$viajes = $_SESSION['viajes'] ?? array();
$total_viajes = $_SESSION['total_viajes'] ?? 0;
$pagina = $_SESSION['pagina_actual'] ?? 1;
$por_pagina = $_SESSION['por_pagina'] ?? 9;
?>
<main>
    <aside class="w3-sidebar w3-bar-block" style="width:15%;">
        <h5><strong>Continentes</strong></h5>
        <p>Europa</p>
        <a href="viajes.php?continente=europa&pais=francia" class="w3-bar-item w3-button w3-border-bottom">Francia</a>
        <a href="viajes.php?continente=europa&pais=italia" class="w3-bar-item w3-button w3-border-bottom">Italia</a>
        <a href="viajes.php?continente=europa&pais=españa" class="w3-bar-item w3-button w3-border-bottom">España</a>
        <p>América</p>
        <a href="viajes.php?continente=america&pais=canadá" class="w3-bar-item w3-button w3-border-bottom">Canadá</a>
        <a href="viajes.php?continente=america&pais=brasil" class="w3-bar-item w3-button w3-border-bottom">Brasil</a>
        <a href="viajes.php?continente=america&pais=estados unidos" class="w3-bar-item w3-button w3-border-bottom">Estados Unidos</a>
        <p>Asia</p>
        <a href="viajes.php?continente=asia&pais=china" class="w3-bar-item w3-button w3-border-bottom">China</a>
        <a href="viajes.php?continente=asia&pais=japón" class="w3-bar-item w3-button w3-border-bottom">Japón</a>
        <a href="viajes.php?continente=asia&pais=tailandia" class="w3-bar-item w3-button w3-border-bottom">Tailandia</a>
        <p>África</p>
        <a href="viajes.php?continente=africa&pais=marruecos" class="w3-bar-item w3-button w3-border-bottom">Marruecos</a>
    </aside>
        
    <section class="viajes" style="margin-left:15%">    
            <?php if ($esAdmin): ?>
                <section class="boton-add-viaje">
                    <a class="boton-enlace" href='alta_viaje.php'>Añadir viaje</a>
                </section>
            <?php endif; ?>
        <h2>Catálogo de viajes</h2>
        <article class="tarjetas">
            <?php if (!empty($viajes)): ?>
                <?php foreach ($viajes as $viaje): ?>
                    <article class="tarjeta-viajes">
                        <a class="tarjeta-viajes-enlace" href="viaje1.html">
                            <h3><?php echo htmlspecialchars($viaje['destino']); ?></h3>
                            <?php if (!empty($viaje['imagen'])): ?>
                                <img src="imagenes/<?php echo htmlspecialchars($viaje['imagen']); ?>" alt="<?php echo htmlspecialchars($viaje['destino']); ?>">
                            <?php endif; ?>
                            <p><strong>Fechas:</strong> <?php echo htmlspecialchars($viaje['fecha_inicio']); ?> - <?php echo htmlspecialchars($viaje['fecha_fin']); ?></p>
                            <p><?php echo htmlspecialchars($viaje['descripcion_corta']); ?></p>
                        </a>
                        <?php if ($esAdmin): ?>
                            <article class="opciones-admin">
                                <a class="boton-enlace" href="alta_viaje.php?id=<?php echo $viaje['id']; ?>">Editar</a>
                                <a class="boton-enlace" href="controller/eliminar_viaje.php?id=<?php echo $viaje['id']; ?>" onclick="return confirm('¿Estás seguro de que quieres eliminar este viaje?');">Eliminar</a>
                            </article>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay viajes disponibles.</p>
            <?php endif; ?>
        </article>

        <?php $total_paginas = ($por_pagina > 0) ? (int)ceil($total_viajes / $por_pagina) : 1; ?>
        <nav class="paginacion-viajes">
            <?php
                $queryBase = array();
                if (!empty($_GET['continente'])) $queryBase['continente'] = $_GET['continente'];
                if (!empty($_GET['pais'])) $queryBase['pais'] = $_GET['pais'];
                if (!empty($_GET['por_pagina'])) $queryBase['por_pagina'] = $_GET['por_pagina'];
            ?>
            <?php if ($pagina > 1): ?>
                    <?php $queryBase['pagina'] = $pagina - 1; ?>
                    <a href="?<?php echo http_build_query($queryBase); ?>" class="w3-button">&#10094; Anterior</a>
            <?php else: ?>
                <span class="w3-button disabled">&#10094; Anterior</span>
            <?php endif; ?>

            <?php for ($p = 1; $p <= $total_paginas; $p++): ?>
                <?php $queryBase['pagina'] = $p; ?>
                <?php if ($p == $pagina): ?>
                    <a href="?<?php echo http_build_query($queryBase); ?>" class="w3-button activo"><?php echo $p; ?></a>
                <?php else: ?>
                    <a href="?<?php echo http_build_query($queryBase); ?>" class="w3-button"><?php echo $p; ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($pagina < $total_paginas): ?>
                <?php $queryBase['pagina'] = $pagina + 1; ?>
                <a href="?<?php echo http_build_query($queryBase); ?>" class="w3-button w3-right">Siguiente &#10095;</a>
            <?php else: ?>
                <span class="w3-button w3-right disabled">Siguiente &#10095;</span>
            <?php endif; ?>
        </nav>
    </section>            
</main>
<?php include 'includes/footer.php'; ?>