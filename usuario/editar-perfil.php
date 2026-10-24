<?php
$titulo = 'Editar mis datos - Escuela Técnica N.º 1';
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

// integracion backend: datos del usuario con sesion y su responsable
// datos de prueba (los mismos que en perfil.php)
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

$edad = date_diff(date_create($usuario['Fecha_Nacimiento']), date_create('today'))->y;
$es_menor = $edad < 18;

// integracion backend: vuelve con ?error=contrasena si la contraseña actual no es correcta
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
                    <li class="breadcrumb-item"><a href="perfil.php">Mi perfil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar mis datos</li>
                </ol>
            </nav>

            <h1 class="mb-3">Editar mis datos</h1>

            <div id="aviso-errores" class="aviso mb-3 <?php if ($error != 'contrasena') { echo 'd-none'; } ?>">
                <img src="../assets/iconos/aviso-error.png" alt="Error" class="icono-aviso">
                <div>
                    <strong>No pudimos guardar los cambios</strong>
                    <p class="mb-0">
                        <?php if ($error == 'contrasena') { ?>
                            La contraseña actual no es correcta
                        <?php } else { ?>
                            Revisá los campos marcados en rojo
                        <?php } ?>
                    </p>
                </div>
            </div>

            <!-- integracion backend: recibe los datos, guarda y vuelve a perfil.php?actualizado=1 -->
            <form id="form-perfil" action="editar-perfil.php" method="post" class="tarjeta h-auto form-cuenta" novalidate>

                <h2 class="titulo-bloque">Datos personales</h2>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo htmlspecialchars($usuario['Nombre']); ?>">
                        <div class="invalid-feedback">Escribí tu nombre</div>
                    </div>
                    <div class="col-md-6">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" id="apellido" name="apellido" class="form-control" value="<?php echo htmlspecialchars($usuario['Apellido']); ?>">
                        <div class="invalid-feedback">Escribí tu apellido</div>
                    </div>
                    <div class="col-md-6">
                        <label for="ci" class="form-label">Cédula de identidad</label>
                        <input type="text" id="ci" class="form-control" value="<?php echo $usuario['CI']; ?>" readonly>
                        <div class="form-text">No se puede cambiar. Si hay un error, comunicate con Adscripción.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="fecha" class="form-label">Fecha de nacimiento</label>
                        <input type="text" id="fecha" class="form-control" value="<?php echo date('d/m/Y', strtotime($usuario['Fecha_Nacimiento'])); ?>" readonly>
                        <div class="form-text">No se puede cambiar</div>
                    </div>
                    <div class="col-md-6">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="tel" id="telefono" name="telefono" class="form-control" value="<?php echo htmlspecialchars($usuario['Telefono']); ?>">
                        <div class="invalid-feedback">Escribí tu teléfono</div>
                    </div>
                    <div class="col-md-6">
                        <label for="mail" class="form-label">Correo electrónico</label>
                        <input type="email" id="mail" class="form-control" value="<?php echo htmlspecialchars($usuario['Mail']); ?>" readonly>
                        <div class="form-text">No se puede cambiar: es tu usuario para iniciar sesión</div>
                    </div>
                </div>

                <?php if ($es_menor) { ?>
                    <fieldset class="bloque-responsable mt-4">
                        <legend>Datos del adulto responsable</legend>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="resp_nombre" class="form-label">Nombre</label>
                                <input type="text" id="resp_nombre" class="form-control" value="<?php echo htmlspecialchars($responsable['Nombre']); ?>" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="resp_apellido" class="form-label">Apellido</label>
                                <input type="text" id="resp_apellido" class="form-control" value="<?php echo htmlspecialchars($responsable['Apellido']); ?>" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="resp_ci" class="form-label">Cédula de identidad</label>
                                <input type="text" id="resp_ci" class="form-control" value="<?php echo $responsable['CI']; ?>" readonly>
                                <div class="form-text">Nombre, apellido y cédula no se pueden cambiar. Si hay un error, comunicate con Adscripción.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="resp_telefono" class="form-label">Teléfono</label>
                                <input type="tel" id="resp_telefono" name="resp_telefono" class="form-control campo-responsable" value="<?php echo htmlspecialchars($responsable['Telefono']); ?>">
                                <div class="invalid-feedback">Escribí el teléfono del responsable</div>
                            </div>
                        </div>
                    </fieldset>
                <?php } ?>

                <hr class="my-4">

                <h2 class="titulo-bloque mb-1">Cambiar contraseña (opcional)</h2>
                <p class="dato-suave">Dejalo vacío si no querés cambiarla</p>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="contrasena_actual" class="form-label">Contraseña actual</label>
                        <div class="input-group has-validation">
                            <input type="password" id="contrasena_actual" name="contrasena_actual" class="form-control">
                            <button type="button" class="btn btn-ojo" data-campo="contrasena_actual" aria-label="Mostrar contraseña"><i class="bi bi-eye"></i></button>
                            <div class="invalid-feedback">Para cambiarla, escribí tu contraseña actual</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="contrasena_nueva" class="form-label">Nueva contraseña</label>
                        <div class="input-group">
                            <input type="password" id="contrasena_nueva" name="contrasena_nueva" class="form-control">
                            <button type="button" class="btn btn-ojo" data-campo="contrasena_nueva" aria-label="Mostrar contraseña"><i class="bi bi-eye"></i></button>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2 mt-4">
                    <button type="submit" class="btn btn-dorado">Guardar cambios</button>
                    <a href="perfil.php" class="btn btn-borde">Cancelar</a>
                </div>
            </form>

        </div>
    </div>
</main>

<script src="../assets/javascripts/ver-contrasena.js"></script>
<script src="../assets/javascripts/editar-perfil.js"></script>

<?php include '../includes/footer.php'; ?>