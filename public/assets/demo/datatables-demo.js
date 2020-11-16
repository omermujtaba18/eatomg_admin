// Call the dataTables jQuery plugin
$(document).ready(function () {
    $('#dataTable').DataTable({
        aLengthMenu: [
            [25, 50, 100, 200, -1],
            [25, 50, 100, 200, "All"]
        ],
        iDisplayLength: -1
    });
});

$(document).ready(function () {
    $('#dataTableActivity').DataTable({
        "order": [[0, 'desc']]
    });
});

$(document).ready(function () {
    $('#dataTableOrder').DataTable({
        "order": [[0, 'desc']]
    });
});

