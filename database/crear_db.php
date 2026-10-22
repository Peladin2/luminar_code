<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "centro_educativo_db";

try {
  $conn = new PDO("mysql:host=$servername", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  die("No se pudo conectar. " . $e->getMessage());
}

try {
  $sql = "DROP DATABASE IF EXISTS $dbname";
  $conn->exec($sql);
  $sql = "CREATE DATABASE $dbname CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci";
  $conn->exec($sql);
  echo "Base de datos creada<br>";
} catch(PDOException $e) {
  echo "Error al crear la base: " . $sql . "<br>" . $e->getMessage();
}

$conn = null;

// ahora me conecto a la base para crear las tablas
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  die("No se pudo conectar. " . $e->getMessage());
}

try {
  $sql = "CREATE TABLE Responsable (
  ID_Responsable INT AUTO_INCREMENT PRIMARY KEY,
  Nombre VARCHAR(50) NOT NULL,
  Apellido VARCHAR(50) NOT NULL,
  CI VARCHAR(15) NOT NULL UNIQUE,
  Telefono VARCHAR(15) NOT NULL
  )";
  $conn->exec($sql);
  echo "Tabla Responsable creada<br>";
} catch(PDOException $e) {
  echo "Error al crear la tabla Responsable: " . $sql . "<br>" . $e->getMessage() . "<br>";
}

try {
  $sql = "CREATE TABLE Usuario (
  ID_Usuario INT AUTO_INCREMENT PRIMARY KEY,
  Nombre VARCHAR(50) NOT NULL,
  Apellido VARCHAR(50) NOT NULL,
  CI VARCHAR(15) NOT NULL UNIQUE,
  Mail VARCHAR(100) NOT NULL UNIQUE,
  Contrasena VARCHAR(255) NOT NULL,
  Activo TINYINT(1) NOT NULL DEFAULT 1,
  Tipo ENUM('normal','administrador') NOT NULL DEFAULT 'normal',
  Telefono VARCHAR(15),
  Fecha_Nacimiento DATE,
  Fecha_Consentimiento DATETIME,
  ID_Responsable INT,
  FOREIGN KEY (ID_Responsable) REFERENCES Responsable(ID_Responsable)
  )";
  $conn->exec($sql);
  echo "Tabla Usuario creada<br>";
} catch(PDOException $e) {
  echo "Error al crear la tabla Usuario: " . $sql . "<br>" . $e->getMessage() . "<br>";
}

try {
  $sql = "CREATE TABLE Administrador (
  ID_Usuario INT PRIMARY KEY,
  FOREIGN KEY (ID_Usuario) REFERENCES Usuario(ID_Usuario) ON DELETE CASCADE
  )";
  $conn->exec($sql);
  echo "Tabla Administrador creada<br>";
} catch(PDOException $e) {
  echo "Error al crear la tabla Administrador: " . $sql . "<br>" . $e->getMessage() . "<br>";
}

try {
  $sql = "CREATE TABLE Configuracion (
  ID_Configuracion TINYINT PRIMARY KEY,
  Telefono_Administracion VARCHAR(15),
  Telefono_Adscripcion VARCHAR(15),
  Horario_Adscripcion VARCHAR(150),
  Correo_Institucional VARCHAR(100),
  Horario_Biblioteca VARCHAR(150),
  URL_Video_Tutorial VARCHAR(500),
  URL_Facebook VARCHAR(255),
  URL_Instagram VARCHAR(255),
  Fecha_Apertura_Preinscripcion DATE,
  Fecha_Cierre_Preinscripcion DATE,
  ID_Administrador INT,
  CHECK (ID_Configuracion = 1),
  CHECK (Fecha_Cierre_Preinscripcion >= Fecha_Apertura_Preinscripcion),
  FOREIGN KEY (ID_Administrador) REFERENCES Administrador(ID_Usuario) ON DELETE SET NULL
  )";
  $conn->exec($sql);
  echo "Tabla Configuracion creada<br>";
} catch(PDOException $e) {
  echo "Error al crear la tabla Configuracion: " . $sql . "<br>" . $e->getMessage() . "<br>";
}

