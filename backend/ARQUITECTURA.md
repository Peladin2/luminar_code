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

Noticia.php

Expone las operaciones CRUD sobre la tabla Noticia: obtenerTodos(), obtenerPorId(), crear(), actualizar() y eliminar(). El ID_Administrador no se puede modificar al actualizar, solo el contenido de la noticia.

Estadistica.php

Expone las operaciones CRUD sobre la tabla Estadistica: obtenerTodos(), obtenerPorId(), crear(), actualizar() y eliminar(). El ID_Administrador no se puede modificar al actualizar.

Documento.php

Expone las operaciones CRUD sobre la tabla Documento: obtenerTodos(), obtenerPorId(), crear(), actualizar() y eliminar(). El ID_Administrador no se puede modificar al actualizar. El campo Solo_Docentes distingue si el documento es de acceso publico o exclusivo para docentes.

Sugerencia.php

Expone obtenerTodos(), obtenerPorId(), crear() y eliminar() sobre la tabla Sugerencia. No tiene actualizar(), porque no hay ningun requisito que pida poder editar una sugerencia ya enviada. Las consultas de lectura no traen el ID_Usuario en el resultado, ya que segun la RNE-10 las sugerencias se muestran de forma anonima al publico, aunque el vinculo con el usuario sigue existiendo en la tabla.

OfertaEducativa.php

Expone obtenerTodos(), obtenerPorId(), crear(), actualizar() y eliminar() sobre la tabla Oferta_Educativa, que combina Curso, Turno y Anexo (la agregacion Oferta Educativa del DER). Mismo criterio que Evento/Noticia/Estadistica/Documento: el ID_Administrador no se puede modificar al actualizar.

La clase tiene dos formas de listar las ofertas, segun para que se las necesite. obtenerTodos() da los IDs crudos de Curso, Turno y Anexo, util para cuando el administrador edita una oferta y el formulario necesita esos IDs para armar los selects. obtenerTodosConDetalle() en cambio usa INNER JOIN contra las tres tablas para traer los nombres reales en vez de los IDs, pensado para mostrar la oferta educativa al publico (RF-2), donde mostrar un numero suelto no sirve de nada.

Si la oferta tiene Preinscripciones asociadas, el ON DELETE CASCADE de esa relacion hace que se borren junto con ella al eliminarla.

OfertaMateria.php

Maneja la tabla intermedia Oferta_Materia, que en el DER es la relacion "Incluye" entre Oferta_Educativa y Materia, (que materias se dictan en cada oferta concreta). Mismo caso que ProfesorMateria: no tiene ID propio, asi que en vez de CRUD expone asignarMateria(), quitarMateria(), obtenerMateriasDeOferta() y obtenerOfertasDeMateria(), las dos ultimas con INNER JOIN para traer los nombres reales en vez de los IDs.

Preinscripcion.php

Expone obtenerTodos(), obtenerPorId(), obtenerPorUsuario() y crear() sobre la tabla Preinscripcion. No tiene actualizar(), porque segun la RNE-3 la preinscripcion no maneja estados de aprobacion o rechazo, solo existe o se elimina. Tampoco se puede modificar su ID_Usuario o ID_Oferta una vez creada, por la misma razon.

A diferencia del resto de los modelos, crear() no hace un simple INSERT, antes valida tres reglas de negocio, usando tres metodos privados de apoyo (contarPreinscripcionesDeUsuario(), yaExistePreinscripcion() y calcularPosicionLista()) que no tiene sentido llamar desde afuera de la clase.

- RNE-1: rechaza la preinscripcion si el usuario ya tiene 3 preinscripciones.
- RNE-2: rechaza la preinscripcion si el usuario ya esta preinscripto en esa misma oferta.
- RNE-4: si el Cupo_Maximo de la oferta ya esta cubierto, la preinscripcion se crea igual pero con una Posicion_Lista calculada (cuantos ya estan esperando, mas uno), en vez de con Posicion_Lista NULL (que indica confirmado).

Por estas validaciones, crear() no devuelve solo el ID como en los demas modelos, sino un array con exito (true o false) y, segun el caso, mensaje explicando el rechazo, o id y posicionLista si se creo correctamente.

Capa de Presentacion - backend/probar_crud.php

Script de prueba que usa las clases de models para mostrar resultados en pantalla, sin conocer nada de SQL ni de la conexion a la base de datos. 
Cuando el frontend este integrado, esta capa se reemplaza por vistas reales conectadas a los mismos modelos.


Relacion entre las clases

Cada modelo depende de Database (composicion: la usa, pero no hereda de ella). Database no depende de ningun modelo,
lo que permite reutilizarla para futuros modelos sin duplicar la logica de conexion.