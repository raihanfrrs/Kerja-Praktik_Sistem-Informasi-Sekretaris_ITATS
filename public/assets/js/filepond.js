$(document).ready(function () {

    let inputFileElement = document.querySelectorAll('#file');
    
    inputFileElement.forEach(function(element) {
        FilePond.create(element);

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
                        }
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