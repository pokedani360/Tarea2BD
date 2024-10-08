<?php
include('db_connection.php');

// Agregar nueva consola
if (isset($_POST['add'])) {
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $formato = $_POST['formato'];
    $controles = $_POST['controles'];
    $unidades = $_POST['unidades'];
    $precio = $_POST['precio'];

    $add_query = "INSERT INTO Consolas (nombre, marca, formato, num_controles, unidades_disponibles, precio) VALUES ('$nombre', '$marca', '$formato', $controles, $unidades, $precio)";
    mysqli_query($conn, $add_query);
}

// Eliminar consola
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete_query = "DELETE FROM Consolas WHERE id_consola = $id";
    mysqli_query($conn, $delete_query);
}

// Mostrar todas las consolas
$consolas_query = "SELECT * FROM Consolas";
$consolas_result = mysqli_query($conn, $consolas_query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Consolas</title>
</head>
<body>
    <h1>Gestión de Consolas</h1>

    <h2>Añadir Consola</h2>
    <form method="POST" action="consolas.php">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="marca" placeholder="Marca" required>
        
        <!-- Selección de formato (sobremesa o portátil) -->
        <label for="formato">Formato:</label>
        <select name="formato" required>
            <option value="sobremesa">Sobremesa</option>
            <option value="portátil">Portátil</option>
        </select>
        
        <input type="number" name="controles" placeholder="Controles incluidos" required>
        <input type="number" name="unidades" placeholder="Unidades disponibles" required>
        <input type="text" name="precio" placeholder="Precio" required>
        <button type="submit" name="add">Añadir</button>
    </form>

    <h2>Lista de Consolas</h2>
    <?php while ($row = mysqli_fetch_assoc($consolas_result)) { ?>
        <p>
            <?php echo $row['nombre']; ?> - 
            <?php echo $row['marca']; ?> - 
            <?php echo ucfirst($row['formato']); ?> - 
            <?php echo $row['unidades_disponibles']; ?> unidades
        </p>
        <a href="consolas.php?delete=<?php echo $row['id_consola']; ?>">Eliminar</a>
    <?php } ?>
</body>
</html>
