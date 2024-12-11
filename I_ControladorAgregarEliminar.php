<?php
// Incluir la configuración de la base de datos y el modelo Add_Producto
require_once 'C:/xampp/htdocs/Proyectos/Sistema_De_Inventario_Pecosol/Config/Database.php';
require_once 'C:/xampp/htdocs/Proyectos/Sistema_De_Inventario_Pecosol/App/Models/I_Add_Producto.php';
require_once 'C:/xampp/htdocs/Proyectos/Sistema_De_Inventario_Pecosol/App/Models/I_Delete_Producto.php';

class ControladorAgregarEliminar {
    private $add_producto_model;
    private $delete_producto_model;

    public function __construct() {
        global $pdo;
        $this->add_producto_model = new Add_Producto($pdo);
        $this->delete_producto_model = new Delete_Producto($pdo);
    }

    public function gestionarProducto() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $accion = $_POST['accion'] ?? '';
            if ($accion === 'agregar') {
                $this->agregarProducto();
            } elseif ($accion === 'eliminar') {
                $this->eliminarProducto();
            }
        }
    }

    private function agregarProducto() {
        $numero_serie = $_POST['numero_serie'];
        $nombre_equipo = $_POST['nombre_equipo'];
        $marca = $_POST['marca'];
        $tipo = $_POST['tipo'];
        $stock = $_POST['stock'];
        $fecha_ingreso = $_POST['fecha_ingreso'];
        $proveedor = $_POST['proveedor'];  // Aquí se obtiene el ID del proveedor

        $resultado = $this->add_producto_model->agregar($numero_serie, $nombre_equipo, $marca, $tipo, $stock, $fecha_ingreso, $proveedor);

        if ($resultado) {
            header("Location: ../Views/Panel_Navegacion.php");
        } else {
            echo "Error al agregar el producto.";
        }
    }

    private function eliminarProducto() {
        $numero_serie = $_POST['numero_serie'];
        $resultado = $this->delete_producto_model->eliminar($numero_serie);

        if ($resultado) {
            header("Location: ../Views/Panel_Navegacion.php");
        } else {
            echo "Error al eliminar el producto.";
        }
    }
}

$controlador = new ControladorAgregarEliminar();
$controlador->gestionarProducto();
