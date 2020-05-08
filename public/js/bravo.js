function notify(message, type, delay_time = 5) {
    alertify.notify(message, type, delay_time);
}

function applyHeaderSearch(datatable_id, with_action = true, with_select_all = false) {
    let dt_table = window.LaravelDataTables[datatable_id];
    let header_count = dt_table.columns().header().length;

    $('#' + datatable_id + ' thead').append("<tr class='d-none d-md-table-row'></tr>");

    dt_table.columns().every(function (index) {
        if ($('#' + datatable_id + ' thead tr:eq(0) th:eq(' + index + ')').is(':visible')) {
            $('#' + datatable_id + ' thead tr:eq(1)').append("<th></th>");
        }
    });


    $('#' + datatable_id + ' thead tr:eq(1) th').each(function (i) {
        let header = $('#' + datatable_id + ' thead tr:eq(0) th:eq(' + i + ')');

        var title = $(header).text();

        if ($(header).is(':visible')) {
            if (with_action) {
                if (header_count == (i + 1)) {

                } else {
                    if (with_select_all && i === 0) {
                        return null;
                    }
                    $(this).html('<input type="text" class="dt-column-search form-control form-control-sm" placeholder="Search ' + title + '" />');
                    $('input', this).on('change', function () {
                        if (dt_table.column(i).search() !== this.value) {
                            dt_table
                                .column(i)
                                .search(this.value)
                                .draw();
                        }
                    });

                }
            } else {
                $(this).html('<input type="text" class="dt-column-search form-control form-control-sm" placeholder="Search ' + title + '" />');
                $('input', this).on('change', function () {
                    if (dt_table.column(i).search() !== this.value) {
                        dt_table
                            .column(i)
                            .search(this.value)
                            .draw();
                    }
                });
            }
        }
    });
}