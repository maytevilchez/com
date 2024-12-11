<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" type="image/png" href="../../Assets/img/Pecosol_logo.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pecosol - Modificar Cliente</title>
    <link rel="stylesheet" href="../../Assets/css/C_Style_Modificar_Cliente.css">
</head>
<body>
    <!-- Encabezado con título e imagen -->
    <div style="text-align: center; margin-top: 20px;">
        <h2>Modificar Cliente</h2>
        <img src="../../Assets/img/Modificar_Cliente.png" alt="Modificar Cliente" style="width: 150px; height: 150px;">
    </div>

    <!-- Formulario para buscar el cliente por ID -->
    <form method="GET" action="../Controllers/C_ControladorModificarCliente.php">
        <label for="cliente_id">ID del Cliente:</label>
        <input type="number" id="cliente_id" name="cliente_id" required>
        <button type="submit" name="accion" value="buscar">Buscar Cliente</button>
    </form>

    <?php if (isset($cliente) && !empty($cliente)): ?>
    <div style="text-align: center; margin-top: 20px;">
        <h3>Cliente Encontrado</h3>
        <form method="POST" action="../Controllers/C_ControladorModificarCliente.php">
            <input type="hidden" name="cliente_id" value="<?= htmlspecialchars($cliente['cliente_id']) ?>">

            <!-- Formulario de modificación de datos del cliente -->
            <div>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($cliente['nombre']) ?>" required>
            </div>
            <div>
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" value="<?= htmlspecialchars($cliente['direccion']) ?>" required>
            </div>
            <div>
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" value="<?= htmlspecialchars($cliente['telefono']) ?>" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($cliente['email']) ?>" required>
            </div>

            <!-- Botón para modificar -->
            <button type="submit" name="accion" value="modificar" style="margin-top: 20px;">Modificar Cliente</button>
        </form>
    </div>
    <?php elseif (isset($cliente)): ?>
        <p style="text-align: center; color: red;">Cliente no encontrado.</p>
    <?php endif; ?>

    <!-- Botón para regresar -->
    <div style="text-align: center; margin-top: 20px;">
        <button onclick="window.location.href='../Views/Panel_Navegacion_CLI.php'">Regresar al Panel de Navegación</button>
    </div>
</body>
</html>
