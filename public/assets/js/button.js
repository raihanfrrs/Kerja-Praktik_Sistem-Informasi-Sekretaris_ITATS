$(document).on('click', '#delete-btn', function(e){
    e.preventDefault();
    let slug = $(this).attr('value');

    Swal.fire({
        title: 'Are you sure?',
        text: "You will permanently delete this account!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#delete-form-'+slug).submit();
        }
    });
});

$(document).on('click', '#deactivate-btn', function () {
    let slug = $(this).val();
    let level = $(this).data("id");

    if(level === 'mahasiswa' || level === 'dosen'){
        $.post('/'+level+'/'+slug, {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            '_method': 'delete'
        })
        .done(response => {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Deactivated Successfully!',
                showConfirmButton: false,
                timer: 2000
            });
            window.setTimeout(function(){
                window.location.href = window.location.origin+'/'+level;
            }, 2000);
            return;
        })
        .fail(errors => {
            return;
        })
    }else{
        window.location.href = window.location.origin;
    }
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
        $("#request-icon").load(location.href + " #request-icon");
        $("#detail-request").modal('hide');
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Request Success!',
            showConfirmButton: false,
            timer: 2000
        });
        return;
    })
    .fail(errors => {
        return;
    })
});

$(document).on('click', '#delete-history-btn', function (e) {
    e.preventDefault();

    Swal.fire({
        title: 'Are you sure?',
        text: "You will permanently delete this request history!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
            $('#form-delete-history').submit();
        }
    })
});