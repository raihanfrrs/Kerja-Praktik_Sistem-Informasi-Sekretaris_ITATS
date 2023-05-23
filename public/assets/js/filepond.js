$(document).ready(function () {
    assignment($('#data-detail').data('id'));
});

function assignment(id) {
    $.get("/assignment/detail/read/"+id, {}, function(assignment, status){
        $("#data-detail").html(assignment);

        let inputFileElement = document.querySelectorAll('#file');

        inputFileElement.forEach(function(element) {
            const pond = FilePond.create(element, {
                            allowRevert: false,
                            instantUpload: true,
                            labelTapToUndo: false,
                            allowCancel: false,
                            onaddfilestart: (file) => { isLoadingCheck(); },
                            onprocessfile: (files) => { isLoadingCheck(); }
                        });
    
            function isLoadingCheck(){
                var isLoading = pond.getFiles().filter(x=>x.status !== 5 && x.status !== 6).length !== 0;
                if(isLoading) {
                    $('input[type="file"]').attr("disabled", "disabled");
                    $('.uploading').click(function(){ return false; });
                }else if (pond.getFiles().filter(x=>x.status === 6).length !== 0){
                    $('input[type="file"]').removeAttr("disabled");
                    $('.uploading').off('click');
                }else {
                    $('input[type="file"]').removeAttr("disabled");
                    $('.uploading').off('click');
                }
            }
    
            $(document).on('click', '.file-'+$(element).attr('data-key'), function (){
                FilePond.setOptions({
                    server: {
                        timeout: 7000,
                        process: {
                            url: '/assignment/uploadFileRequest',
                            method: 'POST',
                            withCredentials: false,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
                            },
                            ondata: (formData) => {
                                formData.append('id', $(element).attr('data-key'));
                                return formData;
                            },
                            onload: (response) => {
                                setTimeout(() => {
                                    $('.file-'+$(element).attr('data-key')).addClass('fade-out');
                                }, 3000);
                                setTimeout(() => {
                                    $('.file-'+$(element).attr('data-key')).addClass('d-none');
                                }, 3500);
                                setTimeout(() => {
                                    $('.alert-'+$(element).attr('data-key')).removeClass('d-none');
                                }, 3600);
                            },
                            onerror: (response) => {
                                let objString = response;
                                let jsonObj = JSON.parse(objString);
                                alert(jsonObj.message);
                            }
                        }
                    }
                });
            });
        });
    });
}