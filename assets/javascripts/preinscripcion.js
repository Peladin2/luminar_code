// preinscripcion: muestra el curso elegido y controla que este todo antes de enviar

const formulario = document.getElementById('form-preinscripcion');

// si la pagina muestra "cerrada" o "limite", no hay formulario y no se hace nada
if (formulario) {
    const opciones = document.getElementsByName('id_oferta');
    const respuestas = document.getElementsByName('curso_grado_anterior');
    const cursoElegido = document.getElementById('curso-elegido');
    const errorOferta = document.getElementById('error-oferta');
    const errorPregunta = document.getElementById('error-pregunta');

    // devuelve la opcion marcada de un grupo de radios, o null si no hay ninguna
    function marcada(grupo) {
        for (let i = 0; i < grupo.length; i++) {
            if (grupo[i].checked) {
                return grupo[i];
            }
        }
        return null;
    }

    function mostrarCursoElegido() {
        const opcion = marcada(opciones);
        if (opcion != null) {
            cursoElegido.textContent = opcion.getAttribute('data-texto');
        }
    }

    // cada vez que elige una oferta se actualiza el resumen
    for (let i = 0; i < opciones.length; i++) {
        opciones[i].addEventListener('change', mostrarCursoElegido);
    }

    // por si vino desde el detalle del curso con una ya marcada
    mostrarCursoElegido();

    formulario.addEventListener('submit', function (evento) {
        let hayErrores = false;

        if (marcada(opciones) == null) {
            errorOferta.classList.remove('d-none');
            hayErrores = true;
        } else {
            errorOferta.classList.add('d-none');
        }

        if (marcada(respuestas) == null) {
            errorPregunta.classList.remove('d-none');
            hayErrores = true;
        } else {
            errorPregunta.classList.add('d-none');
        }

        if (hayErrores) {
            evento.preventDefault();
        }
    });
}