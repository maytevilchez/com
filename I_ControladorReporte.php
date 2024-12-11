<?php
require_once 'C:/xampp/htdocs/Proyectos/Sistema_De_Inventario_Pecosol/Config/Database.php';
require_once 'C:/xampp/htdocs/Proyectos/Sistema_De_Inventario_Pecosol/App/Models/I_Reports_Inventario.php';
require_once 'C:/xampp/htdocs/Proyectos/Sistema_De_Inventario_Pecosol/Librería/dompdf/vendor/autoload.php';

use Dompdf\Dompdf;
date_default_timezone_set('America/Lima');

class ControladorReporte {
    private $reportes;

    public function __construct() {
        global $pdo;
        $this->reportes = new Reports_Inventario($pdo);
    }

    public function generarReporte($tipo, $parametros) {
        // Determina la acción a realizar
        $accion = $parametros['accion'] ?? 'ver';
    
        // Obtenemos los datos según el tipo de reporte
        $result = $this->obtenerDatosReporte($tipo, $parametros);
    
        if (!empty($result)) {
            if ($accion === 'descargar') {
                $this->generarPDF($result, $tipo);
            } else {
                // Cargar la vista HTML y pasar la variable $tipo a la vista
                include '../Views/I_Generar_Reporte.php';
            }
        } else {
            echo "<p>No se encontraron datos para este reporte.</p>";
        }
    }
    

    private function obtenerDatosReporte($tipo, $parametros) {
        switch ($tipo) {
            case 'stock_total':
                return $this->reportes->reporteStockTotal();
            case 'por_marca':
                return $this->reportes->reportePorMarca($parametros['marca'] ?? '');
            case 'por_proveedor':
                return $this->reportes->reportePorProveedor($parametros['proveedor'] ?? '');
            case 'nuevos_ingresos':
                return $this->reportes->reporteNuevosIngresos(
                    $parametros['fechaInicio'] ?? '',
                    $parametros['fechaFin'] ?? ''
                );
            case 'bajo_stock':
                return $this->reportes->reporteBajoStock($parametros['stockMinimo'] ?? 0);
            default:
                return [];
        }
    }

    private function generarPDF($datos, $tipoReporte) {
        $dompdf = new Dompdf();
    
        // Asegúrate de que los datos pasen correctamente a la vista
        ob_start();
        $inventario = $datos;  // Pasando los datos del reporte
        include '../Views/I_ReportePDF.php';  // Aquí se usa la vista que mostrará los datos
        $html = ob_get_clean();
    
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
    
        // Descargar el PDF generado
        $dompdf->stream("Reporte_$tipoReporte.pdf", ["Attachment" => true]);
    }
    
}

// Ejecutar la generación del reporte
$tipo = $_GET['tipo'] ?? '';
$parametros = $_GET;
$controlador = new ControladorReporte();
$controlador->generarReporte($tipo, $parametros);
?>
