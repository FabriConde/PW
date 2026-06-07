<?php include 'includes/header.php';
$error = $_SESSION['error'] ?? '';
$mensaje = $_SESSION['mensaje'] ?? '';
$datosUsuario = $_SESSION['datosUsuario'] ?? [];
unset($_SESSION['error'], $_SESSION['mensaje'], $_SESSION['datosUsuario']);
?>

<main class="alta-usuarios-main">
    <?php if (!empty($mensaje)): ?>
        <h1 class="mensaje-exito"><?php echo htmlspecialchars($mensaje); ?></h1>
    <?php endif; ?>

    <h2>Alta de usuarios</h2>
    <p class="mensaje-info">Completa todos los campos con * para registrarte en PW-TravelPro</p>

    <?php if (!empty($error)): ?>
        <p class="mensaje-error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form id="form-registro" class="alta-usuarios" action="controller/registro_usuario.php" method="post" enctype="multipart/form-data" novalidate>
        <fieldset>
            <legend>Datos personales</legend>
            
            <label for="nombre">*Nombre</label>
            <input id="nombre" type="text" name="nombre" 
            value="<?php echo htmlspecialchars($datosUsuario['nombre'] ?? ''); ?>">
            <output id="error-nombre" class="mensaje-error"></output>

            <label for="apellidos">*Apellidos</label> 
            <input id="apellidos" type="text" name="apellidos" 
            value="<?php echo htmlspecialchars($datosUsuario['apellidos'] ?? ''); ?>">
            <output id="error-apellidos" class="mensaje-error"></output>
            
            <label for="fecha-nacimiento">*Fecha de nacimiento</label>
            <input id="fecha-nacimiento" type="text" name="fecha-nacimiento" placeholder="yyyy-mm-dd" 
            value="<?php echo htmlspecialchars($datosUsuario['fecha-nacimiento'] ?? ''); ?>">
            <output id="error-fecha-nacimiento" class="mensaje-error"></output>

            <label for="edad">*Edad</label>
            <input id="edad" type="text" name="edad"
            value="<?php echo htmlspecialchars($datosUsuario['edad'] ?? ''); ?>">
            <output id="error-edad" class="mensaje-error"></output>

            <label for="dni">*DNI</label>
            <input id="dni" type="text" name="dni"
            value="<?php echo htmlspecialchars($datosUsuario['dni'] ?? ''); ?>">
            <output id="error-dni" class="mensaje-error"></output>

            <label for="telefono">*Teléfono</label>
            <input id="telefono" type="text" name="telefono"
            value="<?php echo htmlspecialchars($datosUsuario['telefono'] ?? ''); ?>">
            <output id="error-telefono" class="mensaje-error"></output>
           
        </fieldset>

        <fieldset>
            <legend>Datos de acceso</legend>

            <label for="email">*Correo electrónico</label>
            <input id="email" type="text" name="email" placeholder="usuario@correo.com" 
            value="<?php echo htmlspecialchars($datosUsuario['email'] ?? ''); ?>">
            <output id="error-email" class="mensaje-error"></output>

            <label for="usuario">*Nombre de usuario</label>
            <input id="usuario" type="text" name="usuario"
            value="<?php echo htmlspecialchars($datosUsuario['usuario'] ?? ''); ?>">
            <output id="error-usuario" class="mensaje-error"></output>
           
            <label for="password">*Contraseña</label>
            <input id="password" type="password" name="password" placeholder="Mínimo 8 caracteres y 1 número">
            <output id="error-password" class="mensaje-error"></output>
            
            <label for="foto">Foto de perfil</label>
            <input id="foto" type="file" name="foto" accept="image/*" >
        </fieldset>

        <fieldset>
            <legend>Preferencias de viaje</legend>

            <p>*Género</p>
            <article class="genero">
                <label class="checkbox-radio"><input type="radio" name="genero" value="mujer" > Mujer</label>
                <label class="checkbox-radio"><input type="radio" name="genero" value="hombre" > Hombre</label>
                <label class="checkbox-radio"><input type="radio" name="genero" value="otro" > Otro</label>
            </article>
            <output id="error-genero" class="mensaje-error"></output>

            <label for="nacionalidad">*Nacionalidad</label>
            <select id="nacionalidad" name="nacionalidad" >
                <option value="" selected disabled>Selecciona una opción</option>
                <option value="es">Española</option>
                <option value="fr">Francesa</option>
                <option value="cn">China</option>
                <option value="ca">Canadiense</option>
                <option value="otra">Otra</option>
            </select>
            <output id="error-nacionalidad" class="mensaje-error"></output>

            <label for="destino">*Destino preferido</label>
            <input id="destino" list="destinos" name="destino" 
            value="<?php echo htmlspecialchars($datosUsuario['destino'] ?? ''); ?>">
            <datalist id="destinos">
                <option value="París">
                <option value="Tokio">
                <option value="Quebec">
                <option value="Toronto">
                <option value="Pekín">
                <option value="Marsella">
                <option value="Nueva York">
            </datalist>
            <output id="error-destino" class="mensaje-error"></output>

            <label for="tipo-viaje">*Tipo de viaje</label>
            <select id="tipo-viaje" name="tipo-viaje" >
                <option value="" selected disabled>Selecciona una opción</option>
                    <option value="aventura" <?php echo (($datosUsuario['tipo-viaje'] ?? '') === 'aventura') ? 'selected' : ''; ?>>Aventura</option>
                    <option value="relax" <?php echo (($datosUsuario['tipo-viaje'] ?? '') === 'relax') ? 'selected' : ''; ?>>Relax</option>
                    <option value="cultural" <?php echo (($datosUsuario['tipo-viaje'] ?? '') === 'cultural') ? 'selected' : ''; ?>>Cultural</option>
                    <option value="gastronomico" <?php echo (($datosUsuario['tipo-viaje'] ?? '') === 'gastronomico') ? 'selected' : ''; ?>>Gastronómico</option>
                    <option value="otro" <?php echo (($datosUsuario['tipo-viaje'] ?? '') === 'otro') ? 'selected' : ''; ?>>Otro</option>
            </select>
            <output id="error-tipo-viaje" class="mensaje-error"></output>

            <label for="acompanantes">*Número de acompañantes:</label>
            <input id="acompanantes" type="range" name="acompanantes" value="<?php echo htmlspecialchars($datosUsuario['acompanantes'] ?? '2'); ?>" >
            <output id="valor-acompanantes" class="mensaje-info"><?php echo htmlspecialchars($datosUsuario['acompanantes'] ?? '2'); ?></output>
            <output id="error-acompanantes" class="mensaje-error"></output>
        </fieldset>

        <fieldset>
            <legend>Observaciones y confirmación</legend>

            <label for="comentarios">Comentarios o necesidades especiales</label>
            <textarea id="comentarios" name="comentarios" rows="2"><?php echo htmlspecialchars($datosUsuario['comentarios'] ?? ''); ?></textarea>
        
            <label for="web">Sitio web similares que usas para buscar viajes</label>
            <input id="web" type="url" name="web" placeholder="https://miweb.com" 
            value="<?php echo htmlspecialchars($datosUsuario['web'] ?? ''); ?>">
           
            <label class="checkbox-radio">
                <input id="condiciones" type="checkbox" name="condiciones" 
                <?php echo !empty($datosUsuario['condiciones']) ? 'checked' : ''; ?>> *Acepto las condiciones de uso y la política de privacidad.
            </label>
           <output id="error-condiciones" class="mensaje-error"></output>
        </fieldset>

        <nav class="acciones-formulario">
            <button type="submit">Registrar</button>
            <button type="reset">Limpiar</button>
        </nav>
    </form>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const formularioAltaUsuario = document.getElementById('form-registro');

        const acompanantesInput = document.getElementById('acompanantes');
        const valorAcompanantes = document.getElementById('valor-acompanantes');
        if (acompanantesInput) {
            acompanantesInput.min = 1;
            acompanantesInput.max = 10;
            acompanantesInput.step = 1;
            if (valorAcompanantes) valorAcompanantes.textContent = acompanantesInput.value || '2';
            acompanantesInput.addEventListener('input', function(e) {
                let valor = parseInt(e.target.value, 10) || 2;
                if (valor < 1) valor = 1;
                if (valor > 10) valor = 10;
                e.target.value = valor;
                if (valorAcompanantes) valorAcompanantes.textContent = valor;
            });
        }

        formularioAltaUsuario.addEventListener('submit', function(evento) {
            let hayErrores = false;

            function manejarError(idCampo, idError, condicion, mensaje) {
                const outputError = document.getElementById(idError);
                if (condicion){
                    outputError.textContent = mensaje;
                    hayErrores = true;
                } else {
                    outputError.textContent = '';
                }
            }

            const nombre = document.getElementById('nombre').value.trim();
            manejarError('nombre', 'error-nombre', nombre.length < 2, 'El nombre debe tener al menos 2 caracteres.');

            const apellidos = document.getElementById('apellidos').value.trim();
            manejarError('apellidos', 'error-apellidos', apellidos.length < 2, 'Los apellidos deben tener al menos 2 caracteres.');

            const fecha = document.getElementById('fecha-nacimiento').value.trim();
            const regexFecha = /^\d{4}-\d{2}-\d{2}$/; 
            manejarError('fecha-nacimiento', 'error-fecha-nacimiento', !regexFecha.test(fecha), 'La fecha debe tener el formato YYYY-MM-DD.');

            const edad = document.getElementById('edad').value.trim();
            manejarError('edad', 'error-edad', edad === "" || isNaN(edad) || parseInt(edad) < 18, 'Debes ser mayor de 18 años y usar un formato numérico.');

            const dni = document.getElementById('dni').value.trim();
            const regexDni = /^[0-9]{8}[A-Za-z]$/;
            manejarError('dni', 'error-dni', !regexDni.test(dni), 'El DNI debe tener 8 números seguidos de 1 letra.');

            const telefono = document.getElementById('telefono').value.trim();
           const regexTel = /^[67][0-9]{8}$/;
            manejarError('telefono', 'error-telefono', !regexTel.test(telefono), 'El teléfono debe contener exactamente 9 números.');

            const email = document.getElementById('email').value.trim();
            const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            manejarError('email', 'error-email', !regexEmail.test(email), 'Introduce un correo electrónico válido.');

            const usuario = document.getElementById('usuario').value.trim();
            manejarError('usuario', 'error-usuario', usuario.length < 4, 'El nombre de usuario debe tener al menos 4 caracteres.');

            const password = document.getElementById('password').value.trim();
            const regexPass = /(?=.*[0-9]).{8,}/;
            manejarError('password', 'error-password', !regexPass.test(password), 'La contraseña debe tener al menos 8 caracteres e incluir un número.');

            const generoOpciones = document.querySelectorAll('input[name="genero"]');
            let generoSeleccionado = false;
            generoOpciones.forEach(opcion => { if (opcion.checked) generoSeleccionado = true; });
            manejarError('genero', 'error-genero', !generoSeleccionado, 'Debes seleccionar un género.');

            const nacionalidad = document.getElementById('nacionalidad').value;
            manejarError('nacionalidad', 'error-nacionalidad', nacionalidad === "", 'Debes seleccionar tu nacionalidad.');
            
            const destino = document.getElementById('destino').value;
            manejarError('destino', 'error-destino', destino === "", 'Debes seleccionar un destino.');

            const tipoViaje = document.getElementById('tipo-viaje').value;
            manejarError('tipo-viaje', 'error-tipo-viaje', tipoViaje === "", 'Debes seleccionar un tipo de viaje.');

            const acompanantesVal = parseInt(document.getElementById('acompanantes').value, 10);
            manejarError('acompanantes', 'error-acompanantes', isNaN(acompanantesVal) || acompanantesVal < 1 || acompanantesVal > 10, 'Debes seleccionar entre 1 y 10 acompañantes.');

            const condiciones = document.getElementById('condiciones').checked;
            manejarError('condiciones', 'error-condiciones', !condiciones, 'Debes aceptar las condiciones de uso.');

            if (hayErrores) {
                evento.preventDefault(); 
            }
        });

        formularioAltaUsuario.addEventListener('reset', function() {
            const outputError = document.querySelectorAll('.mensaje-error');
            outputError.forEach(function(error) {
                error.textContent = '';
            });
        });
    });
</script>

<?php include 'includes/footer.php'; ?>