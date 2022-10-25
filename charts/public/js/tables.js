$(document).ready(function () {
    $('#table_0').DataTable(
        {
            columnDefs: [
                {
                    target: 0,
                    visible: false,
                },
            ],
            lengthMenu: [
                [10, 25, 50, 60, 80, 100, -1],
                [10, 25, 50, 60, 80, 100, 'All'],
            ],
        }
    );

    $('.tables_1').DataTable(
        {
            columnDefs: [
                {
                    target: 0,
                    visible: false,
                },
            ],
            lengthMenu: [
                [10, 25, 50, 60, 80, 100, -1],
                [10, 25, 50, 60, 80, 100, 'All'],
            ],
        }
    );
});
