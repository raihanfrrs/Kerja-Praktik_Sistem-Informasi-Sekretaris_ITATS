$(document).ready(function () {
    const inputFileElement = document.querySelector('input[id="file"]');
    const pond = FilePond.create(inputFileElement);

    FilePond.setOptions({
        server: {
            url: '/assignment/uploadFileRequest',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
            }
        }
    });
});