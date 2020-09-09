Dropzone.autoDiscover = false;
$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let dzParent = $('.container.py-4').children('.body').attr('id');
    let uploadFileType;
    let url;
    switch (dzParent) {
        case 'wordFrequencyCounter':
            uploadFileType = ".doc,.docx";
            url = window.location.href+'/export';
            break;
        case 'flashCard':
            uploadFileType = ".xls,.xlsx";
            url = window.location.href+'/export/pdf';
            break;
        default :
            break;
    }
    const dropzoneOptions = {
        acceptedFiles: uploadFileType,
        addRemoveLinks: true,
    };
    let myDropzone = new Dropzone(".dropzone", dropzoneOptions);
    $("div.download-link").delegate("button", "click", function(){
        var formDownload = $(this).parents('form');
        var filename = formDownload.find('h3').text();
        $.ajax({
            url: url,
            type: "POST",
            data: {
                data: decodeURIComponent(formDownload.find('input').val()),
                filename: filename,
                number: $('#number-card').val(),
                fileType: $('#type').val()
            },
            success: function (response, textStatus, request) {
                var a = document.createElement("a");
                a.href = response.file;
                a.download = response.name;
                document.body.appendChild(a);
                a.click();
                a.remove();
            },
        })
    });
    myDropzone.on("success", function(file, response) {
        let title = file.name.split('.').shift() + '.xls';
        var download = '<form class="download-info" >\n' +
            '                            <h3>'+title+'</h3>\n' +
            '                            <input type="hidden" name="data" value="'+encodeURIComponent(JSON.stringify(response))+'">\n' +
            '                            <button type="button" class="btn btn-success">Download</button>\n' +
            '                            <div class="clearfix"></div>\n' +
            '                        </form>';
        $('.download-link').append(download);
    });
})
