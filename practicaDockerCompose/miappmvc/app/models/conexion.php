<?php

class Database
{
    private $host = "db";
    private $db_name = "productos";
    private $username = "root";
    private $password = "rootpass";
    public $conn;/* 

    public function getConnection(){
        
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name,$this->username,$this->password);
            $this->conn->exec("set names utf8");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "conectado";
            //mysql:host=db;dbname=productosrootrootpass
            //esto es lo que quire decir mi código?
        } catch (PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn; */

    /* public function getConnection(){
            $this->conn = null;

            try {
                $this->conn = new PDO("mysql:host=" .$this->host . ";dbname=" .$this->db_name,$this->username,$this->password);
                $this->conn->exec("set names utf8");
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Conectado";
            } catch (PDOException $exception) {
                echo "ERROR: " . $exception->getMessage();
            }
            return $this->conn;
        } */
    /* public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            echo "Conectado";
        } catch (PDOException $message) {
            echo "Error encontrado en la conexión " . $message->getMessage();
        }
    } */

        public function getConnection(){
            $this->conn = null;

            try {
                // CORREGIDO: Agregado el = después de host
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                echo "Conectado";
            } catch (PDOException $message) {
                echo "Error en la conexion a la base de datos: " .$message->getMessage();
            }
            
            // CORREGIDO: Agregado return para devolver la conexión
            return $this->conn;
        }
}
