<?php
session_start();

// Verificar si hay un mensaje de acceso restringido en la sesión
$mensaje = isset($_SESSION['mensaje_acceso_restringido']) ? $_SESSION['mensaje_acceso_restringido'] : "Acceso restringido.";
unset($_SESSION['mensaje_acceso_restringido']); // Limpiar mensaje después de mostrarlo
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Restringido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #2c3e50; /* Fondo oscuro */
            color: white; /* Texto blanco para contraste */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .mensaje {
            background-color: #e74c3c; /* Fondo rojo para resaltar el mensaje */
            color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 600px;
            width: 90%;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.3rem;
            margin-bottom: 20px;
        }

        a {
            display: inline-block;
            background-color: #3498db; /* Botón de regresar azul */
            color: white;
            padding: 12px 25px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1.2rem;
        }

        a:hover {
            background-color: #2980b9; /* Color más oscuro al pasar el mouse */
        }
    </style>
</head>
<body>

    <div class="mensaje">
        <h1>Acceso Restringido</h1>
        <p><?php echo $mensaje; ?></p>
        <a href="javascript:history.back()">Regresar</a>
    </div>

</body>
</html>
