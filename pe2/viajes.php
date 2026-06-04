<?php include 'includes/header.php';
include __DIR__ . '/controller/obtener_viajes.php';
$esAdmin = $_SESSION['esAdmin'] ?? false;
$destino = $_SESSION['destino'] ?? '';
unset($_SESSION['destino']);
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

        <?php if ($destino): ?>
           <h2>Catálogo de viajes para: <?php echo htmlspecialchars(ucfirst($destino)); ?></h2>
        <?php else: ?>
           <h2>Catálogo de viajes</h2>
        <?php endif; ?>
        <?php include 'includes/ventana_viajes.php'; ?>
    </section>            
</main>
<?php include 'includes/footer.php'; ?>