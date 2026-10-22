// validaciones del formulario de registro

const formulario = document.getElementById('form-registro');
const fecha = document.getElementById('fecha_nacimiento');
const bloqueResponsable = document.getElementById('bloque-responsable');
const avisoErrores = document.getElementById('aviso-errores');

const obligatorios = ['nombre', 'apellido', 'ci', 'telefono', 'mail', 'contrasena', 'fecha_nacimiento'];
const delResponsable = ['resp_nombre', 'resp_apellido', 'resp_ci', 'resp_telefono'];

// calcula la edad a partir de la fecha del input 
function calcularEdad(texto) {
    const partes = texto.split('-');
    const nacimiento = new Date(partes[0], partes[1] - 1, partes[2]);
    const hoy = new Date();

    let edad = hoy.getFullYear() - nacimiento.getFullYear();

    // si todavia no cumplio este año, se le resta uno
    const mes = hoy.getMonth() - nacimiento.getMonth();
    if (mes < 0 || (mes == 0 && hoy.getDate() < nacimiento.getDate())) {
        edad = edad - 1;
    }
    return edad;
}

function esMenor() {
    if (fecha.value == '') {
        return false;
    }
    return calcularEdad(fecha.value) < 18;
}

// marca o desmarca un campo en rojo
function marcar(campo, conError) {
    if (conError) {
        campo.classList.add('is-invalid');
    } else {
        campo.classList.remove('is-invalid');
    }
}

// cuando cambia la fecha se muestra o se oculta el bloque del responsable
fecha.addEventListener('change', function () {
    if (esMenor()) {
        bloqueResponsable.classList.remove('d-none');
    } else {
        bloqueResponsable.classList.add('d-none');
    }
});

formulario.addEventListener('submit', function (evento) {
    let hayErrores = false;

    // campos que no pueden quedar vacios
    for (let i = 0; i < obligatorios.length; i++) {
        const campo = document.getElementById(obligatorios[i]);
        const vacio = campo.value.trim() == '';
        marcar(campo, vacio);
        if (vacio) {
            hayErrores = true;
        }
    }

    // el correo para formato de correo
    const mail = document.getElementById('mail');
    if (mail.value.trim() != '' && !mail.checkValidity()) {
        marcar(mail, true);
        hayErrores = true;
    }

    // las dos contraseñas tienen que ser iguales
    const contrasena = document.getElementById('contrasena');
    const confirmar = document.getElementById('confirmar');
    const distintas = confirmar.value == '' || confirmar.value != contrasena.value;
    marcar(confirmar, distintas);
    if (distintas) {
        hayErrores = true;
    }

    // si es menor, los datos del responsable son obligatorios
    for (let i = 0; i < delResponsable.length; i++) {
        const campo = document.getElementById(delResponsable[i]);
        const vacio = esMenor() && campo.value.trim() == '';
        marcar(campo, vacio);
        if (vacio) {
            hayErrores = true;
        }
    }

    // para que aceptae el uso de los datos (ley 18.331)
    const acepta = document.getElementById('acepta');
    marcar(acepta, !acepta.checked);
    if (!acepta.checked) {
        hayErrores = true;
    }

    if (hayErrores) {
        evento.preventDefault();
        avisoErrores.classList.remove('d-none');
        window.scrollTo(0, 0);
    }
});