$(document).ready(function () {
    receive();
});

function receive() {
    $.get("/receive/read", { 'search': 'default' }, function(receive, status){
        $("#data-receive").html(receive);
    })
}

$(document).on('click', '#accept-surat', function () {
    let slug = $(this).data('id');

    $.post('/receive', {
        '_token': $('meta[name="csrf-token"]').attr('content'),
        '_method': 'post',
        'slug': slug
    })
    .done(response => {
        if(response === 'success'){
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Accept Success!',
                showConfirmButton: false,
                timer: 2000
            });
        }else if(response === 'taken'){
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Request Already Taken!',
                showConfirmButton: false,
                timer: 2000
            });
        }else if(response === 'finished'){
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Request Already Finished!',
                showConfirmButton: false,
                timer: 2000
            });
        }
        return;
    })
    .fail(errors => {
        return;
    })
});