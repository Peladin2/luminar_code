<?php
$titulo = 'Estadísticas - Escuela Técnica N.º 1';
$ruta = '../';
include '../includes/head.php';
include '../includes/header.php';

$anio = 2026;

// integracion backend: datos de la tabla Estadistica del año elegido
// datos de utu 2026 (excel de estudiantes y word de funcionarios)
$estadisticas = [
    // estudiantes por nivel en la sede central
    ['Categoria' => 'nivel', 'Titulo' => 'CPI', 'Descripcion' => 'Capacitación: Electrotecnia básica', 'Valor' => 25],
    ['Categoria' => 'nivel', 'Titulo' => 'FPB', 'Descripcion' => 'Formación Profesional Básica', 'Valor' => 85],
    ['Categoria' => 'nivel', 'Titulo' => 'EBI', 'Descripcion' => 'Educación Básica Integrada (7.º, 8.º y 9.º)', 'Valor' => 212],
    ['Categoria' => 'nivel', 'Titulo' => 'BTP', 'Descripcion' => 'Bachillerato Técnico Profesional', 'Valor' => 264],
    ['Categoria' => 'nivel', 'Titulo' => 'BT', 'Descripcion' => 'Bachillerato Tecnológico', 'Valor' => 413],
    ['Categoria' => 'nivel', 'Titulo' => 'CTT', 'Descripcion' => 'Cursos Técnicos Terciarios', 'Valor' => 95],
    ['Categoria' => 'nivel', 'Titulo' => 'Tecnólogo', 'Descripcion' => 'Sistemas de Producción Agropecuaria Familiar', 'Valor' => 15],

    // estudiantes por turno en la sede central
    ['Categoria' => 'turno', 'Titulo' => 'Turno 1 · Mañana (07:00 a 13:20)', 'Descripcion' => '', 'Valor' => 398],
    ['Categoria' => 'turno', 'Titulo' => 'Turno 2 · Intermedio (09:20 a 15:40)', 'Descripcion' => '', 'Valor' => 15],
    ['Categoria' => 'turno', 'Titulo' => 'Turno 3 · Tarde (12:35 a 18:50)', 'Descripcion' => '', 'Valor' => 266],
    ['Categoria' => 'turno', 'Titulo' => 'Turno 4 · Tarde-noche (15:40 a 21:45)', 'Descripcion' => '', 'Valor' => 60],
    ['Categoria' => 'turno', 'Titulo' => 'Turno 5 · Noche (18:10 a 23:55)', 'Descripcion' => '', 'Valor' => 278],
    ['Categoria' => 'turno', 'Titulo' => 'Turno 7 · Agrario Rural y Tecnólogo', 'Descripcion' => '', 'Valor' => 92],

    // estudiantes en los anexos
    ['Categoria' => 'anexo', 'Titulo' => 'Anexo Tomás Gomensoro', 'Descripcion' => 'Plan Rumbo y BT Gestión y Administración', 'Valor' => 43],
    ['Categoria' => 'anexo', 'Titulo' => 'Anexo Baltasar Brum', 'Descripcion' => 'BTP Cocina y BT Agrario Rural', 'Valor' => 56],

    // personal
    ['Categoria' => 'personal', 'Titulo' => 'Docentes', 'Descripcion' => '29 efectivos, 154 interinos, 26 suplentes', 'Valor' => 209],
    ['Categoria' => 'personal', 'Titulo' => 'Adscriptos', 'Descripcion' => '5 efectivos, 6 interinos, 1 suplente', 'Valor' => 12],
    ['Categoria' => 'personal', 'Titulo' => 'Administrativos', 'Descripcion' => '2 hombres, 6 mujeres', 'Valor' => 8],
    ['Categoria' => 'personal', 'Titulo' => 'Auxiliares de servicio', 'Descripcion' => '1 hombre, 5 mujeres', 'Valor' => 6]
];

// devuelve solo las filas de una categoria
function por_categoria($lista, $categoria) {
    $resultado = [];
    foreach ($lista as $fila) {
        if ($fila['Categoria'] == $categoria) {
            $resultado[] = $fila;
        }
    }
    return $resultado;
}

// suma los valores de una lista
function sumar($lista) {
    $total = 0;
    foreach ($lista as $fila) {
        $total = $total + $fila['Valor'];
    }
    return $total;
}

// pone el punto de los miles (1208 -> 1.208)
function numero($n) {
    return number_format($n, 0, ',', '.');
}

$niveles  = por_categoria($estadisticas, 'nivel');
$turnos   = por_categoria($estadisticas, 'turno');
$anexos   = por_categoria($estadisticas, 'anexo');
$personal = por_categoria($estadisticas, 'personal');

$total_central = sumar($niveles);
$total_turnos  = sumar($turnos);
$total_anexos  = sumar($anexos);
$total_estudiantes = $total_central + $total_anexos;

// el primero de personal son los docentes
$total_docentes = $personal[0]['Valor'];

$anios_historia = date('Y') - 1978;

// integracion backend: demanda = cantidad de preinscripciones por oferta del año elegido
// datos de prueba
$anio_demanda = 2027;
if (isset($_GET['anio'])) {
    $anio_demanda = $_GET['anio'];
}

$demanda = [
    ['oferta' => 'EBI 1.º', 'cantidad' => 34],
    ['oferta' => 'Bach. Informática 2.º', 'cantidad' => 22],
    ['oferta' => 'Bach. Administración 1.º', 'cantidad' => 20],
    ['oferta' => 'Bach. Informática 1.º', 'cantidad' => 18],
    ['oferta' => 'BTP Instalaciones Eléctricas 1.º', 'cantidad' => 6]
];

