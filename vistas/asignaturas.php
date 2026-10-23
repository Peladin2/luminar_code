<?php
$titulo = 'Asignaturas - Escuela Técnica N.º 1';
$ruta = '../';
include '../includes/head.php';
include '../includes/header.php';

// nombres cortos de cada nivel para "se dicta en"
$nombres_nivel = [
    'EBI' => 'EBI',
    'FPB' => 'FPB',
    'BT'  => 'Bach. Tecnológico',
    'BTP' => 'Bach. Técnico Profesional',
    'CTT' => 'CTT'
];

// botones del filtro: codigo => texto (bachillerato junta BT y BTP)
$filtros = [
    ''     => 'Todos',
    'EBI'  => 'Ciclo Básico',
    'BACH' => 'Bachillerato',
    'FPB'  => 'FPB',
    'CTT'  => 'CTT'
];

// integracion backend: materias (tabla Materia) y los niveles de los cursos donde se dictan (Curso_Materia)
// falta: lista real de materias (sale del pdf de horarios de utu)
// datos de prueba
$materias = [
    ['Nombre' => 'Matemática',                 'niveles' => ['EBI', 'BT', 'BTP', 'CTT']],
    ['Nombre' => 'Idioma Español',             'niveles' => ['EBI', 'FPB']],
    ['Nombre' => 'Inglés',                     'niveles' => ['EBI', 'BT', 'BTP']],
    ['Nombre' => 'Física',                     'niveles' => ['BT', 'BTP']],
    ['Nombre' => 'Química',                    'niveles' => ['BT', 'BTP']],
    ['Nombre' => 'Biología',                   'niveles' => ['EBI', 'BT']],
    ['Nombre' => 'Historia',                   'niveles' => ['EBI', 'BT']],
    ['Nombre' => 'Programación',               'niveles' => ['BT', 'CTT']],
    ['Nombre' => 'Bases de datos',             'niveles' => ['BT', 'CTT']],
    ['Nombre' => 'Contabilidad',               'niveles' => ['BT']],
    ['Nombre' => 'Taller de cocina',           'niveles' => ['BTP', 'FPB']],
    ['Nombre' => 'Educación Física',           'niveles' => ['EBI', 'BT', 'FPB']]
];

// lo que eligio el usuario
$buscar = '';
if (isset($_GET['buscar'])) {
    $buscar = trim($_GET['buscar']);
}

$nivel = '';
if (isset($_GET['nivel'])) {
    $nivel = $_GET['nivel'];
}

// saca tildes y pasa a minuscula para comparar (Matemática = matematica)
function normalizar($texto) {
    $con_tilde = ['á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú'];
    $sin_tilde = ['a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u'];
    return mb_strtolower(str_replace($con_tilde, $sin_tilde, $texto));
}

// se quedan las materias que cumplen con la busqueda y el nivel
$resultado = [];
foreach ($materias as $materia) {
    if ($buscar != '' && strpos(normalizar($materia['Nombre']), normalizar($buscar)) === false) {
        continue;
    }
    if ($nivel == 'BACH') {
        if (!in_array('BT', $materia['niveles']) && !in_array('BTP', $materia['niveles'])) {
            continue;
        }
    } else if ($nivel != '' && !in_array($nivel, $materia['niveles'])) {
        continue;
    }
    $resultado[] = $materia;
}
?>

<main class="container py-4">

    <nav aria-label="Ruta de navegación">
        <ol class="breadcrumb miga">
            <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
            <li class="breadcrumb-item"><a href="oferta.php">Oferta educativa</a></li>
            <li class="breadcrumb-item active" aria-current="page">Asignaturas</li>
        </ol>
    </nav>

    <h1>Asignaturas</h1>
    <p class="subtitulo">Todas las materias que se dictan en la escuela y en qué cursos</p>

    <section class="tarjeta h-auto filtros mb-4">
        <form action="asignaturas.php" method="get" class="d-flex flex-wrap gap-2 mb-3">
            <input type="hidden" name="nivel" value="<?php echo htmlspecialchars($nivel); ?>">
            <label for="buscar" class="visually-hidden">Buscar una materia</label>
            <input type="search" id="buscar" name="buscar" class="form-control buscador" placeholder="Buscar una materia..." value="<?php echo htmlspecialchars($buscar); ?>">
            <button type="submit" class="btn btn-dorado">Buscar</button>
        </form>

        <div class="ir-a m-0">
            <span>Filtrar por nivel:</span>
            <?php foreach ($filtros as $codigo => $texto) { ?>
                <a href="asignaturas.php?nivel=<?php echo $codigo; ?>&buscar=<?php echo urlencode($buscar); ?>" class="<?php if ($nivel == $codigo) { echo 'activo'; } ?>"><?php echo $texto; ?></a>
            <?php } ?>
        </div>
    </section>

    <?php if (count($resultado) == 0) { ?>

        <div class="aviso">
            <img src="../assets/iconos/aviso-info.png" alt="Información" class="icono-aviso">
            <div>
                <strong>No encontramos materias con esa búsqueda</strong>
                <p class="mb-0">Probá con otra palabra o elegí "Todos"</p>
            </div>
        </div>

    <?php } else { ?>

        <div class="row g-3">
            <?php foreach ($resultado as $materia) { ?>
                <?php
                // arma "EBI · Bach. Tecnológico · CTT"
                $donde = [];
                foreach ($materia['niveles'] as $codigo) {
                    $donde[] = $nombres_nivel[$codigo];
                }
                ?>
                <div class="col-sm-6 col-lg-3">
                    <article class="caja-dato">
                        <strong><?php echo htmlspecialchars($materia['Nombre']); ?></strong>
                        <span class="dato-suave">Se dicta en: <?php echo implode(' · ', $donde); ?></span>
                    </article>
                </div>
            <?php } ?>
        </div>

    <?php } ?>

    <a href="oferta.php" class="link-volver d-inline-block mt-4">Volver a la oferta educativa</a>

</main>

<?php include '../includes/footer.php'; ?>