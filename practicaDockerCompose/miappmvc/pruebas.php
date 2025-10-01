<?php
// Configuración de zona horaria
date_default_timezone_set('America/El_Salvador');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Pruebas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .info {
            background-color: #e7f3ff;
            padding: 15px;
            border-left: 4px solid #2196F3;
            margin: 20px 0;
        }
        .test-section {
            background-color: #f9f9f9;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            border-left: 4px solid #28a745;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Página de Pruebas PHP</h1>
        
        <div class="info">
            <h3>Información del Sistema</h3>
            <p><strong>Fecha actual:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
            <p><strong>Versión de PHP:</strong> <?php echo phpversion(); ?></p>
            <p><strong>Sistema Operativo:</strong> <?php echo PHP_OS; ?></p>
            <p><strong>Servidor Web:</strong> <?php echo $_SERVER['SERVER_SOFTWARE'] ?? 'No disponible'; ?></p>
        </div>
        
        <div class="test-section">
            <h3>Variables de Servidor</h3>
            <p><strong>Host:</strong> <?php echo $_SERVER['HTTP_HOST'] ?? 'localhost'; ?></p>
            <p><strong>URI:</strong> <?php echo $_SERVER['REQUEST_URI'] ?? '/'; ?></p>
            <p><strong>Método:</strong> <?php echo $_SERVER['REQUEST_METHOD'] ?? 'GET'; ?></p>
            <p><strong>IP del Cliente:</strong> <?php echo $_SERVER['REMOTE_ADDR'] ?? 'No disponible'; ?></p>
        </div>

        <div class="test-section">
            <h3>Pruebas de PHP</h3>
            <?php
            // Prueba de operaciones matemáticas
            $a = 10;
            $b = 5;
            echo "<p><strong>Suma:</strong> $a + $b = " . ($a + $b) . "</p>";
            echo "<p><strong>División:</strong> $a / $b = " . ($a / $b) . "</p>";
            
            // Prueba de arrays
            $frutas = ['manzana', 'banana', 'naranja'];
            echo "<p><strong>Frutas:</strong> " . implode(', ', $frutas) . "</p>";
            
            // Prueba de funciones
            function saludar($nombre) {
                return "Hola, " . $nombre . "!";
            }
            echo "<p><strong>Saludo:</strong> " . saludar('Usuario') . "</p>";
            ?>
        </div>

        <div class="success">
            <h3>Estado de la Conexión</h3>
            <p>✅ PHP está funcionando correctamente</p>
            <p>✅ El servidor web está respondiendo</p>
            <p>✅ Todas las pruebas básicas han pasado</p>
        </div>
    </div>
</body>
</html>