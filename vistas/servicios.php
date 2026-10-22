<?php
$titulo = 'Servicios al estudiante - Escuela Técnica N.º 1';
$ruta = '../';
include '../includes/head.php';
include '../includes/header.php';

// si un dato no lo tenemos, se muestra esto
function dato_o_consultar($dato) {
    if ($dato == '') {
        return 'Consultá en Adscripción';
    }
    return $dato;
}

// comedor 
// falta: decir para quien es el comedor
$comedor = [
    'texto'      => 'Aula comedor de Educación Media FPB',
    'horario'    => 'Turno 1: 13:20 a 13:35 | Turno 3: 12:10 a 12:25 (FPB 11:50 a 12:10)',
    'para_quien' => '',
    'foto'       => ''
];

// integracion backend: el horario de la biblioteca sale de Configuracion (Horario_Biblioteca)
// falta: horario, ubicacion y requisitos del prestamo
$biblioteca = [
    'texto'    => 'Espacio de lectura y estudio, con préstamo de libros y material de consulta para los cursos',
    'horario'  => '',
    'donde'    => '',
    'prestamo' => '',
    'foto'     => ''
];

// las tres secciones que salen de la tabla Actividad, segun el Tipo
// falta: fotos de cada seccion
$secciones = [
    [
        'id'    => 'apoyo',
        'tipo'  => 'apoyo',
        'nombre' => 'Clases de apoyo',
        'texto' => 'Clases para reforzar materias, a cargo de docentes de la escuela',
        'vacio' => 'Por ahora no hay clases de apoyo publicadas',
        'foto'  => ''
    ],
    [
        'id'    => 'extracurriculares',
        'tipo'  => 'extracurricular',
        'nombre' => 'Actividades extracurriculares',
        'texto' => 'Talleres y actividades fuera del horario de clase',
        'vacio' => 'Por ahora no hay actividades publicadas',
        'foto'  => ''
    ],
    [
        'id'    => 'capacitaciones',
        'tipo'  => 'capacitacion',
        'nombre' => 'Capacitaciones',
        'texto' => 'Cursos cortos abiertos a la comunidad, cuando la escuela los ofrece',
        'vacio' => 'Por ahora no hay capacitaciones abiertas',
        'foto'  => ''
    ]
];

// integracion backend: todas las actividades de la tabla Actividad
// datos de prueba
$actividades = [
    [
        'ID_Actividad' => 1,
        'Nombre'       => 'Apoyo de Matemática',
        'Tipo'         => 'apoyo',
        'Horario'      => 'Martes y jueves de 14:00 a 15:00',
        'Lugar'        => 'Sede Central | Aula 4'
    ],
    [
        'ID_Actividad' => 2,
        'Nombre'       => 'Apoyo de Programación',
        'Tipo'         => 'apoyo',
        'Horario'      => 'Miércoles de 17:00 a 18:30',
        'Lugar'        => 'Sede Central | Sala de informática'
    ],
    [
        'ID_Actividad' => 3,
        'Nombre'       => 'Taller de nose',
        'Tipo'         => 'extracurricular',
        'Horario'      => 'Viernes de 15:00 a 17:00',
        'Lugar'        => 'Polideportivo'
    ],
    [
        'ID_Actividad' => 4,
        'Nombre'       => 'Capacitación en primeros auxilios',
        'Tipo'         => 'capacitacion',
        'Horario'      => 'Sábado 14/11 de 9:00 a 12:00',
        'Lugar'        => 'Sede Central'
    ]
];
?>

