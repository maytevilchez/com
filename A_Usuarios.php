<?php
require_once __DIR__ . '/../../Config/Database.php';
require_once __DIR__ . '/../Models/A_Add_Usuario.php';

$usuarioModel = new A_Add_Usuario($pdo);
$usuarios = $usuarioModel->obtenerUsuarios();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="../../Assets/css/Style_Tabla_General.css">
</head>
<body>
    <div style="text-align: center; margin-top: 20px;">
        <h2>Lista Usuarios</h2>
        <img src="../../Assets/img/Usuarios.png" alt="Usuarios" style="width: 200px; height: 200px;">
    </div>
    <?php if (empty($usuarios)): ?>
        <p>No hay usuarios registrados.</p>
    <?php else: ?>
        <table border="1" style="width: 80%; margin: 50px auto; border-collapse: collapse; margin-left: 80px;">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Rol</th>
            </tr>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= htmlspecialchars($usuario['id']) ?></td>
                    <td><?= htmlspecialchars($usuario['username']) ?></td>
                    <td><?= htmlspecialchars($usuario['role']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>
