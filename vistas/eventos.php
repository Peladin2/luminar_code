<?php
$titulo = 'Eventos - Escuela Técnica N.º 1';
$ruta = '../';
include '../includes/head.php';
include '../includes/header.php';

// integracion backend: eventos ordenados por fecha (ORDER BY Fecha ASC)
// datos de prueba
$eventos = [
    [
        'ID_Evento'   => 1,
        'Titulo'      => 'Torneo deportivo en el Polideportivo',
        'Fecha'       => '2026-08-21',
        'Hora'        => '14:00:00',
        'Lugar'       => 'Polideportivo',
        'Descripcion' => 'Torneo de fútbol y vóleibol entre los grupos de todos los turnos.',
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
        'Descripcion' => 'Música, comida y entrega de reconocimientos del año.',
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

$meses = ['ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SET', 'OCT', 'NOV', 'DIC'];

// separa los que todavia no pasaron de los que ya pasaron
$proximos = [];
$anteriores = [];
foreach ($eventos as $evento) {
    if (strtotime($evento['Fecha']) >= strtotime('today')) {
        $proximos[] = $evento;
    } else {
        $anteriores[] = $evento;
    }
}

// los anteriores van del mas nuevo al mas viejo
$anteriores = array_reverse($anteriores);

// muestra la tarjeta de un evento (se usa en las dos listas)
function tarjeta_evento($evento, $meses) {
    $dia = date('d', strtotime($evento['Fecha']));
    $mes = $meses[date('n', strtotime($evento['Fecha'])) - 1];
    ?>
    <div class="col-md-6">
        <article class="tarjeta d-flex gap-3">
            <div class="fecha-evento">
                <span class="dia"><?php echo $dia; ?></span>
                <span class="mes"><?php echo $mes; ?></span>
            </div>
            <div class="d-flex flex-column">
                <h3 class="h5 mb-1"><?php echo htmlspecialchars($evento['Titulo']); ?></h3>
                <span class="dato-suave">
                    <?php if ($evento['Hora'] != '') { echo substr($evento['Hora'], 0, 5) . ' h | '; } ?>
                    <?php echo htmlspecialchars($evento['Lugar']); ?>
                </span>
                <p class="mt-2"><?php echo htmlspecialchars($evento['Descripcion']); ?></p>
                <a href="evento.php?id=<?php echo $evento['ID_Evento']; ?>" class="link-mas mt-auto">Ver más</a>
            </div>
        </article>
    </div>
    <?php
}
?>

<main class="container py-4">

    <nav aria-label="Ruta de navegación">
        <ol class="breadcrumb miga">
            <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Eventos</li>
        </ol>
    </nav>

    <h1 class="mb-2">Eventos</h1>
    <p class="dato-suave mb-4">Agenda de actividades de la escuela</p>

    <h2 class="titulo-bloque">Próximos eventos</h2>
    <?php if (count($proximos) == 0) { ?>
        <p class="dato-suave">No hay eventos programados por ahora</p>
    <?php } ?>
    <div class="row g-4 mb-5">
        <?php foreach ($proximos as $evento) { tarjeta_evento($evento, $meses); } ?>
    </div>

    <h2 class="titulo-bloque">Eventos anteriores</h2>
    <?php if (count($anteriores) == 0) { ?>
        <p class="dato-suave">Todavía no hay eventos anteriores</p>
    <?php } ?>
    <div class="row g-4">
        <?php foreach ($anteriores as $evento) { tarjeta_evento($evento, $meses); } ?>
    </div>

</main>

<?php include '../includes/footer.php'; ?>