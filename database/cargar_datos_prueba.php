<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "centro_educativo_db";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  die("No se pudo conectar. " . $e->getMessage());
}

$clave1 = password_hash("yatusabe000", PASSWORD_DEFAULT);
$clave2 = password_hash("martinaso12345", PASSWORD_DEFAULT);
$clave3 = password_hash("sofia5559", PASSWORD_DEFAULT);
$clave4 = password_hash("brunito2638", PASSWORD_DEFAULT);
$clave5 = password_hash("valentina1187", PASSWORD_DEFAULT);
$clave6 = password_hash("diego15233", PASSWORD_DEFAULT);
$clave7 = password_hash("camila88777", PASSWORD_DEFAULT);
$clave8 = password_hash("joaquin1672", PASSWORD_DEFAULT);

try {
  $sql = "INSERT INTO Responsable (Nombre, Apellido, CI, Telefono)
  VALUES ('Marcela', 'Acosta', '35678901', '098765432')";
  $conn->exec($sql);
  echo "Datos de Responsable cargados<br>";
} catch(PDOException $e) {
  echo "Error al cargar Responsable: " . $e->getMessage() . "<br>";
}

try {
  $sql = "INSERT INTO Usuario (Nombre, Apellido, CI, Mail, Contrasena, Activo, Tipo, Telefono, Fecha_Nacimiento, Fecha_Consentimiento, ID_Responsable) VALUES
  ('Lucia', 'Fernandez', '41234567', 'lfernandez@gmail.com', '$clave1', 1, 'administrador', NULL, NULL, NULL, NULL),
  ('Martin', 'Sosa', '38765432', 'msosa@gmail.com', '$clave2', 1, 'administrador', NULL, NULL, NULL, NULL),
  ('Sofia', 'Ramirez', '50123456', 'sramirez@gmail.com', '$clave3', 1, 'normal', '098123456', '2007-03-14', '2026-09-02 10:15:00', NULL),
  ('Bruno', 'Acosta', '61234567', 'bacosta@gmail.com', '$clave4', 1, 'normal', '099234567', '2011-06-02', '2026-09-05 18:40:00', 1),
  ('Valentina', 'Rodriguez', '48765123', 'vnunez@gmail.com', '$clave5', 1, 'normal', '097345678', '2006-11-20', '2026-09-10 09:05:00', NULL),
  ('Diego', 'Silva', '47651234', 'dsilva@gmail.com', '$clave6', 1, 'normal', '096456789', '2005-01-09', '2026-09-12 21:30:00', NULL),
  ('Camila', 'Acosta', '62345678', 'cacosta@gmail.com', '$clave7', 1, 'normal', '099876543', '2012-08-17', '2026-09-05 18:55:00', 1),
  ('Joaquin', 'Pereira', '45678912', 'jpereira@gmail.com', '$clave8', 0, 'normal', '095111222', '2004-04-25', '2025-10-20 15:00:00', NULL)";
  $conn->exec($sql);
  echo "Datos de Usuario cargados<br>";
} catch(PDOException $e) {
  echo "Error al cargar Usuario: " . $e->getMessage() . "<br>";
}

try {
  $sql = "INSERT INTO Administrador (ID_Usuario) VALUES (1), (2)";
  $conn->exec($sql);
  echo "Datos de Administrador cargados<br>";
} catch(PDOException $e) {
  echo "Error al cargar Administrador: " . $e->getMessage() . "<br>";
}

try {
  $sql = "INSERT INTO Configuracion (ID_Configuracion, Telefono_Administracion, Telefono_Adscripcion, Horario_Adscripcion, Correo_Institucional, Horario_Biblioteca, URL_Video_Tutorial, URL_Facebook, URL_Instagram, Fecha_Apertura_Preinscripcion, Fecha_Cierre_Preinscripcion, ID_Administrador)
  VALUES (1, '47792000', '47792001', 'Lunes a viernes de 8:00 a 12:00 y de 14:00 a 18:00', 'escuelatecnica.bellaunion@gmail.com', 'Lunes a viernes de 8:00 a 20:00', 'https://www.youtube.com/watch?v=ejemplo', 'https://www.facebook.com/ejemplo', 'https://www.instagram.com/ejemplo', '2026-10-01', '2026-12-15', 1)";
  $conn->exec($sql);
  echo "Datos de Configuracion cargados<br>";
} catch(PDOException $e) {
  echo "Error al cargar Configuracion: " . $e->getMessage() . "<br>";
}

