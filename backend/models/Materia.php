<?php

require_once __DIR__ . '/../config/Database.php';

class Materia
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conexion;
    }

    public function obtenerTodos()
    {
        $sql = 'SELECT ID_Materia, Nombre FROM Materia ORDER BY Nombre';
        $consulta = $this->conexion->query($sql);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id)
    {
        $sql = 'SELECT ID_Materia, Nombre FROM Materia WHERE ID_Materia = :id';
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

    public function crear($nombre)
    {
        $sql = 'INSERT INTO Materia (Nombre) VALUES (:nombre)';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':nombre', $nombre);
        $consulta->execute();

        return $this->conexion->lastInsertId();
    }

    public function actualizar($id, $nombre)
    {
        $sql = 'UPDATE Materia SET Nombre = :nombre WHERE ID_Materia = :id';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        if ($consulta->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Si la materia tiene vinculos en Profesor_Materia
    // u Oferta_Materia, esos se borran en cascada al eliminarla.
    public function eliminar($id)
    {
        $sql = 'DELETE FROM Materia WHERE ID_Materia = :id';
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