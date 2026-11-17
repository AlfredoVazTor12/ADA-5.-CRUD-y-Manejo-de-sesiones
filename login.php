<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty(trim($_POST['nombre_usuario']))) {
    $_SESSION['usuario'] = htmlspecialchars(trim($_POST['nombre_usuario']));
    
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }
}

header('Location: index.php');
exit();
