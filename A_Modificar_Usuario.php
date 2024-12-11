<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" type="image/png" href="../../Assets/img/Pecosol_logo.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pecosol - Modificar Usuario</title>
    <link rel="stylesheet" href="../../Assets/css/C_Style_Modificar_Cliente.css">
</head>
<body>
    <div style="text-align: center; margin-top: 20px;">
        <h2>Modificar Usuario</h2>
        <img src="../../Assets/img/Modificar_Usuario.png" alt="Modificar Usuario" style="width: 150px; height: 150px;">
    </div>

    <form method="GET" action="../Controllers/A_ControladorModificarUsuario.php">
        <label for="id">ID del Usuario:</label>
        <input type="number" id="id" name="id" required>
        <button type="submit" name="accion" value="buscar">Buscar Usuario</button>
    </form>

    <?php if (isset($usuario) && !empty($usuario)): ?>
    <div style="text-align: center; margin-top: 20px;">
        <h3>Usuario Encontrado</h3>
        <form method="POST" action="../Controllers/A_ControladorModificarUsuario.php">
            <input type="hidden" name="id" value="<?= htmlspecialchars($usuario['id']) ?>">

            <div>
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" value="<?= htmlspecialchars($usuario['username']) ?>" required>
            </div>
            <div>
                <label for="role">Rol:</label>
                <select id="role" name="role" required>
                    <option value="admin" <?= $usuario['role'] === 'admin' ? 'selected' : '' ?>>Administrador</option>
                    <option value="tecnico" <?= $usuario['role'] === 'tecnico' ? 'selected' : '' ?>>Técnico</option>
                    <option value="vendedor" <?= $usuario['role'] === 'vendedor' ? 'selected' : '' ?>>Vendedor</option>
                </select>
            </div>
            <div>
                <label for="password">Nueva Contraseña (opcional):</label>
                <input type="password" id="password" name="password">
            </div>

            <button type="submit" name="accion" value="modificar" style="margin-top: 20px;">Modificar Usuario</button>
        </form>
    </div>
    <?php elseif (isset($usuario)): ?>
        <p style="text-align: center; color: red;">Usuario no encontrado.</p>
    <?php endif; ?>

    <div style="text-align: center; margin-top: 20px;">
        <button onclick="window.location.href='../Views/Panel_Navegacion_ADM.php'">Regresar al Panel de Navegación</button>
    </div>
</body>
</html>
