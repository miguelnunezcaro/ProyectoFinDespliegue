<h1 class="nombrePagina">Crear Nueva Sesión</h1>
<p class="descripcionPag">Elige tus servicios y rellene sus datos</p>

<?php
include_once __DIR__ . '/../templates/logout.php';
?>

<div class="app">

    <nav class="tabs">
        <button class="actual" type="button" data-paso='1'>Servicios</button>
        <button type="button" data-paso='2'>Información Sesión</button>
        <button type="button" data-paso='3'>Resumen</button>
    </nav>

    <div id="paso1" class="seccion">
        <h2 class="title">Servicios</h2>
        <p class="text-center">Elige tus servicios a continuación:</p>
        <div id="servicios" class="listadoServicios"></div>
    </div>
    <div id="paso2" class="seccion">
        <h2 class="title">Tus datos y Sesión</h2>
        <p class="text-center">Rellene sus datos y fecha de su sesión</p>

        <form class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" placeholder="Introduzca su Nombre" value="<?php echo $nombre; ?>" disabled>
            </div>
            <div class="campo">
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" name="fecha" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
            </div>
            <div class="campo">
                <label for="hora">Hora</label>
                <!-- 
                <input type="time" id="hora" name="hora" min="08:00" max="21:00" step='3600'>
                -->
                <select name="hora" id="hora">
                    <option value="">Selecciona una hora</option>
                    <option value="08:00">8:00</option>
                    <option value="09:00">9:00</option>
                    <option value="10:00">10:00</option>
                    <option value="11:00">11:00</option>
                    <option value="12:00">12:00</option>
                    <option value="13:00">13:00</option>
                    <option value="14:00">14:00</option>
                    <option value="15:00">15:00</option>
                    <option value="16:00">16:00</option>
                    <option value="17:00">17:00</option>
                    <option value="18:00">18:00</option>
                    <option value="19:00">19:00</option>
                    <option value="20:00">20:00</option>
                    <option value="21:00">21:00</option>
                </select>
            </div>
            <input type="hidden" id="id" value="<?php echo $id; ?>">
        </form>
    </div>
    <div id="paso3" class="seccion contenido-resumen">
        <h2 class="title">Resumen</h2>
        <p class="text-center">Verifica que la información sea correcta</p>
    </div>

    <div class="paginacion">
        <button id="anterior" class="boton">&laquo; Anterior</button>
        <button id="siguiente" class="boton">Siguiente &raquo;</button>
    </div>
</div>


<?php
    $script = "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script src='build/js/app.js'></script>
    "
?>