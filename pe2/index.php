<?php include 'includes/header.php'; ?>
<main class="pagina-principal">
    <article class="bienvenida">
        <img src="imagenes/portada.jpg" alt="Portada de la agencia">
        <h2>Bienvenido a PW-TravelPro</h2>
        <p>Tu agencia de viajes confiable para explorar el mundo. Ofrecemos una amplia gama de destinos, paquetes personalizados y ofertas exclusivas para hacer de tu viaje una experiencia inolvidable.</p>
        <h3>¡Descubre el mundo con nosotros!</h3>
    </article>
    <article class="buscador">
        <form method="post">
            <input type="text" name="viaje" placeholder="Buscar viajes...">
                <input type="date" name="fecha">
                <button type="submit">Buscar</button>
        </form>
    </article>
</main>
<?php include 'includes/footer.php'; ?>