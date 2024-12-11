<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar / Eliminar Proveedor</title>
    <link rel="stylesheet" href="../../Assets/css/Style_Agregar_Eliminar.css">
</head>

<body>
    <div style="text-align: center; margin-top: 20px;">
        <h2>Agregar / Eliminar <br> Proveedor</h2>
    </div>

    <!-- Contenedor principal que alinea los formularios horizontalmente -->
    <div class="contenedor-formularios">
        <!-- Sección para agregar un proveedor -->
        <section class="formulario-agregar">
            <h2>Agregar nuevo proveedor</h2>
            <img src="../../Assets/img/Agregar_Proveedor.png" alt="Agregar Proveedor" style="width: 150px; height: 150px;">
            <form method="POST" action="../Controllers/P_ControladorAgregarEliminar.php">
                <input type="hidden" name="accion" value="agregar">
                <div class="form-columnas">
                    <div class="columna">
                        <label for="proveedor">Nombre del Proveedor:</label>
                        <input type="text" id="proveedor" name="proveedor" required>

                        <label for="direccion">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" required>

                        <label for="telefono">Teléfono:</label>
                        <input type="text" id="telefono" name="telefono" required>

                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                </div>

                <button type="submit" class="boton-accion">Agregar Proveedor</button>
            </form>
        </section>

         <!-- Sección para eliminar un proveedor -->
        <section class="formulario-eliminar">
            <h3>Eliminar Proveedor</h3>
            <img src="../../Assets/img/Eliminar_Proveedor.png" alt="Eliminar Proveedor" style="width: 150px; height: 150px;">
            <form method="POST" action="../Controllers/P_ControladorAgregarEliminar.php">
                <input type="hidden" name="accion" value="eliminar">
                <label for="proveedor_id">ID del Proveedor:</label>
                <input type="number" id="proveedor_id" name="proveedor_id" required>
                <button type="submit">Eliminar Proveedor</button>
            </form>
        </section>
    </div>
</body>

</html>
