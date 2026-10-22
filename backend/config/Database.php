<?php
class Database {
  private $servername = "localhost";
  private $username = "luminar_usuario";
  private $password = "luminar_usuario12345";
  private $dbname = "centro_educativo_db";

  public function conectar() {
    try {
      $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname;charset=utf8mb4", $this->username, $this->password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $conn;
    } catch(PDOException $e) {
      die("Error de conexion: " . $e->getMessage());
    }
  }
}
?>