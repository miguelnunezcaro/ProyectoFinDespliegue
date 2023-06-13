<h1 class="nombrePagina">Crear Cuenta</h1>
<p class="descripcionPag">Introduce los siguientes datos para crear una cuenta</p>

<?php
    include_once __DIR__ . "/../templates/alertas.php"
?>

<form class="formulario" action="/crearCuenta" method="POST">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" placeholder="Introduzca su Nombre" value="<?php echo s($usuario->nombre) ?>">
    </div>

    <div class="campo">
        <label for="apellidos">Apellidos</label>
        <input type="text" id="apellidos" name="apellidos" placeholder="Introduzca sus Apellidos" value="<?php echo s($usuario->apellidos) ?>">
    </div>

    <div class="campo">
        <label for="telefono">Teléfono</label>
        <input type="tel" id="telefono" name="telefono" placeholder="Introduzca su Teléfono" value="<?php echo s($usuario->telefono) ?>">
    </div>

    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Introduzca su Email" value="<?php echo s($usuario->email) ?>">
    </div>

    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Introduzca su Password">
    </div>

    <input type="submit" value="Crear Cuenta" class="boton">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/olvide">¿Has olvidado tu contraseña?</a>
</div>