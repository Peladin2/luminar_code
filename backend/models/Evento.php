<?php
class Evento {
  private $conn;
  private $idEvento;
  private $titulo;
  private $fecha;
  private $hora;
  private $lugar;
  private $descripcion;
  private $urlImagen;
  private $idAdministrador;

  public function __construct($conn) {
    $this->conn = $conn;
  }

  public function obtenerTodos() {
    $stmt = $this->conn->prepare("SELECT * FROM Evento ORDER BY Fecha DESC");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
  }

  public function obtenerPorId($id) {
    $stmt = $this->conn->prepare("SELECT * FROM Evento WHERE ID_Evento = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $fila = $stmt->fetch();

    if ($fila) {
      $this->idEvento = $fila['ID_Evento'];
      $this->titulo = $fila['Titulo'];
      $this->fecha = $fila['Fecha'];
      $this->hora = $fila['Hora'];
      $this->lugar = $fila['Lugar'];
      $this->descripcion = $fila['Descripcion'];
      $this->urlImagen = $fila['URL_Imagen'];
      $this->idAdministrador = $fila['ID_Administrador'];
    }
    return $fila;
  }

  public function crear() {
    try {
      $stmt = $this->conn->prepare("INSERT INTO Evento (Titulo, Fecha, Hora, Lugar, Descripcion, URL_Imagen, ID_Administrador)
      VALUES (:titulo, :fecha, :hora, :lugar, :descripcion, :imagen, :admin)");
      $stmt->bindParam(':titulo', $this->titulo);
      $stmt->bindParam(':fecha', $this->fecha);
      $stmt->bindParam(':hora', $this->hora);
      $stmt->bindParam(':lugar', $this->lugar);
      $stmt->bindParam(':descripcion', $this->descripcion);
      $stmt->bindParam(':imagen', $this->urlImagen);
      $stmt->bindParam(':admin', $this->idAdministrador);
      $stmt->execute();
      $this->idEvento = $this->conn->lastInsertId();
      return true;
    } catch(PDOException $e) {
      return false;
    }
  }

  public function actualizar() {
    try {
      $stmt = $this->conn->prepare("UPDATE Evento SET Titulo = :titulo, Fecha = :fecha, Hora = :hora, Lugar = :lugar,
      Descripcion = :descripcion, URL_Imagen = :imagen WHERE ID_Evento = :id");
      $stmt->bindParam(':titulo', $this->titulo);
      $stmt->bindParam(':fecha', $this->fecha);
      $stmt->bindParam(':hora', $this->hora);
      $stmt->bindParam(':lugar', $this->lugar);
      $stmt->bindParam(':descripcion', $this->descripcion);
      $stmt->bindParam(':imagen', $this->urlImagen);
      $stmt->bindParam(':id', $this->idEvento);
      $stmt->execute();
      return true;
    } catch(PDOException $e) {
      return false;
    }
  }

  public function eliminar($id) {
    try {
      $stmt = $this->conn->prepare("DELETE FROM Evento WHERE ID_Evento = :id");
      $stmt->bindParam(':id', $id);
      $stmt->execute();
      return true;
    } catch(PDOException $e) {
      return false;
    }
  }

  public function obtenerProximos() {
    $stmt = $this->conn->prepare("SELECT * FROM Evento WHERE Fecha >= CURDATE() ORDER BY Fecha, Hora");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
  }

  public function obtenerGaleria() {
    $stmt = $this->conn->prepare("SELECT * FROM Multimedia WHERE ID_Evento = :id");
    $stmt->bindParam(':id', $this->idEvento);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
  }

  public function getIdEvento() {
    return $this->idEvento;
  }

  public function getTitulo() {
    return $this->titulo;
  }

  public function setTitulo($titulo) {
    $this->titulo = $titulo;
  }

  public function getFecha() {
    return $this->fecha;
  }

  public function setFecha($fecha) {
    $this->fecha = $fecha;
  }

  public function getHora() {
    return $this->hora;
  }

  public function setHora($hora) {
    $this->hora = $hora;
  }

  public function getLugar() {
    return $this->lugar;
  }

  public function setLugar($lugar) {
    $this->lugar = $lugar;
  }

  public function getDescripcion() {
    return $this->descripcion;
  }

  public function setDescripcion($descripcion) {
    $this->descripcion = $descripcion;
  }

  public function getUrlImagen() {
    return $this->urlImagen;
  }

  public function setUrlImagen($urlImagen) {
    $this->urlImagen = $urlImagen;
  }

  public function getIdAdministrador() {
    return $this->idAdministrador;
  }

  public function setIdAdministrador($idAdministrador) {
    $this->idAdministrador = $idAdministrador;
  }
}
?>