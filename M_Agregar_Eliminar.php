<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar / Eliminar Mantenimiento</title>
    <link rel="stylesheet" href="../../Assets/css/Style_Agregar_Eliminar.css">
</head>

<body>
    <div style="text-align: center; margin-top: 20px;">
        <h2>Agregar / Eliminar <br> Mantenimiento</h2>
    </div>

    <!-- Contenedor principal que alinea los formularios horizontalmente -->
    <div class="contenedor-formularios">
        <!-- Sección para agregar un mantenimiento -->
        <section class="formulario-agregar">
            <h2>Agregar nuevo mantenimiento</h2>
            <img src="../../Assets/img/Agregar_Mantenimiento.png" alt="Agregar Mantenimiento" style="width: 150px; height: 150px;">
            <form method="POST" action="../Controllers/M_ControladorAgregarEliminar.php">
                <input type="hidden" name="accion" value="agregar">

                <!-- Contenedor para dividir en columnas -->
                <div class="form-columnas">
                    <!-- Primera columna -->
                    <div class="columna">
                        <label for="codigo_producto">Código del Producto:</label>
                        <select id="codigo_producto" name="codigo_producto" required>
                            <option value="">--Selecciona--</option>
                            <?php
                            // Obtener productos del inventario
                            require_once 'C:/xampp/htdocs/Proyectos/Sistema_De_Inventario_Pecosol/Config/Database.php';
                            $stmt = $pdo->query("SELECT id, numero_serie FROM inventario");
                            while ($row = $stmt->fetch()) {
                                echo "<option value='" . $row['id'] . "'>" . $row['numero_serie'] . "</option>";
                            }
                            ?>
                        </select>

                        <label for="tecnico_id">Técnico:</label>
                        <select id="tecnico_id" name="tecnico_id" required>
                            <option value="">--Selecciona--</option>
                            <?php
                            // Obtener técnicos
                            $stmt = $pdo->query("SELECT id, username FROM users WHERE role = 'tecnico'");
                            while ($row = $stmt->fetch()) {
                                echo "<option value='" . $row['id'] . "'>" . $row['username'] . "</option>";
                            }
                            ?>
                        </select>

                        <label for="cliente_id">Cliente:</label>
                        <select id="cliente_id" name="cliente_id" required>
                            <option value="">--Selecciona--</option>
                            <?php
                            // Obtener clientes
                            $stmt = $pdo->query("SELECT cliente_id, nombre FROM clientes");
                            while ($row = $stmt->fetch()) {
                                echo "<option value='" . $row['cliente_id'] . "'>" . $row['nombre'] . "</option>";
                            }
                            ?>
                        </select>

                        <label for="tipo_mantenimiento">Tipo de Mantenimiento:</label>
                        <select id="tipo_mantenimiento" name="tipo_mantenimiento" required>
                            <option value="">--Selecciona--</option>
                            <option value="Preventivo">Preventivo</option>
                            <option value="Correctivo">Correctivo</option>
                        </select>
                    </div>

                    <!-- Segunda columna -->
                    <div class="columna">
                        <label for="fecha_mantenimiento">Fecha del Mantenimiento:</label>
                        <input type="date" id="fecha_mantenimiento" name="fecha_mantenimiento" required>

                        <label for="descripcion">Descripción:</label>
                        <textarea id="descripcion" name="descripcion" rows="4" required></textarea>

                        <label for="estado_equipo">Estado del Equipo:</label>
                        <input type="text" id="estado_equipo" name="estado_equipo" required>
                    </div>
                </div>

                <button type="submit" class="boton-accion">Agregar Mantenimiento</button>
            </form>
        </section>

        <!-- Sección para eliminar un mantenimiento -->
        <section class="formulario-eliminar">
            <h3>Eliminar Mantenimiento</h3>
            <img src="../../Assets/img/Eliminar_Mantenimiento.png" alt="Eliminar Mantenimiento" style="width: 150px; height: 150px;">
            <form action="../Controllers/M_ControladorAgregarEliminar.php" method="POST">
                <!-- Campo oculto para definir acción -->
                <input type="hidden" name="accion" value="eliminar">

                <label for="mantenimiento_id">ID del Mantenimiento:</label>
                <input type="number" id="mantenimiento_id" name="mantenimiento_id" required>

                <button type="submit">Eliminar Mantenimiento</button>
            </form>
        </section>
    </div>
</body>

</html>
