<?php
class Turno {
  private $conn;
  private $idTurno;
  private $numeroTurno;
  private $descripcion;
  private $horaEntrada;
  private $horaSalida;

  public function __construct($conn) {
    $this->conn = $conn;
  }

  public function obtenerTodos() {
    $stmt = $this->conn->prepare("SELECT * FROM Turno ORDER BY Numero_Turno");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
  }

  public function obtenerPorId($id) {
    $stmt = $this->conn->prepare("SELECT * FROM Turno WHERE ID_Turno = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $fila = $stmt->fetch();

    if ($fila) {
      $this->idTurno = $fila['ID_Turno'];
      $this->numeroTurno = $fila['Numero_Turno'];
      $this->descripcion = $fila['Descripcion'];
      $this->horaEntrada = $fila['Hora_Entrada'];
      $this->horaSalida = $fila['Hora_Salida'];
    }
    return $fila;
  }

  public function crear() {
    try {
      $stmt = $this->conn->prepare("INSERT INTO Turno (Numero_Turno, Descripcion, Hora_Entrada, Hora_Salida)
      VALUES (:numero, :descripcion, :entrada, :salida)");
      $stmt->bindParam(':numero', $this->numeroTurno);
      $stmt->bindParam(':descripcion', $this->descripcion);
      $stmt->bindParam(':entrada', $this->horaEntrada);
      $stmt->bindParam(':salida', $this->horaSalida);
      $stmt->execute();
      $this->idTurno = $this->conn->lastInsertId();
      return true;
    } catch(PDOException $e) {
      return false;
    }
  }

  public function actualizar() {
    try {
      $stmt = $this->conn->prepare("UPDATE Turno SET Numero_Turno = :numero, Descripcion = :descripcion,
      Hora_Entrada = :entrada, Hora_Salida = :salida WHERE ID_Turno = :id");
      $stmt->bindParam(':numero', $this->numeroTurno);
      $stmt->bindParam(':descripcion', $this->descripcion);
      $stmt->bindParam(':entrada', $this->horaEntrada);
      $stmt->bindParam(':salida', $this->horaSalida);
      $stmt->bindParam(':id', $this->idTurno);
      $stmt->execute();
      return true;
    } catch(PDOException $e) {
      return false;
    }
  }

  public function eliminar($id) {
    try {
      $stmt = $this->conn->prepare("DELETE FROM Turno WHERE ID_Turno = :id");
      $stmt->bindParam(':id', $id);
      $stmt->execute();
      return true;
    } catch(PDOException $e) {
      return false;
    }
  }

  public function getIdTurno() {
    return $this->idTurno;
  }

  public function getNumeroTurno() {
    return $this->numeroTurno;
  }

  public function setNumeroTurno($numeroTurno) {
    $this->numeroTurno = $numeroTurno;
  }

  public function getDescripcion() {
    return $this->descripcion;
  }

  public function setDescripcion($descripcion) {
    $this->descripcion = $descripcion;
  }

  public function getHoraEntrada() {
    return $this->horaEntrada;
  }

  public function setHoraEntrada($horaEntrada) {
    $this->horaEntrada = $horaEntrada;
  }

  public function getHoraSalida() {
    return $this->horaSalida;
  }

  public function setHoraSalida($horaSalida) {
    $this->horaSalida = $horaSalida;
  }
}
?>