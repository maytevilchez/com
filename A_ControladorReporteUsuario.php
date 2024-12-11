<?php
require_once 'C:/xampp/htdocs/Proyectos/Sistema_De_Inventario_Pecosol/Config/Database.php';
require_once 'C:/xampp/htdocs/Proyectos/Sistema_De_Inventario_Pecosol/App/Models/A_Reports_Usuario.php';
require_once 'C:/xampp/htdocs/Proyectos/Sistema_De_Inventario_Pecosol/Librería/dompdf/vendor/autoload.php';

use Dompdf\Dompdf;
date_default_timezone_set('America/Lima');

class A_ControladorReporteUsuario {
    private $reportes;

    public function __construct() {
        global $pdo;
        $this->reportes = new A_Reports_Usuario($pdo);
    }

    public function generarReporte($tipo) {
        // Obtenemos los datos del reporte
        $result = $this->obtenerDatosReporte($tipo);

        if (!empty($result)) {
            if ($_GET['accion'] === 'descargar') {
                $this->generarPDF($result, $tipo);
            } else {
                include '../Views/A_Generar_Reporte.php';
            }
        } else {
            echo "<p>No se encontraron datos para este reporte.</p>";
        }
    }

    private function obtenerDatosReporte($tipo) {
        // Obtener el rol si se seleccionó
        $role = $_GET['role'] ?? null;

        switch ($tipo) {
            case 'usuarios':
                return $this->reportes->reporteUsuarios();
            case 'roles':
                if ($role) {
                    return $this->reportes->reportePorRol($role); // Pasamos el rol seleccionado
                } else {
                    return $this->reportes->reportePorRol(); // Sin rol específico
                }
            default:
                return [];
        }
    }

    private function generarPDF($datos, $tipoReporte) {
        $dompdf = new Dompdf();

        ob_start();
        $usuarios = $datos;
        include '../Views/A_ReportePDF.php';
        $html = ob_get_clean();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream("Reporte_$tipoReporte.pdf", ["Attachment" => true]);
    }
}

// Ejecutar
$tipo = $_GET['tipo'] ?? '';
$controlador = new A_ControladorReporteUsuario();
$controlador->generarReporte($tipo);
?>
