<?php include 'includes/header.php'; 
$erroresBusqueda = $_SESSION['erroresBusqueda'] ?? [];
$destino_busqueda = $_SESSION['destino_busqueda'] ?? '';
$fecha_inicio = $_SESSION['fecha_inicio'] ?? '';
$fecha_fin = $_SESSION['fecha_fin'] ?? '';
unset($_SESSION['erroresBusqueda'], $_SESSION['destino_busqueda'], $_SESSION['fecha_inicio'], $_SESSION['fecha_fin']);
?>
<main class="pagina-principal">
    <article class="bienvenida">
        <img src="imagenes/portada.jpg" alt="Portada de la agencia">
        <h2>Bienvenido a PW-TravelPro</h2>
        <p>Tu agencia de viajes confiable para explorar el mundo. Ofrecemos una amplia gama de destinos, paquetes personalizados y ofertas exclusivas para hacer de tu viaje una experiencia inolvidable.</p>
        <h3>¡Descubre el mundo con nosotros!</h3>
    </article>
    <article class="buscador">
        <form action="controller/obtener_viajes.php" method="post">
            <input type="text" name="destino" placeholder="Buscar viajes..." value="<?php echo $destino_busqueda; ?>">
            <?php if (isset($erroresBusqueda['destino'])): ?>
                <p class="mensaje_error"><?php echo $erroresBusqueda['destino']; ?></p>
            <?php endif; ?>
            <input type="date" name="fecha_inicio" value="<?php echo $fecha_inicio; ?>">
            <?php if (isset($erroresBusqueda['fecha_inicio'])): ?>
                <p class="mensaje_error"><?php echo $erroresBusqueda['fecha_inicio']; ?></p>
            <?php endif; ?>
            <input type="date" name="fecha_fin" value="<?php echo $fecha_fin; ?>">
            <?php if (isset($erroresBusqueda['fecha_fin'])): ?>
                <p class="mensaje_error"><?php echo $erroresBusqueda['fecha_fin']; ?></p>
            <?php endif; ?>
            <button type="submit">Buscar</button>
        </form>
    </article>
</main>
<?php include 'includes/footer.php'; ?>