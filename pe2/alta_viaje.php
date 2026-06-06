<?php include 'includes/header.php';
include __DIR__ . '/controller/crear_viaje.php';
$img_dir = __DIR__ . '/imagenes';
$images = [];
if (is_dir($img_dir)) {
    foreach (glob($img_dir . '/*/*.{jpg,jpeg,png,gif}', GLOB_BRACE) as $img) {
        $images[] = substr($img, strlen($img_dir . '/'));
    }
}
$paises = ['Francia', 'Italia', 'España', 'Canadá', 'Brasil', 'Estados Unidos', 'China', 'Japón', 'Tailandia', 'Marruecos'];
$continentes = ['Europa', 'América', 'Asia', 'África'];
$error = $_SESSION['errorViaje'] ?? [];
$mensaje= $_SESSION['mensajeViaje'] ?? '';
$datosViaje = $_SESSION['datosViaje'] ?? [];
unset($_SESSION['errorViaje'], $_SESSION['mensajeViaje'], $_SESSION['datosViaje']);
?>

<main class="alta-viaje-main">
    <?php if (!empty($mensaje)): ?>
        <h1 class="mensaje-exito"><?php echo htmlspecialchars($mensaje); ?></h1>
    <?php endif; ?>

    <h2>Alta de viajes</h2>
    <p>Completa todos los campos para registrarte un nuevo viaje.</p>

    <?php if (!empty($error)): ?>
        <p class="mensaje-error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form  id="form-viaje" class="alta-viaje" accept=""action="controller/crear_viaje.php" method="post">
        <fieldset>
            <legend>Nuevo viaje</legend>

            <label for="destino">Nombre del destino</label>
            <input id="destino" type="text" name="destino" 
            value="<?php echo htmlspecialchars($datosViaje['destino'] ?? ''); ?>">
            <output id="error-destino" class="mensaje-error" for="destino"></output>

            <label for="fecha-inicio">Fecha de inicio</label>
            <input id="fecha-inicio" type="text" name="fecha-inicio" placeholder="yyyy/mm/dd" 
            value="<?php echo htmlspecialchars($datosViaje['fecha-inicio'] ?? ''); ?>">
            <output id="error-fecha-inicio" class="mensaje-error" for="fecha-inicio"></output>

            <label for="fecha-fin">Fecha de fin</label>
            <input id="fecha-fin" type="text" name="fecha-fin" placeholder="yyyy/mm/dd" 
            value="<?php echo htmlspecialchars($datosViaje['fecha-fin'] ?? ''); ?>">
            <output id="error-fecha-fin" class="mensaje-error" for="fecha-fin"></output>

            <label for="descripcion-corta">Breve descripción</label>
            <input id="descripcion-corta" type="text" name="descripcion-corta" 
            value="<?php echo htmlspecialchars($datosViaje['descripcion-corta'] ?? ''); ?>">
            <output id="error-descripcion-corta" class="mensaje-error" for="descripcion-corta"></output>

            <label for="descripcion-larga">Descripción completa</label>
            <textarea id="descripcion-larga" name="descripcion-larga"><?php echo htmlspecialchars($datosViaje['descripcion-larga'] ?? ''); ?></textarea>
            <output id="error-descripcion-larga" class="mensaje-error" for="descripcion-larga"></output>

            <label for="precio">Precio (EUR)</label>
            <input id="precio" type="text" name="precio" value="<?php echo htmlspecialchars($datosViaje['precio'] ?? ''); ?>">
            <output id="error-precio" class="mensaje-error" for="precio"></output>

            <label for="incluye">Incluye</label>
            <input id="incluye" type="text" name="incluye" value="<?php echo htmlspecialchars($datosViaje['incluye'] ?? ''); ?>">
            <output id="error-incluye" class="mensaje-error" for="incluye"></output>

            <label for="alojamientos">Alojamientos (separados por comas)</label>
            <textarea id="alojamientos" name="alojamientos" placeholder="Ej: Hotel Palace, Hotel Ritz"><?php echo htmlspecialchars($datosViaje['alojamientos'] ?? ''); ?></textarea>
            <output id="error-alojamientos" class="mensaje-error" for="alojamientos"></output>

            <label for="continente">Continente</label>
            <select id="continente" name="continente">
                <option value="">--Selecciona continente--</option>
                <?php foreach ($continentes as $cont): ?>
                    <option value="<?php echo htmlspecialchars($cont); ?>" <?php echo (isset($datosViaje['continente']) && $datosViaje['continente']==$cont)?'selected':''; ?>><?php echo htmlspecialchars($cont); ?></option>
                <?php endforeach; ?>
            </select>
            <output id="error-continente" class="mensaje-error" for="continente"></output>

            <label for="pais">País</label>
            <select id="pais" name="pais">
                <option value="">--Selecciona país--</option>
                <?php foreach ($paises as $pais): ?>
                    <option value="<?php echo htmlspecialchars($pais); ?>" <?php echo (isset($datosViaje['pais']) && $datosViaje['pais']==$pais)?'selected':''; ?>><?php echo htmlspecialchars($pais); ?></option>
                <?php endforeach; ?>
            </select>
            <output id="error-pais" class="mensaje-error" for="pais"></output>

            <label for="imagen">Imagen (selecciona una del servidor)</label>
            <select id="imagen" name="imagen" onchange="document.getElementById('preview').src='imagenes/'+this.value">
                <option value="">--Selecciona imagen--</option>
                <?php foreach ($images as $img): ?>
                    <option value="<?php echo htmlspecialchars($img); ?>" <?php echo (isset($datosViaje['imagen']) && $datosViaje['imagen']==$img)?'selected':''; ?>><?php echo htmlspecialchars($img); ?></option>
                <?php endforeach; ?>
            </select>
            <output id="error-imagen" class="mensaje-error" for="imagen"></output>
            
            <img id="preview" src="" alt="Previsualización" style="max-width:200px;margin-top:8px">
            
            <button type="submit">Nuevo viaje</button>
            <button type="reset">Limpiar</button>
        </fieldset>
    </form>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const formAltaViaje = document.getElementById('form-viaje');

        formAltaViaje.addEventListener('submit', function(evento){
            let hayErrores = false;

            function mostrarError(idCampo, idError, condicion, mensaje) {
                const outputError = document.getElementById(idError);
                if (condicion) {
                    outputError.textContent = mensaje;
                    hayErrores = true;
                } else {
                    outputError.textContent = '';
                }
            }

            // Validaciones
            // 1. Destino (mínimo 2 caracteres)
            const destino = document.getElementById('destino').value.trim();
            mostrarError('destino', 'error-destino', destino.length < 2, 'El nombre del destino debe tener al menos 2 caracteres.');

            // 2. Fechas (formato básico YYYY-MM-DD) y coherencia
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

            // 3. Descripciones
            const descCorta = document.getElementById('descripcion-corta').value.trim();
            mostrarError('descripcion-corta', 'error-descripcion-corta', descCorta.length < 10, 'La breve descripción debe tener al menos 10 caracteres.');

            const descLarga = document.getElementById('descripcion-larga').value.trim();
            mostrarError('descripcion-larga', 'error-descripcion-larga', descLarga.length < 20, 'La descripción completa debe tener al menos 20 caracteres.');

            // 4. Precio (numérico y > 0)
            const precioVal = document.getElementById('precio').value.trim();
            const precioNum = parseFloat(precioVal);
            mostrarError('precio', 'error-precio', precioVal === '' || isNaN(precioNum) || precioNum <= 0, 'Introduce un precio válido mayor que 0.');

            const incluye = document.getElementById('incluye').value.trim();
            mostrarError('incluye', 'error-incluye', incluye.length < 10, 'El campo "Incluye" debe tener al menos 10 caracteres.');

            const alojamientos = document.getElementById('alojamientos').value.trim();
            const alojamientosList = alojamientos.length > 0 ? alojamientos.split(',').map(s => s.trim()).filter(s => s.length > 0) : [];
            mostrarError('alojamientos', 'error-alojamientos', alojamientosList.length < 2, 'Debes indicar al menos 2 alojamientos separados por comas. Ej: Hotel Palace, Hotel Ritz');

            // 5. Continente y país
            const continente = document.getElementById('continente').value;
            mostrarError('continente', 'error-continente', continente === '', 'Debes seleccionar un continente.');

            const pais = document.getElementById('pais').value;
            mostrarError('pais', 'error-pais', pais === '', 'Debes seleccionar un país.');

            // 6. Imagen (selección)
            const imagen = document.getElementById('imagen').value;
            mostrarError('imagen', 'error-imagen', imagen === '', 'Debes seleccionar una imagen.');

            // Si hay errores, prevenir envío
            if (hayErrores) {
                evento.preventDefault();
            }
        });

        formAltaViaje.addEventListener('reset', function() {
            const errores = document.querySelectorAll('.mensaje-error');
            errores.forEach(function(error) {
                error.textContent = '';
            });
        });
    });
</script>
<?php include 'includes/footer.php'; ?>