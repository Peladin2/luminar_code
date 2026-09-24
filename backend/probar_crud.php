<?php

require_once __DIR__ . '/models/Curso.php';

$curso = new Curso();

echo "<h2>Cursos existentes</h2>";
$listaCursos = $curso->obtenerTodos();
foreach ($listaCursos as $fila) {
    echo "ID " . $fila['ID_Curso'] . " - " . $fila['Nombre'] . "<br>";
}

echo "<h2>Crear un curso nuevo</h2>";
$nuevoId = $curso->crear('Bachillerato Tecnologico en Programacion', 'Formacion tecnica orientada al sector informatico.');
echo "Curso creado con ID: " . $nuevoId . "<br>";

echo "<h2>Actualizar ese curso</h2>";
$curso->actualizar($nuevoId, 'Bachillerato Tecnologico en Programacion', 'Descripcion actualizada de prueba.');
echo "Curso actualizado.<br>";

echo "<h2>Ver el curso actualizado</h2>";
$actualizado = $curso->obtenerPorId($nuevoId);
echo $actualizado['Nombre'] . " - " . $actualizado['Descripcion'] . "<br>";

echo "<h2>Eliminar el curso de prueba</h2>";
$curso->eliminar($nuevoId);
echo "Curso eliminado.<br>";

require_once __DIR__ . '/models/Profesor.php';

$profesor = new Profesor();

echo "<h2>Profesores existentes</h2>";
$listaProfesores = $profesor->obtenerTodos();
foreach ($listaProfesores as $fila) {
    echo "ID " . $fila['ID_Profesor'] . " - " . $fila['Nombre'] . " " . $fila['Apellido'] . "<br>";
}

echo "<h2>Crear un profesor nuevo</h2>";
$nuevoIdProfesor = $profesor->crear('Mariano', 'Peralta');
echo "Profesor creado con ID: " . $nuevoIdProfesor . "<br>";

echo "<h2>Actualizar ese profesor</h2>";
$profesor->actualizar($nuevoIdProfesor, 'Mariano', 'Peralta Rodriguez');
echo "Profesor actualizado.<br>";

echo "<h2>Ver el profesor actualizado</h2>";
$profesorActualizado = $profesor->obtenerPorId($nuevoIdProfesor);
echo $profesorActualizado['Nombre'] . " " . $profesorActualizado['Apellido'] . "<br>";

echo "<h2>Eliminar el profesor de prueba</h2>";
$profesor->eliminar($nuevoIdProfesor);
echo "Profesor eliminado.<br>";

require_once __DIR__ . '/models/Materia.php';

$materia = new Materia();

echo "<h2>Materias existentes</h2>";
$listaMaterias = $materia->obtenerTodos();
foreach ($listaMaterias as $fila) {
    echo "ID " . $fila['ID_Materia'] . " - " . $fila['Nombre'] . "<br>";
}

echo "<h2>Crear una materia nueva</h2>";
$nuevoIdMateria = $materia->crear('Contabilidad');
echo "Materia creada con ID: " . $nuevoIdMateria . "<br>";

echo "<h2>Actualizar esa materia</h2>";
$materia->actualizar($nuevoIdMateria, 'Contabilidad y Gestion');
echo "Materia actualizada.<br>";

echo "<h2>Ver la materia actualizada</h2>";
$materiaActualizada = $materia->obtenerPorId($nuevoIdMateria);
echo $materiaActualizada['Nombre'] . "<br>";

echo "<h2>Eliminar la materia de prueba</h2>";
$materia->eliminar($nuevoIdMateria);
echo "Materia eliminada.<br>";

