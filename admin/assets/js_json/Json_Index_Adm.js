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
var URLINFODATA = "../app/WS/JSON_ADMIN_INDEX_INFODATA.php";
var targets = [];
var pkuser, pkprinter, username, softlimit, hardlimit, pagecounter, lifepagecounter, groupname, printername;

//$(".msg").html('<h3 class="text-info">Aviso: Não há dados Cadastrado nesse Momento</h3>');

var resolutionMain = function () {
    resolution = GetResolution();
    if (resolution.widthMain <= 768) {
        targets = [0, 1, 2, 4, 5];
    } else {
        targets = [0, 1, 2];
    }
};

function getImputModal() {
    printername = $('#printername').val();
    username = $('#username').val();
    softlimit = $('#softlimit').val();
    hardlimit = $('#hardlimit').val();
    pagecounter = $('#pagecounter').val();
    lifepagecounter = $('#lifepagecounter').val();
}

function setImputModal(jsonDATA) {
    $.each(jsonDATA.data, function (key, value) {
        $('#printername').val(value.printername);
        $('#username').val(value.username);
        $('#softlimit').val(value.softlimit);
        $('#hardlimit').val(value.hardlimit);
        $('#pagecounter').val(value.pagecounter);
        $('#lifepagecounter').val(value.lifepagecounter);
    });
}

function jsonTab(json) {
    var data = [];
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
        ,"order": [[ 3, "asc" ]]
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

function jsonGetDados(json, acao) {
    $.each(json.response, function (key, value) {
        row = value.row;
        isOK = value.isOK;
    });
    switch (acao) {
        case "a":
            if (row === 0) {
                $('.msg-m').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Operação ocorre um error.</div>');
                RefetModalHome(0,2000,0);
            } else {
                $('.msg-m').html('<div class="alert alert-success  alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Operação Realizada com Suceesso.</div>');
                RefetModalHome(2, 4500, 0);
            }
            break;
        case "b":
            if (isOK === false || row === 0) {
                RefetModalHome(1, 4000, 1);
            } else {
                setImputModal(json);
            }
            break;
        default:
            break;
    }
}

function BuscarDados() {
    idg = parseInt($("#group").val());
    idu = parseInt($("#user").val());
    idp = parseInt($("#printers").val());
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: urlDataMain,
        data: {idg: idG, idu: idU, idp: idP},
        //contentType: 'application/json; charset=utf-8',
        //async: false,            
        error: function () {
            $('.msg').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Erro ao realizar essa Operação.</div></div>');
        },
        success: function (data) {
            jsonTab(data);
        }
    });
}

function BuscarDadosAdm() {
    idg = parseInt($("#group").val());
    idp = parseInt($("#printers").val());
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: urlDataMain,
        data: {idg: idG, idu: 0, idp: idP},
        //contentType: 'application/json; charset=utf-8',
        //async: false,            
        error: function () {
            $('.msg').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Erro ao realizar essa Operação.</div></div>');
        },
        success: function (data) {
            jsonTab(data);
        }
    });
}

//URLSelect - ok
var Ajax_DaodoSelect = function (idU) {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: URLSelect,
        data: {idU: idU},
        beforeSend: function () {
            $(".msg").html('');
        },
        error: function () {
            msg = 1;
            $('.msg').html('');
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
        data: {idU: idU},
        //contentType: 'application/json; charset=utf-8',
        //async: false,            
        error: function () {
            $('.msg').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Erro ao realizar essa Operação.</div></div>');
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
            $(".msg").html('');
        },
        error: function () {
            $('.msg').html('');
        },
        success: function (json) {
            jsonGetDados(json, acao);
        }
    });
};

var Ajax_InfoData = function () {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: URLINFODATA,
        data: {id: 0},
        beforeSend: function () {
            $(".msg").html('');
        },
        error: function () {
            msg = 1;
            $('.msg').html('');
        },
        success: function (json) {
            $("#limite").html(json.infodata.limite);
            $("#disponivel").html(json.infodata.disponivel);
            $("#consumido").html(json.infodata.consumido);
        }
    });
};

var AtualizarDadosInfo = function () {
    setInterval("Ajax_InfoData()", 3000);
};

var Main = function () {
    resolutionMain();
    table = $('#dataTablesHome').DataTable();
    nivelUseID = $("#nivelUseID").val();

    if (nivelUseID === 3) {
        idUse = $("#idUse").val();
        idU = $("#idUsePykota").val();
        Ajax_DaodoSelect(idU);
        BuscarDados();
    } 
    else {
        BuscarDados();
        Ajax_DaodoSelect(0);
    }

    $(".sel").select2({
        placeholder: 'Selecione o item',
        allowClear: true
                /* Classificar dados usando comparação em minúsculas */
        , sorter: data => data.sort((a, b) => a.text.toLowerCase() > b.text.toLowerCase() ? 0 : -1)
    });

};

$(document).ready(function () {
    AtualizarDadosInfo();
    Main();

    $("#btn-pesquisar").click(function () {
        idg = parseInt($("#group").val());
        idu = parseInt($("#user").val());
        idp = parseInt($("#printers").val());
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: urlDataMain,
            data: {idg: idg, idu: idu, idp: idp},
            //contentType: 'application/json; charset=utf-8',
            //async: false,            
            error: function () {
                $('.msg').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Erro ao realizar essa Operação.</div></div>');
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
        $("#mtitle").html('Grupo ' + data[4]);
        Ajax_ACAO("b", 0, pkuser, pkprinter, 0, 0);
        $('.ModalOpcoes').modal({backdrop: 'static', show: true});
    });

    $("#btn-Alterar").on("click", function () {
        getImputModal();
        Ajax_ACAO("a", 0, pkuser, pkprinter, 0, softlimit);
    });

//    Refet(1, 6000);
    //click blur mouseover dblclick change
    /*$(".Opids").on("click", function () {
     var valorIds = $(this).val();
     $('#valorIds').val(valorIds);
     $('.ModalOpcoes').modal('show');
     });*/

    //    $("#group").change(function () {
    //        var idg = $("#group").val();
    //    });

    //    $('.ModalOpcoes').modal('hide');
    //    $('.ModalOpcoes').modal('toggle');
    //    $('.ModalOpcoes').modal().hide();
    //    $(".ModalOpcoes .close").click()
    //    $('.modal').on('click', function () {
    //        $('.modal').modal('hide');
    //    });
});

//Datatable
//        ,"stateSave": true
//        ,"processing": true
//        ,"serverSide": false
//        ,buttons: [
//            'copy', 'pdf'
//        ]
/*
 '<div class="alert alert-success  alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Operação Realizada com Suceesso.</div>'
 '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Erro ao realizar essa Operação.</div>'
 '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Erro ao realizar essa Operação.</div>'
 '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Estamos implementando essa Operação.</div>'
 '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Carregando...</div>'
 */