document.addEventListener('DOMContentLoaded', function () {
    const formMateria = document.querySelector('form[action*="store"], form[action*="update"]');
    const inputAño = formMateria?.querySelector('input[name="año"]');

    if (!formMateria || !inputAño) return;

    const añoActual = new Date().getFullYear();
    const errorSmall = document.getElementById('error-año');
    let temporizadorError;

    inputAño.min = '1900';
    inputAño.max = String(añoActual);

    

    errorSmall.style.color = '#dc3545';
    errorSmall.style.display = 'none';
    errorSmall.style.marginTop = '4px';

    function validarAño() {
        const valorAño = Number(inputAño.value);
        const esValido = Number.isInteger(valorAño) && valorAño >= 1900 && valorAño <= añoActual;

        if (esValido) {
            clearTimeout(temporizadorError);
            errorSmall.style.display = 'none';
            inputAño.style.borderColor = '';
        } else {
            errorSmall.textContent = `Error: el año debe estar entre 1900 y ${añoActual}.`;
            errorSmall.style.display = 'block';
            inputAño.style.borderColor = '#dc3545';

            clearTimeout(temporizadorError);
            temporizadorError = setTimeout(function () {
                errorSmall.style.display = 'none';
            }, 3000);
        }

        return esValido;
    }

    formMateria.addEventListener('submit', function (event) {
        if (!validarAño()) {
            event.preventDefault();
            inputAño.focus();
        }
    });

    inputAño.addEventListener('input', validarAño);
});