try {
  $sql = "CREATE TABLE Curso (
  ID_Curso INT AUTO_INCREMENT PRIMARY KEY,
  Nombre VARCHAR(100) NOT NULL,
  Nivel ENUM('CPI','EBI','FPB','BT','BTP','CTT','Tecnologo') NOT NULL,
  Descripcion TEXT,
  Duracion VARCHAR(30),
  Perfil_Egreso TEXT,
  Requisitos_Ingreso TEXT,
  URL_Imagen VARCHAR(255)
  )";
  $conn->exec($sql);
  echo "Tabla Curso creada<br>";
} catch(PDOException $e) {
  echo "Error al crear la tabla Curso: " . $sql . "<br>" . $e->getMessage() . "<br>";
}

try {
  $sql = "CREATE TABLE Materia (
  ID_Materia INT AUTO_INCREMENT PRIMARY KEY,
  Nombre VARCHAR(100) NOT NULL UNIQUE,
  Descripcion VARCHAR(255)
  )";
  $conn->exec($sql);
  echo "Tabla Materia creada<br>";
} catch(PDOException $e) {
  echo "Error al crear la tabla Materia: " . $sql . "<br>" . $e->getMessage() . "<br>";
}

try {
  $sql = "CREATE TABLE Curso_Materia (
  ID_Curso INT NOT NULL,
  ID_Materia INT NOT NULL,
  Grado VARCHAR(20) NOT NULL,
  PRIMARY KEY (ID_Curso, ID_Materia, Grado),
  FOREIGN KEY (ID_Curso) REFERENCES Curso(ID_Curso) ON DELETE CASCADE,
  FOREIGN KEY (ID_Materia) REFERENCES Materia(ID_Materia) ON DELETE CASCADE
  )";
  $conn->exec($sql);
  echo "Tabla Curso_Materia creada<br>";
} catch(PDOException $e) {
  echo "Error al crear la tabla Curso_Materia: " . $sql . "<br>" . $e->getMessage() . "<br>";
}

try {
  $sql = "CREATE TABLE Profesor (
  ID_Profesor INT AUTO_INCREMENT PRIMARY KEY,
  Nombre VARCHAR(50) NOT NULL,
  Apellido VARCHAR(50) NOT NULL
  )";
  $conn->exec($sql);
  echo "Tabla Profesor creada<br>";
} catch(PDOException $e) {
  echo "Error al crear la tabla Profesor: " . $sql . "<br>" . $e->getMessage() . "<br>";
}

try {
  $sql = "CREATE TABLE Profesor_Materia (
  ID_Profesor INT NOT NULL,
  ID_Materia INT NOT NULL,
  PRIMARY KEY (ID_Profesor, ID_Materia),
  FOREIGN KEY (ID_Profesor) REFERENCES Profesor(ID_Profesor) ON DELETE CASCADE,
  FOREIGN KEY (ID_Materia) REFERENCES Materia(ID_Materia) ON DELETE CASCADE
  )";
  $conn->exec($sql);
  echo "Tabla Profesor_Materia creada<br>";
} catch(PDOException $e) {
  echo "Error al crear la tabla Profesor_Materia: " . $sql . "<br>" . $e->getMessage() . "<br>";
}

try {
  $sql = "CREATE TABLE Turno (
  ID_Turno INT AUTO_INCREMENT PRIMARY KEY,
  Numero_Turno INT NOT NULL UNIQUE,
  Descripcion VARCHAR(100) NOT NULL,
  Hora_Entrada TIME NOT NULL,
  Hora_Salida TIME NOT NULL
  )";
  $conn->exec($sql);
  echo "Tabla Turno creada<br>";
} catch(PDOException $e) {
  echo "Error al crear la tabla Turno: " . $sql . "<br>" . $e->getMessage() . "<br>";
}

try {
  $sql = "CREATE TABLE Anexo (
  ID_Anexo INT AUTO_INCREMENT PRIMARY KEY,
  Nombre VARCHAR(100) NOT NULL,
  Descripcion TEXT,
  Direccion VARCHAR(200),
  Telefono VARCHAR(15),
  Horario_Atencion VARCHAR(150),
  URL_Mapa VARCHAR(500),
  URL_Imagen VARCHAR(255)
  )";
  $conn->exec($sql);
  echo "Tabla Anexo creada<br>";
} catch(PDOException $e) {
  echo "Error al crear la tabla Anexo: " . $sql . "<br>" . $e->getMessage() . "<br>";
}

