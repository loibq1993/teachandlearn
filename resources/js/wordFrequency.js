$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var dataSet;
    $('#text form #button').click(function (e) {
        let form = $('#text form');
        var table = `<div class="result">
                        <h3>Result</h3>
                        <table id="wordFrequency" class="display" style="width:100%">

                        </table>
                    </div>`;
        $('#text .result').remove();
        $.ajax(
            {
                url: "/frequency/submitInput",
                type: "POST",
                data: form.serialize(),
                success: function(result){
                    dataSet = result;
                    $('#text').append(table);
                    var t = $('#wordFrequency').DataTable( {
                        data: dataSet,
                        columnDefs: [
                            { title: "" },
                            { title: "Word", targets: 1 },
                            { title: "Times", targets: 2 },
                        ],
                        aoColumns: [
                            { "mData": null },
                            { "mData": "word" },
                            { "mData": "times" },
                        ],
                        dom: 'Bfrtip',
                        buttons: [
                            {
                                extend: 'excelHtml5',
                                footer: true,
                                exportOptions: {
                                    columns: [1,2]
                                }
                            },
                        ]
                    } );
                    t.on( 'order.dt search.dt', function () {
                        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                            cell.innerHTML = i+1;
                        } );
                    } ).draw();
                }
            });
    });
});
Dropzone.autoDiscover = false;
$(function() {
    var dropzoneOptions = {
        acceptedFiles: ".doc,.docx",
        addRemoveLinks: true,
    }
    var myDropzone = new Dropzone(".dropzone", dropzoneOptions);
    $("div.download-link").delegate("button", "click", function(){
        var formDownload = $(this).parents('form');
        var filename = formDownload.find('h3').text();
        $.ajax({
                url: "/frequency/export",
                type: "POST",
                data: {
                    data: decodeURIComponent(formDownload.find('input').val()),
                    filename: filename
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

