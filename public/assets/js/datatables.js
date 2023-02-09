$(document).ready(function () {
    $('#dataMahasiswa').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/dataMahasiswa',
        columns: [
            { data: 'id', name: 'id', class: 'lead-text' },
            { data: 'product_name', name: 'product_name', class: 'text-muted text-capitalize' },
            { data: 'price', name: 'price', class: 'text-muted' },
            { data: 'action', name: 'action' }
        ]
    });
});