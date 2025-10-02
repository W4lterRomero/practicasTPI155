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

#funcion para crear la conexión de la base de datos, so docker es bastante interesante e importante
#nota: hacer mi propia imagen de docker para descargarla cuando la necesite
$database = new Database();
$contenTemporal = $database->getConnection();
$nombre = "BryAN";
$direccion = "MOrazÀN";
$edad = 25;
 $statement = $contenTemporal->prepare("INSERT INTO tbl_persona(nombre,direccion,edad) VALUES (?,?,?)");
/*$statement->bindParam(1,$nombre);
$statement->bindParam(2,$direccion);
$statement->bindParam(3, $edad);
 */
/* $statement = $contenTemporal->prepare("INSERT INTO tbl_persona(nombre,direccion,edad) VALUES (:nombre,:direccion,:edad)");
$statement->bindParam(":nombre",$nombre);
$statement->bindParam(":direccion",$direccion);
$statement->bindParam(":edad", $edad);
 */
/* $data =$statement->execute(array(":nombre" => $nombre, ":direccion" => $direccion, ":edad" =>$edad)); 
if($data){
    echo "INSERTADO";
}; */
//Este ejercicio tienes que replicarlo pero con un formulario
//Hacerlo tambien a traves de un array

$persona_obj = new Persona();
/* $persona_obj->nombre = "Gerson";
$persona_obj->direccion = "San Miguel";
$persona_obj->edad = 40;

if($statement->execute((array)$persona_obj)){
    echo "INSERTADO";
}
 */
$statement->execute();

?>
