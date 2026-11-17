<?php
$host = getenv('DB_HOST') ?: iitmlq.h.filess.io;
$port = getenv('DB_PORT') ?: 3307;
$db   = getenv('DB_NAME') ?: tienda_sesiones_prizeraise;
$user = getenv('DB_USER') ?: tienda_sesiones_prizeraise;
$pass = getenv('DB_PASS') ?: 091206;

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>
