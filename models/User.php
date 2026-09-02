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
        return $stmt->execute([$firstname, $lastname, $email, $passwordHash, $rol]);
    }
}