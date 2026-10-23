<?php
$titulo = 'Mi perfil - Escuela Técnica N.º 1';
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

// integracion backend: datos del usuario con sesion y su responsable (si tiene)
// datos de prueba
$usuario = [
    'Nombre'           => 'Juan',
    'Apellido'         => 'Pérez',
    'CI'               => '4.123.456-3',
    'Mail'             => 'juan.perez@correo.com',
    'Telefono'         => '099 123 456',
    'Fecha_Nacimiento' => '2009-03-15'
];

$responsable = [
    'Nombre'   => 'María',
    'Apellido' => 'Pérez',
    'CI'       => '3.987.654-3',
    'Telefono' => '098 765 432'
];

// integracion backend: preinscripciones del usuario
// datos de prueba
$preinscripciones = [
    [
        'oferta'   => 'Bach. Informática - 1.º año',
        'sede'     => 'Sede Central',
        'posicion' => 12,
        'cupo'     => 25
    ]
];
$cantidad = count($preinscripciones);

// edad a partir de la fecha de nacimiento
$edad = date_diff(date_create($usuario['Fecha_Nacimiento']), date_create('today'))->y;

// iniciales para el circulo: Juan Pérez -> JP
$iniciales = mb_substr($usuario['Nombre'], 0, 1) . mb_substr($usuario['Apellido'], 0, 1);

// integracion backend: vuelve aca con ?actualizado=1 despues de guardar los cambios
$actualizado = isset($_GET['actualizado']);
?>

<main class="container py-4">

    <nav aria-label="Ruta de navegación">
        <ol class="breadcrumb miga">
            <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Mi perfil</li>
        </ol>
    </nav>

    <h1 class="mb-3">Mi perfil</h1>

    <?php if ($actualizado) { ?>
        <div class="aviso mb-3">
            <img src="../assets/iconos/aviso-exito.png" alt="Éxito" class="icono-aviso">
            <div>
                <strong>Tus datos se actualizaron</strong>
                <p class="mb-0">Los vas a ver así en tus próximas preinscripciones</p>
            </div>
        </div>
    <?php } ?>

    <div class="row g-4">

        <div class="col-lg-8">
            <section class="tarjeta h-auto">
                <h2 class="titulo-bloque">Mis datos personales</h2>

                <div class="d-flex align-items-center gap-3 pb-3 mb-3 borde-abajo">
                    <span class="avatar"><?php echo $iniciales; ?></span>
                    <div>
                        <strong class="d-block fs-4 text-marron"><?php echo htmlspecialchars($usuario['Nombre'] . ' ' . $usuario['Apellido']); ?></strong>
                        <span class="dato-suave">Usuario registrado</span>
                    </div>
                </div>

                <dl class="row datos-perfil pb-2 mb-3 borde-abajo">
                    <dt class="col-sm-4">Cédula de identidad</dt>
                    <dd class="col-sm-8"><?php echo $usuario['CI']; ?></dd>
                    <dt class="col-sm-4">Correo electrónico</dt>
                    <dd class="col-sm-8"><?php echo htmlspecialchars($usuario['Mail']); ?></dd>
                    <dt class="col-sm-4">Teléfono</dt>
                    <dd class="col-sm-8"><?php echo htmlspecialchars($usuario['Telefono']); ?></dd>
                </dl>

                <dl class="row datos-perfil mb-3">
                    <dt class="col-sm-4">Datos del responsable</dt>
                    <dd class="col-sm-8">
                        <?php if ($edad < 18) { ?>
                            <?php echo htmlspecialchars($responsable['Nombre'] . ' ' . $responsable['Apellido']); ?><br>
                            CI <?php echo $responsable['CI']; ?> · Tel. <?php echo htmlspecialchars($responsable['Telefono']); ?>
                        <?php } else { ?>
                            No aplica (usuario mayor de edad)
                        <?php } ?>
                    </dd>
                </dl>

                <a href="editar-perfil.php" class="btn btn-dorado">Editar mis datos</a>
            </section>
        </div>

        <aside class="col-lg-4">
            <section class="tarjeta h-auto">
                <h2 class="titulo-bloque">Mis preinscripciones (<?php echo $cantidad; ?> de 3)</h2>

                <?php if ($cantidad == 0) { ?>
                    <p class="dato-suave">Todavía no tenés preinscripciones</p>
                <?php } ?>

                <?php foreach ($preinscripciones as $pre) { ?>
                    <div class="mb-3">
                        <strong class="d-block"><?php echo $pre['oferta']; ?></strong>
                        <span class="d-block"><?php echo $pre['sede']; ?></span>
                        <?php if ($pre['posicion'] <= $pre['cupo']) { ?>
                            <span class="etiqueta-estado">Dentro del cupo</span>
                        <?php } else { ?>
                            <span class="etiqueta-estado">Lista de espera n.º <?php echo $pre['posicion'] - $pre['cupo']; ?></span>
                        <?php } ?>
                        <span class="d-block dato-suave mt-1">Adscripción se va a comunicar con vos</span>
                    </div>
                <?php } ?>

                <a href="mis-preinscripciones.php" class="link-volver d-inline-block mb-3">Ver mis preinscripciones</a>

                <?php if ($cantidad < 3) { ?>
                    <a href="preinscripcion.php" class="btn btn-dorado w-100">Hacer otra preinscripción</a>
                <?php } ?>
            </section>
        </aside>

    </div>

</main>

<?php include '../includes/footer.php'; ?>