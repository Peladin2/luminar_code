<?php

require_once __DIR__ . '/../config/Database.php';

class OfertaMateria
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conexion;
    }

    public function asignarMateria($idOferta, $idMateria)
    {
        $sql = 'INSERT INTO Oferta_Materia (ID_Oferta, ID_Materia) VALUES (:idOferta, :idMateria)';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':idOferta', $idOferta, PDO::PARAM_INT);
        $consulta->bindParam(':idMateria', $idMateria, PDO::PARAM_INT);
        $consulta->execute();
    }

    public function quitarMateria($idOferta, $idMateria)
    {
        $sql = 'DELETE FROM Oferta_Materia WHERE ID_Oferta = :idOferta AND ID_Materia = :idMateria';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':idOferta', $idOferta, PDO::PARAM_INT);
        $consulta->bindParam(':idMateria', $idMateria, PDO::PARAM_INT);
        $consulta->execute();

        if ($consulta->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function obtenerMateriasDeOferta($idOferta)
    {
        $sql = 'SELECT m.ID_Materia, m.Nombre
                FROM Materia m
                INNER JOIN Oferta_Materia om ON m.ID_Materia = om.ID_Materia
                WHERE om.ID_Oferta = :idOferta
                ORDER BY m.Nombre';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':idOferta', $idOferta, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerOfertasDeMateria($idMateria)
    {
        $sql = 'SELECT oe.ID_Oferta, oe.Grado
                FROM Oferta_Educativa oe
                INNER JOIN Oferta_Materia om ON oe.ID_Oferta = om.ID_Oferta
                WHERE om.ID_Materia = :idMateria
                ORDER BY oe.ID_Oferta';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':idMateria', $idMateria, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
}