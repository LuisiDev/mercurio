<script>
    $(document).ready(function () {
        $('[data-modal-toggle]').click(function () {
            var ticketId = $(this).attr('data-id');
            console.log(ticketId);

            $('#dynamicTicketId').text(ticketId);
            $('#confirmButton').attr('data-id', ticketId);
        });

        $('#confirmButton').click(function () {
            var ticketId = $(this).attr('data-id');
            console.log(ticketId);

            $('#dynamicTicketIdDelete').text(ticketId);
            $('#idTicketHidden').val(ticketId);

            $('#popup-delete').removeClass('hidden');
        });
    });

    function eliminarTicket() {
        var form = document.getElementById('formEliminarTicket');
        var formData = new FormData(form);

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    alert('Ticket eliminado correctamente');
                } else {
                    alert('No se pudo eliminar el ticket');
                }
                window.location.href = '../web/gestion3.php';
            }
        };
        xhttp.open('POST', '../procesos/ticket-delete.php', true);
        xhttp.send(formData);
    }
</script>