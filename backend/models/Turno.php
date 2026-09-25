<?php

require_once __DIR__ . '/../config/Database.php';

class Turno
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conexion;
    }

    public function obtenerTodos()
    {
        $sql = 'SELECT ID_Turno, Numero_Turno, Descripcion, Hora_Entrada, Hora_Salida FROM Turno ORDER BY Numero_Turno';
        $consulta = $this->conexion->query($sql);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id)
    {
        $sql = 'SELECT ID_Turno, Numero_Turno, Descripcion, Hora_Entrada, Hora_Salida FROM Turno WHERE ID_Turno = :id';
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

    public function crear($numeroTurno, $descripcion, $horaEntrada, $horaSalida)
    {
        $sql = 'INSERT INTO Turno (Numero_Turno, Descripcion, Hora_Entrada, Hora_Salida) VALUES (:numeroTurno, :descripcion, :horaEntrada, :horaSalida)';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':numeroTurno', $numeroTurno, PDO::PARAM_INT);
        $consulta->bindParam(':descripcion', $descripcion);
        $consulta->bindParam(':horaEntrada', $horaEntrada);
        $consulta->bindParam(':horaSalida', $horaSalida);
        $consulta->execute();

        return $this->conexion->lastInsertId();
    }

    public function actualizar($id, $numeroTurno, $descripcion, $horaEntrada, $horaSalida)
    {
        $sql = 'UPDATE Turno SET Numero_Turno = :numeroTurno, Descripcion = :descripcion, Hora_Entrada = :horaEntrada, Hora_Salida = :horaSalida WHERE ID_Turno = :id';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':numeroTurno', $numeroTurno, PDO::PARAM_INT);
        $consulta->bindParam(':descripcion', $descripcion);
        $consulta->bindParam(':horaEntrada', $horaEntrada);
        $consulta->bindParam(':horaSalida', $horaSalida);
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        if ($consulta->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // si el turno tiene Ofertas_Educativas asociadas,
    // esto falla por el ON DELETE RESTRICT (RNE-11).
    public function eliminar($id)
    {
        $sql = 'DELETE FROM Turno WHERE ID_Turno = :id';
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