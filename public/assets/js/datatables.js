$(document).ready(function () {
    $('#dataMahasiswa').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/dataMahasiswa',
        columns: [
            { data: 'name', name: 'name', class: 'text-muted text-capitalize' },
            { data: 'npm', name: 'npm', class: 'text-muted text-center' },
            { data: 'email', name: 'email', class: 'text-muted' },
            { data: 'phone', name: 'phone', class: 'text-muted text-center' },
            { data: 'status', name: 'status', class: 'text-muted text-center' },
            { data: 'action', name: 'action', class: 'text-center' }
        ]
    });
    
    $('#dataDosen').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/dataDosen',
        columns: [
            { data: 'name', name: 'name', class: 'text-muted text-capitalize' },
            { data: 'nip', name: 'nip', class: 'text-muted text-center' },
            { data: 'email', name: 'email', class: 'text-muted' },
            { data: 'phone', name: 'phone', class: 'text-muted text-center' },
            { data: 'action', name: 'action', class: 'text-center' }
        ]
    });
});