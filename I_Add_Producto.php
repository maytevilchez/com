<?php
class Add_Producto {
    private $pdo;

    public function __construct($pdo) { 
        $this->pdo = $pdo;
    }

    public function agregar($numero_serie, $nombre_equipo, $marca, $tipo, $stock, $fecha_ingreso, $proveedor) {
        try {
            $sql = "INSERT INTO inventario (numero_serie, nombre_equipo, marca, tipo, stock, fecha_ingreso, proveedor)
                    VALUES (?, ?, ?, ?, ?, ?, ?)"; 
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$numero_serie, $nombre_equipo, $marca, $tipo, $stock, $fecha_ingreso, $proveedor]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function obtenerTodo() {
        try {
            // Realizamos el JOIN con la tabla proveedores para obtener el nombre del proveedor
            $stmt = $this->pdo->query("SELECT inventario.*, proveedores.proveedor FROM inventario LEFT JOIN proveedores ON inventario.proveedor = proveedores.id");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
}
