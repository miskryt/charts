
$(document).ready(function ()
{
    $("#toggle_filter_0").on('click', function (){
        $('.filters').toggle();

        if( $('.filters').is(":hidden"))
        {
            $(this).removeClass('btn-secondary');
            $(this).addClass('btn-outline-secondary');
        }
        else {
            $(this).addClass('btn-secondary');
            $(this).removeClass('btn-outline-secondary');
        }

    });




    // Setup - add a text input to each footer cell

    var table = $('#table_0').DataTable({
        paging: false,
        fixedHeader: true,
        scrollX: true,


        columnDefs: [
            {
                target: 0,
                visible: false,
            },
            {
                target: 2,
                visible: false,
            },
            {
                target: 3,
                visible: false,
            },
            {
                target: 4,
                visible: false,
            },
            {
                target: 5,
                visible: false,
            },
            {
                target: 6,
                visible: false,
            },
            {
                target: 7,
                visible: false,
            },
            {
                target: 9,
                visible: false,
            },
            {
                target: 10,
                visible: false,
            },
            {
                target:11,
                visible: false,
            },
        ],

        initComplete: function () {
            var api = this.api();

            $('#table_0 thead tr')
                .clone(true)
                .addClass('filters')
                .hide()
                .appendTo('#table_0 thead');

            api
                .columns()
                .eq(0)
                .each(function (colIdx) {

                    if(colIdx === 0)
                        return;

                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );


                    var title = $(cell).text().trim();
                    $(cell).html('<input type="text" />');

                    var cursorPositionS;
                    var cursorPositionE;

                    $('input', $('.filters th').eq($(api.column(colIdx).header()).index()))
                        .off('keyup change')
                        .on('change', function (e) {
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();


                            cursorPositionS = this.selectionStart;
                            cursorPositionE = this.selectionEnd;


                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
                        })
                        .on('keyup', function (e) {
                            e.stopPropagation();

                            $(this).trigger('change');
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPositionS, cursorPositionE);
                        });
                });
        },
    });
});
