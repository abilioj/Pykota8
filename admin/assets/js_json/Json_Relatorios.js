var msg = 0;
var row = 0;
var nivelUseID = 0;
var idUse = 0;
var idU = 0;
var idG = 0;
var idP = 0;
var isOK = false;
var table,dataformInpI,dataformInpII;
var urlLangDataTable = "./assets/language/datatables/Portuguese-Brasil.json";
var urlDataMain = "../app/WS/JSON_ADMIN_RELATORIOS.php";
var urlAcao = "../app/WS/JSON_ADMIN_RELATORIOS_ACAO.php";
var URLSelect = "../app/WS/JSON_ADMIN_SELECT.php";
var targets = [];

//$(".msg").html('<h3 class="text-info">Aviso: Não há dados Cadastrado nesse Momento</h3>');

function jsonTab(json) {
    var data = [];
    if (json.data != null) {
        data = json.data;
    }
    table = $('#dataTables-relatorios').DataTable();
    table.destroy();
    table = $('#dataTables-relatorios').DataTable({
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
    html = '<option value="0"></option>';
    $.each(json.user, function (key, value) {
        html += '<option value="' + value.id + '">' + value.text + '</option>';
    });
    $("#user").html(html);
    html = '';
}

function BuscarDados(idU,dataformInpI,dataformInpII) {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: urlDataMain,
        data: {idU : idU,dataformInpI : dataformInpI,dataformInpII : dataformInpII},
        //contentType: 'application/json; charset=utf-8',         
        error: function () {
            $('.msg').html('button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Erro ao realizar essa Operação.</div></div>');
        },
        success: function (data) {
            jsonTab(data);
        }
    });
}

function mainDados() {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: urlDataMain,
        //data: {},
        contentType: 'application/json; charset=utf-8',
        error: function () {
            $('.msg').html('button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Erro ao realizar essa Operação.</div></div>');
        },
        success: function (data) {
            jsonTab(data);
        }
    });
}

//URLSelect - ok
var Ajax_DaodoSelect = function () {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: URLSelect,
        //data: {},
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

var Main = function () {
    table = $('#dataTables-relatorios').DataTable();
    mainDados();
    $(".sel").select2({
        placeholder: 'Selecione o item',
        allowClear: true
                /* Sort data using lowercase comparison */
        , sorter: data => data.sort((a, b) => a.text.toLowerCase() > b.text.toLowerCase() ? 0 : -1)
    });
    Ajax_DaodoSelect();
};

$(document).ready(function () {

    var resolution = GetResolution();
    if (resolution.widthMain <= 768) {
        targets = [];
    }
    else {
        targets = [];
    }

    Main();

    $("#btn-pesquisar").click(function () {
        idU = $("#user").val();
        dataformInpI = $("#dataformInpI").val();
        dataformInpII = $("#dataformInpII").val();
        if(dataformInpII === ''){
            dataformInpII = dataformInpI;
        }
        console.log(idU + ' - ' + dataformInpI + ' - ' + dataformInpII);
        BuscarDados(idU,dataformInpI,dataformInpII);
    });

    $("#btn-todos").click(function () {
        location.reload();
    });

    $('#dataTables-relatorios tbody').on('click', 'tr', function () {
    });

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