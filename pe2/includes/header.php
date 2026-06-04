<?php
require_once __DIR__ . '/../config/session.php';
$erroresLogin = $_SESSION['erroresLogin'] ?? [];
$logeado = $_SESSION['logeado'] ?? false;
$nombreUsuario = $_SESSION['nombreUsuario'] ?? '';
unset($_SESSION['erroresLogin']);
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
                        <h1>Bienvenido, <?php echo htmlspecialchars($nombreUsuario); ?>!</h1>
                        <a class="boton-enlace" href='controller/procesar_logout_usuario.php'>Cerrar Sesión</a>
                    </article>
                <?php else: ?>
                    <article class="login">
                        <form action="controller/procesar_login_usuario.php" method="post" novalidate>
                            <input type="email" name="email" placeholder="Email del usuario"
                            class="<?php echo isset($erroresLogin['email']) ? 'is-invalid' : '' ?>">
                            <?php if (isset($erroresLogin['email'])): ?>
                                <p class="mensaje_error"><?php echo $erroresLogin['email']; ?></p>
                            <?php endif; ?>
                            <input type="password" name="password" placeholder="Contraseña"
                            class="<?php echo isset($erroresLogin['password']) ? 'is-invalid' : '' ?>">
                            <?php if (isset($erroresLogin['password'])): ?>
                                <p class="mensaje_error"><?php echo $erroresLogin['password']; ?></p>
                            <?php endif; ?>
                            <button type="submit">Iniciar Sesión</button>
                        </form>
                        <a class="boton-enlace" href='altausuarios.php'>Registrarse</a>
                        <?php if (isset($erroresLogin['general'])): ?>
                            <p class="mensaje_error"><?php echo $erroresLogin['general']; ?></p>
                        <?php endif; ?>
                    </article>
                <?php endif; ?>
            </article>
            <nav class="barra-navegacion">
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="viajes.php">Viajes</a></li>
                    <li><a href="viajes_grupo.php">Viajes en Grupo</a></li>
                    <li><a href="ofertas.php">Ofertas</a></li>
                    <li><a href="sobre_agencia.php">Sobre nuestra agencia</a></li>
                    <li><a href="sugerencias.php">Sugerencias</a></li>
                </ul>
            </nav>
        </header>