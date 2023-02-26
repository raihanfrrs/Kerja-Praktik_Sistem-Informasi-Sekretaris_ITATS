$(document).on('click', '#detail-role-button', function () {
    let slug = $(this).val();

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

