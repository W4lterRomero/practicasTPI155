<?php

use lib\Route;

    Route::get("/", function(){
        echo "Inicio";
    });

    Route::get("/inicio", function(){
        echo "Inicio";
    });

    Route::dispatch();
?>