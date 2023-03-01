$(document).ready(function () {
    receive();
});

function receive() {
    $.get("/receive/read", { 'search': 'default' }, function(received, status){
        $("#data-received").html(surat);
    })
}