<?php
$titulo = 'Iniciar sesión - Escuela Técnica N.º 1';
$ruta = '../';
include '../includes/head.php';
include '../includes/header.php';

// de donde viene (lo mandan el header y el footer)
$desde = '';
if (isset($_GET['desde'])) {
    $desde = $_GET['desde'];
}

// integracion backend: el login  vuelve aca con ?error= si algo sale mal
$error = '';
if (isset($_GET['error'])) {
    $error = $_GET['error'];
}

// integracion backend: telefono y horario salen de Configuracion
$telefono_adscripcion = '4779 4046';
$horario_adscripcion = '8:00 a 11:30 y 13:00 a 20:30';
?>

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-5">

            <?php if ($desde == 'preinscripcion') { ?>
                <div class="aviso mb-3">
                    <img src="../assets/iconos/aviso-info.png" alt="Información" class="icono-aviso">
                    <div>
                        <strong>Para preinscribirte tenés que iniciar sesión</strong>
                        <p class="mb-0">Si todavía no tenés cuenta, registrate primero</p>
                    </div>
                </div>
            <?php } else if ($desde == 'sugerencias') { ?>
                <div class="aviso mb-3">
                    <img src="../assets/iconos/aviso-info.png" alt="Información" class="icono-aviso">
                    <div>
                        <strong>Para enviar una sugerencia tenés que iniciar sesión</strong>
                        <p class="mb-0">Si todavía no tenés cuenta, registrate primero</p>
                    </div>
                </div>
            <?php } ?>

            <?php if ($error == 'datos') { ?>
                <div class="aviso mb-3">
                    <img src="../assets/iconos/aviso-error.png" alt="Error" class="icono-aviso">
                    <div>
                        <strong>No pudimos iniciar sesión</strong>
                        <p class="mb-0">El correo o la contraseña no son correctos</p>
                    </div>
                </div>
            <?php } else if ($error == 'desactivada') { ?>
                <div class="aviso mb-3">
                    <img src="../assets/iconos/aviso-error.png" alt="Error" class="icono-aviso">
                    <div>
                        <strong>Tu cuenta está desactivada</strong>
                        <p class="mb-0">Comunicate con Adscripción al <?php echo $telefono_adscripcion; ?> para reactivarla</p>
                    </div>
                </div>
            <?php } ?>

            <section class="tarjeta h-auto form-cuenta">
                <h1>Iniciar sesión</h1>
                <p class="text-center mb-4">Ingresá tus datos para continuar</p>

                <!-- integracion backend: aca recibe mail, contraseña y desde, y si esta bien mandaaria a la pagina que corresponda -->
                <form action="login.php" method="post">
                    <input type="hidden" name="desde" value="<?php echo htmlspecialchars($desde); ?>">

                    <div class="mb-3">
                        <label for="mail" class="form-label">Correo electrónico</label>
                        <input type="email" id="mail" name="mail" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label for="contrasena" class="form-label">Contraseña</label>
                    <div class="input-group">
                        <input type="password" id="contrasena" name="contrasena" class="form-control" required>
                        <button type="button" class="btn btn-ojo" data-campo="contrasena" aria-label="Mostrar contraseña"><i class="bi bi-eye"></i></button>
                    </div>
                    </div>

                    <div class="text-end mb-3">
                        <button type="button" class="btn btn-link link-mas p-0" data-bs-toggle="collapse" data-bs-target="#olvido" aria-expanded="false" aria-controls="olvido">¿Olvidaste tu contraseña?</button>
                    </div>

                    <!-- se despliega al tocar el link, no se manda ningun correo -->
                    <div id="olvido" class="collapse">
                        <div class="aviso mb-3">
                            <img src="../assets/iconos/aviso-info.png" alt="Información" class="icono-aviso">
                            <div>
                                <strong>¿Olvidaste tu contraseña?</strong>
                                <p class="mb-0">
                                    Comunicate con Adscripción al <a href="tel:<?php echo str_replace(' ', '', $telefono_adscripcion); ?>"><?php echo $telefono_adscripcion; ?></a>
                                    en su horario de atención (<?php echo $horario_adscripcion; ?>). Te van a asignar una contraseña nueva.
                                </p>
                                </p>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-dorado w-100">Ingresar</button>
                </form>

                <hr class="my-4">

                <div class="d-flex justify-content-center align-items-center gap-3">
                    <span>¿No tenés cuenta?</span>
                    <a href="registro.php" class="btn btn-borde btn-sm">Registrarse</a>
                </div>
            </section>

        </div>
    </div>
</main>

<script src="../assets/javascripts/ver-contrasena.js"></script>

<?php include '../includes/footer.php'; ?>