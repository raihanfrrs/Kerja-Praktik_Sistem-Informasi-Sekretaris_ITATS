$(document).ready(function () {
    $.ajax({
        type: "get",
        url: "dashboard/mahasiswa",
        data: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            "date": "day"
        },
        success: function(data){
            console.log(data);
            $("#mahasiswa-amount").html(data.amount);
            $("#percent").html(data.percent+"%");
        }
    });
});

$(document).on('click', '.dropdown-item', function () {
    let date = $(this).attr('id');

    if (date === 'day') {
        $("#date").html("<span>Today</span>");
    } else if (date === 'month') {
        $("#date").html("<span>This Month</span>");
    } else if (date === 'year') {
        $("#date").html("<span>This Year</span>");
    }

    $.ajax({
        type: "get",
        url: "dashboard/mahasiswa",
        data: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            "date": date
        },
        success: function(data){
            console.log(data);
            $("#mahasiswa-amount").html(data.amount);
            $("#percent").html(data.percent+"%");
        }
    });
});