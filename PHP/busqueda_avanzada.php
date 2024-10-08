<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Búsqueda Avanzada</title>
    <script>
        function actualizarFormulario() {
            const tipoProducto = document.getElementById('tipo_producto').value;

            document.getElementById('filtros_videojuego').style.display = (tipoProducto === 'videojuego') ? 'block' : 'none';
            document.getElementById('filtros_consola').style.display = (tipoProducto === 'consola') ? 'block' : 'none';
            document.getElementById('filtros_generales').style.display = (tipoProducto === 'todos') ? 'block' : 'none';
        }
    </script>
</head>
<body>

<h1>Búsqueda Avanzada</h1>

<form action="resultados_busqueda.php" method="GET">

    <label for="tipo_producto">Seleccionar producto:</label>
    <select name="tipo_producto" id="tipo_producto" onchange="actualizarFormulario()" required>
        <option value="">Selecciona una opción</option>
        <option value="todos">Todos</option>
        <option value="videojuego">Videojuego</option>
        <option value="consola">Consola</option>
    </select><br><br>

    <div id="filtros_generales" style="display:none;">
        <label for="precio_min">Precio mínimo:</label>
        <input type="number" name="precio_min" id="precio_min" min="0"><br>

        <label for="precio_max">Precio máximo:</label>
        <input type="number" name="precio_max" id="precio_max" min="0"><br>
    </div>

    <div id="filtros_videojuego" style="display:none;">
        <label for="clasificacion">Clasificación:</label>
        <select name="clasificacion" id="clasificacion">
            <option value="">Cualquiera</option>
            <option value="RP">RP</option>
            <option value="E">E</option>
            <option value="E10+">E10+</option>
            <option value="T">T</option>
            <option value="M">M</option>
            <option value="A">A</option>
        </select><br>

        <label for="calificacion">Calificación mínima (del 1 al 5):</label>
        <input type="number" name="calificacion" id="calificacion" min="1" max="5" step="0.1"><br>
    </div>

    <div id="filtros_consola" style="display:none;">
        <label for="formato">Formato:</label>
        <select name="formato" id="formato">
            <option value="">Cualquiera</option>
            <option value="sobremesa">Sobremesa</option>
            <option value="portátil">Portátil</option>
        </select><br>

        <label for="num_controles">Número de controles:</label>
        <input type="number" name="num_controles" id="num_controles" min="1"><br>
    </div>

    <br>
    <input type="submit" value="Buscar">
</form>

</body>
</html>
