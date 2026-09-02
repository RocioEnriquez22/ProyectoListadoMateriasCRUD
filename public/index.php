<?php
require_once __DIR__ . "/../controllers/AuthController.php";
require_once __DIR__ . "/../controllers/MateriaController.php";
$authController = new AuthController();
$materiaController= new MateriaController();

$action = $_GET['action'] ?? 'index';

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
    case 'register':
        $authController->muestraRegistro();
        break;
    case 'doRegister':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') die("Método no permitido.");
        $authController->registrar();
        break;
    //Crud de listado materias
    case 'index': 
        $materiaController->index();
        break;
    case 'create':
        $materiaController->create();break;
    case 'store':
        $materiaController->store();break;
    case 'edit': 
        $materiaController->edit();break;
    case 'update':
        $materiaController->update();break;
    case 'delete':
        $materiaController->delete();break;

    case 'users':
        $authController->listUsers();
        break;
    case 'changeRole':
        $authController->changeRole();

    case 'deleteUser':
        $authController->borrarUser();
        break;
    default:
        header("Location: index.php?action=index");
        exit;
}