<?php
class Anexo {
  private $conn;
  private $idAnexo;
  private $nombre;
  private $descripcion;
  private $direccion;
  private $telefono;
  private $horarioAtencion;
  private $urlMapa;
  private $urlImagen;

  public function __construct($conn) {
    $this->conn = $conn;
  }

  public function obtenerTodos() {
    $stmt = $this->conn->prepare("SELECT * FROM Anexo ORDER BY ID_Anexo");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
  }

  public function obtenerPorId($id) {
    $stmt = $this->conn->prepare("SELECT * FROM Anexo WHERE ID_Anexo = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $fila = $stmt->fetch();

    if ($fila) {
      $this->idAnexo = $fila['ID_Anexo'];
      $this->nombre = $fila['Nombre'];
      $this->descripcion = $fila['Descripcion'];
      $this->direccion = $fila['Direccion'];
      $this->telefono = $fila['Telefono'];
      $this->horarioAtencion = $fila['Horario_Atencion'];
      $this->urlMapa = $fila['URL_Mapa'];
      $this->urlImagen = $fila['URL_Imagen'];
    }
    return $fila;
  }

  public function crear() {
    try {
      $stmt = $this->conn->prepare("INSERT INTO Anexo (Nombre, Descripcion, Direccion, Telefono, Horario_Atencion, URL_Mapa, URL_Imagen)
      VALUES (:nombre, :descripcion, :direccion, :telefono, :horario, :mapa, :imagen)");
      $stmt->bindParam(':nombre', $this->nombre);
      $stmt->bindParam(':descripcion', $this->descripcion);
      $stmt->bindParam(':direccion', $this->direccion);
      $stmt->bindParam(':telefono', $this->telefono);
      $stmt->bindParam(':horario', $this->horarioAtencion);
      $stmt->bindParam(':mapa', $this->urlMapa);
      $stmt->bindParam(':imagen', $this->urlImagen);
      $stmt->execute();
      $this->idAnexo = $this->conn->lastInsertId();
      return true;
    } catch(PDOException $e) {
      return false;
    }
  }

  public function actualizar() {
    try {
      $stmt = $this->conn->prepare("UPDATE Anexo SET Nombre = :nombre, Descripcion = :descripcion, Direccion = :direccion,
      Telefono = :telefono, Horario_Atencion = :horario, URL_Mapa = :mapa, URL_Imagen = :imagen WHERE ID_Anexo = :id");
      $stmt->bindParam(':nombre', $this->nombre);
      $stmt->bindParam(':descripcion', $this->descripcion);
      $stmt->bindParam(':direccion', $this->direccion);
      $stmt->bindParam(':telefono', $this->telefono);
      $stmt->bindParam(':horario', $this->horarioAtencion);
      $stmt->bindParam(':mapa', $this->urlMapa);
      $stmt->bindParam(':imagen', $this->urlImagen);
      $stmt->bindParam(':id', $this->idAnexo);
      $stmt->execute();
      return true;
    } catch(PDOException $e) {
      return false;
    }
  }

  public function eliminar($id) {
    try {
      $stmt = $this->conn->prepare("DELETE FROM Anexo WHERE ID_Anexo = :id");
      $stmt->bindParam(':id', $id);
      $stmt->execute();
      return true;
    } catch(PDOException $e) {
      return false;
    }
  }

  public function obtenerOfertas() {
    $stmt = $this->conn->prepare("SELECT o.ID_Oferta, o.Grado, o.Anio_Lectivo, c.Nombre AS Curso, t.Descripcion AS Turno
    FROM Oferta_Educativa o
    INNER JOIN Curso c ON o.ID_Curso = c.ID_Curso
    INNER JOIN Turno t ON o.ID_Turno = t.ID_Turno
    WHERE o.ID_Anexo = :id
    ORDER BY o.Anio_Lectivo, c.Nombre");
    $stmt->bindParam(':id', $this->idAnexo);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
  }

  public function getIdAnexo() {
    return $this->idAnexo;
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

  public function getDireccion() {
    return $this->direccion;
  }

  public function setDireccion($direccion) {
    $this->direccion = $direccion;
  }

  public function getTelefono() {
    return $this->telefono;
  }

  public function setTelefono($telefono) {
    $this->telefono = $telefono;
  }

  public function getHorarioAtencion() {
    return $this->horarioAtencion;
  }

  public function setHorarioAtencion($horarioAtencion) {
    $this->horarioAtencion = $horarioAtencion;
  }

  public function getUrlMapa() {
    return $this->urlMapa;
  }

  public function setUrlMapa($urlMapa) {
    $this->urlMapa = $urlMapa;
  }

  public function getUrlImagen() {
    return $this->urlImagen;
  }

  public function setUrlImagen($urlImagen) {
    $this->urlImagen = $urlImagen;
  }
}
?>