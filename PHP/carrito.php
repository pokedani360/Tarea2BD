<?php
include('db_connection.php');

$error_message = '';

// Agregar producto al carrito
if (isset($_POST['add_to_cart'])) {
    $id_producto = $_POST['id_producto'];
    $tipo = $_POST['tipo'];
    $cantidad = $_POST['cantidad'];

    // Verificar las unidades disponibles según el tipo de producto
    if ($tipo == 'consola') {
        $unidades_query = "SELECT unidades_disponibles, precio FROM Consolas WHERE id_consola = $id_producto";
    } else {
        $unidades_query = "SELECT unidades_disponibles, precio FROM Videojuegos WHERE id_videojuego = $id_producto";
    }
    
    $unidades_result = mysqli_query($conn, $unidades_query);
    $producto = mysqli_fetch_assoc($unidades_result);

    // Verificar si hay suficientes unidades disponibles
    if ($producto && $producto['unidades_disponibles'] >= $cantidad) {
        $precio = $producto['precio'];
        $precio_total = $precio * $cantidad;

        // Insertar el producto en el carrito
        $query = "INSERT INTO Carrito (id_producto, tipo, cantidad, precio_total) VALUES ($id_producto, '$tipo', $cantidad, $precio_total)";
        mysqli_query($conn, $query);

        // Llamar al procedimiento almacenado para actualizar las unidades disponibles
        $call_proc = "CALL ActualizarUnidadesProducto($id_producto, '$tipo', $cantidad)";
        mysqli_query($conn, $call_proc);
    } else {
        // Si no hay suficientes unidades, mostrar un mensaje de error
        $error_message = 'No hay suficientes unidades disponibles para agregar al carrito.';
    }
}

// Mostrar carrito
$cart_query = "SELECT * FROM Carrito";
$cart_result = mysqli_query($conn, $cart_query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Carrito</title>
</head>
<body>
    <h1>Carrito de Compras</h1>

    <!-- Formulario para agregar productos al carrito -->
    <form method="POST">
        <input type="number" name="id_producto" placeholder="ID del Producto" required>
        <select name="tipo">
            <option value="consola">Consola</option>
            <option value="videojuego">Videojuego</option>
        </select>
        <input type="number" name="cantidad" placeholder="Cantidad" required>
        <button type="submit" name="add_to_cart">Añadir al carrito</button>
    </form>

    <!-- Mostrar mensaje de error si existe -->
    <?php if ($error_message) { ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php } ?>

    <h2>Productos en el Carrito</h2>
    <?php
    $total_carrito = 0; // Inicializar el total del carrito

    // Mostrar los productos en el carrito
    while ($row = mysqli_fetch_assoc($cart_result)) {
        // Obtener nombre del producto según su tipo
        if ($row['tipo'] == 'consola') {
            $product_query = "SELECT nombre FROM Consolas WHERE id_consola = " . $row['id_producto'];
        } else {
            $product_query = "SELECT nombre FROM Videojuegos WHERE id_videojuego = " . $row['id_producto'];
        }
        $product_result = mysqli_query($conn, $product_query);
        $product_name = mysqli_fetch_assoc($product_result)['nombre'];

        // Mostrar detalles del producto en el carrito
        echo "<p>Producto: $product_name - Tipo: " . ucfirst($row['tipo']) . " - Cantidad: " . $row['cantidad'] . " - Precio Total: $" . $row['precio_total'] . "</p>";

        // Sumar al total del carrito
        $total_carrito += $row['precio_total'];
    }
    ?>

    <!-- Mostrar el total a pagar -->
    <h3>Total del Carrito: $<?php echo $total_carrito; ?></h3>

    <!-- Botón para proceder al pago -->
    <form method="POST" action="pago.php">
        <button type="submit">Pagar</button>
    </form>
</body>
</html>
