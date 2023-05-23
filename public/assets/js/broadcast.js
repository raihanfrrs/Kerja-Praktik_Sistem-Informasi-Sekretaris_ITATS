$(document).ready(function () {
    broadcastFile();
    broadcastList();
    broadcastDosen();
    btnResetSurat();
    btnResetDosen();
    btnSendBroadcast();
});

function broadcastFile() {
    let inputFileElement = document.querySelectorAll('#files');

    inputFileElement.forEach(function(element) {
        const pond = FilePond.create(element);

        FilePond.setOptions({
            server: {
                timeout: 7000,
                process: {
                    url: '/broadcast/uploadFileRequest',
                    method: 'POST',
                    withCredentials: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
                    },
                    onload: (response) => {
                        broadcastList();
                        btnResetSurat();
                        return response;
                    },
                    onerror: (response) => {
                        let objString = response;
                        let jsonObj = JSON.parse(objString);
                        alert(jsonObj.message);
                    }
                },
                revert: (uniqueFileId, load, error) => {
                    deleteFile(uniqueFileId);

                    error('Error terjadi saat hapus file');

                    load();
                }
            }
        });
    });
}

function deleteFile(nameFile){
    $.ajax({
        url: '/broadcast/destroy',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
        },
        type: "DELETE",
        data: {
            file: nameFile
        },
        success: function(response) {
            broadcastList();
            btnResetSurat();
        },
        error: function(response) {
            console.log('error');
        }
    });
}

function broadcastList() {
    $.get("/broadcast/read-surat", {}, function(broadcast, status){
        $("#data-broadcast").html(broadcast);
    })
}

function broadcastDosen() {
    $.get("/broadcast/read-dosen", {}, function(broadcast, status){
        $("#data-listDosen").html(broadcast);
    })
}

function btnResetSurat() {
    $.get("/broadcast/read-btnSurat", {}, function(broadcast, status){
        $("#btn-reset-surat-wait").html(broadcast);
    })
}

function btnResetDosen() {
    $.get("/broadcast/read-btnDosen", {}, function(broadcast, status){
        $("#btn-reset-dosen-wait").html(broadcast);
    })
}

function btnSendBroadcast() {
    $.get("/broadcast/read-btnSend", {}, function(broadcast, status){
        $("#btn-send-broadcast").html(broadcast);
    })
}

$(document).on('click', '#btn-delete-file', function () {
    let file = $(this).data('id');
    
    $.ajax({
        url: '/broadcast/destroy',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
        },
        type: "DELETE",
        data: {
            file: file
        },
        success: function(response) {
            broadcastList();
            btnResetSurat();
            btnSendBroadcast();
        },
        error: function(response) {
            console.log('error');
        }
    });
});

$(document).on('click', '#bulk_store', function () {
    let id = [];

    if(confirm("Apakah dosen yang dipilih sudah benar?")) {
        $('.dosens_checkbox:checked').each(function () {
            id.push($(this).val());
        });

        if (id.length > 0) {
            $.ajax({
                url: '/broadcast/storeDosenData',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
                },
                type: "post",
                data: {
                    id: id
                },
                success: function(response) {
                    $("#listDosenModal").modal('hide');
                    broadcastDosen();
                    btnResetDosen();
                    btnSendBroadcast();
                },
                error: function(response) {
                    let responseJSON = response.responseJSON;
                    alert(responseJSON.message);
                }
            });
        } else {
            alert("Pilih setidaknya satu dosen!");
        }
    }
});

$(document).on('click', '#resetDosen', function () {
    $.ajax({
        url: '/broadcast/resetDosen',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
        },
        type: "post",
        success: function(response) {
            broadcastDosen();
            btnResetDosen();
            btnSendBroadcast();
        },
        error: function(response) {
            return;
        }
    });
});

$(document).on('click', '#resetSurat', function () {
    $.ajax({
        url: '/broadcast/resetSurat',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
        },
        type: "post",
        success: function(response) {
            broadcastList();
            btnResetSurat();
            btnSendBroadcast();
        },
        error: function(response) {
            return;
        }
    });
});

$(document).on('click', '#sendBroadcast', function () {
    let id = $(this).data('id');

    $.ajax({
        url: '/broadcast/store',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
        },
        type: "post",
        success: function(response) {
            location.reload();
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Berhasil Disiarkan!',
                showConfirmButton: false,
                timer: 2000
            });
        },
        error: function(response) {
            return;
        }
    });
});