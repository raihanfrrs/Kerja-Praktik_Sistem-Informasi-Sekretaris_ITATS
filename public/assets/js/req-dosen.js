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
        console.log(response);
        // if(response){
        //     Swal.fire({
        //         position: 'center',
        //         icon: 'success',
        //         title: 'Request Added!',
        //         showConfirmButton: false,
        //         timer: 2000
        //     });
        // }else{
        //     Swal.fire({
        //         position: 'center',
        //         icon: 'warning',
        //         title: 'Request Already Exists!',
        //         showConfirmButton: false,
        //         timer: 2000
        //     });
        // }
        return;
    })
    .fail(errors => {
        return;
    })
});