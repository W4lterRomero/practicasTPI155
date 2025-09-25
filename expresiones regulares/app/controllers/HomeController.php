<?php


namespace app\controllers;

class HomeController{
    public function index(){
        echo $this->view("HomeView");
    }
/*     public function view(){
        return "funcion view";
    } */
    public function view($vista){
        //require_once("../app/views/HomeView.php");
        if(file_exists("../app/views/$vista.php")){
            ob_start();
            include "../app/views/$vista.php";
            $content = ob_get_clean();
            return $content;
        }
        else{
            echo "vista no encotrada ../app/views/$vista.php";
            return;
        }
        return "hola desde la pagina Home";


    }

}


?>
