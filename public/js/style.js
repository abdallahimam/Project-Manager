$("#checkAllLeft").click(function () {
    $(".checkUsers").prop('checked', $(this).prop('checked'));
});

$("#checkAllRight").click(function () {
    $(".checkTrashes").prop('checked', $(this).prop('checked'));
});