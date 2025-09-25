<?php


use lib\Route;


Route::get("/", function(){
    echo "RUTA RAIZ";
});


Route::get("/inicio", function(){
    echo "Inicio";
});
//ruta con paramaetros para enviar a la funcion
//el nombre de flag despues de lo s: tiene que ser el mismo que el que reciba la función
Route::get("/inicio/:flag", function($flag){
    return  array('nombre'=>"Walter");
});


Route::dispatch();




?>
