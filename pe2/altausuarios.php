<?php include 'includes/header.php';
$errores = $_SESSION['errores'] ?? [];
$erroresGenerales = $_SESSION['erroresGenerales'] ?? [];
$mensaje = $_SESSION['mensaje'] ?? '';
$datosUsuario = $_SESSION['datosUsuario'] ?? [];
unset($_SESSION['errores']);
unset($_SESSION['erroresGenerales']);
unset($_SESSION['mensaje']);
unset($_SESSION['datosUsuario']);
?>

<main class="alta-usuarios-main">
    <?php if (!empty($mensaje)): ?>
        <h1 class="mensaje_exito"><?php echo htmlspecialchars($mensaje); ?></h1>
    <?php endif; ?>

    <?php if (isset($errores['general'])): ?>
        <p class="mensaje_error"><?php echo $errores['general']; ?></p>
    <?php endif; ?>
    <h2>Alta de usuarios</h2>
    <p>Completa todos los campos para registrarte en PW-TravelPro.</p>
    <form class="alta-usuarios" action="controller/procesar_registro_usuario.php" method="post" novalidate>
        <fieldset>
            <legend>Datos personales</legend>
            <label for="nombre">Nombre</label>
            <input id="nombre" type="text" name="nombre" 
            class="<?php echo isset($errores['nombre']) ? 'is-invalid' : '' ?>" minlength="2" maxlength="40"
            value="<?php echo isset($datosUsuario['nombre']) ? htmlspecialchars($datosUsuario['nombre']) : ''; ?>">
            <?php if (isset($errores['nombre'])): ?>
                <p class="mensaje_error"><?php echo $errores['nombre']; ?></p>
            <?php endif; ?>

            <label for="apellidos">Apellidos</label> 
            <input id="apellidos" type="text" name="apellidos" 
            class="<?php echo isset($errores['apellidos']) ? 'is-invalid' : '' ?>" minlength="2" maxlength="60"
            value="<?php echo isset($datosUsuario['apellidos']) ? htmlspecialchars($datosUsuario['apellidos']) : ''; ?>">
            <?php if (isset($errores['apellidos'])): ?>
                <p class="mensaje_error"><?php echo $errores['apellidos']; ?></p>
            <?php endif; ?>

            <label for="fecha-nacimiento">Fecha de nacimiento</label>
            <input id="fecha-nacimiento" type="date" name="fecha-nacimiento" 
            class="<?php echo isset($errores['fecha-nacimiento']) ? 'is-invalid' : '' ?>" 
            value="<?php echo isset($datosUsuario['fecha-nacimiento']) ? htmlspecialchars($datosUsuario['fecha-nacimiento']) : ''; ?>">
            <?php if (isset($errores['fecha-nacimiento'])): ?>
                <p class="mensaje_error"><?php echo $errores['fecha-nacimiento']; ?></p>
            <?php endif; ?>

            <label for="edad">Edad</label>
            <input id="edad" type="number" name="edad" min="18" max="120" 
            class="<?php echo isset($errores['edad']) ? 'is-invalid' : '' ?>" 
            value="<?php echo isset($datosUsuario['edad']) ? htmlspecialchars($datosUsuario['edad']) : ''; ?>">
            <?php if (isset($errores['edad'])): ?>
                <p class="mensaje_error"><?php echo $errores['edad']; ?></p>
            <?php endif; ?>

            <label for="dni">DNI</label>
            <input id="dni" type="text" name="dni" pattern="[0-9]{8}[A-Za-z]" placeholder="Ejemplo: 12345678A" 
            class="<?php echo isset($errores['dni']) ? 'is-invalid' : '' ?>" 
            value="<?php echo isset($datosUsuario['dni']) ? htmlspecialchars($datosUsuario['dni']) : ''; ?>">
            <?php if (isset($errores['dni'])): ?>
                <p class="mensaje_error"><?php echo $errores['dni']; ?></p>
            <?php endif; ?>
            
            <label for="telefono">Teléfono</label>
            <input id="telefono" type="tel" name="telefono" pattern="[0-9]{9}" placeholder="Ejemplo: 612345678" 
            class="<?php echo isset($errores['telefono']) ? 'is-invalid' : '' ?>" 
            value="<?php echo isset($datosUsuario['telefono']) ? htmlspecialchars($datosUsuario['telefono']) : ''; ?>">
            <?php if (isset($errores['telefono'])): ?>
                <p class="mensaje_error"><?php echo $errores['telefono']; ?></p>
            <?php endif; ?>
        </fieldset>

        <fieldset>
            <legend>Datos de acceso</legend>

            <label for="email">Correo electrónico</label>
            <input id="email" type="email" name="email" placeholder="usuario@correo.com" 
            class="<?php echo isset($errores['email']) ? 'is-invalid' : '' ?>" 
            value="<?php echo isset($datosUsuario['email']) ? htmlspecialchars($datosUsuario['email']) : ''; ?>">
            <?php if (isset($errores['email'])): ?>
                <p class="mensaje_error"><?php echo $errores['email']; ?></p>
            <?php endif; ?>
            <label for="usuario">Nombre de usuario</label>
            <input id="usuario" type="text" name="usuario" minlength="4" maxlength="20" 
            class="<?php echo isset($errores['usuario']) ? 'is-invalid' : '' ?>" 
            value="<?php echo isset($datosUsuario['usuario']) ? htmlspecialchars($datosUsuario['usuario']) : ''; ?>">
            <?php if (isset($errores['usuario'])): ?>
                <p class="mensaje_error"><?php echo $errores['usuario']; ?></p>
            <?php endif; ?>
            <label for="password">Contraseña</label>
            <input id="password" type="password" name="password" minlength="8" pattern="(?=.*[A-Za-z])(?=.*[0-9]).{8,}" placeholder="Mínimo 8 caracteres y 1 número" 
            class="<?php echo isset($errores['password']) ? 'is-invalid' : '' ?>">
            <?php if (isset($errores['password'])): ?>
                <p class="mensaje_error"><?php echo $errores['password']; ?></p>
            <?php endif; ?>
            <label for="foto">Foto de perfil</label>
            <input id="foto" type="file" name="foto" accept="image/*" >
        </fieldset>

        <fieldset>
            <legend>Preferencias de viaje</legend>

            <p>Género</p>
            <article class="genero">
                <label class="checkbox-radio"><input type="radio" name="genero" value="mujer" > Mujer</label>
                <label class="checkbox-radio"><input type="radio" name="genero" value="hombre" > Hombre</label>
                <label class="checkbox-radio"><input type="radio" name="genero" value="otro" > Otro</label>
            </article>

            <label for="nacionalidad">Nacionalidad</label>
            <select id="nacionalidad" name="nacionalidad" >
                <option value="" selected disabled>Selecciona una opción</option>
                <option value="es">Española</option>
                <option value="fr">Francesa</option>
                <option value="cn">China</option>
                <option value="ca">Canadiense</option>
                <option value="otra">Otra</option>
            </select>

            <label for="destino">Destino preferido</label>
            <input id="destino" list="destinos" name="destino" >
            <datalist id="destinos">
                <option value="París">
                <option value="Tokio">
                <option value="Quebec">
                <option value="Toronto">
                <option value="Pekín">
                <option value="Marsella">
                <option value="Nueva York">
            </datalist>

            <label for="tipo-viaje">Tipo de viaje</label>
            <select id="tipo-viaje" name="tipo-viaje" >
                <option value="" selected disabled>Selecciona una opción</option>
                <option value="aventura">Aventura</option>
                <option value="relax">Relax</option>
                <option value="cultural">Cultural</option>
                <option value="gastronomico">Gastronómico</option>
                <option value="otro">Otro</option>
            </select>

            <label for="acompanantes">Número de acompañantes: 2</label>
            <input id="acompanantes" type="range" name="acompanantes" min="0" max="10" value="2" >
        </fieldset>

        <fieldset>
            <legend>Observaciones y confirmación</legend>

            <label for="comentarios">Comentarios o necesidades especiales</label>
            <textarea id="comentarios" name="comentarios" rows="2"><?php echo isset($datosUsuario['comentarios']) ? htmlspecialchars(trim($datosUsuario['comentarios'])) : ''; ?></textarea>
        
            <label for="web">Sitio web similares que usas para buscar viajes</label>
            <input id="web" type="url" name="web" placeholder="https://miweb.com" 
            value="<?php echo isset($datosUsuario['web']) ? htmlspecialchars($datosUsuario['web']) : ''; ?>">
           
            <label class="checkbox-radio">
                <input id="condiciones" type="checkbox" name="condiciones" 
                class="<?php echo isset($errores['condiciones']) ? 'is-invalid' : '' ?>" <?php echo isset($datosUsuario['condiciones']) && $datosUsuario['condiciones'] ? 'checked' : ''; ?>> Acepto las condiciones de uso y la política de privacidad.
            </label>
            <?php if (isset($errores['condiciones'])): ?>
                <p class="mensaje_error"><?php echo $errores['condiciones']; ?></p>
            <?php endif; ?>
        </fieldset>

        <nav class="acciones-formulario">
            <button type="submit">Enviar registro</button>
            <button type="reset">Borrar formulario</button>
        </nav>
    </form>
</main>
<?php include 'includes/footer.php'; ?>