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
        <img src="../../Assets/img/Reporte_Mantenimiento.png" alt="Generar Reporte" style="width: 150px; height: 150px;">
    </div>

<!-- Formulario para generar reporte -->
<form method="GET" action="../Controllers/M_ControladorReporte.php">
    <label for="tipo">Selecciona el tipo de reporte:</label>
    <select id="tipo" name="tipo" required>
        <option value="mantenimientos">Todos los Mantenimientos</option>
        <option value="por_tipo">Mantenimientos por Tipo</option>
        <option value="por_tecnico">Mantenimientos por Técnico</option>
        <option value="por_fecha">Mantenimientos por Fecha</option>
    </select>

    <div id="parametros"></div>

    <div style="text-align: center;">
        <button type="submit" name="accion" value="ver">Ver Reporte</button>
        <button type="submit" name="accion" value="descargar">Descargar PDF</button>
    </div>
</form>

<?php if (isset($mantenimientos) && !empty($mantenimientos)): ?>
    <h3>Resultados del Reporte</h3>
    <table border="1">
        <thead>
        <tr>
            <th>#</th>
            <th>Fecha Mantenimiento</th>
            <th>Número de Serie</th>
            <th>Tipo Mantenimiento</th>
            <th>Descripción</th>
            <th>Técnico</th>
            <th>Estado Equipo</th>
            <th>Cliente</th>
        </tr>
        </thead>
        <tbody>
            <?php $contador = 1; ?>
            <?php foreach ($mantenimientos as $item): ?>
                <tr>
                    <td><?= $contador++; ?></td>
                    <td><?= htmlspecialchars($item['fecha_mantenimiento']) ?></td>
                    <td><?= htmlspecialchars($item['numero_serie']) ?></td>
                    <td><?= htmlspecialchars($item['tipo_mantenimiento']) ?></td>
                    <td><?= htmlspecialchars($item['descripcion']) ?></td>
                    <td><?= htmlspecialchars($item['tecnico_nombre']) ?></td>
                    <td><?= htmlspecialchars($item['estado_equipo']) ?></td>
                    <td><?= htmlspecialchars($item['cliente_nombre']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php elseif (isset($mantenimientos)): ?>
    <p>No hay resultados para mostrar.</p>
<?php endif; ?>

<!-- Botón para regresar -->
<button onclick="window.location.href='../Views/Panel_Navegacion_MAN.php'">Regresar al Panel de Navegación</button>

<script>
    const parametrosDiv = document.getElementById('parametros');
    document.getElementById('tipo').addEventListener('change', function() {
        parametrosDiv.innerHTML = ''; // Limpia parámetros anteriores

        if (this.value === 'por_tipo') {
            parametrosDiv.innerHTML = '<label>Tipo de Mantenimiento:</label><select name="tipo_mantenimiento" required><option value="Preventivo">Preventivo</option><option value="Correctivo">Correctivo</option></select>';
        } else if (this.value === 'por_tecnico') {
            parametrosDiv.innerHTML = '<label>Nombre del Técnico:</label><input type="text" name="tecnico_nombre" required>';
        } else if (this.value === 'por_fecha') {
            parametrosDiv.innerHTML = `
                <label>Fecha Inicio:</label><input type="date" name="fechaInicio" required>
                <label>Fecha Fin:</label><input type="date" name="fechaFin" required>`;
        }
    });
</script>
</body>
</html>

