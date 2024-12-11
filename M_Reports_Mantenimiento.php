<?php
class Reports_Mantenimiento {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Obtener todos los mantenimientos
    public function reporteMantenimientos() {
        $stmt = $this->pdo->prepare("
            SELECT 
                mantenimiento.mantenimiento_id,
                mantenimiento.fecha_mantenimiento,
                inventario.numero_serie,
                mantenimiento.tipo_mantenimiento,
                mantenimiento.descripcion,
                users.username AS tecnico_nombre,
                mantenimiento.estado_equipo,
                clientes.nombre AS cliente_nombre
            FROM mantenimiento
            LEFT JOIN inventario ON mantenimiento.codigo_producto = inventario.id
            LEFT JOIN users ON mantenimiento.tecnico_id = users.id
            LEFT JOIN clientes ON mantenimiento.cliente_id = clientes.cliente_id
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function reportePorTipo($tipo_mantenimiento) {
        $stmt = $this->pdo->prepare("
            SELECT 
                mantenimiento.mantenimiento_id,
                mantenimiento.fecha_mantenimiento,
                inventario.numero_serie,
                mantenimiento.tipo_mantenimiento,
                mantenimiento.descripcion,
                users.username AS tecnico_nombre,
                mantenimiento.estado_equipo,
                clientes.nombre AS cliente_nombre
            FROM mantenimiento
            LEFT JOIN inventario ON mantenimiento.codigo_producto = inventario.id
            LEFT JOIN users ON mantenimiento.tecnico_id = users.id
            LEFT JOIN clientes ON mantenimiento.cliente_id = clientes.cliente_id
            WHERE mantenimiento.tipo_mantenimiento = :tipo_mantenimiento
        ");
        $stmt->bindParam(':tipo_mantenimiento', $tipo_mantenimiento);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

// Obtener mantenimientos por técnico (por nombre)
public function reportePorTecnicoNombre($tecnicoNombre) {
    // Consulta SQL para buscar técnicos por nombre (usando LIKE para coincidencias parciales)
    $stmt = $this->pdo->prepare("
        SELECT 
            mantenimiento.mantenimiento_id,
            mantenimiento.fecha_mantenimiento,
            inventario.numero_serie,
            mantenimiento.tipo_mantenimiento,
            mantenimiento.descripcion,
            users.username AS tecnico_nombre,
            mantenimiento.estado_equipo,
            clientes.nombre AS cliente_nombre
        FROM mantenimiento
        LEFT JOIN inventario ON mantenimiento.codigo_producto = inventario.id
        LEFT JOIN users ON mantenimiento.tecnico_id = users.id
        LEFT JOIN clientes ON mantenimiento.cliente_id = clientes.cliente_id
        WHERE users.username LIKE ?
    ");
    $stmt->execute(['%' . $tecnicoNombre . '%']);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    public function reportePorFecha($fechaInicio, $fechaFin) {
        $stmt = $this->pdo->prepare("
            SELECT 
                mantenimiento.mantenimiento_id,
                mantenimiento.fecha_mantenimiento,
                inventario.numero_serie,
                mantenimiento.tipo_mantenimiento,
                mantenimiento.descripcion,
                users.username AS tecnico_nombre,
                mantenimiento.estado_equipo,
                clientes.nombre AS cliente_nombre
            FROM mantenimiento
            LEFT JOIN inventario ON mantenimiento.codigo_producto = inventario.id
            LEFT JOIN users ON mantenimiento.tecnico_id = users.id
            LEFT JOIN clientes ON mantenimiento.cliente_id = clientes.cliente_id
            WHERE mantenimiento.fecha_mantenimiento BETWEEN :fechaInicio AND :fechaFin
        ");
        $stmt->bindParam(':fechaInicio', $fechaInicio);
        $stmt->bindParam(':fechaFin', $fechaFin);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Obtener técnicos de la base de datos (solo aquellos con el rol "tecnico")
    public function obtenerTecnicos() {
        $stmt = $this->pdo->query("SELECT id, username FROM users WHERE role = 'tecnico'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
