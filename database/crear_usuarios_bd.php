<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  die("No se pudo conectar. " . $e->getMessage());
}

try {
  $conn->exec("CREATE ROLE IF NOT EXISTS rol_aplicacion");
  $conn->exec("CREATE ROLE IF NOT EXISTS rol_backup");
  $conn->exec("CREATE ROLE IF NOT EXISTS rol_dba");

  $conn->exec("GRANT SELECT, INSERT, UPDATE, DELETE ON centro_educativo_db.* TO rol_aplicacion");
  $conn->exec("GRANT SELECT, LOCK TABLES, SHOW VIEW ON centro_educativo_db.* TO rol_backup");
  $conn->exec("GRANT ALL PRIVILEGES ON centro_educativo_db.* TO rol_dba");
  echo "Roles creados<br>";
} catch(PDOException $e) {
  echo "Error al crear los roles: " . $e->getMessage() . "<br>";
}

try {
  $conn->exec("DROP USER IF EXISTS 'luminar_usuario'@'localhost'");
  $conn->exec("CREATE USER 'luminar_usuario'@'localhost' IDENTIFIED BY 'luminar_usuario12345'");
  $conn->exec("GRANT rol_aplicacion TO 'luminar_usuario'@'localhost'");
  $conn->exec("SET DEFAULT ROLE rol_aplicacion FOR 'luminar_usuario'@'localhost'");
  echo "Usuario luminar_usuario creado<br>";
} catch(PDOException $e) {
  echo "Error al crear luminar_usuario: " . $e->getMessage() . "<br>";
}

try {
  $conn->exec("DROP USER IF EXISTS 'luminar_backup'@'localhost'");
  $conn->exec("CREATE USER 'luminar_backup'@'localhost' IDENTIFIED BY 'luminar_backup12345'");
  $conn->exec("GRANT rol_backup TO 'luminar_backup'@'localhost'");
  $conn->exec("SET DEFAULT ROLE rol_backup FOR 'luminar_backup'@'localhost'");
  echo "Usuario luminar_backup creado<br>";
} catch(PDOException $e) {
  echo "Error al crear luminar_backup: " . $e->getMessage() . "<br>";
}

try {
  $conn->exec("DROP USER IF EXISTS 'luminar_admin'@'localhost'");
  $conn->exec("CREATE USER 'luminar_admin'@'localhost' IDENTIFIED BY 'luminar_admin54321'");
  $conn->exec("GRANT rol_dba TO 'luminar_admin'@'localhost'");
  $conn->exec("SET DEFAULT ROLE rol_dba FOR 'luminar_admin'@'localhost'");
  echo "Usuario luminar_admin creado<br>";
} catch(PDOException $e) {
  echo "Error al crear luminar_admin: " . $e->getMessage() . "<br>";
}

$conn = null;
?>