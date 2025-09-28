<?php

use lib\Route;
use app\controller\HomeController;

Route::get("/", function(){
    echo "RUTA RAIZ - Aplicación funcionando correctamente";
});

Route::get("/inicio", function(){
    echo "Página de Inicio";
});

Route::get("/home", [HomeController::class, 'index']);

        

Route::dispatch();

?>
