<h1 class="nombrePagina">Nuevo Servicio</h1>
<p class="descripcionPag">Crear un nuevo servicio</p>

<?php
// include_once __DIR__ . '/../templates/barra.php';
include_once __DIR__ . '/../templates/alertas.php';
?>

<form action="/servicios/crear" method="POST" class="formulario">

    <?php
    include_once __DIR__ . '/formulario.php';
    ?>

    <div class="paginacion">
        <input type="submit" class="boton" value="Guardar Servicio">
        <a type="submit" href="/admin" class="boton">Volver Atrás</a>
    </div>
</form>

