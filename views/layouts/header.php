<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>CRUD PHP - MVC</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link rel="stylesheet" href="../CSS/login.css">
    </head>
<body class=body-header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <div>👤 Hola, <strong><?= htmlspecialchars($_SESSION['usuario_nombre'] ?? 'Usuario') ?></strong> 
            (<em><?= htmlspecialchars($_SESSION['usuario_rol'] ?? 'común') ?></em>)
        </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            
            <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php?action=index">Listado</a>
            </li>
            <?php if (isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] === 'admin'): ?>
                <li class="nav-item">
                <a class="nav-link" href="index.php?action=users">Administrar Users</a>
                </li>
            <?php endif; ?>
            <li class="nav-item">
            <a class="nav-link" href="index.php?action=logout">Cerrar Sesion</a>
            </li>
            
        </ul>
        </div>
    </div>
    </nav>
    
    
