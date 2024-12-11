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

        /* Ajustar el ancho de la columna de Email */
        table th:nth-child(5), /* Suponiendo que la columna de Email es la quinta */
        table td:nth-child(5) {
            width: 350px; /* Permite que la columna se ajuste al contenido */
            overflow: visible; /* Asegúrate de que el contenido no se oculte */
            white-space: nowrap; /* Evita que el texto se divida en varias líneas */
            word-wrap: normal; /* Permite que las palabras largas se mantengan en una línea */
            text-overflow: ellipsis; /* Agrega puntos suspensivos si el texto es demasiado largo */
        }
    </style>
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

            <!-- GESTIÓN DE CLIENTES -->
            <div class="menu-section gestion-clientes">
                <div class="menu-title">GESTIÓN DE CLIENTES</div>
                <a href="javascript:void(0);" onclick="cargarSeccion('cliente')" class="menu-button">
                    <i class="fas fa-users"></i> Lista de Clientes
                </a>
                <a href="javascript:void(0);" onclick="cargarSeccion('c_agregar_eliminar')" class="menu-button">
                    <i class="fas fa-user-plus"></i> Agregar / Eliminar
                </a>
                <a href="../Views/C_Modificar_Cliente.php?Modify=true" class="menu-button">
                    <i class="fas fa-user-edit"></i> Modificar Cliente
                </a>
                <a href="../Controllers/C_ControladorReporte.php?tipo=clientes&accion=descargar" class="menu-button">
                    <i class="fas fa-file-alt"></i> Generar Reporte
                </a>
            </div>

            <!-- PANELES DE GESTIÓN -->
            <div class="menu-section paneles-gestion">
                <div class="menu-title">PANELES DE GESTIÓN</div>
                <a href="../Views/Panel_Navegacion_PRO.php" class="menu-button">
                    <i class="fas fa-truck"></i> Gestionar Proveedores
                </a>
                <a href="../Views/Panel_Navegacion.php" class="menu-button">
                    <i class="fas fa-boxes"></i> Gestionar Inventario
                </a>
                <a href="../Views/Panel_Navegacion_MAN.php" class="menu-button">
                    <i class="fas fa-tools"></i> Gestionar Mantenimiento
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
                Aquí podrás gestionar la información de tus clientes de manera eficiente. Desde aquí, puedes registrar nuevos clientes, especificando su nombre, <br>
                dirección, teléfono y correo electrónico. También puedes realizar actualizaciones en los datos existentes para asegurarte de que la información de <br>
                contacto esté siempre correcta. Si hay clientes antiguos que ya no necesitas en tu base de datos, puedes eliminarlos fácilmente. Además, este panel <br>
                permite consultar y filtrar información, facilitando el acceso a los detalles de tus clientes y ayudándote a mantener relaciones más efectivas con ellos.
                </p>
            </div>
        </div>
    </div>

    <!-- Enlace al archivo JavaScript que permite cargar las secciones dinámicamente -->
    <script src="http://localhost/Proyectos/Sistema_De_Inventario_Pecosol/Assets/js/Secciones.js"></script>
</body>
</html>
