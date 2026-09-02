<?php

//archivo que contiene unicamente las consultas SQL a la tabla users
class User {
    private $db;

    // Inyección de la conexión PDO al instanciar el Modelo
    public function __construct($conexion) {
        $this->db = $conexion;
    }

    // Busca un usuario por su email para procesar la autenticación
    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC); 
        //Retorna el arreglo asociativo o false
    }

    // Registra un nuevo usuario aplicando el hasheado seguro de contraseña
    public function create($firstname, $lastname, $email, $password, $rol = 'usuario') {
        // Genera el hash seguro con algoritmo por defecto 
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("INSERT INTO users (firstname, lastname, email, password, rol) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$firstname, $lastname, $email, $passwordHash, 'usuario']);
    }

    //funciones para la vista de administracion de users
    public function getAllUsers(){
        $sql="SELECT id ,firstname ,lastname ,email ,rol ,created_at
                from users ORDER BY id DESC";
        $stmt= $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cambiaRolUser($userId, $nuevoRol){
        $stmt=$this->db->prepare("UPDATE users SET rol=? where id=?");
        return $stmt->execute([$nuevoRol,$userId]);
    }

    public function borrarUser($userId){
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$userId]);
    }
    

}