$(document).ready(function() {
    var base_url     = $("base").attr('href') + "/user";
    var form, action, method, data;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });
    var tableUser = $('#tableUser').DataTable();

});
