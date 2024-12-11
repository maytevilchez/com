<?php
require_once 'C:/xampp/htdocs/Proyectos/Sistema_De_Inventario_Pecosol/Config/Database.php';
require_once 'C:/xampp/htdocs/Proyectos/Sistema_De_Inventario_Pecosol/App/Models/A_Modify_Usuario.php';

class A_ControladorModificarUsuario {
    private $modelo;

    public function __construct() {
        global $pdo;
        $this->modelo = new A_Modify_Usuario($pdo);
    }

    public function buscarUsuario() {
        $user_id = $_GET['id'] ?? '';
        $usuario = $this->modelo->obtenerPorID($user_id);
        include '../Views/A_Modificar_Usuario.php';
    }

    public function modificarUsuario() {
        $user_id = $_POST['id'];
        $username = $_POST['username'];
        $role = $_POST['role'];
        $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

        $resultado = $this->modelo->modificar($user_id, $username, $role, $password);

        if ($resultado) {
            header('Location: ../Views/Panel_Navegacion_ADM.php');
        } else {
            echo "Error al modificar el usuario.";
        }
    }
}

$accion = $_GET['accion'] ?? $_POST['accion'] ?? '';
$controlador = new A_ControladorModificarUsuario();

if ($accion === 'buscar') {
    $controlador->buscarUsuario();
} elseif ($accion === 'modificar') {
    $controlador->modificarUsuario();
}
?>
