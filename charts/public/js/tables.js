$(document).ready(function () {

    $('#table_0 thead tr')
        .clone(true)
        .addClass('filters')
        .hide()
        .appendTo('#table_0 thead');


    var table_0 = $('#table_0').DataTable({
        paging: false,
        fixedHeader: true,
        scrollX: true,
        orderCellsTop: true,
        "processing": true,
        columnDefs: [
            {
                target: 0,
                visible: false,
            }
        ],
        initComplete: function () {
            var api = this.api();

            api
                .columns()
                .eq(0)
                .each(function (colIdx) {

                    if (colIdx === 0)
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

    $("#reset_filter_0").on('click', function (e)
    {
        e.preventDefault();

        $(this).parents().find('.filters').hide();

        $(this).addClass('btn-secondary');
        $(this).removeClass('btn-outline-secondary');


        $(this).parents().find('.filters input').val('').change();
        table_0.order( [ 1, 'asc' ] ).draw();
    });

    $("#toggle_filter_0").on('click', function (e)
    {
        $(this).parents().find('.filters').toggle();

        if ($(this).parents().find('.filters').is(":hidden"))
        {
            $(this).removeClass('btn-secondary');
            $(this).addClass('btn-outline-secondary');
        }
        else
        {
            $(this).addClass('btn-secondary');
            $(this).removeClass('btn-outline-secondary');
        }
    });
});


$(document).ready(function () {

    $('#table_1 thead tr')
        .clone(true)
        .addClass('filters')
        .hide()
        .appendTo('#table_1 thead');


    var table_1 = $('#table_1').DataTable({
        paging: false,


        orderCellsTop: true,
        "processing": true,

        initComplete: function () {
            var api = this.api();

            api
                .columns()
                .eq(0)
                .each(function (colIdx) {

                    var cell = $('#table_1 .filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );

                    var title = $(cell).text().trim();
                    $(cell).html('<input type="text" />');

                    var cursorPositionS;
                    var cursorPositionE;


                    $('input', $('#table_1 .filters th').eq($(api.column(colIdx).header()).index()))
                        .off('keyup change')
                        .on('change', function (e) {
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();

                            cursorPositionS = this.selectionStart;
                            cursorPositionE = this.selectionEnd;

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

    $("#reset_filter_1").on('click', function (e)
    {
        e.preventDefault();

        $('#table_1 .filters').hide();

        $(this).addClass('btn-secondary');
        $(this).removeClass('btn-outline-secondary');


        $('#table_1 .filters input').val('').change();
        table_1.order( [ 0, 'asc' ] ).draw();
    });

    $("#toggle_filter_1").on('click', function (e)
    {
        $('#table_1 .filters').toggle();

        if ($('#table_1 .filters').is(":hidden"))
        {
            $(this).removeClass('btn-secondary');
            $(this).addClass('btn-outline-secondary');
        }
        else
        {
            $(this).addClass('btn-secondary');
            $(this).removeClass('btn-outline-secondary');
        }
    });
});

$(document).ready(function () {

    $('#table_2 thead tr')
        .clone(true)
        .addClass('filters')
        .hide()
        .appendTo('#table_2 thead');


    var table_2 = $('#table_2').DataTable({
        paging: false,
        orderCellsTop: true,
        "processing": true,

        initComplete: function () {
            var api = this.api();

            api
                .columns()
                .eq(0)
                .each(function (colIdx) {

                    var cell = $('#table_2 .filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );

                    var title = $(cell).text().trim();
                    $(cell).html('<input type="text" />');

                    var cursorPositionS;
                    var cursorPositionE;


                    $('input', $('#table_2 .filters th').eq($(api.column(colIdx).header()).index()))
                        .off('keyup change')
                        .on('change', function (e) {
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();

                            cursorPositionS = this.selectionStart;
                            cursorPositionE = this.selectionEnd;

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

    $("#reset_filter_2").on('click', function (e)
    {
        e.preventDefault();

        $('#table_2 .filters').hide();

        $(this).addClass('btn-secondary');
        $(this).removeClass('btn-outline-secondary');


        $('#table_2 .filters input').val('').change();
        table_2.order( [ 0, 'asc' ] ).draw();
    });

    $("#toggle_filter_2").on('click', function (e)
    {
        $('#table_2 .filters').toggle();

        if ($('#table_2 .filters').is(":hidden"))
        {
            $(this).removeClass('btn-secondary');
            $(this).addClass('btn-outline-secondary');
        }
        else
        {
            $(this).addClass('btn-secondary');
            $(this).removeClass('btn-outline-secondary');
        }
    });
});

$(document).ready(function () {

    $('#table_3 thead tr')
        .clone(true)
        .addClass('filters')
        .hide()
        .appendTo('#table_3 thead');


    var table_3 = $('#table_3').DataTable({
        paging: false,
        orderCellsTop: true,
        "processing": true,

        initComplete: function () {
            var api = this.api();

            api
                .columns()
                .eq(0)
                .each(function (colIdx) {

                    var cell = $('#table_3 .filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );

                    var title = $(cell).text().trim();
                    $(cell).html('<input type="text" />');

                    var cursorPositionS;
                    var cursorPositionE;


                    $('input', $('#table_3 .filters th').eq($(api.column(colIdx).header()).index()))
                        .off('keyup change')
                        .on('change', function (e) {
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();

                            cursorPositionS = this.selectionStart;
                            cursorPositionE = this.selectionEnd;

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

    $("#reset_filter_3").on('click', function (e)
    {
        e.preventDefault();

        $('#table_3 .filters').hide();

        $(this).addClass('btn-secondary');
        $(this).removeClass('btn-outline-secondary');


        $('#table_3 .filters input').val('').change();
        table_3.order( [ 0, 'asc' ] ).draw();
    });

    $("#toggle_filter_3").on('click', function (e)
    {
        $('#table_3 .filters').toggle();

        if ($('#table_3 .filters').is(":hidden"))
        {
            $(this).removeClass('btn-secondary');
            $(this).addClass('btn-outline-secondary');
        }
        else
        {
            $(this).addClass('btn-secondary');
            $(this).removeClass('btn-outline-secondary');
        }
    });
});
