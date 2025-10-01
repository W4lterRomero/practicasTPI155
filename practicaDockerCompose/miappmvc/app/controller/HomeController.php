<?php

namespace app\controller;

class HomeController {
    
    public function index(){
        echo $this->view("HomeView", ['title'=>'MiVista']);
    }

    // Simple view method implementation
    protected function view($viewName, $data = []) {
        extract($data);
        $viewFile = __DIR__ . "/../view/{$viewName}.php";
        if (file_exists($viewFile)) {
            ob_start();
            include $viewFile;
            return ob_get_clean();
        } else {
            return "View file not found: {$viewName}";
        }
    }
    
    
}
?>