<h1 class="nombrePagina">Olvide mi Contraseña</h1>
<p class="descripcionPag">Recupera tu contraseña con tu Email</p>

<?php
include_once __DIR__ . '/../templates/alertas.php'; ?>

<form class="formulario" method="POST" action="/olvide">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Introduzca su Email">
    </div>

    <input type="submit" class="boton" value="Enviar">
</form>

<div class="acciones">
<a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/crearCuenta">¿Aún no tienes una cuenta? Crear Una</a>
</div>