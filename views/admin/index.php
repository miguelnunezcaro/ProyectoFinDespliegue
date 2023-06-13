<h1 class="nombrePagina">Panel de Admin</h1>

<?php
include_once __DIR__ . '/../templates/barra.php';
?>
<h2 class="nombrePagina">Buscar Citas</h2>
<div class="busqueda">
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo $fecha; ?>">
        </div>

    </form>
</div>

<?php 
    if (count($sesiones) === 0) {
        echo "<h3 class='nombrePagina'>No hay citas en esta fecha</h3>";
    }
?>

<div id="citas-admin">
    <ul class="sesiones">
    <?php

        $idCita = 0;

        foreach($sesiones as $key => $sesion) {

            if ($idCita !== $sesion->id) {
                $total = 0;

                
    ?>

    <li>
        <p>Código de la sesión: <span><?php echo $sesion->id ?></span></p>
        <p>Hora: <span><?php echo $sesion->hora ?></span></p>
        <p>Cliente: <span><?php echo $sesion->cliente ?></span></p>
        <p>Email: <span><?php echo $sesion->email ?></span></p>
        <p>Teléfono: <span><?php echo $sesion->telefono ?></span></p>

        <h3 class="nombreServicio">Servicios:</h3>

        <?php $idCita = $sesion->id; 
        } $total += $sesion->precio ?>

        <p class="servicio"><?php echo $sesion->servicio . " " . $sesion->precio . "€"; ?></p>

        <?php 
            $actual = $sesion->id;
            $proximo = $sesiones[$key + 1]->id;

            if (esUltimo($actual, $proximo)) { ?>
                
                <p class="total">Precio total: <span><?php echo $total . "€" ?></span></p>

                <form action="/api/eliminar" method="POST">
                    <input type="hidden" name="id" value="<?php echo $sesion->id; ?>">
                    <input type="submit" class="boton-eliminar" value="Eliminar">
                </form>

            <?php

            }
        ?>
    <?php } ?>
    </ul>
</div>


<?php
    $script = "
    <script src='build/js/buscador.js'></script>
    "
?>