<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte PDF de Usuarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .header {
            text-align: left;
            padding: 20px;
            background-color: #3972b3;
            color: white;
        }
        .header img {
            height: 60px;
        }
        .header h1 {
            margin: 10px 0;
            font-size: 26px;
            font-weight: bold;
        }
        .content h2 {
            text-align: center;
            color: #3972b3;
            font-size: 20px;
            margin-bottom: 20px;
        }
        table {
            width: 95%;
            border-collapse: collapse;
            margin: 0 auto;
            background-color: #f9f9f9;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        table th {
            background-color: #3972b3;
            color: white;
            font-size: 12px;
            text-transform: uppercase;
        }
        table tr:nth-child(odd) {
            background-color: #f4f6f9;
        }
        table tr:hover {
            background-color: #e3f2fd;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #666;
            margin-top: 20px;
            padding: 10px;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <!-- Encabezado con logo e información de la empresa -->
    <div class="header">
        <?php
        $rutaLogo = 'C:/xampp/htdocs/Proyectos/Sistema_De_Inventario_Pecosol/Assets/img/Pecosol_logo.jpg';
        $logoBase64 = base64_encode(file_get_contents($rutaLogo));
        ?>
        <img src="data:image/jpeg;base64,<?= $logoBase64 ?>" alt="Logo de Pecosol">
        <h1>Pecosol SAC</h1>
        <p>Reporte de Usuarios</p>
    </div>

    <!-- Contenido principal -->
    <div class="content">
        <h2>Listado de Usuarios</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <?php $contador = 1; ?>
                <?php if (!empty($usuarios)): ?>
                    <?php foreach ($usuarios as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['id']) ?></td>
                            <td><?= htmlspecialchars($user['username']) ?></td>
                            <td><?= htmlspecialchars($user['role']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" style="text-align:center;">No hay datos para mostrar</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pie de página -->
    <div class="footer">
        <p>Reporte generado automáticamente el <?= date("d-m-Y H:i:s") ?></p>
        <p>Pecosol SAC - Todos los derechos reservados</p>
    </div>
</body>
</html>
