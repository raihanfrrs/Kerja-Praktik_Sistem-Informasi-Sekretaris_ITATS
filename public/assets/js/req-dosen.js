$(document).ready(function () {
    receive();
    assignment();
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
    let request_id = $(this).data('key');

    $.post('/receive', {
        '_token': $('meta[name="csrf-token"]').attr('content'),
        '_method': 'post',
        'slug': slug,
        'id': request_id
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

$(document).on('click', '#reject-receive-btn', function () {
    let slug = $(this).data('id');

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, reject it!'
      }).then((result) => {
        if (result.isConfirmed) {
            $.post('assive/'+slug+'/reject', {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                '_method': 'post'
            }).done(response => {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Request Rejected!',
                    showConfirmButton: false,
                    timer: 2000
                });
                $('#detail-receive').modal('hide');
                receive();
                return;
            })
            .fail(errors => {
                return;
            });
        }
    })
});

function assignment() {
    $.get("/assignment/read", { 'search': 'default' }, function(assign, status){
        $("#data-assignment").html(assign);
    })
}

$('#search-assignment').keypress(function(e) {
    var key = e.which;
    if (key == 13) {
        $('#search-assignment-btn').click();
        return false;
    }
});

$(document).on('click', '#search-assignment-btn', function () {
    let search = $('#search-assignment').val();
    
    $.get('/assignment/read', {
        'search': search
    })
    .done(response => {
        $("#data-assignment").html(response);
        return;
    })
    .fail(errors => {
        return;
    })
});

$(document).on('click', '#reject-assignment-btn', function () {
    let slug = $(this).data('id');

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, reject it!'
      }).then((result) => {
        if (result.isConfirmed) {
            $.post('assive/'+slug+'/reject', {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                '_method': 'post'
            }).done(response => {
                console.log(response);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Request Rejected!',
                    showConfirmButton: false,
                    timer: 2000
                });
                assignment();
                return;
            })
            .fail(errors => {
                return;
            });
        }
    })
});