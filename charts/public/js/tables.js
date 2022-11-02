$(document).ready(function () {
    var table = $('.table_filtered');

    table.each(function (i, t)
    {
        var $this = $(t);

        const table_id = $this.prop('id');

        const tr = $this.find('thead tr')
            .clone(true)
            .addClass('filters')
            .hide()
            .appendTo('#' + $this.prop('id') + ' thead');

        const table = $this.DataTable({
                paging: false,
                scrollX: true,
                orderCellsTop: true,
                "processing": true,

                initComplete: function () {
                    var api = this.api();

                    api
                        .columns()
                        .eq(0)
                        .each(function (colIdx) {

                            var cell = $this.closest('.dataTables_scroll').find('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                            );

                            var title = $(cell).text().trim();
                            $(cell).html('<input type="text" />');

                            var cursorPositionS;
                            var cursorPositionE;


                            $('input', $this.closest('.dataTables_scroll').find('.filters th').eq($(api.column(colIdx).header()).index()))
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

        $("#toggle_filter_"+$this.prop('id')).on('click', function (e)
        {
            e.preventDefault();

            const filters = $("#"+table_id).closest('.dataTables_scroll').find('.filters');
            filters.toggle();

            if (filters.is(":hidden"))
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

        $("#reset_filter_"+$this.prop('id')).on('click', function (e)
        {
            e.preventDefault();

            const filters = $("#"+table_id).closest('.dataTables_scroll').find('.filters');

            filters.hide();

            filters.find('input').each(function () {
                if($(this).val().length > 0) {
                    $(this).val('').change()
                }
            });

            $(this).addClass('btn-secondary');
            $(this).removeClass('btn-outline-secondary');

            table.order( [ 0, 'asc' ] ).draw();
        });
    });
});


const CHART_COLORS = {
    red: '#ff0000',
    orange: '#ed7d31',
    yellow: '#ffc000',
    yellow_light: '#ffe599',
    green: '#00b050',
    dark_green: '#70ad47',
};

const NAMED_COLORS_SHEET2 = {
    'table1': [
        CHART_COLORS.red,
        CHART_COLORS.orange,
        CHART_COLORS.yellow,
        CHART_COLORS.yellow,
        CHART_COLORS.green,
    ],
    'table2': [
        CHART_COLORS.red,
        CHART_COLORS.orange,
        CHART_COLORS.yellow,
        CHART_COLORS.yellow,
    ],
    'table3': [
        CHART_COLORS.red,
        CHART_COLORS.orange,
        CHART_COLORS.yellow,
        CHART_COLORS.yellow,
        CHART_COLORS.green,
    ],
    'table4': [
        CHART_COLORS.red,
        CHART_COLORS.orange,
        CHART_COLORS.yellow,
        CHART_COLORS.yellow,
        CHART_COLORS.green,
    ],
    'table5': [
        CHART_COLORS.red,
        CHART_COLORS.orange,
        CHART_COLORS.yellow,
        CHART_COLORS.yellow,
        CHART_COLORS.green,
    ],
};



const NAMED_COLORS_SHEET3 = {
    'table1': [
        CHART_COLORS.red,
        CHART_COLORS.orange,
        CHART_COLORS.dark_green,
        CHART_COLORS.dark_green,
        CHART_COLORS.yellow,
        CHART_COLORS.yellow,
    ],
    'table2': [
        CHART_COLORS.red,
        CHART_COLORS.orange,
        CHART_COLORS.yellow,
        CHART_COLORS.yellow_light,
        CHART_COLORS.green,
    ],
    'table3': [
        CHART_COLORS.red,
        CHART_COLORS.orange,
        CHART_COLORS.dark_green,
        CHART_COLORS.dark_green,
        CHART_COLORS.yellow,
        CHART_COLORS.yellow,
    ],
    'table4': [
        CHART_COLORS.red,
        CHART_COLORS.orange,
        CHART_COLORS.yellow,
        CHART_COLORS.yellow_light,
        CHART_COLORS.green,
    ],
    'table5': [
        CHART_COLORS.red,
        CHART_COLORS.orange,
        CHART_COLORS.dark_green,
        CHART_COLORS.dark_green,
        CHART_COLORS.yellow,
        CHART_COLORS.yellow,
    ],
    'table6': [
        CHART_COLORS.red,
        CHART_COLORS.orange,
        CHART_COLORS.yellow,
        CHART_COLORS.yellow_light,
        CHART_COLORS.green,
    ],
    'table7': [
        CHART_COLORS.red,
        CHART_COLORS.orange,
        CHART_COLORS.dark_green,
        CHART_COLORS.dark_green,
        CHART_COLORS.yellow,
        CHART_COLORS.yellow,
    ],
    'table8': [
        CHART_COLORS.red,
        CHART_COLORS.orange,
        CHART_COLORS.yellow,
        CHART_COLORS.yellow_light,
        CHART_COLORS.green,
    ],
    'table9': [
        CHART_COLORS.red,
        CHART_COLORS.orange,
        CHART_COLORS.dark_green,
        CHART_COLORS.dark_green,
        CHART_COLORS.yellow,
        CHART_COLORS.yellow,
    ],
    'table10': [
        CHART_COLORS.red,
        CHART_COLORS.orange,
        CHART_COLORS.yellow,
        CHART_COLORS.yellow_light,
        CHART_COLORS.green,
    ],
}
