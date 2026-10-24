// editar mis datos: controla los campos antes de guardar

const formulario = document.getElementById('form-perfil');
const avisoErrores = document.getElementById('aviso-errores');

// marca o desmarca un campo en rojo
function marcar(campo, conError) {
    if (conError) {
        campo.classList.add('is-invalid');
    } else {
        campo.classList.remove('is-invalid');
    }
}

formulario.addEventListener('submit', function (evento) {
    let hayErrores = false;

    // nombre, apellido y telefono no pueden quedar vacios
    const obligatorios = ['nombre', 'apellido', 'telefono'];
    for (let i = 0; i < obligatorios.length; i++) {
        const campo = document.getElementById(obligatorios[i]);
        const vacio = campo.value.trim() == '';
        marcar(campo, vacio);
        if (vacio) {
            hayErrores = true;
        }
    }

    // si es menor, el telefono del responsable tampoco (si no es menor, no existe y el for no hace nada)
    const responsable = document.querySelectorAll('.campo-responsable');
    for (let i = 0; i < responsable.length; i++) {
        const vacio = responsable[i].value.trim() == '';
        marcar(responsable[i], vacio);
        if (vacio) {
            hayErrores = true;
        }
    }

    // si escribe una nueva contraseña, tiene que poner la actual
    const actual = document.getElementById('contrasena_actual');
    const nueva = document.getElementById('contrasena_nueva');
    const faltaActual = nueva.value != '' && actual.value == '';
    marcar(actual, faltaActual);
    if (faltaActual) {
        hayErrores = true;
    }

    if (hayErrores) {
        evento.preventDefault();
        avisoErrores.classList.remove('d-none');
        window.scrollTo(0, 0);
    }
});