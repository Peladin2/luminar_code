<?php
$titulo = 'Oferta educativa - Escuela Técnica N.º 1';
$ruta = '../';
include '../includes/head.php';
include '../includes/header.php';

// opciones de los filtros
// el nivel es una lista fija (Curso.Nivel)
$opciones_nivel = [
    'CPI'       => 'Capacitación Profesional Inicial (CPI)',
    'EBI'       => 'Educación Básica Integrada (EBI)',
    'FPB'       => 'Formación Profesional Básica (FPB)',
    'BT'        => 'Bachillerato Tecnológico (BT)',
    'BTP'       => 'Bachillerato Técnico Profesional (BTP)',
    'CTT'       => 'Cursos Técnicos Terciarios (CTT)',
    'Tecnologo' => 'Tecnólogo'
];

// integracion backend: turnos y sedes salen de las tablas Turno y Anexo
$opciones_turno = [
    1 => 'Turno 1 · Mañana',
    2 => 'Turno 2 · Intermedio',
    3 => 'Turno 3 · Tarde',
    4 => 'Turno 4 · Tarde-noche',
    5 => 'Turno 5 · Noche'
];

$opciones_sede = [
    1 => 'Sede Central',
    2 => 'Baltasar Brum',
    3 => 'Tomás Gomensoro'
];

// lo que eligio el usuario (vacio = todos)
$anio = date('Y');
if (isset($_GET['anio'])) {
    $anio = $_GET['anio'];
}

$nivel = '';
if (isset($_GET['nivel'])) {
    $nivel = $_GET['nivel'];
}

$turno = '';
if (isset($_GET['turno'])) {
    $turno = $_GET['turno'];
}

$sede = '';
if (isset($_GET['sede'])) {
    $sede = $_GET['sede'];
}

