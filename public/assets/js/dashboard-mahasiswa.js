$(document).ready(function () {
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
        }
    });

    $.ajax({
        type: "get",
        url: "dashboard/request-out/mahasiswa",
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
        url: "dashboard/request-in/mahasiswa",
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
        url: "dashboard/request-reject/mahasiswa",
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
        url: "dashboard/recent-activity/mahasiswa",
        success: function(data){
            $("#activity").html(data);
        }
    });
});

$(document).on('click', '.dropdown-item.request-out', function () {
    let date = $(this).attr('id');

    if (date === 'day') {
        $("#date-request-out").html("<span>Today</span>");
    } else if (date === 'month') {
        $("#date-request-out").html("<span>This Month</span>");
    } else if (date === 'year') {
        $("#date-request-out").html("<span>This Year</span>");
    }

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
        }
    });

    $.ajax({
        type: "get",
        url: "dashboard/request-out/mahasiswa",
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
        $("#date-request-in-mahasiswa").html("<span>Today</span>");
    } else if (date === 'month') {
        $("#date-request-in-mahasiswa").html("<span>This Month</span>");
    } else if (date === 'year') {
        $("#date-request-in-mahasiswa").html("<span>This Year</span>");
    }

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
        }
    });

    $.ajax({
        type: "get",
        url: "dashboard/request-in/mahasiswa",
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
        $("#date-request-reject").html("<span>Today</span>");
    } else if (date === 'month') {
        $("#date-request-reject").html("<span>This Month</span>");
    } else if (date === 'year') {
        $("#date-request-reject").html("<span>This Year</span>");
    }

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
        }
    });

    $.ajax({
        type: "get",
        url: "dashboard/request-reject/mahasiswa",
        data: {
            "date": date
        },
        success: function(data){
            $("#amount-request-reject").html(data.amount);
            $("#percent-request-reject").html(data.percent+"%");
        }
    });
});