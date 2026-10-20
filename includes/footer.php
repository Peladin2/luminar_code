<?php
// pie de pagina, va al final de cada pagina
// INTEGRACIÓN BACKEND: telefono, correo, direccion y redes despues salen de Configuracion
// falta: confirmar telefono, correo y direccion con la escuela

// por si alguna pagina no tiene el header
if (!isset($hay_sesion)) {
    $hay_sesion = false;
}
?>
<footer class="pie">
    <div class="container">
        <div class="row g-4">

            <div class="col-lg-4 col-md-6">
                <p class="nombre-escuela fw-bold mb-2">ESCUELA TÉCNICA DE BELLA UNIÓN N.º 1</p>
                <p class="mb-1">"Mtro. Téc. Sergio González Olaizola"</p>
                <p class="mb-1">Dirección General de Educación Técnico Profesional (UTU) — ANEP</p>
                <p class="mb-0">Fundada el 9 de marzo de 1978</p>
            </div>

            <div class="col-lg-3 col-md-6">
                <h5>CONTACTO</h5>
                <address class="mb-0">
                    Avda. José G. Artigas esq. Pedro Acosta, Bella Unión<br>
                    Tel: <a href="tel:47792025">4779 2025</a><br>
                    <a href="mailto:ubellaunion@gmail.com">ubellaunion@gmail.com</a><br>
                    Anexos: Baltasar Brum · Tomás Gomensoro
                </address>
            </div>

            <div class="col-lg-2 col-md-6">
                <h5>ENLACES</h5>
                <ul class="list-unstyled mb-0">
                    <li><a href="<?php echo $ruta; ?>index.php">Inicio</a></li>
                    <li><a href="<?php echo $ruta; ?>vistas/oferta.php">Oferta educativa</a></li>
                    <li><a href="<?php echo $ruta; ?>vistas/historia.php">Historia del centro</a></li>
                    <li><a href="<?php echo $ruta; ?>vistas/contacto.php#mapa">Cómo llegar</a></li>
                    <?php if ($hay_sesion) { ?>
                        <li><a href="<?php echo $ruta; ?>usuario/preinscripcion.php">Preinscripciones</a></li>
                        <li><a href="<?php echo $ruta; ?>usuario/sugerencias.php">Sugerencias</a></li>
                    <?php } else { ?>
                        <!-- sin sesion van al login -->
                        <li><a href="<?php echo $ruta; ?>usuario/login.php?desde=preinscripcion">Preinscripciones</a></li>
                        <li><a href="<?php echo $ruta; ?>usuario/login.php?desde=sugerencias">Sugerencias</a></li>
                    <?php } ?>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <h5>SÍGUENOS</h5>
                <div class="redes mb-2">
                    <!-- falta: links de facebook e instagram de la escuela -->
                    <a href="#" aria-label="Facebook de la escuela"><i class="bi bi-facebook"></i></a>
                    <a href="#" aria-label="Instagram de la escuela"><i class="bi bi-instagram"></i></a>
                </div>
                <p class="mb-0">Escuela Técnica Bella Unión N.º 1</p>
            </div>

        </div>

        <div class="barra-final">
            © <?php echo date('Y'); ?> Escuela Técnica de Bella Unión N.º 1 — ANEP-UTU.
        </div>
    </div>
</footer>

<!-- js de bootstrap (menu del celular, desplegables y modales) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>