function showDetails() {
    window.location.href = "detalles";
}

function reload() {
    location.reload();
} 

function returnBack() {
    window.history.back();
}

function assignTicket() {
    window.location.href = 'asignar' + '?id=' + document.getElementById('ticketId').value;
}

function editTicket() {
    window.location.href = 'editar' + '?id=' + document.getElementById('ticketId').value;
}

function deleteTicket() {
    window.location.href = 'eliminar';
}