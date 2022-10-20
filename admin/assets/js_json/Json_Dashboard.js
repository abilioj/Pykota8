/* Dashboard */
var i = 0;
var msg = 0;
var row = 0;
var idG = 0;
var html = '';
var isOK = false;
var indxf = 0;//index pra dertemina o fim/quantidade de grafico
var urlLangDataTable = "./assets/language/datatables/Portuguese-Brasil.json";
var urlDataMain = "../app/WS/JSON_ADMIN_GRAFICOS.php";
var labels;

function limparRow(row) {
    for (var i = 0; i <= row; i++) {
        $('#myChart' + i + '').remove();
    }
}

function MontarDadosGrafico(data, ano) {
    row = 0;
    labels = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
    var array, nome;
    row = data.info.row;
    console.log(row);
    if (row > 0) {
        i = 0;
        $('div').remove('canvas');
        for (var i = 0; i <= row - 1; i++) {
            html += '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 grom"> <canvas class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="myChart' + i + '" ></canvas> </div>';
        }

        $('#g').html(html);
        $.each(data.grafico, function (key, value) {
            nome = value[0];
            array = [value[1], value[2], value[3], value[4], value[5], value[6], value[7], value[8], value[9], value[10], value[11], value[12]];
            //console.log('myChart' + key, nome + " Em " + ano, array);
            Gerar_DADOS_GRAFiCO_Chart('myChart' + key, nome + " Em " + ano, labels, array);
        });
    }
}

// ajaxBuscarDados Ok
var AJAXMontaGrafico = function (idur, ano, indxf) {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: urlDataMain,
        data: {op: 0, idg: 0, idur: idur, ano: ano, indxf: indxf},
        beforeSend: function () {
            msg = 1;
            $(".msg").html('<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Informação!</strong> Carregando...</div></div>');
            Refet(msg, 6000);
        },
        error: function () {
            msg = 1;
            $('.msg').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Erro ao realizar essa Operação.</div></div>');
        },
        success: function (data) {
            MontarDadosGrafico(data, ano);
        }
    });
};

var AJAX_Atualizar = function () {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: urlDataMain,
        data: {op: 2, idg: 0, idur: 0, ano: 0, indxf: 0},
        beforeSend: function () {
            msg = 1;
            $(".msg").html('<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Informação!</strong> Carregando...</div></div>');
            Refet(msg, 6000);
        },
        error: function () {
            msg = 1;
            $('.msg').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Erro ao realizar essa Operação.</div></div>');
        },
        success: function (data) {
            console.log(data);

            $.each(data.info, function (key, value) {
                if (data.info.isOk === false) {
                    $('.msg').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Erro ao realizar essa Operação.</div></div>');
              }
            });

        }
    });
};

var main = function () {

    $(".sel").select2({
        placeholder: 'Selecione o item',
        allowClear: true
                /* Classificar dados usando comparação em minúsculas */
        , sorter: data => data.sort((a, b) => a.text.toLowerCase() > b.text.toLowerCase() ? 0 : -1)
    });

    indxf = 0;
};

$(document).ready(function () {

    main();
    var $btnPesquisar = $("#btn-pesquisar");
    var $btnTodos = $("#btn-todos");
    var $btnBuscar = $("#btn-buscar");
    var $btnAtualizar = $("#btn-atualizar");

    $btnPesquisar.on("click", function () {
        var idur = parseInt($("#userUR").val());
        var ano = parseInt($("#ano").val());
        AJAXMontaGrafico(idur, ano, null);
    });

    $btnBuscar.on("click", function () {
        var idur = parseInt($("#userUR").val());
        var ano = parseInt($("#ano").val());
        AJAXMontaGrafico(idur, ano, null);
    });

    $btnAtualizar.on("click", function () {
        AJAX_Atualizar();
//        location.reload();
    });

    $btnTodos.on("click", function () {
        location.reload();
    });


});
