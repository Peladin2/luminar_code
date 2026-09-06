Arquitectura del Backend - Luminar Code

El backend está organizado en 3 capas, siguiendo Programación Orientada a Objetos:

Capa de Datos - backend/config/Database.php

Clase responsable de abrir la conexión hacia MySQL usando PDO con consultas preparadas.
Es la única clase que conoce las credenciales de conexión.

Capa de Lógica de Negocio - backend/models/Curso.php

Clase que recibe la conexión de Database en su constructor y expone las operaciones CRUD sobre la tabla Curso: 
obtenerTodos(), obtenerPorId(), crear(), actualizar() y eliminar(). Todas las consultas usan sentencias preparadas 
(prepare + bindParam) para prevenir inyección SQL.

Capa de Presentación - backend/probar_crud.php

Script de prueba que usa la clase Curso para mostrar resultados en pantalla, sin conocer nada de SQL ni de la conexión a la base de datos. 
Cuando el frontend esté integrado, esta capa se reemplaza por vistas reales conectadas a los mismos modelos.

Relación entre las clases

Curso depende de Database (composición: la usa, pero no hereda de ella). Database no depende de Curso,
lo que permite reutilizarla para futuros modelos (Profesor, Materia, Oferta_Educativa, etc.) sin duplicar la lógica de conexión.
