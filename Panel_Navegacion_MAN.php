<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../public/Index.php'); // Redirige si no está autenticado
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" type="image/png" href="../../Assets/img/Pecosol_logo.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pecosol - Inventario</title>
    <!-- Enlace al archivo CSS que define el estilo de este panel -->
    <link rel="stylesheet" href="http://localhost/Proyectos/Sistema_De_Inventario_Pecosol/Assets/css/Style_Panel_Navegacion.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Variables de color */
        :root {
            --primary-color: #002B5B;      /* Azul marino oscuro */
            --secondary-color: #004280;    /* Azul marino medio */
            --accent-color: #00A9FF;       /* Azul claro */
            --text-color: #E6EEF8;         /* Texto claro */
            --hover-color: rgba(255, 255, 255, 0.1);
        }

        /* Panel lateral */
        .sidebar {
            width: 280px;
            height: 100vh;
            background: var(--primary-color);
            position: fixed;
            left: 0;
            top: 0;
            color: var(--text-color);
            padding: 20px 0;
        }

        /* Logo y título */
        .logo-container {
            text-align: center;
            padding: 0 20px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logo-container img {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .welcome-text {
            font-size: 1.2rem;
            margin: -5px 0;
            color: var(--text-color);
            text-align: center;
        }

        /* Secciones del menú */
        .menu-section {
            margin: 15px 0;
        }

        .menu-title {
            color: var(--accent-color);
            font-size: 0.9rem;
            text-transform: uppercase;
            padding: 0 20px;
            margin-bottom: 10px;
            font-weight: 500;
        }

        /* Botones del menú */
        .menu-button {
            display: block;
            width: 100%;
            padding: 15px 20px;
            color: var(--text-color);
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            background: transparent;
            text-align: left;
            cursor: pointer;
        }

        .menu-button:hover {
            background: var(--hover-color);
            padding-left: 25px;
        }

        .menu-button.active {
            background: var(--hover-color);
            border-left: 4px solid var(--accent-color);
        }

        /* Iconos */
        .menu-button i {
            width: 20px;
            margin-right: 10px;
            text-align: center;
        }

        /* Sección de mantenimiento */
        .gestion-mantenimiento {
            margin-bottom: 20px;
        }

        /* Sección de paneles */
        .paneles-gestion {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
        }

        /* Botón de cerrar sesión */
        .logout-btn {
            position: absolute;
            bottom: -25px;
            width: 100%;
            color: #FF6B6B;
            padding: 15px 20px;
        }

        .logout-btn:hover {
            background: rgba(255, 107, 107, 0.1);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                z-index: 1000;
            }

            .sidebar.active {
                transform: translateX(0);
            }
        }

        /* Ajustar el margen y el padding del body */
        body {
            margin: 0; /* Elimina el margen */
            padding: 0; /* Elimina el relleno */
        }

        /* Asegúrate de que el contenedor principal ocupe toda la altura */
        .navegacion {
            height: 100vh; /* Asegura que ocupe toda la altura de la ventana */
            overflow: hidden; /* Evita el desbordamiento */
        }

        /* Ajustar el texto de la descripción */
        .inventario-descripcion {
            font-size: 1.1rem; /* Reduce el tamaño de la fuente */
            line-height: 1.5; /* Mejora la legibilidad */
        }

        /* Estilo para la tabla */
        table th:nth-child(7),
        table td:nth-child(7) {
            width: 250px; /* Permite que la columna se ajuste al contenido */
            overflow: visible; /* Asegúrate de que el contenido no se oculte */
            white-space: nowrap; /* Evita que el texto se divida en varias líneas */
            word-wrap: normal; /* Permite que las palabras largas se mantengan en una línea */
            text-overflow: ellipsis; /* Agrega puntos suspensivos si el texto es demasiado largo */
        }
    </style>
</head>
<body>
    <div class="navegacion">
        <!-- Panel de navegación lateral -->
        <nav class="sidebar">
            <!-- Logo y bienvenida -->
            <div class="logo-container">
                <img src="../../Assets/img/Pecosol_logo.jpg" alt="Logo Pecosol">
                <div class="welcome-text">Bienvenido, <?php echo $_SESSION['user']['username']; ?></div>
            </div>

            <!-- GESTIÓN DE MANTENIMIENTO -->
            <div class="menu-section gestion-mantenimiento">
                <div class="menu-title">GESTIÓN DE MANTENIMIENTO</div>
                <a href="javascript:void(0);" onclick="cargarSeccion('mantenimiento')" class="menu-button">
                    <i class="fas fa-tools"></i> Mantenimientos Realizados
                </a>
                <a href="javascript:void(0);" onclick="cargarSeccion('m_agregar_eliminar')" class="menu-button">
                    <i class="fas fa-plus-minus"></i> Agregar / Eliminar
                </a>
                <a href="../Views/M_Modificar_Mantenimiento.php?Modify=true" class="menu-button">
                    <i class="fas fa-edit"></i> Modificar Mantenimiento
                </a>
                <a href="../Views/M_Generar_Reporte.php?generate=true" class="menu-button">
                    <i class="fas fa-file-alt"></i> Generar Reporte
                </a>
            </div>

            <!-- PANELES DE GESTIÓN -->
            <div class="menu-section paneles-gestion">
                <div class="menu-title">PANELES DE GESTIÓN</div>
                <a href="../Views/Panel_Navegacion_PRO.php" class="menu-button">
                    <i class="fas fa-truck"></i> Gestionar Proveedores
                </a>
                <a href="../Views/Panel_Navegacion_CLI.php" class="menu-button">
                    <i class="fas fa-users"></i> Gestionar Clientes
                </a>
                <a href="../Views/Panel_Navegacion.php" class="menu-button">
                    <i class="fas fa-boxes"></i> Gestionar Inventario
                </a>
                <a href="../Views/Panel_Navegacion_ADM.php" class="menu-button">
                    <i class="fas fa-users-cog"></i> Administrar Usuarios
                </a>
            </div>

            <!-- Botón de cerrar sesión -->
            <a href="../public/Index.php?logout=true" class="menu-button logout-btn">
                <i class="fas fa-sign-out-alt"></i> Cerrar sesión
            </a>
        </nav>
        <!-- Contenedor donde se cargan las secciones dinámicamente -->
        <div class="contenido" id="contenido-dinamico">
            <!-- Contenido por defecto al cargar la vista -->
            <div class="default-content">
                <img src="../../Assets/img/Pecosol_Bienvenidad.jpg" alt="Imagen de bienvenida" class="default-image">
                <h2>¡Bienvenido al Sistema de Inventario de Pecosol!</h2>
                <p class="inventario-descripcion">
                    Aquí podrás llevar un control detallado de las tareas de servicio realizadas sobre los productos de tu inventario. Aquí puedes registrar <br>
                    información esencial sobre los mantenimientos, incluyendo el producto involucrado, la fecha en que se realizó la tarea, el tipo de <br>
                    mantenimiento (preventivo o correctivo), una descripción detallada del trabajo, el técnico responsable y el estado del equipo tras el servicio. <br>
                    Si el mantenimiento está relacionado con un cliente específico, puedes vincular esta información directamente en el registro. Este panel también <br>
                    te permite actualizar registros existentes y consultar el historial de mantenimientos, brindándote una herramienta completa para gestionar <br>
                    y monitorear el estado de los productos y servicios en tu sistema.
                </p>
            </div>
        </div>
    </div>

    <!-- Enlace al archivo JavaScript que permite cargar las secciones dinámicamente -->
    <script src="http://localhost/Proyectos/Sistema_De_Inventario_Pecosol/Assets/js/Secciones.js"></script>
</body>
</html>
