<?php include 'includes/header.php';
// Preparar lista de imágenes y países desde el directorio `imagenes/`
$img_dir = __DIR__ . '/imagenes';
$images = [];
if (is_dir($img_dir)) {
    foreach (glob($img_dir . '/*/*.{jpg,jpeg,png,gif}', GLOB_BRACE) as $img) {
        $images[] = substr($img, strlen($img_dir . '/'));
    }
}
$countries = ['Francia', 'Italia', 'España', 'Canadá', 'Brasil', 'Estados Unidos', 'China', 'Japón', 'Tailandia', 'Marruecos'];
$continentes = ['Europa', 'América', 'Asia', 'África'];
$erroresViaje = $_SESSION['erroresViaje'] ?? [];
$mensajeViaje = $_SESSION['mensajeViaje'] ?? '';
$datosViaje = $_SESSION['datosViaje'] ?? [];
?>

<main class="alta-viaje-main">
    <?php if (!empty($mensajeViaje)): ?>
        <h1 class="mensaje_exito"><?php echo htmlspecialchars($mensajeViaje); ?></h1>
    <?php endif; ?>

    <?php if (isset($erroresViaje['general'])): ?>
        <p class="mensaje_error"><?php echo $erroresViaje['general']; ?></p>
    <?php endif; ?>
    <h2>Alta de viajes</h2>
    <p>Completa todos los campos para registrarte un nuevo viaje.</p>
    <form  class="alta-viaje" accept=""action="controller/crear_viaje.php" method="post">
        <fieldset>
            <legend>Nuevo viaje</legend>
            <label for="destino">Nombre del destino</label>
            <input id="destino" type="text" name="destino" 
            class="<?php echo isset($erroresViaje['destino']) ? 'is-invalid' : '' ?>"
            value="<?php echo isset($datosViaje['destino']) ? htmlspecialchars($datosViaje['destino']) : ''; ?>">
            <?php if (isset($erroresViaje['destino'])): ?>
                <p class="mensaje_error"><?php echo $erroresViaje['destino']; ?></p>
            <?php endif; ?>

            <label for="fecha-inicio">Fecha de inicio</label>
            <input id="fecha-inicio" type="date" name="fecha-inicio" 
            class="<?php echo isset($erroresViaje['fecha-inicio']) ? 'is-invalid' : '' ?>" 
            value="<?php echo isset($datosViaje['fecha-inicio']) ? htmlspecialchars($datosViaje['fecha-inicio']) : ''; ?>">
            <?php if (isset($erroresViaje['fecha-inicio'])): ?>
                <p class="mensaje_error"><?php echo $erroresViaje['fecha-inicio']; ?></p>
            <?php endif; ?>

            <label for="fecha-fin">Fecha de fin</label>
            <input id="fecha-fin" type="date" name="fecha-fin" 
            class="<?php echo isset($erroresViaje['fecha-fin']) ? 'is-invalid' : '' ?>" 
            value="<?php echo isset($datosViaje['fecha-fin']) ? htmlspecialchars($datosViaje['fecha-fin']) : ''; ?>">
            <?php if (isset($erroresViaje['fecha-fin'])): ?>
                <p class="mensaje_error"><?php echo $erroresViaje['fecha-fin']; ?></p>
            <?php endif; ?>

            <label for="descripcion">Breve descripción</label>
            <input id="descripcion" type="text" name="descripcion" 
            class="<?php echo isset($erroresViaje['descripcion']) ? 'is-invalid' : '' ?>"
            value="<?php echo isset($datosViaje['descripcion']) ? htmlspecialchars($datosViaje['descripcion']) : ''; ?>">
            <?php if (isset($erroresViaje['descripcion'])): ?>
                <p class="mensaje_error"><?php echo $erroresViaje['descripcion']; ?></p>
            <?php endif; ?>

            <label for="descripcion_larga">Descripción completa</label>
            <textarea id="descripcion_larga" name="descripcion_larga"><?php echo isset($datosViaje['descripcion_larga']) ? htmlspecialchars($datosViaje['descripcion_larga']) : ''; ?></textarea>

            <label for="precio">Precio (EUR)</label>
            <input id="precio" type="number" step="0.01" name="precio" value="<?php echo isset($datosViaje['precio']) ? htmlspecialchars($datosViaje['precio']) : ''; ?>">

            <label for="incluye">Incluye</label>
            <textarea id="incluye" name="incluye"><?php echo isset($datosViaje['incluye']) ? htmlspecialchars($datosViaje['incluye']) : ''; ?></textarea>

            <label for="alojamientos">Alojamientos (uno por línea)</label>
            <textarea id="alojamientos" name="alojamientos"><?php echo isset($datosViaje['alojamientos']) ? htmlspecialchars($datosViaje['alojamientos']) : ''; ?></textarea>

            <label for="continente">Continente</label>
            <select id="continente" name="continente">
                <option value="">--Selecciona continente--</option>
                <?php foreach ($continentes as $cont): ?>
                    <option value="<?php echo htmlspecialchars($cont); ?>" <?php echo (isset($datosViaje['continente']) && $datosViaje['continente']==$cont)?'selected':''; ?>><?php echo htmlspecialchars($cont); ?></option>
                <?php endforeach; ?>
            </select>

            <label for="pais">País</label>
            <select id="pais" name="pais">
                <option value="">--Selecciona país--</option>
                <?php foreach ($countries as $c): ?>
                    <option value="<?php echo htmlspecialchars($c); ?>" <?php echo (isset($datosViaje['pais']) && $datosViaje['pais']==$c)?'selected':''; ?>><?php echo htmlspecialchars($c); ?></option>
                <?php endforeach; ?>
            </select>

            <label for="imagen">Imagen (selecciona una del servidor)</label>
            <select id="imagen" name="imagen" onchange="document.getElementById('preview').src='imagenes/'+this.value">
                <option value="">--Selecciona imagen--</option>
                <?php foreach ($images as $img): ?>
                    <option value="<?php echo htmlspecialchars($img); ?>" <?php echo (isset($datosViaje['imagen']) && $datosViaje['imagen']==$img)?'selected':''; ?>><?php echo htmlspecialchars($img); ?></option>
                <?php endforeach; ?>
            </select>
            
            <img id="preview" src="" alt="Previsualización" style="max-width:200px;margin-top:8px">
            

            <button type="submit">Crear nuevo viaje</button>

        </fieldset>
        
    </form>
</main>
<?php include 'includes/footer.php'; ?>