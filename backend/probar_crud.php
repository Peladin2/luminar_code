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

// Profesor

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

// Materia

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

// ProfesorMateria

require_once __DIR__ . '/models/ProfesorMateria.php';

$profesorMateria = new ProfesorMateria();

echo "<h2>Asignar una materia a un profesor</h2>";
$profesorMateria->asignarMateria(1, 3);
echo "Se asigno la materia con ID 3 al profesor con ID 1.<br>";

echo "<h2>Materias del profesor 1</h2>";
$materiasDelProfesor = $profesorMateria->obtenerMateriasDeProfesor(1);
foreach ($materiasDelProfesor as $fila) {
    echo $fila['Nombre'] . "<br>";
}

echo "<h2>Profesores de la materia 3</h2>";
$profesoresDeMateria = $profesorMateria->obtenerProfesoresDeMateria(3);
foreach ($profesoresDeMateria as $fila) {
    echo $fila['Nombre'] . " " . $fila['Apellido'] . "<br>";
}

echo "<h2>Quitar esa materia del profesor</h2>";
$profesorMateria->quitarMateria(1, 3);
echo "Se quito la materia con ID 3 del profesor con ID 1.<br>";

// Anexo

require_once __DIR__ . '/models/Anexo.php';

$anexo = new Anexo();

echo "<h2>Anexos existentes</h2>";
$listaAnexos = $anexo->obtenerTodos();
foreach ($listaAnexos as $fila) {
    echo "ID " . $fila['ID_Anexo'] . " - " . $fila['Nombre'] . "<br>";
}

echo "<h2>Crear un anexo nuevo</h2>";
$nuevoIdAnexo = $anexo->crear('Anexo polideportivo', 'Anexo orientado al deporte.');
echo "Anexo creado con ID: " . $nuevoIdAnexo . "<br>";

echo "<h2>Actualizar ese anexo</h2>";
$anexo->actualizar($nuevoIdAnexo, 'Anexo polideportivo', 'Descripcion actualizada de prueba.');
echo "Anexo actualizado.<br>";

echo "<h2>Ver el anexo actualizado</h2>";
$anexoActualizado = $anexo->obtenerPorId($nuevoIdAnexo);
echo $anexoActualizado['Nombre'] . " - " . $anexoActualizado['Descripcion'] . "<br>";

echo "<h2>Eliminar el anexo de prueba</h2>";
$anexo->eliminar($nuevoIdAnexo);
echo "Anexo eliminado.<br>";

// Turno

require_once __DIR__ . '/models/Turno.php';

$turno = new Turno();

echo "<h2>Turnos existentes</h2>";
$listaTurnos = $turno->obtenerTodos();
foreach ($listaTurnos as $fila) {
    echo "ID " . $fila['ID_Turno'] . " - Turno " . $fila['Numero_Turno'] . ": " . $fila['Descripcion'] . " (" . $fila['Hora_Entrada'] . " a " . $fila['Hora_Salida'] . ")<br>";
}

echo "<h2>Crear un turno nuevo</h2>";
$nuevoIdTurno = $turno->crear(6, 'nose', '08:00:00', '12:00:00');
echo "Turno creado con ID: " . $nuevoIdTurno . "<br>";

echo "<h2>Actualizar ese turno</h2>";
$turno->actualizar($nuevoIdTurno, 6, 'nose Extendido', '08:00:00', '13:00:00');
echo "Turno actualizado.<br>";

echo "<h2>Ver el turno actualizado</h2>";
$turnoActualizado = $turno->obtenerPorId($nuevoIdTurno);
echo $turnoActualizado['Descripcion'] . " - " . $turnoActualizado['Hora_Entrada'] . " a " . $turnoActualizado['Hora_Salida'] . "<br>";

echo "<h2>Eliminar el turno de prueba</h2>";
$turno->eliminar($nuevoIdTurno);
echo "Turno eliminado.<br>";

// Evento

require_once __DIR__ . '/models/Evento.php';

$evento = new Evento();

