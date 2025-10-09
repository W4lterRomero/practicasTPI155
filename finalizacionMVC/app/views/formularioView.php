<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Formulario'; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main class="container p-4">
        <div class="card">
            <div class="card-head">
                <p>Insertar</p>
            </div>
            <div class="card-body">
                <h1><b>Insertar nuevas personas</b></h1>
                <form action="save" method="POST">
                    <div class="form-group">
                        <label for="">Escriba el nombre</label>
                        <input type="text" class="nombre" name = "nombre">
                    </div>
                    <div class="form-group">
                        <label for="">Escriba la direccion</label>
                        <input type="text" class="nombre" name = "direccion">
                    </div>
                    <div class="form-group">
                        <label for="">Escriba la edad</label>
                        <input type="text" class="nombre" name = "edad">
                    </div>
                    <input type="submit" class="btn btn-success btn-block" value="Guardar">
                </form>
            </div>
        </div>
        
    </main>
    
</body>
</html>