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

Capa de Presentacion - backend/probar_crud.php

Script de prueba que usa las clases de models para mostrar resultados en pantalla, sin conocer nada de SQL ni de la conexion a la base de datos. 
Cuando el frontend este integrado, esta capa se reemplaza por vistas reales conectadas a los mismos modelos.


Relacion entre las clases

Cada modelo depende de Database (composicion: la usa, pero no hereda de ella). Database no depende de ningun modelo,
lo que permite reutilizarla para futuros modelos sin duplicar la logica de conexion.