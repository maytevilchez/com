<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" type="image/png" href="../../Assets/img/Pecosol_logo.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pecosol - Modificar Producto</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 900px;
        }

        .header {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            padding-bottom: 15px;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .hoja {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        label {
            color: #2c3e50;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #2c3e50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #34495e;
        }

        .buscar-btn {
            background-color: #3498db;
        }

        .buscar-btn:hover {
            background-color: #2980b9;
        }

        .modificar-btn {
            background-color: #2ecc71;
        }

        .modificar-btn:hover {
            background-color: #27ae60;
        }

        .regresar-btn {
            background-color: #e74c3c;
        }

        .regresar-btn:hover {
            background-color: #c0392b;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            padding: 20px;
        }

        /* Mensaje de error */
        .error-message {
            color: #e74c3c;
            text-align: center;
            padding: 10px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Modificar Producto</h2>
            <img src="../../Assets/img/Modificar_Producto.png" alt="Modificar Producto" style="width: 100px; height: 100px;">
        </div>

        <!-- Formulario de búsqueda -->
        <form method="GET" action="../Controllers/I_ControladorModificarProducto.php">
            <label for="numero_serie">Número de Serie:</label>
            <input type="text" id="numero_serie" name="numero_serie" required>
            <button type="submit" name="accion" value="buscar" class="buscar-btn">Buscar Producto</button>
        </form>

        <?php if (isset($producto) && !empty($producto)): ?>
            <div class="form-container">
                <h3>Producto Encontrado</h3>
                <form method="POST" action="../Controllers/I_ControladorModificarProducto.php">
                    <input type="hidden" name="numero_serie" value="<?= htmlspecialchars($producto['numero_serie']) ?>">
                    
                    <!-- Primera Hoja -->
                    <div class="hoja">
                        <div>
                            <label for="nombre_equipo">Nombre del Equipo:</label>
                            <input type="text" id="nombre_equipo" name="nombre_equipo" value="<?= htmlspecialchars($producto['nombre_equipo']) ?>" required>
                        </div>
                        <div>
                            <label for="marca">Marca:</label>
                            <input type="text" id="marca" name="marca" value="<?= htmlspecialchars($producto['marca']) ?>" required>
                        </div>
                        <div>
                            <label for="tipo">Tipo:</label>
                            <input type="text" id="tipo" name="tipo" value="<?= htmlspecialchars($producto['tipo']) ?>" required>
                        </div>
                    </div>

                    <!-- Segunda Hoja -->
                    <div class="hoja">
                        <div>
                            <label for="stock">Stock:</label>
                            <input type="number" id="stock" name="stock" value="<?= htmlspecialchars($producto['stock']) ?>" required>
                        </div>
                        <div>
                            <label for="fecha_ingreso">Fecha de Ingreso:</label>
                            <input type="date" id="fecha_ingreso" name="fecha_ingreso" value="<?= htmlspecialchars($producto['fecha_ingreso']) ?>" required>
                        </div>
                        <div>
                            <label for="proveedor">Proveedor:</label>
                            <select id="proveedor" name="proveedor" required>
                                <option value="">Seleccionar proveedor</option>
                                <?php foreach ($proveedores as $proveedor): ?>
                                    <!-- Compara el id del proveedor almacenado en el producto con el id de cada proveedor -->
                                    <option value="<?= $proveedor['id'] ?>" <?= $producto['proveedor'] == $proveedor['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($proveedor['proveedor']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <button type="submit" name="accion" value="modificar" class="modificar-btn">Modificar Producto</button>
                </form>
            </div>
        <?php elseif (isset($producto)): ?>
            <p class="error-message">Producto no encontrado.</p>
        <?php endif; ?>

        <div class="footer">
            <button onclick="window.location.href='../Views/Panel_Navegacion.php'" class="regresar-btn">
                Regresar al Panel de Navegación
            </button>
        </div>
    </div>
</body>
</html>
