/* Dashboard */
var i = 0;
var msg = 0;
var row = 0;
var idG = 0;
var html = '';
var isOK = false;
var targets = [];
var table;
var urlLangDataTable = "./assets/language/datatables/Portuguese-Brasil.json";
var urlData = "../app/WS/JSON_INFO_PRINTER.php";
var urlDataver = "../app/WS/JSON_INFO_PRINTER_VER.php";
var urlDirFiles = "../app/WS/SON_INFO_FILES.php";
var URLINFODATA = "../app/WS/JSON_ADMIN_INDEX_INFODATA.php";
var labels;
var name, colour_copier_count, colour_printer_coun, copier_coun, printer_coun, overall, status;

var resolutionMain = function () {
//    resolution = GetResolution();
//    if (resolution.widthMain <= 768) {
//        targets = [1,3,4];
//    } else {
//        targets = [];
//    }
};

var initVarModal = function () {
    colour_copier_count = 0;
    colour_printer_coun = 0;
    copier_coun = 0;
    printer_coun = 0;
    overall = 0;
    status = "";
};

function setImputModal() {
    $("#name").val(name);
    $("#colour_copier_count").val(colour_copier_count);
    $("#colour_printer_coun").val(colour_printer_coun);
    $("#copier_coun").val(copier_coun);
    $("#printer_coun").val(printer_coun);
    $("#overall").val(overall);
    $("#status").val(status);
}

function limparRow(row) {
    this.row=row;
}

function jsonTab(json) {
    var data = [];
    if (json.data !== null) {
        data = json.data;
    }
    table = $('#dataTables').DataTable();
    table.destroy();
    table = $('#dataTables').DataTable({
        data: data
        , "paging": false
//        , "pagingType": "full_numbers"
        , "responsive": false
        , "order": [[0, "asc"]]
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

var ajaxDados = function () {
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: urlData,
        data: {op: 0},
        beforeSend: function () {
//            $(".msg").html('<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Informação!</strong>Carregando...</div></div>');
        },
        error: function () {
            $('.msg').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Erro ao realizar essa Operação.</div></div>');
        },
        success: function (json) {
            jsonTab(json);
        }
    });
};

var ajaxGetDados = function (ip) {
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: urlDataver,
        data: {acao: 'b', ip: ip},
        beforeSend: function () {
//            $(".msg").html('<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Informação!</strong>Carregando...</div></div>');
        },
        error: function () {
            $('.msg').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Erro ao realizar essa Operação.</div></div>');
        },
        success: function (json) {
            name = json.name;
            colour_copier_count = json.colour_copier_count;
            colour_printer_coun = json.colour_printer_coun;
            copier_coun = json.copier_coun;
            printer_coun = json.printer_coun;
            overall = json.overall;
            status = json.status;
            setImputModal();
        }
    });
};

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
            console.log(json);
            $("#dataTablesFor").DataTable();
        }
    });
};

function autoRefreshG(interval) {
    setTimeout("atualizarG();", interval);
}

function atualizarG() {
    ajaxDados();
    this.autoRefreshG(9000);
}

var main = function () {
    initVarModal();
    setImputModal();
    ajaxDados();
};

$(document).ready(function () {

    main();
    AJAXDadosDirFiles();

    $('#dataTables tbody').on('click', 'tr', function () {
//        var data = table.row(this).data();
//        ajaxGetDados(data[4]);
//        $("#name").val(data[0]);
//        $('.ModalOpcoesVERPrinter').modal({backdrop: 'static', show: true});
    });
    
});
