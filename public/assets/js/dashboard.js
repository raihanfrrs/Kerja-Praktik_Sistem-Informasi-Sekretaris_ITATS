$(document).ready(function () {
    $.ajax({
        type: "get",
        url: "dashboard/mahasiswa",
        data: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            "date": "day"
        },
        success: function(data){
            $("#amount-mahasiswa").html(data.amount);
            $("#percent-mahasiswa").html(data.percent+"%");
        }
    });

    $.ajax({
        type: "get",
        url: "dashboard/dosen",
        data: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            "date": "day"
        },
        success: function(data){
            $("#amount-dosen").html(data.amount);
            $("#percent-dosen").html(data.percent+"%");
        }
    });
});

$(document).on('click', '.dropdown-item.mahasiswa', function () {
    let date = $(this).attr('id');

    if (date === 'day') {
        $("#mahasiswa-date").html("<span>Today</span>");
    } else if (date === 'month') {
        $("#mahasiswa-date").html("<span>This Month</span>");
    } else if (date === 'year') {
        $("#mahasiswa-date").html("<span>This Year</span>");
    }

    $.ajax({
        type: "get",
        url: "dashboard/mahasiswa",
        data: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            "date": date
        },
        success: function(data){
            $("#amount-mahasiswa").html(data.amount);
            $("#percent-mahasiswa").html(data.percent+"%");
        }
    });
});

$(document).on('click', '.dropdown-item.dosen', function () {
    let date = $(this).attr('id');

    if (date === 'day') {
        $("#date-dosen").html("<span>Today</span>");
    } else if (date === 'month') {
        $("#date-dosen").html("<span>This Month</span>");
    } else if (date === 'year') {
        $("#date-dosen").html("<span>This Year</span>");
    }

    $.ajax({
        type: "get",
        url: "dashboard/dosen",
        data: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            "date": date
        },
        success: function(data){
            $("#amount-dosen").html(data.amount);
            $("#percent-dosen").html(data.percent+"%");
        }
    });
});