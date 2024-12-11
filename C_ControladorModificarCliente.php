<?php
require_once 'C:/xampp/htdocs/Proyectos/Sistema_De_Inventario_Pecosol/Config/Database.php';
require_once 'C:/xampp/htdocs/Proyectos/Sistema_De_Inventario_Pecosol/App/Models/C_Modify_Cliente.php';

class C_ControladorModificarCliente {
    private $modelo;

    public function __construct() {
        global $pdo;
        $this->modelo = new C_Modify_Cliente($pdo);
    }

    public function buscarCliente() {
        $cliente_id = $_GET['cliente_id'] ?? '';
        $cliente = $this->modelo->obtenerPorID($cliente_id);
        include '../Views/C_Modificar_Cliente.php'; // Cargar la vista
    }

    public function modificarCliente() {
        $cliente_id = $_POST['cliente_id'];
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];

        $resultado = $this->modelo->modificar($cliente_id, $nombre, $direccion, $telefono, $email);

        if ($resultado) {
            header('Location: ../Views/Panel_Navegacion_CLI.php');
        } else {
            echo "Error al modificar el cliente.";
        }
    }
}

$accion = $_GET['accion'] ?? $_POST['accion'] ?? '';
$controlador = new C_ControladorModificarCliente();

if ($accion === 'buscar') {
    $controlador->buscarCliente();
} elseif ($accion === 'modificar') {
    $controlador->modificarCliente();
}
?>
