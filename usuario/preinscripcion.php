<?php
$titulo = 'Preinscripción - Escuela Técnica N.º 1';
$ruta = '../';

// si no inicio sesion, va al login (esto tiene que ir antes de mostrar cualquier cosa)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php?desde=preinscripcion');
    exit;
}

include '../includes/head.php';
include '../includes/header.php';

// integracion backend: periodo de preinscripcion de Configuracion (RNE-15)
$fecha_apertura = '2026-10-01';
$fecha_cierre   = '2026-11-30';
$hoy = date('Y-m-d');
$periodo_abierto = ($hoy >= $fecha_apertura && $hoy <= $fecha_cierre);

// integracion backend: video tutorial de Configuracion (URL_Video_Tutorial)
// falta: grabar el video tutorial y subirlo
$url_video = '';

// integracion backend: datos del usuario con sesion
// datos de prueba
$usuario = [
    'Nombre'   => 'Juan',
    'Apellido' => 'Pérez',
    'CI'       => '4.123.456-3',
    'Telefono' => '099 123 456',
    'Mail'     => 'juan.perez@correo.com'
];

// integracion backend: preinscripciones que ya tiene el usuario (maximo 3, RNE-1)
// datos de prueba
$mis_preinscripciones = [
    [
        'oferta'   => 'Bach. Informática - 1.º año',
        'detalle'  => 'Turno 3 · Sede Central',
        'posicion' => 12,
        'cupo'     => 25
    ]
];
$cantidad = count($mis_preinscripciones);

// integracion backend: ofertas con preinscripcion abierta, con cuantos preinscriptos tiene cada una
// datos de prueba
$ofertas = [
    [
        'ID_Oferta'   => 1,
        'ID_Curso'    => 1,
        'texto'       => 'Bach. Informática - 1.º año',
        'detalle'     => 'Turno 3 · Tarde (12:35 a 18:50) · Sede Central',
        'ocupados'    => 18,
        'Cupo_Maximo' => 25,
        'ya_esta'     => true
    ],
    [
        'ID_Oferta'   => 2,
        'ID_Curso'    => 1,
        'texto'       => 'Bach. Informática - 2.º año',
        'detalle'     => 'Turno 3 · Tarde (12:35 a 18:50) · Sede Central',
        'ocupados'    => 22,
        'Cupo_Maximo' => 30,
        'ya_esta'     => false
    ],
    [
        'ID_Oferta'   => 3,
        'ID_Curso'    => 2,
        'texto'       => 'Bach. Administración - 1.º año',
        'detalle'     => 'Turno 1 · Mañana (07:00 a 13:20) · Sede Central',
        'ocupados'    => 20,
        'Cupo_Maximo' => 25,
        'ya_esta'     => false
    ],
    [
        'ID_Oferta'   => 4,
        'ID_Curso'    => 5,
        'texto'       => 'BTP Cocina - 3.º año',
        'detalle'     => 'Turno 3 · Tarde (12:35 a 18:50) · Baltasar Brum',
        'ocupados'    => 15,
        'Cupo_Maximo' => 25,
        'ya_esta'     => false
    ],
    [
        'ID_Oferta'   => 5,
        'ID_Curso'    => 3,
        'texto'       => 'EBI - 2.º año',
        'detalle'     => 'Turno 1 · Mañana (07:00 a 13:20) · Sede Central',
        'ocupados'    => 30,
        'Cupo_Maximo' => 30,
        'ya_esta'     => false
    ]
];

// si viene desde el detalle de un curso, se marca la primera oferta de ese curso
$curso_pedido = 0;
if (isset($_GET['curso'])) {
    $curso_pedido = $_GET['curso'];
}
$oferta_marcada = 0;
foreach ($ofertas as $oferta) {
    if ($oferta_marcada == 0 && $oferta['ID_Curso'] == $curso_pedido && !$oferta['ya_esta']) {
        $oferta_marcada = $oferta['ID_Oferta'];
    }
}

// pasa la fecha de 2026-10-01 a 01/10/2026
function fecha($texto) {
    return date('d/m/Y', strtotime($texto));
}
?>

