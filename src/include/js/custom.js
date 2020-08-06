$(document).ready(function() {
    let thRowsCount = $('thead th').length;
    let targets = [];
    if (thRowsCount === 6) {
        targets = [0, 3, 5];
    } else {
        targets = [0, 3];
    }

    $('#example').DataTable( {
        "order": [[ 0, "asc" ]],
        "lengthMenu": [[3, 50, 100, -1], [3, 50, 100, "All"]],
        "pageLength": 3,
        "columnDefs": [ {
            "targets": targets,
            "orderable": false
        }],
        "sDom": '<"top"i>rt<"bottom"lp><"clear">',
        "bLengthChange": false,
    } );
} );