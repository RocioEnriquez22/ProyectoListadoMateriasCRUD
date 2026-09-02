<?php
//"cerebro" que procesara el formulario de ingreso, comprobar las credenciales contra el hash de la bd y gestiona el estado del usuario usando SESSIONS
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../models/User.php";

class AuthController {
    private $userModel;

    public function __construct() {
        global $conexion;
        $this->userModel = new User($conexion);
    }

    //Muestra el formulario de login
    public function showLogin() {
        require __DIR__ . "/../views/auten/login.php";
    }

    //Procesa la autenticación del usuario
    public function login() {
        //Asegurar que session_start() esté activo
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Limpieza de datos recibidos por POST
        $email =trim($_POST['email'] ?? '');
        $password= trim($_POST['password'] ?? '');

        
        
        // Validación de campos no vacíos
        if ($email === '' || $password === '') {
            $error = "Por favor, ingresa tu email y contraseña.";
            require __DIR__ . "/../views/auten/login.php";
            return;
        }

        // Buscar al usuario en MySQL usando  el Modelo
        $usuario = $this->userModel->findByEmail($email);
        
        // Verificar existencia y comparar contraseña con password_verify()
        if ($usuario && password_verify($password, $usuario['password'])) {
            // Autenticación exitosa: Guardamos datos del usuario en $_SESSION
            $_SESSION['usuario_id']     = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['firstname'] . ' ' . $usuario['lastname'];
            $_SESSION['usuario_email']  = $usuario['email'];
            $_SESSION['usuario_rol']    = $usuario['rol']; // 'admin' o 'usuario'

            //Redirigir al listado principal de materias
            header("Location: index.php?action=index");
            exit;
        } else {
            // Credenciales inválidas
            $error = "El correo o la contraseña son incorrectos.";
            require __DIR__ . "/../views/auten/login.php";
        }
    }

    //Cierra la sesión activa (Logout)
    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Vaciamos el arreglo y destruimos la sesión
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();

        // Redirigir de vuelta al formulario de ingreso
        header("Location: index.php?action=login");
        exit;
    }

    public function muestraRegistro(){
        require __DIR__ . "/../views/auten/registro.php";
    }

    public function registrar(){
        $firstname=trim($_POST['firstname'] ?? '');
        $lastname = trim($_POST['lastname'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password= trim($_POST['password'] ?? '');
        $rol = trim($_POST['rol'] ?? 'usuario');
        
        //validacion de los campos
        if ($firstname === '' || $lastname === '' || $email === '' || $password === '') {
        $error = "Todos los campos son obligatorios.";
        require __DIR__ . "/../views/auten/registro.php";
        return;
    }


    //verificacion si el correo ya esta registrado 
        $usuarioExistente = $this->userModel->findByEmail($email);

        if ($usuarioExistente) {
            $error = "El correo electrónico ya está registrado.";
            require __DIR__ . "/../views/auten/registro.php";
            return;
        }

        // Guardar usuario llamando al modelo User (encripta automáticamente la clave)
        $exito = $this->userModel->create($firstname, $lastname, $email, $password, $rol);

        if ($exito) {
            // Redirigir al login con mensaje exitoso
            header("Location: index.php?action=login");
            exit;
        } else {
            $error = "Ocurrió un error al registrar el usuario.";
            require __DIR__ . "/../views/auten/registro.php";
        }
    }

    private function requireLogin(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?action=login");
            exit;
        }
    }

    private function requireAdmin(){
        $this->requireLogin();
        if($_SESSION['usuario_rol'] !=='admin'){
            http_response_code(403);
            die("Acceso no permitido: No tiene permisos de Administrador");
        }   
    }

    //para mostrar el listado de user(solo al admin)
    public function listUsers() {
        $this->requireAdmin();
        $usuarios = $this->userModel->getAllUsers();
        require __DIR__ . "/../views/users/listaUsers.php"; // O la vista dentro de views/users/
    }

    //para el cambio de rol (Solo Admin)
    public function changeRole() {
        $this->requireAdmin();
        $userId   = (int)($_POST['user_id'] ?? 0);
        $nuevoRol = trim($_POST['rol'] ?? '');

        // Impedimos que el administrador logueado se quite el rol a sí mismo por accidente
        if ($userId === (int)$_SESSION['usuario_id']) {
            header("Location: index.php?action=users&error=self_role");
            exit;
        }

        if ($userId > 0 && ($nuevoRol === 'admin' || $nuevoRol === 'usuario')) {
            $this->userModel->cambiaRolUser($userId, $nuevoRol);
        }

        header("Location: index.php?action=users");
        exit;
    }

    public function borrarUser(){
        $this->requireAdmin();
        $userId=(int)($_GET['id'] ?? 0);

        if($userId === (int)$_SESSION['usuario_id']){
            header("Location: index.php?action=users&error=self_delete");
            exit;
        }
        if($userId>1){
            $this->userModel->borrarUser($userId);
        }
        header("Location: index.php?action=users");
        exit;
    }

}




    

