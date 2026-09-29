<?php

require_once __DIR__ . '/../config/Database.php';

class Estadistica
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conexion;
    }

    public function obtenerTodos()
    {
        $sql = 'SELECT ID_Estadistica, Titulo, Valor, Anio, ID_Administrador FROM Estadistica ORDER BY Anio DESC, Titulo';
        $consulta = $this->conexion->query($sql);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id)
    {
        $sql = 'SELECT ID_Estadistica, Titulo, Valor, Anio, ID_Administrador FROM Estadistica WHERE ID_Estadistica = :id';
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

    public function crear($titulo, $valor, $anio, $idAdministrador)
    {
        $sql = 'INSERT INTO Estadistica (Titulo, Valor, Anio, ID_Administrador) VALUES (:titulo, :valor, :anio, :idAdministrador)';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':titulo', $titulo);
        $consulta->bindParam(':valor', $valor);
        $consulta->bindParam(':anio', $anio, PDO::PARAM_INT);
        $consulta->bindParam(':idAdministrador', $idAdministrador, PDO::PARAM_INT);
        $consulta->execute();

        return $this->conexion->lastInsertId();
    }

    public function actualizar($id, $titulo, $valor, $anio)
    {
        $sql = 'UPDATE Estadistica SET Titulo = :titulo, Valor = :valor, Anio = :anio WHERE ID_Estadistica = :id';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':titulo', $titulo);
        $consulta->bindParam(':valor', $valor);
        $consulta->bindParam(':anio', $anio, PDO::PARAM_INT);
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        if ($consulta->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function eliminar($id)
    {
        $sql = 'DELETE FROM Estadistica WHERE ID_Estadistica = :id';
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