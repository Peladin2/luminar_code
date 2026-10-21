<?php
$titulo = 'Escuela Técnica N.º 1 Bella Unión';
$ruta = '';
include 'includes/head.php';
include 'includes/header.php';

// los niveles son fijos, no cambian año a año
$niveles = [
        [
        'nombre' => 'Capacitación Profesional Inicial (CPI)',
        'texto'  => 'Electrotecnia básica',
        'sede'   => 'Sede Central',
        'codigo' => 'CPI'
    ],
    [
        'nombre' => 'Ciclo Básico (EBI)',
        'texto'  => '7.º, 8.º y 9.º año | Turnos 1 y 3',
        'sede'   => 'Sede Central',
        'codigo' => 'EBI'
    ],
    [
        'nombre' => 'Bachillerato Tecnológico',
        'texto'  => 'Informática, Administración, Deporte y Agrario',
        'sede'   => 'Sede Central, Brum y Gomensoro',
        'codigo' => 'BT'
    ],
    [
        'nombre' => 'Bachillerato Técnico Profesional',
        'texto'  => 'Gastronomía, Estética, Construcción y más',
        'sede'   => 'Sede Central y Brum',
        'codigo' => 'BTP'
    ],
    [
        'nombre' => 'Formación Profesional Básica',
        'texto'  => 'Capilar, Madera, Gastronomía y Mecánica',
        'sede'   => 'Sede Central',
        'codigo' => 'FPB'
    ],
    [
        'nombre' => 'Cursos Técnicos Terciarios',
        'texto'  => 'Administración, Redes y Software, Diseño Gráfico',
        'sede'   => 'Sede Central',
        'codigo' => 'CTT'
    ],
    [
        'nombre' => 'Tecnólogo',
        'texto'  => 'Sistemas de Producción Agropecuaria Familiar',
        'sede'   => 'Sede Central',
        'codigo' => 'Tecnologo'
    ]
];

// integracion backend: ofertas con fecha de inicio en los proximos 30 dias
// datos de prueba
$proximos = [
    'Bach. Informática 1.º · Turno 3 · Sede Central - empieza el 02/03/2027',
    'EBI 1.º · Turno 1 · Sede Central - empieza el 02/03/2027'
];

// integracion backend: las 3 ultimas noticias publicadas
// datos de prueba
$noticias = [
    [
        'id'     => 1,
        'titulo' => 'Llamado a inscripción para cursos 2027',
        'fecha'  => '10 de octubre de 2026',
        'imagen' => ''
    ],
    [
        'id'     => 2,
        'titulo' => 'Período de exámenes de diciembre',
        'fecha'  => '5 de octubre de 2026',
        'imagen' => ''
    ],
    [
        'id'     => 3,
        'titulo' => 'Actividad en el Polideportivo',
        'fecha'  => '1 de octubre de 2026',
        'imagen' => ''
    ]
];

// integracion backend: los 3 proximos eventos
// datos de prueba
$eventos = [
    [
        'id'     => 1,
        'titulo' => 'Feria de Ciencias 2026',
        'fecha'  => '12 de noviembre de 2026'
    ],
    [
        'id'     => 2,
        'titulo' => 'Jornada de Puertas Abiertas',
        'fecha'  => '20 de noviembre de 2026'
    ],
    [
        'id'     => 3,
        'titulo' => 'Fogón Estudiantil',
        'fecha'  => '4 de diciembre de 2026'
    ]
];

// las sedes casi no cambian, van fijas
$sedes = [
    [
        'nombre' => 'Sede Central',
        'texto'  => 'Bella Unión - Sede principal',
        'nivel'  => 'Todos los niveles',
        'link'   => 'vistas/anexos.php?sede=central',
        'foto'   => 'central.jpg'
    ],
    [
        'nombre' => 'Baltasar Brum',
        'texto'  => 'BT Agrario Rural y BTP Cocina',
        'nivel'  => 'Bachillerato y Técnico Profesional',
        'link'   => 'vistas/anexos.php?sede=brum',
        'foto'   => 'brum.jpg'
    ],
    [
        'nombre' => 'Tomás Gomensoro',
        'texto'  => 'Plan Rumbo y BT Administración',
        'nivel'  => 'Ciclo Básico y Bachillerato',
        'link'   => 'vistas/anexos.php?sede=gomensoro',
        'foto'   => 'gomensoro.jpg'
    ],
    [
        'nombre' => 'Polideportivo',
        'texto'  => 'Deporte y Educación Física',
        'nivel'  => 'UTU y Secretaría Nacional de Deporte',
        'link'   => 'vistas/polideportivo.php',
        'foto'   => 'polideportivo.jpg'
    ]
];
?>

