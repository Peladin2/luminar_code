Arquitectura del Backend - Luminar Code

El backend esta organizado en 3 capas, siguiendo Programacion Orientada a Objetos:

Capa de Datos - backend/config/Database.php

Clase responsable de abrir la conexion hacia MySQL usando PDO con consultas preparadas.
Es la unica clase que conoce las credenciales de conexion.

Capa de Logica de Negocio - backend/models/

Clases que reciben la conexion de Database en su constructor y exponen las operaciones sobre cada tabla.
Todas las consultas usan sentencias preparadas (prepare + bindParam) para prevenir inyeccion SQL.

Curso.php

Expone las operaciones CRUD sobre la tabla Curso: obtenerTodos(), obtenerPorId(), crear(), actualizar() y eliminar().

Profesor.php

Expone las operaciones CRUD sobre la tabla Profesor: obtenerTodos(), obtenerPorId(), crear(), actualizar() y eliminar().
Los datos que gestiona son unicamente Nombre y Apellido, segun la RNE-7 la informacion publica de un profesor
se limita a esos dos campos mas las materias que dicta.

Materia.php

Expone las operaciones CRUD sobre la tabla Materia: obtenerTodos(), obtenerPorId(), crear(), actualizar() y eliminar().

ProfesorMateria.php

Maneja la tabla intermedia Profesor_Materia, que representa la agregacion del cuerpo docente en el DER. Resuelve la relacion de muchos a muchos entre profesores y materias: un profe puede dar varias materias y una materia la pueden dictar varios profes.

Como esta tabla no tiene un ID propio,su clave primaria es la combinacion de ID_Profesor e ID_Materia, no se le hace un CRUD tradicional como a Curso o Materia. No hay un registro independiente para actualizar, la relacion existe o no existe.

Por eso la clase tiene metodos pensados para esa relacion: asignarMateria() y quitarMateria() para crear o borrar el vinculo, y obtenerMateriasDeProfesor() junto con obtenerProfesoresDeMateria() para consultar los datos desde ambos lados.

Para estas consultas se usa un INNER JOIN. Como la tabla intermedia guarda unicamente numeros IDs, hay que cruzarla con Profesor o Materia para traer los nombres reales, que es lo que realmente sirve mostrar en la pantalla.

Anexo.php

Expone las operaciones CRUD sobre la tabla Anexo: obtenerTodos(), obtenerPorId(), crear(), actualizar() y eliminar(). No se puede eliminar un anexo que tenga Ofertas_Educativas asociadas, queda bloqueado por el ON DELETE RESTRICT de esa relacion, segun la RNE-11.

Turno.php

Expone las operaciones CRUD sobre la tabla Turno: obtenerTodos(), obtenerPorId(), crear(), actualizar() y eliminar(). Igual que con Anexo, no se puede eliminar un turno que tenga Ofertas_Educativas asociadas (ON DELETE RESTRICT, RNE-11).

Evento.php

Expone las operaciones CRUD sobre la tabla Evento: obtenerTodos(), obtenerPorId(), crear(), actualizar() y eliminar(). El metodo actualizar() no permite cambiar el ID_Administrador, ya que no tiene sentido que un evento cambie de responsable al editarse, solo se edita su contenido (titulo, fecha, descripcion, imagen).

Capa de Presentacion - backend/probar_crud.php

Script de prueba que usa las clases de models para mostrar resultados en pantalla, sin conocer nada de SQL ni de la conexion a la base de datos. 
Cuando el frontend este integrado, esta capa se reemplaza por vistas reales conectadas a los mismos modelos.


Relacion entre las clases

Cada modelo depende de Database (composicion: la usa, pero no hereda de ella). Database no depende de ningun modelo,
lo que permite reutilizarla para futuros modelos sin duplicar la logica de conexion.