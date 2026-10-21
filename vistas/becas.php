<?php
$titulo = 'Becas - Escuela Técnica N.º 1';
$ruta = '../';
include '../includes/head.php';
include '../includes/header.php';

// integracion backend: telefono y correo salen de Configuracion
// falta confirmar el telefono de adscripcion con la escuela
$telefono_adscripcion = '4779 4146';
$correo = 'ubellaunion@gmail.com';

// pasos para pedir la beca butia
$pasos = [
    'Entrar a la página de Becas Butiá',
    'Registrarse como usuario',
    'Completar el formulario de solicitud',
    'Adjuntar la documentación que piden',
    'Esperar la respuesta'
];
?>

<main class="container py-4">

    <nav aria-label="Ruta de navegación">
        <ol class="breadcrumb miga">
            <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Becas</li>
        </ol>
    </nav>

    <h1 class="mb-3">Becas disponibles</h1>

    <div class="row g-4">

        <div class="col-lg-8">

            <div class="aviso mb-4">
                <img src="../assets/iconos/aviso-info.png" alt="Información" class="icono-aviso">
                <div>
                    <strong>Recordatorio</strong>
                    <p class="mb-0">Las inscripciones a la Beca Butiá abren a fin de año y cierran en marzo. Las fechas cambian cada año, así que consultalas en la página oficial y no te quedes sin pedirla a tiempo.</p>
                </div>
            </div>

            <article class="tarjeta tarjeta-beca mb-4">
                <h2>Beca Butiá</h2>
                <p>La Beca Butiá está destinada a estudiantes de educación media que necesiten apoyo económico para continuar sus estudios.</p>
                <p>Pueden pedirla estudiantes de 11 a 21 años de Ciclo Básico o Bachillerato de UTU o de liceos públicos.</p>
                <p><strong>Período de inscripción:</strong> de fin de año hasta marzo</p>
                <p><strong>Trámite:</strong> en la página oficial de Butiá</p>
                <a href="https://www.gub.uy/ministerio-educacion-cultura/butia" target="_blank" rel="noopener" class="btn btn-dorado mt-2">Ir a la página de Butiá</a>
            </article>

            <article class="tarjeta tarjeta-beca">
                <h2>Otras becas y apoyos</h2>
                <p>Consultá con Adscripción sobre otros programas de apoyo económico disponibles.</p>
                <p>
                    <strong>Teléfono Adscripción:</strong>
                    <a href="tel:<?php echo str_replace(' ', '', $telefono_adscripcion); ?>"><?php echo $telefono_adscripcion; ?></a>
                </p>
                <p class="mb-0">
                    <strong>Correo:</strong>
                    <a href="mailto:<?php echo $correo; ?>"><?php echo $correo; ?></a>
                </p>
            </article>

        </div>

        <aside class="col-lg-4">

            <div class="tarjeta info-util mb-4">
                <h2>Información útil</h2>
                <h3>¿Cómo solicitar una beca?</h3>
                <ol class="lista-pasos">
                    <?php foreach ($pasos as $paso) { ?>
                        <li><?php echo $paso; ?></li>
                    <?php } ?>
                </ol>
            </div>

            <img src="../assets/img/becas-butia.jpg" alt="Afiche de Becas Butiá: si sos estudiante de Educación Media postulate para recibir la beca" class="img-fluid rounded">

        </aside>

    </div>
</main>

<?php include '../includes/footer.php'; ?>