// integracion backend: ofertas educativas con su curso, turno y sede
// datos de prueba
$ofertas = [
    [
        'ID_Curso'     => 1,
        'Nombre'       => 'Bachillerato Tecnológico en Informática',
        'Nivel'        => 'BT',
        'ID_Turno'     => 3,
        'Hora_Entrada' => '12:35:00',
        'Hora_Salida'  => '18:50:00',
        'Grados'       => '1.º, 2.º y 3.º',
        'ID_Anexo'     => 1,
        'Cupo_Maximo'  => 25,
        'Anio_Lectivo' => 2026
    ],
    [
        'ID_Curso'     => 2,
        'Nombre'       => 'Bachillerato Tecnológico en Administración',
        'Nivel'        => 'BT',
        'ID_Turno'     => 1,
        'Hora_Entrada' => '07:00:00',
        'Hora_Salida'  => '13:20:00',
        'Grados'       => '1.º, 2.º y 3.º',
        'ID_Anexo'     => 1,
        'Cupo_Maximo'  => 30,
        'Anio_Lectivo' => 2026
    ],
    [
        'ID_Curso'     => 3,
        'Nombre'       => 'Educación Básica Integrada (EBI)',
        'Nivel'        => 'EBI',
        'ID_Turno'     => 1,
        'Hora_Entrada' => '07:00:00',
        'Hora_Salida'  => '13:20:00',
        'Grados'       => '7.º, 8.º y 9.º',
        'ID_Anexo'     => 1,
        'Cupo_Maximo'  => 30,
        'Anio_Lectivo' => 2026
    ],
    [
        'ID_Curso'     => 4,
        'Nombre'       => 'FPB Gastronomía',
        'Nivel'        => 'FPB',
        'ID_Turno'     => 3,
        'Hora_Entrada' => '12:35:00',
        'Hora_Salida'  => '18:50:00',
        'Grados'       => '1.º y 2.º',
        'ID_Anexo'     => 1,
        'Cupo_Maximo'  => 20,
        'Anio_Lectivo' => 2026
    ],
    [
        'ID_Curso'     => 5,
        'Nombre'       => 'BTP Cocina',
        'Nivel'        => 'BTP',
        'ID_Turno'     => 3,
        'Hora_Entrada' => '12:35:00',
        'Hora_Salida'  => '18:50:00',
        'Grados'       => '3.º',
        'ID_Anexo'     => 2,
        'Cupo_Maximo'  => 25,
        'Anio_Lectivo' => 2026
    ],
    [
        'ID_Curso'     => 6,
        'Nombre'       => 'Bachillerato Tecnológico Agrario Rural',
        'Nivel'        => 'BT',
        'ID_Turno'     => 1,
        'Hora_Entrada' => '07:00:00',
        'Hora_Salida'  => '13:20:00',
        'Grados'       => '1.º, 2.º y 3.º',
        'ID_Anexo'     => 2,
        'Cupo_Maximo'  => 25,
        'Anio_Lectivo' => 2026
    ],
    [
        'ID_Curso'     => 7,
        'Nombre'       => 'Bachillerato Tecnológico en Gestión y Administración',
        'Nivel'        => 'BT',
        'ID_Turno'     => 3,
        'Hora_Entrada' => '12:35:00',
        'Hora_Salida'  => '18:50:00',
        'Grados'       => '1.º, 2.º y 3.º',
        'ID_Anexo'     => 3,
        'Cupo_Maximo'  => 25,
        'Anio_Lectivo' => 2026
    ],
    [
        'ID_Curso'     => 8,
        'Nombre'       => 'CTT Redes y Software',
        'Nivel'        => 'CTT',
        'ID_Turno'     => 5,
        'Hora_Entrada' => '18:10:00',
        'Hora_Salida'  => '23:55:00',
        'Grados'       => '1.º y 2.º',
        'ID_Anexo'     => 1,
        'Cupo_Maximo'  => 30,
        'Anio_Lectivo' => 2026
    ],
    [
        'ID_Curso'     => 9,
        'Nombre'       => 'Tecnólogo en Sistemas de Producción Agropecuaria Familiar',
        'Nivel'        => 'Tecnologo',
        'ID_Turno'     => 5,
        'Hora_Entrada' => '18:10:00',
        'Hora_Salida'  => '23:55:00',
        'Grados'       => '1.º, 2.º y 3.º',
        'ID_Anexo'     => 1,
        'Cupo_Maximo'  => 25,
        'Anio_Lectivo' => 2026
    ],
    [
        'ID_Curso'     => 10,
        'Nombre'       => 'CPI Electrotecnia básica',
        'Nivel'        => 'CPI',
        'ID_Turno'     => 5,
        'Hora_Entrada' => '18:10:00',
        'Hora_Salida'  => '23:55:00',
        'Grados'       => 'Nivel único',
        'ID_Anexo'     => 1,
        'Cupo_Maximo'  => 25,
        'Anio_Lectivo' => 2026
    ],
    [
        'ID_Curso'     => 1,
        'Nombre'       => 'Bachillerato Tecnológico en Informática',
        'Nivel'        => 'BT',
        'ID_Turno'     => 3,
        'Hora_Entrada' => '12:35:00',
        'Hora_Salida'  => '18:50:00',
        'Grados'       => '1.º',
        'ID_Anexo'     => 1,
        'Cupo_Maximo'  => 30,
        'Anio_Lectivo' => 2027
    ]
];

// saca los segundos: 07:00:00 a 07:00
function hora($texto) {
    return substr($texto, 0, 5);
}

// se quedan solo las ofertas que cumplen con los filtros
$resultado = [];
foreach ($ofertas as $oferta) {
    if ($oferta['Anio_Lectivo'] != $anio) {
        continue;
    }
    if ($nivel != '' && $oferta['Nivel'] != $nivel) {
        continue;
    }
    if ($turno != '' && $oferta['ID_Turno'] != $turno) {
        continue;
    }
    if ($sede != '' && $oferta['ID_Anexo'] != $sede) {
        continue;
    }
    $resultado[] = $oferta;
}

$anio_actual = date('Y');
?>

