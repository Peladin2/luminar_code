// boton del ojo para mostrar u ocultar la contraseña
// sirve para cualquier campo, el boton dice en data-campo cual es

const botonesOjo = document.querySelectorAll('.btn-ojo');

for (let i = 0; i < botonesOjo.length; i++) {
    botonesOjo[i].addEventListener('click', function () {
        const campo = document.getElementById(this.getAttribute('data-campo'));
        const icono = this.querySelector('i');

        if (campo.type == 'password') {
            campo.type = 'text';
            icono.classList.remove('bi-eye');
            icono.classList.add('bi-eye-slash');
            this.setAttribute('aria-label', 'Ocultar contraseña');
        } else {
            campo.type = 'password';
            icono.classList.remove('bi-eye-slash');
            icono.classList.add('bi-eye');
            this.setAttribute('aria-label', 'Mostrar contraseña');
        }
    });
}