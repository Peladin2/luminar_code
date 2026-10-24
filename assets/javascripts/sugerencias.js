// sugerencias: cuenta los caracteres y no deja enviar vacio
const form = document.getElementById('form-sugerencia');

// si es admin o ya la envio, no hay formulario
if (form) {
    const contenido = document.getElementById('contenido');
    const contador = document.getElementById('contador');
    const avisoErrores = document.getElementById('aviso-errores');

    contenido.addEventListener('input', function () {
        contador.textContent = contenido.value.length;
        contenido.classList.remove('is-invalid');
    });

    form.addEventListener('submit', function (e) {
        // trim para sacar los espacios, asi no se puede mandar solo espacios
        if (contenido.value.trim() == '') {
            e.preventDefault();
            contenido.classList.add('is-invalid');
            avisoErrores.classList.remove('d-none');
            contenido.focus();
        }
    });
}