<?php

require_once __DIR__ . '/../config/Database.php';

class Sugerencia
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conexion;
    }

    // Devuelve las sugerencias sin el ID_Usuario, ya que segun la RNE-10
    // se muestran de forma anonima al publico. El vinculo con el usuario
    // sigue existiendo en la tabla, solo que esta consulta no lo trae.
    public function obtenerTodos()
    {
        $sql = 'SELECT ID_Sugerencia, Contenido, Fecha FROM Sugerencia ORDER BY Fecha DESC';
        $consulta = $this->conexion->query($sql);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id)
    {
        $sql = 'SELECT ID_Sugerencia, Contenido, Fecha FROM Sugerencia WHERE ID_Sugerencia = :id';
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

    public function crear($contenido, $fecha, $idUsuario)
    {
        $sql = 'INSERT INTO Sugerencia (Contenido, Fecha, ID_Usuario) VALUES (:contenido, :fecha, :idUsuario)';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':contenido', $contenido);
        $consulta->bindParam(':fecha', $fecha);
        $consulta->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $consulta->execute();

        return $this->conexion->lastInsertId();
    }

    public function eliminar($id)
    {
        $sql = 'DELETE FROM Sugerencia WHERE ID_Sugerencia = :id';
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