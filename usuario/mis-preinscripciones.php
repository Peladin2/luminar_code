<?php
$titulo = 'Mis preinscripciones - Escuela Técnica N.º 1';
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

// integracion backend: preinscripciones del usuario con sesion, con su posicion en la lista
// datos de prueba
$preinscripciones = [
    [
        'ID_Preinscripcion' => 1,
        'curso'             => 'Bach. Tecnológico en Informática',
        'turno'             => 'Turno 3 · Tarde',
        'sede'              => 'Sede Central',
        'grado'             => '1.º',
        'Fecha'             => '2026-10-14 09:15:00',
        'posicion'          => 12,
        'cupo'              => 25
    ],
    [
        'ID_Preinscripcion' => 2,
        'curso'             => 'Educación Básica Integrada (EBI)',
        'turno'             => 'Turno 1 · Mañana',
        'sede'              => 'Sede Central',
        'grado'             => '8.º',
        'Fecha'             => '2026-10-15 18:40:00',
        'posicion'          => 32,
        'cupo'              => 30
    ]
];
$cantidad = count($preinscripciones);

// integracion backend:  vuelve aca con ?cancelada=1 despues de borrar
$cancelada = isset($_GET['cancelada']);

// 2026-10-14 09:15:00 -> 14/10/2026
function fecha($texto) {
    return date('d/m/Y', strtotime($texto));
}
?>

<main class="container py-4">

    <nav aria-label="Ruta de navegación">
        <ol class="breadcrumb miga">
            <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Mis preinscripciones</li>
        </ol>
    </nav>

    <h1 class="mb-3">Mis preinscripciones</h1>

    <?php if ($cancelada) { ?>
        <div class="aviso mb-3">
            <img src="../assets/iconos/aviso-exito.png" alt="Éxito" class="icono-aviso">
            <div>
                <strong>Preinscripción cancelada</strong>
                <p class="mb-0">Ahora tenés <?php echo $cantidad; ?> de 3. Podés hacer otra preinscripción cuando quieras.</p>
            </div>
        </div>
    <?php } ?>

    <div class="aviso mb-4">
        <img src="../assets/iconos/aviso-info.png" alt="Información" class="icono-aviso">
        <div>
            <p class="mb-0">La preinscripción no es una inscripción definitiva. Adscripción se va a comunicar al teléfono registrado en tu cuenta.</p>
        </div>
    </div>

    <section class="tarjeta seccion-estadistica h-auto">
        <h2>Mis preinscripciones (<?php echo $cantidad; ?> de 3)</h2>

        <?php if ($cantidad == 0) { ?>

            <p class="dato-suave">Todavía no tenés preinscripciones</p>
            <a href="preinscripcion.php" class="btn btn-dorado">Preinscribirme a un curso</a>

        <?php } else { ?>

            <div class="table-responsive">
                <table class="tabla-datos">
                    <thead>
                        <tr>
                            <th>Curso</th>
                            <th>Turno</th>
                            <th>Sede</th>
                            <th>Grado</th>
                            <th>Fecha de solicitud</th>
                            <th>Situación</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($preinscripciones as $pre) { ?>
                            <tr>
                                <td><strong><?php echo $pre['curso']; ?></strong></td>
                                <td><?php echo $pre['turno']; ?></td>
                                <td><?php echo $pre['sede']; ?></td>
                                <td><?php echo $pre['grado']; ?></td>
                                <td><?php echo fecha($pre['Fecha']); ?></td>
                                <td>
                                    <?php if ($pre['posicion'] <= $pre['cupo']) { ?>
                                        <span class="etiqueta-estado">Dentro del cupo</span>
                                    <?php } else { ?>
                                        <span class="etiqueta-estado">Lista de espera n.º <?php echo $pre['posicion'] - $pre['cupo']; ?></span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-peligro btn-sm" data-bs-toggle="modal" data-bs-target="#cancelar-<?php echo $pre['ID_Preinscripcion']; ?>">Cancelar</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <?php if ($cantidad < 3) { ?>
                <a href="preinscripcion.php" class="btn btn-dorado mt-3">Hacer otra preinscripción</a>
            <?php } ?>

        <?php } ?>
    </section>

</main>

<!-- una ventana de confirmacion por cada preinscripcion (14b) -->
<?php foreach ($preinscripciones as $pre) { ?>
    <div class="modal fade" id="cancelar-<?php echo $pre['ID_Preinscripcion']; ?>" tabindex="-1" aria-labelledby="titulo-cancelar-<?php echo $pre['ID_Preinscripcion']; ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="titulo-cancelar-<?php echo $pre['ID_Preinscripcion']; ?>">¿Cancelar esta preinscripción?</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <p class="fw-bold mb-2"><?php echo $pre['curso'] . ' - ' . $pre['grado']; ?></p>
                    <p class="mb-0">Vas a perder tu lugar en la lista. Si después te volvés a preinscribir, quedás al final. Esta acción no se puede deshacer.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-borde" data-bs-dismiss="modal">Volver</button>
                    <!-- integracion backend: ricardo recibe el id, borra la preinscripcion y vuelve con ?cancelada=1 -->
                    <form action="mis-preinscripciones.php" method="post" class="m-0">
                        <input type="hidden" name="id_preinscripcion" value="<?php echo $pre['ID_Preinscripcion']; ?>">
                        <button type="submit" class="btn btn-peligro">Sí, cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php include '../includes/footer.php'; ?>