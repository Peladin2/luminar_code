# Luminar_Code - Sistema web Escuela Tecnica N.1
Repositorio del proyecto final de bachillerato tecnologia de la informacion 2026.

## Descripcion
Sisstema web institucional para la Escuela Tecnica N.1 de Bella Union, Uruguay.
Permite gestionar y difundir informacion institucional, evento, noticias, becas, preinscripciones y mas.

## Integrantes
- Leandro - Coordinador / Documentador
- Christian - Analista / Tester
- Renzo - Frontend / Diseñador / UX
- Franco - Subcoordinador / Admin S.O.
- Ricardo - Backend / Admin BD

## Tecnologias
Fronted: HTML5, CSS3, JavaScript, Bootstrap 5.3
Backend: PHP 8.0+
Base de datos: MySQL 8.0+
Servidor: Apache 2.4+
Control de versiones: GitHub

## Requisitos para ejecutar el proyecto
XAMPP o Laragon instalado (incluye Apache, PHP y MySQL)
Visual Studio Code recomendado como editor
Git instalado

## Instalacion
1. Clonar el repositorio
2. Copiar la carpeta del proyecto dentro de htdocs (XAMPP) 
3. Abrir phpMyAdmin y ejecutar los scripts SQL de la carpeta database/, en este orden:
   - ddl_luminarcode.sql (crea la base de datos y las 17 tablas)
   - permiso_usuarios.sql (crea los usuarios de MySQL de la aplicacion)
   - datos_prueba.sql (carga datos de prueba)
4. Verificar la conexion en backend/config/Database.php (usuario y clave ya configurados)
5. Abrir el navegador en localhost/luminar_code

## Convenciones de commits
- feat: nueva funcionalidad
- fix: correccion de errores
- docs: cambios en documentacion
- db: cambios relacionados a la base de datos
## Estado del proyecto
Segunda entrega en curso - 07/09/2026
