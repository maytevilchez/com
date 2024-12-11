<?php
class A_Reports_Usuario {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Método para obtener todos los usuarios
    public function reporteUsuarios() {
        $stmt = $this->pdo->query("SELECT id, username, role FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para obtener usuarios por rol específico o todos los roles
    public function reportePorRol($role = null) {
        if ($role) {
            $stmt = $this->pdo->prepare("SELECT id, username, role FROM users WHERE role = :role");
            $stmt->bindParam(':role', $role);
        } else {
            $stmt = $this->pdo->query("SELECT role, COUNT(*) as total FROM users GROUP BY role");
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
