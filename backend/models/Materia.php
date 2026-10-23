<?php
class Materia {
  private $conn;
  private $idMateria;
  private $nombre;
  private $descripcion;

  public function __construct($conn) {
    $this->conn = $conn;
  }

  public function obtenerTodos() {
    $stmt = $this->conn->prepare("SELECT * FROM Materia ORDER BY Nombre");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
  }

  public function obtenerPorId($id) {
    $stmt = $this->conn->prepare("SELECT * FROM Materia WHERE ID_Materia = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $fila = $stmt->fetch();

    if ($fila) {
      $this->idMateria = $fila['ID_Materia'];
      $this->nombre = $fila['Nombre'];
      $this->descripcion = $fila['Descripcion'];
    }
    return $fila;
  }

  public function crear() {
    try {
      $stmt = $this->conn->prepare("INSERT INTO Materia (Nombre, Descripcion) VALUES (:nombre, :descripcion)");
      $stmt->bindParam(':nombre', $this->nombre);
      $stmt->bindParam(':descripcion', $this->descripcion);
      $stmt->execute();
      $this->idMateria = $this->conn->lastInsertId();
      return true;
    } catch(PDOException $e) {
      return false;
    }
  }

  public function actualizar() {
    try {
      $stmt = $this->conn->prepare("UPDATE Materia SET Nombre = :nombre, Descripcion = :descripcion WHERE ID_Materia = :id");
      $stmt->bindParam(':nombre', $this->nombre);
      $stmt->bindParam(':descripcion', $this->descripcion);
      $stmt->bindParam(':id', $this->idMateria);
      $stmt->execute();
      return true;
    } catch(PDOException $e) {
      return false;
    }
  }

  public function eliminar($id) {
    try {
      $stmt = $this->conn->prepare("DELETE FROM Materia WHERE ID_Materia = :id");
      $stmt->bindParam(':id', $id);
      $stmt->execute();
      return true;
    } catch(PDOException $e) {
      return false;
    }
  }

  public function obtenerProfesores() {
    $stmt = $this->conn->prepare("SELECT p.ID_Profesor, p.Nombre, p.Apellido
    FROM Profesor p
    INNER JOIN Profesor_Materia pm ON p.ID_Profesor = pm.ID_Profesor
    WHERE pm.ID_Materia = :id
    ORDER BY p.Apellido");
    $stmt->bindParam(':id', $this->idMateria);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
  }

  public function getIdMateria() {
    return $this->idMateria;
  }

  public function getNombre() {
    return $this->nombre;
  }

  public function setNombre($nombre) {
    $this->nombre = $nombre;
  }

  public function getDescripcion() {
    return $this->descripcion;
  }

  public function setDescripcion($descripcion) {
    $this->descripcion = $descripcion;
  }
}
?>