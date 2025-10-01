<?php

use lib\Route;
use app\controller;
use app\controller\HomeController;
use app\controller\AuthController;

Route::get("/", function(){
    echo "RUTA RAIZ - Aplicación funcionando correctamente";
});

Route::get("/inicio", function(){
    echo "Página de Inicio";
});

Route::get("/home", [HomeController::class, 'index']);

Route::post("/login", [AuthController::class, 'login']);
Route::get("/login", [AuthController::class, 'loginForm']);


Route::dispatch();

?>
