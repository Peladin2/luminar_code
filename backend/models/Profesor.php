<?php
class Profesor {
  private $conn;
  private $idProfesor;
  private $nombre;
  private $apellido;

  public function __construct($conn) {
    $this->conn = $conn;
  }

  public function obtenerTodos() {
    $stmt = $this->conn->prepare("SELECT * FROM Profesor ORDER BY Apellido, Nombre");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
  }

  public function obtenerPorId($id) {
    $stmt = $this->conn->prepare("SELECT * FROM Profesor WHERE ID_Profesor = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $fila = $stmt->fetch();

    if ($fila) {
      $this->idProfesor = $fila['ID_Profesor'];
      $this->nombre = $fila['Nombre'];
      $this->apellido = $fila['Apellido'];
    }
    return $fila;
  }

  public function crear() {
    try {
      $stmt = $this->conn->prepare("INSERT INTO Profesor (Nombre, Apellido) VALUES (:nombre, :apellido)");
      $stmt->bindParam(':nombre', $this->nombre);
      $stmt->bindParam(':apellido', $this->apellido);
      $stmt->execute();
      $this->idProfesor = $this->conn->lastInsertId();
      return true;
    } catch(PDOException $e) {
      return false;
    }
  }

  public function actualizar() {
    try {
      $stmt = $this->conn->prepare("UPDATE Profesor SET Nombre = :nombre, Apellido = :apellido WHERE ID_Profesor = :id");
      $stmt->bindParam(':nombre', $this->nombre);
      $stmt->bindParam(':apellido', $this->apellido);
      $stmt->bindParam(':id', $this->idProfesor);
      $stmt->execute();
      return true;
    } catch(PDOException $e) {
      return false;
    }
  }

  public function eliminar($id) {
    try {
      $stmt = $this->conn->prepare("DELETE FROM Profesor WHERE ID_Profesor = :id");
      $stmt->bindParam(':id', $id);
      $stmt->execute();
      return true;
    } catch(PDOException $e) {
      return false;
    }
  }

  public function asignarMateria($idMateria) {
    try {
      $stmt = $this->conn->prepare("INSERT INTO Profesor_Materia (ID_Profesor, ID_Materia) VALUES (:profesor, :materia)");
      $stmt->bindParam(':profesor', $this->idProfesor);
      $stmt->bindParam(':materia', $idMateria);
      $stmt->execute();
      return true;
    } catch(PDOException $e) {
      return false;
    }
  }

  public function quitarMateria($idMateria) {
    try {
      $stmt = $this->conn->prepare("DELETE FROM Profesor_Materia WHERE ID_Profesor = :profesor AND ID_Materia = :materia");
      $stmt->bindParam(':profesor', $this->idProfesor);
      $stmt->bindParam(':materia', $idMateria);
      $stmt->execute();
      return true;
    } catch(PDOException $e) {
      return false;
    }
  }

  public function obtenerMaterias() {
    $stmt = $this->conn->prepare("SELECT m.ID_Materia, m.Nombre
    FROM Materia m
    INNER JOIN Profesor_Materia pm ON m.ID_Materia = pm.ID_Materia
    WHERE pm.ID_Profesor = :id
    ORDER BY m.Nombre");
    $stmt->bindParam(':id', $this->idProfesor);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
  }

  public function getIdProfesor() {
    return $this->idProfesor;
  }

  public function getNombre() {
    return $this->nombre;
  }

  public function setNombre($nombre) {
    $this->nombre = $nombre;
  }

  public function getApellido() {
    return $this->apellido;
  }

  public function setApellido($apellido) {
    $this->apellido = $apellido;
  }
}
?>