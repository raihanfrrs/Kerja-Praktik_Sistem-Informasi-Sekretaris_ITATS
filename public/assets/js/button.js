$(document).on('click', '#delete-btn', function(e){
    e.preventDefault();
    let slug = $(this).attr('value');

    Swal.fire({
        title: 'Are you sure?',
        text: "you will permanently delete this account!",
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