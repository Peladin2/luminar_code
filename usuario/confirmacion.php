<?php
$titulo = 'Preinscripción registrada - Escuela Técnica N.º 1';
$ruta = '../';

// si no inicio sesion, va al login
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php');
    exit;
}

include '../includes/head.php';
include '../includes/header.php';

// integracion backend: la preinscripcion que se acaba de guardar (llega con ?id=)
// ricardo tiene que controlar que sea del usuario que inicio sesion
// datos de prueba (cambiá la posicion a 33 para ver la lista de espera)
$preinscripcion = [
    'oferta'   => 'Bach. Informática - 2.º año',
    'detalle'  => 'Turno 3 · Tarde (12:35 a 18:50) · Sede Central',
    'Fecha'    => '2026-10-22 10:32:00',
    'posicion' => 12,
    'cupo'     => 30
];

// integracion backend: cuantas preinscripciones tiene ahora el usuario
$cantidad = 2;

$en_espera = $preinscripcion['posicion'] > $preinscripcion['cupo'];
$lugar_espera = $preinscripcion['posicion'] - $preinscripcion['cupo'];

// 2026-10-22 10:32:00 -> 22/10/2026 a las 10:32
function fecha_hora($texto) {
    return date('d/m/Y', strtotime($texto)) . ' a las ' . date('H:i', strtotime($texto));
}
?>

<main class="container py-4">

    <nav aria-label="Ruta de navegación">
        <ol class="breadcrumb miga">
            <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
            <li class="breadcrumb-item"><a href="preinscripcion.php">Preinscripción</a></li>
            <li class="breadcrumb-item active" aria-current="page">Confirmación</li>
        </ol>
    </nav>

    <section class="tarjeta h-auto confirmacion mx-auto">

        <?php if ($en_espera) { ?>
            <img src="../assets/iconos/aviso-alerta.png" alt="" class="icono-restringido">
        <?php } else { ?>
            <img src="../assets/iconos/aviso-exito.png" alt="" class="icono-restringido">
        <?php } ?>

        <h1>¡Preinscripción registrada!</h1>
        <p>Te preinscribiste en este curso:</p>

        <div class="datos-usuario text-start mb-3">
            <strong class="d-block"><?php echo $preinscripcion['oferta']; ?></strong>
            <span class="d-block"><?php echo $preinscripcion['detalle']; ?></span>
            <span class="d-block dato-suave">Fecha de solicitud: <?php echo fecha_hora($preinscripcion['Fecha']); ?></span>
            <span class="d-block mt-2">
                Situación:
                <?php if ($en_espera) { ?>
                    <span class="etiqueta-estado">Lista de espera n.º <?php echo $lugar_espera; ?></span>
                <?php } else { ?>
                    <span class="etiqueta-estado">Dentro del cupo</span>
                <?php } ?>
            </span>
        </div>

        <?php if ($en_espera) { ?>
            <div class="aviso text-start mb-3">
                <img src="../assets/iconos/aviso-alerta.png" alt="Atención" class="icono-aviso">
                <div>
                    <strong>El cupo de este curso está completo</strong>
                    <p class="mb-0">Quedaste en el lugar n.º <?php echo $lugar_espera; ?> de la lista de espera. Si se libera un lugar, Adscripción se va a comunicar con vos.</p>
                </div>
            </div>
        <?php } ?>

        <div class="aviso text-start mb-3">
            <img src="../assets/iconos/aviso-info.png" alt="Información" class="icono-aviso">
            <div>
                <strong>¿Qué pasa ahora?</strong>
                <p class="mb-0">La preinscripción no es una inscripción definitiva. Adscripción se va a comunicar con vos al teléfono de tu perfil para completar el proceso.</p>
            </div>
        </div>

        <p class="dato-suave">Preinscripciones usadas: <?php echo $cantidad; ?> de 3</p>

        <div class="d-flex flex-wrap justify-content-center gap-2">
            <?php if ($cantidad < 3) { ?>
                <a href="preinscripcion.php" class="btn btn-borde">Hacer otra preinscripción</a>
            <?php } ?>
            <a href="mis-preinscripciones.php" class="btn btn-dorado">Ver mis preinscripciones</a>
        </div>

        <a href="../index.php" class="link-volver d-inline-block mt-3">Volver al inicio</a>
    </section>

</main>

<?php include '../includes/footer.php'; ?>