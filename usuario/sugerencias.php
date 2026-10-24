<?php
$titulo = 'Sugerencias - Escuela Técnica N.º 1';
$ruta = '../';

// si no inicio sesion, va al login y despues vuelve aca
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php?desde=sugerencias');
    exit;
}

include '../includes/head.php';
include '../includes/header.php';

// los administradores no envian sugerencias (rne-16)
$es_admin = $_SESSION['tipo'] == 'administrador';

// integracion backend: se guardaria la sugerencia y vuelve con ?enviada=1
$enviada = isset($_GET['enviada']);

// integracion backend: si llega vacia, vuelve con ?error=vacia
$error = '';
if (isset($_GET['error'])) {
    $error = $_GET['error'];
}
?>

<main class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <nav aria-label="Ruta de navegación">
                <ol class="breadcrumb miga">
                    <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sugerencias</li>
                </ol>
            </nav>

            <h1 class="mb-2">Sugerencias</h1>
            <p class="dato-suave mb-4">Contanos qué te gustaría mejorar o proponer a la escuela. Tu sugerencia la lee la dirección.</p>

            <?php if ($es_admin) { ?>

                <div class="aviso">
                    <img src="../assets/iconos/aviso-info.png" alt="Información" class="icono-aviso">
                    <div>
                        <strong>Las sugerencias las envían los usuarios</strong>
                        <p class="mb-0">Como administrador, las podés ver desde el panel</p>
                    </div>
                </div>

            <?php } else if ($enviada) { ?>

                <div class="aviso mb-3">
                    <img src="../assets/iconos/aviso-exito.png" alt="Éxito" class="icono-aviso">
                    <div>
                        <strong>Gracias, recibimos tu sugerencia</strong>
                        <p class="mb-0">La dirección la va a leer. No se publica en el sitio</p>
                    </div>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="sugerencias.php" class="btn btn-dorado">Enviar otra</a>
                    <a href="../index.php" class="btn btn-borde">Volver al inicio</a>
                </div>

            <?php } else { ?>

                <div id="aviso-errores" class="aviso mb-3 <?php if ($error != 'vacia') { echo 'd-none'; } ?>">
                    <img src="../assets/iconos/aviso-error.png" alt="Error" class="icono-aviso">
                    <div>
                        <strong>No pudimos enviar tu sugerencia</strong>
                        <p class="mb-0">Escribí tu sugerencia antes de enviarla</p>
                    </div>
                </div>

                <!-- integracion backend: recibe 'contenido', le agrega la fecha y el id del usuario de la sesion -->
                <form id="form-sugerencia" action="sugerencias.php" method="post" class="tarjeta h-auto form-cuenta" novalidate>
                    <label for="contenido" class="form-label">Tu sugerencia</label>
                    <textarea id="contenido" name="contenido" class="form-control" rows="6" maxlength="1000"></textarea>
                    <div class="invalid-feedback">Escribí tu sugerencia</div>
                    <div class="form-text"><span id="contador">0</span> de 1000 caracteres</div>

                    <p class="dato-suave mt-3 mb-0">La sugerencia se guarda con tu nombre, pero solo la ve la dirección</p>

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <button type="submit" class="btn btn-dorado">Enviar sugerencia</button>
                        <a href="../index.php" class="btn btn-borde">Cancelar</a>
                    </div>
                </form>

            <?php } ?>

        </div>
    </div>
</main>

<script src="../assets/javascripts/sugerencias.js"></script>

<?php include '../includes/footer.php'; ?>