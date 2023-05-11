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

    $('#dataCategory').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/dataCategory',
        columns: [
            { data: 'jenis', name: 'jenis', class: 'text-muted text-capitalize text-center' },
            { data: 'action', name: 'action', class: 'text-center' }
        ]
    });

    $('#dataSurat').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/dataSurat',
        columns: [
            { data: 'name', name: 'name', class: 'text-muted text-capitalize text-center' },
            { data: 'jenis', name: 'jenis', class: 'text-muted text-capitalize text-center' },
            { data: 'description', name: 'description', class: 'text-muted text-center' },
            { data: 'level', name: 'level', class: 'text-muted text-center text-capitalize' },
            { data: 'action', name: 'action', class: 'text-center' }
        ]
    });

    $('#dataRequestHistory').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/dataRequestHistory',
        columns: [
            { data: 'amount', name: 'amount', class: 'text-muted text-center' },
            { data: 'date', name: 'date', class: 'text-muted text-center' },
            { data: 'status', name: 'status', class: 'text-center' },
            { data: 'action', name: 'action', class: 'text-center' }
        ]
    });

    $('#dataAssignHistory').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/dataAssignHistory',
        columns: [
            { data: 'name', name: 'name', class: 'text-muted text-center' },
            { data: 'date', name: 'date', class: 'text-muted text-center', orderable: true },
            { data: 'status', name: 'status', class: 'text-center' },
            { data: 'action', name: 'action', class: 'text-center' }
        ]
    });
});