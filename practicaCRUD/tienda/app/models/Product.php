<?php

namespace app\models;
use lib\Database;

class Product{

    private $conn;
    private $table = 'productos';
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
        
        // Debug temporal para ver qué pasa
        if ($this->conn === null) {
            die("ERROR CRÍTICO: No hay conexión a la base de datos");
        }
        
        echo "DEBUG: Conexión establecida correctamente<br>";
    }
    
    public function getAll(){
        try {
            if ($this->conn === null) {
                throw new \Exception("Conexión nula en getAll()");
            }
            
            $query = "SELECT * FROM {$this->table} ORDER BY id DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Error al obtener productos: " . $e->getMessage());
            echo "Error SQL: " . $e->getMessage();
            return [];
        }
    }
    //Obtener por ID
    public function getById($id){
        try {
            $query = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Error al obtener producto: " . $e->getMessage());
            return false;
        }
    }

    //CREAR
    public function create($data){
        try {
            $query = "INSERT INTO {$this->table} (nombre, descripcion, precio, stock, categoria, created_at) 
                      VALUES (:nombre, :descripcion, :precio, :stock, :categoria, NOW())";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':nombre', $data['nombre']);
            $stmt->bindParam(':descripcion', $data['descripcion']);
            $stmt->bindParam(':precio', $data['precio']);
            $stmt->bindParam(':stock', $data['stock']);
            $stmt->bindParam(':categoria', $data['categoria']);
            
            return $stmt->execute();
        } catch (\PDOException $e) {
            error_log("Error al crear producto: " . $e->getMessage());
            return false;
        }
    }
    // Eliminar producto
    public function delete($id) {
        try {
            $query = "DELETE FROM {$this->table} WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\PDOException $e) {
            error_log("Error al eliminar producto: " . $e->getMessage());
            return false;
        }
    }
       // Buscar productos por nombre o categoría
    public function search($term) {
        try {
            $query = "SELECT * FROM {$this->table} 
                      WHERE nombre LIKE :term OR categoria LIKE :term 
                      ORDER BY nombre";
            $stmt = $this->conn->prepare($query);
            $searchTerm = "%{$term}%";
            $stmt->bindParam(':term', $searchTerm);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Error en búsqueda: " . $e->getMessage());
            return [];
        }
    }
}