echo "<h2>Eventos existentes</h2>";
$listaEventos = $evento->obtenerTodos();
foreach ($listaEventos as $fila) {
    echo "ID " . $fila['ID_Evento'] . " - " . $fila['Titulo'] . " (" . $fila['Fecha'] . ")<br>";
}

echo "<h2>Crear un evento nuevo</h2>";
$nuevoIdEvento = $evento->crear('Dia del estudiante', '2026-11-15', 'Actividades para los estudiantes.', null, 1);
echo "Evento creado con ID: " . $nuevoIdEvento . "<br>";

echo "<h2>Actualizar ese evento</h2>";
$evento->actualizar($nuevoIdEvento, 'Dia del estudiante y nose', '2026-11-15', 'Descripcion actualizada de prueba.', null);
echo "Evento actualizado.<br>";

echo "<h2>Ver el evento actualizado</h2>";
$eventoActualizado = $evento->obtenerPorId($nuevoIdEvento);
echo $eventoActualizado['Titulo'] . " - " . $eventoActualizado['Descripcion'] . "<br>";

echo "<h2>Eliminar el evento de prueba</h2>";
$evento->eliminar($nuevoIdEvento);
echo "Evento eliminado.<br>";

// Noticia

require_once __DIR__ . '/models/Noticia.php';

$noticia = new Noticia();

echo "<h2>Noticias existentes</h2>";
$listaNoticias = $noticia->obtenerTodos();
foreach ($listaNoticias as $fila) {
    echo "ID " . $fila['ID_Noticia'] . " - " . $fila['Titulo'] . " (" . $fila['Fecha'] . ")<br>";
}

echo "<h2>Crear una noticia nueva</h2>";
$nuevoIdNoticia = $noticia->crear('Suspension de clases', '2026-09-30', 'Se suspenden las clases por corte de agua.', null, 1);
echo "Noticia creada con ID: " . $nuevoIdNoticia . "<br>";

echo "<h2>Actualizar esa noticia</h2>";
$noticia->actualizar($nuevoIdNoticia, 'Suspension de clases confirmada', '2026-09-30', 'Descripcion actualizada de prueba.', null);
echo "Noticia actualizada.<br>";

echo "<h2>Ver la noticia actualizada</h2>";
$noticiaActualizada = $noticia->obtenerPorId($nuevoIdNoticia);
echo $noticiaActualizada['Titulo'] . " - " . $noticiaActualizada['Descripcion'] . "<br>";

echo "<h2>Eliminar la noticia de prueba</h2>";
$noticia->eliminar($nuevoIdNoticia);
echo "Noticia eliminada.<br>";

//Estadistica

require_once __DIR__ . '/models/Estadistica.php';

$estadistica = new Estadistica();

echo "<h2>Estadisticas existentes</h2>";
$listaEstadisticas = $estadistica->obtenerTodos();
foreach ($listaEstadisticas as $fila) {
    echo "ID " . $fila['ID_Estadistica'] . " - " . $fila['Titulo'] . ": " . $fila['Valor'] . " (" . $fila['Anio'] . ")<br>";
}

echo "<h2>Crear una estadistica nueva</h2>";
$nuevoIdEstadistica = $estadistica->crear('Cantidad de docentes', '85', 2026, 1);
echo "Estadistica creada con ID: " . $nuevoIdEstadistica . "<br>";

echo "<h2>Actualizar esa estadistica</h2>";
$estadistica->actualizar($nuevoIdEstadistica, 'Cantidad de docentes activos', '90', 2026);
echo "Estadistica actualizada.<br>";

echo "<h2>Ver la estadistica actualizada</h2>";
$estadisticaActualizada = $estadistica->obtenerPorId($nuevoIdEstadistica);
echo $estadisticaActualizada['Titulo'] . " - " . $estadisticaActualizada['Valor'] . "<br>";

echo "<h2>Eliminar la estadistica de prueba</h2>";
$estadistica->eliminar($nuevoIdEstadistica);
echo "Estadistica eliminada.<br>";

//Documento

