<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar / Eliminar Usuario</title>
    <link rel="stylesheet" href="../../Assets/css/Style_Agregar_Eliminar.css">
</head>
<body>
    <div style="text-align: center; margin-top: 20px;">
        <h2>Agregar / Eliminar Usuario</h2>
    </div>
    <div class="contenedor-formularios">
        <section class="formulario-agregar">
            <h2>Agregar Usuario</h2>
            <img src="../../Assets/img/Agregar_Usuario.png" alt="Agregar Usuario" style="width: 150px; height: 150px;">
            <form method="POST" action="../Controllers/A_ControladorAgregarEliminar.php">
                <input type="hidden" name="accion" value="agregar">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
                <label for="role">Rol:</label>
                <select id="role" name="role" required>
                    <option value="admin">Admin</option>
                    <option value="tecnico">Técnico</option>
                    <option value="vendedor">Vendedor</option>
                </select>
                <button type="submit">Agregar Usuario</button>
            </form>
        </section>

        <section class="formulario-eliminar">
            <h3>Eliminar Usuario</h3>
            <img src="../../Assets/img/Eliminar_Usuario.png" alt="Eliminar Usuario" style="width: 150px; height: 150px;">
            <form method="POST" action="../Controllers/A_ControladorAgregarEliminar.php">
                <input type="hidden" name="accion" value="eliminar">
                <label for="id">ID del Usuario:</label>
                <input type="number" id="id" name="id" required>
                <button type="submit">Eliminar Usuario</button>
            </form>
        </section>
    </div>
</body>
</html>
