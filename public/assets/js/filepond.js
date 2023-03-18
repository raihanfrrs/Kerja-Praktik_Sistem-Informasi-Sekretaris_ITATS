$(document).ready(function () {
    const inputFileElement = document.querySelector('input[id="file"]');
    const pond = FilePond.create(inputFileElement);

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