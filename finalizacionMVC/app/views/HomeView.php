<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-head">
                <p>Lista de Personas</p>
            </div>
            <div class="card-body">
                <a href="formulario" class="btn btn-success mb-3">Agregar Nueva Persona</a>
                
<table>
    <thead>
        <th>
    ID
        </th>
        <th>
            Nombre
        </th>
        <th>
            Direccion
        </th>
    </thead>
    <tbody>
        <?php foreach($data as $item): ?>
            <tr>
                <td><?php echo $item['idPersona'] ?></td>
                <td><?php echo $item['nombre'] ?></td>
                <td><?php echo $item['direccion'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
            </div>
        </div>
    </div>
</body>
</html>