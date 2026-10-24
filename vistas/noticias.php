<?php
$titulo = 'Noticias - Escuela Técnica N.º 1';
$ruta = '../';
include '../includes/head.php';
include '../includes/header.php';

// integracion backend: noticias ordenadas de la mas nueva a la mas vieja (ORDER BY Fecha DESC)
// datos de prueba
$noticias = [
    [
        'ID_Noticia'  => 3,
        'Titulo'      => 'Período de exámenes de diciembre',
        'Fecha'       => '2026-11-20',
        'Descripcion' => 'Ya están disponibles las fechas de los exámenes de diciembre para todos los niveles. Consultá en Adscripción los horarios de cada asignatura y los requisitos para inscribirte.',
        'URL_Imagen'  => ''
    ],
    [
        'ID_Noticia'  => 2,
        'Titulo'      => 'Fogón de fin de año',
        'Fecha'       => '2026-11-05',
        'Descripcion' => 'Invitamos a estudiantes, familias y docentes al fogón de fin de año en el patio de la Sede Central. Va a haber música, comida y la entrega de reconocimientos del año.',
        'URL_Imagen'  => 'assets/img/fachada.jpg'
    ],
    [
        'ID_Noticia'  => 1,
        'Titulo'      => 'Llamado a profesores para clases de apoyo',
        'Fecha'       => '2026-10-15',
        'Descripcion' => 'La escuela abre un llamado a docentes interesados en dar clases de apoyo de Matemática e Idioma Español. Los interesados pueden acercarse a Administración con su currículum.',
        'URL_Imagen'  => ''
    ]
];
?>

<main class="container py-4">

    <nav aria-label="Ruta de navegación">
        <ol class="breadcrumb miga">
            <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Noticias</li>
        </ol>
    </nav>

    <h1 class="mb-2">Noticias</h1>
    <p class="dato-suave mb-4">Llamados, fechas de exámenes, actividades y novedades de la escuela</p>

    <?php if (count($noticias) == 0) { ?>
        <div class="aviso">
            <img src="../assets/iconos/aviso-info.png" alt="Información" class="icono-aviso">
            <div>
                <strong>Todavía no hay noticias publicadas</strong>
                <p class="mb-0">Volvé a entrar más adelante</p>
            </div>
        </div>
    <?php } ?>

    <div class="row g-4">
        <?php foreach ($noticias as $noticia) { ?>
            <div class="col-md-6 col-lg-4">
                <article class="tarjeta d-flex flex-column">

                    <?php if ($noticia['URL_Imagen'] != '') { ?>
                        <img src="../<?php echo $noticia['URL_Imagen']; ?>" alt="<?php echo htmlspecialchars($noticia['Titulo']); ?>" class="foto-noticia mb-3">
                    <?php } ?>

                    <span class="dato-suave"><?php echo date('d/m/Y', strtotime($noticia['Fecha'])); ?></span>
                    <h2 class="h5 mt-1"><?php echo htmlspecialchars($noticia['Titulo']); ?></h2>

                    <?php
                    // resumen: solo los primeros 120 caracteres
                    $resumen = $noticia['Descripcion'];
                    if (mb_strlen($resumen) > 120) {
                        $resumen = mb_substr($resumen, 0, 120) . '...';
                    }
                    ?>
                    <p><?php echo htmlspecialchars($resumen); ?></p>

                    <a href="noticia.php?id=<?php echo $noticia['ID_Noticia']; ?>" class="link-mas mt-auto">Ver más</a>
                </article>
            </div>
        <?php } ?>
    </div>

</main>

<?php include '../includes/footer.php'; ?>