<?php
session_start();
require_once 'conexion.php';

// Verificar que exista sesión de usuario
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit();
}

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

$accion = $_POST['accion'] ?? $_GET['accion'] ?? '';

switch ($accion) {
    case 'agregar':
        $id = intval($_POST['id_producto']);
        $cantidad = max(1, intval($_POST['cantidad'] ?? 1));

        // Consultar datos reales del producto en la BD
        $stmt = $pdo->prepare("SELECT id, nombre, precio, stock FROM productos WHERE id = ?");
        $stmt->execute([$id]);
        $producto = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($producto) {
            if (isset($_SESSION['carrito'][$id])) {
                // Si ya existe en el carrito, sumar la cantidad sin exceder stock
                $nuevaCantidad = $_SESSION['carrito'][$id]['cantidad'] + $cantidad;
                $_SESSION['carrito'][$id]['cantidad'] = min($nuevaCantidad, $producto['stock']);
            } else {
                // Añadir nuevo producto a la sesión
                $_SESSION['carrito'][$id] = [
                    'id'       => $producto['id'],
                    'nombre'   => $producto['nombre'],
                    'precio'   => floatval($producto['precio']),
                    'cantidad' => min($cantidad, $producto['stock']),
                    'stock'    => $producto['stock']
                ];
            }
            $_SESSION['mensaje'] = "Producto añadido al carrito.";
        }
        break;

    case 'modificar':
        $id = intval($_POST['id_producto']);
        $nuevaCantidad = intval($_POST['cantidad']);

        if (isset($_SESSION['carrito'][$id])) {
            if ($nuevaCantidad <= 0) {
                unset($_SESSION['carrito'][$id]);
                $_SESSION['mensaje'] = "Producto eliminado del carrito.";
            } else {
                $stockMax = $_SESSION['carrito'][$id]['stock'];
                $_SESSION['carrito'][$id]['cantidad'] = min($nuevaCantidad, $stockMax);
                $_SESSION['mensaje'] = "Cantidad actualizada correctamente.";
            }
        }
        break;

    case 'eliminar':
        $id = intval($_GET['id']);
        if (isset($_SESSION['carrito'][$id])) {
            unset($_SESSION['carrito'][$id]);
            $_SESSION['mensaje'] = "Producto retirado del carrito.";
        }
        break;

    case 'vaciar':
        $_SESSION['carrito'] = [];
        $_SESSION['mensaje'] = "Se han eliminado todos los productos del carrito.";
        break;
}

header('Location: index.php');
exit();