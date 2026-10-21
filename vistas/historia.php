<?php
$titulo = 'Historia - Escuela Técnica N.º 1';
$ruta = '../';
include '../includes/head.php';
include '../includes/header.php';

// textos de la historia
// falta: parrafo de como fue creciendo la escuela (orientaciones, anexos, edificio)
$parrafo_fundacion = 'La Escuela Técnica de Bella Unión N.º 1 abrió sus puertas el 9 de marzo de 1978. Su primer director fue el Mtro. Téc. Sergio González Olaizola, de quien hoy la escuela lleva el nombre.';
$parrafo_crecimiento = '';
$parrafo_hoy = 'Hoy la escuela recibe a más de 1.200 estudiantes entre la Sede Central y los anexos de Baltasar Brum y Tomás Gomensoro. Ofrece Ciclo Básico, Formación Profesional Básica, Bachillerato Tecnológico, Bachillerato Técnico Profesional, cursos técnicos terciarios y Tecnólogo, en turnos que van de la mañana a la noche.';

// falta: foto historica de la escuela y su pie de foto
$foto_historica = '';
$pie_foto = '';

// falta: otros años importantes, para agregar aca
$momentos = [
    [
        'anio'  => '1978',
        'texto' => 'Fundación de la escuela (9 de marzo)'
    ],
    [
        'anio'  => '2021',
        'texto' => 'Inauguración del Polideportivo Bella Unión (12 de noviembre)'
    ]
];
?>

<main class="container py-4">

    <nav aria-label="Ruta de navegación">
        <ol class="breadcrumb miga">
            <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
            <li class="breadcrumb-item"><a href="mision-vision.php">Institucional</a></li>
            <li class="breadcrumb-item active" aria-current="page">Historia</li>
        </ol>
    </nav>

    <h1>Historia de la escuela</h1>
    <p class="subtitulo">Escuela Técnica N.º 1 - Mtro. Téc. Sergio G. Olaizola - Bella Unión, Artigas</p>

    <div class="row g-4 mt-1">

        <div class="col-lg-7">
            <article class="tarjeta tarjeta-historia h-auto">
                <h2>Nuestra historia</h2>
                <p><?php echo $parrafo_fundacion; ?></p>
                <?php if ($parrafo_crecimiento != '') { ?>
                    <p><?php echo $parrafo_crecimiento; ?></p>
                <?php } ?>
                <p class="mb-0"><?php echo $parrafo_hoy; ?></p>
            </article>
        </div>

        <div class="col-lg-5">
            <figure class="foto-historia mb-0">
                <?php if ($foto_historica != '') { ?>
                    <img src="../assets/img/<?php echo $foto_historica; ?>" alt="<?php echo $pie_foto; ?>" class="img-fluid rounded">
                    <figcaption class="dato-suave mt-2"><?php echo $pie_foto; ?></figcaption>
                <?php } else { ?>
                    <div class="foto-vacia">Foto histórica de la escuela</div>
                <?php } ?>
            </figure>
        </div>

    </div>

    <section class="tarjeta tarjeta-historia h-auto mt-4">
        <h2>Momentos importantes</h2>
        <ul class="momentos">
            <?php foreach ($momentos as $momento) { ?>
                <li>
                    <span class="anio"><?php echo $momento['anio']; ?></span>
                    <span><?php echo $momento['texto']; ?></span>
                </li>
            <?php } ?>
        </ul>
    </section>

    <a href="mision-vision.php" class="link-volver d-inline-block mt-4">Volver a Misión y Visión</a>

</main>

<?php include '../includes/footer.php'; ?>