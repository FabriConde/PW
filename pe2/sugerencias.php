<?php include 'includes/header.php'; ?>
<main>
    <h2>Sugerencias</h2>
    <p>En este apartado compartimos experiencias, opiniones y propuestas de mejora de usuarios que viajaron con PW-TravelPro.</p>
    <article class="tarjetas">
        <article class="tarjeta">
            <h3>Ana Ruiz Manjon</h3>
            <p><strong>Tipo:</strong> Experiencia</p>
            <p><strong>Destino:</strong> París</p>
            <p>La organización fue excelente. El hotel estaba bien ubicado y las excursiones se cumplieron tal y como se indicaba.</p>
        </article>
        <article class="tarjeta">
            <h3>Carlos Manjon</h3>
            <p><strong>Tipo:</strong> Sugerencia</p>
            <p><strong>Destino:</strong> Shanghái</p>
            <p>Propongo añadir packs opcionales para familias con niños y actividades culturales adaptadas.</p>
        </article>
        <article class="tarjeta">
            <h3>Carlos Gómez </h3>
            <p><strong>Tipo:</strong> Experiencia</p>
            <p><strong>Destino:</strong> París</p>
            <p>La organización fue excelente. El hotel estaba bien ubicado y las excursiones se cumplieron tal y como se indicaba.</p>
        </article>
        <article class="tarjeta">
            <h3>Carlos Gómez </h3>
            <p><strong>Tipo:</strong> Experiencia</p>
            <p><strong>Destino:</strong> París</p>
            <p>La organización fue excelente. El hotel estaba bien ubicado y las excursiones se cumplieron tal y como se indicaba.</p>
        </article>
        <article class="tarjeta">
            <h3>Carlos Gómez </h3>
            <p><strong>Tipo:</strong> Experiencia</p>
            <p><strong>Destino:</strong> París</p>
            <p>La organización fue excelente. El hotel estaba bien ubicado y las excursiones se cumplieron tal y como se indicaba.</p>
        </article>
    </article>

    <article class="formulario-sugerencia">
        <form method="post">
            <fieldset>
                <legend><h3>Comparte tu experiencia, opinión o sugerencia</h3></legend>
                <label for="nombre">Nombre y apellidos</label>
                <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" required>

                <label for="correo">Correo electrónico</label>
                <input type="email" id="correo" name="correo" placeholder="ejemplo@ejemplo.com" required>

                <label for="tipo">Tipo de aportación</label>
                <select id="tipo" name="tipo" required>
                    <option value="" disabled selected>Selecciona una opción</option>
                    <option value="experiencia">Experiencia</option>
                    <option value="opinion">Opinión</option>
                    <option value="sugerencia">Sugerencia</option>
                </select>
                
                <label for="destino">Destino relacionado</label>
                <input type="text" id="destino" name="destino" placeholder="Ejemplo: Niza, Toronto, Pekín" required>

                <label for="mensaje">Tu mensaje</label>
                <textarea id="mensaje" name="mensaje" rows="2" placeholder="Escribe aquí tu experiencia, opinión o sugerencia" required></textarea>

                <button class="boton-enlace" type="submit">Enviar</button>
            </fieldset>
        </form>
    </article>
</main>
<?php include 'includes/footer.php'; ?>