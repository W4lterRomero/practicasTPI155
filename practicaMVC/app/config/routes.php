<?php

use core\Route;


Route::get("/", function () {
    echo "RUTA RAIZ";
});

Route::get("/inicio", function () {
    require_once("../app/views/index.php");
});

Route::dispatch();

?>