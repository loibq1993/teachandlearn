$(document).ready(function() {
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