// la barra mas larga es la de mayor cantidad
$mayor = 0;
foreach ($demanda as $fila) {
    if ($fila['cantidad'] > $mayor) {
        $mayor = $fila['cantidad'];
    }
}
?>

<main class="container py-4">

    <nav aria-label="Ruta de navegación">
        <ol class="breadcrumb miga">
            <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
            <li class="breadcrumb-item"><a href="mision-vision.php">Institucional</a></li>
            <li class="breadcrumb-item active" aria-current="page">Estadísticas</li>
        </ol>
    </nav>

    <h1 class="mb-4">Estadísticas institucionales <?php echo $anio; ?></h1>

    <!-- datos principales -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <div class="tarjeta dato-grande">
                <span class="numero"><?php echo numero($total_estudiantes); ?></span>
                <strong>Total de estudiantes</strong>
                <span class="dato-suave">Sede Central y anexos</span>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="tarjeta dato-grande">
                <span class="numero"><?php echo $total_docentes; ?></span>
                <strong>Docentes</strong>
                <span class="dato-suave">Efectivos, interinos y suplentes</span>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="tarjeta dato-grande">
                <span class="numero"><?php echo $anios_historia; ?></span>
                <strong>Años de historia</strong>
                <span class="dato-suave">Fundada el 9 de marzo de 1978</span>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="tarjeta dato-grande">
                <span class="numero">4</span>
                <strong>Sedes</strong>
                <span class="dato-suave">Central, Brum, Gomensoro y Polideportivo</span>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">

        <!-- por nivel -->
        <div class="col-lg-8">
            <section class="tarjeta seccion-estadistica h-auto">
                <h2>Estudiantes por nivel - Sede Central</h2>
                <div class="table-responsive">
                    <table class="tabla-datos">
                        <thead>
                            <tr>
                                <th>Nivel</th>
                                <th>Descripción</th>
                                <th class="text-end">Estudiantes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($niveles as $fila) { ?>
                                <tr>
                                    <td><strong><?php echo $fila['Titulo']; ?></strong></td>
                                    <td><?php echo $fila['Descripcion']; ?></td>
                                    <td class="text-end"><strong><?php echo $fila['Valor']; ?></strong></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr class="fila-total">
                                <td colspan="2">Total Sede Central</td>
                                <td class="text-end"><?php echo numero($total_central); ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </section>
        </div>

        <!-- por turno -->
        <div class="col-lg-4">
            <section class="tarjeta seccion-estadistica h-auto">
                <h2>Distribución por turno</h2>
                <table class="tabla-datos">
                    <tbody>
                        <?php foreach ($turnos as $fila) { ?>
                            <tr>
                                <td><?php echo $fila['Titulo']; ?></td>
                                <td class="text-end"><strong><?php echo $fila['Valor']; ?></strong></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr class="fila-total">
                            <td>Total</td>
                            <td class="text-end"><?php echo numero($total_turnos); ?></td>
                        </tr>
                    </tfoot>
                </table>
            </section>
        </div>

    </div>

    <!-- anexos -->
    <section class="tarjeta seccion-estadistica h-auto mb-4">
        <h2>Estudiantes en anexos</h2>
        <div class="row g-3">
            <?php foreach ($anexos as $fila) { ?>
                <div class="col-md-4">
                    <div class="caja-dato">
                        <strong><?php echo $fila['Titulo']; ?></strong>
                        <span class="dato-suave"><?php echo $fila['Descripcion']; ?></span>
                        <span class="cantidad"><?php echo $fila['Valor']; ?> estudiantes</span>
                    </div>
                </div>
            <?php } ?>
            <div class="col-md-4">
                <div class="caja-dato caja-total">
                    <strong>Total de anexos</strong>
                    <span class="cantidad"><?php echo $total_anexos; ?> estudiantes</span>
                </div>
            </div>
        </div>
    </section>

    <!-- personal -->
    <section class="tarjeta seccion-estadistica h-auto mb-4">
        <h2>Personal de la institución</h2>
        <div class="row g-3">
            <?php foreach ($personal as $fila) { ?>
                <div class="col-6 col-lg-3">
                    <div class="caja-dato">
                        <strong><?php echo $fila['Titulo']; ?></strong>
                        <span class="cantidad"><?php echo $fila['Valor']; ?> en total</span>
                        <span class="dato-suave"><?php echo $fila['Descripcion']; ?></span>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <!-- demanda por curso -->
    <section class="tarjeta seccion-estadistica h-auto">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-2">
            <h2 class="mb-0">Demanda por curso</h2>
            <div class="ir-a m-0">
                <a href="estadisticas.php?anio=2027" class="<?php if ($anio_demanda == 2027) { echo 'activo'; } ?>">2027</a>
                <a href="estadisticas.php?anio=2026" class="<?php if ($anio_demanda == 2026) { echo 'activo'; } ?>">2026</a>
            </div>
        </div>
        <p class="dato-suave">Cantidad de preinscripciones por oferta en <?php echo htmlspecialchars($anio_demanda); ?></p>

        <?php foreach ($demanda as $fila) { ?>
            <div class="fila-barra">
                <span class="nombre"><?php echo $fila['oferta']; ?></span>
                <div class="barra">
                    <div class="relleno" style="width: <?php echo $fila['cantidad'] * 100 / $mayor; ?>%"></div>
                </div>
                <span class="cantidad"><?php echo $fila['cantidad']; ?></span>
            </div>
        <?php } ?>
    </section>

</main>

<?php include '../includes/footer.php'; ?>