<main class="container py-4">

    <nav aria-label="Ruta de navegación">
        <ol class="breadcrumb miga">
            <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Oferta educativa</li>
        </ol>
    </nav>

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <h1 class="mb-0">Oferta educativa <?php echo htmlspecialchars($anio); ?></h1>
        <div class="d-flex flex-wrap gap-3">
            <a href="asignaturas.php" class="link-volver">Ver todas las asignaturas</a>
            <a href="horarios.php" class="link-volver">Ver horarios de los cursos</a>
        </div>
    </div>

    <!-- filtros -->
    <section class="tarjeta h-auto filtros mb-4">
        <div class="ir-a mt-0 mb-3">
            <span>Año lectivo:</span>
            <a href="oferta.php?anio=<?php echo $anio_actual; ?>" class="<?php if ($anio == $anio_actual) { echo 'activo'; } ?>"><?php echo $anio_actual; ?> (vigente)</a>
            <a href="oferta.php?anio=<?php echo $anio_actual + 1; ?>" class="<?php if ($anio == $anio_actual + 1) { echo 'activo'; } ?>"><?php echo $anio_actual + 1; ?> (prevista)</a>
        </div>

        <form action="oferta.php" method="get" class="row g-2 align-items-end">
            <input type="hidden" name="anio" value="<?php echo htmlspecialchars($anio); ?>">

            <div class="col-sm-6 col-lg-3">
                <label for="nivel" class="form-label">Nivel</label>
                <select id="nivel" name="nivel" class="form-select">
                    <option value="">Todos</option>
                    <?php foreach ($opciones_nivel as $codigo => $nombre) { ?>
                        <option value="<?php echo $codigo; ?>" <?php if ($nivel == $codigo) { echo 'selected'; } ?>><?php echo $nombre; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-sm-6 col-lg-3">
                <label for="turno" class="form-label">Turno</label>
                <select id="turno" name="turno" class="form-select">
                    <option value="">Todos</option>
                    <?php foreach ($opciones_turno as $id => $nombre) { ?>
                        <option value="<?php echo $id; ?>" <?php if ($turno == $id) { echo 'selected'; } ?>><?php echo $nombre; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-sm-6 col-lg-3">
                <label for="sede" class="form-label">Sede</label>
                <select id="sede" name="sede" class="form-select">
                    <option value="">Todas</option>
                    <?php foreach ($opciones_sede as $id => $nombre) { ?>
                        <option value="<?php echo $id; ?>" <?php if ($sede == $id) { echo 'selected'; } ?>><?php echo $nombre; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-sm-6 col-lg-3 d-flex gap-2">
                <button type="submit" class="btn btn-dorado flex-grow-1">Filtrar</button>
                <a href="oferta.php?anio=<?php echo htmlspecialchars($anio); ?>" class="btn btn-borde">Limpiar</a>
            </div>
        </form>
    </section>

    <!-- ofertas -->
    <?php if (count($resultado) == 0) { ?>

        <div class="aviso">
            <img src="../assets/iconos/aviso-info.png" alt="Información" class="icono-aviso">
            <div>
                <strong>No hay ofertas con esos filtros</strong>
                <p class="mb-0">Probá con otro nivel, turno o sede, o tocá "Limpiar" para ver todas</p>
            </div>
        </div>

    <?php } else { ?>

        <?php foreach ($resultado as $oferta) { ?>
            <article class="tarjeta h-auto tarjeta-oferta mb-3">
                <div>
                    <h2><?php echo htmlspecialchars($oferta['Nombre']); ?></h2>
                    <p class="mb-1">
                        <?php echo $opciones_nivel[$oferta['Nivel']]; ?> |
                        <?php echo $opciones_turno[$oferta['ID_Turno']]; ?>
                        (<?php echo hora($oferta['Hora_Entrada']); ?> a <?php echo hora($oferta['Hora_Salida']); ?>)
                    </p>
                    <p class="dato-suave mb-0">Grados: <?php echo $oferta['Grados']; ?></p>
                    <p class="dato-suave mb-0">Sede: <?php echo $opciones_sede[$oferta['ID_Anexo']]; ?></p>
                </div>
                <div class="lado-oferta">
                    <span class="etiqueta-cupos"><?php echo $oferta['Cupo_Maximo']; ?> cupos</span>
                    <a href="curso.php?id=<?php echo $oferta['ID_Curso']; ?>" class="btn btn-dorado btn-sm">Ver detalle</a>
                </div>
            </article>
        <?php } ?>

    <?php } ?>

</main>

<?php include '../includes/footer.php'; ?>