<?php
session_start();

// Verificar si el usuario está autenticado y tiene el rol de 'admin'
if (!isset($_SESSION['user'])) {
    header('Location: ../public/Index.php'); // Redirige si no está autenticado
    exit;
}

// Verificar si el usuario tiene el rol 'admin'
if ($_SESSION['user']['role'] !== 'admin') {
    $_SESSION['mensaje_acceso_restringido'] = "Acceso restringido: Solo los administradores pueden acceder a esta página.";
    header("Location: AccesoRestringido.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" type="image/png" href="../../Assets/img/Pecosol_logo.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pecosol - Administración</title>
    <link rel="stylesheet" href="../../Assets/css/Style_Panel_Navegacion.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        /* Variables de color */
        :root {
            --primary-color: #003366;
            --secondary-color: #00509E;
            --accent-color: #00A9FF;
            --text-color: #FFFFFF;
            --background-color: #F4F4F4;
            --hover-color: rgba(255, 255, 255, 0.2);
            --danger-color: #FF6B6B;
            --card-background: #007BFF;
            --border-color: rgba(0, 0, 0, 0.1);
        }

        body {
            background-color: var(--background-color);
            font-family: 'Poppins', sans-serif;
            margin: 0;
            overflow-x: hidden;
            color: var(--text-color);
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 1rem;
        }

        .container {
            display: flex;
            width: 100%;
            max-width: none;
            margin: 0 auto;
            padding: 0;
        }

        .sidebar {
            box-shadow: 2px 0 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            background: var(--primary-color);
            color: #FFFFFF;
            width: 250px;
            height: 100vh;
            position: fixed;
            overflow-y: auto;
            transition: width 0.3s; /* Transición suave al cambiar el tamaño */
            left: 0;
        }

        .sidebar:hover {
            width: 300px; /* Ampliar al pasar el mouse */
        }

        .contenido {
            margin-left: 250px;
            padding: 0;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: margin-left 0.3s; /* Transición suave */
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .sidebar-header img {
            width: 50px; /* Tamaño del logo */
            margin-right: 10px;
        }

        /* Estilo del encabezado del panel */
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 800px;
            margin-bottom: 20px;
            padding: 10px;
            background: var(--card-background);
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .dashboard-header h2 {
            margin: 0;
            color: var(--primary-color);
        }

        .header-actions {
            display: flex;
            align-items: center;
            color: var(--primary-color);
        }

        .header-actions .date-time {
            font-weight: bold;
            margin-right: 20px;
        }

        /* Estilo de tarjetas de estadísticas */
        .stat-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            width: 100%;
            max-width: 800px;
            margin: 20px 0;
        }

        .stat-card {
            background: var(--card-background);
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s, box-shadow 0.2s;
            text-align: center;
            min-width: 200px;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        /* Estilo para el texto de bienvenida */
        .admin-descripcion {
            font-size: 1.1rem;
            line-height: 1.5;
            margin-top: 5px;
            color: #555;
            text-align: justify;
        }

        /* Estilo para el contenedor de bienvenida */
        .welcome-container {
            background-color: #FFFFFF;
            border-radius: px;
            padding: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            margin-top: 15px;
        }

        /* Estilo para los botones del menú */
        .menu-button {
            border-radius: 5px;
            padding: 10px;
            transition: background 0.3s;
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #FFFFFF;
            justify-content: flex-start;
            margin: 5px 0;
            font-weight: 500;
        }

        .menu-button:hover {
            background: var(--hover-color);
        }

        /* Botón de cerrar sesión */
        .logout-btn {
            background: var(--danger-color);
            border-radius: 5px;
            padding: 10px;
            text-align: center;
            transition: background 0.3s;
            color: #FFFFFF;
            margin-top: 20px;
            width: 100%;
            font-weight: bold;
        }

        .logout-btn:hover {
            background: rgba(255, 107, 107, 0.5);
        }

        /* Estilo para la imagen de bienvenida */
        .default-image {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="navegacion">
        <nav class="sidebar">
            <div class="sidebar-header">
                <img src="../../Assets/img/Pecosol_logo.jpg" alt="Logo" class="logo">
                <h1>Bienvenido, <?php echo $_SESSION['user']['username']; ?></h1>
            </div>
            
            <ul class="menu">
                <li class="menu-section">
                    <span class="section-title">Gestión de Usuarios</span>
                </li>
                <li>
                    <a href="javascript:void(0);" onclick="cargarSeccion('usuarios')" class="menu-button">
                        <i class="fas fa-users"></i>
                        <span>Lista de Usuarios</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);" onclick="cargarSeccion('u_agregar_eliminar')" class="menu-button">
                        <i class="fas fa-user-plus"></i>
                        <span>Agregar / Eliminar</span>
                    </a>
                </li>
                <li>
                    <a href="../Views/A_Modificar_Usuario.php" class="menu-button">
                        <i class="fas fa-user-edit"></i>
                        <span>Modificar Usuario</span>
                    </a>
                </li>
                <li>
                    <a href="../Views/A_Generar_Reporte.php?tipo=usuarios&accion=descargar" class="menu-button">
                        <i class="fas fa-file-alt"></i>
                        <span>Generar Reporte</span>
                    </a>
                </li>

                <li class="menu-section">
                    <span class="section-title">Paneles de Gestión</span>
                </li>
                <li>
                    <a href="../Views/Panel_Navegacion.php" class="menu-button">
                        <i class="fas fa-boxes"></i>
                        <span>Gestionar Inventario</span>
                    </a>
                </li>
                <li>
                    <a href="../Views/Panel_Navegacion_CLI.php" class="menu-button">
                        <i class="fas fa-user-tie"></i>
                        <span>Gestionar Clientes</span>
                    </a>
                </li>
                <li>
                    <a href="../Views/Panel_Navegacion_MAN.php" class="menu-button">
                        <i class="fas fa-tools"></i>
                        <span>Gestionar Mantenimiento</span>
                    </a>
                </li>

                <li class="menu-section">
                    <span class="section-title">Cuenta</span>
                </li>
                <li>
                    <a href="../public/Index.php?logout=true" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Cerrar sesión</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="contenido" id="contenido-dinamico">
            <div class="dashboard-header">
                <h2>Panel de Administración</h2>
                <div class="header-actions">
                    <span class="date-time" id="datetime"></span>
                    <div class="user-info">
                        <i class="fas fa-user-shield"></i>
                        <span>Administrador</span>
                    </div>
                </div>
            </div>

            <div class="dashboard-stats">
                <div class="stat-cards">
                    <div class="stat-card">
                        <i class="fas fa-users"></i>
                        <div class="stat-info">
                            <h3>Total Usuarios</h3>
                            <span id="total-usuarios">0</span> <!-- Datos de ejemplo -->
                        </div>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-user-check"></i>
                        <div class="stat-info">
                            <h3>Usuarios Activos</h3>
                            <span id="usuarios-activos">0</span> <!-- Datos de ejemplo -->
                        </div>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-clock"></i>
                        <div class="stat-info">
                            <h3>Última Actividad</h3>
                            <span id="ultima-actividad">N/A</span> <!-- Datos de ejemplo -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="welcome-container">
                <img src="../../Assets/img/Pecosol_Bienvenidad.jpg" alt="Imagen de bienvenida" class="default-image">
                <h2>¡Bienvenido al Panel de Administración!</h2>
                <p class="admin-descripcion">
                    Desde aquí podrás gestionar todos los aspectos relacionados con los usuarios del sistema.
                    Tienes acceso completo para crear, modificar y eliminar cuentas de usuario, así como
                    asignar roles y permisos específicos. Mantén el control total sobre quién accede al
                    sistema y qué acciones pueden realizar.
                </p>
            </div>
        </div>
    </div>

    <script src="../../Assets/js/Secciones.js"></script>
    <script>
        // Actualizar fecha y hora
        function updateDateTime() {
            const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            document.getElementById('datetime').textContent = now.toLocaleDateString('es-ES', options);
        }
        
        setInterval(updateDateTime, 1000);
        updateDateTime();

        // Simulación de datos para las estadísticas
        document.getElementById('total-usuarios').textContent = '25'; // Total de usuarios
        document.getElementById('usuarios-activos').textContent = '18'; // Usuarios activos
        document.getElementById('ultima-actividad').textContent = 'Hace 5 min'; // Última actividad
    </script>
</body>
</html>
