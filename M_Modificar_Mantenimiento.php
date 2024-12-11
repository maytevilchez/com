<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" type="image/png" href="../../Assets/img/Pecosol_logo.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pecosol - Modificar Mantenimiento</title>
    <link rel="stylesheet" href="../../Assets/css/M_Style_Modificar_Mantenimiento.css">
</head>
<body>
    <!-- Encabezado con título e imagen -->
    <div style="text-align: center; margin-top: 20px;">
        <h2>Modificar Mantenimiento</h2>
        <img src="../../Assets/img/Modificar_Mantenimiento.png" alt="Modificar Mantenimiento" style="width: 150px; height: 150px;">
    </div>

    <!-- Formulario para buscar el mantenimiento -->
    <form method="GET" action="../Controllers/M_ControladorModificarMantenimiento.php">
        <label for="mantenimiento_id">ID del Mantenimiento:</label>
        <input type="number" id="mantenimiento_id" name="mantenimiento_id" required>
        <button type="submit" name="accion" value="buscar">Buscar Mantenimiento</button>
    </form>

    <?php if (isset($mantenimiento) && !empty($mantenimiento)): ?>
        <div style="text-align: center; margin-top: 20px;">
            <h3>Mantenimiento Encontrado</h3>
            <form method="POST" action="../Controllers/M_ControladorModificarMantenimiento.php">
                <input type="hidden" name="mantenimiento_id" value="<?= htmlspecialchars($mantenimiento['mantenimiento_id']) ?>">

                <!-- Primera Hoja -->
                <div style="display: inline-block; width: 45%; vertical-align: top; margin-right: 10%;">
                    <label for="fecha_mantenimiento">Fecha de Mantenimiento:</label>
                    <input type="date" id="fecha_mantenimiento" name="fecha_mantenimiento" value="<?= htmlspecialchars($mantenimiento['fecha_mantenimiento']) ?>" required>

                    <label for="tipo_mantenimiento">Tipo de Mantenimiento:</label>
                    <select id="tipo_mantenimiento" name="tipo_mantenimiento" required>
                        <option value="Preventivo" <?= $mantenimiento['tipo_mantenimiento'] === 'Preventivo' ? 'selected' : '' ?>>Preventivo</option>
                        <option value="Correctivo" <?= $mantenimiento['tipo_mantenimiento'] === 'Correctivo' ? 'selected' : '' ?>>Correctivo</option>
                    </select>

                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" required><?= htmlspecialchars($mantenimiento['descripcion']) ?></textarea>
                </div>

                <!-- Segunda Hoja -->
                <div style="display: inline-block; width: 45%; vertical-align: top;">
                    <label for="estado_equipo">Estado del Equipo:</label>
                    <input type="text" id="estado_equipo" name="estado_equipo" value="<?= htmlspecialchars($mantenimiento['estado_equipo']) ?>" required>

                    <label for="tecnico_id">Técnico Responsable:</label>
                    <select id="tecnico_id" name="tecnico_id" required>
                        <?php foreach ($tecnicos as $tecnico): ?>
                            <option value="<?= $tecnico['id'] ?>" <?= $mantenimiento['tecnico_id'] == $tecnico['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($tecnico['username']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label for="cliente_id">Cliente:</label>
                    <select id="cliente_id" name="cliente_id" required>
                        <?php foreach ($clientes as $cliente): ?>
                            <option value="<?= $cliente['cliente_id'] ?>" <?= $mantenimiento['cliente_id'] == $cliente['cliente_id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cliente['nombre']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Botón para modificar -->
                <button type="submit" name="accion" value="modificar" style="margin-top: 20px;">Modificar Mantenimiento</button>
            </form>
        </div>
    <?php elseif (isset($mantenimiento)): ?>
        <p style="text-align: center; color: red;">Mantenimiento no encontrado.</p>
    <?php endif; ?>

    <!-- Botón para regresar -->
    <div style="text-align: center; margin-top: 20px;">
        <button onclick="window.location.href='../Views/Panel_Navegacion_MAN.php'">Regresar al Panel de Navegación</button>
    </div>
</body>
</html>
