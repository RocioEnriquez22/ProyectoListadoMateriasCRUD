document.addEventListener('DOMContentLoaded', function () {
    // Buscamos cualquier formulario de materia presente en la página
    const formMateria = document.querySelector('form[action*="store"], form[action*="update"]');

    if (!formMateria) return;

    const inputAno = document.getElementById('año');

    if (!inputAno) return;

    // Crear el contenedor para el mensaje de error de manera dinámica debajo del input
    const errorSmall = document.createElement('small');
    errorSmall.style.color = '#dc3545';
    errorSmall.style.fontWeight = 'bold';
    errorSmall.style.display = 'none';
    errorSmall.style.marginTop = '4px';
    
    // Insertar el mensaje debajo del campo Año
    inputAno.parentNode.appendChild(errorSmall);

    // Escuchar el evento submit del formulario
    formMateria.addEventListener('submit', function (e) {
        const valorAno = parseInt(inputAno.value, 10);

        
        if (isNaN(valorAno) || valorAno <= 1900) {
            e.preventDefault(); // Detener el envío del formulario al servidor

            // Mostrar mensaje de error visual
            errorSmall.textContent = 'Error: El año debe ser mayor a 1900.';
            errorSmall.style.display = 'block';
            inputAno.style.borderColor = '#960513e5';
            inputAno.focus();
        } else {
            // Ocultar mensaje si cumple la regla
            errorSmall.style.display = 'none';
            inputAno.style.borderColor = '#ccc';
        }
    });

    // Limpiar el error en tiempo real mientras el usuario escribe
    inputAno.addEventListener('input', function () {
        const valorAno = parseInt(inputAno.value, 10);
        if (!isNaN(valorAno) && valorAno > 2000) {
            errorSmall.style.display = 'none';
            inputAno.style.borderColor = '#ccc';
        }
    });
});