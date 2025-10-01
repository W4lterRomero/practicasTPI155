<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Lista de Productos' ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f8f9fa; }
        .container { max-width: 1200px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; }
        .btn { padding: 10px 15px; text-decoration: none; border-radius: 5px; margin: 5px; display: inline-block; }
        .btn-primary { background: #007bff; color: white; }
        .btn-success { background: #28a745; color: white; }
        .btn-danger { background: #dc3545; color: white; }
        .btn-warning { background: #ffc107; color: black; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f8f9fa; font-weight: bold; }
        tr:hover { background-color: #f5f5f5; }
        .alert { padding: 15px; margin-bottom: 20px; border-radius: 4px; }
        .alert-success { background-color: #d4edda; color: #155724; }
        .alert-danger { background-color: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <div class="container">
        <h1><?= $title ?? 'Lista de Productos' ?></h1>
        
        <?php if (isset($_GET['success']) && $_GET['success'] == 'deleted'): ?>
            <div class="alert alert-success">Producto eliminado exitosamente</div>
        <?php endif; ?>
        
        <?php if (isset($_GET['error']) && $_GET['error'] == 'delete_failed'): ?>
            <div class="alert alert-danger">Error al eliminar el producto</div>
        <?php endif; ?>
        
        <a href="/products/create" class="btn btn-primary">+ Crear Nuevo Producto</a>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= htmlspecialchars($product['id']) ?></td>
                            <td><?= htmlspecialchars($product['nombre']) ?></td>
                            <td><?= htmlspecialchars(substr($product['descripcion'], 0, 50)) ?>...</td>
                            <td>$<?= number_format($product['precio'], 2) ?></td>
                            <td><?= htmlspecialchars($product['stock']) ?></td>
                            <td><?= htmlspecialchars($product['categoria']) ?></td>
                            <td>
                                <a href="/products/<?= $product['id'] ?>" class="btn btn-primary">Ver</a>
                                <a href="/products/<?= $product['id'] ?>/edit" class="btn btn-warning">Editar</a>
                                <a href="/products/<?= $product['id'] ?>/delete" 
                                   onclick="return confirm('¿Está seguro de eliminar este producto?')" 
                                   class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 40px;">
                            <p>No hay productos disponibles</p>
                            <a href="/products/create" class="btn btn-primary">Crear el primer producto</a>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