try {
  $sql = "INSERT INTO Anexo (Nombre, Descripcion, Direccion, Telefono, Horario_Atencion, URL_Mapa, URL_Imagen) VALUES
  ('Sede Central', 'Sede principal de la escuela, con la mayoria de los cursos.', 'Calle de ejemplo 1234, Bella Union', '47792000', 'Lunes a viernes de 7:30 a 23:00', 'https://maps.google.com/?q=Bella+Union', 'uploads/sedes/sede-central.jpg'),
  ('Baltasar Brum', 'Anexo con los cursos del area agraria.', 'Calle de ejemplo 45, Baltasar Brum', '47702000', 'Lunes a viernes de 7:30 a 17:30', 'https://maps.google.com/?q=Baltasar+Brum', 'uploads/sedes/baltasar-brum.jpg'),
  ('Tomas Gomensoro', 'Anexo con cursos de Formacion Profesional Basica.', 'Calle de ejemplo 78, Tomas Gomensoro', '47762000', 'Lunes a viernes de 13:00 a 21:00', 'https://maps.google.com/?q=Tomas+Gomensoro', 'uploads/sedes/tomas-gomensoro.jpg'),
  ('Polideportivo', 'Espacio donde los estudiantes de Ciclo Basico hacen Educacion Fisica.', 'Calle de ejemplo 900, Bella Union', NULL, 'Lunes a viernes de 8:00 a 18:00', 'https://maps.google.com/?q=Polideportivo+Bella+Union', 'uploads/sedes/polideportivo.jpg')";
  $conn->exec($sql);
  echo "Datos de Anexo cargados<br>";
} catch(PDOException $e) {
  echo "Error al cargar Anexo: " . $e->getMessage() . "<br>";
}

try {
  $sql = "INSERT INTO Turno (Numero_Turno, Descripcion, Hora_Entrada, Hora_Salida) VALUES
  (1, 'Mañana', '07:30:00', '12:00:00'),
  (2, 'Intermedio', '10:00:00', '14:30:00'),
  (3, 'Tarde', '13:00:00', '17:30:00'),
  (4, 'Tarde-noche', '16:00:00', '20:30:00'),
  (5, 'Noche', '18:30:00', '23:00:00')";
  $conn->exec($sql);
  echo "Datos de Turno cargados<br>";
} catch(PDOException $e) {
  echo "Error al cargar Turno: " . $e->getMessage() . "<br>";
}

try {
  $sql = "INSERT INTO Curso (Nombre, Nivel, Descripcion, Duracion, Perfil_Egreso, Requisitos_Ingreso, URL_Imagen) VALUES
  ('Bachillerato Tecnologico en Informatica', 'BT', 'Formacion tecnica en programacion, bases de datos y redes.', '3 años', 'Desarrolla aplicaciones, administra bases de datos y da soporte tecnico.', 'Ciclo Basico aprobado. Cedula de identidad y carne de salud.', 'uploads/cursos/informatica.jpg'),
  ('Ciclo Basico Tecnologico', 'EBI', 'Educacion media basica con talleres tecnicos.', '3 años', 'Completa la educacion media basica y puede seguir cualquier bachillerato.', 'Primaria aprobada. Cedula de identidad.', 'uploads/cursos/ciclo-basico.jpg'),
  ('Bachillerato Tecnologico Agrario', 'BT', 'Formacion tecnica en produccion animal y vegetal.', '3 años', 'Trabaja en establecimientos rurales y puede seguir estudios terciarios del area.', 'Ciclo Basico aprobado. Cedula de identidad.', 'uploads/cursos/agrario.jpg'),
  ('FPB Gastronomia', 'FPB', 'Formacion Profesional Basica con orientacion en cocina.', '3 años', 'Trabaja como ayudante de cocina y completa la educacion media basica.', 'Tener 15 años o mas y primaria aprobada.', 'uploads/cursos/gastronomia.jpg'),
  ('Electrotecnia basica', 'CPI', 'Curso de capacitacion en instalaciones electricas domiciliarias.', '1 año', 'Realiza instalaciones electricas basicas en viviendas.', 'Tener 15 años o mas.', 'uploads/cursos/electrotecnia.jpg'),
  ('Bachillerato Profesional en Administracion', 'BTP', 'Formacion en gestion administrativa y contable.', '2 años', 'Trabaja en tareas administrativas de empresas y oficinas.', 'Ciclo Basico aprobado.', 'uploads/cursos/administracion.jpg')";
  $conn->exec($sql);
  echo "Datos de Curso cargados<br>";
} catch(PDOException $e) {
  echo "Error al cargar Curso: " . $e->getMessage() . "<br>";
}

