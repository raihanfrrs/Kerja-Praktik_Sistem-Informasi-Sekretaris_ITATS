$(document).ready(function () {
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
        }
    });

    $.ajax({
        type: "get",
        url: "dashboard/request-out/user",
        data: {
            "date": "day"
        },
        success: function(data){
            $("#amount-request-out").html(data.amount);
            $("#percent-request-out").html(data.percent+"%");
        }
    });

    $.ajax({
        type: "get",
        url: "dashboard/request-in/user",
        data: {
            "date": "day"
        },
        success: function(data){
            $("#amount-request-in-mahasiswa").html(data.amount);
            $("#percent-request-in-mahasiswa").html(data.percent+"%");
        }
    });

    $.ajax({
        type: "get",
        url: "dashboard/request-reject/user",
        data: {
            "date": "day"
        },
        success: function(data){
            $("#amount-request-reject").html(data.amount);
            $("#percent-request-reject").html(data.percent+"%");
        }
    });

    $.ajax({
        type: "get",
        url: "dashboard/recent-activity/user",
        success: function(data){
            $("#activity").html(data);
        }
    });
});

$(document).on('click', '.dropdown-item.request-out', function () {
    let date = $(this).attr('id');

    if (date === 'day') {
        $("#date-request-out").html("<span>Hari ini</span>");
    } else if (date === 'month') {
        $("#date-request-out").html("<span>Bulan ini</span>");
    } else if (date === 'year') {
        $("#date-request-out").html("<span>Tahun ini</span>");
    }

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
        }
    });

    $.ajax({
        type: "get",
        url: "dashboard/request-out/user",
        data: {
            "date": date
        },
        success: function(data){
            $("#amount-request-out").html(data.amount);
            $("#percent-request-out").html(data.percent+"%");
        }
    });
});

$(document).on('click', '.dropdown-item.request-in-mahasiswa', function () {
    let date = $(this).attr('id');

    if (date === 'day') {
        $("#date-request-in-mahasiswa").html("<span>Hari ini</span>");
    } else if (date === 'month') {
        $("#date-request-in-mahasiswa").html("<span>Bulan ini</span>");
    } else if (date === 'year') {
        $("#date-request-in-mahasiswa").html("<span>Tahun ini</span>");
    }

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
        }
    });

    $.ajax({
        type: "get",
        url: "dashboard/request-in/user",
        data: {
            "date": date
        },
        success: function(data){
            $("#amount-request-in-mahasiswa").html(data.amount);
            $("#percent-request-in-mahasiswa").html(data.percent+"%");
        }
    });
});

$(document).on('click', '.dropdown-item.request-reject', function () {
    let date = $(this).attr('id');

    if (date === 'day') {
        $("#date-request-reject").html("<span>Hari ini</span>");
    } else if (date === 'month') {
        $("#date-request-reject").html("<span>Bulan ini</span>");
    } else if (date === 'year') {
        $("#date-request-reject").html("<span>Tahun ini</span>");
    }

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
        }
    });

    $.ajax({
        type: "get",
        url: "dashboard/request-reject/user",
        data: {
            "date": date
        },
        success: function(data){
            $("#amount-request-reject").html(data.amount);
            $("#percent-request-reject").html(data.percent+"%");
        }
    });
});