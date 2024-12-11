<?php
class P_Modify_Proveedor {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Obtener proveedor por ID
    public function obtenerPorId($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM proveedores WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }

    // Modificar los datos del proveedor
    public function modificar($id, $proveedor, $direccion, $telefono, $email) {
        try {
            $sql = "UPDATE proveedores SET proveedor = ?, direccion = ?, telefono = ?, email = ? WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$proveedor, $direccion, $telefono, $email, $id]);
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>
