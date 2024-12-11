<?php
class Modify_Mantenimiento {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function obtenerMantenimientoPorId($mantenimiento_id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM mantenimiento WHERE mantenimiento_id = ?");
            $stmt->execute([$mantenimiento_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }

    public function obtenerTecnicos() {
        try {
            $stmt = $this->pdo->query("SELECT id, username FROM users WHERE role = 'tecnico'");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function obtenerClientes() {
        try {
            $stmt = $this->pdo->query("SELECT cliente_id, nombre FROM clientes");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function modificarMantenimiento($mantenimiento_id, $fecha_mantenimiento, $tipo_mantenimiento, $descripcion, $estado_equipo, $tecnico_id, $cliente_id) {
        try {
            $sql = "UPDATE mantenimiento SET fecha_mantenimiento = ?, tipo_mantenimiento = ?, descripcion = ?, estado_equipo = ?, tecnico_id = ?, cliente_id = ? 
                    WHERE mantenimiento_id = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$fecha_mantenimiento, $tipo_mantenimiento, $descripcion, $estado_equipo, $tecnico_id, $cliente_id, $mantenimiento_id]);
        } catch (PDOException $e) {
            return false;
        }
    }
}
