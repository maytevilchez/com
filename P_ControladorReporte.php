<?php
require_once 'C:/xampp/htdocs/Proyectos/Sistema_De_Inventario_Pecosol/Config/Database.php';
require_once 'C:/xampp/htdocs/Proyectos/Sistema_De_Inventario_Pecosol/App/Models/P_Reports_Proveedor.php';
require_once 'C:/xampp/htdocs/Proyectos/Sistema_De_Inventario_Pecosol/Librería/dompdf/vendor/autoload.php';

use Dompdf\Dompdf;
date_default_timezone_set('America/Lima');

class P_ControladorReporte {
    private $reportes;

    public function __construct() {
        global $pdo;
        $this->reportes = new P_Reports_Proveedor($pdo);
    }

    public function generarReporte() {
        // Obtener todos los proveedores
        $result = $this->obtenerDatosReporte();

        if (!empty($result)) {
            $this->generarPDF($result);  // Generar y descargar el PDF
        } else {
            echo "<p>No se encontraron datos para este reporte.</p>";
        }
    }

    private function obtenerDatosReporte() {
        // Obtener todos los proveedores desde la base de datos
        return $this->reportes->reporteTodosLosProveedores();
    }

    private function generarPDF($datos) {
        $dompdf = new Dompdf();

        // Renderizar la vista del PDF
        ob_start();
        include '../Views/P_ReportePDF.php'; // Archivo que contiene la plantilla del PDF
        $html = ob_get_clean();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');  // Formato vertical para el reporte
        $dompdf->render();

        // Descargar el PDF
        $dompdf->stream("Reporte_Proveedores.pdf", ["Attachment" => true]);
    }
}

// Ejecutar la generación del reporte
$controlador = new P_ControladorReporte();
$controlador->generarReporte();
?>
