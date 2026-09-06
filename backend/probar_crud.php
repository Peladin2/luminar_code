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

