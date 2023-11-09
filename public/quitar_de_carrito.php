<?php

use App\Tablas\Articulo;

session_start();

require '../vendor/autoload.php';

try {
    $id = obtener_get('id');

    if ($id === null) {
        return volver();
    }
    $pdo = conectar();
$articulo_id = $_GET['id'];
$sent = $pdo->prepare("SELECT stock FROM articulos WHERE id = :id");
$sent->execute([':id' => $id]);   
$articulo = $sent->fetch(PDO::FETCH_ASSOC);
$stock_actual = $articulo['stock'];
$cantidad_a_sumar = 1; // Esto es un ejemplo, deberías obtener la cantidad de alguna manera

if ($stock_actual >= $cantidad_a_sumar) {
$nuevo_stock = $stock_actual + $cantidad_a_sumar;

$sent = $pdo->prepare("UPDATE articulos SET stock = :nuevo_stock WHERE id = :id");
$sent->bindParam(':nuevo_stock', $nuevo_stock, PDO::PARAM_INT);
$sent->bindParam(':id', $articulo_id, PDO::PARAM_INT);
$sent->execute();
} else {
// Manejar el caso en el que no hay suficiente stock
}

    $carrito = unserialize(carrito());
    $carrito->eliminar($id);
    $_SESSION['carrito'] = serialize($carrito);
} catch (ValueError $e) {
    // TODO: mostrar mensaje de error en un Alert
}




volver();
