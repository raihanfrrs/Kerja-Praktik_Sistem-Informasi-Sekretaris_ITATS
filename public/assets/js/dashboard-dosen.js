$(document).ready(function () {
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
        }
    });

    $.ajax({
        type: "get",
        url: "/dashboard/mahasiswa/superadmin",
        data: {
            "date": "day"
        },
        success: function(data){
            $("#amount-mahasiswa").html(data.amount);
            $("#percent-mahasiswa").html(data.percent+"%");
        }
    });

    $.ajax({
        type: "get",
        url: "/dashboard/dosen/superadmin",
        data: {
            "date": "day"
        },
        success: function(data){
            $("#amount-dosen").html(data.amount);
            $("#percent-dosen").html(data.percent+"%");
        }
    });

    $.ajax({
        type: "get",
        url: "/dashboard/request/superadmin",
        data: {
            "date": "day"
        },
        success: function(data){
            $("#amount-request").html(data.amount);
            $("#percent-request").html(data.percent+"%");
        }
    });

    $.ajax({
        type: "get",
        url: "dashboard/request-activity/superadmin",
        data: {
            "date": "day"
        },
        success: function(data){
            $("#data-request-activity").html(data);
        }
    });

    $.ajax({
        type: "get",
        url: "dashboard/request-in/superadmin",
        success: function(data){
            $("#amount-request-in-dosen").html(data.amount);
            $("#percent-request-in-dosen").html(data.percent+"%");
        }
    });

    $.ajax({
        type: "get",
        url: "dashboard/request-out/superadmin",
        success: function(data){
            $("#amount-request-out-dosen").html(data.amount);
            $("#percent-request-out-dosen").html(data.percent+"%");
        }
    });
    
    $.ajax({
        type: "get",
        url: "dashboard/request-reject/superadmin",
        success: function(data){
            $("#amount-request-reject-dosen").html(data.amount);
            $("#percent-request-reject-dosen").html(data.percent+"%");
        }
    });

    $.ajax({
        type: "get",
        url: "dashboard/request-recent/superadmin",
        success: function(data){
            $("#recent-request").html(data);
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

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
        }
    });

    $.ajax({
        type: "get",
        url: "dashboard/dosen/superadmin",
        data: {
            "date": date
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

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
        }
    });

    $.ajax({
        type: "get",
        url: "dashboard/mahasiswa/superadmin",
        data: {
            "date": date
        },
        success: function(data){
            $("#amount-mahasiswa").html(data.amount);
            $("#percent-mahasiswa").html(data.percent+"%");
        }
    });
});

$(document).on('click', '.dropdown-item.request', function () {
    let date = $(this).attr('id');

    if (date === 'day') {
        $("#date-request").html("<span>Today</span>");
    } else if (date === 'month') {
        $("#date-request").html("<span>This Month</span>");
    } else if (date === 'year') {
        $("#date-request").html("<span>This Year</span>");
    }

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
        }
    });

    $.ajax({
        type: "get",
        url: "dashboard/request/superadmin",
        data: {
            "date": date
        },
        success: function(data){
            $("#amount-request").html(data.amount);
            $("#percent-request").html(data.percent+"%");
        }
    });
});

$(document).on('click', '.dropdown-item.request-activity', function () {
    let date = $(this).attr('id');

    if (date === 'day') {
        $("#date-request-activity").html("<span>Today</span>");
    } else if (date === 'month') {
        $("#date-request-activity").html("<span>This Month</span>");
    } else if (date === 'year') {
        $("#date-request-activity").html("<span>This Year</span>");
    }

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
        }
    });

    $.ajax({
        type: "get",
        url: "dashboard/request-activity/superadmin",
        data: {
            "date": date
        },
        success: function(data){
            $("#data-request-activity").html(data);
        }
    });
});