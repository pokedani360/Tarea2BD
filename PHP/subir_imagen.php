<?php
// Conexión a la base de datos
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar si el archivo fue cargado
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $tipo_producto = $_POST['tipo_producto']; // 'consola' o 'videojuego'
        $id_producto = $_POST['id_producto']; // ID de la consola o videojuego

        // Directorio donde se guardarán las imágenes
        $directorio_subida = 'imagenes/';
        $archivo_subido = $directorio_subida . basename($_FILES['imagen']['name']);

        // Mover el archivo cargado al directorio de imágenes
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $archivo_subido)) {
            // Preparar la consulta SQL para actualizar la ruta de la imagen en la base de datos
            if ($tipo_producto == 'consola') {
                $sql = "UPDATE Consolas SET imagen = ? WHERE id_consola = ?";
            } elseif ($tipo_producto == 'videojuego') {
                $sql = "UPDATE Videojuegos SET imagen = ? WHERE id_videojuego = ?";
            } else {
                echo "Tipo de producto inválido.";
                exit;
            }

            // Ejecutar la consulta
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $archivo_subido, $id_producto);

            if ($stmt->execute()) {
                echo "Imagen subida y ruta guardada correctamente.";
            } else {
                echo "Error al guardar la ruta de la imagen en la base de datos.";
            }

            $stmt->close();
        } else {
            echo "Error al mover el archivo a la carpeta de destino.";
        }
    } else {
        echo "Error al subir la imagen.";
    }
}

$conn->close();
?>

<!-- Formulario para subir la imagen -->
<form action="subir_imagen.php" method="post" enctype="multipart/form-data">
    <label for="tipo_producto">Tipo de producto:</label>
    <select name="tipo_producto" id="tipo_producto">
        <option value="consola">Consola</option>
        <option value="videojuego">Videojuego</option>
    </select><br>

    <label for="id_producto">ID del producto (Consola o Videojuego):</label>
    <input type="text" name="id_producto" id="id_producto" required><br>

    <label for="imagen">Subir imagen:</label>
    <input type="file" name="imagen" id="imagen" required><br>

    <input type="submit" value="Subir Imagen">
</form>