try {
  $sql = "CREATE TABLE Oferta_Educativa (
  ID_Oferta INT AUTO_INCREMENT PRIMARY KEY,
  Grado VARCHAR(20) NOT NULL,
  Cupo_Maximo INT NOT NULL,
  Anio_Lectivo YEAR NOT NULL,
  Fecha_Inicio DATE,
  ID_Curso INT NOT NULL,
  ID_Turno INT NOT NULL,
  ID_Anexo INT NOT NULL,
  ID_Administrador INT NOT NULL,
  CHECK (Cupo_Maximo > 0),
  UNIQUE (ID_Curso, Grado, ID_Turno, ID_Anexo, Anio_Lectivo),
  FOREIGN KEY (ID_Curso) REFERENCES Curso(ID_Curso),
  FOREIGN KEY (ID_Turno) REFERENCES Turno(ID_Turno),
  FOREIGN KEY (ID_Anexo) REFERENCES Anexo(ID_Anexo),
  FOREIGN KEY (ID_Administrador) REFERENCES Administrador(ID_Usuario)
  )";
  $conn->exec($sql);
  echo "Tabla Oferta_Educativa creada<br>";
} catch(PDOException $e) {
  echo "Error al crear la tabla Oferta_Educativa: " . $sql . "<br>" . $e->getMessage() . "<br>";
}

try {
  $sql = "CREATE TABLE Preinscripcion (
  ID_Preinscripcion INT AUTO_INCREMENT PRIMARY KEY,
  Fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  Curso_Grado_Anterior TINYINT(1) NOT NULL,
  ID_Usuario INT NOT NULL,
  ID_Oferta INT NOT NULL,
  UNIQUE (ID_Usuario, ID_Oferta),
  FOREIGN KEY (ID_Usuario) REFERENCES Usuario(ID_Usuario) ON DELETE CASCADE,
  FOREIGN KEY (ID_Oferta) REFERENCES Oferta_Educativa(ID_Oferta)
  )";
  $conn->exec($sql);
  echo "Tabla Preinscripcion creada<br>";
} catch(PDOException $e) {
  echo "Error al crear la tabla Preinscripcion: " . $sql . "<br>" . $e->getMessage() . "<br>";
}

try {
  $sql = "CREATE TABLE Evento (
  ID_Evento INT AUTO_INCREMENT PRIMARY KEY,
  Titulo VARCHAR(150) NOT NULL,
  Fecha DATE NOT NULL,
  Hora TIME,
  Lugar VARCHAR(150),
  Descripcion TEXT,
  URL_Imagen VARCHAR(255),
  ID_Administrador INT NOT NULL,
  FOREIGN KEY (ID_Administrador) REFERENCES Administrador(ID_Usuario)
  )";
  $conn->exec($sql);
  echo "Tabla Evento creada<br>";
} catch(PDOException $e) {
  echo "Error al crear la tabla Evento: " . $sql . "<br>" . $e->getMessage() . "<br>";
}

try {
  $sql = "CREATE TABLE Multimedia (
  ID_Multimedia INT AUTO_INCREMENT PRIMARY KEY,
  Tipo ENUM('imagen','video') NOT NULL,
  URL VARCHAR(500) NOT NULL,
  Descripcion VARCHAR(200),
  ID_Evento INT,
  ID_Administrador INT NOT NULL,
  FOREIGN KEY (ID_Evento) REFERENCES Evento(ID_Evento) ON DELETE SET NULL,
  FOREIGN KEY (ID_Administrador) REFERENCES Administrador(ID_Usuario)
  )";
  $conn->exec($sql);
  echo "Tabla Multimedia creada<br>";
} catch(PDOException $e) {
  echo "Error al crear la tabla Multimedia: " . $sql . "<br>" . $e->getMessage() . "<br>";
}

try {
  $sql = "CREATE TABLE Noticia (
  ID_Noticia INT AUTO_INCREMENT PRIMARY KEY,
  Titulo VARCHAR(150) NOT NULL,
  Fecha DATE NOT NULL,
  Descripcion TEXT,
  URL_Imagen VARCHAR(255),
  ID_Administrador INT NOT NULL,
  FOREIGN KEY (ID_Administrador) REFERENCES Administrador(ID_Usuario)
  )";
  $conn->exec($sql);
  echo "Tabla Noticia creada<br>";
} catch(PDOException $e) {
  echo "Error al crear la tabla Noticia: " . $sql . "<br>" . $e->getMessage() . "<br>";
}

