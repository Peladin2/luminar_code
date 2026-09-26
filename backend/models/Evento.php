<?php

require_once __DIR__ . '/../config/Database.php';

class Evento
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conexion;
    }

    public function obtenerTodos()
    {
        $sql = 'SELECT ID_Evento, Titulo, Fecha, Descripcion, URL_Imagen, ID_Administrador FROM Evento ORDER BY Fecha DESC';
        $consulta = $this->conexion->query($sql);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id)
    {
        $sql = 'SELECT ID_Evento, Titulo, Fecha, Descripcion, URL_Imagen, ID_Administrador FROM Evento WHERE ID_Evento = :id';
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

    public function crear($titulo, $fecha, $descripcion, $urlImagen, $idAdministrador)
    {
        $sql = 'INSERT INTO Evento (Titulo, Fecha, Descripcion, URL_Imagen, ID_Administrador) VALUES (:titulo, :fecha, :descripcion, :urlImagen, :idAdministrador)';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':titulo', $titulo);
        $consulta->bindParam(':fecha', $fecha);
        $consulta->bindParam(':descripcion', $descripcion);
        $consulta->bindParam(':urlImagen', $urlImagen);
        $consulta->bindParam(':idAdministrador', $idAdministrador, PDO::PARAM_INT);
        $consulta->execute();

        return $this->conexion->lastInsertId();
    }

    public function actualizar($id, $titulo, $fecha, $descripcion, $urlImagen)
    {
        $sql = 'UPDATE Evento SET Titulo = :titulo, Fecha = :fecha, Descripcion = :descripcion, URL_Imagen = :urlImagen WHERE ID_Evento = :id';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':titulo', $titulo);
        $consulta->bindParam(':fecha', $fecha);
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

    public function eliminar($id)
    {
        $sql = 'DELETE FROM Evento WHERE ID_Evento = :id';
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