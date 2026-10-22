<?php
$ruta = '../';

// nombres de los niveles 
$nombres_nivel = [
    'CPI'       => 'Capacitación Profesional Inicial (CPI)',
    'EBI'       => 'Educación Básica Integrada (EBI)',
    'FPB'       => 'Formación Profesional Básica (FPB)',
    'BT'        => 'Bachillerato Tecnológico (BT)',
    'BTP'       => 'Bachillerato Técnico Profesional (BTP)',
    'CTT'       => 'Cursos Técnicos Terciarios (CTT)',
    'Tecnologo' => 'Tecnólogo'
];

// documentacion para inscribirse 
$requisitos_generales = "Cédula de identidad y fotocopia
Escolaridad o pase escolar
Carné de vacunas o carné de salud adolescente
Constancia de domicilio
Si es menor de edad, fotocopia de la cédula del adulto que lo inscribe";

// integracion backend: datos del curso (tabla Curso), sus ofertas y sus materias (Curso_Materia)
// datos de prueba
$cursos = [
    1 => [
        'Nombre'             => 'Bachillerato Tecnológico en Informática',
        'Nivel'              => 'BT',
        'Duracion'           => '3 años',
        'Descripcion'        => 'El Bachillerato Tecnológico en Informática forma técnicos capaces de desarrollar, mantener y gestionar sistemas informáticos. Los egresados obtienen un título habilitante para el mercado laboral y para continuar estudios terciarios, por ejemplo en los Cursos Técnicos Terciarios (CTT).',
        'Perfil_Egreso'      => "Programación y desarrollo de software
Administración de redes y sistemas
Soporte técnico y mantenimiento de equipos
Gestión de bases de datos",
        'Requisitos_Ingreso' => $requisitos_generales,
        'URL_Imagen'         => '',
        'ofertas'            => [
            'Turno 3 · Tarde (12:35 a 18:50) - Sede Central - 1.º, 2.º y 3.º'
        ],
        'materias'           => []
    ],
    2 => [
        'Nombre'             => 'Bachillerato Tecnológico en Administración',
        'Nivel'              => 'BT',
        'Duracion'           => '3 años',
        'Descripcion'        => 'El Bachillerato Tecnológico en Administración forma estudiantes capacitados en la gestión contable, administrativa y comercial de empresas u organizaciones. Los egresados adquieren conocimientos para la toma de decisiones financieras, la administración de personal y la gestión de procesos.',
        'Perfil_Egreso'      => "Liquidación de sueldos y gestión de recursos humanos
Control contable, presupuestos y facturación
Gestión de documentos, compras y stock
Asistencia en procesos administrativos y comerciales",
        'Requisitos_Ingreso' => $requisitos_generales,
        'URL_Imagen'         => '',
        'ofertas'            => [
            'Turno 1 · Mañana (07:00 a 13:20) - Sede Central - 1.º, 2.º y 3.º'
        ],
        'materias'           => []
    ],
    3 => [
        'Nombre'             => 'Educación Básica Integrada (EBI)',
        'Nivel'              => 'EBI',
        'Duracion'           => '3 años',
        'Descripcion'        => 'El plan EBI brinda la educación media básica a adolescentes y jóvenes, combinando asignaturas generales con espacios de orientación técnica y talleres de UTU, para después continuar estudios en un bachillerato.',
        'Perfil_Egreso'      => "Educación Media Básica completa
Formación en competencias transversales y pensamiento crítico
Acceso directo a los bachilleratos (BT y BTP)",
        'Requisitos_Ingreso' => $requisitos_generales,
        'URL_Imagen'         => '',
        'ofertas'            => [
            'Turno 1 · Mañana (07:00 a 13:20) - Sede Central - 7.º, 8.º y 9.º'
        ],
        'materias'           => []
    ]
];

// que curso se pidio
$id = 0;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$existe = isset($cursos[$id]);

if ($existe) {
    $curso = $cursos[$id];
    $titulo = $curso['Nombre'] . ' - Escuela Técnica N.º 1';
} else {
    $titulo = 'Curso no encontrado - Escuela Técnica N.º 1';
}

include '../includes/head.php';
include '../includes/header.php';

// si inicio sesion va a preinscribirse, si no al login
if ($hay_sesion) {
    $link_preinscripcion = '../usuario/preinscripcion.php?curso=' . $id;
} else {
    $link_preinscripcion = '../usuario/login.php?desde=preinscripcion';
}
?>

