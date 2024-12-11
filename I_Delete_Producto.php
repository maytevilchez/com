<?php
class Delete_Producto {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function eliminar($numero_serie) {
        try {
            $sql = "DELETE FROM inventario WHERE numero_serie = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$numero_serie]);
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>
