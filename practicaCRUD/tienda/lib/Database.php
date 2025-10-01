<?php
namespace lib;
class Database{
    private $host = "db";
    private $db_name = "db_productos";
    private $username = "root";
    private $rootpass = "rootpass";
    public $conn;

    public function getConnection(){
        $this->conn = null;
        try {
            $this->conn = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name , $this->username, $this->rootpass);
            $this->conn->exec("set names utf8");
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            echo "Conectado";
        } catch (\PDOException $message) {
            echo "Error de conexion de tipo: " . $message->getMessage();
        }
        return $this->conn;
    }
}

?>