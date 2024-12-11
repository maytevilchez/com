<?php 
// Incluir configuración de la base de datos y el modelo para mostrar proveedores
require_once __DIR__ . '/../../Config/Database.php';
require_once __DIR__ . '/../Models/P_Add_Proveedor.php';

// Crear una instancia del modelo para manejar proveedores
$proveedorModel = new Add_Proveedor($pdo);

// Obtener todos los proveedores desde la base de datos
$proveedores = $proveedorModel->obtenerTodo();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedores</title>
    <link rel="stylesheet" href="../../Assets/css/Style_Tabla_General.css">
</head>
<body>
    <div style="text-align: center; margin-top: 20px;">
        <h2>Proveedores</h2>
        <img src="../../Assets/img/Proveedores.png" alt="Proveedores" style="width: 200px; height: 200px;">
    </div>
    <?php if (empty($proveedores)): ?>
        <p>No hay proveedores registrados.</p>
    <?php else: ?>
        <table border="1" style="width: 80%; margin: 20px auto; border-collapse: collapse;">
            <tr>
                <th>ID</th>
                <th>Proveedor</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Email</th>
            </tr>
            <?php foreach ($proveedores as $proveedor): ?>
                <tr>
                    <td><?= htmlspecialchars($proveedor['id']) ?></td>
                    <td><?= htmlspecialchars($proveedor['proveedor']) ?></td>
                    <td><?= htmlspecialchars($proveedor['direccion']) ?></td>
                    <td><?= htmlspecialchars($proveedor['telefono']) ?></td>
                    <td><?= htmlspecialchars($proveedor['email']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>
