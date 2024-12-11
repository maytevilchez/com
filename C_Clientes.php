<?php
require_once __DIR__ . '/../../Config/Database.php';
require_once __DIR__ . '/../Models/C_Add_Cliente.php';

$clienteModel = new C_Add_Cliente($pdo);
$clientes = $clienteModel->obtenerTodo();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link rel="stylesheet" href="../../Assets/css/Style_Tabla_General.css">
</head>
<body>
    <div style="text-align: center; margin-top: 20px;">
        <h2>Clientes</h2>
        <img src="../../Assets/img/Clientes.png" alt="Clientes" style="width: 200px; height: 200px;">
    </div>
    <?php if (empty($clientes)): ?>
        <p>No hay clientes registrados.</p>
    <?php else: ?>
        <table border="1" style="width: 80%; margin: 20px auto; border-collapse: collapse;">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Email</th>
            </tr>
            <?php foreach ($clientes as $cliente): ?>
                <tr>
                    <td><?= htmlspecialchars($cliente['cliente_id']) ?></td>
                    <td><?= htmlspecialchars($cliente['nombre']) ?></td>
                    <td><?= htmlspecialchars($cliente['direccion']) ?></td>
                    <td><?= htmlspecialchars($cliente['telefono']) ?></td>
                    <td><?= htmlspecialchars($cliente['email']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>
