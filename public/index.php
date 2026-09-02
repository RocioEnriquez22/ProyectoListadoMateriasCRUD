<?php
require_once __DIR__ . "/../controllers/AuthController.php";

$authController = new AuthController();
$action = $_GET['action'] ?? 'login';

switch($action) {
    case 'login':
        $authController->showLogin();
        break;
    case 'doLogin':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') die("Método no permitido.");
        $authController->login();
        break;
    case 'logout':
        $authController->logout();
        break;
    case 'index':
        // Aquí cargas la vista o lógica del listado
        echo "Vista principal";
        break;
    case 'register':
        $authController->muestraRegistro();
        break;
    case 'doRegister':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') die("Método no permitido.");
        $authController->registrar();
        break;
    default:
        echo "Acción no válida";
}