<?php
$ruta = '../';

// integracion backend: buscar el evento por ID_Evento
// datos de prueba (los mismos que en eventos.php)
$eventos = [
    [
        'ID_Evento'   => 1,
        'Titulo'      => 'Torneo deportivo en el Polideportivo',
        'Fecha'       => '2026-08-21',
        'Hora'        => '14:00:00',
        'Lugar'       => 'Polideportivo',
        'Descripcion' => "Torneo de fútbol y vóleibol entre los grupos de todos los turnos.\n\nGracias a todos los que participaron.",
        'URL_Imagen'  => 'assets/img/sedes/polideportivo.jpg'
    ],
    [
        'ID_Evento'   => 2,
        'Titulo'      => 'Jornada de puertas abiertas',
        'Fecha'       => '2026-09-18',
        'Hora'        => '09:00:00',
        'Lugar'       => 'Sede Central',
        'Descripcion' => 'Las familias y futuros estudiantes recorrieron los talleres y conocieron los cursos.',
        'URL_Imagen'  => ''
    ],
    [
        'ID_Evento'   => 3,
        'Titulo'      => 'Fogón de fin de año',
        'Fecha'       => '2026-11-05',
        'Hora'        => '19:00:00',
        'Lugar'       => 'Patio de la Sede Central',
        'Descripcion' => "Música, comida y entrega de reconocimientos del año.\n\nEstán invitados estudiantes, familias y docentes.",
        'URL_Imagen'  => 'assets/img/fachada.jpg'
    ],
    [
        'ID_Evento'   => 4,
        'Titulo'      => 'Muestra de proyectos de fin de curso',
        'Fecha'       => '2026-11-27',
        'Hora'        => '',
        'Lugar'       => 'Sede Central',
        'Descripcion' => 'Los estudiantes presentan los proyectos que hicieron durante el año.',
        'URL_Imagen'  => ''
    ]
];

// integracion backend: fotos y videos de Multimedia con el ID_Evento de este evento
// datos de prueba (fotos reales de las sedes)
$multimedia = [
    [
        'ID_Multimedia' => 1,
        'Tipo'          => 'foto',
        'URL'           => 'assets/img/sedes/polideportivo.jpg',
        'Descripcion'   => 'El Polideportivo',
        'ID_Evento'     => 1
    ],
    [
        'ID_Multimedia' => 2,
        'Tipo'          => 'foto',
        'URL'           => 'assets/img/sedes/central.jpg',
        'Descripcion'   => 'Llegada a la Sede Central',
        'ID_Evento'     => 2
    ],
    [
        'ID_Multimedia' => 3,
        'Tipo'          => 'foto',
        'URL'           => 'assets/img/fachada.jpg',
        'Descripcion'   => 'Entrada de la escuela',
        'ID_Evento'     => 2
    ],
    [
        'ID_Multimedia' => 4,
        'Tipo'          => 'video',
        'URL'           => 'https://www.youtube.com/',
        'Descripcion'   => 'Recorrida por los talleres',
        'ID_Evento'     => 2
    ]
];

$meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'setiembre', 'octubre', 'noviembre', 'diciembre'];

// busca el evento con el id de la url
$evento = null;
if (isset($_GET['id'])) {
    foreach ($eventos as $e) {
        if ($e['ID_Evento'] == $_GET['id']) {
            $evento = $e;
        }
    }
}

if ($evento != null) {
    $titulo = $evento['Titulo'] . ' - Escuela Técnica N.º 1';

    // fecha larga: 5 de noviembre de 2026
    $fecha = strtotime($evento['Fecha']);
    $fecha_larga = date('j', $fecha) . ' de ' . $meses[date('n', $fecha) - 1] . ' de ' . date('Y', $fecha);

    $ya_paso = $fecha < strtotime('today');

    // separa las fotos y los videos de este evento
    $fotos = [];
    $videos = [];
    foreach ($multimedia as $m) {
        if ($m['ID_Evento'] == $evento['ID_Evento']) {
            if ($m['Tipo'] == 'foto') {
                $fotos[] = $m;
            } else {
                $videos[] = $m;
            }
        }
    }
} else {
    $titulo = 'Evento no encontrado - Escuela Técnica N.º 1';
}

include '../includes/head.php';
include '../includes/header.php';
?>

<main class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <nav aria-label="Ruta de navegación">
                <ol class="breadcrumb miga">
                    <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="eventos.php">Eventos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Evento</li>
                </ol>
            </nav>

            <?php if ($evento == null) { ?>

                <div class="aviso mb-3">
                    <img src="../assets/iconos/aviso-error.png" alt="Error" class="icono-aviso">
                    <div>
                        <strong>No encontramos ese evento</strong>
                        <p class="mb-0">Puede que se haya borrado o que el enlace esté mal</p>
                    </div>
                </div>

            <?php } else { ?>

                <article class="tarjeta h-auto">
                    <?php if ($ya_paso) { ?>
                        <span class="etiqueta-estado">Ya se realizó</span>
                    <?php } else { ?>
                        <span class="etiqueta-estado">Próximo</span>
                    <?php } ?>

                    <h1 class="mt-2 mb-3"><?php echo htmlspecialchars($evento['Titulo']); ?></h1>

                    <dl class="row datos-perfil mb-3">
                        <dt class="col-sm-3">Fecha</dt>
                        <dd class="col-sm-9"><?php echo $fecha_larga; ?></dd>
                        <?php if ($evento['Hora'] != '') { ?>
                            <dt class="col-sm-3">Hora</dt>
                            <dd class="col-sm-9"><?php echo substr($evento['Hora'], 0, 5); ?> h</dd>
                        <?php } ?>
                        <dt class="col-sm-3">Lugar</dt>
                        <dd class="col-sm-9"><?php echo htmlspecialchars($evento['Lugar']); ?></dd>
                    </dl>

                    <?php if ($evento['URL_Imagen'] != '') { ?>
                        <img src="../<?php echo $evento['URL_Imagen']; ?>" alt="<?php echo htmlspecialchars($evento['Titulo']); ?>" class="foto-noticia foto-grande mb-3">
                    <?php } ?>

                    <p class="mb-0"><?php echo nl2br(htmlspecialchars($evento['Descripcion'])); ?></p>
                </article>

                <?php if (count($fotos) > 0 || count($videos) > 0) { ?>
                    <section class="tarjeta h-auto mt-4">
                        <h2 class="titulo-bloque">Fotos y videos</h2>

                        <div class="row g-3">
                            <?php foreach ($fotos as $foto) { ?>
                                <div class="col-6 col-md-4">
                                    <!-- al tocar la foto se abre grande en otra pestaña -->
                                    <a href="../<?php echo $foto['URL']; ?>" target="_blank" rel="noopener">
                                        <img src="../<?php echo $foto['URL']; ?>" alt="<?php echo htmlspecialchars($foto['Descripcion']); ?>" class="foto-noticia">
                                    </a>
                                </div>
                            <?php } ?>
                        </div>

                        <?php if (count($videos) > 0) { ?>
                            <ul class="list-unstyled mt-3 mb-0">
                                <?php foreach ($videos as $video) { ?>
                                    <li>
                                        <a href="<?php echo htmlspecialchars($video['URL']); ?>" target="_blank" rel="noopener">Ver video: <?php echo htmlspecialchars($video['Descripcion']); ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </section>
                <?php } ?>

            <?php } ?>

            <a href="eventos.php" class="link-volver d-inline-block mt-3">Volver a eventos</a>

        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>