<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pecosol - Generar Reporte</title>
    <link rel="icon" type="image/png" href="../../Assets/img/Reporte_Producto.png">
    <style>
        :root {
            --primary-color: #1a2942;
            --secondary-color: #2c3e50;
            --accent-color: #3498db;
            --text-color: #ffffff;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f6fa;
        }

        .header {
            background-color: var(--primary-color);
            color: var(--text-color);
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .main-container {
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background-color: var(--primary-color);
            color: var(--text-color);
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-container {
            flex: 2;
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--primary-color);
            font-weight: bold;
        }

        select, input {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 1rem;
        }

        .button-group {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        button {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background-color: var(--accent-color);
            color: white;
        }

        .btn-secondary {
            background-color: var(--secondary-color);
            color: white;
        }

        .results-table {
            width: 100%;
            margin-top: 2rem;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: var(--primary-color);
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .content-wrapper {
            display: flex;
            gap: 2rem;
            align-items: flex-start;
            margin-bottom: 2rem;
        }

        .image-section {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding-top: 2rem;
        }

        .report-image {
            max-width: 200px;
            height: auto;
            object-fit: contain;
        }

        @media (max-width: 768px) {
            .content-wrapper {
                flex-direction: column;
            }
            
            .image-section {
                order: -1;
                margin-bottom: 1rem;
            }
            
            .report-image {
                max-width: 150px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Generar Reporte</h1>
        <div class="datetime">
            <?php echo date('l, j \d\e F \d\e Y, H:i'); ?>
        </div>
    </div>

    <div class="main-container">
        <div class="content-wrapper">
            <div class="form-container">
                <form method="GET" action="../Controllers/I_ControladorReporte.php">
                    <div class="form-group">
                        <label for="tipo">Tipo de Reporte:</label>
                        <select id="tipo" name="tipo" required>
                            <option value="stock_total">Stock Total</option>
                            <option value="por_marca">Equipos por Marca</option>
                            <option value="por_proveedor">Equipos por Proveedor</option>
                            <option value="nuevos_ingresos">Nuevos Ingresos</option>
                            <option value="bajo_stock">Equipos en Bajo Stock</option>
                        </select>
                    </div>

                    <div id="parametros" class="form-group">
                        <!-- Los campos dinámicos se insertarán aquí -->
                    </div>

                    <div class="button-group">
                        <button type="submit" name="accion" value="ver" class="btn-primary">Ver Reporte</button>
                        <button type="submit" name="accion" value="descargar" class="btn-primary">Descargar PDF</button>
                        <button type="button" onclick="window.location.href='../Views/Panel_Navegacion.php'" class="btn-secondary">Regresar</button>
                    </div>
                </form>
            </div>
            
            <div class="image-section">
                <img src="../../Assets/img/Reporte_Producto.png" alt="Reporte" class="report-image">
            </div>
        </div>

        <?php if (isset($result) && !empty($result)): ?>
            <div class="results-table">
                <table>
                    <tr>
                        <th>Número de Serie</th>
                        <th>Nombre del Equipo</th>
                        <th>Marca</th>
                        <th>Tipo</th>
                        <th>Stock</th>
                        <th>Fecha de Ingreso</th>
                        <th>Proveedor</th>
                    </tr>
                    <?php foreach ($result as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['numero_serie']) ?></td>
                            <td><?= htmlspecialchars($item['nombre_equipo']) ?></td>
                            <td><?= htmlspecialchars($item['marca']) ?></td>
                            <td><?= htmlspecialchars($item['tipo']) ?></td>
                            <td><?= htmlspecialchars($item['stock']) ?></td>
                            <td><?= htmlspecialchars($item['fecha_ingreso']) ?></td>
                            <td><?= htmlspecialchars($item['proveedor']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <script>
        const parametrosDiv = document.getElementById('parametros');
        document.getElementById('tipo').addEventListener('change', function() {
            parametrosDiv.innerHTML = '';

            switch(this.value) {
                case 'por_marca':
                    parametrosDiv.innerHTML = `
                        <label for="marca">Marca:</label>
                        <input type="text" id="marca" name="marca" required>
                    `;
                    break;
                case 'por_proveedor':
                    parametrosDiv.innerHTML = `
                        <label for="proveedor">Proveedor:</label>
                        <input type="text" id="proveedor" name="proveedor" required>
                    `;
                    break;
                case 'nuevos_ingresos':
                    parametrosDiv.innerHTML = `
                        <label for="fechaInicio">Fecha Inicio:</label>
                        <input type="date" id="fechaInicio" name="fechaInicio" required>
                        <label for="fechaFin">Fecha Fin:</label>
                        <input type="date" id="fechaFin" name="fechaFin" required>
                    `;
                    break;
                case 'bajo_stock':
                    parametrosDiv.innerHTML = `
                        <label for="stockMinimo">Stock Mínimo:</label>
                        <input type="number" id="stockMinimo" name="stockMinimo" required>
                    `;
                    break;
            }
        });
    </script>
</body>
</html>
