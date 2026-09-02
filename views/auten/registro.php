<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario - Proyecto Materias</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f6f9; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .card { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 100%; max-width: 420px; }
        .card h2 { margin-top: 0; color: #333; text-align: center; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; color: #555; font-weight: bold; }
        .form-group input, .form-group select { width: 100%; padding: 9px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        .btn-submit { width: 100%; padding: 10px; background-color: #28a745; color: white; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; font-weight: bold; }
        .btn-submit:hover { background-color: #218838; }
        .link-back { display: block; text-align: center; margin-top: 15px; color: #007bff; text-decoration: none; }
        .error-msg { background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 15px; font-size: 14px; }
    </style>
</head>
<body>

<div class="card">
    <h2>Registrar Usuario</h2>

    <?php if (isset($error) && $error !== ''): ?>
        <div class="error-msg"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form action="index.php?action=doRegister" method="POST">
        <div class="form-group">
            <label for="firstname">Nombre:</label>
            <input type="text" id="firstname" name="firstname" required>
        </div>

        <div class="form-group">
            <label for="lastname">Apellido:</label>
            <input type="text" id="lastname" name="lastname" required>
        </div>

        <div class="form-group">
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required placeholder="correo@ejemplo.com">
        </div>

        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required placeholder="••••••••">
        </div>

        <div class="form-group">
            <label for="rol">Tipo de Usuario (Rol):</label>
            <select id="rol" name="rol" required>
                <option value="usuario">Usuario Común (Solo Lectura)</option>
                <option value="admin">Administrador (CRUD Completo)</option>
            </select>
        </div>

        <button type="submit" class="btn-submit">Guardar Usuario</button>
    </form>

    <a href="index.php?action=login" class="link-back">Volver al inicio de sesión</a>
</div>

</body>
</html>