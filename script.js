document.addEventListener('DOMContentLoaded', () => {
    const alerta = document.getElementById('alerta-mensaje');
    if (alerta) {
        setTimeout(() => {
            alerta.style.opacity = '0';
            setTimeout(() => alerta.remove(), 500);
        }, 3000);
    }
});

function validarLogin() {
    const inputNombre = document.getElementById('nombre_usuario');
    if (inputNombre && inputNombre.value.trim().length < 2) {
        alert('Por favor, ingresa un nombre válido de al menos 2 caracteres.');
        inputNombre.focus();
        return false;
    }
    return true;
}