try {
  $sql = "CREATE TABLE Estadistica (
  ID_Estadistica INT AUTO_INCREMENT PRIMARY KEY,
  Categoria ENUM('nivel','turno','anexo','egresos','personal','general') NOT NULL,
  Titulo VARCHAR(150) NOT NULL,
  Valor INT NOT NULL,
  Descripcion VARCHAR(200),
  Anio YEAR NOT NULL,
  ID_Administrador INT NOT NULL,
  UNIQUE (Categoria, Titulo, Anio),
  FOREIGN KEY (ID_Administrador) REFERENCES Administrador(ID_Usuario)
  )";
  $conn->exec($sql);
  echo "Tabla Estadistica creada<br>";
} catch(PDOException $e) {
  echo "Error al crear la tabla Estadistica: " . $sql . "<br>" . $e->getMessage() . "<br>";
}

try {
  $sql = "CREATE TABLE Logro (
  ID_Logro INT AUTO_INCREMENT PRIMARY KEY,
  Titulo VARCHAR(150) NOT NULL,
  Descripcion TEXT,
  Anio YEAR NOT NULL,
  URL_Imagen VARCHAR(255),
  ID_Administrador INT NOT NULL,
  FOREIGN KEY (ID_Administrador) REFERENCES Administrador(ID_Usuario)
  )";
  $conn->exec($sql);
  echo "Tabla Logro creada<br>";
} catch(PDOException $e) {
  echo "Error al crear la tabla Logro: " . $sql . "<br>" . $e->getMessage() . "<br>";
}

try {
  $sql = "CREATE TABLE Actividad (
  ID_Actividad INT AUTO_INCREMENT PRIMARY KEY,
  Nombre VARCHAR(150) NOT NULL,
  Tipo ENUM('apoyo','extracurricular','capacitacion') NOT NULL,
  Descripcion TEXT,
  Horario VARCHAR(150) NOT NULL,
  Lugar VARCHAR(150),
  ID_Administrador INT NOT NULL,
  FOREIGN KEY (ID_Administrador) REFERENCES Administrador(ID_Usuario)
  )";
  $conn->exec($sql);
  echo "Tabla Actividad creada<br>";
} catch(PDOException $e) {
  echo "Error al crear la tabla Actividad: " . $sql . "<br>" . $e->getMessage() . "<br>";
}

try {
  $sql = "CREATE TABLE Documento (
  ID_Documento INT AUTO_INCREMENT PRIMARY KEY,
  Nombre VARCHAR(150) NOT NULL,
  Descripcion TEXT,
  Categoria ENUM('reglamento','formulario','boletin','otro') NOT NULL,
  Destinatario ENUM('estudiantes','docentes','general') NOT NULL DEFAULT 'general',
  URL_Archivo VARCHAR(255) NOT NULL,
  Fecha_Publicacion DATE NOT NULL,
  ID_Administrador INT NOT NULL,
  FOREIGN KEY (ID_Administrador) REFERENCES Administrador(ID_Usuario)
  )";
  $conn->exec($sql);
  echo "Tabla Documento creada<br>";
} catch(PDOException $e) {
  echo "Error al crear la tabla Documento: " . $sql . "<br>" . $e->getMessage() . "<br>";
}

try {
  $sql = "CREATE TABLE Sugerencia (
  ID_Sugerencia INT AUTO_INCREMENT PRIMARY KEY,
  Contenido TEXT NOT NULL,
  Fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  Revisada TINYINT(1) NOT NULL DEFAULT 0,
  ID_Usuario INT NOT NULL,
  FOREIGN KEY (ID_Usuario) REFERENCES Usuario(ID_Usuario) ON DELETE CASCADE
  )";
  $conn->exec($sql);
  echo "Tabla Sugerencia creada<br>";
} catch(PDOException $e) {
  echo "Error al crear la tabla Sugerencia: " . $sql . "<br>" . $e->getMessage() . "<br>";
}

$conn = null;
?>