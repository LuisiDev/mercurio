document.getElementById('guardar-revision').addEventListener('click', function() {
    const selectedTime = document.querySelector('input[name="timetable"]:checked').value;
    const datepicker = document.querySelector('[inline-datepicker]').querySelector('input').value;
    const datetime = `${datepicker} ${selectedTime}`;

    $.ajax({
        type: 'POST',
        url: 'procesar-modal.php',
        data: { fhRevision: datetime },
        success: function(response) {
            console.log(response);
            alert('Fecha y hora guardadas con éxito.');
            $('#revision-modal').ariaModal('hide');
        },
        error: function(error) {
            console.error(error);
            alert('Ocurrió un error al guardar la fecha y hora.');
        }
    });
});