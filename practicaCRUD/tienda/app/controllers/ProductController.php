<?php

namespace app\controllers;
use app\models\Product;
use lib\View;

class ProductController{

    public function index(){
        $productModel = new Product();
        $products = $productModel->getAll();

        View::render('products/index', [
            'products' => $products,
            'title' => 'Lista de Productos'
        ]);
    }
    public function create(){
        View::render('products/create',[
            'title' => 'Crear Producto'
        ]);
    }
    public function store(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $productModel = new Product();
            $data = [
                'nombre' => $_POST['nombre'] ?? '',
                'descripcion' => $_POST['descripcion'] ?? '',
                'precio' => $_POST['precio'] ?? 0,
                'stock' => $_POST['stock'] ?? 0,
                'categoria' => $_POST['categoria'] ?? ''
            ];
            if($productModel->create($data)){
                echo "producto creado";
            }
        }
    }
    public function show($id){
        $productModel = new Product();
        $product = $productModel->getById($id);
        if($product){
            View::render('products/show',[
                'product' => $product,
                'title' => 'Detalle del producto'
            ]);
        }
    }
    // Eliminar producto (DELETE)
    public function delete($id) {
        $productModel = new Product();
        
        if ($productModel->delete($id)) {
            header('Location: /products?success=deleted');
            exit();
        } else {
            header('Location: /products?error=delete_failed');
            exit();
        }
    }
    // Mostrar formulario de edición
    public function edit($id) {
        $productModel = new Product();
        $product = $productModel->getById($id);
        
        if ($product) {
            View::show('products/edit', [
                'product' => $product,
                'title' => 'Editar Producto'
            ]);
        } else {
            header('Location: /products?error=not_found');
            exit();
        }
    }
    
    // Actualizar producto
    public function update($id) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $productModel = new Product();
            
            $data = [
                'nombre' => $_POST['nombre'] ?? '',
                'descripcion' => $_POST['descripcion'] ?? '',
                'precio' => $_POST['precio'] ?? 0,
                'stock' => $_POST['stock'] ?? 0,
                'categoria' => $_POST['categoria'] ?? ''
            ];
            
            if ($productModel->update($id, $data)) {
                header('Location: /products?success=updated');
                exit();
            } else {
                header('Location: /products/' . $id . '/edit?error=update_failed');
                exit();
            }
        }
    }


}

?>