$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var dataSet;
    $('#text form #button').click(function (e) {
        let form = $('#text form');
        let button = '<a href="/frequency/export" download="" target="_blank" class="export-one btn btn-info">\n' +
            '                            <i class="fa fa-download"></i> Export excel' +
            '                        </a>';
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
                        aoColumns: [  //// 7 columns as Datatable
                            { "mData": null },
                            { "mData": "word" },
                            { "mData": "times" },
                        ],
                    } );
                    $("div.fg-toolbar").prepend($(button));
                    t.on( 'order.dt search.dt', function () {
                        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                            cell.innerHTML = i+1;
                        } );
                    } ).draw();
                }
            });
    });

    $('.export-one').click(function(e) {
        $.ajax(
            {
                url: "/frequency/submitInput",
                type: "POST",
                data: form.serialize(),
                success: function(result){

                }
            })
    })
});
