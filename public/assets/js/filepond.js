$(document).ready(function () {

    let inputFileElement = document.querySelectorAll('#file');
    
    inputFileElement.forEach(function(element) {
        const pond = FilePond.create(element, {
                        onaddfilestart: (file) => { isLoadingCheck(); },
                        onprocessfile: (files) => { isLoadingCheck(); }
                    });

        function isLoadingCheck(){
            var isLoading = pond.getFiles().filter(x=>x.status !== 5).length !== 0;
            if(isLoading) {
                $('input[type="file"]').attr("disabled", "disabled");
            } else {
                $('input[type="file"]').removeAttr("disabled");
            }
        }

        $(document).on('click', '.file-'+$(element).attr('data-key'), function (){
            FilePond.setOptions({
                server: {
                    process: {
                        url: '/assignment/uploadFileRequest',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
                        },
                        ondata: (formData) => {
                            formData.append('id', $(element).attr('data-key'));
                            return formData;
                        },
                        timeout: 7000,
                    },
                    revert: '/revert',
                    restore: '/restore/',
                    load: '/load/',
                    fetch: '/fetch/',
                },
            });
        });
    });
});