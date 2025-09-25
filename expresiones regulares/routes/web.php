<?php


use lib\Route;


Route::get("/", function(){
    echo "RUTA RAIZ";
});


Route::get("/inicio", function(){
    echo "Inicio";
});


Route::dispatch();




?>
