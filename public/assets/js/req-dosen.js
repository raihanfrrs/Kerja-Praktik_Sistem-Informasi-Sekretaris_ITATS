$(document).ready(function () {
    receive();
});

function receive() {
    $.get("/receive/read", { 'search': 'default' }, function(receive, status){
        $("#data-receive").html(receive);
    })
}

$('#search-receive').keypress(function(e) {
    var key = e.which;
    if (key == 13) {
        $('#search-receive-btn').click();
        return false;
    }
});

$(document).on('click', '#search-receive-btn', function () {
    let search = $('#search-receive').val();
    
    $.get('/receive/read', {
        'search': search
    })
    .done(response => {
        $("#data-receive").html(response);
        return;
    })
    .fail(errors => {
        return;
    })
});

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
            receive();
        }else if(response === 'taken'){
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Request Already Taken!',
                showConfirmButton: false,
                timer: 2000
            });
            receive();
        }else if(response === 'finished'){
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Request Already Finished!',
                showConfirmButton: false,
                timer: 2000
            });
            receive();
        }
        return;
    })
    .fail(errors => {
        return;
    })
});