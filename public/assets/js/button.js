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