try {
  $sql = "INSERT INTO Materia (Nombre, Descripcion) VALUES
  ('Matematica', 'Algebra, funciones y estadistica.'),
  ('Fisica', 'Mecanica, electricidad y energia.'),
  ('Programacion', 'Logica y desarrollo de programas.'),
  ('Base de Datos', 'Modelado y consultas SQL.'),
  ('Sistemas Operativos', 'Instalacion y administracion de sistemas.'),
  ('Idioma Español', 'Lectura, escritura y analisis de textos.'),
  ('Ingles', 'Ingles general y tecnico.'),
  ('Historia', 'Historia nacional y universal.'),
  ('Produccion Animal', 'Manejo de ganado y pasturas.'),
  ('Cocina Basica', 'Tecnicas de cocina e higiene.'),
  ('Electrotecnia', 'Circuitos e instalaciones electricas.'),
  ('Educacion Fisica', 'Actividad fisica y deportes.'),
  ('Contabilidad', 'Registros contables y balances.')";
  $conn->exec($sql);
  echo "Datos de Materia cargados<br>";
} catch(PDOException $e) {
  echo "Error al cargar Materia: " . $e->getMessage() . "<br>";
}

try {
  $sql = "INSERT INTO Curso_Materia (ID_Curso, ID_Materia, Grado) VALUES
  (1, 1, '1°'), (1, 2, '1°'), (1, 3, '1°'), (1, 6, '1°'), (1, 7, '1°'),
  (1, 1, '2°'), (1, 3, '2°'), (1, 4, '2°'), (1, 5, '2°'),
  (1, 1, '3°'), (1, 4, '3°'), (1, 7, '3°'),
  (2, 1, '1°'), (2, 6, '1°'), (2, 8, '1°'), (2, 12, '1°'),
  (3, 1, '1°'), (3, 9, '1°'), (3, 6, '1°'),
  (4, 10, '1°'), (4, 6, '1°'), (4, 1, '1°'),
  (5, 11, '1°'),
  (6, 13, '1°'), (6, 1, '1°'), (6, 7, '1°')";
  $conn->exec($sql);
  echo "Datos de Curso_Materia cargados<br>";
} catch(PDOException $e) {
  echo "Error al cargar Curso_Materia: " . $e->getMessage() . "<br>";
}

try {
  $sql = "INSERT INTO Profesor (Nombre, Apellido) VALUES
  ('Ana', 'Bianchi'),
  ('Carlos', 'Mendez'),
  ('Florencia', 'Rodriguez'),
  ('Gustavo', 'Piriz'),
  ('Natalia', 'Da Silva'),
  ('Pablo', 'Cabrera')";
  $conn->exec($sql);
  echo "Datos de Profesor cargados<br>";
} catch(PDOException $e) {
  echo "Error al cargar Profesor: " . $e->getMessage() . "<br>";
}

try {
  $sql = "INSERT INTO Profesor_Materia (ID_Profesor, ID_Materia) VALUES
  (1, 1), (1, 2), (2, 3), (2, 4), (2, 5), (3, 6), (3, 8), (4, 9), (5, 10), (5, 7), (6, 11), (6, 12)";
  $conn->exec($sql);
  echo "Datos de Profesor_Materia cargados<br>";
} catch(PDOException $e) {
  echo "Error al cargar Profesor_Materia: " . $e->getMessage() . "<br>";
}

try {
  $sql = "INSERT INTO Oferta_Educativa (Grado, Cupo_Maximo, Anio_Lectivo, Fecha_Inicio, ID_Curso, ID_Turno, ID_Anexo, ID_Administrador) VALUES
  ('1°', 30, 2026, '2026-03-02', 1, 1, 1, 1),
  ('1°', 30, 2027, '2027-03-01', 1, 1, 1, 1),
  ('2°', 25, 2027, '2027-03-01', 1, 3, 1, 1),
  ('1°', 35, 2027, '2027-03-01', 2, 1, 1, 2),
  ('1°', 20, 2027, '2027-03-01', 3, 1, 2, 2),
  ('1°', 2, 2027, '2027-03-01', 4, 3, 3, 1),
  ('1°', 25, 2027, '2027-03-01', 5, 5, 1, 2)";
  $conn->exec($sql);
  echo "Datos de Oferta_Educativa cargados<br>";
} catch(PDOException $e) {
  echo "Error al cargar Oferta_Educativa: " . $e->getMessage() . "<br>";
}

