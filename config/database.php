<?php
//archivo que gestiona la conexion de forma segura con MySQL usando PDO y manejo de excepciones

$host     = "localhost";
$db       = "proyecto";
$user     = "root";
$password = "";

try {
    // Instanciamos el objeto PDO configurando el DSN y charset UTF-8
    $conexion = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $password);
    
    // Configurar PDO para que lance excepciones en caso de error
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error crítico de conexión a la base de datos: " . $e->getMessage());
}
