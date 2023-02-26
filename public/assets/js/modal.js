$(document).on('click', '#detail-role-button', function () {
    let slug = $(this).data('id');

    $.get('role/'+slug, {
        '_token': $('meta[name="csrf-token"]').attr('content'),
        '_method': 'get'
    })
    .done(response => {
        $("#modal-role").html(response);
        $("#detail-role").modal('show');
    })
    .fail(errors => {
        return;
    })
});

$(document).on('click', '#detail-surat-button', function () {
    let slug = $(this).data('id');

    $.get('request/'+slug+'/surat', {
        '_token': $('meta[name="csrf-token"]').attr('content'),
        '_method': 'get'
    })
    .done(response => {
        $("#modal-surat").html(response);
        $("#detail-surat").modal('show');
    })
    .fail(errors => {
        return;
    })
});