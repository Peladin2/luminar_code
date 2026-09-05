CREATE DATABASE IF NOT EXISTS centro_educativo_db
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_spanish_ci;
 
USE centro_educativo_db;
 

CREATE TABLE Usuario (
    ID_Usuario     INT AUTO_INCREMENT PRIMARY KEY,
    Nombre         VARCHAR(50)  NOT NULL,
    Apellido       VARCHAR(50)  NOT NULL,
    CI             VARCHAR(15)  NOT NULL,
    Mail           VARCHAR(100) NOT NULL,
    Contrasena     VARCHAR(255) NOT NULL,
    CONSTRAINT uq_usuario_ci   UNIQUE (CI),
    CONSTRAINT uq_usuario_mail UNIQUE (Mail)
) ENGINE=InnoDB;
 

CREATE TABLE Registrado (
    ID_Usuario           INT PRIMARY KEY,
    Telefono             VARCHAR(15) NOT NULL,
    Fecha_Nacimiento     DATE NOT NULL,
    Nombre_Responsable   VARCHAR(100) NULL,
    Contacto_Responsable VARCHAR(100) NULL,
    CONSTRAINT fk_registrado_usuario
        FOREIGN KEY (ID_Usuario) REFERENCES Usuario(ID_Usuario)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;
 

CREATE TABLE Administrador (
    ID_Usuario INT PRIMARY KEY,
    Cargo      VARCHAR(50) NOT NULL,
    CONSTRAINT fk_administrador_usuario
        FOREIGN KEY (ID_Usuario) REFERENCES Usuario(ID_Usuario)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;
 

CREATE TABLE Anexo (
    ID_Anexo    INT AUTO_INCREMENT PRIMARY KEY,
    Nombre      VARCHAR(100) NOT NULL,
    Descripcion TEXT NULL,
    URL_Imagen  VARCHAR(255) NULL
) ENGINE=InnoDB;
 

CREATE TABLE Curso (
    ID_Curso    INT AUTO_INCREMENT PRIMARY KEY,
    Nombre      VARCHAR(100) NOT NULL,
    Descripcion TEXT NULL
) ENGINE=InnoDB;
 

CREATE TABLE Turno (
    ID_Turno      INT AUTO_INCREMENT PRIMARY KEY,
    Numero_Turno  INT NOT NULL,
    Descripcion   VARCHAR(100) NOT NULL,
    Hora_Entrada  TIME NOT NULL,
    Hora_Salida   TIME NOT NULL
) ENGINE=InnoDB;
 

CREATE TABLE Oferta_Educativa (
    ID_Oferta       INT AUTO_INCREMENT PRIMARY KEY,
    Grado           VARCHAR(20) NOT NULL,
    Cupo_Maximo     INT NOT NULL,
    ID_Curso        INT NOT NULL,
    ID_Turno        INT NOT NULL,
    ID_Anexo        INT NOT NULL,
    ID_Administrador INT NOT NULL,
    CONSTRAINT fk_oferta_curso
        FOREIGN KEY (ID_Curso) REFERENCES Curso(ID_Curso)
        ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_oferta_turno
        FOREIGN KEY (ID_Turno) REFERENCES Turno(ID_Turno)
        ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_oferta_anexo
        FOREIGN KEY (ID_Anexo) REFERENCES Anexo(ID_Anexo)
        ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_oferta_administrador
        FOREIGN KEY (ID_Administrador) REFERENCES Administrador(ID_Usuario)
        ON DELETE RESTRICT ON UPDATE CASCADE,
    INDEX idx_oferta_curso_turno_anexo (ID_Curso, ID_Turno, ID_Anexo)
) ENGINE=InnoDB;
 

CREATE TABLE Preinscripcion (
    ID_Preinscripcion INT AUTO_INCREMENT PRIMARY KEY,
    Fecha             DATE NOT NULL,
    Posicion_Lista    INT NULL,
    Curso_Anterior    VARCHAR(100) NULL,
    ID_Usuario        INT NOT NULL,
    ID_Oferta         INT NOT NULL,
    CONSTRAINT fk_preinscripcion_registrado
        FOREIGN KEY (ID_Usuario) REFERENCES Registrado(ID_Usuario)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_preinscripcion_oferta
        FOREIGN KEY (ID_Oferta) REFERENCES Oferta_Educativa(ID_Oferta)
        ON DELETE CASCADE ON UPDATE CASCADE,
    INDEX idx_preinscripcion_usuario (ID_Usuario),
    INDEX idx_preinscripcion_oferta (ID_Oferta)
) ENGINE=InnoDB;
 

CREATE TABLE Evento (
    ID_Evento        INT AUTO_INCREMENT PRIMARY KEY,
    Titulo           VARCHAR(150) NOT NULL,
    Fecha            DATE NOT NULL,
    Descripcion      TEXT NULL,
    URL_Imagen       VARCHAR(255) NULL,
    ID_Administrador INT NOT NULL,
    CONSTRAINT fk_evento_administrador
        FOREIGN KEY (ID_Administrador) REFERENCES Administrador(ID_Usuario)
        ON DELETE RESTRICT ON UPDATE CASCADE,
    INDEX idx_evento_fecha (Fecha)
) ENGINE=InnoDB;
 

CREATE TABLE Noticia (
    ID_Noticia       INT AUTO_INCREMENT PRIMARY KEY,
    Titulo           VARCHAR(150) NOT NULL,
    Fecha            DATE NOT NULL,
    Descripcion      TEXT NULL,
    URL_Imagen       VARCHAR(255) NULL,
    ID_Administrador INT NOT NULL,
    CONSTRAINT fk_noticia_administrador
        FOREIGN KEY (ID_Administrador) REFERENCES Administrador(ID_Usuario)
        ON DELETE RESTRICT ON UPDATE CASCADE,
    INDEX idx_noticia_fecha (Fecha)
) ENGINE=InnoDB;
 

CREATE TABLE Estadistica (
    ID_Estadistica   INT AUTO_INCREMENT PRIMARY KEY,
    Titulo           VARCHAR(150) NOT NULL,
    Valor            VARCHAR(100) NOT NULL,
    Anio             YEAR NOT NULL,
    ID_Administrador INT NOT NULL,
    CONSTRAINT fk_estadistica_administrador
        FOREIGN KEY (ID_Administrador) REFERENCES Administrador(ID_Usuario)
        ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;
 

CREATE TABLE Documento (
    ID_Documento     INT AUTO_INCREMENT PRIMARY KEY,
    Nombre           VARCHAR(150) NOT NULL,
    Descripcion      TEXT NULL,
    Link_Descarga    VARCHAR(255) NOT NULL,
    Solo_Docentes    TINYINT(1) NOT NULL DEFAULT 0,
    ID_Administrador INT NOT NULL,
    CONSTRAINT fk_documento_administrador
        FOREIGN KEY (ID_Administrador) REFERENCES Administrador(ID_Usuario)
        ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;
 

CREATE TABLE Profesor (
    ID_Profesor INT AUTO_INCREMENT PRIMARY KEY,
    Nombre      VARCHAR(50) NOT NULL,
    Apellido    VARCHAR(50) NOT NULL
) ENGINE=InnoDB;
 

CREATE TABLE Materia (
    ID_Materia INT AUTO_INCREMENT PRIMARY KEY,
    Nombre     VARCHAR(100) NOT NULL
) ENGINE=InnoDB;
 

CREATE TABLE Profesor_Materia (
    ID_Profesor INT NOT NULL,
    ID_Materia  INT NOT NULL,
    PRIMARY KEY (ID_Profesor, ID_Materia),
    CONSTRAINT fk_profesormateria_profesor
        FOREIGN KEY (ID_Profesor) REFERENCES Profesor(ID_Profesor)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_profesormateria_materia
        FOREIGN KEY (ID_Materia) REFERENCES Materia(ID_Materia)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;
 

CREATE TABLE Sugerencia (
    ID_Sugerencia INT AUTO_INCREMENT PRIMARY KEY,
    Contenido     TEXT NOT NULL,
    Fecha         DATE NOT NULL,
    ID_Usuario    INT NOT NULL,
    CONSTRAINT fk_sugerencia_registrado
        FOREIGN KEY (ID_Usuario) REFERENCES Registrado(ID_Usuario)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;
 

CREATE TABLE Oferta_Materia (
    ID_Oferta  INT NOT NULL,
    ID_Materia INT NOT NULL,
    PRIMARY KEY (ID_Oferta, ID_Materia),
    CONSTRAINT fk_ofertamateria_oferta
        FOREIGN KEY (ID_Oferta) REFERENCES Oferta_Educativa(ID_Oferta)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_ofertamateria_materia
        FOREIGN KEY (ID_Materia) REFERENCES Materia(ID_Materia)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;
