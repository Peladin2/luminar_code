<?php

require_once __DIR__ . '/../config/Database.php';

class Documento
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();

        $this->conexion = $db->conexion;
    }

    public function obtenerTodos()
    {
        $sql = 'SELECT ID_Documento, Nombre, Descripcion, Link_Descarga, Solo_Docentes, ID_Administrador FROM Documento ORDER BY Nombre';
        $consulta = $this->conexion->query($sql);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id)
    {
        $sql = 'SELECT ID_Documento, Nombre, Descripcion, Link_Descarga, Solo_Docentes, ID_Administrador FROM Documento WHERE ID_Documento = :id';
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

    public function crear($nombre, $descripcion, $linkDescarga, $soloDocentes, $idAdministrador)
    {
        $sql = 'INSERT INTO Documento (Nombre, Descripcion, Link_Descarga, Solo_Docentes, ID_Administrador) VALUES (:nombre, :descripcion, :linkDescarga, :soloDocentes, :idAdministrador)';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':descripcion', $descripcion);
        $consulta->bindParam(':linkDescarga', $linkDescarga);
        $consulta->bindParam(':soloDocentes', $soloDocentes, PDO::PARAM_INT);
        $consulta->bindParam(':idAdministrador', $idAdministrador, PDO::PARAM_INT);
        $consulta->execute();

        return $this->conexion->lastInsertId();
    }

    public function actualizar($id, $nombre, $descripcion, $linkDescarga, $soloDocentes)
    {
        $sql = 'UPDATE Documento SET Nombre = :nombre, Descripcion = :descripcion, Link_Descarga = :linkDescarga, Solo_Docentes = :soloDocentes WHERE ID_Documento = :id';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':descripcion', $descripcion);
        $consulta->bindParam(':linkDescarga', $linkDescarga);
        $consulta->bindParam(':soloDocentes', $soloDocentes, PDO::PARAM_INT);
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
        $sql = 'DELETE FROM Documento WHERE ID_Documento = :id';
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