<main class="container py-4">

    <h1>Preinscripción</h1>
    <p class="subtitulo">Elegí el curso al que querés preinscribirte y confirmá. Podés tener hasta 3 preinscripciones activas.</p>

    <div class="aviso mb-4">
        <img src="../assets/iconos/aviso-info.png" alt="Información" class="icono-aviso">
        <div>
            <strong>Importante: la preinscripción no es una inscripción definitiva</strong>
            <p class="mb-0">Adscripción se va a comunicar con vos para completar el proceso</p>
        </div>
    </div>

    <?php if (!$periodo_abierto) { ?>

        <!-- fuera del periodo (08d) -->
        <section class="tarjeta h-auto mb-4">
            <div class="aviso mb-3">
                <img src="../assets/iconos/aviso-alerta.png" alt="Atención" class="icono-aviso">
                <div>
                    <strong>Las preinscripciones están cerradas</strong>
                    <p class="mb-0">El período es del <?php echo fecha($fecha_apertura); ?> al <?php echo fecha($fecha_cierre); ?>. Volvé a entrar en esas fechas.</p>
                </div>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <a href="../vistas/oferta.php" class="btn btn-dorado">Ver oferta educativa</a>
                <a href="mis-preinscripciones.php" class="btn btn-borde">Ver mis preinscripciones</a>
            </div>
        </section>

    <?php } else if ($cantidad >= 3) { ?>

        <!-- ya tiene 3 (08c) -->
        <section class="tarjeta h-auto mb-4">
            <div class="aviso mb-3">
                <img src="../assets/iconos/aviso-alerta.png" alt="Atención" class="icono-aviso">
                <div>
                    <strong>Ya tenés 3 preinscripciones, que es el máximo</strong>
                    <p class="mb-0">Si querés anotarte en otro curso, primero cancelá una desde Mis preinscripciones</p>
                </div>
            </div>
            <a href="mis-preinscripciones.php" class="btn btn-dorado">Ir a mis preinscripciones</a>
        </section>

    <?php } else { ?>

        <!-- video tutorial (RF-31) -->
        <section class="tarjeta h-auto mb-4">
            <h2 class="titulo-bloque">¿Cómo me preinscribo?</h2>
            <div class="row g-4 align-items-center">
                <div class="col-md-7">
                    <?php if ($url_video != '') { ?>
                        <div class="ratio ratio-16x9">
                            <iframe src="<?php echo $url_video; ?>" title="Video tutorial de preinscripción" allowfullscreen></iframe>
                        </div>
                    <?php } else { ?>
                        <div class="foto-vacia video-vacio">El video tutorial va a estar disponible pronto</div>
                    <?php } ?>
                </div>
                <div class="col-md-5">
                    <h3 class="fs-6 fw-bold">Mirá este video corto antes de preinscribirte</h3>
                    <p>Explica cómo elegir el curso, qué significa quedar en lista de espera y qué pasa después de confirmar.</p>
                    <p class="dato-suave mb-0">Duración aproximada: 2 minutos</p>
                </div>
            </div>
        </section>

        <!-- integracion backend: ricardo recibe id_oferta y curso_grado_anterior, guarda y manda a la confirmacion -->
        <form id="form-preinscripcion" action="preinscripcion.php" method="post" novalidate>
            <div class="row g-4">

                <div class="col-lg-7">
                    <section class="tarjeta h-auto">
                        <h2 class="titulo-bloque">1. Elegí un curso</h2>
                        <p class="dato-suave">Se muestran las ofertas con preinscripción abierta</p>

                        <?php foreach ($ofertas as $oferta) { ?>
                            <?php $lleno = $oferta['ocupados'] >= $oferta['Cupo_Maximo']; ?>
                            <label class="opcion-oferta <?php if ($oferta['ya_esta']) { echo 'deshabilitada'; } ?>">
                                <input type="radio" name="id_oferta" value="<?php echo $oferta['ID_Oferta']; ?>"
                                    data-texto="<?php echo $oferta['texto'] . ' · ' . $oferta['detalle']; ?>"
                                    <?php if ($oferta['ya_esta']) { echo 'disabled'; } ?>
                                    <?php if ($oferta['ID_Oferta'] == $oferta_marcada) { echo 'checked'; } ?>>
                                <span class="flex-grow-1">
                                    <strong><?php echo $oferta['texto']; ?></strong>
                                    <span class="d-block dato-suave"><?php echo $oferta['detalle']; ?></span>
                                </span>
                                <span class="text-end">
                                    <span class="d-block cupos"><?php echo $oferta['ocupados']; ?> de <?php echo $oferta['Cupo_Maximo']; ?> cupos ocupados</span>
                                    <?php if ($oferta['ya_esta']) { ?>
                                        <span class="etiqueta-estado">Ya estás preinscripto</span>
                                    <?php } else if ($lleno) { ?>
                                        <span class="etiqueta-estado">Cupo completo: quedás en lista de espera</span>
                                    <?php } ?>
                                </span>
                            </label>
                        <?php } ?>

                        <p id="error-oferta" class="texto-error d-none mb-0">Elegí un curso para continuar</p>
                    </section>
                </div>

                <div class="col-lg-5">
                    <section class="tarjeta h-auto">
                        <h2 class="titulo-bloque">2. Confirmá tus datos</h2>

                        <div class="datos-usuario">
                            <span class="dato-suave">Te preinscribís como:</span>
                            <strong class="d-block fs-5"><?php echo $usuario['Nombre'] . ' ' . $usuario['Apellido']; ?></strong>
                            <span class="d-block">CI <?php echo $usuario['CI']; ?> · Tel. <?php echo $usuario['Telefono']; ?></span>
                            <span class="d-block"><?php echo $usuario['Mail']; ?></span>
                        </div>
                        <a href="perfil.php" class="link-volver d-inline-block mt-2">¿Datos incorrectos? Editalos en tu perfil</a>

                        <hr>

                        <!-- pregunta de control (RF-18): se guarda lo que responde, no se controla -->
                        <fieldset>
                            <legend class="pregunta">¿Cursaste el año anterior en esta institución? *</legend>
                            <div class="form-check form-check-inline">
                                <input type="radio" id="anterior-si" name="curso_grado_anterior" value="1" class="form-check-input">
                                <label for="anterior-si" class="form-check-label">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" id="anterior-no" name="curso_grado_anterior" value="0" class="form-check-input">
                                <label for="anterior-no" class="form-check-label">No</label>
                            </div>
                            <p id="error-pregunta" class="texto-error d-none mb-0">Elegí "Sí" o "No" para continuar</p>
                        </fieldset>

                        <p class="dato-suave mt-3 mb-0">Curso elegido:</p>
                        <p id="curso-elegido" class="fw-bold">Todavía no elegiste un curso</p>

                        <button type="submit" class="btn btn-dorado w-100">Confirmar preinscripción</button>
                        <p class="text-center dato-suave mt-2 mb-0">Te quedan <?php echo 3 - $cantidad; ?> de 3 preinscripciones disponibles</p>
                    </section>
                </div>

            </div>
        </form>

    <?php } ?>

    <!-- resumen de lo que ya tiene -->
    <section class="tarjeta h-auto mt-4">
        <h2 class="titulo-bloque">Mis preinscripciones (<?php echo $cantidad; ?> de 3)</h2>

        <?php if ($cantidad == 0) { ?>
            <p class="dato-suave">Todavía no tenés preinscripciones</p>
        <?php } ?>

        <?php foreach ($mis_preinscripciones as $pre) { ?>
            <div class="caja-dato d-flex flex-row flex-wrap justify-content-between align-items-center mb-2">
                <span>
                    <strong class="d-block"><?php echo $pre['oferta']; ?></strong>
                    <span class="dato-suave"><?php echo $pre['detalle']; ?> · Adscripción se va a comunicar con vos</span>
                </span>
                <?php if ($pre['posicion'] <= $pre['cupo']) { ?>
                    <span class="etiqueta-estado">Dentro del cupo</span>
                <?php } else { ?>
                    <span class="etiqueta-estado">Lista de espera n.º <?php echo $pre['posicion'] - $pre['cupo']; ?></span>
                <?php } ?>
            </div>
        <?php } ?>

        <a href="mis-preinscripciones.php" class="link-volver">Ver mis preinscripciones</a>
    </section>

</main>

<script src="../assets/javascripts/preinscripcion.js"></script>

<?php include '../includes/footer.php'; ?>