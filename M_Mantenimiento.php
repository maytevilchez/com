<?php 
// Incluir configuración de la base de datos y el modelo
require_once __DIR__ . '/../../Config/Database.php';
require_once __DIR__ . '/../Models/M_Add_Mantenimiento.php';

// Crear una instancia del modelo para manejar mantenimientos
$mantenimientoModel = new M_Add_Mantenimiento($pdo);

// Obtener todos los mantenimientos desde la base de datos
$mantenimientos = $mantenimientoModel->obtenerTodo();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenimientos</title>
    <link rel="stylesheet" href="../../Assets/css/M_Style_Mantenimiento.css">
</head>
<body>
    <div style="text-align: center; margin-top: 20px;">
        <h2>Lista de Mantenimientos</h2>
        <img src="../../Assets/img/Mantenimiento.png" alt="Mantenimiento" style="width: 200px; height: 200px; margin-right: 50px;">
    </div>
    <?php if (empty($mantenimientos)): ?>
        <p>No hay mantenimientos registrados.</p>
    <?php else: ?>
        <table border="1" style="width: 80%; margin: 150px auto; border-collapse: collapse;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Técnico</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Tipo</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($mantenimientos as $mantenimiento): ?>
                    <tr>
                        <td><?= htmlspecialchars($mantenimiento['mantenimiento_id']) ?></td>
                        <td><?= htmlspecialchars($mantenimiento['nombre_producto']) ?></td>
                        <td><?= htmlspecialchars($mantenimiento['nombre_tecnico']) ?></td>
                        <td><?= htmlspecialchars($mantenimiento['nombre_cliente']) ?></td>
                        <td><?= htmlspecialchars($mantenimiento['fecha_mantenimiento']) ?></td>
                        <td><?= htmlspecialchars($mantenimiento['tipo_mantenimiento']) ?></td>
                        <td><?= htmlspecialchars($mantenimiento['descripcion']) ?></td>
                        <td><?= htmlspecialchars($mantenimiento['estado_equipo']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
