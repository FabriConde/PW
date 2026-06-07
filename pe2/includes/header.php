<?php
require_once __DIR__ . '/../config/session.php';
$error = $_SESSION['errorLogin'] ?? [];
$logeado = $_SESSION['logeado'] ?? false;
$esAdmin = $_SESSION['esAdmin'] ?? false;
$nombreUsuario = $_SESSION['nombreUsuario'] ?? '';
unset($_SESSION['errorLogin']);
?>
<!doctype html>
<html lang="es-ES">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
        <link rel="stylesheet" href="css/styles.css">
        <title>PW-TravelPro</title>
    </head>
    <body>
        <header>
            <article class="cabecera">
                <img src="imagenes/logo.png" alt="Logo de la agencia">
                <?php if ($logeado): ?>
                    <article class="usuario-logeado">
                        <?php if ($esAdmin): ?>
                            <p>Tipo de usuario: Administrador</p>
                        <?php else: ?>
                            <p>Tipo de usuario: Normal</p>
                        <?php endif; ?>
                        <article class="opciones-usuario">
                            <h1>Bienvenido, <?php echo htmlspecialchars($nombreUsuario); ?>!</h1>
                            <a class="boton-enlace" href='controller/logout_usuario.php'>Cerrar Sesión</a>
                        </article>
                    </article>
                <?php else: ?>
                    <article class="logear-usuario">
                        <article class="login">
                            <form id="form-login" action="controller/login_usuario.php" method="post" novalidate>
                                <input id="email-login" type="text" name="email" placeholder="Email del usuario">
                                <input id="password-login" type="password" name="password" placeholder="Contraseña">
                                <button type="submit">Iniciar Sesión</button>
                            </form>
                            <a class="boton-enlace" href='altausuarios.php'>Registrarse</a>
                        </article>
                        <?php if (!empty($error)): ?>
                            <p class="mensaje-error"><?php echo htmlspecialchars($error); ?></p>
                        <?php endif; ?>
                        <p id="error-email-login" class="mensaje-error"></p>
                        <p id="error-password-login" class="mensaje-error"></p>
                    </article>
                <?php endif; ?>
            </article>
            <nav class="barra-navegacion">
                <button class="menu-toggle">☰</button>
                <ul class="menu">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="viajes.php">Viajes</a></li>
                    <li><a href="viajes_grupo.php">Viajes en Grupo</a></li>
                    <li><a href="ofertas.php">Ofertas</a></li>
                    <li><a href="sobre_agencia.php">Sobre nuestra agencia</a></li>
                    <li><a href="sugerencias.php">Sugerencias</a></li>
                </ul>
            </nav>
        </header>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const formularioLogin = document.getElementById('form-login');
        
        formularioLogin.addEventListener('submit', function(evento) {
            let hayErrores = false;

            function manejarError(idCampo, idError, condicion, mensaje){
                const outputError = document.getElementById(idError);
                if (condicion){
                    outputError.textContent = mensaje;
                    hayErrores = true;
                } else {
                    outputError.textContent = '';
                }
            }

            const email = document.getElementById('email-login').value.trim();
            const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            manejarError('email-login', 'error-email-login', !regexEmail.test(email), 'Introduce un correo electrónico válido.');

            const password = document.getElementById('password-login').value.trim();
            const regexPass = /(?=.*[0-9]).{8,}/;
            manejarError('password-login', 'error-password-login', !regexPass.test(password), 'La contraseña debe tener al menos 8 caracteres e incluir un número.');

            if (hayErrores) {
                evento.preventDefault();
            }
        });
    });
</script>