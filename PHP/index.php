<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USteaM - Tienda de Videojuegos y Consolas</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Bienvenido a USteaM</h1>
    </header>

    <nav>
        <ul>
            <li><a href="consolas.php">Consolas</a></li>
            <li><a href="videojuegos.php">Videojuegos</a></li>
            <li><a href="busqueda_avanzada.php">Búsqueda Avanzada</a></li>
            <li><a href="carrito.php">Carrito</a></li>
            <li><a href="ofertas.php">Ofertas</a></li>
            <li><a href="subir_imagen.php">Subir Imagen</a></li>
        </ul>
    </nav>

    <section>
        <h2>Productos más disponibles</h2>
        <?php
        include('db_connection.php');

        $sqlConsolas = "SELECT nombre, precio, unidades_disponibles FROM consolas ORDER BY unidades_disponibles DESC LIMIT 3";
        $sqlJuegos = "SELECT nombre, precio, unidades_disponibles FROM videojuegos ORDER BY unidades_disponibles DESC LIMIT 3";

        $resultadoConsolas = $conn->query($sqlConsolas);
        $resultadoJuegos = $conn->query($sqlJuegos);

        echo "<h3>Consolas</h3><ul>";
        if ($resultadoConsolas->num_rows > 0) {
            while ($fila = $resultadoConsolas->fetch_assoc()) {
                echo "<li>" . $fila['nombre'] . " - Precio: $" . $fila['precio'] . " - Unidades: " . $fila['unidades_disponibles'] . "</li>";
            }
        } else {
            echo "<li>No hay consolas disponibles</li>";
        }
        echo "</ul>";

        echo "<h3>Videojuegos</h3><ul>";
        if ($resultadoJuegos->num_rows > 0) {
            while ($fila = $resultadoJuegos->fetch_assoc()) {
                echo "<li>" . $fila['nombre'] . " - Precio: $" . $fila['precio'] . " - Unidades: " . $fila['unidades_disponibles'] . "</li>";
            }
        } else {
            echo "<li>No hay videojuegos disponibles</li>";
        }
        echo "</ul>";

        $conn->close();
        ?>
    </section>

    <footer>
        <p>&copy; 2024 USteaM - Tienda de Videojuegos y Consolas</p>
    </footer>
</body>
</html>
