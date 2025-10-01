<?php

namespace lib; // AGREGAR namespace

class View{
    public static function render($viewName, $data = []) {
        extract($data);
        
        // Construir la ruta de la vista
        $viewPath = __DIR__ . "/../app/views/{$viewName}.php";
        
        if (file_exists($viewPath)) {
            ob_start();
            include $viewPath;
            return ob_get_clean();
        }
        
        throw new \Exception("Vista no encontrada: {$viewName}");
    }
    
    public static function show($viewName, $data = []) {
        echo self::render($viewName, $data);
    }
}
?>