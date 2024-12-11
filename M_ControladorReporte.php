<?php
require_once 'C:/xampp/htdocs/Proyectos/Sistema_De_Inventario_Pecosol/Config/Database.php';
require_once 'C:/xampp/htdocs/Proyectos/Sistema_De_Inventario_Pecosol/App/Models/M_Reports_Mantenimiento.php';
require_once 'C:/xampp/htdocs/Proyectos/Sistema_De_Inventario_Pecosol/Librería/dompdf/vendor/autoload.php';

use Dompdf\Dompdf;

class M_ControladorReporte {
    private $reportes;

    public function __construct() {
        global $pdo;
        $this->reportes = new Reports_Mantenimiento($pdo);
    }

    public function generarReporte($tipo, $parametros) {
        $accion = $parametros['accion'] ?? 'ver'; // Aseguramos que la acción esté vacía si no se selecciona

        // Verificamos si el tipo de reporte y la acción son válidos
        if ($tipo && $accion) {
            // Validamos si se deben obtener parámetros adicionales
            $mantenimientos = $this->obtenerDatosReporte($tipo, $parametros);

            if (!empty($mantenimientos)) {
                if ($accion === 'descargar') {
                    $this->generarPDF($mantenimientos, $tipo);
                } else {
                    include '../Views/M_Generar_Reporte.php';  // Vista para mostrar resultados
                }
            } else {
                echo "<p>No se encontraron datos para este reporte.</p>";
            }
        } else {
            echo "<p>Error: No se seleccionó tipo de reporte o acción.</p>";
        }
    }

    private function obtenerDatosReporte($tipo, $parametros) {
        switch ($tipo) {
            case 'mantenimientos':
                return $this->reportes->reporteMantenimientos();
            case 'por_tipo':
                return isset($parametros['tipo_mantenimiento']) ? $this->reportes->reportePorTipo($parametros['tipo_mantenimiento']) : [];
            case 'por_tecnico':
                return isset($parametros['tecnico_nombre']) ? $this->reportes->reportePorTecnicoNombre($parametros['tecnico_nombre']) : [];
            case 'por_fecha':
                return isset($parametros['fechaInicio'], $parametros['fechaFin']) ? $this->reportes->reportePorFecha($parametros['fechaInicio'], $parametros['fechaFin']) : [];
            default:
                return [];
        }
    }
    

    private function generarPDF($datos, $tipoReporte) {
        $dompdf = new Dompdf();

        ob_start();
        $mantenimientos = $datos;  // Pasando los datos del reporte
        include '../Views/M_ReportePDF.php';  // Vista para el reporte en PDF
        $html = ob_get_clean();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $dompdf->stream("Reporte_$tipoReporte.pdf", ["Attachment" => true]);
    }

    // Acción para obtener los técnicos desde la base de datos
    public function obtenerTecnicos() {
        return $this->reportes->obtenerTecnicos();
    }
}
// Ejecutar la generación del reporte
$tipo = $_GET['tipo'] ?? '';
$parametros = $_GET;
$controlador = new M_ControladorReporte();
$controlador->generarReporte($tipo, $parametros);
?>
