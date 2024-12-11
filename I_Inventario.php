<?php
require_once __DIR__ . '/../../Config/Database.php';
require_once __DIR__ . '/../Models/I_Add_Producto.php';

// Crear una instancia del modelo
$productoModel = new Add_Producto($pdo);

// Obtener todos los productos del inventario
$productos = $productoModel->obtenerTodo();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
    <link rel="stylesheet" href="../../Assets/css/Style_Tabla_General.css">
</head>
<body>
    <div style="text-align: center; margin-top: 20px;">
        <h2>Inventario</h2>
        <img src="../../Assets/img/Inventario_Producto.png" alt="Inventario" style="width: 200px; height: 200px;">
    </div>
    <?php if (empty($productos)): ?>
        <p>No hay productos en el inventario.</p>
    <?php else: ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Número de Serie</th>
                <th>Nombre del Equipo</th>
                <th>Marca</th>
                <th>Tipo</th>
                <th>Stock</th>
                <th>Fecha de Ingreso</th>
                <th>Proveedor</th>
            </tr>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?= htmlspecialchars($producto['id']) ?></td>
                    <td><?= htmlspecialchars($producto['numero_serie']) ?></td>
                    <td><?= htmlspecialchars($producto['nombre_equipo']) ?></td>
                    <td><?= htmlspecialchars($producto['marca']) ?></td>
                    <td><?= htmlspecialchars($producto['tipo']) ?></td>
                    <td><?= htmlspecialchars($producto['stock']) ?></td>
                    <td><?= htmlspecialchars($producto['fecha_ingreso']) ?></td>
                    <td><?= htmlspecialchars($producto['proveedor']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>
