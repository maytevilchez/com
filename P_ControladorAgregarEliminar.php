<?php
require_once __DIR__ . '/../../Config/Database.php';
require_once __DIR__ . '/../Models/P_Add_Proveedor.php';
require_once __DIR__ . '/../Models/P_Delete_Proveedor.php';

class C_ControladorAgregarEliminar {
    private $add_proveedor_model;
    private $delete_proveedor_model;

    public function __construct() {
        global $pdo;
        $this->add_proveedor_model = new Add_Proveedor($pdo);
        $this->delete_proveedor_model = new Delete_Proveedor($pdo);
    }

    public function gestionarProveedores() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $accion = $_POST['accion'] ?? '';
            if ($accion === 'agregar') {
                $this->agregarProveedor();
            } elseif ($accion === 'eliminar') {
                $this->eliminarProveedor();
            }
        }
    }

    private function agregarProveedor() {
        $proveedor = $_POST['proveedor'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];

        $resultado = $this->add_proveedor_model->agregar($proveedor, $direccion, $telefono, $email);

        if ($resultado) {
            header("Location: ../Views/Panel_Navegacion_PRO.php");
        } else {
            echo "Error al agregar el proveedor.";
        }
    }

    private function eliminarProveedor() {
        $proveedor_id = $_POST['proveedor_id'];

        $resultado = $this->delete_proveedor_model->eliminar($proveedor_id);

        if ($resultado) {
            header("Location: ../Views/Panel_Navegacion_PRO.php");
        } else {
            echo "Error al eliminar el proveedor.";
        }
    }
}

$controlador = new C_ControladorAgregarEliminar();
$controlador->gestionarProveedores();
?>
