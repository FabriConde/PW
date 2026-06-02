<?php include 'includes/header.php'; ?>
<main class="alta-usuarios-main">
    <h2>Alta de usuarios</h2>
    <p>Completa todos los campos para registrarte en PW-TravelPro.</p>

    <form class="alta-usuarios" action="controller/procesar_login_usuario.php" method="post" autocomplete="on">
        <fieldset>
            <legend>Datos personales</legend>
            <label for="nombre">Nombre</label>
            <input id="nombre" type="text" name="nombre" minlength="2" maxlength="40" required>

            <label for="apellidos">Apellidos</label>
            <input id="apellidos" type="text" name="apellidos" minlength="2" maxlength="60" required>

            <label for="fecha-nacimiento">Fecha de nacimiento</label>
            <input id="fecha-nacimiento" type="date" name="fecha_nacimiento" required>

            <label for="edad">Edad</label>
            <input id="edad" type="number" name="edad" min="18" max="120" required>

            <label for="dni">DNI</label>
            <input id="dni" type="text" name="dni" pattern="[0-9]{8}[A-Za-z]" placeholder="Ejemplo: 12345678A" required>

            <label for="telefono">Teléfono</label>
            <input id="telefono" type="tel" name="telefono" pattern="[0-9]{9}" placeholder="Ejemplo: 612345678" required>
        </fieldset>

        <fieldset>
            <legend>Datos de acceso</legend>

            <label for="email">Correo electrónico</label>
            <input id="email" type="email" name="email" placeholder="usuario@correo.com" required>

            <label for="usuario">Nombre de usuario</label>
            <input id="usuario" type="text" name="usuario" minlength="4" maxlength="20" required>

            <label for="password">Contraseña</label>
            <input id="password" type="password" name="password" minlength="8" pattern="(?=.*[A-Za-z])(?=.*[0-9]).{8,}" placeholder="Mínimo 8 caracteres y 1 número" required>

            <label for="foto">Foto de perfil</label>
            <input id="foto" type="file" name="foto" accept="image/*" required>
        </fieldset>

        <fieldset>
            <legend>Preferencias de viaje</legend>

            <p>Género</p>
            <article class="genero">
                <label class="checkbox-radio"><input type="radio" name="genero" value="mujer" required> Mujer</label>
                <label class="checkbox-radio"><input type="radio" name="genero" value="hombre" required> Hombre</label>
                <label class="checkbox-radio"><input type="radio" name="genero" value="otro" required> Otro</label>
            </article>

            <label for="nacionalidad">Nacionalidad</label>
            <select id="nacionalidad" name="nacionalidad" required>
                <option value="" selected disabled>Selecciona una opción</option>
                <option value="es">Española</option>
                <option value="fr">Francesa</option>
                <option value="cn">China</option>
                <option value="ca">Canadiense</option>
                <option value="otra">Otra</option>
            </select>

            <label for="destino">Destino preferido</label>
            <input id="destino" list="destinos" name="destino" required>
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
            <select id="tipo-viaje" name="tipo_viaje" required>
                <option value="" selected disabled>Selecciona una opción</option>
                <option value="aventura">Aventura</option>
                <option value="relax">Relax</option>
                <option value="cultural">Cultural</option>
                <option value="gastronomico">Gastronómico</option>
                <option value="otro">Otro</option>
            </select>

            <label for="acompanantes">Número de acompañantes: 2</label>
            <input id="acompanantes" type="range" name="acompanantes" min="0" max="10" value="2" required>
        </fieldset>

        <fieldset>
            <legend>Observaciones y confirmación</legend>

            <label for="comentarios">Comentarios o necesidades especiales</label>
            <textarea id="comentarios" name="comentarios" rows="3" minlength="15" maxlength="400" required></textarea>

            <label for="web">Sitio web similares que usas para buscar viajes</label>
            <input id="web" type="url" name="web" placeholder="https://miweb.com" required>

            <label class="checkbox-radio">
                <input id="terminos" type="checkbox" name="acepto" required> Acepto las condiciones de uso y la política de privacidad.
            </label>
        </fieldset>

        <nav class="acciones-formulario">
            <button type="submit">Enviar registro</button>
            <button type="reset">Borrar formulario</button>
        </nav>
    </form>
</main>
<?php include 'includes/footer.php'; ?>