try {
  $sql = "INSERT INTO Preinscripcion (Fecha, Curso_Grado_Anterior, ID_Usuario, ID_Oferta) VALUES
  ('2026-10-02 09:12:00', 1, 3, 2),
  ('2026-10-02 10:30:00', 1, 3, 6),
  ('2026-10-03 18:45:00', 1, 4, 4),
  ('2026-10-04 08:05:00', 1, 5, 2),
  ('2026-10-04 08:20:00', 0, 5, 6),
  ('2026-10-04 08:40:00', 1, 5, 7),
  ('2026-10-06 21:10:00', 1, 6, 6),
  ('2026-10-07 11:00:00', 0, 7, 4),
  ('2026-10-01 07:50:00', 1, 8, 3)";
  $conn->exec($sql);
  echo "Datos de Preinscripcion cargados<br>";
} catch(PDOException $e) {
  echo "Error al cargar Preinscripcion: " . $e->getMessage() . "<br>";
}

try {
  $sql = "INSERT INTO Noticia (Titulo, Fecha, Descripcion, URL_Imagen, ID_Administrador) VALUES
  ('Abrio el periodo de preinscripcion 2027', '2026-10-01', 'Desde hoy y hasta el 15 de diciembre te podes preinscribir a los cursos de 2027 desde la pagina.', 'uploads/noticias/preinscripcion.jpg', 1),
  ('Fechas de examenes de diciembre', '2026-10-10', 'Ya estan publicadas las fechas de los examenes del periodo de diciembre.', NULL, 1),
  ('Llamado a docentes de Informatica', '2026-10-15', 'Se abre un llamado para cubrir horas de Programacion en el turno noche.', 'uploads/noticias/llamado.jpg', 2)";
  $conn->exec($sql);
  echo "Datos de Noticia cargados<br>";
} catch(PDOException $e) {
  echo "Error al cargar Noticia: " . $e->getMessage() . "<br>";
}

try {
  $sql = "INSERT INTO Evento (Titulo, Fecha, Hora, Lugar, Descripcion, URL_Imagen, ID_Administrador) VALUES
  ('Dia del Estudiante', '2026-09-21', '10:00:00', 'Sede Central', 'Jornada de actividades recreativas para todos los estudiantes.', 'uploads/eventos/dia-estudiante.jpg', 1),
  ('Fogon de fin de año', '2026-11-27', '20:00:00', 'Patio de la Sede Central', 'Fogon con musica y comida para cerrar el año.', 'uploads/eventos/fogon.jpg', 1),
  ('Expo de proyectos de Informatica', '2026-11-12', '14:00:00', 'Salon de actos', 'Los estudiantes de 3° presentan sus proyectos finales.', 'uploads/eventos/expo.jpg', 2)";
  $conn->exec($sql);
  echo "Datos de Evento cargados<br>";
} catch(PDOException $e) {
  echo "Error al cargar Evento: " . $e->getMessage() . "<br>";
}

try {
  $sql = "INSERT INTO Multimedia (Tipo, URL, Descripcion, ID_Evento, ID_Administrador) VALUES
  ('imagen', 'uploads/galeria/dia-estudiante-1.jpg', 'Juegos en el patio.', 1, 1),
  ('imagen', 'uploads/galeria/dia-estudiante-2.jpg', 'Entrega de premios.', 1, 1),
  ('video', 'https://www.youtube.com/watch?v=ejemplo2', 'Resumen del Dia del Estudiante.', 1, 1),
  ('imagen', 'uploads/galeria/sede-central-frente.jpg', 'Frente de la Sede Central.', NULL, 2),
  ('imagen', 'uploads/galeria/taller-informatica.jpg', 'Taller de Informatica.', NULL, 2)";
  $conn->exec($sql);
  echo "Datos de Multimedia cargados<br>";
} catch(PDOException $e) {
  echo "Error al cargar Multimedia: " . $e->getMessage() . "<br>";
}

