<?php
include('db_connection.php');

// Variables para los filtros
$tipo_producto = $_GET['tipo_producto'];
$precio_min = isset($_GET['precio_min']) ? (int)$_GET['precio_min'] : 0;
$precio_max = isset($_GET['precio_max']) ? (int)$_GET['precio_max'] : PHP_INT_MAX;

// Construir la consulta SQL según los filtros
$sql = "";

if ($tipo_producto == "todos") {
    $sql = "SELECT id_consola AS id_producto, nombre, precio FROM Consolas WHERE precio BETWEEN $precio_min AND $precio_max
            UNION 
            SELECT id_videojuego AS id_producto, nombre, precio FROM Videojuegos WHERE precio BETWEEN $precio_min AND $precio_max";
} elseif ($tipo_producto == "videojuego") {
    $clasificacion = $_GET['clasificacion'];
    $calificacion = isset($_GET['calificacion']) ? (float)$_GET['calificacion'] : 0;
    $sql = "SELECT id_videojuego AS id_producto, nombre, precio FROM Videojuegos WHERE precio BETWEEN $precio_min AND $precio_max AND calificacion >= $calificacion";
    if (!empty($clasificacion)) {
        $sql .= " AND clasificacion = '$clasificacion'";
    }
} elseif ($tipo_producto == "consola") {
    $formato = $_GET['formato'];
    $num_controles = isset($_GET['num_controles']) ? (int)$_GET['num_controles'] : 0;
    $sql = "SELECT id_consola AS id_producto, nombre, precio FROM Consolas WHERE precio BETWEEN $precio_min AND $precio_max";
    if (!empty($formato)) {
        $sql .= " AND formato = '$formato'";
    }
    if ($num_controles > 0) {
        $sql .= " AND num_controles = $num_controles";
    }
}

// Ejecutar la consulta
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Resultados de la búsqueda:</h2>";
    while ($row = $result->fetch_assoc()) {
        echo "Producto: " . $row["nombre"] . " - Precio: $" . $row["precio"] . "<br>";
    }
} else {
    echo "No se encontraron resultados.";
}

$conn->close();
?>
