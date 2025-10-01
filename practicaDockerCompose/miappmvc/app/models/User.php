<?php

namespace app\models;

class User {
    private $conn;
    
    public function __construct() {
        require_once __DIR__ . '/database.php';
        $database = new \Database();
        $this->conn = $database->getConnection();
    }
    
    // Buscar usuario por username
    public function findByUsername($username) {
        $query = "SELECT * FROM usuarios WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    
    // Verificar contraseña
    public function verifyPassword($password, $hashedPassword) {
        return password_verify($password, $hashedPassword);
    }
    
    // Método temporal para testing sin BD
    public function authenticate($username, $password) {
        // Para pruebas rápidas sin BD
        if ($username === 'admin' && $password === '123') {
            return [
                'id' => 1,
                'username' => 'admin',
                'email' => 'admin@test.com'
            ];
        }
        return false;
    }
}

?>