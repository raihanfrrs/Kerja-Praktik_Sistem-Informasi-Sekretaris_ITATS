$(document).ready(function () {
    read();
});

function read() {
    $.get("/request/read", { 'search': 'default' }, function(surat, status){
        $("#data-surat").html(surat);
    })
}

$('#search-form').keypress(function(e) {
    var key = e.which;
    if (key == 13) {
        $('#search-btn').click();
        return false;
    }
});

$(document).on('click', '#search-btn', function () {
    let search = $('#search-form').val();
    
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