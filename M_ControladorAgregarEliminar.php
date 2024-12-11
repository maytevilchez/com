<?php
require_once __DIR__ . '/../../Config/Database.php';
require_once __DIR__ . '/../Models/M_Add_Mantenimiento.php';
require_once __DIR__ . '/../Models/M_Delete_Mantenimiento.php';

class M_ControladorAgregarEliminar {
    private $add_mantenimiento_model;
    private $delete_mantenimiento_model;

    public function __construct() {
        global $pdo;
        $this->add_mantenimiento_model = new M_Add_Mantenimiento($pdo);
        $this->delete_mantenimiento_model = new M_Delete_Mantenimiento($pdo);
    }

    public function gestionarMantenimiento() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $accion = $_POST['accion'] ?? '';
            if ($accion === 'agregar') {
                $this->agregarMantenimiento();
            } elseif ($accion === 'eliminar') {
                $this->eliminarMantenimiento();
            }
        }
    }

    private function agregarMantenimiento() {
        $codigo_producto = $_POST['codigo_producto'];
        $fecha_mantenimiento = $_POST['fecha_mantenimiento'];
        $tipo_mantenimiento = $_POST['tipo_mantenimiento'];
        $descripcion = $_POST['descripcion'];
        $tecnico_id = $_POST['tecnico_id'];
        $estado_equipo = $_POST['estado_equipo'];
        $cliente_id = $_POST['cliente_id'];
        $resultado = $this->add_mantenimiento_model->agregar($codigo_producto,$fecha_mantenimiento,$tipo_mantenimiento,$descripcion,$tecnico_id,
                                                              $estado_equipo,$cliente_id);

        if ($resultado) {
            header("Location: ../Views/Panel_Navegacion_MAN.php");
        } else {
            echo "Error al agregar el mantenimiento.";
        }
    }

    private function eliminarMantenimiento() {
        $mantenimiento_id = $_POST['mantenimiento_id'];

        $resultado = $this->delete_mantenimiento_model->eliminar($mantenimiento_id);

        if ($resultado) {
            header("Location: ../Views/Panel_Navegacion_MAN.php");
        } else {
            echo "Error al eliminar el mantenimiento.";
        }
    }
}

$controlador = new M_ControladorAgregarEliminar();
$controlador->gestionarMantenimiento();
?>
