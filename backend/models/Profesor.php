<?php

require_once __DIR__ . '/../config/Database.php';

class Profesor
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conexion;
    }

    public function obtenerTodos()
    {
        $sql = 'SELECT ID_Profesor, Nombre, Apellido FROM Profesor ORDER BY Apellido';
        $consulta = $this->conexion->query($sql);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id)
    {
        $sql = 'SELECT ID_Profesor, Nombre, Apellido FROM Profesor WHERE ID_Profesor = :id';
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

    public function crear($nombre, $apellido)
    {
        $sql = 'INSERT INTO Profesor (Nombre, Apellido) VALUES (:nombre, :apellido)';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':apellido', $apellido);
        $consulta->execute();

        return $this->conexion->lastInsertId();
    }

    public function actualizar($id, $nombre, $apellido)
    {
        $sql = 'UPDATE Profesor SET Nombre = :nombre, Apellido = :apellido WHERE ID_Profesor = :id';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':apellido', $apellido);
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        if ($consulta->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Si el profesor ya tiene materias asignadas en Profesor_Materia, esto falla
    // por el ON DELETE CASCADE de esa tabla intermedia, se borran tambien los vinculos.
    public function eliminar($id)
    {
        $sql = 'DELETE FROM Profesor WHERE ID_Profesor = :id';
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