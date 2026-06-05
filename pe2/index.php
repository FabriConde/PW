<?php 
include 'includes/header.php';
require_once __DIR__ . '/config/db_viajes.php';
$erroresBusqueda = $_SESSION['erroresBusqueda'] ?? [];
$destino_busqueda = $_SESSION['destino_busqueda'] ?? '';
$fecha_inicio = $_SESSION['fecha_inicio'] ?? '';
$fecha_fin = $_SESSION['fecha_fin'] ?? '';
unset($_SESSION['erroresBusqueda'], $_SESSION['destino_busqueda'], $_SESSION['fecha_inicio'], $_SESSION['fecha_fin']);

try {
    $datosCarrusel = null;
    $errorCarrusel = null;
    $numViajeCarrusel = 5;
    $resultado = Viajes::obtenerViajesAleatorios(null, $numViajeCarrusel );
    if ($resultado !== null && is_array($resultado)) {
        $datosCarrusel = $resultado;
    } else {
        $errorCarrusel = "Error al obtener viajes para el carrusel.";
    }
} catch ( Exception $e ) {
    $errorCarrusel = $e->getMessage();
}
?>
<main class="pagina-principal">
    <article class="bienvenida">
        <img src="imagenes/portada.jpg" alt="Portada de la agencia">
        <h2>Bienvenido a PW-TravelPro</h2>
        <p>Tu agencia de viajes confiable para explorar el mundo. Ofrecemos una amplia gama de destinos, paquetes personalizados y ofertas exclusivas para hacer de tu viaje una experiencia inolvidable.</p>
        <h3>¡Descubre el mundo con nosotros!</h3>
    </article>
    <?php if (!empty($datosCarrusel)) : ?>
        <article class="tarjeta-viajes">
            <a class="tarjeta-viajes-enlace">
                <img id="carrusel-imagen" src="" alt="Imagen del viaje">
                <h2 id="carrusel-titulo"></h2>
                <p id="carrusel-descripcion"></p>
            </a>
            <button id="btn-anterior" class="boton-enlace">&#10094;</button>
            <button id="btn-siguiente" class="boton-enlace">&#10095;</button>
        </article>
    
    <?php elseif ($errorCarrusel !== null) : ?>
        <p class="mensaje_error"><?php echo $errorCarrusel; ?></p>
    <?php endif; ?>


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
    <?php if (!empty($datosCarrusel)): ?>
        <script type="text/javascript">
            const listaViajes = <?php echo json_encode($datosCarrusel); ?>;
            
            let posicionActual = 0;

            // Capturar los elementos del DOM que vamos a modificar dinámicamente
            const enlaceElement = document.querySelector('.tarjeta-viajes-enlace');
            const imgElement = document.getElementById('carrusel-imagen');
            const tituloElement = document.getElementById('carrusel-titulo');
            const descElement = document.getElementById('carrusel-descripcion');
            
            const btnAnterior = document.getElementById('btn-anterior');
            const btnSiguiente = document.getElementById('btn-siguiente');

            // Función encargada de actualizar los elementos visuales del HTML
            function actualizarCarrusel() {
                const viajeActivo = listaViajes[posicionActual];
                
                // Modificamos las propiedades del DOM correspondientes
                imgElement.src = "imagenes/" + viajeActivo.imagen; // Asegura la ruta correcta a tu carpeta de imágenes
                imgElement.alt = "Imagen de " + viajeActivo.destino;
                tituloElement.textContent = viajeActivo.destino;
                descElement.textContent = viajeActivo.descripcion_corta;
                enlaceElement.href = "viaje.php?id=" + viajeActivo.id;
            }

            // Evento para avanzar en el carrusel (Infinito)
            btnSiguiente.addEventListener('click', function() {
                posicionActual++;
                if (posicionActual >= listaViajes.length) {
                    posicionActual = 0; // Regresa al principio si excede el tamaño
                }
                actualizarCarrusel();
            });

            // Evento para retroceder en el carrusel (Infinito)
            btnAnterior.addEventListener('click', function() {
                posicionActual--;
                if (posicionActual < 0) {
                    posicionActual = listaViajes.length - 1; // Va al último elemento si baja de cero
                }
                actualizarCarrusel();
            });

            // Inicialización: Renderizar el primer viaje al cargar la página index
            actualizarCarrusel();
        </script>
    <?php endif; ?>
</main>
<?php include 'includes/footer.php'; ?>