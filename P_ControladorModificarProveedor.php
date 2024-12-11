<?php
require_once 'C:/xampp/htdocs/Proyectos/Sistema_De_Inventario_Pecosol/Config/Database.php';
require_once 'C:/xampp/htdocs/Proyectos/Sistema_De_Inventario_Pecosol/App/Models/P_Modify_Proveedor.php';

class P_ControladorModificarProveedor {
    private $modelo;

    public function __construct() {
        global $pdo;
        $this->modelo = new P_Modify_Proveedor($pdo);
    }

    // Buscar proveedor por ID
    public function buscarProveedor() {
        $id_proveedor = $_GET['id'] ?? ''; // Obtener el ID del proveedor
        $proveedor = $this->modelo->obtenerPorId($id_proveedor); // Buscar el proveedor por ID
        include '../Views/P_Modificar_Proveedor.php'; // Cargar la vista con los datos del proveedor
    }

    // Modificar los datos del proveedor
    public function modificarProveedor() {
        $id_proveedor = $_POST['id'] ?? ''; // Obtener el ID del proveedor
        $proveedor_nombre = $_POST['proveedor'] ?? ''; // Nombre del proveedor
        $direccion = $_POST['direccion'] ?? ''; // Dirección
        $telefono = $_POST['telefono'] ?? ''; // Teléfono
        $email = $_POST['email'] ?? ''; // Email

        $resultado = $this->modelo->modificar($id_proveedor, $proveedor_nombre, $direccion, $telefono, $email);

        if ($resultado) {
            header('Location: ../Views/Panel_Navegacion_PRO.php');
        } else {
            echo "Error al modificar el cliente.";
        }
    }
}

// Control de la acción solicitada
$accion = $_GET['accion'] ?? $_POST['accion'] ?? '';
$controlador = new P_ControladorModificarProveedor();

if ($accion === 'buscar') {
    $controlador->buscarProveedor(); // Acción de búsqueda
} elseif ($accion === 'modificar') {
    $controlador->modificarProveedor(); // Acción de modificación
}
?>
