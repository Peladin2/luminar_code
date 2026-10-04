<?php

require_once __DIR__ . '/../config/Database.php';

class OfertaEducativa
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conexion;
    }

    public function obtenerTodos()
    {
        $sql = 'SELECT ID_Oferta, Grado, Cupo_Maximo, ID_Curso, ID_Turno, ID_Anexo, ID_Administrador FROM Oferta_Educativa ORDER BY ID_Oferta';
        $consulta = $this->conexion->query($sql);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id)
    {
        $sql = 'SELECT ID_Oferta, Grado, Cupo_Maximo, ID_Curso, ID_Turno, ID_Anexo, ID_Administrador FROM Oferta_Educativa WHERE ID_Oferta = :id';
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

    // Trae la oferta con los nombres reales de Curso, Turno y Anexo en vez de
    // solo los IDs, ya que para mostrarla en pantalla (RF-2) no sirve de nada
    // un numero suelto.
    public function obtenerTodosConDetalle()
    {
        $sql = 'SELECT oe.ID_Oferta, oe.Grado, oe.Cupo_Maximo,
                       c.Nombre AS NombreCurso, t.Descripcion AS NombreTurno, a.Nombre AS NombreAnexo
                FROM Oferta_Educativa oe
                INNER JOIN Curso c ON oe.ID_Curso = c.ID_Curso
                INNER JOIN Turno t ON oe.ID_Turno = t.ID_Turno
                INNER JOIN Anexo a ON oe.ID_Anexo = a.ID_Anexo
                ORDER BY oe.ID_Oferta';
        $consulta = $this->conexion->query($sql);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($grado, $cupoMaximo, $idCurso, $idTurno, $idAnexo, $idAdministrador)
    {
        $sql = 'INSERT INTO Oferta_Educativa (Grado, Cupo_Maximo, ID_Curso, ID_Turno, ID_Anexo, ID_Administrador) VALUES (:grado, :cupoMaximo, :idCurso, :idTurno, :idAnexo, :idAdministrador)';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':grado', $grado);
        $consulta->bindParam(':cupoMaximo', $cupoMaximo, PDO::PARAM_INT);
        $consulta->bindParam(':idCurso', $idCurso, PDO::PARAM_INT);
        $consulta->bindParam(':idTurno', $idTurno, PDO::PARAM_INT);
        $consulta->bindParam(':idAnexo', $idAnexo, PDO::PARAM_INT);
        $consulta->bindParam(':idAdministrador', $idAdministrador, PDO::PARAM_INT);
        $consulta->execute();

        return $this->conexion->lastInsertId();
    }

    public function actualizar($id, $grado, $cupoMaximo, $idCurso, $idTurno, $idAnexo)
    {
        $sql = 'UPDATE Oferta_Educativa SET Grado = :grado, Cupo_Maximo = :cupoMaximo, ID_Curso = :idCurso, ID_Turno = :idTurno, ID_Anexo = :idAnexo WHERE ID_Oferta = :id';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':grado', $grado);
        $consulta->bindParam(':cupoMaximo', $cupoMaximo, PDO::PARAM_INT);
        $consulta->bindParam(':idCurso', $idCurso, PDO::PARAM_INT);
        $consulta->bindParam(':idTurno', $idTurno, PDO::PARAM_INT);
        $consulta->bindParam(':idAnexo', $idAnexo, PDO::PARAM_INT);
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        if ($consulta->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Si la oferta ya tiene Preinscripciones asociadas, esto falla por el
    // ON DELETE CASCADE de esa tabla (se borrarian tambien las preinscripciones).
    public function eliminar($id)
    {
        $sql = 'DELETE FROM Oferta_Educativa WHERE ID_Oferta = :id';
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