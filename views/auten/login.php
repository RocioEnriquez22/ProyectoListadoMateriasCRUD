<!-- Interfaz visual del login -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Proyecto Materias</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f6f9; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-card { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 100%; max-width: 380px; }
        .login-card h2 { margin-top: 0; color: #333; text-align: center; }
        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; margin-bottom: 6px; color: #555; font-weight: bold; }
        .form-group input { width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        .btn-submit { width: 100%; padding: 11px; background-color: #007bff; color: white; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; }
        .btn-submit:hover { background-color: #0056b3; }
        .error-msg { background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 15px; border: 1px solid #f5c6cb; font-size: 14px; }

        .register-box { margin-top: 20px; text-align: center; border-top: 1px solid #eee; padding-top: 15px; }
        .btn-register { display: block; width: 100%; padding: 10px; background-color: #28a745; color: white; text-decoration: none; border-radius: 4px; box-sizing: border-box; font-weight: bold; }
        .btn-register:hover { background-color: #218838; }
        .error-msg { background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 15px; font-size: 14px;}
    
    
    </style>
</head>
<body>

<div class="login-card">
    <h2>Iniciar Sesión</h2>

    <?php if (isset($error) && $error !== ''): ?>
        <div class="error-msg"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form action="index.php?action=doLogin" method="POST">
        <div class="form-group">
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required placeholder="ejemplo@correo.com">
        </div>

        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required placeholder="••••••••">
        </div>

        <button type="submit" class="btn-submit">Ingresar</button>
    </form>

    <div class="register-box">
        <p style="font-size: 14px; color: #666; margin-bottom: 10px;">¿No tienes una cuenta?</p>
        <a href="index.php?action=register" class="btn-register">Crear nuevo usuario</a>
    </div>
</div>
</div>

</body>
</html>