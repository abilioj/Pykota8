var msg = 0;
var row = 0;
var nivelUseID = 0;
var idUse = 0;
var idU = 0;
var idG = 0;
var idP = 0;
var isOK = false;
var table;
var urlLangDataTable = "./assets/language/datatables/Portuguese-Brasil.json";
var URLSelect = "../app/WS/JSON_ADMIN_SELECT.php";
var urlDataMain = "../app/WS/JSON_ADMIN_INDEX_DATA_ADM.php";
var urlAcao = "../app/WS/JSON_ADMIN_INDEX_ACAO.php";
var targets = [0, 1, 2];
var pkuser, pkprinter, username, softlimit, hardlimit, pagecounter, lifepagecounter, groupname, printername;

//$("#msg").html('<h3 class="text-info">Aviso: Não há dados Cadastrado nesse Momento</h3>');

function getImput() {
    printername = $('#printername').val();
    username = $('#username').val();
    softlimit = $('#softlimit').val();
    hardlimit = $('#hardlimit').val();
    pagecounter = $('#pagecounter').val();
    lifepagecounter = $('#lifepagecounter').val();
}

function jsonTab(json) {
    var data = null;
    if (json.data != null) {
        data = json.data;
    }
    table = $('#dataTablesHome').DataTable();
    table.destroy();
    table = $('#dataTablesHome').DataTable({
        data: data
        , "pagingType": "full_numbers"
        , "responsive": false
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

function jsonCampoSelect(json) {
    var html;
    html = '';
    //Selecione o user
    html = '<option value=""></option>';
    $.each(json.user, function (key, value) {
        html += '<option value="' + value.id + '">' + value.text + '</option>';
    });
    $("#user").html(html);
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
    html = '';
}

function jsonGetDados(json) {
    $.each(json.info, function (key, value) {
        row = value.row;
        isOK = value.isOK;
    });
    if (isOK) {
        $('#msg').html('<div class="alert alert-success  alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Operação Realizada com Suceesso.</div>');
        $('.ModalOpcoes').modal('toggle');
    }
    Refet(1, 2000);
    $.each(json.data, function (key, value) {
        $('#printername').val(value.printername);
        $('#username').val(value.username);
        $('#softlimit').val(value.softlimit);
        $('#hardlimit').val(value.hardlimit);
        $('#pagecounter').val(value.pagecounter);
        $('#lifepagecounter').val(value.lifepagecounter);
    });
}

function limparCampos() {
    //    $(".sel").empty();
}

function BuscarDados() {
    idg = parseInt($("#group").val());
    idu = parseInt($("#user").val());
    idp = parseInt($("#printers").val());
    idUc = parseInt($("#idUsePykota").val());
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: urlDataMain,
        data: {idg: idG, idu: idU, idp: idP, idUc: idUc, op: 1},
        //contentType: 'application/json; charset=utf-8',
        //async: false,            
        error: function () {
            $('#msg').html('button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Erro ao realizar essa Operação.</div></div>');
        },
        success: function (data) {
            jsonTab(data);
        }
    });
}

//URLSelect
var Ajax_DaodoSelect = function (idU) {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: URLSelect,
        data: {idU: idU, op: 1,acao: "op"},
        beforeSend: function () {
            $("#msg").html('');
        },
        error: function () {
            msg = 1;
            $('#msg').html('');
        },
        success: function (json) {
            jsonCampoSelect(json);
        }
    });
};

//urlDataMain
var Ajax_DadosTAB = function (idU) {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: urlDataMain,
        data: {idu: idU, op: 1},
        //contentType: 'application/json; charset=utf-8',
        //async: false,            
        error: function () {
            $('#msg').html('button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Erro ao realizar essa Operação.</div></div>');
        },
        success: function (data) {
            jsonTab(data);
        }
    });
};

//urlAcao
var Ajax_ACAO = function (acao, idg, idu, idp, hardlimit, softlimit) {
    $.ajax({
        type: "POST",
        url: urlAcao,
        dataType: "json",
        data: {acao: acao, idg: idg, idu: idu, idp: idp, hardlimit: hardlimit, softlimit: softlimit}, //
        beforeSend: function () {
            //            $("#msg").html('');
        },
        error: function () {
            $('#msg').html('');
        },
        success: function (json) {
            jsonGetDados(json, acao);
        }
    });
};

var Main = function () {
    table = $('#dataTablesHome').DataTable();
    nivelUseID = $("#nivelUseID").val();
    idU = $("#idUsePykota").val();

    if (nivelUseID == 3) {
        Ajax_DaodoSelect(idU);
    } else {
        Ajax_DaodoSelect(0);
    }

    table.destroy();
    BuscarDados();

    $(".sel").select2({
        placeholder: 'Selecione o item',
        allowClear: true
    });
};

$(document).ready(function () {

    Main();

    $("#btn-pesquisar").click(function () {
        idg = parseInt($("#group").val());
        idu = $("#idUsePykota").val();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: urlDataMain,
            data: {idg: idg, idu: idu, op: 1},
            //contentType: 'application/json; charset=utf-8',
            //async: false,            
            error: function () {
                $('#msg').html('button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Erro ao realizar essa Operação.</div></div>');
            },
            success: function (data) {
                jsonTab(data);
            }
        });
    });

    $("#btn-todos").click(function () {
        location.reload();
    });

    $('#dataTablesHome tbody').on('click', 'tr', function () {
        var data = table.row(this).data();
        pkuser = data[1];
        pkprinter = data[2];
        //$("#mtitle").html('Grupo ' + data[4]);
        //Ajax_ACAO("b", 0, pkuser, pkprinter, 0, 0);
        //$('.ModalOpcoes').modal({backdrop: 'static', show: true});
    });
    
    $("#OpVisualizar").on('dblclick', function (){
        var idGPK = $("#idGPK").val();
        var link = './verGroupMontado.php?idg=' + idGPK + '&idu=' + idU + '';
         window.location.href = link;
    });

});