require_once __DIR__ . '/models/Documento.php';

$documento = new Documento();

echo "<h2>Documentos existentes</h2>";
$listaDocumentos = $documento->obtenerTodos();
foreach ($listaDocumentos as $fila) {
    $soloDocentesTexto = $fila['Solo_Docentes'] == 1 ? "Si" : "No";
    echo "ID " . $fila['ID_Documento'] . " - " . $fila['Nombre'] . " (Solo docentes: " . $soloDocentesTexto . ")<br>";
}

echo "<h2>Crear un documento nuevo</h2>";
$nuevoIdDocumento = $documento->crear('Reglamento de Convivencia', 'Normas de convivencia institucional.', '/documentos/reglamento_convivencia.pdf', 0, 1);
echo "Documento creado con ID: " . $nuevoIdDocumento . "<br>";

echo "<h2>Actualizar ese documento</h2>";
$documento->actualizar($nuevoIdDocumento, 'Reglamento de Convivencia', 'Descripcion actualizada de prueba.', '/documentos/reglamento_convivencia.pdf', 0);
echo "Documento actualizado.<br>";

echo "<h2>Ver el documento actualizado</h2>";
$documentoActualizado = $documento->obtenerPorId($nuevoIdDocumento);
echo $documentoActualizado['Nombre'] . " - " . $documentoActualizado['Descripcion'] . "<br>";

echo "<h2>Eliminar el documento de prueba</h2>";
$documento->eliminar($nuevoIdDocumento);
echo "Documento eliminado.<br>";

//Sugerencia

require_once __DIR__ . '/models/Sugerencia.php';

$sugerencia = new Sugerencia();

echo "<h2>Sugerencias existentes</h2>";
$listaSugerencias = $sugerencia->obtenerTodos();
foreach ($listaSugerencias as $fila) {
    echo "ID " . $fila['ID_Sugerencia'] . " - " . $fila['Contenido'] . " (" . $fila['Fecha'] . ")<br>";
}

echo "<h2>Crear una sugerencia nueva</h2>";
$nuevoIdSugerencia = $sugerencia->crear('Seria bueno tener un bebedero en el patio.', '2026-09-28', 3);
echo "Sugerencia creada con ID: " . $nuevoIdSugerencia . "<br>";

echo "<h2>Ver la sugerencia creada</h2>";
$sugerenciaCreada = $sugerencia->obtenerPorId($nuevoIdSugerencia);
echo $sugerenciaCreada['Contenido'] . "<br>";

echo "<h2>Eliminar la sugerencia de prueba</h2>";
$sugerencia->eliminar($nuevoIdSugerencia);
echo "Sugerencia eliminada.<br>";

//OfertaEducativa

require_once __DIR__ . '/models/OfertaEducativa.php';

$ofertaEducativa = new OfertaEducativa();

echo "<h2>Ofertas educativas con detalle</h2>";
$listaOfertas = $ofertaEducativa->obtenerTodosConDetalle();
foreach ($listaOfertas as $fila) {
    echo $fila['Grado'] . " - " . $fila['NombreCurso'] . " (" . $fila['NombreTurno'] . ", " . $fila['NombreAnexo'] . ") - Cupo: " . $fila['Cupo_Maximo'] . "<br>";
}

echo "<h2>Crear una oferta nueva</h2>";
$nuevoIdOferta = $ofertaEducativa->crear('2°', 28, 1, 2, 1, 1);
echo "Oferta creada con ID: " . $nuevoIdOferta . "<br>";

echo "<h2>Actualizar esa oferta</h2>";
$ofertaEducativa->actualizar($nuevoIdOferta, '2°', 30, 1, 2, 1);
echo "Oferta actualizada.<br>";

echo "<h2>Ver la oferta actualizada</h2>";
$ofertaActualizada = $ofertaEducativa->obtenerPorId($nuevoIdOferta);
echo "Grado " . $ofertaActualizada['Grado'] . " - Cupo " . $ofertaActualizada['Cupo_Maximo'] . "<br>";

