
var tables = function () {
//dataTable list - dataTablesList
    $('#dataTablesList').DataTable({
        "language": {
            "url": "./assets/language/datatables/Portuguese-Brasil.json"
        },
        searching : true,
        lengthChange : false,
        stateSave : false,
        responsive : true,
        processing : false,
        serverSide : false
    });
};

var main = function () {
    tables();
};

$(document).ready(function () {
    console.log("ok");
    main();
});
