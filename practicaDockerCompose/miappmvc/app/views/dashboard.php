
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f5f5f5; }
        .navbar { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .navbar h1 { font-size: 1.5rem; }
        .user-info { display: flex; align-items: center; gap: 1rem; }
        .logout-btn { background: rgba(255,255,255,0.2); color: white; border: none; padding: 0.5rem 1rem; border-radius: 5px; cursor: pointer; transition: background 0.3s; }
        .logout-btn:hover { background: rgba(255,255,255,0.3); }
        .container { max-width: 1200px; margin: 2rem auto; padding: 0 2rem; }
        .welcome-card { background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); margin-bottom: 2rem; }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; margin-top: 2rem; }
        .stat-card { background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.1); border-left: 4px solid #667eea; }
        .stat-number { font-size: 2rem; font-weight: bold; color: #667eea; }
        .stat-label { color: #666; margin-top: 0.5rem; }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>Mi Sistema MVC</h1>
        <div class="user-info">
            <span>Bienvenido, <strong><?= htmlspecialchars($username) ?></strong></span>
            <a href="/logout">
                <button class="logout-btn">Cerrar Sesión</button>
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="welcome-card">
            <h2>🎉 ¡Bienvenido al Dashboard!</h2>
            <p>Has iniciado sesión exitosamente en el sistema.</p>
            <p><strong>Usuario ID:</strong> <?= htmlspecialchars($user_id) ?></p>
            <p><strong>Hora de acceso:</strong> <?= htmlspecialchars($login_time) ?></p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">1</div>
                <div class="stat-label">Sesión Activa</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">PHP 8.2</div>
                <div class="stat-label">Versión del Sistema</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">MVC</div>
                <div class="stat-label">Arquitectura</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">Docker</div>
                <div class="stat-label">Contenedor</div>
            </div>
        </div>
    </div>
</body>
</html>