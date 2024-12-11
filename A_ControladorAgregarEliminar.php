<?php
require_once __DIR__ . '/../../Config/Database.php';
require_once __DIR__ . '/../Models/A_Add_Usuario.php';
require_once __DIR__ . '/../Models/A_Delete_Usuario.php';

class A_ControladorAgregarEliminar {
    private $add_usuario_model;
    private $delete_usuario_model;

    public function __construct() {
        global $pdo;
        $this->add_usuario_model = new A_Add_Usuario($pdo);
        $this->delete_usuario_model = new A_Delete_Usuario($pdo);
    }

    public function gestionarUsuarios() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $accion = $_POST['accion'] ?? '';
            if ($accion === 'agregar') {
                $this->agregarUsuario();
            } elseif ($accion === 'eliminar') {
                $this->eliminarUsuario();
            }
        }
    }

    private function agregarUsuario() {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        $resultado = $this->add_usuario_model->agregarUsuario($username, $password, $role);

        if ($resultado) {
            header("Location: ../Views/Panel_Navegacion_ADM.php");
        } else {
            echo "Error al agregar el usuario.";
        }
    }

    private function eliminarUsuario() {
        $user_id = $_POST['id'];
        $resultado = $this->delete_usuario_model->eliminar($user_id);

        if ($resultado) {
            header("Location: ../Views/Panel_Navegacion_ADM.php");
        } else {
            echo "Error al eliminar el usuario.";
        }
    }
}

$controlador = new A_ControladorAgregarEliminar();
$controlador->gestionarUsuarios();
?>
