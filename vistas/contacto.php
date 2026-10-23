<?php
$titulo = 'Contacto - Escuela Técnica N.º 1';
$ruta = '../';
include '../includes/head.php';
include '../includes/header.php';

// integracion backend: telefonos, horario y correo salen de Configuracion
$direccion = 'Avda. José G. Artigas esq. Pedro Acosta, Bella Unión';
$telefono_administracion = '4779 2025';
$telefono_adscripcion = '4779 4046';
$horario_adscripcion = '8:00 a 11:30 y 13:00 a 20:30';
$correo = 'ubellaunion@gmail.com';

// integracion backend: direccion de cada anexo (tabla Anexo)
// falta: telefonos de los anexos y la calle completa de baltasar brum
$anexos = [
    [
        'nombre'    => 'Baltasar Brum',
        'direccion' => 'José Batlle y Ordóñez, Baltasar Brum'
    ],
    [
        'nombre'    => 'Tomás Gomensoro',
        'direccion' => '25 de Agosto y Manuel Jesús González, Tomás Gomensoro'
    ]
];

// lo que se busca en google maps (sin clave, alcanza con el texto de la direccion)
// falta: confirmar con la escuela que el punto del mapa quede bien ubicado
$lugar_mapa = 'Avenida José G. Artigas y Pedro Acosta, Bella Unión, Artigas, Uruguay';
?>

<main class="container py-4">

    <nav aria-label="Ruta de navegación">
        <ol class="breadcrumb miga">
            <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contacto</li>
        </ol>
    </nav>

    <h1>Contacto</h1>
    <p class="subtitulo">Comunicate con la escuela o acercate a la sede</p>

    <div class="row g-4 mt-1">

        <div class="col-lg-5">
            <section class="tarjeta h-auto">
                <h2 class="titulo-bloque">Escuela Técnica N.º 1 - Bella Unión</h2>

                <dl class="datos-servicio mb-0">
                    <dt>Dirección</dt>
                    <dd><?php echo $direccion; ?></dd>

                    <dt>Teléfono de Administración</dt>
                    <dd><a href="tel:<?php echo str_replace(' ', '', $telefono_administracion); ?>"><?php echo $telefono_administracion; ?></a></dd>

                    <dt>Teléfono de Adscripción</dt>
                    <dd><a href="tel:<?php echo str_replace(' ', '', $telefono_adscripcion); ?>"><?php echo $telefono_adscripcion; ?></a></dd>

                    <dt>Horario de Adscripción</dt>
                    <dd><?php echo $horario_adscripcion; ?></dd>

                    <dt>Correo electrónico</dt>
                    <dd><a href="mailto:<?php echo $correo; ?>"><?php echo $correo; ?></a></dd>

                    <dt>Anexos</dt>
                    <dd class="mb-0">
                        <?php foreach ($anexos as $anexo) { ?>
                            <span class="d-block"><strong><?php echo $anexo['nombre']; ?>:</strong> <?php echo $anexo['direccion']; ?></span>
                        <?php } ?>
                    </dd>
                </dl>
            </section>
        </div>

        <div class="col-lg-7">
            <!-- el footer manda aca con "como llegar" (contacto.php#mapa) -->
            <section id="mapa" class="tarjeta h-auto mapa">
                <iframe
                    src="https://maps.google.com/maps?q=<?php echo urlencode($lugar_mapa); ?>&z=16&output=embed"
                    title="Mapa con la ubicación de la escuela"
                    loading="lazy"
                    allowfullscreen></iframe>

                <a href="https://www.google.com/maps/dir/?api=1&destination=<?php echo urlencode($lugar_mapa); ?>" target="_blank" rel="noopener" class="btn btn-dorado mt-3">Cómo llegar</a>
            </section>
        </div>

    </div>

</main>

<?php include '../includes/footer.php'; ?>