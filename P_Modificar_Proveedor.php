<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" type="image/png" href="../../Assets/img/Pecosol_logo.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pecosol - Modificar Proveedor</title>
    <link rel="stylesheet" href="../../Assets/css/P_Style_Modificar_Proveedor.css">
</head>
<body>
    <div style="text-align: center; margin-top: 20px;">
        <h2>Modificar Proveedor</h2>
        <img src="../../Assets/img/Modificar_Proveedor.png" alt="Modificar Proveedor" style="width: 150px; height: 150px;">
    </div>

    <!-- Formulario para buscar proveedor por ID -->
    <form method="GET" action="../Controllers/P_ControladorModificarProveedor.php">
        <label for="id">ID del Proveedor:</label>
        <input type="number" id="id" name="id" required>
        <button type="submit" name="accion" value="buscar">Buscar Proveedor</button>
    </form>

    <?php if (isset($proveedor) && !empty($proveedor)): ?>
    <div style="text-align: center; margin-top: 20px;">
        <h3>Proveedor Encontrado</h3>
        <form method="POST" action="../Controllers/P_ControladorModificarProveedor.php">
            <!-- ID oculto para identificar el registro -->
            <input type="hidden" name="id" value="<?= htmlspecialchars($proveedor['id']) ?>">

            <!-- Campos editables -->
            <div>
                <label for="proveedor">Proveedor:</label>
                <input type="text" id="proveedor" name="proveedor" value="<?= htmlspecialchars($proveedor['proveedor']) ?>" required>
            </div>
            <div>
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" value="<?= htmlspecialchars($proveedor['direccion']) ?>" required>
            </div>
            <div>
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" value="<?= htmlspecialchars($proveedor['telefono']) ?>" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($proveedor['email']) ?>" required>
            </div>

            <button type="submit" name="accion" value="modificar" style="margin-top: 20px;">Modificar Proveedor</button>
        </form>
    </div>
    <?php elseif (isset($proveedor)): ?>
        <p style="text-align: center; color: red;">Proveedor no encontrado.</p>
    <?php endif; ?>

    <div style="text-align: center; margin-top: 20px;">
        <button onclick="window.location.href='../Views/Panel_Navegacion_PRO.php'">Regresar al Panel de Navegación</button>
    </div>
</body>
</html>
