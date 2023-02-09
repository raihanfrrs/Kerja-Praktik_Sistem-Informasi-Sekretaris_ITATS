$(document).ready(function () {
    $('#dataMahasiswa').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/dataMahasiswa',
        columns: [
            { data: 'number', name: 'number', class: 'text-bold' },
            { data: 'name', name: 'name', class: 'text-muted text-capitalize' },
            { data: 'npm', name: 'npm', class: 'text-muted' },
            { data: 'email', name: 'email', class: 'text-muted' },
            { data: 'phone', name: 'phone', class: 'text-muted' },
            { data: 'status', name: 'status', class: 'text-muted text-center' },
            { data: 'action', name: 'action' }
        ]
    });
});