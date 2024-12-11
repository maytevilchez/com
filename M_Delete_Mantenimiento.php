<?php
class M_Delete_Mantenimiento {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function eliminar($mantenimiento_id) {
        try {
            $sql = "DELETE FROM mantenimiento WHERE mantenimiento_id = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$mantenimiento_id]);
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>
