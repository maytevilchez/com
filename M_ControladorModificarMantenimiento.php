<?php
require_once 'C:/xampp/htdocs/Proyectos/Sistema_De_Inventario_Pecosol/Config/Database.php';
require_once 'C:/xampp/htdocs/Proyectos/Sistema_De_Inventario_Pecosol/App/Models/M_Modify_Mantenimiento.php';

class ControladorModificarMantenimiento {
    private $modelo;

    public function __construct() {
        global $pdo;
        $this->modelo = new Modify_Mantenimiento($pdo);
    }

    public function buscarMantenimiento() {
        $mantenimiento_id = $_GET['mantenimiento_id'] ?? '';
        $mantenimiento = $this->modelo->obtenerMantenimientoPorId($mantenimiento_id);
        $tecnicos = $this->modelo->obtenerTecnicos();
        $clientes = $this->modelo->obtenerClientes();
        include '../Views/M_Modificar_Mantenimiento.php';
    }

    public function modificarMantenimiento() {
        $mantenimiento_id = $_POST['mantenimiento_id'];
        $fecha_mantenimiento = $_POST['fecha_mantenimiento'];
        $tipo_mantenimiento = $_POST['tipo_mantenimiento'];
        $descripcion = $_POST['descripcion'];
        $estado_equipo = $_POST['estado_equipo'];
        $tecnico_id = $_POST['tecnico_id'];
        $cliente_id = $_POST['cliente_id'];

        $resultado = $this->modelo->modificarMantenimiento($mantenimiento_id, $fecha_mantenimiento, $tipo_mantenimiento, $descripcion, $estado_equipo, $tecnico_id, $cliente_id);

        if ($resultado) {
            header('Location: ../Views/Panel_Navegacion_MAN.php');
        } else {
            echo "Error al modificar el mantenimiento.";
        }
    }
}

$accion = $_GET['accion'] ?? $_POST['accion'] ?? '';
$controlador = new ControladorModificarMantenimiento();

if ($accion === 'buscar') {
    $controlador->buscarMantenimiento();
} elseif ($accion === 'modificar') {
    $controlador->modificarMantenimiento();
}
