<?php
require_once __DIR__ . '/../../Config/Database.php';
require_once __DIR__ . '/../Models/C_Add_Cliente.php';
require_once __DIR__ . '/../Models/C_Delete_Cliente.php';

class C_ControladorAgregarEliminar {
    private $add_cliente_model;
    private $delete_cliente_model;

    public function __construct() {
        global $pdo;
        $this->add_cliente_model = new C_Add_Cliente($pdo);
        $this->delete_cliente_model = new C_Delete_Cliente($pdo);
    }

    public function gestionarClientes() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $accion = $_POST['accion'] ?? '';
            if ($accion === 'agregar') {
                $this->agregarCliente();
            } elseif ($accion === 'eliminar') {
                $this->eliminarCliente();
            }
        }
    }

    private function agregarCliente() {
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];

        $resultado = $this->add_cliente_model->agregar($nombre, $direccion, $telefono, $email);

        if ($resultado) {
            header("Location: ../Views/Panel_Navegacion_CLI.php");
        } else {
            echo "Error al agregar el cliente.";
        }
    }

    private function eliminarCliente() {
        $cliente_id = $_POST['cliente_id'];
        $resultado = $this->delete_cliente_model->eliminar($cliente_id);

        if ($resultado) {
            header("Location: ../Views/Panel_Navegacion_CLI.php");
        } else {
            echo "Error al eliminar el cliente.";
        }
    }
}

$controlador = new C_ControladorAgregarEliminar();
$controlador->gestionarClientes();
?>
