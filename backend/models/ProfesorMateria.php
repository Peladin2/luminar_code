<?php

require_once __DIR__ . '/../config/Database.php';

class ProfesorMateria
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conexion;
    }

    public function asignarMateria($idProfesor, $idMateria)
    {
        $sql = 'INSERT INTO Profesor_Materia (ID_Profesor, ID_Materia) VALUES (:idProfesor, :idMateria)';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':idProfesor', $idProfesor, PDO::PARAM_INT);
        $consulta->bindParam(':idMateria', $idMateria, PDO::PARAM_INT);
        $consulta->execute();
    }

    public function quitarMateria($idProfesor, $idMateria)
    {
        $sql = 'DELETE FROM Profesor_Materia WHERE ID_Profesor = :idProfesor AND ID_Materia = :idMateria';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':idProfesor', $idProfesor, PDO::PARAM_INT);
        $consulta->bindParam(':idMateria', $idMateria, PDO::PARAM_INT);
        $consulta->execute();

        if ($consulta->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function obtenerMateriasDeProfesor($idProfesor)
    {
        $sql = 'SELECT m.ID_Materia, m.Nombre
                FROM Materia m
                INNER JOIN Profesor_Materia pm ON m.ID_Materia = pm.ID_Materia
                WHERE pm.ID_Profesor = :idProfesor
                ORDER BY m.Nombre';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':idProfesor', $idProfesor, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerProfesoresDeMateria($idMateria)
    {
        $sql = 'SELECT p.ID_Profesor, p.Nombre, p.Apellido
                FROM Profesor p
                INNER JOIN Profesor_Materia pm ON p.ID_Profesor = pm.ID_Profesor
                WHERE pm.ID_Materia = :idMateria
                ORDER BY p.Apellido';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':idMateria', $idMateria, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
}