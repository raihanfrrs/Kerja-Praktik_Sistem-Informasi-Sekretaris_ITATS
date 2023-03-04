$(document).ready(function () {
    request();
    acception();
});

function request() {
    $.get("/request/read", { 'search': 'default' }, function(surat, status){
        $("#data-surat").html(surat);
    })
}

function acception() {
    $.get("/acception/read", { 'search': 'default' }, function(acception, status){
        $("#data-acception").html(acception);
    })
}

$('#search-request').keypress(function(e) {
    var key = e.which;
    if (key == 13) {
        $('#search-request').click();
        return false;
    }
});

$(document).on('click', '#search-request', function () {
    let search = $('#search-request').val();
    
    $.get('/request/read', {
        'search': search
    })
    .done(response => {
        $("#data-surat").html(response);
        return;
    })
    .fail(errors => {
        return;
    })
});

$(document).on('click', '#request-surat', function () {
    let slug = $(this).data('id');

    $.post('/request', {
        '_token': $('meta[name="csrf-token"]').attr('content'),
        '_method': 'post',
        'slug': slug
    })
    .done(response => {
        if(response == 'success'){
            $("#request-icon").load(location.href + " #request-icon");
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Request Added!',
                showConfirmButton: false,
                timer: 2000
            });
        }else if(response == 'exist'){
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Request Already Exists!',
                showConfirmButton: false,
                timer: 2000
            });
        }else if(response == 'doneYet'){
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'The request is still unfinished!',
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

$(document).on('click', '#delete-request', function () {
    let slug = $(this).data('id');
    
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
        }
    });

    $.ajax({
        type: "post",
        url: "/request/delete",
        data: {
            "slug": slug
        },
        success: function(data){
            $("#request-icon").load(location.href + " #request-icon");
            $("#modal-request").html(data);
            $("#detail-request").modal('show');
            if(!data){
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'Surat Not Found!',
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        }
    });
});

$(document).on('click', '#submit-request-btn', function () {
    $.post('/request/send', {
        '_token': $('meta[name="csrf-token"]').attr('content'),
        '_method': 'post'
    })
    .done(response => {
        if(response) {
            $("#request-icon").load(location.href + " #request-icon");
            $("#detail-request").modal('hide');
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Request Success!',
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