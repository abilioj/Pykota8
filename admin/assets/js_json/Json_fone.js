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
var urlDirFiles = "";
var labels;

function jsonTabela(json) {
    var data = [];
    if (json.data !== null) {
        data = json.data;
    }
    table = $('#dataTablesFone').DataTable();
    table.destroy();
    table = $('#dataTablesFone').DataTable({
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
    $('#dataTablesFone').DataTable({
        ajax: '../data/ramais.json'
        , "language": {
            "url": urlLangDataTable
        }
    });   
});
