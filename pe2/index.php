<?php 
include 'includes/header.php';
require_once __DIR__ . '/config/db_viajes.php';

$error = $_SESSION['error'] ?? '';
$datosBusqueda = $_SESSION['datosBusqueda'] ?? [];
unset($_SESSION['error'], $_SESSION['datosBusqueda']);

try {
    $datosCarrusel = null;
    $errorCarrusel = null;
    $numViajeCarrusel = 5;
    $resultado = Viajes::obtenerViajesAleatorios(null, $numViajeCarrusel);
    
    if ($resultado !== null && is_array($resultado)) {
        $datosCarrusel = $resultado;
    } else {
        $errorCarrusel = "No se han obtenido viajes.";
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
            <article class="tarjeta-viajes" id="contenedor-carrusel">
                
                <?php foreach ($datosCarrusel as $index => $viaje): ?>
                    <a href="viaje.php?id=<?php echo htmlspecialchars($viaje['id'] ?? ''); ?>" 
                       class="tarjeta-viajes-enlace slide-viaje" 
                       style="display: <?php echo $index === 0 ? 'block' : 'none'; ?>;">
                        <img class="imagen-carrusel" src="imagenes/<?php echo htmlspecialchars($viaje['imagen'] ?? ''); ?>" alt="Imagen de <?php echo htmlspecialchars($viaje['destino'] ?? ''); ?>">
                        <h2><?php echo htmlspecialchars($viaje['destino'] ?? ''); ?></h2>
                        <p><?php echo htmlspecialchars($viaje['descripcion_corta'] ?? ''); ?></p>
                    </a>
                <?php endforeach; ?>

                <article class="botones-carrusel">
                    <button id="btn-anterior" class="boton-enlace">&#10094;</button>
                    <button id="btn-siguiente" class="boton-enlace">&#10095;</button>
                </article>
            </article>
        <?php elseif ($errorCarrusel !== null) : ?>
            <p class="mensaje-error"><?php echo htmlspecialchars($errorCarrusel); ?></p>
        <?php endif; ?>
    </article>
    
    <h2>Busca tu próximo destino</h2>
    <p>Introduce un destino y unas fechas para encontrar el viaje perfecto para ti.</p>
    <article class="errores-busqueda">
        <?php if (!empty($error)): ?>
            <p class="mensaje-error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <p id="error-destino" class="mensaje-error"></p>
        <p id="error-fecha-inicio" class="mensaje-error"></p>
        <p id="error-fecha-fin" class="mensaje-error"></p>
    </article>
    
    <article class="buscador">
        <form id="form-busqueda" action="controller/obtener_viajes.php" method="post">
            <input id="destino" type="text" name="destino" placeholder="España" value="<?php echo htmlspecialchars($datosBusqueda['destino'] ?? ''); ?>">
            <input id="fecha-inicio" type="text" name="fecha-inicio" placeholder="yyyy-mm-dd"  value="<?php echo htmlspecialchars($datosBusqueda['fecha_inicio'] ?? ''); ?>">
            <input id="fecha-fin" type="text" name="fecha-fin" placeholder="yyyy-mm-dd"  value="<?php echo htmlspecialchars($datosBusqueda['fecha_fin'] ?? ''); ?>">
            <button type="submit">Buscar</button>
            <button type="reset">Limpiar</button>
        </form>
    </article>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carrusel = document.querySelectorAll('.slide-viaje');
        
        if (carrusel.length > 0) {
            let posicionActual = 0;
            const btnAnterior = document.getElementById('btn-anterior');
            const btnSiguiente = document.getElementById('btn-siguiente');

            btnSiguiente.addEventListener('click', function() {
                carrusel[posicionActual].style.display = 'none'; 
                
                posicionActual++;
                if (posicionActual >= carrusel.length) {
                    posicionActual = 0; 
                }
                
                carrusel[posicionActual].style.display = 'block'; 
            });

            btnAnterior.addEventListener('click', function() {
                carrusel[posicionActual].style.display = 'none'; 
                
                posicionActual--;
                if (posicionActual < 0) {
                    posicionActual = carrusel.length - 1;
                }
                
                carrusel[posicionActual].style.display = 'block'; 
            });
        }
        
        const formBusqueda = document.getElementById('form-busqueda');

        if (formBusqueda) {
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
                mostrarError('destino', 'error-destino', destino.length < 4, 'El nombre del destino debe tener al menos 4 caracteres.');

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
        }
    });
</script>

<?php include 'includes/footer.php'; ?>