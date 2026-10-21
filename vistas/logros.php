<?php
$titulo = 'Logros y reconocimientos - Escuela Técnica N.º 1';
$ruta = '../';
include '../includes/head.php';
include '../includes/header.php';

// integracion backend: logros ordenados del mas nuevo al mas viejo (tabla Logro)
// datos de prueba
$logros = [
    [
        'ID_Logro'    => 1,
        'Titulo'      => 'Título del logro de ejemplo 1',
        'Descripcion' => 'Descripción breve del logro: quién lo obtuvo y en qué ocasión. Dato de prueba.',
        'Anio'        => 2026,
        'URL_Imagen'  => ''
    ],
    [
        'ID_Logro'    => 2,
        'Titulo'      => 'Título del logro de ejemplo 2',
        'Descripcion' => 'Descripción breve del logro: quién lo obtuvo y en qué ocasión. Dato de prueba.',
        'Anio'        => 2026,
        'URL_Imagen'  => ''
    ],
    [
        'ID_Logro'    => 3,
        'Titulo'      => 'Título del logro de ejemplo 3',
        'Descripcion' => 'Descripción breve del logro: quién lo obtuvo y en qué ocasión. Dato de prueba.',
        'Anio'        => 2025,
        'URL_Imagen'  => ''
    ]
];
?>

<main class="container py-4">

    <nav aria-label="Ruta de navegación">
        <ol class="breadcrumb miga">
            <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
            <li class="breadcrumb-item"><a href="mision-vision.php">Institucional</a></li>
            <li class="breadcrumb-item active" aria-current="page">Logros y reconocimientos</li>
        </ol>
    </nav>

    <h1>Logros y reconocimientos</h1>
    <p class="subtitulo">Premios, menciones y reconocimientos de estudiantes, docentes y de la escuela</p>

    <?php if (count($logros) == 0) { ?>

        <div class="aviso mt-4">
            <img src="../assets/iconos/aviso-info.png" alt="Información" class="icono-aviso">
            <div>
                <strong>Todavía no hay logros publicados</strong>
                <p class="mb-0">Cuando la escuela publique uno, lo vas a ver acá</p>
            </div>
        </div>

    <?php } else { ?>

        <div class="row g-4 mt-1">
            <?php foreach ($logros as $logro) { ?>
                <div class="col-md-6 col-lg-4">
                    <article class="tarjeta tarjeta-foto tarjeta-logro">
                        <?php if ($logro['URL_Imagen'] != '') { ?>
                            <img src="../<?php echo $logro['URL_Imagen']; ?>" alt="<?php echo htmlspecialchars($logro['Titulo']); ?>">
                        <?php } else { ?>
                            <div class="foto-vacia">Sin foto</div>
                        <?php } ?>
                        <div class="cuerpo">
                            <span class="etiqueta-anio"><?php echo $logro['Anio']; ?></span>
                            <h2><?php echo htmlspecialchars($logro['Titulo']); ?></h2>
                            <p class="mb-0"><?php echo htmlspecialchars($logro['Descripcion']); ?></p>
                        </div>
                    </article>
                </div>
            <?php } ?>
        </div>

    <?php } ?>

    <a href="mision-vision.php" class="link-volver d-inline-block mt-4">Volver a Misión y Visión</a>

</main>

<?php include '../includes/footer.php'; ?>