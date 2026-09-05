USE centro_educativo_db;
 
INSERT INTO Usuario (ID_Usuario, Nombre, Apellido, CI, Mail, Contrasena) VALUES
(1, 'Lucía', 'Fernández', '41234567', 'lfernandez@gmail.com', 'Lucia4821'),
(2, 'Martín', 'Sosa', '38765432', 'msosa@gmail.com', 'Martin7364'),
(3, 'Sofía', 'Ramírez', '50123456', 'sramirez@gmail.com', 'Sofia2957'),
(4, 'Bruno', 'Acosta', '61234567', 'bacosta@gmail.com', 'Bruno1180'),
(5, 'Valentina', 'Núñez', '48765123', 'vnunez@gmail.com', 'Valentina6034'),
(6, 'Diego', 'Silva', '47651234', 'dsilva@gmail.com', 'Diego3492');
 
INSERT INTO Administrador (ID_Usuario, Cargo) VALUES
(1, 'Secretaria'),
(2, 'Director');
 
INSERT INTO Registrado (ID_Usuario, Telefono, Fecha_Nacimiento, Nombre_Responsable, Contacto_Responsable) VALUES
(3, '098123456', '2007-03-14', NULL, NULL),
(4, '099234567', '2011-06-02', 'Marcela Acosta', '098765432'),
(5, '097345678', '2006-11-20', NULL, NULL),
(6, '096456789', '2005-01-09', NULL, NULL);
 
INSERT INTO Anexo (ID_Anexo, Nombre, Descripcion, URL_Imagen) VALUES
(1, 'Sede Central', 'Sede principal de la institución en Bella Unión.', NULL),
(2, 'Baltasar Brum', 'Anexo orientado a Bachillerato Tecnológico Agrario.', NULL),
(3, 'Tomás Gomensoro', 'Anexo más reciente, con cursos en horario nocturno.', NULL),
(4, 'Polideportivo', 'Espacio deportivo compartido con la Secretaría Nacional de Deportes.', NULL);
 
INSERT INTO Curso (ID_Curso, Nombre, Descripcion) VALUES
(1, 'Bachillerato Tecnológico en Informática', 'Formación técnica orientada al desarrollo de software.'),
(2, 'Ciclo Básico Tecnológico', 'Primer ciclo de formación técnica.'),
(3, 'Bachillerato Tecnológico Agrario', 'Formación técnica orientada a producción agraria.');
 
INSERT INTO Turno (ID_Turno, Numero_Turno, Descripcion, Hora_Entrada, Hora_Salida) VALUES
(1, 1, 'Matutino', '07:30:00', '13:20:00'),
(2, 3, 'Vespertino', '12:30:00', '17:35:00'),
(3, 5, 'Nocturno', '18:10:00', '22:00:00'),
(4, 2, 'Deporte', '09:00:00', '15:40:00'),
(5, 4, 'Construcción, Estética y Mecánica', '15:40:00', '21:45:00');
 
INSERT INTO Oferta_Educativa (ID_Oferta, Grado, Cupo_Maximo, ID_Curso, ID_Turno, ID_Anexo, ID_Administrador) VALUES
(1, '1°', 30, 2, 1, 1, 1),
(2, '3°', 25, 1, 2, 1, 1),
(3, '3°', 20, 3, 1, 2, 2),
(4, '1°', 25, 2, 3, 3, 2);
 
INSERT INTO Preinscripcion (ID_Preinscripcion, Fecha, Posicion_Lista, Curso_Anterior, ID_Usuario, ID_Oferta) VALUES
(1, '2026-07-15', NULL, NULL, 3, 2),
(2, '2026-07-16', 5, 'Ciclo Básico 1° en otra institución', 4, 1),
(3, '2026-07-18', NULL, NULL, 5, 3),
(4, '2026-07-19', NULL, NULL, 3, 4),
(5, '2026-07-20', NULL, NULL, 6, 1);
 
INSERT INTO Evento (ID_Evento, Titulo, Fecha, Descripcion, URL_Imagen, ID_Administrador) VALUES
(1, 'Fogón', '2026-09-20', 'Fogón tradicional organizado por el centro educativo.', NULL, 1),
(2, 'Día del Estudiante', '2026-10-05', 'Actividades y celebraciones organizadas por el Día del Estudiante.', NULL, 2);
 
INSERT INTO Noticia (ID_Noticia, Titulo, Fecha, Descripcion, URL_Imagen, ID_Administrador) VALUES
(1, 'Llamado a aspiraciones docentes', '2026-08-10', 'Apertura de inscripciones para cubrir horas docentes.', NULL, 1),
(2, 'Fechas de exámenes de diciembre', '2026-09-01', 'Publicación del calendario de exámenes del segundo semestre.', NULL, 2);
 
INSERT INTO Estadistica (ID_Estadistica, Titulo, Valor, Anio, ID_Administrador) VALUES
(1, 'Cantidad de estudiantes matriculados', '1177', 2026, 1),
(2, 'Cantidad de egresados', '210', 2025, 2);
 
INSERT INTO Documento (ID_Documento, Nombre, Descripcion, Link_Descarga, Solo_Docentes, ID_Administrador) VALUES
(1, 'Reglamento de Evaluación', 'Normativa vigente sobre evaluación de los estudiantes.', '/documentos/reglamento_evaluacion.pdf', 0, 1),
(2, 'Formulario de Licencia Docente', 'Formulario interno para solicitud de licencias.', '/documentos/formulario_licencia.pdf', 1, 2);
 
INSERT INTO Profesor (ID_Profesor, Nombre, Apellido) VALUES
(1, 'Ana', 'Bianchi'),
(2, 'Carlos', 'Duarte'),
(3, 'Patricia', 'Leites');
 
INSERT INTO Materia (ID_Materia, Nombre) VALUES
(1, 'Matemática'),
(2, 'Programación'),
(3, 'Inglés'),
(4, 'Educación Física');
 
INSERT INTO Profesor_Materia (ID_Profesor, ID_Materia) VALUES
(1, 1),
(1, 2),
(2, 3),
(3, 4);
 
INSERT INTO Sugerencia (ID_Sugerencia, Contenido, Fecha, ID_Usuario) VALUES
(1, 'Sería bueno tener más bancos en el patio.', '2026-08-05', 3),
(2, 'Falta señalización para llegar al aula comedor.', '2026-08-12', 5);
 
INSERT INTO Oferta_Materia (ID_Oferta, ID_Materia) VALUES
(1, 1),
(1, 2),
(2, 2),
(2, 3),
(3, 1),
(4, 4);
