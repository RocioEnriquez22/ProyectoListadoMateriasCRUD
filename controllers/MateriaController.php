<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../models/Materia.php";

class MateriaController{
    private $materiaModel;
    
    public function __construct(){
        global $conexion;
        $this->materiaModel = new MateriaModel($conexion);
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

    //Para mostrar el listado de users logueados
    public function index(){
        $this->requireLogin();
        $materias=$this->materiaModel->getAll();

        require __DIR__."/../views/users/index.php";
    }

    public function create() {
        $this->requireAdmin();
        $estados = $this->materiaModel->getEstados();
        require __DIR__ . "/../views/materias/crearMateria.php";
    }

    public function store() {
        $this->requireAdmin();
        $nombre   = trim($_POST['nombre'] ?? '');
        $año      = (int)($_POST['año'] ?? 0);
        $idEstado = (int)($_POST['idEstado'] ?? 0);

        if ($nombre !== '' && $año > 0 && $idEstado > 0) {
            $this->materiaModel->create($nombre, $año, $idEstado);
        }
        header("Location: index.php?action=index");
        exit;
    }

    // Formulario de edición (Solo Admin)
    public function edit() {
        $this->requireAdmin();
        $id = (int)($_GET['id'] ?? 0);
        $materia = $this->materiaModel->getById($id);
        $estados = $this->materiaModel->getEstados();

        if (!$materia) {
            header("Location: index.php?action=index");
            exit;
        }
        require __DIR__ . "/../views/materias/edit.php";
    }

    public function update() {
        $this->requireAdmin();
        $id       = (int)($_POST['idMateria'] ?? 0);
        $nombre   = trim($_POST['nombre'] ?? '');
        $año      = (int)($_POST['año'] ?? 0);
        $idEstado = (int)($_POST['idEstado'] ?? 0);

        if ($id > 0 && $nombre !== '' && $año > 0 && $idEstado > 0) {
            $this->materiaModel->update($id, $nombre, $año, $idEstado);
        }
        header("Location: index.php?action=index");
        exit;
    }

    // Borrado lógico (Solo Admin)
    public function delete() {
        $this->requireAdmin();
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            $this->materiaModel->deleteLogico($id);
        }
        header("Location: index.php?action=index");
        exit;
    }


}