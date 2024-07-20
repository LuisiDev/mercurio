document.querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault();

    // Verificar si se debe enviar el correo
    if (document.getElementById('checkCorreo').checked && document.getElementById('correo').value.trim() !== '') {
        // Realizar la solicitud fetch para enviar el correo
        fetch('mail-ticket-sending.php', {
            method: 'POST',
            body: new FormData(this)
        })
        .then(response => response.text())
        .then(data => {
            // Aquí puedes manejar la respuesta si es necesario
            console.log(data); // Puedes mostrar algún mensaje de éxito si deseas
        })
        .catch(error => {
            console.error('Error al enviar el correo:', error);
        });
    }

    // Continuar con el envío del formulario principal
    this.submit();
});