<main class="container py-4">

    <nav aria-label="Ruta de navegación">
        <ol class="breadcrumb miga">
            <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
            <li class="breadcrumb-item"><a href="mision-vision.php">Institucional</a></li>
            <li class="breadcrumb-item active" aria-current="page">Servicios al estudiante</li>
        </ol>
    </nav>

    <h1>Servicios al estudiante</h1>
    <p class="subtitulo">Lo que la escuela ofrece a sus estudiantes además de las clases</p>

    <nav class="ir-a" aria-label="Ir a una sección">
        <span>Ir a:</span>
        <a href="#comedor">Comedor</a>
        <a href="#biblioteca">Biblioteca</a>
        <?php foreach ($secciones as $seccion) { ?>
            <a href="#<?php echo $seccion['id']; ?>"><?php echo $seccion['nombre']; ?></a>
        <?php } ?>
    </nav>

    <!-- comedor -->
    <section id="comedor" class="tarjeta servicio h-auto mb-4">
        <div class="row g-4">
            <div class="col-md-4">
                <?php if ($comedor['foto'] != '') { ?>
                    <img src="../assets/img/<?php echo $comedor['foto']; ?>" alt="Comedor de la escuela">
                <?php } else { ?>
                    <div class="foto-vacia">Foto del comedor</div>
                <?php } ?>
            </div>
            <div class="col-md-8">
                <h2>Comedor</h2>
                <p class="bajada"><?php echo $comedor['texto']; ?></p>
                <dl class="datos-servicio mb-0">
                    <dt>Horario</dt>
                    <dd><?php echo $comedor['horario']; ?></dd>
                    <dt>Para quién</dt>
                    <dd><?php echo dato_o_consultar($comedor['para_quien']); ?></dd>
                    <dt>Cómo acceder</dt>
                    <dd class="mb-0">Consultá en Adscripción</dd>
                </dl>
            </div>
        </div>
    </section>

    <!-- biblioteca -->
    <section id="biblioteca" class="tarjeta servicio h-auto mb-4">
        <div class="row g-4">
            <div class="col-md-4">
                <?php if ($biblioteca['foto'] != '') { ?>
                    <img src="../assets/img/<?php echo $biblioteca['foto']; ?>" alt="Biblioteca de la escuela">
                <?php } else { ?>
                    <div class="foto-vacia">Foto de la biblioteca</div>
                <?php } ?>
            </div>
            <div class="col-md-8">
                <h2>Biblioteca</h2>
                <p class="bajada"><?php echo $biblioteca['texto']; ?></p>
                <dl class="datos-servicio mb-0">
                    <dt>Horario</dt>
                    <dd><?php echo dato_o_consultar($biblioteca['horario']); ?></dd>
                    <dt>Dónde</dt>
                    <dd><?php echo dato_o_consultar($biblioteca['donde']); ?></dd>
                    <dt>Préstamo de libros</dt>
                    <dd class="mb-0"><?php echo dato_o_consultar($biblioteca['prestamo']); ?></dd>
                </dl>
            </div>
        </div>
    </section>

    <!-- clases de apoyo, extracurriculares y capacitaciones -->
    <?php foreach ($secciones as $seccion) { ?>
        <section id="<?php echo $seccion['id']; ?>" class="tarjeta servicio h-auto mb-4">
            <div class="row g-4">
                <div class="col-md-4">
                    <?php if ($seccion['foto'] != '') { ?>
                        <img src="../assets/img/<?php echo $seccion['foto']; ?>" alt="<?php echo $seccion['nombre']; ?>">
                    <?php } else { ?>
                        <div class="foto-vacia">Sin foto</div>
                    <?php } ?>
                </div>
                <div class="col-md-8">
                    <h2><?php echo $seccion['nombre']; ?></h2>
                    <p class="bajada"><?php echo $seccion['texto']; ?></p>

                    <?php
                    $hay = false;
                    foreach ($actividades as $actividad) {
                        if ($actividad['Tipo'] == $seccion['tipo']) {
                            $hay = true;
                    ?>
                            <div class="actividad">
                                <h3><?php echo htmlspecialchars($actividad['Nombre']); ?></h3>
                                <p>
                                    <?php echo htmlspecialchars($actividad['Horario']); ?>
                                    <?php if ($actividad['Lugar'] != '') { ?>
                                        | <?php echo htmlspecialchars($actividad['Lugar']); ?>
                                    <?php } ?>
                                </p>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <?php if ($hay == false) { ?>
                        <p class="dato-suave mb-0"><?php echo $seccion['vacio']; ?></p>
                    <?php } ?>
                </div>
            </div>
        </section>
    <?php } ?>

    <a href="mision-vision.php" class="link-volver d-inline-block">Volver a Misión y Visión</a>

</main>

<?php include '../includes/footer.php'; ?>