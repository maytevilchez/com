<?php
class A_Add_Usuario {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function agregarUsuario($username, $password, $role) {
        try {
            // Hash de la contraseña
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Inserción en la base de datos
            $sql = "INSERT INTO users (username, password, role) VALUES (:username, :password, :role)";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                ':username' => $username,
                ':password' => $hashedPassword,
                ':role' => $role
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function obtenerUsuarios() {
        try {
            $stmt = $this->pdo->query("SELECT id, username, role FROM users");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
}
?>
