<?php
$ruta = '../';

// integracion backend: buscar la noticia por ID_Noticia
// datos de prueba (las mismas que en noticias.php)
$noticias = [
    [
        'ID_Noticia'  => 3,
        'Titulo'      => 'Período de exámenes de diciembre',
        'Fecha'       => '2026-11-20',
        'Descripcion' => "Ya están disponibles las fechas de los exámenes de diciembre para todos los niveles. Consultá en Adscripción los horarios de cada asignatura y los requisitos para inscribirte.\n\nRecordá llevar tu cédula el día del examen.",
        'URL_Imagen'  => ''
    ],
    [
        'ID_Noticia'  => 2,
        'Titulo'      => 'Fogón de fin de año',
        'Fecha'       => '2026-11-05',
        'Descripcion' => "Invitamos a estudiantes, familias y docentes al fogón de fin de año en el patio de la Sede Central. Va a haber música, comida y la entrega de reconocimientos del año.\n\nSi querés participar con una actividad, avisá en Adscripción.",
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

// busca la noticia con el id de la url
$noticia = null;
if (isset($_GET['id'])) {
    foreach ($noticias as $n) {
        if ($n['ID_Noticia'] == $_GET['id']) {
            $noticia = $n;
        }
    }
}

// el titulo de la pestaña es el de la noticia
if ($noticia != null) {
    $titulo = $noticia['Titulo'] . ' - Escuela Técnica N.º 1';
} else {
    $titulo = 'Noticia no encontrada - Escuela Técnica N.º 1';
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
                    <li class="breadcrumb-item"><a href="noticias.php">Noticias</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Noticia</li>
                </ol>
            </nav>

            <?php if ($noticia == null) { ?>

                <div class="aviso mb-3">
                    <img src="../assets/iconos/aviso-error.png" alt="Error" class="icono-aviso">
                    <div>
                        <strong>No encontramos esa noticia</strong>
                        <p class="mb-0">Puede que se haya borrado o que el enlace esté mal</p>
                    </div>
                </div>

            <?php } else { ?>

                <article class="tarjeta h-auto">
                    <span class="dato-suave"><?php echo date('d/m/Y', strtotime($noticia['Fecha'])); ?></span>
                    <h1 class="mt-1 mb-3"><?php echo htmlspecialchars($noticia['Titulo']); ?></h1>

                    <?php if ($noticia['URL_Imagen'] != '') { ?>
                        <img src="../<?php echo $noticia['URL_Imagen']; ?>" alt="<?php echo htmlspecialchars($noticia['Titulo']); ?>" class="foto-noticia foto-grande mb-3">
                    <?php } ?>

                    <!-- nl2br respeta los enters que pone el admin -->
                    <p class="mb-0"><?php echo nl2br(htmlspecialchars($noticia['Descripcion'])); ?></p>
                </article>

            <?php } ?>

            <a href="noticias.php" class="link-volver d-inline-block mt-3">Volver a noticias</a>

        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>