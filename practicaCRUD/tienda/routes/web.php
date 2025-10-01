<?php

use lib\Route;
use app\controllers\ProductController;

Route::get("/", function(){
    header('Location: /products');
    exit();
});

Route::get("/products", [ProductController::class, 'index']);
Route::get("/products/create", [ProductController::class, 'create']);
Route::post("/products", [ProductController::class, 'store']);
Route::get("/products/{id}", [ProductController::class, 'show']);
Route::get("/products/{id}/edit", [ProductController::class, 'edit']);
Route::post("/products/{id}/update", [ProductController::class, 'update']);
Route::get("/products/{id}/delete", [ProductController::class, 'delete']);

Route::dispatch();
?>