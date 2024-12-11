<?php
class C_Add_Cliente {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function agregar($nombre, $direccion, $telefono, $email) {
        try {
            $sql = "INSERT INTO clientes (nombre, direccion, telefono, email) 
                    VALUES (?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$nombre, $direccion, $telefono, $email]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function obtenerTodo() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM clientes");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
}
?>