<main>
    <section class="portada">
        <div class="container">
            <h1>Escuela Técnica N.º 1</h1>
            <p class="nombre-completo">Mtro. Téc. Sergio G. Olaizola</p>
            <p>Bella Unión, Uruguay | Fundada en 1978</p>
            <p>Formando técnicos y profesionales para el Uruguay</p>
            <div class="d-flex flex-wrap gap-2 mt-4">
                <a href="vistas/oferta.php" class="btn btn-dorado">Ver oferta educativa</a>
                <a href="vistas/mision-vision.php" class="btn btn-amarillo">Conocer la institución</a>
            </div>
        </div>
    </section>

    <div class="container py-5">

        <section class="mb-5">
            <div class="cabecera-seccion">
                <h2>Oferta Educativa</h2>
                <div class="caja-becas">
                    <strong>Becas Butiá</strong>
                    <a href="vistas/becas.php" class="btn btn-dorado btn-sm">Ver información</a>
                </div>
            </div>

            <?php if (count($proximos) > 0) { ?>
                <div class="tarjeta recordatorio">
                    <h3>Cursos que empiezan pronto</h3>
                    <ul class="lista-simple">
                        <?php foreach ($proximos as $curso) { ?>
                            <li><?php echo $curso; ?></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>

            <div class="row g-3">
                <?php foreach ($niveles as $nivel) { ?>
                    <div class="col-md-6 col-lg-4">
                        <article class="tarjeta">
                            <h3><?php echo $nivel['nombre']; ?></h3>
                            <p><?php echo $nivel['texto']; ?></p>
                            <p class="dato-suave"><?php echo $nivel['sede']; ?></p>
                            <a href="vistas/oferta.php?nivel=<?php echo $nivel['codigo']; ?>" class="link-mas">Ver detalle</a>
                        </article>
                    </div>
                <?php } ?>
            </div>

            <div class="text-center mt-4">
                <a href="vistas/oferta.php" class="btn btn-borde">Ver toda la oferta educativa</a>
            </div>
        </section>

        <section class="mb-5">
            <h2 class="titulo-seccion">Últimas noticias</h2>
            <div class="row g-3">
                <?php foreach ($noticias as $noticia) { ?>
                    <div class="col-md-4">
                        <article class="tarjeta tarjeta-foto">
                            <?php if ($noticia['imagen'] != '') { ?>
                                <img src="uploads/<?php echo $noticia['imagen']; ?>" alt="">
                            <?php } else { ?>
                                <div class="foto-vacia">Sin foto</div>
                            <?php } ?>
                            <div class="cuerpo">
                                <h3><?php echo $noticia['titulo']; ?></h3>
                                <p class="dato-suave"><?php echo $noticia['fecha']; ?></p>
                                <a href="vistas/noticia.php?id=<?php echo $noticia['id']; ?>" class="link-mas">Leer más</a>
                            </div>
                        </article>
                    </div>
                <?php } ?>
            </div>
            <div class="text-center mt-4">
                <a href="vistas/noticias.php" class="btn btn-borde">Ver todas las noticias</a>
            </div>
        </section>

        <section class="mb-5">
            <h2 class="titulo-seccion">Próximos eventos</h2>
            <div class="row g-3">
                <?php foreach ($eventos as $evento) { ?>
                    <div class="col-md-4">
                        <article class="tarjeta">
                            <h3><?php echo $evento['titulo']; ?></h3>
                            <p class="dato-suave"><?php echo $evento['fecha']; ?></p>
                            <a href="vistas/evento.php?id=<?php echo $evento['id']; ?>" class="link-mas">Ver más</a>
                        </article>
                    </div>
                <?php } ?>
            </div>
        </section>

        <section>
            <h2 class="titulo-seccion">Nuestras sedes</h2>
            <div class="row g-3">
                <?php foreach ($sedes as $sede) { ?>
                    <div class="col-sm-6 col-lg-3">
                        <article class="tarjeta tarjeta-foto">
                            <?php if ($sede['foto'] != '') { ?>
                                <img src="assets/img/sedes/<?php echo $sede['foto']; ?>" alt="<?php echo $sede['nombre']; ?>">
                            <?php } else { ?>
                                <div class="foto-vacia">Foto de la sede</div>
                            <?php } ?>
                            <div class="cuerpo">
                                <h3><?php echo $sede['nombre']; ?></h3>
                                <p><?php echo $sede['texto']; ?></p>
                                <p class="dato-suave"><?php echo $sede['nivel']; ?></p>
                                <a href="<?php echo $sede['link']; ?>" class="link-mas">Ver sede</a>
                            </div>
                        </article>
                    </div>
                <?php } ?>
            </div>
        </section>

    </div>
</main>

<?php include 'includes/footer.php'; ?>