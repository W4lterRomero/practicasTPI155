<?php


namespace app\controllers;
use app\models\Persona_model;
use lib\Controller;
class HomeController extends Controller{
    public function index(){

        $persona = new Persona_model();
        $data = $persona->getPersona();

        echo $this->view("HomeView", ['title' => 'MiVista', 'data' => $data]);
    }
/*     public function view(){
        return "funcion view";
    } */
   public function mostrarFormulario(){
       echo $this->view("formularioView", ['title' => 'Formulario de Persona']);
   }
   public function recibirFormulario(){
    if(isset($_POST) && !empty($_POST)){
        $persona = new Persona_model();
        $persona->guardarPersona($_POST);
        header("Location: /public/Home");
        exit;
    }
   }
   public function buscarId($idPersona){
    $persona = new Persona_model();
    $data = $persona->getPersonaid($idPersona);
    return json_encode($data);
   }
   

}


?>
