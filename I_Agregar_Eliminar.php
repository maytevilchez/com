<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar / Eliminar Producto</title>
    <link rel="stylesheet" href="../../Assets/css/Style_Agregar_Eliminar.css">
</head>

<body>
    <div style="text-align: center; margin-top: 20px;">
        <h2>Agregar / Eliminar Producto</h2>
    </div>

    <!-- Contenedor principal que alinea los formularios horizontalmente -->
    <div class="contenedor-formularios">
        <!-- Sección para agregar un producto -->
        <section class="formulario-agregar">
            <h2>Agregar nuevo producto</h2>
            <img src="../../Assets/img/Nuevo_Producto.png" alt="Agregar Producto" style="width: 150px; height: 150px;">
            <form method="POST" action="../Controllers/I_ControladorAgregarEliminar.php">
                <input type="hidden" name="accion" value="agregar">

                <!-- Contenedor para dividir en columnas -->
                <div class="form-columnas">
                    <!-- Primera columna -->
                    <div class="columna">
                        <label for="numero_serie">Número de Serie:</label>
                        <input type="text" id="numero_serie" name="numero_serie" required>

                        <label for="nombre_equipo">Nombre del Equipo:</label>
                        <input type="text" id="nombre_equipo" name="nombre_equipo" required>

                        <label for="marca">Marca:</label>
                        <input type="text" id="marca" name="marca" required>

                        <label for="tipo">Tipo:</label>
                        <input type="text" id="tipo" name="tipo" required>
                    </div>

                    <!-- Segunda columna -->
                    <div class="columna">
                        <label for="stock">Stock:</label>
                        <input type="number" id="stock" name="stock" required>

                        <label for="fecha_ingreso">Fecha de Ingreso:</label>
                        <input type="date" id="fecha_ingreso" name="fecha_ingreso" required>

                        <label for="proveedor">Proveedor:</label>
                        <select name="proveedor" id="proveedor" required>
                            <option label="">--Selecciona---</option>
                            <?php
                            // Incluir la conexión y obtener los proveedores
                            require_once 'C:/xampp/htdocs/Proyectos/Sistema_De_Inventario_Pecosol/Config/Database.php';
                            $stmt = $pdo->query("SELECT id, proveedor FROM proveedores");
                            while ($row = $stmt->fetch()) {
                                echo "<option value='" . $row['id'] . "'>" . $row['proveedor'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <button type="submit" class="boton-accion">Agregar Producto</button>
            </form>
        </section>

        <!-- Sección para eliminar un producto -->
        <section class="formulario-eliminar">
            <h3>Eliminar Producto</h3>
            <img src="../../Assets/img/Eliminar_Producto.png" alt="Eliminar Producto" style="width: 150px; height: 150px;">
            <form action="../Controllers/I_ControladorAgregarEliminar.php" method="POST">
                <!-- Campo oculto para definir acción -->
                <input type="hidden" name="accion" value="eliminar">

                <label for="numero_serie_eliminar">Número de Serie del Producto:</label>
                <input type="text" id="numero_serie_eliminar" name="numero_serie" required>

                <button type="submit">Eliminar Producto</button>
            </form>
        </section>
    </div>
</body>

</html>
