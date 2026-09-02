<?php

class MateriaModel{

    private $db;

    public function __construct ($conexion){
        $this->db =$conexion;
    }

    //mostramos las materias que estan solo en activas
    public function getAll(){
        $sql="SELECT m.idMateria, m.nombre, m.año, m.idEstado, e.nombre AS estado_nombre 
        from materia m
        inner join estado e Using (idEstado)
        where e.activo=1 or e.nombre!= 'Eliminada'
        order by m.nombre DESC";

        $stmt= $this->db->prepare($sql);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id){
        $stmt = $this->db->prepare("SELECT * FROM materia WHERE idMateria = ?");
        $stmt->execute([$id]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nombre, $año, $idEstado){
        $stmt = $this->db->prepare("INSERT INTO materia (nombre, año, idEstado) VALUES (?, ?, ?)");
        return $stmt->execute([$nombre, $año, $idEstado]); 
    }

    public function update($id, $nombre, $año, $idEstado) {
        $sql="UPDATE materia SET nombre = ?, año = ?, idEstado = ? WHERE idMateria = ?";
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([$nombre, $año, $idEstado, $id]);
    }

    public function getEstados() {
        $stmt = $this->db->prepare("SELECT * FROM estado ORDER BY nombre ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteLogico($id) {
        
        $sql = "UPDATE materia SET idEstado = (
                    SELECT idEstado FROM estado WHERE nombre = 'Eliminada' OR activo = 0 LIMIT 1
                ) WHERE idMateria = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }



}