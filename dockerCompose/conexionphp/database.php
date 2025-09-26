<?php

    class Database {
    private $host = "db";
    private $db_name = "db_estudiantes"; #nombre de la base de datos
    private $username = "root";
    private $password = "rootpass";
    public $conn; #conexion siempre debe ir dentro de un try catch


   
    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "conectado";
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }
}

$database = new Database();
$database->getConnection();



?>
