<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar / Eliminar Cliente</title>
    <link rel="stylesheet" href="../../Assets/css/Style_Agregar_Eliminar.css">
</head>
<body>
    <div style="text-align: center; margin-top: 20px;">
        <h2>Agregar / Eliminar Cliente</h2>
    </div>
    <div class="contenedor-formularios">
        <section class="formulario-agregar">
            <h2>Agregar Cliente</h2>
            <img src="../../Assets/img/Agregar_Cliente.png" alt="Agregar Cliente" style="width: 150px; height: 150px;">
            <form method="POST" action="../Controllers/C_ControladorAgregarEliminar.php">
                <input type="hidden" name="accion" value="agregar">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" required>
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <button type="submit">Agregar Cliente</button>
            </form>
        </section>

        <section class="formulario-eliminar">
            <h3>Eliminar Cliente</h3>
            <form method="POST" action="../Controllers/C_ControladorAgregarEliminar.php">
            <img src="../../Assets/img/Eliminar_Cliente.png" alt="Eliminar Cliente" style="width: 150px; height: 150px;">
                <input type="hidden" name="accion" value="eliminar">
                <label for="cliente_id">ID del Cliente:</label>
                <input type="number" id="cliente_id" name="cliente_id" required>
                <button type="submit">Eliminar Cliente</button>
            </form>
        </section>
    </div>
</body>
</html>
