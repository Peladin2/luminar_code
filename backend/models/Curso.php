<?php

require_once __DIR__ . '/../config/Database.php';

class Curso
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conexion;
    }

    public function obtenerTodos()
    {
        $sql = 'SELECT ID_Curso, Nombre, Descripcion FROM Curso ORDER BY Nombre';
        $consulta = $this->conexion->query($sql);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id)
    {
        $sql = 'SELECT ID_Curso, Nombre, Descripcion FROM Curso WHERE ID_Curso = :id';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            return $resultado;
        } else {
            return null;
        }
    }

    public function crear($nombre, $descripcion)
    {
        $sql = 'INSERT INTO Curso (Nombre, Descripcion) VALUES (:nombre, :descripcion)';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':descripcion', $descripcion);
        $consulta->execute();

        return $this->conexion->lastInsertId();
    }

    public function actualizar($id, $nombre, $descripcion)
    {
        $sql = 'UPDATE Curso SET Nombre = :nombre, Descripcion = :descripcion WHERE ID_Curso = :id';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':descripcion', $descripcion);
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        if ($consulta->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    // Si el curso tirne una Oferta_Educativa asociada, esto falla por la
    // restriccion de clave foranea (ON DELETE RESTRICT) definidaa en la RNE-11.
    public function eliminar($id)
    {
        $sql = 'DELETE FROM Curso WHERE ID_Curso = :id';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        if ($consulta->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}