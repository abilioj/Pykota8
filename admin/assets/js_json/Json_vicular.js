var msg = 0;
var row = 0;
var isOK = false;
var table;
var targets = [0, 1];
var urlLangDataTable = "./assets/language/datatables/Portuguese-Brasil.json";
var URLSelect = "app/WS/JSON_ADMIN_VICULAR.php";
var URLAcao = "app/WS/JSON_ADMIN_VICULAR.php";

function jsonCampoSelect(json) {
    var html;
    html = '';
    //Selecione o user
    html = '<option value=""></option>';
    $.each(json.user, function (key, value) {
        html += '<option value="' + value.id + '">' + value.text + '</option>';
    });
    $("#user").html(html);
    //Selecione o useracess
    html = '<option value=""></option>';
    $.each(json.useracess, function (key, value) {
        html += '<option value="' + value.id + '">' + value.text + '</option>';
    });
    $("#useracess").html(html);
    html = '';
    //Selecione o printers
    html = '<option value=""></option>';
    $.each(json.printers, function (key, value) {
        html += '<option value="' + value.id + '">' + value.text + '</option>';
    });
    $("#printers").html(html);
    html = '';
    //Selecione o group
    html = '<option value=""></option>';
    $.each(json.group, function (key, value) {
        html += '<option value="' + value.id + '">' + value.text + '</option>';
    });
    $("#group").html(html);
}

var Ajax_DaodoSelect = function () {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: URLSelect,
        data: {idGU: 1},
//        contentType: 'application/json; charset=utf-8',
/*        beforeSend: function () {
//            $("#msg").html('');
//        },*/
        error: function () {
            msg = 1;
            $('#msg').html('');
        },
        success: function (json) {
            jsonCampoSelect(json);
        }
    });
};

var Main = function () {
    $(".sel").select2({
        placeholder: 'Selecione o item',
        allowClear: true
    });
    Ajax_DaodoSelect();
};

$(document).ready(function () {

    var caminho = $('#caminho').val();
    var caminhos = $('#caminhos').val();
    URLSelect = caminhos + URLSelect;
    console.log(URLSelect);
    Main();

    table = $('#dataTablesLST').DataTable({
        paging: false
    });
    table.destroy();
    table = $('#dataTablesLST').DataTable({
        "language": {
            "url": urlLangDataTable
        }
        , "pagingType": "full_numbers"
        , "responsive": false
        , "columnDefs": [
            {
                "targets": targets
                , "visible": false
            }
        ]
        , searching: false
    });

    $('#dataTablesLST tbody').on('click', 'tr', function () {
        var data = table.row(this).data();
//        var idU = data[0];
//        var idG = data[1];
//        var idUA = data[2];
//        var nameU = data[3]
//        var nameG = data[5]
//        console.log("idG: " + idG + " Nome do Grupo: " + nameG);
        $('.ModalOpcoes').modal({backdrop: 'static', show: true});
    });

    console.log(row);
});