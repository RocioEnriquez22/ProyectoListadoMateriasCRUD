CREATE DATABASE IF NOT EXISTS proyecto;
USE proyecto;

-- Tabla de Usuarios (Autenticación y Autorización)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol VARCHAR(20) NOT NULL DEFAULT 'usuario', -- 'admin' o 'usuario'
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de Estados de la Materia
CREATE TABLE IF NOT EXISTS estado (
    idEstado INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL, 
    activo TINYINT(1) DEFAULT 1
);

-- Tabla de Materias (Relacionada con Estado)
CREATE TABLE IF NOT EXISTS materia (
    idMateria INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    año INT NOT NULL,
    idEstado INT NOT NULL,
    FOREIGN KEY (idEstado) REFERENCES estado(idEstado) ON DELETE RESTRICT ON UPDATE CASCADE
);

-- Datos Iniciales de Prueba!!

-- Estados
INSERT INTO estado (idEstado,nombre, activo) VALUES 
(1, 'Cursando', 1),
(2, 'Regular', 1),
(3, 'Aprobada', 1),
(4, 'Promocionada', 1),
(5, 'Finalizada', 1),
(6, 'Libre', 1),
(7, 'Eliminada', 0);

-- Usuarios de prueba. Las contraseñas corresponden a "123456" y fueron generadas con password_hash().
INSERT INTO users (firstname, lastname, email, password, rol) VALUES 
('Carlos', 'Bazan', 'admin@gmail.com', '$2y$10$Af2cHSJPUk/wk.t1399jjul5JHswwYvzAbIlUKXP81CsgINap5UsK', 'admin'),
('Juan', 'Pérez', 'juan@gmail.com', '$2y$10$Af2cHSJPUk/wk.t1399jjul5JHswwYvzAbIlUKXP81CsgINap5UsK', 'usuario');

-- Materias iniciales
INSERT INTO materia (nombre, año, idEstado) VALUES 
('Programación Web', 2026, 1),
('Base de Datos', 2026, 3);