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

    <article class="carrusel">
        <?php if (!empty($datosCarrusel)) : ?>
            <article class="tarjeta-viajes">
                <a class="tarjeta-viajes-enlace">
                    <img class="imagen-carrusel" id="carrusel-imagen" src="" alt="Imagen del viaje">
                    <h2 id="carrusel-titulo"></h2>
                    <p id="carrusel-descripcion"></p>
                </a>
                <article class="botones-carrusel">
                    <button id="btn-anterior" class="boton-enlace">&#10094;</button>
                    <button id="btn-siguiente" class="boton-enlace">&#10095;</button>
                </article>
            </article>
        <?php elseif ($errorCarrusel !== null) : ?>
            <p class="mensaje_error"><?php echo $errorCarrusel; ?></p>
        <?php endif; ?>
    </article>
    
    <h2>Busca tu próximo destino</h2>
    <p>Introduce un destino y unas fechas para encontrar el viaje perfecto para ti.</p>
    <article class="errores-busqueda">
        <?php if (!empty($error)): ?>
            <p class="mensaje-error"><?php echo $error; ?></p>
        <?php endif; ?>
        <p id="error-destino" class="mensaje-error"></p>
        <p id="error-fecha-inicio" class="mensaje-error"></p>
        <p id="error-fecha-fin" class="mensaje-error"></p>
    </article>
    
    <article class="buscador">
        <form id="form-busqueda" action="controller/obtener_viajes.php" method="post">
            <input id="destino" type="text" name="destino" placeholder="España" value="<?php echo $destino_busqueda; ?>">
            <input id="fecha-inicio" type="text" name="fecha-inicio" placeholder="yyyy/mm/dd"  value="<?php echo $fecha_inicio; ?>">
            <input id="fecha-fin" type="text" name="fecha-fin" placeholder="yyyy/mm/dd"  value="<?php echo $fecha_fin; ?>">
            <button type="submit">Buscar</button>
            <button type="reset">Limpiar</button>
        </form>
    </article>

   
    <?php if (!empty($datosCarrusel)): ?>
        <script>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const formBusqueda = document.getElementById('form-busqueda');

        formBusqueda.addEventListener('submit', function(event) {
            let hayErrores = false;

            function mostrarError(idCampo, idError, condicion, mensaje){
                const outputError = document.getElementById(idError);
                if (condicion){
                    outputError.textContent = mensaje;
                        hayErrores = true;
                    } else {
                    outputError.textContent = '';
                }
            }

            const destino = document.getElementById('destino').value.trim();
            mostrarError('destino', 'error-destino', destino === '', 'Introduce un destino para la búsqueda.');

            const regexFecha = /^\d{4}-\d{2}-\d{2}$/;
            const fechaInicio = document.getElementById('fecha-inicio').value.trim();
            const fechaFin = document.getElementById('fecha-fin').value.trim();
            mostrarError('fecha-inicio', 'error-fecha-inicio', !regexFecha.test(fechaInicio), 'La fecha de inicio no es válida.');
            mostrarError('fecha-fin', 'error-fecha-fin', !regexFecha.test(fechaFin), 'La fecha de fin no es válida.');
            if (regexFecha.test(fechaInicio) && regexFecha.test(fechaFin)) {
                const fi = new Date(fechaInicio);
                const ff = new Date(fechaFin);
                mostrarError('fecha-fin', 'error-fecha-fin', ff < fi, 'La fecha de fin debe ser igual o posterior a la fecha de inicio.');
            }
            if (hayErrores) {
                event.preventDefault();
            }
        });

        formBusqueda.addEventListener('reset', function() {
            const errores = document.querySelectorAll('.mensaje-error');
            errores.forEach(function(error) {
                error.textContent = '';
            });
        });

    });
</script>


<?php include 'includes/footer.php'; ?>