echo "<h2>Eliminar la oferta de prueba</h2>";
$ofertaEducativa->eliminar($nuevoIdOferta);
echo "Oferta eliminada.<br>";

//OfertaMateria

require_once __DIR__ . '/models/OfertaMateria.php';

$ofertaMateria = new OfertaMateria();

echo "<h2>Asignar una materia a una oferta</h2>";
$ofertaMateria->asignarMateria(1, 3);
echo "Se asigno la materia con ID 3 a la oferta con ID 1.<br>";

echo "<h2>Materias de la oferta 1</h2>";
$materiasDeOferta = $ofertaMateria->obtenerMateriasDeOferta(1);
foreach ($materiasDeOferta as $fila) {
    echo $fila['Nombre'] . "<br>";
}

echo "<h2>Ofertas que incluyen la materia 3</h2>";
$ofertasDeMateria = $ofertaMateria->obtenerOfertasDeMateria(3);
foreach ($ofertasDeMateria as $fila) {
    echo "Oferta ID " . $fila['ID_Oferta'] . " - Grado " . $fila['Grado'] . "<br>";
}

echo "<h2>Quitar esa materia de la oferta</h2>";
$ofertaMateria->quitarMateria(1, 3);
echo "Se quito la materia con ID 3 de la oferta con ID 1.<br>";

//Preinscripcion

require_once __DIR__ . '/models/Preinscripcion.php';

$preinscripcion = new Preinscripcion();

echo "<h2>Crear una oferta de prueba con cupo 1</h2>";
$idOfertaPrueba = $ofertaEducativa->crear('1°', 1, 1, 1, 1, 1);
echo "Oferta de prueba creada con ID: " . $idOfertaPrueba . " (cupo maximo 1)<br>";

echo "<h2>Primera preinscripcion a la oferta de prueba (usuario 5)</h2>";
$resultado1 = $preinscripcion->crear('2026-10-04', null, 5, $idOfertaPrueba);
echo $resultado1['mensaje'] ?? "Preinscripcion creada con ID " . $resultado1['id'] . ", posicion en lista: " . ($resultado1['posicionLista'] ?? 'confirmado, sin lista de espera') . "<br>";

echo "<h2>Segunda preinscripcion a la misma oferta (usuario 6, cupo ya lleno)</h2>";
$resultado2 = $preinscripcion->crear('2026-10-04', null, 6, $idOfertaPrueba);
echo $resultado2['mensaje'] ?? "Preinscripcion creada con ID " . $resultado2['id'] . ", posicion en lista: " . ($resultado2['posicionLista'] ?? 'confirmado, sin lista de espera') . "<br>";

echo "<h2>Intentar preinscribir al usuario 5 de nuevo a la misma oferta (debe fallar, RNE-2)</h2>";
$resultado3 = $preinscripcion->crear('2026-10-04', null, 5, $idOfertaPrueba);
echo $resultado3['exito'] ? "Se creo (no deberia)" : $resultado3['mensaje'];
echo "<br>";

echo "<h2>Tercera preinscripcion del usuario 3 (ya tenia 2, esta lo lleva a 3)</h2>";
$resultado4 = $preinscripcion->crear('2026-10-04', null, 3, $idOfertaPrueba);
echo $resultado4['mensaje'] ?? "Preinscripcion creada con ID " . $resultado4['id'] . ", posicion en lista: " . ($resultado4['posicionLista'] ?? 'confirmado, sin lista de espera') . "<br>";

echo "<h2>Cuarta preinscripcion del usuario 3 (debe fallar, RNE-1)</h2>";
$resultado5 = $preinscripcion->crear('2026-10-04', null, 3, 1);
echo $resultado5['exito'] ? "Se creo (no deberia)" : $resultado5['mensaje'];
echo "<br>";

echo "<h2>Limpiar: eliminar la oferta de prueba (borra en cascada las preinscripciones de prueba)</h2>";
$ofertaEducativa->eliminar($idOfertaPrueba);
echo "Oferta de prueba eliminada.<br>";

