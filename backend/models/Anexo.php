<?php

require_once __DIR__ . '/../config/Database.php';

class Anexo
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conexion;
    }

    public function obtenerTodos()
    {
        $sql = 'SELECT ID_Anexo, Nombre, Descripcion, URL_Imagen FROM Anexo ORDER BY Nombre';
        $consulta = $this->conexion->query($sql);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id)
    {
        $sql = 'SELECT ID_Anexo, Nombre, Descripcion, URL_Imagen FROM Anexo WHERE ID_Anexo = :id';
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

    public function crear($nombre, $descripcion, $urlImagen = null)
    {
        $sql = 'INSERT INTO Anexo (Nombre, Descripcion, URL_Imagen) VALUES (:nombre, :descripcion, :urlImagen)';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':descripcion', $descripcion);
        $consulta->bindParam(':urlImagen', $urlImagen);
        $consulta->execute();

        return $this->conexion->lastInsertId();
    }

    public function actualizar($id, $nombre, $descripcion, $urlImagen = null)
    {
        $sql = 'UPDATE Anexo SET Nombre = :nombre, Descripcion = :descripcion, URL_Imagen = :urlImagen WHERE ID_Anexo = :id';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':descripcion', $descripcion);
        $consulta->bindParam(':urlImagen', $urlImagen);
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        if ($consulta->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Si el anexo tiene Ofertas_Educativas asociadas, esto falla por el
    // ON DELETE RESTRICT definido en Oferta_Educativa (RNE-11).
    public function eliminar($id)
    {
        $sql = 'DELETE FROM Anexo WHERE ID_Anexo = :id';
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