<?php
require_once 'C:/xampp/htdocs/Proyectos/Sistema_De_Inventario_Pecosol/Config/Database.php';
require_once 'C:/xampp/htdocs/Proyectos/Sistema_De_Inventario_Pecosol/App/Models/I_Modify_Producto.php';

class ControladorModificarProducto {
    private $modelo;

    public function __construct() {
        global $pdo;
        $this->modelo = new Modify_Producto($pdo);
    }

    public function buscarProducto() {
        $numero_serie = $_GET['numero_serie'] ?? '';
        $producto = $this->modelo->obtenerPorNumeroSerie($numero_serie);
        $proveedores = $this->modelo->obtenerProveedores(); // Obtener la lista de proveedores
        include '../Views/I_Modificar_Producto.php'; // Pasar los proveedores a la vista
    }    

    public function modificarProducto() {
        $numero_serie = $_POST['numero_serie'];
        $nombre_equipo = $_POST['nombre_equipo'];
        $marca = $_POST['marca'];
        $tipo = $_POST['tipo'];
        $stock = $_POST['stock'];
        $fecha_ingreso = $_POST['fecha_ingreso'];
        $proveedor = $_POST['proveedor'];

        $resultado = $this->modelo->modificar($numero_serie, $nombre_equipo, $marca, $tipo, $stock, $fecha_ingreso, $proveedor);

        if ($resultado) {
            header('Location: ../Views/Panel_Navegacion.php');
        } else {
            echo "Error al modificar el producto.";
        }
    }
}

$accion = $_GET['accion'] ?? $_POST['accion'] ?? '';
$controlador = new ControladorModificarProducto();

if ($accion === 'buscar') {
    $controlador->buscarProducto();
} elseif ($accion === 'modificar') {
    $controlador->modificarProducto();
}
