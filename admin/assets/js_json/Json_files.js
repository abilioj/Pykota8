/* Dashboard */
var i = 0;
var msg = 0;
var row = 0;
var idG = 0;
var html = '';
var isOK = false;
var targets = [0];
var table;
var urlLangDataTable = "./assets/language/datatables/Portuguese-Brasil.json";
var urlDirFiles = "../app/WS/JSON_INFO_FILES.php";
var labels;

function jsonTabela(json) {
    var data = [];
    if (json.data !== null) {
        data = json.data;
    }
    table = $('#dataTablesFor').DataTable();
    table.destroy();
    table = $('#dataTablesFor').DataTable({
        data: data
//        , "paging": false
//        , "responsive": false
//        , "info": false
//        , "filter": false
        , "pagingType": "full_numbers"
        , "order": [[1, "asc"]]
        , "columnDefs": [
            {
                "targets": targets
                , "visible": false
            }
        ]
        , "language": {
            "url": urlLangDataTable
        }
    });
}

var AJAXDadosDirFiles = function () {
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: urlDirFiles,
        data: {p: 0},
        beforeSend: function () {
//            $(".msg").html('<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Informação!</strong>Carregando...</div></div>');
        },
        error: function () {
            $('.msg').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Erro ao realizar essa Operação.</div></div>');
        },
        success: function (json) {
            jsonTabela(json);
        }
    });
};

var main = function () {
};

$(document).ready(function () {

    main();
    AJAXDadosDirFiles();

    $('#dataTablesFor tbody').on('click', 'tr', function () {
//        var data = table.row(this).data();
//        ajaxGetDados(data[4]);
//        $("#name").val(data[0]);
//        $('.ModalOpcoesVERPrinter').modal({backdrop: 'static', show: true});
    });
    
});
