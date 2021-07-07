// Call the dataTables jQuery plugin
$(document).ready(function () {
  $("#dataTable").DataTable({
    aLengthMenu: [
      [25, 50, 100, 200, -1],
      [25, 50, 100, 200, "All"],
    ],
    iDisplayLength: 25,
  });
});

$(document).ready(function () {
  $("#dataTableActivity").DataTable({
    order: [[0, "desc"]],
  });
});

$(document).ready(function () {
  $("#dataTableOrder").DataTable({
    order: [[0, "desc"]],
  });
});

$(document).ready(function () {
  $("#tableTopSeller").DataTable({
    order: [[1, "desc"]],
    lengthChange: false,
    searching: false,
    paging: false,
    info: false,
  });
});