try {
  $sql = "INSERT INTO Estadistica (Categoria, Titulo, Valor, Descripcion, Anio, ID_Administrador) VALUES
  ('nivel', 'Estudiantes de Ciclo Basico (EBI)', 320, NULL, 2026, 1),
  ('nivel', 'Estudiantes de Bachillerato Tecnologico', 280, NULL, 2026, 1),
  ('nivel', 'Estudiantes de FPB', 95, NULL, 2026, 1),
  ('nivel', 'Estudiantes de CPI', 25, 'Electrotecnia basica.', 2026, 1),
  ('turno', 'Estudiantes del turno Mañana', 310, NULL, 2026, 1),
  ('turno', 'Estudiantes del turno Tarde', 250, NULL, 2026, 1),
  ('turno', 'Estudiantes del turno Noche', 160, NULL, 2026, 1),
  ('anexo', 'Estudiantes en Baltasar Brum', 70, NULL, 2026, 1),
  ('anexo', 'Estudiantes en Tomas Gomensoro', 55, NULL, 2026, 1),
  ('egresos', 'Egresados de Bachillerato', 64, NULL, 2025, 1),
  ('personal', 'Docentes', 85, NULL, 2026, 1),
  ('personal', 'Funcionarios no docentes', 22, NULL, 2026, 1),
  ('general', 'Cursos ofrecidos', 18, NULL, 2026, 1)";
  $conn->exec($sql);
  echo "Datos de Estadistica cargados<br>";
} catch(PDOException $e) {
  echo "Error al cargar Estadistica: " . $e->getMessage() . "<br>";
}

try {
  $sql = "INSERT INTO Logro (Titulo, Descripcion, Anio, URL_Imagen, ID_Administrador) VALUES
  ('Primer puesto en la feria departamental de ciencias', 'Estudiantes de 2° de Informatica ganaron con un proyecto de riego automatico.', 2025, 'uploads/logros/premio.jpg', 1),
  ('Mencion en olimpiada de programacion', 'Un equipo de 3° obtuvo una mencion en la etapa nacional.', 2026, 'uploads/logros/olimpiada.jpg', 2)";
  $conn->exec($sql);
  echo "Datos de Logro cargados<br>";
} catch(PDOException $e) {
  echo "Error al cargar Logro: " . $e->getMessage() . "<br>";
}

try {
  $sql = "INSERT INTO Actividad (Nombre, Tipo, Descripcion, Horario, Lugar, ID_Administrador) VALUES
  ('Apoyo de Matematica', 'apoyo', 'Clases de apoyo para estudiantes de 1° y 2°.', 'Martes y jueves de 14:00 a 15:00', 'Salon 5, Sede Central', 1),
  ('Taller de robotica', 'extracurricular', 'Armado y programacion de robots con placas Arduino.', 'Viernes de 15:00 a 17:00', 'Laboratorio de Informatica', 2),
  ('Capacitacion en primeros auxilios', 'capacitacion', 'Curso corto abierto a estudiantes y funcionarios.', 'Sabado 14 de noviembre de 9:00 a 13:00', 'Salon de actos', 1)";
  $conn->exec($sql);
  echo "Datos de Actividad cargados<br>";
} catch(PDOException $e) {
  echo "Error al cargar Actividad: " . $e->getMessage() . "<br>";
}

try {
  $sql = "INSERT INTO Documento (Nombre, Descripcion, Categoria, Destinatario, URL_Archivo, Fecha_Publicacion, ID_Administrador) VALUES
  ('Reglamento de convivencia', 'Normas de convivencia de la escuela.', 'reglamento', 'general', 'uploads/documentos/reglamento-convivencia.pdf', '2026-03-01', 1),
  ('Formulario de pase', 'Formulario para solicitar el pase a otra institucion.', 'formulario', 'estudiantes', 'uploads/documentos/formulario-pase.pdf', '2026-03-01', 1),
  ('Planilla de calificaciones', 'Planilla para entregar las calificaciones del periodo.', 'formulario', 'docentes', 'uploads/documentos/planilla-calificaciones.pdf', '2026-06-15', 2),
  ('Boletin informativo de octubre', 'Novedades del mes.', 'boletin', 'general', 'uploads/documentos/boletin-octubre.pdf', '2026-10-01', 1)";
  $conn->exec($sql);
  echo "Datos de Documento cargados<br>";
} catch(PDOException $e) {
  echo "Error al cargar Documento: " . $e->getMessage() . "<br>";
}

try {
  $sql = "INSERT INTO Sugerencia (Contenido, Fecha, Revisada, ID_Usuario) VALUES
  ('Estaria bueno tener mas horarios de apoyo de Matematica en la tarde.', '2026-09-15 16:20:00', 1, 3),
  ('Propongo hacer un torneo de futbol entre turnos.', '2026-10-05 12:00:00', 0, 6),
  ('La biblioteca podria abrir los sabados de mañana.', '2026-10-08 19:45:00', 0, 5)";
  $conn->exec($sql);
  echo "Datos de Sugerencia cargados<br>";
} catch(PDOException $e) {
  echo "Error al cargar Sugerencia: " . $e->getMessage() . "<br>";
}

$conn = null;
?>