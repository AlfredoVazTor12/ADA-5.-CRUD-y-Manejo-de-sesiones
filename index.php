<?php
session_start();
require_once 'conexion.php';

$stmt = $pdo->query("SELECT * FROM productos ORDER BY id ASC");
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$usuarioActivo = $_SESSION['usuario'] ?? null;
$carrito = $_SESSION['carrito'] ?? [];
$mensaje = $_SESSION['mensaje'] ?? '';
unset($_SESSION['mensaje']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online - Carrito con Sesiones PHP</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<header class="navbar">
    <div class="container nav-content">
        <h1>TechStore PHP</h1>
        <div class="user-info">
            <?php if ($usuarioActivo): ?>
                <span>Bienvenido, <strong><?= htmlspecialchars($usuarioActivo) ?></strong></span>
                <a href="logout.php" class="btn btn-danger btn-sm">Cerrar Sesión</a>
            <?php else: ?>
                <span>Invitado (Inicia sesión para comprar)</span>
            <?php endif; ?>
        </div>
    </div>
</header>

<main class="container">

    <?php if ($mensaje): ?>
        <div class="alerta" id="alerta-mensaje"><?= htmlspecialchars($mensaje) ?></div>
    <?php endif; ?>

    <?php if (!$usuarioActivo): ?>
        <section class="card login-box">
            <h2>Identifícate para comenzar</h2>
            <p>Ingresa tu nombre para iniciar una sesión en el servidor y habilitar tu carrito de compras.</p>
            <form action="login.php" method="POST" onsubmit="return validarLogin()">
                <input type="text" id="nombre_usuario" name="nombre_usuario" placeholder="Escribe tu nombre completo..." required>
                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
            </form>
        </section>
    <?php else: ?>

        <section class="seccion">
            <h2>Catálogo de Productos</h2>
            <div class="grid-productos">
                <?php foreach ($productos as $prod): ?>
                    <article class="card producto-card">
                        <h3><?= htmlspecialchars($prod['nombre']) ?></h3>
                        <p class="desc"><?= htmlspecialchars($prod['descripcion']) ?></p>
                        <p class="precio">$<?= number_format($prod['precio'], 2) ?></p>
                        <p class="stock">Disponibles: <?= $prod['stock'] ?></p>

                        <form action="carrito_acciones.php" method="POST" class="form-agregar">
                            <input type="hidden" name="accion" value="agregar">
                            <input type="hidden" name="id_producto" value="<?= $prod['id'] ?>">
                            <input type="number" name="cantidad" value="1" min="1" max="<?= $prod['stock'] ?>" required>
                            <button type="submit" class="btn btn-primary">Añadir al carrito</button>
                        </form>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="seccion card">
            <div class="carrito-header">
                <h2>Carrito de Compras de <?= htmlspecialchars($usuarioActivo) ?></h2>
                <?php if (!empty($carrito)): ?>
                    <a href="carrito_acciones.php?accion=vaciar" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Seguro que deseas vaciar el carrito?')">Vaciar Carrito</a>
                <?php endif; ?>
            </div>

            <?php if (empty($carrito)): ?>
                <p class="vacio">Tu carrito está vacío. Añade productos del catálogo superior.</p>
            <?php else: ?>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Precio Unitario</th>
                                <th>Cantidad (Modificar)</th>
                                <th>Subtotal</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $totalGeneral = 0;
                            foreach ($carrito as $item): 
                                $subtotal = $item['precio'] * $item['cantidad'];
                                $totalGeneral += $subtotal;
                            ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($item['nombre']) ?></strong></td>
                                    <td>$<?= number_format($item['precio'], 2) ?></td>
                                    <td>
                                        <form action="carrito_acciones.php" method="POST" class="form-modificar">
                                            <input type="hidden" name="accion" value="modificar">
                                            <input type="hidden" name="id_producto" value="<?= $item['id'] ?>">
                                            <input type="number" name="cantidad" value="<?= $item['cantidad'] ?>" min="1" max="<?= $item['stock'] ?>" required>
                                            <button type="submit" class="btn btn-secondary btn-sm">Actualizar</button>
                                        </form>
                                    </td>
                                    <td>$<?= number_format($subtotal, 2) ?></td>
                                    <td>
                                        <a href="carrito_acciones.php?accion=eliminar&id=<?= $item['id'] ?>" 
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('¿Retirar este producto del carrito?')">Eliminar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-right"><strong>Total a Pagar:</strong></td>
                                <td colspan="2" class="total-final">$<?= number_format($totalGeneral, 2) ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <?php endif; ?>
        </section>

    <?php endif; ?>

</main>

<script src="script.js"></script>
</body>
</html>
