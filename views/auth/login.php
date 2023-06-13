<h1 class="nombrePagina">Login</h1>
<p class="descripcionPag">Inicia sesión con tus datos</p>

<?php
    include_once __DIR__ . "/../templates/alertas.php"
?>

<form class="formulario" method="POST" action="/">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Introduzca su Email">
    </div>

    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Introduzca su Password">
    </div>

    <input type="submit" class="boton" value="Iniciar Sesión">
</form>

<div class="acciones">
    <a href="/crearCuenta">¿Aún no tienes una cuenta? Crear Una</a>
    <a href="/olvide">¿Has olvidado tu contraseña?</a>
</div>