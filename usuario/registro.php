<?php
$titulo = 'Crear cuenta - Escuela Técnica N.º 1';
$ruta = '../';
include '../includes/head.php';
include '../includes/header.php';
?>

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-xl-6">
            <section class="tarjeta h-auto form-cuenta">

                <h1>Crear cuenta</h1>
                <p class="text-center mb-4">Completá tus datos para registrarte</p>

                <!-- aparece solo si hay errores al enviar -->
                <div id="aviso-errores" class="aviso mb-4 d-none">
                    <img src="../assets/iconos/aviso-error.png" alt="Error" class="icono-aviso">
                    <div>
                        <strong>No pudimos crear tu cuenta</strong>
                        <p class="mb-0">Revisá los campos marcados en rojo</p>
                    </div>
                </div>

                <!-- integracion backend: el formulario para guardar el usuario -->
                <form id="form-registro" action="registro.php" method="post" novalidate>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" id="nombre" name="nombre" class="form-control">
                            <div class="invalid-feedback">Escribí tu nombre</div>
                        </div>
                        <div class="col-md-6">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" id="apellido" name="apellido" class="form-control">
                            <div class="invalid-feedback">Escribí tu apellido</div>
                        </div>
                        <div class="col-md-6">
                            <label for="ci" class="form-label">Cédula de identidad</label>
                            <input type="text" id="ci" name="ci" class="form-control" placeholder="1.234.567-8">
                            <div class="invalid-feedback">Escribí tu cédula</div>
                        </div>
                        <div class="col-md-6">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="tel" id="telefono" name="telefono" class="form-control" placeholder="099 123 456">
                            <div class="invalid-feedback">Escribí tu teléfono</div>
                        </div>
                        <div class="col-12">
                            <label for="mail" class="form-label">Correo electrónico</label>
                            <input type="email" id="mail" name="mail" class="form-control">
                            <div class="invalid-feedback">Escribí un correo válido, por ejemplo nombre@gmail.com</div>
                        </div>
                        <div class="col-md-6">
                            <label for="contrasena" class="form-label">Contraseña</label>
                        <div class="input-group has-validation">
                            <input type="password" id="contrasena" name="contrasena" class="form-control">
                            <button type="button" class="btn btn-ojo" data-campo="contrasena" aria-label="Mostrar contraseña"><i class="bi bi-eye"></i></button>
                            <div class="invalid-feedback">Escribí una contraseña</div>
                        </div>
                        </div>
                        <div class="col-md-6">
                            <label for="confirmar" class="form-label">Confirmar contraseña</label>
                        <div class="input-group has-validation">
                            <input type="password" id="confirmar" name="confirmar" class="form-control">
                            <button type="button" class="btn btn-ojo" data-campo="confirmar" aria-label="Mostrar contraseña"><i class="bi bi-eye"></i></button>
                            <div class="invalid-feedback">Las contraseñas no coinciden</div>
                        </div>
                        </div>
                        <div class="col-md-6">
                            <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control">
                            <div class="invalid-feedback">Elegí tu fecha de nacimiento</div>
                        </div>
                    </div>

                    <!-- solo se muestra si es menor de 18 (rne-8) -->
                    <fieldset id="bloque-responsable" class="bloque-responsable mt-4 d-none">
                        <legend>Datos del adulto responsable</legend>
                        <p class="dato-suave">Como sos menor de 18 años, necesitamos los datos de un adulto responsable</p>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="resp_nombre" class="form-label">Nombre</label>
                                <input type="text" id="resp_nombre" name="resp_nombre" class="form-control">
                                <div class="invalid-feedback">Escribí el nombre del responsable</div>
                            </div>
                            <div class="col-md-6">
                                <label for="resp_apellido" class="form-label">Apellido</label>
                                <input type="text" id="resp_apellido" name="resp_apellido" class="form-control">
                                <div class="invalid-feedback">Escribí el apellido del responsable</div>
                            </div>
                            <div class="col-md-6">
                                <label for="resp_ci" class="form-label">Cédula de identidad</label>
                                <input type="text" id="resp_ci" name="resp_ci" class="form-control">
                                <div class="invalid-feedback">Escribí la cédula del responsable</div>
                            </div>
                            <div class="col-md-6">
                                <label for="resp_telefono" class="form-label">Teléfono</label>
                                <input type="tel" id="resp_telefono" name="resp_telefono" class="form-control">
                                <div class="invalid-feedback">Escribí el teléfono del responsable</div>
                            </div>
                        </div>
                    </fieldset>

                    <div class="form-check mt-4">
                        <input type="checkbox" id="acepta" name="acepta" class="form-check-input">
                        <label for="acepta" class="form-check-label">Acepto el uso de mis datos personales según la Ley N.º 18.331</label>
                        <div class="invalid-feedback">Tenés que aceptar para crear la cuenta</div>
                    </div>

                    <button type="submit" class="btn btn-dorado w-100 mt-4">Crear cuenta</button>
                </form>

                <p class="text-center mt-4 mb-0">
                    <a href="login.php" class="link-mas">¿Ya tenés cuenta? Iniciá sesión</a>
                </p>

            </section>
        </div>
    </div>
</main>

<script src="../assets/javascripts/registro.js"></script>
<script src="../assets/javascripts/ver-contrasena.js"></script>

<?php include '../includes/footer.php'; ?>