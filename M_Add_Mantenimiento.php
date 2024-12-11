<?php
class M_Add_Mantenimiento {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function agregar($codigo_producto, $fecha_mantenimiento, $tipo_mantenimiento, $descripcion, $tecnico_id, $estado_equipo, $cliente_id) {
        try {
            $sql = "INSERT INTO mantenimiento (codigo_producto, fecha_mantenimiento, tipo_mantenimiento, descripcion, tecnico_id, estado_equipo, cliente_id) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                $codigo_producto,
                $fecha_mantenimiento,
                $tipo_mantenimiento,
                $descripcion,
                $tecnico_id,
                $estado_equipo,
                $cliente_id
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function obtenerTodo() {
        try {
            $sql = "SELECT 
                        m.mantenimiento_id, 
                        i.numero_serie AS nombre_producto, 
                        u.username AS nombre_tecnico, 
                        c.nombre AS nombre_cliente, 
                        m.fecha_mantenimiento, 
                        m.tipo_mantenimiento, 
                        m.descripcion, 
                        m.estado_equipo
                    FROM mantenimiento m
                    LEFT JOIN inventario i ON m.codigo_producto = i.id
                    LEFT JOIN users u ON m.tecnico_id = u.id
                    LEFT JOIN clientes c ON m.cliente_id = c.cliente_id";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
    

    public function obtenerOpciones($tabla) {
        try {
            $sql = "SELECT * FROM $tabla";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
}
?>
