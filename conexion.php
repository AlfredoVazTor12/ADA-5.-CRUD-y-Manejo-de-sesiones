<?php
$host = 'localhost';
$db   = 'tienda_sesiones';
$user = 'root'; // Cambiar si tu usuario de MySQL es distinto
$pass = '';     // Cambiar si tienes contraseña en MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>