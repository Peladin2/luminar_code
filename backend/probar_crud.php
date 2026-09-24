<?php

require_once __DIR__ . '/models/Curso.php';

$curso = new Curso();

echo "<h2>Cursos existentes</h2>";
$listaCursos = $curso->obtenerTodos();
foreach ($listaCursos as $fila) {
    echo "ID " . $fila['ID_Curso'] . " - " . $fila['Nombre'] . "<br>";
}

echo "<h2>Crear un curso nuevo</h2>";
$nuevoId = $curso->crear('Bachillerato Tecnológico en Turismo', 'Formación técnica orientada al sector turístico.');
echo "Curso creado con ID: " . $nuevoId . "<br>";

echo "<h2>Actualizar ese curso</h2>";
$curso->actualizar($nuevoId, 'Bachillerato Tecnológico en Turismo', 'Descripción actualizada de prueba.');
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
$profesor->actualizar($nuevoIdProfesor, 'Mariano', 'Peralta Rodríguez');
echo "Profesor actualizado.<br>";

echo "<h2>Ver el profesor actualizado</h2>";
$profesorActualizado = $profesor->obtenerPorId($nuevoIdProfesor);
echo $profesorActualizado['Nombre'] . " " . $profesorActualizado['Apellido'] . "<br>";

echo "<h2>Eliminar el profesor de prueba</h2>";
$profesor->eliminar($nuevoIdProfesor);
echo "Profesor eliminado.<br>";

