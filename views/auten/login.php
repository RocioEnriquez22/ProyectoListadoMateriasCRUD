<!-- Interfaz visual del login -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Proyecto Materias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="stylesheet" href="../CSS/login.css">
</head>
<body>

<div class="login-card">
    <h2>Iniciar Sesión</h2>

    <form action="index.php?action=doLogin" method="POST">
        <?php if (isset($error)): ?>
            <div class="error-msg">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        <div class="form-group">
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required placeholder="ejemplo@correo.com">
        </div>

        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required placeholder="••••••••">
        </div>

        <button type="submit" class="btn btn-submit">Ingresar</button>
    </form>

    <div class="register-box">
        <p>¿No tienes una cuenta?</p>
        <button type="button" class="btn-modal" onclick="openModal()">Crear nuevo usuario</button>
    </div>
</div>
</div>
<div class="modal" id="registerModal">
    <div class="modal-contenido">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <h3>Crear Cuenta</h3>

        <?php if (isset($error) && isset($modal_error) && $modal_error): ?>
            <div class="error-msg">
                <?= htmlspecialchars($error) ?>
            </div>
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
                <label for="email_reg">Correo Electrónico:</label>
                <input type="email" id="email_reg" name="email" required>
            </div>

            <div class="form-group">
                <label for="pass_reg">Contraseña:</label>
                <input type="password" id="pass_reg" name="password" required>
            </div>

            <button type="submit" class="btn-modal">Guardar Usuario</button>
        </form>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src="../JS/modal.js"></script>
<?php if (isset($modal_error) && $modal_error): ?>
        <script>
            // Forzamos la apertura ejecutando cuando el DOM ya esté listo
            document.addEventListener('DOMContentLoaded', function() {
                openModal();
            });
        </script>
    <?php endif; ?>
</body>
</html>