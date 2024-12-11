<?php
header("Access-Control-Allow-Origin: http://localhost:3000"); // Asegúrate de incluir el puerto
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require_once 'C:/xampp/htdocs/Proyectos/Sistema_De_Inventario_Pecosol/Config/Database.php';

session_start();
//if (!isset($_SESSION['user'])) {
//    echo json_encode(['error' => 'No está autenticado']);
//    exit;
//

$seccion = $_GET['seccion'] ?? '';

switch ($seccion) {
//Inventario
    case 'inventario':
        include '../Views/I_Inventario.php';
        break;
    case 'agregar_eliminar':
        include '../Views/I_Agregar_Eliminar.php';
        break;
//Proveedores
    case 'proveedor':
        include '../Views/P_Proveedores.php';
        break;
    case 'p_agregar_eliminar':
        include '../Views/P_Agregar_Eliminar.php';
        break;
//Clientes
    case 'cliente':
        include '../Views/C_Clientes.php';
        break;
    case 'c_agregar_eliminar':
        include '../Views/C_Agregar_Eliminar.php';
        break;

//Mantenimiento
    case 'mantenimiento':
        include '../Views/M_Mantenimiento.php';
        break;
    case 'm_agregar_eliminar':
        include '../Views/M_Agregar_Eliminar.php';
        break;

//Mantenimiento
    case 'usuarios':
        include '../Views/A_Usuarios.php';
        break;
    case 'u_agregar_eliminar':
        include '../Views/A_Agregar_Eliminar.php';
        break;
        echo json_encode(["error" => "Sección no válida"]);
        break;
    }
?>
