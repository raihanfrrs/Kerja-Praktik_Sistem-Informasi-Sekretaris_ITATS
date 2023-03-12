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



$(document).ready(function(){
    
    $("#btn-show-password").click(() => {
        if ($("#new-pass-input").attr('type') == "password") {
            $("#new-pass-input").attr('type', 'text');
            $("#btn-show-password").html('<i class="bi bi-eye-slash-fill"></i>');
        }else{
            $("#new-pass-input").attr('type', 'password');
            $("#btn-show-password").html("<i class='bi bi-eye-fill'></i>");
        }
    });


    $("#btn-get-otp").click(function(){
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csfr').val()
            }
          });

          $.ajax({
            url:  'get-email',
            type: 'POST',
            data: {
                'Email': $('#yourEmail').val(),
                '_token': $('#csfr').val()},
            success: function (data) {
                if (data.length != 0) {
                    $('#user-id-input').val(data.user_id);
                    var cooldown = 120;
                    $("#btn-get-otp").prop('disabled', true);
                    var x = setInterval(() => {
                        $('#btn-get-otp').val(cooldown+" detik");
                        cooldown = cooldown-1;
                        if (cooldown < 0) {
                            clearInterval(x)
                            $("#btn-get-otp").prop('disabled', false);
                            $('#btn-get-otp').val("Get More Code");
                        }
                    }, 1000);


                    $.ajax({
                        url:  'get-code',
                        type: 'POST',
                        data: {
                            'Email': $('#yourEmail').val(),
                            '_token': $('#csfr').val()},
                        success: function (data) {
                            $('#btn-renew-pass').click(() => {
                                $('#btn-renew-pass').attr('type','submit');
                                if (data == $('#yourOTP').val()) {
                                    $('#btn-renew-pass').click();
                                }

                            })
                        }
                    });
                    
                }else{
                    console.log('tidak');
                    Swal.fire(
                        'Email Anda belum Terdaftar !',
                        'Gunakan Email yang telah terdaftar !',
                        'error'
                      );
                }
          }
          });

          
      
  });
});

