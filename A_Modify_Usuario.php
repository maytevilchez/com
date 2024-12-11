<?php
class A_Modify_Usuario {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Obtener usuario por ID
    public function obtenerPorID($user_id) {
        try {
            $stmt = $this->pdo->prepare("SELECT id, username, role FROM users WHERE id = ?");
            $stmt->execute([$user_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }

    // Modificar usuario
    public function modificar($user_id, $username, $role, $password) {
        try {
            if ($password) {
                $sql = "UPDATE users SET username = ?, role = ?, password = ? WHERE id = ?";
                $stmt = $this->pdo->prepare($sql);
                return $stmt->execute([$username, $role, $password, $user_id]);
            } else {
                $sql = "UPDATE users SET username = ?, role = ? WHERE id = ?";
                $stmt = $this->pdo->prepare($sql);
                return $stmt->execute([$username, $role, $user_id]);
            }
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>
