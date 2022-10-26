$(document).ready(function () {
    $('#table_0').DataTable(
        {
            paging: false,
            fixedHeader: true,
            columnDefs: [
                {
                    target: 0,
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
