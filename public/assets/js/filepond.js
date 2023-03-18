$(document).ready(function () {

    let inputFileElement = document.querySelectorAll('#file');
    
    inputFileElement.forEach(function(element) {
        FilePond.create(element);
    });
      
    FilePond.setOptions({
        server: {
            process: {
                url: '/assignment/uploadFileRequest/'+$(inputFileElement).data("id"),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
                }
            },
            revert: '/revert',
            restore: '/restore/',
            load: '/load/',
            fetch: '/fetch/',
        },
    });
});