<?php
$titulo = 'Historia - Escuela Técnica N.º 1';
$ruta = '../';
include '../includes/head.php';
include '../includes/header.php';

// textos de la historia (notas que paso la escuela)
$parrafo_fundacion = 'La escuela empezó a funcionar el 19 de diciembre de 1965 como una institución no oficial, impulsada por una comisión de vecinos. Su primer director fue Enio Paiva y se dictaban cursos de carpintería, corte y confección, cocina y mecánica.';

$parrafo_crecimiento = 'La institución actual nació en 1978 con la inauguración de la Escuela Técnica de Bella Unión, y en 1981 se mudó a su local de Av. Artigas y Dr. Pedro Acosta. Durante años fue una escuela de oficios, hasta que entre 2000 y 2007 pasó a ser un centro de educación media técnica profesional. Desde entonces tuvo varias reformas y ampliaciones para acompañar el crecimiento de la oferta y del alumnado.';

$parrafo_hoy = 'Hoy la escuela recibe a más de 1.200 estudiantes en cinco turnos, entre la Sede Central y los anexos de Baltasar Brum y Tomás Gomensoro. Ofrece Ciclo Básico, Formación Profesional Básica, Bachillerato Tecnológico, Bachillerato Técnico Profesional, cursos técnicos terciarios, capacitaciones y Tecnólogo, en áreas como informática, administración, gastronomía, construcción, robótica y agrario.';

// falta: foto historica de la escuela y su pie de foto
$foto_historica = '';
$pie_foto = '';

$momentos = [
    [
        'anio'  => '1965',
        'texto' => 'Empieza a funcionar como institución no oficial, impulsada por una comisión de vecinos (19 de diciembre)'
    ],
    [
        'anio'  => '1978',
        'texto' => 'Nace la Escuela Técnica de Bella Unión. La primera clase se da el 3 de setiembre'
    ],
    [
        'anio'  => '1981',
        'texto' => 'Empieza a funcionar en su local de Av. Artigas y Dr. Pedro Acosta'
    ],
    [
        'anio'  => '2000-2007',
        'texto' => 'Pasa de escuela de oficios a centro de educación media técnica profesional'
    ],
    [
        'anio'  => '2008',
        'texto' => 'Por la Ley N.º 18.386 pasa a llamarse oficialmente "Maestro Técnico Sergio González Olaizola"'
    ],
    [
        'anio'  => '2009',
        'texto' => 'Empiezan las clases de Agrario en Baltasar Brum'
    ],
    [
        'anio'  => '2010-2020',
        'texto' => 'Se suman cursos de Administración, Electricidad, Electrotecnia, Mecánica, Carpintería, Construcción, Gastronomía, Belleza, Informática, Agrario, Deporte, Robótica y Tecnólogo'
    ],
    [
        'anio'  => '2021',
        'texto' => 'Empiezan los FPB, para mayores de 15 años que quieren terminar Educación Básica aprendiendo un oficio'
    ],
    [
        'anio'  => '2021-2022',
        'texto' => 'Comparte el edificio con la nueva Escuela Técnica N.º 2 mientras se construye su local'
    ],
    [
        'anio'  => '2022-2024',
        'texto' => 'Se inaugura el Polideportivo'
    ],
    [
        'anio'  => '2025',
        'texto' => 'El equipo de robótica ALBATROK representa a la escuela en el First Lego League Open de Daytona Beach, Florida'
    ],
    [
        'anio'  => '2026',
        'texto' => 'Pasantías de estudiantes con ALUR, acuerdo con Calagua y llegada del contenedor para el comedor'
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