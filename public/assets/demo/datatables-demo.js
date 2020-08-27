// Call the dataTables jQuery plugin
$(document).ready(function () {
    $('#dataTable').DataTable();
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

