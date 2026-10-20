<?php
// barra de arriba del sitio publico
// va despues del head.php

// integracion backend: el login tiene que guardar en $_SESSION
// id_usuario, nombre y correo
$hay_sesion = isset($_SESSION['id_usuario']);
?>
<header class="barra-superior">
    <nav class="navbar navbar-expand-xl">
        <div class="container-fluid px-3">

            <a class="navbar-brand" href="<?php echo $ruta; ?>index.php">
                <img src="<?php echo $ruta; ?>assets/img/logo-utu.png" alt="ANEP - UTU Educación Técnico Profesional" class="logo">
            </a>

            <!-- boton del menu en celular -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal" aria-controls="menuPrincipal" aria-expanded="false" aria-label="Abrir menu">
                <i class="bi bi-list"></i>
            </button>

            <div class="collapse navbar-collapse" id="menuPrincipal">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Institucional</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo $ruta; ?>vistas/mision-vision.php">Misión y Visión</a></li>
                            <li><a class="dropdown-item" href="<?php echo $ruta; ?>vistas/historia.php">Historia</a></li>
                            <li><a class="dropdown-item" href="<?php echo $ruta; ?>vistas/logros.php">Logros y reconocimientos</a></li>
                            <li><a class="dropdown-item" href="<?php echo $ruta; ?>vistas/servicios.php">Servicios al estudiante</a></li>
                            <li><a class="dropdown-item" href="<?php echo $ruta; ?>vistas/normas.php">Normas y uniforme</a></li>
                            <li><a class="dropdown-item" href="<?php echo $ruta; ?>vistas/estadisticas.php">Estadísticas</a></li>
                            <li><a class="dropdown-item" href="<?php echo $ruta; ?>vistas/documentos.php">Documentos</a></li>
                            <li><a class="dropdown-item" href="<?php echo $ruta; ?>vistas/galeria.php">Galería</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $ruta; ?>vistas/oferta.php">Oferta Educativa</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $ruta; ?>vistas/noticias.php">Noticias</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $ruta; ?>vistas/eventos.php">Eventos</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $ruta; ?>vistas/becas.php">Becas</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $ruta; ?>vistas/docentes.php">Docentes</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $ruta; ?>vistas/anexos.php">Anexos</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $ruta; ?>vistas/contacto.php">Contacto</a></li>
                </ul>

                <div class="d-flex flex-wrap align-items-center gap-2">
                    <!-- idioma, falta hacer el cambio con js -->
                    <div class="selector-idioma">
                        <a href="#" class="activo">ES</a><span class="separador">|</span><a href="#">PT</a>
                    </div>

                    <?php if ($hay_sesion) { ?>

                        <a href="<?php echo $ruta; ?>usuario/preinscripcion.php" class="btn btn-preinscribirse">Preinscribirse</a>

                        <div class="dropdown">
                            <button class="btn btn-sesion dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Mi cuenta</button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li class="px-3 py-2">
                                    <strong><?php echo htmlspecialchars($_SESSION['nombre']); ?></strong><br>
                                    <span class="dato-suave"><?php echo htmlspecialchars($_SESSION['correo']); ?></span>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?php echo $ruta; ?>usuario/perfil.php">Mi perfil</a></li>
                                <li><a class="dropdown-item" href="<?php echo $ruta; ?>usuario/mis-preinscripciones.php">Mis preinscripciones</a></li>
                                <li><a class="dropdown-item" href="<?php echo $ruta; ?>vistas/horarios.php">Horarios de cursos</a></li>
                                <li><a class="dropdown-item" href="<?php echo $ruta; ?>usuario/sugerencias.php">Enviar una sugerencia</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <!-- integracion backend: cerrar-sesion.php borra la sesion y vuelve al inicio -->
                                <li><a class="dropdown-item" href="<?php echo $ruta; ?>usuario/cerrar-sesion.php">Cerrar sesión</a></li>
                            </ul>
                        </div>

                    <?php } else { ?>

                        <!-- sin sesion los dos van al login -->
                        <a href="<?php echo $ruta; ?>usuario/login.php?desde=preinscripcion" class="btn btn-preinscribirse">Preinscribirse</a>
                        <a href="<?php echo $ruta; ?>usuario/login.php" class="btn btn-sesion">Iniciar sesión</a>

                    <?php } ?>
                </div>
            </div>

        </div>
    </nav>
</header>