<h1 class="nombrePagina">Actualizar Servicio</h1>
<p class="descripcionPag">Modifica el servicio</p>

<?php
// include_once __DIR__ . '/../templates/barra.php';
include_once __DIR__ . '/../templates/alertas.php';
?>

<form method="POST" class="formulario">

    <?php
    include_once __DIR__ . '/formulario.php';
    ?>

    <div class="paginacion">
        <input type="submit" class="boton" value="Actualizar Servicio">
        <a type="submit" href="/servicios" class="boton">Volver Atrás</a>
    </div>
</form>