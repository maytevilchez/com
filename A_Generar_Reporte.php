<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" type="image/png" href="../../Assets/img/Pecosol_logo.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pecosol - Generar Reporte</title>
    <link rel="stylesheet" href="../../Assets/css/I_Style_Generar_Reporte.css">
</head>
<body>
    <!-- Encabezado con título e imagen -->
    <div style="text-align: center; margin-top: 20px;">
        <h2>Generar Reporte</h2>
        <img src="../../Assets/img/Reporte_Usuario.png" alt="Reporte Usuario" style="width: 150px; height: 150px;">
    </div>

    <form method="GET" action="../Controllers/A_ControladorReporteUsuario.php">
        <label for="tipo">Selecciona el tipo de reporte:</label>
        <select id="tipo" name="tipo" required>
            <option value="usuarios">Usuarios del Sistema</option>
            <option value="roles">Usuarios por Rol</option>
        </select>

        <div id="parametros"></div>

        <div>
            <button type="submit" name="accion" value="ver">Ver Reporte</button>
            <button type="submit" name="accion" value="descargar">Descargar PDF</button>
        </div>
    </form>

    <!-- Mostrar resultados del reporte si existen -->
    <?php if (isset($result) && !empty($result)): ?>
        <h3>Resultado del Reporte</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Role</th>
            </tr>
            <?php foreach ($result as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['id']) ?></td>
                    <td><?= htmlspecialchars($item['username']) ?></td>
                    <td><?= htmlspecialchars($item['role']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php elseif (isset($result)): ?>
        <p>No se encontraron datos para este reporte.</p>
    <?php endif; ?>

    <!-- Botón para regresar -->
    <button onclick="window.location.href='../Views/Panel_Navegacion_ADM.php'">Regresar al Panel de Navegación</button>

    <!-- Script para campos dinámicos -->
    <script>
        const parametrosDiv = document.getElementById('parametros');
        document.getElementById('tipo').addEventListener('change', function() {
            parametrosDiv.innerHTML = ''; // Limpia parámetros anteriores

            // Añade campos según el tipo de reporte seleccionado
            if (this.value === 'roles') {
                // Menú desplegable con roles disponibles
                parametrosDiv.innerHTML = `
                    <label for="role">Selecciona un Rol:</label>
                    <select name="role" id="role" required>
                        <option value="admin">Administrador</option>
                        <option value="tecnico">Técnico</option>
                        <option value="vendedor">Vendedor</option>
                    </select>
                `;
            } else if (this.value === 'usuarios') {
                parametrosDiv.innerHTML = '<p>Este reporte muestra todos los usuarios sin filtros.</p>';
            }
        });
    </script>
</body>
</html>
