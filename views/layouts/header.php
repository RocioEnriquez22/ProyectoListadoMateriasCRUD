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
<style>
body{
    font-family:Arial,sans-serif;
    max-width:1000px;
    margin:40px auto;
    padding:0 20px}
nav{
    margin-bottom:30px
}
nav a{
    margin-right:15px
}
table{
    width:100%;
    border-collapse:collapse
}
th,td{
    border:1px solid #ccc;
    padding:10px;
    text-align:left
}
form{
    max-width:600px
}
label{
    display:block;
    margin-top:15px
}
input{
    width:100%;
    padding:8px;
    box-sizing:border-box
}
button{
    margin-top:20px;
    padding:9px 15px
}
.actions a{
    margin-right:10px}
</style>
</head>
<body>
    <nav>
        <a href="index.php?action=index">Listado de Materias</a>
        <a href="index.php?action=create">Nuevo usuario</a>
        <?php if (isset($_SESSION['usuario_id'])): ?>
        <div class="user-panel">
            👤 Hola, <strong><?= htmlspecialchars($_SESSION['usuario_nombre'] ?? 'Usuario') ?></strong> 
            (<em><?= htmlspecialchars($_SESSION['usuario_rol'] ?? 'común') ?></em>)
            
            <!-- Botón de Cerrar Sesión (Visible para todo usuario logueado) -->
            <a href="index.php?action=logout" class="btn-logout">Cerrar Sesión</a>
        </div>
    <?php endif; ?>
    </nav>
    
