<?php
class Noticia {
  private $conn;
  private $idNoticia;
  private $titulo;
  private $fecha;
  private $descripcion;
  private $urlImagen;
  private $idAdministrador;

  public function __construct($conn) {
    $this->conn = $conn;
  }

  public function obtenerTodos() {
    $stmt = $this->conn->prepare("SELECT * FROM Noticia ORDER BY Fecha DESC");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
  }

  public function obtenerPorId($id) {
    $stmt = $this->conn->prepare("SELECT * FROM Noticia WHERE ID_Noticia = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $fila = $stmt->fetch();

    if ($fila) {
      $this->idNoticia = $fila['ID_Noticia'];
      $this->titulo = $fila['Titulo'];
      $this->fecha = $fila['Fecha'];
      $this->descripcion = $fila['Descripcion'];
      $this->urlImagen = $fila['URL_Imagen'];
      $this->idAdministrador = $fila['ID_Administrador'];
    }
    return $fila;
  }

  public function crear() {
    try {
      $stmt = $this->conn->prepare("INSERT INTO Noticia (Titulo, Fecha, Descripcion, URL_Imagen, ID_Administrador)
      VALUES (:titulo, :fecha, :descripcion, :imagen, :admin)");
      $stmt->bindParam(':titulo', $this->titulo);
      $stmt->bindParam(':fecha', $this->fecha);
      $stmt->bindParam(':descripcion', $this->descripcion);
      $stmt->bindParam(':imagen', $this->urlImagen);
      $stmt->bindParam(':admin', $this->idAdministrador);
      $stmt->execute();
      $this->idNoticia = $this->conn->lastInsertId();
      return true;
    } catch(PDOException $e) {
      return false;
    }
  }

  public function actualizar() {
    try {
      $stmt = $this->conn->prepare("UPDATE Noticia SET Titulo = :titulo, Fecha = :fecha, Descripcion = :descripcion,
      URL_Imagen = :imagen WHERE ID_Noticia = :id");
      $stmt->bindParam(':titulo', $this->titulo);
      $stmt->bindParam(':fecha', $this->fecha);
      $stmt->bindParam(':descripcion', $this->descripcion);
      $stmt->bindParam(':imagen', $this->urlImagen);
      $stmt->bindParam(':id', $this->idNoticia);
      $stmt->execute();
      return true;
    } catch(PDOException $e) {
      return false;
    }
  }

  public function eliminar($id) {
    try {
      $stmt = $this->conn->prepare("DELETE FROM Noticia WHERE ID_Noticia = :id");
      $stmt->bindParam(':id', $id);
      $stmt->execute();
      return true;
    } catch(PDOException $e) {
      return false;
    }
  }

  public function obtenerUltimas($cantidad) {
    $stmt = $this->conn->prepare("SELECT * FROM Noticia ORDER BY Fecha DESC LIMIT :cantidad");
    $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
  }

  public function getIdNoticia() {
    return $this->idNoticia;
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