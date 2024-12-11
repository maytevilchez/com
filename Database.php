<?php
try {
    $host = 'localhost:3000';
    $dbname = 'inventario_pecosol';
    $username = 'root';
    $password = '';
    
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $username,
        $password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    die();
}
