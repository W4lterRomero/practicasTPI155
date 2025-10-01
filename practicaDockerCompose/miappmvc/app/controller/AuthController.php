<?php

namespace app\controller;
use app\models\User;
class AuthController {
    
    public function loginForm(){
        echo $this->renderView("loginForm", []);
    }
    public function login(){
        $username = null;
        $password = null;
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $username = $_POST['username'] ??  '';
            
            $password = $_POST['password'] ??  '';

            if(empty($username) || empty($password)){
                echo $this->renderView("LoginForm", [
                    'error' => 'Todos los campos son obligatorios'
                ]);
                return;
            }
            $userModel = new User();
          $user = $userModel->authenticate($username,$password);
        if($user){
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            header('Location: /dashboard');
            exit();
        }
        else{
            echo $this->renderView("loginForm", [
                    'error' => 'Credenciales incorrectas'
          ]);
          }
        }
        
    }
    public function renderView($viewName, $data = []){
        extract($data);
        $viewPath = __DIR__ . "/../views/{$viewName}.php";

        if(file_exists($viewPath)){
            ob_start();
            include $viewPath;
            return ob_get_clean();
        }
        return "vista no encontrada ";
    }
}
?>