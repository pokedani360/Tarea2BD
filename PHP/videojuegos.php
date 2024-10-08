<?php
include('db_connection.php');

// Agregar nuevo videojuego
if (isset($_POST['add'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $clasificacion = $_POST['clasificacion'];
    $calificacion = $_POST['calificacion'];
    $unidades = $_POST['unidades'];
    $precio = $_POST['precio'];

    $add_query = "INSERT INTO Videojuegos (nombre, descripcion, clasificacion, calificacion, unidades_disponibles, precio) VALUES ('$nombre', '$descripcion', '$clasificacion', $calificacion, $unidades, $precio)";
    mysqli_query($conn, $add_query);
}

// Eliminar videojuego
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete_query = "DELETE FROM Videojuegos WHERE id_videojuego = $id";
    mysqli_query($conn, $delete_query);
}

// Mostrar todos los videojuegos
$videojuegos_query = "SELECT * FROM Videojuegos";
$videojuegos_result = mysqli_query($conn, $videojuegos_query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Videojuegos</title>
</head>
<body>
    <h1>Gestión de Videojuegos</h1>

    <h2>Añadir Videojuego</h2>
    <form method="POST" action="videojuegos.php">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="descripcion" placeholder="Descripción" required>
        <select name="clasificacion">
            <option value="RP">RP</option>
            <option value="E">E</option>
            <option value="E10+">E10+</option>
            <option value="T">T</option>
            <option value="M">M</option>
            <option value="A">A</option>
        </select>
        <input type="number" name="calificacion" placeholder="Calificación (1-5)" min="1" max="5" required>
        <input type="number" name="unidades" placeholder="Unidades disponibles" required>
        <input type="text" name="precio" placeholder="Precio" required>
        <button type="submit" name="add">Añadir</button>
    </form>

    <h2>Lista de Videojuegos</h2>
    <?php while ($row = mysqli_fetch_assoc($videojuegos_result)) { ?>
        <p><?php echo $row['nombre']; ?> - <?php echo $row['clasificacion']; ?> - <?php echo $row['unidades_disponibles']; ?> unidades</p>
        <a href="videojuegos.php?delete=<?php echo $row['id_videojuego']; ?>">Eliminar</a>
    <?php } ?>
</body>
</html>
