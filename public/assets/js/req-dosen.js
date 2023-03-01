$(document).ready(function () {
    receive();
});

function receive() {
    $.get("/receive/read", { 'search': 'default' }, function(receive, status){
        $("#data-receive").html(receive);
    })
}