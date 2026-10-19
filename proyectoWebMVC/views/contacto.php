
<section class="seccion">
    <span class="etiqueta">Hablemos</span>
    <h2>Contáctame</h2>
    <p>Completa el formulario. Tu mensaje quedará guardado en la base de datos.</p>

    <?php echo $mensaje_db; ?>

    <form action="contacto" method="POST" class="formulario">
        <div class="campo">
            <label for="nombre">Nombre completo</label>
            <input
                type="text"
                id="nombre"
                name="nombre"
                maxlength="100"
                autocomplete="name"
                required
            >
        </div>

        <div class="campo">
            <label for="correo">Correo electrónico</label>
            <input
                type="email"
                id="correo"
                name="correo"
                maxlength="150"
                autocomplete="email"
                required
            >
        </div>

        <div class="campo">
            <label for="comentario">Comentario</label>
            <textarea
                id="comentario"
                name="comentario"
                rows="6"
                required
            ></textarea>
        </div>

        <button type="submit" class="boton">Enviar mensaje</button>
    </form>
</section>
