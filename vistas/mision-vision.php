<?php
$titulo = 'Misión y Visión - Escuela Técnica N.º 1';
$ruta = '../';
include '../includes/head.php';
include '../includes/header.php';

// tarjetas de abajo, para no repetir el mismo html 4 veces
// iconos: pack de Dave Gandy (freeicon.com)
$accesos = [
    [
        'titulo' => 'Historia',
        'texto'  => 'Cómo empezó y cómo fue creciendo la escuela',
        'link'   => 'historia.php',
        'icono'  => 'historia.png'
    ],
    [
        'titulo' => 'Logros y reconocimientos',
        'texto'  => 'Premios y reconocimientos de estudiantes y docentes',
        'link'   => 'logros.php',
        'icono'  => 'logros.png'
    ],
    [
        'titulo' => 'Estadísticas',
        'texto'  => 'Matrícula, egresos y otros datos del centro',
        'link'   => 'estadisticas.php',
        'icono'  => 'estadisticas.png'
    ],
    [
        'titulo' => 'Servicios al estudiante',
        'texto'  => 'Comedor, biblioteca y clases de apoyo',
        'link'   => 'servicios.php',
        'icono'  => 'servicios.png'
    ]
];
?>

<main>
    <div class="container py-3">
        <nav aria-label="Ruta de navegación">
            <ol class="breadcrumb miga">
                <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
                <li class="breadcrumb-item">Institucional</li>
                <li class="breadcrumb-item active" aria-current="page">Misión y Visión</li>
            </ol>
        </nav>
    </div>

    <section class="banda-titulo">
        <div class="container">
            <h1>Misión y Visión Institucional</h1>
            <p>Escuela Técnica N.º 1 - Mtro. Téc. Sergio G. Olaizola - Bella Unión, Artigas</p>
        </div>
    </section>

    <section class="intro">
        <div class="container">
            <p>La Dirección General de Educación Técnico Profesional - UTU integra la Administración Nacional de Educación Pública (ANEP), ofreciendo educación técnica y tecnológica de nivel medio y terciario, y formación profesional básica y superior en todo el territorio del Uruguay, sobre la base de los principios de gratuidad, laicidad e igualdad.</p>
        </div>
    </section>

    <div class="container py-5">
        <div class="row g-4">
            <div class="col-md-6">
                <article class="tarjeta tarjeta-mv">
                    <h2>Misión</h2>
                    <p>Impartir educación técnica, tecnológica y formación profesional (básica y superior) en todo el territorio nacional. Busca garantizar la igualdad de oportunidades y la efectiva inclusión, formando ciudadanos capaces de desarrollarse integralmente y aportando valor al desarrollo productivo, social y económico del país.</p>
                </article>
            </div>
            <div class="col-md-6">
                <article class="tarjeta tarjeta-mv">
                    <h2>Visión</h2>
                    <p>Consolidarse como un referente fundamental en la enseñanza técnico-profesional, impulsando la innovación tecnológica y adaptando constantemente sus propuestas educativas a las demandas del mercado laboral y del desarrollo sostenible en Uruguay.</p>
                </article>
            </div>
        </div>

        <section class="mt-5">
            <h2 class="subtitulo">Conocé más sobre la escuela</h2>
            <div class="row g-3">
                <?php foreach ($accesos as $acceso) { ?>
                    <div class="col-sm-6 col-lg-3">
                        <a href="<?php echo $acceso['link']; ?>" class="tarjeta acceso">
                            <div class="circulo"><img src="../assets/iconos/<?php echo $acceso['icono']; ?>" alt=""></div>
                            <h3><?php echo $acceso['titulo']; ?></h3>
                            <p><?php echo $acceso['texto']; ?></p>
                            <span class="link-mas">Ver más</span>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </section>
    </div>
</main>

<?php include '../includes/footer.php'; ?>