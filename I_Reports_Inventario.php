<?php
class Reports_Inventario {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Reporte de Stock Total
    public function reporteStockTotal() {
        $stmt = $this->pdo->query("SELECT inventario.*, proveedores.proveedor FROM inventario LEFT JOIN proveedores ON inventario.proveedor = proveedores.id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Reporte de Equipos por Marca
    public function reportePorMarca($marca) {
        $stmt = $this->pdo->prepare("SELECT inventario.*, proveedores.proveedor FROM inventario LEFT JOIN proveedores ON inventario.proveedor = proveedores.id WHERE inventario.marca = ?");
        $stmt->execute([$marca]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Reporte de Equipos por Proveedor
    public function reportePorProveedor($proveedor) {
        $stmt = $this->pdo->prepare("SELECT inventario.*, proveedores.proveedor FROM inventario LEFT JOIN proveedores ON inventario.proveedor = proveedores.id WHERE proveedores.proveedor = ?");
        $stmt->execute([$proveedor]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Reporte de Nuevos Ingresos
    public function reporteNuevosIngresos($fechaInicio, $fechaFin) {
        $stmt = $this->pdo->prepare("SELECT inventario.*, proveedores.proveedor FROM inventario LEFT JOIN proveedores ON inventario.proveedor = proveedores.id WHERE inventario.fecha_ingreso BETWEEN ? AND ?");
        $stmt->execute([$fechaInicio, $fechaFin]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Reporte de Equipos en Bajo Stock
    public function reporteBajoStock($stockMinimo) {
        $stmt = $this->pdo->prepare("SELECT inventario.*, proveedores.proveedor FROM inventario LEFT JOIN proveedores ON inventario.proveedor = proveedores.id WHERE inventario.stock <= ?");
        $stmt->execute([$stockMinimo]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