<main class="container py-4">

    <?php if (!$existe) { ?>

        <div class="aviso mt-3">
            <img src="../assets/iconos/aviso-alerta.png" alt="Atención" class="icono-aviso">
            <div>
                <strong>No encontramos ese curso</strong>
                <p class="mb-0">Puede que ya no se dicte. Fijate en la <a href="oferta.php">oferta educativa</a> los cursos disponibles</p>
            </div>
        </div>

    <?php } else { ?>

        <nav aria-label="Ruta de navegación">
            <ol class="breadcrumb miga">
                <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
                <li class="breadcrumb-item"><a href="oferta.php">Oferta educativa</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($curso['Nombre']); ?></li>
            </ol>
        </nav>

        <div class="row g-4">

            <div class="col-lg-8">
                <article class="tarjeta h-auto detalle-curso">
                    <h1><?php echo htmlspecialchars($curso['Nombre']); ?></h1>
                    <p class="dato-suave"><?php echo $nombres_nivel[$curso['Nivel']]; ?> | Duración: <?php echo $curso['Duracion']; ?></p>

                    <?php if ($curso['Nivel'] == 'EBI') { ?>
                        <div class="aviso mb-3">
                            <img src="../assets/iconos/aviso-info.png" alt="Información" class="icono-aviso">
                            <div>
                                <strong>¿Terminás 6.º de escuela?</strong>
                                <p class="mb-0">La inscripción a 1.er año se hace por la plataforma GURÍ, desde la escuela</p>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="bloque-curso">
                        <h2>Descripción</h2>
                        <p class="mb-0"><?php echo htmlspecialchars($curso['Descripcion']); ?></p>
                    </div>

                    <div class="bloque-curso">
                        <h2>Perfil de egreso</h2>
                        <ul class="mb-0">
                            <?php foreach (explode("\n", $curso['Perfil_Egreso']) as $linea) { ?>
                                <li><?php echo htmlspecialchars(trim($linea)); ?></li>
                            <?php } ?>
                        </ul>
                    </div>

                    <div class="bloque-curso">
                        <h2>Turnos y sedes</h2>
                        <ul class="mb-0">
                            <?php foreach ($curso['ofertas'] as $oferta) { ?>
                                <li><?php echo $oferta; ?></li>
                            <?php } ?>
                        </ul>
                    </div>

                    <div class="bloque-curso">
                        <h2>Requisitos de ingreso</h2>
                        <ul class="mb-0">
                            <?php foreach (explode("\n", $curso['Requisitos_Ingreso']) as $linea) { ?>
                                <li><?php echo htmlspecialchars(trim($linea)); ?></li>
                            <?php } ?>
                        </ul>
                    </div>

                    <div class="bloque-curso">
                        <h2>Materias por año</h2>
                        <?php if (count($curso['materias']) == 0) { ?>
                            <!-- falta: materias de cada año de cada curso -->
                            <p class="dato-suave mb-0">Las materias de este curso todavía no están cargadas. Consultá en Adscripción.</p>
                        <?php } else { ?>
                            <?php foreach ($curso['materias'] as $grado => $lista) { ?>
                                <p class="mb-1"><strong><?php echo $grado; ?>:</strong> <?php echo $lista; ?></p>
                            <?php } ?>
                        <?php } ?>
                    </div>

                    <?php if ($curso['URL_Imagen'] != '') { ?>
                        <img src="../<?php echo $curso['URL_Imagen']; ?>" alt="<?php echo htmlspecialchars($curso['Nombre']); ?>" class="img-fluid rounded mt-3">
                    <?php } ?>

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <a href="<?php echo $link_preinscripcion; ?>" class="btn btn-dorado">Preinscribirse a este curso</a>
                        <a href="horarios.php" class="btn btn-borde">Ver horarios</a>
                    </div>
                </article>
            </div>

            <aside class="col-lg-4">
                <div class="tarjeta h-auto otros-cursos">
                    <h2>Otros cursos disponibles</h2>
                    <?php foreach ($cursos as $otro_id => $otro) { ?>
                        <?php if ($otro_id != $id) { ?>
                            <div class="caja-dato mb-2">
                                <strong><?php echo htmlspecialchars($otro['Nombre']); ?></strong>
                                <a href="curso.php?id=<?php echo $otro_id; ?>" class="link-mas">Ver detalle</a>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <a href="oferta.php" class="link-volver d-inline-block mt-2">Ver toda la oferta educativa</a>
                </div>
            </aside>

        </div>

    <?php } ?>

</main>

<?php include '../includes/footer.php'; ?>