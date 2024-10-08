<?php
include('db_connection.php');

$id_carrito = $_POST['id_carrito'];

// Finalizar compra para el carrito seleccionado
$detalle_query = "SELECT * FROM detalle_carro WHERE id_carrito = $id_carrito";
$detalle_result = mysqli_query($conn, $detalle_query);

while ($row = mysqli_fetch_assoc($detalle_result)) {
    $id_producto = $row['id_producto'];
    $tipo = $row['tipo'];
    $cantidad = $row['cantidad'];

    if ($tipo == 'consola') {
        $update_query = "UPDATE Consolas SET unidades_disponibles = unidades_disponibles - $cantidad WHERE id_consola = $id_producto";
    } else {
        $update_query = "UPDATE Videojuegos SET unidades_disponibles = unidades_disponibles - $cantidad WHERE id_videojuego = $id_producto";
    }

    mysqli_query($conn, $update_query);
}

// Limpiar el detalle del carrito
$clear_cart = "DELETE FROM detalle_carro WHERE id_carrito = $id_carrito";
mysqli_query($conn, $clear_cart);

echo "Compra realizada con éxito.";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pago</title>
</head>
<body>
    <h1>Gracias por su compra</h1>
</body>
</html>
