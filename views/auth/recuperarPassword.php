<h1 class="nombrePagina">Recuperar Contraseña</h1>
<p class="descripcionPag">Introduce tu nueva contraseña a continuación</p>

<?php
    include_once __DIR__ . "/../templates/alertas.php"
?>

<?php
    if ($error) {
        return;
    }
?>

<form class="formulario" method="POST">
    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Introduzca su nueva Password">
    </div>
    <input class="boton" type="submit" value="Guardar Nuevo Password">

</form>

<div class="acciones">
<a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/crearCuenta">¿Aún no tienes una cuenta? Crear Una</a>
</div>
