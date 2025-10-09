<?php 

namespace app\models;

use Database;
use PDOException;

class Persona_model extends Database{

    public function getPersona(){
        $conexion = $this->getConnection();
        $sql = $conexion->query("SELECT * FROM tbl_persona");
        return $sql->fetchAll();
    }

    public function guardarPersona($data){
        try {
            $conexion = $this->getConnection();
            $statement = $conexion->prepare("INSERT INTO tbl_persona (nombre, direccion, edad) VALUES (:nombre, :direccion, :edad)");
            $statement->bindParam(":nombre", $data['nombre']);
            $statement->bindParam(":direccion", $data['direccion']);
            $statement->bindParam(":edad", $data['edad']);
            return $statement->execute();
        } catch (PDOException $e) {
            error_log("Error al guardar persona: " . $e->getMessage());
            return false;
        }
    }
     public function getPersonaid($id){
        $conexion = $this->getConnection();
        $statement = $conexion->prepare("SELECT * FROM tbl_persona WHERE idPersona = ?");
        $statement->execute([$id]);
        return $statement->fetch();
    }
}


?>