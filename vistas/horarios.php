<?php
$titulo = 'Horarios - Escuela Técnica N.º 1';
$ruta = '../';
include '../includes/head.php';
include '../includes/header.php';

// integracion backend: turnos de la tabla Turno (las horas vienen como 07:00:00)
// y los cursos de cada turno salen de las ofertas educativas de ese turno
// datos de prueba
$turnos = [
    [
        'Numero_Turno' => 1,
        'Descripcion'  => 'Mañana',
        'Hora_Entrada' => '07:00:00',
        'Hora_Salida'  => '13:20:00',
        'cursos'       => 'EBI, FPB, Bachilleratos (Informática, Administración, Deporte, Agrario) y BTP'
    ],
    [
        'Numero_Turno' => 2,
        'Descripcion'  => 'Intermedio',
        'Hora_Entrada' => '09:20:00',
        'Hora_Salida'  => '15:40:00',
        'cursos'       => 'Bach. Recreación y Deporte (3.º año)'
    ],
    [
        'Numero_Turno' => 3,
        'Descripcion'  => 'Tarde',
        'Hora_Entrada' => '12:35:00',
        'Hora_Salida'  => '18:50:00',
        'cursos'       => 'EBI, FPB, Bachilleratos (Informática, Administración, Deporte, Agrario) y BTP'
    ],
    [
        'Numero_Turno' => 4,
        'Descripcion'  => 'Tarde-noche',
        'Hora_Entrada' => '15:40:00',
        'Hora_Salida'  => '21:45:00',
        'cursos'       => 'BTP Mecánica Industrial, Estética Personal y Edificaciones'
    ],
    [
        'Numero_Turno' => 5,
        'Descripcion'  => 'Noche',
        'Hora_Entrada' => '18:10:00',
        'Hora_Salida'  => '23:55:00',
        'cursos'       => 'Bach. Administración, BTP, CTT, Tecnólogo y Plan Rumbo'
    ]
];

// saca los segundos: 07:00:00 a 07:00
function hora($texto) {
    return substr($texto, 0, 5);
}
?>

<main class="container py-4">

    <nav aria-label="Ruta de navegación">
        <ol class="breadcrumb miga">
            <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Horarios</li>
        </ol>
    </nav>

    <h1 class="mb-4">Horarios de cursos</h1>

    <?php if ($hay_sesion) { ?>

        <section class="tarjeta seccion-estadistica h-auto">
            <h2>Turnos disponibles</h2>
            <div class="table-responsive">
                <table class="tabla-datos">
                    <thead>
                        <tr>
                            <th>Turno</th>
                            <th>Horario</th>
                            <th>Cursos habituales</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($turnos as $turno) { ?>
                            <tr>
                                <td><strong>Turno <?php echo $turno['Numero_Turno']; ?> · <?php echo $turno['Descripcion']; ?></strong></td>
                                <td class="text-nowrap"><?php echo hora($turno['Hora_Entrada']); ?> a <?php echo hora($turno['Hora_Salida']); ?></td>
                                <td><?php echo $turno['cursos']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>

        <p class="dato-suave mt-3 mb-0">Los horarios pueden cambiar durante el año. Consultalos siempre en esta página.</p>

    <?php } else { ?>

        <section class="tarjeta h-auto restringido mx-auto mb-4">
            <img src="../assets/iconos/aviso-alerta.png" alt="" class="icono-restringido">
            <h2>Contenido restringido</h2>
            <p>Los horarios de cursos son exclusivos para usuarios registrados. Tenés que iniciar sesión o crear una cuenta para ver esta sección.</p>
            <div class="d-flex flex-wrap justify-content-center gap-2">
                <a href="../usuario/login.php?desde=horarios" class="btn btn-dorado">Iniciar sesión</a>
                <a href="../usuario/registro.php" class="btn btn-borde">Crear cuenta</a>
            </div>
        </section>

        <section class="tarjeta seccion-estadistica h-auto">
            <h2>Información general de turnos</h2>
            <div class="row g-3">
                <?php foreach ($turnos as $turno) { ?>
                    <div class="col-sm-6 col-lg">
                        <div class="caja-dato">
                            <strong>Turno <?php echo $turno['Numero_Turno']; ?> · <?php echo $turno['Descripcion']; ?></strong>
                            <span><?php echo hora($turno['Hora_Entrada']); ?> a <?php echo hora($turno['Hora_Salida']); ?></span>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>

    <?php } ?>

</main>

<?php include '../includes/footer.php'; ?>