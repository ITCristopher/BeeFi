document.addEventListener('DOMContentLoaded', () => {
    const formulario = document.querySelector('form');

    formulario.addEventListener('submit', async (evento) => {
        evento.preventDefault();

        const datos = new URLSearchParams(new FormData(formulario)).toString();

        const respuesta = await fetch('register.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: datos
        });

        const resultado = await respuesta.text();
        if (resultado.includes('Error')) {
            alert('Error: ' + resultado);
        } else {
            alert('Registro exitoso');
            window.location.href = 'index.html'; // Redirigir al inicio de sesión
        }
    });
});